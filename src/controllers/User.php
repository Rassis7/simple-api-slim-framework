<?php
namespace src\controllers;

use Slim\{Slim, Http\Request, Http\Response};
use helpers\Bcrypt;
use src\models;

class User
{
    private $user;

    /**
     * User constructor.
     * @param models\User $user
     */
    public function __construct(models\User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Response $response
     * @return static
     */
    public function findAllAction(Response $response) : Response
    {
        try {
            $users = ($this->user->all(['id', 'nome', 'email']));
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 400);
        }

        return $response->withJson($users, 200);
    }

    /**
     * @param Response $response
     * @param $id
     * @return static
     */
    public function findByIdAction(Response $response, $id): Response
    {
        $user = null;
        try {
            $user = ($this->user->find(intval($id), ['id', 'nome', 'email']));
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 400);
        }
        return $response->withJson($user, 200);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return static
     */
    public function createAction(Request $request, Response $response): Response
    {
        try {
            $params = $request->getParsedBody();

            $user = new $this->user();
            $user->nome = $params['name'];
            $user->email = $params['email'];
            $user->hash = Bcrypt::hash($params['password']);

            //Tenho que saber se o usuário já existe
            $isUserExist = $this->user->findUser($user->email, $user->hash);

            if (!is_null($isUserExist)) {
                throw new \Exception("Usuário já existe");
            }

            //ao criar um usuario, tenho que retornar o token dele
            $token = null;
            if ($user->save()) {
                $token = Auth::authAction($request, $response);
            } else {
                throw new \Exception('Usuario não criado');
            }

            return $token;
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 400);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $id
     * @return static
     */
    public function updateAction(Request $request, Response $response, $id): Response
    {
        try {
            $params = $request->getParsedBody();

            $user = $this->user->findOrFail($id);
            $user->nome = $params['nome'];
            $user->email = $params['email'];

            $user->save();
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 400);
        }

        return $response->withJson([
            'id' => $user->id,
            'nome' => $user->nome,
            'email' => $user->email
        ], 200);
    }

    /**
     * @param Response $response
     * @param $id
     * @return static
     */
    public function deleteAction(Response $response, $id): Response
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 400);
        }
        return $response->withJson(null, 200);
    }

}