@extends('layouts.admin')

@section('title', 'ຈັດການ Defaults — ແຜນເງິນເດືອນ')
@section('page-title', 'ຈັດການ Defaults ແຜນເງິນເດືອນ')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg shadow-sm p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.salary.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-base font-semibold text-gray-800">ຈັດການ Default ລາຍການ</h2>
                <p class="text-xs text-gray-500">ລາຍການເຫຼົ່ານີ້ຈະຖືກສຳເນົາໃສ່ທຸກແຜນໃໝ່ທີ່ສ້າງ</p>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ $errors->first() }}</div>
    @endif

    {{-- Add new default form --}}
    <div class="bg-white rounded-lg shadow-sm p-4">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">+ ເພີ່ມລາຍການໃໝ່</h3>
        <form method="POST" action="{{ route('head_of_finance.salary.defaults.store') }}"
              class="flex flex-wrap items-end gap-3">
            @csrf

            {{-- Section from chart_of_accounts --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1">ໝວດ (Section)</label>
                <select name="section_coa" id="section-select" required
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- ເລືອກໝວດ --</option>
                    @foreach ($sectionAccounts as $sec)
                    <option value="{{ $sec->account_code }}">{{ $sec->account_code }} — {{ $sec->account_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Account code: select (when section has children) or text (fallback) --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1">ສາລະບານ (ລຮ)</label>
                <select id="account-select" name="account_code"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-72 focus:outline-none focus:ring-2 focus:ring-blue-500 hidden"
                    disabled>
                    <option value="">-- ເລືອກ ລຮ --</option>
                </select>
                <input type="text" id="account-text" name="account_code"
                    placeholder="ເຊັ່ນ: 61.30.01"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-40 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    disabled>
            </div>

            {{-- Item name (auto-filled from account selection) --}}
            <div class="flex-1 min-w-64">
                <label class="block text-xs text-gray-500 mb-1">ຊື່ລາຍການ</label>
                <input type="text" name="item_name" id="item-name-input"
                    placeholder="ເນື້ອໃນ (ຈະຕື່ມໃຫ້ອັດຕະໂນມັດ)"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                ເພີ່ມ
            </button>
        </form>
    </div>

    {{-- Defaults grouped by section (driven by actual data + chart_of_accounts labels) --}}
    @forelse ($grouped as $secCode => $items)
    @php $secLabel = $sectionIndex[$secCode]?->account_name ?? $secCode; @endphp
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-4 py-2.5 {{ str_starts_with($secCode,'60') ? 'bg-blue-700' : 'bg-indigo-700' }} text-white text-sm font-semibold flex items-center justify-between">
            <span>{{ $secCode }} — {{ $secLabel }}</span>
            <span class="text-xs font-normal opacity-75">{{ $items->count() }} ລາຍການ</span>
        </div>
        @if ($items->isEmpty())
        <div class="px-4 py-4 text-center text-gray-400 text-sm">ຍັງບໍ່ມີລາຍການ</div>
        @else
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500">
                    <th class="px-4 py-2 text-left w-28">ສາລະບານ</th>
                    <th class="px-4 py-2 text-left">ຊື່ລາຍການ</th>
                    <th class="px-4 py-2 text-right w-32">ດຳເນີນການ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($items as $item)
                <tr class="hover:bg-gray-50 group" id="default-row-{{ $item->id }}">
                    {{-- View mode --}}
                    <td class="px-4 py-2 text-gray-500 text-xs font-mono view-mode-{{ $item->id }}">{{ $item->account_code }}</td>
                    <td class="px-4 py-2 text-gray-800 view-mode-{{ $item->id }}">{{ $item->item_name }}</td>
                    <td class="px-4 py-2 text-right view-mode-{{ $item->id }}">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button type="button" onclick="startEdit({{ $item->id }})"
                                class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded hover:bg-gray-200">
                                ແກ້ໄຂ
                            </button>
                            <form method="POST" action="{{ route('head_of_finance.salary.defaults.destroy', $item) }}"
                                onsubmit="return confirm('ລຶບ Default ນີ້ ແທ້ ບໍ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100">
                                    ລຶບ
                                </button>
                            </form>
                        </div>
                    </td>

                    {{-- Edit mode (hidden by default) --}}
                    <td colspan="3" class="px-4 py-2 hidden edit-mode-{{ $item->id }}">
                        <form method="POST" action="{{ route('head_of_finance.salary.defaults.update', $item) }}"
                              class="flex items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="text" name="account_code" value="{{ $item->account_code }}"
                                class="border border-gray-300 rounded px-2 py-1 text-xs w-28 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <input type="text" name="item_name" value="{{ $item->item_name }}"
                                class="border border-gray-300 rounded px-2 py-1 text-xs flex-1 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <button type="submit"
                                class="text-xs px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">ບັນທຶກ</button>
                            <button type="button" onclick="cancelEdit({{ $item->id }})"
                                class="text-xs px-3 py-1 bg-gray-100 text-gray-600 rounded hover:bg-gray-200">ຍົກເລີກ</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @empty
    <div class="bg-white rounded-lg shadow-sm px-4 py-8 text-center text-gray-400">ຍັງບໍ່ມີ Default ລາຍການ — ເພີ່ມດ້ານເທິງ</div>
    @endforelse

</div>

<script>
// ── Inline edit helpers ──────────────────────────────────────────────
function startEdit(id) {
    document.querySelectorAll(`.view-mode-${id}`).forEach(el => el.classList.add('hidden'));
    document.querySelectorAll(`.edit-mode-${id}`).forEach(el => el.classList.remove('hidden'));
}
function cancelEdit(id) {
    document.querySelectorAll(`.view-mode-${id}`).forEach(el => el.classList.remove('hidden'));
    document.querySelectorAll(`.edit-mode-${id}`).forEach(el => el.classList.add('hidden'));
}

// ── Add-form cascading: Section → Account ────────────────────────────
const accountsBySection = @json(
    $sectionAccounts->mapWithKeys(fn($s) => [
        $s->account_code => $s->children->map(fn($c) => [
            'code' => $c->account_code,
            'name' => $c->account_name,
        ])->values()
    ])
);

const sectionSel   = document.getElementById('section-select');
const accountSel   = document.getElementById('account-select');
const accountTxt   = document.getElementById('account-text');
const itemNameInp  = document.getElementById('item-name-input');

function showAccountSelect(children) {
    accountSel.innerHTML = '<option value="">-- ເລືອກ ລຮ --</option>';
    children.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.code;
        opt.textContent = c.code + ' — ' + c.name;
        opt.dataset.name = c.name;
        accountSel.appendChild(opt);
    });
    accountSel.classList.remove('hidden');
    accountSel.disabled = false;
    accountSel.required = true;
    accountTxt.classList.add('hidden');
    accountTxt.disabled = true;
    accountTxt.required = false;
    accountTxt.value = '';
}

function showAccountText() {
    accountSel.classList.add('hidden');
    accountSel.disabled = true;
    accountSel.required = false;
    accountTxt.classList.remove('hidden');
    accountTxt.disabled = false;
    accountTxt.required = true;
    accountTxt.value = '';
}

sectionSel.addEventListener('change', function () {
    const children = accountsBySection[this.value] || [];
    itemNameInp.value = '';
    if (children.length > 0) {
        showAccountSelect(children);
    } else {
        showAccountText();
    }
});

accountSel.addEventListener('change', function () {
    const sel = this.options[this.selectedIndex];
    if (sel && sel.dataset.name) itemNameInp.value = sel.dataset.name;
});
</script>
@endsection
