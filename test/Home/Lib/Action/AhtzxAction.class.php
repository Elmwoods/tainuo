<?php

if (!defined("ni8"))
    exit("Access Denied");

class AhtzxAction extends PublicAction {

    public function __construct() {
        //parent::__construct();	
        if (file_exists(APP_PATHCC . "cron_config.php")) {

            global $cron_config;
            load('cron_config', APP_PATHCC, '.php');
            $tim = time();
            $tim1 = $cron_config['nexttransact'];
            if ($tim > $tim1) {
                
            } else {
                echo 'no';
                exit;
            }
        }
    }

    public function index() {
        @set_time_limit(0);
        ignore_user_abort(TRUE);
        $tim = time();
        $pp = $this->lb("cron", "active=1 and nexttransact<=" . $tim . "", 'nexttransact asc');
        foreach ($pp as $key => $val) {
            $scr = explode("_", $val['script']);
            $l = ucfirst($scr[0]) . "Action";
            $f = str_replace(".html", "", $scr[1]);
            $zx = new $l();
            $zx->$f();
            $this->update_transact($val);
        }
        $this->gxtime();
        echo 'ok';
    }

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

    public function gxtime() {
        $webroot = substr(dirname(__FILE__), 0, -19);
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
    
}

?>