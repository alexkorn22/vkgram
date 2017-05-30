<?php

namespace vendor\core;

trait TSingleton{

    private static $instance;

    public static function getInstance(){
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}