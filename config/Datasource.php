<?php

$BdConfig = [
    'driver' => $_ENV['DB_CLIENT'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
];

//conectando ao BD
$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($BdConfig);
$capsule->bootEloquent();
$capsule->setAsGlobal();