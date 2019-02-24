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
parent.MsgBox.SuccessMsg("修改成功");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />

<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">快递管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1);">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="search"><form method="get" action="" id="searchform" target="_self"><span>名称/编码：</span><span><input type="text" value="<{$title}>" class="cd" name="title">&nbsp;</span>
<input type="submit" class="btn btn-primary btn-sm" value="搜索"></form>
</div>
<div class="clear"></div>
	<div class="contentbox">

<form style="margin-top:0px;" method="POST" action="" id="form1">
  <table class="table table-bordered" width="100%">
    <tbody><tr class="theader">
      <td width="88" align="right">排序</td>
      <td width="168" align="left">编码</td>
      <td width="172" align="left">名称</td>
      <td width="469" align="left">Web</td>
	  <td width="53" align="center">操作&nbsp;</td>
    </tr>
	  <volist name="arr" id="vol">
	            <tr>
          <td align="right"><input class="cd50" type="text" value="<{$vol.sort}>" maxlength="2" size="5" name="sort[]"></td>
          <td><input type="text" class="cd100" value="<{$vol.code}>" name="code[]"></td>
          <td><input type="text" class="cd300" value="<{$vol.name}>" name="name[]"></td>
          <td><input type="text" value="<{$vol.web}>" class="cd300" name="web[]" />
		 <input type="hidden" value="<{$vol.id}>" name="id[]"></td>
		 <td align="center">
		  		<a onclick="javascript:return confirm('确定要删除吗?')" href="<{:C('web_url')}>__APP__/home_xpress.html?act=del&id=<{$vol.id}>"><img src="<{:C('web_url')}>__WJ__/images/delete.png"></a>  </td>
        </tr>
		 </volist>
		        
		  <tr>
		  <td align="right">新增<input type="hidden" value="" name="id[]">
		  <input class="cd50" type="text" value="0" maxlength="2" size="5" name="sort[]"></td>
		  <td align="left"><input type="text" class="cd100" name="code[]" /></td>
		  <td align="left"><input type="text" class="cd300" name="name[]" /></td>
		  <td align="left"><input type="text" value="" class="cd300" name="web[]" /></td>
		  <td align="left">&nbsp;</td>
		</tr>
            <tr>
			  <td align="left" style="padding-left:40px;" colspan="5">
				<input type="submit" onclick="return confirm('你确定吗?');" value="提交" id="submit" class="btn btn-primary">			  </td>
        </tr>
  </tbody></table>
</form>
<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>