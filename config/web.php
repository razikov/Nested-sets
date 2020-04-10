<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'tests',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'SX91nJePfKE1e1oX-5mCTZue_78cADop',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'arrayCache' => [
            'class' => \yii\caching\ArrayCache::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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
        'db' => require(__DIR__ . '/db.php'),
        
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy HH:mm',
            'nullDisplay' => '',
            'currencyCode' => 'RUB',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'Europe/Moscow',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'thread/<ids:(\d+)(,\d+)+>' => 'site/thread',
                'thread/<ids:(\d+)>' => 'site/thread',
//                'aoc/<action>' => 'adventofcode/<action>',
                "<controller>/<action>" => "<controller>/<action>",
//                "<module>/<controller>/<action>" => "<module>/<controller>/<action>",
            ],
        ],
        'storageContainer' => [
            'class' => \app\components\StorageContainer::class,
            'storages' => [
                1 => [
                    'class' => \app\components\LocalStorage::class,
                    'basePath' => '@app/web/uploads',
                    'baseUrl' => '/uploads',
                ],
            ],
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login'],
        ],
        'defaultRoute' => 'site/index',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;
