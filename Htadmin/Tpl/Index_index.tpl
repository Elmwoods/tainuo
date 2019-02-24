<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<style type="text/css">
body{ margin:0; padding:0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#4b4b4b; line-height:160%; background:#fbfbfb; text-align:center;outline:none;}
body,h1,h2,h3,h4,h5,h6,p,ul,ol,li,form,img,dl,dt,dd,table,th,td,blockquote,fieldset,div,strong,label,em,embed,br{margin:0;padding:0;border:0;}
ul,ol,li{list-style:none;}
a{ text-decoration:none;outline:none;}
a:link{ color:#4b4b4b;}
a:visited{ color:#4b4b4b;}
a:hover{ color:#CC0000;}
.clear{height:0px;font-size:0px;clear:both;line-height:0px;}
/* top */
.top{ width:100%; height:78px; background:url(<{:C('web_url')}>__WJ__/images/top_bg1.jpg) repeat-x left top; text-align:left;}
.main_bg1{ position:absolute; left:50%; top:50%; margin-left:-384px; margin-top:-230px; width:767px; height:460px; background:url(<{:C('web_url')}>__WJ__/images/main_bg2.jpg) no-repeat; text-align:left;}
.main{ width:632px; height:430px; margin:0 auto;}
.main h2{ height:58px; line-height:58px; border-bottom:#cacaca 1px solid; font-weight:normal; overflow:hidden; zoom:1;}
.main h2 span{ float:left; font-size:25px; font-family:"微软雅黑"; color:#1e92cd;}
/* main_lf */
.main h2 strong{ float:right;ont-family:Verdana; font-size:22px; color:#4b4b4b; font-weight:normal;}
.main .main_lf{ float:left; width:260px; margin-top:36px; text-align:center;}
.main .main_lf .main_lf_inter{ width:260px; margin-top:35px; height:40px; line-height:40px; background:url(<{:C('web_url')}>__WJ__/images/login_bg1.jpg) repeat-x; text-align:center; font-family:"微软雅黑"; font-size:18px;}
.main .main_lf .main_lf_inter a{ display:block; width:100%; height:100%; color:#1e92cb; border:#ccc 1px solid;}
.main .main_lf .main_lf_inter a:hover{ background:url(<{:C('web_url')}>__WJ__/images/login_bg2.jpg) repeat-x; border:#046ba3 1px solid; color:#fff;}
.main .main_lf .main_lf_inter span{ padding-left:7px; font-size:14px;}
.main .main_lf .main_lf_inter strong{ padding-left:7px; font-family:"宋体"; font-size:18px; font-weight:normal;}
/* main_rg */
.main .main_rg{ float:right; width:310px; margin-top:30px; font-size:14px;}
.main .main_rg .main_rg_zt{ font-family:"宋体"; font-size:14px;}
.main .main_rg input{ margin:0; padding:0; border:0; vertical-align:middle; font-family:Verdana; font-size:14px; color:#4b4b4b;}
.main .main_rg img{ margin:0; padding:0; border:0; vertical-align:middle;}
.main .main_rg .main_input_bg1{ width:246px; height:35px; line-height:35px; background:url(<{:C('web_url')}>__WJ__/images/input_bg3.jpg) no-repeat; text-indent:50px; float:left;}
.main .main_rg .main_input_bg2{ width:246px; height:35px; line-height:35px; background:url(<{:C('web_url')}>__WJ__/images/input_bg1.jpg) no-repeat; text-indent:50px;float:left;}
.main .main_rg .main_input_bg3{ width:86px; height:35px; line-height:35px; margin-right:8px; background:url(<{:C('web_url')}>__WJ__/images/input_bg4.jpg) no-repeat; padding-left:50px;}
.main .main_rg  .main_rg_btn1{ list-style:none;}
.main .main_rg  .main_rg_btn1 li{ float:left; height:32px;margin-right:10px;}
.main .main_rg  .main_rg_btn1 li a{ display:block; padding:0 20px; line-height:32px; background:url(<{:C('web_url')}>__WJ__/images/btn_bg2.jpg) repeat-x; border:#ccc 1px solid;}
.main .main_rg  .main_rg_btn1 li a:hover{ background:url(<{:C('web_url')}>__WJ__/images/btn_bg3.jpg) repeat-x; border:#0e87c1 1px solid; color:#fff;}
.support{ height:28px; line-height:28px; padding-right:7px; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right;}
</style>
<script src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script src="<{:C('web_url')}>__WJ__/js/function.js"></script>
</head>
<body>
<!-- top -->
<div class="top">
	<div><img src="<{:C('web_url')}>__WJ__/images/logo2.jpg" alt="<{$Think.lang.lg_web}>" width="332" height="70" /></div>    
</div>
<!-- main -->
<div class="main_bg1">    
    <div class="main">
        <h2><span>管理系统</span><strong>User Login</strong></h2>
        <div class="main_lf">
        	<p><img src="<{:C('web_url')}>__WJ__/images/login_3.png" alt="login" width="180" height="48" /></p>
            <br />
            <br />
            <p><img src="<{:C('web_url')}>__WJ__/images/btn_3.png" alt="管理系统" width="180" height="127" /></p>            
        </div>
        <div class="main_rg">
        	<form action="" method="post" name="login" id="login">
            	<table width="310" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="60" height="50" align="left" class="main_rg_zt">账  户</td>
                    <td width="250" align="left"><input name="username" type="text" class="main_input_bg1" id="username" maxlength="20" autocomplete="off" value="<{$htadmin}>" /></td>
                  </tr>
                  <tr>
                    <td height="50" align="left" class="main_rg_zt">密  码</td>
                    <td align="left"><input name="password" type="password" class="main_input_bg2" id="password" maxlength="20" autocomplete="off" /></td>
                  </tr>                                
                  <tr>
                    <td height="45" align="left">验证码</td>
                    <td height="45" align="left"><input name="code" type="text" class="main_input_bg3" id="code" maxlength="6" autocomplete="off" /><img src='<{:C('web_url')}>__APP__/pub_verify.html' onclick="this.src=this.src+'?'+Math.random();"/>
</td>
                  </tr>
                  <tr>
                    <td height="50" colspan="2">
                    	<ul class="main_rg_btn1">
                            <li><a href="javascript:submitfrom();"><strong>登 录</strong></a></li>
                            <li><a href="javascript:formReset();"><strong>重新填写</strong></a></li>
                            <li><a href="javascript:reloa();"><strong>刷 新</strong></a></li>
                        </ul>
                        <p class="clear"></p>                    </td>
                  </tr>
                </table>
            </form>
        </div>
        <p class="clear"></p>
    </div>
    <div class="support">技术支持：<a href="mailto:tech@ni8.com" target="_blank">tech@ni8.com</a> &nbsp;&nbsp;客服电话：0755-83271816</div>
</div>
</body>
</html>