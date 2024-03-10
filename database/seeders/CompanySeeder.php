<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\CompanyDescribingInfo;
use App\Models\CompanyDesignInfo;
use App\Models\StaffMember;
use App\Models\StaffMemberDescribingInfo;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()
            ->count(3)
            ->has(CompanyDesignInfo::factory()->count(1), 'design')
            ->has(CompanyDescribingInfo::factory()->count(1), 'info')
            ->has(Client::factory()->count(3), 'clients')
            ->has(
                StaffMember::factory()
                    ->count(3)
                    ->has(StaffMemberDescribingInfo::factory()->count(1), 'info')
                , 'staff')
            ->create();
    }
}
