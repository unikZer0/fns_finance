<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicIncomePlan;
use App\Models\AcademicIncomeItem;

return new class extends Migration
{
    public function up(): void
    {
        $extras = [
            ['section_code' => '3.0', 'sort_order' => 0, 'item_name' => 'ຄ່າລົງທະບຽນ ເທີມ 3',                        'num_credits' => null, 'rate_per_person' => 90000, 'nuol_percentage' => 0.0000, 'student_year' => null],
            ['section_code' => '4.0', 'sort_order' => 0, 'item_name' => 'ຄ່າບູລະນະຫ້ອງທົດລອງຄອມພິວເຕີ',               'num_credits' => null, 'rate_per_person' => 50000, 'nuol_percentage' => 0.0000, 'student_year' => null],
            ['section_code' => '5.0', 'sort_order' => 0, 'item_name' => 'ຄ່າບຳລຸງອຸປະກອນຫ້ອງທົດລອງ',                 'num_credits' => null, 'rate_per_person' => 20000, 'nuol_percentage' => 0.0000, 'student_year' => null],
            ['section_code' => '6.0', 'sort_order' => 0, 'item_name' => 'ຄ່າບໍລິການວິຊາການ ແລະ ຄ່າບໍລິການອື່ນໆ',  'num_credits' => null, 'rate_per_person' => 0,     'nuol_percentage' => 0.0000, 'student_year' => null],
        ];

        DB::table('academic_income_defaults')->insert($extras);

        foreach (AcademicIncomePlan::all() as $plan) {
            if ($plan->items()->whereIn('section_code', ['3.0','4.0','5.0','6.0'])->exists()) {
                continue;
            }
            foreach ($extras as $e) {
                AcademicIncomeItem::create([
                    'plan_id'         => $plan->id,
                    'section_code'    => $e['section_code'],
                    'sort_order'      => $e['sort_order'],
                    'item_name'       => $e['item_name'],
                    'num_credits'     => null,
                    'rate_per_person' => $e['rate_per_person'],
                    'num_persons'     => 0,
                    'nuol_percentage' => $e['nuol_percentage'],
                    'student_year'    => null,
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('academic_income_defaults')
            ->whereIn('section_code', ['3.0','4.0','5.0','6.0'])
            ->delete();
    }
};
