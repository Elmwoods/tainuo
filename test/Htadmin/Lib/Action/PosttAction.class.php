<?php
if(!defined("ni8shop")) exit("Access Denied");
class PosttAction extends PublicAction {
     public function __construct() 
    { 
		 parent::__construct(); 
		 $this->checkuserb();
		 $this->adminlog();	
		 $this->ly=$_SERVER['HTTP_REFERER'];
    }	
	public function index(){
	    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			foreach($_POST['ordernum'] as $key=>$val){
				$this->setF('Postt','id='.$key,'sort',$val);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
		$list=$this->lb('Postt','title<>""','sort desc,id desc');
		$this->assign('arr',$list);	
		
		$this->display();
	}

	public function fsadd(){
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$title=str_replace('"','',$_POST['title']);
			if(empty($title)){
			echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
			exit;
			}
			$_POST['ssl']=abs($_POST['ssl']);
			$_POST['sprice']=abs($_POST['sprice']);
			$_POST['xsl']=abs($_POST['xsl']);
			$_POST['xprice']=abs($_POST['xprice']);
			$nr=$this->build_sql($_POST);	
			if($id>0){
			$cla=$this->save("Postt",$nr,'id='.$id);
			}
			else{
			$this->add("Postt",$nr);
			}	

			$this->assign('sx',"1");
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];		
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Postt",'id='.$id.'','sort desc,id desc');
			$this->assign('show',$show);
		}	
		
		$this->display();
	}

	public function price(){
	   $id=$_GET['id'];
	   if(!empty($id)){	       
				$this->del('Posttp','id='.$id);			
				echo "<script language='javascript'>location='".$this->ly."';</script>";
				exit;			
		}
		$where=" 1 ";
		if(!empty($_GET['postt'])){
			$where.=" and Posttp.postt=".(int)$_GET['postt']." ";
			$this->assign('postt',$_GET['postt']);
		}
		$rv=D('PosttpView');
		$order='id desc';		
		$arr = $rv->getListPage(20, $where, $order);
		$this->assign('arr',$arr['list']);
	    $this->assign('fpage',$arr['show']);	
	    $this->assign('count',$arr['count']);
			
		$this->farr=$this->lb("Postt","passed=1",'sort desc,id desc');
		
	   $this->display();
	}

	public function priced(){
	
	     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$postt=str_replace('"','',$_POST['postt']);
			$aeraid=str_replace('"','',$_POST['aeraid']);
			if(empty($postt) || empty($aeraid)){
			echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
			exit;
			}
			$_POST['sprice']=abs($_POST['sprice']);
			$_POST['xprice']=abs($_POST['xprice']);
			$nr=$this->build_sql($_POST);	
			if($id>0){
			$cla=$this->save("Posttp",$nr,'id='.$id);
			}
			else{
			$this->add("Posttp",$nr);
			}	

			$this->assign('sx',"1");
			$this->display("pub:load");
			exit;
		}
		    $act=$_GET['act'];
			$id=(int)$_GET['id'];		
			if($act=='edit' && !empty($id)){
				$show=$this->finds("Posttp",'id='.$id.'','id desc');
				$this->assign('show',$show);
			}
			$this->farr=$this->lb("Postt","passed=1",'sort desc,id desc');
				
		 $this->display();
	}

	public function xz(){
		$id=(int)$_GET['id'];
		$aeraid=$_GET['aeraid'];
		$postt=$_GET['postt'];
		$show=$this->finds("Posttp",'id='.$id.'','id desc');
		$lbs=$this->lb("Posttp",'postt='.$postt.' and id<>'.$id,'id desc');
		$nr="";
		foreach($lbs as $key=>$val){
		    if(!empty($val['aeraid'])){
				if(empty($nr)){
					$nr.=$val['aeraid'];
				}
				else{
					$nr.=",".$val['aeraid'];
				}
			}

		}
		$this->nx=explode(",",$nr);
		$this->yx=explode(",",$aeraid);
		$this->dq=$this->lb('Region',' parent_id=1',' sort desc,id asc',true);
		$this->display();
	}
	
}
?>