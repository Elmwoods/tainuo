<?php
include_once 'phpqrcode.php';
if (!defined("ni8"))
    exit("Access Denied");

class IndexAction extends PublicAction //extends Action
{

   public function __construct() {
       parent::__construct();
       $this->checkwaiter();
   }

    public function checkwaiter() {
        //$_SESSION['wait_id'] = 2406;
//        if ($_SESSION['wait_id'] == 2406) {
//            $_SESSION = null;
//        }
        if (!$_SESSION['openid'] && !$_SESSION['wait_id']) {
            $this->redirect('wxapi/index');
        }
        if ($_SESSION['wait_id']) {
            $this->waiter = M('waiter')->where(array('id' => $_SESSION['wait_id']))->find();
        } else {
            $this->waiter = M('waiter')->where(array('openid' => $_SESSION['openid']))->find();
        }
        //dump($this->waiter = M('waiter')->where(array('openid' => $_SESSION['openid']))->find());exit;
    }

    public function index() {//主页
//        if ($this->waiter['id']) {
//            $this->redirect('index/record');
//        }
//        $team_id = isset($_REQUEST['teamid']) ? (int)$_REQUEST['teamid'] : '';
//
//        if (IS_POST) {
//            $username = $_POST['username'];
//            $moble = $_POST['moble'];
//            $yzm = $_POST['yzm'];
//            if (md5(C('PASS') . $yzm) . $moble != cookie('sendcode')) {
//                cookie("err_mes", '短信验证码错误！');
//                $this->redirect('index/index');
//                exit;
//            }
//            cookie('sendcode', null);
//            $find = M('waiter')->where("moble = '{$moble}'")->find();
//            if (!$find) {
//                $id = M('waiter')->add(array(
//                    'regtime' => date('Y-m-d H:i:s'),
//                    'username' => $username,
//                    'moble' => $moble,
//                    'passed' => 1,
//                    'openid' => $_SESSION['openid'],
//                    'headimgurl' => $_SESSION['wxuser']['headimgurl']
//                ));
//                cookie("err_mes", '注册成功！');
//                if (!$team_id){
//                    $this->redirect('index/index');
//                }else{
//                    $this->redirect('index/join', array('id' => $team_id));
//                }
//            } else {
//                M('waiter')->where("id = " . $find['id'])->save(array(
//                    'openid' => $_SESSION['openid'],
//                    'headimgurl' => $_SESSION['wxuser']['headimgurl']
//                ));
//                cookie("err_mes", '绑定成功！');
//                $this->redirect('index/index');
//            }
//        }
//        cookie('captcha', 1);
        $this->display();
    }

    public function record() {
        if (!$this->waiter['id']) {
            $this->redirect('index/index');
        }
        $date=date("Y-m-d",strtotime("- 3 days",time()));
        $where = " and worktime>'".$date."'";
        $where=" ";
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
        $subject = M('item')->where("waiter_id = {$this->waiter['id']}  and is_hs = 0 " . $where)->order('worktime desc,id desc')->select();
        foreach ($subject as &$vo) {
            $vo['subject'] = M('subject')->where("id = {$vo['subject_id']}")->find();
            $vo['hotel'] = M('hotel')->where("id = {$vo['hotel_id']}")->find();
            $vo['part'] = M('part')->where("id = {$vo['part_id']}")->find();
        }
        $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();

        $info = M('item')->where("waiter_id = {$this->waiter['id']}  and is_hs = 0 " . $where)
                        ->field("count(*) as times,sum(hours) as hourss,sum(reward) as rewards")->find();
        $this->assign(array(
            'hotel' => $hotel,
            'info' => $info,
        ));
        $this->assign(array(
            'subject' => $subject
        ));
        $this->display();
    }

    public function itemexit() {
        $id = (int) $_GET['id'];
        $item = M('item')->where("id = {$id} and waiter_id = {$this->waiter['id']} and hours = 0")->find();
//        dump(M()->_sql());exit;
        if ($item) {
            M('')->startTrans();
            $s = M('subject')->where("id = {$item['subject_id']}")->setDec('sl');
//            dump(M()->_sql());
            $d = M('item')->where("id = {$item['id']}")->delete();
//            dump(M()->_sql());
            if ($s && $d) {
                M()->commit();
//                exit;
            } else {
                M()->rollback(); 
            }
            $this->msg('退出成功', U('index/record'));
        } else {
            $this->msg('', "");
        }
    }

    public function join() {
        $team_id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : '';
        // dump($team_id);
        // die;
        if (!$this->waiter['id']) {
            $this->redirect('index/index', array('teamid' => $team_id));
        }
        if ($_GET['id']) {
            $id = (int) $_GET['id'];
            $subject = M('subject')->where("id = {$id}")->find();
            // 20191213 新增
            if (!$subject['status']) {
                $this->msg('当前项目禁止加入!', U('index/record'));
            }
            $date = date('Y-m-d');
            $online = M('item')->where("waiter_id = {$this->waiter['id']} and worktime = '{$date}' and is_hs = 0 and  receive_price = 0")->find();
//            dump($online);            dump(M()->_sql());exit;
            if ($online) {
                $this->msg('您今日已参与了其他项目！', U('index/record'));
            }
            if (!$subject) {
                $this->msg('项目不存在！', U('index/record'));
            }
            if ($subject['total'] == $subject['sl']) {
                $this->msg('项目人数已满！', U('index/record'));
            }

            // add begin
            //if (M('item')->where("is_hs = 0 and subject_id = {$subject['id']} and waiter_id = {$this->waiter['id']}")->find()) {
            //    $this->msg('您已加入了项目！', U('index/record'));
            //}
            $all_waiter = M('item')->where("is_hs = 0 and subject_id = {$subject['id']}")->getField('waiter_id', true);
            $map['id'] = array('in', $all_waiter);
            $waiter_names = M('waiter')->where($map)->getField('username', true);
            $waiter_name = M('waiter')->where(['id' => $this->waiter['id']])->getField('username');
            if (in_array($this->waiter['id'], $all_waiter) || in_array($waiter_name, $waiter_names)) {
                $this->msg('您已加入了项目！', U('index/record'));
            }
            // add end

            // 时薪 190223
            $level_id = $this->finds('waiter',  'id = '. $id, 'id desc', true)['level'];
            $hourly_wage = $this->finds('level', 'id = '. $level_id, 'id desc', true)['price'];

            $ontime = $subject['ontime'];
            $offtime = $subject['offtime'];
            $reward = 0;
            $sum = 0;
            $hour = round((strtotime($offtime) - strtotime($ontime) ) / (60 * 60) - $subject['break'] / 60, 2);
            $reward = bcadd($reward, bcmul($hour, $subject['wage']));
            $sub = bcsub($this->webset['wage'], $subject['wage']);
            $irebate = 0;
            if ($sub > 0) {
                $irebate = bcmul($hour, $sub);
            }
            $data = array(
                'hotel_id' => $subject['hotel_id'],
                'part_id' => $subject['part_id'],
                'user_id' => $subject['user_id'],
                'subject_id' => $subject['id'],
                'ontime' => $ontime,
                'offtime' => $offtime,
                'hours' => $hour,
                'rebate' => $irebate,
                'waiter_id' => $this->waiter['id'],
                'clothes' => 1,
                'break' => $subject['break'],
                'worktime' => $subject['worktime'],
                // 'reward' => bcmul($hour, $subject['wage']),
                // 'wage' => $subject['wage'],
                'reward' => bcmul($hour, $subject['wage']),
                'wage' => $hourly_wage
            );

            M()->startTrans();
            $add = M('item')->add($data);
            $save = M('subject')->where("id = {$subject['id']} and total > sl")->setInc('sl');
            if ($add && $save) {
                M()->commit();
                $this->reset($subject['id']);
                $this->msg('加入项目成功！', U('index/record'));
            } else {
                M()->rollback();
                $this->msg('加入项目失败，请重试！');
            }
        }
        $date=date("Y-m-d",strtotime("- 3 days",time()));
        $where = "total > sl and is_hs= 0 and passed = 1 and worktime>'".$date."'";
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
        $subject = M('subject')->where($where)->order('worktime desc,id desc')->select();
        //dump(M()->_sql());exit;
        foreach ($subject as $k => &$vo) {
            $vo['hotel'] = M('hotel')->where("id = {$vo['hotel_id']}")->find();
            if (M('item')->where("is_hs = 0 and waiter_id = {$this->waiter['id']} and subject_id ={$vo['id']}")->find()) {
                unset($subject[$k]);
            }
            $vo['part'] = M('part')->where("id = {$vo['part_id']}")->find();
        }

        $hotel = M('hotel')->where('passed = 1')->order('sort desc,id desc')->select();
        $this->assign(array(
            'hotel' => $hotel
        ));
        $this->assign(array(
            'subject' => $subject
        ));
        $this->display();
    }

    public function test() {

        $this->display();
    }

//    public function qrcode(){
//        $uname = 'test';
//        $userid = 1;
//        $drpath = './Uploads/daili';
//        $imgma = 'ma' . $userid . '.png';
//        $urel = '/Uploads/daili/' . $imgma;
//        if (!file_exists($drpath . '/' . $imgma)) {
//            $this->sp_dir_create($drpath);
//            $a = vendor("phpqrcode.phpqrcode");
//            dump($a);
//            die;
//            $phpqrcode = new QRcode();
//            $hurl = "http://baidu.com/";
//            $size = "7";
//            //$size = "10.10";
//            $errorLevel = "L";
//            $phpqrcode->png($hurl, $drpath . '/' . $imgma, $errorLevel, $size);
////			$picpath = './Public/weixins/images/bj.jpg';
////			$image = new \Think\Image();
////			$image->open($picpath)->water($drpath . '/' . $imgma, array(247, 715), 100)->save($drpath . '/t' . $imgma);
//        }
//        $this->urel = $urel;
//        $this->display();
//    }
//
//    //二维码生成
//    function sp_dir_create($path,$mode = 0777) {
//        if (is_dir($path))return true;
//        $ftp_enable = 0;
//        $path = $this->sp_dir_path($path);
//        $temp = explode('/',$path);
//        $cur_dir = '';
//        $max = count($temp) -1;
//        for ($i = 0;$i <$max;$i++) {
//            $cur_dir .= $temp[$i] .'/';
//            if (@is_dir($cur_dir))
//                continue;
//            @mkdir($cur_dir,0777,true);
//            @chmod($cur_dir,0777);
//        }
//        return is_dir($path);
//    }
//
//    function sp_dir_path($path) {
//        $path = str_replace('\\','/',$path);
//        if (substr($path,-1) != '/')
//            $path = $path .'/';
//        return $path;
//    }
}

?>