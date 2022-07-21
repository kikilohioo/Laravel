# Anotaciones Laravel
* Buena práctica #1
	Agregar nombres a las rutas con ```...->name('nombreRuta.metodo')```
* Buena práctica #2
	Formas de redirigir 
	- ```return redirect()->back()```
	- ```return redirect()->action('ControllerName@metodo')```
	- ```return redirect()->route(''nombreruta.metodo)```

#### Comandos Artisan
A todos agregar antes ```php artisan```
- ```serve``` para iniciar el servidor de desarrollo
- ```tinker``` entrar a consola para interactuar más facilmente con los modelos y las bases de datos
- ```generate:key``` genera una ```APP_KEY``` en el archivo ```.env```
- ```config:cache``` guarda las variables del ```.env``` y las deja accesibles en ```config('app.variable')```
- ```config:clear``` limpia las variables desde el cache y deja acceder desde ```evn('varible')``` o desde ```config('app.variable')```
- ```make:controller [NameController]``` para crear un controlador
- ```migrate:fresh``` se usa para crear la base de datos, a traves de los modelos y migraciones
- ```migrate:fresh --seed``` se usa para crear la base de datos, a traves de los modelos y migraciones, y además crea información random a traves de los factories y seeders

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
