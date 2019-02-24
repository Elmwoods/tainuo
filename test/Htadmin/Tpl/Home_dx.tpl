<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{$Think.config.web_url}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{$Think.config.web_url}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/function.js"></script>
<include file="Pub:msg" />
<script>
<if condition="$Think.get.err eq 1">
$(function(){
parent.MsgBox.SuccessMsg("修改成功");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">短信模块配置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th>短信总开关：</th>
    <td><input type="radio" <if condition='($show.dx_passed eq 1)'>checked="checked"</if> value="1" name="dx_passed">开启&nbsp;<input type="radio" value="0" name="dx_passed" <if condition='($show.dx_passed eq 0)'>checked="checked"</if>>关闭 <!--<a target="_blank" href="http://www.winic.org">申请地址</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://www.900112.com/main.html">管理地址</a>--></td>
  </tr>
   
  <tr>
    <th width="15%">短信通账号：</th>
    <td width="85%"><input name="dx_user_name" type="text" id="dx_user_name" class="cd"  value="<{$show.dx_user_name}>"/>
    <span class="tswz">非程序人员请不要修改</span></td>
  </tr>
  <tr>
    <th width="15%">短信通密码：</th>
    <td width="85%"><input name="dx_password" type="password" id="dx_password" class="cd"  value="<{$show.dx_password}>"/></td>
  </tr>  
  <tr>
    <th width="15%">短信签名：</th>
    <td width="85%"><input name="dxqm" type="text" id="dxqm" class="cd"  value="<{$show.dxqm}>"/>必须与平台设置一样</td>
  </tr>  
 
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>

	</div>
	
	
<include file="Pub:foot" />
</body>
</html>