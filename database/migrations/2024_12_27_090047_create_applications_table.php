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
        Schema::create('applications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('userID');
            $table->integer('scholarshipID');
            $table->string('requirementFile', 255)->nullable(true);
            $table->string('requirementFile2', 255)->nullable(true);
            $table->string('requirementFile3', 255)->nullable(true);
            $table->string('requirementFile4', 255)->nullable(true);
            $table->string('paymentAddress', 255);
            $table->string('status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
