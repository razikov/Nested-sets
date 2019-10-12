<?php

$path = realpath(__DIR__."/../data")."/data.db";

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.$path,
];