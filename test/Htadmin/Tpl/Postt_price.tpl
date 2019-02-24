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
function add(id,prv) {
            if (id == null || id =='')
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加地区运费', width: 1050, height: 500, url: urlS+'postt_priced.html?act=add'});
            else
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改地区运费', width: 1050, height: 500, url: urlS+'postt_priced.html?act=edit&id='+id});
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">地区运费管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="add('','');">添加运输方式</button>	
    </div>
	<div class="clear"></div>
    
<div class="search"><form id="searchform" action="" method="get"><span>快递方式：</span>
<select name="postt" style="width:auto;" id="postt" class="cdselect">
  <option value="">选择快递方式</option>
 <volist name="farr" id="vol">
	  <option value="<{$vol.id}>" <if condition="($postt eq $vol[id])">selected="selected"</if>><{$vol.title}></option>
	  </volist>
</select>
 <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      
					<th width="71">ID</th>	
					<th width="138">快递方式</th>				
					<th width="545">地区</th>
					<th width="151">起重价格</th>
					<th width="114"><strong>续重价格</strong></th>
					<th width="56">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				       <td><{$vo.id}></td>
						<td><{$vo.title}></td>	
						<td style="word-wrap: break-word; word-break: normal;  width:100px;"><{$vo.aeraname}></td>					
						
						<td><{$vo.sprice}></td>
						<td><{$vo.xprice}></td>
						<td><span style="cursor:pointer;" onclick="add(<{$vo.id}>,'');">[修改]</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>[<a href="<{:C('web_url')}>__APP__/postt_price.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
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