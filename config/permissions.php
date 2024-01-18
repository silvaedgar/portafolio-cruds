<?php
// Archivo que contiene la definición de los permisos del sistema, debe contener ese orden 1er el arreglo que se utiliza para crear el middleware, es el que se consulta para el mismo y el "role"+name que se usa para crear el Role en los seeders.

return [
    'middlewareDtss' => ['dtss.create', 'dtss.update', 'dtss.delete'],
    'roleDtss' => 'DatatableSS',
    'canDtssCreate' => 'dtss.create',
    'canDtssUpdate' => 'dtss.update',
    'canDtssDestroy' => 'dtss.delete',

    'middlewareDtclient' => ['dtclient.create', 'dtclient.update', 'dtclient.delete'],
    'roleDtclient' => 'Datatable',
    'canDtclientCreate' => 'dtclient.create',
    'canDtclientUpdate' => 'dtclient.update',
    'canDtclientDestroy' => 'dtclient.delete',

    'middlewarePaginate' => ['paginate.create', 'paginate.update', 'paginate.delete'],
    'rolePaginate' => 'Paginate',
    'canPaginateCreate' => 'paginate.create',
    'canPaginateUpdate' => 'paginate.update',
    'canPaginateDestroy' => 'paginate.delete',

    'middlewareApi' => ['api.create', 'api.update', 'api.delete'],
    'roleApi' => 'Api',
    'canApiCreate' => 'api.create',
    'canApiUpdate' => 'api.update',
    'canApiDestroy' => 'api.delete',
];
