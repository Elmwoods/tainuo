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
<include file="Pub:msg" />
<script>
<if condition="$Think.get.err eq 1">
$(function(){
parent.MsgBox.SuccessMsg("操作成功");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">订单参数设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	 <tr>
    <th width="16%"><span class="red">参数设置</span></th>
    <td width="84%">&nbsp;</td>
    </tr>
  <tr>
    <th width="16%"><strong>购物车保存时间</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[0]}>"/>
      &nbsp;天(从添加时间开始算)</td>
    </tr>
	<tr style="display:none;">
    <th width="16%"><strong>库存减少</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[1]}>"/>
      &nbsp;(下单减库存为0，支付完成减库存为1)</td>
    </tr>
	<tr>
    <th width="16%"><strong>产品可评价时间</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[2]}>"/>
      &nbsp;天(从确认完成时间开始算)</td>
    </tr>
	<tr>
    <th width="16%"><strong>物流可查看时间</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[3]}>"/>
      &nbsp;天(从确认完成时间开始算)</td>
    </tr>
 <tr>
    <th width="16%"><strong>自动确认完成时间</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[4]}>"/>
      &nbsp;天(从发货时间开始算)</td>
    </tr> 
	 <tr style="display:none;">
    <th width="16%"><strong>退换货物限制</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[5]}>"/>
      &nbsp;天(从确认完成时间开始算)</td>
    </tr>
	<tr>
    <th width="16%"><strong>佣金结算</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[6]}>"/>
      &nbsp;天(从订单确认完成时间开始算)</td>
    </tr> 
	<tr>
    <th width="16%"><strong>订单未付款取消</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[7]}>"/>
      &nbsp;天(从下单时间开始算)</td>
    </tr> 
	<tr>
    <th width="16%"><strong>购买产品酒币到账期限</strong></th>
    <td width="84%"><input name="order[]" type="text" id="order" class="cd50"  value="<{$order[8]}>"/>
      &nbsp;天(从确认完成时间开始算)</td>
    </tr> 
	<tr>
    <th width="16%"><span class="red">其他设置</span></th>
    <td width="84%">&nbsp;</td>
    </tr>
	<tr>
	<th width="16%"><strong>评论是否加图开关</strong></th>
    <td width="84%"><input name="wset[]" type="text" id="wset" class="cd50"  value="<{$wset[0]|default='0'}>"/>
      &nbsp;1代表开，0代表关</td>
    </tr>
	<tr>
	<th width="16%"><strong>后台人工充值开关</strong></th>
    <td width="84%"><input name="wset[]" type="text" id="wset" class="cd50"  value="<{$wset[1]|default='0'}>"/>
      &nbsp;1代表开，0代表关</td>
    </tr>	
	<tr>
	<th width="16%"><strong>用户提现开关</strong></th>
    <td width="84%"><input name="wset[]" type="text" id="wset" class="cd50"  value="<{$wset[2]|default='0'}>"/>
      &nbsp;1代表开，0代表关</td>
    </tr>
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>