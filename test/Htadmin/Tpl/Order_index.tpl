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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome"><{$Think.cookie.qy|orderqy=###}>订单</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	
	<if condition="$passed eq 4"><a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" >放入回收站</a></if><input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary" onclick="location.href='<{:C('web_url')}>__APP__/order_ddexport';"/>
    </div>
	<div class="search"><form id="searchform" action="" method="get">
	<input name="user_id" type="hidden" value="<{$user_id}>" /><span>订单号：</span><span><input name="ddbh" type="text" class="cd" value="<{$ddbh}>"/>&nbsp;</span>
	<span>
	<select name="passed" style="width:auto;" id="passed" class="cdselect">
	  <option value="">选择订单状态</option>
		  <option value="0" <if condition="($passed eq '0')">selected="selected"</if>>待付款</option>
		  <option value="1" <if condition="($passed eq '1')">selected="selected"</if>>待发货</option>
		  <option value="2" <if condition="($passed eq '2')">selected="selected"</if>>待收货</option>
		  <option value="3" <if condition="($passed eq '3')">selected="selected"</if>>交易成功</option>
		  <option value="4" <if condition="($passed eq '4')">selected="selected"</if>>交易失败</option>
	</select>
	</span>
		<span>订单时间:<input name="ks" style="height:28px;" type="text" class="cd100" value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>-<input name="js" type="text" class="cd100" value="<{$js}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>&nbsp;
	</span>
	<span>付款时间:<input name="ks1" style="height:28px;" type="text" class="cd100" value="<{$ks1}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>-<input name="js1" type="text" class="cd100" value="<{$js1}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>&nbsp;
	
	</span>
	
	  <input type="submit" value="搜索" class="btn btn-primary"/></form>
	</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="10"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="138">订单号<span style="color:#FF0000;"></span></th>					
					<th width="70">会员账户</th>
					<th width="48">产品金额</th>
					<th width="60">满减优惠</th>
					<th width="60">优惠券</th>
					<th width="60">酒币</th>
					<th width="60">运费</th>
					<th width="60">应付金额</th>
                    <th width="60">优惠金额</th>
					
					<th width="60">实付金额</th>					
					<th width="20">订单状态</th>
					<th width="130">订单时间<br />
付款时间</th>
					<th>操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.ddbh}>'></td>
						<td><{$vo.ddbh}></td>						
						<td><{$vo.user_id|ly=###}><br />
<{$vo.user_id|hygroup="user","id",###,"id","contact"}></td>
						<td><{$vo.pprice}></td>
						<td><{$vo.mj}></td>
						<td><{$vo.yhq}></td>
						<td><{$vo.pointp}></td>
						<td><{$vo.kdfsprice}></td>
						<td><{$vo.prices}></td>
                        <td><{$vo.zkprice}></td>
						
						<td><{$vo.zhprice}></td>
						
						<td><{$vo.passed|ddpassed=###}></td>
						<td style="font-size:12px;"><{$vo.addtime|date="Y-m-d H:i:s",###}><br />
<if condition="$vo.fktime gt 0"><{$vo['fktime']|date="Y-m-d H:i:s",###}></if></td>
						<td>
						[<a href="<{:C('web_url')}>__APP__/order_dd.html?classid=<{$vo.classid}>">修改</a>]
						<if condition="$vo.passed eq 4">&nbsp;&nbsp;&nbsp;[<a href="<{:C('web_url')}>__APP__/order.html?id=<{$vo.ddbh}>">回收</a>]</if></td>
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