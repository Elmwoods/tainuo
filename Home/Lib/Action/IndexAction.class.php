<?php

if (!defined("ni8"))
    exit("Access Denied");

class IndexAction extends PublicAction {

    public function __construct() {
        parent::__construct();
    }

    public function index() {//主页
        if (IS_POST) {
            $username = $_POST['username'];
            $moble = $_POST['moble'];
            $yzm = $_POST['yzm'];
            if (md5(C('PASS') . $yzm) . $moble != cookie('sendcode')) {
                cookie("err_mes", '短信验证码错误！');
                $this->redirect('index/index');
                exit;
            }
            cookie('sendcode', null);
            if (!M('waiter')->where("moble = '{$moble}'")->find()) {
                M('waiter')->add(array(
                    'regtime' => date('Y-m-d H:i:s'),
                    'username' => $username,
                    'moble' => $moble,
                    'passed' => 1
                ));
                cookie("err_mes", '注册成功！');
                $this->redirect('index/index');
            } else {
                cookie("err_mes", '该手机号码已注册，请勿重复提交！');
                $this->redirect('index/index');
                exit;
            }
        }
        cookie('captcha', 1);
        $this->display();
    }

    
    public function test() {
        $this->assign('err', '测试');
        $this->display();
    }
}

?>