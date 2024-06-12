<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    private array $names = [
        'Хирург',
        'Терапевт',
        'Кардиолог',
        'Стоматолог',
        'Невролог',
        'Гинеколог',
        'Уролог',
        'Дерматолог',
        'Эндокринолог',
        'Офтальмолог',
        'Отоларинголог (ЛОР)',
        'Гастроэнтеролог',
        'Педиатр',
        'Пульмонолог',
        'Ревматолог',
        'Онколог',
        'Нефролог',
        'Инфекционист',
        'Гематолог',
        'Аллерголог-иммунолог'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->names as  $name) {
            JobPosition::query()->create([
                'name' => $name,
                'company_id' => Company::inRandomOrder()->first()->id
            ]);
        }
    }
}
