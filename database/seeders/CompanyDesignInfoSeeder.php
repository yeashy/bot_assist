<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyDesignInfoSeeder extends Seeder
{
    private array $testCompanyDesignInfo = [
        'background_color' => '#ffffff',
        'text_color' => '#000000',
        'border_color' => '#5f71f7',
        'block_background_color' => '#bac1f7',
        'button_background_color' => '#5f71f7',
        'main_background_color' => '#bac1f7',
        'additional_background_color' => '#bac1f7',
        'button_text_color' => '#000000',
        'main_text_color' => '#000000',
        'additional_text_color' => '#000000',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Company $company */
        $company = Company::query()
            ->where('name', 'Test company')
            ->first();

        $company->design()->create($this->testCompanyDesignInfo);
    }
}
