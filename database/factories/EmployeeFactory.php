<?php

namespace Database\Factories;

use App\Models\Employee;
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
            'staff_member_id' => $this->faker->numberBetween(1, 9),
            'job_position_id' => $this->faker->numberBetween(1, 3),
            'company_affiliate_id' => $this->faker->numberBetween(1, 6)
        ];
    }
}
