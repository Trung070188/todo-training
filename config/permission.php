<?php

return [
    'admin' => [
        'users' => ['view','show', 'create', 'update', 'delete'],
        'products' => ['view','show','create','update','delete'],
        'orders' => ['view','show','create','update','delete','order','order-status'],
        'order_logs' => ['view','show','create','update','delete'],

    ],
    'customer' => [
        'users' => [],
        'products' => [],
        'orders' => ['view','show','create','update','order','order-status'],
        'order_logs' => [],


    ],
    'employee' => [
        'users' => [],
        'products' => [],
        'orders' => ['view','show','delete','order'],
        'order_logs' => [],

    ],
];
