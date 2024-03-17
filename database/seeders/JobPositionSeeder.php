<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    private array $names = [
        'Хирург',
        'Терапевт',
        'Кардиолог'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->names as  $name) {
            JobPosition::query()->create([
                'name' => $name
            ]);
        }
    }
}
