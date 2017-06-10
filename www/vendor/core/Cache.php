<?php

namespace vendor\core;


class Cache{

    public  function __construct(){

    }

    public function set($key, $data, $seconds = 3600) {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        $mdKey = md5($key);
        mkdir(CACHE . '/' . substr($mdKey,0, 3));
        if (file_put_contents(CACHE . '/' . substr($mdKey, 0, 3)  . '/' . $mdKey . '.txt', serialize($content))) {
            return true;
        } else {
            return false;
        }
    }

    public function get($key) {
        $mdKey = md5($key);
        $file = CACHE . '/' . substr($mdKey, 0, 3)  . '/'. $mdKey . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if ($content['end_time'] >= time()) {
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function delete($key) {
        $mdKey = md5($key);
        $file = CACHE . '/' . substr($mdKey, 0, 3)  . '/' . $mdKey . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }

}