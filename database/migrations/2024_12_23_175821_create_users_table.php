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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID')->autoIncrement();
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable(true);
            $table->string('lastName', 100);
            $table->string('address', 180);
            $table->date('birthDate');
            $table->string('gender', 10);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('userType', 20);
            $table->string('status', 30);
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
