<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'tests',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'debug'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'SX91nJePfKE1e1oX-5mCTZue_78cADop',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'thread/<ids:(\d+)(,\d+)+>' => 'site/thread',
                'thread/<ids:(\d+)>' => 'site/thread',
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
    'modules' => [
        'gurps' => [
            'class' => 'app\modules\gurps\Module',
        ],
        'UserImportExport' => [
            'class' => 'app\modules\UserImportExport\Module',
        ],
    ],
    'params' => $params,
    'language' => 'ru-RU',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
