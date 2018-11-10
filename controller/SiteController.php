<?php
namespace controller;
use model\Member;
use model\SigninForm;
use helper\Site;
use model\SignupForm;
class SiteController extends BaseController{
    
    public function indexAction(){
        $model = new Member();
        $member = $model->findByPk(3);
        $this->render('site/index');
    }

    public function signupAction(){
        $form = new SignupForm();
        if($form->validate()){
            $this->sendEmail();
            $this->navigate('site/welcome');
        }else{

        }
        $this->render('site/_signup_form');
    }
    public function signinAction(){

        $form = new SigninForm();
        if($form->validate()){
            $this->navigate('site/index');
        }else{
            $this->render('site/_signin_form');
        }
    }
    public function welcomeAction(){
        $this->render('site/welcome');
    }
    public function signoutAction(){
        Site::user()->signout();
        $this->render('site/index');
    }
}