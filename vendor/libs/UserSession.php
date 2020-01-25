<?php

namespace vendor\libs;

use app\models\UserModel;

class UserSession 
{
    public static function startSession() {
        \session_start();
        if (isset($_SESSION['user'])) {
                if (($_SESSION['user']->token != $_COOKIE['token'] || !isset($_COOKIE['token']))) {
                $_SESSION['authError'] = 'Возможно кто-то пытался взломать вашу учетную запись. Пожалуйста выполните вход еще раз.';
                $model = new UserModel;
                $model->unsetToken($_SESSION['user']->id);
                self::destroyUserSession();
                header('location: /user/login');
            } else {
                $_COOKIE['token'] = $_COOKIE['token'];
            }
        }
    }
    public static function setUserAuth($user) {
        unset($user->password);
        $_SESSION['user'] = $user;
        setrawcookie('token', $user->token, time() + (86400 * 365), '/', '', false, true);
    }
    public static function get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }
    public static function destroyUserSession() {
        unset($_SESSION['user']);
        unset($_COOKIE['token']);
    }
    public static function setMessage($key, $value) {
        $_SESSION[$key] = $value;
    }
    public static function unsetMessage($key) {
        unset($_SESSION[$key]);
    }
}