<?php
/* ---------  Menu del aside del modulo cada elemento del arreglo son los parametros de cada opcion
 1. auth: indica si se necesita estar autorizado para acceder a la opcion
 2. label: Descripcion de la opcion en el menu. En las vistas debe asignarse un valor de 'activePage' para que se resalte en el menu cuando sea la opción activa. el valor de este 'activePage' es el mismo del label que tiene aqui y se compara con el LABEL del archivo labelsMenu.php en config.
 3. url: Valor del route para acceder seria route(url)
 4. icon: Icono que se muestra junto a la descripcion del label. Usa el formato de fontawesome
 5. id: solo tiene valores cuando es el encabezado del menu de segundo nivel. En los JS se agregan las cadenas "caret" para la flecha y "sublevel" para validar el click en el encabezado. Y el id lo toma el menu del subnivel. Para las vistas hay que habilitar si se abre este submenu a traves del parametro collapse cuyo valor es el id de aqui que senala que es de 2do nivel. de resto es vacio.
 6. Permissions, indica los permisos que debe tener para acceder al recurso. El valor de permissions, es un string que se asocia al key del archivo permissions.php en config, sino tiene asociaciación se pone en blanco o un arreglo vacio
 6. caret: Es false o un arreglo es el menu de segundo nivel
*/

return [
    'options' =>
    [
        [
            'auth' => false,
            'label' => 'Inicio',
            'url' => 'home',
            'icon' => '<i class="fa-solid fa-house" aria-hidden="true"></i>',
            'id' => '',
            'permissions' => [],
            'caret' => false,
        ],
        [
            'auth' => true,
            'label' => 'CRUDS',
            'url' => '',
            'icon' => '<i class="fa-solid fa-database" aria-hidden="true"></i>',
            'id' => 'cruds',
            'permissions' => [],
            'caret' => [
                [
                    'label' => 'DataTable ServerSide',
                    'url' => 'dataTableSS.index',
                    'icon' => '<i class="fa-solid fa-table-list" aria-hidden="true"></i>',
                    'id' => '',
                    'permissions' => 'permissions.middlewareDtss',
                    'caret' => false
                ],
                [
                    'label' => 'DataTable Client',
                    'url' => 'dataTable.index',
                    'icon' => '<i class="fa-solid fa-table-cells" aria-hidden="true"></i>',
                    'id' => '',
                    'permissions' => 'permissions.middlewareDtclient',
                    'caret' => false
                ],
                [
                    'label' => 'DataTable Paginate',
                    'url' => 'paginate.index',
                    'icon' => '<i class="fa fa-table" aria-hidden="true"></i>',
                    'id' => '',
                    'permissions' => 'permissions.middlewarePaginate',
                    'caret' => false
                ],
                [
                    'label' => 'Crud Api',
                    'url' => 'apiCrud.index',
                    'icon' => '<i class="fa fa-table" aria-hidden="true"></i>',
                    'id' => '',
                    'permissions' => 'permissions.middlewareApi',
                    'caret' => false
                ],


            ],
        ],
        // [
        //     'auth' => true,
        //     'label' => 'Elementos',
        //     'url' => '',
        //     'icon' => '<i class="fa-brands fa-elementor"></i>',
        //     'id' => 'element',
        //     'permissions' => '',
        //     'caret' => [
        //         [
        //             'label' => 'Inputs',
        //             'url' => 'elements.input',
        //             'icon' => '<i class="fas fa-keyboard"></i>',
        //             'permissions' => '',
        //             'id' => '',
        //             'caret' => 'false'
        //         ],
        //         [
        //             'label' => 'Selects',
        //             'url' => 'elements.select',
        //             'icon' => '<i class="fa-solid fa-list-check"></i>',
        //             'id' => '',
        //             'permissions' => '',
        //             'caret' => 'false'
        //         ],
        //         [
        //             'label' => 'Check y Radios',
        //             'url' => 'elements.check',
        //             'icon' => '<i class="fa fa-check" aria-hidden="true"></i>',
        //             'id' => '',
        //             'permissions' => '',
        //             'caret' => 'false'
        //         ],
        //         [
        //             'label' => 'Modal',
        //             'url' => 'elements.modal',
        //             'icon' => '<i class="fas fa-comment-dots"></i>',
        //             'id' => '',
        //             'permissions' => [],

        //             'caret' => 'false'
        //         ]
        //     ],
        // ],
        [
            'auth' => false,
            'label' => 'Codigo QR',
            'url' => 'elements.qrCode',
            'icon' => '<i class="fa fa-qrcode" aria-hidden="true"></i>',
            'id' => '',
            'permissions' => [],
            'caret' => false,
        ],
        [
            'auth' => false,
            'label' => 'Grafico',
            'url' => 'graphics.index',
            'icon' => '<i class="fa fa-bar-chart" aria-hidden="true"></i>',
            'id' => '',
            'permissions' => [],
            'caret' => false,
        ],
        [
            'auth' => false,
            'label' => 'Login',
            'url' => 'user.login',
            'icon' => '<i class="fa fa-universal-access" aria-hidden="true"></i>',
            'id' => '',
            'permissions' => [],
            'caret' => false,
        ],
    ],
];
