<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "user") {
                return redirect("/logout");
            }
            $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();


            $allScholarships = json_decode(DB::table('scholarships')->get(), true);
            $filteredScholarships = array();
            foreach ($allScholarships as $ss) {
                $count = DB::table('applications')->where('scholarshipID', '=', $ss['id'])->where('status', '<>', 'rejected')->count();
                if ($count >= $ss['numberOfRespondents']) {
                    continue;
                } else {
                    array_push($filteredScholarships, $ss);
                }
            }
            $allApplications = DB::table('applications')
                ->where('userID', '=', $user['userID'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('user.applications', [
                'notifCount' => $notifCount,
                'user' => $user,
                'scholarships' => $allScholarships,
                'applications' => $allApplications,
                'filteredScholarships' => $filteredScholarships
            ]);
        }
        return redirect("/");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "user") {
                return redirect("/logout");
            }

            if ($request->btnApplyScholarship) {
                $request->validate([
                    'scholarship' => ['required', 'integer', 'exists:scholarships,id'],
                    'paymentAddress' => ['required', 'string', 'regex:/^0x[a-fA-F0-9]{40}$/'],
                    'requirements' => ['required', 'file', 'mimes:pdf', 'max:5120'],
                    'ownerID' => ['required', 'integer', 'exists:users,userID'],
                ]);

                $existCount = DB::table('applications')->where('userID', '=', $user['userID'])->where('scholarshipID', '=', $request->scholarship)->where('status', '=', 'active')->count();
                if ($existCount > 0) {
                    session()->put("errorExistingApplication", true);
                } else {
                    $newApply = new Applications();
                    $newApply->userID = $user['userID'];
                    $newApply->scholarshipID = $request->scholarship;
                    $newApply->paymentAddress = $request->paymentAddress;

                    $file = $request->file('requirements');

                    // Stored outside the public webroot with a random name:
                    // the old code saved PDFs into public/storage/applications
                    // under a guessable timestamp filename, so anyone could
                    // enumerate and download other students' documents.
                    // SecureFileController is now the only way to read these.
                    $fileName = Str::uuid() . '.pdf';
                    $isStored = Storage::disk('secure')->putFileAs('applications', $file, $fileName);

                    if ($isStored) {
                        $newApply->requirementFile = $fileName;
                        $newApply->status = "active";
                        $isSave = $newApply->save();
                        if ($isSave) {
                            session()->put("successApply", true);
                            $newNotif = new Notifications();
                            $newNotif->userID = $request->ownerID;
                            $newNotif->message = "A Student Applies In One Of Your Scholarship Programs, Please Check Applications Page";
                            $newNotif->status = "unread";
                            $newNotif->save();
                        } else {
                            session()->put("errorApply", true);
                        }
                    } else {
                        session()->put("errorApply", true);
                    }
                }
            }

            return redirect("/user_applications");
        }
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
