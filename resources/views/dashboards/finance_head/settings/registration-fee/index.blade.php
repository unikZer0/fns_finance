@extends('layouts.admin')

@section('title', 'ຄ່າລົງທະບຽນ')
@section('page-title', 'ການຕັ້ງຄ່າລົງທະບຽນ')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1rem;">
    <a href="{{ route('head_of_finance.settings.registration-fee.create') }}" class="fns-btn fns-btn-primary">+ ເພີ່ມຄ່າລົງທະບຽນ</a>
</div>

@forelse($settings as $s)
<div class="fns-card" style="margin-bottom:1.25rem;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.75rem;">
        <div>
            <span class="fns-badge {{ $s->section_type === 'year2_4' ? 'fns-badge-blue' : 'fns-badge-green' }}" style="font-size:0.85rem; padding:0.3rem 0.8rem;">
                {{ \App\Models\RegistrationFeeSetting::sectionLabel($s->section_type) }}
            </span>
            <span style="margin-left:0.75rem; color:#6b7280; font-size:0.875rem;">ປີ {{ $s->start_year }}
                @if($s->gov_doc_id) · {{ $s->gov_doc_id }} @endif
            </span>
        </div>
        <div style="display:flex; gap:0.5rem;">
            <a href="{{ route('head_of_finance.settings.registration-fee.edit', $s) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ແກ້ໄຂ</a>
            <form method="POST" action="{{ route('head_of_finance.settings.registration-fee.destroy', $s) }}" style="display:inline;"
                onsubmit="return confirm('ລຶບລາຍການນີ້ບໍ?')">
                @csrf @method('DELETE')
                <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger">ລຶບ</button>
            </form>
        </div>
    </div>
    <table class="fns-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ລາຍການ</th>
                <th>ຈຳນວນ (ກີບ)</th>
                <th>% ມຊ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($s->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->amount, 2) }}</td>
                <td>{{ number_format($item->nuol_pct * 100, 2) }}%</td>
            </tr>
            @endforeach
            <tr style="background:#f9fafb; font-weight:600;">
                <td colspan="2" style="text-align:right;">ລວມ</td>
                <td>{{ number_format($s->total_rate, 2) }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@empty
<div class="fns-card" style="text-align:center; color:#9ca3af;">ບໍ່ມີຂໍ້ມູນ</div>
@endforelse
@endsection
