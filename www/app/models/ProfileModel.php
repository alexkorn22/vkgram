<?php
/**
 * Created by PhpStorm.
 * User: korns
 * Date: 07.06.2017
 * Time: 19:32
 */

namespace app\models;


class ProfileModel extends AppModel {

    protected static $table = 'profiles';
    protected $tokenVK = '';
    protected $chatID = '';
    protected $notificationGroup = 0;
    protected $userID = 0;

    public function save($data){

        if ($this->id){
            $rec = \R::load(self::$table,$this->id);
        } else {
            $rec = \R::dispense(self::$table);
        };
        $rec->token_vk = $data['token_vk'];
        $rec->chat_id_tg = $data['chat_id_tg'];
        $rec->user_id = $data['user_id'];
        $rec->notification_group = 0;
        if (isset($data['notification_group'])) {
            $rec->notification_group = 1;
        }
        $this->id = \R::store($rec);
    }

    public function getByUserID($userID) {
        $rec = \R::findOne(self::$table,'user_id = :user_id '
            ,[
                ':user_id' => $userID,
            ]);
        if ($rec == null) {
            $this->id = 0;
            return false;
        } else {
            $this->tokenVK = $rec->token_vk;
            $this->chatID = $rec->chat_id_tg;
            $this->notificationGroup = $rec->notification_group;
            $this->userID = $rec->user_id;
            $this->id = $rec->id;
            return true;
        }
    }



}