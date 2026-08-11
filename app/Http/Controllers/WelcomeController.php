<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] == "user") {
                return redirect("/user_home");
            } else {
                return redirect("/logout");
            }
        }

        $mDate =  date('Y-m-d', strtotime('-14 years'));
        return view('welcome', ['maxDate' => $mDate]);
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
        if ($request->btnSignup) {
            $userCount = DB::table('users')->where('email', '=', $request->email)->count();
            if ($userCount > 0) {
                session()->put("errorEmailExist", true);
            } else {
                $newUser = new Users();
                $newUser->firstName = $request->firstName;
                $newUser->middleName = $request->middleName;
                $newUser->lastName = $request->lastName;
                $newUser->address = $request->address;
                $newUser->birthDate = $request->birthDate;
                $newUser->gender = $request->gender;
                $newUser->email = $request->email;
                $newUser->password = Hash::make($request->password);
                $newUser->userType = $request->userType;
                if ($request->userType == "org") {
                    $newUser->status = "active";
                } else if ($request->userType == "user") {
                    $newUser->status = "active";
                }
                $isSave = $newUser->save();
                if ($isSave) {
                    session()->put("successUserCreate", true);
                } else {
                    session()->put("errorUserCreate", true);
                }
            }
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
