<h2 margin="0 auto">Modulo CRUDs de Laravel</h2>

<h3>Modulo que despliega un CRUD de usuario desde 4 perspectivas</h3>

1. Haciendo uso del DataTable Server Side, extrae los datos de usuarios paginando en DataTable desde el mismo servidor
2. Haciendo uso del DataTable, extrae los usuarios y los muestra en DataTable.
3. Paginando los datos en la consulta a la Base de datos, usando un paginador propio.
4. A traves de una API, se desarrolla el proceso CRUD, a traves del uso de una API, el listado se genera consumiento una API creada por Laravel, la actualizacion de datos se hace enviando objetos JSON a Laravel, todos a traves del uso de Fetch.

<h3>Aplicaciones</h3>
1. Laravel Spatie, para la permisologia. https://spatie.be/docs/laravel-permission <br>
2. SimpleQR para la generación del código QR (simple-qrcode) <br>
3. Libreria de graficos highcharts en JavaScript.https://code.highcharts.com/highcharts.js <br>
4. Datatable server side ([yajra/laravel-datatables-oracle](https://datatables.net/examples/data_sources/server_side))

<h3>Funcionamiento</h3>
El modulo contiene 3 funciones generales: <br>
a) El cruds de usuarios, con las 4 opciones señaladas, para su acceso es necesario hacer login <br>
b) Generación de códigos QR (desde JS y Laravel) <br>
c) Grafico que muestra la cantidad de palabras según el número de caracteres que posean <br>
d) Los permisos solo son utilizados en los cruds despues de ejecutar el seeder vera los usuarios en la base de datos <br>

<h3>Instalación</h3>
1. Para instalar la aplicación proceda a clonar el repositorio. <br>
2. Ejecute la sentencia composer install (instalara todos los paquetes) <br>
3. Configure el archivo .env a partir del .env.example. <br>
4. Ejecute las migraciones laravel y el seeder, esto creara la BD y los registros faker de uso.(13 usuarios y roles, 12 niveles de permiso), todos los usuarios se crean con clave 12345678
5. Cree el link para el almacenamiento de las imagenes (php artisan storage:link)
