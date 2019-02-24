<?php
if(!defined("ni8shop")) exit("Access Denied");
class GgAction extends PublicAction {
     public function __construct() 
    { 
		 parent::__construct(); 
		 $this->checkuserb();
		 $this->adminlog();	
		 $this->ly=$_SERVER['HTTP_REFERER'];
    }
	
	//6-1
	 public function qy(){
		if(isset($_GET['qy'])){
		if(!empty($_GET['qy'])){
		cookie('qy',(int)$_GET['qy']);
		}
		else
		{
		//cookie('qy',0);
		}
		}
	}
	
	//6-1
	public function advs(){	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Advs','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Advs','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where='';
		if(!empty($_GET['group'])){
			$where.=" and fz='".$_GET['group']."'";
			$this->assign('group',$_GET['group']);
		}
		$arr=$this->arr('Advs',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$farr=$this->fg('Advs',"fz");
		$this->assign('farr',$farr);
		
		$this->display();
	}
	
	//6-1
	public function gadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$name=str_replace('"','',$_POST['name']);	
			if(empty($name)){
				echo "<script language=javascript>alert('名称不能为空!');history.go(-1);</script>";
				exit;
			}
			$_POST['date']=date("Y-m-d H:i:s");
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Advs",$nr,'id='.$id);
			}
			else{
				$this->add("Advs",$nr);
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
			$show=$this->finds("Advs",'id='.$id,'id desc');
			$this->assign('show',$show);	
		}		
		$this->display();
	}
	
	//6-1
	public function advscon(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('advs_con','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('advs_con','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and name like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['group_id'])){
			$where.=" and  	group_id=".$_GET['group_id']."";
			$this->assign('group_id',$_GET['group_id']);
		}
		
		$arr=$this->arr('advs_con',15,' 1 '.$where,'sort desc, id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$farr=$this->lb('Advs',"1","id desc");
		$this->assign('farr',$farr);
		$this->display();
	}	
		
	//6-1
	public function advscond(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();
			$_POST['addtime']=date("Y-m-d H:i:s");	
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Advs_con",$nr,'id='.$id);
			}
			else{
				$this->add("Advs_con",$nr);
			}
			//
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Advs_con",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		
		$farr=$this->lb('Advs',"1","id desc");
		$this->assign('farr',$farr);
		
		$this->display();
	}
	
	//合作伙伴-ni8shop
	public function links(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Link','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Link','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and title like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['passed'])){
			$where.=" and  	passed=".$_GET['passed']."";
			$this->assign('passed',$_GET['passed']);
		}
		
		$arr=$this->arr('Link',15,' 1 '.$where,'sort desc, id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
	
		$this->display();
	}
	
	//编辑合作伙伴-ni8shop
	public function linksd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();
			$_POST['addtime']=date("Y-m-d H:i:s");	
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Link",$nr,'id='.$id);
			}
			else{
				$this->add("Link",$nr);
			}
			//
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Link",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}	
	
	//6-1
	public function email(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Mail_mod','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Mail_mod','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		$this->qy();
		$where="  and id < 5 ";
		if(!empty($_GET['title'])){
			$where.=" and title like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		
	
		
		$arr=$this->arr('Mail_mod',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	//6-1	
	public function emaild(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();
			$_POST['addtime']=date("Y-m-d H:i:s");	
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Mail_mod",$nr,'id='.$id);
			}
			else{
				$this->add("Mail_mod",$nr);
			}
			//
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Mail_mod",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}
	
	//浏览邮件模板-ni8shop
	public function emailv(){
		$pz=array(
		'../' =>C('pic_url'),
		);
		C('TMPL_PARSE_STRING',$pz);
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Mail_mod",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}	
	
	
	//发送邮件/短信-ni8shop
	public function sendemail(){
		$pz=array(
		'__WJ__' =>__ROOT__.'/webfile/admin',
		'../' =>C('pic_url'),
		);
		C('TMPL_PARSE_STRING',$pz);
		$id=(int)$_GET['id'];
		if(!empty($id)){
			$show=$this->finds("Mail_mod",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->arrs=$this->lb('Mail_mod',' 1 and qy=1','id desc');
		$this->vip=C('vip');
		$this->display();
	}	
	
	//搜索会员发送邮件/短信6-1
	public function ss(){
		$isshop=$_GET['isshop'];
		$t=$_GET['t'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		//if($isshop=="" && empty($t))exit;
		$where="";
		if($isshop<>""){
		$where.=" and vip=".$isshop;
		}
		if(!empty($t)){
		$where.=" and username like '%".$t."%'";
		}
		if (!empty($ks) && !empty($js) && $js>$ks){
		   $where=$where." and date_format(regtime,'%Y-%m-%d')>='".$ks."' and date_format(regtime,'%Y-%m-%d')<='".$js."'";
		}
		$rss=$this->lb('user','passed=1 '.$where,'id desc');
		foreach($rss as $rs){
		echo '<option value="'.$rs['id'].'">'.$rs['username'].'</option>';
		}
	}
	//发送邮件/短信-ni8shop
	public function mailsend(){
		@set_time_limit(0);
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$hyid=$_POST['hyid1'];		
		$mtype=$_POST['mtype'];
		$mtitle=$_POST['subject'];
		if (empty($hyid)){
			echo "会员对象不能为空!";
			exit;
		}
		$where='';	
		$prosql=implode(",",$hyid);
		$where.=" and id in($prosql) ";
	
		$mcontent=stripslashes($_POST["mes"]);
		if(!empty($_POST["action"]) && $_POST["action"]=="send" && $mtype==1){
			if (empty($mcontent)){
				echo "邮件内容为空!";
				exit;
			}
			if (empty($mtitle)){
				echo "邮件标题为空!";
				exit;
			}
			echo "<iframe src=\"".C('web_url').__APP__."/gg_mailback.html?limit=0&sqlw=".urlencode($where)."&mailcontent=".urlencode($mcontent)."&mailtitle=".urlencode($mtitle)."\" width='100%' height='100%' frameborder='0' scrolling='yes'></iframe>";
			exit;
		}
		elseif($mtype==2){
		   if (empty($mcontent)){
				echo "短信内容为空!";
				exit;
			}
		echo "<iframe src=\"".C('web_url').__APP__."/gg_mailback1.html?limit=0&sqlw=".urlencode($where)."&mailcontent=".urlencode($mcontent)."&mailtitle=".urlencode($mtitle)."\" width='100%' height='100%' frameborder='0' scrolling='yes'></iframe>";
		exit;
		}
		}
	}
	//群发发送短信
	function mailback1(){
	@set_time_limit(0);
	ignore_user_abort(TRUE);
		$mcontent=urldecode($_GET['mailcontent']);
		$mtitle=urldecode($_GET["mailtitle"]);
		$sqlw=$_GET['sqlw'];
		$limits=(int)$_GET['limit'];
		$limitsa=(int)$_GET['limit'];
		if (empty($mcontent)){
		echo "内容为空!";
		exit;
		}
		if (empty($mtitle)){
		echo "标题为空!";
		exit;
		}
		if (!empty($sqlw)){
		$sqlw=str_replace("\\","",urldecode($sqlw));
		}else{
		$sqlw="";
		}
		
		$arrs=$this->lbmit('User',' 1' .$sqlw,'id desc',$limits.",5");
		$limits=$limits+5;
		$i=1;
		$ntime=time(); 		
		foreach($arrs as $v){
		       if(!$v['moble'])continue;
				$mcontent=stripslashes($mcontent);
				$nickname=($v['nickname'])?$v['nickname']:"尊敬的用户";
				$mcontent=str_replace('[username]',$nickname,$mcontent);
				$this->sendmob($v['moble'],$mcontent);
				echo $v["username"]."&nbsp;&nbsp; sendok<br>";
				$i=$i+1;

			}
			if ($i==6)
				 echo "<script>window.location=\"".C('web_url').__APP__."/gg_mailback1.html?limit=".$limits."&sqlw=".urlencode($sqlw)."&mailcontent=".urlencode($mcontent)."&mailtitle=".urlencode($mtitle)."\";</script>";				 
			 else
			 {
				 $t=$limitsa+$i-1;
				 echo "总发送".$t."条短信";
			}
	}
	//群发发送邮件-ni8shop
	function mailback(){
	    @set_time_limit(0);
		ignore_user_abort(TRUE);
		$mcontent=urldecode($_GET['mailcontent']);
		$mtitle=urldecode($_GET["mailtitle"]);
		$sqlw=$_GET['sqlw'];
		$limits=(int)$_GET['limit'];
		$limitsa=(int)$_GET['limit'];
		if (empty($mcontent)){
		echo "邮件内容为空!";
		exit;
		}
		if (empty($mtitle)){
		echo "邮件标题为空!";
		exit;
		}
		if (!empty($sqlw)){
		$sqlw=str_replace("\\","",urldecode($sqlw));
		}else{
		$sqlw="";
		}
		
		$arrs=$this->lbmit('User',' 1 and email<>""' .$sqlw,'id desc',$limits.",5");
		$limits=$limits+5;
		$i=1;
		$ntime=time(); 		
		foreach($arrs as $v){
		        if(!$v['email'])continue;
				$mcontent=stripslashes($mcontent);
				$nickname=($v['nickname'])?$v['nickname']:"尊敬的用户";
				$mcontent=str_replace('[username]',$nickname,$mcontent);
				//$bday=ceil((time()-$v['lastLoginTime'])/86400);
				$mcontent=str_replace('[sitename]',nl2br($this->webset['emailfoot']),$mcontent);
				$this->sedmail($mtitle,$mcontent,$v['email']);
				echo $v["username"]."&nbsp;&nbsp; To ".$v["email"]."&nbsp;&nbsp; sendok<br>";
				$i=$i+1;

			}
			if ($i==6)
				 echo "<script>window.location=\"".C('web_url').__APP__."/gg_mailback.html?limit=".$limits."&sqlw=".urlencode($sqlw)."&mailcontent=".urlencode($mcontent)."&mailtitle=".urlencode($mtitle)."\";</script>";				 
			 else
			 {
				 $t=$limitsa+$i-1;
				 echo "总发送".$t."条邮件";
			}
	}
	//站内信息6-1
	public function xtmes(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('webmessagetext','id='.$id);
				$this->del('webmessage','textid='.$id);
				$this->del('websysmessag','textid='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
		    $id=(int)$_GET['id'];
			$this->del('webmessagetext','id='.$id);
			$this->del('webmessage','textid='.$id);
			$this->del('websysmessag','textid='.$id);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and title like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		if(!empty($_GET['lx'])){
			$where.=" and lx=".$_GET['lx']."";
			$this->assign('lx',$_GET['lx']);
		}		
		$arr=$this->arr('webmessagetext',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}	
		
	//站内信息
	public function xtmesd(){
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dx=$_POST['dx'];
			$lx=$_POST['lx'];
		    $hyid=$_POST['hyid1'];			
			$mes=$_POST['mes'];	
			$title=$_POST['title'];	
			if (empty($hyid) && $dx==1){
				echo "会员对象不能为空!";
				exit;
			}
			if (empty($mes) || empty($title)){
				echo "发送内容或者标题不能为空!";
				exit;
			}
			$textid=$this->add("webmessagetext",array("lx"=>$lx,"title"=>$title,"content"=>$mes,"addtime"=>date("Y-m-d H:i:s")));
			if($textid){
			   if($dx==0){
			      $this->add("webmessage",array("textid"=>$textid,"lx"=>$lx,"addtime"=>time()));
			   }else{
				  foreach($hyid as $key=>$val){
				    $this->add("webmessage",array("textid"=>$textid,"recid"=>$val,"lx"=>$lx,"addtime"=>time()));	 		  
				  }
			   }
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
			$show=$this->finds("webmessagetext",'id='.$id,'id desc');				
			$this->assign('show',$show);
			$this->display("xtmes1");	
		}else{
			$this->vip=C('vip');
			$this->display();
		}
	}
}
?>