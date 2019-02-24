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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
<script>
function add(id,prv) {
            if (id == null || id =='')
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加运输方式', width: 1050, height: 500, url: urlS+'postt_fsadd.html?act=add'});
            else
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改运输方式', width: 1050, height: 500, url: urlS+'postt_fsadd.html?act=edit&id='+id});
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">运输方式</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">	
	<div class="control-group">
	<!--<button type="button" class="btn btn-primary btn-sm" onclick="add('','');">添加运输方式</button>-->
	<button id="edit-nodecatsort" class="btn btn-primary btn-sm" type="button" tmplabel="保存排序" app="desktop"><span><span>编辑排序</span></span></button>
    </div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
				    <th width="71" style="text-align:center;">ID</th>
					<th width="400" style="text-align:center;">运输方式名称</th>
					<th width="166" style="text-align:center;">起重</th>
					<th width="178" style="text-align:center;">起重价格</th>
					<th width="178" style="text-align:center;">续重</th>
					<th width="178" style="text-align:center;">续重价格</th>
					<th width="178" style="text-align:center;">序号</th>					
					<th width="143" style="text-align:center;">发布状态</th>
					<th width="120" style="text-align:center;">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td align="center" style="text-align:center;"><{$vo.id}></td>
						<td align="center" style="text-align:center;"><{$vo.title}></td>
						<td align="center" style="text-align:center;"><{$vo.ssl}></td>
						<td style="text-align:center;"><{$vo.sprice}></td>
						<td style="text-align:center;"><{$vo.xsl}></td>
						<td style="text-align:center;"><{$vo.xprice}></td>
						<td style="text-align:center;"><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vo.sort}>" name="ordernum[<{$vo.id}>]" size="5"><b><{$vo.sort}></b></td>						
						<td style="text-align:center;"><if condition="($vo.passed eq 0)"><span class="red">已停止</span><else/>已使用</if></td>
						<td align="center" style="text-align:center;">
						<span style="cursor:pointer;" onclick="add(<{$vo.id}>,'');">[修改]</span>&nbsp;&nbsp;&nbsp;&nbsp;<!--<span style="cursor:pointer;" onclick="deleteRow('postt',<{$vo.id}>,'id','','','postt_index');">[删除]</span>--></td>
				  </tr>
				  </volist>
		</table>
	  </form>
		<div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div><br />
<br />
<include file="Pub:foot" />
</body>
</html>