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
<include file="Pub:msg" />

</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">优惠券领取列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>账号/金额：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<input name="user_id" type="hidden" value="<{$user_id}>" />
<span>
<select name="action" id="action" class="cdselect">
<option value="">使用状态</option>
        <option value="0" <?php if($action=='0')echo "selected='selected'";?>>未使用</option>
		<option value="1" <?php if($action=='1')echo "selected='selected'";?>>已使用</option>
		<option value="2" <?php if($action=='2')echo "selected='selected'";?>>已过期</option>
      </select>
	  </span>
 <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="51">ID</th>				
					<th width="89">优惠券金额</th>
					<th width="80">使用条件(满)</th>
					<th width="140">时间范围</th>
					<th width="60">使用状态</th>
					<th width="309">使用情况(时间、单号)</th>
					<th width="100">会员账号</th>
					<th width="169">领取时间</th>
					<th width="55">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>											
						<td><{$vo.jg}></td>
						<td><{$vo.yqjg}></td>
						<td><{$vo['stimes']|date='Y-m-d H:i:s',###}><br />
<{$vo['etimes']|date='Y-m-d H:i:s',###}></td>
						<td><if condition="$vo.passed eq 1">已使用<else/><if condition="$vo[etimes] gt $dat">未使用<else/>已过期</if></if></td>
						<td><{$vo.sytime}><br /><{$vo.ordernum}>
</td>
						<td><{$vo.user_id|ly=###}></td>
						<td><{$vo.addtime}></td>
						<td><span>[<a href="<{:C('web_url')}>__APP__/user_hblq.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
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