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
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加产品信息', width: 1000, height: 600, url: urlS+'pro_proadd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改产品信息', width: 1000, height: 600, url: urlS+'pro_proadd.html?act='+act+'&id='+ids});
			   }
        }
function sxj(lx){
	if(lx==2){
		$("#lx").val(lx);
		document.getElementById('nodecatEditor').submit();
	}else if(lx==1){
		$("#lx").val(lx);
		document.getElementById('nodecatEditor').submit();
	}else{
	    location.href="<{:C('web_url')}>__APP__/pro_dc.html";
	}
}
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">产品管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加产品</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
	<a href="javascript://" class="btn btn-primary btn-sm" onclick="sxj(2);">批量上架</a>
	<a href="javascript://" class="btn btn-primary btn-sm" onclick="sxj(1);">批量下架</a>
	<a href="javascript://" class="btn btn-primary btn-sm" onclick="sxj(3);">导出产品当前数据</a>
	
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>产品标题/型号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<span>
<select name="classid" style="width:auto;" id="ldclassid" class="cdselect" data="typepro|typebrand|1|pplink|1">
  <option value="0">选择分类</option>
  <volist name="cone" id="vol">
  <option <if condition="($vol[classid] eq $classid)">selected="selected"</if> style="background-color:#F6F6F6;color:#000;" value="<{$vol.classid}>"><{$vol.class_name_cn}></option>
  <volist name="vol[0]" id="vol1">
<option <if condition="($vol1[classid] eq $classid)">selected="selected"</if> style="background-color:#F6F6F6;color:#000;" value="<{$vol1.classid}>">──<{$vol1.class_name_cn}></option>
<volist name="vol1[0]" id="vol2">
<option <if condition="($vol2[classid] eq $classid)">selected="selected"</if> value="<{$vol2.classid}>">-----<{$vol2.class_name_cn}></option>
</volist>
</volist>
</volist>
</select>
</span>
<span style="display:none;">
<select name="ppclassid" style="width:auto;" id="ppclassid" class="cdselect">
<option value="">选择品牌</option>
<volist name="pp" id="vol">
<option <if condition="($vol[classid] eq $ppclassid)">selected="selected"</if> value="<{$vol.classid}>"><{$vol.class_name_cn}></option>
</volist>
</select>
</span>

<span>
<select name="passed" style="width:auto;" id="passed" class="cdselect">
  <option value="">选择发布状态</option>
<option <if condition="($passed eq '0')">selected="selected"</if>  value="0">已下架</option>
<option <if condition="($passed eq '1')">selected="selected"</if>  value="1">已上架</option>
</select>
</span>
<span  style="display:none;">
<select name="isjf" style="width:auto;" id="isjf" class="cdselect">
  <option value="">是否兑换</option>
<option <if condition="($isjf eq '0')">selected="selected"</if>  value="0">否</option>
<option <if condition="($isjf eq '1')">selected="selected"</if>  value="1">是</option>
</select>
</span>
<span style="display:none;">
<select name="istg" style="width:auto;" id="istg" class="cdselect">
  <option value="">是否团购</option>
<option <if condition="($istg eq '0')">selected="selected"</if>  value="0">否</option>
<option <if condition="($istg eq '1')">selected="selected"</if>  value="1">是</option>
</select>
</span>
<span>
<select name="tj" style="width:auto;" id="tj" class="cdselect">
  <option value="">是否推荐</option>
<option <if condition="($tj eq '0')">selected="selected"</if>  value="0">否</option>
<option <if condition="($tj eq '1')">selected="selected"</if>  value="1">是</option>
</select>
</span>
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
					<th width="60">产品图</th>					
					<th width="263">产品标题</th>
					<th width="109">类型</th>
					<!--<th width="99">品牌</th>-->
					<th width="39">金额</th>
					<th width="39">总销量</th>
					<!--<th width="40">团购<br />购买</th>-->
					<th width="39">分销拥金</th>
					<!--<th width="30">积分<br />
兑换</th>-->
					<th width="130">修改时间</th>
					<th width="30">序号</th>
					<th width="30">推荐</th>					
					<th width="50">上架状态</th>
					<th>操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><img width="50" height="50" src="<{$vo[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"></td>					
						<td><{$vo.title}></td>
						<td><{$vo.typeprot}></td>
						<!--<td><{$vo.class_name_cn}></td>-->
						<td><{$vo.price}></td>
						<td><{$vo.sale}></td>
						<!--<td><if condition="$vo.istg eq 1"><span class="red">是</span><br /><{$vo.tgprice}><else/>否</if></td>-->
						<td><{$vo.yjprice}></td>
						<!--<td><if condition="$vo.isjf eq 1"><span class="red">是</span><br /><{$vo.point}>分<else/>否</if></td>-->
						<td><{$vo.addtime}></td>
						<td><{$vo.sort}></td>
						<td><if condition="$vo.tj eq 1">是<else/><span class="red">否</span></if></td>						
						<td align="center"><if condition="$vo.passed eq 1"><a href="<{:C('web_url')}>__APP__/pro_index.html?xjid=<{$vo.id}>"><img src="<{:C('web_url')}>__WJ__/images/salyes.gif" title="点击下架" style="border:none;"></a><else/><a href="<{:C('web_url')}>__APP__/pro_index.html?sjid=<{$vo.id}>"><span style="color:#FF0000"><img src="<{:C('web_url')}>__WJ__/images/salno.gif" title="点击上架" style="border:none;"></span></a></if></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/user_message.html?newsid=<{$vo.id}>" >查看评论</a>]</span>&nbsp;&nbsp;<span>[<a href="<{:C('web_url')}>__APP__/pro_index.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>
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