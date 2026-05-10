@extends('layouts.admin')

@section('title', 'ແຜນເງິນເດືອນ ສົກ ' . $plan->fiscal_year)
@section('page-title', 'ແຜນເງິນເດືອນ ສົກ ' . $plan->fiscal_year)

@php
function fmtS2($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

@section('content')
<div class="space-y-4 pb-24">

    {{-- Top bar --}}
    <div class="bg-white rounded-lg shadow-sm p-4 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.salary.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-bold text-gray-900">ສົກ {{ $plan->fiscal_year }}</h2>
                <span class="text-xs px-2 py-0.5 rounded font-semibold
                    {{ $plan->status === 'APPROVED' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $plan->status === 'APPROVED' ? 'ອະນຸມັດແລ້ວ' : 'ຮ່າງ' }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('head_of_finance.salary.summary', $plan) }}"
                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 gap-2">
                ເບິ່ງສັງລວມ
            </a>
            @if ($plan->status === 'DRAFT')
                <form method="POST" action="{{ route('head_of_finance.salary.approve', $plan) }}" style="margin:0">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700">
                        ອະນຸມັດ
                    </button>
                </form>
                <form method="POST" action="{{ route('head_of_finance.salary.destroy', $plan) }}"
                    onsubmit="return confirm('ລຶບແຜນ ສົກ {{ $plan->fiscal_year }} ແທ້ ບໍ?')" style="margin:0">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg hover:bg-red-100">
                        ລຶບ
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('head_of_finance.salary.revert_draft', $plan) }}" style="margin:0">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-orange-50 text-orange-600 text-sm font-medium rounded-lg hover:bg-orange-100">
                        ຍ້ອນກັບຮ່າງ
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    {{-- Main table form --}}
    <form method="POST" action="{{ route('head_of_finance.salary.save_all', $plan) }}" id="salaryForm">
        @csrf

        @php
            $isApproved = $plan->status === 'APPROVED';
            $seq60 = 0; $seq61 = 0;
        @endphp

        {{-- Section 60 --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4">
            <div class="px-4 py-3 bg-slate-700 text-white font-bold text-sm flex justify-between">
                <span>60 — ເງິນເດືອນ ແລະ ເງິນອຸດໜູນຂອງ ພ/ງ</span>
                <span id="total60_month" class="font-mono">{{ fmtS2($totals['60']) }} ກີບ/ເດືອນ</span>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-600">
                        <th class="px-3 py-2 text-left w-8">ລ/ດ</th>
                        <th class="px-3 py-2 text-left w-24">ສາລະບານ</th>
                        <th class="px-3 py-2 text-left">ເນື້ອໃນ</th>
                        <th class="px-3 py-2 text-center w-20">ຈໍານວນ (ພົນ)</th>
                        <th class="px-3 py-2 text-right w-36">ໂອນ ATM (ກີບ/ເດືອນ)</th>
                        <th class="px-3 py-2 text-right w-36">ຖອນສົດ (ກີບ/ເດືອນ)</th>
                        <th class="px-3 py-2 text-right w-32">ລວມ/ເດືອນ</th>
                        <th class="px-3 py-2 text-right w-36">ລວມ/ປີ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['60.10', '60.20'] as $sec)
                    @php $secData = $sections[$sec]; @endphp
                    <tr class="bg-blue-50 border-b border-blue-100">
                        <td colspan="2" class="px-3 py-1.5 font-semibold text-blue-800 text-xs">{{ $sec }}</td>
                        <td colspan="4" class="px-3 py-1.5 font-semibold text-blue-800 text-xs">{{ $sectionMeta[$sec] }}</td>
                        <td class="px-3 py-1.5 text-right font-semibold text-blue-800 text-xs font-mono sec-total-month" data-sec="{{ $sec }}">{{ fmtS2($secData['total_month']) }}</td>
                        <td class="px-3 py-1.5 text-right font-semibold text-blue-800 text-xs font-mono sec-total-year" data-sec="{{ $sec }}">{{ fmtS2($secData['total_month'] * 12) }}</td>
                    </tr>
                    @foreach ($secData['items'] as $item)
                    @php $seq60++; $pm = $item->totalPerMonth(); @endphp
                    <tr class="border-b border-gray-100 hover:bg-gray-50" data-item="{{ $item->id }}" data-sec="{{ $sec }}">
                        <td class="px-3 py-1.5 text-center text-gray-500 text-xs">{{ $seq60 }}</td>
                        <td class="px-3 py-1.5 text-gray-400 text-xs">{{ $item->account_code }}</td>
                        <td class="px-3 py-1.5 text-gray-800">{{ $item->item_name }}</td>
                        <td class="px-3 py-1.5 text-center">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][num_persons]"
                                value="{{ $item->num_persons }}" min="0"
                                class="w-16 border border-gray-300 rounded px-1 py-0.5 text-center text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700">{{ $item->num_persons }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][amount_atm]"
                                value="{{ $item->amount_atm }}" min="0" step="any"
                                class="w-32 border border-gray-300 rounded px-1 py-0.5 text-right text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700 font-mono">{{ $item->amount_atm > 0 ? fmtS2($item->amount_atm) : '' }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][amount_cash]"
                                value="{{ $item->amount_cash }}" min="0" step="any"
                                class="w-32 border border-gray-300 rounded px-1 py-0.5 text-right text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700 font-mono">{{ $item->amount_cash > 0 ? fmtS2($item->amount_cash) : '' }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right text-xs font-mono text-gray-700" id="row_month_{{ $item->id }}">{{ $pm > 0 ? fmtS2($pm) : '' }}</td>
                        <td class="px-3 py-1.5 text-right text-xs font-mono text-gray-700" id="row_year_{{ $item->id }}">{{ $pm > 0 ? fmtS2($pm * 12) : '' }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-slate-100 border-t-2 border-slate-300 font-semibold text-xs">
                        <td colspan="6" class="px-3 py-2 text-center">ລວມ 60</td>
                        <td class="px-3 py-2 text-right font-mono" id="grand60_month">{{ fmtS2($totals['60']) }}</td>
                        <td class="px-3 py-2 text-right font-mono" id="grand60_year">{{ fmtS2($totals['60'] * 12) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Section 61 --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4">
            <div class="px-4 py-3 bg-indigo-700 text-white font-bold text-sm flex justify-between">
                <span>61 — ເງິນນະໂຍບາຍ ແລະ ຊ່ວຍໜູນຕ່າງໆ</span>
                <span id="total61_month" class="font-mono">{{ fmtS2($totals['61']) }} ກີບ/ເດືອນ</span>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-600">
                        <th class="px-3 py-2 text-left w-8">ລ/ດ</th>
                        <th class="px-3 py-2 text-left w-24">ສາລະບານ</th>
                        <th class="px-3 py-2 text-left">ເນື້ອໃນ</th>
                        <th class="px-3 py-2 text-center w-20">ຈໍານວນ (ພົນ)</th>
                        <th class="px-3 py-2 text-right w-36">ໂອນ ATM (ກີບ/ເດືອນ)</th>
                        <th class="px-3 py-2 text-right w-36">ຖອນສົດ (ກີບ/ເດືອນ)</th>
                        <th class="px-3 py-2 text-right w-32">ລວມ/ເດືອນ</th>
                        <th class="px-3 py-2 text-right w-36">ລວມ/ປີ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['61.20', '61.30', '61.40', '61.50'] as $sec)
                    @php $secData = $sections[$sec]; @endphp
                    <tr class="bg-indigo-50 border-b border-indigo-100">
                        <td colspan="2" class="px-3 py-1.5 font-semibold text-indigo-800 text-xs">{{ $sec }}</td>
                        <td colspan="4" class="px-3 py-1.5 font-semibold text-indigo-800 text-xs">{{ $sectionMeta[$sec] }}</td>
                        <td class="px-3 py-1.5 text-right font-semibold text-indigo-800 text-xs font-mono sec-total-month" data-sec="{{ $sec }}">{{ fmtS2($secData['total_month']) }}</td>
                        <td class="px-3 py-1.5 text-right font-semibold text-indigo-800 text-xs font-mono sec-total-year" data-sec="{{ $sec }}">{{ fmtS2($secData['total_month'] * 12) }}</td>
                    </tr>
                    @foreach ($secData['items'] as $item)
                    @php $seq61++; $pm = $item->totalPerMonth(); @endphp
                    <tr class="border-b border-gray-100 hover:bg-gray-50" data-item="{{ $item->id }}" data-sec="{{ $sec }}">
                        <td class="px-3 py-1.5 text-center text-gray-500 text-xs">{{ $seq61 }}</td>
                        <td class="px-3 py-1.5 text-gray-400 text-xs">{{ $item->account_code }}</td>
                        <td class="px-3 py-1.5 text-gray-800">{{ $item->item_name }}</td>
                        <td class="px-3 py-1.5 text-center">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][num_persons]"
                                value="{{ $item->num_persons }}" min="0"
                                class="w-16 border border-gray-300 rounded px-1 py-0.5 text-center text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700">{{ $item->num_persons }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][amount_atm]"
                                value="{{ $item->amount_atm }}" min="0" step="any"
                                class="w-32 border border-gray-300 rounded px-1 py-0.5 text-right text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700 font-mono">{{ $item->amount_atm > 0 ? fmtS2($item->amount_atm) : '' }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right">
                            @if (!$isApproved)
                            <input type="number" name="items[{{ $item->id }}][amount_cash]"
                                value="{{ $item->amount_cash }}" min="0" step="any"
                                class="w-32 border border-gray-300 rounded px-1 py-0.5 text-right text-xs focus:outline-none focus:ring-1 focus:ring-blue-500"
                                oninput="calcRow({{ $item->id }}, '{{ $sec }}')">
                            @else
                            <span class="text-xs text-gray-700 font-mono">{{ $item->amount_cash > 0 ? fmtS2($item->amount_cash) : '' }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-1.5 text-right text-xs font-mono text-gray-700" id="row_month_{{ $item->id }}">{{ $pm > 0 ? fmtS2($pm) : '' }}</td>
                        <td class="px-3 py-1.5 text-right text-xs font-mono text-gray-700" id="row_year_{{ $item->id }}">{{ $pm > 0 ? fmtS2($pm * 12) : '' }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-indigo-100 border-t-2 border-indigo-300 font-semibold text-xs">
                        <td colspan="6" class="px-3 py-2 text-center">ລວມ 61</td>
                        <td class="px-3 py-2 text-right font-mono" id="grand61_month">{{ fmtS2($totals['61']) }}</td>
                        <td class="px-3 py-2 text-right font-mono" id="grand61_year">{{ fmtS2($totals['61'] * 12) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Grand total --}}
        <div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center text-sm font-semibold">
            <span class="text-gray-700">ລວມທັງໝົດ (60 + 61)</span>
            <div class="text-right">
                <div class="text-base text-gray-900">
                    <span id="grand_month">{{ fmtS2($totals['grand_month']) }}</span> ກີບ/ເດືອນ
                </div>
                <div class="text-xs text-gray-500">
                    ລວມ/ປີ: <span id="grand_year" class="font-mono">{{ fmtS2($totals['grand_year']) }}</span> ກີບ
                </div>
            </div>
        </div>

        {{-- Floating save button --}}
        @if (!$isApproved)
        <div class="fixed bottom-6 right-6 z-50">
            <button type="submit" form="salaryForm"
                class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 gap-2 text-sm">
                💾 ບັນທຶກ
            </button>
        </div>
        @endif

    </form>

</div>

<script>
function fmt(n) {
    if (!n || isNaN(n)) return '';
    return Math.round(n).toLocaleString('en-US');
}

function calcRow(itemId, sec) {
    const row  = document.querySelector(`tr[data-item="${itemId}"]`);
    const atm  = parseFloat(row.querySelector(`input[name*="amount_atm"]`).value)  || 0;
    const cash = parseFloat(row.querySelector(`input[name*="amount_cash"]`).value) || 0;
    const pm   = atm + cash;
    const py   = pm * 12;

    document.getElementById(`row_month_${itemId}`).textContent = pm > 0 ? fmt(pm) : '';
    document.getElementById(`row_year_${itemId}`).textContent  = py > 0 ? fmt(py) : '';

    calcSectionTotal(sec);
}

function calcSectionTotal(sec) {
    let secMonth = 0;
    document.querySelectorAll(`tr[data-sec="${sec}"]`).forEach(row => {
        const itemId = row.dataset.item;
        if (!itemId) return;
        const atm  = parseFloat(row.querySelector(`input[name*="amount_atm"]`)?.value)  || 0;
        const cash = parseFloat(row.querySelector(`input[name*="amount_cash"]`)?.value) || 0;
        secMonth += atm + cash;
    });

    document.querySelector(`.sec-total-month[data-sec="${sec}"]`).textContent = fmt(secMonth);
    document.querySelector(`.sec-total-year[data-sec="${sec}"]`).textContent  = fmt(secMonth * 12);

    calcGrandTotals();
}

function calcGrandTotals() {
    const secs60 = ['60.10', '60.20'];
    const secs61 = ['61.20', '61.30', '61.40', '61.50'];

    let t60 = 0, t61 = 0;
    secs60.forEach(s => {
        const el = document.querySelector(`.sec-total-month[data-sec="${s}"]`);
        if (el) t60 += parseFloat(el.textContent.replace(/,/g, '')) || 0;
    });
    secs61.forEach(s => {
        const el = document.querySelector(`.sec-total-month[data-sec="${s}"]`);
        if (el) t61 += parseFloat(el.textContent.replace(/,/g, '')) || 0;
    });

    document.getElementById('grand60_month').textContent = fmt(t60);
    document.getElementById('grand60_year').textContent  = fmt(t60 * 12);
    document.getElementById('grand61_month').textContent = fmt(t61);
    document.getElementById('grand61_year').textContent  = fmt(t61 * 12);

    const grand = t60 + t61;
    document.getElementById('grand_month').textContent = fmt(grand);
    document.getElementById('grand_year').textContent  = fmt(grand * 12);
    document.getElementById('total60_month').textContent = fmt(t60) + ' ກີບ/ເດືອນ';
    document.getElementById('total61_month').textContent = fmt(t61) + ' ກີບ/ເດືອນ';
}
</script>
@endsection
