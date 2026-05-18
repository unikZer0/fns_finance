@extends('layouts.admin')

@section('title', 'ຮ່າງສັງລວມລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)
@section('page-title', 'ຮ່າງສັງລວມລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)

@section('content')
<div style="display:flex; gap:0.5rem; margin-bottom:1rem; flex-wrap:wrap; justify-content:flex-end;">
    <a href="{{ route('head_of_finance.academic-income.show', $academicIncome) }}" class="fns-btn fns-btn-secondary">← ກັບໄປ</a>
    @if(!$academicIncome->isApproved())
        <a href="{{ route('head_of_finance.academic-income.evaluate', $academicIncome) }}" class="fns-btn fns-btn-primary">ແກ້ໄຂຂໍ້ມູນ</a>
        <form method="POST" action="{{ route('head_of_finance.academic-income.approve', $academicIncome) }}" style="display:inline;"
            onsubmit="return confirm('ອະນຸມັດແຜນນີ້ບໍ?')">
            @csrf
            <button type="submit" class="fns-btn fns-btn-success">ອະນຸມັດ</button>
        </form>
    @endif
</div>

{{-- Header info --}}
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div style="display:flex; gap:2rem; flex-wrap:wrap; align-items:center;">
        <div>
            <span style="color:#6b7280; font-size:0.75rem;">ສົກປີ</span>
            <p style="font-weight:700; font-size:1.25rem; margin:0;">{{ $academicIncome->fiscal_year }}</p>
        </div>
        <div>
            <span style="color:#6b7280; font-size:0.75rem;">ສະຖານະ</span>
            <p style="margin:0;">
                <span class="fns-badge {{ $academicIncome->isApproved() ? 'fns-badge-green' : 'fns-badge-gray' }}">
                    {{ $academicIncome->isApproved() ? 'ອະນຸມັດແລ້ວ' : 'ຮ່າງ' }}
                </span>
            </p>
        </div>
    </div>
</div>

@php
    $grandTotal = 0;
    $grandFirst = 0;
    $grandSecond = 0;

    $sectionLabels = [
        '1.1' => '1.1 ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 2–4 ແລະ ປ.ໂທ',
        '1.2' => '1.2 ລາຍຮັບຄ່າລົງທະບຽນ ນ/ສ ປີ 2–4 ຂອງ ຄວທ',
        '1.3' => '1.3 ລາຍຮັບຄ່າໜ່ວຍກິດ ນ/ສ ປີ 1',
        '1.4' => '1.4 ຄ່າລົງທະບຽນ ນ/ສ ປີ 1 ຂອງ ຄວທ',
    ];
@endphp

@foreach($grouped as $sectionCode => $items)
@php
    $secTotal = $items->sum('total_income');
    $secFirst = $items->sum('first_payment_amount');
    $secSecond = $items->sum('second_payment_amount');
    $grandTotal += $secTotal;
    $grandFirst += $secFirst;
    $grandSecond += $secSecond;
@endphp
<div class="fns-card" style="margin-bottom:1.25rem;">
    <h3 style="font-weight:600; margin-bottom:1rem; color:#1e40af;">
        {{ $sectionLabels[$sectionCode] ?? $sectionCode }}
    </h3>
    <table class="fns-table">
        <thead>
            <tr>
                <th>ສາຂາວິຊາ / ລາຍການ</th>
                <th style="text-align:right;">ຈຳນວນ ນ/ສ</th>
                <th style="text-align:right;">% ມຊ</th>
                <th style="text-align:right;">ລວມລາຍຮັບ (ກີບ)</th>
                <th style="text-align:right;">ງວດ 1</th>
                <th style="text-align:right;">ງວດ 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->degreeProgram?->name ?? 'ລວມ' }}</td>
                <td style="text-align:right;">{{ number_format($item->student_count) }}</td>
                <td style="text-align:right;">{{ number_format($item->snap_nuol_pct * 100, 2) }}%</td>
                <td style="text-align:right;">{{ number_format($item->total_income, 2) }}</td>
                <td style="text-align:right;">{{ number_format($item->first_payment_amount, 2) }}</td>
                <td style="text-align:right;">{{ number_format($item->second_payment_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background:#eff6ff; font-weight:600;">
                <td colspan="3">ລວມໝວດ {{ $sectionCode }}</td>
                <td style="text-align:right;">{{ number_format($secTotal, 2) }}</td>
                <td style="text-align:right;">{{ number_format($secFirst, 2) }}</td>
                <td style="text-align:right;">{{ number_format($secSecond, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endforeach

{{-- Grand total --}}
<div class="fns-card" style="background:#1e3a5f; color:#fff;">
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td style="padding:0.75rem 1rem; font-size:1.05rem; font-weight:700;">ລວມລາຍຮັບວິຊາການທັງໝົດ</td>
            <td style="padding:0.75rem 1rem; text-align:right; font-size:1.2rem; font-weight:700;">{{ number_format($grandTotal, 2) }} ກີບ</td>
            <td style="padding:0.75rem 1rem; text-align:right;">ງວດ 1: {{ number_format($grandFirst, 2) }}</td>
            <td style="padding:0.75rem 1rem; text-align:right;">ງວດ 2: {{ number_format($grandSecond, 2) }}</td>
        </tr>
    </table>
</div>
@endsection
