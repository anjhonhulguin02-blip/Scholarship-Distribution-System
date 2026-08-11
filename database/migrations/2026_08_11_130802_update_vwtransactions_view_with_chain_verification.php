<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * vwtransactions was previously only ever created by manually importing
     * scholardb.sql against MySQL -- no Laravel migration created it, so a
     * fresh `php artisan migrate` (new dev setup, CI, or this project's own
     * test suite) left every page that queries vwtransactions broken with
     * "table doesn't exist". This migration is now the single source of
     * truth for the view, portable across MySQL and SQLite, and safe to
     * rerun against the real database that already has it (DROP VIEW IF
     * EXISTS first).
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS vwtransactions');
        DB::statement('
            CREATE VIEW vwtransactions AS
            SELECT
                transactions.id AS id,
                transactions.applicationID AS applicationID,
                transactions.status AS status,
                transactions.amountReceived AS amountReceived,
                transactions.transactionHash AS transactionHash,
                transactions.chainVerified AS chainVerified,
                transactions.chainVerificationNote AS chainVerificationNote,
                transactions.created_at AS created_at,
                transactions.updated_at AS updated_at,
                scholarships.id AS scholarshipID,
                scholarships.scholarshipName AS scholarshipName,
                applications.userID AS studentID,
                applications.paymentAddress AS studentPaymentAddress,
                scholarships.userID AS ownerID,
                users.firstName AS firstName,
                users.middleName AS middleName,
                users.lastName AS lastName,
                scholarships.orgName AS orgName,
                scholarships.scholarshipAmount AS scholarshipAmount
            FROM applications
            JOIN transactions ON transactions.applicationID = applications.id
            JOIN scholarships ON scholarships.id = applications.scholarshipID
            JOIN users ON users.userID = applications.userID
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vwtransactions');
        DB::statement('
            CREATE VIEW vwtransactions AS
            SELECT
                transactions.id AS id,
                transactions.applicationID AS applicationID,
                transactions.status AS status,
                transactions.amountReceived AS amountReceived,
                transactions.transactionHash AS transactionHash,
                transactions.created_at AS created_at,
                transactions.updated_at AS updated_at,
                scholarships.id AS scholarshipID,
                scholarships.scholarshipName AS scholarshipName,
                applications.userID AS studentID,
                applications.paymentAddress AS studentPaymentAddress,
                scholarships.userID AS ownerID,
                users.firstName AS firstName,
                users.middleName AS middleName,
                users.lastName AS lastName,
                scholarships.orgName AS orgName,
                scholarships.scholarshipAmount AS scholarshipAmount
            FROM applications
            JOIN transactions ON transactions.applicationID = applications.id
            JOIN scholarships ON scholarships.id = applications.scholarshipID
            JOIN users ON users.userID = applications.userID
        ');
    }
};
