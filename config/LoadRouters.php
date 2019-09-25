<?php

// Carrega todos arquivos de rota automaticamente
$pathRouters = dirname(__FILE__) . '/../src/routers';

foreach (scandir($pathRouters) as $filename) {
    $path = $pathRouters . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}