<?php

namespace App\Reports\Sections;

use App\Models\AcademicIncomePlan;
use App\Models\RegistrationFeeSetting;

class IncomeSection
{
    public string $id    = 'income';
    public string $title = 'ລາຍຮັບວິຊາການ';
    public string $view  = 'reports.annual.sections.income';

    public function data(int $year): array
    {
        $plan    = AcademicIncomePlan::with('items.degreeProgram')
                     ->where('fiscal_year', $year)->first();
        $grouped = $plan?->items->groupBy('section_code')->sortKeys() ?? collect();

        $feeYear2_4 = RegistrationFeeSetting::with('items')
                        ->where('section_type', 'year2_4')
                        ->orderByDesc('start_year')->first();

        $feeYear1 = RegistrationFeeSetting::with('items')
                      ->where('section_type', 'year1')
                      ->orderByDesc('start_year')->first();

        return compact('plan', 'grouped', 'feeYear2_4', 'feeYear1');
    }

    public function totals(int $year): array
    {
        $plan = AcademicIncomePlan::with('items')->where('fiscal_year', $year)->first();
        if (! $plan) {
            return ['gross' => 0, 'faculty' => 0, 'p1' => 0, 'p2' => 0,
                    'alloc11' => 0, 'alloc13' => 0, 'alloc11_pct' => 0, 'alloc13_pct' => 0];
        }

        $items   = $plan->items;
        $faculty = (float) $items->sum('total_income');
        $p1      = (float) $items->sum('first_payment_amount');
        $p2      = (float) $items->sum('second_payment_amount');
        $gross   = $items->sum(fn ($it) =>
            in_array($it->section_code, ['1.2', '1.4', '4', '5'])
                ? $it->student_count * $it->snap_registration_fee_rate
                : $it->student_count * $it->snap_course_credit_unit * $it->snap_credit_unit_price
        );

        // Proportional allocation: sec1.1 vs sec1.3 faculty credit income
        $alloc11 = (float) $items->where('section_code', '1.1')->sum('total_income');
        $alloc13 = (float) $items->where('section_code', '1.3')->sum('total_income');
        $creditTotal   = $alloc11 + $alloc13;
        $alloc11Pct    = $creditTotal > 0 ? round($alloc11 / $creditTotal, 6) : 0;
        $alloc13Pct    = $creditTotal > 0 ? round(1 - $alloc11Pct, 6) : 0;

        return compact('gross', 'faculty', 'p1', 'p2',
                       'alloc11', 'alloc13', 'alloc11Pct', 'alloc13Pct');
    }
}
