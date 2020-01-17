<?php

if (!defined("ni8"))
    exit("Access Denied");

class ForemenAction extends PublicAction {

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
        } else {
            //echo ACTION_NAME;
            //推荐用户
            $tgcode = $this->_get('tgcode');
            if (!empty($tgcode)) {
                cookie('tgcode', strtoupper($tgcode), 3600);
            }
        }
        $this->checkuser();
    }
    // 未使用 20191016
    public function load(){
        $where = "";
        if ($_GET['start']) {
            $where .= " and worktime >= '{$_GET['start']}'";
            $this->assign('start', $_GET['start']);
        }
        if ($_GET['end']) {
            $where .= " and worktime <= '{$_GET['end']}'";
            $this->assign('end', $_GET['end']);
        }
        if ($_GET['hotel_id']) {
            $where .= " and hotel_id = {$_GET['hotel_id']}";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if ($_GET['part_id']) {
            $where .= " and part_id = {$_GET['part_id']}";
            $this->assign('part_id', $_GET['part_id']);
        }
        $offset = 5;
        $page = $_GET['page']>1?($_GET['page']-1)*$offset:1;
//        dump($page);
        $subject = M('subject')
            ->where(" user_id = {$this->user['id']} and is_hs = 0 " . $where)
            ->order('worktime desc,id desc')
            ->limit($page, $offset)
            ->select();
        foreach ($subject as &$sub) {
            $sub['kq_sl'] = M('item')->where("subject_id = {$sub['id']} and is_con = 1 and is_hs = 0")->count();
            $sub['hotel'] = M('hotel')->where("id = {$sub['hotel_id']}")->find();
            $sub['part'] = M('part')->where("id = {$sub['part_id']}")->find();
        }
        $this->ajaxReturn(array(
            'code' => 1,
            'data' => $subject
        ));
    }

    public function index() {//主页
        // dump($_SERVER);
        // die;
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
        $where = "";
        if ($_GET['start']) {
            $where .= " and worktime >= '{$_GET['start']}'";
            $this->assign('start', $_GET['start']);
        }
        if ($_GET['end']) {
            $where .= " and worktime <= '{$_GET['end']}'";
            $this->assign('end', $_GET['end']);
        }
        if ($_GET['hotel_id']) {
            $where .= " and hotel_id = {$_GET['hotel_id']}";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if ($_GET['part_id']) {
            $where .= " and part_id = {$_GET['part_id']}";
            $this->assign('part_id', $_GET['part_id']);
        }
        $offset = 20;
        $page = $_GET['page']>1?($_GET['page']-1)*$offset:0;
        $subject = M('subject')
            ->where(" user_id = {$this->user['id']} and is_hs = 0 " . $where)
            ->order('worktime desc,id desc')
            ->limit($page, $offset)
            ->select();
//        dump($subject);
//        die;
        foreach ($subject as &$sub) {
            $sub['kq_sl'] = M('item')->where("subject_id = {$sub['id']} and is_con = 1 and is_hs = 0")->count();
            $sub['hotel'] = M('hotel')->where("id = {$sub['hotel_id']}")->find();
            $sub['part'] = M('part')->where("id = {$sub['part_id']}")->find();
        }

        $isflag = $_GET['isflag'];
        if (!$isflag){
            $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();

            $info = M('subject')->where("passed = 1 and user_id = {$this->user['id']}  and is_hs = 0 " . $where)
                ->field("count(*) as times,sum(hours) as hourss,sum(reward) as rewards")->find();
            // var_dump($info);
            // die;
            $this->assign(array(
                'hotel' => $hotel,
                'info' => $info,
            ));
            $this->assign(array(
                'subject' => $subject,
            ));

            $this->display();
        }else{
            $this->ajaxReturn(array(
                'code' => 1,
                'data' => $subject
            ));
        }
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
            $_POST['passed'] = 0;
            $id = M('subject')->add($_POST);
            $list = array();
            $reward = 0;
            $sum = 0;
            foreach ($waiter as $k => $v) {
                if ($v) {

                    // 时薪 190223
                    $level_id = $this->finds('waiter',  'id = '. $v, 'id desc', true)['level'];
                    $hourly_wage = $this->finds('level', 'id = '. $level_id, 'id desc', true)['price'];

                    $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $_POST['break'] / 60, 2);
                    $reward = bcadd($reward, bcmul($hour, $_POST['wage']));
                    $sub = bcsub($this->webset['wage'], $_POST['wage']);
                    $irebate = 0;
                    if ($sub > 0) {
                        $irebate = bcmul($hour, $sub);
                    }
                    $data = array(
                        'hotel_id' => $_POST['hotel_id'],
                        'part_id' => $_POST['part_id'],
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
                        // 'reward' => bcmul($hour, $_POST['wage']),
                        // 'wage' => $_POST['wage'],
                        'reward' => bcmul($hour, $hourly_wage),
                        'wage' => $hourly_wage
                    );
                    $list[] = $data;
                }else{
                    unset($waiter[$k]);
                }
            }
            M('subject')->where("id = {$id}")->save(array('sl' => count($list)));
            M('item')->addAll($list);
            $this->reset($id);
//            if ($this->webset['notice_tel']) {
//                $sl = M('subject')->where("passed = 0")->count() ?: 0;
//                $this->sendinfo($this->webset['notice_tel'], array($sl), '3');
//            }
            cookie("err_mes", "添加成功,等待审核！");
            $this->redirect('foremen/index');
        }
        // 当前字符串哪种编码格式
        // $encode = mb_detect_encoding($_SESSION['user_name'], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
        // echo $encode;
        $offset = 20;
        $page = $_GET['page']>1?($_GET['page']-1)*$offset:0;
        $waiter = M('waiter')->where('passed = 1')->order('id desc')->limit($page, $offset)->select();
        cookie("fwait", "passed = 1");
        // $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();  // 20190215 注释
        $hotel_name = mb_substr($_SESSION['user_name'],0,4,'utf-8');
        $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->where(array('title' =>array("LIKE", '%' . $hotel_name . '%')))->select();

        $isflag = $_GET['isflag'];
        if(!$isflag){
            $this->assign(array(
                'waiter' => $waiter,
                'hotel' => $hotel
            ));
            $this->display();
        }else{
            $this->ajaxReturn(array(
                'code' => 1,
                'data' => $waiter
            ));
        }
    }

    public function deleteitem() {
        if (is_array($_GET['id'])) {
            $subject_id = $_GET['subject_id'];
            $ids = implode(',', $_GET['id']);
            $sl = M('item')->where("id in ({$ids}) and subject_id = {$subject_id} and  status = 0")->count();
            M('')->startTrans();
            $d = M('item')->where("id in ({$ids}) and subject_id = {$subject_id} and  status = 0")->delete();
            $s = M('subject')->where("id = {$subject_id}")->setDec('sl', $sl);
            if ($s && $d) {
                M()->commit();
            } else {
                M()->rollback();
            }
        } else {
            $id = (int) $_GET['id'];
            $item = M('item')->where("id = {$id} and status = 0")->find();
            if (!$item) {
                echo '<script>history.go(-1);</script>';
                exit;
            }
            M('')->startTrans();
            $s = M('subject')->where("id = {$item['subject_id']}")->setDec('sl');
            $d = M('item')->where("id = {$id}")->delete();
            if ($s && $d) {
                M()->commit();
            } else {
                M()->rollback();
            }
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

    // 20190223 修改
    public function changeall() {
        if (IS_POST) {
            // dump($_POST);
            // die;
            $waiter = explode(',', $_POST['id']);
            foreach ($waiter as $k => $v) {
                if ($v) {
                    // 时薪 190223
                    $hourly_wage = M('item i')->join('ni88_waiter w ON i.waiter_id = w.id ')->join('ni88_level l ON w.level = l.id')->field('price')->where('i.id = '.$v)->find()['price'];

                    $offtime = $_POST['offtime'];
                    $ontime = $_POST['ontime'];
                    $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $_POST['break'] / 60, 2);
                    // $reward = bcadd($reward, bcmul($hour, $hourly_wage));

                    $sub = bcsub($this->webset['wage'], $hourly_wage);
                    $irebate = 0;
                    if ($sub > 0) {
                        $irebate = bcmul($hour, $sub);
                    }
                    $save = array(
                        'wage' => $hourly_wage,
                        'break' => $_POST['break'],
                        'ontime' => $_POST['ontime'],
                        'offtime' => $_POST['offtime'],
                        'is_con' => $_POST['is_con'],
                        'pay' => $_POST['pay'],
                        'paymoney' => $_POST['paymoney'],
                        'clothes' => $_POST['clothes']
                    );
                    $save['hours'] = $hour;
                    $save['rebate'] = $irebate;
                    $save['reward'] = bcmul($hour, $hourly_wage);
                    M('item')->where("id = ".$v)->save($save);
                }else{
                    unset($waiter[$k]);
                }
            }

            // 20190223 注释
            // $save = array(
                // 'wage' => $_POST['wage'],
            //     'break' => $_POST['break'],
            //     'ontime' => $_POST['ontime'],
            //     'offtime' => $_POST['offtime'],
            //     'is_con' => $_POST['is_con'],
            //     'pay' => $_POST['pay'],
            //     'paymoney' => $_POST['paymoney'],
            //     'clothes' => $_POST['clothes']
            // );
            // $_POST['id'] = trim($_POST['id'], ',');
            // $hour = round((strtotime($_POST['offtime']) - strtotime($_POST['ontime']) ) / (60 * 60) - $_POST['break'] / 60, 2);
            // $reward = bcadd($reward, bcmul($hour, $_POST['wage']));
            // $sub = bcsub($this->webset['wage'], $_POST['wage']);
            // $irebate = 0;
            // if ($sub > 0) {
            //     $irebate = bcmul($hour, $sub);
            // }
            // $save['hours'] = $hour;
            // $save['rebate'] = $irebate;
            // $save['reward'] = bcmul($hour, $_POST['wage']);
            // M('item')->where("id in ({$_POST['id']})")->save($save);
            $this->reset($_POST['subject_id']);
            cookie("err_mes", "保存成功！");
            $this->redirect('foremen/flist', array('id' => $_POST['subject_id']));
        }
        if ($_GET['id']) {
            $subject_id = $_GET['subject_id'];
            $subject = M("subject")->where("id = {$subject_id} and passed = 1 and user_id = {$this->user['id']}")->find();
            $item = M("item")->where("subject_id = {$subject_id} and user_id = {$this->user['id']} ")->select();
            foreach ($item as &$vol) {
                $vol['wait'] = M('waiter')->where('id=' . $vol['waiter_id'])->find();
            }
            if (!$subject) {
                echo '<script>history.go(-1);</script>';
                exit;
            }
            $ids = implode(',', $_GET['id']);
            $check = M("item")->field('id')->where("status != 1 and subject_id = {$subject_id} and user_id = {$this->user['id']} and id in ({$ids}) ")->select();
            $checklist = array_column($check, 'id');
            $this->assign(array(
                'subject' => $subject,
                'item' => $item,
                'check' => $checklist
            ));
            $this->display();
        }
    }

    // 20190223 修改
    public function changeitem() {
        $id = (int) $_GET['id'];
        $subject = M("subject")->where("id = {$id} and passed = 1 and user_id = {$this->user['id']}")->find();
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
                    if (M('item')->where("subject_id = {$subject['id']} and waiter_id = {$v}")->find()) {
                        continue;
                    }

                    // 时薪     // 20190223 修改
                    $level_id = $this->finds('waiter',  'id = '. $v, 'id desc', true)['level'];
                    $hourly_wage = $this->finds('level', 'id = '. $level_id, 'id desc', true)['price'];

                    $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $subject['break'] / 60, 2);
                    $reward = bcadd($reward, bcmul($hour, $subject['wage']));
                    $sub = bcsub($this->webset['wage'], $subject['wage']);
                    $irebate = 0;
                    if ($sub > 0) {
                        $irebate = bcmul($hour, $sub);
                    }
                    $data = array(
                        'part_id' => $subject['part_id'],
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
                        // 'reward' => bcmul($hour, $subject['wage']), // 20190223 注释
                        // 'wage' => $subject['wage'],
                        'reward' => bcmul($hour, $hourly_wage), // 20190223 修改
                        'wage' => $hourly_wage
                    );
                    $list[] = $data;
                }
            }
            $sl = count($list);
            if (count($list) + $subject['sl'] > $subject['total']) {
                $this->msg('人数超出项目限制！');
            }
            $a = M('subject')->where("id = {$id} and total >= sl + {$sl}")->save(array('title' => $_POST['title'], 'passed' => 0, 'part_id' => $_POST['part_id'], 'num' => $_POST['num'], 'total' => $_POST['total'], 'hotel_id' => $_POST['hotel_id'], 'worktime' => $_POST['worktime']));
            $b = M('item')->where("subject_id = {$id}")->save(array('worktime' => $_POST['worktime'], 'part_id' => $_POST['part_id'], 'hotel_id' => $_POST['hotel_id']));
            if ($sl > 0) {
                M()->startTrans();
                $d = M('subject')->where("id = {$id} and total >= sl + {$sl}")->setInc('sl', $sl);
                $c = M('item')->addAll($list);
                if ($c && $d) {
                    M()->commit();
                    $this->reset($subject['id']);
                    if ($this->webset['notice_tel']) {
                        $sl = M('subject')->where("passed = 0")->count() ?: 0;
                        $this->sendinfo($this->webset['notice_tel'], array($sl), '3');
                    }
                    $this->msg('保存成功！', U('foremen/index'));
                } else {
                    M()->rollback();
                    $this->msg('保存失败！', U('foremen/index'));
                }
            }
            cookie("err_mes", "保存成功！");
            $this->redirect('foremen/index');
        }
        $offset = 20;
        $page = $_GET['page']>1?($_GET['page']-1)*$offset:0;
        $item = M('item')->where("subject_id = {$id}")->field('waiter_id')->select();
        $ids = implode(',', array_column($item, 'waiter_id'));
        if (!empty($item)) {
            $where = " and id not in ({$ids})";
        }
        $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();
        $this->assign(array(
            'hotel' => $hotel
        ));
        $waiter = M('waiter')->where("passed = 1 " . $where)->order('id desc')->limit($page, $offset)->select();
        cookie("fwait", "passed = 1 " . $where);
        $isflag = $_GET['isflag'];
        if (!$isflag){
            $this->assign(array(
                'subject' => $subject,
                'waiter' => $waiter,
                'sl' => count($item),
            ));
            $this->display();
        }else{
            $this->ajaxReturn(array(
                'code' => 1,
                'data' => $waiter
            ));
        }

    }

    public function flist() {
        $id = (int) $_GET['id'];
        $subject = M('subject')->where("id = {$id} and passed = 1 and user_id = {$this->user['id']}  and is_hs = 0")->find();
        if (!$subject) {
            echo '<script>history.go(-1);</script>';
            exit;
        }

        $this->sub_query($id);
        $where = "";
        if ($_GET['keyboard']) {
            $k = addslashes($_GET['keyboard']);
            $waiter = M('waiter')->where("username like '%{$k}%' or moble like '%{$k}%'")->field('id')->select();
            $ids = implode(',', array_column($waiter, 'id'));
            $where = " and (waiter_id in ($ids))";
        }
        if ($_GET['status']) {
            if ($_GET['status'] == 1) {
                $where = " and is_con = 0";
            } else if ($_GET['status'] == 2) {
                $where = " and is_con = 1 and status != 1";
            } else {
                $where = " and  status = 1";
            }
            $this->assign('status', $_GET['status']);
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

    public function wagelist() {
        $id = (int) $_GET['id'];
        $subject = M('subject')->where("id = {$id} and passed = 1 and user_id = {$this->user['id']}  and is_hs = 0")->find();
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
        $list = M('sendhb')->where("subject_id = {$subject['id']}" . $where)->order('id desc')->select();
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

    // 20190223 修改
    public function fshow() {
        $id = (int) $_GET['id'];
        $item = M('item')->where("id = {$id}")->find();
        $waiter = M('waiter')->where("id = {$item['waiter_id']}")->find();
        if (!$item) {
            echo '<script>history.go(-1);</script>';
            exit;
        }
        // dump($id);die;
        if (IS_POST) {
            // 时薪     // 20190223 修改
            $hourly_wage = M('item i')->join('ni88_waiter w ON i.waiter_id = w.id ')->join('ni88_level l ON w.level = l.id')->field('price')->where('i.id = '.$id)->find()['price'];
            $ontime = $_POST['ontime'];
            $offtime = $_POST['offtime'];
            $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $_POST['break'] / 60, 2);
            // $sub = bcsub((float) $this->webset['wage'], (float) $_POST['wage']);
            // if ($this->webset['wage'] > $_POST['wage']) {
            //     $irebate = bcmul($hour, $sub);
            // } else {
            //     $irebate = 0;
            // }
            $sub = bcsub((float) $this->webset['wage'], (float) $hourly_wage);
            if ($this->webset['wage'] > $hourly_wage) {
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
                // 'reward' => bcmul($hour, (float) $_POST['wage']),
                // 'wage' => $_POST['wage'],
                'reward' => bcmul($hour, (float) $hourly_wage),
                'wage' => $hourly_wage,
                'is_con' => $_POST['is_con']
            );
            // dump($this->webset);
            // dump($data);
            // die;
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
        cookie('captcha', 1);
        $this->display();
    }

    protected function sub_query($id) {
        //$id= 495;
        $sendlist = M('sendhb')->where("(passed = 1 or passed = 3) and subject_id = {$id}")->select();
        foreach ($sendlist as $v) {
            $info = $this->sendquery($v['ordern']);
            if ($info['result_code'] == 'SUCCESS') {
                if ($info['status'] == 'RECEIVED') {
                    $receive = 2;
                } elseif ($info['status'] == 'RFUND_ING') {
                    $receive = 3;
                } elseif ($info['status'] == 'REFUND') {
                    $receive = 4;
                } elseif ($info['status'] == 'SENT') {
                    $receive = 1;
                } else {
                    continue;
                }
                if ($receive) {
                    M('sendhb')->where("id = {$v['id']}")->save(array(
                        'passed' => $receive
                    ));
                    if ($receive == 2) {
                        M('item')->where("id = {$v['item_id']}")->setInc('receive_price', $v['amount']);
                    }
                    if ($receive == 4) {
                        M('item')->where("id = {$v['item_id']}")->setDec('send_price', $v['amount']);
                        M('item')->where("id = {$v['item_id']}")->save(array('status' => 2));
                        M('user')->where("id = {$v['user_id']}")->setInc('discount', $v['amount']);
                        M('jl')->add(array(
                            'addtime' => time(),
                            'user_id' => $v['user_id'],
                            'price' => $v['amount'],
                            'qy' => 3,
                            'addtime' => $time,
                        ));
                    }
                }
            }
        }
    }

    protected function send_redpack($openid, $amoount, $mch_billno) {
//        return array(
//            'return_code' => 'SUCCESS',
//            'result_code' => 'SUCCESS',
//        );
        vendor('Wxpay.Wxpaypubhelper');
        vendor('Wxpay.Sddkruntimeexception');
        vendor('Wxpay.Wxpayconfig');
        $xx = $this->finds("Pay", "passed=1 and  id=2 ", 'id desc');
        $pz = $xx['pz'];
        $pz = explode("||", $pz);
        $payconf = new WxPayConf_pub();
        WxPayConf_pub::$addid = $pz[0];
        WxPayConf_pub::$mchid = $pz[2];
        WxPayConf_pub::$key = $pz[3];
        WxPayConf_pub::$appsecret = $pz[1];
        $act_name = "辛苦了，您今天工资！";
        $wishing = "辛苦了，您今天工资！";
        $client_ip = get_client_ip();
        $remark = "无";
        $scene_id = "PRODUCT_4";
        $total_amount = intval($amoount * 100);
        $re_openid = $openid;
        $send_name = "泰诺日结";
        //$mch_billno = date("YmdHis").rand(10000,99999);
        $input = new Send_redpack();
        $input->setParameter("re_openid", $re_openid);
        $input->setParameter("act_name", $act_name);
        $input->setParameter("wishing", $wishing);
        $input->setParameter("client_ip", $client_ip);
        $input->setParameter("remark", $remark);
        $input->setParameter("send_name", $send_name);
        $input->setParameter("total_amount", $total_amount);
        $input->setParameter("scene_id", $scene_id);
        $input->setParameter("mch_billno", $mch_billno);
        $unifiedOrderResult = $input->getResult();
        return $unifiedOrderResult;
    }

    public function querytest() {
        //set_time_limit(0);
        $ddbh = '201804180327376698664';
        vendor('Wxpay.Wxpaypubhelper');
        vendor('Wxpay.Sddkruntimeexception');
        vendor('Wxpay.Wxpayconfig');
        $xx = $this->finds("Pay", "passed=1 and  id=2 ", 'id desc');
        $pz = $xx['pz'];
        $pz = explode("||", $pz);
        $payconf = new WxPayConf_pub();
        WxPayConf_pub::$addid = $pz[0];
        WxPayConf_pub::$mchid = $pz[2];
        WxPayConf_pub::$key = $pz[3];
        WxPayConf_pub::$appsecret = $pz[1];

        //$mch_billno = date("YmdHis").rand(10000,99999);
        $input = new Send_query();
        $input->setParameter("mch_billno", $ddbh);
        $unifiedOrderResult = $input->getResult();
        dump($unifiedOrderResult);
        exit;
        return $unifiedOrderResult;
    }

    protected function sendquery($ddbh) {
        set_time_limit(0);

        vendor('Wxpay.Wxpaypubhelper');
        vendor('Wxpay.Sddkruntimeexception');
        vendor('Wxpay.Wxpayconfig');
        $xx = $this->finds("Pay", "passed=1 and  id=2 ", 'id desc');
        $pz = $xx['pz'];
        $pz = explode("||", $pz);
        $payconf = new WxPayConf_pub();
        WxPayConf_pub::$addid = $pz[0];
        WxPayConf_pub::$mchid = $pz[2];
        WxPayConf_pub::$key = $pz[3];
        WxPayConf_pub::$appsecret = $pz[1];

        //$mch_billno = date("YmdHis").rand(10000,99999);
        $input = new Send_query();
        $input->setParameter("mch_billno", $ddbh);
        $unifiedOrderResult = $input->getResult();
        return $unifiedOrderResult;
    }

    // public function wage() {
    //       	// cookie("err_mes", '系统维护中~');
    //       	// return false;
    //         set_time_limit(0);
    //         $id = (int) $_GET['subject_id'];
    //         $subject = M('subject')->where("id={$id} and user_id = {$this->user['id']}")->find();
    //         if (!$subject) {
    //             $this->redirect('foremen/index');
    //         }
    //         $ids = implode(',', $_GET['id']);
    //         $time = time();
    //         $date = date('YmdHis');
    //         $item = M('item')->where("status != 1 and is_hs = 0 and is_con = 1 and id in ({$ids}) and subject_id = {$subject['id']}")->select();
    //         // var_dump($item);
    //         // die;
    //         // 红包限额 20190223
    //         $quota = M('web')->find()['limit'];
    //
    //         foreach ($item as $v) {
    //             $waiter = M('waiter')->where("id = {$v['waiter_id']}")->find();
    //             $send_price = 0;
    //             if ($v['reward'] >= $quota) {
    //                 continue;
    //             }
    //             $reward = $v['reward'] - $v['send_price'];
    //             if ($reward) {
    //                 $user = M('user')->where("id ={$this->user['id']}")->field('discount,id')->find();
    //                 if ($user['discount'] < $reward) {
    //                     cookie("err_mes", '当前账号余额不足！');
    //                     $this->redirect('foremen/index');
    //                 }
    //             }
    //             if ($waiter['openid']) {
    //                 for ($i = $reward; $i >= 1; $i = $i - 200) {
    //                     $amount = $i >= 200 ? 200 : $i;
    //                     $ordernum = $date . rand(10000, 99999) . $waiter['id'];
    //                     // $res = $this->send_redpack($waiter['openid'], $amount, $ordernum);
    //                     $res = array(
    //                         'return_code' => 'SUCCESS',
    //                         'result_code' => 'SUCCESS'
    //                     );
    //                     if ($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS') {
    //                         $send_price += $amount;
    //                         M('user')->where("id = {$this->user['id']}")->setDec('discount', $amount);
    //                         M('jl')->add(array(
    //                             'user_id' => $v['user_id'],
    //                             'price' => $amount,
    //                             'qy' => 1,
    //                             'addtime' => $time,
    //                         ));
    //                         M('sendhb')->add(array(
    //                             'waiter_id' => $waiter['id'],
    //                             'user_id' => $v['user_id'],
    //                             'amount' => $amount,
    //                             'ordern' => $ordernum,
    //                             'addtime' => $time,
    //                             'item_id' => $v['id'],
    //                             'subject_id' => $subject['id'],
    //                             'passed' => 1,
    //                             'msg' => $res['err_code_des'],
    //                             'wxddbh' => $res['send_listid']
    //                         ));
    //                     } else {
    //                         M('sendhb')->add(array(
    //                             'waiter_id' => $waiter['id'],
    //                             'user_id' => $v['user_id'],
    //                             'amount' => $amount,
    //                             'ordern' => $ordernum,
    //                             'addtime' => $time,
    //                             'item_id' => $v['id'],
    //                             'subject_id' => $subject['id'],
    //                             'passed' => 0,
    //                             'msg' => $res['err_code_des'],
    //                         ));
    //                     }
    //                 }
    //                 $status = $send_price + $v['send_price'] == $v['reward'] ? 1 : 2;
    //                 M('item')->where("id = {$v['id']}")->save(array(
    //                     'status' => $status,
    //                     'send_price' => $v['send_price'] + $send_price,
    //                 ));
    //             }
    //         }
    //         cookie("err_mes", '发放成功！');
    //         $this->redirect('foremen/index', array('id' => $subject['id']));
    //     }

    public function wage() {
        set_time_limit(0);
        $id = (int) $_GET['subject_id'];
        $subject = M('subject')->where("id={$id} and user_id = {$this->user['id']}")->find();
        if (!$subject) {
            $this->redirect('foremen/index');
        }
        $ids = implode(',', $_GET['id']);
        $date = date('YmdHis');
        $item = M('item')->where("status != 1 and is_hs = 0 and is_con = 1 and id in ({$ids}) and subject_id = {$subject['id']}")->select();
        // 红包限额 20190223
        $quota = M('web')->find()['limit'];
        // $t1 = microtime(true);

        foreach ($item as $k => $v) {
            $waiter = M('waiter')->where("id = {$v['waiter_id']}")->find();
            // $send_price = 0;
            if ($v['reward'] >= $quota) {
                continue;
            }

            $reward = $v['reward'] - $v['send_price'];

            if ($reward > 0) {
                $user = M('user')->where("id ={$this->user['id']}")->field('discount,id')->find();
                if ($user['discount'] < $reward) {
                    cookie("err_mes", '当前账号余额不足！');
                    $this->redirect('foremen/index');
                }
            }
            if ($waiter['openid']) {
                for ($i = $reward; $i >= 1; $i = $i - 200) {
                    $amount = $i >= 200 ? 200 : $i;

                    if (($item[$k]['send_price'] + $amount) > $v['reward'] ) {
                        continue;
                    }
                    $ordernum = $date . rand(10000, 99999) . $waiter['id'];
                    // $res = $this->send_redpack($waiter['openid'], $amount, $ordernum);
                    $res = array(
                        'return_code' => 'SUCCESS',
                        'result_code' => 'SUCCESS'
                    );
                    usleep(50000);
                    $time = time();

                    if ($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS') {
                        // $send_price += $amount;
                        $item[$k]['send_price'] += $amount;

                        M('user')->where("id = {$this->user['id']}")->setDec('discount', $amount);
                        M('jl')->add(array(
                            'user_id' => $v['user_id'],
                            'price' => $amount,
                            'qy' => 1,
                            'addtime' => $time,
                        ));

                        M('sendhb')->add(array(
                            'waiter_id' => $waiter['id'],
                            'user_id' => $v['user_id'],
                            'amount' => $amount,
                            'ordern' => $ordernum,
                            'addtime' => $time,
                            'item_id' => $v['id'],
                            'subject_id' => $subject['id'],
                            'passed' => 1,
                            'msg' => $res['err_code_des'],
                            'wxddbh' => $res['send_listid']
                        ));

                    } else {
                        M('sendhb')->add(array(
                            'waiter_id' => $waiter['id'],
                            'user_id' => $v['user_id'],
                            'amount' => $amount,
                            'ordern' => $ordernum,
                            'addtime' => $time,
                            'item_id' => $v['id'],
                            'subject_id' => $subject['id'],
                            'passed' => 0,
                            'msg' => $res['err_code_des'],
                        ));
                        $flag = true;
                        break;
                    }
                }

                // $status = $send_price + $v['send_price'] == $v['reward'] ? 1 : 2;
                // M('item')->where("id = {$v['id']}")->save(array(
                //     'status' => $status,
                //     'send_price' => $v['send_price'] + $send_price,
                // ));
                // var_dump($v['send_price']);
                // echo "<hr/>";
                // var_dump($item[$k]['send_price']);
                $status = $item[$k]['send_price'] ? ($item[$k]['send_price'] == $v['reward'] ? 1 : 2) : 0;

                M('item')->where("id = {$v['id']}")->save(array(
                    'status' => $status,
                    'send_price' => $item[$k]['send_price'],
                ));
                if ($flag) {
                    break;
                }
            }
        }
        // $t2 = microtime(true);
        // echo '耗时'.round($t2-$t1,3).'秒<br>';
        // echo 'Now memory_get_usage: ' . memory_get_usage() . '<br />';
        // foreach ($item as $k => $v) {
        //     $item[$k]['status'] = $v['send_price'] ? ($item[$k]['send_price'] == $v['reward'] ? 1 : 2) : 0;
        //     var_dump($v['send_price']);
        //     echo "<hr/>";
        //     var_dump($item[$k]['status']);
        //     M('item')->where("id = {$v['id']}")->save(array(
        //         'status' => $item[$k]['status'],
        //         'send_price' => $v['send_price'],
        //     ));
        // }
        // $model = M();
        // foreach ($item as $k => $v) {
        //     $_item[$k]['waiter_id'] =  $v['waiter_id'];
        //     $_item[$k]['send_price'] =  $v['send_price'];
        //     $_item[$k]['status'] =  $v['status'];
        // }
        //
        // $sql = $this->batchUpdate($_item, 'waiter_id');
        //
        // M()->execute($sql);
        // file_put_contents(rand(1000,9999).'.txt', 1, FILE_APPEND);
        $msg = $flag ? '部分发放成功,' . $res[err_code_des] : '发放成功！';
        cookie("err_mes", $msg);
        $this->redirect('foremen/index', array('id' => $subject['id']));
    }

    /**
 * 批量更新函数
 * @param $data array 待更新的数据，二维数组格式
 * @param array $params array 值相同的条件，键值对应的一维数组
 * @param string $field string 值不同的条件，默认为id
 * @return bool|string
 */
function batchUpdate($data, $field, $params = [])
{
   if (!is_array($data) || !$field || !is_array($params)) {
      return false;
   }

    $updates = $this->parseUpdate($data, $field);
    $where = $this->parseParams($params);

    // 获取所有键名为$field列的值，值两边加上单引号，保存在$fields数组中
    // array_column()函数需要PHP5.5.0+，如果小于这个版本，可以自己实现，
    // 参考地址：http://php.net/manual/zh/function.array-column.php#118831
    $fields = array_column($data, $field);
    $fields = implode(',', array_map(function($value) {
        return "'".$value."'";
    }, $fields));

    $sql = sprintf("UPDATE `%s` SET %s WHERE `%s` IN (%s) %s", 'ni88_item', $updates, $field, $fields, $where);

   return $sql;
}

/**
 * 将二维数组转换成CASE WHEN THEN的批量更新条件
 * @param $data array 二维数组
 * @param $field string 列名
 * @return string sql语句
 */
function parseUpdate($data, $field)
{
    $sql = '';
    $keys = array_keys(current($data));

    foreach ($keys as $column) {
        $sql .= sprintf("`%s` = CASE `%s` \n", $column, $field);
        foreach ($data as $line) {
            $sql .= sprintf("WHEN '%s' THEN '%s' \n", $line[$field], $line[$column]);
        }
        $sql .= "END,";
    }

    return rtrim($sql, ',');
}

/**
 * 解析where条件
 * @param $params
 * @return array|string
 */
function parseParams($params)
{
   $where = [];
   foreach ($params as $key => $value) {
      $where[] = sprintf("`%s` = '%s'", $key, $value);
   }

   return $where ? ' AND ' . implode(' AND ', $where) : '';
}


    public function dc() {
        ob_end_clean();
        $id = $_GET['id'];
        $arr = $this->joinarr('item', 1000, 'ni88_item.*,ni88_waiter.username,ni88_waiter.moble', "1 and subject_id = {$id}", 'ni88_item.id desc', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id');
        set_time_limit(0);
        $this->head("subject_item");
        $filename = '<tr>
	            <td >序号</td>
                    <td >服务员</td>
                    <td >服务员手机号码</td>
                    <td >上班时间</td>
                    <td >下班时间</td>
                    <td >就餐休息时间（分钟）</td>
                    <td >工时（小时）</td>
                    <td >时薪（元）</td>
                    <td >酬劳（元）</td>
                    <td >领班返利</td>
                    <td >归还工服</td>
                    <td >现金支付</td>
                    <td >现金支付金额（元）</td>
                    <td >是否确认</td>
                    <td >工资发放状态</td>
                    <td >已发放金额（元）</td>
                    </tr>';
        foreach ($arr['list'] as $key => $val) {
            $clothes = $val['clothes'] == 1 ? "是" : "否";
            $pay = $val['pay'] == 1 ? "是" : "否";
            $con = $val['is_con'] == 1 ? "是" : "否";
            $filename .= '<tr>
		               <td>' . ($key + 1) . '</td>
		               <td >' . $val['username'] . '</td>
				<td >' . $val['moble'] . '</td>
                                <td >' . $val['ontime'] . '</td>
                                <td >' . $val['offtime'] . '</td>

                                <td >' . $val['break'] . '</td>
                                <td >' . $val['hours'] . '</td>
				<td >' . $val['wage'] . '</td>
                                <td >' . $val['reward'] . '</td>
                                <td >' . $val['rebate'] . '</td>
                                <td >' . $clothes . '</td>
                                <td >' . $pay . '</td>
                                <td >' . $val['paymoney'] . '</td>
                                    <td >' . $con . '</td>
                                        <td >' . sendstatus($val['status']) . '</td>
                                            <td >' . $val['send_price'] . '</td>
					   </tr>';
        }
        //if (count($arr['list']) == 1) {
        $filename = iconv("utf-8", "gb2312", $filename);
        //}
        //
        echo '<table width="1000" border="1">' . $filename . '</table>';
    }

}

?>
