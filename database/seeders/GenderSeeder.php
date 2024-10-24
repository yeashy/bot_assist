<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

final class GenderSeeder extends Seeder
{
    /**
     * @var array<string>
     */
    private array $names = [
        'Мужчина',
        'Женщина',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->names as $name) {
            Gender::query()->create([
                'name' => $name,
            ]);
        }
    }
}
