<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.2.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
<script type="text/javascript">        
        function add(id,dj,prv) {
            if (id == null || id =='')
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加<{$kzname}>分类', width: 950, height: 500, url: urlS+'pro_lclassd.html?act=add&dj='+dj+'&prv='+prv});
            else
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改<{$kzname}>分类', width: 950, height: 500, url: urlS+'pro_lclassd.html?act=edit&id='+id+"&dj="+dj+"&prv="+prv});
        }		


$(function(){
    var url = window.location.toString();
    var id = "<{$Think.get.classid}>";
    if(id){
      var t = $("#"+id).offset().top;
      $(window).scrollTop(t);
   }
});

</script>
<style>
.table-hover tr td{ color:#333;}</style>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome"><{$kzname}>分类管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<button type="button" class="btn btn-primary btn-sm" onclick="add('',1,0);">添加顶级分类</button>
	<button id="edit-nodecatsort" class="btn btn-primary btn-sm" type="button" tmplabel="保存排序" app="desktop"><span><span>编辑排序</span></span></button>
    </div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
				    <th width="6%">栏目ID</th>
					<th width="35%">栏目名称</th>					
					<th width="8%">排序</th>
					<th width="11%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布状态</th>
					<!--<th width="14%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;添加子分类</th>-->
					<th width="13%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;操作</th>
					<th width="13%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;推荐</th>
				</tr>
				<volist name="classlist" id="vol">
			      <tr>
				        <td><a name="<{$vol.classid}>" id="<{$vol.classid}>"></a><{$vol.classid}></td>
						<td><!--<img src="<{:C('web_url')}>__WJ__/images/<{$link_id|midd=###,$vol[classid],0}>.png" id="dj1" title="<{$vol.classid}>">--><{$vol.class_name_cn}></td>						
						<td><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vol.sort}>" name="ordernum[<{$vol.classid}>]" size="5"><b><{$vol.sort}></b></td>
						<td>
						<if condition="($vol[passed] eq 0)">
						<span class="opt lnk red" onclick="passed('typepro','<{$vol.classid}>');" id="passed_<{$vol.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/no.gif" app="desktop">已禁用</span>
<else/>
<span class="opt lnk" onclick="passed('typepro','<{$vol.classid}>');" id="passed_<{$vol.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/yes.gif" app="desktop">已发布</span>
</if>
</td>
						<!--<td><if condition="($kzdj gt 1)">
						<span class="opt lnk" onclick="add('',2,<{$vol.classid}>);">
<img border="0" app="desktop" alt="添加子类目" src="<{:C('web_url')}>__WJ__/images/addcate.gif">
添加子类目

</span></if></td>-->
						<td>						

<span class="opt lnk" onclick="add(<{$vol.classid}>,1,0);">
<img border="0" app="desktop" alt="编辑" src="<{:C('web_url')}>__WJ__/images/editcate.gif">
编辑
</span>

<span class="opt lnk" onclick="deleteRow('typepro',<{$vol.classid}>,'classid','',<{$vol.prv_id}>,'pro_lclass');">
<img border="0" app="desktop" alt="删除" src="<{:C('web_url')}>__WJ__/images/delecate.gif">
删除
</span>

						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="<{$vol.tj}>" <if condition="$vol.tj eq 1">checked</if> data="<{$vol.classid}>" title="typepro" name="tj[]"></td>
				  </tr>
				  <volist name="vol[0]" id="vol1">
				  <tr class="active1" id="xj<{$vol.classid}>" <{$link_id|midd=###,$vol[classid],1}>>
				        <td  style="text-align:center;"><a name="<{$vol1.classid}>" id="<{$vol1.classid}>"></a><{$vol1.classid}></td>
						<td><img src="<{:C('web_url')}>__WJ__/images/<{$link_id|midd=###,$vol1[classid],0}>.png" id="dj2" title="<{$vol1.classid}>"><{$vol1.class_name_cn}></td>						
						<td><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vol1.sort}>" name="ordernum[<{$vol1.classid}>]" size="5"><b><{$vol1.sort}></b></td>
						<td>
						<if condition="($vol1[passed] eq 0)">
						<span class="opt lnk red" onclick="passed('typepro','<{$vol1.classid}>');" id="passed_<{$vol1.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/no.gif" app="desktop">已禁用</span>
<else/>
<span class="opt lnk" onclick="passed('typepro','<{$vol1.classid}>');" id="passed_<{$vol1.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/yes.gif" app="desktop">已发布</span>
</if>
</td>
						<td><if condition="($kzdj gt 2)">
						<span class="opt lnk" onclick="add('',3,<{$vol1.classid}>);">
<img border="0" app="desktop" alt="添加子类目" src="<{:C('web_url')}>__WJ__/images/addcate.gif">
添加子类目

</span></if></td>
						<td>

<span class="opt lnk" onclick="add(<{$vol1.classid}>,2,<{$vol.classid}>);">
<img border="0" app="desktop" alt="编辑" src="<{:C('web_url')}>__WJ__/images/editcate.gif">
编辑
</span>

<span class="opt lnk" onclick="deleteRow('typepro',<{$vol1.classid}>,'classid','',<{$vol1.prv_id}>,'pro_lclass');">
<img border="0" app="desktop" alt="删除" src="<{:C('web_url')}>__WJ__/images/delecate.gif">
删除
</span>


						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="<{$vol1.tj}>" <if condition="$vol1.tj eq 1">checked</if> data="<{$vol1.classid}>" title="typepro" name="tj[]"></td>
				  </tr>
				   <volist name="vol1[0]" id="vol2">
				   <tr class="active" id="xj<{$vol1.classid}>" <{$link_id|midd=###,$vol1[classid],1}>>
				        <td  style="text-align:center;"><a name="<{$vol2.classid}>" id="<{$vol2.classid}>"></a><{$vol2.classid}></td>
						<td><div class="dj2"></div><{$vol2.class_name_cn}></td>						
						<td><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vol2.sort}>" name="ordernum[<{$vol2.classid}>]" size="5"><b><{$vol2.sort}></b></td>
						<td>
						<if condition="($vol2[passed] eq 0)">
						<span class="opt lnk red" onclick="passed('typepro','<{$vol2.classid}>');" id="passed_<{$vol2.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/no.gif" app="desktop">已禁用</span>
<else/>
<span class="opt lnk" onclick="passed('typepro','<{$vol2.classid}>');" id="passed_<{$vol2.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/yes.gif" app="desktop">已发布</span>
</if>
</td>
						<td></td>
						<td>

<span class="opt lnk" onclick="add(<{$vol2.classid}>,3,<{$vol1.classid}>);">
<img border="0" app="desktop" alt="编辑" src="<{:C('web_url')}>__WJ__/images/editcate.gif">
编辑
</span>

<span class="opt lnk" onclick="deleteRow('typepro',<{$vol2.classid}>,'classid','',<{$vol2.prv_id}>,'pro_lclass');">
<img border="0" app="desktop" alt="删除" src="<{:C('web_url')}>__WJ__/images/delecate.gif">
删除
</span>


						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="<{$vol2.tj}>" <if condition="$vol2.tj eq 1">checked</if> data="<{$vol2.classid}>" title="typepro" name="tj[]"></td>
				  </tr>
				  </volist>
				  </volist>
				</volist>
		</table>
	  </form>				
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>