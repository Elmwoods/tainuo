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
parent.MsgBox.SuccessMsg("修改成功!");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">修改资料</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" onSubmit="return pswfrom(this);"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th>用户名：</th>
    <td><{$user.username}></td>
  </tr>
  <tr>
    <th width="13%">原始密码：</th>
    <td width="87%"><input name="mypwd" type="password" id="mypwd" class="cd"/><span class="tswz">修改密码就填写,不修改为空(密码范围6-16个字符)</span></td>
  </tr>
  <tr>
    <th>设置密码：</th>
    <td><input name="newpwd" type="password" id="newpwd" class="cd"/></td>
  </tr>
  <tr>
    <th>确认密码：</th>
    <td><input name="renewpwd" type="password" id="renewpwd" class="cd"/></td>
  </tr>
   <tr>
    <th>个人姓名：</th>
    <td><input name="realname" type="text" id="realname" class="cd"  value="<{$user.realname}>"/><span class="ts">*</span></td>
  </tr>
  <tr>
    <th>手机号码：</th>
    <td><input name="mobile" type="text" id="mobile" class="cd" value="<{$user.mobile}>"/><span class="ts">*</span></td>
  </tr>
  <tr>
    <th>Q Q号码：</th>
    <td><input name="qq" type="text" id="qq" class="cd"  value="<{$user.qq}>"/></td>
  </tr>
  <tr>
    <th>邮箱地址：</th>
    <td><input name="email" type="text" id="email" class="cd"  value="<{$user.email}>"/><span class="ts">*</span></td>
  </tr> 
 
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="提交" class="btn btn-primary" /><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>
                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>