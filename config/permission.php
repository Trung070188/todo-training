<?php

return [
    'admin' => [
        'users' => ['view','show', 'create', 'update', 'delete'],
        'products' => ['view','show','create','update','delete'],
        'orders' => ['view','show','create','update','delete','order'],

    ],
    'customer' => [
        'users' => [],
        'products' => [],
        'orders' => ['view','show','create','update','order'],

    ],
    'employee' => [
        'users' => [],
        'products' => [],
        'orders' => ['view','show','delete','order'],

    ],
];
