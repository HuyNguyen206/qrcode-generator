<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Qrcode;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Flash;
use Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
//            \request()->request->replace()
            if (\request()->email) {
                $user = User::query()->firstWhere('email', \request()->email);
                if(!$user) {
                    $user = User::factory()->create([
                        'email' => \request()->email,
                        'name' => \request()->email
                    ]);
                }
            } else {
                $user = auth()->user();
            }
            $qrcode = Qrcode::find(\request()->qrcodeId);
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'qrcode_id' =>  $qrcode->id,
                'status' => 'initiated',
                'qrcode_owner_id' => $qrcode->user_id,
                'payment_method' => 'paystack',
                'amount' => $qrcode->amount
            ]);
            \request()->merge([
                'order_id' => $transaction->id,
                'metadata' => json_encode([
                    'buyer_user_id' => $user->id,
                    'buyer_user_email' => $user->email,
                    'qrcode_id' => $qrcode->id,
                    'transaction_id' => $transaction->id
                ], JSON_THROW_ON_ERROR)
            ]);
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            Flash::error('The paystack token has expired. Please refresh the page and try again');
            return Redirect::back();
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $data = $paymentDetails['data'];
        $transaction =  Transaction::find($data['metadata']['transaction_id']);
        $qrcodeId = $data['metadata']['qrcode_id'];
        if ($data['status'] !== 'success') {
            Flash::error("Sorry. Payment Fail. {$paymentDetails['message']}");
            $transaction->update([
                'status' => 'failure',
                'message' => $paymentDetails['message']
            ]);
            return \redirect()->route('qrcodes.show', $qrcodeId);
        }
        $qrcode = Qrcode::find($qrcodeId);
        if($qrcode->amount != $data['amount']/100) {
            Flash::error('Sorry. You paid the wrong amount. Please contact admin');
            $transaction->update([
                'status' => 'failure',
                'message' => 'wrong amount'
            ]);
            return \redirect()->route('qrcodes.show', $qrcodeId);
        }
        $buyerId = $data['metadata']['buyer_user_id'];
        $buyerAccount = Account::where('user_id',$buyerId)->first();
        $buyerAccount->update([
            'total_debit' => DB::raw("total_credit + $qrcode->amount")
        ]);
        $buyerAccount->accountHistories()->create([
           'user_id' => $buyerId,
           'message' => "Paid $transaction->payment_method payment to {$qrcode->user->email}
           for qrcode $qrcode->product_name"
        ]);
        $transaction->update([
            'status' => 'completed',
            'message' => 'Payment successfully'
        ]);
        Flash::success('Success. Payment successfully.');
        return \redirect()->route('transactions.show', $transaction->id);

        //Send email notification to buyer and qrcorde owner
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    public function redirectToCallBack()
    {
        $user = User::query()->firstWhere('email', \request()->email);
        if(!$user) {
            $user = User::factory()->create([
                'email' => \request()->email,
                'name' => \request()->email
            ]);
        }

    }
}
