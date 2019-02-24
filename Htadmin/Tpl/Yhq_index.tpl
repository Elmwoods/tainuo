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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加优惠券', width: 1000, height: 600, url: urlS+'yhq_yhqadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改优惠券', width: 1000, height: 600, url: urlS+'yhq_yhqadd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">优惠券管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('','');">添加优惠券</button>	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>优惠券金额：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
</span>
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="49">ID</th>					
					<th width="120">优惠券名称</th>
					<th width="49">金额</th>
					<th width="70">数量/剩余数量</th>
					<th width="60">使用条件(满)</th>
					<th width="200">有效期</th>
					<th width="18">是否启用</th>
					<th width="110">添加时间</th>
					<th width="119">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.title}>(单用户领取<{$vo.isone}>次)</td>
						<td><{$vo.jg}></td>
						<td><{$vo.sl}>/<{$vo.sysl}></td>
						<td><{$vo.yqjg}></td>
						<td><!--<{$vo['stimes']|date="Y-m-d H:i:s",###}>-<{$vo['etimes']|date="Y-m-d H:i:s",###}>--><{$vo.ts}>天</td>
						<td><if condition="$vo.passed eq 0">否<else/>是</if></td>
						<td><{$vo.addTime}></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/yhq_index.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span> <if condition="$vo.lx eq 1">&nbsp;&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/yhq_dhm.html?id=<{$vo.id}>">管理兑换码</a>]</span></if></td>
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