@extends('layouts.admin')

@section('title', 'ແຜນລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)
@section('page-title', 'ແຜນລາຍຮັບວິຊາການ ປີ ' . $academicIncome->fiscal_year)

@section('content')
<div style="display:flex; gap:0.5rem; margin-bottom:1rem; flex-wrap:wrap;">
    @if(!$academicIncome->isApproved())
        <a href="{{ route('head_of_finance.academic-income.evaluate', $academicIncome) }}" class="fns-btn fns-btn-primary">ປ້ອນຂໍ້ມູນ / ປະເມີນ</a>
    @endif
    <a href="{{ route('head_of_finance.academic-income.summary', $academicIncome) }}" class="fns-btn fns-btn-secondary">ເບິ່ງສັງລວມ</a>
    @if(!$academicIncome->isApproved())
        <form method="POST" action="{{ route('head_of_finance.academic-income.approve', $academicIncome) }}" style="display:inline;"
            onsubmit="return confirm('ອະນຸມັດແຜນນີ້ບໍ? ຈະບໍ່ສາມາດແກ້ໄຂໄດ້ອີກ')">
            @csrf
            <button type="submit" class="fns-btn fns-btn-success">ອະນຸມັດ</button>
        </form>
    @endif
</div>

<div class="fns-card" style="margin-bottom:1rem;">
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem;">
        <div>
            <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ສົກປີ</p>
            <p style="font-weight:600; font-size:1.1rem;">{{ $academicIncome->fiscal_year }}</p>
        </div>
        <div>
            <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ສະຖານະ</p>
            <span class="fns-badge {{ $academicIncome->isApproved() ? 'fns-badge-green' : 'fns-badge-gray' }}">
                {{ $academicIncome->isApproved() ? 'ອະນຸມັດແລ້ວ' : 'ຮ່າງ' }}
            </span>
        </div>
        <div>
            <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ຜູ້ສ້າງ</p>
            <p>{{ $academicIncome->creator?->full_name ?? '—' }}</p>
        </div>
        @if($academicIncome->notes)
        <div style="grid-column:1/-1;">
            <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ໝາຍເຫດ</p>
            <p>{{ $academicIncome->notes }}</p>
        </div>
        @endif
    </div>
</div>

@if($academicIncome->items->count())
<div class="fns-card">
    <table class="fns-table">
        <thead>
            <tr>
                <th>ໝວດ</th>
                <th>ສາຂາວິຊາ</th>
                <th>ນ/ສ</th>
                <th>% ມຊ</th>
                <th>ລວມລາຍຮັບ</th>
                <th>ງວດ 1</th>
                <th>ງວດ 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach($academicIncome->items->sortBy('section_code') as $item)
            <tr>
                <td><strong>{{ $item->section_code }}</strong></td>
                <td>{{ $item->degreeProgram?->name ?? 'ລວມ' }}</td>
                <td>{{ number_format($item->student_count) }}</td>
                <td>{{ number_format($item->snap_nuol_pct * 100, 2) }}%</td>
                <td>{{ number_format($item->total_income, 2) }}</td>
                <td>{{ number_format($item->first_payment_amount, 2) }}</td>
                <td>{{ number_format($item->second_payment_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="fns-card" style="text-align:center; color:#9ca3af;">
    ຍັງບໍ່ມີຂໍ້ມູນ — ກົດ "ປ້ອນຂໍ້ມູນ / ປະເມີນ" ເພື່ອເລີ່ມຕົ້ນ
</div>
@endif
@endsection
