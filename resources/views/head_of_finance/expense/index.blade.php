@extends('layouts.admin')

@section('title', 'ລາຍຈ່າຍວິຊາການ')
@section('page-title', 'ລາຍຈ່າຍວິຊາການ')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg shadow-sm p-4 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-lg font-bold text-gray-900">ແຜນລາຍຈ່າຍວິຊາການທັງໝົດ</h2>
        <div class="flex gap-2">
            <a href="{{ route('head_of_finance.expense.defaults') }}"
                class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 gap-2">
                ຈັດການ Defaults
            </a>
            <button type="button" onclick="document.getElementById('createModal').style.display='flex'"
                class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 gap-2">
                + ສ້າງແຜນໃໝ່
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-600 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-center w-10">#</th>
                    <th class="px-4 py-3 text-left">ສົກສຶກສາ</th>
                    <th class="px-4 py-3 text-center">ຈຳນວນລາຍການ</th>
                    <th class="px-4 py-3 text-left">ສ້າງໂດຍ</th>
                    <th class="px-4 py-3 text-center">ສະຖານະ</th>
                    <th class="px-4 py-3 text-center">ການດຳເນີນການ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($plans as $plan)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-center text-gray-400">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $plan->fiscal_year }}</td>
                    <td class="px-4 py-3 text-center text-gray-600">{{ $plan->items_count ?? $plan->items()->count() }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $plan->creator?->full_name ?? '-' }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-0.5 rounded text-xs font-semibold
                            {{ $plan->status === 'APPROVED' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $plan->status === 'APPROVED' ? 'ອະນຸມັດແລ້ວ' : 'ຮ່າງ' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('head_of_finance.expense.summary', $plan) }}"
                                class="text-blue-600 hover:text-blue-800 text-xs font-medium">ສັງລວມ</a>
                            <a href="{{ route('head_of_finance.expense.show', $plan) }}"
                                class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">ແກ້ໄຂ</a>
                            @if ($plan->status === 'DRAFT')
                            <button type="button"
                                onclick="openDeleteModal('{{ route('head_of_finance.expense.destroy', $plan) }}', 'ສົກ {{ $plan->fiscal_year }}')"
                                class="text-red-500 hover:text-red-700 text-xs font-medium">ລຶບ</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400 italic">ຍັງບໍ່ມີແຜນ — ກົດ "ສ້າງແຜນໃໝ່" ເພື່ອເລີ່ມ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- Create Modal --}}
<div id="createModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:380px;">
        <div class="modal-header" style="padding:20px 24px 16px;">
            <h3 style="font-size:var(--font-size-lg);font-weight:600;">ສ້າງແຜນລາຍຈ່າຍໃໝ່</h3>
        </div>
        <form method="POST" action="{{ route('head_of_finance.expense.store') }}">
            @csrf
            <div class="modal-body" style="padding:0 24px 20px;">
                <label class="block text-sm font-medium text-gray-700 mb-1">ສົກສຶກສາ <span class="text-red-500">*</span></label>
                <input type="number" name="fiscal_year" min="2020" max="2099"
                    value="{{ date('Y') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-red-500">
                @error('fiscal_year')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('createModal').style.display='none'"
                    class="btn btn-secondary">ຍົກເລີກ</button>
                <button type="submit" class="btn btn-primary" style="background:#dc2626;">ສ້າງ</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div id="deleteModal" class="modal-overlay" style="display:none;">
    <div class="modal" style="max-width:400px;">
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <div style="width:48px;height:48px;border-radius:50%;background:var(--color-danger-bg);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg style="width:24px;height:24px;color:#DC2626" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
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
function openDeleteModal(url, name) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteModal').style.display = 'flex';
}
['createModal','deleteModal'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>
@endpush
@endsection
