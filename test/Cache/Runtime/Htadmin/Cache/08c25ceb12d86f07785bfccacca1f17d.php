<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理系统</title>
<meta content="管理系统" name="keywords" />
<meta content="管理系统" name="description" />
<script>
var urlS="<?php echo C('web_url');?>__APP__/";
var piclj="<?php echo C('htpiclj');?>";
var piclj1="<?php echo C('htpiclj1');?>";
</script>
<link href="<?php echo C('web_url');?>__WJ__/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/function.js"></script>
<script type="text/javascript">
$(function(){
    $(".main-nav li:eq(0)").click();
})
</script>
<!--MsgBox-->
<link type="text/css" href="<?php echo C('web_url');?>__WJ__/js/msg/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/AsyncBox.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/FunLib.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/json2.js"></script>
</head>
<body onload="changeheight();" onresize="changeheight();">
<div class="h_t">
                  <div class="logo"><!--<img src="<?php echo C('web_url');?>__WJ__/images/logo.png" />--><h5 style="margin-left: 20px;font-size: 30px;height: 72px;line-height: 72px;">管理系统</h5></div>
<div class="tm">
           <ul class="main-nav">
		   <?php $ll=0; ?>
		   <?php if(is_array($mem)): $mlist = 0; $__LIST__ = $mem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($mlist % 2 );++$mlist; if((is_array($usergroup)&&in_array(md5($vol[0]),$usergroup))||($user['adminjb']==1)){$ll++; ?>
                <li  <?php if(($ll == 1)): ?>class="active"<?php endif; ?> name='<?php echo C('web_url');?>__APP__/home_left1.html?bk=<?php echo ($mlist); ?>'><a target="main" href="javascript://"><?php echo ($vol[0]); ?></a></li>
			<?php } endforeach; endif; else: echo "" ;endif; ?>
            </ul>
</div>
<div class="tu"><span><?php echo ($user["username"]); ?>:您好!</span>
<a title="系统首页" href="<?php echo C('web_url');?>__APP__/index_home.html"><img src="<?php echo C('web_url');?>__WJ__/images/home.png" alt="系统首页" height="30" /></a>
<a title="刷 新" href="javascript:reloa();"><img src="<?php echo C('web_url');?>__WJ__/images/sx.png" alt="刷 新" height="30" /></a>
<a title="修改资料" href="<?php echo C('web_url');?>__APP__/home_mpsw.html" target="main"><img src="<?php echo C('web_url');?>__WJ__/images/psw.png" alt="修改资料" height="30" /></a>
<a title="安全退出" href="<?php echo C('web_url');?>__APP__/index_logout.html"><img src="<?php echo C('web_url');?>__WJ__/images/logoout.png" alt="安全退出" height="30" /></a></div>
</div>
<!-- 头部结束 -->
<div class="leftbox">
  <div class="tit"> 栏目菜单&nbsp;&nbsp;
    
  </div>
  <div class="menuBox" id="menuBox">
<iframe frameBorder="0" id="menu" name="menu" scrolling="auto" src="<?php echo C('web_url');?>__APP__/home_left1.html" style="HEIGHT:100%; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 2;overflow-x:hidden;"> </iframe>
    
  </div>
</div>
<!-- 左边公共菜单结束 -->
<!-- 显示隐藏条开始 -->
<div class="centerBar" id="centerBar" onclick="hideMenu()"> <span></span> </div>
<!-- 显示隐藏条结束 -->
<!-- 右边主体框开始 -->
<div class="rightbox" id="rightbox">
<iframe frameborder="0" id="main" name="main" scrolling="yes" src="<?php echo C('web_url');?>__APP__/home_welcome.html" style="HEIGHT: 100%; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 1;overflow-x:hidden;"></iframe>
</div>
</body>
</html>