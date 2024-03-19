<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosition;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    private array $names = [
        'Осмотр',
        'Удаление кариеса',
        'Лоботомия'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $times = [0, 15, 30, 45];

        foreach ($this->names as $name) {
            Service::query()->create([
                'name' => $name,
                'allocated_time' => Carbon::createFromTime(rand(0, 2), $times[rand(0, 3)]),
                'company_id' => Company::inRandomOrder()->first()->id,
                'price' => rand(0, 10000)
            ])->positions()->attach(JobPosition::inRandomOrder()->limit(2)->pluck('id')->all());
        }
    }
}
