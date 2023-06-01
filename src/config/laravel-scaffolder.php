<?php

$dirname = SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldDirname();
$dist_dirname = SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldDistDirname();
$config_key = SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

return [

    'LARAVEL_ROOT_NAMESPACE' => 'App\\',

    'PACKAGE_DIR_PATH' => $dirname . "/",
    'DIST_DIR_NAME'    => $dist_dirname,

    'DIST_DIR_PATH'     => $dirname . "/" . $dist_dirname . "/",
    'PACKAGE_NAMESPACE' => "SJoussin\LaravelScaffolder\\" . $dist_dirname . "\\",
    'STUB_PATH'         => $dirname . "/stubs/",

    'USE_ROUTES_RESOURCE' => true,

    'api' => [
        'host' => "http://0.0.0.0:4444/api/"
    ],

    'oauth' => [
        'host'   => "http://dev.oauth.cartegriseminute.net",
        'scopes' => [
            'route:any'     => 'Grant route:any access',
            'route:anyView' => 'Grant route:anyView access',
            'route:store'   => 'Grant route:store access',
            'route:edit'    => 'Grant route:edit access',
            'route:delete'  => 'Grant route:delete access',
        ]
    ],


    'resources' => [

        'Exemple' => [
            'connection' => 'mysql',
            'table'      => 'exemple',
            'attributes' => [
                'id'      => [
                    'type'           => 'int',
                    'db_type'        => 'integer',
                    'length'         => '33',
                    'nullable'       => false,
                    'default'        => null,
                    'default_seeder' => null,
                    'extra'          => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'          => 'required|integer',
                ],
                'user_id' => [
                    'type'           => 'int',
                    'db_type'        => 'integer',
                    'length'         => '33',
                    'nullable'       => true,
                    'default'        => null,
                    'default_seeder' => 1,
                    'extra'          => ['FOREIGN_KEY'],
                    'rules'          => 'nullable|integer',
                ],
                'lat'     => [
                    'type'           => 'float',
                    'db_type'        => 'float',
                    'length'         => '11',
                    'nullable'       => false,
                    'default'        => null,
                    'default_seeder' => 9.0,
                    'extra'          => [],
                    'rules'          => 'required|float',
                ],
                'long'    => [
                    'type'           => 'float',
                    'db_type'        => 'float',
                    'length'         => '11',
                    'nullable'       => false,
                    'default'        => null,
                    'default_seeder' => 1.10,
                    'extra'          => [],
                    'rules'          => 'required|float',
                ]
            ]
        ]
    ],

];
