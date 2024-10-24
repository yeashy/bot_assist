<?php

namespace Database\Seeders;

use App\Models\Font;
use Illuminate\Database\Seeder;

final class FontSeeder extends Seeder
{
    /**
     * @var array<string>
     */
    private array $names = [
        'Arial',
        'Verdana',
        'Times New Roman',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->names as $name) {
            Font::query()->create([
                'name' => $name,
            ]);
        }
    }
}
