<?php

namespace App\Http\Controllers\FinanceHead;

use App\Http\Controllers\Controller;
use App\Models\AcademicIncomePlan;
use App\Models\AcademicIncomeItem;
use App\Models\CreditUnitPriceSetting;
use App\Models\DegreeProgram;
use App\Models\NuolPctSetting;
use App\Models\RegistrationFeeSetting;
use Illuminate\Http\Request;

class AcademicIncomeAssessmentController extends Controller
{
    public function evaluate(AcademicIncomePlan $academicIncome)
    {
        if ($academicIncome->isApproved()) {
            return redirect()
                ->route('head_of_finance.academic-income.show', $academicIncome)
                ->with('error', 'ແຜນທີ່ອະນຸມັດແລ້ວບໍ່ສາມາດແກ້ໄຂໄດ້');
        }

        $programs11 = DegreeProgram::where('is_active', true)
            ->with('latestCourseCredit')
            ->where(fn($q) => $q
                ->where(fn($q2) => $q2->where('level', 'bachelor')->where('study_year', '>=', 2))
                ->orWhereIn('level', ['master', 'phd'])
            )
            ->orderBy('level')->orderByRaw('study_year IS NULL')->orderBy('study_year')->orderBy('name')
            ->get();

        $programs13 = DegreeProgram::where('is_active', true)
            ->with('latestCourseCredit')
            ->where('level', 'bachelor')
            ->where(fn($q) => $q->where('study_year', 1)->orWhereNull('study_year'))
            ->orderBy('name')
            ->get();

        $creditPrices = CreditUnitPriceSetting::orderByDesc('start_year')
            ->get()->groupBy('level')->map(fn($i) => $i->first());

        $feeYear2_4 = RegistrationFeeSetting::where('section_type', 'year2_4')
            ->with('items')->orderByDesc('start_year')->first();

        $feeYear1 = RegistrationFeeSetting::where('section_type', 'year1')
            ->with('items')->orderByDesc('start_year')->first();

        $existingItems = $academicIncome->items->keyBy(fn($item) => $item->section_code . '_' . $item->degree_program_id);

        $nuolBachelor  = NuolPctSetting::latestFor('bachelor');
        $nuolMasterPhd = NuolPctSetting::latestFor('master_phd');

        return view('dashboards.finance_head.academic-income.evaluate', compact(
            'academicIncome', 'programs11', 'programs13', 'creditPrices',
            'feeYear2_4', 'feeYear1', 'existingItems', 'nuolBachelor', 'nuolMasterPhd'
        ));
    }

    public function saveEvaluate(Request $request, AcademicIncomePlan $academicIncome)
    {
        if ($academicIncome->isApproved()) {
            return back()->with('error', 'ແຜນທີ່ອະນຸມັດແລ້ວບໍ່ສາມາດແກ້ໄຂໄດ້');
        }

        $request->validate([
            's11'          => 'nullable|array',
            's11.*'        => 'nullable|integer|min:0',
            's13'          => 'nullable|array',
            's13.*'        => 'nullable|integer|min:0',
            'students_1_2' => 'required|integer|min:0',
            'students_1_4' => 'required|integer|min:0',
        ]);

        $nuolBachelor  = NuolPctSetting::latestFor('bachelor')?->percentage ?? 0.17;
        $nuolMasterPhd = NuolPctSetting::latestFor('master_phd')?->percentage ?? 0.10;

        $programs11 = DegreeProgram::where('is_active', true)
            ->with('latestCourseCredit')
            ->where(fn($q) => $q
                ->where(fn($q2) => $q2->where('level', 'bachelor')->where('study_year', '>=', 2))
                ->orWhereIn('level', ['master', 'phd'])
            )->get()->keyBy('id');

        $programs13 = DegreeProgram::where('is_active', true)
            ->with('latestCourseCredit')
            ->where('level', 'bachelor')
            ->where(fn($q) => $q->where('study_year', 1)->orWhereNull('study_year'))
            ->get()->keyBy('id');

        $creditPrices = CreditUnitPriceSetting::orderByDesc('start_year')
            ->get()->groupBy('level')->map(fn($i) => $i->first());

        $feeYear2_4 = RegistrationFeeSetting::where('section_type', 'year2_4')
            ->with('items')->orderByDesc('start_year')->first();

        $feeYear1 = RegistrationFeeSetting::where('section_type', 'year1')
            ->with('items')->orderByDesc('start_year')->first();

        // Sections 1.1 and 1.3 — per degree program, rate depends on level
        $sectionPrograms = ['1.1' => [$programs11, 's11'], '1.3' => [$programs13, 's13']];
        foreach ($sectionPrograms as $sectionCode => [$sectionProgramList, $inputKey]) {
            $inputs = $request->input($inputKey, []);
            foreach ($sectionProgramList as $program) {
                $nuol       = $program->level === 'bachelor' ? $nuolBachelor : $nuolMasterPhd;
                $count      = (int) ($inputs[$program->id] ?? 0);
                $creditUnit = $program->latestCourseCredit?->course_credit_unit ?? 0;
                $price      = $creditPrices[$program->level]?->credit_unit_price ?? 0;
                $total      = $count * $creditUnit * $price * (1 - $nuol);

                AcademicIncomeItem::updateOrCreate(
                    ['plan_id' => $academicIncome->id, 'section_code' => $sectionCode, 'degree_program_id' => $program->id],
                    [
                        'student_count'              => $count,
                        'snap_credit_unit_price'     => $price,
                        'snap_course_credit_unit'    => $creditUnit,
                        'snap_registration_fee_rate' => null,
                        'snap_nuol_pct'              => $nuol,
                        'total_income'               => $total,
                        'first_payment_amount'       => 0,
                        'second_payment_amount'      => 0,
                    ]
                );
            }
        }

        // Section 1.2 — Year 2-4 registration fee (bachelor rate)
        $feeRate2_4 = $feeYear2_4 ? $feeYear2_4->total_rate : 0;
        $count12    = (int) $request->students_1_2;
        $total12    = $count12 * $feeRate2_4 * (1 - $nuolBachelor);

        AcademicIncomeItem::updateOrCreate(
            ['plan_id' => $academicIncome->id, 'section_code' => '1.2', 'degree_program_id' => null],
            [
                'student_count'              => $count12,
                'snap_credit_unit_price'     => null,
                'snap_course_credit_unit'    => null,
                'snap_registration_fee_rate' => $feeRate2_4,
                'snap_nuol_pct'              => $nuolBachelor,
                'total_income'               => $total12,
                'first_payment_amount'       => 0,
                'second_payment_amount'      => 0,
            ]
        );

        // Section 1.4 — Year 1 registration fee (bachelor rate)
        $feeRate1 = $feeYear1 ? $feeYear1->total_rate : 0;
        $count14  = (int) $request->students_1_4;
        $total14  = $count14 * $feeRate1 * (1 - $nuolBachelor);

        AcademicIncomeItem::updateOrCreate(
            ['plan_id' => $academicIncome->id, 'section_code' => '1.4', 'degree_program_id' => null],
            [
                'student_count'              => $count14,
                'snap_credit_unit_price'     => null,
                'snap_course_credit_unit'    => null,
                'snap_registration_fee_rate' => $feeRate1,
                'snap_nuol_pct'              => $nuolBachelor,
                'total_income'               => $total14,
                'first_payment_amount'       => 0,
                'second_payment_amount'      => 0,
            ]
        );

        return redirect()
            ->route('head_of_finance.academic-income.summary', $academicIncome)
            ->with('success', 'ບັນທຶກການປະເມີນລາຍຮັບສຳເລັດ');
    }
}
