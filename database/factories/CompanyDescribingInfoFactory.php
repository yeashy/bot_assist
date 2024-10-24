<?php

namespace Database\Factories;

use App\Models\CompanyDescribingInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyDescribingInfo>
 */
final class CompanyDescribingInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'main_link' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'logo_path' => $this->faker->imageUrl(),
            'address' => $this->faker->address(),
            'email' => $this->faker->companyEmail(),
        ];
    }
}
