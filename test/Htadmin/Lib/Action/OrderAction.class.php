<?php
if(!defined("ni8shop")) exit("Access Denied");
class OrderAction extends PublicAction {
     public function __construct() 
    { 
     parent::__construct(); 
	 $this->checkuserb();
	 $this->adminlog();	
	 $this->ly=$_SERVER['HTTP_REFERER'];
    }
    //公用6-1
	 public function qy(){
		if(isset($_GET['qy'])){
		if($_GET['qy']<>""){
		cookie('qy',(int)$_GET['qy']);
		}
		else
		{
		//cookie('qy',0);
		}
		}
	}
//退换货收货地址
public function address(){
exit;
        $list=$this->lb('Tkaddress','names<>""','id desc');
		$this->assign('arr',$list);	
		$this->display();
}
//退换货收货地址修改	
public function addressd(){
	exit;
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id=(int)$_POST['id_not'];
			$_POST['addtime']=date("Y-m-d H:i:s");
			$title=str_replace('"','',$_POST['names']);
			if(empty($title)){
			echo "<script language=javascript>alert('数据没有填写完整!');history.go(-1);</script>";
			exit;
			}
			$nr=$this->build_sql($_POST);	
			if($id>0){
			$cla=$this->save("Tkaddress",$nr,'id='.$id);
			}
			else{
			$this->add("Tkaddress",$nr);
			}	

			$this->assign('sx',"1");
			$this->display("pub:load");
			exit;
		}
		
		$act=$_GET['act'];
		$id=(int)$_GET['id'];		
		if($act=='edit' && !empty($id)){
			$show=$this->finds("Tkaddress",'id='.$id.'','id desc');
			$this->assign('show',$show);
			$this->assign('sfs',$show['sf']);
			$this->assign('css',$show['cs']);
			$this->assign('xcs',$show['xc']);
		}	
		$sf=$this->lb('Region',' parent_id=1',' id asc',true);
		$this->assign('sf',$sf);
		
		if(!empty($show['sf'])){
			$cslist=$this->lb('Region',' parent_id='.(int)$show['sf'],' id asc',true);
			$this->assign('cslist',$cslist);
		}
		if(!empty($show['cs'])){
			$xclist=$this->lb('Region',' parent_id='.(int)$show['cs'].'',' id asc',true);
			$this->assign('xclist',$xclist);
		}
		
	$this->display();
}
//订单发货6-1
public function sendh(){	
	$ks=$_GET['ks'];
	$js=$_GET['js'];
	$ks1=$_GET['ks1'];
	$js1=$_GET['js1'];
	$this->assign('ks',$_GET['ks']);
	$this->assign('js',$_GET['js']);
	$this->assign('ks1',$_GET['ks1']);
	$this->assign('js1',$_GET['js1']);
    
	$where=" and ishs=0 and qy=0 and tk=0 and passed>0 and passed<3";
	
	if(!empty($_GET['ddbh'])){
		$where.=" and ddbh like '%".$_GET['ddbh']."%' ";
		$this->assign('ddbh',$_GET['ddbh']);
	}
	
	if($_GET['passed']<>""){
	$where.=" and passed=".(int)$_GET['passed']."";
	$this->assign('passed',(int)$_GET['passed']);
	}
	
	
	if (!empty($ks) && !empty($js) && $js>$ks){
	$where=$where." and addtime>=".strtotime($ks)." and addtime<=".strtotime($js)."";
	}
	if (!empty($ks1) && !empty($js1) && $js1>$ks1){
	$where=$where." and fktime>=".strtotime($ks1)." and fktime<=".strtotime($js1)."";
	}
	if(!empty($where)){
		   cookie('ddfheport',$where);
		}
		else{
		   cookie('ddfheport',NULL);
	}
	$arr=$this->arr('Dd',15,' 1 '.$where,'classid desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
	$this->display();
}
//订单发货导出
public function ddfhexport(){
       $where=cookie('ddfheport');
	   $arr=$this->lb('Dd',' 1 '.$where,'classid desc');
	   $this->dchead("ddfhlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >订单时间</td>
				  <td >会员账号</td>
				  <td >订单号</td>
				  <td >产品名称</td>
				  <td >产品规格型号</td>
				  <td >产品数量</td>
				  <td >产品单价</td>
				  <td >产品全额</td>
				  <td >满减优惠</td>
				  <td >折扣优惠</td>				 
				  <td >酒币</td>
				  <td >运费</td>
				  <td >应付全额</td>
				  <td >实付全额</td>
				  <td >付款时间</td>
				  <td >订单状态</td>
				  <td >收货人</td>
				  <td >联系电话</td>
				  <td >地址</td>
				  <td >用户备注</td>
				  <td >客服备注</td>
				  </tr>'; 
	   foreach($arr as $key=>$val){
	       $address=str_replace('\\','',$val['address']);
           $address=unserialize($address);
	       $arrp=$this->lb('Ddp'," 1 and ddbh='".$val['ddbh']."'",'id desc');
		   $passed=ddpassed($val['passed']);
		   $fktime=($val['fktime'])?date("Y-m-d H:i:s",$val['fktime']):'';
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.date("Y-m-d H:i:s",$val['addtime']).'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td style="vnd.ms-excel.numberformat:@;">'.$val['ddbh'].'</td>
					   <td >'.$arrp[0]['title'].'</td>
					   <td >'.$arrp[0]['csname'].'</td>
					   <td >'.$arrp[0]['sl'].'</td>
					   <td >'.$arrp[0]['dj'].'</td>
					   <td >'.$arrp[0]['price'].'</td>
					   <td >'.$val['mj'].'</td>
					   <td >'.($arrp[0]['prozk']*10).'</td>
					   <td >'.$val['pointp'].'</td>					  
					   <td >'.$val['kdfsprice'].'</td>
					   <td >'.$val['prices'].'</td>
					   <td >'.$val['zhprice'].'</td>
					   <td >'.$fktime.'</td>
					   <td >'.$passed.'</td>
					   <td >'.$address['names'].'</td>
					   <td >'.$address['phone'].'</td>
					   <td >'.address($address['sf']).address($address['cs']).address($address['xc']).$address['address'].'</td>
					   <td >'.$val['bz'].'</td>
					   <td >'.$val['ddsm'].'</td>					  
					   </tr>'; 
		 foreach($arrp as $key1=>$val1){
		     if($key1>0){
			 $filename.='<tr>
						   <td></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td >'.$val1['title'].'</td>
						   <td >'.$val1['csname'].'</td>
						   <td >'.$val1['sl'].'</td>
						   <td >'.$val1['dj'].'</td>
						   <td >'.$val1['price'].'</td>
						   <td ></td>
						   <td ></td>
						   <td ></td>					  
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>					  
						   </tr>'; 
			}
		 }
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//订单发货6-1
public function sendhh(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
		$classid=(int)$_POST['classid_not'];
		$ly=$_POST['ly_not'];		
		$show=$this->finds("Dd",'passed=1 and classid='.$classid,'classid desc');		
		if(!$show){
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}       
		if($show["passed"]==1 && !empty($_POST['wlfs']) && !empty($_POST['wldh'])){			
			$this->save("Dd",array("passed"=>2,"fhtime"=>time(),"wlfs"=>$_POST['wlfs'],"wldh"=>$_POST['wldh']),'classid='.$classid);
			$this->save("Ddp",array("passed"=>2),"ddbh='".$show["ddbh"]."'");
			$kd=$this->finds("Xpress",'id='.$_POST["wlfs"],'id desc');
			if($kd){				
				$mess=array($show['ddbh']);	
		        $this->sendinfo(picc($show['user_id'],"user","username"),$mess,6);
			 }
			
		}
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	
	$classid=(int)$_GET['classid'];	
	if(!empty($classid)){
	$show=$this->finds("Dd",'classid='.$classid,'classid desc');
	$address=str_replace('\\','',$show['address']);
    $address=unserialize($address);
	$this->assign('address',$address);
	$this->assign('show',$show);
	if(!empty($show['wldh'])){
		$wlxx=$this->kd100(picc($show['wlfs'],"xpress","code"),$show['wldh']);
		$this->assign('wlxx',$wlxx["data"]);
	}	
	
	$ddlist=$this->lb('Ddp',"ddbh='".$show["ddbh"]."'",'id desc');
	$this->assign('ddlist',$ddlist);	
	}
	$this->kd=$this->lb('Xpress'," 1",' sort desc');
	
	$isfp=$this->finds("fp",'ddid='.$classid,'id desc');
	$this->assign('isfp',$isfp);	
	$this->display();
}
//产品订单管理6-1
public function index(){
	//$this->fsxx("o7nATwafPzUZh5nGq6ptllZLG0Y8","20160513012257499627",'已发货',"2","13-11-12");//发货信息
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$allid=$_POST['articleid'];
	foreach($allid as $key=>$id){
	$this->save('Dd',array("ishs"=>1),"ddbh='".$id."' and passed=4");
	$this->save('Ddp',array("ishs"=>1),"ddbh='".$id."' and passed=4");
	}
	echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	if (!empty($_GET['id'])){
	$this->save('Dd',array("ishs"=>1),"ddbh='".$_GET['id']."' and passed=4");
	$this->save('Ddp',array("ishs"=>1),"ddbh='".$_GET['id']."' and passed=4");
	echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	
	$this->qy();
	$ks=$_GET['ks'];
	$js=$_GET['js'];
	$ks1=$_GET['ks1'];
	$js1=$_GET['js1'];
	$this->assign('ks',$_GET['ks']);
	$this->assign('js',$_GET['js']);
	$this->assign('ks1',$_GET['ks1']);
	$this->assign('js1',$_GET['js1']);
    $user_id=$_GET['user_id'];
	$where=" and ishs=0 and qy=".(int)cookie('qy')."";
	if(!empty($user_id)){
	$where.=" and user_id=".$user_id;
	$this->assign('user_id',(int)$user_id);
	}
	if(!empty($_GET['ddbh'])){
	$where.=" and (ddbh like '%".$_GET['ddbh']."%' or qhm like '%".$_GET['ddbh']."%')";
	$this->assign('ddbh',$_GET['ddbh']);
	}
	
	if($_GET['passed']<>""){
	$where.=" and passed=".(int)$_GET['passed']."";
	$this->assign('passed',(int)$_GET['passed']);
	}
	if($_GET['isjs']<>""){
	$where.=" and isjs=".(int)$_GET['isjs']."";
	$this->assign('isjs',(int)$_GET['isjs']);
	}
	
	if (!empty($ks) && !empty($js) && $js>$ks){
	$where=$where." and addtime>=".strtotime($ks)." and addtime<=".strtotime($js)."";
	}
	if (!empty($ks1) && !empty($js1) && $js1>$ks1){
	$where=$where." and fktime>=".strtotime($ks1)." and fktime<=".strtotime($js1)."";
	}

    if(!empty($where)){
		   cookie('ddeport',$where);
		}
		else{
		   cookie('ddeport',NULL);
	}
	$arr=$this->arr('Dd',15,' 1 '.$where,'classid desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
	$this->display();
}
//订单导出
public function ddexport(){
       $where=cookie('ddeport');
	   $arr=$this->lb('Dd',' 1 '.$where,'classid desc');
	   $this->dchead("ddlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >订单时间</td>
				  <td >会员账号</td>
				  <td >订单号</td>
				  <td >产品名称</td>
				  <td >产品规格型号</td>
				  <td >产品数量</td>
				  <td >产品单价</td>
				  <td >产品全额</td>
				  <td >满减优惠</td>
				  <td >折扣优惠</td>				 
				  <td >酒币</td>
				  <td >运费</td>
				  <td >应付全额</td>
				  <td >实付全额</td>
				  <td >付款时间</td>
				  <td >订单状态</td>
				  <td >收货人</td>
				  <td >联系电话</td>
				  <td >地址</td>
				  <td >用户备注</td>
				  <td >客服备注</td>
				  </tr>'; 
	   foreach($arr as $key=>$val){
	       $address=str_replace('\\','',$val['address']);
           $address=unserialize($address);
	       $arrp=$this->lb('Ddp'," 1 and ddbh='".$val['ddbh']."'",'id desc');
		   $passed=ddpassed($val['passed']);
		   $fktime=($val['fktime'])?date("Y-m-d H:i:s",$val['fktime']):'';
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.date("Y-m-d H:i:s",$val['addtime']).'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td style="vnd.ms-excel.numberformat:@;">'.$val['ddbh'].'</td>
					   <td >'.$arrp[0]['title'].'</td>
					   <td >'.$arrp[0]['csname'].'</td>
					   <td >'.$arrp[0]['sl'].'</td>
					   <td >'.$arrp[0]['dj'].'</td>
					   <td >'.$arrp[0]['price'].'</td>
					   <td >'.$val['mj'].'</td>
					   <td >'.($arrp[0]['prozk']*10).'</td>
					   <td >'.$val['pointp'].'</td>					  
					   <td >'.$val['kdfsprice'].'</td>
					   <td >'.$val['prices'].'</td>
					   <td >'.$val['zhprice'].'</td>
					   <td >'.$fktime.'</td>
					   <td >'.$passed.'</td>
					   <td >'.$address['names'].'</td>
					   <td >'.$address['phone'].'</td>
					   <td >'.address($address['sf']).address($address['cs']).address($address['xc']).$address['address'].'</td>
					   <td >'.$val['bz'].'</td>
					   <td >'.$val['ddsm'].'</td>					  
					   </tr>'; 
		 foreach($arrp as $key1=>$val1){
		     if($key1>0){
			 $filename.='<tr>
						   <td></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td >'.$val1['title'].'</td>
						   <td >'.$val1['csname'].'</td>
						   <td >'.$val1['sl'].'</td>
						   <td >'.$val1['dj'].'</td>
						   <td >'.$val1['price'].'</td>
						   <td ></td>
						   <td ></td>
						   <td ></td>					  
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>
						   <td ></td>					  
						   </tr>'; 
			}
		 }
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//订单修改6-1
public function dd(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$classid=(int)$_POST['classid_not'];
		$ly=$_POST['ly_not'];
		$passed=(int)$_POST['passed'];
		$show=$this->finds("Dd",'classid='.$classid,'classid desc');		
		if(!$show){
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
		
	
        if($show["passed"]==4){
			unset($_POST['passed']);			
			$passedd=4;
		}elseif($show["passed"]==3){
			unset($_POST['passed']);
			$passedd=3;
		}elseif($passed==3 && $show["passed"]<>3){
	     	 $_POST['ycsm']=$show["ycsm"].$this->user['username']."后台操作完成定单".date("Y-m-d H:i:s").",";
			 $passedd=$_POST['passed'];
			 //$zjf=0;
	         //$showp=$this->lb('Ddp'," ddbh='".$show['ddbh']."' and ishs=0 and isth=0",'id desc');
	         //foreach($showp as $key1=>$val1){
	         //   $zjf=$zjf+$val1['price'];
	         //}			
	        //$nr=array();
	        //$nr['passed']=3;
		    $_POST['qrtime']=time();
			$this->save('rebates',array("qrtime"=>time()),"ddbh='".$show["ddbh"]."' and is_pay=1");
		    //$zjf=$zjf+$show['kdfsprice']-$show['yhq']-$show['mj']-$show['pointp']-$show['zkprice'];
		    //if($zjf<0)$zjf=0;
		    //$zjf=$zjf*$show['point'];
			
		   // if(!empty($zjf)){
//			   $arrjf=array();
//			   $arrjf['addtime']=date("Y-m-d H:i:s");
//			   $arrjf['user_id']=$show['user_id'];
//			   $arrjf['price']=(int)$zjf;
//			   $arrjf['sz']="消费获取积分:".$zjf."分";
//			   $arrjf['qy']="1";
//			   $arrjf['passed']="0";
//			   $arrjf['ordern']=$show['ddbh'];
//			   $this->add('Jl',$arrjf);				   		
//			   $this->update("User","id=".$this->userstrpc($show['user_id']),"pointend",$zjf);	
//			   $this->update("User","id=".$this->userstrpc($show['user_id']),"point",$zjf);	   
//		   }
           $this->save("Ddp",array("qrtime"=>time()),"ddbh='".$show["ddbh"]."'");
		   $this->save("Rebates",array("is_pay"=>1),"ddbh='".$show["ddbh"]."'");
		}
		else{
		   $passedd=$_POST['passed'];
			if($passed==4 && $show["passed"]<>4){	
					if($show["yhqid"]){
						//$this->save('yhqlq',array("passed"=>0,"sytime"=>NULL,"ordernum"=>NULL),'id='.$show["yhqid"]);
					}					
					$ddlist=$this->lb('Ddp'," ddbh='".$show["ddbh"]."'",' id desc');
					$setorder=explode("$$",$this->webset['order']);
					foreach($ddlist as $key=>$value){
					     if(($setorder[1]==0 && $value['passed']==0) || ($setorder[1]==1 && $value['passed']==1)){
						 $this->update("Pro","id=".$value['pr_id'],"kc",$value['sl']);
						 
						 $this->update1("Sku","pro_id=".$value['pr_id']." and cs='".(int)$value['cs']."' ","count",$value['sl']);
						 }
						 $this->update1("Pro","id=".$value['id'],"sale",$value['sl']);
						 $this->update1("Pro","id=".$value['id'],"xnsale",$value['sl']);
					}
					$this->save("Rebates",array("is_pay"=>0),"ddbh='".$show["ddbh"]."'");
			        $_POST['ycsm']=$show["ycsm"].$this->user['username']."后台操作取消定单".date("Y-m-d H:i:s").",";						
			}
		}
		if($passed==1 && $show["passed"]<>1){
		   $_POST["fktime"]=time();
		   $this->save("Rebates",array("is_pay"=>1,"fktime"=>time()),"ddbh='".$show["ddbh"]."'");
		   $_POST['ycsm']=$show["ycsm"].$this->user['username']."后台操作支付定单".date("Y-m-d H:i:s").",";	
		}
		$_POST['zkprice']=((int)$_POST['zkprice']>=0)?$_POST['zkprice']:0;		
		$_POST['zhprice']=$show["prices"]-$_POST['zkprice'];
		$_POST['zhprice']=($_POST['zhprice']>=0)?$_POST['zhprice']:0;
		if($passed==2 && $show["passed"]<>2){
			$_POST["fhtime"]=time();
			
		}			
		$nr=$this->build_sql($_POST);
		if($classid>0){
			$this->save("Dd",$nr,'classid='.$classid);
			$this->save("Ddp",array("passed"=>$passedd),"ddbh='".$show["ddbh"]."'");
		}
		
		if($passed==2 && $show["passed"]<>2){			
			$kd=$this->finds("Xpress",'id='.$_POST["wlfs"],'id desc');
			if($kd){				
				$mess=array($show['ddbh']);	
		        $this->sendinfo(picc($show['user_id'],"user","username"),$mess,6);
			 }
		}
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
	}
	
	$classid=(int)$_GET['classid'];	
	if(!empty($classid)){
	$show=$this->finds("Dd",'classid='.$classid,'classid desc');
	$address=str_replace('\\','',$show['address']);
    $address=unserialize($address);
	$this->assign('address',$address);
	$this->assign('show',$show);
	if(!empty($show['wldh'])){
		$wlxx=$this->kd100(picc($show['wlfs'],"xpress","code"),$show['wldh']);
		$this->assign('wlxx',$wlxx["data"]);
	}	
	
	$ddlist=$this->lb('Ddp',"ddbh='".$show["ddbh"]."'",'id desc');
	$this->assign('ddlist',$ddlist);	
	}
	$this->kd=$this->lb('Xpress'," 1",' sort desc');
	
	$isfp=$this->finds("fp",'ddid='.$classid,'id desc');
	$this->assign('isfp',$isfp);	
	$this->display();
}
//回收站6-1
public function hsz(){
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$allid=$_POST['articleid'];
	foreach($allid as $key=>$id){
		$this->del('Dd',"ddbh='".$id."'");
		$this->del('Ddp',"ddbh='".$id."'");
		$ddlist=$this->lb('Ddp',"ddbh='".$id."'",'id desc');
		foreach($ddlist as $key=>$val){
			$this->del('Tk',"ddpid=".$val['id']."");
		}
	}
	echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	if (!empty($_GET['id'])){
	$this->del('Dd',"ddbh='".$_GET['id']."'");
	$this->del('Ddp',"ddbh='".$_GET['id']."'");
	$ddlist=$this->lb('Ddp',"ddbh='".$_GET['id']."'",'id desc');
	foreach($ddlist as $key=>$val){
			$this->del('Tk',"ddpid=".$val['id']."");
		}
	echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	if (!empty($_GET['idd'])){
	//$this->save('Dd',array("ishs"=>0),"ddbh='".$_GET['idd']."'");
	//$this->save('Ddp',array("ishs"=>0),"ddbh='".$_GET['idd']."'");
	echo "<script language='javascript'>location='".$this->ly."';</script>";
	}
	
	$this->qy();
	$ks=$_GET['ks'];
	$js=$_GET['js'];
	$qy=$_GET['qy'];
	$this->assign('ks',$_GET['ks']);
	$this->assign('js',$_GET['js']);
	$where=" and ishs=1";
	if(!empty($_GET['ddbh'])){
	$where.=" and ddbh like '%".$_GET['ddbh']."%'";
	$this->assign('ddbh',$_GET['ddbh']);
	}
	if($qy<>""){
	$where.=" and qy=".(int)$qy."";
	$this->assign('qy',$qy);
	}
	
	if($_GET['passed']<>""){
	$where.=" and passed=".(int)$_GET['passed']."";
	$this->assign('passed',(int)$_GET['passed']);
	}
	
	if (!empty($ks) && !empty($js) && $js>$ks){
	$where=$where." and addtime>=".strtotime($ks)." and addtime<=".strtotime($js)."";
	}	
	

	$arr=$this->arr('Dd',15,' 1 '.$where,'classid desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
	$this->display();
}
//退换货
public  function thh(){				
		$where=" and (tk=1 or tkpassed>0)";
		if(!empty($_GET['title'])){
		$where.=" and (ddbh like '%".$_GET['title']."%')";
		$this->assign('title',$_GET['title']);
		}
		if($_GET['ispassed']<>""){
			$where.=" and tkpassed=".(int)$_GET['ispassed']."";
			$this->assign('ispassed',(int)$_GET['ispassed']);
		}
	    $arr=$this->arr('dd',15,' 1 '.$where,'classid desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//退换货操作
public  function thhcz(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$id=(int)$_POST['id'];
		$ispassed=(int)$_POST['tkpassed'];	
		$content=$_POST['content'];	
		$content=($content)?",".$content:"";		
		$show=$this->finds("Dd",'tk>0 and classid='.$id,'classid desc');		
		if($show){
		
		  $tkshow=$this->finds('Tk'," ddpid=".$show['classid']." ",' id asc');
		  if($show['tkpassed']==0){		  
			$po=array();
			$po['user_id']=$show['user_id'];
			$po['title']=$show['ddbh'];
			$po['addtime']=date("Y-m-d H:i:s");			
			$po['ddpid']=$show['classid'];
			$po['isth']=$show['tk'];
			$po['qy']=1;


			if($ispassed==12){//确认退款
				$po['tktitle']="卖家已退款";
				$po['content']="同意退款，退款金额:".$show['zhprice'].",72小时到帐".$content;
				//退款接口
				if($show['pay']==10){//余额支付		
					$this->update("User","id=".$show['user_id'],"discount",$show['zhprice']);
					$addtime=date("Y-m-d H:i:s");				
				    $this->add("pjl",array("addtime"=>$addtime,"zftime"=>$addtime,"user_id"=>$show['user_id'],"price"=>$show['zhprice'],"sz"=>"退款：".$show['zhprice']."元","ordern"=>$show['ddbh'],"qy"=>1,"passed"=>1,"text"=>"订单退款"));				
				}else{
					$tkddbh=date("Ymdhis").rand(100000,999999);
	                $price=$show['zhprice'];
	                $tranDateTime = date("YmdHis");
	                $ddbh=$show['ddbh'];
	                $orgtranAmt=$show['zhprice'];
	                $orgtranDateTime=$show['jyhtime'];
                    $end=$this->tpaygfb($tkddbh,$price,$tranDateTime,$ddbh,$orgtranAmt,$orgtranDateTime);	
	                if($end=="yes"){
	                    echo 'ok';
	                }else{
	                    echo $end;
						echo "退款接口失败!";
						exit;
	                }
				}
				$this->save("Ddp",array("passed"=>4,"ispassed"=>12),"ddbh='".$show['ddbh']."'");
		        $this->save("Dd",array("passed"=>4,"tktime"=>time(),"tkpassed"=>12),"classid=".$show['classid']."");
				$this->update1("user","id=".$show['user_id'],"orderprice",$show['zhprice']);
				$mess=array($show['ddbh'],"卖家已退款");	
		        $this->sendinfo(picc($show['user_id'],"user","username"),$mess,7);	
					
		  }elseif($ispassed==11){//拒绝退款
			  $po['tktitle']="卖家拒绝退款";
			  $po['content']="拒绝退款，退款金额:".$show['zhprice'].$content;						
			  
			  $this->save("Ddp",array("isth"=>0,"ispassed"=>11),"ddbh='".$show['ddbh']."'");
		      $this->save("Dd",array("tk"=>0,"tkpassed"=>11,"tktime"=>time()),"classid=".$show['classid']."");
		      $this->save("rebates",array("is_pay"=>1),"ddbh='".$show['ddbh']."'");	
			  
			  $mess=array($show['ddbh'],"卖家拒绝退款");	
		      $this->sendinfo(picc($show['user_id'],"user","username"),$mess,7);			    
		 }elseif($ispassed==13){//取消订单
			  $po['tktitle']="卖家取消退款";
			  $po['content']="卖家取消退款，退款金额:".$show['zhprice'].$content;
			  	
			  $this->save("Ddp",array("isth"=>0,"ispassed"=>13),"ddbh='".$show['ddbh']."'");
		      $this->save("Dd",array("tk"=>0,"tkpassed"=>13,"tktime"=>time()),"classid=".$show['classid']."");
		      $this->save("rebates",array("is_pay"=>1),"ddbh='".$show['ddbh']."'");				  				
			  	
		      $mess=array($show['ddbh'],"卖家取消退款");	
		      $this->sendinfo(picc($show['user_id'],"user","username"),$mess,7);	   
		 }
		    $this->add('Tk',$po);	     
			   
		  }
		}	
		
		
			
		//
		$this->assign('sx',1);
		$this->display("pub:load");
		exit;
	}
	
	 $id=$_GET['id'];
	 $show=$this->finds("Dd",'(tk>0 or tkpassed>0) and classid='.$id,'classid desc');
	 if($show){
	    $tk=$this->lb('Tk'," ddpid=".$show['classid']." ",' id asc');
		if(!$tk){
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		$this->assign('show',$show);
		$this->assign('tklist',$tk);
		
		$address=str_replace('\\','',$show['address']);
        $address=unserialize($address);
	    $this->assign('address',$address);
	    $ddlist=$this->lb('Ddp',"ddbh='".$show["ddbh"]."'",'id desc');
	    $this->assign('ddlist',$ddlist);
	
	 }
	 else{
		 echo "<script language='javascript'>location='".$this->ly."';</script>";
	 }
	//$list=$this->lb('Tkaddress','names<>""','id desc');
	//$this->assign('address',$list);	
	 $this->display();
}
public  function tpaygfb($tkddbh,$price,$tranDateTime,$ddbh,$orgtranAmt,$orgtranDateTime){	
     $signStr='tranCode=[4010]merchantID=[0000053156]merOrderNum=['.$tkddbh.']tranAmt=['.$price.']ticketAmt=[]tranDateTime=['.$tranDateTime.']currencyType=[156]merURL=[]customerEMail=[]authID=[]orgOrderNum=['.$ddbh.']orgtranDateTime=['.$orgtranDateTime.']orgtranAmt=['.$orgtranAmt.']orgTxnType=[8888]orgTxnStat=[0000]msgExt=[]virCardNo=[0000000002000008909]virCardNoIn=[]tranIP=[127.0.0.1]isLocked=[]feeAmt=[0]respCode=[0000]VerficationCode=[2017guotan]';
	 $this->log_resultall("【接收到国付宝退款明码】:\n".$signStr."\n");

	  $signValue = md5($signStr);
	  $date='version=1.0&tranCode=4010&merchantID=0000053156&merOrderNum='.$tkddbh.'&tranAmt='.$price.'&currencyType=156&merURL=&customerEMail=&tranDateTime='.$tranDateTime.'&virCardNo=0000000002000008909&virCardNoIn=&tranIP=127.0.0.1&feeAmt=0&orgOrderNum='.$ddbh.'&orgtranDateTime='.$orgtranDateTime.'&orgtranAmt='.$orgtranAmt.'&orgTxnStat=0000&orgTxnType=8888&respCode=0000&merchantEncode=UTF-8&signValue='.$signValue.'';
	  $this->log_resultall("【接收到国付宝退款数据】:\n".$date."\n");
	  $host='https://gateway.gopay.com.cn/Trans/WebClientAction.do';      
	  $xml=$this->curlpost($date,$host);
	  //echo $xml;
	  //exit;
	  $this->log_resultall("【接收到国付宝退款返回数据】:\n".$xml."\n");
	  $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	  if($array_data['respCode']=='1000'){
	     return "yes";
		 
	  }else{
	     return $array_data['msgExt'];		 
	  }	  
}
//退款更新
public  function tkgx($id,$tkprice,$yjprice,$flfs){
    $show=$this->finds('Ddp'," id=".$id." and ishs=0 and qy<2",'id desc');
	if($show){
		$othershow=$this->finds('Ddp'," ddbh='".$show['ddbh']."' and id<>".$id."  and isth=0 and ishs=0",'id desc');
		if($othershow){
           $yjlist=$this->lb('Rebates'," ddbh='".$show['ddbh']."'",' id asc');
		   foreach($yjlist as $key=>$val){
			 if($flfs==1){
				$amount=$val['amount']-$yjprice;
			 }else{
				$amount=$val['amount']-$tkprice;
			 }
			 $amountdl=$val['amount']-$tkprice;
		    
			 $amount=($amount<=0)?0:$amount;
			 $amountdl=($amountdl<=0)?0:$amountdl;
			 if($val['vip']>=C("dqvip") && ($val['user_id']!=$val['tj_id'])){
				 $money = $amountdl-$amountdl*$val['ratio'];
				 $amount=$amountdl;
			 }else{
				 $money =$amount*$val['ratio'];				 
			 }
			 $money=($money<=0)?0:$money;
		     $this->save("Rebates",array("amount"=>$amount,"money"=>$money),"id=".$val['id']." and isjs=0");
		   
		   }
		}else{
			 $this->save("Rebates",array("is_pay"=>2),"ddbh='".$show['ddbh']."' and isjs=0");//全部退
			 $this->save("Dd",array("passed"=>4),"ddbh='".$show['ddbh']."'");
		}
	}
}
//sale6-1
public  function sale(){
	$time=date("Y-m-d");
	$stime=date("Y-m-01",time());
	$ks=$_GET['ks'];
	$js=$_GET['js'];

	$where=" 1 ";
	$where1=" 1 ";
	$wheretk=" 1 ";
	$whereyj=" 1 ";
	if (!empty($ks) && !empty($js) && $js>$ks){
	$where=$where." and isthtime>=".strtotime($ks)." and isthtime<=".strtotime($js)."";
	$where1=$where1." and fktime>=".strtotime($ks)." and fktime<=".strtotime($js)."";
	$wheretk=$wheretk." and date_format(addtime,'%Y-%m-%d')>='$ks' and date_format(addtime,'%Y-%m-%d')<='$js'";
	$whereyj=$whereyj." and date_format(add_time,'%Y-%m-%d')>='$ks' and date_format(add_time,'%Y-%m-%d')<='$js'";
	$this->assign('ks',$ks);
	$this->assign('js',$js);
	$this->assign('time',$ks."到".$js."的");
	}
	else{
	$where=$where." and isthtime>=".strtotime($stime)." and isthtime<=".strtotime($time)."";
	$where1=$where1." and fktime>=".strtotime($stime)." and fktime<=".strtotime($time)."";
	$wheretk=$wheretk." and date_format(addtime,'%Y-%m-%d')>='$stime' and date_format(addtime,'%Y-%m-%d')<='$time'";
	$whereyj=$whereyj." and date_format(add_time,'%Y-%m-%d')>='$stime' and date_format(add_time,'%Y-%m-%d')<='$time'";
	$this->assign('time',"当月");
	}	
	$tj1=$this->finds22('dd',$where1." and qy<2 and passed>0 and passed<4","classid");
	//$tj2=$this->finds22('dd',$where1." and qy=2 and passed=3","classid");
	$tj3=$this->finds33('Tk',$wheretk." and isth=1 and first=1","id","price");
	$tj33=$this->finds33('Tk',$wheretk." and isth=2 and first=1","id","price");
	//$tj4=$this->finds33('Tk',$wheretk." and first=1","id","price");
	$tj5=$this->finds33('Rebates',$whereyj." and is_pay=1","id","money");
	$tj6=$this->finds33('Rebates',$whereyj." and is_pay=1 and isjs=1","id","money");
	$tj7=$this->finds33('Rebates',$whereyj." and is_pay=1 and isjs=0","id","money");
	//$tj8=$this->tj('Tk',$where." and isth=3 and first=1");
	
	$arr=array(
	array("title"=>"商品订单","sl"=>formatmoney((float)$tj1['count'])),
	//array("title"=>"积分订单(分)","sl"=>formatmoney((float)$tj2['count'])),
	//array("title"=>"退款退货订单","sl"=>formatmoney((float)$tj4['count'])),
	//array("title"=>"退款订单","sl"=>formatmoney((float)$tj3['count'])),	
	//array("title"=>"退货订单","sl"=>formatmoney((float)$tj33['count'])),	
	//array("title"=>"换货订单数","sl"=>formatmoney((float)$tj8)),
	
	array("title"=>"总返利酒币","sl"=>formatmoney((float)$tj5['count'])),
	array("title"=>"酒币已结算","sl"=>formatmoney((float)$tj6['count'])),
	array("title"=>"酒币未结算","sl"=>formatmoney((float)$tj7['count'])),
	);	
	$this->assign('arr',$arr);
	$this->display();
}
//总佣金6-1
public  function yj(){
    $user_id=$_GET['user_id'];
	$where=" ";
	if(!empty($user_id)){
		$where.=" and tj_id=".$user_id."";
		$this->assign('user_id',(int)$user_id);
	}
	if(!empty($_GET['ddbh'])){
		$where.=" and ddbh like '%".$_GET['ddbh']."%'";
		$this->assign('ddbh',$_GET['ddbh']);
	}	
	if($_GET['ispay']<>""){
		$where.=" and is_pay=".$_GET['ispay']."";
		$this->assign('ispay',$_GET['ispay']);
	}	
	if($_GET['isjs']<>""){
		$where.=" and isjs=".$_GET['isjs']."";
		$this->assign('isjs',$_GET['isjs']);
	}	
	if(!empty($_GET['ddbh'])){
		$where.=" and ddbh like '%".$_GET['ddbh']."%'";
		$this->assign('ddbh',$_GET['ddbh']);
	}	

	$arr=$this->arr('Rebates',15,' 1 '.$where,'id desc');
	$this->assign('arr',$arr['list']);
	$this->assign('fpage',$arr['show']);	
	$this->assign('count',$arr['count']);
    $this->display();
}
//订单打印6-1
public function prints(){	
	$classid=(int)$_GET['classid'];	
	if(!empty($classid)){
		$show=$this->finds("Dd",'classid='.$classid,'classid desc');
		$address=str_replace('\\','',$show['address']);
		$address=unserialize($address);
		$this->assign('address',$address);
		$this->assign('show',$show);	
		$ddlist=$this->lb('Ddp',"ddbh='".$show["ddbh"]."'",'id desc');
		$this->assign('ddlist',$ddlist);	
	}	
	$this->display();
}
//发票列表	
public function fp(){
       if (!empty($_GET['id'])){
			$id=(int)$_GET['id'];
			$show=$this->finds("fp",'id='.$id,'id desc');
			if($show){
                $this->save("dd",array("fpid"=>0),"classid=".$show['ddid']);
				$this->del('fp','id='.$show['id']);
			}
			echo "<script language='javascript'>location='".$this->ly."';</script>";
			exit;
		}
		
	   	$where=" and dd.fpid>0 and dd.passed>0 and dd.passed<4";// 
		$ddbh=$_GET['ddbh'];		
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$passed=$_GET['passed'];
		
		if(!empty($ddbh)){			
			$where.=" and dd.ddbh ='".$ddbh."' ";
			$this->assign('ddbh',$ddbh);
		}		
		if (!empty($ks) && !empty($js)){
			$where=$where." and fp.stime>='".strtotime($ks)."' and fp.stime<='".strtotime($js)."'";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}		
		if($passed<>""){
			$where.=" and fp.issend=".(int)$passed."";
			$this->assign('passed',(int)$passed);
		}
		$rv=D('FpView');
        $arr = $rv->getListPage(20,' 1 '.$where,'dd.classid desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
        $this->display();
}
//发票操作
public function fpd(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$id=(int)$_POST['id_not'];
		$ly=$_POST['ly_not'];
		$issend=(int)$_POST['issend'];
		$isfp=$this->finds("fp",'id='.$id,'id desc');
		if($isfp){
		if($isfp['issend']==1){	
		   unset($_POST['issend']);
		}else{
		   $_POST['stime']=time();
		}					
		$nr=$this->build_sql($_POST);		
		$this->save("fp",$nr,"id=".$id);
		echo "<script language='javascript'>location='".$ly."';</script>";
		exit;
		}
	}
	
	$id=(int)$_GET['id'];	
	if(!empty($id)){
	$isfp=$this->finds("fp",'id='.$id,'id desc');
	$this->assign('isfp',$isfp);
	$show=$this->finds("dd",'classid='.$isfp['ddid'],'classid desc');
	$address=str_replace('\\','',$show['address']);
    $address=unserialize($address);
	$this->assign('address',$address);
	$this->assign('show',$show);	
	$ddlist=$this->lb('Ddp',"ddbh='".$show["ddbh"]."'",'id desc');
	$this->assign('ddlist',$ddlist);	
	}
	$this->display();
}
}
?>