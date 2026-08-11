<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "org") {
                return redirect("/logout");
            }


            $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();

            $mDate =  date('Y-m-d', strtotime('-14 years'));

            return view('org.details', ['user' => $user, 'maxDate' => $mDate, 'notifCount' => $notifCount]);
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

            if ($user['userType'] != "org") {
                return redirect("/logout");
            }

            if ($request->btnSaveDetails) {
                $updateCount = DB::table('users')->where("userID", '=', $user['userID'])->update([
                    "birthDate" => $request->birthDate,
                    "firstName" => $request->firstName,
                    "middleName" => $request->middleName,
                    "lastName" => $request->lastName,
                    "address" => $request->address,
                    "gender" => $request->gender,
                ]);
                if ($updateCount > 0) {
                    $myDataArr = json_decode(DB::table('users')->where("userID", '=', $user['userID'])->get(), true);
                    $user =  $myDataArr[0];
                    session()->put("users", $user);

                    session()->put("successUpdateDetails", true);
                } else {
                    session()->put("errorUpdateDetails", true);
                }
            }
            return redirect("/org_details");
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
