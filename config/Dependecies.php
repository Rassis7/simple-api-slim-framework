<?php

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container["errorHandler"] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $data = [
            "status" => "error",
            "message" => $exception->getMessage(),
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $response->withStatus($exception->getCode())->withHeader("Content-type", "application/json")->write($body);
    };
};
