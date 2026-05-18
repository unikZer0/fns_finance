@extends('layouts.admin')

@section('title', 'ສາຂາວິຊາ')
@section('page-title', 'ຈັດການສາຂາວິຊາ')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
    <form method="GET" style="display:flex; gap:0.5rem;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="ຄົ້ນຫາລະຫັດ / ຊື່..."
            class="fns-input" style="width:220px;">
        <select name="level" class="fns-input" style="width:160px;">
            <option value="">ທຸກລະດັບ</option>
            <option value="bachelor" @selected(request('level')==='bachelor')>ປ.ຕີ</option>
            <option value="master" @selected(request('level')==='master')>ປ.ໂທ</option>
            <option value="phd" @selected(request('level')==='phd')>ປ.ເອກ</option>
        </select>
        <button type="submit" class="fns-btn fns-btn-secondary">ຄົ້ນຫາ</button>
        @if(request('search') || request('level'))
            <a href="{{ route('head_of_finance.settings.degree-programs.index') }}" class="fns-btn fns-btn-secondary">ລ້າງ</a>
        @endif
    </form>
    <a href="{{ route('head_of_finance.settings.degree-programs.create') }}" class="fns-btn fns-btn-primary">
        + ເພີ່ມສາຂາວິຊາ
    </a>
</div>

<div class="fns-card">
    <table class="fns-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ລະຫັດ</th>
                <th>ຊື່ສາຂາວິຊາ</th>
                <th>ລະດັບ</th>
                <th>ຊັ້ນປີ</th>
                <th>ສະຖານະ</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programs as $p)
            <tr>
                <td>{{ $programs->firstItem() + $loop->index }}</td>
                <td><strong>{{ $p->code }}</strong></td>
                <td>{{ $p->name }}</td>
                <td>
                    <span class="fns-badge {{ $p->level === 'bachelor' ? 'fns-badge-blue' : ($p->level === 'master' ? 'fns-badge-green' : 'fns-badge-purple') }}">
                        {{ $p->level_label }}
                    </span>
                </td>
                <td>{{ $p->study_year ? 'ປີ ' . $p->study_year : '—' }}</td>
                <td>
                    <span class="fns-badge {{ $p->is_active ? 'fns-badge-green' : 'fns-badge-gray' }}">
                        {{ $p->is_active ? 'ໃຊ້ງານ' : 'ປິດ' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('head_of_finance.settings.degree-programs.edit', $p) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ແກ້ໄຂ</a>
                    <form method="POST" action="{{ route('head_of_finance.settings.degree-programs.destroy', $p) }}" style="display:inline;"
                        onsubmit="return confirm('ລຶບສາຂາວິຊານີ້ບໍ?')">
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
    <div style="margin-top:1rem;">{{ $programs->links() }}</div>
</div>
@endsection
