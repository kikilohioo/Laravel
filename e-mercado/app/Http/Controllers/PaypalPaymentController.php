<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\PaypalPayment;
use TheSeer\Tokenizer\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaypalPaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('paypal/success'),
                'cancelUrl' => url('paypal/error')
            ))->send();

            if($response->isRedirect()){
                $response->redirect();
            }else{
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();

                $payment = new PaypalPayment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->status = $arr['state'];

                $payment->save();
            }else{
                return redirect()
                ->route('main')
                ->withErrors('Oops! an error has been detected, try again o contact us.');
            }

            return redirect()
            ->route('main')
            ->withSuccess('Thanks! Your payment has been processed successfully!');
        }else{
            return redirect()
            ->route('main')
            ->withErrors('Oops! an error has been detected, try again o contact us.');
        }
    }

    public function error()
    {
        return redirect()
        ->route('main')
        ->withErrors('Oops! User declined the payment.');
    }
}
