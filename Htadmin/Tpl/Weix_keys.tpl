<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">关键词自动回复</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
<a href="<{:C('web_url')}>__APP__/weix_keysadd" class="btn">添加关键词</a>
    </div>
	
		<!--<div class="hyinfo"><b class="text-warning">提示：</b></div>-->

	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">	
	<form method="post" action="<{:C('web_url')}>__APP__/weix_keys" id="form1">
	<input name="__EVENTTARGET" id="__EVENTTARGET" value="" type="hidden">
    <input name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" type="hidden">
	<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>
	</form>
	<table width="100%" class="table table-bordered">
				<tr>
				    <th width="207">规则名称</th>
					<th width="201">关键词</th>					
					<th width="357">回复消息类型</th>
					<th width="127">是否禁用</th>
					<th width="230">操作</th>
				</tr>
					<volist name="list" id="vo"> 
			      <tr>
				        <td><{$vo.title}></td>
						<td><{$vo.keys|keys=###}></td>						
						<td><{$vo.style|style=###}></td>
						<td><{$vo.passed|passed=###}></td>
						<td>
						<span>[<a href="<{:C('web_url')}>__APP__/weix_keysmod?id=<{$vo.id}>">修改</a>]</span>
						<if condition="($vo.passed eq 1)">
						<span>[<a href="javascript:__doPostBack('repList$<{$vo.id}>$lbLock','');">禁用</a>]</span>
<else />
<span>[<a href="javascript:__doPostBack('repList$<{$vo.id}>$lbUnLock','');">启用</a>]</span>
</if>
						<span>[<a href="javascript:__doPostBack('repList$<{$vo.id}>$lbDelete','');" onClick="return ConfirmDel();">删除</a>]</span>						</td>
				  </tr>
				  </volist>
		</table>
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$page}></div></div> 
		
	</div>
	</div>
</body>
</html>