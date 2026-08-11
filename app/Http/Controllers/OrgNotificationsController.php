<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgNotificationsController extends Controller
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
            $data = DB::table('notifications')
                ->where('userID', '=', $user['userID'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('org.notifications', ['notifCount' => $notifCount, 'data' => $data]);
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

            if ($request->btnMarkRead) {
                $updateCount = DB::table('notifications')->where('id', '=', $request->notifID)->update([
                    "status" => "read"
                ]);
                if ($updateCount > 0) {
                    session()->put("successMarkAsRead", true);
                } else {
                    session()->put("errorMarkAsRead", true);
                }
            } else if ($request->btnDeleteNotif) {
                $deleteCount = DB::table('notifications')->where('id', '=', $request->notifID)->delete();
                if ($deleteCount > 0) {
                    session()->put("successDelete", true);
                } else {
                    session()->put("errorDelete", true);
                }
            }


            return redirect("/org_notifications");
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
    public function destroy(string $id, Request $request) {}
}
