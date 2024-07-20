<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientDescribingInfo;
use App\Models\Company;
use App\Models\CompanyAffiliate;
use App\Models\CompanyDescribingInfo;
use App\Models\CompanyDesignInfo;
use App\Models\StaffMember;
use App\Models\StaffMemberDescribingInfo;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    private array $testCompany = [
        'name' => 'Test Company',
        'code_name' => 'test_company',
        'bot_token' => '7311110449:AAG2N1qKDG6JLe002VMTmDS3gXvxinDuU8g',
        'company_type_id' => 1
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Company::query()->create($this->testCompany);

        Company::factory()
            ->count(3)
            ->has(CompanyDesignInfo::factory()->count(1), 'design')
            ->has(CompanyDescribingInfo::factory()->count(1), 'info')
            ->has(CompanyAffiliate::factory()->count(2), 'affiliates')
            ->has(
                Client::factory()
                    ->count(3)
                    ->has(ClientDescribingInfo::factory()->count(1), 'info')
                , 'clients')
            ->has(
                StaffMember::factory()
                    ->count(10)
                    ->has(StaffMemberDescribingInfo::factory()->count(1), 'info')
                , 'staff')
            ->createQuietly();
    }
}
