<?php

if (!defined("ni8shop"))
    exit("Access Denied");

class HomeAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        $this->checkuserb();
        $this->adminlog();
        $this->ly = $_SERVER['HTTP_REFERER'];
        $this->webroots = substr(dirname(__FILE__), 0, -19);
    }

    //6-1
    public function left1() {
        $bk = (int) $_GET['bk'];
        $this->assign("bk", $bk);
        $this->display();
    }

    //6-1
    public function welcome() {
        $st1 = date("Y-m-d 0:0:0");
        $et1 = date("Y-m-d H:i:s");

        $st = strtotime(date("Y-m-d 0:0:0"));
        $et = time();

        $zst1 = date("Y-m-d H:i:s", strtotime("-1 day", $st));
        $zet1 = date("Y-m-d H:i:s", strtotime("-1 day", $et));

        $yytime = date("Ymd");
        $zyytime = date("Ymd", strtotime($zst1));
        $zst = strtotime("-1 day", $st);
        $zet = strtotime("-1 day", $et);

        $salep = $this->finds33("Dd", "ishs=0 and zhprice>0 and passed>0 and passed<4", "classid desc", "zhprice");
        $order1 = $this->finds33("Dd", "addtime>" . $st . " and addtime<" . $et . " and passed>0 and passed<4 and ishs=0", "classid desc", "zhprice");
        $jb = $this->finds33("rebates", "jstime >" . $st . " and jstime <" . $et . " and isjs=1", "id desc", "money");
        $zjb = $this->finds33("jl", "qy=3", "id desc", "price");
        $zjb1 = $this->finds33("jl", "qy=1", "id desc", "price");
        $zjb2 = $this->finds33("jl", "qy=2", "id desc", "price");
        $web = array(
            'bbh' => php_uname(),
            'yx' => php_sapi_name(),
            'bb' => Zend_Version(),
            'file' => __FILE__,
            'host' => $_SERVER["HTTP_HOST"],
            'yq' => $_SERVER['SERVER_SOFTWARE'],
            'mu' => $_SERVER['SystemRoot'],
            'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'port' => $_SERVER['SERVER_PORT'],
            'order' => $this->tj("Dd", "addtime>" . $st . " and addtime<" . $et . " and passed>0 and passed<4 and ishs=0"),
            'order1' => $order1['count'],
            'hycount' => $this->tj("User", "regtime>'" . $st1 . "' and regtime<'" . $et1 . "'"),
            'jb' => $jb['count'],
            'order2' => $this->tj("Dd", "1 and ishs=0"),
            'norder' => $this->tj("Dd", "passed=0 and ishs=0"),
            'yorder' => $this->tj("Dd", "passed=1 and ishs=0"),
            'zorder' => $this->tj("Dd", "passed=2 and ishs=0"),
            'pro' => $this->tj("pro", "1"),
            'pro1' => $this->tj("pro", "passed=1"),
            'pro2' => $this->tj("pro", "passed=0"),
            'salep' => ($salep['count']) ? $salep['count'] : 0,
            'zjb' => $zjb['count'],
            'zjb1' => $zjb1['count'],
            'zjb2' => $zjb2['count'],
            'ntx' => $this->tj("yhtx", "passed<3"),
        );
        $this->assign('web', $web);
        $this->display();
    }

    //6-1
    public function mpsw() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mypwd = $_POST['mypwd'];
            $newpwd = $_POST['newpwd'];
            $renewpwd = $_POST['renewpwd'];
            $mobile = $_POST['mobile'];
            $qq = $_POST['qq'];
            $email = $_POST['email'];
            $realname = $_POST['realname'];
            if (empty($mobile)) {
                echo "<script>alert('手机号不能为空!');history.go(-1);</script>";
                exit;
            }
            if (empty($mypwd) and ( $newpwd <> $renewpwd)) {
                echo "<script>alert('确认密码错误!');history.go(-1);</script>";
                exit;
            }
            $da = array();
            if (!empty($mypwd)) {
                $da['Password'] = md5($newpwd);
            }
            $da['mobile'] = $mobile;
            $da['qq'] = $qq;
            $da['email'] = $email;
            $da['realname'] = $realname;
            if (!empty($mypwd)) {
                $row = $this->save("Admin", $da, "id=" . $this->user['id'] . " and Password='" . md5($mypwd) . "'");
            } else {
                $row = $this->save("Admin", $da, "id=" . $this->user['id'] . " ");
            }
            $this->redirect('home/mpsw', array('err' => 1), 0, '');
            exit;
        }
        $this->display();
    }

    //6-1
    public function web() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $_POST["addtime"] = date("Y-m-d H:i:s");
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }


        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $_POST["addtime"] = date("Y-m-d H:i:s");
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //PC系统设置-ni8shop
    public function webpc() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $_POST["addtime"] = date("Y-m-d H:i:s");
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=2");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }


        $show = $this->finds("Web", "id=2", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //6-1
    public function email() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $email = $this->_get('email');
            if (!empty($email)) {
                $this->sedmail("test", "test", $email);
                $this->redirect('home/email', "", 0, '');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }

        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //6-1
    public function dx() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }

        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //6-1
    public function point() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //支付配置设置6-1
    public function pay() {
        $idd = $_GET['id'];
        if ($idd) {
            //$this->del("Pay","id=".$idd);
            echo "<script>location.href='" . $this->ly . "';</script>";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $allid = $_POST['articleid'];
            foreach ($allid as $key => $id) {
                //$this->del('Pay','id='.$id);
            }
            echo "<script language='javascript'>location='" . $ly . "';</script>";
            exit;
        }

        $where = "";
        $arr = $this->arr('Pay', 15, 'id>0 ' . $where, 'id desc');
        $this->assign('arr', $arr['list']);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);
        $this->display();
    }

    //编辑支付配置设置6-1
    public function payadd() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['addtime'] = date("Y-m-d H:i:s");
            $id = $_POST['id_not'];
            $nr = array();
            $_POST['pz'] = implode("||", $_POST['pz']);
            $nr = $this->build_sql($_POST);
            if ($id) {
                $this->save("Pay", $nr, "id=" . $id);
            } else {
                $this->add("Pay", $nr);
            }
            $this->assign('sx', 1);
            $this->display("Pub:load");
            exit;
        }
        $id = $_GET['id'];
        $show = $this->finds("Pay", "id=" . (int) $id, 'id desc');
        $this->assign('show', $show);
        $this->assign('pz', explode("||", $show['pz']));
        $this->display();
    }

    //6-1
    public function xpress() {
        $id = $_GET['id'];
        $act = $_GET['act'];
        if ($id && $act == "del") {
            $this->del("Xpress", "id=" . $id);
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sort = $_POST['sort'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $name_en = $_POST['name_en'];
            $web = $_POST['web'];
            $id = $_POST['id'];
            foreach ($name as $key => $val) {
                if ($val) {
                    $da = array();
                    $da["sort"] = $sort[$key];
                    $da["code"] = $code[$key];
                    $da["name"] = $name[$key];
                    $da["web"] = $web[$key];
                    if ($id[$key]) {
                        $this->save("Xpress", $da, "id=" . $id[$key]);
                    } else {
                        $this->add("Xpress", $da);
                    }
                }
            }
            echo "<script language='javascript'>location='" . $this->ly . "';</script>";
            exit;
        }

        $where = ' ';
        if (!empty($_GET['title'])) {
            $where .= " and (name  like '%" . $_GET['title'] . "%' or code like '%" . $_GET['title'] . "%')";
            $this->assign('title', $_GET['title']);
        }


        $arr = $this->arr('Xpress', 15, 'id>0 ' . $where, 'sort desc');
        $this->assign('arr', $arr['list']);
        $this->assign('fpage', $arr['show']);
        $this->assign('count', $arr['count']);

        $this->display();
    }

    //6-1
    public function fx() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $_POST['commission'] = serialize($_POST['commission']);
            $_POST['ucz'] = serialize($_POST['ucz']);
            $_POST['uz'] = serialize($_POST['uz']);
            $_POST['umf'] = serialize($_POST['umf']);
            if (empty($_POST['ucz_enabled']))
                $_POST['ucz_enabled'] = 0;
            if (empty($_POST['uz_enabled']))
                $_POST['uz_enabled'] = 0;
            if (empty($_POST['umf_enabled']))
                $_POST['umf_enabled'] = 0;
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->commission = unserialize($show['commission']);
        $this->ucz = unserialize($show['ucz']);
        $this->uz = unserialize($show['uz']);
        $this->umf = unserialize($show['umf']);
        $this->display();
    }

    //6-1
    public function yhhd() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mprice = $_POST['mprice'];
            $mjprice = $_POST['mjprice'];
            $mjtext = "";
            foreach ($mprice as $key => $val) {
                if (!empty($mjtext)) {
                    $mjtext .= "$$" . abs((float) $val) . "|" . abs((float) $mjprice[$key]);
                } else {
                    $mjtext .= abs((float) $val) . "|" . abs((float) $mjprice[$key]);
                }
            }
            $arr = array();
            $arr['mj'] = (int) $_POST['mj'];
            $arr['mjtext'] = $mjtext;
            $arr['mb'] = (int) $_POST['mb'];
            $arr['mbprice'] = abs((int) $_POST['mbprice']);
            $res = $this->save('Web', $arr, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $xx = $this->finds('Web', "id=1", 'id desc');
        $this->assign('shop', $xx);
        $mmj = array();
        $arr = explode("$$", $xx['mjtext']);
        foreach ($arr as $key => $val) {
            $arr1 = explode("|", $val);
            if ($arr1[0] != "")
                $mmj[] = array("mprice" => $arr1[0], "mjprice" => $arr1[1]);
        }
        $this->assign('mmj', $mmj);
        $this->display();
    }

    //6-1
    public function order() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $nr = '';
            foreach ($_POST['order'] as $aa) {
                if ($nr == '') {
                    $nr .= abs((int) $aa);
                } else {
                    $nr .= "$$" . abs((int) $aa);
                }
            }
            $nr1 = '';
            foreach ($_POST['wset'] as $aa1) {
                if ($nr1 == '') {
                    $nr1 .= abs((int) $aa1);
                } else {
                    $nr1 .= "$$" . abs((int) $aa1);
                }
            }
            //$_POST['order']=implode("$$",$_POST['order']);
            $_POST['order'] = $nr;
            $_POST['order'] = str_replace("-", "", $_POST['order']);
            $_POST['wset'] = $nr1;
            $_POST['wset'] = str_replace("-", "", $_POST['wset']);
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->order = explode("$$", $show['order']);
        $this->wset = explode("$$", $show['wset']);
        $this->display();
    }

    //登录设置6-1
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $da = $this->build_sql($_POST);
            $row = $this->save("Web", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }

        $show = $this->finds("Web", "id=1", 'id desc');
        $this->assign('show', $show);
        $this->display();
    }

    //6-1
    public function dev() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $da = array();
            $da = $this->build_sql($_POST);
            $row = $this->save("Weixin", $da, "id=1");
            echo "<script>location.href='?err=1';</script>";
            exit;
        }
        $wxshow = $this->finds('Weixin', "id=1", 'id desc');
        $this->assign('wxshow', $wxshow);

        $this->display();
    }

    //6-1
    public function delf() {
        $id = (int) $_GET['id'];
        $kk = $_GET['kk'];
        $filed = $_GET['filed'];
        $arr = $this->finds($kk, "id=" . $id . "", 'id desc');
        if ($arr) {
            $arrPic = $arr[$filed];
            $this->delFile(str_replace("../", "", $arrPic));
            $nr = array();
            $nr[$filed] = "";
            $this->save($kk, $nr, 'id=' . $id . '');
        }
        echo "<script language='javascript'>location='" . $this->ly . "';</script>";
        exit;
    }

    //清除缓存6-1
    public function delhc() {
        @set_time_limit(0);
        ignore_user_abort(TRUE);
        $cache = Cache::getInstance();
        $cache->clear();
        $caches = array(
            "HomeCache" => array("name" => "网站前台缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Cache/"),
            "WHomeCache" => array("name" => "移动前台缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/Cache/"),
            "AdminCache" => array("name" => "网站后台缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/Cache/"),
            "HomeData" => array("name" => "网站前台数据库字段缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Data/"),
            "WHomeData" => array("name" => "移动前台数据库字段缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/Data/"),
            "AdminData" => array("name" => "网站后台数据库字段缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/Data/"),
            "HomeLog" => array("name" => "网站前台日志缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Logs/"),
            "WHomeLog" => array("name" => "移动前台日志缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/Logs/"),
            "AdminLog" => array("name" => "网站后台日志缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/Logs/"),
            "HomeTemp" => array("name" => "网站前台临时缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Temp/"),
            "WHomeTemp" => array("name" => "移动前台临时缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/Temp/"),
            "AdminTemp" => array("name" => "网站后台临时缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/Temp/"),
            "HomeHtml" => array("name" => "网站前台静态缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Html/"),
            "WHomeHtml" => array("name" => "移动前台静态缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/Html/"),
            "AdminHtml" => array("name" => "网站后台静态缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/Html/"),
            "Homeruntime" => array("name" => "网站前台runtime.php缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/~runtime.php"),
            "WHomeruntime" => array("name" => "移动前台runtime.php缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Wap/~runtime.php"),
            "Adminruntime" => array("name" => "网站后台runtime.php缓存文件", "path" => WEB_CACHE_PATH . "Runtime/" . APP_NAME . "/~runtime.php"),
        );
        if (IS_POST) {
            foreach ($_POST['cache'] as $path) {
                if (isset($caches[$path]))
                    delDirAndFile($caches[$path]['path']);
            }
            echo json_encode(array("status" => 1, "info" => "缓存文件已清除"));
        } else {
            foreach ($caches as $path) {
                delDirAndFile($path['path'], true);
            }
            $this->assign("caches", $caches);
            $this->display();
        }
    }

    //6-1
    public function delfm() {
        $id = (int) $_GET['id'];
        $kk = $_GET['kk'];
        $filed = $_GET['filed'];
        $px = $_GET['px'];
        $arr = $this->finds($kk, "id=" . $id . "", 'id desc');
        if ($arr) {
            $arrPic = $arr[$filed];
            $arrPic = explode("|", $arrPic);
            $pic = $arrPic[$px - 1];
            array_remove($arrPic, $px - 1);
            $arrPic = implode("|", $arrPic);
            $this->delFile(str_replace("../", "", $pic));
            $nr = array();
            $nr[$filed] = $arrPic;
            $this->save($kk, $nr, 'id=' . $id . '');
        }
        echo "<script language='javascript'>location='" . $this->ly . "';</script>";
        exit;
    }

    //6-1
    public function delfc() {
        $classid = (int) $_GET['classid'];
        $kk = $_GET['kk'];
        $filed = $_GET['filed'];
        $arr = $this->finds($kk, "classid=" . $classid . "", 'classid desc');
        if ($arr) {
            $arrPic = $arr[$filed];
            $this->delFile(str_replace("../", "", $arrPic));
            $nr = array();
            $nr[$filed] = "";
            $this->save($kk, $nr, 'classid=' . $classid . '');
        }
        echo "<script language='javascript'>location='" . $this->ly . "';</script>";
        exit;
    }

    //删除编辑器图片空间里面的图片-ni8shop
    public function filedel() {
        if ($_POST["action"] == "delss") {//如果action=delete
            $url = $_POST["url"];
            if (empty($url)) {//如果url为空
                die(0);
            }
            $url = str_replace("../", "", $url); //替换路径
            if (file_exists($url)) {//检查文件是否存在	
                if (!is_file($url))
                    return false;
                @chmod($url, 0777);
                $result = unlink($url); //删除文件
                if ($result) {//如果成功删除
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
            exit();
        }
    }

    //新消息弹出6-1
    /*public function remind() {

        $time = gmdate('Y-m-d', strtotime("+1 day") + 8 * 3600);
        $time2 = strtotime($time);
        $time1 = strtotime(date("Y-m-d"));

        $xx1 = $this->tj('dd', 'passed=0 and ishs=0 and qy<2'); //未付款
        $xx2 = $this->tj('dd', 'passed=1 and ishs=0 and qy<2'); //已付款
        $xx3 = $this->tj('dd', 'passed=2 and ishs=0 and qy<2'); //已发货
        $xx4 = $this->tj('rebates', 'isjs=0'); //未结算订单数
        $xx5 = $this->tj('rebates', 'isjs=1'); //已结算订单数
        $xx6 = "";
        $xx7 = $this->tj('yhtx', 'passed=0'); //申请提现
        $xx8 = "";
        $xx9 = "";
        echo '{"span_Message":' . (int) $xx1 . ',"span_BackOrder":' . (int) $xx2 . ',"point":' . (int) $xx3 . ',"zxsj1":' . (int) $xx4 . ',"zxsj2":' . (int) $xx5 . ',"zxsj3":' . (int) $xx6 . ',"span_AdvisoryReply":' . (int) $xx7 . ',"zxsj4":' . $xx8 . ',"nr":"' . $xx9 . '"}';
    }*/

}

?>