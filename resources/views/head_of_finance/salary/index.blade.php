@extends('layouts.admin')

@section('title', 'ແຜນເງິນເດືອນ')
@section('page-title', 'ແຜນເງິນເດືອນ ແລະ ນະໂຍບາຍ')

@section('content')
<div class="space-y-4">

    {{-- Create form --}}
    <div class="bg-white rounded-lg shadow-sm p-4 flex flex-wrap items-start justify-between gap-4">
        <form method="POST" action="{{ route('head_of_finance.salary.store') }}" class="flex items-end gap-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ສ້າງແຜນໃໝ່ — ສົກຮຽນ</label>
                <input type="number" name="fiscal_year" placeholder="ເຊັ່ນ: 2026"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-36 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    min="2000" max="9999" required>
            </div>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                + ສ້າງ
            </button>
        </form>
        @error('fiscal_year')
            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
        @enderror
        <a href="{{ route('head_of_finance.salary.defaults') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 gap-2 self-start mt-5">
            ⚙ ຈັດການ Defaults
        </a>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-gray-600 font-semibold">ສົກຮຽນ</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold">ສະຖານະ</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold">ຜູ້ສ້າງ</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-semibold">ດຳເນີນການ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($plans as $plan)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-semibold text-gray-800">ສົກ {{ $plan->fiscal_year }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-0.5 rounded text-xs font-semibold
                            {{ $plan->status === 'APPROVED' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $plan->status === 'APPROVED' ? 'ອະນຸມັດ' : 'ຮ່າງ' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-500 text-xs">{{ $plan->creator?->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('head_of_finance.salary.show', $plan) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700">
                                ເບິ່ງ / ແກ້ໄຂ
                            </a>
                            @if ($plan->status === 'DRAFT')
                            <form method="POST" action="{{ route('head_of_finance.salary.destroy', $plan) }}"
                                onsubmit="return confirm('ລຶບແຜນ ສົກ {{ $plan->fiscal_year }} ແທ້ ບໍ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-xs font-medium rounded-lg hover:bg-red-100">
                                    ລຶບ
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">ຍັງບໍ່ມີແຜນ — ສ້າງໃໝ່ດ້ານເທິງ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
