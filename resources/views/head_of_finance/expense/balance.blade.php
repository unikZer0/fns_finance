<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ແຜນງົບປະມານດຸ່ນດ່ຽງ ສົກ {{ $plan->fiscal_year }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'NotoSansLao','Noto Sans Lao','Phetsarath OT',Arial,sans-serif; font-size:11px; color:#000; background:#f0f0f0; }

        .toolbar { position:fixed; top:0; left:0; right:0; z-index:100; background:#1e293b; padding:10px 20px; display:flex; align-items:center; gap:10px; }
        .toolbar a, .toolbar button { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:6px; font-size:13px; font-family:inherit; cursor:pointer; border:none; text-decoration:none; }
        .btn-back  { background:#334155; color:#e2e8f0; }
        .btn-print { background:#2563eb; color:#fff; }
        .toolbar-title { color:#94a3b8; font-size:13px; margin-left:auto; }

        .page { background:#fff; width:277mm; min-height:190mm; margin:70px auto 20px; padding:12mm 14mm; box-shadow:0 2px 8px rgba(0,0,0,.15); }

        .letterhead { text-align:center; margin-bottom:8px; }
        .letterhead p { font-size:11px; line-height:1.6; }
        .letterhead .title-main { font-size:13px; font-weight:bold; margin-top:6px; }

        table { width:100%; border-collapse:collapse; font-size:10px; }
        th, td { border:1px solid #000; padding:3px 5px; vertical-align:middle; }
        th { font-weight:bold; text-align:center; background:#fff; }

        .bg-income   { background:#d1fae5; }
        .bg-expense  { background:#fecaca; }
        .bg-balance  { background:#dbeafe; }
        .bg-total    { background:#f3f4f6; font-weight:bold; }
        .bg-pos      { background:#bbf7d0; }
        .bg-neg      { background:#fca5a5; }

        td.num { text-align:right; white-space:nowrap; }
        td.ctr { text-align:center; }

        .warn-box { background:#fef3c7; border:1px solid #f59e0b; padding:6px 12px; border-radius:4px; margin-bottom:8px; font-size:10px; color:#92400e; }

        .signatures { display:flex; justify-content:space-between; margin-top:18px; }
        .sig-block { text-align:center; width:22%; font-size:10px; }
        .sig-date { margin-bottom:4px; }
        .sig-space { height:28px; }
        .sig-role { font-weight:bold; }

        @media print {
            body { background:#fff; }
            .toolbar { display:none !important; }
            .page { margin:0; padding:10mm 12mm; box-shadow:none; width:100%; }
        }
        @page { size:A4 landscape; margin:10mm 12mm; }
    </style>
</head>
<body>

<div class="toolbar">
    <a href="{{ route('head_of_finance.balance.index') }}" class="btn-back">← ກັບຄືນ</a>
    <button onclick="window.print()" class="btn-print">🖨 ພິມ</button>
    <span class="toolbar-title">ແຜນງົບປະມານດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</span>
</div>

@php
function fmtBal($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

<div class="page">
    <div class="letterhead">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <p>ມະຫາວິທະຍາໄລແຫ່ງຊາດ</p>
        <p>ຄະນະວິທະຍາສາດທຳມະຊາດ</p>
        <p class="title-main">ແຜນງົບປະມານດຸ່ນດ່ຽງລາຍຮັບ ແລະ ລາຍຈ່າຍວິຊາການ ຂອງ ຄວທ ປະຈຳ ສົກຮຽນ {{ $plan->fiscal_year }}</p>
    </div>

    @if (!$incomePlan)
    <div class="warn-box">⚠ ບໍ່ພົບແຜນລາຍຮັບ ສົກ {{ $plan->fiscal_year }} — ລາຍຮັບສະແດງ 0.</div>
    @endif

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width:3%">ລ/ດ</th>
                <th colspan="3" class="bg-income">ລາຍຮັບ</th>
                <th colspan="3" class="bg-expense">ລາຍຈ່າຍ</th>
                <th colspan="2" class="bg-balance">ດຸ່ນດ່ຽງ</th>
            </tr>
            <tr>
                <th class="bg-income" style="width:22%">ລາຍການລາຍຮັບຈາກພາກສ່ວນຕ່າງໆ</th>
                <th class="bg-income num" style="width:12%">ງົບປະມານ/ປີ</th>
                <th class="bg-income num" style="width:10%">ງົບປະມານ/ເດືອນ</th>
                <th class="bg-expense" style="width:16%">ເນື້ອໃນລາຍຈ່າຍ</th>
                <th class="bg-expense num" style="width:12%">ລາຍຈ່າຍ/ປີ</th>
                <th class="bg-expense num" style="width:10%">ລາຍຈ່າຍ/ເດືອນ</th>
                <th class="bg-balance num" style="width:10%">ດຸ່ນດ່ຽງ/ປີ</th>
                <th class="bg-balance num" style="width:10%">ດຸ່ນດ່ຽງ/ເດືອນ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $maxRows = max(count($incomeRows), count($expenseRows));
            @endphp
            @for ($i = 0; $i < $maxRows; $i++)
            @php
                $inc = $incomeRows[$i]  ?? null;
                $exp = $expenseRows[$i] ?? null;
            @endphp
            <tr>
                <td class="ctr">{{ $i + 1 }}</td>
                {{-- Income --}}
                @if ($inc)
                <td>{{ $inc['label'] }}</td>
                <td class="num">{{ $inc['kawt'] > 0 ? fmtBal($inc['kawt']) : '' }}</td>
                <td class="num">{{ $inc['kawt'] > 0 ? fmtBal($inc['kawt'] / 12) : '' }}</td>
                @else
                <td></td><td></td><td></td>
                @endif
                {{-- Expense --}}
                @if ($exp)
                <td>{{ $exp['label'] }}</td>
                <td class="num">{{ $exp['total'] > 0 ? fmtBal($exp['total']) : '' }}</td>
                <td class="num">{{ $exp['total'] > 0 ? fmtBal($exp['total'] / 12) : '' }}</td>
                @else
                <td></td><td></td><td></td>
                @endif
                {{-- Balance per row: empty (only total row shows balance) --}}
                <td></td><td></td>
            </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr class="bg-total">
                <td></td>
                <td style="text-align:center;font-weight:bold;">ລວມ</td>
                <td class="num">{{ fmtBal($totalIncome) }}</td>
                <td class="num">{{ fmtBal($totalIncome / 12) }}</td>
                <td></td>
                <td class="num">{{ fmtBal($totalExpense) }}</td>
                <td class="num">{{ fmtBal($totalExpense / 12) }}</td>
                <td class="num {{ $balance >= 0 ? 'bg-pos' : 'bg-neg' }}">{{ fmtBal($balance) }}</td>
                <td class="num {{ $balance >= 0 ? 'bg-pos' : 'bg-neg' }}">{{ fmtBal($balance / 12) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="signatures">
        <div class="sig-block">
            <div class="sig-date">ວັນທີ ......../......../{{ $plan->fiscal_year }}</div>
            <div class="sig-space"></div>
            <div class="sig-role">ຄະນະບໍດີ</div>
        </div>
        <div class="sig-block">
            <div class="sig-date">ວັນທີ ......../......../{{ $plan->fiscal_year }}</div>
            <div class="sig-space"></div>
            <div class="sig-role">ຫົວໜ້າພະແນກຈັດຕັ້ງ-ສັງລວມ</div>
        </div>
        <div class="sig-block">
            <div class="sig-date">ວັນທີ ......../......../{{ $plan->fiscal_year }}</div>
            <div class="sig-space"></div>
            <div class="sig-role">ຫົວໜ້າພະແນກວິຊາການ</div>
        </div>
        <div class="sig-block">
            <div class="sig-date">ວັນທີ ......../......../{{ $plan->fiscal_year }}</div>
            <div class="sig-space"></div>
            <div class="sig-role">ຫົວໜ້າພະແນກການເງິນ-ຊັບສິນ</div>
        </div>
    </div>
</div>

</body>
</html>
