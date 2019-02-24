<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">缓存清理</div>
		
    </div>
	
	<div class="mainbox topborder">
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">清理结果显示：</b></div>
	<div class="textinfo">
	<volist name="caches" id="vol">
<{$vol['name']}>&nbsp; &nbsp;<span class="red">清理完成!</span><br />
</volist>
	</div>
	</div>
	<include file="Pub:foot" />
</body>
</html>