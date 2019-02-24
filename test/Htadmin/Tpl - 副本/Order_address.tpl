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
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加收货地址', width: 1050, height: 500, url: urlS+'order_addressd.html?act=add'});
            else
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改收货地址', width: 1050, height: 500, url: urlS+'order_addressd.html?act=edit&id='+id});
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">退换货收货地址</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">	
	<div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="add('','');">添加收货地址</button>	
    </div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table width="100%" class="table table-bordered">
				<tr>
				    <th width="71" style="text-align:center;">ID</th>
					<th width="200" style="text-align:center;">收货人</th>
					<th width="166" style="text-align:center;">收货电话</th>
					<th width="78" style="text-align:center;">省份</th>
					<th width="78" style="text-align:center;">城市</th>
					<th width="78" style="text-align:center;">区县</th>
					<th width="678" style="text-align:center;">地址</th>					
					<th width="120" style="text-align:center;">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td align="center" style="text-align:center;"><{$vo.id}></td>
						<td align="center" style="text-align:center;"><{$vo.names}></td>
						<td align="center" style="text-align:center;"><{$vo.phone}></td>
						<td style="text-align:center;"><{$vo[sf]|address=###}></td>
						<td style="text-align:center;"><{$vo[cs]|address=###}></td>
						<td style="text-align:center;"><{$vo[xc]|address=###}></td>										
						<td style="text-align:left;"><{$vo.address}></td>
						<td align="center" style="text-align:center;">
						<span style="cursor:pointer;" onclick="add(<{$vo.id}>,'');">[修改]</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor:pointer;" onclick="deleteRow('Tkaddress',<{$vo.id}>,'id','','','order_address');">[删除]</span></td>
				  </tr>
				  </volist>
		</table>
		<div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div><br />
<br />
<include file="Pub:foot" />
</body>
</html>