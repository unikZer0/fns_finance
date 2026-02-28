<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ดึง ID ของ Admin role และ Management department
        $adminRole = Role::where('role_name', 'Admin')->first();
        $managementDept = Department::where('department_name', 'ฝ่ายบริหาร')->first();

        if ($adminRole && $managementDept) {
            User::firstOrCreate(
                ['username' => 'admin'],
                [
                    'username' => 'admin',
                    'password' => Hash::make('admin123'),
                    'full_name' => 'ผู้ดูแลระบบ',
                    'role_id' => $adminRole->id,
                    'department_id' => $managementDept->id,
                    'is_active' => true,
                ]
            );

            // สร้าง user ทดสอบเพิ่ม
            User::firstOrCreate(
                ['username' => 'finance01'],
                [
                    'username' => 'finance01',
                    'password' => Hash::make('password123'),
                    'full_name' => 'เจ้าหน้าที่การเงิน 1',
                    'role_id' => Role::where('role_name', 'Finance')->first()?->id ?? $adminRole->id,
                    'department_id' => Department::where('department_name', 'ฝ่ายการเงิน')->first()?->id ?? $managementDept->id,
                    'is_active' => true,
                ]
            );
        }
    }
}
