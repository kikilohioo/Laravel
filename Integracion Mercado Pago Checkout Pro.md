# Integracion Mercado Pago Checkout Pro
1. Creamos la cuenta de Mercado Pago
2. Creamos una aplicacion para generar nuestras claves de integracion
3. Crearemos 2 cuentas de prueba, 1 para emular un vendedor y otra para emular un comprador
4. Accederemos con las credenciales del vendedor a Mercado Pago
5. Crearemos nuevamente una app con otro nombre y usaremos esas credenciales para realizar las pruebas sobre el sistema
6. Registramos las un servicio en el archivo config/services.php de la siguiente forma:
	```
	'mercadopago' => [
		'key' => env('MP_PUBLIC_KEY'),
		'token' => env('MP_ACCESS_TOKEN')
	]
	```
7. En el archivo .env incluiremos nuestras credenciales de la cuenta de prueba, generada en nuestra cuenta real
8. Instalar el SDK de Mercado Pago con el comando 
	```composer require mercadopago/dx-php```
9. Considerar revisar error de psr-4 standar con posible solucion en composer.lock o composer.json 
	```
	"autoload": {
		"psr-4": {
			"App\\": "app/",
			"Database\\Factories\\": "database/factories/",
			"Database\\Seeders\\": "database/seeders/",
			"MercadoPago\\": "vendor/mercadopago/dx-php/src/"
		}
	}
	```

### Formas de integrarlo
No se exactamente cual es la mejor forma, pero de momento no he podido enviar el objeto de ```$preference``` de Marcado Pago hacia el front para su posterior prosesamiento. Actualmente estoy realizando lo siguiente:
1. En el controlador que retorna la vista de pago, envio el ```$preference->id``` a traves de la URL
2. En la plantilla de blade para el pago tomo ese ```$preference->id``` y armo los scripts necesarios para conformar el Checkout Modal y procesar el pago de la siguiente forma
	```
	<script>
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const cart_id = urlParams.get('cart')
		const mp = new MercadoPago('{{config('services.mercadopago.key')}}', {
			locale: 'es-AR'
		});

		mp.checkout({
			preference: {
			id: cart_id
			},
			render: {
			container: '.cho-container',
			label: 'Pagar',
			}
		});
	</script>
	```

#### Camino Alternativo(original visto en video de YouTube)
1. En archivo de plantilla blade que servirá para realizar el checkout inlcuir estas lineas al inicio del archivo:
	```
	@php
		// SDK de Mercado Pago
		require base_path('/vendor/autoload.php');
		// Agrega credenciales
		MercadoPago\SDK::setAccessToken(config('services.token'));

		$item = new Item();
		$item->title = 'Papas Fritas';
		$item->quantity = 2;
		$item->unit_price = 100.00;
		$preference = new Preference();
		$preference->items = array($item);    
		$preference->save();
	@endphp
	```
2. Posteriormente deberiamos de tener acceso al obejto de preferencias y los datos de los items con mayor flexibildiad y de forma más segura

Aclaracion: de esta forma hay un error interno en el framework que no he podido debuguear

## Proximas pruebas o mejoras
- Integrar feedback con sistema propio de control de pagos
- Desarrollar endponits para recepcion de actualizacion de estado de pagos