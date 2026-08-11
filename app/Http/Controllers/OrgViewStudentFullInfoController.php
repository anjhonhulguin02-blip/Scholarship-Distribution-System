<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgViewStudentFullInfoController extends Controller
{
    public function index(Request $request)
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "org") {
                return redirect("/logout");
            }

            $id = $request->query('id');
            if ($id) {
                $data = json_decode(DB::table('students')->where('id', '=', $id)->get(), true);

                if (count($data) == 0) {
                    abort(404);
                }

                // A student's full profile (including grades/report card)
                // may only be viewed by an org that student has actually
                // applied to, never guessed by iterating student IDs.
                $hasRelationship = DB::table('applications')
                    ->join('scholarships', 'scholarships.id', '=', 'applications.scholarshipID')
                    ->where('scholarships.userID', '=', $user['userID'])
                    ->where('applications.userID', '=', $data[0]['userID'])
                    ->exists();

                if (!$hasRelationship) {
                    abort(403);
                }

                $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();

                $mDate =  date('Y-m-d', strtotime('-18 years'));
                return view('org.studentinfo', [
                    'data' => count($data) == 0 ? [] : $data[0],
                    'maxDate' => $mDate,
                    'notifCount' => $notifCount
                ]);
            }

            return redirect("/org_applications");
        }
        return redirect("/");
    }
}
