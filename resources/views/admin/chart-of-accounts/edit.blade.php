@extends('layouts.admin')

@section('title', 'แก้ไขบัญชี')
@section('page-title', 'แก้ไขข้อมูลบัญชี')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">ข้อมูลบัญชี</h2>
        </div>

        <form action="{{ route('admin.chart-of-accounts.update', $chartOfAccount) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Account Code -->
            <div>
                <label for="account_code" class="block text-sm font-medium text-gray-700 mb-2">
                    รหัสบัญชี <span class="text-red-500">*</span>
                </label>
                <input type="text" name="account_code" id="account_code" value="{{ old('account_code', $chartOfAccount->account_code) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('account_code') border-red-500 @enderror font-mono"
                    placeholder="กรอกรหัสบัญชี">
                @error('account_code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Name -->
            <div>
                <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">
                    ชื่อบัญชี <span class="text-red-500">*</span>
                </label>
                <input type="text" name="account_name" id="account_name" value="{{ old('account_name', $chartOfAccount->account_name) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('account_name') border-red-500 @enderror"
                    placeholder="กรอกชื่อบัญชี">
                @error('account_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.chart-of-accounts.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    ยกเลิก
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    บันทึก
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
