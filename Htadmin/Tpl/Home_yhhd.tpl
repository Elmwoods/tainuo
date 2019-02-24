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
        <div class="icontithome">优惠活动设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	 <tr>
    <th width="10%"><span class="red">优惠活动设置</span></th>
    <td width="90%"><span class="red">(优先于其他设置)</span></td>
    </tr>
  <tr>
    <th><strong class="red">满减活动开关</strong></th>
    <td><input name="mj" type="radio" value="0" <if condition="$shop['mj'] eq 0">checked="checked"</if> />
               关闭<input name="mj" type="radio" value="1" <if condition="$shop['mj'] eq 1">checked="checked"</if>/>
               开启</td>
    </tr>
	 <tr>
    <th></th>
    <td id="mmj">满减设置(金额元)：<br />
	<if condition="count($mmj) gt 0">
	  <volist name="mmj" id="vol">
<div style="margin-top:5px;">满 <input name="mprice[]" type="text" class="cd100" value="<{$vol.mprice|default='0'}>" maxlength="10" />减<input name="mjprice[]" type="text" class="cd100" value="<{$vol.mjprice|default='0'}>" maxlength="10" /><span class="delete" style="color:#0033CC; display:<php>if($i==1)echo "none";</php>; cursor:pointer;">&nbsp;删除</span></div>
</volist>
	  <else/>
<div style="margin-top:5px;">满 <input name="mprice[]" type="text" class="cd100" value="0" maxlength="10" />减<input name="mjprice[]" type="text" class="cd100" value="0" maxlength="10" /><span class="delete" style="color:#0033CC; display:none; cursor:pointer;">&nbsp;删除</span></div>
</if>
<div id="mmjend"  style="margin-top:5px;"> &nbsp;<input type="button" value="添加" class="btn" autocomplete="off" maxnum="5" id="addmj" style="background-color: #666666; border:none; width:50px; height:30px; color:#FFFFFF;"><span>最大数量为5个</span></div></td>
    </tr>
	 
 <tr>
    <th><strong  class="red">满包邮开关</strong></th>
    <td><input name="mb" type="radio" value="0" <if condition="$shop['mb'] eq 0">checked="checked"</if> />
               关闭<input name="mb" type="radio" value="1" <if condition="$shop['mb'] eq 1">checked="checked"</if>/>
               开启</td>
    </tr> 
	
	 <tr>
    <th></th>
    <td>满多少包邮(金额元)：<input name="mbprice" type="text" class="cd100"  id="mbprice" value="<{$shop.mbprice}>" maxlength="10" /></td>
    </tr> 	
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
	<script>
$(function(){
	$("#addmj").bind('click',function(){	
			var tmp=$('#mmj div').eq(0).clone();
			var sl=$("#mmj div").length;
			if(sl>5)return;	
			if(tmp)$(tmp).insertBefore($("#mmjend"));
			$("#mmj div .delete").show();
			$("#mmj div .delete").eq(0).hide();
		});
	$(".delete").live("click", function () {
				if (confirm("确定要删除该数据吗？")) {
					if($("#mmj div").length>2){					
						$(this).closest("div").remove();
					 }
					else
					{
					  alert("不能删除全部信息！");
					  }              
				}
		});
		
});
</script>
<include file="Pub:foot" />
</body>
</html>