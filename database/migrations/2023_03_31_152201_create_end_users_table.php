<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('end_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('gender',['male','female']);
            $table->date('DOB');
            $table->string('mob_num');
            $table->string('image')->default('public/doctors/default.png');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_users');
    }
};
