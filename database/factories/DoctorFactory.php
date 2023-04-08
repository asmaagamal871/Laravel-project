<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorFactory extends Factory
{
    public function definition()
    {
            return [
                // Add any other doctor-specific attributes here
                'national_id' => fake()->unique()->randomNumber(8,true),
                'pharmacy_id'=>fake()->numberBetween(1, 5),
                
            ];
        
    }
}
