<?php

namespace Database\Seeders;

use App\Models\Font;
use Illuminate\Database\Seeder;

class FontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Font::query()->create([
           'name' => 'Arial'
        ]);

        Font::query()->create([
            'name' => 'Verdana'
        ]);

        Font::query()->create([
            'name' => 'FreeMono'
        ]);
    }
}
