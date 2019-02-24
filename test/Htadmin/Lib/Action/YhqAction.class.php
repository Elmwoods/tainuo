<?php
if(!defined("ni8shop")) exit("Access Denied");
class YhqAction extends PublicAction {
public function __construct() { 
     parent::__construct(); 
	 $this->checkuserb();
	 $this->adminlog();		
	 $this->ly=$_SERVER['HTTP_REFERER'];
    }	

public function index(){
		$idd=$_GET['id'];
		if($idd){
			$this->del("Yhq","id=".$idd);
			$this->del("yhqm","yhqid=".$idd);
			echo "<script>location.href='".$this->ly."';</script>";
			exit;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				 $this->del('Yhq','id='.$id);
				 $this->del("yhqm","yhqid=".$id);
			}
			echo "<script language='javascript'>location='".$ly."';</script>";
			exit;
		}
		
		$where="";	
		if(!empty($_GET['title'])){
			$where.=" and (jg=".$_GET['title']." )";
			$this->assign('title',$_GET['title']);
		}			
		$arr=$this->arr('Yhq',15,'id>0 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();		
	}

public function yhqadd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST['addTime']=date("Y-m-d H:i:s");
			$id=$_POST['id_not'];
			$nr=array();
			$_POST['stimes']=strtotime($_POST['stimes']);
			$_POST['etimes']=strtotime($_POST['etimes']);
			$nr=$this->build_sql($_POST);
			if($id){
			  $this->save("Yhq",$nr,"id=".$id);
			}
			else
			{
			   $this->add("Yhq",$nr);
			}
			$this->assign('sx',1);
			$this->display("Pub:load");
			exit;
		}
		$id=(int)$_GET['id'];
		if(!empty($id)){
			$show=$this->finds("Yhq","id=".(int)$id,'id desc');
			$this->assign('show',$show);
		}
		$dqtime=time();
		$this->assign('dqtime',$dqtime);
		$this->display();
}	
public function dhm(){
		$idd=$_GET['did'];
		if($idd){			
			$this->del("yhqm","id=".$idd);
			$this->update1("Yhq","sl>0 and id=".(int)cookie('qym'),"sl",1);
			$this->update1("Yhq","sysl>0 and id=".(int)cookie('qym'),"sysl",1);			
			echo "<script>location.href='".$this->ly."';</script>";
			exit;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){				  
				  $this->del("yhqm","id=".$id);
				  $this->update1("Yhq","sl>0 and id=".(int)cookie('qym'),"sl",1);
			      $this->update1("Yhq","sysl>0 and id=".(int)cookie('qym'),"sysl",1);	
			}
			echo "<script language='javascript'>location='".$ly."';</script>";
			exit;
		}
		
		$where="";
		if($_GET['id']<>""){
		   cookie('qym',$_GET['id']);
		}
		if(!empty($_GET['title'])){
			$where.=" and (title='".$_GET['title']."' or code='".$_GET['title']."' )";
			$this->assign('title',$_GET['title']);
		}		
		if($_GET['passed']<>""){
			$where.=" and passed=".$_GET['passed']."";			
			$this->assign('passed',(int)$_GET['passed']);
		}
		$where.=" and yhqid=".(int)cookie('qym')."";
			
		$arr=$this->arr('yhqm',15,'id>0 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$this->yhq=$this->finds("Yhq","id=".(int)cookie('qym'),'id desc');
		$this->display();		
	}
public function yhmadd(){ 
       $yhq=$this->finds("Yhq","id=".(int)cookie('qym'),'id desc');       
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){			
			$id=$_POST['id_not'];
			$sl=abs((int)$_POST['sl']);
			$nr=array();			
			$nr=$this->build_sql($_POST);
			if($id){
			  $this->save("yhqm",array("code"=>strtoupper($nr['code'])),"id=".$id);
			}else{
			 
			  if($sl>0){
			  for($i=0;$i<$sl;$i++){
			     $codee=strtoupper($this->randStr(8));
			     $this->add("yhqm",array("title"=>$yhq['title'],"code"=>$codee,"addtime"=>date("Y-m-d H:i:s"),"yhqid"=>$yhq['id']));
			  }
			  $this->update("Yhq","id=".(int)cookie('qym'),"sl",$sl);
			  $this->update("Yhq","id=".(int)cookie('qym'),"sysl",$sl);
			  }
			}			
			$this->assign('sx',1);
			$this->display("Pub:load");
			exit;
		}	
		$id=(int)$_GET['id'];
		if(!empty($id)){
			$show=$this->finds("yhqm","id=".(int)$id,'id desc');
			$this->assign('show',$show);
		}	
		$this->assign('yhq',$yhq);		
		$this->display();
}
public function dhmdr(){
    @set_time_limit(0);
	ignore_user_abort(TRUE);
    $yhq=$this->finds("Yhq","id=".(int)cookie('qym'),'id desc');
	$this->assign('yhq',$yhq); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$tmp=$_FILES['scfile']['tmp_name'];
		$name=$_FILES['scfile']['name'];
		$size=$_FILES['scfile']['size'];
		$extArr = array("txt");
		$extend = pathinfo($name);
		$ext = strtolower($extend["extension"]);		
		if(!empty($name)){
			 if(in_array($ext,$extArr)){
				 if($size<(20000*1024)){
				   $save = "./log/123.".$ext;
				   if(is_uploaded_file($tmp)){
					    if (!file_exists($save)) {
							@mkdir($save);
					    }	
						if(move_uploaded_file($tmp,$save)){
							 $fh = fopen("./log/123.txt","r");
							 $line=array();
							 while(!feof($fh)){
								$line[] = fgets($fh);
							 }
							 foreach($line as $val){
								$units = strtoupper(trim($val));
								$ism=$this->finds("yhqm","code='".$units."'",'id desc');
								if(empty($ism) && !empty($units)){
								  $this->add("yhqm",array("title"=>$yhq['title'],"code"=>$units,"addtime"=>date("Y-m-d H:i:s"),"yhqid"=>$yhq['id']));
								  $this->update("Yhq","id=".(int)cookie('qym'),"sl",1);
			                      $this->update("Yhq","id=".(int)cookie('qym'),"sysl",1);
								}
								
							
							}
						}
				   }
				 }
			 }
		}
		$this->redirect('yhq/dhm',array("id"=>(int)cookie('qym')), 0, '');
		exit();	
	}
    $this->display();
}
}
?>