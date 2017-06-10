<?php


namespace app\models;


class GroupModel extends AppModel {
    protected static $table = 'groups';

    public function fillFields($data){
        unset($data['do_save_group']);
        if (isset($data['get_notification']) && !empty($data['get_notification'])){
            $data['notification'] = 1;
        }else {
            $data['notification'] = 0;
        }
        parent::fillFields($data);
    }
}