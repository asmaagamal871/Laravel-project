<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'st_name' => fake()->name(),
            'building_no' => fake()->randomNumber(2, true),
            'floor_no' => fake()->randomNumber(2, true),
            'flat_no' => fake()->randomNumber(2, true),
            'building_no' => fake()->randomNumber(2, true),
            'is_main' => fake()->boolean,
             'area_id' => fake()->numberBetween(1, 2),
            'end_user_id' => fake()->numberBetween(1, 5)
        ];
    }
}
