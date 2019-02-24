<?php
header("Content-type: text/html;charset=utf-8");
define('ni8shop',true);
define('APP_NAME','Htadmin');
define('APP_PATH','./Htadmin/');
define('APP_LANG',true);
define('APP_DEBUG',true);
define('DB_FIELDS_CACHE',FALSE);
define('HTML_CACHE_ON',FALSE);

define("WEB_ROOT", dirname(__FILE__) . "/");
define('WEB_CACHE_PATH', WEB_ROOT."Cache/");
define("RUNTIME_PATH", WEB_ROOT . "Cache/Runtime/".APP_NAME."/");
define('HTML_PATH',RUNTIME_PATH.'Html/');
define('THINK_PATH','./Coretp/');
$hh=$_SERVER['HTTP_HOST'];
$pos = strpos($hh,'.');
$webhost=substr($hh,$pos+1);
if($webhost!="hx.net.cn"){
//header("Location: http://gt.hx.net.cn/htni8.php");
//exit;
}
require(THINK_PATH.'ThinkPHP.php');
?>