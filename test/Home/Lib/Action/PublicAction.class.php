<?php

if (!defined("ni8"))
    exit("Access Denied");

class PublicAction extends Action {

    protected function msg($msg, $url = '') {
        cookie('err_mes', $msg);
        if (empty($url)) {
            $url = $_SERVER['HTTP_REFERER'];
        }
        header('Location: ' . $url);
        exit;
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
//初始化6-1
    public function _initialize() {
        bcscale(2);

        define('ROOT_PATH', dirname(str_replace('PublicAction.class.php', '', str_replace('\\', '/', __FILE__))));

        if (ACTION_NAME != 'uploadcan' && ACTION_NAME != 'uprz' && ACTION_NAME != 'upload' && ACTION_NAME != 'infor' && ACTION_NAME != 'ewm') {
            import('Common.Sqlin', APP_PATH, '.php');
            $dbsql = new sqlin();
        }
        import("ORG.Util.String");

        $webset = $this->finds('Web', 'id=1', 'id desc', true);
        $wxset = $this->finds('Weixin', 'id=1', 'id desc'); //微信配置
        $this->qq = explode("|", $webset['qq']); //在线QQ
        $this->commission = unserialize($webset['commission']); //分销方式拥金返利百分比%
        $this->ucz = unserialize($webset['ucz']); //代理商设置一次性充值直接升级条件
        $this->uz = unserialize($webset['uz']); //代理商设置商品折扣
        $this->umf = unserialize($webset['umf']); //代理商设置满包邮费
        $this->setorder = explode("$$", $webset['order']); //订单设置
        $this->wset = explode("$$", $webset['wset']); //其他设置
        if ($webset["closecon"] == 0)
            die("网站维护中...");
        if ($webset['pv'] == 1) {
            $this->pvok(); //站点统计开关
        }
        if ($wxset['iswx'] == 3) {
            die("网站维护中...");
        } elseif ($wxset['iswx'] == 2) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                die("网站维护中...");
            }
        } elseif ($wxset['iswx'] == 1) {
            $this->is_weixin($wxset['appid']); //只微信打开
        }

        $this->webset = $webset;
        $this->wxset = $wxset;
        //C('DEFAULT_THEME',$webset['temp']);//默认模版

        import('Common.send_mail', APP_PATH, '.php');
        $this->sm = new smail($webset['emailuser'], $webset['emailpsw'], $webset['stmpemail']);

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            $this->iswx = 1;
        } else {
            $this->iswx = 0;
        }

        $this->assign('webt', $this->webset['t']);
        $this->assign('webk', $this->webset['k']);
        $this->assign('webd', $this->webset['d']);

//        $city = cookie('city');
//        if (empty($city)) {
//            $ipInfos = $this->GetIpLookup();
//            if ($ipInfos) {
//                cookie('city', $ipInfos['city'], 3600);
//            } else {
//                cookie('city', '成都', 3600);
//            }
//        }

        $issdk = 0;
        if (MODULE_NAME != "Usersale" && (MODULE_NAME != "Member" || ACTION_NAME == "ewm")) {
            $issdk = 1;
        }
        if ($issdk == 1) {
            $this->wxsdk();
            $this->wsdk = 1;
        }
        $err = addslashes(strip_tags(cookie("err_mes")));
        if (!empty($err)) {
            cookie("err_mes", null);
            $this->assign('err', $err);
        }
    }

//SQL执行6-1
    public function dbquery($sql) {
        $news = M();
        return $news->query($sql);
    }

//检查没有登录6-1
    public function checkuser() {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('Auth/login', "", 0, '');
            exit;
        }
    }

//检查已经登录6-1
    public function yescheckuser() {
        if (!empty($_SESSION['user_id'])) {
            $this->redirect('foremen/index', "", 0, '');
            exit;
        }
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

    public function joinarr($date, $fy, $field, $where = '', $order = 'sort desc', $join, $ca = false) {
        $arr = array();
        $news = M($date);
        import('ORG.Util.Page'); // 导入分页类
        if ($ca) {
            $count = $news->cache(true)->where($where)->join($join)->count(); //获取数据的总数
        } else {
            $count = $news->where($where)->join($join)->count(); //获取数据的总数
        }
        $page = new Page($count, $fy);
        if ($ca) {
            $arrs = $news->cache(true)->field($field)->join($join)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
        } else {
            $arrs = $news->where($where)->field($field)->join($join)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
        }
        //echo $news->getLastSql();
        $arr['list'] = $arrs;
        import('Common.Pages', APP_PATH, '.php');
        $web_page = new Pager($count, $fy, (int) $_GET['page']);
        $arr['show'] = $web_page->pagenr;
        $arr['count'] = $count;
        $arr['cpage'] = $page->totalPages;
        return $arr;
    }

//获取验证码ni8	
    public function verify() {
        if (cookie('captcha') == 1 || $_GET['err'] == 1) {
            import('ORG.Util.Image');
            cookie('captcha', null);
            Image::buildImageVerify(4, 1, 'png', '60', '30', 'verify');
        }
    }

//分页列表6-1
    public function arr($date, $fy, $where = '', $order = 'sort desc', $ca = false) {
        $arr = array();
        $news = M($date);
        import('ORG.Util.Page');
        if ($ca) {
            $count = $news->cache(true)->where($where)->count();
        } else {
            $count = $news->where($where)->count();
        }
        $page = new Page($count, $fy);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
        } else {
            $arrs = $news->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
        }
        //echo $news->getLastSql();
        $arr['list'] = $arrs;
        import('Common.Pages', APP_PATH, '.php');
        $web_page = new Pager($count, $fy, (int) $_GET['page']);
        $arr['show'] = $web_page->pagenr;
        $arr['count'] = $count;
        $arr['cpage'] = $page->totalPages;
        return $arr;
    }

//分页列表6-1
    public function arrf($date, $fy, $where = '', $order = 'sort desc', $file = '*', $ca = false) {
        $arr = array();
        $news = M($date);
        import('ORG.Util.Page');
        if ($ca) {
            $count = $news->cache(true)->where($where)->count();
        } else {
            $count = $news->where($where)->count();
        }
        $page = new Page($count, $fy);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->field($file)->select();
        } else {
            $arrs = $news->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->field($file)->select();
        }
        //echo $news->getLastSql();
        $arr['list'] = $arrs;
        import('Common.Pages', APP_PATH, '.php');
        $web_page = new Pager($count, $fy, (int) $_GET['page']);
        $arr['show'] = $web_page->pagenr;
        $arr['count'] = $count;
        $arr['cpage'] = $page->totalPages;
        return $arr;
    }

//统计数量6-1
    public function tj($date, $where = '', $ca = false) {
        $news = M($date);
        if ($ca) {
            $count = $news->cache(true)->where($where)->count();
        } else {
            $count = $news->where($where)->count();
        }
        return $count;
    }

//统计和6-1
    public function sum($date, $where = '', $dx, $ca = false) {
        $news = M($date);
        if ($ca) {
            $count = $news->cache(true)->where($where)->sum($dx); //获取数据的总数	
        } else {
            $count = $news->where($where)->sum($dx); //获取数据的总数	 
        }
        return $count;
    }

//最大
    public function maxfid($date, $where = '', $ca = false) {
        $news = M($date);
        if ($ca) {
            $count = $news->cache(true)->where($where)->max('price'); //获取数据的总数	
        } else {
            $count = $news->where($where)->max('price'); //获取数据的总数	 
        }
        return $count;
    }

//最小
    public function minfid($date, $where = '', $ca = false) {
        $news = M($date);
        if ($ca) {
            $count = $news->cache(true)->where($where)->min('price'); //获取数据的总数	
        } else {
            $count = $news->where($where)->min('price'); //获取数据的总数	 
        }
        return $count;
    }

//不分页列6-1
    public function lb($date, $where = '', $sort = 'sort desc', $ca = false) {
        $arrs = array();
        $news = M($date);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($sort)->select();
        } else {
            $arrs = $news->where($where)->order($sort)->select();
        }
        //echo $news->getLastSql();
        return $arrs;
    }

//不分页列6-1
    public function lbf($date, $where = '', $sort = 'sort desc', $file = '*', $ca = false) {
        $arrs = array();
        $news = M($date);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($sort)->field($file)->select();
        } else {
            $arrs = $news->where($where)->order($sort)->field($file)->select();
        }
        return $arrs;
    }

//列表数量6-1
    public function lbmit($date, $where = '', $sort = 'sort desc', $limit, $ca = false) {
        $arrs = array();
        $news = M($date);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($sort)->limit($limit)->select();
        } else {
            $arrs = $news->where($where)->order($sort)->limit($limit)->select();
        }
        return $arrs;
    }

//列表数量6-1
    public function lbmitf($date, $where = '', $sort = 'sort desc', $limit, $file = '*', $ca = false) {
        $arrs = array();
        $news = M($date);
        if ($ca) {
            $arrs = $news->cache(true)->where($where)->order($sort)->limit($limit)->field($file)->select();
        } else {
            $arrs = $news->where($where)->order($sort)->limit($limit)->field($file)->select();
        }

        return $arrs;
    }

//查找一条数据6-1
    public function finds($date, $where = '', $sort = 'sort desc', $ca = false, $file = '*') {
        $news = M($date);
        if ($ca) {
            $arr = $news->cache(true)->where($where)->order($sort)->field($file)->find();
        } else {
            $arr = $news->where($where)->order($sort)->field($file)->find();
            //echo $news->getLastSql();
        }
        return $arr;
    }

//查找指定字段6-1
    public function getf($date, $where = '', $sort = 'sort desc', $setfi = 'id', $ca = false) {
        $news = M($date);
        if ($ca) {
            $arr = $news->cache(true)->where($where)->order($sort)->getField($setfi);
        } else {
            $arr = $news->where($where)->order($sort)->getField($setfi);
        }
        return $arr;
    }

//删除数据6-1
    public function del($date, $where = '') {
        $news = M($date);
        return $news->where($where)->delete();
    }

//添加数据6-1
    public function add($date, $arr) {
        $news = M($date);
        return $news->add($arr);
    }

//修改数据6-1
    public function save($date, $arr, $where = 'id=1') {
        $news = M($date);
        return $news->where($where)->save($arr);
    }

//添加6-1
    public function update($date, $where = 'id=1', $file, $sl) {
        $news = M($date);
        return $news->where($where)->setInc($file, $sl);
    }

//减去6-1
    public function update1($date, $where = 'id=1', $file, $sl) {
        $news = M($date);
        return $news->where($where)->setDec($file, $sl);
    }

//地区
    public function regions($id, $ca = false) {
        $arrs = array();
        $news = M('Region');
        if ($ca) {
            $arrs = $news->cache(true)->where('parent_id=' . $id)->order('region_name asc')->select();
        } else {
            $arrs = $news->where('parent_id=' . $id)->order('region_name asc')->select();
        }
        return $arrs;
    }

//删除文件6-1
    public function delFile($file) {

        if (!is_file($file))
            return false;

        @chmod($file, 0777);

        @unlink($file);

        return true;
    }

//判断空方法6-1
    public function _empty() {
        echo "<script language=javascript>history.go(-1);</script>";
        exit;
    }

//get传值6-1
    public function curlget($src) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $src);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $Infos = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $Infos;
    }

//post传值6-1
    public function curlpost($data, $src) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $src);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        $Infos = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $Infos;
    }

//随机数ni8	
    public function url_short($url) {
        //$url = crc32($url);
        //$result = sprintf("%u",$url);
        //echo base64_encode($result);
        return $this->randStr(6, $url);
    }

//随机数6-1
    public function randStr($len = 6, $chars) {
        $chars = 'ABDEFGHJKLMNPQRSTVWXYabdefghijkmnpqrstvwxy0123456789';
        mt_srand((double) microtime() * 1000000 * getmypid());
        $password = '';
        while (strlen($password) < $len)
            $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $password;
    }

//获取token6-1
    public function token() {
        $sq = $this->finds('Weixin', 'id=1', 'id desc');
        $this->appid = $sq['appid'];
        $this->appsecret = $sq['appsecret'];
        $this->gxtime = $sq['gxtime'];
        $this->times = time();
        $this->access_token = $sq['access_token'];
        if (empty($this->appid) || empty($this->appsecret)) {
            $gtoken = "";
        } else {
            $sjx = $this->gxtime + 7000;
            if (empty($this->access_token) || $sjx < ($this->times)) {

                $src = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appid . '&secret=' . $this->appsecret;
                $token = $this->curlget($src);
                $token = json_decode($token, true);
                $gtoken = $token['access_token'];
                $nr = array();
                $nr['access_token'] = $gtoken;
                $nr['gxtime'] = $this->times;
                $this->save('weixin', $nr, "id=1");
            } else {
                $gtoken = $this->access_token;
            }
        }
        return $gtoken;
    }

//写日记6-1
    public function log_resultall($word) {
        $logfile = 'log/pay_send_' . date('Y_m_d') . '.txt';
        $fp = fopen($logfile, "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期: " . strftime("%Y-%m-%d %H:%M:%S", time()) . " == \r\n" . $word . "\r\n\r\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

//写日记6-1
    public function log_resultalldx($word) {
        $logfile = 'log/dx/sms_send_' . date('Y_m_d') . '.txt';
        $fp = fopen($logfile, "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期: " . strftime("%Y-%m-%d %H:%M:%S", time()) . " == \r\n" . $word . "\r\n\r\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

//微信推送发送信息6-1
    public function fsxx($id, $mess, $tpid, $lx = 0) {
        $wxuser = $this->getf("User", " id=" . $id . " and passed=1 ", " id desc", 'wxopenid', false);
        if ($wxuser) {
            if ($lx == 1) {
                $url = C('web_url') . __APP__ . "/member_index";
            } else {
                $url = C('web_url') . __APP__ . "/member_order";
            }
            $this->wxts($wxuser['wxopenid'], $url, $tpid, $mess);
        }
    }

//微信推送6-1
    public function wxts($openid, $url, $id, $mess) {
        $dx = $this->finds('Mail_mod', "id=" . (int) $id, 'id desc');
        if (!$dx) {
            return false;
        }
        $data = sprintf($dx['wxmessage'], $mess[0], $mess[1], $mess[2], $mess[3], $mess[4], $mess[5], $mess[6], $mess[7], $mess[8], $mess[9], $mess[10]);
        $data = json_decode($data, true);
        $this->doSend($openid, $dx['template_id'], $url, $data);
    }

//6-1
    public function doSend($touser, $template_id, $url, $data, $topcolor = '#173177') {
        $template = array(
            'touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $json_template = json_encode($template);
        $this->log_resultall($json_template);
        $access_token = $this->token();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        $dataRes = $this->curlpost(urldecode($json_template), $url);
        $log = (is_array($dataRes) and ! empty($dataRes)) ? http_build_query($dataRes) : $dataRes;
        $this->log_resultall($log);
        if ($dataRes['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
    }

//广告6-1
    public function ggss($id) {
        $limit = $this->getf("Advs", "id=" . $id, " id desc", 'total', true);
        $arr = $this->lbmit("Advs_con", 'passed=1 and group_id=' . $id, 'sort desc,id desc', '0,' . $limit . '', true);
        return $arr;
    }

//关键子
    public function keys($date, $where = '', $ca = false, $sort = "") {
        $News = M($date);
        if ($ca) {
            $rows = $News->cache(true)->where($where)->order($sort)->field('t,k,d')->find();
        } else {
            $rows = $News->where($where)->field('t,k,d')->find();
        }
        if ($rows) {
            $this->webt = $rows['t'];
            $this->webk = $rows['k'];
            $this->webd = $rows['d'];
        } else {
            echo "<script language=javascript>history.go(-1);</script>";
            exit;
        }
    }

//站点统计6-1
    public function pvok() {
        $pvip = cookie('pvip');
        if (empty($pvip)) {
            $ip = get_client_ip(0);
            $url = $this->geturlip();
            $nr = array();
            $nr["ip"] = $ip;
            $nr["time"] = date("Y-m-d H:i:s");
            $nr["username"] = $this->user['username'];
            $nr["url"] = $url;
            $this->add("Page_view", $nr);
            cookie('pvip', md5($ip), 3600);
        }
    }

//详细地址6-1
    public function geturlip() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }

//IP地址ni8
    public function GetIP() {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        } else {
            $cip = "192.168.0.1";
        }
        return $cip;
    }

//发送邮件6-1
    public function sedmail($title, $content, $tomail) {
        $subject = "=?UTF-8?B?" . base64_encode($title) . "?=";
        $content = $content;
        if ($this->webset["mails"] == 1) {
            $end = $this->sm->send($tomail, "" . $this->webset['company'] . "<" . $this->webset['postemail'] . ">", "{$subject}", "{$content}");
        }
    }

//发送短信6-1
    public function sendmob($mobile, $content) {
        $content = $content;
        if ($this->webset["dx_passed"] == 1) {
            $uid = $this->webset["dx_user_name"]; //用户账户
            $pwd = $this->webset["dx_password"]; //用户密码
            $mobno = $mobile; //发送的手机号码,多个请以英文逗号隔开如"138000138000,138111139111"
            $content = $content . $this->webset["dxqm"]; //发送内容
            $otime = ''; //定时发送,暂不开通,为空
            $client = new SoapClient("http://service2.winic.org:8003/Service.asmx?WSDL");
            $param = array('uid' => $uid, 'pwd' => $pwd, 'tos' => $mobno, 'msg' => $content, 'otime' => $otime);
            $result = $client->__soapCall('SendMessages', array('parameters' => $param));
            $this->log_resultalldx("短信" . $result . "手机号" . $mobile . "内容" . $content); //获取信息
        }
    }

//公共发送信息6-1
    public function sendinfo($mobile, $mess, $id) {
        $dx = $this->finds('Mail_mod', "id=" . (int) $id, 'id desc');
        if ($dx) {
            if (is_numeric($mobile) && preg_match("/1[345678]{1}\d{9}$/", $mobile)) {
                $textTpl = $dx['message'];
                $textTpl = str_replace(array("{", "}"), array("", ""), $textTpl);
                $content = sprintf($textTpl, $mess[0], $mess[1], $mess[2], $mess[3], $mess[4], $mess[5], $mess[6], $mess[7], $mess[8], $mess[9], $mess[10]);

                $this->sendmob($mobile, $content);
            } elseif (filter_var($mobile, FILTER_VALIDATE_EMAIL)) {
                $textTpl = $dx['yjmessage'];
                $textTpl = str_replace(array("{", "}"), array("", ""), $textTpl);
                $content = sprintf($textTpl, $mess[0], $mess[1], $mess[2], $mess[3], $mess[4], $mess[5], $mess[6], $mess[7], $mess[8], $mess[9], $mess[10]);
                $content = $content . "<br><br>" . nl2br($this->webset['emailfoot']);
                $this->sedmail($dx['title'], $content, $mobile);
            } else {
                $this->fsxx($mobile, $mess, $id, 0);
            }
        }
    }

//关联会员ID
    public function userstr($userid) {
        $userstr = '';
        $user = $this->finds("User", 'id=' . $userid, 'id desc');
        $userstr = $user['id'];
        if (!empty($user['glid'])) {
            $userstr .= ',' . $user['glid'];
        }
        return $userstr;
    }

//获取关联PC帐户
    public function userstrpc($userid) {
        $userstr = '';
        $user = $this->finds("User", 'id=' . $userid, 'id desc');
        if (!empty($user['glid'])) {
            $gluser = $this->finds("User", 'id=' . $user['glid'] . ' and qy=0', 'id desc');
            if ($gluser) {
                $glid = $gluser['id'];
            } else {
                $glid = $user['id'];
            }
        } else {
            $glid = $user['id'];
        }
        return $glid;
    }

//判断微信打开6-1
    public function is_weixin($val) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        } else {
            $nowx = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $val . "&redirect_uri=" . urlencode(C("web_url")) . "&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect";
            Header("Location: $nowx");
            exit;
        }
    }

//计算返利6-1
    public function calaRebates($ddbh) {
        if ($this->webset['fs'] == 1) {
            $dd = $this->finds('Dd', "ishs=0 and ddbh='" . $ddbh . "' and user_id=" . $this->user['id'] . " and isf=0", 'classid desc');
            if ($dd) {
                $this->save("Dd", array("isf" => 1), "classid=" . $dd['classid']);
            } else {
                return false;
            }
            $ddp = $this->lb('Ddp', "ddbh='" . $ddbh . "' and user_id=" . $this->user['id'] . "", 'id desc');
            $zprice = 0;
            $dlzprice = 0;
            foreach ($ddp as $d) {
                $dlzprice += $d['price']; //代理
                if ($this->webset['flfs'] == 1) {
                    $zprice += $d['yjprice'] * $d['sl'];
                } else {
                    //$zprice += $d['price'];
                }
            }

            if ($this->webset['flfs'] == 2) {
                //$zprice=$zprice-$dd['yhq']-$dd['mj']-$dd['pointp']-$dd['zkprice'];
                $zprice = $dd['zhprice'];
            } else {
                
            }
            $zprice = ($zprice <= 0) ? 0 : $zprice;


            //
            //自己返利
            /* 		    $orderzj = array();
              $orderzj['order_time'] = $dd['addtime'];
              $orderzj['ddbh'] = $ddbh;
              $orderzj['prv_link'] =$this->user['prv_link'];
              $orderzj['type'] = $this->webset['flfs'];
              $orderzj['price'] = $zprice;
              $orderzj['dlzprice'] = $dlzprice;
              $this->_addRebateszj($this->user,$orderzj); */
            // 采用递归调用，逐级向上查询写入返利表
            if ($this->user['prv_id']) {
                $tjuser = M('User')->where('id=' . $this->user['prv_id'])->find(); // 查询上级是否存在
                $order = array();
                $order['order_time'] = $dd['addtime'];
                $order['ddbh'] = $ddbh;
                $order['prv_link'] = $this->user['prv_link'];
                $order['type'] = $this->webset['flfs'];
                $order['price'] = $zprice;
                $order['dlzprice'] = $dlzprice;
                if ($tjuser)
                    $this->_addRebates($tjuser, $this->user, $order, $dj = 1);
            }
        }
    }

//自己返利
    public function _addRebateszj($thisuser, $order) {
        exit;
        $fl = 0;
        $ratio = 0;
        $flme = $this->webset['flme'];
        $fl = $order['price'] * $flme / 100;
        $ratio = $flme / 100;

        if ($fl > 0) {
            $order['ratio'] = $ratio;
            $this->_putRebates($fl, $thisuser, $order);
        }
    }

// 写返利记录, 可递归调用6-1
    public function _addRebates($tjuser, $thisuser, $order, $dj) {
        $ufl = $this->commission;
        $uz = $this->uz;
        $kname = explode("_", C('vip'));
        $zk = array_combine($kname, array_slice($uz, 0));
        $fl = 0;
        $ratio = 0;

        $fl = $order['price'] * $ufl[$dj - 1] / 100;
        $ratio = $ufl[$dj - 1] / 100;

        if ($fl == 0 || $dj > $this->webset['dj']) {
            return false;
        }
        $order['ratio'] = $ratio;
        $this->_putRebates($fl, $tjuser, $order);
        if ($tjuser['prv_id'] > 0) {
            $ntjuser = M('User')->where('id=' . $tjuser['prv_id'])->find(); // 查询上级是否存在
            $dj = $dj + 1;
            if ($ntjuser)
                $this->_addRebates($ntjuser, $tjuser, $order, $dj);
        }
    }

    /*
     * 写返利表
     * $fl			返利值
     * $tjid	  获得返利的人
     * $order  订单信息6-1
     */

    public function _putRebates($fl, $tj, $order) {
        $data['user_id'] = $this->user['id'];
        $data['ddbh'] = $order['ddbh'];
        $data['money'] = (int) $fl;
        $data['prv_link'] = $order['prv_link'];
        $data['type'] = $order['type'];
        $data['is_pay'] = 0;
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['amount'] = $order['price'];
        $data['vip'] = $this->user['vip'];
        $data['tj_vip'] = $tj['vip'];
        $data['tj_id'] = $tj['id'];
        $data['ratio'] = $order['ratio'];
        $data['order_time'] = $order['order_time'];
        $this->add('Rebates', $data);
    }

    /**
     * desription获取新的宽高-ni8
     */
    public function show_pic_scal($width, $height, $picpath) {
        $imginfo = GetImageSize($picpath);
        $imgw = $imginfo [0];
        $imgh = $imginfo [1];

        $ra = number_format(($imgw / $imgh), 1); //宽高比     
        $ra2 = number_format(($imgh / $imgw), 1); //高宽比     


        if ($imgw > $width or $imgh > $height) {
            if ($imgw > $imgh) {
                $newWidth = $width;
                $newHeight = round($newWidth / $ra);
            } elseif ($imgw < $imgh) {
                $newHeight = $height;
                $newWidth = round($newHeight / $ra2);
            } else {
                $newWidth = $width;
                $newHeight = round($newWidth / $ra);
            }
        } else {
            $newHeight = $imgh;
            $newWidth = $imgw;
        }
        $newsize [0] = $newWidth;
        $newsize [1] = $newHeight;

        return $newsize;
    }

    /**
     * 缩略图主函数ni8   
     * @param string $src 图片路径   
     * @param int $w 缩略图宽度   
     * @param int $h 缩略图高度   
     * @return mixed 返回缩略图路径   
     * * */
    public function resize($src, $w, $h) {
        $temp = pathinfo($src);
        $name = $temp["basename"]; //文件名     
        $dir = $temp["dirname"]; //文件所在的文件夹     
        $extension = $temp["extension"]; //文件扩展名     
        $savepath = "{$dir}/{$name}"; //缩略图保存路径,新的文件名为*.thumb.jpg     
        //获取图片的基本信息     
        $info = getimagesize($src);
        $width = $info[0]; //获取图片宽度     
        $height = $info[1]; //获取图片高度     
        $per1 = round($width / $height, 2); //计算原图长宽比     
        $per2 = round($w / $h, 2); //计算缩略图长宽比     
        //计算缩放比例     
        if ($per1 > $per2 || $per1 == $per2) {
            //原图长宽比大于或者等于缩略图长宽比，则按照宽度优先     
            $per = $w / $width;
        }
        if ($per1 < $per2) {
            //原图长宽比小于缩略图长宽比，则按照高度优先     
            $per = $h / $height;
        }
        $temp_w = intval($width * $per); //计算原图缩放后的宽度     
        $temp_h = intval($height * $per); //计算原图缩放后的高度     
        $temp_img = imagecreatetruecolor($temp_w, $temp_h); //创建画布     
        $im = imagecreatefromjpeg($src);
        imagecopyresampled($temp_img, $im, 0, 0, 0, 0, $temp_w, $temp_h, $width, $height);
        if ($per1 > $per2) {
            imagejpeg($temp_img, $savepath, 100);
            imagedestroy($im);
            //return addBg($savepath,$w,$h,"w");     
            //宽度优先，在缩放之后高度不足的情况下补上背景     
        }
        if ($per1 == $per2) {
            imagejpeg($temp_img, $savepath, 100);
            imagedestroy($im);
        }
        if ($per1 < $per2) {
            imagejpeg($temp_img, $savepath, 100);
            imagedestroy($im);
        }
    }

//快递查询6-1
    public function kd100($code, $wldh) {
        $post_data = array();
        $post_data["user"] = $this->webset['KUAIDI_APP_CODE'];
        $post_data["psw"] = $this->webset['KUAIDI_APP_KEY'];
        $post_data["code"] = $code;
        $post_data["wldh"] = $wldh;
        $url = 'http://www.ni8.net.cn/kdapi.html';
        $o = "";
        foreach ($post_data as $k => $v) {
            $o .= "$k=" . urlencode($v) . "&";  //默认UTF-8编码格式
        }
        $post_data = substr($o, 0, -1);
        $wlxx = $this->curlpost($post_data, $url);
        $wlxx = json_decode($wlxx, true);

        return $wlxx;
    }

//分组-ni8shop
    public function fg($date, $group, $ca = false, $where = '') {
        $arrs = array();
        $news = M($date);

        if ($ca) {
            $arrs = $news->cache(true)->where($where)->field("count(*) as count," . $group . "")->group($group)->select();
        } else {
            $arrs = $news->where($where)->field("count(*) as count," . $group . "")->group($group)->select();
        }
        return $arrs;
    }

//推荐人-ni8shop
    public function usertj($user_id) {
        $arr = array();
        if ($this->webset['fs'] == 1 && !empty($user_id)) {
            $tj = $this->finds('User', "id=" . $user_id . " and passed=1", 'id desc');
            if ($tj) {
                $arr['prv_id'] = $tj['id'];
                if (empty($tj['prv_link'])) {
                    $arr['prv_link'] = $tj['id'];
                } else {
                    $arr['prv_link'] = $tj['id'] . "," . $tj['prv_link'];
                }
                $dj = $this->webset['dj'];
                $match = explode(",", $arr['prv_link']);
                foreach ($match as $key => $val) {//判断代理
                    $vip = $this->getf("User", "id=" . $val, "id desc", "vip");
                    if ($vip >= C("dqvip")) {
                        //$dj1=$key+1;
                        break;
                    }
                }
                if (!empty($dj1)) {
                    $dj = ($dj1 > $dj) ? $dj : $dj1;
                }
                array_splice($match, $dj);
                $arr['prv_link'] = implode(",", $match);
            }
        }
        return $arr;
    }

    private function GetIpp() {
        $realip = '';
        $unknown = 'unknown';
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($arr as $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } else if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
                $realip = $_SERVER['REMOTE_ADDR'];
            } else {
                $realip = $unknown;
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
                $realip = getenv("REMOTE_ADDR");
            } else {
                $realip = $unknown;
            }
        }
        $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;
        return $realip;
    }

    private function GetIpLookup($ip = '') {
        if (empty($ip)) {
            $ip = $this->GetIpp();
        }
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
        if (empty($res)) {
            return false;
        }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if (!isset($jsonMatches[0])) {
            return false;
        }
        $json = json_decode($jsonMatches[0], true);
        if (isset($json['ret']) && $json['ret'] == 1) {
            $json['ip'] = $ip;
            unset($json['ret']);
        } else {
            return false;
        }
        return $json;
    }

    /* 银行卡
      $card卡号
      $name姓名
      $tel电话
      $idcardno身份证号
     */

    public function checkcard($card, $name = '', $idcardno = '', $tel = '') {
        $appkey = 'be6b09922de2706ce3f3a8ada21c734e';
        $url = 'http://api.id98.cn/api/v2/bankcard?appkey=' . $appkey . '&bankcardno=' . $card;
        if ($name != '') {
            $url .= '&name=' . $name;
        }
        if ($idcardno != '') {
            $url .= '&idcardno=' . $idcardno;
        }
        if ($tel != '') {
            $url .= '&tel=' . $tel;
        }
        $data = json_decode($this->curlget($url), true);
        //dump($data);        var_dump($url);exit;
        if ($data['isok'] == 1 && $data['code'] == 1) {

            return true;
        } else {
            return false;
        }
    }

    /* 身份证
      $name姓名
      $sfz身份证
     */

    public function checksfz($name, $sfz) {
        $appkey = 'be6b09922de2706ce3f3a8ada21c734e';
        $url = 'http://api.id98.cn/api/idcard?appkey=' . $appkey . '&name=' . $name . '&cardno=' . $sfz;

        $data = json_decode($this->curlget($url), true);
        //var_dump($data,$url);exit;
        if ($data['isok'] == 1 && $data['code'] == 1) {
            return true;
        } else {
            return false;
        }
    }

//判断银行卡
    public function checkyhk($name) {
        vendor('Cheakbank.Getbank');
        $bank = new GetBank();
        $end = $bank->luhm($name);
        return $end;
    }

//调用SDK
    public function wxsdk() {
        $sq = $this->finds('Weixin', 'id=1', 'id desc');
        $wx_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $wx_url = explode('#', $wx_url);
        $end_url = $wx_url[0];
        $timestamp = time();
        $wxnonceStr = $this->sjssdk();
        $jsapi_ticket = $this->jsapi_ticketsdk();
        $wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s", $jsapi_ticket, $wxnonceStr, $timestamp, $wx_url[0]);
        $wxSha1 = sha1($wxOri);
        /* if(strstr($end_url,"&from")){
          $sj_url=explode("&from",$end_url);
          }else{
          $sj_url=explode("&tgc",$end_url);
          } */
        $sj_url = explode("&from", $end_url);
        //$sj_url=explode("&tgc",$sj_url[0]);
        $this->end_urla = $sj_url[0];
        $this->timestampa = $timestamp;
        $this->wxnonceStra = $wxnonceStr;
        $this->wxSha1a = $wxSha1;
        $this->appida = $sq['appid'];
    }

//随机数
    private function sjssdk($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

//jsapi_ticket
    public function jsapi_ticketsdk() {
        $time = time();
        $res = M('weixin')->where('id = 1')->find();
        $gxtime = (int) $res['jsapigxtime'] + 7000;
        if ($gxtime < $time) {
            $access_token = $this->token();
            $src = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
            $ticket = $this->curlget($src);
            $json = json_decode($ticket, true);
            $ticket = $json['ticket'];
            $data = array(
                'ticket' => $ticket,
                'jsapigxtime' => time(),
            );
            $this->save('weixin', $data, "id=1");
        } else {
            $ticket = $res['ticket'];
        }
        return $ticket;
    }

    public function zlxall($title, $mes, $user) {
        $textid = $this->add("webmessagetext", array("lx" => 2, "title" => $title, "content" => $mes, "addtime" => date("Y-m-d H:i:s")));
        $this->add("webmessage", array("textid" => $textid, "recid" => $user, "lx" => 2, "addtime" => time()));
    }

}

?>