<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<include file="Pub:js" />
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
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">微信绑定设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="<{:C('web_url')}>__APP__/weix" id="myformly" name="myformly">
	<input name="id_not" type="hidden" value="<{$show.id}>" />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	<tr>
    <th width="13%"></th>
    <td width="87%">注意：此指纹(Token) / AppId / AppSecret 必须与微信公众号后台一致,否则无法通信!</td>
  </tr>
  <tr>
    <th width="13%">微信原始ID：</th>
    <td width="87%"><input name="wxid" type="text" id="wxid" class="cd"  value="<{$show.wxid}>"/></td>
  </tr>
  <tr>
    <th width="13%">微信名称：</th>
    <td width="87%"><input name="wxname" type="text" id="wxname" class="cd"  value="<{$show.wxname}>"/></td>
  </tr>
   <tr>
    <th width="13%">接口URL：</th>
    <td width="87%"><input name="url" type="text" id="url" class="cd"  value="<{:C("pic_url")}>wz.php/wts"/></td>
  </tr>
   <tr>
    <th width="13%">指纹(Token)：</th>
    <td width="87%"><input name="token" type="text" id="token" class="cd"  value="<{$show.token}>"/></td>
  </tr>
   <tr>
    <th width="13%"></th>
    <td width="87%">注意：以下为 "开发者凭据"，请保持与微信公众后台一致！</td>
  </tr>
   <tr>
    <th width="13%">AppId：</th>
    <td width="87%"><input name="appid" type="text" id="appid" class="cd"  value="<{$show.appid}>"/></td>
  </tr>
   <tr>
    <th width="13%">AppSecret：</th>
    <td width="87%"><input name="appsecret" type="text" id="appsecret" class="cd"  value="<{$show.appsecret}>"/></td>
  </tr>   
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
</body>
</html>