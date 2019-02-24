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
        <div class="icontithome">开发人员设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	<tr>
    <th width="13%">微信接口配置：</th>
    <td width="87%"><input name="kfz" type="radio" value="0" <if condition='$wxshow[kfz] eq "0"'>checked="checked"</if> />
                        未配置
                        <input type="radio" name="kfz" value="1"  <if condition='$wxshow[kfz] eq "1"'>checked="checked"</if> />
                      已配置&nbsp;&nbsp;&nbsp;&nbsp; <span class="red">初始设置请改为未配置</span></td>
  </tr>
   <tr>
    <th width="13%">微信限制访问：</th>
    <td width="87%"><input name="iswx" type="radio" value="0" <if condition='$wxshow[iswx] eq "0"'>checked="checked"</if> />
                        不限制
                        <input type="radio" name="iswx" value="1"  <if condition='$wxshow[iswx] eq "1"'>checked="checked"</if> />
                      限制手机端
					  <input type="radio" name="iswx" value="2"  <if condition='$wxshow[iswx] eq "2"'>checked="checked"</if> />
                      限制微信端
					   <input type="radio" name="iswx" value="3"  <if condition='$wxshow[iswx] eq "3"'>checked="checked"</if> />
                      全限制</td>
  </tr>
   <tr>
    <th width="13%">微信是否绑定PC：</th>
    <td width="87%"><input name="isbd" type="radio" value="0" <if condition='$wxshow[isbd] eq "0"'>checked="checked"</if> />
                        否
                        <input type="radio" name="isbd" value="1"  <if condition='$wxshow[isbd] eq "1"'>checked="checked"</if> />
                      是</td>
  </tr>
  <tr>
    <th width="13%">微信是否优先验证手机：</th>
    <td width="87%"><input name="ismob" type="radio" value="0" <if condition='$wxshow[ismob] eq "0"'>checked="checked"</if> />
                        否
                        <input type="radio" name="ismob" value="1"  <if condition='$wxshow[ismob] eq "1"'>checked="checked"</if> />
                      是</td>
  </tr>
  <tr>
    <th width="13%">微信模版初始设置开关：</th>
    <td width="87%"><input name="moble" type="radio" value="0" <if condition='$wxshow[moble] eq "0"'>checked="checked"</if> />
                        否
                        <input type="radio" name="moble" value="1"  <if condition='$wxshow[moble] eq "1"'>checked="checked"</if> />
                      是</td>
  </tr>  
 
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>