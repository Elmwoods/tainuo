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
<include file="Pub:msg" />
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加计划任务', width: 1000, height: 600, url: urlS+'syst_cornsd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改计划任务', width: 1000, height: 600, url: urlS+'syst_cornsd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">计划任务管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
<!--	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加计划任务</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>-->
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="71">ID</th>					
					<th width="136">名称</th>
					<th width="129">脚本</th>
					<th width="310">周期</th>
					<th width="148">上次执行时间</th>
					<th width="153">下次执行时间</th>
					<th width="158">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.name}></td>
						<td><{$vo.script}></td>
						<td><if condition="$vo[week] neq '-1'">
						<{$vo.week|lang_show=###}>
						<elseif condition="$vo[day] eq '-1'"/>
							每天
						<else/>
						每月<{$vo.day}>号
						</if>
						</if><{$vo.hours}>:<{$vo.minutes}></td>
						<td><if condition="$vo.lasttransact neq ''"><{$vo.lasttransact|date='Y-m-d',###}><else/><b>N/A</b></if></td>
						<td><if condition="$vo.nexttransact neq ''"><{$vo.nexttransact|date='Y-m-d',###}><else/><b>N/A</b></if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;&nbsp;
						<!--<span>[<a href="<{:C('web_url')}>__APP__/syst_corns.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>&nbsp;&nbsp;&nbsp;--><span>[<a href="<{:C('web_url')}>__APP__/syst_corns.html?execute=<{$vo.id}>">执行</a>]</span></td>
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