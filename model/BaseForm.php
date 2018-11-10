<?
namespace model;
class BaseForm{
    
    /**
     * length=>[lower,higher] or email=>[>=lower] or email=>[<=higher]
     * number_value=>[lower,higher]
     * email=>[lower,higher] or email=>[>=lower] or email=>[<=higher]
     * unique=>[ModelClass,field,error_message]
     * int=[field1,field2,...]
     * required=[field1,field2,...]
     */
    public function rules(){
        return [];
    }
    public function __set($name, $value)
    {        
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        if (isset($this->{$name})){
            return $this->{$name};
        }
        return '';
    }

    public function load(){
        foreach($_POST as $key=>$value){
            if(property_exists($this,$key)){
                $this->{$key}=trim($value);
            }
        }
        return $this;
    }
    public function validate(){
        return true;
    }
}