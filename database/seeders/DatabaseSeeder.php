<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();

        $procurementId = DB::table('departments')->insertGetId(['department_name' => 'Procurement', 'code' => 'PROC', 'head' => 'Asha Menon', 'employee_count' => 12, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now]);
        $manufacturingId = DB::table('departments')->insertGetId(['department_name' => 'Manufacturing', 'code' => 'MFG', 'head' => 'Rahul Shah', 'employee_count' => 34, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('departments')->insert(['department_name' => 'Logistics', 'code' => 'LOG', 'head' => 'Nina Patel', 'employee_count' => 18, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ecosphere.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department_id' => $procurementId,
        ]);

        User::create([
            'name' => 'Employee User',
            'email' => 'employee@ecosphere.test',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $manufacturingId,
        ]);

        DB::table('categories')->insert([
            ['name' => 'Tree Plantation', 'type' => 'CSR', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Energy Saving', 'type' => 'Challenge', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('emission_factors')->insert([
            ['source' => 'Diesel', 'unit' => 'Litre', 'factor' => 2.6800, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['source' => 'Petrol', 'unit' => 'Litre', 'factor' => 2.3100, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['source' => 'Electricity', 'unit' => 'kWh', 'factor' => 0.8200, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('products')->insert([
            ['name' => 'Diesel', 'category' => 'Fuel', 'co2_factor' => 2.6800, 'description' => 'Fuel purchase entry', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Steel Component', 'category' => 'Raw Material', 'co2_factor' => 1.8500, 'description' => 'Manufacturing input', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Recycled Packaging', 'category' => 'Packaging', 'co2_factor' => 0.4200, 'description' => 'Lower emission packaging', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('environmental_goals')->insert([
            ['title' => 'Reduce fuel emissions by 10%', 'target' => 10, 'deadline' => now()->addMonths(3)->toDateString(), 'status' => 'planned', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Complete monthly energy audit', 'target' => 1, 'deadline' => now()->addMonth()->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('policies')->insert([
            ['title' => 'Supplier Code of Conduct', 'description' => 'Employees must follow sustainable sourcing and ethics rules.', 'pdf' => null, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Anti-Bribery Policy', 'description' => 'All employees acknowledge governance and compliance expectations.', 'pdf' => null, 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('challenges')->insert([
            ['title' => 'Carpool Week', 'category' => 'Energy Saving', 'xp' => 120, 'difficulty' => 'easy', 'deadline' => now()->addWeeks(2)->toDateString(), 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Zero Plastic Desk', 'category' => 'Waste', 'xp' => 200, 'difficulty' => 'medium', 'deadline' => now()->addWeeks(4)->toDateString(), 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('csr_activities')->insert([
            ['title' => 'Community Clean-up Drive', 'category' => 'Tree Plantation', 'points' => 150, 'activity_date' => now()->addWeek()->toDateString(), 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Sustainability Training', 'category' => 'Training', 'points' => 80, 'activity_date' => now()->addDays(10)->toDateString(), 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
