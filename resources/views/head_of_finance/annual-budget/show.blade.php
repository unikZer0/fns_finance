@extends('layouts.admin')

@section('title', 'ແຜນງົບປະມານ ' . $annualBudget->fiscal_year)
@section('page-title', 'ແຜນງົບປະມານປະຈຳປີ ' . $annualBudget->fiscal_year)

@section('content')

    {{-- ── Top action bar ──────────────────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.annual-budget.index') }}"
                class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                ກັບຄືນ
            </a>
            @php
                $statusMap = [
                    'draft' => ['label' => 'ຮ່າງ', 'class' => 'bg-gray-100 text-gray-700'],
                    'submitted' => ['label' => 'ສົ່ງແລ້ວ', 'class' => 'bg-yellow-100 text-yellow-700'],
                    'approved' => ['label' => 'ອະນຸມັດ', 'class' => 'bg-green-100 text-green-700'],
                ];
                $s = $statusMap[$annualBudget->status] ?? ['label' => $annualBudget->status, 'class' => 'bg-gray-100 text-gray-700'];
            @endphp
            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $s['class'] }}">{{ $s['label'] }}</span>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('head_of_finance.annual-budget.preview', $annualBudget) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                ພາບລວມ
            </a>
            <a href="{{ route('head_of_finance.annual-budget.edit', $annualBudget) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600">
                ແກ້ໄຂ
            </a>
        </div>
    </div>

    {{-- ── Budget Table (matches image layout) ────────────────────────────── --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden" id="budget-table-wrapper">

        {{-- Document Header --}}
        <div class="text-center py-4 border-b border-gray-200">
            <p class="text-xs text-gray-500">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
            <p class="text-xs text-gray-500">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</p>
            <p class="text-sm font-bold mt-2">ແຜນງົບປະມານປະຈຳປີ {{ $annualBudget->fiscal_year }}</p>
        </div>

        @php
            $totalRegular = 0;
            $totalAcademic = 0;
            foreach ($annualBudget->lineItems as $item) {
                if (str_ends_with($item->account->formatted_code ?? '', '-00-00-00')) {
                    $totalRegular += $item->amount_regular ?? 0;
                    $totalAcademic += $item->amount_academic ?? 0;
                }
            }
            $totalLuam = $totalRegular + $totalAcademic; // ແຜນລວມ = ປົກກະຕິ + ວິຊາການ
        @endphp

        {{-- Main Budget Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-orange-400 text-white text-center">
                        <th class="border border-orange-300 px-3 py-2 w-32">ພາກ.ພາກສ່ວນ.</th>
                        <th class="border border-orange-300 px-3 py-2">ເນື້ອໃນ</th>
                        <th colspan="3" class="border border-orange-300 px-3 py-2">ແຜນປີ {{ $annualBudget->fiscal_year }}
                        </th>
                        <th rowspan="2" class="border border-orange-300 px-3 py-2 w-24">ການດໍາ<br>ເນີນງານ</th>
                    </tr>
                    <tr class="bg-orange-400 text-white text-center">
                        <th class="border border-orange-300 px-3 py-2 text-xs">ຮ່ວງ.ລູກຮ່ວງ</th>
                        <th class="border border-orange-300 px-3 py-2">ລາຍການຈ່າຍ</th>
                        <th class="border border-orange-300 px-3 py-2 text-xs font-bold">ແຜນລວມ<br><span
                                class="font-normal">(6)</span></th>
                        <th class="border border-orange-300 px-3 py-2 text-xs">ງົບປະມານ<br>ປົກກະຕິ (7)</th>
                        <th class="border border-orange-300 px-3 py-2 text-xs">ງົບປະມານ<br>ວິຊາການ (8=6-7)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($annualBudget->lineItems as $item)
                        @php
                            $isHeader = str_ends_with($item->account->formatted_code ?? '', '-00-00');
                            $itemLuam = ($item->amount_regular ?? 0) + ($item->amount_academic ?? 0);
                        @endphp
                        <tr class="{{ $isHeader ? 'bg-blue-50 font-semibold' : 'bg-white hover:bg-gray-50' }}">
                            <td
                                class="border border-gray-200 px-3 py-2 font-mono text-xs text-gray-600 whitespace-nowrap text-center">
                                {{ $item->account->formatted_code ?? '-' }}
                            </td>
                            <td class="border border-gray-200 px-4 py-2 text-gray-800">
                                {{ $item->account->account_name ?? '-' }}
                            </td>
                            {{-- ຄໍ 6: ແຜນລວມ = ປົກກະຕິ + ວິຊາການ --}}
                            <td class="border border-gray-200 px-3 py-2 text-right tabular-nums font-semibold">
                                {{ $itemLuam ? number_format($itemLuam, 2) : '' }}
                            </td>
                            {{-- ຄໍ 7: ງົບປະມານປົກກະຕິ --}}
                            <td class="border border-gray-200 px-3 py-2 text-right tabular-nums">
                                {{ $item->amount_regular ? number_format($item->amount_regular, 2) : '' }}
                                @if (($isHeader || $item->has_children) && ($item->amount_regular ?? 0) > ($item->children_sum_regular ?? 0))
                                    <div class="text-[10px] text-orange-500 font-normal mt-0.5" title="ງົບປະມານຍັງບໍ່ຖືກຈັດສັນຄົບຖ້ວນ">
                                        (ຍັງເຫຼືອ: {{ number_format(($item->amount_regular ?? 0) - ($item->children_sum_regular ?? 0), 2) }})
                                    </div>
                                @endif
                            </td>
                            {{-- ຄໍ 8=6-7: ງົບປະມານວິຊາການ --}}
                            <td class="border border-gray-200 px-3 py-2 text-right tabular-nums">
                                {{ $item->amount_academic ? number_format($item->amount_academic, 2) : '' }}
                                @if (($isHeader || $item->has_children) && ($item->amount_academic ?? 0) > ($item->children_sum_academic ?? 0))
                                    <div class="text-[10px] text-orange-500 font-normal mt-0.5" title="ງົບປະມານຍັງບໍ່ຖືກຈັດສັນຄົບຖ້ວນ">
                                        (ຍັງເຫຼືອ: {{ number_format(($item->amount_academic ?? 0) - ($item->children_sum_academic ?? 0), 2) }})
                                    </div>
                                @endif
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit inline via modal --}}
                                    <button type="button"
                                        onclick="openEditModal({{ $item->id }}, {{ $item->amount_regular ?? 0 }}, {{ $item->amount_academic ?? 0 }})"
                                        class="text-yellow-600 hover:text-yellow-800" title="ແກ້ໄຂ">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form
                                        action="{{ route('head_of_finance.annual-budget.items.destroy', [$annualBudget, $item]) }}"
                                        method="POST" class="inline" onsubmit="return confirm('ລຶບລາຍການນີ້?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="ລຶບ">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">ຍັງບໍ່ມີລາຍການ — ເພີ່ມໂດຍໃຊ້ຟອມລຸ່ມນີ້
                            </td>
                        </tr>
                    @endforelse

                    {{-- Totals row --}}
                    @if ($annualBudget->lineItems->count() > 0)
                        <tr class="bg-orange-100 font-bold">
                            <td colspan="2" class="border border-orange-200 px-4 py-2 text-right">ລວມທັງໝົດ</td>
                            {{-- ຄໍ 6: ແຜນລວມ --}}
                            <td class="border border-orange-200 px-3 py-2 text-right tabular-nums text-blue-800">
                                {{ number_format($totalLuam, 2) }}
                            </td>
                            {{-- ຄໍ 7: ງົບປົກກະຕິ --}}
                            <td class="border border-orange-200 px-3 py-2 text-right tabular-nums text-orange-800">
                                {{ number_format($totalRegular, 2) }}
                            </td>
                            {{-- ຄໍ 8: ງົບວິຊາການ --}}
                            <td class="border border-orange-200 px-3 py-2 text-right tabular-nums text-orange-800">
                                {{ number_format($totalAcademic, 2) }}
                            </td>
                            <td class="border border-orange-200"></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- ── Bulk Add Items Form ─────────────────────────────────────────── --}}
        <div class="p-6 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700">➕ ເພີ່ມລາຍການງົບປະມານ</h3>
                <button type="button" id="addRowBtn"
                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    ເພີ່ມແຖວໃໝ່
                </button>
            </div>

            <form action="{{ route('head_of_finance.annual-budget.items.bulk', $annualBudget) }}" method="POST"
                id="bulkForm">
                @csrf

                {{-- Table header --}}
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm" id="bulkTable">
                        <thead class="bg-gray-100 text-xs text-gray-600 uppercase">
                            <tr>
                                <th class="px-3 py-2 text-left w-8">#</th>
                                <th class="px-3 py-2 text-left">ບັນຊີ (Chart of Account)</th>
                                <th class="px-3 py-2 text-left w-48">ງົບປະມານປົກກະຕິ (ຄໍ 7)</th>
                                <th class="px-3 py-2 text-left w-48">ງົບປະມານວິຊາການ (ຄໍ 8=6-7)</th>
                                <th class="px-3 py-2 w-10"></th>
                            </tr>
                        </thead>
                        <tbody id="bulkRows">
                            {{-- JS will populate rows --}}
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center gap-3 mt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        ບັນທຶກທັງໝົດ
                    </button>
                    <span class="text-xs text-gray-400">ສາມາດເພີ່ມຫຼາຍແຖວ ແລ້ວ Submit ເທື່ອດຽວ</span>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Edit Item Modal ────────────────────────────────────────────────── --}}
    <div id="editItemModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm">
            <h3 class="text-base font-semibold text-gray-800 mb-4">ແກ້ໄຂຈຳນວນເງິນ</h3>
            <form id="editItemForm" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">ງົບທຳມະດາ</label>
                        <input type="number" name="amount_regular" id="edit_regular" min="0" step="0.01"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">ງົບວິຊາການ</label>
                        <input type="number" name="amount_academic" id="edit_academic" min="0" step="0.01"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex gap-3 mt-5">
                    <button type="submit"
                        class="flex-1 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                        ບັນທຶກ
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm">
                        ຍົກເລີກ
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // ── Edit-item modal ────────────────────────────────────────────────────
            const BASE_URL = '{{ url("head-of-finance/annual-budget/" . $annualBudget->id . "/items") }}';

            function openEditModal(itemId, regular, academic) {
                document.getElementById('edit_regular').value = regular;
                document.getElementById('edit_academic').value = academic;
                document.getElementById('editItemForm').action = BASE_URL + '/' + itemId;
                document.getElementById('editItemModal').classList.remove('hidden');
                document.getElementById('editItemModal').classList.add('flex');
            }

            function closeEditModal() {
                document.getElementById('editItemModal').classList.add('hidden');
                document.getElementById('editItemModal').classList.remove('flex');
            }

            document.getElementById('editItemModal').addEventListener('click', function (e) {
                if (e.target === this) closeEditModal();
            });

            // ── Bulk-add dynamic rows ──────────────────────────────────────────────
            // Build the accounts option list once from PHP data
            const allAccounts = @json($accounts->map(fn($a) => ['id' => $a->id, 'code' => $a->formatted_code, 'name' => $a->account_name]));
            const usedIds = new Set(@json($annualBudget->lineItems->pluck('account_id')));

            let rowCount = 0;

            function buildAccountOptions(selectedId = '') {
                let html = '<option value="">-- ເລືອກບັນຊີ --</option>';
                allAccounts.forEach(acc => {
                    const disabled = usedIds.has(acc.id) ? 'disabled' : '';
                    const selected = acc.id == selectedId ? 'selected' : '';
                    html += `<option value="${acc.id}" ${disabled} ${selected}>${acc.code} — ${acc.name}</option>`;
                });
                return html;
            }

            function addRow() {
                const idx = rowCount++;
                const tbody = document.getElementById('bulkRows');
                const tr = document.createElement('tr');
                tr.className = 'border-b border-gray-100 hover:bg-gray-50';
                tr.setAttribute('data-row', idx);
                tr.innerHTML = `
                                <td class="px-3 py-2 text-center text-gray-400 text-xs">${idx + 1}</td>
                                <td class="px-3 py-2">
                                    <select name="items[${idx}][account_id]"
                                            class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-400">
                                        ${buildAccountOptions()}
                                    </select>
                                </td>
                                <td class="px-3 py-2">
                                    <input type="number" name="items[${idx}][amount_regular]"
                                           min="0" step="0.01" placeholder="0.00"
                                           class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-400 text-right">
                                </td>
                                <td class="px-3 py-2">
                                    <input type="number" name="items[${idx}][amount_academic]"
                                           min="0" step="0.01" placeholder="0.00"
                                           class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-400 text-right">
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <button type="button" onclick="removeRow(this)"
                                            class="text-red-400 hover:text-red-600" title="ລຶບແຖວ">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>`;
                tbody.appendChild(tr);
                // Focus the new select
                tr.querySelector('select').focus();
            }

            function removeRow(btn) {
                btn.closest('tr').remove();
            }

            // Wire up the "ເພີ່ມແຖວໃໝ່" button
            document.getElementById('addRowBtn').addEventListener('click', addRow);

            // Start with one empty row
            addRow();

            // Prevent submitting if no rows have an account selected
            document.getElementById('bulkForm').addEventListener('submit', function (e) {
                const rows = document.querySelectorAll('#bulkRows tr');
                const hasValid = Array.from(rows).some(tr => {
                    const sel = tr.querySelector('select');
                    return sel && sel.value;
                });
                if (!hasValid) {
                    e.preventDefault();
                    alert('ກະລຸນາເລືອກບັນຊີຢ່າງໜ້ອຍ 1 ລາຍການ!');
                }
            });
        </script>

        <style>
            @media print {

                #admin-sidebar,
                x-admin-header,
                .no-print,
                form {
                    display: none !important;
                }

                #budget-table-wrapper {
                    box-shadow: none;
                }
            }
        </style>
    @endpush
@endsection
