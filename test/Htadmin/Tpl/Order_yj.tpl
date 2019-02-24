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
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />

</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">佣金流水记录</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	
	
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>订单号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span><input name="user_id" type="hidden" value="<{$user_id}>" />
<span>
	<select name="ispay" style="width:auto;" id="ispay" class="cdselect">
	  <option value="">付款状态</option>
		  <option value="0" <if condition="($ispay eq '0')">selected="selected"</if>>待付款</option>
		  <option value="1" <if condition="($ispay eq '1')">selected="selected"</if>>已付款</option>
		  <!--<option value="2" <if condition="($ispay eq '2')">selected="selected"</if>>退款</option>-->
	</select>
	</span>
<span>
	<select name="isjs" style="width:auto;" id="isjs" class="cdselect">
	  <option value="">结算状态</option>
		  <option value="0" <if condition="($isjs eq '0')">selected="selected"</if>>待结算</option>
		  <option value="1" <if condition="($isjs eq '1')">selected="selected"</if>>已结算</option>
	</select>
	</span>
 <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="51">ID</th>					
					<th width="100">操作时间</th>
					<th width="224">订单号</th>
					<th width="99">返利酒币</th>					
					<th width="150">买家</th>
					<th width="81">订单金额</th>
					<th width="81">比列</th>
					<th width="81">付款状态</th>
					<th width="81">结算状态</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.add_time}></td>
						<td><{$vo.ddbh}></td>
						<td><{$vo.money|formatmoney=###,0}></td>						
						<td><{$vo.user_id|ly=###}></td>
						<td><{$vo.amount}></td>
						<td><{$vo.ratio}></td>
						<td><if condition="$vo[is_pay] eq 0">待付款<elseif condition="$vo[is_pay] eq 1"/>已付款<else/>退款</if></td>
						<td><if condition="$vo[isjs] eq 0">待结算<else/>已结算</if></td>
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