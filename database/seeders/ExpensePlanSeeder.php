<?php

namespace Database\Seeders;

use App\Models\ExpensePlan;
use App\Models\ExpenseCategory;
use App\Models\ExpenseItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensePlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ExpenseItem::truncate();
        ExpenseCategory::truncate();
        ExpensePlan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminId = DB::table('users')->value('id');

        $plan = ExpensePlan::create([
            'fiscal_year' => 2026,
            'status'      => 'APPROVED',
            'notes'       => 'ແຜນງົບປະມານປະຈຳສົກ 2026 — ນำเข້າຈາກ Planning 2026.xls',
            'created_by'  => $adminId,
        ]);

        // 2.1
        $main1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.1',
            'name'       => 'ແຜນປະເມີນລາຍຈ່າຍບໍລິຫານປົກກະຕິ',
            'sort_order' => 0,
        ]);

        $sub1_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.1',
            'name'       => 'ບໍລິຫານສັງລວມ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 0, 'name' => 'ເຄື່ອງໃຊ້ຫ້ອງການ', 'monthly_amount' => 2800000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 1, 'name' => 'ແບບພິມ', 'monthly_amount' => 250000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 2, 'name' => 'ວາລະສານ ແລະ ໜັງສືພິມ', 'monthly_amount' => 0, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 3, 'name' => 'ຮັບແຂກ', 'monthly_amount' => 800000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 4, 'name' => 'ໂທລະສັບບໍລິຫານ', 'monthly_amount' => 30000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 5, 'name' => 'ຄ່າໄປສະນີ', 'monthly_amount' => 0, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 6, 'name' => 'ຄ່າບໍລິການທະນາຄານ', 'monthly_amount' => 30000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 7, 'name' => 'ຊື້ຂອງຂັວນຂອງຕ້ອນ', 'monthly_amount' => 400000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 8, 'name' => 'ວັນບຸນລະດັບຊາດ', 'monthly_amount' => 500000, 'quantity' => 12, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 9, 'name' => 'ອຸດໜູນວຽກປ້ອງກັນ', 'monthly_amount' => 0, 'quantity' => 12, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub1_1->id, 'sort_order' => 10, 'name' => 'ຄ່ານ້ຳມັນບໍລິຫານ', 'monthly_amount' => 0, 'quantity' => 12, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);

        $sub1_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.2',
            'name'       => 'ບຳລຸງຮັກສາ, ສ້ອມແປງ ແລະ ຕິດຕັ້ງ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 0, 'name' => 'ບຳລຸງຮັກສາຄອມພີວເຕີ', 'monthly_amount' => 9000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 1, 'name' => 'ບຳລຸງຮັກສາເຄື່ອງສາຍໂປຣເຈັກເຕີ', 'monthly_amount' => 5000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 2, 'name' => 'ບຳລຸງຮັກສາແອເຢັນ', 'monthly_amount' => 45000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 3, 'name' => 'ບຳລຸງຮັກສາຕູ້ເຢັນ + ຕູ້ນ້ຳເຢັນ', 'monthly_amount' => 2000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 4, 'name' => 'ບຳລຸງຮັກສາພັດລົມ', 'monthly_amount' => 8000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 5, 'name' => 'ບຳລຸງຮັກສາດອກໄຟ', 'monthly_amount' => 6000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 6, 'name' => 'ບຳລຸງຮັກສາເຄື່ອງພິມ', 'monthly_amount' => 2000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 7, 'name' => 'ບຳລຸງຮັກສາຈັກອັດສຳເນົາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 8, 'name' => 'ຈັກປ້ຳນ້ຳອັດຕະໂນມັດ', 'monthly_amount' => 4000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_2->id, 'sort_order' => 9, 'name' => 'ຈັກຕັດຫຍ້າ', 'monthly_amount' => 2000000, 'quantity' => 1, 'remark' => '']);

        $sub1_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.3',
            'name'       => 'ສ້ອມແປງ ແລະ ປັບປຸງອາຄານຫ້ອງຮຽນ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub1_3->id, 'sort_order' => 0, 'name' => 'ສ້ອມແປງອາຄານສໍານັກງານຕ່າງໆ', 'monthly_amount' => 14000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_3->id, 'sort_order' => 1, 'name' => 'ປັບປຸງອາຄານຫ້ອງຮຽນ-ຫ້ອງທົດລອງ', 'monthly_amount' => 40000000, 'quantity' => 1, 'remark' => '']);

        $sub1_4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.4',
            'name'       => 'ສ້ອມແປງພາຫານະ',
            'sort_order' => 3,
        ]);
        ExpenseItem::create(['category_id' => $sub1_4->id, 'sort_order' => 0, 'name' => 'ສ້ອມແປງລົດຕູ້', 'monthly_amount' => 5700000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_4->id, 'sort_order' => 1, 'name' => 'ສ້ອມແປງລົດຈັກ', 'monthly_amount' => 1000000, 'quantity' => 1, 'remark' => '']);

        $sub1_5 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.5',
            'name'       => 'ຊື້ເຄື່ອງຈັກ, ວັດຖຸອຸປະກອນ',
            'sort_order' => 4,
        ]);
        ExpenseItem::create(['category_id' => $sub1_5->id, 'sort_order' => 0, 'name' => 'ຊື້ ໂຕະ, ຕັ່ງ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_5->id, 'sort_order' => 1, 'name' => 'ບຳລຸງຮັກສາ, ສ້ອມແປງ ໂຕະ, ຕັ່ງ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_5->id, 'sort_order' => 2, 'name' => 'ຊື້ເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ', 'monthly_amount' => 25000000, 'quantity' => 1, 'remark' => '']);

        $sub1_6 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.6',
            'name'       => 'ຄ່າປະກັນໄພພາຫະນະ',
            'sort_order' => 5,
        ]);
        ExpenseItem::create(['category_id' => $sub1_6->id, 'sort_order' => 0, 'name' => 'ປະກັນໄພລົດໃຫຍ່', 'monthly_amount' => 4100000, 'quantity' => 1, 'remark' => '']);

        $sub1_7 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.7',
            'name'       => 'ລາຍຈ່າຍໄປວຽກທາງການ',
            'sort_order' => 6,
        ]);
        ExpenseItem::create(['category_id' => $sub1_7->id, 'sort_order' => 0, 'name' => 'ໄປວຽກທາງການພາຍໃນປະເທດ', 'monthly_amount' => 16000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_7->id, 'sort_order' => 1, 'name' => 'ໄປວຽກທາງການຕ່າງປະເທດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub1_8 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.8',
            'name'       => 'ປົກປັກຮັກສາ ແລະ ອານາໄມອາຄານ, ສະຖານທີ່',
            'sort_order' => 7,
        ]);
        ExpenseItem::create(['category_id' => $sub1_8->id, 'sort_order' => 0, 'name' => 'ບຳລຸງຮັກສາວິທະຍາເຂດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຈ່າຍຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub1_8->id, 'sort_order' => 1, 'name' => 'ອານາໄມອາຄານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຈ່າຍຢູ່ງົບລັດ']);

        $sub1_9 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.9',
            'name'       => 'ວຽກງານກິດຈະກຳນັກສຶກສາ',
            'sort_order' => 8,
        ]);
        ExpenseItem::create(['category_id' => $sub1_9->id, 'sort_order' => 0, 'name' => 'ປະຖົມນິເທດນັກສຶກສາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_9->id, 'sort_order' => 1, 'name' => 'ກວດສອບລະບຽບວິໃນນັກສຶກສາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub1_10 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.10',
            'name'       => 'ລາຍຈ່າຍກອງປະຊຸມ, ສຳມະນາ ແລະ ຝຶກອົບຮົມ',
            'sort_order' => 9,
        ]);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 0, 'name' => 'ກອງປະຊຸມ ສຳນັກຄະນະບໍດີ', 'monthly_amount' => 2400000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 1, 'name' => 'ກອງປະຊຸມ ພາກວິຊາ (6 ພາກ)', 'monthly_amount' => 1200000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 2, 'name' => 'ກອງປະຊຸມ ພະແນກ (6 ພະແນກ)', 'monthly_amount' => 1440000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 3, 'name' => 'ສຳມະນາ ພະແນກວິຊາການ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 4, 'name' => 'ສຳມະນາ ພະແນກຈັດຕັ້ງສັງລວມ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 5, 'name' => 'ສຳມະນາ ພະແນກການເງິນ-ຊັບສິນ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 6, 'name' => 'ຝຶກອົບຮົມ ພະແນກຄຸ້ມຄອງນັກສຶກສາ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 7, 'name' => 'ຝຶກອົບຮົມ ພະແນກຄົ້ນຄ້ວາ ແລະ ບໍລິການ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub1_10->id, 'sort_order' => 8, 'name' => 'ຝຶກອົບຮົມ ພະແນກຫຼັງປະລິນຍາຕີ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);

        $sub1_11 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main1->id,
            'ref_code'   => '2.1.11',
            'name'       => 'ລາຍຈ່າຍບໍລິຫານປົກກະຕິອື່ນໆ',
            'sort_order' => 10,
        ]);
        ExpenseItem::create(['category_id' => $sub1_11->id, 'sort_order' => 0, 'name' => 'ລາຍຈ່າຍບໍລິຫານປົກກະຕິອື່ນໆ', 'monthly_amount' => 36090500, 'quantity' => 1, 'remark' => '']);

        // 2.2
        $main2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.2',
            'name'       => 'ແຜນປະເມີນລາຍຈ່າຍປັບປຸງ ແລະ ສົ່ງເສີມວິຊາການ',
            'sort_order' => 1,
        ]);

        $sub2_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.1',
            'name'       => 'ຊື້ວັດຖຸ, ອຸປະກອນການຮຽນ ແລະ ການສິດສອນ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub2_1->id, 'sort_order' => 0, 'name' => 'ອຸປະກອນການຮຽນ-ການສອນ', 'monthly_amount' => 18000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_1->id, 'sort_order' => 1, 'name' => 'ອຸປະກອນການສອບເສັງ', 'monthly_amount' => 8000000, 'quantity' => 1, 'remark' => '']);

        $sub2_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.2',
            'name'       => 'ປັບປຸງ ແລະ ພັດທະນາການສຶກສາ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub2_2->id, 'sort_order' => 0, 'name' => 'ງົບປະມານປັບປຸງ ແລະ ພັດທະນາການສຶກສາ', 'monthly_amount' => 76000000, 'quantity' => 1, 'remark' => '']);

        $sub2_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.3',
            'name'       => 'ບຳລຸງຫ້ອງທົດລອງ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 0, 'name' => 'ຫ້ອງທົດລອງ ພາກວິຊາຄະນິດສາດ', 'monthly_amount' => 3000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 1, 'name' => 'ຫ້ອງທົດລອງ ພາກວິຊາຟິຊິກສາດ', 'monthly_amount' => 6000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 2, 'name' => 'ຫ້ອງທົດລອງ ພາກວິຊາເຄມີສາດ', 'monthly_amount' => 6000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 3, 'name' => 'ຫ້ອງທົດລອງ ພາກວິຊາຊີວະວິທະຍາ', 'monthly_amount' => 6000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 4, 'name' => 'ຫ້ອງທົດລອງ ພາກວິຊາວິທະຍາສາດຄອມ', 'monthly_amount' => 7000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_3->id, 'sort_order' => 5, 'name' => 'ຄ່າຊ່ວຍຫ້ອງທົດລອງ', 'monthly_amount' => 6000000, 'quantity' => 1, 'remark' => '']);

        $sub2_4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.4',
            'name'       => 'ຊື້ອຸປະກອນທົດລອງ',
            'sort_order' => 3,
        ]);
        ExpenseItem::create(['category_id' => $sub2_4->id, 'sort_order' => 0, 'name' => 'ອຸປະກອນທົດລອງຟິຊິກສາດ', 'monthly_amount' => 32000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_4->id, 'sort_order' => 1, 'name' => 'ອຸປະກອນທົດລອງເຄມີສາດ', 'monthly_amount' => 32000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_4->id, 'sort_order' => 2, 'name' => 'ອຸປະກອນທົດລອງຊີວະວິທະຍາ', 'monthly_amount' => 32000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_4->id, 'sort_order' => 3, 'name' => 'ອຸປະກອນທົດລອງຄອມພິວເຕີ', 'monthly_amount' => 320000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_4->id, 'sort_order' => 4, 'name' => 'ອຸປະກອນທົດລອງຄະນິດສາດ', 'monthly_amount' => 68000000, 'quantity' => 1, 'remark' => '']);

        $sub2_5 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.5',
            'name'       => 'ລາຍຈ່າຍກອງປະຊຸມວິຊາການ',
            'sort_order' => 4,
        ]);
        ExpenseItem::create(['category_id' => $sub2_5->id, 'sort_order' => 0, 'name' => 'ພິທີສະຫຼຸບ ແລະ ເປີດສົກ ປໍໂທ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_5->id, 'sort_order' => 1, 'name' => 'ກອງປະຊຸມສໍາມະນາວິຊາການ ປໍໂທ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_5->id, 'sort_order' => 2, 'name' => 'ກອງປະຊຸມຜູ້ຊົງຄຸນວຸດທິ ປໍໂທ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub2_6 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.6',
            'name'       => 'ບຳລຸງຫ້ອງອ່ານ',
            'sort_order' => 5,
        ]);
        ExpenseItem::create(['category_id' => $sub2_6->id, 'sort_order' => 0, 'name' => 'ຊື້ປື້ມໃສ່ຫ້ອງອ່ານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub2_6->id, 'sort_order' => 1, 'name' => 'ຊື້ຮ້ານປື້ມໃສ່ຫ້ອງອ່ານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub2_7 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.7',
            'name'       => 'ການຍົກລະດັບໄລຍະຍາວ',
            'sort_order' => 6,
        ]);
        ExpenseItem::create(['category_id' => $sub2_7->id, 'sort_order' => 0, 'name' => 'ສົ່ງພະນັກງານໄປຍົກລະດັບໄລຍະຍາວ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub2_8 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main2->id,
            'ref_code'   => '2.2.8',
            'name'       => 'ລາຍຈ່າຍຕິດຕາມການປະຕິບັດຫຼັກສູດ',
            'sort_order' => 7,
        ]);
        ExpenseItem::create(['category_id' => $sub2_8->id, 'sort_order' => 0, 'name' => 'ງົບປະມານຕິດຕາມຫຼັກສູດ ປໍໂທ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        // 2.3
        $main3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.3',
            'name'       => 'ແຜນປະເມີນລາຍຈ່າຍດັດສົມ, ສົ່ງເສີມ ແລະ ບຳລຸງຮັກສາ',
            'sort_order' => 2,
        ]);

        $sub3_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main3->id,
            'ref_code'   => '2.3.1',
            'name'       => 'ບໍລິຫານວິຊາການ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub3_1->id, 'sort_order' => 0, 'name' => 'ສົ່ງເສີມວິຊາການສ່ວນກາງ', 'monthly_amount' => 25000000, 'quantity' => 1, 'remark' => '']);

        $sub3_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main3->id,
            'ref_code'   => '2.3.2',
            'name'       => 'ບູລະນະ ແລະ ປົກປັກຮັກສາວັດທະນະທຳ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 0, 'name' => 'ສຳນັກຄະນະບໍດີ', 'monthly_amount' => 12500000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 1, 'name' => 'ພາກວິຊາຄະນິດສາດ', 'monthly_amount' => 974000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 2, 'name' => 'ພາກວິຊາຟິຊິກສາດ', 'monthly_amount' => 594000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 3, 'name' => 'ພາກວິຊາເຄມີສາດ', 'monthly_amount' => 1666000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 4, 'name' => 'ພາກວິຊາຊີວະວິທະຍາ', 'monthly_amount' => 2000000, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_2->id, 'sort_order' => 5, 'name' => 'ພາກວິຊາວິທະຍາສາດຄອມ', 'monthly_amount' => 2000000, 'quantity' => 1, 'remark' => '']);

        $sub3_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main3->id,
            'ref_code'   => '2.3.3',
            'name'       => 'ໄປທັດສະນະສຶກສາ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 0, 'name' => 'ທັດສະນະສຶກສາ ສຳນັກຄະນະບໍດີ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 1, 'name' => 'ທັດສະນະສຶກສາ ພາກວິຊາຄະນິດສາດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 2, 'name' => 'ທັດສະນະສຶກສາ ພາກວິຊາຟິຊິກສາດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 3, 'name' => 'ທັດສະນະສຶກສາ ພາກວິຊາເຄມີສາດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 4, 'name' => 'ທັດສະນະສຶກສາ ພາກວິຊາຊີວະວິທະຍາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub3_3->id, 'sort_order' => 5, 'name' => 'ທັດສະນະສຶກສາ ພາກວິຊາວິທະຍາສາດຄອມ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        // 2.4
        $main4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.4',
            'name'       => 'ແຜນປະເມີນລາຍຈ່າຍບໍລິຫານອຸດໜູນກົງຈັກ',
            'sort_order' => 3,
        ]);

        $sub4_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main4->id,
            'ref_code'   => '2.4.1',
            'name'       => 'ອຸດໜູນຄ່າບັດໂທລະສັບປະຈຳຕຳແໜ່ງ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub4_1->id, 'sort_order' => 0, 'name' => 'ຄ່າບັດໂທລະສັບ ຄະນະບໍດີ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_1->id, 'sort_order' => 1, 'name' => 'ຄ່າບັດໂທລະສັບ ຮອງຄະນະບໍດີ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_1->id, 'sort_order' => 2, 'name' => 'ຄ່າບັດໂທລະສັບ ຫົວໜ້າພາກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_1->id, 'sort_order' => 3, 'name' => 'ຄ່າບັດໂທລະສັບ ຫົວໜ້າພະແນກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);

        $sub4_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main4->id,
            'ref_code'   => '2.4.2',
            'name'       => 'ອຸດໜູນຄ່ານ້ຳມັນປະຈຳຕຳແໜ່ງ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub4_2->id, 'sort_order' => 0, 'name' => 'ຄ່ານ້ຳມັນ ຄະນະບໍດີ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_2->id, 'sort_order' => 1, 'name' => 'ຄ່ານ້ຳມັນ ຮອງຄະນະບໍດີ ແລະ ຫົວໜ້າພາກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_2->id, 'sort_order' => 2, 'name' => 'ຄ່ານ້ຳມັນ ຫົວໜ້າພະແນກ ແລະ ຮອງພາກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);

        $sub4_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main4->id,
            'ref_code'   => '2.4.3',
            'name'       => 'ເງິນເດືອນສັນຍາຈ້າງ ແລະ ຄ່າແຮງງານ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub4_3->id, 'sort_order' => 0, 'name' => 'ຄ່າແຮງງານ ພະນັກງານສັນຍາຈ້າງ ສຳນັກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_3->id, 'sort_order' => 1, 'name' => 'ຄ່າແຮງງານ ພະນັກງານສັນຍາຈ້າງ ຂັບລົດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_3->id, 'sort_order' => 2, 'name' => 'ສັນຍາຈ້າງ ICT ບຳລຸງຮັກສາລະບົບ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub4_4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main4->id,
            'ref_code'   => '2.4.4',
            'name'       => 'ອຸດໜູນການເຮັດວຽກເພີ່ມ',
            'sort_order' => 3,
        ]);
        ExpenseItem::create(['category_id' => $sub4_4->id, 'sort_order' => 0, 'name' => 'ອຸດໜູນພະນັກງານລົງທະບຽນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_4->id, 'sort_order' => 1, 'name' => 'ອຸດໜູນການສອບເສັງ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);
        ExpenseItem::create(['category_id' => $sub4_4->id, 'sort_order' => 2, 'name' => 'ອຸດໜູນການກວດສອບງົບປະມານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub4_4->id, 'sort_order' => 3, 'name' => 'ອຸດໜູນການຄຸ້ມຄອງນັກສຶກສາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub4_5 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main4->id,
            'ref_code'   => '2.4.5',
            'name'       => 'ອຸດໜູນຄ່າຄອງຊີບ',
            'sort_order' => 4,
        ]);
        ExpenseItem::create(['category_id' => $sub4_5->id, 'sort_order' => 0, 'name' => 'ອຸດໜູນຄ່າຄອງຊີບ ພະນັກງານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => 'ຂື້ນຢູ່ງົບລັດ']);

        // 2.5
        $main5 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.5',
            'name'       => 'ແຜນປະເມີນລາຍຈ່າຍຄ່າສິດສອນ ແລະ ການປະເມີນ',
            'sort_order' => 4,
        ]);

        $sub5_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main5->id,
            'ref_code'   => '2.5.1',
            'name'       => 'ຄ່າສອນລະບົບພິເສດ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub5_1->id, 'sort_order' => 0, 'name' => 'ຄ່າຊົ່ວໂມງສອນ ພາກພິເສດ (ປ.ຕີ)', 'monthly_amount' => 331867200, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_1->id, 'sort_order' => 1, 'name' => 'ຄ່າຊົ່ວໂມງສອນ ປະລິນຍາໂທ', 'monthly_amount' => 326332800, 'quantity' => 1, 'remark' => '']);

        $sub5_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main5->id,
            'ref_code'   => '2.5.2',
            'name'       => 'ຄ່າບໍລິການສອບເສັງ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub5_2->id, 'sort_order' => 0, 'name' => 'ຄ່າກຳມະການສອບເສັງຈົບຊັ້ນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_2->id, 'sort_order' => 1, 'name' => 'ຄ່າຍາມຫ້ອງເສັງ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_2->id, 'sort_order' => 2, 'name' => 'ຄ່າອອກຫົວບົດ ແລະ ກວດບົດ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_2->id, 'sort_order' => 3, 'name' => 'ຄ່າບໍລິການສອບເສັງອື່ນໆ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub5_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main5->id,
            'ref_code'   => '2.5.3',
            'name'       => 'ບົດໂຄງການຈົບຊັ້ນ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub5_3->id, 'sort_order' => 0, 'name' => 'ຄ່າຊີ້ນຳບົດໂຄງການຈົບຊັ້ນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_3->id, 'sort_order' => 1, 'name' => 'ຄ່າກຳມະການປ້ອງກັນບົດຈົບຊັ້ນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub5_3->id, 'sort_order' => 2, 'name' => 'ຄ່າດຳເນີນບົດ ປໍໂທ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub5_4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main5->id,
            'ref_code'   => '2.5.4',
            'name'       => 'ອຸດໜູນການລົງທະບຽນ',
            'sort_order' => 3,
        ]);
        ExpenseItem::create(['category_id' => $sub5_4->id, 'sort_order' => 0, 'name' => 'ອຸດໜູນການລົງທະບຽນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        // 2.6
        $main6 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => null,
            'ref_code'   => '2.6',
            'name'       => 'ແຜນລາຍຈ່າຍເຄື່ອນໄຫວນອກຫຼັກສູດ',
            'sort_order' => 5,
        ]);

        $sub6_1 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main6->id,
            'ref_code'   => '2.6.1',
            'name'       => 'ບໍລິຈາກເລືອດໃຫ້ອົງການກາແດງລາວ',
            'sort_order' => 0,
        ]);
        ExpenseItem::create(['category_id' => $sub6_1->id, 'sort_order' => 0, 'name' => 'ບໍລິຈາກເລືອດຄັ້ງທີ I', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_1->id, 'sort_order' => 1, 'name' => 'ບໍລິຈາກເລືອດຄັ້ງທີ II', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub6_2 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main6->id,
            'ref_code'   => '2.6.2',
            'name'       => 'ເຄື່ອນໄຫວກິລາ ແລະ ສິນລະປະ',
            'sort_order' => 1,
        ]);
        ExpenseItem::create(['category_id' => $sub6_2->id, 'sort_order' => 0, 'name' => 'ການແຂ່ງຂັນກິລາຊາວໜຸ່ມ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_2->id, 'sort_order' => 1, 'name' => 'ການເຄື່ອນໄຫວກິລາພາຍໃນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_2->id, 'sort_order' => 2, 'name' => 'ການເຄື່ອນໄຫວກິລາກັບທາງນອກ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_2->id, 'sort_order' => 3, 'name' => 'ການເຄື່ອນໄຫວສິນລະປະກຳ ນັກສຶກສາ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_2->id, 'sort_order' => 4, 'name' => 'ການຝຶກຊ້ອມສິນລະປະວັນນະຄະດີ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub6_3 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main6->id,
            'ref_code'   => '2.6.3',
            'name'       => 'ອອກແຮງງານລວມ',
            'sort_order' => 2,
        ]);
        ExpenseItem::create(['category_id' => $sub6_3->id, 'sort_order' => 0, 'name' => 'ອານາໄມຫ້ອງຮຽນ, ຫ້ອງການ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_3->id, 'sort_order' => 1, 'name' => 'ອານາໄມສະຖານທີ່ຮັບຜິດຊອບ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_3->id, 'sort_order' => 2, 'name' => 'ປຸກຕົ້ນໄມ້', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

        $sub6_4 = ExpenseCategory::create([
            'plan_id'    => $plan->id,
            'parent_id'  => $main6->id,
            'ref_code'   => '2.6.4',
            'name'       => 'ຈັດການແຂ່ງຂັນຖາມ-ຕອບວິທະຍາສາດ',
            'sort_order' => 3,
        ]);
        ExpenseItem::create(['category_id' => $sub6_4->id, 'sort_order' => 0, 'name' => 'ຄ່າເຊົ່າຫ້ອງປະຊຸມ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_4->id, 'sort_order' => 1, 'name' => 'ຄ່ານ້ຳດື່ມມື້ຈັດງານ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_4->id, 'sort_order' => 2, 'name' => 'ຄ່າຂັນລາງວັນ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);
        ExpenseItem::create(['category_id' => $sub6_4->id, 'sort_order' => 3, 'name' => 'ຄ່າອອກຄຳຖາມ', 'monthly_amount' => 0, 'quantity' => 1, 'remark' => '']);

    }
}

