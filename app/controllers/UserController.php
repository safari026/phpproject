<?php

namespace app\controllers;

use app\models\UserModel;
use vendor\libs\Validator;
use vendor\libs\UserSession;

class UserController extends AppController {
    public $layout = 'main';

    public function registerAction (){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::validateUserCreds([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'confPassword' => $_POST['confPassword']
            ]);
            if (isset($data['emailError']) || isset($data['pwdError'])) {
                $this->set(['data' => $data]);
            }  else {
                $model = new UserModel;
                $check = $model->saveUser(['email' => $data['email'], 'password' => password_hash($data['password'], PASSWORD_DEFAULT)]);
                if ($check) {
                    header('location: /');   
                }
                if (!$check) {
                    $data['emailError'] = 'Пользователь с таким имэйл уже зарегестрирован.';
                    $this->set(['data'=>$data]);
                }
            }
        }
    }

    public function loginAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel;
            $user = $model->findUserByEmail($_POST['email']);
            if ($user) {
                if (Validator::checkPassword($_POST['password'], $user[0]->password)) {
                    $user[0]->token = md5(time());
                    $model->setUserToken($user[0]);
                    UserSession::setUserAuth($user[0]);
                    header('location: /');
                }
            }
            $this->set(['data'=>['error' => 'Неверный имеэйл адрес или пароль']]);
        }
    }

    public function logoutAction() {
        if (UserSession::get('user')) {
            $model = new UserModel;
            $model->unsetToken($_SESSION['user']->user_id);
            UserSession::destroyUserSession();
            header('location: /');
        }
    }
}