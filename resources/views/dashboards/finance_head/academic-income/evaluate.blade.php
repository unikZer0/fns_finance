@extends('layouts.admin')

@section('title', 'ປ້ອນຂໍ້ມູນ ປີ ' . $academicIncome->fiscal_year)
@section('page-title', 'ປ້ອນຂໍ້ມູນການປະເມີນລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)

@section('content')
<form method="POST" action="{{ route('head_of_finance.academic-income.saveEvaluate', $academicIncome) }}">
@csrf

{{-- Section 1.1 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div class="fns-sec-hd">
        <div class="fns-sec-num">1.1</div>
        <div>
            <div class="fns-sec-title">ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 2–4 ລະບົບຈ່າຍເງິນ ແລະ ປ.ໂທ</div>
            <div class="fns-sec-desc">ສູດ: ຈຳນວນ ນ/ສ × ໜ່ວຍກິດ × ລາຄາ/ໜ່ວຍ × (1 − % ມຊ)</div>
        </div>
    </div>
    <div class="fns-table-wrap" style="border:1px solid var(--fns-gray-200); box-shadow:none;">
        @include('dashboards.finance_head.academic-income._program-table', [
            'programs'    => $programs11,
            'section'     => '1.1',
            'inputPrefix' => 's11',
        ])
    </div>
</div>

{{-- Section 1.2 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div class="fns-sec-hd">
        <div class="fns-sec-num">1.2</div>
        <div>
            <div class="fns-sec-title">ລາຍຮັບຄ່າລົງທະບຽນ ນ/ສ ປີ 2–4 ຂອງ ຄວທ</div>
            <div class="fns-sec-desc">ສູດ: ຈຳນວນ ນ/ສ × ຄ່າລົງທະບຽນ × (1 − % ມຊ ປ.ຕີ)</div>
        </div>
    </div>
    @if($feeYear2_4)
    <div class="fns-rate-chip" style="margin-bottom:1rem; display:inline-flex; gap:1rem; align-items:center;">
        <div>
            <div class="fns-rate-chip-label">ຄ່າລົງທະບຽນ (ລວມ)</div>
            <div class="fns-rate-chip-val" style="font-size:1.05rem;">{{ number_format($feeYear2_4->total_rate, 2) }} ກີບ</div>
        </div>
        <div style="width:1px; background:var(--fns-gray-200); align-self:stretch;"></div>
        <div>
            <div class="fns-rate-chip-label">ປີທີ່ໃຊ້</div>
            <div style="font-size:0.88rem; font-weight:600; color:var(--fns-gray-600);">{{ $feeYear2_4->start_year }}</div>
        </div>
    </div>
    @else
        <div class="fns-alert fns-alert-error" style="margin-bottom:0.75rem;">ບໍ່ມີຂໍ້ມູນຄ່າລົງທະບຽນ ນ/ສ ປີ 2–4 — ກະລຸນາຕັ້ງຄ່າກ່ອນ</div>
    @endif
    <div class="fns-form-group" style="max-width:240px; margin-bottom:0;">
        <label class="fns-label">ຈຳນວນ ນ/ສ ທັງໝົດ</label>
        <input type="number" name="students_1_2" min="0"
            value="{{ old('students_1_2', $existingItems->get('1.2_')?->student_count ?? 0) }}"
            class="fns-input" required>
    </div>
</div>

{{-- Section 1.3 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div class="fns-sec-hd">
        <div class="fns-sec-num">1.3</div>
        <div>
            <div class="fns-sec-title">ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 1 ລະບົບຈ່າຍເງິນ</div>
            <div class="fns-sec-desc">ສູດ: ຈຳນວນ ນ/ສ × ໜ່ວຍກິດ × ລາຄາ/ໜ່ວຍ × (1 − % ມຊ)</div>
        </div>
    </div>

    {{-- 1.3a: Bachelor year 1 --}}
    <div style="font-size:0.8rem; font-weight:600; color:var(--fns-gray-500); margin-bottom:0.4rem; text-transform:uppercase; letter-spacing:0.04em;">
        ປ.ຕີ ປີ 1
    </div>
    <div class="fns-table-wrap" style="border:1px solid var(--fns-gray-200); box-shadow:none; margin-bottom:1rem;">
        @include('dashboards.finance_head.academic-income._program-table', [
            'programs'    => $programs13_bach,
            'section'     => '1.3',
            'inputPrefix' => 's13',
        ])
    </div>

    {{-- 1.3b: Master/PhD year 1 (year1_rate) --}}
    <div style="font-size:0.8rem; font-weight:600; color:var(--fns-gray-500); margin-bottom:0.4rem; text-transform:uppercase; letter-spacing:0.04em;">
        ປ.ໂທ / ປ.ເອກ ປີ 1
    </div>
    <div class="fns-table-wrap" style="border:1px solid var(--fns-gray-200); box-shadow:none;">
        @include('dashboards.finance_head.academic-income._program-table', [
            'programs'      => $programs13_master,
            'section'       => '1.3',
            'inputPrefix'   => 's13m',
            'useYear1Unit'  => true,
        ])
    </div>
</div>

{{-- Section 1.4 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div class="fns-sec-hd">
        <div class="fns-sec-num">1.4</div>
        <div>
            <div class="fns-sec-title">ຄ່າລົງທະບຽນ ນ/ສ ປີ 1 ລະບົບຈ່າຍເງິນ ຂອງ ຄວທ</div>
            <div class="fns-sec-desc">ສູດ: ຈຳນວນ ນ/ສ × ຄ່າລົງທະບຽນ × (1 − % ມຊ ປ.ຕີ)</div>
        </div>
    </div>
    @if($feeYear1)
    <div class="fns-rate-chip" style="margin-bottom:1rem; display:inline-flex; gap:1rem; align-items:center;">
        <div>
            <div class="fns-rate-chip-label">ຄ່າລົງທະບຽນ (ລວມ)</div>
            <div class="fns-rate-chip-val" style="font-size:1.05rem;">{{ number_format($feeYear1->total_rate, 2) }} ກີບ</div>
        </div>
        <div style="width:1px; background:var(--fns-gray-200); align-self:stretch;"></div>
        <div>
            <div class="fns-rate-chip-label">ປີທີ່ໃຊ້</div>
            <div style="font-size:0.88rem; font-weight:600; color:var(--fns-gray-600);">{{ $feeYear1->start_year }}</div>
        </div>
    </div>
    @else
        <div class="fns-alert fns-alert-error" style="margin-bottom:0.75rem;">ບໍ່ມີຂໍ້ມູນຄ່າລົງທະບຽນ ນ/ສ ປີ 1 — ກະລຸນາຕັ້ງຄ່າກ່ອນ</div>
    @endif
    <div class="fns-form-group" style="max-width:240px; margin-bottom:0;">
        <label class="fns-label">ຈຳນວນ ນ/ສ ທັງໝົດ</label>
        <input type="number" name="students_1_4" min="0"
            value="{{ old('students_1_4', $existingItems->get('1.4_')?->student_count ?? 0) }}"
            class="fns-input" required>
    </div>
</div>

{{-- Submit --}}
<div style="display:flex; gap:0.5rem; align-items:center;">
    <button type="submit" class="fns-btn fns-btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:15px;height:15px;"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/></svg>
        ບັນທຶກ
    </button>
    <a href="{{ route('head_of_finance.academic-income.show', $academicIncome) }}" class="fns-btn fns-btn-secondary">ຍົກເລີກ</a>
</div>

</form>
@endsection
