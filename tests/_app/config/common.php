<?php

return [
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@jarrus90/Multilang' => dirname(dirname(dirname(__DIR__))),
        '@tests' => dirname(dirname(__DIR__)),
        '@vendor' => VENDOR_DIR,
    ],
    'bootstrap' => [
        'jarrus90\Multilang\Bootstrap',
    ],
    'modules' => [
        'multilang' => [
            'class' => 'jarrus90\Multilang\Module',
            'controllerMap' => [
                'admin' => [
                    'class' => 'jarrus90\Multilang\Controllers\AdminController',
                    'behaviors' => function(){return [];}
                ]
            ]
        ],
    ],
    'params' => [],
];