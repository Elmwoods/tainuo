<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<script type="text/javascript">
$(function(){
    $(".main-nav li:eq(0)").click();
})
</script>
<!--MsgBox-->
<include file="Pub:msg" />
</head>
<body onload="changeheight();" onresize="changeheight();">
<div class="h_t">
                  <div class="logo"><!--<img src="<{:C('web_url')}>__WJ__/images/logo.png" />--><h5 style="margin-left: 20px;font-size: 30px;height: 72px;line-height: 72px;">管理系统</h5></div>
<div class="tm">
           <ul class="main-nav">
		   <php>$ll=0;</php>
		   <volist name="mem" id="vol" key="mlist">
		    <php>if((is_array($usergroup)&&in_array(md5($vol[0]),$usergroup))||($user['adminjb']==1)){$ll++;</php>
                <li  <if condition='($ll eq 1)'>class="active"</if> name='<{:C('web_url')}>__APP__/home_left1.html?bk=<{$mlist}>'><a target="main" href="javascript://"><{$vol[0]}></a></li>
			<php>}</php>
		   </volist>
            </ul>
</div>
<div class="tu"><span><{$user.username}>:您好!</span>
<a title="系统首页" href="<{:C('web_url')}>__APP__/index_home.html"><img src="<{:C('web_url')}>__WJ__/images/home.png" alt="系统首页" height="30" /></a>
<a title="刷 新" href="javascript:reloa();"><img src="<{:C('web_url')}>__WJ__/images/sx.png" alt="刷 新" height="30" /></a>
<a title="修改资料" href="<{:C('web_url')}>__APP__/home_mpsw.html" target="main"><img src="<{:C('web_url')}>__WJ__/images/psw.png" alt="修改资料" height="30" /></a>
<a title="安全退出" href="<{:C('web_url')}>__APP__/index_logout.html"><img src="<{:C('web_url')}>__WJ__/images/logoout.png" alt="安全退出" height="30" /></a></div>
</div>
<!-- 头部结束 -->
<div class="leftbox">
  <div class="tit"> 栏目菜单&nbsp;&nbsp;
    
  </div>
  <div class="menuBox" id="menuBox">
<iframe frameBorder="0" id="menu" name="menu" scrolling="auto" src="<{:C('web_url')}>__APP__/home_left1.html" style="HEIGHT:100%; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 2;overflow-x:hidden;"> </iframe>
    
  </div>
</div>
<!-- 左边公共菜单结束 -->
<!-- 显示隐藏条开始 -->
<div class="centerBar" id="centerBar" onclick="hideMenu()"> <span></span> </div>
<!-- 显示隐藏条结束 -->
<!-- 右边主体框开始 -->
<div class="rightbox" id="rightbox">
<iframe frameborder="0" id="main" name="main" scrolling="yes" src="<{:C('web_url')}>__APP__/home_welcome.html" style="HEIGHT: 100%; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 1;overflow-x:hidden;"></iframe>
</div>
</body>
</html>