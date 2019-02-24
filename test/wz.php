<?php
header("Content-type: text/html;charset=utf-8");
header('X-Frame-Options: deny');
@ini_set("session.cookie_httponly", 1); 
define('ni8',true);
define('APP_NAME','Home');
define('APP_PATH','./Home/');
define('APP_LANG',true);
define('APP_DEBUG',true);
define('THINK_PATH','./Coretp/');

define('APP_PATHCC','./Cache/execute/');
define("WEB_ROOT", dirname(__FILE__) . "/");
define("RUNTIME_PATH", WEB_ROOT . "Cache/Runtime/".APP_NAME."/");
define('HTML_PATH',RUNTIME_PATH.'Html/');
//ob_start();
$hh=$_SERVER['HTTP_HOST'];
$pos = strpos($hh,'.');
$webhost=substr($hh,$pos+1);
define('WEB_HOST',$webhost);
if($webhost!="hx.net.cn"){
//header("Location: http://gt.hx.net.cn");
//exit;
}
require(THINK_PATH.'ThinkPHP.php');
?>