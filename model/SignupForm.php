<?php
namespace model;
class SignupForm extends BaseForm{
    public $signup_username;
    public $signup_email;
    public $signup_first_name;
    public $signup_surename;
    public $signup_password;
    public $signup_reenter_password;

    public $errors =[];
    public function validate()
    {
        $this->load();
        if (filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['signup_email'] ='Email is not valid';
        }else{
            $member = new Member();
            $member = $member->findOneBy(['email'=>$this->signup_email]);
            if($member){
                $this->errors['signup_email'] ='Email already used';
            }
        }        
        
        if($this->signup_username==''){
            $this->errors['signup_username'] ='Surename is required';
        }
        if($this->email==''){
            $this->errors['signup_email'] ='Email is required';
        }
        if($this->signup_first_name==''){
            $this->errors['signup_first_name'] ='First Name is required';
        }
        if($this->signup_password==''){
            $this->errors['signup_password'] ='Password is required';
        }
        if($this->signup_password!=$this->signup_reenter_password){
            $this->errors['signup_reenter_password'] ='Password did not match';
        }
        if(count($this->errors)>1){
            return false;
        }
        $session_hash = md5(microtime());
        $_SESSION['auth_key']=$session_hash;

        $member = new Member();
        $member->username = $this->signup_username;
        $member->email = $this->signup_email;
        $member->password_hash = hash('sha256', $this->signup_password);
        $member->status = 2;
        $member->auth_key=$session_hash;
        $member->email_validate_hash = hash('sha256', microtime());
        $member->created_at = time();
        $member->updated_at = time();
        $member->insert();
        return true;

    }
}