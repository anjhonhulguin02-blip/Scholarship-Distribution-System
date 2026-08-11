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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('userID');
            $table->string('orgName', 100);
            $table->string('scholarshipName', 255);
            $table->decimal('scholarshipAmount', 10, 4);
            $table->integer('numberOfRespondents');
            $table->text('requirements');
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
