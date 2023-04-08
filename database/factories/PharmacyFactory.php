<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_id' => fake()->unique()->randomNumber(8, true),
            'priority' => fake()->numberBetween(1, 5),
            'area_id'=>fake()->numberBetween(1, 2),
        ];
    }
}
