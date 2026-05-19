{{-- Variables: $items (collection), $editable (bool) --}}
<table class="fns-table" style="margin:0;border-radius:0;">
    <thead>
        <tr style="font-size:0.72rem;">
            <th style="width:4%">#</th>
            <th>ລາຍການ</th>
            <th style="width:12%">ອ້າງອີງ</th>
            <th style="width:13%;text-align:right;">ຕໍ່ເດືອນ (ກີບ)</th>
            <th style="width:6%;text-align:center;">ຈ/ນ</th>
            <th style="width:14%;text-align:right;">ໝົດປີ (ກີບ)</th>
            <th style="width:12%">ໝາຍເຫດ</th>
            @if($editable)<th style="width:8%"></th>@endif
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr style="font-size:0.78rem;">
            <td class="c dim">{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td style="color:#64748b;">{{ $item->reference }}</td>
            <td style="text-align:right;">{{ number_format($item->monthly_amount, 0) }}</td>
            <td style="text-align:center;">{{ $item->quantity }}</td>
            <td style="text-align:right;font-weight:600;">{{ number_format($item->annual_amount, 0) }}</td>
            <td style="color:#64748b;font-size:0.72rem;">{{ $item->remark }}</td>
            @if($editable)
            <td>
                <div style="display:flex;gap:4px;">
                    <button class="fns-btn fns-btn-sm" style="font-size:0.65rem;padding:2px 6px;"
                        onclick="openEditItemModal({{ json_encode($item) }})">ແກ້</button>
                    <form method="POST" action="{{ route('head_of_finance.expense-items.destroy', $item) }}" style="display:inline;"
                        onsubmit="return confirm('ລຶບລາຍການ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger" style="font-size:0.65rem;padding:2px 6px;">ລຶບ</button>
                    </form>
                </div>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
