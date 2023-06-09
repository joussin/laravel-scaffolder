<?php


return [

    'ROOT_NAMESPACE' => 'App\\',

    'PACKAGE_DIR_PATH' => base_path(\Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDirname() . "/"),//'src/'
    'DIST_DIR_NAME' => \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDistDirname(), //'Generated'

    'DIST_DIR_PATH' => base_path(\Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDirname() . "/" .\Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDistDirname()."/"), //'src/Generated/'
    'PACKAGE_NAMESPACE' => "Api\\".\Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDistDirname()."\\", //'Api\\Generated\\'
    'STUB_PATH' => base_path(\Api\Providers\ScaffolderConfigServiceProvider::getScaffoldDirname() . "/stubs/"), // "src/stubs/"

    'USE_ROUTES_RESOURCE' => true,


    'resources' => [

        'Location' => [
            'connection' => 'mysql',
            'table' => 'location',
            'attributes' => [
                'id'       => [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => false,
                    'default'  => null,
                    'default_seeder'  => null,
                    'extra'    => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'    => 'required|integer',
                ],
                'user_id'  =>  [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'default_seeder'  => 1,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
                'lat'      =>  [
                    'type'     => 'float',
                    'db_type'     => 'float',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
                    'default_seeder'  => 9.0,
                    'extra'    => [],
                    'rules'    => 'required|float',
                ],
                'long'     =>  [
                    'type'     => 'float',
                    'db_type'     => 'float',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
                    'default_seeder'  => 1.10,
                    'extra'    => [],
                    'rules'    => 'required|float',
                ]
            ]
        ],

        'Address'  => [
            'connection' => 'mysql',
            'table' => 'address',
            'attributes' => [
                'id'       => [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => false,
                    'default'  => null,
                    'default_seeder'  => null,
                    'extra'    => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'    => 'required|integer',
                ],
                'user_id'  =>  [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'default_seeder'  => 1,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
                'location_id'  =>  [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'default_seeder'  => 1,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
                'full_address'  =>  [
                    'type'     => 'string',
                    'db_type'     => 'string',
                    'length'   => '255',
                    'nullable' => true,
                    'default'  => null,
                    'default_seeder'  => "1 quai auguste roy, Triel sur seine",
                    'extra'    => [],
                    'rules'    => 'nullable|string',
                ],
            ]
        ]
    ],

];
