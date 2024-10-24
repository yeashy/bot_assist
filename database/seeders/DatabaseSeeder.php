<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenderSeeder::class,
            FontSeeder::class,
            CompanyTypeSeeder::class,
            CompanySeeder::class,
            JobPositionSeeder::class,
            ServiceSeeder::class,
            EmployeeSeeder::class,
            EmployeeWorkingPeriodSeeder::class,
            ServiceAssignmentSeeder::class,
            InitialEntitiesSeeder::class,
        ]);
    }
}
