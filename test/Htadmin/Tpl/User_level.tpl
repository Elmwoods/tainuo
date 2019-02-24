<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
<script>
    function addinfo(id = '') {
        let title = id? '编辑':'添加';
        parent.MsgBox.OpenWin({ id: 'MenuEdit', title: title+'服务员等级', width: 1000, height: 500, url: urlS+'user_levelinfo.html?id='+id});
    }
</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">服务员等级管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo();">添加服务员等级</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
    </div>
<!--<div class="search"><form id="searchform" action="" method="get"><span>账号/姓名：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="passed" style="width:auto;" id="passed" class="cdselect">
  <option value="">选择状态</option>
<option <if condition="($passed eq '0')">selected="selected"</if>  value="0">未审核</option>
<option <if condition="($passed eq '1')">selected="selected"</if>  value="1">已审核</option>
</select>
</span>	  
	 
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>-->
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>

			        <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>					
					<th width="135">等级名称</th>
					<th>时薪</th>
					<th>操作</th>
				</tr>
                <volist name="show" id="vo"> 
                    <tr>
                        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                        <td><{$vo.id}></td>						
                        <td><{$vo.level_name}></td>
                        <td><{$vo.price}></td>
                        <!--<td><if condition="$vo.passed eq 1">已审核<else/><span class="red">未审核</span></if></td>-->
                        <td>
                        <span onclick="addinfo('<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;
                        <span>[<a href="<{:C('web_url')}>__APP__/user_level.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>
                        </td>
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