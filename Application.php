<?php

use model\DBConnector;

 class Application {
    private static $_config;
    
    public static function getConfig(){
        return self::$_config;
    }
    public static function setConfig($key,$value){
        return self::$_config[$key]=$value;
    }
    public function start($config){
        self::$_config = $config;
        $dbCon =new DBConnector();
        $dbCon->init(self::$_config['db']);

        $ctrler = $this->getControllerSufix();
        $action = $this->getActionSuffix();

        $ctrlerFull = 'controller\\'.ucwords($ctrler).'Controller';
        $actionFull = $action.'Action';

        if(file_exists($ctrlerFull.'.php')){
            $obj = new $ctrlerFull();
            $obj->init();
            if(method_exists($obj,$actionFull)){
                $obj->$actionFull();
            }
        }
    }

     private function getBaseRequest(){
         $baseRequest = '';
         foreach($_GET as $key=>$value){
            $baseRequest = $key;
            break;
         }
         return $baseRequest;
     }
     /**
      * determine the prefix of the controller
      */
     private function getControllerSufix(){
        $rqst = $this->getBaseRequest();
        $rqstCtrler = explode('/',$rqst);
        if(array_key_exists(0,$rqstCtrler)){
            return $rqstCtrler[0]!=''?$rqstCtrler[0]:'site';
        }
        return 'site';
     }
     /**
      * determine the prefix of the action function
      */
     private function getActionSuffix(){
        $rqst = $this->getBaseRequest();
        $rqstActn = explode('/',$rqst);
        if(array_key_exists(1,$rqstActn)){
            return $rqstActn[1];
        }
        return 'index';
     }
 }

?>