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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加合作伙伴', width: 1000, height: 600, url: urlS+'gg_linksd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改合作伙伴', width: 1000, height: 600, url: urlS+'gg_linksd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">合作伙伴管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加合作伙伴</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>合作伙伴名：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="passed" style="width:auto;" id="passed" class="cdselect">
  <option value="">选择状态</option>

	  <option value="0" <if condition="($passed eq '0')">selected="selected"</if>>关闭</option>
	  <option value="1" <if condition="($passed eq '1')">selected="selected"</if>>打开</option>

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
					<th width="25">ID</th>					
					<th width="232">合作伙伴名</th>
					<th width="337">链接地址</th>
					<th width="192">图片</th>
					<th width="83">序号</th>
					<th width="94">状态</th>
					<th width="142">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.title}></td>
						<td><{$vo.url}></td>
						<td><img width="120"  src="<{$vo[log]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=120&w=40';"></td>
						<td><{$vo.sort}></td>
						<td><if condition="$vo.passed eq 0">关闭<else/>打开</if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/gg_links.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span></td>
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