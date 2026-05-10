<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fetch parent IDs keyed by reference
        $parents = DB::table('expense_defaults')->whereNull('parent_id')
            ->pluck('id', 'reference');

        $subs = [];

        // ── 2.1.1 ບໍລິຫານສັງລວມ ─────────────────────────────────────────────
        if ($p = $parents['2.1.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0,  'item_name' => 'ເຄື່ອງໃຊ້ຫ້ອງການ',             'amount_per_month' => 2800000, 'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1,  'item_name' => 'ແບບພິມ',                        'amount_per_month' => 250000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 2,  'item_name' => 'ວາລະສານ ແລະ ໜັງສືພິມ',          'amount_per_month' => 0,       'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 3,  'item_name' => 'ຮັບແຂກ',                        'amount_per_month' => 800000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 4,  'item_name' => 'ໂທລະສັບບໍລິຫານ',               'amount_per_month' => 30000,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 5,  'item_name' => 'ຄ່າໄປສະນີ',                    'amount_per_month' => 0,       'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 6,  'item_name' => 'ຄ່າບໍລິການທະນາຄານ',             'amount_per_month' => 30000,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 7,  'item_name' => 'ຊື້ຂອງຂັວນຂອງຕ້ອນ',            'amount_per_month' => 400000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 8,  'item_name' => 'ວັນບຸນລະດັບຊາດ',               'amount_per_month' => 500000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 9,  'item_name' => 'ອຸດໜູນວຽກປ້ອງກັນ',             'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 10, 'item_name' => 'ຄ່ານ້ຳມັນບໍລິຫານຫ້ອງການ',      'amount_per_month' => 0,       'num_months' => 4,  'notes' => 'ຂື້ນຢູ່ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 11, 'item_name' => 'ຄ່ານ້ຳມັນເຄື່ອງ',              'amount_per_month' => 0,       'num_months' => 4,  'notes' => 'ຂື້ນຢູ່ງົບລັດ'],
            ]);
        }

        // ── 2.1.2 ບຳລຸງຮັກສາ, ສ້ອມແປງ ແລະ ຕິດຕັ້ງ ──────────────────────────
        if ($p = $parents['2.1.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0,  'item_name' => 'ບຳລຸງຮັກສາຄອມພີວເຕີ',          'amount_per_month' => 300000,   'num_months' => 30],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1,  'item_name' => 'ບຳລຸງຮັກສາເຄື່ອງສາຍໂປຣເຈັກເຕີ','amount_per_month' => 200000,   'num_months' => 25],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 2,  'item_name' => 'ບຳລຸງຮັກສາແອເຢັນ',              'amount_per_month' => 500000,   'num_months' => 90],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 3,  'item_name' => 'ບຳລຸງຮັກສາຕູ້ເຢັນ + ຕູ້ນ້ຳເຢັນ','amount_per_month' => 100000,  'num_months' => 20],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 4,  'item_name' => 'ບຳລຸງຮັກສາພັດລົມ',              'amount_per_month' => 80000,    'num_months' => 100],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 5,  'item_name' => 'ບຳລຸງຮັກສາດອກໄຟ',              'amount_per_month' => 10000,    'num_months' => 600],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 6,  'item_name' => 'ບຳລຸງຮັກສາເຄື່ອງພິມ',           'amount_per_month' => 100000,   'num_months' => 20],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 7,  'item_name' => 'ບຳລຸງຮັກສາຈັກອັດສຳເນົາ',        'amount_per_month' => 2000000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 8,  'item_name' => 'ບຳລຸງຮັກສາໂທລະສັບ',             'amount_per_month' => 50000,    'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 9,  'item_name' => 'ບຳລຸງຮັກສາກ້ອງຖ່າຍຮູບ',         'amount_per_month' => 50000,    'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 10, 'item_name' => 'ບຳລຸງຮັກສາໂທລະທັດ',             'amount_per_month' => 50000,    'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 11, 'item_name' => 'ຈັກປ້ຳນ້ຳອັດຕະໂນມັດ',           'amount_per_month' => 1000000,  'num_months' => 4],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 12, 'item_name' => 'ຈັກຕັດຫຍ້າ',                   'amount_per_month' => 1000000,  'num_months' => 2],
            ]);
        }

        // ── 2.1.3 ສ້ອມແປງ ແລະ ປັບປຸງອາຄານ ──────────────────────────────────
        if ($p = $parents['2.1.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ສ້ອມແປງອາຄານສໍານັກງານຕ່າງໆ',      'amount_per_month' => 2000000,  'num_months' => 7],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ປັບປຸງອາຄານຫ້ອງຮຽນ-ຫ້ອງທົດລອງ',   'amount_per_month' => 40000000, 'num_months' => 1],
            ]);
        }

        // ── 2.1.4 ສ້ອມແປງພາຫານະ ──────────────────────────────────────────────
        if ($p = $parents['2.1.4'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ລົດຕູ້',  'amount_per_month' => 2850000, 'num_months' => 2],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ລົດຈັກ', 'amount_per_month' => 1000000, 'num_months' => 1],
            ]);
        }

        // ── 2.1.5 ຊື້ເຄື່ອງຈັກ, ວັດຖຸອຸປະກອນ ────────────────────────────────
        if ($p = $parents['2.1.5'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ຊື້ ໂຕະ, ຕັ່ງ',                           'amount_per_month' => 150000,    'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ບຳລຸງຮັກສາ, ສ້ອມແປງ ໂຕະ, ຕັ່ງ',          'amount_per_month' => 30000,     'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 2, 'item_name' => 'ຊື້ເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',          'amount_per_month' => 25000000,  'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 3, 'item_name' => 'ຊື້ພາຫະນະ',                               'amount_per_month' => 200000000, 'num_months' => 0],
            ]);
        }

        // ── 2.1.6 ຄ່າປະກັນໄພພາຫະນະ ──────────────────────────────────────────
        if ($p = $parents['2.1.6'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ປະກັນໄພລົດໃຫຍ່', 'amount_per_month' => 2050000, 'num_months' => 2],
            ]);
        }

        // ── 2.1.7 ລາຍຈ່າຍໄປວຽກທາງການ ────────────────────────────────────────
        if ($p = $parents['2.1.7'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ໄປວຽກທາງການພາຍໃນປະເທດ',  'amount_per_month' => 16000000, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ໄປວຽກທາງການຕ່າງປະເທດ',   'amount_per_month' => 0,        'num_months' => 1],
            ]);
        }

        // ── 2.1.8 ປົກປັກຮັກສາ ແລະ ອານາໄມ ────────────────────────────────────
        if ($p = $parents['2.1.8'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ບຳລຸງຮັກສາວິທະຍາເຂດ', 'amount_per_month' => 2000000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ອານາໄມອາຄານ',          'amount_per_month' => 10000000, 'num_months' => 12],
            ]);
        }

        // ── 2.1.9 ວຽກງານກິດຈະກຳນັກສຶກສາ ─────────────────────────────────────
        if ($p = $parents['2.1.9'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0, 'item_name' => 'ປະຖົມນິເທດນັກສຶກສາ',                         'amount_per_month' => 1500000, 'num_months' => 2],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1, 'item_name' => 'ກວດສອບການປະຕິບັດລະບຽບວິໃນນັກສຶກສາ',          'amount_per_month' => 400000,  'num_months' => 5],
            ]);
        }

        // ── 2.1.10 ກອງປະຊຸມ, ສຳມະນາ ──────────────────────────────────────────
        if ($p = $parents['2.1.10'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 0,  'item_name' => 'ສຳນັກຄະນະບໍດີ',                            'amount_per_month' => 200000, 'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 1,  'item_name' => 'ພາວິຊາຄະນິດສາດ',                           'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 2,  'item_name' => 'ພາກວິຊາຟິຊິກສາດ',                           'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 3,  'item_name' => 'ພາກວິຊາເຄມີສາດ',                            'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 4,  'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',                         'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 5,  'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',                 'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 6,  'item_name' => 'ພະແນກວິຊາການ',                              'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 7,  'item_name' => 'ພະແນກຈັດຕັ້ງສັງລວມ',                        'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 8,  'item_name' => 'ພະແນກການເງິນ-ຊັບສິນ',                       'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 9,  'item_name' => 'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',                      'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 10, 'item_name' => 'ພະແນກຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',          'amount_per_month' => 20000,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.1', 'sort_order' => 11, 'item_name' => 'ພະແນກຫຼັງປະລິນຍາຕີ',                        'amount_per_month' => 20000,  'num_months' => 12],
            ]);
        }

        // ── 2.2.1 ຊື້ວັດຖຸ, ອຸປະກອນການຮຽນ-ການສອນ ───────────────────────────
        if ($p = $parents['2.2.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ອຸປະກອນການຮຽນ-ການສອນ', 'amount_per_month' => 1500000, 'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ອຸປະກອນການສອບເສັງ',    'amount_per_month' => 4000000, 'num_months' => 2],
            ]);
        }

        // ── 2.2.2 ປັບປຸງ ແລະ ພັດທະນາການສຶກສາ ────────────────────────────────
        if ($p = $parents['2.2.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ພາກວິຊາຄະນິດສາດ',                    'amount_per_month' => 0, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ພາກວິຊາຟີຊິກສາດ',                    'amount_per_month' => 0, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 2, 'item_name' => 'ພາກວິຊາເຄມີສາດ',                     'amount_per_month' => 0, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 3, 'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',                  'amount_per_month' => 0, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 4, 'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',          'amount_per_month' => 0, 'num_months' => 1],
            ]);
        }

        // ── 2.2.3 ບຳລຸງຫ້ອງທົດລອງ ───────────────────────────────────────────
        if ($p = $parents['2.2.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ພາກວິຊາຄະນິດສາດ',                    'amount_per_month' => 250000,    'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ພາກວິຊາຟິຊິກສາດ',                    'amount_per_month' => 500000,    'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 2, 'item_name' => 'ພາກວິຊາເຄມີສາດ',                     'amount_per_month' => 500000,    'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 3, 'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',                  'amount_per_month' => 500000,    'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 4, 'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',          'amount_per_month' => 1083333,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 5, 'item_name' => 'ຊື້ອຸປະກອນທົດລອງ',                   'amount_per_month' => 0,         'num_months' => 12],
            ]);
        }

        // ── 2.2.4 ຊື້ອຸປະກອນທົດລອງ ──────────────────────────────────────────
        if ($p = $parents['2.2.4'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ອຸປະກອນທົດລອງຟິຊິກສາດ',           'amount_per_month' => 32000000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ອຸປະກອນທົດລອງເຄມີສາດ',            'amount_per_month' => 32000000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 2, 'item_name' => 'ອຸປະກອນທົດລອງຊີວະວິທະຍາ',         'amount_per_month' => 32000000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 3, 'item_name' => 'ຄອມພິວເຕີຕັ້ງໂຕະ (PC)',            'amount_per_month' => 12100000,  'num_months' => 40],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 4, 'item_name' => 'ໂປຣເຈັກເຕີໃສ່ຫ້ອງຮຽນ',            'amount_per_month' => 5300000,   'num_months' => 0],
            ]);
        }

        // ── 2.2.5 ກອງປະຊຸມວິຊາການ ───────────────────────────────────────────
        if ($p = $parents['2.2.5'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ພິທີສະຫຼຸບຊຸດຮຽນ ແລະ ເປີດສົກໃໝ່ ປໍໂທ', 'amount_per_month' => 2300000, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ກອງປະຊຸມສຳມະນາວິຊາການ ປໍໂທ',           'amount_per_month' => 7150000, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 2, 'item_name' => 'ກອງປະຊຸມຜູ້ຊົງຄຸນວຸດທິ ປໍໂທ',          'amount_per_month' => 3150000, 'num_months' => 1],
            ]);
        }

        // ── 2.2.6 ບຳລຸງຫ້ອງອ່ານ ─────────────────────────────────────────────
        if ($p = $parents['2.2.6'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ຊື້ປື້ມໃສ່ຫ້ອງອ່ານ',   'amount_per_month' => 425000,  'num_months' => 20],
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 1, 'item_name' => 'ຊື້ຮ້ານປື້ມໃສ່ຫ້ອງອ່ານ','amount_per_month' => 2500000, 'num_months' => 1],
            ]);
        }

        // ── 2.2.7 ການຍົກລະດັບໄລຍະຍາວ ─────────────────────────────────────────
        if ($p = $parents['2.2.7'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ສົ່ງພະນັກງານໄປຍົກລະດັບໄລຍະຍາວ', 'amount_per_month' => 0, 'num_months' => 1],
            ]);
        }

        // ── 2.2.8 ຕິດຕາມການປະຕິບັດຫຼັກສູດ ────────────────────────────────────
        if ($p = $parents['2.2.8'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.2', 'sort_order' => 0, 'item_name' => 'ງົບປະມານຕິດຕາມຫຼັກສູດ ປໍໂທ', 'amount_per_month' => 0, 'num_months' => 1],
            ]);
        }

        // ── 2.3.1 ບໍລິຫານວິຊາການ ────────────────────────────────────────────
        if ($p = $parents['2.3.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 0,  'item_name' => 'ສົ່ງເສີມວິຊາການສ່ວນກາງ',                     'amount_per_month' => 0,       'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 1,  'item_name' => 'ກອງປະຊຸມສຳມະນາການເງິນ (ພະແນກການເງິນ)',        'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 2,  'item_name' => 'ພະແນກບໍລິຫານສັງລວມ',                          'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 3,  'item_name' => 'ໜ່ວຍງານ ICT',                                  'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 4,  'item_name' => 'ຫຼັງປະລິນຍາຕີ',                                'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 5,  'item_name' => 'ຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',                 'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 6,  'item_name' => 'ພັດທະນາຫຸ່ນຍົນ (Robot)',                       'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 7,  'item_name' => 'ພະແນກວິຊາການ',                                 'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 8,  'item_name' => 'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',                        'amount_per_month' => 0,       'num_months' => 12, 'notes' => 'ຂື້ນຢູ່ພາກ 62'],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 9,  'item_name' => 'ພາກວິຊາຄະນິດສາດ',                             'amount_per_month' => 416667,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 10, 'item_name' => 'ພາກວິຊາຟີຊິກສາດ',                             'amount_per_month' => 416667,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 11, 'item_name' => 'ພາກວິຊາເຄມີສາດ',                              'amount_per_month' => 416667,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 12, 'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',                           'amount_per_month' => 416667,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 13, 'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',                   'amount_per_month' => 416667,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 14, 'item_name' => 'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',                      'amount_per_month' => 0,       'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 15, 'item_name' => 'ເຄື່ອນໄຫວວຽກວິຊາການອື່ນໆ',                     'amount_per_month' => 0,       'num_months' => 4],
            ]);
        }

        // ── 2.3.2 ບູລະນະ ແລະ ປົກປັກຮັກສາວັດທະນະທຳ ─────────────────────────
        if ($p = $parents['2.3.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 0, 'item_name' => 'ສຳນັກຄະນະບໍດີ',                  'amount_per_month' => 1041667, 'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 1, 'item_name' => 'ພາກວິຊາຄະນິດສາດ',               'amount_per_month' => 81167,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 2, 'item_name' => 'ພາກວິຊາຟິຊິກສາດ',               'amount_per_month' => 49500,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 3, 'item_name' => 'ພາກວິຊາເຄມີສາດ',                'amount_per_month' => 70750,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 4, 'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',             'amount_per_month' => 51083,   'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 5, 'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',     'amount_per_month' => 350333,  'num_months' => 12],
            ]);
        }

        // ── 2.3.3 ໄປທັດສະນະສຶກສາ ────────────────────────────────────────────
        if ($p = $parents['2.3.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 0, 'item_name' => 'ສຳນັກຄະນະບໍດີ',                  'amount_per_month' => 190000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 1, 'item_name' => 'ພາກວິຊາຄະນິດສາດ',               'amount_per_month' => 190000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 2, 'item_name' => 'ພາກວິຊາຟິຊິກສາດ',               'amount_per_month' => 190000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 3, 'item_name' => 'ພາກວິຊາເຄມີສາດ',                'amount_per_month' => 190000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 4, 'item_name' => 'ພາກວິຊາຊີວະວິທະຍາ',             'amount_per_month' => 190000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.3', 'sort_order' => 5, 'item_name' => 'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',     'amount_per_month' => 190000, 'num_months' => 0],
            ]);
        }

        // ── 2.4.1 ອຸດໜູນຄ່າບັດໂທລະສັບ ───────────────────────────────────────
        if ($p = $parents['2.4.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 0, 'item_name' => 'ຄະນະບໍດີ',                        'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 1, 'item_name' => 'ຮອງຄະນະບໍດີ',                     'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 2, 'item_name' => 'ຫົວໜ້າພາກວິຊາ',                   'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 3, 'item_name' => 'ຫົວໜ້າພະແນກ',                     'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 4, 'item_name' => 'ຮອງຫົວໜ້າພາກວິຊາ',                'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 5, 'item_name' => 'ຮອງຫົວໜ້າພະແນກ',                  'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 6, 'item_name' => 'ຫົວໜ້າໜ່ວຍງານ, ເລຂາ',             'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 7, 'item_name' => 'ຫົວໜ້າໜ່ວຍວິຊາ',                  'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 8, 'item_name' => 'ໜ່ວຍງານ, ສາມອົງການ',              'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 9, 'item_name' => 'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',          'amount_per_month' => 0, 'num_months' => 12, 'notes' => 'ຈ່າຍງົບລັດ'],
            ]);
        }

        // ── 2.4.2 ອຸດໜູນຄ່ານ້ຳມັນ ────────────────────────────────────────────
        if ($p = $parents['2.4.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 0, 'item_name' => 'ຄະນະບໍດີ',                                      'amount_per_month' => 500000, 'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 1, 'item_name' => 'ຮອງຄະນະບໍດີ, ຫົວໜ້າພາກວິຊາ',                   'amount_per_month' => 400000, 'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 2, 'item_name' => 'ຫົວໜ້າພະແນກ, ຮອງພາກວິຊາ',                      'amount_per_month' => 200000, 'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 3, 'item_name' => 'ຮອງຫົວໜ້າພະແນກ, ຮສ ແລະ ຫົວໜ້າໜ່ວຍວິຊາ',        'amount_per_month' => 150000, 'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 4, 'item_name' => 'ຮອງຫົວໜ້າໜ່ວຍວິຊາ, ຫົວໜ້າໜ່ວຍງານ',             'amount_per_month' => 80000,  'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 5, 'item_name' => 'ຮອງຫົວໜ້າໜ່ວຍງານ',                              'amount_per_month' => 70000,  'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 6, 'item_name' => 'ອາຈານ ແລະ ພະນັກງານທົ່ວໄປ',                      'amount_per_month' => 50000,  'num_months' => 0, 'notes' => 'ໃຊ້ງົບລັດ'],
            ]);
        }

        // ── 2.4.3 ເງິນເດືອນສັນຍາຈ້າງ ─────────────────────────────────────────
        if ($p = $parents['2.4.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 0, 'item_name' => 'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງສຳນັກ',              'amount_per_month' => 2000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 1, 'item_name' => 'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງຂັບລົດ',             'amount_per_month' => 2000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 2, 'item_name' => 'ສັນຍາຈ້າງບຳລຸງຮັກສາລະບົບ ICT',                 'amount_per_month' => 1000000, 'num_months' => 0],
            ]);
        }

        // ── 2.4.4 ອຸດໜູນການເຮັດວຽກເພີ່ມ ──────────────────────────────────────
        if ($p = $parents['2.4.4'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 0, 'item_name' => 'ອຸດໜູນພະນັກງານລົງທະບຽນ',           'amount_per_month' => 35000000, 'num_months' => 2],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 1, 'item_name' => 'ອຸດໜູນການສອບເສັງ',                  'amount_per_month' => 35000000, 'num_months' => 2],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 2, 'item_name' => 'ອຸດໜູນການກວດສອບງົບປະມານ',           'amount_per_month' => 4500000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 3, 'item_name' => 'ອຸດໜູນຕາມຂໍ້ຕົກລົງຕ່າງໆ',          'amount_per_month' => 1000000,  'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 4, 'item_name' => 'ອຸດໜູນການບໍລິຫານເທີມສາມ',          'amount_per_month' => 15000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 5, 'item_name' => 'ອຸດໜູນກະກຽມສະຫລຸບການເງິນ',         'amount_per_month' => 12000000, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 6, 'item_name' => 'ອຸດໜູນການບໍລິຫານ ປໍໂທ',            'amount_per_month' => 20000000, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.4', 'sort_order' => 7, 'item_name' => 'ອຸດໜູນການນໍາພາບົດວິທະຍານິພົນ',     'amount_per_month' => 20000000, 'num_months' => 0],
            ]);
        }

        // ── 2.5.1 ຄ່າສອນລະບົບພິເສດ ───────────────────────────────────────────
        if ($p = $parents['2.5.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 0, 'item_name' => 'ຄ່າຊົ່ວໂມງສອນພາກພິເສດ',      'amount_per_month' => 27655600,  'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 1, 'item_name' => 'ຄ່າຊົ່ວໂມງສອນເທີມສາມ',       'amount_per_month' => 0,         'num_months' => 12],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 2, 'item_name' => 'ຄ່າຊົ່ວໂມງສອນປະລິນຍາໂທ',     'amount_per_month' => 27194400,  'num_months' => 12],
            ]);
        }

        // ── 2.5.2 ຄ່າບໍລິການສອບເສັງ ──────────────────────────────────────────
        if ($p = $parents['2.5.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 0, 'item_name' => 'ຄ່າກຳມະການສອບເສັງຈົບຊັ້ນ',   'amount_per_month' => 2000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 1, 'item_name' => 'ຄ່າຍາມຫ້ອງເສັງ',              'amount_per_month' => 6000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 2, 'item_name' => 'ຄ່າອອກຫົວບົດ ແລະ ກວດບົດ',    'amount_per_month' => 4000000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 3, 'item_name' => 'ຄ່າບໍລິການສອບເສັງ ປໍໂທ',     'amount_per_month' => 0,       'num_months' => 0],
            ]);
        }

        // ── 2.5.3 ບົດໂຄງການຈົບຊັ້ນ ───────────────────────────────────────────
        if ($p = $parents['2.5.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 0, 'item_name' => 'ຄ່າຊີ້ນຳບົດໂຄງການຈົບຊັ້ນ',          'amount_per_month' => 0, 'num_months' => 50],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 1, 'item_name' => 'ຄ່າກຳມະການປ້ອງກັນບົດຈົບຊັ້ນ',       'amount_per_month' => 0, 'num_months' => 1],
                ['parent_id' => $p, 'category_code' => '2.5', 'sort_order' => 2, 'item_name' => 'ຄ່າດຳເນີນບົດໂຄງການຈົບຊັ້ນ ປໍໂທ',   'amount_per_month' => 0, 'num_months' => 6],
            ]);
        }

        // ── 2.6.1 ບໍລິຈາກເລືອດ ────────────────────────────────────────────────
        if ($p = $parents['2.6.1'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 0, 'item_name' => 'ບໍລິຈາກເລືອດຄັ້ງທີ I',  'amount_per_month' => 50000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 1, 'item_name' => 'ບໍລິຈາກເລືອດຄັ້ງທີ II', 'amount_per_month' => 50000, 'num_months' => 0],
            ]);
        }

        // ── 2.6.2 ກິລາ ແລະ ສິນລະປະ ───────────────────────────────────────────
        if ($p = $parents['2.6.2'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 0, 'item_name' => 'ການແຂ່ງຂັນກິລາຊາວໜຸ່ມ',             'amount_per_month' => 200000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 1, 'item_name' => 'ການເຄື່ອນໄຫວກິລາພາຍໃນ',            'amount_per_month' => 200000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 2, 'item_name' => 'ການເຄື່ອນໄຫວກິລາກັບທາງນອກ',        'amount_per_month' => 200000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 3, 'item_name' => 'ການເຄື່ອນໄຫວສິນລະປະ',              'amount_per_month' => 200000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 4, 'item_name' => 'ການຝຶກຊ້ອມສິນລະປະວັນນະຄະດີ',       'amount_per_month' => 200000, 'num_months' => 0],
            ]);
        }

        // ── 2.6.3 ອອກແຮງງານລວມ ────────────────────────────────────────────────
        if ($p = $parents['2.6.3'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 0, 'item_name' => 'ອານາໄມຫ້ອງຮຽນ, ຫ້ອງການ', 'amount_per_month' => 100000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 1, 'item_name' => 'ອານາໄມສະຖານທີ່ຮັບຜິດຊອບ', 'amount_per_month' => 100000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 2, 'item_name' => 'ປຸກຕົ້ນໄມ້',              'amount_per_month' => 100000, 'num_months' => 0],
            ]);
        }

        // ── 2.6.4 ຖາມ-ຕອບວິທະຍາສາດ ───────────────────────────────────────────
        if ($p = $parents['2.6.4'] ?? null) {
            $subs = array_merge($subs, [
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 0, 'item_name' => 'ຄ່າເຊົ່າຫ້ອງປະຊຸມ 1 ວັນ', 'amount_per_month' => 500000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 1, 'item_name' => 'ຄ່ານ້ຳດື່ມມື້ຈັດງານ',     'amount_per_month' => 500000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 2, 'item_name' => 'ຄ່າຂັນລາງວັນ',           'amount_per_month' => 500000, 'num_months' => 0],
                ['parent_id' => $p, 'category_code' => '2.6', 'sort_order' => 3, 'item_name' => 'ຄ່າອອກຄຳຖາມ',           'amount_per_month' => 2000,   'num_months' => 0],
            ]);
        }

        // Fill in default reference/notes if missing
        foreach ($subs as &$row) {
            $row['reference'] = $row['reference'] ?? null;
            $row['notes']     = $row['notes']     ?? null;
        }
        unset($row);

        if (!empty($subs)) {
            DB::table('expense_defaults')->insert($subs);
        }
    }

    public function down(): void
    {
        DB::table('expense_defaults')->whereNotNull('parent_id')->delete();
    }
};
