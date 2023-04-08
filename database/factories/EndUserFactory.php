<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EndUser>
 */
class EndUserFactory extends Factory
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
            'DOB' => now(),
            'gender'=>'female',
            'mob_num'=>fake()->unique()->phoneNumber()
        ];
    }
}
