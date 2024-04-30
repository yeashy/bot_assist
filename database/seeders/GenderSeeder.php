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
        foreach ($this->names as $name) {
            Gender::query()->create([
                'name' => $name
            ]);
        }
    }
}
