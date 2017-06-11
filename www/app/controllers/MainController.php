<?php

namespace app\controllers;

use app\models\GroupModel;
use app\models\MainModel;
use app\models\ProfileModel;
use vendor\core\App;
use vendor\core\base\View;
use vendor\core\Registry;
use vendor\core\User;
use vendor\libs\Telegram;
use vendor\libs\VK;

class MainController extends AppController{

    /**
     * @var Telegram
     */
    protected $telegram = false;

    public function indexAction() {

    }

    public function runAction() {
        $this->layout = false;
        $this->run();
    }

    public function run() {
        $profiles = ProfileModel::getListWithNotification();
        $idProfiles = [];
        foreach ($profiles as $profile) {
            $idProfiles[] = $profile->getId();
        }
        $groups = GroupModel::getListFromProfilesWithNotification($idProfiles);
        GroupModel::setLastWallRecords($groups);
        $data = $this->getUnitedData($profiles, $groups);
        $this->setRecordsVK($data);
        $this->initTelegram();
        foreach ($data as $item) {
            $this->sendMsg($item['groups']);
            $this->saveLastWallRecords($item['groups']);
        }
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

    protected function setRecordsVK(&$data) {
        foreach ($data as &$value) {
            $profile = $value['profile'];
            $vk = new VK($profile->token_vk);
            foreach ($value['groups'] as $group) {
                $records = $vk->wallTextsGetLast($group->id_vk,$group->lastWallRecord);
                $group->wallRecords = $records['records'];
                $group->newLastWallRecord = $records['newLastRecordId'];
            }
        }
    }

    protected function initTelegram() {
        $this->telegram = new Telegram(BOT_TOKEN);
    }

    protected function sendMsg($groups) {
        if (!$this->telegram) {
            return false;
        }
        foreach ($groups as $group) {
            $this->telegram->chatId = $group->chat_id_tg;
            foreach ($group->wallRecords as $wallRecord) {
//                $this->telegram->sendMessage($wallRecord);
                debug($wallRecord);
            }
        }
        return true;
    }

    protected function saveLastWallRecords($groups) {
        foreach ($groups as $group) {
            $group->saveNewLastWallRecord();
        }
    }

}