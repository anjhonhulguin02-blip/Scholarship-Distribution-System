<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves applicant-uploaded files (requirement PDFs, profile photos, grade
 * images) from private storage after an ownership/relationship check.
 *
 * These used to be saved straight into the public webroot with a
 * timestamp-based filename, which meant anyone who guessed or brute-forced
 * a filename could download another student's documents with no
 * authentication at all. New uploads are written to non-public storage
 * with random names; this controller is now the only way to read them back.
 * It still falls back to the old public paths so previously uploaded demo
 * data keeps working without a data migration.
 */
class SecureFileController extends Controller
{
    public function application(Request $request, int $applicationId): StreamedResponse
    {
        $user = $this->requireSessionUser();

        $application = DB::table('applications')
            ->join('scholarships', 'scholarships.id', '=', 'applications.scholarshipID')
            ->where('applications.id', '=', $applicationId)
            ->select('applications.userID as studentID', 'applications.requirementFile', 'scholarships.userID as orgID')
            ->first();

        if (!$application || !$application->requirementFile) {
            abort(404);
        }

        $isOwner = $user['userType'] === 'user' && (int) $user['userID'] === (int) $application->studentID;
        $isReviewingOrg = $user['userType'] === 'org' && (int) $user['userID'] === (int) $application->orgID;

        if (!$isOwner && !$isReviewingOrg) {
            abort(403);
        }

        return $this->streamPrivateOrLegacy('applications', $application->requirementFile);
    }

    public function studentProfile(Request $request, int $studentId): StreamedResponse
    {
        return $this->streamStudentAsset($studentId, 'profile', 'profiles');
    }

    public function studentGrade(Request $request, int $studentId): StreamedResponse
    {
        return $this->streamStudentAsset($studentId, 'grade', 'grades');
    }

    private function streamStudentAsset(int $studentId, string $column, string $subdir): StreamedResponse
    {
        $user = $this->requireSessionUser();

        $student = DB::table('students')->where('id', '=', $studentId)->first();
        if (!$student || !$student->{$column}) {
            abort(404);
        }

        $isOwner = $user['userType'] === 'user' && (int) $user['userID'] === (int) $student->userID;
        $isRelatedOrg = false;

        if ($user['userType'] === 'org') {
            $isRelatedOrg = DB::table('applications')
                ->join('scholarships', 'scholarships.id', '=', 'applications.scholarshipID')
                ->where('scholarships.userID', '=', $user['userID'])
                ->where('applications.userID', '=', $student->userID)
                ->exists();
        }

        if (!$isOwner && !$isRelatedOrg) {
            abort(403);
        }

        return $this->streamPrivateOrLegacy($subdir, $student->{$column});
    }

    private function requireSessionUser(): array
    {
        if (!session()->exists('users')) {
            abort(403);
        }

        return session()->get('users');
    }

    private function streamPrivateOrLegacy(string $subdir, string $filename): StreamedResponse
    {
        $disk = Storage::disk('secure');

        if ($disk->exists("$subdir/$filename")) {
            return $disk->response("$subdir/$filename");
        }

        // Legacy fallback: files uploaded before this fix were saved
        // directly under the public webroot.
        $legacyPath = public_path("$subdir/$filename");
        if (is_file($legacyPath)) {
            return response()->stream(function () use ($legacyPath) {
                readfile($legacyPath);
            }, 200, [
                'Content-Type' => mime_content_type($legacyPath) ?: 'application/octet-stream',
                'Content-Disposition' => 'inline; filename="' . basename($legacyPath) . '"',
            ]);
        }

        abort(404);
    }
}
