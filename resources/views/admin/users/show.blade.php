@extends('layouts.admin')

@section('title', 'รายละเอียดผู้ใช้งาน')
@section('page-title', 'รายละเอียดผู้ใช้งาน')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">ข้อมูลผู้ใช้งาน</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-lg hover:bg-yellow-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    แก้ไข
                </a>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Username -->
            <div class="grid grid-cols-3 gap-4">
                <div class="text-sm font-medium text-gray-500">ชื่อผู้ใช้</div>
                <div class="col-span-2 text-sm text-gray-900">{{ $user->username }}</div>
            </div>

            <!-- Full Name -->
            <div class="grid grid-cols-3 gap-4">
                <div class="text-sm font-medium text-gray-500">ชื่อเต็ม</div>
                <div class="col-span-2 text-sm text-gray-900">{{ $user->full_name }}</div>
            </div>

            <!-- Role -->
            <div class="grid grid-cols-3 gap-4">
                <div class="text-sm font-medium text-gray-500">บทบาท</div>
                <div class="col-span-2">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ $user->role->role_name }}
                    </span>
                </div>
            </div>

            <!-- Department -->
            <div class="grid grid-cols-3 gap-4">
                <div class="text-sm font-medium text-gray-500">แผนก</div>
                <div class="col-span-2 text-sm text-gray-900">{{ $user->department->department_name ?? '-' }}</div>
            </div>

            <!-- Status -->
            <div class="grid grid-cols-3 gap-4">
                <div class="text-sm font-medium text-gray-500">สถานะ</div>
                <div class="col-span-2">
                    @if ($user->is_active)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">ใช้งาน</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">ไม่ใช้งาน</span>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="pt-6 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    กลับไปหน้ารายการ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
