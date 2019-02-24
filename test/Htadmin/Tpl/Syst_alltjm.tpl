<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{$Think.config.web_url}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{$Think.config.web_url}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">每天访问统计</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>
	<div class="search"><form id="searchform" action="" method="get"><span>日期：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="127">时间</th>					
					<th width="200">前一天url总数</th>
					<th width="200">前一天的PV数/IP数</th>
					<th width="122">前一天会员上线/注册</th>
					<th width="113">产品数据</th>
					<th width="100">产品订单数量</th>
					<th width="100">结算数量</th>
					<th width="100">结算总酒币</th>
					<th width="161">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.time|substr=###,0,10}></td>						
						<td><{$vo.totalurl}></td>
						<td><{$vo.pageviews}>/<{$vo.totalip}></td>
						<td><{$vo.visitusernum}>/<{$vo.reguser}></td>
						<td><{$vo.pronum}></td>
						<td><{$vo.newsnum}></td>
						<td><{$vo.offernum}></td>
						<td><{$vo.videonum}></td>
						<td>						
						<span>[<a href="<{$Think.config.web_url}>__APP__/syst_alltjm.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span></td>
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