<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ຮ່າງດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</title>
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
        .letterhead p { font-size:11px; }
        .letterhead .main-org { font-size:12px; font-weight:bold; }
        .letterhead .doc-title { font-size:14px; font-weight:bold; margin-top:4px; }

        table { width:100%; border-collapse:collapse; font-size:10px; }
        th, td { border:1px solid #000; padding:3px 5px; }
        th { font-weight:bold; text-align:center; }

        .bg-income-header  { background:#86efac; }
        .bg-expense-header { background:#fca5a5; }
        .bg-income-total   { background:#bbf7d0; }
        .bg-expense-total  { background:#fecaca; }
        .bg-balance-pos    { background:#d1fae5; }
        .bg-balance-neg    { background:#fee2e2; }
        .bg-section        { background:#e0e7ff; }

        td.num, th.num { text-align:right; white-space:nowrap; }
        td.center       { text-align:center; }

        .warn-box { background:#fef3c7; border:1px solid #f59e0b; padding:8px 14px; border-radius:6px; margin-bottom:10px; font-size:11px; color:#92400e; }

        .signatures { display:flex; justify-content:space-between; margin-top:18px; }
        .sig-block { text-align:center; width:22%; font-size:10px; }
        .sig-block .sig-date { margin-bottom:4px; }
        .sig-block .sig-role { font-weight:bold; }
        .sig-space { height:30px; }

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
    <a href="{{ route('head_of_finance.expense.show', $plan) }}" class="btn-back">← ກັບຄືນ</a>
    <button onclick="window.print()" class="btn-print">🖨 ພິມ</button>
    <span class="toolbar-title">ຮ່າງດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</span>
</div>

@php
function fmtB($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

<div class="page">
    <div class="letterhead">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <p class="main-org">ມະຫາວິທະຍາໄລແຫ່ງຊາດ</p>
        <p class="main-org">ຄະນະວິທະຍາສາດທຳມະຊາດ</p>
        <p class="doc-title">ຮ່າງດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</p>
    </div>

    @if (!$incomePlan)
    <div class="warn-box">
        ⚠ ບໍ່ພົບແຜນລາຍຮັບວິຊາການ ສົກ {{ $plan->fiscal_year }} — ສະແດງດ້ານລາຍຈ່າຍເທົ່ານັ້ນ.
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th colspan="3" class="bg-income-header">ລາຍຮັບ (ຄ່າຮຽນສຸດທິ)</th>
                <th style="width:2%;border:none;background:#fff;"></th>
                <th colspan="3" class="bg-expense-header">ລາຍຈ່າຍ</th>
            </tr>
            <tr>
                <th style="width:4%" class="bg-income-header">ລ/ດ</th>
                <th class="bg-income-header">ລາຍການ</th>
                <th class="num bg-income-header" style="width:18%">ຈຳນວນ (ກີບ)</th>
                <th style="border:none;background:#fff;"></th>
                <th style="width:4%" class="bg-expense-header">ລ/ດ</th>
                <th class="bg-expense-header">ລາຍການ</th>
                <th class="num bg-expense-header" style="width:18%">ຈຳນວນ (ກີບ)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $incomeList  = array_values($incomeRows ?? []);
                $expenseList = array_values($expenseRows);
                $maxRows = max(count($incomeList), count($expenseList));
            @endphp
            @for ($i = 0; $i < $maxRows; $i++)
            <tr>
                @if (isset($incomeList[$i]))
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $incomeList[$i]['label'] }}</td>
                <td class="num">{{ $incomeList[$i]['kawt'] > 0 ? fmtB($incomeList[$i]['kawt']) : '' }}</td>
                @else
                <td></td><td></td><td></td>
                @endif
                <td style="border:none;background:#fff;"></td>
                @if (isset($expenseList[$i]))
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ str_replace(array_keys([]), [], $expenseList[$i]['label']) }}</td>
                <td class="num">{{ $expenseList[$i]['total'] > 0 ? fmtB($expenseList[$i]['total']) : '' }}</td>
                @else
                <td></td><td></td><td></td>
                @endif
            </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr class="bg-income-total">
                <td colspan="2" style="text-align:center;font-weight:bold;">ລວມລາຍຮັບສຸດທິ</td>
                <td class="num"><strong>{{ fmtB($totalIncome) }}</strong></td>
                <td style="border:none;background:#fff;"></td>
                <td colspan="2" class="bg-expense-total" style="text-align:center;font-weight:bold;">ລວມລາຍຈ່າຍທັງໝົດ</td>
                <td class="num bg-expense-total"><strong>{{ fmtB($totalExpense) }}</strong></td>
            </tr>
            <tr class="{{ $balance >= 0 ? 'bg-balance-pos' : 'bg-balance-neg' }}">
                <td colspan="7" style="text-align:center;font-weight:bold;font-size:12px;padding:5px;">
                    ດຸ່ນດ່ຽງ (ລາຍຮັບ − ລາຍຈ່າຍ) = <strong>{{ fmtB($balance) }}</strong> ກີບ
                    @if ($balance >= 0)
                        &nbsp;✔ ລາຍຮັບຄຸ້ມລາຍຈ່າຍ
                    @else
                        &nbsp;✘ ລາຍຮັບບໍ່ຄຸ້ມລາຍຈ່າຍ (ຂາດ {{ fmtB(abs($balance)) }} ກີບ)
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="signatures">
        @foreach (['ຄະນະບໍດີ','ຫົວໜ້າພະແນກຈັດຕັ້ງ-ສັງລວມ','ຫົວໜ້າພະແນກວິຊາການ','ຫົວໜ້າພະແນກການເງິນ-ຊັບສິນ'] as $role)
        <div class="sig-block">
            <div class="sig-date">ວັນທີ ......../......../{{ $plan->fiscal_year }}</div>
            <div class="sig-space"></div>
            <div class="sig-role">{{ $role }}</div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>
