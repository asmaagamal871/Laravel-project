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
        $this->call(PharmacySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(EndUserSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(MedicineSeeder::class);
    }
}
