<?php

namespace src\routers;

use helpers\Bcrypt;
use Slim\Http\{Request, Response};
use src\controllers\User as UserController;
use src\controllers\Auth as AuthController;
use src\models\User as UserModel;
use Firebase\JWT\JWT;

$middlewareAuth = function (Request $request, Response $response, $next) {
    try {
        AuthController::validJWT($request);
        return $next($request, $response);
    } catch (\Exception $e) {
        $msg = ($e->getCode() != 403) ? 'ERRO AO VALIDAR O TOKEN' : $e->getMessage();
        return $response->withJson($msg, 403);
    }
};

$app->group('/user', function () use ($app) {
    $app->get('/', function (Request $request, Response $response, array $args) {
        $this->logger->info("User findAdd, '/user' route");
        return (new UserController(new UserModel()))->findAllAction($response);
    });

    $app->get('/{id}', function (Request $request, Response $response, array $args) {
        $this->logger->info("User findById, '/user/{id}' route");
        return (new UserController(new UserModel()))->findByIdAction($response, $args["id"]);
    });

    $app->put('/{id}', function (Request $request, Response $response, $args) {
        $this->logger->info("User update, '/user/{id}' route");
        return (new UserController(new UserModel()))->updateAction($request, $response, $args["id"]);
    });

    $app->delete('/{id}', function (Request $request, Response $response, $args) {
        $this->logger->info("User delete, '/user/{id}' route");
        return (new UserController(new UserModel()))->deleteAction($response, $args["id"]);
    });
})->add($middlewareAuth);

$app->post('/user/', function (Request $request, Response $response, $args) {
    $this->logger->info("User create, '/user' route");
    return (new UserController(new UserModel()))->createAction($request, $response);
});