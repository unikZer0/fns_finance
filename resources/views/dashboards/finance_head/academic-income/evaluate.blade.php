@extends('layouts.admin')

@section('title', 'ປະເມີນລາຍຮັບ ປີ ' . $academicIncome->fiscal_year)
@section('page-title', 'ປ້ອນຂໍ້ມູນການປະເມີນລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)

@section('content')
<form method="POST" action="{{ route('head_of_finance.academic-income.saveEvaluate', $academicIncome) }}">
@csrf

{{-- NUOL Percentages --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:1rem;">ຈຳນວນເປີເຊັນ ມຊ (%) ຕໍ່ແຕ່ລະໝວດ</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1rem;">
        @foreach(['1_1'=>'1.1','1_2'=>'1.2','1_3'=>'1.3','1_4'=>'1.4'] as $key => $label)
        <div class="fns-form-group">
            <label class="fns-label">ໝວດ {{ $label }} (%)</label>
            <input type="number" name="nuol_pct_{{ $key }}" step="0.01" min="0" max="100"
                value="{{ old('nuol_pct_'.$key, number_format($academicIncome->{'nuol_pct_'.$key} * 100, 2, '.', '')) }}"
                class="fns-input @error('nuol_pct_'.$key) fns-input-error @enderror" required>
            @error('nuol_pct_'.$key)<p class="fns-error">{{ $message }}</p>@enderror
        </div>
        @endforeach
    </div>
</div>

{{-- Section 1.1 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:0.25rem;">1.1 ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 2–4 ລະບົບຈ່າຍເງິນ ແລະ ປ.ໂທ</h3>
    <p style="color:#6b7280; font-size:0.8rem; margin-bottom:1rem;">ສູດ: ນ/ສ × ໜ່ວຍກິດ × ລາຄາ × (1 − % ມຊ)</p>
    @include('dashboards.finance_head.academic-income._program-table', [
        'programs'    => $programs11,
        'section'     => '1.1',
        'inputPrefix' => 's11',
    ])
</div>

{{-- Section 1.2 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:0.25rem;">1.2 ລາຍຮັບຄ່າລົງທະບຽນ ນ/ສ ປີ 2–4 ຂອງ ຄວທ</h3>
    <p style="color:#6b7280; font-size:0.8rem; margin-bottom:1rem;">ສູດ: ນ/ສ × ຄ່າລົງທະບຽນ × (1 − % ມຊ)</p>
    @if($feeYear2_4)
        <p style="margin-bottom:0.75rem;">ຄ່າລົງທະບຽນ (ລວມ): <strong>{{ number_format($feeYear2_4->total_rate, 2) }} ກີບ</strong> (ປີ {{ $feeYear2_4->start_year }})</p>
    @else
        <div class="fns-alert fns-alert-error" style="margin-bottom:0.75rem;">ບໍ່ມີຂໍ້ມູນຄ່າລົງທະບຽນ ນ/ສ ປີ 2–4 — ກະລຸນາຕັ້ງຄ່າກ່ອນ</div>
    @endif
    <div class="fns-form-group" style="max-width:200px;">
        <label class="fns-label">ຈຳນວນ ນ/ສ ທັງໝົດ</label>
        <input type="number" name="students_1_2" min="0"
            value="{{ old('students_1_2', $existingItems->get('1.2_')?->student_count ?? 0) }}"
            class="fns-input" required>
    </div>
</div>

{{-- Section 1.3 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:0.25rem;">1.3 ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 1 ລະບົບຈ່າຍເງິນ</h3>
    <p style="color:#6b7280; font-size:0.8rem; margin-bottom:1rem;">ສູດ: ນ/ສ × ໜ່ວຍກິດ × ລາຄາ × (1 − % ມຊ)</p>
    @include('dashboards.finance_head.academic-income._program-table', [
        'programs'    => $programs13,
        'section'     => '1.3',
        'inputPrefix' => 's13',
    ])
</div>

{{-- Section 1.4 --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:0.25rem;">1.4 ຄ່າລົງທະບຽນ ນ/ສ ປີ 1 ລະບົບຈ່າຍເງິນ ຂອງ ຄວທ</h3>
    <p style="color:#6b7280; font-size:0.8rem; margin-bottom:1rem;">ສູດ: ນ/ສ × ຄ່າລົງທະບຽນ × (1 − % ມຊ)</p>
    @if($feeYear1)
        <p style="margin-bottom:0.75rem;">ຄ່າລົງທະບຽນ (ລວມ): <strong>{{ number_format($feeYear1->total_rate, 2) }} ກີບ</strong> (ປີ {{ $feeYear1->start_year }})</p>
    @else
        <div class="fns-alert fns-alert-error" style="margin-bottom:0.75rem;">ບໍ່ມີຂໍ້ມູນຄ່າລົງທະບຽນ ນ/ສ ປີ 1 — ກະລຸນາຕັ້ງຄ່າກ່ອນ</div>
    @endif
    <div class="fns-form-group" style="max-width:200px;">
        <label class="fns-label">ຈຳນວນ ນ/ສ ທັງໝົດ</label>
        <input type="number" name="students_1_4" min="0"
            value="{{ old('students_1_4', $existingItems->get('1.4_')?->student_count ?? 0) }}"
            class="fns-input" required>
    </div>
</div>

<div style="display:flex; gap:0.5rem;">
    <button type="submit" class="fns-btn fns-btn-primary">ບັນທຶກ ແລະ ເບິ່ງສັງລວມ</button>
    <a href="{{ route('head_of_finance.academic-income.show', $academicIncome) }}" class="fns-btn fns-btn-secondary">ຍົກເລີກ</a>
</div>
</form>
@endsection
