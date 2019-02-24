<?php

if (!defined("ni8"))
    exit("Access Denied");

class AuthAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        import('Common.Csession', APP_PATH, '.php');
        $this->sess = new cls_session();
        $this->sess->session('user_sessions');
        if (!empty($_SESSION['user_id'])) {
            $user = $this->sess->get_user_info('user');
            if (!$user) {
                $this->sess->destroy_session('user');
                $this->redirect('auth/login', "", 0, '');
                exit;
            }
            $this->user = $user;
        }
    }

    public function userlogin() {
        if (IS_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = M('user')->where("username = '{$username}'")->find();
            if (!$user) {
                $this->ajaxReturn(array('success' => 2));
            }
            if ($user['password'] != md5($password)) {
                $this->ajaxReturn(array('success' => 2));
            }
            if ($user['passed'] == 0) {
                $this->ajaxReturn(array('success' => 2));
            }
            $value = rand(100000, 999999);
            //echo $value;
            $code = md5(C('PASS') . $value);

            cookie('sendcode1', $code . $user['moble'], 900);
            $this->sendinfo($user['moble'], array($value), '4');
            $this->ajaxReturn(array('success' => 1));
        }
    }

    public function login() {
        if (IS_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $captcha = $_POST['captcha'];

            $user = M('user')->where("username = '{$username}'")->find();

            if (!$user) {
                cookie("err_mes", "账户不存在！");
                $this->redirect('auth/login');
            }
            if ($user['password'] != md5($password)) {
                cookie("err_mes", "密码错误！");
                $this->redirect('auth/login');
            }
            if (md5($captcha) != $_COOKIE['verify']) {
                cookie("err_mes", '图片验证码错误！');
                $this->redirect('auth/login');
                exit;
            }
//            if (md5(C('PASS') . $captcha) . $user['moble'] != cookie('sendcode1')) {
//                cookie("err_mes", '短信验证码错误！');
//                $this->redirect('auth/login');
//                exit;
//            }
            if ($user['passed'] == 0) {
                cookie("err_mes", "账户已被禁用！");
                $this->redirect('auth/login');
            }
            $_SESSION['user_id'] = $user['id'];
            $this->sess->update_user_info('user');
            $this->redirect('foremen/index');
        }
        cookie('captcha', 1);
        $this->display();
    }

    public function logout() {
        $this->sess->destroy_session('user');
        $this->redirect('auth/login', "", 0, '');
    }

}

?>