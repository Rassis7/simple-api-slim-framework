<?php
/**
 * Created by PhpStorm.
 * User: assis
 * Date: 24/07/18
 * Time: 23:23
 */

namespace src\controllers;

use helpers\Bcrypt;
use Slim\Http\{Request, Response};
use src\controllers\User as UserController;
use src\models\User as UserModel;
use Firebase\JWT\JWT;

class Auth
{
    /**
     * @param $request
     * @param $response
     * @param $service
     * @return mixed
     */
    public static function authAction(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();

            //Verificar se a senha do meu usuário bate
            $hash = Bcrypt::hash($params['password']);
            $user = (new UserModel())->findUser($params['email'], $hash);

            if (!$user) {
                throw new \Exception("Usuário não existe", 401);
            }

            $token = array(
                'id' => $user->id,
                'email' => $user->email
            );

            $jwt = JWT::encode($token, $_ENV['SECRET_KEY_JWT']);

            return $response->withJson(["jwt" => $jwt], 200);
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), 401);
        }
    }

    public static function validJWT(Request $request)
    {
        $params = json_decode($request->getHeader('HTTP_X_TOKEN')[0]);

        if (is_null($params)) {
            throw new \Exception('TOKEN INVÁLIDO', 403);
        }

        $jwtQuebrado = JWT::decode($params->jwt, $_ENV['SECRET_KEY_JWT'], array('HS256'));
        $user = UserModel::getUserByIdAndEmail($jwtQuebrado->email, $jwtQuebrado->id);

        if (is_null($user)) {
            throw new \Exception('O Token não corresponde ao usuário logado', 403);
        }

        return true;
    }
}