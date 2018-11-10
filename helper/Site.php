<?php
namespace helper;
use \Application;
use model\Member;

class Site{
    private static $instance = null;
    private static $user = null;
    public function config(){
        return Application::getConfig();
    }
    public static function app(){
        if($instance===null){
            $instance = new Site();
        }
        return $instance;
    }
    public function __set($name,$value){
        Application::setConfig($name,$value);
    }
    public function __get($name){
        return self::config()[$name];
    }
    /**
     * Get the instance of user;
     * @return \model\Member 
     */
    public static function user(){
        if(self::$user==null){
            self::$user = UserInstance::getUser();
        }
        return self::$user;
    }
    
}
