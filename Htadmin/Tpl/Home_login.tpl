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
        <div class="icontithome">会员登陆设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th>微信登录方式：</th>
    <td><select name="login">
	<option value="0" <if condition='($show.login eq 0)'>selected="selected"</if>>自动登陆(微信)</option>
	<option value="1" <if condition='($show.login eq 1)'>selected="selected"</if>>手动登陆</option>
	<option value="2" <if condition='($show.login eq 2)'>selected="selected"</if>>自动/手动登陆</option>
	</select></td>
  </tr>
   
  <tr>
    <th width="15%">手动登陆方法：</th>
    <td width="85%"><select name="loginfs">
	<option value="0" <if condition='($show.loginfs eq 0)'>selected="selected"</if>>手机登陆</option>
	<option value="1" <if condition='($show.loginfs eq 1)'>selected="selected"</if>>邮箱登陆</option>
	<option value="2" <if condition='($show.loginfs eq 2)'>selected="selected"</if>>手机/邮箱登陆</option>
	</select></td>
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