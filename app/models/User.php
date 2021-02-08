<?php


namespace app\models;


use system\core\Model;

class User extends Model
{
    protected $table = 'users';

    public function auth($login, $pass)
    {
        $pass = md5($pass);
        //var_dump($pass);
        $res = $this->db->query("SELECT * FROM {$this->table} WHERE `login` = ? AND `password` = ?", [$login, $pass]);
        if(!empty($res[0])){
            return $res[0]['id'];
        }
        return false;
    }

    /**
     * авторизация в
     * @param $id
     */
    public function login($id)
    {
        $res = $this->findOne($id);
        if(!empty($res[0])){
            $_SESSION['user']['login'] = $res[0]['login'];
            if($res[0]['role'] == 'admin'){
                $_SESSION['is_admin'] = 1;
            }
        }
    }
}