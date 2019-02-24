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
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '微信添加会员', width: 1000, height: 500, url: urlS+'user_wxuadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '微信会员信息', width: 1000, height: 500, url: urlS+'user_wxuadd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">微信会员管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>会员OPENID/呢称/手机号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="passed" style="width:auto;" id="passed" class="cdselect">
  <option value="">选择状态</option>
<option <if condition="($passed eq '0')">selected="selected"</if>  value="0">未审核</option>
<option <if condition="($passed eq '1')">selected="selected"</if>  value="1">已审核</option>
</select>
</span>	 
<span>
<select name="isgz" style="width:auto;" id="isgz" class="cdselect">
  <option value="">选择关注</option>
<option <if condition="($isgz eq '0')">selected="selected"</if>  value="0">未关注</option>
<option <if condition="($isgz eq '1')">selected="selected"</if>  value="1">已关注</option>
</select>
</span>	 
 <span style="display:none;">
<select name="vip" style="width:auto;" id="vip" class="cdselect">
  <option value="">会员等级</option>
<option <if condition="($vip eq '0')">selected="selected"</if>  value="0">铁牌会员</option>
<option <if condition="($vip eq '6')">selected="selected"</if>  value="6">黄金代理商</option>
<option <if condition="($vip eq '7')">selected="selected"</if>  value="7">白金代理商</option>
<option <if condition="($vip eq '8')">selected="selected"</if>  value="8">钻石代理商</option>
</select>
</span>  
	  
  <input type="submit" value="搜索" class="btn btn-primary"/><!--<font class="red">提示：绑订了PC会员,不能操作的相关信息请到PC会员操作</font>--></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="69">头像</th>					
					<th width="190">Openid账户<br />
会员卡号</th>
					<th width="100">呢称/手机号码</th>
					<th width="60">级别<br />
微信地区</th>
					<th width="60">订单数</th>
					<th width="100">账户余额
</th>
					<!--<th width="80">
佣金总收入<br />
佣金余额</th>-->
<th width="80">剩余服务总数<br />
可领券</th>
					<th width="195">注册时间<br />
关注时间</th>
					<th width="50">审核<br />
状态</th>
					<th width="45">关注</th>
					<th width="102">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><img height="50" src="<{$vo[headimgurl]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"></td>					
						<td><{$vo.username}><br /><{$vo.hykh}>
</td>
						<td><{$vo.nickname}><br />
<{$vo.moble}></td>
						<td><{$vo['vip']|vip=###}><br />
<{$vo.wxaddress}></td>
						<td><a href="<{:C('web_url')}>__APP__/order.html?user_id=<{$vo.id}>"><{$vo['id']|ordertj="dd",###,$vo['glid']}></a></td>
						<td>￥<a href="<{:C('web_url')}>__APP__/user_jl.html?user_id=<{$vo.id}>"><{$vo.discount}></a></td>
						<!--<td>￥<a href="<{:C('web_url')}>__APP__/order_yj.html?user_id=<{$vo.id}>"><{$vo.balances}></a><br />
￥<a href="<{:C('web_url')}>__APP__/user_yjtx.html?user_id=<{$vo.id}>"><{$vo.balancesend}></a></td>-->
<td><{$vo.tcs}><br />
<a href="<{:C('web_url')}>__APP__/tcorder_hblq.html?user_id=<{$vo.id}>"><{$vo.yhqs}></a></td>
						<td><{$vo.regtime}><br />
<{$vo.gztime}></td>
						<td><if condition="$vo.passed eq 1">已审核<else/><span class="red">未审核</span></if></td>
						<td><if condition="$vo.subscribe eq 1">是<else/><span class="red">否</span></if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/user_wx.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>		<!--				<br /><span>[<a href="<{:C('web_url')}>__APP__/user_prv.html?user_id=<{$vo.id}>">查看下级</a>]</span>--></td>
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