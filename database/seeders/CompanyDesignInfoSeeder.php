<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyDesignInfoSeeder extends Seeder
{
    private array $testCompanyDesignInfo = [
        'primary_color' => '#000000',
        'secondary_color' => '#ffffff',
        'accent_color' => '#000000',
        'background_color' => '#ffffff'
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
