<?php


namespace app\models;


class GroupModel extends AppModel {
    protected static $table = 'groups';
    public $wallRecords = [];
    public $lastWallRecord = 0;
    protected $idLastWallRecord = 0;
    public $newLastWallRecord = 0;

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

    public static function setLastWallRecords(&$groups) {
        $idGroups = [];
        foreach ($groups as $group) {
            $idGroups[] = $group->getId();
        }
        $recs = \R::find('lastwallrecords',' id_group IN (' . \R::genSlots($idGroups) . ')',$idGroups);
        foreach ($recs as $rec) {
            foreach ($groups as $group) {
                if ($group->getId() == $rec->id_group) {
                    $group->lastWallRecord = $rec->id_last_wall;
                    $group->idLastWallRecord = $rec->id;
                    break;
                }
            }
        }
    }

    public function saveNewLastWallRecord() {
        if ($this->newLastWallRecord <= $this->lastWallRecord) {
            return;
        }
        if ($this->idLastWallRecord != 0) {
            $record = \R::load('lastwallrecords',$this->idLastWallRecord);
        } else {
            $record = \R::dispense('lastwallrecords');
        }
        $record->id_group = $this->getId();
        $record->id_last_wall = $this->newLastWallRecord;
        \R::store($record);
    }

}