<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/ss.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">分销获得酒币记录详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选数据 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get">
        <dl class="lineD">
           <dt>买家账号：</dt>
           <dd><input type="text" value="<{$uname}>" id="uname" style="width:190px" name="uname"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
           <dt>酒币获得账号：</dt>
           <dd><input type="text" value="<{$tjname}>" id="tjname" style="width:190px" name="tjname"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
           <dt>订单号：</dt>
           <dd><input type="text" value="<{$order}>" id="order" style="width:190px" name="order"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
      <dt>订单金额：</dt>
      <dd><select class="c_select" style="width:80px" id="bj" name="bj">
	  <option value="">--请选择--</option>
	  <option value="gt" <if condition="($bj eq 'gt')">selected="selected"</if>>大于</option>
	  <option value="eq" <if condition="($bj eq 'eq')">selected="selected"</if>>等于</option>
	  <option value="lt" <if condition="($bj eq 'lt')">selected="selected"</if>>小于</option>
	  </select>
      <input type="text" value="<{$money}>" class="input" style="width:100px" id="money" name="money">
        <span>不填则不限制</span>
      </dd>
    </dl>
	<dl class="lineD">
      <dt>酒币：</dt>
      <dd><select class="c_select" style="width:80px" id="bj1" name="bj1">
	  <option value="">--请选择--</option>
	  <option value="gt" <if condition="($bj1 eq 'gt')">selected="selected"</if>>大于</option>
	  <option value="eq" <if condition="($bj1 eq 'eq')">selected="selected"</if>>等于</option>
	  <option value="lt" <if condition="($bj1 eq 'lt')">selected="selected"</if>>小于</option>
	  </select>
      <input type="text" value="<{$money1}>" class="input" style="width:100px" id="money1" name="money1">
        <span>不填则不限制</span>
      </dd>
    </dl>
	<dl class="lineD">
      <dt>交易时间(开始)：</dt>
      <dd><input type="text" value="<{$ks}>" id="ks" style="width:190px" name="ks" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选开始时间则查询从开始时间往后所有</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>交易时间(结束)：</dt>
      <dd><input type="text" value="<{$js}>" id="js" style="width:190px" name="js" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选结束时间则查询从结束时间往前所有</span></dd>
    </dl>
	<dl class="lineD">
      <dt>订单状态：</dt>
      <dd><select name="is_pay" style="width:80px" id="is_pay" >
  <option value="">订单状态</option>
<option <if condition="($is_pay eq '0')">selected="selected"</if>  value="0">未支付</option>
<option <if condition="($is_pay eq '1')">selected="selected"</if>  value="1">已支付</option>
<!--<option <if condition="($is_pay eq '2')">selected="selected"</if>  value="2">已退款</option>-->
</select> <span>不填则不限制</span></dd>
    </dl>
	<dl class="lineD">
      <dt>结算状态：</dt>
      <dd><select name="isjs" style="width:80px" id="isjs" >
  <option value="">结算状态</option>
<option <if condition="($isjs eq '0')">selected="selected"</if>  value="0">未结算</option>
<option <if condition="($isjs eq '1')">selected="selected"</if>  value="1">已结算</option>
</select> <span>不填则不限制</span></dd>
    </dl>
	<dl class="lineD">
      <dt>结算时间(开始)：</dt>
      <dd><input type="text" value="<{$ks1}>" id="ks1" style="width:190px" name="ks1" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选开始时间则查询从开始时间往后所有</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>结算时间(结束)：</dt>
      <dd><input type="text" value="<{$js1}>" id="js1" style="width:190px" name="js1" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选结束时间则查询从结束时间往前所有</span></dd>
    </dl>
    <div class="page_btm">
      <input type="submit" value="确定" class="btn btn-warning">
    </div>	
	</form>
  </div>
  </div>
  <div class="clear"></div>
<div class="search" style="background-color:#ececec; height:50px; padding-top:10px;">&nbsp;
  <input type="button" value="搜索/筛选数据" onclick="dosearch();" class="btn btn-primary  search_action"/><input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary" onclick="location.href='<{:C('web_url')}>__APP__/tj_yjlsexport';"/>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="40">买家id</th>					
					<th>买家账号</th>
					<th width="50">订单号/订单时间</th>
					<th width="60">订单状态</th>
					<th width="150">订单时间/结算时间</th>
					<th >酒币会员名</th>
					<th width="60">分销级别</th>
					<th width="60">会员等级</th>
                    <th width="50">总金额<br />
比列</th>	
					<th width="50">返利酒币</th>									
					<th>结算</th>					
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><{$vo.user_id}></td>					
						<td><{$vo[user_id]|ly=###}><br />
<{$vo['user_id']|hygroup="user","id",###,"id","contact"}>
</td>
						<td><{$vo.ddbh}><br /><{$vo[order_time]|date="Y-m-d H:i:s",###}>
</td>
						<td><if condition="$vo[is_pay] eq 0">未支付<elseif condition="$vo[is_pay] eq 1"/>已支付<else/>已退款</if></td>
						<td><{$vo.add_time}><br />
						<if condition="$vo[is_pay] eq 0">未生成<else/>
<if condition="$vo[jstime] gt 0"><{$vo[jstime]|date="Y-m-d H:i:s",###}><else/>未结算</if></if></td>						
						<td><{$vo[tj_id]|ly=###}><br /><{$vo['tj_id']|hygroup="user","id",###,"id","contact"}></td>
						<td><php>$d=explode(",",$vo['prv_link']);if($d[0]==$vo['tj_id']){echo 'A级';}else{echo 'B级';}</php></td>
						<td><{$vo['tj_id']|hygroup="user","id",###,"id","vip"|vip=###}></td>						
						<td><{$vo.amount}><br />
<{$vo.ratio}></td>
						<td><{$vo.money|formatmoney=###,0}></td>
						<td><if condition="$vo[isjs] eq 0">否<else/>是</if></td>

						
				  </tr>				  
				  </volist>
		</table>
	  </form>	     
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
		
	</div>
	</div>
<include file="Pub:foot" />
<script>
var isSearchHidden = 1;
var searchName = "搜索/筛选数据";
function dosearch() {
	if(isSearchHidden == 1) {
		$("#search_div").slideDown("fast");
		$(".search_action").val("搜索完毕");
		isSearchHidden = 0;
	}else {
		$("#search_div").slideUp("fast");
		$(".search_action").val(searchName);
		isSearchHidden = 1;
	}
} 
</script>
</body>
</html>