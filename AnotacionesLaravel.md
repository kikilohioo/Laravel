# Anotaciones Laravel
#### Como Iniciar
- ```composer create-project laravel/laravel example-app``` ejecutamos este comando con el nombre del proyecto
- ```cd example-app``` nos cambiamos al directorio raiz del proyecto y listo
- Para integración con React instalar libreraria laravel/ui con comando ```composer require laravel/ui``` y usamos el comando ```php artisan ui react --auth``` para montar el ambiente para conectar con apps de React(puede ser Vue o Bootstrap tambien)

* Buena práctica #1
	Agregar nombres a las rutas con ```...->name('nombreRuta.metodo')```
* Buena práctica #2
	Formas de redirigir 
	- ```return redirect()->back()```
	- ```return redirect()->action('ControllerName@metodo')```
	- ```return redirect()->route(''nombreruta.metodo)```
* Buena práctica #3
	Resolver mediante inyección implicitad de modelos las operaciones show | update | destroy y cualquier otra que depende de encontrar un elemento asociado a un modelo, mediante su identificador. Esto se realiza casteando el parametro al momento de recibirlo en el metodo encargado de gestionar la operación en cuestion 
	``` public function show(Model $modelById){...}``` de esta forma, adentro del metodo show ```$modelById``` es el mismo resultado que la operación ```Model::findOrFail($modelById)```. Con la excepción de que en el enrrutamiento podemos resolver sobre cual parametro realizar la busqueda de la siguiente forma 
	````Route::get('model/{modelById:otherField}')``` ahora va a hacer un ```findOrFail()``` con otro parametro del modelo, en este caso ```otherField```
* Buena práctica #4
	Mantener los nombres de los metodos de las operaciones CRUD con las recomendaciones de laravel (index,show,store,update,destroy) nos permite resolver todas esas rutas de forma muy simple. Todas las lineas de enrrutamiento anteriores para cada metodo se resuelven en una sola ```Route::resource('model', 'ModelController')```. Además podemos excluir mediante los metodos ```->only([...]) o ->except([...])```
* Buena práctica #5
	Hay que tener en cuenta el orden en el que se crean las migraciones para que no hayan conflictos en las relaciones con claves foraneas en la base de datos


#### Comandos Artisan
A todos agregar antes ```php artisan```
- ```serve``` para iniciar el servidor de desarrollo
- ```tinker``` entrar a consola para interactuar más facilmente con los modelos y las bases de datos
- ```generate:key``` genera una ```APP_KEY``` en el archivo ```.env```
- ```config:cache``` guarda las variables del ```.env``` y las deja accesibles en ```config('app.variable')```
- ```config:clear``` limpia las variables desde el cache y deja acceder desde ```evn('varible')``` o desde ```config('app.variable')```
- ```make:model [Name]``` para crear un modelo
- ```make:controller [NameController]``` para crear un controlador
- ```migrate:fresh``` se usa para crear la base de datos, a traves de los modelos y migraciones
- ```migrate:fresh --seed``` se usa para crear la base de datos, a traves de los modelos y migraciones, y además crea información random a traves de los factories y seeders
- ```make:request [NameRequest]``` para separar la logica de validación de campos a un lugar mas centralizado, luego permite hacer inyección de dependencias en le controlador ```public function create(ModelRequest $request)```
- ```make:model -a``` te crea el modelo, controlador, migracion, factory y seeder

#### Query Builder
Se usa cuando no se puede usar Eloquent. Debemos de incluir ```use Illuminate\Support\Facades\DB``` en el archivo donde quieramos usarlo y ejecutar cosas como ```DB::table('products')->get()``` para realizar acciones sobre la base de datos.
más info en https://laravel.com/docs/9.x/queries

#### Eloquent
Es el ORM de Laravel y sirve para hacer interacciones a la base de datos a traves de los modelos por ejemplo incluyendo ```use App\Models\Product``` en el archivo donde quieramos usarlo y ejecutar cosas como ```Product::findOrFail('products');```

* #### Como traer todos los registros
	```$entidades = Entidad::all()->where()``` el where es para agregar condiciones
* #### Como traer un registro solo
	```$entidad = Entidad::findOrFail($id)``` aplica el metodo where
* #### Como crear un registro
	```$entidad = new Entidad()``` aplica el metodo where
	```$entidad->campo1 = ...```
	```$entidad->campo2 = ...```
	```...```
	```$entidad->save()```
* #### Como editar un registro
	```$entidad = Entidad::findOrFail($id)``` aplica el metodo where
	```$entidad->campo1 = ...```
	```$entidad->campo2 = ...```
	```...```
	```$entidad->save()```
* #### Como eliminar un registro
	```$entidad = Entidad::findOrFail($id)``` aplica el metodo where
	```$entidad->delete()```
