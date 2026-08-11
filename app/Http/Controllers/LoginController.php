<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            return redirect("/");
        }
        return view('login');
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
        if ($request->btnLogin) {
            $queryResult = json_decode(DB::table('users')->where('email', '=', $request->email)->get(), true);
            if (count($queryResult) > 0) {
                $user = array();
                foreach ($queryResult as $q) {
                    if (password_verify($request->password, $q['password'])) {
                        $user = $q;
                        break;
                    }
                }
                if (count($user) > 0) {
                    if ($user['userType'] == "user" && $user['status'] == "active") {
                        session()->put("successLogin", true);
                        session()->put("users", $user);
                        return redirect("/user_home");
                    } else if ($user['userType'] == "org" && $user['status'] == "active") {
                        session()->put("successLogin", true);
                        session()->put("users", $user);
                        return redirect("/org_home");
                    } else {
                        session()->put("unauthorized", true);
                    }
                } else {

                    session()->put("errorLogin", true);
                }
            } else {
                session()->put("errorLogin", true);
            }
        }
        return redirect("/login");
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
