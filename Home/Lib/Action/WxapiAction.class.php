<?php
if(!defined("ni8")) exit("Access Denied");
class WxapiAction extends PublicAction {
public function __construct(){ 
     parent::__construct();	
}	
//自动获取会员信息
public function index(){
	  $this->yescheckuser();
	  $dqlink=urlencode(str_replace("/index.php","",'http://'.$_SERVER['SERVER_NAME'].(($_SERVER["SERVER_PORT"]!=80)?':'.$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"]));
	  $sq=$this->finds('Weixin','id=1','id desc');
	  if (!isset($_GET['code']))
 	 {
		 $wxurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$sq['appid']."&redirect_uri=".$dqlink."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
		 Header("Location: $wxurl");
		 redirect($wxurl, 5, '页面跳转中...');
     }
     else
 	 {
		$state=$_GET['state'];
		$code=$_GET['code'];
		$appid=$sq['appid'];
		$appsecret=$sq['appsecret'];
	 
		$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
		$access_token=$this->curlget($url);
		$access_token= json_decode($access_token,true);
		$access_token1=$access_token['access_token'];
		$refresh_token=$access_token['refresh_token'];
		$openid=$access_token['openid'];
		$scope=$access_token['scope'];
 
		$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token1.'&openid='.$openid.'&lang=zh_CN';
		$getuser=$this->curlget($url);
		$getuser= json_decode($getuser,true);
		$openid=$getuser['openid'];
		$nickname=$getuser['nickname'];
		$sex=$getuser['sex'];
		$province=$getuser['province'];
		$city=$getuser['city'];
		$country=$getuser['country'];
		$headimgurl=$getuser['headimgurl'];
     
		$isdl=$this->finds('User',"username='".$openid."' and qy=1",'id desc');
		if($isdl){
			if($isdl['passed']==0){
			echo '对不起,会员登录正在维护中!';
			exit;
			}
			$gxnr=array();
			$gxnr['LastLoginTime']=date("Y-m-d H:i:s");
			$gxnr['LoginTimes']=$isdl['LoginTimes']+1;
			$this->save('User',$gxnr,"username='".$openid."'");
			if($this->wxset['ismob']==1 && empty($isdl['moble'])){
			   cookie("hyid",$isdl['id']);
			   $this->redirect('member/mob',"", 0, '');				
			}else{			
			   $_SESSION['user_id']=$isdl['id'];
			   $this->sess->update_user_info('user');	
			   //$this->redirect('member/index',"", 0, '');
			   redirect(urldecode(cookie('lylogin')));			  
			}
				
 	   }else{
			if($openid){
				$yy=str_replace("-","",date("Y-m-d"));
				$yy1=str_replace(":","",date("H:i:s"));				
				$inBillNo=md5($yy."-".$yy1);
				$sex=($sex==1)?0:1;
				$gxnr=array();
				$gxnr['codee']=$inBillNo;
				$gxnr['username']=$openid;
				$gxnr['nickname']=$nickname;
				$gxnr['LastLoginTime']=date("Y-m-d H:i:s");
				$gxnr['LoginTimes']=1;
				$gxnr['passed']=1;
				$gxnr['regtime']=date("Y-m-d H:i:s");
				$gxnr['sex']=$sex;
				$gxnr['wxaddress']=$province.$city.$country;				
				$gxnr['headimgurl']=$headimgurl;
				$gxnr['qy']=1;
				$tgcode=cookie('tgcode');
			    if($this->webset['fs']==1 && !empty($tgcode)){	
					$tjuser = $this->find('user', " codee='".$tgcode."' ", 'id asc');
					$arr=$this->usertj((int)$tjuser["id"]);
					$gxnr['prv_id'] = (int)$arr['prv_id'];
					$gxnr['prv_link'] = $arr['prv_link'];				
				}
						
				$hyid=$this->add('User',$gxnr);
				cookie('tgcode',NULL);
				if($this->wxset['ismob']==1){
			       cookie("hyid",$hyid);
			      $this->redirect('member/mob',"", 0, '');				
			    }else{			
			       $_SESSION['user_id']=$hyid;
			       $this->sess->update_user_info('user');	
				   //$this->redirect('member/index',"", 0, '');
				   redirect(urldecode(cookie('lylogin')));		  
			    }
			
                
				
	        } 
			else{
			    $this->redirect('index/index',"", 0, '');
			}
 	   }
 	
 	}
}   


	
}
?>