Modulo CRUDs Portafolio

Modulo que despliega el CRUD de usuario desde 4 perspectivas.

1. Haciendo uso del DataTable Server Side, extrae los datos de usuarios paginando en DataTable desde el mismo servidor
2. Haciendo uso del DataTable, extrae los usuarios y los muestra en DataTable.
3. Paginando los datos en la consulta a la Base de datos, usando un paginador propio.
4. A traves de una API, se desarrolla el proceso CRUD, a traves del uso de una API, el listado se genera consumiento una API creada por Laravel, la actualizacion de datos se hace enviando objetos JSON a Laravel, todos a traves del uso de Fetch.

El CRUD hace uso de la libreria Spatie para la permisologia de acceso.

Igualmente el modulo muestra la generación de un código QR desde JavaScript y con PHP haciendo uso de la Libreria simpleQrcode

Finalmente muestra una grafica para explicar el funcionamiento de una libreria grafica. Este grafico toma todos los usuarios y cuenta los caracteres, la grafica muestra la cantidad de usuarios con un numero determinado de caracteres.

Esta aplicación hace uso de los siguientes paquetes:

1. Laravel Spatie, para la permisologia
2. SimpleQR para la generación del código QR (simple-qrcode)
3. La libreria de graficos https://code.highcharts.com/highcharts.js
4. Paquete para el manejo de Datatable server side (yajra/laravel-datatables-oracle)

Para instalar la aplicación proceda a clonar el repositorio.
Despues de instalado ejecute las migraciones laravel y el seeder, esto creara la BD y los registros faker de uso.(13 usuarios y roles, 12 niveles de permiso)
