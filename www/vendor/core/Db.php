<?php

namespace vendor\core;


class Db{

    use TSingleton;
    /**
     * @var \PDO
     */
    public $pdo;

    protected function __construct(){

        $config = require ROOT . '/config/db.php';
        require LIBS . '/redbean.php';
        \R::setup($config['dsn'], $config['user'], $config['pass']);
    }
}