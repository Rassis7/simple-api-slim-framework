<?php

# === IMPORTS E CONFIGURAÇÕES REFERENTES A ESTRUTURA DO PROJETO, NÃO ALTERAR DAQUI PARA BAIXO
require 'vendor/autoload.php';

# === dotenv
require '.env-config.php';

// Instantiate the app
$settings = require __DIR__ . '/config/Settings.php';

//inciando app
$app = new \Slim\App($settings);

# ==================================================
# === cors
require 'config/Cors.php';
# === bd
require 'config/Datasource.php';
# === dependencies
require 'config/Dependecies.php';
# === dependencies
require 'config/LoadRouters.php';
# ==================================================

# === run slim
$app->run();