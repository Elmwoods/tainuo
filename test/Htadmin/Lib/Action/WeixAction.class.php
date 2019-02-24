<?php
if(!defined("ni8shop")) exit("Access Denied");
class WeixAction extends PublicAction {  

   public function __construct() 
    { 
		 parent::__construct(); 
		 $this->checkuserb();
		 $this->adminlog();	
		 $this->ly=$_SERVER['HTTP_REFERER'];
    } 
	//同步客服微信
	public function kftb(){
	  $access_token=$this->token();
	  $src='https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token='.$access_token;
	  $list=$this->curlget($src);
	  $list = json_decode($list, true);
	  $arr=$list['kf_list'];
	  foreach($arr as $key=>$val){
	    $model=explode("@",$val['kf_account']);
		$title=$this->finds('Kf',"model='".$model[0]."'",'id desc');
		$ar=array();
		if($title){
		  $ar['kf_wx']=$val['kf_wx'];
		  $ar['addTime']=date("Y-m-d H:i:s");
		  $this->save('Kf',$ar,"model='".$model[0]."'");
		}else{
		  $ar['model']=$model[0];
		  $ar['nc']=$val['kf_nick'];
		  $ar['spic']=$val['kf_headimgurl'];
		  $ar['passed']=1;
		  $ar['addTime']=date("Y-m-d H:i:s");
		  $ar['kfpre']="@".$model[1];
		  $ar['kf_wx']=$val['kf_wx'];
		  $this->add('Kf',$ar);
		}
	  }
	  echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	
	//客服管理
	public function kf(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
			    $title=$this->finds('Kf',"id=".$id,'id desc');
				$this->del('Kf','id='.$id);
				//删除客服
				$access_token=$this->token();
				$src="https://api.weixin.qq.com/customservice/kfaccount/del?access_token=".$access_token."&kf_account=".$title['model'].$title['kfpre']."";
				$this->curlget($src);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
		    $title=$this->finds('Kf',"id=".(int)$_GET['id'],'id desc');
			 $this->del('Kf','id='.(int)$_GET['id']);
			//删除客服
			$access_token=$this->token();
			$src="https://api.weixin.qq.com/customservice/kfaccount/del?access_token=".$access_token."&kf_account=".$title['model'].$title['kfpre']."";
			$this->curlget($src);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}

		$where=" ";
		
		$arr=$this->arr('Kf',15,' 1 '.$where,'sort desc,id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
	   $this->display();
	}
	//客服管理
	public function kfd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$da=$this->build_sql($_POST);
			$_POST['addTime']=date("Y-m-d H:i:s");
			$access_token=$this->token();
			if($id){
			  $row=$this->save("Kf",$da,"id=".$id);
			  //修改客服
				$src="https://api.weixin.qq.com/customservice/kfaccount/update?access_token=".$access_token;
				$date=' {
					"kf_account" : "'.$_POST['model'].$_POST['kfpre'].'",
					"nickname" : "'.$_POST['nc'].'",
					"wxname" : "'.$_POST['kf_wx'].'"
				 }';
				 $this->curlpost($date,$src);				
				if(!empty($_POST['spic']) && strpos($_POST['spic'],"http://")==""){
				//上传客服头像
				$src="https://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=".$access_token."&kf_account=".$_POST['model'].$_POST['kfpre'].""; 
				$file=realpath(str_replace("../","","".$_POST['spic']));
				$this->upload_curl_pic($src,$file);				
				}
				//
			}
			else{
			  $row=$this->add("Kf",$da);
			  //添加客服账号
				$src="https://api.weixin.qq.com/customservice/kfaccount/add?access_token=".$access_token;
				$date=' {
					"kf_account" : "'.$_POST['model'].$_POST['kfpre'].'",
					"nickname" : "'.$_POST['nc'].'",
					"wxname" : "'.$_POST['kf_wx'].'"
				 }';
				$this->curlpost($date,$src);
			   if(!empty($_POST['spic'])){
					//上传客服头像
					$src="https://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=".$access_token."&kf_account=".$_POST['model'].$_POST['kfpre'].""; 
					$file=realpath(str_replace("../","","".$_POST['spic']));
					$this->upload_curl_pic($src,$file);
				}
              //
			}
			
			$this->assign('sx',"1");
			$this->display("pub:load");
			exit;
		}
		$id=$_GET['id'];
		$show=$this->finds('Kf',"id=".$id,'id desc');
		$this->assign('show',$show);
		$this->display();
	}
	//6-1
	public function index(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$da=$this->build_sql($_POST);
			$row=$this->save("Weixin",$da,"id=".$id);
			echo "<script>location.href='?err=1';</script>";
			exit;	
		}
		
		$show=$this->finds('Weixin',"id=1",'id desc');
		$this->assign('show',$show);
		$this->display();
	}
	
	//6-1
	public function onegz(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id'];		
			$hidReplyType=$_POST['hidReplyType'];//类型
			$txtReplyWords=$_POST['txtReplyWords'];//文本回复
			$hidNews=$_POST['hidNews'];//多图内容
			//$hidNews=str_replace('\\"','',$hidNews);
			//$hidNews=str_replace('\\','',$hidNews);
			if((empty($txtReplyWords) && empty($hidNews)) or empty($hidReplyType)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($hidReplyType=='text'){
				$nr['style']=0;
				$nr['content']=$txtReplyWords;
			}
			elseif($hidReplyType=='news'){
				$nr['style']=1;
				$nr['content']=$hidNews;
			}	
			$nr['addtime']=date("Y-m-d h:i:s");
			$classid=$this->save("Weixink",$nr,'id='.$id.' and qy=0');
			echo "<script>location.href='?err=1';</script>";
			exit;
		}
		
		$show=$this->finds('Weixink','qy=0','id asc');
		if($show){
		}
		else
		{
			$nr=array();	
			$nr['userid']=1;
			$nr['qy']=0;	
			$id=$this->add('Weixink',$nr);
			$show=$this->finds('Weixink','qy=0','id asc');
		}
		$this->assign('show',$show);
		if($show['style']==1){
			$content=str_replace('\\','',$show['content']);
			$picarr=(json_decode($content,true));
			$this->assign('picarr',$picarr);
		}
		$timestamp = time()	;
		$token=md5('unique_saltartr' . $timestamp);
		$this->assign('timestamp',$timestamp);
		$this->assign('token',$token);
		$this->display();
	}
	//6-1
	public function twogz(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id'];
			
			$hidReplyType=$_POST['hidReplyType'];//类型
			$txtReplyWords=$_POST['txtReplyWords'];//文本回复
			$hidNews=$_POST['hidNews'];//多图内容
			//$hidNews=str_replace('\\"','',$hidNews);
			//$hidNews=str_replace('\\','',$hidNews);
			if((empty($txtReplyWords) && empty($hidNews)) or empty($hidReplyType)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($hidReplyType=='text'){
				$nr['style']=0;
				$nr['content']=$txtReplyWords;
				}
			elseif($hidReplyType=='news'){
				$nr['style']=1;
				$nr['content']=$hidNews;
			}	
			$nr['addtime']=date("Y-m-d h:i:s");		
			$classid=$this->save("Weixink",$nr,'id='.$id.' and qy=1');
			echo "<script>location.href='?err=1';</script>";
			exit;
		}
		
		$show=$this->finds('Weixink','qy=1','id asc');
		if($show){
		}
		else
		{
			$nr=array();	
			$nr['userid']=$this->user['userid'];
			$nr['qy']=1;	
			$id=$this->add('Weixink',$nr);
			$show=$this->finds('Weixink','qy=1','id asc');
		}
		$this->assign('show',$show);
		if($show['style']==1){
			$content=str_replace('\\','',$show['content']);
			$picarr=(json_decode($content,true));
			$this->assign('picarr',$picarr);
		}
		$timestamp = time()	;
		$token=md5('unique_saltartr' . $timestamp);
		$this->assign('timestamp',$timestamp);
		$this->assign('token',$token);
		$this->display();
	}
	//6-1
	public function addlink(){
		$this->display();
	}
	//上传处理6-1
	public function upload(){
		//设置上传目录
		$path = "upfile/";	
		$act=$_GET['act'];
		$timestamp=$_GET['timestamp'];
		$token=$_GET['token'];
		$verifyToken = md5('unique_saltartr' . $timestamp);
		$path = $path.$act.'/';
		if (!file_exists($path))mkdir($path);
		
		$path = $path. 'image/wximg/';
		if (!file_exists($path))mkdir($path);
		
		if (!empty($_FILES)  && $token == $verifyToken) {	
		//得到上传的临时文件流
		$tempFile = $_FILES['Filedata']['tmp_name'];	
		//允许的文件后缀
		$fileTypes = array('jpg','jpeg','gif','png'); 	
		//得到文件原名
		//$fileName = iconv("GB2312","UTF-8",$_FILES["Filedata"]["name"]);
		$fileParts = pathinfo($_FILES['Filedata']['name']);	
		
		if (in_array($fileParts['extension'],$fileTypes)) {
		//新文件名
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $fileParts['extension'];
		
		//文件大小
		$max_size = 512000;	//500kb
		$file_size = $_FILES['Filedata']['size'];
		if ($file_size > $max_size) {
				$data=array();
				$data['success']=0;
				$data['result']="";
				$data['fullurl']="";
				$data['error']="上传文件大小超过限制";
				echo json_encode($data);
				exit;
		}
		
		//移动文件
		$file_path = $path . $new_file_name;
			//最后保存服务器地址
				 
			if (move_uploaded_file($tempFile, $file_path)){
				$data=array();
				$data['success']=1;
				$data['result']="";
				$data['fullurl']="../".$file_path;
				$data['error']="上传成功";
			}else{
				$data=array();
				$data['success']=0;
				$data['result']="";
				$data['fullurl']="";
				$data['error']="上传失败";
			}
		} else {
				$data=array();
				$data['success']=0;
				$data['result']="";
				$data['fullurl']="";
				$data['error']="参数错误";
		}	
		echo json_encode($data);
		}
		else
		{
				$data=array();
				$data['success']=0;
				$data['result']="";
				$data['fullurl']="";
				$data['error']="参数错误";
				echo json_encode($data);
				exit;
		}
		
		//echo "{'success':1,'result':'22','fullurl':'3333','error':'参数有误'}";
	}
	//6-1
	public function keys(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$__EVENTTARGET=$_POST['__EVENTTARGET'];
			$arr=explode("$",$__EVENTTARGET);	
			if($arr[0]=='repList' && $arr[2]=='lbLock'){
				$id=(int)$arr[1];
				$nr=array();
				$nr["passed"]=0;
				$this->save('Weixinkey',$nr,'id='.$id.'');		
			}
			elseif($arr[0]=='repList' && $arr[2]=='lbUnLock'){
				$id=(int)$arr[1];
				$nr=array();
				$nr["passed"]=1;
				$this->save('Weixinkey',$nr,'id='.$id.'');	
			}
			elseif($arr[0]=='repList' && $arr[2]=='lbDelete'){
				$id=(int)$arr[1];
				$this->del('Weixinkey','id='.$id.'');		
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		$arr=$this->arr('Weixinkey','15',' 1',' passed desc, id desc');
		$this->assign('list',$arr['list']);					
		$this->assign('page',$arr['show']);	
		$this->assign('count',$arr['count']);	
		$this->display();
	}
	
	//6-1
	public function keysadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$txtRuleName=$_POST['txtRuleName'];//规则名
			$hidReplyType=$_POST['hidReplyType'];//类型
			$txtReplyWords=$_POST['txtReplyWords'];//文本回复
			$hidKeyword=$_POST['hidKeyword'];//关键字
			//$hidKeyword=str_replace('\\"','',$hidKeyword);
			//$hidKeyword=str_replace('\\','',$hidKeyword);
			$hidNews=$_POST['hidNews'];//多图内容	
			//$hidNews=str_replace('\\"','',$hidNews);
			//$hidNews=str_replace('\\','',$hidNews);
			if((empty($txtReplyWords) && empty($hidNews)) or empty($hidReplyType)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($hidReplyType=='text'){
				$nr['style']=0;
				$nr['content']=$txtReplyWords;
			}
			elseif($hidReplyType=='news'){
				$nr['style']=1;
				$nr['content']=$hidNews;
			}	
			$nr['title']=$txtRuleName;
			$nr['keys']=$hidKeyword;
			$nr['addtime']=date("Y-m-d h:i:s");
			$nr['userid']=1;	
			$classid=$this->add('Weixinkey',$nr);
			$ly=$_POST['ly'];
			echo "<script language='javascript'>location='".$ly."';</script>";
			exit;
		}
		
		$timestamp = time()	;
		$token=md5('unique_saltartr' . $timestamp);
		$this->assign('timestamp',$timestamp);
		$this->assign('token',$token);
		
		$ly=$_SERVER['HTTP_REFERER'];
		$this->assign('ly',$ly);
		
		$this->display();
	}
	//6-1
	public function keysmod(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id'];
			$txtRuleName=$_POST['txtRuleName'];//规则名
			$hidReplyType=$_POST['hidReplyType'];//类型
			$txtReplyWords=$_POST['txtReplyWords'];//文本回复
			$hidKeyword=$_POST['hidKeyword'];//关键字
			//$hidKeyword=str_replace('\\"','',$hidKeyword);
			//$hidKeyword=str_replace('\\','',$hidKeyword);
			$hidNews=$_POST['hidNews'];//多图内容	
			//$hidNews=str_replace('\\"','',$hidNews);
			//$hidNews=str_replace('\\','',$hidNews);
			if((empty($txtReplyWords) && empty($hidNews)) or empty($hidReplyType)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($hidReplyType=='text'){
				$nr['style']=0;
				$nr['content']=$txtReplyWords;
			}
			elseif($hidReplyType=='news'){
				$nr['style']=1;
				$nr['content']=$hidNews;
			}	
			$nr['title']=$txtRuleName;
			$nr['keys']=$hidKeyword;
			$nr['addtime']=date("Y-m-d h:i:s");
			$classid=$this->save('Weixinkey',$nr,'id='.$id.'');
			$ly=$_POST['ly'];
			echo "<script language='javascript'>location='".$ly."';</script>";
			exit;
		}
		$id=(int)$_GET['id'];
		$show=$this->finds('Weixinkey',' id='.$id.'','id desc');
		$this->assign('show',$show);
		$keys=str_replace('\\','',$show['keys']);
		$keys=(json_decode($keys,true));
		$this->assign('keys',$keys);
		
		if($show['style']==1){
			$content=str_replace('\\','',$show['content']);
			$picarr=(json_decode($content,true));
			$this->assign('picarr',$picarr);
		}
		
		$timestamp = time()	;
		$token=md5('unique_saltartr' . $timestamp);
		$this->assign('timestamp',$timestamp);
		$this->assign('token',$token);
		
		$ly=$_SERVER['HTTP_REFERER'];
		$this->assign('ly',$ly);
		
		$this->display();
	}
	//6-1
	public function menu(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$hidAct=(int)$_POST['hidAct'];
		if($hidAct=='1' || $hidAct=='3'){
			$access_token=$this->token();
		}
		if($hidAct=='1'){
		//发布开始
			$menu='';
			$arr=$this->lbmit('Weixmenu','parent=0 ',' sort desc, id desc','0,3');
			$menu='{
			 "button":[';
			foreach($arr as $key=>$value){
				$ifnext=$this->finds('Weixmenu',' parent='.$value['id'].' ','id desc');
				if($ifnext){
					$menu.='{
						   "name":"'.$value['mtitle'].'",
						   "sub_button":[';
					$arr2=$this->lbmit('Weixmenu','parent='.$value['id'].' ',' sort desc, id desc','0,5');
					foreach($arr2 as $key2=>$value2){
							if($value2['content']=="")continue;
							if($value2['style']==2){
								$menu.='{	
								   "type":"view",
								   "name":"'.$value2['mtitle'].'",
								   "url":"'.$value2['content'].'"
								   },';
							}
							else
							{
								$menu.='{
								   "type":"click",
								   "name":"'.$value2['mtitle'].'",
								   "key":"chick_'.$value2['id'].'"
									},';
							}
					}
					if(substr($menu,-1)==',')$menu=substr($menu,0,strlen($menu)-1);
					$menu.=']
						   },';
				}else{
					if($value['style']==2){
						$menu.='{	
						   "type":"view",
						   "name":"'.$value['mtitle'].'",
						   "url":"'.$value['content'].'"
						   },';
					}else{
						$menu.='{
						   "type":"click",
						   "name":"'.$value['mtitle'].'",
						   "key":"chick_'.$value['id'].'"
							},';
						}
				}
		    }
		if(substr($menu,-1)==',')$menu=substr($menu,0,strlen($menu)-1);
		$menu.=']
			   }';
			 //创建菜单
				$src='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
				$jg=$this->curlpost($menu,$src);
				$jg= json_decode($jg,true);
				$jgxs=$jg['errcode'];
				if($jgxs==0){
					$mesg='Successful';
					$cu=1;
				}
				else
				{
					$mesg='Err:'.$jgxs;
					$cu=0;
				}		
		//发布结束
		}
		elseif($hidAct=='3'){
		//停用
			$src="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token;
			$this->curlget($src);
			$mesg='Successful';
			$cu=1;
		}
			$this->redirect('menu',array('mesg'=>$mesg,'cu'=>$cu), 0, '');
			exit;
		}
		
		$meu=array();
		$arr=$this->lbmit('Weixmenu','parent=0',' sort desc, id desc','0,3');
		foreach($arr as $key=>$value){
			$meu1=array();
			$arr1=$this->lbmit('Weixmenu',' parent='.$value['id'].' ',' sort desc, id desc','0,5');
			foreach($arr1 as $key1=>$value1){
				$meu1[]=array("id"=>$value1['id'],"name"=>urlencode($value1['mtitle']));
			}
			if($arr1){
				$meu[]=array("id"=>$value['id'],"name"=>urlencode($value['mtitle']),"hasChilds"=>1,"childs"=>$meu1);
			}
			else
			{
				$meu[]=array("id"=>$value['id'],"name"=>urlencode($value['mtitle']),"hasChilds"=>0);
			}
		}
		$hidTreeJson=urldecode(json_encode($meu));
		$this->assign('hidTreeJson',$hidTreeJson);
		$this->display();
	}
	//6-1
	public function menuadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id'];//名称
			$txtTitle=str_replace('"','',$_POST['txtTitle']);//菜单名称
			$parent=(int)$_GET['parent'];//上级
			$sort=(int)$_POST['sort'];//序号
			if(empty($txtTitle)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($id>0){
				$nr['mtitle']=$txtTitle;
				$nr['sort']=$sort;
				$classid=$this->save('Weixmenu',$nr,'id='.$id.'');
			}
			else{
				$nr['mtitle']=$txtTitle;
				$nr['parent']=$parent;
				$nr['addtime']=date("Y-m-d h:i:s");
				$nr['userid']=1;	
				$nr['sort']=$sort;
				$classid=$this->add('Weixmenu',$nr);
			}
			//$this->redirect('menu',"", 0, '');
			echo '<script>window.parent.location.href ="'.U("menu").'";</script>';
			exit;
		}
		$parent=$_GET['parent'];
		$this->assign('parent',$parent);
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		$this->assign('act',$act);
		if($act=='edit' && !empty($id)){
			$show=$this->finds('Weixmenu',' id='.$id.'','id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}
	//6-1
	public function menudel(){
	$id=(int)$_GET['id'];
	$this->del('Weixmenu','id='.$id.'');
	echo 'ok';
	}
	//6-1
	public function menunr(){	
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id'];
			$hidReplyType=$_POST['hidReplyType'];//类型
			$txtReplyWords=$_POST['txtReplyWords'];//文本回复
			$txtTargetDesc=str_replace('"','',$_POST['txtTargetDesc']);//连接
			$hidSubmit=$_POST['hidSubmit'];
			$hidNews=$_POST['hidNews'];//多图内容	
			//$hidNews=str_replace('\\"','',$hidNews);
			//$hidNews=str_replace('\\','',$hidNews);
			if((empty($txtReplyWords) && empty($hidNews) && empty($txtTargetDesc)) or empty($hidReplyType)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			$nr=array();
			if($hidReplyType=='text'){
				$nr['style']=0;
				$nr['content']=$txtReplyWords;
			}
			elseif($hidReplyType=='news'){
				$nr['style']=1;
				$nr['content']=$hidNews;
			}
			elseif($hidReplyType=='link'){
				$nr['style']=2;
				$nr['content']=$txtTargetDesc;
			}	
			$nr['addtime']=date("Y-m-d h:i:s");
			$classid=$this->save('Weixmenu',$nr,'id='.$id.'');
			echo "<script language='javascript'>alert('保存成功!');location='".$this->ly."';</script>";
			exit;
		}
		$id=(int)$_GET['id'];
		$show=$this->finds('Weixmenu',' id='.$id.'','id desc');
		$this->assign('show',$show);
		if($show['style']==1){
			$content=str_replace('\\','',$show['content']);
			$picarr=(json_decode($content,true));
			$this->assign('picarr',$picarr);
		}
		
		$timestamp = time()	;
		$token=md5('unique_saltartr' . $timestamp);
		$this->assign('timestamp',$timestamp);
		$this->assign('token',$token);
		
		$this->display();
	}
	//6-1
	public function mb(){
	     $wx=$this->finds('Weixin','id=1','id asc');
		 if($wx['moble']==0){
		     $access_token=$this->token();
			 $date='{
              "industry_id1":"1",
              "industry_id2":"4"
             }';
             $src="https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=".$access_token;
		     //$this->curlpost($date,$src);			 
			 //获得模板-订单付款成功
             $mb=$this->lb('Mail_mod',' 1',' id asc',false);
			 foreach($mb as $key=>$val){
			    if(empty($val['template_id'])){
				 $template_id=$this->wmb($val['tm'],$access_token);			
				 $this->save("Mail_mod",array("template_id"=>$template_id),"id=".$val['id']);
				}
			 }		
			 $this->save("Weixin",array("moble"=>1),"id=1");
			 echo "ok";
			 exit;
		 }
		 echo "已经生成了";

	}
	//6-1
	public function wmb($mbid,$access_token){
			 $date='{
						 "template_id_short":"'.$mbid.'"
					 }';
             $src="https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=".$access_token;
             $date= $this->curlpost($date,$src);			 
			 $date=(json_decode($date,true));	
			 return $date['template_id'];
	}
    //6-1
	public function user(){
	    @set_time_limit(0);
		ignore_user_abort(TRUE);
		$access_token=$this->token();
		$hq = (int)$_GET['hq'];
		// 获取关注者列表
		if(empty($hq)){
			$src = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token;
			$getuser = $this->curlget($src);
			$getuser = json_decode($getuser, true);
			$getuser = $getuser['data']['openid'];			
			$i = 1;
			foreach($getuser as $key => $value) {
				 $addtime = date("Y-m-d H:i:s");
				 $msgtime = time();
				 $res=$this->finds("weixuser","openid='" . $value . "' ","id desc");
				 if($res){
					 $this->save("weixuser",array("subscribe"=>1),"openid='" . $value . "'");		    
				 }else {
					$yy = str_replace("-", "", date("Y-m-d"));
					$yy1 = str_replace(":", "", date("H:i:s"));
					$inBillNo = md5($yy . "-" . $yy1).$i;
					$this->add("weixuser",array("openid"=>$value,"addtime"=>$addtime,"subscribe"=>1));		
				 }
				 $i++;
			}
		}
		echo '获取成功!';
		exit;
        // 更新会员
       $ks = intval($_GET['page']);
       if ($ks < 1) $ks = 1;
       $pageSize = 5;
       $start = ($ks-1) * $pageSize;
       $arr=$this->arr('weixuser',$pageSize," 1 and id>0 and (nickname IS NULL or nickname='' or headimgurl='' or headimgurl is NULL) and qy=1",'id desc');
       $row = $arr['count'];//总数量
	   if($_GET['page']){
	     $total=cookie('total');
	   }else{
       $total=$arr['cpage'];//总页数 
	     cookie('total',$total);
	   }      
       $lists = $arr['list']; //查询结果
       if (!empty($lists)) {
	         $i = 1;
	        echo '
			<script>
			function refreshThisPage()
			{
				 window.location.reload();
			}
			</script>
			<center>共有' . $total . '页数据，正在发送第<font color="#ff0000">' . $ks . '</font>页,请稍后...
				<br>如果长时间没有反应，请点<a href="javascript:void(0)" onclick="refreshThisPage()">击此处刷新</a>
			</center>';
	        echo '<center><br><textarea cols="100" rows="20" >';
	        foreach($lists as $rss) {
		        if (empty($rss['nc'])) {
					$src = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $rss['username'] . '&lang=zh_CN';
					$touser = $this->curlget($src);
					$touser = json_decode($touser, true);
					$name = $touser['nickname'];
					$sex = (int)$touser['sex'];
					$sex=($sex==1)?0:1;
					$city = $touser['city'];
					$province = $touser['province'];
					$country = $touser['country'];
					$headimgurl = $touser['headimgurl'];
					
					$wxaddress=$city.$province.$country;
					$name = str_replace("\xF09F92A2", '', $name);
		
					$name = htmlspecialchars($name);
					$name = str_replace("'", "\'", $name); 
		
					$name = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $name); 
					if ($rss['username'] <> 'oQGRyt2u1a4qR0U3y8iZcvfb0qEI1') {
						$this->save("user",array("nickname"=>$name,"sex"=>$sex,"headimgurl"=>$headimgurl,"wxaddress"=>$wxaddress),"username='".$rss['username']. "'");	
						//echo $name."<br>".$sex."<br>".$headimgurl."<br>".$wxaddress."<br>".$rss['username'];
					    //exit;					
						echo '.  ' . $rss['openid'] . '获取成功  ' . $name . ' &#13;&#10;';
					}
		        }
	       }
	        echo '</textarea></center>';
	       if ($total > $ks) {
			   $ks++;
			   echo "<script>
					function gotoNext(){
						window.location.href='".C("web_url").__APP__."/weix_user?page=".$ks ."&hq=1';
	
					}
					setTimeout('gotoNext()',2000);
					</script>";
			   die();
	       }else {
				echo '<center>全部更新完成!</center>';
	       }
		}else {
			echo '<center>暂时无新数据!</center>';
		}		
	}
	//上传文件
	public function upload_curl_pic($url,$file)
	{
	$url  = $url;
	$fields['media'] = '@'.$file;
	$ch = curl_init($url) ;
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	$result = curl_exec($ch) ;
	if (curl_errno($ch)) {
	 return curl_error($ch);
	}
	curl_close($ch);
	return $result;
	} 
	
}
?>