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
<style>
.mod {
    border: 0px solid #CCCCCC;
    float: left;
    margin-left: 5%;
    margin-top: 5px;
    padding: 5px;
    width: 90%;
}
.stitle {
    border-bottom: 1px solid #CCCCCC;
    display: block;
    float: left;
    font-weight: bold;
    width: 100%;
	height:25px; line-height:25px;
}
.part4 li {
	list-style: none;
	float: left;
	width: 24%;
	font-weight:normal;
}
.part4 li label{font-weight:normal;}
</style>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">管理权限组</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
<form action="" method="post" name="form1">
<input name="group_id_not" type="hidden" value="<{$show.group_id}>" />
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtjn">
	<tbody><tr>
		<th width="10%">权限组</th>
		<td><input type="text" value="<{$show.group_name}>" name="group_name" class="cd"></td>
	</tr>
	<tr>
	  <th>描述</th>
	  <td><textarea rows="5" class="cdtext" name="group_desc"><{$show.group_desc}></textarea></td>
	  </tr>
	<tr>
		<th>权限设置</th>
		<td id="glxz">
		<volist name="mem" id="vol">
		<php>if((is_array($usergroup) && in_array(md5($vol[0]),$usergroup)) || ($user['adminjb']==1)){</php>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtjn">
			<tbody>
			<tr>
			<th style=" font-size:16px; text-align:left;">
			<b>&nbsp;<input class="xz" <php>if(is_array($group_perms) && in_array(md5($vol[0]),$group_perms))echo 'checked="checked"';</php> type="checkbox" value="<{$vol[0]|md5}>" name="perm[]" >&nbsp;&nbsp;<{$vol[0]}></b>
			</th>
			</tr>
			<volist name="vol[1]" id="vol1">
			<php>if((is_array($usergroup) && in_array(md5($vol1[0]),$usergroup)) || ($user['adminjb']==1)){</php>
			<tr><td>
			<div class="mod">
			<div class="stitle"><{$vol1[0]}><input class="xz1" type="checkbox" value="<{$vol1[0]|md5}>" name="perm[]" <php>if(is_array($group_perms) && in_array(md5($vol1[0]),$group_perms))echo 'checked="checked"';</php>></div>
			<ul class="part4">
			<volist name="vol1[1]" id="vol2">
			<php>if((is_array($usergroup) && in_array(md5($vol2[1]),$usergroup)) || ($user['adminjb']==1)){</php>
			<li><label><input type="checkbox" value="<{$vol2[1]|md5}>" name="perm[]" <php>if(is_array($group_perms) && in_array(md5($vol2[1]),$group_perms))echo 'checked="checked"';</php>>&nbsp;<{$vol2[0]}></label></li>
			<php>}</php>
			</volist>
			</ul></div></td></tr>
			<php>}</php>
			</volist>			
			</tbody></table>	
		<php>}</php>
		</volist>		
			</td>

	</tr>

	<tr>

	  <td>&nbsp;</td>

	  <td><input type="submit" value="提交" class="btn  btn-primary"></td>

	  </tr>

</tbody></table>

</form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>