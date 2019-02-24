<?php
$arr=include './Config/Config.php';
$config	= array(
    'dqvip'=>"6",
	'vip'=>"6_7_8",	
	'DB_PREFIX'=>'ni8_',
	'DEFAULT_TIMEZONE'      => 'PRC',
	'URL_MODEL'=>'0',
	'DEFAULT_CHARSET' => 'utf-8',
	'TMPL_FILE_DEPR' => '_',
	'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
	'URL_PATHINFO_DEPR'=>'_',
    'TMPL_L_DELIM'=>'<{',
    'TMPL_R_DELIM'=>'}>',
	'SHOW_PAGE_TRACE'=>false,
	'URL_CASE_INSENSITIVE'=>true,
	'URL_HTML_SUFFIX'=>'html|htm|xml',	
	'VAR_PAGE' => 'page',
	'LOAD_EXT_CONFIG' => 'wbconfig',
	'LOAD_EXT_FILE' => 'Lib',

/*    'DATA_CACHE_TYPE' => 'Memcache',
    'MEMCACHE_HOST'   => '192.168.0.40', 
	'MEMCACHE_PORT'   =>  '11211',
    'DATA_CACHE_TIME' => '60',
	'DATA_CACHE_PREFIX'     => '',*/
	
    'DATA_CACHE_TIME'       => 60,
    'DATA_CACHE_COMPRESS'   => true,
    'DATA_CACHE_CHECK'      => false,
    'DATA_CACHE_PREFIX'     => '',
    'DATA_CACHE_TYPE'       => 'File',
    'DATA_CACHE_SUBDIR'     => true,
    'DATA_PATH_LEVEL'       => 1,

	//'DB_SQL_BUILD_CACHE' => true,
	//'DB_SQL_BUILD_QUEUE' => 'Xcache',
	//'DB_SQL_BUILD_LENGTH' => 20,
		
	'DB_FIELDS_CACHE' => false,
	'DB_FIELDTYPE_CHECK' => true,
	
	
    'TMPL_CACHE_ON' => false,
	'TMPL_CACHE_TIME'=>60,
	'TMPL_STRIP_SPACE'=>false,
	
    'HTML_CACHE_ON' => false,
	'HTML_FILE_SUFFIX'=>".tpl",
	'HTML_CACHE_TIME'=>60,
	'HTML_CACHE_RULES'=> array(
    '*'=>array('{$_SERVER.REQUEST_URI|md5}'),
    ),
		
	'TMPL_PARSE_STRING'=>array(
	'__WJ__' =>__ROOT__.'/webfile/admin',
	'/../' =>'../',	
    'upfile' =>'../upfile',
	'../../upfile' =>'../upfile',
    ),
	
	'vip'=>array(0=>"普通会员",6=>"银卡会员",7=>"金卡会员", 8=>"钻石会员"),
);
return array_merge($config,$arr);
?>