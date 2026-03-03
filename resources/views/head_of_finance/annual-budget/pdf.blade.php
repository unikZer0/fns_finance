<!DOCTYPE html>
<html lang="lo">

<head>
    <meta charset="UTF-8">
    <title>ແຜນງົບປະມານປະຈຳປີ {{ $annualBudget->fiscal_year }}</title>
    <style>
        body {
            font-family: 'notosanslao', sans-serif;
            font-size: 11px;
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        /* Header section */
        .doc-header p {
            margin: 2px 0;
            font-size: 11px;
        }

        .header-grid {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .header-grid td {
            vertical-align: top;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background-color: #fce4d6;
            /* Light orange matching the image */
            text-align: center;
        }

        .bg-gray {
            background-color: #f3f4f6;
        }

        .header-row td {
            font-weight: bold;
            background-color: #e6f2ff;
        }

        /* Specific widths */
        .col-code {
            width: 120px;
            text-align: center;
        }

        .col-name {
            width: auto;
        }

        .col-amount {
            width: 100px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="doc-header text-center">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
    </div>

    <table class="header-grid" style="border: none;">
        <tr>
            <td style="border: none; text-align: left;">
                <p style="margin:2px 0;">ມະຫາວິທະຍາໄລແຫ່ງຊາດ</p>
                <p style="margin:2px 0;">ຄະນະວິທະຍາສາດປ່າໄມ້</p>
            </td>
            <td style="border: none; text-align: right;">
                <p style="margin:2px 0;">ເລກທີ .................... /ຄນທ</p>
                <p style="margin:2px 0;">ວັນທີ........./........./ 2025</p>
            </td>
        </tr>
    </table>

    <h3 class="text-center mb-4">ແຜນງົບປະມານປະຈຳປີ {{ $annualBudget->fiscal_year }}</h3>

    @php
        $totalRegular = 0;
        $totalAcademic = 0;
        foreach ($annualBudget->lineItems as $item) {
            $totalRegular += $item->amount_regular ?? 0;
            $totalAcademic += $item->amount_academic ?? 0;
        }
        $totalLuam = $totalRegular + $totalAcademic;
    @endphp

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="col-code">ພາກ.ພາກສ່ວນ.</th>
                <th rowspan="2" class="col-name">ເນື້ອໃນ</th>
                <th colspan="3">ແຜນປີ {{ $annualBudget->fiscal_year }}</th>
            </tr>
            <tr>
                <th class="col-amount flex flex-col justify-center">ຮ່ວງ.ລູກຮ່ວງ</th>
                <th class="col-name">ລາຍການຈ່າຍ</th>
                <th class="col-amount">ແຜນລວມ<br>(6)</th>
                <th class="col-amount">ງົບປະມານ<br>ປົກກະຕິ (7)</th>
                <th class="col-amount">ງົບປະມານ<br>ວິຊາການ (8=6-7)</th>
            </tr>
        </thead>
        <tbody>
            {{-- Grand Totals Row at top --}}
            <tr style="background-color: #e2efda; font-weight: bold;">
                <td colspan="2" class="text-right"></td>
                <td class="text-right" style="color: #000; text-decoration: underline;">
                    {{ number_format($totalLuam, 0, ',', '.') }}
                </td>
                <td class="text-right" style="color: #000; text-decoration: underline;">
                    {{ number_format($totalRegular, 0, ',', '.') }}
                </td>
                <td class="text-right" style="color: #000; text-decoration: underline;">
                    {{ number_format($totalAcademic, 0, ',', '.') }}
                </td>
            </tr>

            @forelse ($annualBudget->lineItems as $item)
                @php
                    $isHeader = str_ends_with($item->account->account_code ?? '', '-00-00');
                    $itemLuam = ($item->amount_regular ?? 0) + ($item->amount_academic ?? 0);
                @endphp
                <tr class="{{ $isHeader ? 'header-row' : '' }}">
                    <td class="col-code">{{ $item->account->account_code ?? '-' }}</td>
                    <td class="col-name" style="{{ $isHeader ? 'color: #00b050;' : '' }}">
                        @if(!$isHeader)- @endif{{ $item->account->account_name ?? '-' }}
                    </td>
                    <td class="col-amount">{{ $itemLuam ? number_format($itemLuam, 0, ',', '.') : '0' }}</td>
                    <td class="col-amount">
                        {{ $item->amount_regular ? number_format($item->amount_regular, 0, ',', '.') : '0' }}
                    </td>
                    <td class="col-amount">
                        {{ $item->amount_academic ? number_format($item->amount_academic, 0, ',', '.') : '0' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">ບໍ່ມີລາຍການ</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
