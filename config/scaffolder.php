<?php


return [

    'resources' => [
        'User' => [
            'attributes' => []
        ],

        'Location' => [
            'attributes' => [
                'id'       => [
                    'type'     => 'int',
                    'length'   => '33',
                    'nullable' => false,
                    'default'  => null,
                    'extra'    => ['PRIMARY_KEY', 'AUTO_INCREMENT', 'FOREIGN_KEY', 'UNIQUE', 'INDEX'],
                    'rules'    => 'required|integer',
                ],
                'user_id'  =>  [
                    'type'     => 'int',
                    'length'   => '33',
                    'nullable' => true,
                    'default'  => null,
                    'extra'    => ['FOREIGN_KEY'],
                    'rules'    => 'nullable|integer',
                ],
                'lat'      =>  [
                    'type'     => 'float',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
                    'extra'    => [],
                    'rules'    => 'required|float',
                ],
                'long'     =>  [
                    'type'     => 'float',
                    'length'   => '11',
                    'nullable' => false,
                    'default'  => null,
                    'extra'    => [],
                    'rules'    => 'required|float',
                ]
            ]
        ],
        'City'     => [
            'attributes' => []
        ],
        'Address'  => [
            'attributes' => []
        ],

        'Product'             => [
            'attributes' => []
        ],
        'Cart'                => [
            'attributes' => []
        ],
        'Command'             => [
            'attributes' => []
        ],
        'Delivery'            => [
            'attributes' => []
        ],
        'Payment'             => [
            'attributes' => []
        ],
        'PaymentNotification' => [
            'attributes' => []
        ],
    ],

];
