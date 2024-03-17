<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    private array $names = [
        'Мужчина',
        'Женщина'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::query()->create([
            'name' => 'Мужчина'
        ]);

        Gender::query()->create([
            'name' => 'Женщина'
        ]);
        foreach ($this->names as $name) {
            Gender::query()->create([
                'name' => $name
            ]);
        }
    }
}
