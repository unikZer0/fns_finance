@extends('layouts.admin')

@section('title', 'ປະເມີນລາຍຮັບ ປີ ' . $academicIncome->fiscal_year)
@section('page-title', 'ປ້ອນຂໍ້ມູນການປະເມີນລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)

@section('content')
<form method="POST" action="{{ route('head_of_finance.academic-income.saveEvaluate', $academicIncome) }}">
@csrf

{{-- NUOL Percentages (read-only from settings) --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;">
        <h3 style="font-weight:600;">ຈຳນວນເປີເຊັນ ມຊ (%)</h3>
        <a href="{{ route('head_of_finance.settings.nuol-pct.index') }}" style="font-size:0.8rem; color:#6366f1;">ແກ້ໄຂການຕັ້ງຄ່າ →</a>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem;">
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:0.5rem; padding:0.75rem 1rem;">
            <p style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ປ.ຕີ (bachelor)</p>
            <p style="font-size:1.25rem; font-weight:700; color:#1e293b;">
                {{ $nuolBachelor ? number_format($nuolBachelor->percentage * 100, 2) : '17.00' }} %
            </p>
            @if($nuolBachelor)
                <p style="font-size:0.7rem; color:#94a3b8; margin-top:0.15rem;">ປີເລີ່ມ: {{ $nuolBachelor->start_year }}</p>
            @else
                <p style="font-size:0.7rem; color:#f59e0b; margin-top:0.15rem;">ໃຊ້ຄ່າເລີ່ມຕົ້ນ — ກະລຸນາຕັ້ງຄ່າ</p>
            @endif
        </div>
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:0.5rem; padding:0.75rem 1rem;">
            <p style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ປ.ໂທ / ປ.ເອກ (master/phd)</p>
            <p style="font-size:1.25rem; font-weight:700; color:#1e293b;">
                {{ $nuolMasterPhd ? number_format($nuolMasterPhd->percentage * 100, 2) : '10.00' }} %
            </p>
            @if($nuolMasterPhd)
                <p style="font-size:0.7rem; color:#94a3b8; margin-top:0.15rem;">ປີເລີ່ມ: {{ $nuolMasterPhd->start_year }}</p>
            @else
                <p style="font-size:0.7rem; color:#f59e0b; margin-top:0.15rem;">ໃຊ້ຄ່າເລີ່ມຕົ້ນ — ກະລຸນາຕັ້ງຄ່າ</p>
            @endif
        </div>
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
