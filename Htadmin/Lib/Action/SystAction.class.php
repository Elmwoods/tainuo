<?php
if(!defined("ni8shop")) exit("Access Denied");
class SystAction extends PublicAction {
     public function __construct() 
    { 
		 parent::__construct(); 
		 $this->checkuserb();
		 $this->adminlog();	
		 $this->ly=$_SERVER['HTTP_REFERER'];
		 $this->webroots=substr(dirname(__FILE__), 0, -19);
    }
	//计划任务6-1
	public function corns(){	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Cron','id='.$id);
				$this->delFile("Cache/execute/cron_sign_".$id.".lock");
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Cron','id='.(int)$_GET['id']);
			$this->delFile("Cache/execute/cron_sign_".(int)$_GET['id'].".lock");
		
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['execute'])){
			$execute = new PubAction();
			$execute->execute_transact((int)$_GET['execute']);	
			echo "<script>alert('执行成功!');</script>";
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where=' and active=1';
		
		$arr=$this->arr('Cron',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);	
	
		$this->display();
	}
	
	//添加计划任务6-1
	public function cornsd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$id=(int)$_POST['id_not'];
		$nr=$this->build_sql($_POST);
		$execute = new PubAction();
		if($id>0){
			//$execute->update_transact($_POST);
			$fp = fopen($this->webroots."/Cache/execute/cron_sign_".$id.".lock",'w');
			fclose($fp);
			$this->save("Cron",$nr,'id='.$id);
		}
		else{
			$id=$this->add("Cron",$nr);
			$fp = fopen($this->webroots."/Cache/execute/cron_sign_".$id.".lock",'w');
			fclose($fp);
		}
		$this->assign('sx',1);
		$this->display("pub:load");
		exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];	
		if(!empty($id)){
		$show=$this->finds("Cron",'id='.$id,'id desc');
		$this->assign('show',$show);	
		}		
		$this->display();
	}
		
	
	//IP锁定6-1
	public function iplock(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Stop_ip','id='.$id);
			}
			$this->getipdata();
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Stop_ip','id='.(int)$_GET['id']);
			$this->getipdata();
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
		$where.=" and ip='".$_GET['title']."'";
		$this->assign('title',$_GET['title']);
		}
		
		if(!empty($_GET['type'])){
		$where.=" and  	type=".$_GET['type']."";
		$this->assign('type',$_GET['type']);
		}
		
		$arr=$this->arr('Stop_ip',15,' 1 '.$where,'statu desc,id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
			
	//编辑IP锁定6-1
	public function iplockd(){
		if(!empty($_GET['ip'])){
			$nr=array();
			$nr['ip']=$_GET['ip'];
			$nr['reason']=$this->user['username'];
			$nr['optime']=time();
			$nr['stoptime']=time();
			$nr['type']=1;
			$nr['statu']=1;
			$this->add("Stop_ip",$nr);
			$this->getipdata();
			$this->redirect('syst/iplock',"", 0, '');
			exit;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();			
			$_POST['reason']=$this->user['username'];
			$_POST['optime']=time();
			$_POST['stoptime']=strtotime($_POST['stoptime']);
			$nr=$this->build_sql($_POST);
			if($id>0){		    
				$this->save("Stop_ip",$nr,'id='.$id);
				$this->getipdata();
			}
			else{		    
				$this->add("Stop_ip",$nr);
				$this->getipdata();
			}
			//
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Stop_ip",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}
	
	//过滤词管理6-1
	public function keyword(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Filter_keyword','id='.$id);
			}
			$this->update_cache_filter();
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Filter_keyword','id='.(int)$_GET['id']);
			$this->update_cache_filter();
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and (keyword like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}	
	
		$arr=$this->arr('Filter_keyword',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
	
		$this->display();
	}
	
	//过滤词管理6-1	
	public function keywordd(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$nr=array();
			$_POST['time']=time();
			$nr=$this->build_sql($_POST);
			if($id>0){
				$this->save("Filter_keyword",$nr,'id='.$id);
			}
			else{
				$arr=explode(chr(10),$_POST['keyword']);
				foreach($arr as $key=>$val){
					$arr1=explode("=",$val);
					if($arr1[0]){
						$this->add("Filter_keyword",array("keyword"=>$arr1[0],"replace"=>$arr1[1],"statu"=>(int)$_POST["statu"],"time"=>time()));
					}
				}
				
			}
			$this->update_cache_filter();
			//
			$this->assign('sx',1);
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Filter_keyword",'id='.$id,'id desc');
			$this->assign('show',$show);
		}
		$this->display();
	}
	
	//创建锁定IP文件6-1
	public function getipdata(){
		$re=$this->lb("Stop_ip",'statu=1','id desc');
		foreach ($re as $v){
			if($v['type']==1)
				$stop_view[]=$v['ip'];
			else
				$stop_reg[]=$v['ip'];
		}
		$stop_view=serialize($stop_view);
		$stop_reg=serialize($stop_reg);
	
		$write_str='<?php global $stop_view,$stop_reg; $stop_view = unserialize(\''.$stop_view.'\');$stop_reg=unserialize(\''.$stop_reg.'\');?>';
		if(count($re)>0){
			$fp = fopen($this->webroots.'/Cache/execute/stop_ip.php','w');
			fwrite($fp,$write_str,strlen($write_str));
			fclose($fp);
		}
		else{
			unlink($this->webroots.'/Cache/execute/stop_ip.php');
		}
	}
	//创建过滤词文件6-1
	public function update_cache_filter(){
		$re=$this->lb("filter_keyword",'1','id desc');
		foreach($re as $v){
			if($v['statu']==1){	
				if(empty($banned))
					$banned="$v[keyword]";
				else
					$banned.="|$v[keyword]";
			}
			else
			{
				if(empty($find))
				{
					$find="'/$v[keyword]/i'";
					$replace="'$v[replace]'";
				}
				else
				{
					$find.=",'/$v[keyword]/i'";
					$replace.=",'$v[replace]'";
				}
			}
		}
		if(strlen($banned)>0)
			$banned='/('.$banned.')/i';
		else
			$banned='';
		$str='<?php
		global $find,$replace,$banned,$_CACHE;
		$find= array('.$find.');
		$replace=array('.$replace.');
		$banned=\''.$banned.'\';
		$_CACHE[\'word_filter\'] = Array
		(
			\'filter\' => Array
			(
				\'find\' => &$find,
				\'replace\' => &$replace
			),
			\'banned\' => &$banned
		);
		?>';
		if(count($re)>0){
			$fp = fopen($this->webroots.'/Cache/execute/filter.inc.php','w');
			fwrite($fp,$str,strlen($str));//将内容写入文件．
			fclose($fp);
		}
		else{
			unlink($this->webroots.'/Cache/execute/filter.inc.php');
		}
   }
	//数据统计6-1
	public function tjj(){
		$tj1=$this->tj('xpress','id>0');
		$tj2=$this->tj('address','id>0');
		$tj3=$this->tj('advs_con','id>0');
		$tj4=$this->tj('dd','qy<2');		
		$tj7=$this->tj('gwc','id>0');
		$tj8=$this->tj('message','qy=0');
		$tj9=$this->tj('pro','passed=1');
		$tj10=$this->tj('pro','passed=0');
		$tj11=$this->tj('rebates','is_pay=1 and money>0 and isjs=1');
		$tj12=$this->tj('scj','qy=1');
		$tj13=$this->tj('user','1');		
		$tj15=$this->tj('yhk','1');
		$tj16=$this->tj('yhqlq','1');
		$tj17=$this->tj('yhtx','1');
		
		$arr=array(
		array("title"=>"快递公司","sl"=>$tj1),
		array("title"=>"收货地址","sl"=>$tj2),
		array("title"=>"广告","sl"=>$tj3),
		array("title"=>"产品订单","sl"=>$tj4),		
		array("title"=>"临时购物车","sl"=>$tj7),
		array("title"=>"产品评论","sl"=>$tj8),
		array("title"=>"上架产品","sl"=>$tj9),
		array("title"=>"下架产品","sl"=>$tj10),
		array("title"=>"返利订单","sl"=>$tj11),
		array("title"=>"收藏商品","sl"=>$tj12),
		array("title"=>"会员","sl"=>$tj13),
		
		array("title"=>"银行卡","sl"=>$tj15),
		array("title"=>"领取优惠券","sl"=>$tj16),
		array("title"=>"提现数量","sl"=>$tj17),
		);
		$this->assign('arr',$arr);
		$this->display();
	}
	
	//今日访问统计6-1
	public function nowtj(){
		$time=date("Y-m-d");
		$this->pvs=$this->tj("Page_view","date_format(time,'%Y-%m-%d')='$time'",true);
		$this->ips=count($this->fg("Page_view","ip",true,"date_format(time,'%Y-%m-%d')='$time'"));
		$this->urls=count($this->fg("Page_view","url",true,"date_format(time,'%Y-%m-%d')='$time'"));
		$this->onusers=$this->tj("User_sessions","userid>0",true);
		$this->users=$this->tj("User_sessions","userid=0",true); 
		$this->newsusers=$this->tj("User","date_format(regtime,'%Y-%m-%d')='$time'",true);
		
		$this->list1=$this->fggetf("Page_view","ip","ip,username","count desc,ip asc,username desc","0,10","date_format(time,'%Y-%m-%d')='$time'",true);
		$this->list2=$this->fggetf("Page_view","url","url","count desc,url asc","0,10","date_format(time,'%Y-%m-%d')='$time' and url<>''",true);
		$this->display();
	}
	//全部访问统计6-1	
	public function alltj(){
		$act=$_GET['act'];
		if($act=="all"){
			$this->delall('page_view');
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Page_view','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Page_view','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and (ip like '%".$_GET['title']."%')";
			$this->assign('title',$_GET['title']);
		}	
		$arr=$this->arr('Page_view',50,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	
	//每天访问统计6-1	
	public function alltjm(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$allid=$_POST['articleid'];
			foreach($allid as $key=>$id){
				$this->del('Page_rec','id='.$id);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}
		if (!empty($_GET['id'])){
			$this->del('Page_rec','id='.(int)$_GET['id']);
			echo "<script language='javascript'>location='".$this->ly."';</script>";
		}	
		
		$where="";
		if(!empty($_GET['title'])){
			$where.=" and date_format(time,'%Y-%m-%d')='".$_GET['title']."'";
			$this->assign('title',$_GET['title']);
		}	
	
		$arr=$this->arr('Page_rec',50,' 1 '.$where,'time desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
	}
	//清理数据信息
	public function dell(){	
	   exit;
	   $vip=$this->user['adminjb'];
	   if($vip==1){
		   $this->del("Address","1");
		   $this->del("Admin_log","1");
		   $this->del("Admin_sessions","1");
		   $this->del("Dd","1");
		   $this->del("Ddp","1");
		   $this->del("Gwc","1");
		   $this->del("Kf","1");
		   $this->del("link","1");
		   $this->del("message","1");
		   $this->del("page_rec","1");
		   $this->del("page_view ","1");
		   $this->del("pnews","1");
		   $this->del("pro","1");
		   $this->del("rebates","1");
		   $this->del("scj","1");
		   $this->del("sku","1");
		   $this->del("stop_ip","1");
		   $this->del("tk","1");
		   $this->del("tkaddress","1");
		   $this->del("typebrand","1");
		   $this->del("typehelp","1");
		   $this->del("typepnews","1");
		   $this->del("typepro","1");
		   $this->del("typeprokz","1");
		   $this->del("user","1");
		   $this->del("user_sessions","1");
		   $this->del("verify","1");
		   $this->del("yhk","1");
		   $this->del("yhq","1");
		   $this->del("yhqlq","1");
		   $this->del("yhtx","1");
		   echo "操作完成";
	   }
	   else{
	     echo "操作完成";
	   }
	}	
	
}
?>