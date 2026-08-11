<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Cashins;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrgTransactionController extends Controller
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

            $allData = DB::table('vwtransactions')
                ->where('ownerID', '=', $user['userID'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $checkBalance = DB::table('balances')->where('userID', '=', $user['userID'])->count();
            if ($checkBalance == 0) {
                $newBalance = new Balance();
                $newBalance->userID = $user['userID'];
                $newBalance->amount = 0;
                $newBalance->save();
            }

            $phpRate = $this->getEthToPhpRate();
            $contractABI = config('contract.abi');
            $contractAddress = env('CONTRACT_ADDRESS');
            $rpcURL = env('LOCAL_RPC');
            $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
            $myBalance = $myBalanceArr[0]['amount'];
            return view('org.transactions', [
                'transactions' => $allData,
                'notifCount' => $notifCount,
                'phpRate' => $phpRate,
                'contractABI' => $contractABI,
                'contractAddress' => $contractAddress,
                'userID' => $user['userID'],
                'myBalance' => $myBalance,
                'rpcURL' => $rpcURL
            ]);
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

            if ($request->btnAddCash) {
                $newCashin = new Cashins();
                $newCashin->userID = $user['userID'];
                $newCashin->amount = $request->amount;
                $newCashin->transactionHash = $request->thash;
                $newCashin->ethAmount = $request->eth;
                $isSave = $newCashin->save();
                $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
                $myBalance = $myBalanceArr[0]['amount'];
                $myBalance = $myBalance + $request->amount;
                DB::table('balances')->where('id', '=', $myBalanceArr[0]['id'])->update([
                    'amount' => $myBalance,
                ]);
                if ($isSave) {
                    $newNotif = new Notifications();
                    $newNotif->userID = $user['userID'];
                    $newNotif->message = "You have Successfully Cashin Amount Of " . $request->amount;
                    $newNotif->status = 'unread';
                    $newNotif->save();
                    session()->put("successCashin", true);
                } else {
                    session()->put("errorCashin", true);
                }
            } else if ($request->btnDisburse) {
                $request->validate([
                    'thash' => ['required', 'regex:/^0x[a-fA-F0-9]{64}$/'],
                    'amount' => ['required', 'numeric', 'min:0'],
                    'transID' => ['required', 'integer', 'exists:transactions,id'],
                ]);

                $myBalanceArr = json_decode(DB::table('balances')->where('userID', '=', $user['userID'])->get(), true);
                $myBalance = $myBalanceArr[0]['amount'];
                $myBalance = $myBalance - $request->amount;
                DB::table('balances')->where('id', '=', $myBalanceArr[0]['id'])->update([
                    'amount' => $myBalance,
                ]);

                [$chainVerified, $chainNote] = $this->verifyOnChainReceipt($request->thash);

                $updateCount = DB::table('transactions')->where('id', '=', $request->transID)->update([
                    "transactionHash" => $request->thash,
                    "amountReceived" => $request->amount,
                    "status" => "disbursed",
                    "chainVerified" => $chainVerified,
                    "chainVerificationNote" => $chainNote,
                ]);
                if ($updateCount > 0) {
                    $newNotif = new Notifications();
                    $newNotif->userID = $user['userID'];
                    $newNotif->message = "You have Successfully Disbursed Fund Amounting To P" . $request->amount;
                    $newNotif->status = 'unread';
                    $newNotif->save();

                    $newNotif = new Notifications();
                    $newNotif->userID = $request->studentID;
                    $newNotif->message = "Your Scholarship Funds Amounting To P" . number_format($request->amount, 4) . " has been successfully disbursed to your designated payment address";
                    $newNotif->status = 'unread';
                    $newNotif->save();
                    session()->put("successDisbursed", true);
                } else {
                    session()->put("errorDisbursed", true);
                }
            }
            return redirect("/org_transactions");
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

    /**
     * The browser reports a transaction hash after sending funds via the
     * org's own wallet, but the server previously recorded that hash and
     * amount as-is with no independent check -- an org could mark a
     * disbursement "disbursed" using a fabricated or unrelated hash, since
     * nothing confirmed the transaction actually happened, succeeded, or
     * involved this contract. This calls the RPC node's own
     * eth_getTransactionReceipt so the recorded chainVerified status
     * reflects reality rather than an unverified client claim. Verification
     * failure (unreachable RPC, unmined tx, or a reverted call) does not
     * block the disbursement -- the org's wallet already sent real funds --
     * it only means the record is honestly flagged as unverified instead of
     * silently trusted.
     *
     * @return array{0: bool, 1: string} [chainVerified, note]
     */
    private function verifyOnChainReceipt(string $txHash): array
    {
        $rpcURL = env('LOCAL_RPC');
        $contractAddress = env('CONTRACT_ADDRESS');

        if (!$rpcURL) {
            return [false, 'Not verified: no blockchain RPC endpoint is configured for this environment.'];
        }

        try {
            $response = Http::timeout(10)->post($rpcURL, [
                'jsonrpc' => '2.0',
                'id' => 1,
                'method' => 'eth_getTransactionReceipt',
                'params' => [$txHash],
            ]);
        } catch (\Throwable $e) {
            return [false, 'Not verified: could not reach the RPC endpoint (' . $e->getMessage() . ').'];
        }

        if (!$response->successful()) {
            return [false, 'Not verified: RPC endpoint returned an error response.'];
        }

        $receipt = $response->json('result');

        if (!$receipt) {
            return [false, 'Not verified: no transaction receipt found for this hash (not yet mined, or invalid).'];
        }

        if (($receipt['status'] ?? null) !== '0x1') {
            return [false, 'Not verified: the on-chain transaction reverted or failed.'];
        }

        if ($contractAddress && strtolower($receipt['to'] ?? '') !== strtolower($contractAddress)) {
            return [false, 'Not verified: transaction receipt does not target the configured scholarship contract.'];
        }

        return [true, 'Verified against the transaction receipt returned by the RPC endpoint at disbursement time.'];
    }
}
