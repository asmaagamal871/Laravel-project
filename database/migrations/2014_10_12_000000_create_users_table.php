<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

//use App\User;
//User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'is_admin' => 1]);
//Add UserSeeder::class to DatabaseSeeder.php
//php artisan migrate --seed
//php artisan migrate:refresh --seed

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('national_id');
            $table->primary('national_id');
            $table->string('name');
            $table->string('gender');
            $table->date('DOB');
            $table->string('mob_num');
            $table->string('avatar');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
