<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create()->type()->save(User::factory()->create(
                [
                    'email' => 'admin@example.com',
                    'password' => bcrypt('123456'),
                ]
            ));
    }
}
