<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyDescribingInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'main_link' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'logo_path' => $this->faker->imageUrl(),
            'address' => $this->faker->address(),
            'email' => $this->faker->companyEmail()
        ];
    }
}
