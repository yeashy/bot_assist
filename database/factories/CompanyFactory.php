<?php

namespace Database\Factories;

use App\Models\CompanyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'bot_token' => $this->faker->creditCardNumber(null, false, ''),
            'company_type_id' => CompanyType::inRandomOrder()->first()->id
        ];
    }
}
