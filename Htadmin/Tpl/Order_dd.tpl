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
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome"><{$Think.cookie.qy|orderqy=###}>订单详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<input name="classid_not" type="hidden" value="<{$show.classid}>" />
	<input name="ly_not" type="hidden" value="<{$ly}>" />
	<div class="mainbox topborder">	
	<div class="hyinfo"><b class="text-warning"><{$show.ddbh}>--订单产品列表</b><if condition="$show[qhm] neq ''"><font style="color:#FF0000;">取货码:<{$show[qhm]}></font></if>&nbsp;&nbsp;<input type="button" value="订单打印" class="btn btn-default"  onclick="location.href='<{:C('web_url')}>__APP__/order_prints.html?classid=<{$show.classid}>';"/></div>
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
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">个人信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none;">
	<tr>
                                        <td><strong>会员信息</strong></td>
                                        <td>会员账号:<{$show.user_id|ly=###}>&nbsp;&nbsp;&nbsp;&nbsp;订单提交时间：<{$show.addtime|date="Y-m-d H:i:s",###}></td>
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
                                        <td><textarea name="bz" class="cdtext"><{$show[bz]|default='无备注说明!'}></textarea></td>
                                    </tr>
                                    </if>
									<tr>
                                        <td><strong>物流信息</strong></td>
                                        <td>运输方式:<select name="wlfs">
										<option value="0">选择快递方式</option>
										<volist name="kd" id="vol">
										<option value="<{$vol.id}>" <if condition="$vol[id] eq $show[wlfs]">selected="selected"</if>><{$vol.name}></option>
										</volist>
										</select>
										
										&nbsp;&nbsp;&nbsp;&nbsp;物流单号:<input name="wldh" type="text" class="cd150"  value="<{$show[wldh]}>"/>&nbsp;&nbsp;&nbsp;&nbsp;<if condition="$show[wldh] neq ''">发货时间:<{$show[fhtime]|date="Y-m-d H:i:s",###}></if>&nbsp;&nbsp;<if condition="$show[qrtime] gt 0">确认收货时间:<{$show[qrtime]|date="Y-m-d H:i:s",###}></if><br />
										<if condition="$show[wldh] neq ''">
<div style="width:600px; height:150px; padding:2px; overflow:auto; border:1px solid #f4f4f4;">
<volist name="wlxx" id="vol">
<{$vol.time}><{$vol.context}><br />
</volist>
</div></if></td>
                                    </tr>
								
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">支付信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none; width:100%;">
							    <tr>
                                       
                                        <td width="25%"><strong>支付方式：</strong><if condition="$show[qy] eq 2">积分支付<else/><if condition="$show[pay] eq 10">余额支付<else/><{$show[pay]|hygroup="pay","id",###,"id","title"}></if></if></td>
                                        <td width="25%"><strong>配送方式</strong>: <{$show.kdfs|hygroup="postt","id",###,"id","title"}></td>
                                        <td width="25%"><strong>第三方支付交易号</strong>：<{$show.jyh}></td>
                                        <td width="25%"><strong>付款时间</strong>：<if condition="$show[fktime] gt 0"><{$show.fktime|date="Y-m-d H:i:s",###}></if></td>
      </tr>
                                
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">账单明细</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none; width:100%;">
							    <tr>
                                       
                                        <td width="25%"><strong>产品金额：</strong><{$show.pprice}></td>
                                        <td width="25%"><strong>优惠券</strong>: <{$show.yhq}></td>
                                        <td width="25%"><strong>满减优惠</strong>：<{$show.mj}></td>
                                        <td width="25%"><strong>运费</strong>：<{$show.kdfsprice}></td>
      </tr>
	  <tr>
                                       
                                        <td width="25%"><strong>酒币：</strong><{$show.pointp}></td>
                                        <td width="25%"><strong>应付金额</strong>: <{$show.prices}></td>
                                        <td width="25%"><strong><strong class="red">优惠金额</strong>：<input name="zkprice" type="text" class="cd150"  value="<{$show[zkprice]}>" placeholder="减少多少"/><br /></td>
                                        <td width="25%"><strong class="red">实际付款</strong>：<{$show.zhprice}></td>
      </tr>
	  <tr>
                                       
                                        
                                        <td width="25%"><strong>订单状态</strong>：<select name="passed" id="passed" class="cdselect">
        <option value="0" <if condition="$show[passed] eq 0">selected="selected"</if>>待付款</option>
	    <option value="1" <if condition="$show[passed] eq 1">selected="selected"</if>>已付款</option>
		<option value="2" <if condition="$show[passed] eq 2">selected="selected"</if>>已发货</option>
		<option value="3" <if condition="$show[passed] eq 3">selected="selected"</if>>已完成</option>
		<option value="4" <if condition="$show[passed] eq 4">selected="selected"</if>>已取消</option>
		</select></td>
                                       <td width="25%">
</td>
                                        <td width="25%"></td>
										<td width="25%"></td>
      </tr>
	  
	  <tr><td colspan="4">订单说明:<br />
<textarea name="ddsm" class="cdtext"><{$show[ddsm]|default='无说明!'}></textarea></td></tr>
                                
      </table>
	  <div style="text-align:left; padding-left:50px;"><input type="submit" value="保存数据" class="btn btn-primary" /><input type="button" value="订单打印" class="btn btn-default"  onclick="location.href='<{:C('web_url')}>__APP__/order_prints.html?classid=<{$show.classid}>';"/></div>
	</div>
	</div>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>