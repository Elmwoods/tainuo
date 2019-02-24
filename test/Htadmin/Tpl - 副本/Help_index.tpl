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
<script type="text/javascript">        
        function add(id,dj,prv) {
            if (id == null || id =='')
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加栏目', width: 1100, height: 500, url: urlS+'help_classadd.html?act=add&dj='+dj+'&prv='+prv});
            else
                parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '修改栏目', width: 1100, height: 500, url: urlS+'help_classadd.html?act=edit&id='+id+"&dj="+dj+"&prv="+prv});
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
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">栏目管理列表</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	<if condition="$qy neq 10">
	<button type="button" class="btn btn-primary btn-sm" onclick="add('',1,0);">添加栏目</button>
	</if>
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
					<th width="14%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;添加子分类</th>
					<th width="26%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;操作</th>
					
				</tr>
				<volist name="classlist" id="vol">
			      <tr>
				        <td><a name="<{$vol.classid}>" id="<{$vol.classid}>"></a><{$vol.classid}></td>
						<td><img src="<{:C('web_url')}>__WJ__/images/<{$link_id|midd=###,$vol[classid],0}>.png" id="dj1" title="<{$vol.classid}>"><{$vol.class_name_cn}></td>						
						<td><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vol.sort}>" name="ordernum[<{$vol.classid}>]" size="5"><b><{$vol.sort}></b></td>
						<td>
						<if condition="($vol[passed] eq 0)">
						<span class="opt lnk red" onclick="passed('typehelp','<{$vol.classid}>');" id="passed_<{$vol.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/no.gif" app="desktop">已禁用</span>
<else/>
<span class="opt lnk" onclick="passed('typehelp','<{$vol.classid}>');" id="passed_<{$vol.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/yes.gif" app="desktop">已发布</span>
</if>
</td>
						<td><span class="opt lnk" onclick="add('',2,<{$vol.classid}>);">
<img border="0" app="desktop" alt="添加子类目" src="<{$Think.config.web_url}>__WJ__/images/addcate.gif">
添加子类目
</span></td>
						<td>						

<span class="opt lnk" onclick="add(<{$vol.classid}>,1,0);">
<img border="0" app="desktop" alt="编辑" src="<{:C('web_url')}>__WJ__/images/editcate.gif">
编辑
</span>
<if condition="$vol['classid'] neq 1">
<span class="opt lnk" onclick="deleteRow('typehelp',<{$vol.classid}>,'classid','',<{$vol.prv_id}>,'help_index');">
<img border="0" app="desktop" alt="删除" src="<{:C('web_url')}>__WJ__/images/delecate.gif">
删除
</span>
</if>
						</td>
						
				  </tr>
				  <volist name="vol[0]" id="vol1">
				  <tr class="active" id="xj<{$vol.classid}>" <{$link_id|midd=###,$vol[classid],1}>>
				        <td  style="text-align:center;"><a name="<{$vol1.classid}>" id="<{$vol1.classid}>"></a><{$vol1.classid}></td>
						<td><div class="dj2"></div><{$vol1.class_name_cn}><span class="red">[<{$lx[$vol1['tj']]}>]</span></td>						
						<td><input class="_x_ipt" type="number" style="display:none" vtype="unsigned" value="<{$vol1.sort}>" name="ordernum[<{$vol1.classid}>]" size="5"><b><{$vol1.sort}></b></td>
						<td>
						<if condition="($vol1[passed] eq 0)">
						<span class="opt lnk red" onclick="passed('typehelp','<{$vol1.classid}>');" id="passed_<{$vol1.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/no.gif" app="desktop">已禁用</span>
<else/>
<span class="opt lnk" onclick="passed('typehelp','<{$vol1.classid}>');" id="passed_<{$vol1.classid}>">
<img src="<{:C('web_url')}>__WJ__/images/yes.gif" app="desktop">已发布</span>
</if>
</td>
						<td>&nbsp;</td>
						<td>

<span class="opt lnk" onclick="add(<{$vol1.classid}>,2,<{$vol.classid}>);">
<img border="0" app="desktop" alt="编辑" src="<{:C('web_url')}>__WJ__/images/editcate.gif">
编辑
</span>

<span class="opt lnk" onclick="deleteRow('typehelp',<{$vol1.classid}>,'classid','',<{$vol1.prv_id}>,'help_index');">
<img border="0" app="desktop" alt="删除" src="<{:C('web_url')}>__WJ__/images/delecate.gif">
删除
</span>


						</td>
						
				  </tr>
				  </volist>
				</volist>
		</table>
	  </form>				
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>