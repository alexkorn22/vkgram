<?php
/**
 * Created by PhpStorm.
 * User: korns
 * Date: 07.06.2017
 * Time: 19:14
 */

namespace app\controllers;

use app\models\ProfileModel;
use vendor\core\App;

class ProfileController extends AppController {

    public function indexAction() {
        $this->isNotAuthToMain();
        $data = [
            'user_id' => App::$app->user->getId(),
        ];
        if ($this->isPost()){
            $data = $_POST;
            if ($data['do_save_profile']) {

            }
        } else {
            // получение данных

        }
        $this->setVars(compact('data'));
    }

}