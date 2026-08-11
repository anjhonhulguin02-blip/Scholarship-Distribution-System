<?php

namespace App\Http\Controllers;

use App\Models\ApplicationRemarks;
use App\Models\Notifications;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgApplicationsController extends Controller
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

            $allData = DB::table('vwapplications')
                ->where('userID', '=', $user['userID'])
                ->orderBy('applicationCreateDate', 'desc')
                ->paginate(10);

            return view('org.applications', ['applications' => $allData, 'notifCount' => $notifCount]);
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

            if ($request->btnUpdateAppl) {
                $newRemarks = new ApplicationRemarks();
                $newRemarks->studentID = $request->studentID;
                $newRemarks->remarks = $request->remarks;
                $isSave = $newRemarks->save();
                if ($isSave) {
                    session()->put("successAddRemarks", true);
                    $newNotif = new Notifications();
                    $newNotif->userID = $request->studentID;
                    $newNotif->message = $request->remarks;
                    $newNotif->status = 'unread';
                    $newNotif->save();
                } else {
                    session()->put("errorAddRemarks", true);
                }
            } else if ($request->btnApprove) {
                $newRemarks = new ApplicationRemarks();
                $newRemarks->studentID = $request->studentID;
                $newRemarks->remarks = $request->remarks;
                $isSave = $newRemarks->save();
                if ($isSave) {
                    $newNotif = new Notifications();
                    $newNotif->userID = $request->studentID;
                    $newNotif->message = $request->remarks;
                    $newNotif->status = 'unread';
                    $newNotif->save();

                    $newTrans = new Transactions();
                    $newTrans->applicationID = $request->applicationID;
                    $newTrans->status = "waiting for disbursement";
                    $newTrans->save();


                    $updateCount = DB::table('applications')->where('id', '=', $request->applicationID)->update(['status' => 'approved']);
                    if ($updateCount > 0) {
                        session()->put("successApproved", true);
                    } else {
                        session()->put("errorApproved", true);
                    }
                } else {
                    session()->put("errorApproved", true);
                }
            } else if ($request->btnApproveWithDisburse) {
                $newRemarks = new ApplicationRemarks();
                $newRemarks->studentID = $request->studentID;
                $newRemarks->remarks = $request->remarks;
                $isSave = $newRemarks->save();
                if ($isSave) {
                    $newNotif = new Notifications();
                    $newNotif->userID = $request->studentID;
                    $newNotif->message = $request->remarks;
                    $newNotif->status = 'unread';
                    $newNotif->save();

                    $newNotif = new Notifications();
                    $newNotif->userID = $request->studentID;
                    $newNotif->message = "Your Scholarship Funds Amounting To P" . number_format($request->amount, 4) . " has been successfully disbursed to your designated payment address";
                    $newNotif->status = 'unread';
                    $newNotif->save();

                    $newTrans = new Transactions();
                    $newTrans->applicationID = $request->applicationID;
                    $newTrans->status = "disbursed";
                    $newTrans->transactionHash = $request->thash;
                    $newTrans->amountReceived = $request->amountReceived;
                    $newTrans->save();

                    $newNotif = new Notifications();
                    $newNotif->userID = $user['userID'];
                    $newNotif->message = "You have Successfully Disbursed Fund Amounting To P" . $request->amount;
                    $newNotif->status = 'unread';
                    $newNotif->save();

                    $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
                    $myBalance = $myBalanceArr[0]['amount'];
                    $myBalance = $myBalance - $request->amount;
                    DB::table('balances')->where('id', '=', $myBalanceArr[0]['id'])->update([
                        'amount' => $myBalance,
                    ]);

                    DB::table('transactions')->where('id', '=', $request->transID)->update([
                        "transactionHash" => $request->thash,
                        "amountReceived" => $request->amount,
                        "status" => "disbursed"
                    ]);

                    $updateCount = DB::table('applications')->where('id', '=', $request->applicationID)->update(['status' => 'approved']);
                    if ($updateCount > 0) {
                        session()->put("successApprovedWithDisbursed", true);
                    } else {
                        session()->put("errorApprovedWithDisbursed", true);
                    }
                } else {
                    session()->put("errorApprovedWithDisbursed", true);
                }
            } else if ($request->btnReject) {
                $updateCount = DB::table('applications')->where('id', '=', $request->applicationID)->update(['status' => 'rejected']);
                if ($updateCount > 0) {
                    session()->put("successRejected", true);
                } else {
                    session()->put("errorReject", true);
                }
            }

            return redirect("/org_applications");
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
