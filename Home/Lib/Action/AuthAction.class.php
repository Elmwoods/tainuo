<?php

if (!defined("ni8"))
    exit("Access Denied");

class AuthAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        
    }



    public function login() {
        if (IS_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $captcha = $_POST['captcha'];
            if(md5($captcha) != $_COOKIE['verify']){
                //cookie("err_mes","验证码错误！");
                //$this->redirect('auth/login');
            }
            $user = M('user')->where("username = '{$username}'")->find();
            if(!$user){
                cookie("err_mes","账户不存在！");
                $this->redirect('auth/login');
            }
            if($user['password'] != md5($password)){
                cookie("err_mes","密码错误！");
                $this->redirect('auth/login');
            }
            if($user['passed'] == 0){
                cookie("err_mes","账户已被禁用！");
                $this->redirect('auth/login');
            }
            $_SESSION['user_id'] = $user['id'];
            $this->sess->update_user_info('user');
            $this->redirect('foremen/index');
        }
        cookie('captcha',1);
        $this->display();
    }

    
    
    public function logout() {
        $this->sess->destroy_session('user');
        $this->redirect('auth/login', "", 0, '');
    }

}

?>