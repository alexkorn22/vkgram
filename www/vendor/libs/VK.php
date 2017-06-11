<?php

namespace vendor\libs;

class VK{

    protected $token;
    protected $api = "https://api.vk.com/method/";
    protected $dataFile = 'data.json';
    public $listGroups;

    public function __construct($token=""){
        $this->token = $token;
        $this->dataFile = __DIR__ . '/' . $this->dataFile;
    }

    protected function getUrl($method, $params) {
       $params['access_token'] = $this->token;
       return $this->api . '/' . $method . '?' . http_build_query($params);
    }

    public static function getAnswer($url) {
        $res = file_get_contents($url);
        return json_decode($res,true);
    }

    public function getWall($ownerId, $count = 2) {
        $params = array(
            "count" => $count,
            "owner_id" => $ownerId,
        );
        $url = $this->getUrl('wall.get',$params);
        $data = self::getAnswer($url);
        return $data['response'];
    }

    public function wallTextsGetLast($ownerId,$lastRecordId) {

        $data = $this->getWall($ownerId, 2);
        $res = array(
            'records' => array(),
            'newLastRecordId' => $lastRecordId
        );
        foreach ($data as $key=>$value){
            if ($key == 0) {
                continue;
            }
            if ($value['id'] > $lastRecordId) {
                $res['records'][] = str_replace("<br>","\n",$value['text']);
            }
            if ($value['id'] > $res['newLastRecordId']) {
                $res['newLastRecordId'] = $value['id'];
            }
        }
        return $res;
    }

}