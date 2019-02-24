<?php

if (!defined("ni8shop"))
    exit("Access Denied");

class UserAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        $this->checkuserb();
        $this->adminlog();
        $this->ly = $_SERVER['HTTP_REFERER'];
    }

//区域6-1
    public function qy() {
        if (isset($_GET['qy'])) {
            if ($_GET['qy'] <> "") {
                cookie('qy', (int) $_GET['qy']);
            } else {
                //cookie('qy',0);
            }
        }
    }

    public function jl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $this->del('Jl', 'id=' . $id . " ");
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $this->del('Jl', 'id=' . $id . " ");
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }


        $where = " ";
        if ($_GET['qy'] !== null) {
            $where .= " and qy = {$_GET['qy']}";
            $this->assign('qy', $_GET['qy']);
        }
        if (!empty($_GET['user_id'])) {
            $where .= " and user_id IN (" . $this->userstr($_GET['user_id']) . ")";
            $this->assign('user_id', $_GET['user_id']);
        }
        if (!empty($_GET['title'])) {
            $userid = $this->getf("User", "username ='" . $_GET['title'] . "'", 'id desc', 'id');
            $where .= " and (user_id =" . (int) $userid . " )";
            $this->assign('title', $_GET['title']);
        }
        $arr = $this->arr('Jl', 20, ' 1 ' . $where, 'id desc');
        $this->assign('arr', $arr['list']);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function recharge() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userid = $_POST['userid'];
            $price = $_POST['price'];
            $text = $_POST['text'];
            if (empty($userid) || empty($price)) {
                $this->assign('sx', 1);
                $this->display("pub:load");
                exit;
            }
            $isone = $this->finds("User", "id=" . $userid . "", 'id desc');
            if ($isone) {

                $this->update("User", "id=" . $userid, "discount", $price);

                $addtime = time();
                $ordernum = date("Ymdhis") . rand(100000, 999999) . $userid;
                $id = $this->add("Jl", array("addtime" => $addtime, "user_id" => $userid, "price" => $price, "qy" => 0, "text" => $text));
            }

            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }

        $userid = $_GET['userid'];
        $show = $this->finds("User", 'id=' . $userid . ' ', 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

//会员信息6-1
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("User", 'id=' . $id . '', 'id desc');
                if ($show) {
                    delDirAndFile(WEB_ROOT . "upfile/user/" . $show['id'] . "/", true);
                    $this->del('User', 'id=' . $show['id']);
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }

        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("User", 'id=' . $id . '', 'id desc');
            if ($show) {
                delDirAndFile(WEB_ROOT . "upfile/user/" . $show['id'] . "/", true);
                $this->del('User', 'id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }


        $where = " ";
        if (!empty($_GET['title'])) {
            $where .= " and (username like '%" . $_GET['title'] . "%' or nickname like '%" . $_GET['title'] . "%')";
            $this->assign('title', $_GET['title']);
        }
        if ($_GET['passed'] <> "") {
            $where .= " and passed=" . (int) $_GET['passed'] . "";
            $this->assign('passed', (int) $_GET['passed']);
        }


        $arr = $this->arr('User', 20, ' 1 ' . $where, 'id desc');
        $arry = $arr['list'];

        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

//会员导出
    public function userexport() {
        $where = cookie('usereport');
        $arr = $this->lb('User', ' 1 ' . $where, 'id desc');
        $this->dchead("userlist");
        $filename = '<tr>
	              <td >序号</td>
				  <td >用户ID</td>
				  <td >会员账户</td>
				  <td >电话号码</td>
				  <td >邮箱地址</td>
				  <td >真实姓名</td>
				  <td >昵称</td>
				  <td >会员级别</td>
				  <td >推广码</td>
				  <td >账户余额</td>
				  <td >返利酒币</td>				 
				  <td >酒币余额</td>
				  <td >总销售额</td>
				  <td >审核状态</td>
				  <td >注册时间</td>
				  </tr>';
        foreach ($arr as $key => $val) {

            $passed = ($val['passed'] == 1) ? '已审核' : '未审核';

            $filename .= '<tr>
		               <td>' . ($key + 1) . '</td>
		               <td >' . $val['id'] . '</td>
					   <td >' . $val['username'] . '</td>
					   <td >' . $val['moble'] . '</td>
					   <td >' . $val['email'] . '</td>
					   <td >' . $val['contact'] . '</td>
					   <td >' . $val['nickname'] . '</td>
					   <td >' . vip($val['vip']) . '</td>
					   <td >' . $val['codee'] . '</td>
					   <td >' . $val['discount'] . '</td>
					   <td >' . $val['balances'] . '</td>					  
					   <td >' . $val['pointend'] . '</td>
					   <td >' . $val['orderprice'] . '</td>
					   <td >' . $passed . '</td>					  
					   <td >' . $val['regtime'] . '</td>					  
					   </tr>';
        }
        //$filename=iconv("utf-8", "gb2312", $filename); 
        echo '<table width="1000" border="1">' . $filename . '</table>';
    }

//PC会员修改6-1
    public function uadd() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
//            if (!is_numeric($username) || !preg_match("/1[34578]{1}\d{9}$/", $username)) {
//                $this->assign('sx', 1);
//                $this->display("pub:load");
//                exit;
//            }
            if (empty($username)) {
                $this->assign('sx', 1);
                $this->display("pub:load");
                exit;
            }


            $id = (int) $_POST['id_not'];
            $password = str_replace('"', '', $_POST['password']);

            $nr = array();
            if (!empty($password)) {
                $_POST['password'] = md5($_POST['password']);
                if ($id > 0) {
                    M('user_sessions')->where("userid = {$id}")->delete();
                }
            } else {
                unset($_POST['password']);
            }
            unset($_POST['password1']);
            $nr = $this->build_sql($_POST);
            if ($id > 0) {
                $isone = $this->finds("User", "username='" . $_POST['username'] . "' and id<>" . $id . "", 'id desc');
                if ($isone) {
                    $this->assign('sx', 1);
                    $this->display("pub:load");
                    exit;
                }
                $this->save("User", $nr, 'id=' . $id);
            } else {
                $isone = $this->finds("User", "username='" . $_POST['username'] . "'", 'id desc');
                if ($isone) {
                    $this->assign('sx', 1);
                    $this->display("pub:load");
                    exit;
                }
                $nr['regtime'] = date('Y-m-d H:i:s');
                $this->add("User", $nr);
            }
            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }

        $act = $_GET['act'];
        $id = (int) $_GET['id'];
        if (!empty($id)) {
            $show = $this->finds("User", 'id=' . $id . '', 'id desc');

            $this->assign('show', $show);
        }

        $this->display();
    }

    public function waiter() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                $show = $this->finds("waiter", 'id=' . $id . '', 'id desc');
                $this->del('waiter', 'id=' . $show['id']);
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }

        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $show = $this->finds("waiter", 'id=' . $id . '', 'id desc');
            $this->del('waiter', 'id=' . $show['id']);

            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }


        $where = " ";
        if (!empty($_GET['title'])) {
            $where .= " and (username like '%" . $_GET['title'] . "%' or moble like '%" . $_GET['title'] . "%')";
            $this->assign('title', $_GET['title']);
        }
        if ($_GET['passed'] <> "") {
            $where .= " and passed=" . (int) $_GET['passed'] . "";
            $this->assign('passed', (int) $_GET['passed']);
        }


        $arr = $this->arr('waiter', 20, ' 1 ' . $where, 'id desc');
        $arry = $arr['list'];

        $this->assign('arr', $arry);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    public function wsave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
//            if (!is_numeric($username) || !preg_match("/1[34578]{1}\d{9}$/", $username)) {
//                $this->assign('sx', 1);
//                $this->display("pub:load");
//                exit;
//            }
            if (empty($username)) {
                $this->assign('sx', 1);
                $this->display("pub:load");
                exit;
            }

            $id = (int) $_POST['id_not'];
            $password = str_replace('"', '', $_POST['password']);

            $nr = array();
            if (!empty($password)) {
                $_POST['password'] = md5($_POST['password']);
            } else {
                unset($_POST['password']);
            }
            unset($_POST['password1']);
            $nr = $this->build_sql($_POST);
            if ($id > 0) {
                $isone = $this->finds("waiter", "moble='" . $_POST['moble'] . "' and id<>" . $id . "", 'id desc');
                if ($isone) {
                    $this->assign('sx', 1);
                    $this->display("pub:load");
                    exit;
                }
                $this->save("waiter", $nr, 'id=' . $id);
            } else {
                $isone = $this->finds("waiter", "moble='" . $_POST['moble'] . "'", 'id desc');
                if ($isone) {
                    $this->assign('sx', 1);
                    $this->display("pub:load");
                    exit;
                }
                $nr['regtime'] = date('Y-m-d H:i:s');
                $this->add("waiter", $nr);
            }
            $this->assign('sx', 1);
            $this->display("pub:load");
            exit;
        }

        $act = $_GET['act'];
        $id = (int) $_GET['id'];
        if (!empty($id)) {
            $show = $this->finds("waiter", 'id=' . $id . '', 'id desc');

            $this->assign('show', $show);
        }

        $this->display();
    }

}

?>