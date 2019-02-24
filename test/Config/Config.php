<?php
return array(
'DB_TYPE'=>'mysql',
'DB_HOST'=>'localhost',
'DB_NAME'=>'tainuo',
'DB_USER'=>'root',
'DB_PWD'=>'root',
'DB_PORT'=>'3306',
'web_url'=>'http://'.$_SERVER["HTTP_HOST"].'',
'pic_url'=>'http://'.$_SERVER["HTTP_HOST"].''.__ROOT__."/",
'htpiclj'=>__ROOT__,
'htpiclj1'=>'..',


'COOKIE_PREFIX'=>'ni8_',
'COOKIE_EXPIRE'=>3600 * 24,
'COOKIE_PATH'=> "/",
//'COOKIE_DOMAIN'=> str_replace(":8000","",str_replace("www.","",$_SERVER["HTTP_HOST"])),
'COOKIE_DOMAIN'=> $_SERVER["HTTP_HOST"],
'COOKIE_SECURE'=>false,
'PASS'=>'ni8123',	
)
?>