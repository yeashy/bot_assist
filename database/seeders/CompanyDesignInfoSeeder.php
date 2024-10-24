<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

final class CompanyDesignInfoSeeder extends Seeder
{
    /**
     * @var array<string>
     */
    private array $testCompanyDesignInfo = [
        'primary_color' => '#000000',
        'secondary_color' => '#ffffff',
        'accent_color' => '#000000',
        'background_color' => '#ffffff',
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
