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
<include file="Pub:msg" />
<include file="Pub:js" />
<script>
<if condition="$Think.get.err eq 1">
$(function(){
parent.MsgBox.SuccessMsg("操作成功");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">酒币模块设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	 <tr>
    <th width="10%"><span class="red">酒币设置</span></th>
    <td width="90%">&nbsp;</td>
    </tr>
  <tr>
    <th><strong>人头奖励</strong></th>
    <td><input name="point_int" type="text" id="point" class="cd50"  value="<{$show.point}>"/>
      &nbsp;推荐会员注册推荐人奖励酒币(不需要请填写0)</td>
    </tr>
 <tr>
    <th><strong>酒币兑换</strong></th>
    <td><input name="point1_f" type="text" id="point1" class="cd50"  value="<{$show.point1}>"/>
      &nbsp;1酒币等于多少元(不需要请填写0)</td>
    </tr> 
  <tr>
   <tr>
    <th><strong>购买使用酒币</strong></th>
    <td><input name="pointfs" type="radio" value="0" <if condition="$show['pointfs'] eq 0">checked="checked"</if>/>不使用<input name="pointfs" type="radio" value="1" <if condition="$show['pointfs'] eq 1">checked="checked"</if>/>使用</td>
    </tr> 
	<tr>
    <th><strong>酒币获取</strong></th>
    <td><input name="point2_f" type="text" id="point2" class="cd50"  value="<{$show.point2}>"/>
      &nbsp;1元等于多少酒币(购买获取酒币，不需要请填写0)</td>
    </tr> 
  <tr>
	<tr>
    <th><strong>酒币过期设置</strong></th>
    <td><input name="pointgq_int" type="text" id="pointgq" class="cd50"  value="<{$show.pointgq}>"/>天
      &nbsp;酒币过期设置(永远不过期请填写0)</td>
    </tr> 
	<tr>
    <th><strong>酒币说明</strong></th>
    <td><textarea name="pointtext" id="content_1"><{$show.pointtext}></textarea></td>
    </tr> 
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>