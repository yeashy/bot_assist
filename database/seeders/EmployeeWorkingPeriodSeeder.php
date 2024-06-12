<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Log;

class EmployeeWorkingPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $startDate = CarbonImmutable::now()->startOfDay();
            $endDate = CarbonImmutable::now()->addDays(90)->startOfDay();

            while ($endDate->day !== $startDate->day) {
                $startTime = $startDate->addHours(8);
                $endTime = $startDate->addHours(18);

                while ($endTime->hour !== $startTime->hour) {
                    $employee->periods()->create([
                        'date' => $startDate->toDateString(),
                        'start_time' => $startTime->toTimeString(),
                        'end_time' => $startTime->addMinutes(15)->toTimeString()
                    ]);

                    $startTime = $startTime->addMinutes(15);
                }

                $startDate = $startDate->addDay();
            }
        }
    }
}
