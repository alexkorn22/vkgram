<?php
/**
 * Created by PhpStorm.
 * User: korns
 * Date: 07.06.2017
 * Time: 19:32
 */

namespace app\models;

use vendor\core\App;
use vendor\core\Cache;

class ProfileModel extends AppModel {

    protected static $table = 'profiles';

    public function getByUserID() {
        $nameCache = 'getProfileFromUserID';
        $cacheData = App::$app->cache->get($nameCache);
        if ($cacheData){
            $this->fillFields($cacheData);
            $this->id = $cacheData['id'];
            return true;
        }
        $rec = \R::findOne(self::$table,'user_id = :user_id '
            ,[
                ':user_id' => $this->user_id,
            ]);
        if ($rec == null) {
            $this->id = 0;
            return false;
        } else {
            $this->fillFields($rec);
            $this->id = $rec->id;
            $forCache = $this->getFields();
            $forCache['id'] = $this->id;
            App::$app->cache->set($nameCache,$forCache);
            return true;
        }
    }

    public function fillFields($data){
        unset($data['do_save_profile']);
        if (isset($data['get_notification']) && !empty($data['get_notification'])){
            $data['get_notification'] = 1;
        }else {
            $data['get_notification'] = 0;
        }
        parent::fillFields($data);
    }

    public function saveFields(){
        parent::saveFields();
        App::$app->cache->set('getProfileFromUserID',$this->getFields());
        App::$app->cache->delete('ProfileModelGetListWithNotification');
    }

    /**
     * @return array prof
     */
    public static function getListWithNotification() {

        $nameCache = 'ProfileModelGetListWithNotification';
        $cacheData = App::$app->cache->get($nameCache);
        if ($cacheData){
            return $cacheData;
        }
        $recs = \R::find(self::$table,'get_notification = ? ',[1]);
        $result = [];
        foreach ($recs as $rec){
            $prof = new ProfileModel();
            $prof->fillFields($rec);
            $result[] = $prof;
        }
        App::$app->cache->set($nameCache,$result);
        return $result;
    }

}