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
10. En archivo de plantilla blade que servirá para realizar el checkout inlcuir estas lineas al inicio del archivo:
	```
	@php
	// SDK de Mercado Pago
	require base_path('/vendor/autoload.php');
	// Agrega credenciales
	MercadoPago\SDK::setAccessToken(config('services.token'));
	@endphp
	```