<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] == "user") {
                return redirect("/user_home");
            } elseif ($user['userType'] == "org") {
                return redirect("/org_home");
            }

            return redirect("/logout");
        }

        return view('welcome');
    }
}
