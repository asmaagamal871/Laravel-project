<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name($nbWords = 6, $variableNbWords = true),
                'email' => $faker->email($nbSentences = 2, $variableNbSentences = true),
                'password' => $faker->password($maxNbChars = 8),
            ]);
        }
    
    }
}
