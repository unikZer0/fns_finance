<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ຮ່າງສັງລວມລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</title>
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

        .letterhead { text-align:center; margin-bottom:6px; }
        .letterhead p { font-size:11px; }
        .letterhead .main-org { font-size:12px; font-weight:bold; }
        .letterhead .doc-title { font-size:14px; font-weight:bold; margin-top:4px; }

        table { width:100%; border-collapse:collapse; font-size:10px; }
        th, td { border:1px solid #000; padding:3px 5px; }
        th { font-weight:bold; text-align:center; }

        .bg-header    { background:#fdba74; }
        .bg-subheader { background:#fed7aa; }
        .bg-total     { background:#a5f3fc; }
        .bg-section   { background:#e0e7ff; }

        td.num, th.num { text-align:right; white-space:nowrap; }
        td.center       { text-align:center; }

        .signatures { display:flex; justify-content:space-between; margin-top:18px; }
        .sig-block { text-align:center; width:22%; font-size:10px; }
        .sig-block .sig-date { margin-bottom:4px; }
        .sig-block .sig-role { font-weight:bold; }
        .sig-space { height:30px; }

        .page-break { page-break-after:always; }

        @media print {
            body { background:#fff; }
            .toolbar { display:none !important; }
            .page { margin:0; padding:10mm 12mm; box-shadow:none; width:100%; page-break-after:always; }
            .page:last-child { page-break-after:avoid; }
        }
        @page { size:A4 landscape; margin:10mm 12mm; }
    </style>
</head>
<body>

<div class="toolbar">
    <a href="{{ route('head_of_finance.expense.show', $plan) }}" class="btn-back">← ກັບຄືນ</a>
    <button onclick="window.print()" class="btn-print">🖨 ພິມ</button>
    <a href="{{ route('head_of_finance.expense.pdf', $plan) }}" class="btn-pdf" target="_blank">📄 PDF</a>
    <span class="toolbar-title">ຮ່າງສັງລວມລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</span>
</div>

@php
function fmtS($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

{{-- PAGE 1: Summary --}}
<div class="page">
    <div class="letterhead">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <p class="main-org">ມະຫາວິທະຍາໄລແຫ່ງຊາດ</p>
        <p class="main-org">ຄະນະວິທະຍາສາດທຳມະຊາດ</p>
        <p class="doc-title">ຮ່າງສັງລວມລາຍຈ່າຍ ສົກ {{ $plan->fiscal_year }}</p>
    </div>

    <table>
        <thead>
            <tr class="bg-header">
                <th style="width:4%">ລ/ດ</th>
                <th style="width:34%">ລາຍການ</th>
                <th class="num" style="width:14%">ອ້າງອີງ</th>
                <th class="num" style="width:14%">ຕໍ່ເດືອນ (ກີບ)</th>
                <th class="num" style="width:8%">ຈ/ນ ເດືອນ</th>
                <th class="num" style="width:16%">ຕໍ່ປີ (ກີບ)</th>
                <th style="width:10%">ໝາຍເຫດ</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-total">
                <td class="center"></td>
                <td><strong>ລວມລາຍຈ່າຍທັງໝົດ</strong></td>
                <td class="num"></td>
                <td class="num"><strong>{{ fmtS($grandTotal / 12) }}</strong></td>
                <td class="center"><strong>12</strong></td>
                <td class="num"><strong>{{ fmtS($grandTotal) }}</strong></td>
                <td></td>
            </tr>
            @php $seq = 1; @endphp
            @foreach ($rows as $cat => $row)
            @php
                $catItems = $sections[$cat];
                $catTotal = $row['total'];
                $catRef   = $cat;
            @endphp
            <tr>
                <td class="center">{{ $seq }}</td>
                <td>{{ str_replace($cat . '  ', '', $row['label']) }}</td>
                <td class="center">{{ $catRef }}</td>
                <td class="num">{{ $catTotal > 0 ? fmtS($catTotal / 12) : '' }}</td>
                <td class="center">12</td>
                <td class="num">{{ fmtS($catTotal) }}</td>
                <td></td>
            </tr>
            @php $seq++; @endphp
            @endforeach
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

{{-- PAGES 2–7: Detail per category --}}
@foreach ($rows as $cat => $row)
@php
    $items    = $sections[$cat];
    $catTotal = $row['total'];
@endphp
<div class="page">
    <div class="letterhead">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
        <p class="main-org">ມະຫາວິທະຍາໄລແຫ່ງຊາດ — ຄະນະວິທະຍາສາດທຳມະຊາດ</p>
        <p class="doc-title">{{ $row['label'] }}</p>
        <p style="font-size:10px;margin-top:2px;">ສົກ {{ $plan->fiscal_year }}</p>
    </div>

    <table>
        <thead>
            <tr class="bg-header">
                <th style="width:4%">ລ/ດ</th>
                <th>ລາຍການ</th>
                <th class="num" style="width:12%">ອ້າງອີງ</th>
                <th class="num" style="width:16%">ຕໍ່ເດືອນ (ກີບ)</th>
                <th class="num" style="width:8%">ຈ/ນ ເດືອນ</th>
                <th class="num" style="width:16%">ໝົດປີ (ກີບ)</th>
                <th style="width:10%">ໝາຍເຫດ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            @php
                $t           = $item->amount_per_month * $item->num_months;
                $hasChildren = $item->relationLoaded('children') && $item->children->isNotEmpty();
            @endphp
            {{-- Parent row --}}
            <tr style="{{ $hasChildren ? 'background:#f8fafc;' : '' }}">
                <td class="center" style="font-weight:{{ $hasChildren ? 'bold' : 'normal' }}">{{ $loop->iteration }}</td>
                <td style="font-weight:{{ $hasChildren ? 'bold' : 'normal' }}">{{ $item->item_name }}</td>
                <td class="center" style="font-weight:bold;color:#1d4ed8;">{{ $item->reference }}</td>
                <td class="num">{{ $item->amount_per_month > 0 ? fmtS($item->amount_per_month) : '' }}</td>
                <td class="center">{{ $item->num_months }}</td>
                <td class="num" style="font-weight:{{ $hasChildren ? 'bold' : 'normal' }}">{{ fmtS($t) }}</td>
                <td>{{ $item->notes }}</td>
            </tr>
            {{-- Sub-item rows --}}
            @if ($hasChildren)
                @foreach ($item->children as $child)
                @php $ct = $child->amount_per_month * $child->num_months; @endphp
                <tr style="background:#eff6ff;">
                    <td class="center" style="color:#93c5fd;font-size:9px;">{{ $loop->iteration }}</td>
                    <td style="padding-left:18px;color:#374151;">
                        <span style="color:#bfdbfe;margin-right:4px;">└</span>{{ $child->item_name }}
                        @if ($child->notes)
                        <span style="font-size:8px;color:#9ca3af;font-style:italic;">({{ $child->notes }})</span>
                        @endif
                    </td>
                    <td class="center" style="color:#6b7280;">{{ $child->reference }}</td>
                    <td class="num" style="color:#4b5563;">{{ $child->amount_per_month > 0 ? fmtS($child->amount_per_month) : '' }}</td>
                    <td class="center" style="color:#4b5563;">{{ $child->num_months }}</td>
                    <td class="num" style="color:#4b5563;">{{ $ct > 0 ? fmtS($ct) : '' }}</td>
                    <td style="color:#6b7280;">{{ $child->notes }}</td>
                </tr>
                @endforeach
            @endif
            @empty
            <tr><td colspan="7" style="text-align:center;padding:8px;color:#666;">ຍັງບໍ່ມີລາຍການ</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="bg-total">
                <td colspan="5" style="text-align:center;font-weight:bold;">ລວມ</td>
                <td class="num"><strong>{{ fmtS($catTotal) }}</strong></td>
                <td></td>
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
@endforeach

</body>
</html>
