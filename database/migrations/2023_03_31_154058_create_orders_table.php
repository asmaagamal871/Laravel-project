<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status', ['new','processing','waitingCustConfirmation','cancelled','confirmed','delivered']);
            $table->boolean('is_insured');
            $table->unsignedBigInteger('delivery_address_id');
            $table->foreign('delivery_address_id')->references('id')->on('addresses');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('end_users');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
            $table->string('visa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
