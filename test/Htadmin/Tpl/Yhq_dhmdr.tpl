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
<script>
<if condition="$Think.get.err eq 1">
$(function(){
parent.MsgBox.SuccessMsg("修改成功");
//MsgBox.ErrorMsg({ msg: '上传缩略图失败' });
//asyncbox.tips('请设定链接目标', 'error');
//parent.MsgBox.ErrorMsg({ msg: '上传Logo失败' });
//parent.asyncbox.alert("请重新设置额度", "温馨提示");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">[<{$yhq.title}>兑换码导入]</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form name="form" method="post" enctype="multipart/form-data">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
 
   <tr>
    <th>&nbsp;</th>
    <td>*请上传txt文件 1M以内</td>
  </tr>
  <tr>
    <th>选择文件：</th>
    <td><input name="scfile" type="file" class="input-text" id="scfile" size="30"></td>
  </tr> 
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="导入数据" class="btn btn-primary"/><input onclick="history.go(-1);" type="button" value="返回" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>