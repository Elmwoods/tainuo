<?php

if (!defined("ni8shop"))
    exit("Access Denied");

class PubAction extends PublicAction {

    public function __construct() {
        //parent::__construct(); 	   
    }

    //6-1
    public function verify() {
        import('ORG.Util.Image');
        Image::buildImageVerify(4, 1, 'png', '60', '30', 'verify');
    }

    public function part() {
        $hotel_id = (int) $_GET['hotel_id'];
        $where = "hotel_id = $hotel_id and passed = 1 and hotel_id != 0";
        $waiter = M('part')->where($where)->order('sort desc,id desc')->select();
        ob_end_clean();
        $this->ajaxReturn($waiter);
    }

    //6-1
    public function passed() {
        $sjk = $_POST['sjk'];
        $id = (int) $_POST['id'];
        $passed = (int) $_POST['passed'];
        $nr = array();
        $nr["passed"] = (int) $passed;
        $this->save($sjk, $nr, "classid=" . $id);
    }

    //6-1
    public function tj() {
        $id = (int) $_POST['aid'];
        $data = $_POST['data'];
        $nr = array();
        $nr["tj"] = (int) $_POST['ishot'];
        $this->save($data, $nr, 'classid=' . $id);
    }

    //6-1
    public function dell() {
        $sjk = $_GET['sjk'];
        $sjk1 = $_GET['sjk1'];
        $fild = $_GET['fild'];
        $id = (int) $_GET['id'];
        $this->del($sjk, $fild . '=' . $id);
        $this->del($sjk, "link_id like '%|" . $id . "|%'");
        if ($sjk1) {
            $this->del($sjk1, "link_id like '%|" . $id . "|%'");
        }
        echo 'ok';
    }

    //6-1
    public function sku() {
        $action = $_POST['action'];
        $pid = (int) $_POST['pid'];
        $rss = $this->finds('sku', "pro_id=" . $pid . " and cs='" . $action . "'", 'pro_id desc');
        if ($rss) {
            echo $rss['price'] . ":" . $rss['count'];
        } else {
            echo "";
        }
    }

    public function pro() {
        exit;
        $bid = (int) $_GET['bid'];
        $cs = $this->lb('Typepro', ' prv_id=' . $bid . '', ' sort desc,classid desc');
        $msg = "";
        $msg = '<option value="">选择下级分类</option>';
        foreach ($cs as $key => $c) {
            $msg .= "<option value=" . $c['classid'] . ">" . $c['class_name_cn'] . "</option>";
        }

        $msg1 = "";
        $pplink = $this->getf('Typepro', 'classid=' . $bid . '', 'classid desc', "pplink");
        if (!empty($pplink)) {
            $pplink = "0" . str_replace("|", ",", $pplink) . "0";
        } else {
            $pplink = 0;
        }
        $pplist = $this->lb('Typebrand', 'qy=1 and classid in(' . $pplink . ')', ' sort desc,classid desc');
        foreach ($pplist as $key => $c) {
            $msg1 .= "<input type='radio' name='ppclassid' value=" . $c['classid'] . " />" . $c['class_name_cn'] . "&nbsp;&nbsp;";
        }

        $msg2 = "";
        $kzlink = $this->getf('Typepro', 'classid=' . $bid . '', 'classid desc', "bkzlink");
        $kzlink1 = $this->getf('Typepro', 'classid=' . $bid . '', 'classid desc', "kzlink");
        if (!empty($kzlink)) {
            $kzlink = "0" . str_replace("|", ",", $kzlink) . "0";
        } else {
            $kzlink = 0;
        }
        $kzlist = $this->lb('Typeprokz', 'qy=1 and prv_id=0 and classid in(' . $kzlink . ')', ' sort desc,classid desc');
        foreach ($kzlist as $key => $c) {
            $kzlist1 = $this->lb('Typeprokz', 'qy=1 and prv_id=' . $c['classid'] . '', ' sort desc,classid desc');
            $msg22 = "";
            foreach ($kzlist1 as $key1 => $c1) {
                if (strpos($kzlink1, "|" . $c1['classid'] . "|") > -1)
                    $msg22 .= '&nbsp;<input type="checkbox" id="kzlink[]" value="' . $c1['classid'] . '" name="kzlink[]">' . $c1['class_name_cn'] . '&nbsp;';
            }
            $msg2 .= '<tr><td width="10%" height="30" bgcolor="#ffffff" align="left">&nbsp;' . $c['class_name_cn'] . '</td><td width="90%" bgcolor="#ffffff">' . $msg22 . '</td></tr>';
        }

        $msg3 = "";
        $cslink = $this->getf('Typepro', 'classid=' . $bid . '', 'classid desc', "pricecs");
        if (!empty($cslink)) {
            $cslink = "0" . str_replace("|", ",", $cslink) . "0";
        } else {
            $cslink = 0;
        }
        $cslist = $this->lb('Typeprokz', 'qy=2 and prv_id=0 and classid in(' . $cslink . ')', ' sort desc,classid desc', true);
        $i = 0;
        foreach ($cslist as $key => $c) {
            $cslist1 = $this->lb('Typeprokz', 'qy=2 and prv_id=' . $c['classid'] . '', 'classid desc', true);
            $msg33 = "";
            foreach ($cslist1 as $key1 => $c1) {
                $msg33 .= '<li class="li_width"><label><input type="checkbox" class="chcBox_Width" value="' . $c1['classid'] . '"  alt="' . $c1['class_name_cn'] . '"/></label><span class="li_empty"  contentEditable="true" rel="' . $c1['class_name_cn'] . '">' . $c1['class_name_cn'] . '</span></li>';
            }
            $msg3 .= '<ul style="padding:0px;" class="Father_Title"><li contentEditable="true" rel="' . $c['class_name_cn'] . '" name="' . $c['classid'] . '">' . $c['class_name_cn'] . '</li></ul><ul class="Father_Item' . $i . '">' . $msg33 . '</ul><div style="clear:both; height:1px;"></div>';
            $i++;
        }

        echo $msg . "%%" . $msg1 . "%%" . $msg2 . "%%" . $msg3; //下级分类%%品牌%%扩展分类%%参数价格
    }

    //无图显示设置-ni8shop
    public function nopic() {
        $leng = ($this->_get('l')) ? $this->_get('l') : 300;
        $width = ($this->_get('w')) ? $this->_get('w') : 300;
        $text = ($this->_get('t')) ? $this->_get('t') : 'No Pic';
        import('ORG.Util.Image');
        Image::nopp($text, 'png', $leng, $width);
    }

    //信息表审核-ni8shop
    public function passed1() {
        $sjk = $_POST['sjk'];
        $id = (int) $_POST['id'];
        $passed = (int) $_POST['passed'];
        $nr = array();
        $nr["passed"] = (int) $passed;
        $this->save($sjk, $nr, "id=" . $id);
    }

    //计划任务执行-ni8shop
    public function execute_transact($transact_id = 0) {
        $systime = time();
        $webroot = substr(dirname(__FILE__), 0, -19);

        $show = $this->finds("cron", ($transact_id > 0 ? "id='$transact_id'" : " active=1 and nexttransact<='$systime'"), 'nexttransact asc');
        if ($show['script']) {
            $locked = $webroot . "/Cache/execute/cron_sign_" . $transact_id . ".lock";
            if (is_writable($locked) && filemtime($locked) > $systime - 600) {//10分钟执行一次
                return false;
            } else {
                touch($locked);
            }
            @set_time_limit(0);
            ignore_user_abort(TRUE);
            $url = C('pic_url') . "/wz.php/" . $show['script'];
            echo "<iframe src=\"" . $url . "\" width='100%' height='100%' frameborder='0' scrolling='yes'></iframe>";
            $this->update_transact($show);
            //unlink($locked);		
        }
        $re = $this->getf("cron", "active=1 ", 'nexttransact asc', "nexttransact");
        if ($re) {
            $cron['nexttransact'] = $re;
            $write_config_con_str = serialize($cron);
            $write_config_con_str = '<?php global $cron_config; $cron_config = unserialize(\'' . $write_config_con_str . '\');?>';
            $fp = fopen($webroot . '/Cache/execute/cron_config.php', 'w');
            fwrite($fp, $write_config_con_str, strlen($write_config_con_str));
            fclose($fp);
        }
    }

    //更新计划任务时间-ni8shop
    public function update_transact($cron_transact) {
        $systime = time();
        $cron_transact["id"] = ($cron_transact["id"]) ? $cron_transact["id"] : $cron_transact["id_not"];
        $week = $cron_transact['week'];
        $day = $cron_transact['day'];
        $hours = $cron_transact['hours'];
        $minutes = $cron_transact['minutes'];
        $nexttransact = 0;
        if ($week != '-1') {
            $nexttransact = strtotime("next " . $week);
            $nexttransact += (intval($hours) * 60 * 60);
            $nexttransact += (intval($minutes) * 60);
        } else if ($day == '-1') {
            $time_str = gmdate('Y-m-d', strtotime("+1 day") + 8 * 3600);
            $time_str .= " $hours:$minutes:00";
            $nexttransact = strtotime($time_str);
        } else {
            $time_str = gmdate('Y-m', strtotime("next Month") + 8 * 3600);
            $time_str .= "-";
            $time_str .= $day;
            $time_str .= " $hours:$minutes:00";
            $nexttransact = strtotime($time_str);
        }
        $news = M("cron");
        return $news->where("id=" . $cron_transact["id"] . "")->save(array("lasttransact" => $systime, "nexttransact" => $nexttransact));
    }

    //城市变化-ni8shop
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

//城市变化-ni8shop
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

    //分类显示品牌-ni8shop
    public function ppgl() {
        $ts = array(
            '1' => "选择品牌",
        );

        $data = $_POST['data'];
        $classid = (int) $_POST['classid'];
        $data = explode("|", $data);
        $nr = "<option value=''>" . $ts[$data[4]] . "</option>";
        $show = $this->finds($data[0], 'classid=' . $classid, 'sort desc,classid desc');
        if ($show['prv_id'] > 0)
            $show = $this->finds($data[0], 'classid=' . $show['all_id'], 'sort desc,classid desc');
        if ($show) {
            $pplink = "0" . str_replace("|", ",", $show[$data[3]]) . "0";
            $pp = $this->lb($data[1], "class_name_cn<>'' and prv_id=0 and qy=" . $data[2] . " and classid in(" . $pplink . ")", 'sort desc,classid desc');

            foreach ($pp as $key => $val) {
                $nr .= '<option  value="' . $val['classid'] . '">' . $val['class_name_cn'] . '</option>';
            }
        }
        echo $nr;
    }

}

?>