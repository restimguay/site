<?php
namespace model;

use model\BaseModel;

/**
 * @var $id int  
 * @var $username string  
 */
class Member extends BaseModel{
    public $id;
    public $username;
    public $email;
    public $auth_key;
    public $password_hash;
    public $status;
    public $created_at;
    public $updated_at;

    public function  __construct()
    {
        $this->tablename='member';
        $this->pk='id';
    }

    public function isGuest(){
       return $this->id=='';
    }

    public function signout(){
        $this->auth_key='';
        $this->id='';
        unset($_SESSION['auth_key']);
        unset($_SESSION['until']);
        $this->update();
    }
}


?>