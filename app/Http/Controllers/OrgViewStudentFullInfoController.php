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
                $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();

                $data = json_decode(DB::table('students')->where('id', '=', $id)->get(), true);

                $mDate =  date('Y-m-d', strtotime('-14 years'));
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
