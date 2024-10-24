<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

final class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->count(90)->create();
    }
}
