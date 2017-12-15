<?php
Yii::setAlias('@api', realpath(__DIR__.'/..'));

//echo __DIR__ . '/..'; exit;
$params_loc = require __DIR__.'/../../config/params_loc.php';
$db     = require(__DIR__ . '/../../config/db.php');
$params = require(__DIR__ . '/params.php');



return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
            'basePath' => '@api/modules/v1',
            'controllerNamespace' => 'api\modules\v1\controllers'
        ]

    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => false,
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/promo'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{name}' => '<name:\\w+>',

                    ],
                    'except' => ['delete', 'create', 'update'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET custom' => 'custom',
                        'GET get-discount-info' => 'get-discount-info',
                        'GET activate-discount' => 'activate-discount'
                    ],
                ],

            ],
        ],
    ],
    'params' => $params,
];