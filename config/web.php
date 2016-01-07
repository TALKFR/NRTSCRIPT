<?php

$params = require(__DIR__ . '/params.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'js/jquery-1.11.3.js',
//                        'js/jquery-1.9.0.js',
                    ]
                ],
//                'yii\bootstrap\BootstrapAsset' => [
//                    'sourcePath' => null,
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web',
//                    'css' => ['css/bootstrap-ie7.css',]
//                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OHm1TzTHozsSEeLWhX5BFkBDuQv9GOb6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_SESSION'],
                    'exportInterval' => 1,
                ],
                [
                    'class' => 'app\components\NRTFileTarget',
                    'exportInterval' => 1,
                    'levels' => ['info', 'error'],
                    'categories' => ['trace'],
                    'prefix' => function ($message) {
                return '';
            },
                    'logVars' => [],
                    'logFile' => '@app/runtime/logs/requests.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
            ],
        ],
        'db' => [
            // ...
            'on afterOpen' => function($event) {
                // $event->sender refers to the DB connection
//                $event->sender->createCommand("USE Data_0331e68e23ca4e308b49869bffbe5c79")->execute();
                //echo 'tii';
                //exit(0);
            }
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbv2' => require(__DIR__ . '/dbv2.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '10.100.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '10.100.*'],
        'generators' => [ //here
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'Nrt' => '@app/Templates', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
