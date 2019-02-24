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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加信息', width: 1000, height: 600, url: urlS+'help_nadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改信息', width: 1000, height: 600, url: urlS+'help_nadd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">信息列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加信息</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>关键字：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="classid" style="width:auto;" id="classid" class="cdselect">
  <option value="0">选择分类</option>
  <volist name="classlist" id="vol">
  <optgroup label="<{$vol.class_name_cn}>"></optgroup>
  <volist name="vol[0]" id="vol1">

<option <if condition="($vol1[classid] eq $classid)">selected="selected"</if>  value="<{$vol1.classid}>">─<{$vol1.class_name_cn}></option>
</volist>
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
			      <th width="23"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="34">ID</th>					
					<th width="333">信息标题</th>
					<th width="78">类目</th>
					<th width="101">点击数</th>
					<th width="184">发布时间</th>
					<th width="93">序号</th>
					<th width="72">发布状态</th>
					<th width="97">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.title}></td>
						<td><{$vo.classid|lm=###,'typehelp'}></td>
						<td><{$vo.hits}></td>
						<td><{$vo.addtime}></td>
						<td><{$vo.sort}></td>
						<td><if condition="$vo.passed eq 1">已发布<else/><span class="red">已禁止</span></if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>
						<span>[<a href="<{:C('web_url')}>__APP__/help_info.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
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