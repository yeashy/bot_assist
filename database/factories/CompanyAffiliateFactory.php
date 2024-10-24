<?php

namespace Database\Factories;

use App\Models\CompanyAffiliate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyAffiliate>
 */
final class CompanyAffiliateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(asText: true),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->randomFloat(8, 56.4, 56.6),
            'longitude' => $this->faker->randomFloat(8, 84.9, 85.1),
            'is_main' => $this->faker->boolean(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
