<?php
if(!defined("htqh")) exit("Access Denied");
class PublicAction extends Action
{
    public function _initialize(){
	//获取登录
	  define('ROOT_PATH', str_replace('PublicAction.class.php', '', str_replace('\\', '/', __FILE__)));
	  import('Common.Csession',APP_PATH,'.php');
	  $this->sess = new cls_session();
	  $this->sess->session('user_sessions');
	  //过滤
	  import('Common.Sqlin',APP_PATH,'.php');
	  $dbsql=new sqlin();	
	  import("ORG.Util.String");  
	  if (!empty($_SESSION['user_id']))
     {
	 //获取用户信息
     $this->user=$this->sess->get_user_info('user');
     }	
	 //BANNER图
	 switch(MODULE_NAME){
     case "About":
     if(ACTION_NAME=='index' or ACTION_NAME=='show')
     {
     $banid="1";
     }
	 elseif(ACTION_NAME=='contact')
     {
     $banid="3";
     }
	 elseif(ACTION_NAME=='hr' or ACTION_NAME=='job')
     {
     $banid="2";
     }
     break;
     case "Information":
     if(ACTION_NAME=='index' || ACTION_NAME=='search')
     {
     $banid="4";
     }
	 elseif(ACTION_NAME=='positions')
     {
     $banid="5";
     }
	 elseif(ACTION_NAME=='arbitrage')
     {
     $banid="6";
     }
	 elseif(ACTION_NAME=='lists' or ACTION_NAME=='show'  or ACTION_NAME=='news')
     {
     $banid="7";
     }
	 elseif(ACTION_NAME=='economy')
     {
     $banid="8";
     }
	 elseif(ACTION_NAME=='maturity')
     {
     $banid="9";
     }
	 elseif(ACTION_NAME=='calendar')
     {
     $banid="10";
     }
	 elseif(ACTION_NAME=='announcement' or ACTION_NAME=='show1')
     {
     $banid="11";
     }
     break;
	 case "Service":
	 if(ACTION_NAME=='index' || ACTION_NAME=='crj')
     {
     $banid="12";
     }
	 elseif(ACTION_NAME=='account')
     {
     $banid="13";
     }
	 elseif(ACTION_NAME=='download')
     {
     $banid="14";
     }
	 elseif(ACTION_NAME=='bank' or ACTION_NAME=='bankshow')
     {
     $banid="15";
     }
	 elseif(ACTION_NAME=='faq')
     {
     $banid="16";
     }
	 break;
	 case "Download":
	 if(ACTION_NAME=='index')
     {
     $banid="17";
     }
	 break;
	 case "Education":
	 if(ACTION_NAME=='index' or ACTION_NAME=='lists')
     {
     $banid="18";
     }
	 elseif(ACTION_NAME=='qqjs')
     {
     $banid="20";
     }
	 elseif(ACTION_NAME=='dwzh')
     {
     $banid="21";
     }
	 elseif(ACTION_NAME=='contracts')
     {
     $banid="22";
     }
	 break;
	 case "News":
	 if(ACTION_NAME=='index')
     {
     $banid="23";
     }
	 elseif(ACTION_NAME=='schg' || ACTION_NAME=='show' || ACTION_NAME=='show2')
     {
     $banid="24";
     }
	 elseif(ACTION_NAME=='train' || ACTION_NAME=='show3' || ACTION_NAME=='show33' || ACTION_NAME=='apply')
     {
     $banid="25";
     }
	  elseif(ACTION_NAME=='news' || ACTION_NAME=='show4' )
     {
     $banid="26";
     }
	 elseif(ACTION_NAME=='rules')
     {
     $banid="27";
     }
	 break;
	 case "English":
	 if(ACTION_NAME=='index')
     {
     $banid="28";
     }
	 break;
	 case "Custserv":
	 if(ACTION_NAME=='index')
     {
     $banid="30";
     }
	 else
	 {
	 $banid="29";
	 }
	 break;
	 case "Member":
	 if(ACTION_NAME=='down')
     {
     $banid="32";
     }
	 elseif(ACTION_NAME=='partner' || ACTION_NAME=='par')
     {
     $banid="33";
     }
	 else
	 {
	 $banid="31";
	 }
	 break;
     default:
     $banid="1";
     break;
     }
     $banner=$this->getf('About','id='.(int)$banid,$sort='sort desc',$setfi='spic');
	 $this->assign('banner',$banner); 
	 //获取网站设置
	 $webset=$this->finds('Webinfo','id=1','id desc');
	 $this->assign('webset',$webset);
     //客服
	 $topkf=$this->lbmit('Photo','passed=1 and qy=10','sort desc,addTime desc','0,10');
	$this->assign('topkf',$topkf);
	
	$top1=$this->lbmit('Classnews','qy=1','sort asc','0,3');
	$this->assign('top1',$top1);
	
	$top11=$this->lbmit('About3','qy=1 and passed=1','sort desc ,addTime desc','0,3');
	$this->assign('top11',$top11);
	
	$top1banner=$this->lbmit('Photo','qy=1 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top1banner',$top1banner);
	
	$top2banner=$this->lbmit('Photo','qy=2 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top2banner',$top2banner);
	
	$top3banner=$this->lbmit('Photo','qy=3 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top3banner',$top3banner);
	
	$top4=$this->lbmit('Classdown','classid>0','sort asc','0,8');
	$this->assign('top4',$top4);
	
	$top4banner=$this->lbmit('Photo','qy=4 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top4banner',$top4banner);
	
	$top5=$this->lbmit('About3','qy=2 and passed=1','sort desc ,addTime desc','0,3');
	$this->assign('top5',$top5);
	
	$top5banner=$this->lbmit('Photo','qy=5 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top5banner',$top5banner);
	
	$top6banner=$this->lbmit('Photo','qy=6 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top6banner',$top6banner);
	
	$top7banner=$this->lbmit('Photo','qy=7 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top7banner',$top7banner);
	
	$top8=$this->lbmit('About3','qy=4 and passed=1','sort desc ,addTime desc','0,8');
	$this->assign('top8',$top8);
	
	$top8banner=$this->lbmit('Photo','qy=8 and passed=1','sort desc ,addTime desc','0,1');
	$this->assign('top8banner',$top8banner);
	
	}
	
	//获取网站标题
    public function keys($date,$where='')
    {
	  $News = M($date);
      $rows = $News->where($where)->field('t,k,d')->find(); 
	  if($rows){
	  $this->webt=$rows['t'];
	  $this->webk=$rows['k'];
	  $this->webd=$rows['d'];
	  }
	  else
	  {
	  echo "<script language=javascript>history.go(-1);</script>";
	  exit;
	  }
    }
	//获取验证码	
    public function verify(){
    import('ORG.Util.Image');
    Image::buildImageVerify(4,1,'png','60','20','verify');
    }
	//检查会员登录
	public function checkuser(){
    if(empty($_SESSION['user_id'])){
	$this->redirect('Member_login',"", 0, '');
	exit;
	}
    }
	//检查内部会员登录
	public function checkuserb(){
    if(empty($_SESSION['user_id'])){
	echo '<script>alert("登陆后台失效或时间超时，请重新登陆！");parent.window.location.href="'.U("Index/index").'";</script>';
	exit;
	}
	echo '<script>if (window.top == window){window.top.location.href ="'.U("Index/index").'";}</script>';
    }
	//分页列表
	public function arr($date,$fy,$where='',$order='sort desc')
    {
	  $arr=array();
	  $news = M($date);
	  import('ORG.Util.Page');// 导入分页类
	  $count=$news->where($where)->count();//获取数据的总数
	  $page  = new Page($count,$fy);
      $arrs=$news->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
	  //echo $news->getLastSql();
	  $arr['list']=$arrs;
	  import('Common.Pages',APP_PATH,'.php');
	  $web_page=new Pager($count,$fy,(int)$_GET['page']);
      $arr['show']=$web_page->pagenr;
	  $arr['count']=$count;
	  return $arr;
    } 
	//不分页列表
	public function lb($date,$where='',$sort='sort desc')
    {
	  $arrs=array();
	  $news = M($date);
      $arrs=$news->where($where)->order($sort)->select();
	  return $arrs;
    } 
	//不分页列表
	public function lbmit($date,$where='',$sort='sort desc',$limit)
    {
	  $arrs=array();
	  $news = M($date);
      $arrs=$news->where($where)->order($sort)->limit($limit)->select();
	  return $arrs;
    } 	
	//查找一条数据
	public function finds($date,$where='',$sort='sort desc')
    {
	  $news = M($date);
      $arr=$news->where($where)->order($sort)->find();
	  return $arr;
    }
	//查找一条字段
	public function getf($date,$where='',$sort='sort desc',$setfi='id')
    {
	  $news = M($date);
      $arr=$news->where($where)->order($sort)->getField($setfi);
	  return $arr;
    }
	//删除数据
	public function del($date,$where='')
    {
	  $news = M($date);
      return $news->where($where)->delete();
    } 
	//添加数据
	public function add($date,$arr)
    {
	  $news = M($date);
      return $news->add($arr);
    } 
	//修改数据
	public function save($date,$arr,$where='id=1')
    {
	  $news = M($date);
      return $news->where($where)->save($arr);
    } 
	//修改数据
	public function update($date,$where='id=1')
    {
	  $news = M($date);
      return $news->where($where)->setInc('hits',1); 
    } 
	//地区
	public function regions($id){
	  $arrs=array();
	  $news = M('Region');
      $arrs=$news->where('parent_id='.$id)->order('region_name_en asc')->select();
	  return $arrs;
    }
	//删除文件
 	public function delFile($file) {

	  if ( !is_file($file) ) return false;

	  @chmod($file, 0777);

	  @unlink($file);

	  return true;
    }
	//判断空方法
	public function _empty()
	{
	echo "<script language=javascript>history.go(-1);</script>";
	exit;
	}
	//get传值
	public function curlget($src){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $src);
	curl_setopt($ch, CURLOPT_HEADER,FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	$Infos = curl_exec($ch);
	if (curl_errno($ch)) {
	return curl_error($ch);
	}
	curl_close($ch);
	return $Infos;
	}
	//post传值
	public function curlpost($data,$src){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $src);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$Infos = curl_exec($ch);
	if (curl_errno($ch)) {
	return curl_error($ch);
	}
	curl_close($ch);
	return $Infos;
	}
}
?>