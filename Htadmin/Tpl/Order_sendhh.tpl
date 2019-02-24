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
<include file="Pub:js" />
<!--MsgBox-->
<include file="Pub:msg" />
<script>
function ss(){
var fs=$("#wlfs").val();
var wldh=$("#wldh").val();
if(fs==0){
 alert("选择快递方式");
 return false;
}
if(wldh==""){
 alert("输入快递单号");
 return false;
}
 return true;
}</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">订单发货详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" onsubmit=" return ss();" >
	<input name="classid_not" type="hidden" value="<{$show.classid}>" />
	<input name="ly_not" type="hidden" value="<{$ly}>" />
	<div class="mainbox topborder">	
	<div class="hyinfo"><b class="text-warning"><{$show.ddbh}>--订单产品列表</b>&nbsp;&nbsp;<input type="button" value="订单打印" class="btn btn-default"  onclick="location.href='<{:C('web_url')}>__APP__/order_prints.html?classid=<{$show.classid}>';"/></div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table class="table noborder">
							    <tr>
                                       
                                        <th>产品名称</th>
										<th>产品编号</th>
										<th>属性</th>
                                        <th>产品单价</th>
										<th>产品折扣</th>
										<th>数量</th>
                                        <th>产品总金额</th>
										
      </tr>
	  <volist name="ddlist" id="vol">
	  <php>$allprices=$allprices+$vol["price"];</php>
	     <tr>
                                        <td><{$vol.title}><if condition="$vol['isth'] gt 0"><span class="red">[<{$vol.isth|isth=###}>-<{$vol.ispassed|isthpass=###}>]</span></if></td>
										<td><{$vol.pr_id|hygroup="pro","id",###,"id","model"}></td>
										<td><{$vol.csname}></td>
                                        <td><{$vol.dj}></td>
										<td><{$vol[prozk]*10}></td>
										<td><{$vol.sl}></td>
                                        <td><{$vol.price}></td>
										
                                    </tr>

     </volist> 
	 <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
										<td>&nbsp;</td>
																
										
										<td></td>
										<td><span class="red">合计:<{$allprices|number_format=###,2,'.',''}>
</span></td>
                                    </tr>
									 <tr>
                                        <td>优惠券：<{$show.yhq}></td>
                                        <td>满减优惠：<{$show.mj}></td>
                                        <td>运费：<{$show.kdfsprice}></td>
                                        <td>酒币：<{$show.pointp}></td>
										<td>应付金额：<{$show.prices}></td>
																
										
										<td>优惠金额：<{$show.zkprice}></td>
										<td><span class="red">实际付款:<{$show.zhprice|number_format=###,2,'.',''}>
</span></td>
                                    </tr>                               
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">个人信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none;">
	<tr>
                                        <td><strong>会员信息</strong></td>
                                        <td>会员账号:<{$show.user_id|ly=###}>&nbsp;&nbsp;&nbsp;&nbsp;订单提交时间：<{$show.addtime|mdate=###}></td>
                                    </tr>
	


							    <tr>
                                       
                                        <td width="100"><strong>收货信息</strong></td>
                                        <td>收货人：<{$address['names']}>   电话：<{$address['phone']}>   收货地址：<{$address['sf']|address=###}> <{$address['cs']|address=###}> <{$address['xc']|address=###}> <{$address['address']}></td>
            </tr>

	
									<if condition="$isfp neq ''">
									<tr>
                                       
                                        <td width="100"><strong>发票信息</strong></td>
                                        <td><if condition="$isfp['lx'] eq 1">
										普通发票<br />
发票抬头:<{$isfp['company']}><br />
纳税人识别码:<{$isfp['sbm']}><br />
发票内容:<{$isfp['nr']|fplr=###}>
										<else/>
										增值税发票<br />
单位名称:<{$isfp['company']}><br />
发票内容:<{$isfp['nr']|fplr=###}><br />
纳税人识别码:<{$isfp['sbm']}><br />
注册地址:<{$isfp['address']}><br />
注册电话:<{$isfp['tel']}><br />
开户银行:<{$isfp['yh']}><br />
银行账户:<{$isfp['yhcode']}></if></td>
            </tr>
</if>
	 <tr>
                                        <td><strong>备注留言</strong></td>
                                        <td><{$show[bz]|default='无备注说明!'}></td>
                                    </tr>
                                    </if>
									<tr>
                                        <td><strong>物流信息</strong></td>
                                        <td>运输方式:<select name="wlfs" id="wlfs">
										<option value="0">选择快递方式</option>
										<volist name="kd" id="vol">
										<option value="<{$vol.id}>" <if condition="$vol[id] eq $show[wlfs]">selected="selected"</if>><{$vol.name}></option>
										</volist>
										</select>
										
										&nbsp;&nbsp;&nbsp;&nbsp;物流单号:<input id="wldh" name="wldh" type="text" class="cd150"  value="<{$show[wldh]}>"/>&nbsp;&nbsp;&nbsp;&nbsp;<if condition="$show[wldh] neq ''">发货时间:<{$show[fhtime]|mdate=###}></if>&nbsp;&nbsp;<if condition="$show[qrtime] gt 0">确认收货时间:<{$show[qrtime]|mdate=###}></if><br />
										<if condition="$show[wldh] neq ''">
<div style="width:600px; height:150px; padding:2px; overflow:auto; border:1px solid #f4f4f4;">
<volist name="wlxx" id="vol">
<{$vol.time}><{$vol.context}><br />
</volist>
</div></if></td>
                                    </tr>
								
      </table>
	  <if condition="$show['passed'] eq 1">
	  <div style="text-align:left; padding-left:50px;"><input type="submit" value="发货" class="btn btn-primary" /></div>
	  <else/>
	  <div style="text-align:left; padding-left:50px;"><input type="button" value="返回" onclick="history.go(-1);" class="btn btn-primary" /></div>
	  </if>
	</div>
	</div>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>