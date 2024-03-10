<?php

namespace Database\Factories;

use App\Models\ClientDescribingInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClientDescribingInfo>
 */
class ClientDescribingInfoFactory extends Factory
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
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->address(),
            'description' => $this->faker->text()
        ];
    }
}
