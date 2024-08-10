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
            'background_color' => $this->faker->hexColor(),
            'text_color' => $this->faker->hexColor(),
            'border_color' => $this->faker->hexColor(),
            'block_background_color' => $this->faker->hexColor(),
            'button_background_color' => $this->faker->hexColor(),
            'main_background_color' => $this->faker->hexColor(),
            'additional_background_color' => $this->faker->hexColor(),
            'button_text_color' => $this->faker->hexColor(),
            'main_text_color' => $this->faker->hexColor(),
            'additional_text_color' => $this->faker->hexColor(),
        ];
    }
}
