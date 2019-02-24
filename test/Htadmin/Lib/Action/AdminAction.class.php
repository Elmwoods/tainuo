<?php
if(!defined("ni8shop")) exit("Access Denied");
class AdminAction extends PublicAction {
    public function __construct() 
    { 
     parent::__construct(); 
	 $this->checkuserb();
	 $this->adminlog();	
    }

	public function group(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST['group_perms']=implode(",",$_POST['perm']);
			unset($_POST['perm']);
			$da=array();
			$da=$this->build_sql($_POST);
			$group_id=(int)$_POST['group_id_not'];
			if($group_id){
				$this->save("Admin_group",$da,"group_id=".$group_id);
			}
			else
			{
				$this->add("Admin_group",$da);
			}
			$this->redirect('admin/groupl','', 0, '');
			exit;
		}
		
		$id=$_GET['id'];
		$act=$_GET['act'];
		if($id && $act=="edit"){
			$show=$this->finds("Admin_group","group_id=".$id,'group_id desc');
			$this->assign('show',$show);
			$this->assign('group_perms', explode(",", $show['group_perms']));
		}	
		$this->display();
	}

	public function groupl(){
		$id=$_GET['id'];
		$act=$_GET['act'];
		if($id && $act=="del"){
			$this->del("Admin_group","group_id=".$id);
			$this->redirect('admin/groupl',array("err"=>1), 0, '');	
			exit;
		}
		$arr=$this->arr('Admin_group',50,' 1 ','group_id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	

	public function addmanager(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();	
			$nr['username']=$_POST['username'];
			if(empty($id)){
				$_POST['Password']=md5($_POST['password']);
			}
			else
			{
				if(!empty($_POST['password'])){
					$_POST['Password']=md5($_POST['password']);
				}
				else{
					unset($_POST['password']);
				}
			}
			unset($_POST['password1']);
			$nr=$this->build_sql($_POST);
			if(empty($id)){
				$this->add("Admin",$nr);
			}
			else
			{
				$this->save("Admin",$nr,"id=".$id."");
			}
			$this->redirect('admin/index','', 0, '');
			exit;
		}
		
		$id=(int)$_GET['id'];
		if(!empty($id)){
			$show=$this->finds("Admin","id=".$id." and adminjb=0",'id desc');	
			$this->assign('show',$show);
		}	
		$grouplist=$this->lb("Admin_group","1","group_id desc");
		$this->assign('grouplist',$grouplist);
		$this->display();
	}

	public function index(){
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$allid=$_POST['articleid'];
		foreach($allid as $key=>$id){
			$this->del('Admin','id='.$id);
		}
		$ly=$_SERVER['HTTP_REFERER'];
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	if (!empty($_GET['id'])){
		$this->del('Admin','id='.(int)$_GET['id']);
		$ly=$_SERVER['HTTP_REFERER'];
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	
	$where="";
	if(!empty($_GET['title'])){
		$where.=" and (username like '%".$_GET['title']."%' or email like '%".$_GET['title']."%' or mobile like '%".$_GET['title']."%')";
		$this->assign('title',$_GET['title']);
	}
	if($_GET['group_id']<>""){
		$where.=" and group_id=".(int)$_GET['group_id']."";
		$this->assign('group_id',(int)$_GET['group_id']);
	}
	$arr=$this->arr('Admin',20,' adminjb=0 '.$where,'id desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
	
	$grouplist=$this->lb("Admin_group","1","group_id desc");
	$this->assign('grouplist',$grouplist);
	$this->display();
	}
	

	public function logg(){
	
	$ly=$_SERVER['HTTP_REFERER'];
	if($_GET['act']=="add"){
		$this->delall('Admin_log');
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$allid=$_POST['articleid'];
		foreach($allid as $key=>$id){
			$this->del('Admin_log','id='.$id);
		}	
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	
	$st=time()-15*24*3600;
	$this->del('Admin_log','time<='.$st);//-------清空半个月前的日志
	$where='';
	if($_GET['title']<>""){
		$where.=" and title='".$_GET['title']."'";
		$this->assign('title',$_GET['title']);
	}
	if($_GET['time']<>""){
		$st=strtotime($_GET['time'])-86400;
		$et=$st+172800;
		$where.=" and time>$st and time<$et";
		$this->assign('time',$_GET['time']);
	}
	if($_GET['url']<>""){
		$where.=" and url like '".$_GET['url']."%'";
		$this->assign('url',$_GET['url']);
	}
	
	$arr=$this->arr('Admin_log',20,' 1 '.$where,'time desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
	$this->display();
	}
		
}
?>