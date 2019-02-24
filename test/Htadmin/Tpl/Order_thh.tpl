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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '退款信息', width: 1000, height: 600, url: urlS+'order_thhcz.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '退款信息', width: 1000, height: 600, url: urlS+'order_thhcz.html?act='+act+'&id='+ids});
			   }
        }
</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">订单退款管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">

<div class="search"><form id="searchform" action="" method="get"><span>订单号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
	<span>
	<select name="ispassed" style="width:auto;" id="ispassed" class="cdselect">
	  <option value="">选择处理方式</option>
		  <option value="0" <if condition="($ispassed eq '0')">selected="selected"</if>>审核中</option>
		  <option value="11" <if condition="($ispassed eq '11')">selected="selected"</if>>已拒绝</option>
		  <option value="12" <if condition="($ispassed eq '12')">selected="selected"</if>>已完成</option>
		  <option value="13" <if condition="($ispassed eq '13')">selected="selected"</if>>已取消</option>
		 
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
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="71">ID</th>					
					<th width="200">订单号</th>
					<th width="70">会员账户</th>
					<th width="88">退款金额</th>
					<th width="130">申请时间</th>
					<th width="74">处理状态</th>
					<th width="130">处理时间</th>					
					<th width="67">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.classid}>'></td>
						<td><{$vo.classid}></td>						
						<td><{$vo.ddbh}>
</td>
<td><{$vo[user_id]|ly=###}></td>
						<td><{$vo.zhprice}></td>
						<td><{$vo.isthtime|mdate=###}></td>
						<td><{$vo[tkpassed]|isthpass=###}></td>						
						<td><if condition="$vo[tktime] gt 0"><{$vo.tktime|mdate=###}></if></td>						
						<td><span onclick="addinfo('edit','<{$vo.classid}>');">[<a href="javascript://">查看操作</a>]</span></td>
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