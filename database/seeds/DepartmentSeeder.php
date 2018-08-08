<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time_now = now();
        $departmentList = [
            [
                'department_name' => '管理部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '專案部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '研究部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '編輯部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '設計部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '工程部',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'department_name' => '其他',
                'department_info' => null,
                'created_at' => $time_now,
                'updated_at' => $time_now
            ]
        ];
        Department::insert($departmentList);
    }
}
