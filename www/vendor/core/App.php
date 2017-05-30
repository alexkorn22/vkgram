<?php

namespace vendor\core;


/**
 * Class App
 * @package vendor\core
 */
class App{

    public static $app;

    public function __construct(){
        self::$app = Registry::getInstance();
    }

}