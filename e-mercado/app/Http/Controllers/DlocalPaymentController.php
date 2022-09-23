<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\DlocalPayment;

class DlocalPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = $request->user();
        $body = array(
            'payer' => array(
                'name' => $user->name,
                'email' => $user->email,
                //'birth_date' => '09-07-1999',
                'phone' => '+59895448562',
                'document' => '49018125',
                'user_reference' => $user->id,
                'ip' => '192.168.1.24',
                'device_id' => 'f4fd6r43',//pensar en algo como: $user->devices()->where('MAC', $request->mac)???
            ),
            'amount' => $request->input('amount'),
            'currency' => env('DLOCAL_CURRENCY'),
            'payment_method_id' => 'VD',
            'payment_method_flow' => 'REDIRECT',
            'country' => 'UY',
            'order_id' => $request->input('order_id'),
            'original_order_id' => $request->input('order_id'),
            'notification_url' => route('dlocal.pending'),
            'callback_url' => route('dlocal.success'),
        );

        $date = (new \DateTime())->format('c');
        $client = new Client();

        $response = $client->request('POST', 'https://sandbox.dlocal.com/payments', [
            'body' =>json_encode($body),
            'headers' => [
                'Authorization' => 'V2-HMAC-SHA256, Signature: '.hash_hmac('sha256', env('DLOCAL_X_LOGIN').$date.json_encode($body), env('DLOCAL_SECRET')),
                'Content-Type' => 'application/json',
                'User-Agent' => 'MerchantTest / 1.0',
                'X-Date' => $date,//'2022-09-21T13:46:28.629Z',
                'X-Login' => env('DLOCAL_X_LOGIN'),
                'X-Trans-Key' => 'x4HACcCzbk',
                'X-Version' => '2.1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $arr = json_decode($response->getBody()->getContents());

        $payment = new DlocalPayment();
        $payment->payment_id = $arr->id;
        $payment->currency = $arr->currency;
        $payment->payment_method_id = $arr->payment_method_id;
        $payment->amount = $arr->amount;
        $payment->status = $arr->status;

        $payment->save();

        return redirect()
            ->route('main')
            ->withSuccess('Thanks! Your payment has been processed successfully!');
    }
}
