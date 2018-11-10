<?php
namespace controller;
use helper\Site;
use helper\mail\PHPMailer;
class BaseController{

    private $template = 'main';
    function init()
    {
        if(Site::user()==null || Site::user()->isGuest()){
            if(!array_key_exists('site/signin',$_GET) && !array_key_exists('site/signup',$_GET) && !array_key_exists('site/signout',$_GET)){
                header('Location: ?site/signin');
            } 
        }
        $this->load();
    }
    function renderPartial($view,$data=[]){
        ob_start();
        var_export($data);
        require 'view/'. $view .'.php';
        return ob_get_clean();
    }
    function navigate($path){
        header('Location: ?'.$path);
    }
    function render($view,$data=[]){
        ob_start();
        extract($data);
        $content=  require 'view/'. $view .'.php';
        $this->renderTemplate($content);
    }
    private function renderTemplate($content){
        $content =  ob_get_clean();
        extract(['content'=>$content]);        
        require 'view/template/'. $this->template .'.php';
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

    public function load(){
        foreach($_POST as $key=>$value){
            $this->{$key}=$value;
        }
    }
    public function sendEmail(){
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Set who the message is to be sent from
        $mail->setFrom('resti.guay@gmail.com', 'First Last');
        //Set an alternative reply-to address
        $mail->addReplyTo('resti.guay@gmail.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('resti.guay@gmail.com');
        //Set the subject line
        $mail->Subject = 'Validate Email';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML(file_get_contents(__DIR__.'\validate.html'));
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            //  echo "Message sent!";
        }
    }
}