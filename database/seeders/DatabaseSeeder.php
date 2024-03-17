<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            GenderSeeder::class,
            JobPositionSeeder::class,
            ServiceSeeder::class,
            FontSeeder::class,
            CompanyTypeSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class
        ]);
    }
}
