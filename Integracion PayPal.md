# Integracion Paypal Checkout
1. Crear una aplicacion en el developer dashboard de paypal en:
```https://developer.paypal.com/dashboard```
2. Agregaremos las siguientes credenciales al .env de nuestro proyecto
```
PAYPAL_CLIENT_ID= --Client ID de paypal--
PAYPAL_CLIENT_SECRET= --Secret de paypal--
PAYPAL_CURRENCY=USD
```
3. Crear Modelo y Migracion para gestion de datos de los pagos
	```
	Schema::create('paypal_payments', function (Blueprint $table) {
		$table->id();
		$table->string('payment_id');
		$table->string('payer_id');
		$table->string('payer_email');
		$table->float('amount', 10, 2);
		$table->string('currency');
		$table->string('status');
		$table->timestamps();
	});
	```
	Y ejecutar migracion para que quede montada la tabla.
4. Instalar libreria Omnipay para la gestion de pagos e integrar más facil PayPal. Ejecutamos:
```composer require league/omnipay omnipay/paypal```

5. Crear controlador PaypalPaymentController con comando ```php artisan make:controller PaypalPaymentController```
6. El controlador debe tener un codigo basico de esta forma:
	```
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
				'returnUrl' => url('success'),
				'cancelUrl' => url('error')
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
	```
7. En el front deberemos de generar un formulario que envie los datos del pago al endpoint que procesará posteriormente el pago.
	```
	<form action="--endpoint--" method="post">
		@crsf
		<button class="mt-2 btn btn-primary" type="submit">
			Pagar con 
			<i class="fa-2xl fa-brands fa-cc-paypal"></i>
		</button>
	</form>
	```
8. Generar ruta para iniciar el checkout
```Route::post('paypal', 'PaypalPaymentController@pay')->name('paypal.pay');```
9. Y por ultimo una ruta para procesar el error o el exito de la operacion, asi como recuperar los datos de la transaccion y almacenarlos para controlarlos
```
Route::post('paypal/success', 'PaypalPaymentController@pay')->name('paypal.success');
Route::post('paypal/error', 'PaypalPaymentController@pay')->name('paypal.error');
```

Codigo de metodo en el controlador
```
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
```

## Proximas pruebas o mejoras
- Probar integracion con asociacion de pagos a traves de la orden como en sitema de pago comun
- Buscar solucion en formato de modal o in site
- Crear endpoints para cambios de estados de pagos