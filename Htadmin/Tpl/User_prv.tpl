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
        <div class="icontithome">客户会员列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22">头像</th>
					<th width="40">客户账户</th>
					<th width="109">客户呢称/姓名</th>					
					<th>会员级别</th>
					<th>注册时间</th>
					<th>是否关注</th>
					<th>订单数量</th>
					<th>返利酒币</th>
					<th>几级客户</th>
					<th>关注时间</th>
					<th>审核状态</th>
					
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><img height="50" src="<{$vo.headimgurl|default='0'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"></td>
						<td><{$vo.username}></td>	
						<td><{$vo.nickname}><br />
<{$vo.contact}></td>					
						<td><{$vo['vip']|vip=###}></td>
						<td><{$vo.regtime}></td>
						<td><if condition="$vo.subscribe eq 1">是<else/><span class="red">否</span></if></td>
						<td><a href="<{:C('web_url')}>__APP__/order.html?qy=0&user_id=<{$vo.id}>"><{$vo['id']|ordertj="dd",###}></a></td>
						<td><{$vo.balances|formatmoney=###,0}></td>
						<td><{$vo['prv_link']|thdj=###,$user_id}></td>
						<td><{$vo.gztime}></td>
						<td><if condition="$vo.passed eq 1">已审核<else/><span class="red">未审核</span></if></td>
						
						
				  </tr>				  
				  </volist>
		</table>
    
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
		
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>