<?php

namespace app\models;

use vendor\core\base\QueryBuilder;

class UserModel extends QueryBuilder {

    public $table='users'; // пусть таблица называется posts

    public function saveUser($data) {
        $check = $this->table($this->table)->select('email')->where('email', '=', $data['email'])->Qget();
        if (count($check) > 0) {
            return false;
        }
        $this->insert($this->table, $data);
        return true;
    }

    public function findUserByEmail($email) {
       $user =  $this->table($this->table)->select('*')->where('email', '=',  $email)->Qget();
       return $user;
    }

    public function setUserToken($user) {
        $this->update($this->table, ['token'=>$user->token], [['user_id', $user->user_id]]);
    }
    public function unsetToken($user_id) {
        $this->update($this->table, ['token' => null], [['user_id', $user_id]]);
    }
}