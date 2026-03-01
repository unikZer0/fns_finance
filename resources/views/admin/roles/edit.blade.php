@extends('layouts.admin')

@section('title', 'แก้ไขบทบาท')
@section('page-title', 'แก้ไขข้อมูลบทบาท')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">ข้อมูลบทบาท</h2>
        </div>

        <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div>
                <label for="role_name" class="block text-sm font-medium text-gray-700 mb-2">
                    ชื่อบทบาท <span class="text-red-500">*</span>
                </label>
                <input type="text" name="role_name" id="role_name" value="{{ old('role_name', $role->role_name) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('role_name') border-red-500 @enderror"
                    placeholder="กรอกชื่อบทบาท">
                @error('role_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
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
