<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ຕາຕະລາງສັງລວມລາຍຈ່າຍເງິນເດືອນ ສົກ {{ $plan->fiscal_year }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'NotoSansLao','Noto Sans Lao','Phetsarath OT',Arial,sans-serif; font-size:11px; color:#000; background:#f0f0f0; }

        .toolbar { position:fixed; top:0; left:0; right:0; z-index:100; background:#1e293b; padding:10px 20px; display:flex; align-items:center; gap:10px; }
        .toolbar a, .toolbar button { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:6px; font-size:13px; font-family:inherit; cursor:pointer; border:none; text-decoration:none; }
        .btn-back  { background:#334155; color:#e2e8f0; }
        .btn-print { background:#2563eb; color:#fff; }
        .btn-pdf   { background:#16a34a; color:#fff; }
        .toolbar-title { color:#94a3b8; font-size:13px; margin-left:auto; }

        .page { background:#fff; width:277mm; min-height:190mm; margin:70px auto 20px; padding:12mm 14mm; box-shadow:0 2px 8px rgba(0,0,0,.15); }

        .letterhead { text-align:center; margin-bottom:8px; }
        .letterhead p { font-size:11px; line-height:1.6; }
        .letterhead .bold { font-weight:bold; }
        .letterhead .title { font-size:13px; font-weight:bold; margin-top:4px; }

        table { width:100%; border-collapse:collapse; font-size:10px; margin-bottom:10px; }
        th, td { border:1px solid #000; padding:3px 5px; vertical-align:middle; }
        th { font-weight:bold; text-align:center; }

        .bg-sec60   { background:#dbeafe; }
        .bg-sec61   { background:#e0e7ff; }
        .bg-subsec  { background:#f0f9ff; }
        .bg-total   { background:#e5e7eb; font-weight:bold; }
        .bg-grand   { background:#1e293b; color:#fff; font-weight:bold; }

        td.num { text-align:right; white-space:nowrap; font-family:monospace; }
        td.ctr { text-align:center; }
        td.ind { padding-left:16px; }

        .section-header td { font-weight:bold; font-size:10px; }

        .signatures { display:flex; justify-content:space-between; margin-top:16px; }
        .sig-block { text-align:center; width:22%; font-size:10px; }
        .sig-date { margin-bottom:4px; }
        .sig-space { height:28px; }
        .sig-role { font-weight:bold; }

        .gov1-table { margin-top:12px; }
        .gov1-table th { background:#f3f4f6; }

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
    <a href="{{ route('head_of_finance.salary.show', $plan) }}" class="btn-back">← ກັບຄືນ</a>
    <button onclick="window.print()" class="btn-print">🖨 ພິມ</button>
    <a href="{{ route('head_of_finance.salary.pdf', $plan) }}" class="btn-pdf" target="_blank">📄 PDF</a>
    <span class="toolbar-title">ຕາຕະລາງສັງລວມລາຍຈ່າຍເງິນເດືອນ ສົກ {{ $plan->fiscal_year }}</span>
</div>

@php
function fmtG($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

<div class="page">
    <div class="letterhead">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <p class="bold">ມະຫາວິທະຍາໄລແຫ່ງຊາດ — ຄະນະວິທະຍາສາດທຳມະຊາດ</p>
        <p class="title">ຕາຕະລາງສັງລວມລາຍຈ່າຍເງິນເດືອນ ຕາມສາລະບານງົບປະມານ</p>
        <p style="font-size:10px;margin-top:2px;">ເດືອນ 01/{{ $plan->fiscal_year }} (ງວດທີ 1 ສົກປີ {{ $plan->fiscal_year }})</p>
    </div>

    {{-- Main salary table --}}
    <table>
        <thead>
            <tr>
                <th colspan="4" style="width:40%">ສາລະບານງົບປະມານ</th>
                <th rowspan="2">ເນື້ອໃນລາຍຈ່າຍ</th>
                <th rowspan="2" class="num" style="width:8%">ຈໍານວນ (ພົນ)</th>
                <th colspan="3" style="width:30%">ຈໍານວນເງິນຖອນຕົວຈິງໃນ 1 ເດືອນ</th>
                <th rowspan="2" class="num" style="width:12%">ລວມ 12 ເດືອນ (ກີບ)</th>
            </tr>
            <tr>
                <th style="width:4%">ພ</th>
                <th style="width:4%">ພສ</th>
                <th style="width:4%">ຮ່ວງ</th>
                <th style="width:4%">ລຮ</th>
                <th class="num" style="width:12%">ໂອນ ATM (ກີບ)</th>
                <th class="num" style="width:9%">ຖອນສົດ (ກີບ)</th>
                <th class="num" style="width:12%">ລວມ (ກີບ)</th>
            </tr>
        </thead>
        <tbody>
            @php $secLabels = [
                '60.10' => ['60','10','00','00'],
                '60.20' => ['60','20','00','00'],
                '61.20' => ['61','20','00','00'],
                '61.30' => ['61','30','00','00'],
                '61.40' => ['61','40','00','00'],
                '61.50' => ['61','50','00','00'],
            ]; @endphp

            {{-- 60 header --}}
            <tr class="bg-sec60 section-header">
                <td>60</td><td></td><td></td><td></td>
                <td>ເງິນເດືອນ ແລະ ເງິນອຸດໜູນຂອງ ພ/ງ</td>
                <td class="ctr"></td>
                <td class="num">{{ fmtG($sections['60.10']['total_month'] + $sections['60.20']['total_month']) > 0 ? fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month')) : '' }}</td>
                <td class="num"></td>
                <td class="num">{{ fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month')) }}</td>
                <td class="num">{{ fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month') * 12) }}</td>
            </tr>

            @foreach (['60.10', '60.20'] as $sec)
            @php $parts = explode('.', $sec); $secData = $sections[$sec]; @endphp
            <tr class="bg-subsec section-header">
                <td></td><td>{{ $parts[1] }}</td><td>00</td><td>00</td>
                <td>{{ $sectionMeta[$sec] }}</td>
                <td class="ctr"></td>
                <td class="num"></td><td class="num"></td>
                <td class="num">{{ $secData['total_month'] > 0 ? fmtG($secData['total_month']) : '' }}</td>
                <td class="num">{{ $secData['total_month'] > 0 ? fmtG($secData['total_month'] * 12) : '' }}</td>
            </tr>
            @foreach ($secData['items'] as $item)
            @php $c = explode('.', $item->account_code); $pm = $item->totalPerMonth(); @endphp
            <tr>
                <td></td><td></td><td>{{ $c[2] ?? '' }}</td><td>00</td>
                <td class="ind">{{ $item->item_name }}</td>
                <td class="ctr">{{ $item->num_persons > 0 ? $item->num_persons : '' }}</td>
                <td class="num">{{ $item->amount_atm > 0 ? fmtG($item->amount_atm) : '' }}</td>
                <td class="num">{{ $item->amount_cash > 0 ? fmtG($item->amount_cash) : '' }}</td>
                <td class="num">{{ $pm > 0 ? fmtG($pm) : '' }}</td>
                <td class="num">{{ $pm > 0 ? fmtG($pm * 12) : '' }}</td>
            </tr>
            @endforeach
            @endforeach

            {{-- 60 total --}}
            <tr class="bg-total">
                <td colspan="5" class="ctr">ລວມ 60</td>
                <td class="ctr"></td>
                <td class="num">{{ fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month')) }}</td>
                <td></td>
                <td class="num">{{ fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month')) }}</td>
                <td class="num">{{ fmtG(collect($sections)->only(['60.10','60.20'])->sum('total_month') * 12) }}</td>
            </tr>

            {{-- 61 header --}}
            <tr class="bg-sec61 section-header">
                <td>61</td><td></td><td></td><td></td>
                <td>ເງິນນະໂຍບາຍ ແລະ ຊ່ວຍໜູນຕ່າງໆ</td>
                <td class="ctr"></td><td class="num"></td><td class="num"></td>
                <td class="num">{{ fmtG(collect($sections)->only(['61.20','61.30','61.40','61.50'])->sum('total_month')) }}</td>
                <td class="num">{{ fmtG(collect($sections)->only(['61.20','61.30','61.40','61.50'])->sum('total_month') * 12) }}</td>
            </tr>

            @foreach (['61.20', '61.30', '61.40', '61.50'] as $sec)
            @php $parts = explode('.', $sec); $secData = $sections[$sec]; @endphp
            <tr class="bg-subsec section-header">
                <td></td><td>{{ $parts[1] }}</td><td>00</td><td>00</td>
                <td>{{ $sectionMeta[$sec] }}</td>
                <td class="ctr"></td>
                <td class="num"></td><td class="num"></td>
                <td class="num">{{ $secData['total_month'] > 0 ? fmtG($secData['total_month']) : '' }}</td>
                <td class="num">{{ $secData['total_month'] > 0 ? fmtG($secData['total_month'] * 12) : '' }}</td>
            </tr>
            @foreach ($secData['items'] as $item)
            @php $c = explode('.', $item->account_code); $pm = $item->totalPerMonth(); @endphp
            <tr>
                <td></td><td></td><td>{{ $c[2] ?? '' }}</td><td>{{ $c[2] ?? '' }}</td>
                <td class="ind">{{ $item->item_name }}</td>
                <td class="ctr">{{ $item->num_persons > 0 ? $item->num_persons : '' }}</td>
                <td class="num">{{ $item->amount_atm > 0 ? fmtG($item->amount_atm) : '' }}</td>
                <td class="num">{{ $item->amount_cash > 0 ? fmtG($item->amount_cash) : '' }}</td>
                <td class="num">{{ $pm > 0 ? fmtG($pm) : '' }}</td>
                <td class="num">{{ $pm > 0 ? fmtG($pm * 12) : '' }}</td>
            </tr>
            @endforeach
            @endforeach

            {{-- Grand total --}}
            <tr class="bg-grand">
                <td colspan="5" style="text-align:center;">ລວມທັງໝົດ (60 + 61)</td>
                <td class="ctr"></td><td class="num">{{ fmtG($totals['grand_month']) }}</td>
                <td></td>
                <td class="num">{{ fmtG($totals['grand_month']) }}</td>
                <td class="num">{{ fmtG($totals['grand_year']) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- gov1: headcount table --}}
    <table class="gov1-table" style="width:40%;">
        <thead>
            <tr><th colspan="3" style="background:#e0e7ff;">ຕາຕະລາງສັງລວມຈໍານວນພົນ</th></tr>
            <tr>
                <th>ລ/ດ</th><th style="text-align:left;">ເນື້ອໃນ</th>
                <th class="num">ຈໍານວນ (ຄົນ)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $regular  = $sections['60.10']['items']->firstWhere('account_code', '60.10.01')?->num_persons ?? 0;
                $domestic = $sections['60.10']['items']->firstWhere('account_code', '60.10.04')?->num_persons ?? 0;
                $abroad   = $sections['60.10']['items']->firstWhere('account_code', '60.10.05')?->num_persons ?? 0;
            @endphp
            <tr><td colspan="3" class="bg-subsec" style="font-weight:bold;">I. ຈໍານວນພົນພະນັກງານ-ອາຈານ</td></tr>
            <tr><td class="ctr">1</td><td>ພະນັກງານ-ອາຈານປະຈໍາການ</td><td class="num">{{ $regular }}</td></tr>
            <tr><td class="ctr">2</td><td>ພະນັກງານຮຽນຕໍ່ພາຍໃນ</td><td class="num">{{ $domestic }}</td></tr>
            <tr><td class="ctr">3</td><td>ພະນັກງານຮຽນຕໍ່ຕ່າງປະເທດ</td><td class="num">{{ $abroad }}</td></tr>
            <tr class="bg-total"><td></td><td style="font-weight:bold;">ລວມ</td><td class="num">{{ $regular + $domestic + $abroad }}</td></tr>
        </tbody>
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
