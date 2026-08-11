<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * birthDate and gender describe a person, not an organization. The
     * original schema forced every "org" account through the same required
     * fields as a student (the seed data even has a birth date and gender
     * for the sample org account), which is why the old signup form had to
     * ask an organization for a birth date at all. Registration now only
     * asks for role-appropriate fields; these columns become optional so
     * an Organization/Provider account is not forced to fabricate a
     * birth date and gender.
     *
     * Uses raw SQL rather than Schema::table()->change() to avoid adding a
     * doctrine/dbal dependency just for this one nullability change.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `users` MODIFY `birthDate` DATE NULL');
            DB::statement('ALTER TABLE `users` MODIFY `gender` VARCHAR(10) NULL');
            return;
        }

        if ($driver === 'sqlite') {
            // SQLite has no MODIFY COLUMN; NOT NULL is only enforced at
            // insert time and this connection is exclusively used for the
            // automated test suite (fresh schema every run), so there is
            // no existing data to migrate here.
            DB::statement('CREATE TABLE users_new AS SELECT * FROM users');
            DB::statement('DROP TABLE users');
            DB::statement('CREATE TABLE users (
                userID INTEGER PRIMARY KEY AUTOINCREMENT,
                firstName VARCHAR(100) NOT NULL,
                middleName VARCHAR(100),
                lastName VARCHAR(100) NOT NULL,
                organizationName VARCHAR(150),
                address VARCHAR(180) NOT NULL,
                birthDate DATE,
                gender VARCHAR(10),
                email VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                userType VARCHAR(20) NOT NULL,
                status VARCHAR(30) NOT NULL,
                created_at DATETIME,
                updated_at DATETIME
            )');
            // Explicit column lists on both sides: users_new preserves the
            // physical column order SQLite already had (organizationName
            // appended at the end, since SQLite ignores after() on ADD
            // COLUMN), which does not match the new table's declared order.
            // An unqualified SELECT * would silently shift every value
            // after lastName into the wrong column.
            DB::statement('INSERT INTO users (
                userID, firstName, middleName, lastName, organizationName,
                address, birthDate, gender, email, password, userType,
                status, created_at, updated_at
            ) SELECT
                userID, firstName, middleName, lastName, organizationName,
                address, birthDate, gender, email, password, userType,
                status, created_at, updated_at
            FROM users_new');
            DB::statement('DROP TABLE users_new');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("UPDATE `users` SET `birthDate` = '2000-01-01' WHERE `birthDate` IS NULL");
            DB::statement("UPDATE `users` SET `gender` = 'unspecified' WHERE `gender` IS NULL");
            DB::statement('ALTER TABLE `users` MODIFY `birthDate` DATE NOT NULL');
            DB::statement('ALTER TABLE `users` MODIFY `gender` VARCHAR(10) NOT NULL');
        }
    }
};
