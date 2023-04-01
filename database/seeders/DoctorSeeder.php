<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Database\Factories\factory;

class DoctorSeeder extends Seeder
{
     public function run()
     {
          Doctor::factory(5)->create()->each(function ($user) {
               $user->type()->save(User::factory()->create());
          });
     }
}
