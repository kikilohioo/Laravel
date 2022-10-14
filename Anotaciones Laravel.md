# Anotaciones Laravel
#### Como Iniciar
- ```composer create-project laravel/laravel example-app``` ejecutamos este comando con el nombre del proyecto
- ```cd example-app``` nos cambiamos al directorio raiz del proyecto y listo
- Para integración con React instalar libreraria laravel/ui con comando ```composer require laravel/ui``` y usamos el comando ```php artisan ui react --auth``` para montar el ambiente para conectar con apps de React(puede ser Vue o Bootstrap tambien)

## Laravel ### Tips
* ### Tip #1
	Agregar nombres a las rutas con ```...->name('nombreRuta.metodo')```
* ### Tip #2
	Formas de redirigir 
	- ```return redirect()->back()```
	- ```return redirect()->action('ControllerName@metodo')```
	- ```return redirect()->route(''nombreruta.metodo)```
* ### Tip #3
	Resolver mediante inyección implicitad de modelos las operaciones show | update | destroy y cualquier otra que depende de encontrar un elemento asociado a un modelo, mediante su identificador. Esto se realiza casteando el parametro al momento de recibirlo en el metodo encargado de gestionar la operación en cuestion 
	``` public function show(Model $modelById){...}``` de esta forma, adentro del metodo show ```$modelById``` es el mismo resultado que la operación ```Model::findOrFail($modelById)```. Con la excepción de que en el enrrutamiento podemos resolver sobre cual parametro realizar la busqueda de la siguiente forma 
	```Route::get('model/{modelById:otherField}')``` ahora va a hacer un ```findOrFail()``` con otro parametro del modelo, en este caso ```otherField```
* ### Tip #4
	Mantener los nombres de los metodos de las operaciones CRUD con las recomendaciones de laravel (index,show,store,update,destroy) nos permite resolver todas esas rutas de forma muy simple. Todas las lineas de enrrutamiento anteriores para cada metodo se resuelven en una sola ```Route::resource('model', 'ModelController')```. Además podemos excluir mediante los metodos ```->only([...]) o ->except([...])```
* ### Tip #5
	Hay que tener en cuenta el orden en el que se crean las migraciones para que no hayan conflictos en las relaciones con claves foraneas en la base de datos
* ### Tip #6
	Para construccion de relaciones con modelos con claves compuestas debemos sobrescribir el siguiente metodo de la siguiente forma
	 ```
	 /**
     * Set the keys for a select query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSelectQuery($query)
    {
        $query->where([
            'id_usuario' => $this->id_usuario,
            'id_rol' => $this->id_rol,
        ]);

        return $query;
    }
	 ```
* Para traer datos de relaciones de muchos a muchos, con datos de tablas pivot se puede hacer lo siguiente en la declaracion de las relaciones
```
return $this->belongsToMany(Product::class)->withPivot('quantity');
```
* ### Tip #7
	Descentralizar la gestion de las validaciones con un CustomFormRequest, para eso primero creaemos un archivo ModelRequest con el comando ```php artisan make:request ModelRequest```
	en el que editaremos el metodo rules() incluyendo ahi las reglas basicas de validacion como en el siguiente ejemplo:
	```
	public function rules()
    {
        return [
            'title' => 'required',
            'description' => ['required', 'min:20'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
    }
	```
	además podremos agregar reglas personalizadas de validacion mediante el metood withValidator() que podremos agregar al ModelRequest como en el siguiente ejemplo
	```
	public function withValidator($validator)
    {
        $validator->after(function($validator){
            if ($this->status == 'available' && $this->stock == 0) {
                $validator->errors()
                ->add('stock', 'If available must have stock');
            }
        });
    }
	```
* ### Tip #8
	#### Controladores de recursos anidados
	Por ejemplo para agregar un producto a un carrito se usan este tipo de controladores, que responde o resuelve 2 modelos, uno padre y uno hijo.
	Se utiliza el comando 
	```
	php artisan make:controller PadreHijoController -m Hijo -p Padre
	```
	Además para registrar las rutas se recomienda usar una ruta de recursos de la siguiente forma
	```
	Route::resource('padre.hijo', 'PadreHijoController)
	```
* ### Tip #9
	Uso de getters para centralizar logicas sencillas como calcular precio total de un producto por su cantidad o simil, agregandolas como un "nuevo atributo" ejemplo:
	```
	public function getTotalAttribute(){
		return $this->pivot->quantity * $this->price;
	}
	```
	Retorna el valor total de ese producto y como regla general se usa get + nuevoAtributo + Attribute, accediendo luego como: ```$model->nuevoAtributo```
* ### Tip #10
	Habilitar log de consultas para conexion actual:
	```
	\DB::connection()->enableQueryLog();
	```
* ### Tip #11
	Usar metodo with() para evitar consultas excesivas a la base de datos para obtener entidades a traves de relaciones
	```
	Model::with('relation')->get()
	```
	O mejor aun, siempre que un modelo quieramos que venga con cierta relacion o relaciones, editamos el modelo agregando el siguiente atributo
	```
	protected $with = [
		'relation1',
		'relation2',
		...
	]
	```
	Adicionalmente para poder tener excepciones, existe el metodo without() que se usa de la siguiente forma
	```
	Model::without('relation')->get()
	```
* ### Tip #12
	Probar usar fill() and isDirty() para auditoria sobre modelos
* ### Tip #13
	Usando setters por ejemplo para automatizar la gestion de encriptacion de contraseñas
	```
	public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
	```
* ### Tip #14
	Soft Deletes, forma de eliminar parcialmente datos de la base de datos, para utilizar esta caracteristica de Laravel, deberemos de modificar el modelo en cuestion, dejandolo de la siguiente forma:
	```
	use Illuminate\Database\Eloquent\SoftDeletes;

	class Product extends Model
	{
    	use HasFactory, SoftDeletes;
	...
	```
	De esta forma al usar delete modificaremos el atributo ```deleted_at``` de la base de datos. Además accederemos a esos elementos "eliminados" saltandonos los global scopes usando el metodo ```withoutGlobalScopes()->onlyTrashed()```. Por ultimo podremos restaurarlos usando el metodo ```restore()```, aplicable tambien a colecciones.
* ### Tip #15
	Como crear comandos personalizados de artisan: usando el siguiente comando:
	```php artisan make:command CommandName```
	En el atributo signature registramos el comando en si y los parametros
	```protected $signature = 'carts:remove-old {--days=7 : The days after which the carts will be removed}';```
	Y por ultimo en el metodo handle realizaremos la tarea en si que realiza el comando, asi como los mensajes que devolveremos por consola.
* ### Tip #16
	Agendar ejecucion de comandos para automatizar tareas, se hace modificando el archivo Console\Kernel.php y ejecutnado el comando ```php artisan schedule:work``` para desarrollo y ```php artisan schedule:run``` para produccion(se debe indagar sobre cron job u eventos dependiendo del OS).
	Previo a su ejecucion deberemos de modificar en el archivo Kernel.php el metodo schedule() de la siguietne forma:
	```
	protected function schedule(Schedule $schedule)
    {
		$schedule->command('carts:remove-old')->daily();
    }
	```
* ### Tip #17
	Eventos desencadenados cuando se trae, crea, está creando, actualiza, está actualizando, elimina, está eliminando, restaura, está restaurando o replicando, un modelo en la DB. Se pueden crear a traves de los Events::class, con sus correspondientes Listeners::class, tambien pueden hacerse en Closures directamente en el modelo correspondiente o en el caso de que sean multiples eventos para un modelo solo, existen los Observers::class, para registrar multiples eventos de forma centralizada.



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
* #### Como crear un local scope
	En el modelo de la entidad crearemos una funcion por ejemplo para mostrar los productos disponibles en este ejemplo:
	```
	public function scopeAvailable($query){
        $query->where('status', 'available');
    }
	``` 
	Luego en el controlador o donde lo necesitemos llamaremos el scope de la siguiente manera:
	```
	Porduct::available()->get()
	```
* #### Como crear un global scope
	No existe comando aun en la version 9 de laravel para ello, por lo que deberemos crear el archivo a mano en su respectivo directorio App\Scopes\AnythingScope.php incluyendo las siguientes lineas de código.
	
	```
	<?php

	namespace App\Scopes;

	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Scope;


	class AnythingScope implements Scope
	{
		/**
		* Apply the scope to a given Eloquent query builder.
		*
		* @param  \Illuminate\Database\Eloquent\Builder  $builder
		* @param  \Illuminate\Database\Eloquent\Model  $model
		* @return void
		*/
		public function apply(Builder $builder, Model $model)
		{
			$builder->anything();
		}
	}
	``` 
	Luego en el modelo debemos registrar las scopes gloabales que utilizaremos de la siguiente forma.
	```
	/**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AnythingScope);
    }
	```
	Por ultimo para evadir el uso de un global scope debemos de generar un modelo que extienda del modelo donde queremos sacarlo y redefinir la fucnion ```booted()``` para asi desregistrar los scopes globales que deseemos. Aqui un codigo de ejemplo de productos:
	```
	<?php

	namespace App\Models;

	class PanelProduct extends Product
	{
		/**
		* The "booted" method of the model.
		*
		* @return void
		*/
		protected static function booted()
		{
			
		}
	}
	```

#### Broadcasting(push and realtime refreshing)
- Primero deberemos revisar nuestro archivo de configuracion en ```config/broadcasting.php```, donde observamos que por defecto viene ```null``` si no se indica en el ```.env``` archivo.
- Nos traeremos una libreria llamada Pusher mediante el comando ```composer require pusher/pusher-php-server```
- El siguiente paso es configurar adecuadamente Pusher, para ello iremos a pusher.com
- Iniciaremos sesion y crearemos nuestra app, seleccionando las tecnologias tanto para back-en como para front-end.
- Obtendremos unas keys de este estilo
```
app_id = "********"
key = "**********************"
secret = "************************"
cluster = "****"
```
- Estos datos deberemos agregarlos al ```.env``` archivo donde correspondan, asi como modificar esta variable de la siguiente forma```BROADCAST_DRIVER=pusher```
- Ahora crearemos un evento con el comando ```php artisan make:event EventName``` y agregaremos un ```... implement ShouldBroadcast``` al final del nombre de la clase
- Crearemos una variable publica que incluiremos en el constructor de la clase, que se resivirá en el mismo.
- Cambiamos el nombre del ```new PrivateChannel('nameHere')``` por lo que requiera cada caso
- Luego iremos al archivo ```config/app.php``` y descomentaremos la linea ```App\Providers\BroadcastServiceProvider::class,```
