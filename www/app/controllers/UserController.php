<?php

namespace app\controllers;

use app\models\UserModel;
use vendor\core\App;
use vendor\core\base\View;

class UserController extends MainController {

    public function loginAction() {
        $this->isAuthToMain();
        View::setMeta('Авторизация', 'Авторизация пользователя');
        $data = [
            'login' => '',
            'password' => '',
        ];
        $errors = [];
        if ($this->isPost() && isset($_POST['do_login'])){
            $data = $_POST;
            $errors = App::$app->user->login($data['login'], $data['password']);
        }
        $this->isAuthToMain();
        $this->setVars(compact('data','errors'));
    }

    public function regAction() {
        $this->isAuthToMain();
        View::setMeta('Регистрация', 'Регистрация нового пользователя');
        $data = [
            'login' => '',
            'email' => '',
            'password' => '',
            'password_confirm' => ''
        ];
        $errors = [];
        if ($this->isPost() && isset($_POST['do_registration'])){
            $data = $_POST;
            $errors = App::$app->user->verificationReg($data);
            if (empty($errors)) {
                App::$app->user->save($data);
                $errors = App::$app->user->login($data['login'],$data['password']);
                if (empty($errors)) {
                    $this->isAuthToMain();
                }
            }
        }
        $this->setVars(compact('data','errors'));
    }

    public function logoutAction() {
        if (App::$app->user->isAuth()) {
            App::$app->user->logout();
            App::$app->user = new UserModel();
        }
        header('Location: /');
    }

    public function isAuthToMain() {
        if (App::$app->user->isAuth()) {
            $this->goToIndex();
        }
    }

}