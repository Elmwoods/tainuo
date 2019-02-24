<?php
if(!defined("ni8shop")) exit("Access Denied");
class PublicAction extends Action{
    //6-1
    public function _initialize(){
        bcscale(2);
		  define('ROOT_PATH', str_replace('PublicAction.class.php', '', str_replace('\\', '/', __FILE__)));
		  import('Common.menu',APP_PATH,'.php');
		  $this->mem=$GLOBALS["mem"];
		  import('Common.Csession',APP_PATH,'.php');
		  $this->sess = new cls_session();
		  $this->sess->session('admin_sessions');
	
		  import('Common.Sqlin',APP_PATH,'.php');
		  $dbsql=new sqlin();	
	
		  import('Common.send_mail',APP_PATH,'.php');
		  $this->webset=$this->finds('Web','id=1','id desc',true);	
		  $this->wset=explode("$$",$this->webset['wset']);//其他设
		  $this->sm = new smail($this->webset['emailuser'],$this->webset['emailpsw'], $this->webset['stmpemail']);
			
		  import("ORG.Util.String");
		  if (!empty($_SESSION['admin_id'])){		
			  $this->user=$this->sess->get_user_info('admin');
			  $group=$this->finds("Admin_group","group_id=".$this->user['group_id']."",'group_id desc',true);	
			  $this->dj=$group['group_name'];
			  $this->usergroup=explode(",",$group['group_perms']);
		  }	 
 
	}	
	
	//6-1
	public function checkuserb(){
		if(empty($_SESSION['admin_id']) && ACTION_NAME!='upload'){
			echo '<script>alert("登陆后台失效或时间超时，请重新登陆!");parent.window.location.href="'.U("Index_index").'";</script>';
			exit;
		}
		
		if(ACTION_NAME!='filedel' && ACTION_NAME!='emailv' && ACTION_NAME!='upload'  && ACTION_NAME!='menudel' && ACTION_NAME!='remind'){
			echo '<script>if (window.top == window){window.top.location.href ="'.U("Index_index").'";}</script>';
		}
    }
	
	//6-1
	public function finds($date,$where='',$sort='sort desc',$ca=false){
		  $news = M($date);
		   if($ca){
			  $arr=$news->cache(true)->where($where)->order($sort)->find();
		   }
		  else{
			  $arr=$news->where($where)->order($sort)->find();
			//   echo $news->getLastSql();
		  }
		  return $arr;
    }
	
	//6-1
	public function save($date,$arr,$where='id=1'){
		  $news = M($date);
		  return $news->where($where)->save($arr);
    } 
	
	//6-1
	public function add($date,$arr){
		  $news = M($date);
		  return $news->add($arr);
    } 
	
	//6-1
	public function arr($date,$fy,$where='',$order='sort desc',$ca=false){
		  $arr=array();
		  $news = M($date);
		  import('ORG.Util.Page');// 导入分页类
		  if($ca){
			  $count=$news->cache(true)->where($where)->count();//获取数据的总数
		  }
		  else
		  {
			   $count=$news->where($where)->count();//获取数据的总数
		  }
		  $page  = new Page($count,$fy);
		   if($ca){
			   $arrs=$news->cache(true)->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		   }
		   else
		   {
			   $arrs=$news->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		  }
		  //echo $news->getLastSql();
		  $arr['list']=$arrs;
		  import('Common.Pages',APP_PATH,'.php');
		  $web_page=new Pager($count,$fy,(int)$_GET['page']);
		  $arr['show']=$web_page->pagenr;
		  $arr['count']=$count;
		  $arr['cpage']=$page->totalPages;
		  return $arr;
    } 
    public function joinarr($date,$fy,$field,$where='',$order='sort desc',$join,$ca=false,$is_flag=false){
		$arr=array();
		$news = M($date);
		import('ORG.Util.Page');// 导入分页类
		if($ca){
			$count=$news->cache(true)->where($where)->join($join)->count();//获取数据的总数
			$sum=$news->cache(true)->where($where)->join($join)->sum('amount');//获取红包总数
		}
		else
		{
			$count=$news->where($where)->join($join)->count();//获取数据的总数
			$sum=$news->where($where)->join($join)->sum('amount');//获取红包总数
		}
		$page  = new Page($count,$fy);
		if($ca){
			$arrs=$news->cache(true)->field($field)->join($join)->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		}
		else
		{
			$arrs=$news->where($where)->field($field)->join($join)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		} 
		
		if($is_flag){
			$xd_sum = $news->cache(true)->where($where)->join($join)->sum('num');//获取下单总数			
			$arr['xd_sum']=$xd_sum;
		}
		
		// echo $news->getLastSql();
		$arr['list']=$arrs;
		import('Common.Pages',APP_PATH,'.php');
		$web_page=new Pager($count,$fy,(int)$_GET['page']);
		$arr['show']=$web_page->pagenr;
		$arr['count']=$count;
		$arr['sum']=$sum;
		$arr['cpage']=$page->totalPages;
		return $arr;
	} 
    public function gjarr($date,$fy,$field,$where='',$order='sort desc',$join,$group,$ca=false){
		  $arr=array();
		  $news = M($date);
		  import('ORG.Util.Page');// 导入分页类
		  $sql = $news->where($where)->field($field)->group($group)->join($join)->order($order)->buildSql();
		  if($ca){
			  $count=$news->cache(true)->table($sql.' a')->count();//获取数据的总数
		  }
		  else
		  {
			  $count=$news->table($sql.' a')->count();;//获取数据的总数
		  }
		  $page  = new Page($count,$fy);
		   if($ca){
			   $arrs=$news->cache(true)->field($field)->group($group)->join($join)->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		   }
		   else
		   {
			   $arrs=$news->where($where)->field($field)->group($group)->join($join)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
		  }
		  // echo $news->getLastSql();
				  
		  $arr['list']=$arrs;
		  import('Common.Pages',APP_PATH,'.php');
		  $web_page=new Pager($count,$fy,(int)$_GET['page']);
		  $arr['show']=$web_page->pagenr;
		  $arr['count']=$count;
		  $arr['cpage']=$page->totalPages;
		  return $arr;
    } 
	
	//6-1
	public function lb($date,$where='',$sort='sort desc',$ca=false){
		  $arrs=array();
		  $news = M($date);
		  if($ca){
			   $arrs=$news->cache(true)->where($where)->order($sort)->select();
		   }
		   else
		   {
			  $arrs=$news->where($where)->order($sort)->select();
		  }
		  return $arrs;
    } 
	//6-1
	public function delall($date){
		  $news = M();
		  return $news->execute("truncate table ".C("DB_PREFIX").$date."");
    } 
	//数据列表个数-ni8shop
	public function lbmit($date,$where='',$sort='sort desc',$limit,$ca=false){
		  $arrs=array();
		  $news = M($date);
		  if($ca){
			  $arrs=$news->cache(true)->where($where)->order($sort)->limit($limit)->select();
		  }
		  else
		  {
			  $arrs=$news->where($where)->order($sort)->limit($limit)->select();
		  }
		  return $arrs;
    }
	 	
	//6-1
	public  function build_sql($data){
		$temp=array();
		if(!is_array($data)) return false;
		foreach ($data as $key=>$v)
		{
			if(substr($key,0,-4)!= "_not"){
				if(substr($key,-4) == "_int"){
					$temp[substr($key,0,strlen($key)-4)]=abs((int)$v);
				}elseif(substr($key,-2) == "_f"){
					$temp[substr($key,0,strlen($key)-2)]=abs((float)$v);
				}elseif(substr($key,-5) == '_time'){
					  if($v!=''){
						  $temp[substr($key,0,strlen($key)-5)]=$v;
					  }
					  else
					  {
						  $temp[substr($key,0,strlen($key)-5)]=date("Y-m-d H:i:s");
					  }			
				}elseif(substr($key,-6) == '_times'){
					  if($v!=''){
						  $temp[substr($key,0,strlen($key)-6)]=$v;
					  }
					  else
					  {
						  $temp[substr($key,0,strlen($key)-6)]=time();
					  }			
				}else{
					//转义内容里的特殊字符
					//$v = addslashes($v);
					$v = str_replace("\'","'",$v);
					$v = str_replace("'","\'",$v);
					$temp[$key]=$v;
	
				}
			}
	
		}
			return $temp;
    }
	
	//6-1
	public function del($date,$where=''){
		$news = M($date);
		echo $news->getLastSql();
		return $news->where($where)->delete();
    } 
	
	//6-1
	 public function adminlog(){
		 $script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
		 $sctiptName = array_pop($script_tmp);
			$p=NULL;
			if(!empty($_POST)&&is_array($_POST))
			{
				foreach($_POST as $v)
				{
					if(is_array($v)){
						$p.=implode(",",$v);
						}
					else{
						$p.=','.$v;
						}
				}
			}
			
			if($p!=''){
				$p=$this->csubstr($_SERVER['REQUEST_URI'].'&post='.$p,0,50);
			}
			else{
				$p=$this->csubstr($_SERVER['REQUEST_URI'],0,50);
			}
			$p=htmlspecialchars($p);
			
			$nrr=array();
			$nrr['user']=$this->user['username'];
			$nrr['scriptname']=$sctiptName;
			$nrr['url']=$p;
			$nrr['time']=time();
			$show=$this->finds("Admin_log","user='".$this->user['username']."' and url='".$p."'",'id desc');	
			if($show){
				if($this->user['adminjb']==0)$this->save("Admin_log",$nrr,"id=".$show['id']);
			}
			else{
				if($this->user['adminjb']==0)$this->add("Admin_log",$nrr);
			}
	}
	
	//邮件发送-ni8shop
	public function sedmail($title,$content,$tomail){
		$subject="=?UTF-8?B?".base64_encode($title)."?=";
		$content = $content;	
		if($this->webset["mails"]==1){	
			$end = $this->sm->send($tomail,"".$this->webset['company']."<".$this->webset['postemail'].">", "{$subject}", "{$content}" );
		}		
	}
	
	//删除文件-ni8shop
	public function delFile($file) {
		  if ( !is_file($file) ) return false;
		  @chmod($file, 0777);
		  @unlink($file);
		  return true;
    }
	
    //6-1
	public function _empty(){
		echo "<script language=javascript>history.go(-1);</script>";
		exit;
	}
	
	//6-1
	public function fg($date,$group,$ca=false,$where=''){
		  $arrs=array();
		  $news = M($date);
		  
		  if($ca){
			   $arrs=$news->cache(true)->where($where)->field("count(*) as count,".$group."")->group($group)->select();
		   }
		   else
		   {
			   $arrs=$news->where($where)->field("count(*) as count,".$group."")->group($group)->select();
		  }
		  return $arrs;
    }
	
	//6-1
	public function setF($date,$where='id=1',$Field,$sj){
		$Form = M($date); 
		$Form->where($where)->setField($Field,$sj);
    } 
	//发送短信-ni8shop
	public function sendmob($mobile,$content){
		$content = $content;	
		if($this->webset["dx_passed"]==1){	
			$uid =$this->webset["dx_user_name"];//用户账户
			$pwd =$this->webset["dx_password"];//用户密码
			$mobno = $mobile;//发送的手机号码,多个请以英文逗号隔开如"138000138000,138111139111"
			$content = $content.$this->webset["dxqm"];//发送内容
			$otime = '';//定时发送,暂不开通,为空
			$client = new SoapClient("http://service2.winic.org:8003/Service.asmx?WSDL");
			$param = array('uid' => $uid,'pwd' => $pwd,'tos' => $mobno,'msg' => $content,'otime'=>$otime);
			$result = $client->__soapCall('SendMessages',array('parameters' => $param));
                        dump($result);
		}		
   }
	
	//get传值-ni8shop
	public function curlget($src){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $src);
		curl_setopt($ch, CURLOPT_HEADER,FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		$Infos = curl_exec($ch);
		if (curl_errno($ch)) {
		return curl_error($ch);
		}
		curl_close($ch);
		return $Infos;
	}
	
   //post传值-ni8shop
	public function curlpost($data,$src){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $src);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		$Infos = curl_exec($ch);
		if (curl_errno($ch)) {
		return curl_error($ch);
		}
		curl_close($ch);
		return $Infos;
	}
	
	//6-1
	public function cthree($date,$where=''){
		$cone=array();	
		$class1=$this->lb($date,'class_name_cn<>"" and prv_id=0'.$where,'sort desc,classid desc');
		foreach($class1 as $key1=>$val1){
			$classlist2=array();
			$class2=$this->lb($date,'class_name_cn<>"" and prv_id='.$val1["classid"].''.$where,'sort desc,classid desc');
			foreach($class2 as $key2=>$val2){
				$class3=$this->lb($date,'class_name_cn<>"" and prv_id='.$val2["classid"].''.$where,'sort desc,classid desc');	
				array_push($val2,$class3); 
				$classlist2[]=$val2;
			}	
			array_push($val1, $classlist2);
			$cone[]=$val1;
		}
		$this->cone=$cone;
	}
	//获取数据统计-ni8shop
	public function tj($date,$where='',$ca=false){
		  $news = M($date);
		  if($ca){
			   $count=$news->cache(true)->where($where)->count();//获取数据的总数	
		  }
		  else
		  {
			  $count=$news->where($where)->count();//获取数据的总数	 
		  }
		  return $count;
    } 
	
	//截取字符-ni8shop
	public function csubstr($string, $start, $length, $dot = ' ...'){   
		if(strlen($string) <= $length) {
			return $string;
		}
		$string = str_replace(array('&nbsp;','&amp;', '&quot;', '&lt;', '&gt;'), array(' ','&', '"', '<', '>'), $string);
		$strcut = '';
			$n = $tn = $noc = 0;
			while($n < strlen($string)) {
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1; $n++; $noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2; $n += 2; $noc += 2;
				} elseif(224 <= $t && $t <= 239) {
					$tn = 3; $n += 3; $noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4; $n += 4; $noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5; $n += 5; $noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6; $n += 6; $noc += 2;
				} else {
					$n++;
				}
				if($noc >= $length) {
					break;
				}
			}
			if($noc > $length) {
				$n -= $tn;
			}
			$strcut = substr($string, 0, $n);
			return $strcut;	
	}
	
	//获取单独字段-ni8shop
	public function getf($date,$where='',$sort='sort desc',$setfi='id',$ca=false){
		  $news = M($date);
		  if($ca){
			  $arr=$news->cache(true)->where($where)->order($sort)->getField($setfi);
		  }
		  else
		  {
			  $arr=$news->where($where)->order($sort)->getField($setfi);
		  }
		  return $arr;
    }
	
	//订单统计-ni8shop
	public function finds22($date,$where='',$sort='sort desc',$ca=false)
    {
	  $f="sum(zhprice) as count";
	  $news = M($date);
       if($ca){
	  $arr=$news->cache(true)->where($where)->field($f)->order($sort)->find();
	  }
	  else{
      $arr=$news->where($where)->field($f)->order($sort)->find();
	  //echo $news->getLastSql();
	  }
	  return $arr;
    }
	//ni8shop
	public function finds33($date,$where='',$sort='sort desc',$fs,$ca=false)
    {
	  $f="sum(".$fs.") as count";
	  $news = M($date);
       if($ca){
	  $arr=$news->cache(true)->where($where)->field($f)->order($sort)->find();
	  }
	  else{
      $arr=$news->where($where)->field($f)->order($sort)->find();
	  //echo $news->getLastSql();
	  }
	  return $arr;
    }
	
	//二级列表-ni8shop
	public function cthree2($date,$where=''){
		$cone=array();	
		$class1=$this->lb($date,'class_name_cn<>"" and prv_id=0'.$where,'sort desc,classid desc');
		foreach($class1 as $key1=>$val1){
			$class2=$this->lb($date,'class_name_cn<>"" and prv_id='.$val1["classid"].' '.$where,'sort desc,classid desc');
			if($class2){
			array_push($val1, $class2);
			$cone[]=$val1;
			}
		}
		$this->cone=$cone;
	}	
	//更新字段-ni8shop
	public function update($date,$where='id=1',$file,$sl)
		{
		  $news = M($date);
		  return $news->where($where)->setInc($file,$sl); 
	} 
	//减少-ni8shop
	public function update1($date,$where='id=1',$file,$sl)
		{
		  $news = M($date);
		  return $news->where($where)->setDec($file,$sl); 
	} 
	
	//分组排序-ni8shop
	public function fggetf($date,$group,$file,$sort,$limit,$where="",$ca=false){
		  $arrs=array();
		  $news = M($date);
		  
		  if($ca){
			   $arrs=$news->cache(true)->where($where)->field("count(*) as count,".$file."")->group($group)->order($sort)->limit($limit)->select();
		   }
		   else
		   {
			   $arrs=$news->where($where)->field("count(*) as count,".$file."")->group($group)->order($sort)->limit($limit)->select();
		  }
		  return $arrs;
    } 
	//获取token-ni8shop
    public function token(){
	$sq=$this->finds('Weixin','id=1','id desc');
	$this->appid=$sq['appid'];
	$this->appsecret=$sq['appsecret'];
	$this->gxtime=$sq['gxtime'];
	$this->times=time();
	$this->access_token=$sq['access_token'];
	if(empty($this->appid) || empty($this->appsecret)){
	$gtoken="";
	echo "<script language=javascript>alert('微信配置信息不完整!');history.go(-1);</script>";
	exit;
	}
	else{
	$sjx=$this->gxtime+7000;
	if(empty($this->access_token) || $sjx<($this->times)){
	
	 $src='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
	 $token=$this->curlget($src);
	 $token= json_decode($token,true);
     $gtoken=$token['access_token'];
	 $nr=array();
	 $nr['access_token']=$gtoken;
	 $nr['gxtime']=$this->times;
	 $this->save('weixin',$nr,"id=1");//1
	
	}
	else{
	$gtoken=$this->access_token;
	}
	
	}
	return $gtoken;
	}
	//end 
	


	
	
	



 

	


	
	
	
	

	
	
	
	
	




	

	

	

	public function regions($id){
	  $arrs=array();
	  $news = M('Region');
      $arrs=$news->where('parent_id='.$id)->order('region_name_en asc')->select();
	  return $arrs;
    }



	

	public function province(){
	$province=$this->lb('Region','parent_id=1','id asc',true);
	$sf="";
	$sflist=array();
	foreach($province as $key=>$val){
	$sf.=$val["region_name"].','.$val["id"].',';
	$class2=$this->lb('Region','parent_id='.$val["id"].'','id asc',true);
	array_push($val, $class2); 
	$sflist[]=$val;	
	}
	$sf=substr($sf,0,strlen($sf)-1);
	$this->sf=$sf;
	$this->sflist=$sflist;
	}

	public function classfl($date){
	$classone=$this->lb($date,'prv_id=0','sort desc,classid desc');
	$this->classone=$classone;
	$classtwo=$this->lb($date,'prv_id>0','sort desc,classid desc');
	$this->classtwo=$classtwo;
	}
	//关联会员ID-ni8shop
	public function userstr($userid){
		$userstr = '';
		$user=$this->finds("User",'id='.$userid,'id desc');		
		$userstr = $user['id'];
		if (!empty($user['glid'])) {
			$userstr .= ','.$user['glid'];
		}
		return $userstr;
    }
	//获取关联PC帐户-ni8shop
	public function userstrpc($userid){
		$userstr = '';
		$user=$this->finds("User",'id='.$userid,'id desc');				
		 if (!empty($user['glid'])) {
			$gluser=$this->finds("User",'id='.$user['glid'].' and qy=0','id desc');	
			if($gluser){
			    $glid=$gluser['id'];								
			}
			else{
				 $glid=$user['id'];
			}			
		  }
		  else{
				$glid=$user['id'];
		  }
		return $glid;
    }
	//快递查询-ni8shop
    public function kd100($code,$wldh){  
      $post_data = array();
        $post_data["user"] = $this->webset['KUAIDI_APP_CODE'];
        $post_data["psw"] = $this->webset['KUAIDI_APP_KEY'];
        $post_data["code"] = $code;
        $post_data["wldh"] = $wldh;
        $url='http://www.ni8.net.cn/kdapi.html';
        $o="";
        foreach ($post_data as $k=>$v)
        {
            $o.= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
        }
        $post_data=substr($o,0,-1);
        $wlxx=$this->curlpost($post_data,$url);
        $wlxx=json_decode($wlxx,true);
		
        return $wlxx;
} 
//微信推送发送信息-ni8shop
public function fsxx($id,$mess,$tpid,$lx=0){
        $wxuser=$this->finds('User'," id=".$id." and passed=1 and qy=1 ",'id desc');
		if($wxuser){
		if($lx==1){
		   $url=C('web_url').__APP__."/member";
		}elseif($lx==2){
		   $url=C('web_url').__APP__."/member_thh";
		}else{
		   $url=C('web_url').__APP__."/member_order";
		}
		   $url=str_replace("htni8","wz",$url);		   
		   $this->wxts($wxuser['username'],$url,$tpid,$mess);
		}
}	
public function wxts($openid,$url,$id,$mess){
    $dx=$this->finds('Mail_mod',"id=".(int)$id,'id desc');	
	if(!$dx){
	   return false;
	}	
	$data = sprintf($dx['wxmessage'],$mess[0],$mess[1],$mess[2],$mess[3],$mess[4],$mess[5],$mess[6],$mess[7],$mess[8],$mess[9],$mess[10]);	
	$data=json_decode($data,true);	
    $this->doSend($openid,$dx['template_id'],$url,$data);
}
public function doSend($touser,$template_id,$url,$data,$topcolor = '#173177'){ 
        $template = array(
            'touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $json_template = json_encode($template);		
		$access_token=$this->token();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=". $access_token;
        $dataRes = $this->curlpost(urldecode($json_template),$url);
		$log = (is_array($dataRes) and !empty($dataRes)) ? http_build_query($dataRes) : $dataRes;		
        if ($dataRes['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
}	

//公共发送信息6-1
public function sendinfo($mobile,$mess,$id){
    $dx=$this->finds('Mail_mod',"id=".(int)$id,'id desc');
	if($dx){	    
		if(is_numeric($mobile) && preg_match("/1[345678]{1}\d{9}$/",$mobile)){
			$textTpl=$dx['message'];
			$textTpl=str_replace(array("{","}"),array("",""),$textTpl);
			$content = sprintf($textTpl,$mess[0],$mess[1],$mess[2],$mess[3],$mess[4],$mess[5],$mess[6],$mess[7],$mess[8],$mess[9],$mess[10]);
			$this->sendmob($mobile,$content);
		}elseif(filter_var($mobile, FILTER_VALIDATE_EMAIL)){
		    $textTpl=$dx['yjmessage'];
			$textTpl=str_replace(array("{","}"),array("",""),$textTpl);
			$content = sprintf($textTpl,$mess[0],$mess[1],$mess[2],$mess[3],$mess[4],$mess[5],$mess[6],$mess[7],$mess[8],$mess[9],$mess[10]);
		    $content=$content."<br><br>".nl2br($this->webset['emailfoot']);
		    $this->sedmail($dx['title'],$content,$mobile);
		}
		else{		    
		    $this->fsxx($mobile,$mess,$id,0);
		}
	}
}
//提现
public function txpay($userid,$price){
    echo "等待接口介入";
}
//微信退款
public function tpay($order,$price,$jyh){
	    vendor('Wxpay.Wxpaypubhelper');
		vendor('Wxpay.Sddkruntimeexception');
		vendor('Wxpay.Wxpayconfig');
		
		$xx=$this->finds("Pay","passed=1 and  id=2 ",'id desc');
		$pz=$xx['pz'];
		$pz=explode("||",$pz);	
		$payconf = new WxPayConf_pub();
		WxPayConf_pub::$addid=$pz[0];
		WxPayConf_pub::$mchid=$pz[2];
		WxPayConf_pub::$key=$pz[3];
		WxPayConf_pub::$appsecret=$pz[1];
	
		
		$out_trade_no = $order;
		$transaction_id = $jyh;
	    $refund_fee = $price*100;		
		$total_fee = $price*100;
		//$refund_fee = 1;		
		//$total_fee = 1;
		if(!empty($transaction_id)){		
			$transaction_id = $transaction_id;
			$total_fee = $total_fee;
			$refund_fee = $refund_fee;
			$input = new Refund_pub();
			$input->setParameter("transaction_id",$transaction_id);
			$input->setParameter("out_refund_no",WxPayConf_pub::$mchid.date("YmdHis"));
			$input->setParameter("total_fee",$total_fee);
			$input->setParameter("refund_fee",$refund_fee);		
			$input->setParameter("op_user_id",WxPayConf_pub::$mchid);
			$unifiedOrderResult = $input->getResult();			
			return $unifiedOrderResult;
		}
	}
public function dchead($file){
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");   
		header("Pragma: public");
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");  
		header("Content-Disposition: attachment;filename=".$file.".xls "); 
		header("Content-Transfer-Encoding: binary "); 
}
//写日记6-1
public function  log_resultall($word) {
	$logfile = 'log/pay_send_'.date('Y_m_d').'.txt';
	$fp = fopen($logfile, "a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"执行日期: ".strftime("%Y-%m-%d %H:%M:%S",time())." == \r\n".$word."\r\n\r\n");
	flock($fp, LOCK_UN);
	fclose($fp);
} 
//随机数6-1
public function randStr($len=6,$chars) {  
	$chars='ABDEFGHJKLMNPQRSTVWXYabdefghijkmnpqrstvwxy0123456789';
	//mt_srand((double)microtime()*1000000*getmypid());
	$password='';  
	while(strlen($password)<$len)  
	$password.=substr($chars,(mt_rand()%strlen($chars)),1);  
	return $password; 
}
}
?>