<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Guard against pre-existing duplicate emails before adding the unique
        // index, so this migration never fails/destroys data on a populated DB.
        $duplicates = DB::table('users')
            ->select('email')
            ->groupBy('email')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('email');

        if ($duplicates->isNotEmpty()) {
            throw new \RuntimeException(
                'Cannot add unique index on users.email: duplicate emails exist for: '
                    . $duplicates->implode(', ') . '. Resolve duplicates manually before migrating.'
            );
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('organizationName', 150)->nullable()->after('lastName');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn('organizationName');
        });
    }
};
