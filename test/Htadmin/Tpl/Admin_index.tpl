<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">管理员列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>账号/手机号/邮箱：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="group_id" style="width:auto;" id="group_id" class="cdselect">
  <option value="">选择会员组</option>
    <volist name="grouplist" id="vol">
		  <option value="<{$vol.group_id}>" <if condition="($group_id eq $vol[group_id])">selected="selected"</if>><{$vol.group_name}></option>
	</volist>
</select>
</span>
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered  table-hover">
				<tr>
			      <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="30">ID</th>					
					<th width="150">账号</th>
					<th width="100">姓名</th>					
					<th width="100">部门</th>
					<th width="100">电话</th>
					<th width="100">Email</th>
					<th width="100">QQ</th>
					<th width="85">会员组</th>
					<th width="34">登录次数</th>
					<th width="137">最后登录时间</th>
					<th width="97">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.username}></td>
						<td><{$vo.realname}></td>						
						<td><{$vo.depart}></td>
						<td><{$vo.mobile}></td>
						<td><{$vo.email}></td>
						<td><{$vo.qq}></td>
						<td><{$vo.group_id|hygroup="admin_group","group_id",###,"group_id","group_name"}></td>
						<td><{$vo.LoginTimes}></td>
						<td><{$vo.LastLoginTime}></td>
						<td>
						<span> [<a href="<{:C('web_url')}>__APP__/admin_addmanager.html?id=<{$vo.id}>">修改</a>]</span>
						<span>&nbsp;&nbsp;&nbsp;[<a href="<{:C('web_url')}>__APP__/admin_index.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
				  </tr>				  
				  </volist>
		</table>
	  </form>	     
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
		
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>