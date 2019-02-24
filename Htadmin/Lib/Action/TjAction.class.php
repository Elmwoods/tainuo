<?php
if(!defined("ni8shop")) exit("Access Denied");
class TjAction extends PublicAction {
public function __construct(){ 
		 parent::__construct(); 
		 $this->checkuserb();
		 $this->adminlog();	
		 $this->ly=$_SERVER['HTTP_REFERER'];
}
//区域
public function qy(){
		 if(isset($_GET['qy'])){
		 if($_GET['qy']<>""){
			cookie('qy',(int)$_GET['qy']);
		 }
		 else{
			//cookie('qy',0);
			}
		}
}
//会员统计
public  function user(){
		$where="";
		$uname=$_GET['uname'];
		$realname=$_GET['realname'];
		$qy=$_GET['qy'];
		$vip=$_GET['vip'];
		$lx=$_GET['lx'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		
		if(!empty($uname)){
			$where.=" and username='".$uname."'";
			$this->assign('uname',$uname);
		}
		if(!empty($realname)){			
			$where.=" and (nickname like '%".$realname."%' or contact like '%".$realname."%')";
			$this->assign('realname',$realname);
		}		
		if($qy<>""){
			$where.=" and qy=".(int)$qy."";
			$this->assign('qy',(int)$qy);
		}
		if($vip<>""){
			$where.=" and vip=".(int)$vip."";
			$this->assign('vip',(int)$vip);
		}
		if(!empty($lx) && !empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and ".$lx.">".(int)$money."";
			if($bj=="eq")$where.=" and ".$lx."=".(int)$money."";
			if($bj=="lt")$where.=" and ".$lx."<".(int)$money."";
			$this->assign('lx',$lx);
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		
		if(!empty($where)){
		   cookie('usereport',$where);
		}
		else{
		   cookie('usereport',NULL);
		}
	    $arr=$this->arr('User',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//会员导出
public function userexport(){
       $where=cookie('usereport');
	   $arr=$this->lb('User',' 1 '.$where,'id desc');
	   $this->head("userlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >用户ID</td>
				  <td >会员账户</td>
				  <td >电话号码</td>
				  <td >邮箱地址</td>
				  <td >真实姓名</td>
				  <td >昵称</td>
				  <td >会员级别</td>
				  <td >会员类型</td>
				  <td >账户余额</td>
				  <td >佣金酒币</td>				 
				  <td >酒币余额</td>
				  <td >审核状态</td>
				  <td >公众号关注</td>
				  <td >注册时间</td>
				  </tr>'; 
	   foreach($arr as $key=>$val){
	       $qy=($val['qy']==0)?'PC端':'微信端';
		   $passed=($val['passed']==1)?'已审核':'未审核';
		   $isgz=($val['subscribe']==0)?'否':'是';
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['username'].'</td>
					   <td >'.$val['moble'].'</td>
					   <td >'.$val['email'].'</td>
					   <td >'.$val['contact'].'</td>
					   <td >'.$val['nickname'].'</td>
					   <td >'.vip($val['vip']).'</td>
					   <td >'.$qy.'</td>
					   <td >'.$val['discount'].'</td>
					   <td >'.$val['balances'].'</td>					  
					   <td >'.$val['pointend'].'</td>
					   <td >'.$passed.'</td>
					   <td >'.$isgz.'</td>
					   <td >'.$val['regtime'].'</td>					  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//拥金提现
public function yj(){
		$where="";
		$uname=$_GET['uname'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$ks1=$_GET['ks1'];
		$js1=$_GET['js1'];
		$passed=$_GET['passed'];
		$clr=$_GET['clr'];
		
		
		if(!empty($uname)){
		    $userid=$this->getf("User","username ='".$uname."'",'id desc','id');
			$where.=" and user_id IN (".$this->userstr($userid).")";
			$this->assign('uname',$uname);
		}
		if(!empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and price>".(int)$money."";
			if($bj=="eq")$where.=" and price=".(int)$money."";
			if($bj=="lt")$where.=" and price<".(int)$money."";
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		if (!empty($ks) && !empty($js)){
			$where=$where." and addtime>='".$ks."' and addtime<='".$js."'";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}
		if (!empty($ks) && empty($js)){
			$where=$where." and addtime>='".$ks."' ";
			$this->assign('ks',$ks);
		}
		if (empty($ks) && !empty($js)){
			$where=$where." and addtime<='".$js."'";
			$this->assign('js',$js);
		}
		if (!empty($ks1) && !empty($js1)){
			$where=$where." and cltime>='".$ks1."' and cltime<='".$js1."'";
			$this->assign('ks1',$ks1);
			$this->assign('js1',$js1);
		}
		if (!empty($ks1) && empty($js1)){
			$where=$where." and cltime>='".$ks1."' ";
			$this->assign('ks1',$ks1);
		}
		if (empty($ks1) && !empty($js1)){
			$where=$where." and cltime<='".$js1."'";
			$this->assign('js1',$js1);
		}
			
		if($passed<>""){
			$where.=" and passed=".(int)$passed."";
			$this->assign('passed',(int)$passed);
		}
		if(!empty($clr)){
			$where.=" and clr='".$clr."'";
			$this->assign('clr',$clr);
		}
		
		if(!empty($where)){
		   cookie('yjeport',$where);
		}
		else{
		   cookie('yjeport',NULL);
		}
	    $arr=$this->arr('Jl',15,' 1 and qy=2 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//拥金提现导出
public function yjexport(){
       $where=cookie('yjeport');
	   $arr=$this->lb('Jl',' 1 and qy=2 '.$where,'id desc');
	   $this->head("yjlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >ID</td>
				  <td >会员id</td>
				  <td >Openid/账户名</td>
				  <td >真实姓名</td>
				  <td >提现金额</td>
				  <td >提现状态</td>
				  <td >提现时间</td>
				  <td >处理时间</td>
				  <td >处理人</td>
				  <td >说明</td>
				  <td >处理备注</td>				  
				  </tr>'; 
	   foreach($arr as $key=>$val){
		   $passed=($val['passed']==1)?'已审核':'未审核';
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['user_id'].'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td >'.hygroup("user","id",$val['user_id'],"id","contact").'</td>
					   <td >'.$val['price'].'</td>
					   <td >'.$passed.'</td>
					   <td >'.$val['addtime'].'</td>
					   <td >'.$val['cltime'].'</td>
					   <td >'.$val['clr'].'</td>
					   <td >'.$val['sz'].'</td>
					   <td >'.$val['text'].'</td>					   			  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//帐户提现6-1
public function zh(){
		$where="";
		$uname=$_GET['uname'];
		$kh=$_GET['kh'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$ks1=$_GET['ks1'];
		$js1=$_GET['js1'];
		$passed=$_GET['passed'];
		$clr=$_GET['clr'];
		
		
		if(!empty($uname)){
		    $userid=$this->getf("User","username ='".$uname."'",'id desc','id');
			$where.=" and user_id=".$userid."";
			$this->assign('uname',$uname);
		}
		if(!empty($kh)){
			$where.=" and kh='".$kh."'";
			$this->assign('kh',$kh);
		}
		if(!empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and price>".(int)$money."";
			if($bj=="eq")$where.=" and price=".(int)$money."";
			if($bj=="lt")$where.=" and price<".(int)$money."";
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		if (!empty($ks) && !empty($js)){
			$where=$where." and time>=".strtotime($ks)." and time<=".strtotime($js)."";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}
		if (!empty($ks) && empty($js)){
			$where=$where." and time>=".strtotime($ks)." ";
			$this->assign('ks',$ks);
		}
		if (empty($ks) && !empty($js)){
			$where=$where." and time<=".strtotime($js)."";
			$this->assign('js',$js);
		}
		if (!empty($ks1) && !empty($js1)){
			$where=$where." and shtime >=".strtotime($ks1)." and shtime <=".strtotime($js1)."";
			$this->assign('ks1',$ks1);
			$this->assign('js1',$js1);
		}
		if (!empty($ks1) && empty($js1)){
			$where=$where." and shtime >=".strtotime($ks1)." ";
			$this->assign('ks1',$ks1);
		}
		if (empty($ks1) && !empty($js1)){
			$where=$where." and shtime <=".strtotime($js1)."";
			$this->assign('js1',$js1);
		}
			
		if($passed<>""){
			$where.=" and passed=".(int)$passed."";
			$this->assign('passed',(int)$passed);
		}
		if(!empty($clr)){
			$where.=" and clr='".$clr."'";
			$this->assign('clr',$clr);
		}
		
		if(!empty($where)){
		   cookie('zheport',$where);
		}
		else{
		   cookie('zheport',NULL);
		}
	    $arr=$this->arr('Yhtx',15,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//帐户提现导出6-1
public function zhexport(){
       $where=cookie('zheport');
	   $arr=$this->lb('Yhtx',' 1 '.$where,'id desc');
	   $this->head("zhlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >ID</td>
				  <td >会员id</td>
				  <td >会员账户</td>
				  <td >银行</td>
				  <td >银行卡号</td>
				  <td >姓名</td>
				  <td >提现金额</td>
				  <td >提现时间</td>
				  <td >处理时间</td>
				  <td >处理状态</td>
				  <td >处理人</td>
				  <td >处理备注</td>				  
				  </tr>'; 
	   foreach($arr as $key=>$val){
		   $passed=txpass($val['passed']);
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['user_id'].'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td >'.$val['yhname'].'</td>
					   <td >"'.$val['kh'].'"</td>
					   <td >'.$val['name'].'</td>
					   <td >'.$val['price'].'</td>
					   <td >'.date("Y-m-d H:i:s",$val['time']).'</td>
					   <td >'.date("Y-m-d H:i:s",$val['shtime']).'</td>
					   <td >'.$passed.'</td>
					   <td >'.$val['clr'].'</td>					   
					   <td >'.$val['text'].'</td>					   			  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//充值记录6-1
public function cz(){
        $where=" and qy=1 and passed=1";
		$uname=$_GET['uname'];
		$order=$_GET['order'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$passed=$_GET['passed'];

		
		
		if(!empty($uname)){
		    $userid=$this->getf("User","username ='".$uname."'",'id desc','id');
			$where.=" and user_id=".$userid."";
			$this->assign('uname',$uname);
		}
		if(!empty($order)){
			$where.=" and ordern='".$order."'";
			$this->assign('order',$order);
		}
		if(!empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and price>".(int)$money."";
			if($bj=="eq")$where.=" and price=".(int)$money."";
			if($bj=="lt")$where.=" and price<".(int)$money."";
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		if (!empty($ks) && !empty($js)){
			$where=$where." and zftime>='".$ks."' and zftime<='".$js."'";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}
		if (!empty($ks) && empty($js)){
			$where=$where." and zftime>='".$ks."' ";
			$this->assign('ks',$ks);
		}
		if (empty($ks) && !empty($js)){
			$where=$where." and zftime<='".$js."'";
			$this->assign('js',$js);
		}
			
		if($passed<>""){
		    if($passed==0)$where.=" and sz not like '%后台%'";
			if($passed==1)$where.=" and sz like '%后台%'";
			$this->assign('passed',(int)$passed);
		}
		
		
		if(!empty($where)){
		   cookie('czeport',$where);
		}
		else{
		   cookie('czeport',NULL);
		}

		$arr=$this->arr('pjl',20,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//充值记录导出
public function czexport(){
       $where=cookie('czeport');
	   $arr=$this->lb('pjl',' 1 '.$where,'id desc');
	   $this->head("czlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >ID</td>
				  <td >会员id</td>
				  <td >账户账户</td>
				  <td >姓名</td>
				  <td >充值金额</td>
				  <td >订单号</td>
				  <td >提交时间</td>
				  <td >支付时间</td>
				  <td >充值状态</td>
				  <td >说明</td>
				  <td >处理备注</td>			  
				  </tr>'; 
	   foreach($arr as $key=>$val){
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['user_id'].'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td >'.hygroup("user","id",$val['user_id'],"id","contact").'</td>
					   <td >'.$val['price'].'</td>
					   <td >"'.$val['ordern'].'"</td>
					   <td >'.$val['addtime'].'</td>
					   <td >'.$val['zftime'].'</td>
					   <td >充值成功</td>
					   <td >'.$val['sz'].'</td>					   
					   <td >'.$val['text'].'</td>					   			  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//资金记录6-1
public function zj(){
        $where=" and passed=1";
		$uname=$_GET['uname'];
		$order=$_GET['order'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$passed=$_GET['passed'];

		
		
		if(!empty($uname)){
		    $userid=$this->getf("User","username ='".$uname."'",'id desc','id');
			$where.=" and user_id=".$userid."";
			$this->assign('uname',$uname);
		}
		if(!empty($order)){
			$where.=" and ordern='".$order."'";
			$this->assign('order',$order);
		}
		if(!empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and price>".(int)$money."";
			if($bj=="eq")$where.=" and price=".(int)$money."";
			if($bj=="lt")$where.=" and price<".(int)$money."";
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		if (!empty($ks) && !empty($js)){
			$where=$where." and addtime>='".$ks."' and addtime<='".$js."'";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}
		if (!empty($ks) && empty($js)){
			$where=$where." and addtime>='".$ks."' ";
			$this->assign('ks',$ks);
		}
		if (empty($ks) && !empty($js)){
			$where=$where." and addtime<='".$js."'";
			$this->assign('js',$js);
		}		
		
		if(!empty($where)){
		   cookie('zjeport',$where);
		}
		else{
		   cookie('zjeport',NULL);
		}
		$arr=$this->arr('pjl',20,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//资金记录导出
public function zjexport(){
       $where=cookie('zjeport');
	   $arr=$this->lb('pjl',' 1 '.$where,'id desc');
	   $this->head("zjlist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >ID</td>
				  <td >会员id</td>
				  <td >账户账号</td>
				  <td >姓名</td>
				  <td >影响金额</td>
				  <td >订单号</td>
				  <td >交易时间</td>
				  <td >支付时间</td>
				  <td >状态</td>
				  <td >说明</td>
				  <td >处理备注</td>			  
				  </tr>'; 
	   foreach($arr as $key=>$val){
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['user_id'].'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td >'.hygroup("user","id",$val['user_id'],"id","contact").'</td>
					   <td >'.$val['price'].'</td>
					   <td >"'.$val['ordern'].'"</td>
					   <td >'.$val['addtime'].'</td>
					   <td >'.$val['zftime'].'</td>
					   <td >完成</td>
					   <td >'.$val['sz'].'</td>					   
					   <td >'.$val['text'].'</td>					   			  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//佣金流水记录6-1
public function yjls(){
        $where="  ";
		$uname=$_GET['uname'];
		$tjname=$_GET['tjname'];
		$order=$_GET['order'];
		$bj=$_GET['bj'];
		$money=$_GET['money'];
		$bj1=$_GET['bj1'];
		$money1=$_GET['money1'];
		$ks=$_GET['ks'];
		$js=$_GET['js'];
		$is_pay=$_GET['is_pay'];
		$isjs=$_GET['isjs'];
		$ks1=$_GET['ks1'];
		$js1=$_GET['js1'];		
		
		if(!empty($uname)){
		    $userid=$this->getf("User","username ='".$uname."'",'id desc','id');
			$where.=" and user_id=".$userid."";
			$this->assign('uname',$uname);
		}
		if(!empty($tjname)){
		    $userid=$this->getf("User","username ='".$tjname."'",'id desc','id');
			$where.=" and tj_id=".$userid."";
			$this->assign('tjname',$tjname);
		}
		if(!empty($order)){
			$where.=" and ddbh='".$order."'";
			$this->assign('order',$order);
		}
		if(!empty($bj) && !empty($money)){
			if($bj=="gt")$where.=" and amount>".(int)$money."";
			if($bj=="eq")$where.=" and amount=".(int)$money."";
			if($bj=="lt")$where.=" and amount<".(int)$money."";
			$this->assign('bj',$bj);
			$this->assign('money',$money);
		}
		if(!empty($bj1) && !empty($money1)){
			if($bj1=="gt")$where.=" and money>".(int)$money1."";
			if($bj1=="eq")$where.=" and money=".(int)$money1."";
			if($bj1=="lt")$where.=" and money<".(int)$money1."";
			$this->assign('bj1',$bj1);
			$this->assign('money1',$money1);
		}
		if (!empty($ks) && !empty($js)){
			$where=$where." and add_time>='".$ks."' and add_time<='".$js."'";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
		}
		if (!empty($ks) && empty($js)){
			$where=$where." and add_time>='".$ks."' ";
			$this->assign('ks',$ks);
		}
		if (empty($ks) && !empty($js)){
			$where=$where." and add_time<='".$js."'";
			$this->assign('js',$js);
		}	
		if($is_pay<>""){
			$where.=" and is_pay=".$is_pay."";
			$this->assign('is_pay',$is_pay);
		}
		if($isjs<>""){
			$where.=" and isjs=".$isjs."";
			$this->assign('isjs',$isjs);
		}		
		if (!empty($ks1) && !empty($js1)){
			$where=$where." and jstime>=".strtotime($ks1)." and jstime<=".strtotime($js1)."";
			$this->assign('ks1',$ks1);
			$this->assign('js1',$js1);
		}
		if (!empty($ks1) && empty($js1)){
			$where=$where." and jstime>=".strtotime($ks1)."";
			$this->assign('ks1',$ks1);
		}
		if (empty($ks1) && !empty($js1)){
			$where=$where." and jstime<=".strtotime($js1)."";
			$this->assign('js1',$js1);
		}	
		if(!empty($where)){
		   cookie('yjlseport',$where);
		}
		else{
		   cookie('yjlseport',NULL);
		}
		$arr=$this->arr('Rebates',20,' 1 '.$where,'id desc');
		$this->assign('arr',$arr['list']);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
}
//佣金流水导出
public function yjlsexport(){
       $where=cookie('yjlseport');
	   $arr=$this->lb('Rebates',' 1 '.$where,'id desc');
	   $this->head("yjlslist");
	   $filename='<tr>
	              <td >序号</td>
				  <td >ID</td>
				  <td >买家id</td>
				  <td >买家账户名</td>
				  <td >呢称</td>
				  <td >订单号</td>
				  <td >订单时间</td>
				  <td >订单状态</td>
				  <td >交易时间</td>
				  <td >结算时间</td>
				  <td >佣金会员名</td>
				  <td >佣金会员名呢称</td>
				  <td >佣金会员等级</td>
				  <td >总金额</td>
				  <td >比列</td>	
				  <td >返利酒币</td>
				  <td >结算</td>				  
				  </tr>'; 
	   foreach($arr as $key=>$val){
		   if($val["is_pay"]=="0"){
			 $is_pay="未支付";
		   }elseif($val["is_pay"]=="1"){
			 $is_pay="已支付";
		   }elseif($val["is_pay"]=="2"){
			 $is_pay="已退款";
		   }
		   if($val["jstime"]>0){
		     $jstime=date("Y-m-d H:i:s",$val['jstime']);
		   }else{
		     $jstime="暂无结算时间";
		   }	
		   if($val["isjs"]==0){
		     $isjs="否";
		   }else{
		     $isjs="是";
		   }   
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td >'.$val['id'].'</td>
					   <td >'.$val['user_id'].'</td>
					   <td >'.ly($val['user_id']).'</td>
					   <td >'.hygroup("user","id",$val['user_id'],"id","nickname").'</td>
					   <td >"'.$val['ddbh'].'"</td>
					   <td >"'.date("Y-m-d H:i:s",$val['order_time']).'"</td>
					   <td >'.$is_pay.'</td>
					   <td >'.$val['add_time'].'</td>
					   <td >'.$jstime.'</td>
					    <td >'.ly($val['tj_id']).'</td>
					   <td >'.hygroup("user","id",$val['tj_id'],"id","nickname").'</td>
					   <td >'.vip(hygroup("user","id",$val['tj_id'],"id","vip")).'</td>
					   <td >'.$val['amount'].'</td>					   
					   <td >'.$val['ratio'].'</td>	
					   <td >'.$val['money'].'</td>
					   <td >'.$isjs.'</td>				   			  
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
}
//收藏统计6-1
public function pro(){
        $where=" and passed=1";
		$title=$_GET['title'];		
		
		if(!empty($title)){
			$where.=" and title like '%".$title."%'";
			$this->assign('title',$title);
		}		
		
		$arr=$this->arr('Pro',20,' 1 '.$where,'id desc');
		$arrs=array();
		foreach($arr['list'] as $key=>$val){
		$val["sl"]=$this->tj('scj',"id=".$val['id']." and qy=1");
		$show=$this->finds('scj'," id=".$val['id']." and qy=1",'classid desc');
		$val["user_name"]=$show['user_name'];
		$val["ip"]=$show['ip'];
		$val["time"]=$show['time'];
		$arrs[]=$val;
		}
		$this->assign('arr',$arrs);
		$this->assign('fpage',$arr['show']);	
		$this->assign('count',$arr['count']);
		$this->display();
  
}
//商品销售统计6-1
public function salepro(){
   $where=" and Ddp.passed>0 and Ddp.passed<4 and Ddp.isth=0";
   $classid=(int)$_GET['classid'];
   $ks=$_GET['ks'];
   $js=$_GET['js'];
   $sort=$_GET['sort'];
   if($sort == 'desc'){
        $ext = 'asc';
        $sort_str = '↑';
  	  }else{
        $ext = 'desc';
        $sort_str = '↓';
  	  }
	if(!empty($classid)){
        	$where.=" and Pro.link_id like '%|".$classid."|%'";
			$this->assign('classid',$classid);
    }
	if (!empty($ks) && !empty($js)){
			$where=$where." and Ddp.fktime>=".strtotime($ks)." and Ddp.fktime<=".strtotime($js)."";
			$this->assign('ks',$ks);
			$this->assign('js',$js);
	}
	if (!empty($ks) && empty($js)){
			$where=$where." and Ddp.fktime>=".strtotime($ks)." ";
			$this->assign('ks',$ks);
	}
	if (empty($ks) && !empty($js)){
			$where=$where." and Ddp.fktime<=".strtotime($js)."";
			$this->assign('js',$js);
	}	
	if(!empty($where)){
		   cookie('saleproeport',$where);
	}
		else{
		   cookie('saleproeport',NULL);
	}
   $sort  = ($sort) ? $sort : 'desc';//排序方式
   
   $rv=D('ProsaleView');

   $arr = $rv->getListPage(20,' 1 '.$where,'Pro.id desc');	
   $max_money = 0;
   foreach ($arr['list'] as $key => $value) {
     $max_money += $value['pro_max_money'];
   }
   $list    = $this->array_sort($arr['list'],'pro_max_money',$sort);
   $this->assign('arr',$list);
   $this->assign('fpage',$arr['show']);	
   $this->assign('count',$arr['count']);
   
   $this->assign('max_money',$max_money);
   $this->assign('ext',$ext);
   $this->assign('sort_str',$sort_str);
   $this->cthree("Typepro",' and qy=1');
   $this->display();
}
//6-1
public function salepros(){
   $id=(int)$_GET['id'];
    $ks=$_GET['ks'];
	$js=$_GET['js'];
	$ks1=$_GET['ks1'];
	$js1=$_GET['js1'];
	$this->assign('ks',$_GET['ks']);
	$this->assign('js',$_GET['js']);
	$this->assign('ks1',$_GET['ks1']);
	$this->assign('js1',$_GET['js1']);
   $this->assign('id',$_GET['id']);
   $where=' and passed>0 and passed<4 and isth=0 and pr_id='.$id.'';
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
   $arr=$this->arr('Ddp',15,' 1 '.$where,'id desc');
   $arrs=array();
   foreach($arr['list'] as $key=>$val){
      $dd=$this->finds("dd","ddbh='".$val['ddbh']."'",'classid desc');
	  $js=$this->tj("Ddp","ddbh='".$val['ddbh']."'",true);
	  if($js==1){
	    $val['mj']=$dd['mj'];
		$val['yhq']=$dd['yhq'];
		$val['jb']=$dd['pointp'];
		$val['yf']=$dd['kdfsprice'];
		$val['price1']=$dd['prices'];
		$val['price2']=$dd['zkprice'];
		$val['price3']=$dd['zhprice'];
	  }else{
	    $ddpricebl=$val['price']/$dd['pprice'];
		$val['mj']=number_format($dd['mj']*$ddpricebl,"2",".","");
		$val['yhq']=number_format($dd['yhq']*$ddpricebl,"2",".","");
		$val['jb']=number_format($dd['pointp']*$ddpricebl,"2",".","");
		$val['yf']=number_format($dd['kdfsprice']*$ddpricebl,"2",".","");
		$val['price1']=number_format(($val['price']-$val['mj']-$val['yhq']-$val['jb']-$val['yf']),"2",".","");
		$val['price2']=number_format($dd['zkprice']*$ddpricebl,"2",".","");
		$val['price3']=number_format(($val['price1']-$val['price2']),"2",".","");
	  }	
      $arrs[]=$val;
   }
   $this->assign('arr',$arrs);
   $this->assign('fpage',$arr['show']);	
   $this->assign('count',$arr['count']);
   $this->display();
}
//商品销售统计导出
public function saleproexport(){
       $where=cookie('saleproeport');
	   $rv=D('ProsaleView');
	   $arr = $rv->getListPage(20,' 1 '.$where,'id desc');	
	   $max_money = 0;
	   foreach ($arr['list'] as $key => $value) {
		 $max_money += $value['pro_max_money'];
	   }
	   $list    = $this->array_sort($arr['list'],'pro_max_money',"desc");
	   $this->head("saleprolist");
	   $filename='<tr>
	              <td>序号</td>
				  <td>ID</td>
				  <td>产品名称</td>
				  <td>累计销量</td>
				  <td>累计销售额</td>
				  <td>所占比例</td>				  			  
				  </tr>'; 
	   foreach($list as $key=>$val){
		   $filename.='<tr>
		               <td>'.($key+1).'</td>
		               <td>'.$val['id'].'</td>
					   <td>'.$val['title'].'</td>
					   <td>'.(($val['num'])?$val['num']:"0").'</td>
					   <td>'.(($val['pro_max_money'])?$val['pro_max_money']:"0").'</td>
					   <td>"'.sprintf("%.2f",($val['pro_max_money']/$max_money*100)).'%"</td>
					   </tr>'; 
	   }
	   //$filename=iconv("utf-8", "gb2312", $filename); 
	   echo '<table width="1000" border="1">'.$filename.'</table>';
  
}
//网站资金统计6-1
public function wzzj(){
    $data=array();//
    $ks=$_GET['ks'];
    $js=$_GET['js'];
	if(!empty($ks)){
		$this->ks1=strtotime($ks);
		$this->start=$ks;
		$this->assign('ks',$ks);
	}
	if(!empty($js)){
		$this->js1=strtotime($js);
		$this->ends=$js;
		$this->assign('js',$js);
	}
	$this->type = 1;  
	if( $ks || $js){
	       if($ks && $js){
          	   $this->type = 2;
	       }else if($ks){
          	   $this->type = 3;
	       }else{
          	   $this->type = 4;
	       }
	}
		
   $data['user']=$this->user_data();
   $data['yj']=$this->yj_data();
   $data['cz']=$this->cz_data();
   $data['order']=$this->order_data();
   $data['js']=$this->js_data();
   $data['tx']=$this->tx_data();
   $data['fp']=$this->fp_data();
   $data['yhq']=$this->yhq_data();

   $this->assign('data',$data);
   $this->display();
}
//帐户提现6-1
function tx_data(){

        $where = $this->get_where1('WHERE','time');		
		
        $sql   = 'SELECT COUNT(*) a1,SUM(price) a2,SUM(case when `passed` = 0 then `price` end) a3,SUM(case when `passed` = 1 then `price` end) a4,SUM(case when `passed` = 2 then `price` end) a5,SUM(case when `passed` = 3 then `price` end) a6 FROM `ni8_yhtx` '.$where;
		
        $run_data = M("")->query($sql);  
		
		$sql   = 'SELECT SUM(discount) a7,SUM(point) a8,SUM(pointend) a9 FROM `ni8_user` ';
        $out_data = M("")->query($sql);  
		$aa=array();
		if($run_data[0]){
		 $aa=array_merge($aa,$run_data[0]);
		}
		if($out_data[0]){
		 $aa=array_merge($aa,$out_data[0]);
		}		
		return $aa;    
        //return array_merge($run_data[0],$out_data[0]);

}
//结算佣金6-1
function js_data(){

        $where = $this->get_where('WHERE','add_time');		
		
        $sql   = 'SELECT SUM(amount) a1,SUM(money) a2,SUM(case when `is_pay` = 0 then `amount` end) a3,SUM(case when `is_pay` = 1 then `amount` end) a4,SUM(case when `is_pay` = 2 then `amount` end) a5,SUM(case when `is_pay` = 1 then `money` end) a6,SUM(case when `isjs` = 1 and `is_pay` = 1 then `money` end) a7,SUM(case when `isjs` = 0 and `is_pay` = 1 then `money` end) a8 FROM `ni8_rebates` '.$where;
        $run_data = M("")->query($sql);  
		
		    
        return array_merge($run_data[0]);

}
//订单统计6-1
function order_data(){

        $where = $this->get_where1('WHERE','addtime');		
		
        $sql   = 'SELECT COUNT(*) max,COUNT(case when `passed` = 0 then `passed` end) npassed,COUNT(case when `passed` >0 and `passed` <>4  then `passed` end) ypassed,SUM(case when `passed` = 0 then `zhprice` end) price,SUM(case when `passed` >0 and `passed` <>4 then `zhprice` end) yprice FROM `ni8_dd` '.$where;
        $run_data = M("")->query($sql);
		
		

        $where = $this->get_where('WHERE','addtime');
		if($where){
			$where.=" and first=1";
		}else{
			$where=" where first=1";
		}	
        $sql   = 'SELECT SUM(`tk`.price) tkprice,SUM(case when `tk`.isth = 1 then `tk`.price end) tkprice1,SUM(case when `tk`.isth = 2 then `tk`.price end) tkprice2,COUNT(case when `tk`.isth = 3 then `tk`.isth end) tkprice3,COUNT(case when `tk`.isth = 2 then `tk`.isth end) tkprice4,COUNT(case when `tk`.isth = 1 then `tk`.isth end) tkprice5,COUNT(case when `ddp`.ispassed <> 5 and `ddp`.ispassed <> 6 then `tk`.isth end) cl1,COUNT(case when `ddp`.ispassed = 5  then `tk`.isth end) cl2,COUNT(case when `ddp`.ispassed = 6  then `tk`.isth end) cl3 FROM `ni8_tk` tk LEFT JOIN `ni8_ddp` ddp ON `tk`.ddpid = `ddp`.id '.$where;
        $out_data = M("")->query($sql);
		
		$aa=array();
		if($run_data[0]){
		 $aa=array_merge($aa,$run_data[0]);
		}
		if($out_data[0]){
		 $aa=array_merge($aa,$out_data[0]);
		}		
		return $aa;
        //return array_merge($run_data[0],$out_data[0]);

}
//冲值统计6-1
function cz_data(){

        $where = $this->get_where('WHERE','zftime');

		if($where){
			$where.=" and qy=1 and passed=1";
		}else{
			$where=" where qy=1 and passed=1";
		}	
        $sql   = "SELECT COUNT(*) max,COUNT(case when `sz` not like '%后台%' then `passed` end) qt,COUNT(case when `sz` like '%后台%' then `passed` end) ht,SUM(case when `sz` not like '%后台%' then `price` end) qprice,SUM(case when `sz` like '%后台%' then `price` end) hprice,SUM(price) aprice FROM `ni8_pjl` ".$where;
        $run_data = M("")->query($sql);    
        return $run_data[0];

}
//佣金提现
function yj_data(){

        $where = $this->get_where('WHERE','addtime');
		
		if($where){
			$where.=" and qy=3";
		}else{
			$where=" where qy=3";
		}
		
        $sql   = 'SELECT COUNT(*) max,COUNT(case when `passed` = 0 then `passed` end) npassed,COUNT(case when `passed` = 1 then `passed` end) ypassed,SUM(case when `passed` = 0 then `price` end) price,SUM(case when `passed` = 1 then `price` end) yprice,SUM(price) aprice FROM `ni8_jl` '.$where;
        $run_data = M("")->query($sql);

        $sql   = 'SELECT SUM(balances) balances,SUM(balancesend) balancesend,SUM(balancesends) balancesends FROM `ni8_user` ';
        $out_data = M("")->query($sql);
        $aa=array();
		if($run_data[0]){
		 $aa=array_merge($aa,$run_data[0]);
		}
		if($out_data[0]){
		 $aa=array_merge($aa,$out_data[0]);
		}
		
		return $aa;
        //return array_merge($run_data[0], $out_data[0]);

}
//用户统计6-1
function user_data(){
    	$where = $this->get_where('WHERE','`user`.regtime');       
        //一条找出全部 包括跨表
        $sql = 'SELECT COUNT(*) max,COUNT(case when `user`.vip=0 then `user`.vip end) vip1,COUNT(case when `user`.vip = 6 then `user`.vip end) vip2,COUNT(case when `user`.vip = 7 then `user`.vip end) vip3,COUNT(case when `user`.vip = 8 then `user`.vip end) vip4,COUNT(case when `verify`.passed = 0 then `verify`.passed end) ver_passed,COUNT(case when `verify`.passed = 1 then `verify`.passed end) ver_passed1,COUNT(case when `verify`.passed = 2 then `verify`.passed end) ver_passed2 FROM `ni8_user` user LEFT JOIN `ni8_verify` verify ON `user`.id = `verify`.user_id '.$where;
        return M("")->query($sql);

    }
//发票统计
function fp_data(){

        $sql = 'SELECT SUM(case when `dd`.passed >0 and `dd`.passed <>4 then `zhprice` end) p1 FROM `ni8_fp` fp LEFT JOIN `ni8_dd` dd ON `fp`.ddid = `dd`.classid where `fp`.ddid>0';		
        $run_data = M("")->query($sql);    
        return $run_data[0];
		

}
function yhq_data(){

        $sql = 'SELECT SUM(jg) yh1,SUM(case when `yhqlq`.passed=1 then `jg` end) yh2,SUM(case when `yhqlq`.passed=0 and etimes<'.time().' then `jg` end) yh3,SUM(case when `yhqlq`.passed=0 and etimes>'.time().' then `jg` end) yh4 FROM `ni8_yhqlq` yhqlq ';		
        $run_data = M("")->query($sql);    
        return $run_data[0];
		

}
public function head($file){
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");   
		header("Pragma: public");
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");  
		header("Content-Disposition: attachment;filename=".$file.".xls "); 
		header("Content-Transfer-Encoding: binary "); 
}
public function array_sort($arr, $keys, $type = 'desc') {

		$keysvalue = $new_array = array();

		foreach ($arr as $k => $v) {
		$keysvalue[$k] = $v[$keys];
		}

		if ($type == 'asc') {

		asort($keysvalue);
		} else {

		arsort($keysvalue);
		}

		reset($keysvalue);

		foreach ($keysvalue as $k => $v) {

		$new_array[] = $arr[$k];
		}

		return $new_array;
	}
//组合WHERE条件
function get_where($where,$str){
         
        switch ($this->type) {
        	case 1:
        		return '';
        		break;
            case 2:
        		return $where." ".$str." >= '".$this->start."' AND ".$str." <= '".$this->ends."'";
                break;
            case 3:
        		return $where." ".$str." >= '".$this->start."'";
                break;
        	default:
        		return $where." ".$str." <= '".$this->ends."'";
        		break;
        }

    }
function get_where1($where,$str){
         
        switch ($this->type) {
        	case 1:
        		return '';
        		break;
            case 2:
        		return $where." ".$str." >= ".$this->ks1." AND ".$str." <= ".$this->js1."";
                break;
            case 3:
        		return $where." ".$str." >= ".$this->ks1."";
                break;
        	default:
        		return $where." ".$str." <= ".$this->js1."";
        		break;
        }

    }
}
?>