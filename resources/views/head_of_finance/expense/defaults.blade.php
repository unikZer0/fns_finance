@extends('layouts.admin')

@section('title', 'Expense Defaults')
@section('page-title', 'Expense Defaults')

@section('content')
<div class="space-y-4">

    <div class="bg-white rounded-lg shadow-sm p-4 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('head_of_finance.expense.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-900">ຈັດການ Expense Defaults</h2>
        </div>
        <button type="button" onclick="document.getElementById('addModal').style.display='flex'"
            class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 gap-2">
            + ເພີ່ມ Default
        </button>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    @foreach ($categoryTitles as $cat => $title)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-5 py-3 bg-slate-700 text-white text-sm font-semibold">{{ $title }}</div>
        <table class="w-full text-xs">
            <thead class="bg-slate-100 text-gray-600 uppercase">
                <tr>
                    <th class="px-3 py-2 text-center w-8">#</th>
                    <th class="px-3 py-2 text-left">ລາຍການ</th>
                    <th class="px-3 py-2 text-center">ອ້າງອີງ</th>
                    <th class="px-3 py-2 text-right">ຕໍ່ເດືອນ</th>
                    <th class="px-3 py-2 text-right">ຈ/ນ ເດືອນ</th>
                    <th class="px-3 py-2 text-right">ໝົດປີ</th>
                    <th class="px-3 py-2 text-center w-16"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($grouped[$cat] ?? collect() as $d)
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-1.5 text-center text-gray-400">{{ $loop->iteration }}</td>
                    <td class="px-3 py-1.5 text-gray-800">{{ $d->item_name }}</td>
                    <td class="px-3 py-1.5 text-center text-gray-400">{{ $d->reference }}</td>
                    <td class="px-3 py-1.5 text-right">{{ number_format($d->amount_per_month, 0, '.', ',') }}</td>
                    <td class="px-3 py-1.5 text-right">{{ $d->num_months }}</td>
                    <td class="px-3 py-1.5 text-right font-medium">{{ number_format($d->amount_per_month * $d->num_months, 0, '.', ',') }}</td>
                    <td class="px-3 py-1.5 text-center">
                        <form method="POST" action="{{ route('head_of_finance.expense.defaults.destroy', $d) }}" style="margin:0;"
                            onsubmit="return confirm('ລຶບ Default ນີ້?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs">ລຶບ</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-4 text-center text-gray-400 italic text-xs">ຍັງບໍ່ມີ Default</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endforeach

</div>

{{-- Add Modal --}}
<div id="addModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:480px;">
        <div class="modal-header" style="padding:20px 24px 16px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;">ເພີ່ມ Default ໃໝ່</h3>
        </div>
        <form method="POST" action="{{ route('head_of_finance.expense.defaults.store') }}">
            @csrf
            <div class="modal-body" style="padding:0 24px 20px;display:flex;flex-direction:column;gap:14px;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ໝວດ <span class="text-red-500">*</span></label>
                    <select name="category_code" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        @foreach ($categoryTitles as $cat => $title)
                        <option value="{{ $cat }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ຊື່ລາຍການ <span class="text-red-500">*</span></label>
                    <input type="text" name="item_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ອ້າງອີງ</label>
                        <input type="text" name="reference" placeholder="2.1.1" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ຈ/ນ ເດືອນ <span class="text-red-500">*</span></label>
                        <input type="number" name="num_months" value="12" min="0" step="0.5" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ຕໍ່ເດືອນ (ກີບ) <span class="text-red-500">*</span></label>
                    <input type="number" name="amount_per_month" value="0" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ໝາຍເຫດ</label>
                    <input type="text" name="notes" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('addModal').style.display='none'" class="btn btn-secondary">ຍົກເລີກ</button>
                <button type="submit" class="btn btn-primary" style="background:#dc2626;">ເພີ່ມ</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('addModal')?.addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>
@endpush
@endsection
