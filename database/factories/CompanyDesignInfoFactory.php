<?php

namespace Database\Factories;

use App\Models\Font;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyDesignInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'primary_color' => $this->faker->hexColor(),
            'secondary_color' => $this->faker->hexColor(),
            'accent_color' => $this->faker->hexColor(),
            'background_color' => $this->faker->hexColor()
        ];
    }
}
