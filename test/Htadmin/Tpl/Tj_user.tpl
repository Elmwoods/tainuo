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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">会员账户详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选会员 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get">
        <dl class="lineD">
           <dt>会员账号：</dt>
           <dd><input type="text" value="<{$uname}>" id="uname" style="width:190px" name="uname"><span>不填则不限制</span></dd>
        </dl>
    <dl class="lineD">
      <dt>姓名或者昵称：</dt>
      <dd><input type="text" value="<{$realname}>" id="realname" style="width:190px" name="realname"><span>不填则不限制</span>  </dd>
    </dl>
	<dl class="lineD" style="display:none;">
      <dt>会员类型：</dt>
      <dd><select name="qy" style="width:80px" id="qy" >
		  <option value="">会员类型</option>
		<option <if condition="($qy eq '0')">selected="selected"</if>  value="0">PC会员</option>
		<option <if condition="($qy eq '1')">selected="selected"</if>  value="1">微信会员</option>
		</select>
      </dd>
    </dl>
	<dl class="lineD">
      <dt>会员级别：</dt>
      <dd><select name="vip" style="width:80px" id="vip" >
  <option value="">会员等级</option>
<option <if condition="($vip eq '0')">selected="selected"</if>  value="0">普通会员</option>
<option <if condition="($vip eq '6')">selected="selected"</if>  value="6">银卡会员</option>
<option <if condition="($vip eq '7')">selected="selected"</if>  value="7">金卡会员</option>
<option <if condition="($vip eq '8')">selected="selected"</if>  value="8">钻石会员</option>
</select> </dd>
    </dl>
	
    <dl class="lineD">
      <dt>钱包余额/酒币：</dt>
      <dd><select class="c_select" style="width:80px" id="lx" name="lx">
	  <option value="">--请选择--</option>
	  <option value="discount" <if condition="($lx eq 'discount')">selected="selected"</if>>钱包余额</option>
	  <!--<option value="balances" <if condition="($lx eq 'balances')">selected="selected"</if>>佣金总收入</option>
	  <option value="balancesend" <if condition="($lx eq 'balancesend')">selected="selected"</if>>佣金余额</option>
	  <option value="balancesends" <if condition="($lx eq 'balancesends')">selected="selected"</if>>已提佣金</option>-->
	  <option value="pointend" <if condition="($lx eq 'pointend')">selected="selected"</if>>可用酒币</option>
	  </select>
      <select class="c_select" style="width:80px" id="bj" name="bj">
	  <option value="">--请选择--</option>
	  <option value="gt" <if condition="($bj eq 'gt')">selected="selected"</if>>大于</option>
	  <option value="eq" <if condition="($bj eq 'eq')">selected="selected"</if>>等于</option>
	  <option value="lt" <if condition="($bj eq 'lt')">selected="selected"</if>>小于</option>
	  </select>
      <input type="text" value="<{$money}>" class="input" style="width:100px" id="money" name="money">
        <span>不填则不限制</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" value="确定" class="btn btn-warning">
    </div>	
	</form>
  </div>
  </div>
  <div class="clear"></div>
<div class="search" style="background-color:#ececec; height:50px; padding-top:10px;">&nbsp;
  <input type="button" value="搜索/筛选会员" onclick="dosearch();" class="btn btn-primary  search_action"/><input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary" onclick="location.href='<{:C('web_url')}>__APP__/tj_userexport';"/>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">会员ID</th>
					<th width="69">头像</th>					
					<th width="190">会员账号</th>
					<th width="100">姓名/昵称</th>
					<th width="60">会员级别</th>
					<!--<th width="60">会员类型</th>-->
					<th width="100">钱包余额
</th><th width="100">酒币余额</th>
					<!--<th width="80">
佣金总收入<br />
佣金余额</th>-->
<th width="80">消费总额</th>
					<th width="197">注册时间</th>
					<th width="60">审核状态</th>
					<th width="55">关注</th>
					
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><img height="50" src="<{$vo[headimgurl]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"></td>					
						<td><{$vo.username}><br />
						<if condition="$vo['glid'] gt 0"><br />
						已绑定：<span style="color:#FF0000;"><{$vo['glid']|hygroup="user","id",###,"id","username"}></span>
						</if>
</td>
						<td><{$vo.contact}><br /><{$vo.nickname}></td>
						<td><{$vo['vip']|vip=###}></td>
						<!--<td><if condition="$vo['qy'] eq 0">PC端<else/>微信端</if></td>-->
						<td>￥<{$vo.discount}></td>
						<td><{$vo.pointend}></td>
						<!--<td>￥<{$vo.balances}><br />
￥<{$vo.balancesend}></td>-->
<td>￥<{$vo.orderprice}></td>
						<td><{$vo.regtime}></td>
						<td><if condition="$vo.passed eq 1">已审核<else/><span class="red">未审核</span></if></td>
						<td><if condition="$vo.subscribe eq 1">是<else/><span class="red">否</span></if></td>
						
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
var searchName = "搜索/筛选会员";
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