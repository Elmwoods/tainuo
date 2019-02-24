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
        <div class="icontithome">
		<if condition="($Think.cookie.qy eq 1)">
		消费获得酒币<elseif condition="($Think.cookie.qy eq 2)"/>
		酒币消费<elseif condition="($Think.cookie.qy eq 3)"/>
		分销获得酒币<elseif condition="($Think.cookie.qy eq 4)"/>
		分享获得酒币<else/>
		酒币流水
		</if>记录列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <!--<div class="control-group" style="padding-top:6px;">
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>-->
<div class="search"><form id="searchform" action="" method="get">
<input name="user_id" type="hidden" value="<{$user_id}>" />
<input name="xs" type="hidden" value="<{$xs}>" />
<input name="qy" type="hidden" value="<{$Think.cookie.qy}>" /><span>会员账号/订单号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<if condition="$xs eq 1">
<span>
<select name="ly" style="width:auto;" id="ly" class="cdselect">
  <option value="">酒币来源</option>
<option <if condition="($ly eq '1')">selected="selected"</if>  value="1">消费获得酒币</option>
<option <if condition="($ly eq '2')">selected="selected"</if>  value="2">分享获得酒币</option>
<option <if condition="($ly eq '3')">selected="selected"</if>  value="3">分销获得酒币</option>
</select>
</span>
</if>
 <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="26"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="51">ID</th>	
					<th width="229">产品订单号</th>				
					<th width="220">订单时间</th>
					
					<th width="121">酒币</th>
					<th width="124">会员账号</th>
					<th width="226">备注</th>
					<th width="72">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><{$vo.ordern}></td>					
						<td><{$vo.addtime}></td>
						
						<td><{$vo.price|number_format=###,0,'.',''}></td>
						<td><{$vo.user_id|ly=###}></td>
						<td><{$vo.sz}></td>
						<td><!--<span>[<a href="<{:C('web_url')}>__APP__/user_pointjl.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>-->						</td>
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