<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\EmployeeWorkingPeriod;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workingPeriods = EmployeeWorkingPeriod::inRandomOrder()->limit(5000)->get();

        foreach ($workingPeriods as $workingPeriod) {
            $workingPeriod->assignment()->create([
                'service_id' => Service::inRandomOrder()->first()->id,
                'client_id' => Client::inRandomOrder()->first()->id
            ]);
        }
    }
}
