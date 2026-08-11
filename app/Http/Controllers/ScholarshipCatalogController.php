<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Public, unauthenticated scholarship catalog. Read-only: no PII, no
 * session state required. Lets a visitor see what the platform actually
 * offers before creating an account.
 */
class ScholarshipCatalogController extends Controller
{
    public function index()
    {
        $scholarships = DB::table('scholarships')
            ->where('status', '=', 'active')
            ->orderByRaw('applicationDeadline IS NULL, applicationDeadline ASC')
            ->get()
            ->map(fn ($s) => $this->withOpenSlots($s));

        return view('scholarships.index', ['scholarships' => $scholarships]);
    }

    public function show(int $id)
    {
        $scholarship = DB::table('scholarships')->where('id', '=', $id)->where('status', '=', 'active')->first();

        if (!$scholarship) {
            abort(404);
        }

        return view('scholarships.show', ['scholarship' => $this->withOpenSlots($scholarship)]);
    }

    private function withOpenSlots(object $scholarship): object
    {
        $filledSlots = DB::table('applications')
            ->where('scholarshipID', '=', $scholarship->id)
            ->where('status', '<>', 'rejected')
            ->count();

        $scholarship->openSlots = max(0, $scholarship->numberOfRespondents - $filledSlots);
        $scholarship->isFull = $scholarship->openSlots <= 0;

        return $scholarship;
    }
}
