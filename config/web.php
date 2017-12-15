<?php

$params = require __DIR__ . '/params.php';
$params_loc = require __DIR__.'/params_loc.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ceSp-wuE2qc3avRbvUXf2G3Y8QHU4I6l',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>'   => '<controller>/view',
                '<controller:\w+>/<name:\w+>'   => '<controller>/view',
                '/<action:\w+>' => 'site/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>'   => '<module>/<controller>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:\w+>'   => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>'   => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                /*[
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api',
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{name}' => '<name:\\w+>',
                    ],
                    'pluralize' => false,
                ],
                */


            ],

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
