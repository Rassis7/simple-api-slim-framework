<?php

namespace src\routers;

use Slim\Http\{Request, Response};
use \src\controllers\Auth as AuthController;

$app->post('/auth', function (Request $request, Response $response) {
    $this->logger->info("User authAction, '/auth' route");
    return AuthController::authAction($request, $response);
});

$app->get('/validJWT', function (Request $request, Response $response) {
    $this->logger->info("User authAction, '/auth' route");

    try {
        return AuthController::validJWT($request, $response);
    } catch (\Exception $e) {
        return $response->withJson($e->getMessage(), 403);
    }

});
