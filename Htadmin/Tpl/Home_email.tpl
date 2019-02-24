<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
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
        <div class="icontithome">邮件模块配置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th>邮件总开关：</th>
    <td><input type="radio" <if condition='($show.mails eq 1)'>checked="checked"</if> value="1" name="mails">开启&nbsp;<input type="radio" value="0" name="mails" <if condition='($show.mails eq 0)'>checked="checked"</if>>关闭</td>
  </tr>
  <tr>
    <th width="15%">管理员邮箱：</th>
    <td width="85%"><input name="adminemail" type="text" id="adminemail" class="cd"  value="<{$show.adminemail}>"/>
    <span class="tswz"></span></td>
  </tr>
  <tr>
    <th width="15%">投递员邮箱：</th>
    <td width="85%"><input name="postemail" type="text" id="postemail" class="cd"  value="<{$show.postemail}>"/></td>
  </tr>
  <tr>
    <th width="15%">邮件服务器：</th>
    <td width="85%"><input name="stmpemail" type="text" id="stmpemail" class="cd"  value="<{$show.stmpemail}>"/></td>
  </tr>
  <tr>
    <th width="15%">登陆用户：</th>
    <td width="85%"><input name="emailuser" type="text" id="emailuser" class="cd"  value="<{$show.emailuser}>"/></td>
  </tr>
  <tr>
    <th width="15%">登陆密码：</th>
    <td width="85%"><input name="emailpsw" type="password" id="emailpsw" class="cd"  value="<{$show.emailpsw}>"/></td>
  </tr>
  <tr>
    <th>群发邮件底部标签：</th>
    <td><label>
      <textarea name="emailfoot" cols="60" rows="5" id="emailfoot" class="cdtext"><{$show.emailfoot}></textarea>
    </label></td>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">邮箱配置测试</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<form method="get" target="_self">
	<table width="100%" cellspacing="0">
         <tbody><tr>
          <td width="15%" align="center">测试收件人Email</td>
          <td width="85%" align="left"><input type="text" maxlength="60" class="cd" id="email" name="email"></td>
        </tr>
        <tr>
          <td width="15%" height="40" align="right">&nbsp;</td>
          <td width="85%" align="left"><input type="submit" value="测试发送"  class="btn btn-primary"></td>
        </tr>
      </tbody></table>
	</form>
	</div>
	</div>
	
	
<include file="Pub:foot" />
</body>
</html>