<?php
namespace Database\Seeders;

use App\Models\EndUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class EndUserSeeder extends Seeder
{
    public function run()
    {
         EndUser::factory(5)->create()->each(function ($user) {
              $user->type()->save(User::factory()->create());
         });
    }
}
