<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<include file="Pub:js" />
<SCRIPT language="javascript">
<!--
function chkInput(obj)
{
    <if condition="$Think.get.id eq ''">
	if (obj.username.value=="")
	{
		alert ("请输入账号。");
		obj.username.focus();
		return false;
	}
	if (obj.password.value=="")
	{
		alert ("请输入您的密码。");
		obj.password.focus();
		return false;
	}
	if (obj.password1.value!=obj.password.value)
	{
		alert ("请确认您的密码。");
		obj.password1.focus();
		return false;
	}
	</if>
	return true;
}
//-->
</SCRIPT>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome"><if condition="$Think.get.id neq ''">修改<else/>添加</if>管理员</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myform" name="myform" onsubmit="return chkInput(this)" >
	<input name="id_not" type="hidden" value="<{$show.id}>" />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj ">
  <tr>
    <th width="13%">管理员账号：</th>
    <td width="87%"><input name="username" type="text" id="username" class="cd"  value="<{$show.username}>"/></td>
  </tr>
  <tr>
    <th>管理员密码：</th>
    <td><input name="password" type="password" id="password" class="cd"/></td>
  </tr> 
   <tr>
    <th>确认密码：</th>
    <td><input name="password1" type="password" id="password1" class="cd"/></td>
  </tr> 
   <tr>
    <th>员工编号/身份证：</th>
    <td><input name="sfz" type="text" id="sfz" class="cd"  value="<{$show.sfz}>"/></td>
  </tr>
  <tr>
    <th>真实姓名：</th>
    <td><input name="realname" type="text" id="realname" class="cd"  value="<{$show.realname}>"/></td>
  </tr>
   <tr>
    <th>所属部门：</th>
    <td><input name="depart" type="text" id="depart" class="cd"  value="<{$show.depart}>"/></td>
  </tr>
   <tr>
    <th>联系电话：</th>
    <td><input name="mobile" type="text" id="mobile" class="cd"  value="<{$show.mobile}>"/></td>
  </tr>
   <tr>
    <th>邮箱地址：</th>
    <td><input name="email" type="text" id="email" class="cd"  value="<{$show.email}>"/></td>
  </tr>
   <tr>
    <th>联系QQ：</th>
    <td><input name="qq" type="text" id="qq" class="cd"  value="<{$show.qq}>"/></td>
  </tr>
   <tr>
    <th>备注：</th>
    <td><textarea name="bz"  id="bz" style="width:500px; height:100px; padding:3px;"><{$show.bz}></textarea></td>
  </tr>
  <tr>
    <th>所属管理组：</th>
    <td><select name="group_id" class="cd">
	<volist name="grouplist" id="vol">
		  <option  value="<{$vol.group_id}>" <if condition="($show[group_id] eq $vol[group_id])">selected="selected"</if>><{$vol.group_name}></option>
	</volist></select></td>
  </tr>
  <tr>
    <th>会员开关：</th>
    <td><input type="radio" value="1" name="passed" <if condition='($show.passed  eq 1)'>checked="checked"</if>>开启&nbsp;<input type="radio" value="0" name="passed" <if condition='($show.passed  eq 0)'>checked="checked"</if>>关闭</td>
  </tr>    
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="提交" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>