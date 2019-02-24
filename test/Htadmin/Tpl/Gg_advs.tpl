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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加广告位', width: 1000, height: 500, url: urlS+'gg_gadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改广告位', width: 1000, height: 500, url: urlS+'gg_gadd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">广告位列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
<!--<div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加广告位</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>-->

	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="71">ID</th>					
					<th width="245">名称</th>
					<th width="181"><select name="" onchange="window.location='<{:C('web_url')}>__APP__/gg_advs.html?group='+this.value;">
	  <option value="">所有广告</option>
	  <volist name="farr" id="vol">
	  <option value="<{$vol.fz}>" <if condition="($group eq $vol[fz])">selected="selected"</if>><{$vol.fz}></option>
	  </volist>
	  </select></th>
					<th width="93">规格</th>
					<th width="133">数量</th>
					<th width="164">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.name}></td>
						<td><{$vo.fz}></td>
						<td><{$vo.width}>X<{$vo.height}></td>
						<td><{$vo.total}></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span><!--&nbsp;&nbsp;<span >[<a href="<{:C('web_url')}>__APP__/gg_advs.html?id=<{$vo.id}>">删除</a>]</span>--></td>
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