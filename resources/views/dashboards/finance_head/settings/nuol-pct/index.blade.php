@extends('layouts.admin')

@section('title', 'ອັດຕາເປີເຊັນ ມຊ')
@section('page-title', 'ຕັ້ງຄ່າຈຳນວນເປີເຊັນ ມຊ (%)')

@section('content')

{{-- Current active rates summary --}}
@php
    $activeBachelor  = $settings->where('level', 'bachelor')->first();
    $activeMasterPhd = $settings->where('level', 'master_phd')->first();
@endphp
<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1rem; margin-bottom:1.5rem;">
    <div class="fns-card" style="border-left:4px solid #3b82f6;">
        <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ອັດຕາປັດຈຸບັນ — ປ.ຕີ</p>
        <p style="font-size:1.5rem; font-weight:700; color:#1e40af;">
            {{ $activeBachelor ? number_format($activeBachelor->percentage * 100, 2).'%' : '—' }}
        </p>
        @if($activeBachelor)
            <p style="color:#9ca3af; font-size:0.75rem;">ປີ {{ $activeBachelor->start_year }}</p>
        @endif
    </div>
    <div class="fns-card" style="border-left:4px solid #10b981;">
        <p style="color:#6b7280; font-size:0.75rem; margin-bottom:0.25rem;">ອັດຕາປັດຈຸບັນ — ປ.ໂທ / ປ.ເອກ</p>
        <p style="font-size:1.5rem; font-weight:700; color:#065f46;">
            {{ $activeMasterPhd ? number_format($activeMasterPhd->percentage * 100, 2).'%' : '—' }}
        </p>
        @if($activeMasterPhd)
            <p style="color:#9ca3af; font-size:0.75rem;">ປີ {{ $activeMasterPhd->start_year }}</p>
        @endif
    </div>
</div>

<div style="display:flex; justify-content:flex-end; margin-bottom:1rem;">
    <a href="{{ route('head_of_finance.settings.nuol-pct.create') }}" class="fns-btn fns-btn-primary">+ ເພີ່ມອັດຕາໃໝ່</a>
</div>

<div class="fns-card">
    <table class="fns-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ລະດັບ</th>
                <th>ອັດຕາ (%)</th>
                <th>ເລກທີເອກະສານ</th>
                <th>ປີທີ່ເລີ່ມໃຊ້</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($settings as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <span class="fns-badge {{ $s->level === 'bachelor' ? 'fns-badge-blue' : 'fns-badge-green' }}">
                        {{ \App\Models\NuolPctSetting::levelLabel($s->level) }}
                    </span>
                </td>
                <td><strong>{{ number_format($s->percentage * 100, 2) }}%</strong></td>
                <td>{{ $s->gov_doc_id ?? '—' }}</td>
                <td>{{ $s->start_year }}</td>
                <td>
                    <a href="{{ route('head_of_finance.settings.nuol-pct.edit', $s) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ແກ້ໄຂ</a>
                    <form method="POST" action="{{ route('head_of_finance.settings.nuol-pct.destroy', $s) }}" style="display:inline;"
                        onsubmit="return confirm('ລຶບລາຍການນີ້ບໍ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger">ລຶບ</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#9ca3af;">ຍັງບໍ່ມີຂໍ້ມູນ — ກະລຸນາເພີ່ມອັດຕາ ມຊ</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
