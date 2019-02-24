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
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">库存预警管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
    
<div class="search">
<form id="searchform" action="" method="get">
<span>产品标题/型号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>库存小于：</span><span><input name="kc" type="text" class="cd50" value="<{$kc}>"/>&nbsp;</span>
 <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<input name="lx" id="lx" type="hidden" value="" />
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="30">ID</th>					
					<th width="263">产品标题</th>
					<th width="109">类型</th>
					<!--<th width="99">品牌</th>-->
					<th width="39">金额</th>
					<th width="100">总库存</th>
					<!--<th width="40">团购</th>
					<th width="100">团购库存</th>					
					<th width="30">积分兑换</th>
					<th width="30">兑换库存</th>-->
					<th width="30">参数</th>					
					<th width="222">参数库存</th>
					<th width="50">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.title}></td>
						<td><{$vo.typeprot}></td>
						<!--<td><{$vo.class_name_cn}></td>-->
						<td><{$vo.price}></td>
						<td><{$vo.kc}></td>
						<!--<td><if condition="$vo.istg eq 1"><span class="red">是</span><else/>否</if></td>
						<td><{$vo.tgkc}></td>
						<td><if condition="$vo.isjf eq 1"><span class="red">是</span><else/>否</if></td>
						<td><{$vo.jfkc}></td>-->
						<td><if condition="$vo.isprice eq 1">是<else/><span class="red">否</span></if></td>						
						<td align="center"><volist name="vo[cs]" id="vol1"><{$vol1.title}>(<{$vol1.price}>)(<span class="red"><{$vol1.kc}></span>)<br />
						</volist></td>
						<td><span>[<a href="<{:C('web_url')}>__APP__/pro_index.html?title=<{$vo.title}>" >修改</a>]</span>			</td>
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