<?php


namespace app\models;


class UserModel extends MainModel {

    protected $id = 0;
    protected $login;
    protected $admin = 0;
    protected static $table = 'users';

    public function save($data){
        $rec = \R::dispense('users');
        $rec->login = $data['login'];
        $rec->email = $data['email'];
        $rec->password = md5($data['password']);
        $rec->admin = $this->admin;
        $this->id = \R::store($rec);
    }

    public function isAdmin() {
        if (1 == $this->admin) {
            return true;
        } else {
            return false;
        }
    }

    public function isAuth() {
        return !empty($this->id);
    }

    public function login($login, $password) {
        $errors = [];
        $rec = \R::findOne(self::$table,'login = :login '
            ,[
              ':login' => $login,
            ]);
        if ($rec == null){
            $errors[] = 'Логина не существует';
        }else {
            if (md5($password) != $rec->password) {
                $errors[] = 'Не правильный пароль';
            }
        }
        if (empty($errors)) {
            $this->fillFromRecord($rec);
            $_SESSION['user_id'] = serialize($this->id);
        }
        return $errors;
    }

    public function fillFromRecord($rec){
        $this->id = $rec->id;
        $this->login = $rec->login;
        $this->admin = $rec->admin;
    }

    public function checkAuth() {
        if (isset($_SESSION['user_id'])) {
            $idUser = unserialize($_SESSION['user_id']);
            $rec = \R::findOne('users','id = :id '
                ,[
                    ':id' => $idUser
                ]);
            if ($rec->isEmpty()){
                return false;
            }
            $this->fillFromRecord($rec);
            return true;
        }else {
            return false;
        }
    }

    public function getPerformance() {
        return $this->login;
    }

    public function verificationReg($data){
        $errors = [];
        if (trim($data['login']) == ''){
            $errors[] = 'Не заполнен логин';
        }
        if (trim($data['email']) == ''){
            $errors[] = 'Не заполнен email';
        }
        if ($data['password'] == ''){
            $errors[] = 'Не заполнен пароль';
        } else {
            if ($data['password'] != $data['password_confirm']){
                $errors[] = 'Подтверждение пароля не сопадает';
            }
        }
        if (empty($errors)) {
            $rec = \R::findOne(self::$table,'login = ?',[$data['login']]);
            if ($rec){
                $errors[] = 'Пользователь с таким логином существует';
            } else {
                $rec = \R::findOne(self::$table,'email = ?',[$data['email']]);
                if ($rec){
                    $errors[] = 'Пользователь с таким email существует';
                }
            }
        }
        return $errors;
    }

    public function logout() {
        unset($_SESSION['user_id']);
    }

}