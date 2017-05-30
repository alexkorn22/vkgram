<?php
use vendor\core\Router;
require 'front_contoller.php';

//routers
Router::add('^page/?(?P<alias>[a-z-]+)?$',['controller'=>'Page','action'=>'view']);

//default routers
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch(rtrim($_SERVER['QUERY_STRING'], '/'));