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

    /**
     * @var ProfileModel
     */
    protected $profile;

    public function getCurrentProfile() {
        $this->isNotAuthToMain();
        $data = [
            'user_id' => App::$app->user->getId(),
            'token_vk' => '',
            'chat_id_tg' => '',
            'get_notification' => '',
        ];
        $this->profile = new ProfileModel();
        $this->profile->fillFields($data);
        $this->profile->getByUserID();
    }

    public function indexAction() {
        $this->getCurrentProfile();
        $alerts = [];
        if ($this->isPost()){
            $data = $_POST;
            if (isset($data['do_save_profile'])) {
                $this->profile->fillFields($data);
                $this->profile->saveFields();
                $alerts[] = 'Данные успешно сохранены';
            }
        }
        $data = $this->profile->getFields();
        $this->setVars(compact('data','alerts'));
    }

    public function groupsAction() {
        $this->getCurrentProfile();
        $this->setVars(compact('data'));
    }

    public function addgroupAction() {
        $this->getCurrentProfile();
        $this->view = 'group';

//        $this->setVars(compact('data'));
    }

}