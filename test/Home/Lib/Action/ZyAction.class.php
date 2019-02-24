<?php

if (!defined("ni8"))
    exit("Access Denied");

class ZyAction extends PublicAction {

    public function _initialize() {
        $webset = $this->finds('Web', 'id=1', 'id desc', true); //站点配置
        $this->webset = $webset;
        $this->setorder = explode("$$", $webset['order']); //订单设置 
    }

    //购买获取积分
    public function buypoint() {
        set_time_limit(0);
        $sendlist = M('sendhb')->where("(passed = 1 or passed = 3)")->select();
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
                            'user_id' => $v['user_id'],
                            'price' => $v['amount'],
                            'qy' => 3,
                            'addtime' => time(),
                        ));
                    }
                }
            }
        }
    }

    public function test() {
        set_time_limit(0);
        $sendlist = M('sendhb')->where("(passed !=0 and passed != 4)")->select();
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
                    if ($receive == 4) {
                        M('item')->where("id = {$v['item_id']}")->setDec('send_price', $v['amount']);
                        M('item')->where("id = {$v['item_id']}")->save(array('status' => 2));
                        M('user')->where("id = {$v['user_id']}")->setInc('discount', $v['amount']);
                        M('jl')->add(array(
                            'user_id' => $v['user_id'],
                            'price' => $v['amount'],
                            'qy' => 3,
                            'addtime' => $time,
                        ));
                    }
                }
            }
        }
        $item = M('item')->where("status != 0")->select();
        foreach ($item as $v) {
            $r_price = M('sendhb')->where("passed = 2 and item_id ={$v['id']}")->sum('amount');
            $r_price = $r_price ? $r_price : 0;
            M('item')->where("id={$v['id']}")->save(array(
                'receive_price' => $r_price
            ));
        }
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

    //自动确认完成
    public function order() {
        return false;

        $ts = $this->setorder[4];
        $time = strtotime("-" . $ts . " day", time());
        $qrsh = $this->lb('Dd', "passed=2 and ishs=0 and fhtime<" . $ks . "", 'classid desc');

        foreach ($qrsh as $key => $value) {
            $zjf = 0;
            $show = $this->lb('Ddp', " ddbh='" . $value['ddbh'] . "' and ishs=0 and isth=0 and passed=2", 'id desc');
            foreach ($show as $key1 => $val1) {
                $zjf = $zjf + $val1['price'];
            }
            $nr = array();
            $nr['passed'] = 3;
            $nr['qrtime'] = time();
            $this->save('Dd', $nr, "passed=2 and ishs=0 and classid=" . $value['classid'] . "");
            $this->save('Ddp', $nr, "passed=2 and ishs=0 and ddbh='" . $value['ddbh'] . "'");
            // $zjf=$zjf+$value['kdfsprice']-$value['yhq']-$value['mj']-$value['pointp']-$value['zkprice'];
//		   if($zjf<0)$zjf=0;
//		   $zjf=$zjf*$value['point'];
//		   if(!empty($zjf)){
//			   $arrjf=array();
//			   $arrjf['addtime']=date("Y-m-d H:i:s");
//			   $arrjf['user_id']=$value['user_id'];
//			   $arrjf['price']=(int)$zjf;
//			   $arrjf['sz']="消费获取积分:".$zjf."分";
//			   $arrjf['qy']="1";
//			   $arrjf['passed']="0";
//			   $arrjf['ordern']=$value['ddbh'];
//			   $this->add('Jl',$arrjf);				   		
//			   $this->update("User","id=".$this->userstrpc($value['user_id']),"pointend",$zjf);	
//			   $this->update("User","id=".$this->userstrpc($value['user_id']),"point",$zjf);	   
//		   }
        }
    }

    //购物车清理
    public function gwc() {
        return false;
        $ts = $this->setorder[0];
        $time = strtotime("-" . $ts . " day", time());
        $this->del("Gwc", "addtime<" . $time . "", "id asc");
    }

    //积分三个月清理
    public function point() {
        return false;
        $ts = $this->webset['pointgq'];
        if ($ts > 0) {
            $time = date("Y-m-d H:i:s", strtotime("-" . $ts . " day", time()));
            $jflist = $this->lb("jl", "qy=1 and price>0 and (passed=0 or pricend>0) and addtime<'" . $time . "'", "id asc");
            foreach ($jflist as $key => $val) {
                $pointz = 0;
                if ($val['pricend'] > 0) {
                    $pointz = $val['pricend'];
                } else {
                    $pointz = $val['price'];
                }
                if ($pointz) {
                    $this->update1("User", "id=" . $this->userstrpc($val['user_id']), "pointend", $pointz);
                    $this->update1("User", "id=" . $this->userstrpc($val['user_id']), "point", $pointz);
                    $this->save("jl", array("passed" => 1, "pricend" => 0), "id=" . $val['id']);
                }
            }
        }
    }

    //订单佣金结算
    public function orderjs() {
        return false;
        $time = date("Y-m-d H:i:s", strtotime("-" . $this->setorder[6] . " day", time()));
        $arr = $this->lb("Rebates", "is_pay=1 and isjs=0 and add_time<'" . $time . "'", " id desc");
        foreach ($arr as $key => $val) {
            if (empty($val['money']))
                continue;
            $this->save("Rebates", array("isjs" => 1, "jstime" => time()), "isjs=0 and id=" . $val['id'] . "");
            $this->update("User", "id=" . $this->userstrpc($val['tj_id']), "balances", $val['money']);
            $this->update("User", "id=" . $this->userstrpc($val['tj_id']), "balancesend", $val['money']);
        }
    }

    //订单未付款当天取消
    public function orderqx() {
        return false;
        //@set_time_limit(0);
        //ignore_user_abort(TRUE);		
        $ts = $this->setorder[7];
        $time = strtotime("-" . $ts . " day", time());
        $arr = $this->lb("Dd", "passed=0", " classid desc");
        $setorder = explode("$$", $this->webset['order']);
        foreach ($arr as $key => $val) {
            if ($bctiome < $time) {
                $ddlist = $this->lb('Ddp', " ddbh='" . $val['ddbh'] . "' and passed=0", 'id desc');
                foreach ($ddlist as $key1 => $value) {
                    if (($setorder[1] == 0 && $value['passed'] == 0)) {
                        $this->update("Pro", "id=" . $value['pr_id'], "kc", $value['sl']);
                        $this->update1("Sku", "pro_id=" . $value['pr_id'] . " and cs='" . (int) $value['cs'] . "' ", "count", $value['sl']);
                    }
                    $this->update1("Pro", "id=" . $value['id'], "sale", $value['sl']);
                }

                $this->save("Dd", array("passed" => 4), "passed=0 and classid=" . $val['classid'] . "");
                $this->save("Ddp", array("passed" => 4), "passed=0 and ddbh='" . $val['ddbh'] . "'");
            }
        }
    }

    //统计  
    public function tjsj() {
        //@set_time_limit(0);
        //ignore_user_abort(TRUE);
        $time = gmdate('Y-m-d', strtotime("-1 day") + 8 * 3600);
        $time1 = strtotime($time);
        $time2 = strtotime(date("Y-m-d"));
        //===================================pv总数
        $pvs = $this->tj("Page_view", "date_format(time,'%Y-%m-%d')='$time'", false);
        //====================================独立ip总数
        $ips = count($this->fg("Page_view", "ip", false, "date_format(time,'%Y-%m-%d')='$time'"));
        //====================================url总数
        $urls = count($this->fg("Page_view", "url", false, "date_format(time,'%Y-%m-%d')='$time'"));
        //====================================上线会员数
        $onusers = $this->tj("User", "date_format(LastLoginTime,'%Y-%m-%d')='$time'", false);
        //=====================================前一天所有注册的新的会员
        $nregusers = $this->tj("User", "date_format(regtime,'%Y-%m-%d')='$time'", false);
        //======================================前一天产品数据
        $pronum = $this->tj("Pro", "date_format(addtime,'%Y-%m-%d')='$time'", false);
        //======================================订单数量
        $newss = $this->tj("Dd", "addtime>" . $time1 . " and addtime<" . $time2 . "", false);
        //=======================================佣金结算
        $zp = $this->tj("Rebates", "jstime>" . $time1 . " and jstime<" . $time2 . "", false);


        $ntime = date("Y-m-d H:i:s");
        $nr = array();
        $nr['time'] = $ntime;
        $nr['totalurl'] = $urls;
        $nr['pageviews'] = $pvs;
        $nr['totalip'] = $ips;
        $nr['visitusernum'] = $onusers;
        $nr['reguser'] = $nregusers;
        $nr['pronum'] = $pronum;
        $nr['newsnum'] = $newss;
        $nr['offernum'] = $zp;
        $this->add("page_rec", $nr);
        //==========================================以下是清空详细记录表的记录
        $time = gmdate('Y-m-d', strtotime("-3 day") + 8 * 3600);
        $this->del('Page_view', "date_format(addtime,'%Y-%m-%d')<'$time'", ' id desc');
    }

}

?>