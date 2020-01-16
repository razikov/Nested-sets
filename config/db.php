<?php

$path = realpath(__DIR__."/../data")."/data.db";

//return [
//    'class' => 'yii\db\Connection',
//    'dsn' => 'sqlite:'.$path,
//];

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=tests',
    'username' => 'root',
    'password' => 'hexrf88',
    'charset' => 'utf8',
];