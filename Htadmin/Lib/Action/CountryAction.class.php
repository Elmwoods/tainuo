<?php
if(!defined("ni8shop")) exit("Access Denied");
class CountryAction extends PublicAction {
    public function __construct() 
    { 
     parent::__construct(); 
	 $this->checkuserb();
	 $this->adminlog();	
	 $this->ly=$_SERVER['HTTP_REFERER'];
    }
	public function index(){
		$idd=$_GET['id'];
		if($idd){
			$this->del("Region","id=".$idd);
			//$this->redirect('country/index',array("err"=>1), 0, '');	
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){			
			$sort=$_POST['sort'];
			$flag=$_POST['flag'];
			$region_name=$_POST['region_name'];
			$region_name_en=$_POST['region_name_en'];
			$id=$_POST['id'];
			foreach($region_name as $key=>$val){
				if($val){
					$da=array();
					$da["sort"]=$sort[$key];
					$da["flag"]=$flag[$key];
					$da["region_name"]=$region_name[$key];
					$da["region_name_en"]=$region_name_en[$key];
					$da["region_type"]=0;
					if($id[$key]){
						$this->save("Region",$da,"id=".$id[$key]);
					}
					else
					{
						$this->add("Region",$da);
					}
			   }
		  }
			
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			//$this->redirect('country/index',"", 0, '');	
			exit;
		}
		
		$where='';
		if(!empty($_GET['title'])){
			$where.=" and (region_name  like '%".$_GET['title']."%' or region_name_en like '%".$_GET['title']."%' or flag like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}
	
		$arr=$this->arr('Region',500,'id>0 and region_type=0 '.$where,'sort asc,region_name_en asc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);	
		$this->display();
	}

	public function province(){
		$id=$_GET['id'];
		$act=$_GET['act'];
		if($id && $act=="del"){
			$this->del("Region","id=".$id);
			//$this->redirect('country/province',array("err"=>1), 0, '');	
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){			
			$sort=$_POST['sort'];
			$flag=$_POST['flag'];
			$parent_id=$_POST['parent_id'];
			$region_name=$_POST['region_name'];
			$region_name_en=$_POST['region_name_en'];
			$id=$_POST['id'];
			foreach($region_name as $key=>$val){
				if($val){
					$da=array();
					$da["sort"]=$sort[$key];
					$da["flag"]=$flag[$key];
					$da["parent_id"]=$parent_id[$key];
					$da["region_name"]=$region_name[$key];
					$da["region_name_en"]=$region_name_en[$key];
					$da["region_type"]=1;
					
					if($id[$key]){
						$this->save("Region",$da,"id=".$id[$key]);
					}
					else
					{
						$this->add("Region",$da);
					}
				}
			}
			$ly=$_SERVER['HTTP_REFERER'];
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			//$this->redirect('country/province',"", 0, '');	
			exit;
		}
		
		$where='';
		if(!empty($_GET['title'])){
			$where.=" and (region_name  like '%".$_GET['title']."%' or region_name_en like '%".$_GET['title']."%' or flag like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['parent_id'])){
			$where.=" and parent_id=".(int)$_GET['parent_id']."";
			$this->assign('parent_id',$_GET['parent_id']);
		}
		
		$arr=$this->arr('Region',20,'id>0 and region_type=1 '.$where,'sort asc,region_name_en asc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$gj=$this->lb('region',' 1 and region_type=0','sort asc,region_name_en asc');
		$this->assign('gj',$gj);
		$this->display();
	}
	
	

	public function city(){
		$id=$_GET['id'];
		$act=$_GET['act'];
		if($id && $act=="del"){
			$this->del("Region","id=".$id);
			//$this->redirect('country/province',array("err"=>1), 0, '');	
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){			
			$sort=$_POST['sort'];
			$flag=$_POST['flag'];
			$parent_id=$_POST['parent_id'];
			$region_name=$_POST['region_name'];
			$region_name_en=$_POST['region_name_en'];
			$id=$_POST['id'];
			foreach($region_name as $key=>$val){
				if($val){
					$da=array();
					$da["sort"]=$sort[$key];
					$da["flag"]=$flag[$key];
					$da["parent_id"]=$parent_id[$key];
					$da["region_name"]=$region_name[$key];
					$da["region_name_en"]=$region_name_en[$key];
					$da["region_type"]=2;
					if($id[$key]){
						$this->save("Region",$da,"id=".$id[$key]);
					}
					else
					{
						$this->add("Region",$da);
					}
				}
			}
			$ly=$_SERVER['HTTP_REFERER'];
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			//$this->redirect('country/province',"", 0, '');	
			exit;
		}
		
		$where='';
		if(!empty($_GET['title'])){
			$where.=" and (region_name  like '%".$_GET['title']."%' or region_name_en like '%".$_GET['title']."%' or flag like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['parent_id'])){
			$where.=" and parent_id=".(int)$_GET['parent_id']."";
			$this->assign('parent_id',$_GET['parent_id']);
		}
		
		$arr=$this->arr('Region',15,'id>0 and region_type=2 '.$where,'sort asc,region_name_en asc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$show=$this->finds("region","id=".(int)$_GET['parent_id'],'id desc');
		if($show){
			$gj=$this->lb('region',' 1 and region_type=1 and parent_id='.$show['parent_id'],'sort asc,region_name_en asc');
		}
		else
		{
			$gj=$this->lb('region',' 1 and region_type=1 ','sort asc,region_name_en asc');
		}
		$this->assign('gj',$gj);
		$this->display();
	}

	public function xian(){
		$ly=$this->ly;
		$domain = strpos($ly, 'country_city.html'); 
		if($domain>0){
			cookie('fh',$ly);
		}
		$id=$_GET['id'];
		$act=$_GET['act'];
		if($id && $act=="del"){
			$this->del("Region","id=".$id);
			//$this->redirect('country/province',array("err"=>1), 0, '');	
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){			
			$sort=$_POST['sort'];
			$flag=$_POST['flag'];
			$parent_id=$_POST['parent_id'];
			$region_name=$_POST['region_name'];
			$region_name_en=$_POST['region_name_en'];
			$id=$_POST['id'];
			foreach($region_name as $key=>$val){
				if($val){
					$da=array();
					$da["sort"]=$sort[$key];
					$da["flag"]=$flag[$key];
					$da["parent_id"]=$parent_id[$key];
					$da["region_name"]=$region_name[$key];
					$da["region_name_en"]=$region_name_en[$key];
					$da["region_type"]=3;
					if($id[$key]){
						$this->save("Region",$da,"id=".$id[$key]);
					}
					else
					{
						$this->add("Region",$da);
					}
				}
			}
			$ly=$_SERVER['HTTP_REFERER'];
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			//$this->redirect('country/province',"", 0, '');	
			exit;
		}
		
		$where='';
		if(!empty($_GET['title'])){
			$where.=" and (region_name  like '%".$_GET['title']."%' or region_name_en like '%".$_GET['title']."%' or flag like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['parent_id'])){
			$where.=" and parent_id=".(int)$_GET['parent_id']."";
			$this->assign('parent_id',$_GET['parent_id']);
		}
		
		$arr=$this->arr('Region',15,'id>0 and region_type=3 '.$where,'sort asc,region_name_en asc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		
		$show=$this->finds("region","id=".(int)$_GET['parent_id'],'id desc');
		if($show){
			$gj=$this->lb('region',' 1 and region_type=2 and parent_id='.$show['parent_id'],'sort asc,region_name_en asc');
		}
		else
		{
			$gj=$this->lb('region',' 1 and region_type=2 ','sort asc,region_name_en asc');
		}
		$this->assign('gj',$gj);
		$this->display();
	}
		
}
?>
