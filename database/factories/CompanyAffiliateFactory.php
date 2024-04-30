<?php

namespace Database\Factories;

use App\Models\CompanyAffiliate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyAffiliate>
 */
class CompanyAffiliateFactory extends Factory
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
            'address' => $this->faker->address()
        ];
    }
}
