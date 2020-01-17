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

    public function subject() {
        dump(1);die;
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

        $where = " ";
        if ($ks) {
            $where .= " and (worktime >= '{$ks}' )";
        }
        if ($js) {
            $where .= " and (worktime < '{$js}' )";
        }
        if (!empty($_GET['title'])) {
            $where .= " and (ni8_subject.title like '%" . $_GET['title'] . "%' )";
            $this->assign('title', $_GET['title']);
        }
        if (!empty($_GET['hotel_id'])) {
            $where .= " and (hotel_id = {$_GET['hotel_id']} )";
            $this->assign('hotel_id', $_GET['hotel_id']);
        }
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or nickname like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        S('subject_where', $where);
        $arr = $this->joinarr('subject', 20, 'ni8_subject.*,ni8_user.username,ni8_user.nickname,ni8_hotel.title as hotel', ' 1 ' . $where, 'ni8_subject.id desc', 'left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id');
        $rebate = M('subject')->where(' 1 ' . $where)->join('left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id')->sum('ni8_subject.rebate');
        $reward = M('subject')->where(' 1 ' . $where)->join('left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id')->sum('ni8_subject.reward');
        $hours = M('subject')->where(' 1 ' . $where)->join('left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id')->sum('ni8_subject.hours');
        $this->assign('reward', $reward);
        $this->assign('rebate', $rebate);
        $this->assign('hours', $hours);
        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function sdc() {
        ob_end_clean();
        $where = S('subject_where');
        $arr = $this->joinarr('subject', 1000, 'ni8_subject.*,ni8_user.username,ni8_user.nickname,ni8_hotel.title as hotel', ' 1 ' . $where, 'ni8_subject.id desc', 'left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id');
        set_time_limit(0);
        $this->head("subjects");
        $filename = '<tr>
	            <td >序号</td>
                    <td >项目名称</td>
                    <td >领班</td>
                    <td >酒店</td>
                    <td >工作日期</td>
                    <td >时薪</td>
                    <td >返利</td>
                    <td >工时</td>
                    <td >薪酬</td>
                    <td >发布时间</td>
                    </tr>';
        foreach ($arr['list'] as $key => $val) {
            $filename .= '<tr>
		               <td >' . ($key + 1) . '</td>
                               <td >' . $val['title'] . '</td>	
		               <td >' . $val['username'] . $val['nickname'] . '</td>
                               <td >' . $val['hotel'] . '</td>	   
                               <td >' . $val['worktime'] . '</td>
                                   <td >' . $val['wage'] . '元 </td>
                               <td >' . $val['rebate'] . '元 </td>
                                   <td >' . $val['hours'] . '小时 </td>
                               <td >' . $val['reward'] . '元 </td>	
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
        $arr = $this->joinarr('item', 1000, 'ni8_item.*,ni8_waiter.username,ni8_waiter.moble', ' 1 ' . $where, 'ni8_item.id desc', 'left join ni8_waiter on ni8_waiter.id = ni8_item.waiter_id');
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
                    </tr>';
        foreach ($arr['list'] as $key => $val) {
            $clothes = $val['clothes'] == 1 ? "是" : "否";
            $pay = $val['pay'] == 1 ? "是" : "否";
            $filename .= '<tr>
		               <td>' . ($key + 1) . '</td>
		               <td >' . $val['username'] . '</td>
				<td >' . $val['moble'] . '</td>	   
                                <td >' . $val['ontime'] . '</td>
                                <td >' . $val['offtime'] . '</td>
                                    
                                <td >' . $val['break'] . '分钟</td>
                                <td >' . $val['hours'] . '小时</td>
				<td >' . $val['wage'] . '元</td>	
                                <td >' . $val['reward'] . '元</td>	
                                <td >' . $val['rebate'] . '元</td>
                                <td >' . $clothes . '</td>
                                <td >' . $pay . '</td>
                                <td >' . $val['paymoney'] . '元</td>
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

        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or moble like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        S('xq_where', $where);
        $arr = $this->joinarr('item', 20, 'ni8_item.*,ni8_waiter.username,ni8_waiter.moble', ' 1 ' . $where, 'ni8_item.id desc', 'left join ni8_waiter on ni8_waiter.id = ni8_item.waiter_id');
        $arry = $arr['list'];
        $this->assign('subject', $subject);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
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
        $where = " ";
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
        cookie('fitem_where', $where);
        if (!empty($_GET['user'])) {
            $where .= " and (username like '%" . $_GET['user'] . "%' or nickname like '%" . $_GET['user'] . "%')";
            $this->assign('username', $_GET['user']);
        }
        $tj = M('subject')->where(' 1 ' . $where)->field("SUM(hours) AS hourss,SUM(rebate) AS rebates,SUM(reward) AS rewards")->join('left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id')->find();
        $arr = $this->gjarr('subject', 20, 'SUM(hours) AS hourss,SUM(rebate) AS rebates,SUM(reward) AS rewards,ni8_user.username,ni8_user.nickname,ni8_subject.user_id,ni8_hotel.title as hotel', ' 1 ' . $where, 'ni8_subject.id desc', 'left join ni8_user on ni8_user.id = ni8_subject.user_id left join ni8_hotel on ni8_hotel.id = ni8_subject.hotel_id', 'ni8_subject.user_id');
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

        $where = " ";
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
        $arr = $this->gjarr('item', 20, 'SUM(rebate) AS rebates,SUM(hours) AS hourss,SUM(reward) AS rewards,ni8_waiter.username,ni8_waiter.moble,ni8_item.waiter_id', ' 1 ' . $where, 'ni8_item.id desc', 'left join ni8_waiter on ni8_waiter.id = ni8_item.waiter_id', 'ni8_item.waiter_id');
        $arry = $arr['list'];
        $hotel = M('hotel')->order('sort desc,id desc')->select();
        $this->assign('hotel', $hotel);
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function fitem() {

        $id = (int) $_GET['id'];
        $where = cookie('fitem_where');
        $where .= " and user_id = {$id}";
        $arr = $this->gjarr('item', 20, 'SUM(rebate) AS rebates,SUM(hours) AS hourss,SUM(reward) AS rewards,ni8_waiter.username,ni8_waiter.moble,ni8_item.waiter_id', ' 1 ' . $where, 'ni8_item.id desc', 'left join ni8_waiter on ni8_waiter.id = ni8_item.waiter_id', 'ni8_item.waiter_id');
        $arry = $arr['list'];
        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

}

?>