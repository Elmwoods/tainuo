<?php

if (!defined("ni8"))
    exit("Access Denied");

class IndexAction extends PublicAction {

    public function __construct() {
        parent::__construct();
    }

    public function index() {//主页
        $this->display();
        /*if (IS_POST) {
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
        $this->display();*/
    }

    
    public function test() {
        $subject['id']  = 9759;
        $all_waiter = M('item')->where("is_hs = 0 and subject_id = {$subject['id']}")->getField('waiter_id', true);
//            $all_waiter = array_column($item, 'waiter_id');
        var_dump($all_waiter);
        $map['waiter_id'] = array('in', $all_waiter);
        $waiter_names = M('waiter')->where($map)->getField('user_name', true);
        var_dump($waiter_names);
        $waiter_name = M('waiter')->where(['waiter_id', $this->waiter['id']])->getField('user_name');
        var_dump($waiter_name);
        if (in_array($this->waiter['id'], $all_waiter) || in_array($waiter_name, $waiter_names)) {
            $this->msg('您已加入了项目！', U('index/record'));
        }
exit();
        $this->assign('err', '测试');
        $this->display();
    }
}

?>