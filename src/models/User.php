<?php

namespace src\models;

use helpers\Bcrypt;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //somente pode editar
    protected $fillable = ['nome', 'email', 'password'];
    //proteger de inserções
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = "users";

    public function findUser($username, $hash)
    {
        return User::where('email', '=', $username)
            ->where('hash', '=', $hash)
            ->first();
    }

    public static function getUserByIdAndEmail($email, $id) 
    {
        return User::where('email', '=', $email)
            ->where('id', '=', $id)
            ->first();
    }
}
