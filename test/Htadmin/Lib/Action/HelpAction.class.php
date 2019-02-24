<?php
if(!defined("ni8shop")) exit("Access Denied");
class HelpAction extends PublicAction {
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
	public function newsclass(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			foreach($_POST['ordernum'] as $key=>$val){
				$this->setF('Typepnews','classid='.$key,'sort',$val);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		$this->qy();
		$this->cthree("Typepnews",' and qy='.cookie('qy').'');
		$this->assign('classlist',$this->cone);
		
		$classid=(int)$_GET['classid'];
		$show=$this->finds("Typepnews",'classid='.$classid,'classid desc');
		$this->assign('link_id',$show['link_id']);	
		
			
		$this->assign('kzname',newsqy(cookie('qy')));
		$this->assign('kzdj',newsdj(cookie('qy')));
		
		$this->display();
	}
	//6-1
	public function pclassadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$prv_id=(int)$_POST['prv_id'];
			$nr=array();
			$_POST['addtime']=date("Y-m-d H:i:s");	
			$nr=$this->build_sql($_POST);
			if($id>0){
				$cla=$this->save("Typepnews",$nr,'classid='.$id);
				$classid=$id;
			}
			else{
				$classid=$this->add("Typepnews",$nr);
			}
			//
			if(empty($prv_id)){
				$all_id=$classid;
				$templink="|".$classid."|";
			}
			else
			{	
				$sq=$this->finds("Typepnews",'classid='.$prv_id,'sort desc,classid desc');
				if($sq){
					$all_id=$sq['all_id'];
					$temp=$sq['link_id'];
				}
				else{
					$all_id=0;
					$temp="";
				}
				$templink=($temp=="")?"|".$classid."|":$temp.$classid."|";
			}
			
			$nr=array();
			$nr["all_id"]=$all_id;
			$nr["link_id"]=$templink;
			$this->save("Typepnews",$nr,'classid='.$classid);
			$this->assign('classid',$classid);
			$this->assign('action',"help_newsclass");
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		$dj=(int)$_GET['dj'];
		$prv=(int)$_GET['prv'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Typepnews",'classid='.$id,'sort desc,classid desc');
			$this->assign('show',$show);
		}
		if(!empty($prv)){
			$prvs=$this->finds("Typepnews",'classid='.$prv,'sort desc,classid desc');
			$this->assign('prvname',$prvs["class_name_cn"]);
		}
		else
		{
			$this->assign('prvname',"顶级目录");
		}
		$this->assign('dj',$dj);
		$this->assign('prv',$prv);		
			
		$this->assign('ispic',newspic(cookie('qy')));
		
		$this->display();
	}
	//6-1
	public function news(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('pnews','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('pnews','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		$this->qy();
		$this->cthree("Typepnews",' and qy='.cookie('qy').'');
		$where=" and qy=".cookie('qy')."";
		if(!empty($_GET['title'])){
			$where.=" and title like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		
		if($_GET['passed']<>""){
			$where.=" and passed=".(int)$_GET['passed']."";
			$this->assign('passed',(int)$_GET['passed']);
		}
		if($_GET['tj']<>""){
			$where.=" and tj=".(int)$_GET['tj']."";
			$this->assign('tj',(int)$_GET['tj']);
		}
		
		if(!empty($_GET['classid'])){
			$where.=" and link_id like '%|".$_GET['classid']."|%'";
			$this->assign('classid',$_GET['classid']);
		}
		$this->assign('kzname',newsqy(cookie('qy')));
		$arr=$this->arr('Pnews',15,' 1 '.$where,'sort desc,addtime desc,id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	//6-1
	public function newsnadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$title=str_replace('"','',$_POST['title']);	
			if(empty($title)){
				echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
				exit;
			}
			
			$prvs=$this->finds("Typepnews",'classid='.$_POST['classid'],'classid desc');
			$_POST['link_id']=$prvs["link_id"];
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Pnews",$nr,'id='.$id);
			}
			else{
				$this->add("Pnews",$nr);
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
			$show=$this->finds("Pnews",'id='.$id,'sort desc,id desc');
			$this->assign('mpic',explode("|",$show['mpic']));	
			$this->assign('show',$show);	
		}
		
		$this->cthree("Typepnews",' and qy='.cookie('qy').'');	
		$this->assign('time',date("Y-m-d H:i:s"));
		$this->assign('ispic',newspics(cookie('qy')));
		$this->display();
	}
	//6-1
	public function sskey(){
		$idd=$_GET['id'];
		if($idd){
		$this->del("Sskey","id=".$idd);
		echo "<script>location.href='".$this->ly."';</script>";
		exit;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$allid=$_POST['articleid'];
		foreach($allid as $key=>$id){
		$this->del('Sskey','id='.$id);
		}
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
		}
		
		$where="";
		if(!empty($_GET['title'])){
		$where.=" and title like '%".$_GET['title']."%'";
		$this->assign('title',$_GET['title']);
		}
				
		$arr=$this->arr('Sskey',15,'id>0 '.$where,'ssnum desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	//6-1
	public function sskeyadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST['addtime']=date("Y-m-d H:i:s");
			$id=$_POST['id_not'];
			$nr=array();
			$nr=$this->build_sql($_POST);
			if($id){
			  $this->save("Sskey",$nr,"id=".$id);
			}
			else
			{
			   $this->add("Sskey",$nr);
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		$id=$_GET['id'];
		$show=$this->finds("Sskey","id=".(int)$id,'id desc');
		$this->assign('show',$show);	
		$this->display();
	}
    //主页-ni8shop
    public function index(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			foreach($_POST['ordernum'] as $key=>$val){
				$this->setF('Typehelp','classid='.$key,'sort',$val);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}		
		$this->qy();
		$this->assign('qy',cookie('qy'));
		$this->cthree("Typehelp",' and qy='.cookie('qy').'');
		$this->assign('classlist',$this->cone);
		$classid=(int)$_GET['classid'];
		$show=$this->finds("Typehelp",'classid='.$classid,'sort desc,classid desc');
		$this->assign('link_id',$show['link_id']);
		$this->lx=array("单页面","图片列表","文章列表");
		$this->display();
    }
	//添加-ni8shop
	public function classadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$prv_id=(int)$_POST['prv_id'];
			$nr=array();
			$_POST['addtime']=date("Y-m-d H:i:s");	
			$nr=$this->build_sql($_POST);	
			if($id>0){
				$cla=$this->save("Typehelp",$nr,'classid='.$id);
				$classid=$id;
			}
			else{
				$classid=$this->add("Typehelp",$nr);
			}
			//
			if(empty($prv_id)){
				$all_id=$classid;
				$templink="|".$classid."|";
			}
			else
			{	
				$sq=$this->finds("Typehelp",'classid='.$prv_id,'sort desc,classid desc');
				if($sq){
					$all_id=$sq['all_id'];
					$temp=$sq['link_id'];
				}
				else{
					$all_id=0;
					$temp="";
				}
				$templink=($temp=="")?"|".$classid."|":$temp.$classid."|";
			}
			$nr=array();
			$nr["all_id"]=$all_id;
			$nr["link_id"]=$templink;
			$this->save("Typehelp",$nr,'classid='.$classid);
			//
			$this->assign('classid',$classid);
			$this->assign('action',"help_index");
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		$dj=(int)$_GET['dj'];
		$prv=(int)$_GET['prv'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Typehelp",'classid='.$id,'sort desc,classid desc');
			$this->assign('show',$show);
		}
		if(!empty($prv)){
			$prvs=$this->finds("Typehelp",'classid='.$prv,'sort desc,classid desc');
			$this->assign('prvname',$prvs["class_name_cn"]);
		}
		else
		{
			$this->assign('prvname',"顶级目录");
		}
		$this->assign('dj',$dj);
		$this->assign('prv',$prv);	
		$this->display();
	}	
	
	//信息列表-ni8shop
	public function info(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Help','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Help','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
	
		$this->qy();
		$this->cthree("Typehelp",' and qy='.cookie('qy').' and tj>0');
		$this->assign('classlist',$this->cone);
		$where=" and qy=".cookie('qy')."";
		if(!empty($_GET['title'])){
			$where.=" and (title like '%".$_GET['title']."%' )";
			$this->assign('title',$_GET['title']);
		}
		if(!empty($_GET['classid'])){
			$where.=" and classid=".$_GET['classid']."";
			$this->assign('classid',$_GET['classid']);
		}
		$arr=$this->arr('Help',20,' 1 '.$where,'sort desc,id desc');
			$this->assign('arr',$arr['list']);
			$this->assign('fpage',$arr['show']);	
			$this->assign('count',$arr['count']);
		$this->display();
	}
	//信息添加-ni8shop
	public function nadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Help",$nr,'id='.$id);
			}
			else{
				$this->add("Help",$nr);
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
			$show=$this->finds("Help",'id='.$id,'sort desc,id desc');
			$this->assign('show',$show);	
		}
	
		$this->cthree("Typehelp",' and qy='.cookie('qy').' and tj>0');
		$this->assign('lb',$this->cone);
		$this->assign('time',date("Y-m-d H:i:s"));	
		$this->display();
	}
	

	


	//普通信息6-1
	public function gg(){	
	    if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Infor','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Infor','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
	    $this->qy();
		$kz=array(
		'1'=>"单文信息",
		);
		$this->assign('tit',$kz[cookie('qy')]);
		$where=' and qy='.cookie('qy');
		if(!empty($_GET['title'])){
			$where.=" and title like '%".$_GET['title']."%'";
			$this->assign('title',$_GET['title']);
		}
		$arr=$this->arr('Infor',15,' 1 '.$where,'sort desc,id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
	    $this->display();
	}
	//普通信息添加6-1
	public function ggd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$name=str_replace('"','',$_POST['title']);	
			if(empty($name)){
				echo "<script language=javascript>alert('名称不能为空!');history.go(-1);</script>";
				exit;
			}
			$_POST['addtime']=date("Y-m-d H:i:s");			
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Infor",$nr,'id='.$id);
			}
			else{
				$this->add("Infor",$nr);
			}
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
			$show=$this->finds("Infor",'id='.$id,'id desc');
			$this->assign('show',$show);	
		}		
		$this->display();
	}		
}
?>