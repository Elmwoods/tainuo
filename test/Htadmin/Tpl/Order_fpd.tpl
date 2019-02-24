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
        <div class="icontithome">发票详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<input name="id_not" type="hidden" value="<{$isfp.id}>" />
	<input name="ly_not" type="hidden" value="<{$ly}>" />
	<div class="mainbox topborder">	
	<div class="hyinfo"><b class="text-warning">订单号：<{$show.ddbh}></b></div>
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
	                          
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">个人信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none;">
	<tr>
                                        <td><strong>会员信息</strong></td>
                                        <td>会员账号:<{$show.user_id|ly=###}>&nbsp;&nbsp;&nbsp;&nbsp;订单付款时间：<{$show.fktime|mdate=###}></td>
                                    </tr>
	


							    <tr>
                                       
                                        <td width="100"><strong>收票信息</strong></td>
                                        <td>收货人：<{$address['names']}>   电话：<{$address['phone']}>   收货地址：<{$address['sf']|address=###}> <{$address['cs']|address=###}> <{$address['xc']|address=###}> <{$address['address']}></td>
            </tr>				
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
                                        <td><strong>备注信息</strong></td>
                                        <td><textarea name="bz" class="cdtext"><{$isfp[bz]|default='无备注说明!'}></textarea></td>
                                    </tr>  
									 <tr>
                                       
                                       <td><strong>订单金额</strong></td>
                                       <td>￥<{$show['zhprice']}></td>
      </tr>                                   
									
	  <tr>
                                       
                                       <td><strong>开票时间</strong></td>
                                       <td><if condition="$isfp['stime'] gt 0"><{$isfp.stime|mdate=###}></if></td>
      </tr>  
                                        <td><strong>开票状态</strong></td>
                                       <td><select name="issend" id="issend" class="cdselect">
        <option value="0" <if condition="$isfp[issend] eq 0">selected="selected"</if>>未开</option>
	    <option value="1" <if condition="$isfp[issend] eq 1">selected="selected"</if>>已开</option>		
		</select></td>
      </tr>  
	  
                                
      </table>
	  <div style="text-align:left; padding-left:50px;"><input type="submit" value="提交" class="btn btn-primary" /></div>
	</div>
	</div>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>