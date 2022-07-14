# Anotaciones Laravel
* Buena práctica #1
	Agregar nombres a las rutas con ```...->name('nombreRuta')```
#### Comandos Artisan
A todos agregar antes ```php artisan```
- ```serve``` para iniciar el servidor de desarrollo
- ```tinker``` entrar a consola para interactuar más facilmente con los modelos y las bases de datos
- ```generate:key``` genera una ```APP_KEY``` en el archivo ```.env```
- ```config:cache``` guarda las variables del ```.env``` y las deja accesibles en ```config('app.variable')```
- ```config:clear``` limpia las variables desde el cache y deja acceder desde ```evn('varible')``` o desde ```config('app.variable')```
- ```make:controller [NameController]``` para crear un controlador