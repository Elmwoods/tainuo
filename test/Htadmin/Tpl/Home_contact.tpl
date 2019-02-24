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
        <div class="icontithome">联系我们</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" onSubmit="return wbadd(this);">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th width="13%">网站名称：</th>
    <td width="87%"><input name="company" type="text" id="company" class="cd500"  value="<{$show.company}>"/></td>
  </tr> 
  <tr>
    <th width="13%">网站标题：</th>
    <td width="87%"><input name="t" type="text" id="t" class="cd500"  value="<{$show.t}>"/></td>
  </tr>
  <tr>
    <th width="13%">网站关键字：</th>
    <td width="87%"><input name="k" type="text" id="k" class="cd500"  value="<{$show.k}>"/></td>
  </tr>
  <tr>
    <th width="13%">网站描述：</th>
    <td width="87%"><textarea name="d" rows="10" class="cd" id="d" style="width:500px; height:100px;"><{$show.d}></textarea></td>
  </tr>
  <tr>
    <th width="13%">标准时薪：</th>
    <td width="87%"><input name="wage" type="text"  class="cd50"  value="<{$show.wage}>"/>元</td>
  </tr>
  
  <tr>
    <th width="13%">现场支付上限：</th>
    <td width="87%"><input name="limit" type="text"  class="cd50"  value="<{$show.limit}>"/>元</td>
  </tr>
   <!--  <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为640px × 181px的图片 500K以内</td>
  </tr>
  <tr>
    <th>LOGO图片：</th>
    <td><img id="thumbshow_1" width="166" height="80"  src="<{$show[log]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=166&w=80';"><input name="log" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<{$show.log}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.log  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Web&filed=log">删除文件</a></if></td>
  </tr>
 <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为160 × 160px的图片 500K以内</td>
  </tr>
   <tr>
    <th>APP二维码：</th>
    <td><img id="thumbshow_2" width="100" height="100"  src="<{$show[weberw]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=100&w=100';"><input name="weberw" type="hidden" id="pic_2"   rel="no" size="53" class="cd" value="<{$show.weberw}>"/><input type="button" id="image2" value="选择图片" /><if condition="($show.weberw  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Web&filed=weberw">删除文件</a></if></td>
  </tr>
   <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为160 × 160px的图片 500K以内</td>
  </tr>
   <tr>
    <th>微信二维码：</th>
    <td><img id="thumbshow_3" width="100" height="100"  src="<{$show[wxewm]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=100&w=100';"><input name="wxewm" type="hidden" id="pic_3"  rel="no" size="53" class="cd" value="<{$show.wxewm}>"/><input type="button" id="image3" value="选择图片" /><if condition="($show.wxewm  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Web&filed=wxewm">删除文件</a></if></td>
  </tr>-->
  <!--<tr>
    <th width="13%">快递查询公司编号：</th>
    <td width="87%"><input name="KUAIDI_APP_CODE" type="text" id="KUAIDI_APP_CODE" class="cd200"  value="<{$show.KUAIDI_APP_CODE}>"/></td>
  </tr>
  <tr>
    <th width="13%">快递查询APP_KEY：</th>
    <td width="87%"><input name="KUAIDI_APP_KEY" type="text" id="KUAIDI_APP_KEY" class="cd200"  value="<{$show.KUAIDI_APP_KEY}>"/>请不要随便更改</td>
  </tr>
  <tr style="display:none;">
    <th width="13%">在线QQ,用|分隔：</th>
    <td width="87%"><input name="qq" type="text" id="qq" class="cd500"  value="<{$show.qq}>"/></td>
  </tr>
   <tr>
    <th width="13%">客服电话：</th>
    <td width="87%"><input name="tel" type="text" id="tel" class="cd300"  value="<{$show.tel}>"/></td>
  </tr>-->
   <tr>
    <th>网站默认模板：</th>
    <td><select id="temp" name="temp" class="cd">
            <option value="default">default</option></select></td>
  </tr>
    <tr>
    <th>版权信息：</th>
    <td><textarea name="bqxx" rows="10" class="cd" id="bqxx" style="width:500px; height:100px;"><{$show.bqxx}></textarea></td>
  </tr>
   <tr>
    <th>网站开关：</th>
    <td><input type="radio" value="1" name="closecon" <if condition='($show.closecon  eq 1)'>checked="checked"</if>>开启&nbsp;<input type="radio" value="0" name="closecon" <if condition='($show.closecon  eq 0)'>checked="checked"</if>>关闭</td>
  </tr>
     <tr>
    <th>站点统计开关：</th>
    <td><input type="radio" value="1" name="pv" <if condition='($show.pv  eq 1)'>checked="checked"</if>>开启&nbsp;<input type="radio" value="0" name="pv" <if condition='($show.pv  eq 0)'>checked="checked"</if>>关闭</td>
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