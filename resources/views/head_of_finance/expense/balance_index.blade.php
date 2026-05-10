@extends('layouts.admin')

@section('title', 'ດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ')
@section('page-title', 'ດຸ່ນດ່ຽງລາຍຮັບ-ລາຍຈ່າຍ')

@section('content')
<div class="space-y-4">

    <div class="bg-white rounded-lg shadow-sm p-4">
        <h2 class="text-base font-semibold text-gray-700 mb-1">ເລືອກສົກຮຽນເພື່ອເບິ່ງດຸ່ນດ່ຽງ</h2>
        <p class="text-sm text-gray-500">ຕ້ອງການທັງແຜນລາຍຮັບ ແລະ ແຜນລາຍຈ່າຍ ຂອງສົກດຽວກັນ</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-gray-600 font-semibold">ສົກຮຽນ</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold">ແຜນລາຍຮັບ</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold">ແຜນລາຍຈ່າຍ</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-semibold">ດຳເນີນການ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($expensePlans as $ep)
                @php
                    $incomeStatus = $incomeMap[$ep->fiscal_year] ?? null;
                    $canView = $incomeStatus !== null;
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-semibold text-gray-800">ສົກ {{ $ep->fiscal_year }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($incomeStatus)
                            <span class="px-2 py-0.5 rounded text-xs font-semibold
                                {{ $incomeStatus === 'APPROVED' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $incomeStatus === 'APPROVED' ? 'ອະນຸມັດ' : 'ຮ່າງ' }}
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-500">ບໍ່ມີ</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-0.5 rounded text-xs font-semibold
                            {{ $ep->status === 'APPROVED' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $ep->status === 'APPROVED' ? 'ອະນຸມັດ' : 'ຮ່າງ' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        @if ($canView)
                            <a href="{{ route('head_of_finance.expense.balance', $ep) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-teal-600 text-white text-xs font-medium rounded-lg hover:bg-teal-700 gap-1">
                                ⚖ ເບິ່ງດຸ່ນດ່ຽງ
                            </a>
                        @else
                            <span class="text-xs text-gray-400">ຕ້ອງການແຜນລາຍຮັບ</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">ຍັງບໍ່ມີແຜນລາຍຈ່າຍ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
