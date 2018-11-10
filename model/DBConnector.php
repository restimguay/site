<?php
namespace model;
use Application;
class DBConnector{
    private static $_hostname='';
    private static $_dbname='';
    private static $_username='';
    private static $_password='';
    private static $_connection=null;
    public static function init(){
        $dbConfig = Application::getConfig()['db'];
        self::$_hostname = $dbConfig['hostname'];
        self::$_dbname = $dbConfig['dbname'];
        self::$_username = $dbConfig['username'];
        self::$_password = $dbConfig['password'];
        self::$_connection = new PDO('mysql:host='.self::$_hostname.';dbname='.self::$_dbname, self::$_username, self::$_password);
    }

    public static function getConnection(){
        if(self::$_connection==null){
            self::init();
        }
        return self::$_connection;
    }
}