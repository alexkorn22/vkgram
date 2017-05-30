<?php
/**
 * Created by PhpStorm.
 * User: korns
 * Date: 26.03.2017
 * Time: 21:56
 */

namespace vendor\core\base;

use vendor\core\App;

class Controller{

    /**
     * текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * имя файла вида(по умолчанию название экшена)
     * @var string
     */
    public $view;

    /**
     * текущий файл шаблона
     * @var string
     */
    public $layout;

    /**
     * параметры для передачи в вид
     * @var array
     */
    public $vars = [];

    public function __construct($route){
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView(){
        $objView = new View($this->route, $this->layout, $this->view);
        $objView->render($this->vars);
    }

    public function setVars($vars){
        $this->vars = $vars;
    }

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function isGet() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public function loadView($view, $vars = []) {
        extract($vars);
        require APP . '/views/' . $this->route['controller'] . '/' . $view . '.php';
    }

    public function goToIndex() {
        header('Location: /');
    }

}