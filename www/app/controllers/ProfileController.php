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
            'token_vk' => '',
            'chat_id_tg' => '',
            'get_notification' => '',
        ];
        $profile = new ProfileModel();
        $profile->fillFields($data);
        if ($profile->getByUserID()) {
            $data = $profile->getFields();
        }
        if ($this->isPost()){
            $data = $_POST;
            if (isset($data['do_save_profile'])) {
                $profile->fillFields($data);
                $profile->saveFields();
                $data = $profile->getFields();
            }
        }
        $this->setVars(compact('data'));
    }


}