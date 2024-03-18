<?php

namespace Database\Factories;

use App\Models\CompanyAffiliate;
use App\Models\Employee;
use App\Models\JobPosition;
use App\Models\StaffMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff_member_id' => StaffMember::inRandomOrder()->first()->id,
            'job_position_id' => JobPosition::inRandomOrder()->first()->id,
            'company_affiliate_id' => CompanyAffiliate::inRandomOrder()->first()->id
        ];
    }
}
