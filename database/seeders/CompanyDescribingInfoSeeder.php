<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

final class CompanyDescribingInfoSeeder extends Seeder
{
    /**
     * @var array<string>
     */
    private array $testCompanyDescribingInfo = [
        'main_link' => 'www.test_company.com',
        'phone_number' => '79059905894',
        'logo_path' => 'https://via.placeholder.com/640x480.png/00eebb?text=test_company',
        'email' => 'test_company@gmail.com',
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

        $company->info()->create($this->testCompanyDescribingInfo);
    }
}
