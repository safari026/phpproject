<?php

namespace vendor\libs;

class Validator 
{
    public static function validateUserCreds($creds) {
        $data = $creds;
        foreach($data as $key => $value) {
            switch ($key) {
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $data['emailError'] = 'Пожалуйста введите корректный адрес имэйл.';
                    }
                case 'password':
                    if (!\preg_match('/[a-z]/', $data['password']) || !\preg_match('/[A-Z]/', $data['password']) || !\preg_match('/[0-1]/', $data['password']) || (strlen($data['password']) < 6)) {
                        $data['pwdError'] = 'Пароль должен состоять как минимун из 6 символов и содержать буквы в верхнем и нижнем регистре и цифры.';
                    }
                    if ($data['password'] != $data['confPassword']) {
                        $data['pwdError'] = 'Пароли не совпадают.';
                    }
            }
        }
        return $data;
    }

    public static function checkPassword($password, $check) {
        return \password_verify($password, $check);
    }

    public static function validatePost($post) {
        if ($post['post_title'] == '') {
            $post['titleError'] = 'Пожалуйста введите название.';
        }
        if ($post['post_body'] == '') {
            $post['bodyError'] = 'Пожалуйста введите текст поста.';
        }
        return $post;
    }
}