<?php


namespace app\models;


class GroupModel extends AppModel {
    protected static $table = 'groups';

    public function fillFields($data){
        if (isset($data['do_save_group'])) {
            unset($data['do_save_group']);
        }
        if (isset($data['notification']) && !empty($data['notification'])){
            $data['notification'] = 1;
        }else {
            $data['notification'] = 0;
        }
        parent::fillFields($data);
    }

    public static function getListFromProfile($idProfile) {
        $recs = \R::find(self::$table,'id_profile = ? ',[$idProfile]);
        $result = [];
        foreach ($recs as $rec){
            $group = new GroupModel();
            $group->fillFields($rec);
            $result[] = $group;
        }
        return $result;
    }

    public static function getListFromProfilesWithNotification($idProfiles) {
        $recs = \R::find(self::$table,'notification=1 and id_profile IN (' . \R::genSlots($idProfiles) . ')',$idProfiles);
        $result = [];
        foreach ($recs as $rec){
            $group = new GroupModel();
            $group->fillFields($rec);
            $result[] = $group;
        }
        return $result;
    }

}