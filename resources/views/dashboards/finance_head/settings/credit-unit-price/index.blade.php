@extends('layouts.admin')

@section('title', 'ລາຄາຄ່າໜ່ວຍກິດ')
@section('page-title', 'ການຕັ້ງລາຄາຄ່າໜ່ວຍກິດ')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
    <form method="GET" style="display:flex; gap:0.5rem;">
        <select name="level" class="fns-input" style="width:180px;">
            <option value="">ທຸກລະດັບ</option>
            <option value="bachelor" @selected(request('level')==='bachelor')>ປ.ຕີ</option>
            <option value="master" @selected(request('level')==='master')>ປ.ໂທ</option>
            <option value="phd" @selected(request('level')==='phd')>ປ.ເອກ</option>
        </select>
        <button type="submit" class="fns-btn fns-btn-secondary">ຄົ້ນຫາ</button>
        @if(request('level'))
            <a href="{{ route('head_of_finance.settings.credit-unit-price.index') }}" class="fns-btn fns-btn-secondary">ລ້າງ</a>
        @endif
    </form>
    <a href="{{ route('head_of_finance.settings.credit-unit-price.create') }}" class="fns-btn fns-btn-primary">+ ເພີ່ມລາຄາ</a>
</div>

<div class="fns-card">
    <table class="fns-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ລະດັບ</th>
                <th>ລາຄາຕໍ່ໜ່ວຍກິດ (ກີບ)</th>
                <th>ເລກທີເອກະສານ</th>
                <th>ປີທີ່ເລີ່ມໃຊ້</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($settings as $s)
            <tr>
                <td>{{ $settings->firstItem() + $loop->index }}</td>
                <td>
                    <span class="fns-badge {{ $s->level === 'bachelor' ? 'fns-badge-blue' : ($s->level === 'master' ? 'fns-badge-green' : 'fns-badge-purple') }}">
                        {{ \App\Models\CreditUnitPriceSetting::levelLabel($s->level) }}
                    </span>
                </td>
                <td>{{ number_format($s->credit_unit_price, 2) }}</td>
                <td>{{ $s->gov_doc_id ?? '—' }}</td>
                <td>{{ $s->start_year }}</td>
                <td>
                    <a href="{{ route('head_of_finance.settings.credit-unit-price.edit', $s) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ແກ້ໄຂ</a>
                    <form method="POST" action="{{ route('head_of_finance.settings.credit-unit-price.destroy', $s) }}" style="display:inline;"
                        onsubmit="return confirm('ລຶບລາຄານີ້ບໍ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger">ລຶບ</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#9ca3af;">ບໍ່ມີຂໍ້ມູນ</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $settings->links() }}</div>
</div>
@endsection
