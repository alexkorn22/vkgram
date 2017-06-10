<?php
/**
 * Created by PhpStorm.
 * User: korns
 * Date: 07.06.2017
 * Time: 19:14
 */

namespace app\controllers;

use app\models\GroupModel;
use app\models\ProfileModel;
use vendor\core\App;

class ProfileController extends AppController {

    /**
     * @var ProfileModel
     */
    protected $profile;

    protected function getCurrentProfile() {
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
        $data = GroupModel::getListFromProfile($this->profile->getId());
        $this->setVars(compact('data'));
    }

    public function addgroupAction() {
        $this->changeGroup();
    }

    protected function checkProfile() {
        $this->getCurrentProfile();
        if (!$this->profile->getId()) {
            header('Location: /profile/');
        }
    }


    protected function changeGroup($id = 0) {
        $this->checkProfile();
        $this->view = 'group';
        $data = [
            'name' => '',
            'id' => $id,
            'link' => '',
            'notification' => 0,
            'id_profile' => $this->profile->getId(),
            'id_vk' => '',
            'chat_id_tg' => $this->profile->chat_id_tg,
        ];
        if ($this->isPost()) {
            $data = $_POST;
            if (isset($data['do_save_group'])) {
                $group = new GroupModel();
                $group->fillFields($data);
                $group->saveFields();
                header('Location: /profile/groups/');
            }
        } elseif($id != 0) {
            $group = GroupModel::getByID($id);
            $dataGroup = $group->getFields();
            $dataGroup['id'] = $group->getId();
            if ($dataGroup['id']) {
                $data = $dataGroup;
            }

        };
        $this->setVars(compact('data'));
    }

    public function delgroupAction() {
        $this->checkProfile();
        if ($this->isGet() && isset($_GET['id'])) {
            if ($_GET['id']) {
                $this->delGroup($_GET['id']);
            }
        }
        header('Location: /profile/groups/');
    }

    public function changegroupAction() {
        $this->checkProfile();
        if ($this->isGet() && isset($_GET['id'])) {
            if ($_GET['id']) {
                $this->changeGroup($_GET['id']);
            }
        }
    }

    protected function delGroup($id) {
        $group = GroupModel::getByID($id);
        $group->delete();
    }

}