<?php

namespace model;
class SigninForm extends BaseForm{
    public $signin_username_email;
    public $signin_password;
    public $signin_remember=false;
    public $session_hash;
    public function validate()
    {
        $this->load();
        $hash_password = hash('sha256', $this->signin_password);
       
        $signin_info = 'username';
        if (filter_var($signin_username_email, FILTER_VALIDATE_EMAIL)) {
            $signin_info = 'email';
        }

        $member = new Member();
        $member =  $member->findOneBy([$signin_info=>$this->signin_username_email,'password_hash'=>$hash_password]);
                
        if($member){
            $this->session_hash = md5(microtime());
            $_SESSION['auth_key']=$this->session_hash;
            if($this->signin_remember){
                $_SESSION['until']=time()+(3600*24*180);
            }else{
                $_SESSION['until']=time()+(3600*1);
            }
            $member->auth_key = $this->session_hash;
            $member->update();
            return true;
        }
        return false;
    }
}