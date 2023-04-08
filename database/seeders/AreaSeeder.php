<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Area;
use Illuminate\Database\Seeder;
use Database\Factories\factory;

class AreaSeeder extends Seeder
{
     public function run()
     {
          Area::factory(5)->create()->each(function ($user) {
          $user->type()->save(User::factory()->create());
          });
          
          
     }
}
