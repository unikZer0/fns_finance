<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            // ── 2.1 ບໍລິຫານປົກກະຕິ ──────────────────────────────────────
            ['category_code' => '2.1', 'sort_order' => 0,  'item_name' => 'ບໍລິຫານສັງລວມ',                          'reference' => '2.1.1',  'amount_per_month' => 4810000,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 1,  'item_name' => 'ບຳລຸງຮັກສາ, ສ້ອມແປງ ແລະ ຕິດຕັ້ງ',        'reference' => '2.1.2',  'amount_per_month' => 6916667,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 2,  'item_name' => 'ສ້ອມແປງ ແລະ ປັບປຸງອາຄານຫ້ອງຮຽນ',         'reference' => '2.1.3',  'amount_per_month' => 4500000,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 3,  'item_name' => 'ສ້ອມແປງພາຫານະ',                          'reference' => '2.1.4',  'amount_per_month' => 558333,    'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 4,  'item_name' => 'ຊື້ເຄື່ອງຈັກ, ວັດຖຸອຸປະກອນ',              'reference' => '2.1.5',  'amount_per_month' => 2083333,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 5,  'item_name' => 'ຄ່າປະກັນໄພພາຫານະ',                       'reference' => '2.1.6',  'amount_per_month' => 341667,    'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 6,  'item_name' => 'ລາຍຈ່າຍໄປວຽກທາງການ',                     'reference' => '2.1.7',  'amount_per_month' => 1333333,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 7,  'item_name' => 'ປົກປັກຮັກສາ ແລະ ອານາໄມອາຄານ, ສະຖານທີ່', 'reference' => '2.1.8',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 8,  'item_name' => 'ວຽກງານກິດຈະກຳນັກສຶກສາ',                  'reference' => '2.1.9',  'amount_per_month' => 0,         'num_months' => 1],
            ['category_code' => '2.1', 'sort_order' => 9,  'item_name' => 'ກອງປະຊຸມ, ສຳມະນາ ແລະ ຝຶກອົບຮົມ',         'reference' => '2.1.10', 'amount_per_month' => 1920000,   'num_months' => 12],
            ['category_code' => '2.1', 'sort_order' => 10, 'item_name' => 'ລາຍຈ່າຍບໍລິຫານອື່ນໆ',                    'reference' => '2.1.11', 'amount_per_month' => 3007542,   'num_months' => 12],

            // ── 2.2 ສົ່ງເສີມວິຊາການ ──────────────────────────────────────
            ['category_code' => '2.2', 'sort_order' => 0,  'item_name' => 'ຊື້ວັດຖຸ, ອຸປະກອນການຮຽນ ແລະ ການສອນ',     'reference' => '2.2.1',  'amount_per_month' => 2166667,   'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 1,  'item_name' => 'ປັບປຸງ ແລະ ພັດທະນາການສຶກສາ',              'reference' => '2.2.2',  'amount_per_month' => 6333333,   'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 2,  'item_name' => 'ບຳລຸງຫ້ອງທົດລອງ',                        'reference' => '2.2.3',  'amount_per_month' => 2833333,   'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 3,  'item_name' => 'ຊື້ອຸປະກອນທົດລອງ',                       'reference' => '2.2.4',  'amount_per_month' => 40333333,  'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 4,  'item_name' => 'ກອງປະຊຸມວິຊາການ',                        'reference' => '2.2.5',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 5,  'item_name' => 'ບຳລຸງຫ້ອງອ່ານ',                          'reference' => '2.2.6',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 6,  'item_name' => 'ການຍົກລະດັບໄລຍະຍາວ',                     'reference' => '2.2.7',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.2', 'sort_order' => 7,  'item_name' => 'ຕິດຕາມການປະຕິບັດຫຼັກສູດ',                 'reference' => '2.2.8',  'amount_per_month' => 0,         'num_months' => 12],

            // ── 2.3 ດັດສົມ, ສົ່ງເສີມ ແລະ ບຳລຸງຮັກສາ ─────────────────────
            ['category_code' => '2.3', 'sort_order' => 0,  'item_name' => 'ບໍລິຫານວິຊາການ',                         'reference' => '2.3.1',  'amount_per_month' => 2083333,   'num_months' => 12],
            ['category_code' => '2.3', 'sort_order' => 1,  'item_name' => 'ບູລະນະ ແລະ ປົກປັກຮັກສາວັດທະນະທຳ',        'reference' => '2.3.2',  'amount_per_month' => 1644500,   'num_months' => 12],
            ['category_code' => '2.3', 'sort_order' => 2,  'item_name' => 'ໄປທັດສະນະສຶກສາ',                         'reference' => '2.3.3',  'amount_per_month' => 0,         'num_months' => 12],

            // ── 2.4 ອຸດໜູນກົງຈັກ ─────────────────────────────────────────
            ['category_code' => '2.4', 'sort_order' => 0,  'item_name' => 'ອຸດໜູນຄ່າບັດໂທລະສັບປະຈຳຕຳແໜ່ງ',         'reference' => '2.4.1',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.4', 'sort_order' => 1,  'item_name' => 'ອຸດໜູນຄ່ານ້ຳມັນປະຈຳຕຳແໜ່ງ',              'reference' => '2.4.2',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.4', 'sort_order' => 2,  'item_name' => 'ເງິນເດືອນສັນຍາຈ້າງ ແລະ ຄ່າແຮງງານ',       'reference' => '2.4.3',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.4', 'sort_order' => 3,  'item_name' => 'ອຸດໜູນການເຮັດວຽກເພີ່ມ',                   'reference' => '2.4.4',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.4', 'sort_order' => 4,  'item_name' => 'ອຸດໜູນຄ່າຄອງຊີບ',                        'reference' => '2.4.5',  'amount_per_month' => 0,         'num_months' => 12],

            // ── 2.5 ຄ່າສິດສອນ ແລະ ການປະເມີນ ─────────────────────────────
            ['category_code' => '2.5', 'sort_order' => 0,  'item_name' => 'ຄ່າສອນລະບົບພິເສດ',                       'reference' => '2.5.1',  'amount_per_month' => 54850000,  'num_months' => 12],
            ['category_code' => '2.5', 'sort_order' => 1,  'item_name' => 'ຄ່າບໍລິການສອບເສັງ',                      'reference' => '2.5.2',  'amount_per_month' => 0,         'num_months' => 12],
            ['category_code' => '2.5', 'sort_order' => 2,  'item_name' => 'ບົດໂຄງການຈົບຊັ້ນ',                       'reference' => '2.5.3',  'amount_per_month' => 0,         'num_months' => 1],
            ['category_code' => '2.5', 'sort_order' => 3,  'item_name' => 'ອຸດໜູນການລົງທະບຽນ',                      'reference' => '2.5.4',  'amount_per_month' => 0,         'num_months' => 12],

            // ── 2.6 ນອກຫຼັກສູດ ────────────────────────────────────────────
            ['category_code' => '2.6', 'sort_order' => 0,  'item_name' => 'ບໍລິຈາກເລືອດໃຫ້ອົງການກາແດງລາວ',          'reference' => '2.6.1',  'amount_per_month' => 0,         'num_months' => 1],
            ['category_code' => '2.6', 'sort_order' => 1,  'item_name' => 'ເຄື່ອນໄຫວກິລາ ແລະ ສິນລະປະ',              'reference' => '2.6.2',  'amount_per_month' => 0,         'num_months' => 1],
            ['category_code' => '2.6', 'sort_order' => 2,  'item_name' => 'ອອກແຮງງານລວມ',                           'reference' => '2.6.3',  'amount_per_month' => 0,         'num_months' => 1],
            ['category_code' => '2.6', 'sort_order' => 3,  'item_name' => 'ຖາມ-ຕອບວິທະຍາສາດ',                       'reference' => '2.6.4',  'amount_per_month' => 0,         'num_months' => 1],
        ];

        DB::table('expense_defaults')->insert($defaults);
    }

    public function down(): void
    {
        DB::table('expense_defaults')->truncate();
    }
};
