<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Like vwtransactions, vwapplications was previously only ever created
     * by manually importing scholardb.sql against MySQL. It is used by
     * OrgReviewApplicantController and org.review to look up a single
     * application for review. This migration makes `php artisan migrate`
     * alone sufficient to provision it, on MySQL or SQLite. Safe to rerun
     * against the real database that already has it.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS vwapplications');
        DB::statement('
            CREATE VIEW vwapplications AS
            SELECT
                scholarships.id AS id,
                scholarships.userID AS userID,
                scholarships.orgName AS orgName,
                scholarships.scholarshipName AS scholarshipName,
                scholarships.requirements AS requirements,
                scholarships.status AS status,
                scholarships.created_at AS created_at,
                scholarships.updated_at AS updated_at,
                applications.id AS applicationID,
                applications.scholarshipID AS scholarshipID,
                applications.requirementFile AS requirementFile,
                applications.requirementFile2 AS requirementFile2,
                applications.requirementFile3 AS requirementFile3,
                applications.requirementFile4 AS requirementFile4,
                applications.paymentAddress AS paymentAddress,
                applications.status AS applicationStatus,
                applications.created_at AS applicationCreateDate,
                users.firstName AS firstName,
                users.middleName AS middleName,
                users.lastName AS lastName,
                users.userID AS studentID,
                scholarships.scholarshipAmount AS scholarshipAmount
            FROM applications
            JOIN scholarships ON scholarships.id = applications.scholarshipID
            JOIN users ON users.userID = applications.userID
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vwapplications');
    }
};
