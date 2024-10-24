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

final class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->count(3)
            ->has(CompanyDesignInfo::factory()->count(1), 'design')
            ->has(CompanyDescribingInfo::factory()->count(1), 'info')
            ->has(CompanyAffiliate::factory()->count(5), 'affiliates')
            ->has(
                Client::factory()
                    ->count(3)
                    ->has(ClientDescribingInfo::factory()->count(1), 'info'), 'clients')
            ->has(
                StaffMember::factory()
                    ->count(10)
                    ->has(StaffMemberDescribingInfo::factory()->count(1), 'info'), 'staff')
            ->createQuietly();
    }
}
