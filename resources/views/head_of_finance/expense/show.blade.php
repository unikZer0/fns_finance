@extends('layouts.admin')

@section('title', 'ລາຍຈ່າຍວິຊາການ ສົກ ' . $plan->fiscal_year)
@section('page-title', 'ລາຍຈ່າຍວິຊາການ ສົກ ' . $plan->fiscal_year)

@php
function fmtE($n) { return number_format((float)$n, 0, '.', ','); }
@endphp

@section('content')
<div class="space-y-4 pb-24">

    {{-- Top bar --}}
    <div class="bg-white rounded-lg shadow-sm p-4 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.expense.index') }}" class="text-gray-500 hover:text-gray-700">
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
            <a href="{{ route('head_of_finance.expense.summary', $plan) }}"
                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 gap-2">
                ເບິ່ງສັງລວມ
            </a>
            <a href="{{ route('head_of_finance.expense.balance', $plan) }}"
                class="inline-flex items-center px-3 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 gap-2">
                ⚖ ດຸ່ນດ່ຽງ
            </a>
            @if ($plan->status === 'DRAFT')
                <button type="button" onclick="document.getElementById('approveModal').style.display='flex'"
                    class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 gap-2">
                    ອະນຸມັດ
                </button>
                <button type="button"
                    onclick="openDeleteModal('{{ route('head_of_finance.expense.destroy', $plan) }}', 'ສົກ {{ $plan->fiscal_year }}')"
                    class="inline-flex items-center px-3 py-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg hover:bg-red-100 gap-2">
                    ລຶບ
                </button>
            @else
                <form method="POST" action="{{ route('head_of_finance.expense.revert_draft', $plan) }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-orange-50 text-orange-600 text-sm font-medium rounded-lg hover:bg-orange-100 gap-2">
                        ຍ້ອນກັບຮ່າງ
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
    @endif

    @if ($plan->status === 'APPROVED')
    <div class="bg-green-50 border border-green-300 rounded-lg px-4 py-3 text-sm text-green-800 flex items-center gap-2">
        ແຜນນີ້ຖືກ<strong class="mx-1">ອະນຸມັດ</strong>ແລ້ວ — ຢູ່ໃນໂໝດອ່ານຢ່າງດຽວ. ກົດ "ຍ້ອນກັບຮ່າງ" ເພື່ອແກ້ໄຂ.
    </div>
    @endif

    {{-- Save-All Form --}}
    <form id="saveAllForm" method="POST" action="{{ route('head_of_finance.expense.save_all', $plan) }}">
        @csrf

        @foreach (array_keys($categoryTitles) as $cat)
        @php
            $catId    = str_replace('.', '_', $cat);
            $items    = $sections[$cat];
            $secTotal = $items->sum(fn($i) => $i->amount_per_month * $i->num_months);
        @endphp

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-5 py-3 bg-slate-700 text-white text-sm font-semibold">
                {{ $categoryTitles[$cat] }}
            </div>

            {{-- Auto-fill banner for 2.5 --}}
            @if ($cat === '2.5' && $plan->status === 'DRAFT')
            <div class="px-4 py-2 bg-amber-50 border-b border-amber-200 flex items-center gap-3">
                <form method="POST" action="{{ route('head_of_finance.expense.auto_fill_25', $plan) }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1 text-xs bg-amber-100 text-amber-700 border border-amber-300 rounded hover:bg-amber-200">
                        ອັດຕະໂນມັດຈາກລາຍຮັບ (ຄ່າສອນ)
                    </button>
                </form>
                <span class="text-xs text-amber-600">ຕັ້ງຄ່າ 2.5.1 ຈາກ kawtIncome × teachingRate ຂອງ Income ສົກ {{ $plan->fiscal_year }}</span>
            </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-xs" id="sec_table_{{ $catId }}">
                    <thead class="bg-slate-100 text-gray-600 uppercase">
                        <tr>
                            <th class="px-3 py-2 text-center w-8">#</th>
                            <th class="px-3 py-2 text-left">ລາຍການ</th>
                            <th class="px-3 py-2 text-center w-20">ອ້າງອີງ</th>
                            <th class="px-3 py-2 text-right w-36">ຕໍ່ເດືອນ (ກີບ)</th>
                            <th class="px-3 py-2 text-right w-24">ຈ/ນ ເດືອນ</th>
                            <th class="px-3 py-2 text-right w-36">ໝົດປີ (ກີບ)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($items as $item)
                        @php
                            $hasChildren = $item->children->isNotEmpty();
                            $rowTotal    = $item->amount_per_month * $item->num_months;
                            $childrenId  = 'ci_' . $item->id;
                        @endphp

                        {{-- Parent row --}}
                        <tr class="hover:bg-gray-50 {{ $hasChildren ? 'bg-slate-50/60' : '' }}"
                            data-id="{{ $item->id }}"
                            data-section="{{ $catId }}"
                            data-has-children="{{ $hasChildren ? 'true' : 'false' }}">
                            <td class="px-3 py-1.5 text-center text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-3 py-1.5 text-gray-800 font-medium">
                                <div class="flex items-center gap-1.5">
                                    @if ($hasChildren)
                                    <button type="button"
                                        onclick="toggleChildren('{{ $childrenId }}')"
                                        id="toggle_{{ $childrenId }}"
                                        class="text-blue-400 hover:text-blue-600 flex-shrink-0"
                                        title="ຂະຫຍາຍ/ຍຸບ">
                                        <svg class="w-3.5 h-3.5 rotate-90 transition-transform duration-150" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    @endif
                                    {{ $item->item_name }}
                                </div>
                            </td>
                            <td class="px-3 py-1.5 text-center text-blue-600 font-semibold text-xs">{{ $item->reference }}</td>

                            @if ($hasChildren)
                            {{-- Parent with children: display computed total (no editable inputs) --}}
                            <td class="px-3 py-1.5 text-right text-gray-400 italic text-xs" colspan="2">
                                (ລວມຈາກລາຍລະອຽດ)
                            </td>
                            <td class="px-3 py-1.5 text-right font-semibold text-gray-800"
                                id="row_total_{{ $item->id }}" data-v="{{ $rowTotal }}">
                                {{ fmtE($rowTotal) }}
                            </td>
                            @else
                            {{-- Parent without children: editable inputs --}}
                            <td class="px-2 py-1.5 text-right">
                                <input type="number" min="0" step="1"
                                    name="items[{{ $item->id }}][amount_per_month]"
                                    value="{{ $item->amount_per_month }}"
                                    oninput="calcRow({{ $item->id }})"
                                    class="w-36 px-2 py-1 border border-gray-300 rounded text-right text-xs focus:ring-1 focus:ring-red-400">
                            </td>
                            <td class="px-2 py-1.5 text-right">
                                <input type="number" min="0" step="0.5"
                                    name="items[{{ $item->id }}][num_months]"
                                    value="{{ $item->num_months }}"
                                    oninput="calcRow({{ $item->id }})"
                                    class="w-20 px-2 py-1 border border-gray-300 rounded text-right text-xs focus:ring-1 focus:ring-red-400">
                            </td>
                            <td class="px-3 py-1.5 text-right font-medium"
                                id="row_total_{{ $item->id }}" data-v="{{ $rowTotal }}">
                                {{ fmtE($rowTotal) }}
                            </td>
                            @endif
                        </tr>

                        {{-- Sub-item rows (collapsible) --}}
                        @if ($hasChildren)
                        <tr id="{{ $childrenId }}" class="children-container">
                            <td colspan="6" class="p-0">
                                <table class="w-full text-xs">
                                    <tbody class="divide-y divide-blue-50">
                                    @foreach ($item->children as $child)
                                    @php $childTotal = $child->amount_per_month * $child->num_months; @endphp
                                    <tr class="bg-blue-50/30 hover:bg-blue-50/60"
                                        data-id="{{ $child->id }}"
                                        data-parent-id="{{ $item->id }}"
                                        data-section="{{ $catId }}">
                                        <td class="w-8 px-3 py-1 text-center text-blue-200">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-1 pl-8 text-gray-600">
                                            <span class="text-blue-300 mr-1">└</span>{{ $child->item_name }}
                                            @if ($child->notes)
                                            <span class="ml-1 text-[10px] text-gray-400 italic">({{ $child->notes }})</span>
                                            @endif
                                        </td>
                                        <td class="w-20 px-3 py-1 text-center text-gray-400">{{ $child->reference }}</td>
                                        <td class="w-36 px-2 py-1 text-right">
                                            <input type="number" min="0" step="1"
                                                name="items[{{ $child->id }}][amount_per_month]"
                                                value="{{ $child->amount_per_month }}"
                                                oninput="calcChild({{ $child->id }}, {{ $item->id }})"
                                                class="w-32 px-2 py-0.5 border border-blue-200 rounded text-right text-xs focus:ring-1 focus:ring-blue-400 bg-white">
                                        </td>
                                        <td class="w-24 px-2 py-1 text-right">
                                            <input type="number" min="0" step="0.5"
                                                name="items[{{ $child->id }}][num_months]"
                                                value="{{ $child->num_months }}"
                                                oninput="calcChild({{ $child->id }}, {{ $item->id }})"
                                                class="w-16 px-2 py-0.5 border border-blue-200 rounded text-right text-xs focus:ring-1 focus:ring-blue-400 bg-white">
                                        </td>
                                        <td class="w-36 px-3 py-1 text-right text-gray-600"
                                            id="row_total_{{ $child->id }}" data-v="{{ $childTotal }}">
                                            {{ fmtE($childTotal) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic text-xs">ຍັງບໍ່ມີລາຍການ</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if ($items->count() > 0)
                    <tfoot>
                        <tr class="bg-slate-50 font-semibold text-xs">
                            <td colspan="5" class="px-3 py-2 text-right text-gray-700">ລວມ</td>
                            <td class="px-3 py-2 text-right text-red-700"
                                id="sec_total_{{ $catId }}" data-v="{{ $secTotal }}">
                                {{ fmtE($secTotal) }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
        @endforeach

    </form>

</div>

{{-- Floating Save --}}
@if ($plan->status === 'DRAFT')
<div class="fixed bottom-6 right-6 z-50">
    <button type="submit" form="saveAllForm"
        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:bg-red-700 active:scale-95 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        ບັນທຶກ
    </button>
</div>
@endif

{{-- Approve Modal --}}
<div id="approveModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:420px;">
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;margin-bottom:8px;">ຢືນຢັນການອະນຸມັດ</h3>
            <p style="font-size:var(--font-size-base);color:var(--color-text-secondary);">ອະນຸມັດແຜນລາຍຈ່າຍ ສົກ <strong>{{ $plan->fiscal_year }}</strong>?</p>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="document.getElementById('approveModal').style.display='none'" class="btn btn-secondary">ຍົກເລີກ</button>
            <form method="POST" action="{{ route('head_of_finance.expense.approve', $plan) }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn btn-primary" style="background:#16a34a;">ອະນຸມັດ</button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div id="deleteModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:400px;">
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;margin-bottom:8px;">ຢືນຢັນການລຶບ</h3>
            <span id="deleteItemName" style="display:inline-block;padding:4px 12px;background:var(--color-danger-bg);color:var(--color-danger-text);font-size:var(--font-size-sm);font-weight:500;border-radius:var(--radius-md);border:1px solid var(--color-danger-border);"></span>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" class="btn btn-secondary">ຍົກເລີກ</button>
            <form id="deleteForm" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">ລຶບ</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function fmtJS(n) {
    if (isNaN(n) || n === 0) return '0';
    return new Intl.NumberFormat().format(Math.round(n));
}

function toggleChildren(id) {
    const el  = document.getElementById(id);
    const btn = document.getElementById('toggle_' + id);
    if (!el) return;
    const isHidden = el.classList.toggle('hidden');
    if (btn) {
        btn.querySelector('svg').style.transform = isHidden ? 'rotate(0deg)' : 'rotate(90deg)';
    }
}

// Called when a leaf (no-children parent) row changes
function calcRow(id) {
    const tr = document.querySelector(`tr[data-id="${id}"][data-has-children="false"]`);
    if (!tr) return;
    const section = tr.dataset.section;
    const amt    = parseFloat(tr.querySelector(`[name="items[${id}][amount_per_month]"]`)?.value) || 0;
    const months = parseFloat(tr.querySelector(`[name="items[${id}][num_months]"]`)?.value)       || 0;
    const total  = amt * months;
    const cell = document.getElementById(`row_total_${id}`);
    if (cell) { cell.textContent = fmtJS(total); cell.dataset.v = total; }
    calcSectionTotal(section);
}

// Called when a sub-item (child) row changes
function calcChild(childId, parentId) {
    // Recalc child total
    const tr   = document.querySelector(`tr[data-id="${childId}"]`);
    if (!tr) return;
    const amt    = parseFloat(tr.querySelector(`[name="items[${childId}][amount_per_month]"]`)?.value) || 0;
    const months = parseFloat(tr.querySelector(`[name="items[${childId}][num_months]"]`)?.value)       || 0;
    const total  = amt * months;
    const cell = document.getElementById(`row_total_${childId}`);
    if (cell) { cell.textContent = fmtJS(total); cell.dataset.v = total; }

    // Recompute parent total from all its children
    let parentTotal = 0;
    document.querySelectorAll(`tr[data-parent-id="${parentId}"]`).forEach(childTr => {
        parentTotal += parseFloat(document.getElementById(`row_total_${childTr.dataset.id}`)?.dataset.v || 0);
    });
    const parentCell = document.getElementById(`row_total_${parentId}`);
    if (parentCell) { parentCell.textContent = fmtJS(parentTotal); parentCell.dataset.v = parentTotal; }

    // Recompute section total
    const section = tr.dataset.section;
    calcSectionTotal(section);
}

function calcSectionTotal(sectionId) {
    let total = 0;
    // Only count parent rows (not child rows)
    document.querySelectorAll(`tr[data-section="${sectionId}"][data-id]`).forEach(tr => {
        // Skip if this is a child row (has data-parent-id)
        if (tr.dataset.parentId) return;
        const id = tr.dataset.id;
        total += parseFloat(document.getElementById(`row_total_${id}`)?.dataset.v || 0);
    });
    const cell = document.getElementById(`sec_total_${sectionId}`);
    if (cell) { cell.textContent = fmtJS(total); cell.dataset.v = total; }
}

function openDeleteModal(url, name) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteModal').style.display = 'flex';
}

@if ($plan->status === 'APPROVED')
document.querySelectorAll('#saveAllForm input').forEach(el => {
    el.disabled = true;
    el.classList.add('bg-gray-50', 'cursor-not-allowed');
});
@endif

['approveModal','deleteModal'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>
@endpush
@endsection
