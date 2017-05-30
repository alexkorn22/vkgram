<?php

namespace app\controllers;

use vendor\core\base\Controller;
use vendor\core\base\Model;
use vendor\core\base\View;

class AppController extends Controller {
    public function __construct($route){
        parent::__construct($route);
        View::setMeta('Тестовый сайт', 'Описание для тестового сайта');
    }
}