<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'department_name' => 'Human Resources',
                'code' => 'HR',
                'head' => 'Jane Doe',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Finance',
                'code' => 'FIN',
                'head' => 'John Smith',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Information Technology',
                'code' => 'IT',
                'head' => 'Peter Jones',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}