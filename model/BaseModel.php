<?php
namespace model;
use PDO;
class BaseModel {
    public $tablename;
    public $pk;

    private static $tables=[];

    /**
     * @return PDO
     */
    public function conn()
    {
        if(!array_key_exists($this->tablename,self::$tables)){
            self::$tables[$this->tablename] = $this->getTableColumns();
        }
        return DBConnector::getConnection();
    }
    public function selectAll(){
        $sql = 'SELECT * FROM '.$this->tablename;
        $result = $this->conn()->query($sql);
        foreach ($this->conn()->query($sql) as $row) {
            $this->id=$row['id'];
            $this->username=$row['username'];
            $this->email=$row['email'];
            echo $this->username .'\n';
        }
    }

    /**
     * returns the object with values;
     */
    public function findByPk($pkvalue){
        $sql = 'SELECT * FROM '. $this->tablename .' WHERE `'. $this->pk .'`="'.$pkvalue.'"';
        return $this->executeQuery($sql);
    }
    /**
     * 
     */
    public function findOneBy($condition){
        
        $filter='';
        foreach($condition as $key=>$value){
            $filter .=' `'.$key.'`="'.$value.'" and ';
        }
        $filter = rtrim($filter,' and ');
        $sql = 'SELECT * FROM '. $this->tablename .' WHERE '.$filter.' LIMIT 1';
        return $this->executeQuery($sql);
    }

    public function executeQuery($sql){
        $result = $this->conn()->query($sql);
        if(!$result){
            return false;
        }
        return $result->fetchObject(get_class($this));
    }

    public function __get($name)
    {
        if (isset($this->{$name})){
            return $this->{$name};
        }
        return '';
    }

    public function __set($name, $value)
    {        
        $this->{$name} = $value;
    }
    public function insert(){
        $sql = 'INSERT INTO '. $this->tablename;
        $fields = ' (';
        $values = ' VALUES(';
        $properties = get_object_vars ($this);
        foreach ($properties as $key => $value) {
            if(in_array($key, self::$tables[$this->tablename]) && $key!=$this->pk){
                $fields .='`'.$key.'`, ';
                $values .='"'.$value.'",';
            }
        }
        $fields = rtrim($fields,', ').')';
        $values = rtrim($values,', ').')';
        $sql.=$fields.$values;
        return $this->conn()->exec($sql);
    }
    public function update(){
       $sql = 'UPDATE '. $this->tablename;
       $sql .= ' SET ';
       $properties = get_object_vars ($this);
       foreach ($properties as $key => $value) {
           if(in_array($key, self::$tables[$this->tablename]) && $key!=$this->pk){
                $sql .=' `'.$key.'`="'.$value.'",';
           }
       }
       $sql = rtrim($sql,', ');
       $sql .= ' WHERE `'.$this->pk.'`="'.$this->{$this->pk}.'"';
       return $this->conn()->exec($sql);
    }
    /**
     * 
     */
    private function getTableColumns(){
        $q = DBConnector::getConnection()->query('SHOW COLUMNS FROM '. $this->tablename);        
        $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
        return $table_fields;
    }
}