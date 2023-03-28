<?php


return [

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
                    'extra'    => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'    => 'required|integer',
                ],
                'user_id'  =>  [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
                'lat'      =>  [
                    'type'     => 'float',
                    'db_type'     => 'integer',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
                    'extra'    => [],
                    'rules'    => 'required|float',
                ],
                'long'     =>  [
                    'type'     => 'float',
                    'db_type'     => 'integer',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
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
                    'extra'    => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'    => 'required|integer',
                ],
                'user_id'  =>  [
                    'type'     => 'int',
                    'db_type'     => 'integer',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
            ]
        ]
    ],

];
