<?php
if(!defined("ni8")) exit("Access Denied");
//会员等级
function week($time){
    $date = date('N',$time);
    switch ($date) {
        case 1:
            return '星期一';
            break;
        case 2:
            return '星期二';
            break;
        case 3:
            return '星期三';
            break;
        case 4:
            return '星期四';
            break;
        case 5:
            return '星期五';
            break;
        case 6:
            return '星期六';
            break;
        case 7:
            return '星期日';
            break;
        default:
            break;
    }
}

function vip($val){
$arr=array(
"0"=>"铁牌会员",
"6"=>"黄金代理商",
"7"=>"白金代理商",
"8"=>"钻石代理商"
);
return $arr[$val];
}
//地区查找
function address($id){
$news = M('Region');
$region_name=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField('region_name');
return $region_name;
}
//银行卡
function yhk(){
$yharray=array();
$yharray[]=array('id'=>1,'name'=>'中国银行');
$yharray[]=array('id'=>2,'name'=>'建设银行');
$yharray[]=array('id'=>3,'name'=>'农业银行');
$yharray[]=array('id'=>4,'name'=>'浦发银行');
$yharray[]=array('id'=>5,'name'=>'工商银行');
$yharray[]=array('id'=>6,'name'=>'交通银行');
$yharray[]=array('id'=>7,'name'=>'广发银行');
$yharray[]=array('id'=>8,'name'=>'民生银行');
$yharray[]=array('id'=>9,'name'=>'深圳发展银行');
$yharray[]=array('id'=>10,'name'=>'招商银行');
$yharray[]=array('id'=>11,'name'=>'兴业银行');
$yharray[]=array('id'=>12,'name'=>'北京银行');
$yharray[]=array('id'=>13,'name'=>'中国邮政');
$yharray[]=array('id'=>14,'name'=>'中信银行');
$yharray[]=array('id'=>15,'name'=>'光大银行');
return $yharray;
}
//银行卡
function yhk1($id){
$yharray=array();
$yharray[1]=array('id'=>1,'name'=>'中国银行');
$yharray[2]=array('id'=>2,'name'=>'建设银行');
$yharray[3]=array('id'=>3,'name'=>'农业银行');
$yharray[4]=array('id'=>4,'name'=>'浦发银行');
$yharray[5]=array('id'=>5,'name'=>'工商银行');
$yharray[6]=array('id'=>6,'name'=>'交通银行');
$yharray[7]=array('id'=>7,'name'=>'广发银行');
$yharray[8]=array('id'=>8,'name'=>'民生银行');
$yharray[9]=array('id'=>9,'name'=>'深圳发展银行');
$yharray[10]=array('id'=>10,'name'=>'招商银行');
$yharray[11]=array('id'=>11,'name'=>'兴业银行');
$yharray[12]=array('id'=>12,'name'=>'北京银行');
$yharray[13]=array('id'=>13,'name'=>'中国邮政');
$yharray[14]=array('id'=>14,'name'=>'中信银行');
$yharray[15]=array('id'=>15,'name'=>'光大银行');
return $yharray[$id]['name'];
}
//提现状态
function txpass($zt){
if($zt=="0")$pa="待审核";
if($zt=="1")$pa="审核未通过";
if($zt=="2")$pa="待打款";
if($zt=="3")$pa="已到账";
return $pa;
}
//end
//保险状态
function bxpassed($zt){
if($zt=="1")$pa="初始";
if($zt=="2")$pa="待支付";
if($zt=="3")$pa="已支付";
if($zt=="4")$pa="作废";
return $pa;
}
//判断几维数组
function arrayLevel($arr){
    $al = array(0);
    function aL($arr,&$al,$level=0){
        if(is_array($arr)){
            $level++;
            $al[] = $level;
            foreach($arr as $v){
                aL($v,$al,$level);
            }
        }
    }
    aL($arr,$al);
    return max($al);
}

//快递名称
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
//快递方式
function kdfs($zt){
	if($zt==1)$pa="快递";
	if($zt==2)$pa="EMS";
	if($zt==3)$pa="平邮";
	return $pa;
}
//ni8
function hygroup($date,$where,$where1,$id,$file){
	$news = M($date);
	$fname=$news->cache(true,0)->where($where.'='.$where1)->order($id.' desc')->getField($file);
	return $fname;
}
//获取当前
function midd($link_id,$classid,$fs=1){
if(strpos($link_id,"|".$classid."|")>-1){
if($fs==1)return 'checked';
if($fs==2)return 'selected';
}
else
{
return '';
}
}
//获取用户ni8
function ly($id){
$news = M('user');
$username=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField('username');
return $username;
}
//续费用
function ljxf($date,$ddbh){
$dq=strtotime('-15 day',strtotime($date));
$dq1=strtotime($date);
$time=time();
if($time>$dq && $time<=$dq1){
echo '<a href="'.C("pic_url").'insurance_payxf?ddbh='.$ddbh.'">立即续费</a>';
}
}
//数组
 function array_remove(&$arr, $offset)
		{
		array_splice($arr, $offset, 1);
		}

//序列化
function unze($content,$dx){
$content=str_replace('\\','',$content);
$content=unserialize($content);
return $content[$dx];
}
//被保人关心
function insuredrelation($zt){
if($zt==1)$pa="本人";
if($zt==2)$pa="配偶";
if($zt==3)$pa="父母";
if($zt==4)$pa="子女";
return $pa;
}
//性别
function sex($zt){
if($zt==0)$pa="男";
if($zt==1)$pa="女";
return $pa;
}
//保险时间单位
function dw($zt){
	if($zt==0)$pa="天";
	if($zt==1)$pa="月";
	if($zt==2)$pa="年";
	return $pa;
}
//证件类型
function zjstyle($zt){
	if($zt==1)$pa="身份证";
	if($zt==2)$pa="护照";
	if($zt==3)$pa="港澳通行证";
	if($zt==4)$pa="台湾通行证";
	if($zt==5)$pa="其他证件";	
	return $pa;
}
//月份
function mo($date){
$arr=array(
"1"=>"Jan",
"2"=>"Feb",
"3"=>"Mar",
"4"=>"Apr",
"5"=>"May",
"6"=>"June",
"7"=>"July",
"8"=>"Aug",
"9"=>"Sept",
"10"=>"Oct",
"11"=>"Nov",
"12"=>"Dec",
);
return $arr[$date];
}
//分割|线
function qqfg($date,$index){
$arr=explode("|",$date);
return $arr[$index];
}
//保险分行
function bxfg($date){
$arr=explode(chr(10),$date);
$nr="";
foreach($arr as $key){
$nr.="<p>".$key."</p>";
}
return $nr;
}
//合并样式
function parse_css($urls,$lj="web")
{
	$showurl = $url = md5(implode(',',$urls));
	$systime=time();	 
	$css_url = 'webfile/'.$lj.'/runtime/'.$url.'.css';
	$url_path = WEB_ROOT.$css_url;
	if(!file_exists($url_path) || filemtime($url_path) < $systime-14400)
	{
		if(!file_exists(WEB_ROOT.'webfile/'.$lj.'/runtime/'))
			mkdir(WEB_ROOT.'webfile/'.$lj.'/runtime/',0777);

		$css_content = '';
		foreach($urls as $url)
		{
			$css_content .= @file_get_contents($url);
		}
		$css_content = preg_replace("/[\r\n]/",'',$css_content);
		//$css_content = str_replace("../images/",$tmpl_path."/images/",$css_content);		
		//@file_put_contents($url_path, unicode_encode($css_content));
		@file_put_contents($url_path, $css_content);		
	}	
	return "../".$css_url;
}
//合并JS
function parse_script($urls,$lj="web",$encode_url=array())
{

	$showurl = $url = md5(implode(',',$urls));
    $systime=time();
	$js_url = 'webfile/'.$lj.'/runtime/'.$url.'.js';
	$url_path = WEB_ROOT.$js_url;
	if(!file_exists($url_path) || filemtime($url_path) < $systime-14400)
	{
		if(!file_exists(WEB_ROOT.'webfile/'.$lj.'/runtime/'))
			mkdir(WEB_ROOT.'webfile/'.$lj.'/runtime/',0777);		

		if(count($encode_url)>0)
		{
			import('Common.Javascriptpacker',APP_PATH,'.php');
		}

		$js_content = '';
		foreach($urls as $url)
		{
		
			$append_content = @file_get_contents($url)."\r\n";
			
			if(in_array($url,$encode_url))
			{
				$packer = new JavaScriptPacker($append_content);
				$append_content = $packer->pack();
			}
			$js_content .= $append_content;
		}

		@file_put_contents($url_path,$js_content);
	}

	return "../".$js_url;
}
//获取对象ni8
function pic($id,$date,$dx){
$news = M($date);
$spic=$news->cache(true)->where('id='.$id)->order('id desc')->getField($dx);
return $spic;
}
//获取对象
function picc($id,$date,$dx){
$news = M($date);
$spic=$news->cache(true)->where('classid='.$id)->order('classid desc')->getField($dx);
return $spic;
}
//截取字符ni8
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
//星号-ni8
function xx($str){
return cut_str($str, 3, 0).'****'.cut_str($str, 3, -3);
}
//同上-ni8
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}
//替换
function replace($find,$th,$content){
return str_replace($find,$th,$content);
}
//加密
function encrypt($data, $key) {
$prep_code = serialize($data);
$block = mcrypt_get_block_size('des', 'ecb');
if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
$prep_code .= str_repeat(chr($pad), $pad);
}
$encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
return base64_encode($encrypt);
}
//解密
function decrypt($str, $key) {
$str = base64_decode($str);
$str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
$block = mcrypt_get_block_size('des', 'ecb');
$pad = ord($str[($len = strlen($str)) - 1]);
if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
$str = substr($str, 0, strlen($str) - $pad);
}
return unserialize($str);
}
//保留2位小数ni8
function formatmoney($money){
		 return number_format($money,"2",".","");
}
//自动连接
function build_srcall($cs,$classid,$ure,$kk=true,$cs1="",$cs2="")
	{
        $get=explode("&",$ure);
		$temp1='';
		if(!is_array($get)){
			if($kk)$temp1="?".$cs."=".$classid;
		}
		else{	
			foreach ($get as $key)
			{
			$keys=explode("=",$key);
			if($keys[0]=="pr"){
			if($keys[0]<>$cs && $keys[0]<>$cs1 && $keys[0]<>$cs2 && $keys[0]<>"page" && !empty($keys[1])) $temp1.=$keys[0]."=".$keys[1]."&";
			}
			else{
			if($keys[0]<>$cs && $keys[0]<>$cs1 && $keys[0]<>$cs2 && $keys[0]<>"page" && !empty($keys[1])) $temp1.=$keys[0]."=".(int)$keys[1]."&";
			}
			}
			if(!empty($temp1))
			{
			if($kk){
			$temp1="?".substr($temp1,0,strlen($temp1)-1)."&".$cs."=".$classid;
			}
			else
			{
			$temp1="?".substr($temp1,0,strlen($temp1)-1);
			}
			}
			else
			{
			if($kk)$temp1="?".$cs."=".$classid;
			}
		}
     return $temp1;
	}
//订单状态ni8
function passed($zt){
if($zt==0)$pa="待付款";
if($zt==1)$pa="已付款";
if($zt==2)$pa="待收货";
if($zt==3)$pa="交易成功";
if($zt==4)$pa="交易失败";
return $pa;
}
//退换状态ni8
function isth($zt){
if($zt==1)$pa="退款";
if($zt==2)$pa="退货";
if($zt==3)$pa="换货";
return $pa;
}
//退换处理状态ni8
function isthpass($zt){
if($zt=="0")$pa="审核中";
if($zt=="1")$pa="审核通过";//审核通过
if($zt=="2")$pa="等待卖家收货";//买家发货-等待收货
if($zt=="3")$pa="卖家已收货";//已收货（发货物）
if($zt=="4")$pa="卖家已发货";//发货物
if($zt=="5")$pa="已完成";
if($zt=="6")$pa="已拒绝";
return $pa;
}
//退换处理状态ni8
function isthpassmes($zt){
if($zt=="0")$pa="审核中";
if($zt=="1")$pa="请发货";//审核通过
if($zt=="2")$pa="待收货";//买家发货-等待卖家收货
if($zt=="3")$pa="待发货";//已收货（待货物）
if($zt=="4")$pa="待收货";//发货物
if($zt=="5")$pa="已完成";
if($zt=="6")$pa="已拒绝";
return $pa;
}
//评论等级
function plxx($zt){
if($zt==1)$pa="差评";
if($zt==2)$pa="中评";
if($zt==3)$pa="好评";
return $pa;
}
//统计评论
function plcount($classid,$qy,$where=""){
$news = M('Message');
$count=$news->where(' qy='.$qy.' and proid='.$classid.' '.$where)->count();
return $count;
}
//
function tpfg($date){
$arr=explode("|",$date);
$nr="";
foreach($arr as $key=>$val){
if($val)$nr.='<img src="'.$val.'"/>';
}
return $nr;
}

//
function isjs($zt){
if($zt==0)$pa="未结算";
if($zt==1)$pa="已结算";
return $pa;
}
//end



//获取评论内容
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









function lyweb($id){
$news = M('user');
$username=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField('company');
return $username;
}
function ly1($id,$file){
$news = M('user');
$username=$news->cache(true,0)->where('id='.$id)->order('id desc')->getField($file);
return $username;
}
//获取分类2014-12-1
function dqclass1($classid,$date){
$news = M($date);
$region_name=$news->where('classid='.$classid)->order('classid desc')->getField('title');
return $region_name;
}
//获取分类ok
function dqclass($classid,$date){
$news = M($date);
$region_name=$news->cache(true,0)->where('classid='.$classid)->order('classid desc')->getField('class_name_cn');
return $region_name;
}
//获取分类ok
function dqclasshy($classid,$date){
$news = M($date);
$region_name=$news->where('classid='.$classid)->order('classid desc')->getField('class_name_cn');
return $region_name;
}
//ok

//ok
function qygm($zt){
if($zt==0)$pa="5人以下";
if($zt==1)$pa="5---10人";
if($zt==2)$pa="11---50人";
if($zt==3)$pa="51---100人";
if($zt==4)$pa="101---200人";
if($zt==5)$pa="201---300人";
if($zt==6)$pa="301---500人";
if($zt==7)$pa="500---1000人";
if($zt==8)$pa="1000人以上";
return $pa;
}
//获取当前分类2014-12-1
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
//ok

//ok
function sex1($zt){
if($zt==0)$pa="男";
if($zt==1)$pa="女";
return $pa;
}









//参数连接ni8
function build_src($cs,$classid,$ure,$kk=true,$cs1="",$cs2="",$cs3="",$cs4="")
	{
        $get=explode("&",$ure);
		$temp1='';
		if(!is_array($get)){
		if($kk)$temp1="?".$cs."=".$classid;
		}
		else{	
		foreach ($get as $key)
		{
		$keys=explode("=",$key);
		if($keys[0]<>$cs && $keys[0]<>$cs1 && $keys[0]<>$cs2 && $keys[0]<>$cs3 && $keys[0]<>$cs4 && $keys[0]<>"page" && !empty($keys[1])) $temp1.=$keys[0]."=".$keys[1]."&";
		}
		if(!empty($temp1))
		{
		if($kk){
        $temp1="?".substr($temp1,0,strlen($temp1)-1)."&".$cs."=".$classid;
		}
		else
		{
		$temp1="?".substr($temp1,0,strlen($temp1)-1);
		}
		}
		else
		{
		if($kk)$temp1="?".$cs."=".$classid;
		}
		}
     return $temp1;
	}









//ok
 

//ok
function checkorderstatus($ordid,$lx){
	$cs=explode("|||",$lx);
	$csc=count($cs);
    if($csc==1){
    $Ord=M('Dd');
    $ordstatus=$Ord->where("ddbh='".$ordid."'")->getField('passed');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
	}
	else{
    $Ord=M('Jl');
    $ordstatus=$Ord->where("qy=0 and ordern='".$ordid."'")->order("id desc")->find();
    if($ordstatus){
        return true;
    }else{
        return false;    
    }
	}
}
//ok
function orderhandle($parameter,$lx){
    $cs=explode("|||",$lx);
	$csc=count($cs);
    if($csc==1){
    $ordid=$parameter['out_trade_no'];
	$data=array();
    $data['ddsm']   ="支付宝交易号:".$parameter['trade_no']."交易状态:".$parameter['trade_status']."通知的发送时间:".$parameter['notify_time']."买家支付宝帐号:".$parameter['buyer_email'];
    $data['passed']=1;
	$data['jyh']=$parameter['trade_no'];
	$data['pay']=1;
	$data['fktime']=date("Y-m-d H:i:s");
    $Ord=M('Dd');
    $Ord->where("ddbh='".$ordid."'")->save($data);
	
	$data=array();
    $data['passed']=1;
	$data['pay']=1;
	$data['fktime']=date("Y-m-d H:i:s");
    $Ord=M('Ddp');
    $Ord->where("ddbh='".$ordid."'")->save($data);
	}
	else{
	$ordid=$parameter['out_trade_no'];
	$price=$parameter['total_fee'];
	$user_id=(int)$cs[1];	
	$Ord1=M('User');
	$pz1=$Ord1->where(' id='.$user_id)->order("id desc")->find();
	if($pz1){
	 $news = M("Jl");
	 $arrjf=array();
     $arrjf['addtime']=date("Y-m-d H:i:s");
     $arrjf['user_id']=$user_id;
     $arrjf['print']=$price;
     $arrjf['text']="支付宝冲值人民币".$price."元";
     $arrjf['qy']=0;
	 $arrjf['lang']=0;
	 $arrjf['printend']=$pz1['discount']+$price;
	 $arrjf['sz']="收入";
	 $arrjf['ordern']=$ordid;
     $news->add($arrjf);
	 $data=array();
	 $data['discount']=$pz1['discount']+$price;
     $Ord=M('User');
     $Ord->where("id=".$user_id."")->save($data);	
	 }  
	}
}

function checkorderstatus1($ordid,$lx){
	$cs=explode("-",$lx);
	$csc=count($cs);
    if($csc==1){
    $Ord=M('Dd');
    $ordstatus=$Ord->where("ddbh='".$ordid."'")->getField('passed');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
	}
	else{
	$Ord=M('Jl');
    $ordstatus=$Ord->where("qy=0 and ordern='".$ordid."'")->order("id desc")->find(); 
    if($ordstatus){
        return true;
    }else{
        return false;    
    }
	}
} 

function orderhandle1($parameter,$lx){
    $cs=explode("-",$lx);
	$csc=count($cs);
    if($csc==1){
    $ordid=$parameter['out_trade_no'];
	$data=array();
    $data['ddsm']   ="银联交易号:".$parameter['trade_no']."交易状态:".$parameter['trade_status']."通知的发送时间:".$parameter['notify_time']."持卡人IP:".$parameter['customerIp']."交易金额:".$parameter['total_fee']."卡号:".$parameter['accNo']."转入账号:".$parameter['bookedAccNo'];
    $data['passed']=1;
	$data['jyh']=$parameter['trade_no'];
	$data['pay']=2;
    $Ord=M('Dd');
    $Ord->where("ddbh='".$ordid."'")->save($data);
	
	$data=array();
    $data['passed']=2;
    $Ord=M('Ddp');
    $Ord->where("ddbh='".$ordid."'")->save($data);
	}
	else{
	$ordid=$parameter['out_trade_no'];
	$price=$parameter['total_fee'];
	$user_id=(int)$cs[1];	
	$Ord1=M('User');
	$pz1=$Ord1->where(' id='.$user_id)->order("id desc")->find();
	if($pz1){
	 $news = M("Jl");
	 $arrjf=array();
     $arrjf['addtime']=date("Y-m-d H:i:s");
     $arrjf['user_id']=$user_id;
     $arrjf['print']=$price;
     $arrjf['text']="银联冲值人民币".$price."元";
     $arrjf['qy']=0;
	 $arrjf['lang']=0;
	 $arrjf['printend']=$pz1['discount']+$price;
	 $arrjf['sz']="收入";
	 $arrjf['ordern']=$ordid;
     $news->add($arrjf);
	 $data=array();
	 $data['discount']=$pz1['discount']+$price;
     $Ord=M('User');
     $Ord->where("id=".$user_id."")->save($data);	
	 }    
	}
} 
?>