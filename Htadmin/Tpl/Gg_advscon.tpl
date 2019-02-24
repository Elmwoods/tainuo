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
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加广告', width: 1000, height: 600, url: urlS+'gg_advscond.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改广告', width: 1000, height: 600, url: urlS+'gg_advscond.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">广告管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加广告</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>标题：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="group_id" style="width:auto;" id="group_id" class="cdselect">
  <option value="">选择位置</option>
 <volist name="farr" id="vol">
	  <option value="<{$vol.id}>" <if condition="($group_id eq $vol[id])">selected="selected"</if>><{$vol.fz}>-<{$vol.name}></option>
	  </volist>
</select>
</span>
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="75">ID</th>					
					<th width="200">信息标题</th>
					<th width="169">广告图</th>
					<th width="200">广告位</th>
					<th width="142">发布时间</th>
					<th width="83">序号</th>
					<th width="94">发布状态</th>
					<th width="142">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.name}></td>
						<td><img name="" src="<{$vo.spic}>" width="155" alt="" /></td>
						<td><{$vo.group_id|hygroup="advs","id",###,"id","fz"}>-<{$vo.group_id|hygroup="advs","id",###,"id","name"}></td>
						<td><{$vo.addtime}></td>
						<td><{$vo.sort}></td>
						<td><if condition="$vo.passed eq 0">已禁止<else/>已发布</if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/gg_advscon.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span></td>
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