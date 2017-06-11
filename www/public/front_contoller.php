<?php
use vendor\core\Router;

define('WWW', __DIR__);
define('DEBUG',1);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('CACHE', dirname(__DIR__) . '/tmp/cache');

if (DEBUG == 1) {
    error_reporting(-1);
}
require LIBS .'/functions.php';
require ROOT . '/config/AppConfig.php';

spl_autoload_register(function ($class) {
    $nameClass = str_replace('\\','/',$class);
    $file = ROOT . "/$nameClass.php";
    if (file_exists($file)) {
        require_once $file;
    }
});

new \vendor\core\App();