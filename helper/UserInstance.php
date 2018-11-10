<?php
namespace helper;

use model\Member;

class UserInstance{
    private static $user=null;
    private static $instance=null;
    /**
     * @return \model\Member
     */
    public static function getUser(){
        if(self::$user==null){
            self::$user = new Member();
            $session = self::getUserSession();
            if($session==''){
                self::$user = new Member();
            }else{
                self::$user = self::$user->findOneBy(['auth_key'=>$session]);
            }           
        }
        
        return self::$user;
    }


    private static function getUserSession(){
        if(isset($_SESSION['until'])){
            if($_SESSION['until'] < time()){
                unset($_SESSION['until']);
                unset($_SESSION['auth_key']);
                return '';
            }
        }
        return $_SESSION['auth_key']!=''?$_SESSION['auth_key']:'';
    }
}