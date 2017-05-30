<?php
$config = [
    'components' => [
      'cache' => 'vendor\core\Cache',
      'model' => 'vendor\core\base\Model',
      'user' => '\app\models\UserModel',
    ],
];
return $config;