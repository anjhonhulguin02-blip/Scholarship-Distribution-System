<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrgReviewApplicantController extends Controller
{
    public function index(Request $request)
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "org") {
                return redirect("/logout");
            }

            $checkBalance = DB::table('balances')->where('userID', '=', $user['userID'])->count();
            if ($checkBalance == 0) {
                $newBalance = new Balance();
                $newBalance->userID = $user['userID'];
                $newBalance->amount = 0;
                $newBalance->save();
            }

            $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
            $myBalance = $myBalanceArr[0]['amount'];


            $id = $request->query('id');
            if ($id) {
                $phpRate = $this->getEthToPhpRate();
                $contractABI = config('contract.abi');
                $contractAddress = env('CONTRACT_ADDRESS');
                $rpcURL = env('LOCAL_RPC');
                $privateKey = env('PRIVATE_KEY');
    
                $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();

                $data = json_decode(DB::table('vwapplications')->where('applicationID', '=', $id)->get(), true);

                return view('org.review', [
                    'data' => $data[0],
                    'notifCount' => $notifCount,
                    'phpRate' => $phpRate,
                    'contractABI' => $contractABI,
                    'contractAddress' => $contractAddress,
                    'userID' => $user['userID'],
                    'myBalance' => $myBalance,
                    'rpcURL' => $rpcURL,
                    'privateKey' => $privateKey
                ]);
            }

            return redirect("/org_applications");
        }
        return redirect("/");
    }

    function getEthToPhpRate()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => 'ethereum',
            'vs_currencies' => 'php'
        ]);

        if ($response->successful()) {
            return $response->json()['ethereum']['php'];
        }

        return null; // Handle API failure
    }
}
