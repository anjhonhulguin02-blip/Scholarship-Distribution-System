<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The schema had no concept of an application deadline at all -- only
     * an open/closed "status" -- even though the brief calls for showing
     * eligibility and deadlines on the public catalog. Nullable/additive so
     * existing scholarship rows are unaffected (they just show as
     * "no deadline specified" until an org sets one).
     */
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->date('applicationDeadline')->nullable()->after('numberOfRespondents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropColumn('applicationDeadline');
        });
    }
};
