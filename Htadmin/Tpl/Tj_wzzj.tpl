<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/datall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">网站资金统计</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">	
  <div class="clear"></div>
	<div class="search"><form id="searchform" action="" method="get"><span>从</span><span><input class="cd" type="text" value="<{$ks}>" id="ks" name="ks" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly>&nbsp;</span>
	<span>
	到
	</span>
	<span>
	<input type="text" value="<{$js}>" id="js"  class="cd"  name="js" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly>
	</span>&nbsp;
	  <input type="submit" value="统计" class="btn btn-primary"/></form>
	</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	
	<div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>会员统计</th>        
        <th>充值统计</th>
		<th>账户提现</th>
      </tr>
      <tr>
        <td valign="top">
        	<dl class="lx"><dt>用户总数:</dt><dd><{$data['user'][0]['max']|default='0'}> 人</dd></dl>
            <dl class="lx"><dt>普通会员:</dt><dd><{$data['user'][0]['vip1']|default='0'}> 人</dd></dl>
            <dl class="lx"><dt>银卡会员:</dt><dd><{$data['user'][0]['vip2']|default='0'}> 人</dd></dl>
            <dl class="lx"><dt>金卡会员:</dt><dd><{$data['user'][0]['vip3']|default='0'}> 人</dd></dl>
        	<dl class="lx"><dt>钻石会员:</dt><dd><{$data['user'][0]['vip4']|default='0'}> 人</dd></dl>
			<dl class="lx"><dt>申请认证:</dt><dd><{$data['user'][0]['ver_passed']|default='0'}> 人</dd></dl>
			<dl class="lx"><dt>通过认证:</dt><dd><{$data['user'][0]['ver_passed1']|default='0'}> 人</dd></dl>
			<dl class="lx"><dt>拒绝认证:</dt><dd><{$data['user'][0]['ver_passed2']|default='0'}> 人</dd></dl>
        </td>       
        <td valign="top">
            <dl class="lx"><dt>充值记录总数:</dt><dd><{$data['cz']['max']|default='0'}> 条</dd></dl>
         	<dl class="lx"><dt>前台记录数:</dt><dd><{$data['cz']['qt']|default='0'}> 条</dd></dl>
         	<dl class="lx"><dt>后台记录数:</dt><dd><{$data['cz']['ht']|default='0'}> 条</dd></dl>
            <dl class="lx"><dt>充值总金额:</dt><dd><{$data['cz']['aprice']|default='0.00'}> 元</dd></dl>
         	<dl class="lx"><dt>前台金额:</dt><dd><{$data['cz']['qprice']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>后台金额:</dt><dd><{$data['cz']['hprice']|default='0.00'}> 元</dd></dl>
        </td>
		<td valign="top">
            <dl class="lx"><dt>总提现总数:</dt><dd><{$data['tx']['a1']|default='0'}>  条</dd></dl>
            <dl class="lx"><dt>总提现金额:</dt><dd><{$data['tx']['a2']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>待审核金额:</dt><dd><{$data['tx']['a3']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>审核未通过金额:</dt><dd><{$data['tx']['a4']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>待打款金额:</dt><dd><{$data['tx']['a5']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>已到账金额:</dt><dd><{$data['tx']['a6']|default='0.00'}> 元</dd></dl>
            <dl class="lx"><dt>会员总钱包余额:</dt><dd><{$data['tx']['a7']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>会员总酒币:</dt><dd><{$data['tx']['a8']|default='0'}> 分</dd></dl>
			<dl class="lx"><dt>会员可用总酒币:</dt><dd><{$data['tx']['a9']|default='0'}> 分</dd></dl>
        </td>
	</tr>
    <tr>
        <th>订单统计</th>
        <th>结算佣金</th>
        <th>优惠券统计金额</th>
    </tr>
    <tr>
        <td valign="top">
            <dl class="lx"><dt>订单总数:</dt><dd><{$data['order']['max']|default='0'}> 个</dd></dl>
            <dl class="lx"><dt>未付款订单数:</dt><dd><{$data['order']['npassed']|default='0'}> 个</dd></dl>
            <dl class="lx"><dt>已付款订单数:</dt><dd><{$data['order']['ypassed']|default='0'}> 个</dl>   
			<!--<dl class="lx"><dt>退款:</dt><dd><{$data['order']['tkprice5']|default='0'}> 个</dl>
			<dl class="lx"><dt>退货:</dt><dd><{$data['order']['tkprice4']|default='0'}> 个</dl>
			<dl class="lx"><dt>换货:</dt><dd><{$data['order']['tkprice3']|default='0'}> 个</dl>  
			<dl class="lx"><dt>售后处理中:</dt><dd><{$data['order']['cl1']|default='0'}> 个</dl>
			<dl class="lx"><dt>售后处理完成:</dt><dd><{$data['order']['cl2']|default='0'}> 个</dl>  
			<dl class="lx"><dt>售后拒绝处理:</dt><dd><{$data['order']['cl3']|default='0'}> 个</dl>     --> 	
            <dl class="lx"><dt>未付款总额:</dt><dd><{$data['order']['price']|default='0.00'}> 元</dd></dl>
         	<dl class="lx"><dt>已付款总额:</dt><dd><{$data['order']['yprice']|default='0.00'}> 元</dl>
			<!--<dl class="lx"><dt>退货退款总额:</dt><dd><{$data['order']['tkprice']|default='0.00'}> 元</dl>
			<dl class="lx"><dt>退款总额:</dt><dd><{$data['order']['tkprice1']|default='0.00'}> 元</dl>
			<dl class="lx"><dt>退货总额:</dt><dd><{$data['order']['tkprice2']|default='0.00'}> 元</dl>
			<dl class="lx"><dt>套餐订单数:</dt><dd><{$data['order']['tc1']|default='0'}>个</dl>
			<dl class="lx"><dt>套餐订单总额:</dt><dd><{$data['order']['tc2']|default='0.00'}> 元</dl>-->
			<dl class="lx"><dt>购买总金额:</dt><dd><{$data['order']['yprice']|default='0.00'}>  元</dd></dl>  
			<dl class="lx"><dt>开发票总金额:</dt><dd><{$data['fp']['p1']|default='0.00'}> 元</dd></dl>
			
        </td>
        <td valign="top" style="padding-left:0px">
            <dl class="lx"><dt>产品总额:</dt><dd><{$data['js']['a1']|default='0.00'}> 元</dd></dl>         	
         	<dl class="lx"><dt>未付款产品总额:</dt><dd><{$data['js']['a3']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>已付款产品总额:</dt><dd><{$data['js']['a4']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>已退款产品总额:</dt><dd><{$data['js']['a5']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>预计结算总额:</dt><dd><{$data['js']['a2']|default='0.00'}> 币</dd></dl>
			<dl class="lx"><dt>可结算总额:</dt><dd><{$data['js']['a6']|default='0.00'}> 币</dd></dl>
			<dl class="lx"><dt>已结算总额:</dt><dd><{$data['js']['a7']|default='0.00'}> 币</dd></dl>
			<dl class="lx"><dt>未结算总额:</dt><dd><{$data['js']['a8']|default='0.00'}> 币</dd></dl>
			
         	



        </td>
        <td valign="top">
			<dl class="lx"><dt>总共发放:</dt><dd><{$data['yhq']['yh1']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>已过期:</dt><dd><{$data['yhq']['yh2']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>已使用:</dt><dd><{$data['yhq']['yh3']|default='0.00'}> 元</dd></dl>
			<dl class="lx"><dt>未使用:</dt><dd><{$data['yhq']['yh4']|default='0.00'}> 元</dd></dl>
			
        </td>
      </tr>
   

    </table>
  </div> 
		
	</div>
	</div>
<include file="Pub:foot" />

</body>
</html>