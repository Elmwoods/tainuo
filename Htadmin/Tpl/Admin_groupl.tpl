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
parent.MsgBox.SuccessMsg("操作成功");
});
</if>
</script>
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
<table width="100%" cellspacing="0" cellpadding="2" border="0" class="table">
	<tbody><tr class="theader"> 
		<td width="42">ID</td>
		<td width="430">权限组</td>
		<td width="234" align="left">操作</td>
	</tr>
	<volist name="arr" id="vol">
	<tr>
				<td><{$vol.group_id}></td>
				<td><a href="<{:C('web_url')}>__APP__/admin.html?group_id=<{$vol.group_id}>"><{$vol.group_name}></a></td>
				<td><a href="<{:C('web_url')}>__APP__/admin_group.html?act=edit&id=<{$vol.group_id}>"><img src="<{:C('web_url')}>__WJ__/images/edit.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{:C('web_url')}>__APP__/admin_groupl.html?act=del&id=<{$vol.group_id}>"><img src="<{:C('web_url')}>__WJ__/images/delete.png"></a> </td>
			</tr>
			</volist>			
</tbody></table>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>