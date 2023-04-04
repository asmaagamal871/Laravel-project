<?php

namespace Database\Factories;
// In database/factories/UserFactory.php


use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory as FactoriesFactory;

class UserFactory extends FactoriesFactory
{
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'name' => fake()->name(),
        ];
    }
}
