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
        <div class="icontithome">发票管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    
	<div class="search"><form id="searchform" action="" method="get">
	<span>订单号：</span><span><input name="ddbh" type="text" class="cd" value="<{$ddbh}>"/>&nbsp;</span>
	<span>
	<select name="passed" style="width:auto;" id="passed" class="cdselect">
	  <option value="">开票状态</option>
		  <option value="0" <if condition="($passed eq '0')">selected="selected"</if>>未开</option>
		  <option value="1" <if condition="($passed eq '1')">selected="selected"</if>>已开</option>		 
	</select>
	</span>
		<span>开票时间范围:<input name="ks" style="height:28px;" type="text" class="cd100" value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>-<input name="js" type="text" class="cd100" value="<{$js}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-10}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>&nbsp;
	
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
					<th width="70">订单金额</th>
					<th width="100">会员账户</th>
					<th width="130">付款时间</th>
					<th width="60">发票类型</th>
					<th width="200">发票抬头/单位名称</th>
					<th width="60">发票内容</th>
					<th width="60">开票状态</th>
                    <th width="130">开票时间</th>
					<th>操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.ddbh}>'></td>
						<td><{$vo.ddbh}></td>
						<td><{$vo.zhprice}></td>						
						<td><{$vo.user_id|ly=###}></td>
						<td><{$vo.fktime|mdate=###}></td>
						<td><if condition="$vo['lx'] eq 1">
										普通发票<else/>增值税发票</if></td>
						<td><{$vo.company}></td>
						<td><{$vo['nr']|fplr=###}></td>						
						<td><if condition="$vo['issend'] eq 1">
										已开<else/>未开</if></td>
						<td style="font-size:12px;"><if condition="$vo['stime'] gt 0"><{$vo.stime|mdate=###}></if></td>
						<td>
						[<a href="<{:C('web_url')}>__APP__/order_fpd.html?id=<{$vo.id}>">操作</a>]<!--&nbsp;&nbsp;&nbsp;[<a href="<{:C('web_url')}>__APP__/order_fp.html?id=<{$vo.id}>">删除</a>]--></td>
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