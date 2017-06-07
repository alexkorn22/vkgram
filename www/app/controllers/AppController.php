<?php

namespace app\controllers;

use vendor\core\App;
use vendor\core\base\Controller;
use vendor\core\base\Model;
use vendor\core\base\View;

class AppController extends Controller {
    public function __construct($route){
        parent::__construct($route);
        View::setMeta('Новости ВК в Телеграм', 'Новости ВК в Телеграм');
    }

    public function indexAction() {

    }

    public function isAuthToMain() {
        if (App::$app->user->isAuth()) {
            $this->goToIndex();
        }
    }

    public function isNotAuthToMain() {
        if (!App::$app->user->isAuth()) {
            $this->goToIndex();
        }
    }
}