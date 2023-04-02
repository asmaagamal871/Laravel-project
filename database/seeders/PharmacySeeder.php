<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PharmacySeeder extends Seeder
{
    public function run()
    {

        Pharmacy::factory(5)->create()->each(function ($user) {
            $user->type()->save(User::factory()->create());
        });
    }
}
