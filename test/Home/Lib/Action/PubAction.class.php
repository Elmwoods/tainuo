<?php

if (!defined("ni8"))
    exit("Access Denied");

class PubAction extends PublicAction {

    public function __construct() {
        parent::__construct();
    }

    // 未使用 20190116
    public function part() {
        $hotel_id = (int)$_GET['hotel_id'];
        $where ="hotel_id = $hotel_id and passed = 1 and hotel_id != 0";
        $waiter = M('part')->where($where)->order('sort desc,id desc')->select();
        ob_end_clean();
        $this->ajaxReturn($waiter);
    }

    // 20190116
    public function waiter() {
        $keyword = $_GET['keyword'];
        $where = addslashes(cookie("fwait"));
        if(!empty($keyword)){
            $where .= " and (username like '%{$keyword}%' or moble like '%{$keyword}%')";
        }
        $waiter = M('waiter')->where($where)->order('id desc')->select();
        ob_end_clean();
        $this->ajaxReturn($waiter);
    }
    public function iwaiter() {
        $keyword = $_GET['keyword'];
        $id = $_GET['id'];
        $where = " subject_id = {$id} and status != 1";
        if(!empty($keyword)){
            $where .= " and (username like '%{$keyword}%' or moble like '%{$keyword}%')";
        }
        $waiter = M('item')->where($where)->join("left join ni88_waiter on ni88_waiter.id = ni88_item.waiter_id")->field("ni88_item.*,ni88_waiter.username,ni88_waiter.moble")->order('id desc')->select();
        
        $this->ajaxReturn($waiter);
    }
//会员签到
    public function hyqd() {
        if (empty($this->user['id']) || $this->webset['point'] <= 0) {
            echo "no";
            exit;
        }
        $nowtime = date("Y-m-d");
        if ($this->user['qdtime'] == $nowtime) {
            echo "old";
            exit;
        }
        $ordernum = date("Ymdhis") . rand(100000, 999999) . $this->user['id'];
        $this->add("Jl", array("addtime" => date("Y-m-d H:i:s"), "user_id" => $this->user['id'], "price" => $this->webset['point'], "qy" => 1, "sz" => "会员签到得积分", "ordern" => $ordernum));
        $this->update("User", "id=" . $this->user['glid'], "point", $this->webset['point']);
        $this->update("User", "id=" . $this->user['glid'], "pointend", $this->webset['point']);
        $this->save("User", array("qdtime" => $nowtime), "id=" . $this->user['id']);
        echo "yes";
    }

//领取优惠券
    public function yhq() {
        if (empty($this->user['id'])) {
            echo "no";
            exit;
        }
        $id = $_GET['id'];
        $xx = $this->finds("Yhq", 'passed=1 and id=' . $id . ' and sysl>0 and etimes>' . time() . '', 'id desc');
        if ($xx) {
            //$islq=$this->finds('Yhqlq',"hbid=".$xx['id']." and user_id=".$this->user['id']."",'id desc');
            $lqcount = $this->tj('Yhqlq', "hbid=" . $xx['id'] . " and user_id=" . $this->user['id'] . "", false);
            if ($lqcount >= $xx['isone']) {
                echo "old";
            } else {
                $nr = array();
                $nr["title"] = $xx['title'];
                $nr["stimes"] = $xx['stimes'];
                $nr["etimes"] = $xx['etimes'];
                $nr["jg"] = $xx['jg'];
                $nr["yqjg"] = $xx['yqjg'];
                $nr["addtime"] = date("Y-m-d H:i:s");
                $nr["user_id"] = (int) $this->user['id'];
                $nr["hbid"] = $xx['id'];
                $this->add("Yhqlq", $nr);
                $po = array();
                $po['sysl'] = $xx['sysl'] - 1;
                $this->save("Yhq", $po, "id=" . $id . "");
                echo "yes";
            }
        } else {
            echo "no";
        }
    }

//城市变化
    public function city() {
        $id = (int) $_GET['id'];
        $msg1 .= "<option value=''>请选择区县</option>";
        if ($id == 0) {
            $msg .= "<option value=''>请选择城市</option>";
        } else {
            $cs = $this->lb('Region', ' parent_id=' . $id, ' id asc', true);
            $msg .= "<option value=''>请选择城市</option>";
            foreach ($cs as $key => $c) {
                $msg .= "<option value=" . $c['id'] . ">" . $c['region_name'] . "</option>";
            }
        }
        echo $msg . "%" . $msg1;
    }

//城市变化
    public function xian() {
        $id = (int) $_GET['id'];
        if ($id == 0) {
            $msg .= "<option value=''>请选择区县</option>";
        } else {
            $xc = $this->lb('Region', ' parent_id=' . $id . '', ' id asc', true);
            $msg .= "<option value=''>请选择区县</option>";
            foreach ($xc as $key => $c) {
                $msg .= "<option value=" . $c['id'] . ">" . $c['region_name'] . "</option>";
            }
        }
        echo $msg;
    }

//设置地址默认
    public function address() {
        if (empty($this->user['id'])) {
            exit;
        }
        $id = $_POST['id'];
        $po1 = array();
        $po1['defaultt'] = 0;
        $this->save('Address', $po1, "user_id = {$this->user['id']} ");
        if (!empty($id)) {
            $res = $this->save('Address', array("defaultt" => 1), "user_id = {$this->user['id']}  and id=" . $id);
        }
    }

//判断会员重复
    public function user() {
        $user = $_POST['user'];
        $captcha = $_POST['captcha'];
        $fs = (int) $_POST['fs'];
        //$cx = $this->finds('waiter', "username='" . $user . "' or moble='" . $user . "'", 'id desc');
        if (md5($captcha) != $_COOKIE['verify']) {
            echo '{"captcha":false}';
            exit;
        }
        if ($_POST['bd'] == 1) {
            echo '{"is_regist":true,"captcha":true}';
            exit;
        }
        if ($cx) {
            if ($fs == 1) {
                echo '{"is_regist":false,"captcha":true}';
            } elseif ($fs == 2) {
                echo '{"is_regist":true,"captcha":true}';
            }
        } else {
            if ($fs == 1) {
                echo '{"is_regist":true,"captcha":true}';
            } elseif ($fs == 2) {
                echo '{"is_regist":false,"captcha":true}';
            }
        }
    }

//发送验证码
    public function sendcode() {
        ob_end_clean();
        $fs = (int) $_POST['fs'];
        $user = $_POST['user'];
        $value = rand(100000, 999999);
        //echo $value;
        $code = md5(C('PASS') . $value);
        cookie('sendcode', $code.$user, 900);
        if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
            if ($fs == 1) {
                $this->sendinfo($user, array($value), '1');
            } else {
                $this->sendinfo($user, array($value), '2');
            }
        } else {
            if ($fs == 1) {
                $this->sendinfo($user, array($value), '4');
            } else {
                $this->sendinfo($user, array($value), '1');
            }
        }
        echo '{"success":true}';
    }

//参数改变价格
    public function gbjg() {
        $id = (int) $_POST["id"];
        $cs = $_POST["cs"];
        $where = "";
        if (!empty($cs)) {
            $where .= " and cs='" . $cs . "'";
        }
        $cx = $this->finds('Sku', "pro_id=" . $id . " " . $where, 'pro_id desc');
        if ($cx) {
            echo $cx['price'] . ":" . $cx['count'];
        } else {
            echo "0.00:0";
        }
    }

//团购购买
    public function caraddg() {
        if (empty($this->user['id'])) {
            echo 'nouser';
            exit;
        }
        $action = $_POST['action'];
        $id = (int) $_POST['id'];
        $sl = (int) $_POST['sl'];
        $xx = $this->finds('Pro', 'passed=1 and id=' . $id, 'id desc');
        if ($xx) {
            if ($action == "nowaddt") {
                $kc = $xx['tgkc'];
            } else {
                $kc = $xx['jfkc'];
                $ky = $this->user['pointend'];
                $sy = $xx['point'];
                if ($sy > $ky) {
                    echo 'point|0';
                    exit;
                }
            }
            if ($kc < $sl) {
                echo 'kc|0';
                exit;
            }
            if ($sl < 1) {
                echo 'sl|0';
                exit;
            }
            if ($action == "nowaddt") {
                cookie('nowbuyt', $xx['id'] . "$$" . $sl);
            } else {
                cookie('nowbuyp', $xx['id'] . "$$" . $sl);
            }

            echo 'yes|0';
            //
        } else {
            echo 'no|0';
        }
    }

//加入购物车
    public function caradd() {
        if (empty($this->user['id'])) {
            echo 'nouser';
            exit;
        }
        $action = $_POST['action'];
        $id = (int) $_POST['id'];
        $sl = (int) $_POST['sl'];
        $cs = $_POST['cs'];
        $xx = $this->finds('Pro', 'passed=1 and id=' . $id, 'id desc');
        if ($xx) {
            if ($xx['isprice'] == 1) {
                $cslm = (json_decode($xx['priceprv'], true));
                $cslmlist = (json_decode($xx['pricecs'], true));
                $count = count($cslm);
                if ($cs <> '') {
                    $csarr = explode("_", $cs);
                    $csarrc = count($csarr);
                } else {
                    $csarrc = 0;
                }
                if ($count != $csarrc) {
                    echo 'cs|0';
                    exit;
                }
                $where = "";
                if (!empty($cs)) {
                    $where .= " and cs='" . $cs . "'";
                }
                $cx = $this->finds('Sku', "pro_id=" . $id . " " . $where, 'pro_id desc');
                if ($cx) {
                    if ($cx['count'] < $sl) {
                        echo 'kc|0';
                        exit;
                    }
                }
            } else {
                if ($xx['kc'] < $sl) {
                    echo 'kc|0';
                    exit;
                }
            }

            if ($sl < 1) {
                echo 'sl|0';
                exit;
            }

            $gwc = $this->finds('Gwc', "user_id = {$this->user['id']} and pro_id=" . $id . " and cs='" . $cs . "'", 'id desc');
            if ($gwc) {
                $this->save('Gwc', array("sl" => $sl, "addtime" => time()), "id=" . $gwc['id']);
                if ($action == "nowadds") {
                    cookie('nowbuy', $gwc['id']);
                } else {
                    cookie('nowbuy', null);
                }
            } else {
                $id = $this->add('Gwc', array("sl" => $sl, "addtime" => time(), "user_id" => ($this->user['id']), "pro_id" => $id, "cs" => $cs));
                if ($action == "nowadds") {
                    cookie('nowbuy', $id);
                } else {
                    cookie('nowbuy', null);
                }
            }
            $countgwc = $this->tj('Gwc', "user_id = {$this->user['id']}", false);
            echo 'yes|' . $countgwc . '';
            //
        } else {
            echo 'no|0';
        }
    }

//收藏夹
    public function scj() {
        if (empty($this->user['id'])) {
            echo 'nouser';
            exit;
        }
        $action = $_POST['action'];
        $id = $_POST['id'];
        $qy = (int) $_POST['qy'];
        $cx = $this->finds('Scj', "qy=" . $qy . " and (user_id = {$this->user['id']} or user_id=" . (int) $this->user['glid'] . ") and id=" . $id, 'classid desc');
        if ($cx) {
            echo 'yes';
            exit;
        }
        $xx = $this->finds('Pro', 'passed=1 and id=' . $id, 'id desc', true);
        if ($xx) {
            $nr = array();
            $nr["title"] = $xx['title'];
            $nr["spic"] = $xx['spic'];
            $nr["price"] = $xx['price'];
            $nr["time"] = date("Y-m-d");
            $nr["id"] = $id;
            $nr["user_id"] = (int) $this->user['id'];
            $nr["qy"] = $qy;
            $nr["ip"] = $this->GetIP();
            $nr["user_name"] = $this->user['nickname'];
            $this->add("Scj", $nr);
            echo 'yes';
        } else {
            echo 'no';
        }
    }

//查询订单状态
    public function gx() {
        if (empty($this->user['id'])) {
            exit;
        }
        $ddid = $_POST['ddid'];
        $orsj = $_POST['orsj'];
        if ($orsj == "jl") {
            $show = $this->finds($orsj, "ordern='" . $ddid . "' and passed=1 and user_id=" . (int) $this->user['glid'] . ") ", "id desc");
        } else {
            $show = $this->finds($orsj, "ddbh='" . $ddid . "' and passed=1 and user_id=" . (int) $this->user['glid'] . ")", "classid desc");
        }
        if ($show) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

}

?>