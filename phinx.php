<?php
require '.env-config.php';

return [
    "paths" => [
        "migrations" => "db/migrations"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "dev",
        "dev" => [
            "adapter" => $_ENV['DB_CLIENT'],
            "host" => $_ENV['DB_HOST'],
            "name" => $_ENV['DB_DATABASE'],
            "user" => $_ENV['DB_USER'],
            "pass" => $_ENV['DB_PASSWORD'],
            "port" => $_ENV['DB_PORT']
        ]
    ]
];