<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgScholarshipsController extends Controller
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


            $checkBalance = DB::table('balances')->where('userID', '=', $user['userID'])->count();
            if ($checkBalance == 0) {
                $newBalance = new Balance();
                $newBalance->userID = $user['userID'];
                $newBalance->amount = 0;
                $newBalance->save();
            }

            $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
            $myBalance = $myBalanceArr[0]['amount'];

            return view('org.scholarships', ['notifCount' => $notifCount, 'myBalance' => $myBalance]);
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

            if ($request->btnSaveScholarship) {
                $count = DB::table('scholarships')->where('userID', '=', $user['userID'])->where('scholarshipName', '=', $request->scholarshipName)->where('orgName', '=', $request->orgName)->count();
                if ($count > 0) {
                    session()->put("errorScholarExist", true);
                } else {
                    $newScholarship = new Scholarships();
                    $newScholarship->userID = $user['userID'];
                    $newScholarship->orgName = $request->orgName;
                    $newScholarship->scholarshipName = $request->scholarshipName;
                    $newScholarship->scholarshipAmount = $request->scholarshipAmount;
                    $newScholarship->requirements = $request->requirements;
                    $newScholarship->numberOfRespondents = $request->numberOfRespondents;
                    $newScholarship->status = "active";
                    $isSave = $newScholarship->save();
                    if ($isSave) {
                        session()->put("successAddScholarship", true);
                    } else {
                        session()->put("errorAddScholarship", true);
                    }
                }
            }
            return redirect("/org_scholars");
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
    public function destroy(string $id, Request $request)
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "org") {
                return redirect("/logout");
            }

            if ($request->btnDeleteScholar) {
                $deleteCount = DB::table('scholarships')->where('id', '=', $id)->delete();
                if ($deleteCount > 0) {
                    session()->put("successDeleteScholarship", true);
                } else {
                    session()->put("errorDeleteScholarship", true);
                }
            }

            return redirect("/org_sch_list");
        }
        return redirect("/");
    }
}
