<?php

$arr = include './Config/Config.php';
$config = array(
    //'配置项'=>'配置值'
    'dqvip' => "6",
    'vip' => "6_7_8",
    'DEFAULT_THEME' => '',
    //'TMPL_DETECT_THEME' => false,
    //'THEME_LIST' => 'default',
    'VAR_TEMPLATE' => 't',
    'DB_PREFIX' => 'ni8_',
    'DEFAULT_TIMEZONE' => 'Asia/Singapore',
    'URL_MODEL' => '1',
    'DEFAULT_CHARSET' => 'utf-8',
    //'TMPL_FILE_DEPR' => '_',
    'TMPL_TEMPLATE_SUFFIX' => '.html',
    'URL_PATHINFO_DEPR' => '_',
    'TMPL_L_DELIM' => '<{',
    'TMPL_R_DELIM' => '}>',
    'SHOW_PAGE_TRACE' => false,
    'URL_CASE_INSENSITIVE' => true,
    'URL_HTML_SUFFIX' => 'html|htm',
    'VAR_PAGE' => 'page',
    'DB_FIELDS_CACHE' => false,
    'DB_FIELDTYPE_CHECK' => true,
    'URL_ROUTER_ON' => false,
    'URL_ROUTE_RULES' => array(
    ),
    'DATA_CACHE_TIME' => 60,
    'DATA_CACHE_COMPRESS' => true,
    'DATA_CACHE_CHECK' => true,
    'DATA_CACHE_PREFIX' => '',
    'DATA_CACHE_TYPE' => 'File',
    'DATA_CACHE_SUBDIR' => true,
    'DATA_PATH_LEVEL' => 1,
    'TMPL_PARSE_STRING' => array(
        '__WJ__' => __ROOT__ . '/webfile/wapp',
        '/../' => '../',
    //'../' =>"http://".$_SERVER["HTTP_HOST"].__ROOT__."/",
    //'../' =>"http://www.".WEB_HOST.__ROOT__."/",
    ),
);
return array_merge($config, $arr);
?>