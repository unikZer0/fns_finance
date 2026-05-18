{{-- Variables: $topCategories (collection), $plan (ExpensePlan), $editable (bool), $chartOfAccounts (collection, only when editable) --}}
@foreach($topCategories as $mainCat)
<div class="exp-main-cat-block" style="margin-bottom:1rem;">

    {{-- Main category header row --}}
    <div class="exp-row exp-main-row" style="display:flex;align-items:center;gap:8px;background:var(--fns-navy);color:#fff;padding:8px 12px;border-radius:6px 6px 0 0;">
        <span style="font-weight:700;flex:1;">{{ $mainCat->ref_code }} — {{ $mainCat->name }}</span>
        <span style="font-weight:700;white-space:nowrap;">{{ number_format($mainCat->subtotal(), 0) }} ກີບ</span>
        @if($editable)
        <div style="display:flex;gap:6px;margin-left:12px;">
            {{-- Add subcategory --}}
            <button class="fns-btn fns-btn-sm" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.7rem;"
                onclick="openCatModal({{ $plan->id }}, {{ $mainCat->id }}, '{{ addslashes($mainCat->ref_code) }}')">+ ໝວດຍ່ອຍ</button>
            {{-- Add item directly to main cat (no children) --}}
            <button class="fns-btn fns-btn-sm" style="background:rgba(255,255,255,0.12);color:#fff;font-size:0.7rem;"
                onclick="openItemModal({{ $mainCat->id }})">+ ລາຍການ</button>
            {{-- Delete main cat --}}
            <form method="POST" action="{{ route('head_of_finance.expense-categories.destroy', $mainCat) }}" style="display:inline;"
                onsubmit="return confirm('ລຶບໝວດ {{ addslashes($mainCat->name) }} ທັງໝົດ?')">
                @csrf @method('DELETE')
                <button type="submit" class="fns-btn fns-btn-sm" style="background:rgba(220,38,38,0.7);color:#fff;font-size:0.7rem;">ລຶບ</button>
            </form>
        </div>
        @endif
    </div>

    {{-- Subcategories --}}
    @foreach($mainCat->children as $sub)
    <div class="exp-sub-block" style="border-left:3px solid var(--fns-navy);margin-left:12px;">
        {{-- Subcategory header --}}
        <div style="display:flex;align-items:center;gap:8px;background:#f1f5f9;padding:6px 12px;border-bottom:1px solid #e2e8f0;">
            <span style="font-weight:600;flex:1;color:var(--fns-navy);">{{ $sub->ref_code }} {{ $sub->name }}</span>
            <span style="font-weight:600;color:var(--fns-navy);white-space:nowrap;">{{ number_format($sub->subtotal(), 0) }} ກີບ</span>
            @if($editable)
            <div style="display:flex;gap:5px;margin-left:10px;">
                <button class="fns-btn fns-btn-sm fns-btn-primary" style="font-size:0.7rem;"
                    onclick="openItemModal({{ $sub->id }})">+ ລາຍການ</button>
                <form method="POST" action="{{ route('head_of_finance.expense-categories.destroy', $sub) }}" style="display:inline;"
                    onsubmit="return confirm('ລຶບໝວດຍ່ອຍ {{ addslashes($sub->name) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="fns-btn fns-btn-sm fns-btn-danger" style="font-size:0.7rem;">ລຶບ</button>
                </form>
            </div>
            @endif
        </div>

        {{-- Items table --}}
        @if($sub->items->isNotEmpty())
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
                @foreach($sub->items as $item)
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
        @else
        <p style="padding:8px 12px;font-size:0.78rem;color:#94a3b8;margin:0;">ຍັງບໍ່ມີລາຍການ</p>
        @endif
    </div>
    @endforeach

    {{-- Direct items (main cat has no children, items attached directly) --}}
    @if($mainCat->children->isEmpty() && $mainCat->items->isNotEmpty())
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
            @foreach($mainCat->items as $item)
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
    @endif

    @if($mainCat->children->isEmpty() && $mainCat->items->isEmpty() && !$editable)
    <p style="padding:8px 12px;font-size:0.78rem;color:#94a3b8;margin:0;border-left:3px solid #e2e8f0;margin-left:12px;">ຍັງບໍ່ມີຂໍ້ມູນ</p>
    @endif

</div>
@endforeach
