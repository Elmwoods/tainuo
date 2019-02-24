<?php

if (!defined("ni8shop"))
    exit("Access Denied");

class ProAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        $this->checkuserb();
        $this->adminlog();
        $this->ly = $_SERVER['HTTP_REFERER'];
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

    public function qy() {
        if (isset($_GET['qy'])) {
            if (!empty($_GET['qy'])) {
                cookie('qy', (int) $_GET['qy']);
            } else {
                //cookie('qy',0);
            }
        }
    }

    public function hotel() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("hotel", 'id=' . $id . '', 'id desc');
                if ($show) {
                    $this->del('hotel', 'id=' . $show['id']);
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("hotel", 'id=' . $id . '', 'id desc');
            if ($show) {
                $this->del('hotel', 'id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }


        $where = " ";
        if (!empty($_GET['title'])) {
            $where .= " and (title like '%" . $_GET['title'] . "%' )";
            $this->assign('title', $_GET['title']);
        }
        if ($_GET['passed'] <> "") {
            $where .= " and passed=" . (int) $_GET['passed'] . "";
            $this->assign('passed', (int) $_GET['passed']);
        }


        $arr = $this->arr('hotel', 20, ' 1 ' . $where, 'id desc');
        $arry = $arr['list'];

        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function reset($subject_id) {
        $webset = M('web')->find();
        $items = M('item')->where("subject_id = {$subject_id}")->select();
        $reward = 0;
        $sum = 0;
        $hours = 0;
        foreach ($items as $vol) {
            $hour = round((strtotime($vol['offtime']) - strtotime($vol['ontime']) ) / (60 * 60) - $vol['break'] / 60, 2);
            if ($hour >= 0) {
                $hours = bcadd($hours, $hour);
                $reward = bcadd($reward, bcmul($hour, (float) $vol['wage']));
            }
            $sub = bcsub((float) $webset['wage'], (float) $vol['wage']);
            if ($sub > 0 && $hour > 0) {
                $sum = bcadd($sum, bcmul($hour, $sub));
            } else {
                $sub = 0;
            }
        }
        $rebate = $sum;
        M('subject')->where("id = {$subject_id}")->save(array('rebate' => $rebate, 'reward' => $reward, 'hours' => $hours));
    }

    public function hsave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = (int) $_POST['id_not'];
            $nr = array();
            $nr = $this->build_sql($_POST);
            if ($id > 0) {
                $this->save("hotel", $nr, 'id=' . $id);
            } else {
                $this->add("hotel", $nr);
            }
            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }

        $act = $_GET['act'];
        $id = (int) $_GET['id'];
        if (!empty($id)) {
            $show = $this->finds("hotel", 'id=' . $id . '', 'id desc');
            $this->assign('show', $show);
        }

        $this->display();
    }

    public function psave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = (int) $_POST['id_not'];
            $nr = array();
            $nr = $this->build_sql($_POST);
            if ($id > 0) {
                $this->save("part", $nr, 'id=' . $id);
            } else {
                $this->add("part", $nr);
            }
            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }
        $hotel = M('hotel')->where("passed = 1 ")->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $act = $_GET['act'];
        $id = (int) $_GET['id'];
        if (!empty($id)) {
            $show = $this->finds("hotel", 'id=' . $id . '', 'id desc');
            $this->assign('show', $show);
        }
        $this->display();
    }

    public function part() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("part", 'id=' . $id . '', 'id desc');
                if ($show) {
                    $this->del('part', 'id=' . $show['id']);
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("part", 'id=' . $id . '', 'id desc');
            if ($show) {
                $this->del('part', 'id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        $where = " ";
        if (!empty($_GET['title'])) {
            $where .= " and (title like '%" . $_GET['title'] . "%' )";
            $this->assign('title', $_GET['title']);
        }
        if ($_GET['passed'] <> "") {
            $where .= " and passed=" . (int) $_GET['passed'] . "";
            $this->assign('passed', (int) $_GET['passed']);
        }
        if ($_GET['hotel_id'] <> "") {
            $where .= " and hotel_id=" . (int) $_GET['hotel_id'] . "";
            $this->assign('hotel_id', (int) $_GET['hotel_id']);
        }
        $hotel = M('hotel')->where("passed = 1 ")->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $arr = $this->arr('part', 20, ' 1 ' . $where, 'id desc');
        $arry = $arr['list'];

        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function subject() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("subject", 'id=' . $id . '', 'id desc');
                if ($show) {
                    $this->del('subject', 'id=' . $show['id']);
                    $this->del('item', 'subject_id=' . $show['id']);
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("subject", 'id=' . $id . '', 'id desc');
            if ($show) {
                $this->del('subject', 'id=' . $show['id']);
                $this->del('item', 'subject_id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        $ks = $_GET['ks'];
        $js = $_GET['js'];
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);

        $where = " and ni88_subject.passed = 1 ";
        if ($ks) {
            $where .= " and (worktime >= '{$ks}' )";
        }
        if ($js) {
            $where .= " and (worktime < '{$js}' )";
        }
        if (!empty($_GET['title'])) {
            $where .= " and (ni88_subject.title like '%" . $_GET['title'] . "%' )";
            $this->assign('title', $_GET['title']);
        }
        if (!empty($_GET['hotel_id'])) {
            $where .= " and (hotel_id = {$_GET['hotel_id']} )";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if (!empty($_GET['part_id'])) {
            $where .= " and (part_id = {$_GET['part_id']} )";
            $this->assign('part_id', $_GET['part_id']);
        }
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or nickname like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        S('subject_where', $where);
        $arr = $this->joinarr('subject', 20, 'ni88_subject.*,ni88_user.username,ni88_user.nickname,ni88_hotel.title as hotel', ' 1 ' . $where, 'ni88_subject.worktime desc,ni88_subject.id desc', 'left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id',false,true);
        $rebate = M('subject')->where(' 1 ' . $where)->join('left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id')->sum('ni88_subject.rebate');
        $reward = M('subject')->where(' 1 ' . $where)->join('left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id')->sum('ni88_subject.reward');
        $hours = M('subject')->where(' 1 ' . $where)->join('left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id')->sum('ni88_subject.hours');
        // 新增
        $tarrs = M('subject')->where(' 1 ' .$where)->field('ni88_subject.*,ni88_user.username,ni88_user.nickname,ni88_hotel.title as hotel')->join( 'left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id')->order('ni88_subject.worktime desc,ni88_subject.id desc')->select();
        $kq_sum = 0;
        foreach($tarrs as $k => $v){
            $kq_num = M('item')->where("subject_id = {$v['id']} and is_con = 1 and is_hs = 0")->count();
            $kq_sum += $kq_num;
        }
        foreach($arr['list'] as $k => $v){
            $arr['list'][$k]['kq_num'] = M('item')->where("subject_id = {$v['id']} and is_con = 1 and is_hs = 0")->count();
            // $kq_sum += $arr['list'][$k]['kq_num'];
        }
        
        $this->assign('reward', $reward);
        $this->assign('rebate', $rebate);
        $this->assign('hours', $hours);
        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $part = M('part')->order('sort desc,id desc')->select();
        $this->assign('part', $part);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->assign('xd_sum', $arr['xd_sum']);
        $this->assign('kq_sum', $kq_sum);
        $this->display();
    }
    public function applysp() {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("subject", 'id=' . (int)$id . '', 'id desc');
                if ($show) {
                    M('subject')->where("id = {$id}")->save(array(
						'passed' => 1
					));
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
	}
    public function apply() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("subject", 'id=' . $id . '', 'id desc');
                if ($show) {
                    $this->del('subject', 'id=' . $show['id']);
                    $this->del('item', 'subject_id=' . $show['id']);
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("subject", 'id=' . $id . '', 'id desc');
            if ($show) {
                $this->del('subject', 'id=' . $show['id']);
                $this->del('item', 'subject_id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['iid'])) {
            $id = (int) $_GET['iid'];
            $show = $this->finds("subject", 'id=' . $id . '', 'id desc');
            if ($show) {
                M('subject')->where("id = {$id}")->save(array(
                    'passed' => 1
                ));
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        $ks = $_GET['ks'];
        $js = $_GET['js'];
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);

        $where = " and ni88_subject.passed = 0 ";
        if ($ks) {
            $where .= " and (worktime >= '{$ks}' )";
        }
        if ($js) {
            $where .= " and (worktime < '{$js}' )";
        }
        if (!empty($_GET['title'])) {
            $where .= " and (ni88_subject.title like '%" . $_GET['title'] . "%' )";
            $this->assign('title', $_GET['title']);
        }
        if (!empty($_GET['hotel_id'])) {
            $where .= " and (hotel_id = {$_GET['hotel_id']} )";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if (!empty($_GET['part_id'])) {
            $where .= " and (part_id = {$_GET['part_id']} )";
            $this->assign('part_id', $_GET['part_id']);
        }
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or nickname like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        $arr = $this->joinarr('subject', 20, 'ni88_subject.*,ni88_user.username,ni88_user.nickname,ni88_hotel.title as hotel', ' 1 ' . $where, 'ni88_subject.id desc', 'left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id');

        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $part = M('part')->order('sort desc,id desc')->select();
        $this->assign('part', $part);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function sdc() {
        ob_end_clean();                                         
        $where = S('subject_where');
        $arr = $this->joinarr('subject', 1000, 'ni88_subject.*,ni88_user.username,ni88_user.nickname,ni88_hotel.title as hotel', ' 1 ' . $where, 'ni88_subject.worktime desc,ni88_subject.id desc', 'left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id');
        set_time_limit(0);
        $this->head("subjects");
        $filename = '<tr>
	            <td >序号</td>
                    <td >项目名称</td>
                    <td >领班</td>
                    <td >酒店</td>
                    <td >部门</td>
                    <td >工作日期</td>
                    <td >返利</td>
                    <td >工时</td>
                    <td >薪酬</td>
                    <td >已发放金额</td>
                    <td >下单人数</td>
                    <td >考勤人数</td>
                    <td >发布时间</td>
                    </tr>'; //                    <td >时薪</td>                                      <td >' . $val['wage'] . ' </td>


        foreach ($arr['list'] as $key => $val) {
            $kq_num = M('item')->where("subject_id = {$v['id']} and is_con = 1 and is_hs = 0")->count();
            $filename .= '<tr>
		               <td >' . ($key + 1) . '</td>
                               <td >' . $val['title'] . '</td>	
		               <td >' . $val['username'] . $val['nickname'] . '</td>
                               <td >' . $val['hotel'] . '</td>	   
                                   <td >' . cate('part', $val['part_id']) . '</td>	   
                               <td >' . $val['worktime'] . '</td>
                               <td >' . $val['rebate'] . ' </td>
                                   <td >' . $val['hours'] . ' </td>
                               <td >' . $val['reward'] . ' </td>
                                   <td >' . sumprice('item','subject_id',$val['id'],'send_price') . ' </td>
                                   <td>'. $val['num'].'</td>
                                   <td>'. $kq_num.'</td>
                               <td >' . date('Y-m-d H:i:s', $val['addtime']) . '</td>
					   </tr>';
        }
        if (count($arr['list']) == 1) {
            $filename = iconv("utf-8", "gb2312", $filename);
        }
        echo '<table width="1000" border="1">' . $filename . '</table>';
    }

    public function xqdc() {
        ob_end_clean();
        $where = S('xq_where');
        $arr = $this->joinarr('item', 1000, 'ni88_item.*,ni88_waiter.username,ni88_waiter.moble', ' 1 ' . $where, 'ni88_item.ontime asc, ni88_item.offtime asc', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id');
        set_time_limit(0);
        $this->head("subject_item");
        $filename = '<tr>
	            <td >序号</td>
                    <td >服务员</td>
                    <td >服务员手机号码</td>
                    <td >上班时间</td>
                    <td >下班时间</td>
                    <td >就餐休息时间</td>
                    <td >工时</td>
                    <td >时薪</td>
                    <td >酬劳</td>
                    <td >领班返利</td>
                    <td >归还工服</td>
                    <td >现金支付</td>				 
                    <td >现金支付金额</td>
                    <td >是否确认</td>
                    <td >工资发放状态</td>
                    <td >已发放金额</td>
                    <td >已领取金额</td>
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
                                                 <td >' . $val['receive_price'] . '</td>
					   </tr>';
        }
        if (count($arr['list']) == 1) {
            $filename = iconv("utf-8", "gb2312", $filename);
        }
        //
        echo '<table width="1000" border="1">' . $filename . '</table>';
    }

    public function head($file) {
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $file . ".xls ");
        header("Content-Transfer-Encoding: binary ");
    }

    public function sublist() {
        $id = $_GET['id'];

        $subject = M('subject')->where("id = {$id}")->find();
        $where = " and  subject_id = {$subject['id']}";
        if ($subject) {
            $this->sub_query($subject['id']);
        }

        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or moble like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
         
        S('xq_where', $where);
        $arr = $this->joinarr('item', 20, 'ni88_item.*,ni88_waiter.username,ni88_waiter.moble', ' 1 ' . $where, 'ni88_item.ontime asc, ni88_item.offtime asc ', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id');
        $arry = $arr['list'];
        $this->assign('subject', $subject);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
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

    public function jl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $this->del('sendhb', 'id=' . $id . " ");
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $this->del('sendhb', 'id=' . $id . " ");
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }

        $where = " ";

        if (!empty($_GET['users'])) {
            $where .= " and ni88_user.username like '%{$_GET['users']}%'";
            $this->assign('users', $_GET['users']);
        }
        if (!empty($_GET['waiter'])) {
            $where .= " and (ni88_waiter.username like '%{$_GET['waiter']}%' or ni88_waiter.moble like '%{$_GET['waiter']}%')";
            $this->assign('waiter', $_GET['waiter']);
        }
        if (!empty($_GET['subject'])) {
            $where .= " and (ni88_subject.title like '%{$_GET['subject']}%') ";
            $this->assign('subject', $_GET['subject']);
        }
//        if (!empty($_GET['passed'])) {
//            $where .= " and (ni88_sendhb.passed = {$_GET['passed']} ";
//            $this->assign('passed', $_GET['passed']);
//        }
        $ks = strtotime($_GET['ks']);
        $js = strtotime($_GET['js']);
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);
        if (!empty($ks) && !empty($js)) {
            $where = $where . " and ni88_sendhb.addtime>=" . $ks . " and ni88_sendhb.addtime<=" . $js . "";
        }
        if (!empty($ks) && empty($js)) {
            $where = $where . " and ni88_sendhb.addtime>=" . $ks . " ";
        }
        if (empty($ks) && !empty($js)) {
            $where = $where . " and ni88_sendhb.addtime<=" . $js . "";
        }
        $ks = strtotime($_GET['ks']);
        $js = strtotime($_GET['js']);
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);
        if (!empty($ks) && !empty($js)) {
            $where = $where . " and ni88_sendhb.addtime>=" . $ks . " and ni88_sendhb.addtime<=" . $js . "";
        }
        if (!empty($ks) && empty($js)) {
            $where = $where . " and ni88_sendhb.addtime>=" . $ks . " ";
        }
        if (empty($ks) && !empty($js)) {
            $where = $where . " and ni88_sendhb.addtime<=" . $js . "";
        }
        $ks = $_GET['wks'];
        $js = $_GET['wjs'];
        $this->assign('wks', $_GET['wks']);
        $this->assign('wjs', $_GET['wjs']);
        if (!empty($ks) && !empty($js)) {
            $where = $where . " and ni88_subject.worktime>='" . $ks . "' and ni88_subject.worktime<='" . $js . "'";
        }
        if (!empty($ks) && empty($js)) {
            $where = $where . " and ni88_subject.worktime>='" . $ks . "' ";
        }
        if (empty($ks) && !empty($js)) {
            $where = $where . " and ni88_subject.worktime<='" . $js . "'";
        }
        $passed = $_GET['passed'];
        if ($passed <> "") {
            $where .= " and ni88_sendhb.passed=" . (int) $passed . "";
            $this->assign('passed', (int) $passed);
        }
        $arr = $this->joinarr('sendhb', 20, 'ni88_sendhb.*,ni88_user.username,ni88_subject.title,ni88_subject.worktime,ni88_waiter.username as waiter,ni88_waiter.moble as waitermoble', ' 1 ' . $where, 'ni88_sendhb.id desc', 'left join ni88_subject on ni88_subject.id = ni88_sendhb.subject_id left join ni88_user on ni88_user.id = ni88_sendhb.user_id left join ni88_waiter on ni88_waiter.id = ni88_sendhb.waiter_id');
        $arry = $arr['list'];
        // dump($arr);die;
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->assign('sum',$arr['count']);
        $this->display();
    }

    public function sssave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = (int) $_POST['id_not'];
            $show = M('item')->where("id = {$id}")->find();
            $nr = array();

            $nr = $this->build_sql($_POST);
            $nr['ontime'] = $nr['worktime'] . ' ' . $nr['ontime'];
            $nr['offtime'] = $nr['worktime'] . ' ' . $nr['offtime'];
            $nr['hours'] = round((strtotime($nr['offtime']) - strtotime($nr['ontime']) ) / (60 * 60) - $nr['break'] / 60, 2);
            $webset = M('web')->find();
            $sub = bcsub((float) $webset['wage'], (float) $_POST['wage']);
            $irebate = 0;
            if ($sub > 0) {
                $irebate = bcmul($nr['hours'], $sub);
            }
            $nr['rebate'] = $irebate;
            $nr['reward'] = bcmul($nr['hours'], (float) $nr['wage']);

            if ($id > 0) {
                $this->save("item", $nr, 'id=' . $id);
            } else {
                $this->add("item", $nr);
            }
            $this->reset($show['subject_id']);

            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }

        $act = $_GET['act'];
        $id = (int) $_GET['id'];
        if (!empty($id)) {
            $show = $this->finds("item", 'id=' . $id . '', 'id desc');
            $show['waiter'] = M('waiter')->where("id = {$show['waiter_id']}")->find();

            $this->assign('show', $show);
        }

        $this->display();
    }

    public function hz() {

        $ks = $_GET['ks'];
        $js = $_GET['js'];
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);
        $where = " and ni88_subject.passed = 1";
        if ($ks) {
            $where .= " and (worktime >= '{$ks}' )";
        }
        if ($js) {
            $where .= " and (worktime < '{$js}' )";
        }

        if (!empty($_GET['hotel_id'])) {
            $where .= " and (hotel_id = {$_GET['hotel_id']} )";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if (!empty($_GET['part_id'])) {
            $where .= " and (part_id = {$_GET['part_id']} )";
            $this->assign('part_id', $_GET['part_id']);
        }
        cookie('fitem_where', $where);
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or nickname like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        $tj = M('subject')->where(' 1 ' . $where)->field("SUM(hours) AS hourss,SUM(rebate) AS rebates,SUM(reward) AS rewards")->join('left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id')->find();
        $arr = $this->gjarr('subject', 20, 'SUM(hours) AS hourss,SUM(rebate) AS rebates,SUM(reward) AS rewards,ni88_user.username,ni88_user.nickname,ni88_subject.user_id,ni88_hotel.title as hotel', ' 1 ' . $where, 'ni88_subject.id desc', 'left join ni88_user on ni88_user.id = ni88_subject.user_id left join ni88_hotel on ni88_hotel.id = ni88_subject.hotel_id', 'ni88_subject.user_id');
        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $this->assign('arr', $arry);
        $this->assign('tj', $tj);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function fwhz() {

        $ks = $_GET['ks'];
        $js = $_GET['js'];
        $this->assign('ks', $_GET['ks']);
        $this->assign('js', $_GET['js']);

        $where = " and hours != 0";
        if ($ks) {
            $where .= " and (worktime >= '{$ks}' )";
        }
        if ($js) {
            $where .= " and (worktime < '{$js}' )";
        }
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or moble like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        if (!empty($_GET['hotel_id'])) {
            $where .= " and (hotel_id = {$_GET['hotel_id']} )";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if (!empty($_GET['part_id'])) {
            $where .= " and (part_id = {$_GET['part_id']} )";
            $this->assign('part_id', $_GET['part_id']);
        }
        $rebate = M('item')->where(' 1 ' . $where)->join('left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id')->sum('receive_price');
        $reward = M('item')->where(' 1 ' . $where)->join('left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id')->sum('reward');
        $hours = M('item')->where(' 1 ' . $where)->join('left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id')->sum('hours');
        $this->assign('reward', $reward);
        $this->assign('rebate', $rebate);
        $this->assign('hours', $hours);
        $arr = $arr = $this->joinarr('item', 20, 'ni88_item.*,ni88_waiter.username,ni88_waiter.moble', ' 1 ' . $where, 'worktime desc,ni88_item.id desc', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id');
        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
         cookie('fwhzdc',$where);
        $this->display();
    }
    public function fwhzdc() {
        $where = cookie('fwhzdc');
        $arr = $this->joinarr('item', 10000, 'ni88_item.*,ni88_waiter.username,ni88_waiter.moble', ' 1 ' . $where, 'worktime desc,ni88_item.id desc', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id');
        $arry = $arr['list'];
        ob_end_clean();
        set_time_limit(0);
        $this->head("Attendants");
        $filename = '<tr>
	            <td >序号</td>
                    <td >服务员</td>
                     <td >服务员手机号码</td>
                    <td >工作时间</td>
                    <td >酒店</td>
                    <td >部门</td>
                    <td >工时</td>
                    <td >时薪</td>
                    <td >酬劳</td>
                    <td >是否确认</td>
                    <td >工资发放状态</td>
                    <td >已发放金额</td>
                    <td >已领取金额</td>				 
                    </tr>';
        foreach ($arr['list'] as $key => $val) {
            $clothes = $val['clothes'] == 1 ? "是" : "否";
            $pay = $val['pay'] == 1 ? "是" : "否";
            $con = $val['is_con'] == 1 ? "是" : "否";
            $filename .= '<tr>
		               <td>' . ($key + 1) . '</td>
		               <td >' . $val['username'] .$val['u']. '</td>
				<td >' . $val['moble']. '</td>	   
                                <td >' . $val['ontime'] .'-'.$val['offtime'] . '</td>
                                <td >' . cate('hotel',$val['hotel_id']) . '</td>
                                    
                                <td >' . cate('part',$val['part_id']) . '</td>
                                <td >' . $val['hours'] . '</td>
				<td >' . $val['wage'] . '</td>	
                                <td >' . $val['reward'] . '</td>	
                                    <td >' . $con . '</td>
                                        <td >' . sendstatus($val['status']) . '</td>
                                            <td >' . $val['send_price'] . '</td>
                                                 <td >' . $val['receive_price'] . '</td>
					   </tr>';
        }
        if (count($arr['list']) == 1) {
            $filename = iconv("utf-8", "gb2312", $filename);
        }
        //
        echo '<table width="1000" border="1">' . $filename . '</table>';
    }

    public function fitem() {

        $id = (int) $_GET['id'];
        // $where = cookie('fitem_where');  // 20190219
        $where .= " and user_id = {$id}";
        $arr = $this->gjarr('item', 20, 'SUM(rebate) AS rebates,SUM(hours) AS hourss,SUM(reward) AS rewards,ni88_waiter.username,ni88_waiter.moble,ni88_item.waiter_id', ' 1 ' . $where, 'ni88_item.id desc', 'left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id', 'ni88_item.waiter_id');
        $arry = $arr['list'];
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

}

?>