<?php

namespace Database\Factories;

use App\Models\StaffMemberDescribingInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StaffMemberDescribingInfo>
 */
class StaffMemberDescribingInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo_path' => $this->faker->imageUrl(),
            'phone_number' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
            'description' => $this->faker->text()
        ];
    }
}
