<table class="fns-table">
    <thead>
        <tr>
            <th>ຊັ້ນປີ</th>
            <th>ສາຂາວິຊາ</th>
            <th>ລະດັບ</th>
            <th style="width:80px;">ໜ່ວຍກິດ</th>
            <th style="width:150px;">ລາຄາ/ໜ່ວຍ (ກີບ)</th>
            <th style="width:120px;">ຈຳນວນ ນ/ສ</th>
        </tr>
    </thead>
    <tbody>
        @forelse($programs as $p)
        @php
            $creditUnit = $p->latestCourseCredit?->course_credit_unit ?? null;
            $price      = $creditPrices[$p->level]?->credit_unit_price ?? null;
            $existing   = $existingItems->get($section . '_' . $p->id);
        @endphp
        <tr>
            <td>{{ $p->study_year ? 'ປີ ' . $p->study_year : '—' }}</td>
            <td>{{ $p->name }}</td>
            <td>
                <span class="fns-badge {{ $p->level==='bachelor'?'fns-badge-blue':($p->level==='master'?'fns-badge-green':'fns-badge-purple') }}">
                    {{ $p->level_label }}
                </span>
            </td>
            <td style="text-align:center;">
                @if($creditUnit)
                    {{ $creditUnit }}
                @else
                    <span style="color:#f59e0b;" title="ຍັງບໍ່ຕັ້ງຄ່າ">—</span>
                @endif
            </td>
            <td style="text-align:right;">
                @if($price)
                    {{ number_format($price, 2) }}
                @else
                    <span style="color:#f59e0b;" title="ຍັງບໍ່ຕັ້ງລາຄາ">—</span>
                @endif
            </td>
            <td>
                <input type="number" name="{{ $inputPrefix }}[{{ $p->id }}]" min="0"
                    value="{{ old($inputPrefix.'.'.$p->id, $existing?->student_count ?? 0) }}"
                    class="fns-input">
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center; color:#9ca3af;">ບໍ່ມີສາຂາວິຊາ</td></tr>
        @endforelse
    </tbody>
</table>
