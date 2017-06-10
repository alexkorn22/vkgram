<?php

namespace app\controllers;

use app\models\GroupModel;
use app\models\MainModel;
use app\models\ProfileModel;
use vendor\core\App;
use vendor\core\base\View;
use vendor\core\Registry;
use vendor\core\User;
use vendor\libs\VK;

class MainController extends AppController{

    public function indexAction() {

    }

    public function runAction() {
        $this->layout = false;

        $profiles = ProfileModel::getListWithNotification();
        $idProfiles = [];
        foreach ($profiles as $profile) {
            $idProfiles[] = $profile->getId();
        }
        $groups = GroupModel::getListFromProfilesWithNotification($idProfiles);
        $data = $this->getUnitedData($profiles, $groups);
        $records = $this->getRecordsVK($data);
        debug($records);

    }

    protected function getUnitedData($profiles, $groups){
        $data = [];
        foreach ($profiles as $profile ) {
            $item = ['profile' => $profile, 'groups' => []];
            foreach ($groups as $group) {
                if ($group->id_profile == $profile->getId()) {
                    $item['groups'][] = $group;
                }
            }
            $data[] = $item;
        }
        return $data;
    }

    protected function getRecordsVK($data) {
        $records = [];
        foreach ($data as $value) {
            $profile = $value['profile'];
            $vk = new VK($profile->token_vk);
            foreach ($value['groups'] as $group) {
                $records[] = $vk->wallTextsGetLast($group->id_vk,0);
            }
        }
        return $records;
    }

}