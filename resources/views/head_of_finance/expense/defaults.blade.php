@extends('layouts.admin')

@section('title', 'ຈັດການ Expense Defaults')
@section('page-title', 'ຈັດການ Expense Defaults')

@section('content')
<div class="space-y-4">

    <div class="bg-white rounded-lg shadow-sm p-4 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.expense.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-bold text-gray-900">ຈັດການ Expense Defaults</h2>
                <p class="text-xs text-gray-500 mt-0.5">ລາຍການເຫຼົ່ານີ້ຈະຖືກໂຫຼດອັດຕະໂນມັດເມື່ອສ້າງແຜນໃໝ່ — ລາກແຖວເພື່ອຈັດລຳດັບ</p>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div id="reorder-toast" class="hidden fixed top-4 right-4 z-50 px-4 py-2 bg-green-600 text-white text-sm rounded-lg shadow-lg transition-opacity">
        ບັນທຶກລຳດັບສຳເລັດ
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
    @endif

    @foreach ($categoryTitles as $cat => $title)
    @php $catId = str_replace('.', '_', $cat); @endphp
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-5 py-3 bg-slate-700 text-white text-sm font-semibold">{{ $title }}</div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead class="bg-slate-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-2 py-2 w-8"></th>
                        <th class="px-3 py-2 text-center w-8">#</th>
                        <th class="px-3 py-2 text-left">ລາຍການ</th>
                        <th class="px-3 py-2 text-center w-20">ອ້າງອີງ</th>
                        <th class="px-3 py-2 text-right w-36">ຕໍ່ເດືອນ / ຄ່າໜ່ວຍ</th>
                        <th class="px-3 py-2 text-right w-20">ຈ/ນ</th>
                        <th class="px-3 py-2 text-right w-36">ລວມ (ກີບ)</th>
                        <th class="px-3 py-2 text-center w-28">ຈັດການ</th>
                    </tr>
                </thead>
                <tbody id="sortable_{{ $catId }}"
                    class="divide-y divide-gray-100"
                    data-reorder-url="{{ route('head_of_finance.expense.defaults.reorder') }}"
                    data-csrf="{{ csrf_token() }}">

                    @forelse ($grouped[$cat] ?? collect() as $d)
                    @php
                        $hasChildren  = $d->children->isNotEmpty();
                        $childrenId   = 'children_' . $d->id;
                        $childrenTotal= $d->children->sum(fn($c) => $c->amount_per_month * $c->num_months);
                        $parentTotal  = $d->amount_per_month * $d->num_months;
                    @endphp

                    {{-- Parent row --}}
                    <tr class="hover:bg-gray-50 select-none {{ $hasChildren ? 'bg-slate-50' : '' }}" data-id="{{ $d->id }}">
                        <td class="px-2 py-2 text-center">
                            <span class="drag-handle cursor-grab text-gray-300 hover:text-gray-500 active:cursor-grabbing">
                                <svg class="w-4 h-4 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="9"  cy="6"  r="1.5"/><circle cx="15" cy="6"  r="1.5"/>
                                    <circle cx="9"  cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                    <circle cx="9"  cy="18" r="1.5"/><circle cx="15" cy="18" r="1.5"/>
                                </svg>
                            </span>
                        </td>
                        <td class="px-3 py-2 text-center text-gray-400 row-num font-medium">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2 text-gray-800 font-medium">
                            <div class="flex items-center gap-1.5">
                                @if ($hasChildren)
                                <button type="button"
                                    onclick="toggleChildren('{{ $childrenId }}')"
                                    id="toggle_{{ $childrenId }}"
                                    class="text-blue-400 hover:text-blue-600 transition-transform"
                                    title="ຂະຫຍາຍ/ຍຸບ ລາຍລະອຽດ">
                                    <svg class="w-3.5 h-3.5 rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                @endif
                                {{ $d->item_name }}
                            </div>
                        </td>
                        <td class="px-3 py-2 text-center text-blue-600 font-semibold">{{ $d->reference }}</td>
                        <td class="px-3 py-2 text-right text-gray-600">{{ number_format($d->amount_per_month, 0, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right text-gray-600">{{ $d->num_months }}</td>
                        <td class="px-3 py-2 text-right font-semibold text-gray-800">
                            {{ number_format($parentTotal, 0, '.', ',') }}
                            @if ($hasChildren && $childrenTotal != $parentTotal)
                            <div class="text-gray-400 font-normal text-[10px]">(ລາຍລະອຽດ: {{ number_format($childrenTotal, 0, '.', ',') }})</div>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button"
                                    onclick="openEditModal({{ $d->id }}, {{ json_encode($d->item_name) }}, {{ json_encode($d->reference) }}, {{ $d->amount_per_month }}, {{ $d->num_months }}, {{ json_encode($d->notes) }}, '{{ route('head_of_finance.expense.defaults.update', $d) }}')"
                                    class="text-blue-500 hover:text-blue-700" title="ແກ້ໄຂ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button type="button"
                                    onclick="openAddSubModal({{ $d->id }}, {{ json_encode($d->reference . ' ' . $d->item_name) }})"
                                    class="text-green-500 hover:text-green-700" title="ເພີ່ມລາຍລະອຽດ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                                <button type="button"
                                    onclick="openDeleteModal('{{ route('head_of_finance.expense.defaults.destroy', $d) }}', '{{ addslashes($d->item_name) }}'{{ $hasChildren ? ', true' : '' }})"
                                    class="text-red-500 hover:text-red-700" title="ລຶບ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Sub-item rows --}}
                    @if ($hasChildren)
                    <tr id="{{ $childrenId }}" class="sub-rows-container">
                        <td colspan="8" class="p-0">
                            <table class="w-full text-xs">
                                <tbody class="divide-y divide-blue-50">
                                @foreach ($d->children as $sub)
                                @php $subTotal = $sub->amount_per_month * $sub->num_months; @endphp
                                <tr class="bg-blue-50/40 hover:bg-blue-50">
                                    <td class="w-8 px-2 py-1.5"></td>
                                    <td class="w-8 px-3 py-1.5 text-center text-blue-300">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-1.5 pl-8 text-gray-600">
                                        <span class="text-blue-300 mr-1">└</span>{{ $sub->item_name }}
                                        @if ($sub->notes)
                                        <span class="ml-1 text-[10px] text-gray-400 italic">({{ $sub->notes }})</span>
                                        @endif
                                    </td>
                                    <td class="w-20 px-3 py-1.5 text-center text-gray-400">{{ $sub->reference }}</td>
                                    <td class="w-36 px-3 py-1.5 text-right text-gray-500">{{ number_format($sub->amount_per_month, 0, '.', ',') }}</td>
                                    <td class="w-20 px-3 py-1.5 text-right text-gray-500">{{ $sub->num_months }}</td>
                                    <td class="w-36 px-3 py-1.5 text-right text-gray-600">{{ number_format($subTotal, 0, '.', ',') }}</td>
                                    <td class="w-28 px-3 py-1.5 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="button"
                                                onclick="openEditModal({{ $sub->id }}, {{ json_encode($sub->item_name) }}, {{ json_encode($sub->reference) }}, {{ $sub->amount_per_month }}, {{ $sub->num_months }}, {{ json_encode($sub->notes) }}, '{{ route('head_of_finance.expense.defaults.update', $sub) }}')"
                                                class="text-blue-400 hover:text-blue-600" title="ແກ້ໄຂ">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                onclick="openDeleteModal('{{ route('head_of_finance.expense.defaults.destroy', $sub) }}', '{{ addslashes($sub->item_name) }}')"
                                                class="text-red-400 hover:text-red-600" title="ລຶບ">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endif

                    @empty
                    <tr class="empty-row">
                        <td colspan="8" class="px-4 py-4 text-center text-gray-400 italic text-xs">ຍັງບໍ່ມີ Default</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Inline add parent form --}}
        <div class="border-t border-gray-200 px-4 py-3 bg-gray-50">
            <form method="POST" action="{{ route('head_of_finance.expense.defaults.store') }}"
                class="flex flex-wrap gap-2 items-end">
                @csrf
                <input type="hidden" name="category_code" value="{{ $cat }}">
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-500">ລາຍການ *</label>
                    <input type="text" name="item_name" required placeholder="ຊື່ລາຍການ"
                        class="px-2 py-1.5 border border-gray-300 rounded text-xs w-48 focus:ring-1 focus:ring-red-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-500">ອ້າງອີງ</label>
                    <input type="text" name="reference" placeholder="2.1.1"
                        class="px-2 py-1.5 border border-gray-300 rounded text-xs w-20 focus:ring-1 focus:ring-red-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-500">ຕໍ່ເດືອນ (ກີບ) *</label>
                    <input type="number" name="amount_per_month" value="0" min="0" required
                        class="px-2 py-1.5 border border-gray-300 rounded text-xs w-32 focus:ring-1 focus:ring-red-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-500">ຈ/ນ ເດືອນ *</label>
                    <input type="number" name="num_months" value="12" min="0" step="0.5" required
                        class="px-2 py-1.5 border border-gray-300 rounded text-xs w-20 focus:ring-1 focus:ring-red-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-500">ໝາຍເຫດ</label>
                    <input type="text" name="notes" placeholder=""
                        class="px-2 py-1.5 border border-gray-300 rounded text-xs w-32 focus:ring-1 focus:ring-red-400">
                </div>
                <div class="flex flex-col justify-end">
                    <button type="submit"
                        class="px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">
                        + ເພີ່ມລາຍການ
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

</div>

{{-- Edit Modal --}}
<div id="editModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:480px;">
        <div class="modal-header" style="padding:20px 24px 16px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;">ແກ້ໄຂ Default</h3>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-body" style="padding:0 24px 20px;display:flex;flex-direction:column;gap:14px;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ຊື່ລາຍການ <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_item_name" name="item_name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ອ້າງອີງ</label>
                        <input type="text" id="edit_reference" name="reference"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ຈ/ນ ເດືອນ <span class="text-red-500">*</span></label>
                        <input type="number" id="edit_num_months" name="num_months" min="0" step="0.5" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ຕໍ່ເດືອນ (ກີບ) <span class="text-red-500">*</span></label>
                    <input type="number" id="edit_amount_per_month" name="amount_per_month" min="0" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ໝາຍເຫດ</label>
                    <input type="text" id="edit_notes" name="notes"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('editModal').style.display='none'" class="btn btn-secondary">ຍົກເລີກ</button>
                <button type="submit" class="btn btn-primary" style="background:#2563eb;">ບັນທຶກ</button>
            </div>
        </form>
    </div>
</div>

{{-- Add Sub-item Modal --}}
<div id="addSubModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:500px;">
        <div class="modal-header" style="padding:20px 24px 16px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;">ເພີ່ມລາຍລະອຽດ</h3>
            <p id="subModalParentLabel" class="text-sm text-blue-600 mt-1"></p>
        </div>
        <form method="POST" action="{{ route('head_of_finance.expense.defaults.store') }}">
            @csrf
            <input type="hidden" id="sub_parent_id" name="parent_id">
            <div class="modal-body" style="padding:0 24px 20px;display:flex;flex-direction:column;gap:14px;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ຊື່ລາຍການ <span class="text-red-500">*</span></label>
                    <input type="text" name="item_name" required placeholder="ຊື່ລາຍການລະອຽດ"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ຄ່າໜ່ວຍ / ຕໍ່ເດືອນ *</label>
                        <input type="number" name="amount_per_month" value="0" min="0" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ຈຳນວນ / ເດືອນ *</label>
                        <input type="number" name="num_months" value="1" min="0" step="0.5" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ໝາຍເຫດ</label>
                    <input type="text" name="notes" placeholder=""
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('addSubModal').style.display='none'" class="btn btn-secondary">ຍົກເລີກ</button>
                <button type="submit" class="btn btn-primary" style="background:#16a34a;">ເພີ່ມ</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div id="deleteModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:400px;">
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;margin-bottom:8px;">ຢືນຢັນການລຶບ</h3>
            <span id="deleteItemName" style="display:inline-block;padding:4px 12px;background:var(--color-danger-bg);color:var(--color-danger-text);font-size:var(--font-size-sm);font-weight:500;border-radius:var(--radius-md);border:1px solid var(--color-danger-border);"></span>
            <p id="deleteChildWarning" class="text-xs text-orange-600 mt-2 hidden">ການລຶບນີ້ຈະລຶບລາຍລະອຽດທັງໝົດພາຍໃຕ້ລາຍການນີ້ດ້ວຍ</p>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
function toggleChildren(id) {
    const el = document.getElementById(id);
    const btn = document.getElementById('toggle_' + id);
    if (!el) return;
    const isHidden = el.classList.toggle('hidden');
    if (btn) {
        btn.querySelector('svg').style.transform = isHidden ? 'rotate(0deg)' : 'rotate(90deg)';
    }
}

function openEditModal(id, itemName, reference, amount, months, notes, url) {
    document.getElementById('edit_item_name').value        = itemName || '';
    document.getElementById('edit_reference').value        = reference || '';
    document.getElementById('edit_amount_per_month').value = amount || 0;
    document.getElementById('edit_num_months').value       = months || 12;
    document.getElementById('edit_notes').value            = notes || '';
    document.getElementById('editForm').action             = url;
    document.getElementById('editModal').style.display     = 'flex';
}

function openAddSubModal(parentId, parentLabel) {
    document.getElementById('sub_parent_id').value         = parentId;
    document.getElementById('subModalParentLabel').textContent = 'ພາຍໃຕ້: ' + parentLabel;
    document.getElementById('addSubModal').style.display   = 'flex';
}

function openDeleteModal(url, name, hasChildren = false) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteItemName').textContent = name;
    const warn = document.getElementById('deleteChildWarning');
    warn.classList.toggle('hidden', !hasChildren);
    document.getElementById('deleteModal').style.display = 'flex';
}

['editModal','deleteModal','addSubModal'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});

let toastTimer;
function showToast(msg, ok = true) {
    const t = document.getElementById('reorder-toast');
    t.textContent = msg;
    t.className = `fixed top-4 right-4 z-50 px-4 py-2 text-white text-sm rounded-lg shadow-lg transition-opacity ${ok ? 'bg-green-600' : 'bg-red-500'}`;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => { t.className += ' opacity-0'; }, 2000);
}

function renumberRows(tbody) {
    let i = 1;
    tbody.querySelectorAll('tr:not(.empty-row):not(.sub-rows-container) .row-num').forEach(cell => { cell.textContent = i++; });
}

document.querySelectorAll('[id^="sortable_"]').forEach(tbody => {
    Sortable.create(tbody, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'bg-blue-50',
        filter: '.sub-rows-container',
        onEnd() {
            renumberRows(tbody);
            const ids = [...tbody.querySelectorAll('tr[data-id]')].map(tr => tr.dataset.id);
            fetch(tbody.dataset.reorderUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': tbody.dataset.csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ items: ids }),
            })
            .then(r => r.ok ? showToast('ບັນທຶກລຳດັບສຳເລັດ') : showToast('ເກີດຂໍ້ຜິດພາດ', false))
            .catch(() => showToast('ເກີດຂໍ້ຜິດພາດ', false));
        },
    });
});
</script>
@endpush
@endsection
