<?php

namespace app\models;

use vendor\core\base\Model;

class AppModel extends Model {

    protected $id = 0;
    protected $fields = [];

    public function __get($name){
       return $this->fields[$name];
    }

    public function __set($name, $value){
        $this->fields[$name] = $value;
    }

    public function fillFields($data) {
        foreach ($this->fields as $key => $value) {
            $this->fields[$key] = $data[$key];
        }
    }

    public function fillRecordFields($record) {
        foreach ($this->fields as $key => $value) {
            $record->$key = $value;
        }
    }

    public function save() {
        if ($this->id){
            $record = \R::load(self::$table,$this->id);
        } else {
            $record = \R::dispense(self::$table);
        };
        $this->fillRecordFields($record);
        $this->id = \R::store($record);
    }

}