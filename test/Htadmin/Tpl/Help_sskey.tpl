<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{$Think.config.web_url}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{$Think.config.web_url}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加关键字', width: 600, height: 350, url: urlS+'help_sskeyadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改信息关键字', width: 600, height: 350, url: urlS+'help_sskeyadd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">热门搜索词</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加关键词</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>关键字：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>

  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="23"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="34">ID</th>					
					<th width="333">关键词</th>
					<th width="78">搜索次数</th>
					<th width="97">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.title}></td>
						<td><{$vo.ssnum}></td>
						<td>						
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;&nbsp;<span>[<a href="<{$Think.config.web_url}>__APP__/help_sskey.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
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