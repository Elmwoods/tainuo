<?php

if (!defined("ni8"))
    exit("Access Denied");

class ForemenAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        $this->checkuser();
    }

    public function index() {//主页
        if (IS_POST) {
            $id = (int) $_POST['id'];
            $find = M('subject')->where("user_id = {$this->user['id']} and id = {$id}")->find();
            if ($find) {
                M('subject')->where("user_id = {$this->user['id']} and id = {$id}")->save(array('is_hs' => 1));
                M('item')->where("user_id = {$this->user['id']} and subject_id = {$id}")->save(array('is_hs' => 1));
                $this->ajaxReturn(array(
                    'code' => 1
                ));
            } else {
                $this->ajaxReturn(array(
                    'code' => 0
                ));
            }
            exit;
        }
        $subject = M('subject')->where("user_id = {$this->user['id']} and is_hs = 0")->order('id desc')->select();

        $this->assign(array(
            'subject' => $subject,
        ));
        $this->display();
    }

    public function additem() {
        if (IS_POST) {
            $waiter = explode(',', $_POST['waiter']);
            $ontime = $_POST['ontime'];
            $offtime = $_POST['offtime'];
            $_POST['addtime'] = time();
            if (!$_POST['hotel_id']) {
                cookie("err_mes", "请选择酒店！");
                $this->redirect('foremen/additem');
            }
            if (!$_POST['title']) {
                cookie("err_mes", "请填写项目名称！");
                $this->redirect('foremen/additem');
            }
            if (!$_POST['worktime']) {
                cookie("err_mes", "请填写工作日期！");
                $this->redirect('foremen/additem');
            }
            $_POST['user_id'] = $this->user['id'];
            $id = M('subject')->add($_POST);
            $list = array();
            $reward = 0;
            $sum = 0;
            foreach ($waiter as $v) {
                if ($v) {
                    $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $_POST['break'] / 60, 2);
                    $reward = bcadd($reward, bcmul($hour, $_POST['wage']));
                    $sub = bcsub($this->webset['wage'], $_POST['wage']);
                    $irebate = 0;
                    if ($sub > 0) {
                        $irebate = bcmul($hour, $sub);
                    }
                    $data = array(
                        'hotel_id' => $_POST['hotel_id'],
                        'user_id' => $_POST['user_id'],
                        'subject_id' => $id,
                        'ontime' => $ontime,
                        'offtime' => $offtime,
                        'hours' => $hour,
                        'rebate' => $irebate,
                        'waiter_id' => $v,
                        'clothes' => 1,
                        'break' => $_POST['break'],
                        'worktime' => $_POST['worktime'],
                        'reward' => bcmul($hour, $_POST['wage']),
                        'wage' => $_POST['wage'],
                    );
                    $list[] = $data;
                }
            }

            M('item')->addAll($list);
            $this->reset($id);
            cookie("err_mes", "添加成功！");
            $this->redirect('foremen/index');
        }
        $waiter = M('waiter')->where('passed = 1')->order('id desc')->select();
        cookie("fwait", "passed = 1");
        $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();
        $this->assign(array(
            'waiter' => $waiter,
            'hotel' => $hotel
        ));
        $this->display();
    }

    public function deleteitem() {
        if (is_array($_GET['id'])) {
            $subject_id = $_GET['subject_id'];
            $ids = implode(',', $_GET['id']);
            M('item')->where("id in ({$ids}) and subject_id = {$subject_id}")->delete();
        } else {
            $id = (int) $_GET['id'];
            $item = M('item')->where("id = {$id}")->find();
            if (!$item) {
                echo '<script>history.go(-1);</script>';
                exit;
            }
            M('item')->where("id = {$id}")->delete();

            $subject_id = $item['subject_id'];
        }
        $this->reset($subject_id);
        cookie("err_mes", "删除成功！");
        $this->redirect('foremen/flist', array('id' => $subject_id));
    }

    public function confirm() {
        if (is_array($_GET['id'])) {
            $subject_id = $_GET['subject_id'];
            $ids = implode(',', $_GET['id']);
            M('item')->where("id in ({$ids}) and subject_id = {$subject_id}")->save(array('is_con' => 1));
        } else {
            $id = (int) $_GET['id'];
            $item = M('item')->where("id = {$id}")->find();
            if (!$item) {
                echo '<script>history.go(-1);</script>';
                exit;
            }
            M('item')->where("id = {$id}")->save(array('is_con' => 1));

            $subject_id = $item['subject_id'];
        }

        cookie("err_mes", "保存成功！");
        $this->redirect('foremen/flist', array('id' => $subject_id));
    }

    public function changeall() {
        if (IS_POST) {
            $save = array(
                'wage' => $_POST['wage'],
                'break' => $_POST['break'],
                'ontime' => $_POST['ontime'],
                'offtime' => $_POST['offtime'],
                'is_con' => $_POST['is_con'],
                'clothes' => $_POST['clothes']
            );
            $_POST['id'] = trim($_POST['id'], ',');
            $hour = round((strtotime($_POST['offtime']) - strtotime($_POST['ontime']) ) / (60 * 60) - $_POST['break'] / 60, 2);
            $reward = bcadd($reward, bcmul($hour, $_POST['wage']));
            $sub = bcsub($this->webset['wage'], $_POST['wage']);
            $irebate = 0;
            if ($sub > 0) {
                $irebate = bcmul($hour, $sub);
            }
            $save['hours'] = $hour;
            $save['rebate'] = $irebate;
            $save['reward'] = bcmul($hour, $_POST['wage']);
            M('item')->where("id in ({$_POST['id']})")->save($save);
            $this->reset($_POST['subject_id']);
            cookie("err_mes", "保存成功！");
            $this->redirect('foremen/flist', array('id' => $_POST['subject_id']));
        }
        if ($_GET['id']) {
            $subject = M("subject")->where("id = {$_GET['id']} and user_id = {$this->user['id']}")->find();
            $item = M("item")->where("subject_id = {$_GET['id']} and user_id = {$this->user['id']}")->select();
            foreach ($item as &$vol) {
                $vol['wait'] = M('waiter')->where('id=' . $vol['waiter_id'])->find();
            }
            if (!$subject) {
                echo '<script>history.go(-1);</script>';
                exit;
            }
            $this->assign(array(
                'subject' => $subject,
                'item' => $item
            ));
            $this->display();
        }
    }

    public function changeitem() {
        $id = (int) $_GET['id'];
        $subject = M("subject")->where("id = {$id} and user_id = {$this->user['id']}")->find();
        if (!$subject) {
            echo '<script>history.go(-1);</script>';
            exit;
        }
        if (IS_POST) {
            $waiter = explode(',', $_POST['waiter']);
            $ontime = $subject['ontime'];
            $offtime = $subject['offtime'];
            $list = array();
            $reward = 0;
            $sum = 0;
            foreach ($waiter as $v) {
                if ($v) {
                    $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $subject['break'] / 60, 2);
                    $reward = bcadd($reward, bcmul($hour, $subject['wage']));
                    $sub = bcsub($this->webset['wage'], $subject['wage']);
                    $irebate = 0;
                    if ($sub > 0) {
                        $irebate = bcmul($hour, $sub);
                    }
                    $data = array(
                        'hotel_id' => $subject['hotel_id'],
                        'user_id' => $subject['user_id'],
                        'subject_id' => $subject['id'],
                        'ontime' => $ontime,
                        'offtime' => $offtime,
                        'hours' => $hour,
                        'rebate' => $irebate,
                        'waiter_id' => $v,
                        'clothes' => 1,
                        'break' => $subject['break'],
                        'worktime' => $subject['worktime'],
                        'reward' => bcmul($hour, $subject['wage']),
                        'wage' => $subject['wage'],
                    );
                    $list[] = $data;
                }
            }
            M('subject')->where("id = {$id}")->save(array('title' => $_POST['title'], 'worktime' => $_POST['worktime']));
            M('item')->where("subject_id = {$id}")->save(array('worktime' => $_POST['worktime']));
            M('item')->addAll($list);
            $this->reset($subject['id']);
            cookie("err_mes", "保存成功！");
            $this->redirect('foremen/index');
        }
        $item = M('item')->where("subject_id = {$id}")->field('waiter_id')->select();
        $ids = implode(',', array_column($item, 'waiter_id'));
        if (!empty($item)) {
            $where = " and id not in ({$ids})";
        }
        $waiter = M('waiter')->where("passed = 1 " . $where)->order('id desc')->select();
        cookie("fwait", "passed = 1 " . $where);
        $this->assign(array(
            'subject' => $subject,
            'waiter' => $waiter
        ));
        $this->display();
    }

    public function flist() {
        $id = (int) $_GET['id'];
        $subject = M('subject')->where("id = {$id} and user_id = {$this->user['id']}  and is_hs = 0")->find();
        if (!$subject) {
            echo '<script>history.go(-1);</script>';
            exit;
        }
        $where = "";
        if ($_GET['keyboard']) {
            $k = addslashes($_GET['keyboard']);
            $waiter = M('waiter')->where("username like '%{$k}%' or moble like '%{$k}%'")->field('id')->select();
            $ids = implode(',', array_column($waiter, 'id'));
            $where = " and (waiter_id in ($ids))";
        }
        $list = M('item')->where("subject_id = {$subject['id']}" . $where)->order('id desc')->select();
        foreach ($list as &$vol) {
            $vol['wait'] = M('waiter')->where('id=' . $vol['waiter_id'])->find();
        }
        $this->assign(array(
            'subject' => $subject,
            'list' => $list,
            'keyboard' => $k,
        ));
        $this->display();
    }

    public function fshow() {
        $id = (int) $_GET['id'];
        $item = M('item')->where("id = {$id}")->find();
        $waiter = M('waiter')->where("id = {$item['waiter_id']}")->find();
        if (!$item) {
            echo '<script>history.go(-1);</script>';
            exit;
        }
        if (IS_POST) {
            $ontime = $_POST['ontime'];
            $offtime = $_POST['offtime'];
            $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $_POST['break'] / 60, 2);
            $sub = bcsub((float) $this->webset['wage'], (float) $_POST['wage']);
            if ($this->webset['wage'] > $_POST['wage']) {
                $irebate = bcmul($hour, $sub);
            } else {
                $irebate = 0;
            }
            $data = array(
                'clothes' => $_POST['clothes'],
                'pay' => $_POST['pay'],
                'paymoney' => $_POST['paymoney'],
                'ontime' => $ontime,
                'hours' => $hour,
                'rebate' => $irebate,
                'offtime' => $offtime,
                'break' => $_POST['break'],
                'worktime' => $_POST['worktime'],
                'reward' => bcmul($hour, (float) $_POST['wage']),
                'wage' => $_POST['wage'],
                'is_con' => $_POST['is_con']
            );
            if ($data['reward'] >= $this->webset['limit'] && $data['pay'] == 1) {
                cookie('err_mes', "总报酬大于现金支付上限！");
                $this->redirect('foremen/fshow', array('id' => $item['id']));
            }
            $save = M('item')->where("id = {$item['id']}")->save($data);
            $this->reset($item['subject_id']);
            cookie('err_mes', "保存成功！");
            $this->redirect('foremen/flist', array('id' => $item['subject_id']));
        }
        $this->assign(array(
            'show' => $item,
            'waiter' => $waiter
        ));
        $this->display();
    }

    public function reset($subject_id) {
        $items = M('item')->where("subject_id = {$subject_id}")->select();
        $reward = 0;
        $sum = 0;
        $hours = 0;
        foreach ($items as $vol) {
            $hour = round((strtotime($vol['offtime']) - strtotime($vol['ontime']) ) / (60 * 60) - $vol['break'] / 60, 2);
            if ($hour >= 0) {
                $hours = bcadd($hours, $hour);
                $reward = bcadd($reward, bcmul($hour, $vol['wage']));
            }
            $sub = bcsub($this->webset['wage'], $vol['wage']);
            if ($sub > 0 && $hour > 0) {
                $sum = bcadd($sum, bcmul($hour, $sub));
            } else {
                $sub = 0;
            }
        }
        $rebate = $sum;
        M('subject')->where("id = {$subject_id}")->save(array('hours' => $hours, 'rebate' => $rebate, 'reward' => $reward));
    }

    public function bd() {
        if (IS_POST) {
            $username = $_POST['username'];
            $yzm = $_POST['yzm'];
            if (md5(C('PASS') . $yzm) . $username != cookie('sendcode')) {
                cookie("err_mes", '短信验证码错误！');
                $this->redirect('foremen/bd');
            }
            M('user')->where("id = {$this->user['id']}")->save(array(
                'moble' => $username,
            ));
            cookie("err_mes", '设置成功！');
            $this->redirect('foremen/index');
        }
        $this->display();
    }

}

?>