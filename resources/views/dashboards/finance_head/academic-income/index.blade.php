@extends('layouts.admin')

@section('title', 'ການປະເມີນລາຍຮັບວິຊາການ')
@section('page-title', 'ການປະເມີນລາຍຮັບວິຊາການ')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1rem;">
    <a href="{{ route('head_of_finance.academic-income.create') }}" class="fns-btn fns-btn-primary">+ ສ້າງແຜນໃໝ່</a>
</div>

<div class="fns-card">
    <table class="fns-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ສົກປີງົບປະມານ</th>
                <th>ສະຖານະ</th>
                <th>ຜູ້ສ້າງ</th>
                <th>ວັນທີສ້າງ</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($plans as $plan)
            <tr>
                <td>{{ $plans->firstItem() + $loop->index }}</td>
                <td><strong>ປີ {{ $plan->fiscal_year }}</strong></td>
                <td>
                    <span class="fns-badge {{ $plan->status === 'APPROVED' ? 'fns-badge-green' : 'fns-badge-gray' }}">
                        {{ $plan->status === 'APPROVED' ? 'ອະນຸມັດແລ້ວ' : 'ຮ່າງ' }}
                    </span>
                </td>
                <td>{{ $plan->creator?->full_name ?? '—' }}</td>
                <td>{{ $plan->created_at->format('d/m/Y') }}</td>
                <td style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                    <a href="{{ route('head_of_finance.academic-income.show', $plan) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ເບິ່ງ</a>
                    @if(!$plan->isApproved())
                        <a href="{{ route('head_of_finance.academic-income.evaluate', $plan) }}" class="fns-btn fns-btn-sm fns-btn-primary">ປະເມີນ</a>
                    @endif
                    <a href="{{ route('head_of_finance.academic-income.summary', $plan) }}" class="fns-btn fns-btn-sm fns-btn-secondary">ສັງລວມ</a>
                    @if(!$plan->isApproved())
                        <form method="POST" action="{{ route('head_of_finance.academic-income.destroy', $plan) }}" style="display:inline;"
                            onsubmit="return confirm('ລຶບແຜນນີ້ບໍ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger">ລຶບ</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#9ca3af;">ບໍ່ມີແຜນ — ກົດ "ສ້າງແຜນໃໝ່" ເພື່ອເລີ່ມຕົ້ນ</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $plans->links() }}</div>
</div>
@endsection
