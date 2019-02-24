<?php
if(!defined("ni8shop")) exit("Access Denied");
function mdate($val){
  return date("Y-m-d H:i:s",$val);
}
function xxname($textid){
$news = M("webmessage");
$arrs=$news->cache(false)->where("textid=".$textid."")->select();
$sl=count($arrs);
if($sl==1){
   $recid=$arrs[0]['recid'];
   if($recid==0){
     $bt="全部";
   }else{
     $bt=ly($recid);
   }
}else{
   $bt="";
	foreach($arrs as $key=>$val){
		if($bt){
			$bt.=",".ly($val['recid']);
		}
		else{
			$bt.="".ly($val['recid']);
		}
	}
}
return $bt;
}
//6-1
function midd($link_id,$classid,$lx){
	if(strpos($link_id,"|".$classid."|")>-1){
		if($lx==0){
			return 'zk';
		}else{
			return 'style="display:;"';
		}
	}else{
		if($lx==0){
			return 'hb';
		}else{
			return 'style="display:none;"';
		}
	}
}
function fplr($val){
$arr=array(
"0"=>"明细",
"1"=>"办公用品",
"2"=>"耗材"
);
return $arr[$val];
}
function lxmessage($val){
$arr=array(
"1"=>"系统",
"2"=>"通知",
"3"=>"公告"
);
return $arr[$val];
}
function yypassed($val){
$arr=array(
"0"=>"已取消",
"1"=>"待使用",
"2"=>"已服务"
);
return $arr[$val];
}
//会员推荐级别
function thdj($link,$val){
	$array=explode(",",$link);
	foreach($array as $key=>$va){
		if($va==$val){
		return $dj=($key+1)."级";
		break;		
		}
	}
}
//会员等级-ni8shop
function vip($val){
	$arr=array(
	"0"=>"普通会员",
	"6"=>"银卡会员",
	"7"=>"金卡会员",
	"8"=>"钻石会员"
	);
	return $arr[$val];
}
//6-1
function picfl($val){
	$pic=array(
		'0'=>"移动横图",
		'1'=>"栏目图片",
		);
	return $pic[$val];
}
//微信是否禁用-ni8shop
function passed($pass){
	if($pass==0){
		return '<span class="red">是</span>';
	}
	else
	{
		return '否';
	}
}
//微信消息类型-ni8shop
function style($sty){
if($sty==0){
return '文本消息';
}
elseif($sty==1){
return '图文消息';
}
else
{
return '连接消息';
}
}
//微信关键词-ni8shop
function keys($sty){
$sty=str_replace('\\','',$sty);
$sty=(json_decode($sty,true));
$values='';
foreach($sty as $key=>$value){
if($key==0){
$values.=$value['keyword'];
}
else
{
$values.='、'.$value['keyword'];
}
}
return $values;
}
//提现状态-ni8shop
function txpass($zt){
if($zt=="0")$pa="待审核";
if($zt=="1")$pa="审核未通过";
if($zt=="2")$pa="审核通过";
if($zt=="3")$pa="已到账";
return $pa;
}
//ni8shop
function isth($zt){
if($zt==1)$pa="退款";
if($zt==2)$pa="退货";
if($zt==3)$pa="换货";
return $pa;
}
//退换处理状态ni8shop
function isthpass($zt){
if($zt=="0")$pa="审核中";
if($zt=="1")$pa="审核通过";//审核通过
if($zt=="2")$pa="等待卖家收货";//买家发货-等待收货
if($zt=="3")$pa="卖家已收货";//已收货（发货物）
if($zt=="4")$pa="卖家已发货";//发货物
if($zt=="5")$pa="已完成";
if($zt=="6")$pa="已拒绝";

if($zt=="11")$pa="已拒绝";
if($zt=="12")$pa="已完成";
if($zt=="13")$pa="已取消";
return $pa;
}
//保留2位小数ni8shop
function formatmoney($money,$sl=2){
		 return number_format($money,(int)$sl,".","");
}

function isjs($zt){
if($zt==0)$pa="未结算";
if($zt==1)$pa="已结算";
return $pa;
}
//ni8shop
function orderqy($zt){
if($zt==0)$pa="产品";
if($zt==1)$pa="团购";
if($zt==2)$pa="积分";
return $pa;
}
//评论等级-ni8shop
function plxx($zt){
if($zt==1)$pa="一星";
if($zt==2)$pa="二星";
if($zt==3)$pa="三星";
if($zt==4)$pa="四星";
if($zt==5)$pa="五星";
return $pa;
}
//快递名称-ni8shop
function kdname($zt){
$news = M("region");
$arrs=$news->cache(true)->where("id in(".$zt.")")->select();
$nr="";
foreach($arrs as $key=>$val){
	if($nr){
		$nr.=",".$val['region_name'];
	}
	else{
		$nr.="".$val['region_name'];
	}
}
echo $nr;
}

function insuredrelation($zt){
if($zt==1)$pa="本人";
if($zt==2)$pa="配偶";
if($zt==3)$pa="父母";
if($zt==4)$pa="子女";
return $pa;
}

function zjstyle($zt){
	if($zt==1)$pa="身份证";
	if($zt==2)$pa="护照";
	if($zt==3)$pa="港澳通行证";
	if($zt==4)$pa="台湾通行证";
	if($zt==5)$pa="其他证件";	
	return $pa;
}
//会员来源-ni8shop
function ly($id){
$news = M('user');
$username=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField('username');
return ($username)?$username:"无";
}
//6-1
function newsqy($qy){
$kz=array(
	'1'=>"酒讯",
	'2'=>"酒问",
	);
return $kz[$qy];
}
//6-1
function newsdj($qy){
$dj=array(
	'1'=>"0",
	'2'=>"0",
	);
return $dj[$qy];
}
//6-1
function newspic($qy){
$ispic=array(
	'1'=>"0",
	'2'=>"1",
	);
return $ispic[$qy];
}
//6-1
function newspics($qy){
$ispic=array(
	'1'=>"1",
	'2'=>"0",
	);
return $ispic[$qy];
}
//退款金额-ni8shop	
function tkprice($date,$prid,$ddid){
	$news = M($date);
	$fname=$news->cache(true,0)->where('proid='.$prid.' and ddpid='.$ddid.' and qy=0')->order('id asc')->getField("price");
	return $fname;	
}
//获取字段内容-ni8shop	
function hygroup($date,$where,$where1,$id,$file){
	$news = M($date);
	$fname=$news->cache(true,0)->where($where.'='.$where1)->order($id.' desc')->getField($file);
	return $fname;
}

function dw($zt){
	if($zt==0)$pa="天";
	if($zt==1)$pa="月";
	if($zt==2)$pa="年";
	return $pa;
}
//计划任务周期-ni8shop
function lang_show($zt){
if($zt=="Sunday")$pa="每周日";
if($zt=="Monday")$pa="每周一";
if($zt=="Tuesday")$pa="每周二";
if($zt=="Wednesday")$pa="每周三";
if($zt=="Thursday")$pa="每周四";
if($zt=="Friday")$pa="每周五";
if($zt=="Saturday")$pa="每周六";
if($zt=="-1")$pa="每天";
return $pa;
}
//获取当前分类-ni8shop
function lm($id,$date){
$news = M($date);
$region_name=$news->cache(true,0)->where('classid='.$id)->order('classid desc')->getField('class_name_cn');
return $region_name;
}
//删除文件夹-ni8shop
function delDirAndFile($path, $delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }

}

function cutout($String,$Length,$Append = false){ 
    if (strlen($String)<=$Length){
        return $String; 
    }
else{ 
        $I = 0; 
        while ($I < $Length) { 
            $StringTMP = substr($String,$I,1); 
            if ( ord($StringTMP) >=224 ) { 
                $StringTMP = substr($String,$I,3); 
                $I = $I + 3; 
            } 
            elseif( ord($StringTMP) >=192 ) { 
                $StringTMP = substr($String,$I,2); 
                $I = $I + 2; 
            } 
            else { 
                $I = $I + 1; 
            } 
            $StringLast[] = $StringTMP; 
        } 
        $StringLast = implode("",$StringLast); 
        if($Append) { 
            $StringLast .= "..."; 
        } 
        return $StringLast; 
    }
}

function array_remove(&$arr, $offset)
		{
		array_splice($arr, $offset, 1);
		} 

//地址-ni8shop
function address($id){
$news = M('Region');
$region_name=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField('region_name');
return $region_name;
}

function pay($zt){
if($zt==0)$pa="余额支付(默认)";
if($zt==1)$pa="微信支付";
if($zt==2)$pa="银联支付";
if($zt==3)$pa="支付宝";
return $pa;
}

function picc($id,$date,$dx){
$news = M($date);
$spic=$news->cache(true)->where('id='.$id)->order('id desc')->getField($dx);
return $spic;
}
//ni8shop
function ddpassed($zt){
if($zt==0)$pa="待付款";
if($zt==1)$pa="待发货";
if($zt==2)$pa="待收货";
if($zt==3)$pa="交易成功";
if($zt==4)$pa="交易失败";
return $pa;
}
//6-1
function bh($link_id,$dq){
if(strpos($link_id,"|".$dq."|")>-1){
return ' checked="checked" ';
}
else
{
return '';
}
}

function replace($content,$th){
return str_replace("www",$th,$content);
}


function middxz($link_id,$classid,$fs=1){
if(strpos($link_id,"|".$classid."|")>-1){
if($fs==1)return 'checked';
if($fs==2)return 'selected';
}
else
{
return '';
}
}
//end








function qy($id){
$lm=array(
  array('0'=>'1','1'=>'新闻中心','2'=>'图片尺寸:887px × 288px'),
  array('0'=>'2','1'=>'新闻中心详细','2'=>'图片尺寸:宽280px'),
  array('0'=>'3','1'=>'二手市场','2'=>'图片尺寸:586px × 300px'),
  array('0'=>'4','1'=>'二手市场小广告','2'=>'图片尺寸:248px × 160px'),
  array('0'=>'5','1'=>'首页BANNER图','2'=>'图片尺寸:655px × 288px'),
  array('0'=>'6','1'=>'首页底部广告','2'=>'图片尺寸:1190px × 58px'),  
  );
  foreach($lm as $key=>$value){
  if($value[0]==$id)$nr=$value[1];
  }
return $nr;
}

function hpl($id,$ddh,$nr){
$news = M('Feedback1');
$nr1=$news->where("pro_id=".$id." and ddbh='".$ddh."'")->order('id desc')->getField($nr);
if($nr=='passed'){
if($nr1==1){
return '已审核';
}
else
{
return '未审核';
}
}
else
{
return $nr1;
}
}

function bh1($jb,$link_id,$dq){
if(strpos($link_id,"|".$dq."|")>-1 || $jb==1){
return 1;
}
else
{
return 0;
}
}



function pic($id){
$news = M('Pro');
$spic=$news->where('id='.$id)->order('id desc')->getField('spic');
return $spic;
}








function lm1($id,$date){
$news = M($date);
$region_name=$news->cache(true,0)->where('classid='.$id)->order('classid desc')->getField('title');
return $region_name;
}
//订单统计-ni8shop
function ordertj($date,$userid){
$news = M($date);
$count=$news->where("user_id=".$userid." and ishs=0 and qy=0")->count();
return $count;
}

function links($link_id,$date){
$link_id=explode("|",$link_id);
$news = M($date);
if($link_id[1])$region_name=$news->cache(true,0)->where('classid='.$link_id[1])->order('classid desc')->getField('class_name_cn');
if($link_id[2]){
$region_name1=$news->cache(true,0)->where('classid='.$link_id[2])->order('classid desc')->getField('class_name_cn');
$region_name1=">".$region_name1;
}
if($link_id[3]){
$region_name2=$news->cache(true,0)->where('classid='.$link_id[3])->order('classid desc')->getField('class_name_cn');
$region_name2=">".$region_name2;
}
return $region_name."&nbsp;".$region_name1."&nbsp;".$region_name2;
}

function sex($zt){
if($zt==0)$pa="男";
if($zt==1)$pa="女";
return $pa;
}


function gf($date){
$arr=explode(chr(10),$date);
return '<h1>'.$arr[0].'</h1><h2>'.$arr[1].'</h2>';
}

function csfg($date,$index){
$arr=explode("||",$date);
return $arr[$index];
}

function mb($zt){
$lm="#|模版一|模版二|模版三";
$lm=explode("|",$lm);	
return $lm[$zt];
}










//获取ID地址转换名称-ni8shop
function convertip($ip, $ipdatafile){
	static $fp = NULL, $offset = array(), $index = NULL;
	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));
	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];
	if($fp === NULL && $fp = @fopen($ipdatafile, 'rb')){
		$offset = unpack('Nlen', fread($fp, 4));
		$index  = fread($fp, $offset['len'] - 4);
	}
	elseif($fp == FALSE){
		return  '- Invalid IP data file';
	}
	$length = $offset['len'] - 1028;
	$start  = unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);
	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8){
		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip){
			$index_offset = unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = unpack('Clen', $index{$start + 7});
			break;
		}
	}
	fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	if($index_length['len']) {
		return '- '.fread($fp, $index_length['len']);
	} else {
		return '- Unknown';
	}
}
?>