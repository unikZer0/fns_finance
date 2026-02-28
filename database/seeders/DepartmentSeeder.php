<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['department_name' => 'ฝ่ายบริหาร', 'department_type' => 'Management'],
            ['department_name' => 'ฝ่ายการเงิน', 'department_type' => 'Finance'],
            ['department_name' => 'ฝ่ายบัญชี', 'department_type' => 'Accounting'],
            ['department_name' => 'ฝ่ายขาย', 'department_type' => 'Sales'],
            ['department_name' => 'ฝ่ายจัดซื้อ', 'department_type' => 'Procurement'],
            ['department_name' => 'ฝ่ายไอที', 'department_type' => 'IT'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['department_name' => $department['department_name']],
                $department
            );
        }
    }
}
