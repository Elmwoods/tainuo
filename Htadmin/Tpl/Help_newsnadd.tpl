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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<script>var passwordhh="<{$user.username}>";</script>
<include file="Pub:js" />
<!--MsgBox-->	
<style>
#J_imageView  img{ margin-right:5px;}</style>
<include file="Pub:msg" />
<script type="text/javascript">
        function subArticleForm() {
            $("#spnMsg").text('');
            var tit = $.trim($("#title").val());
			var classid = $.trim($("#classid").val());		
			var addtime = $.trim($("#addtime").val());			
			var sorts = $.trim($("#sort").val());
            if (tit == "") {
			$("#spnMsg").html("请输入标题");
                return false;
            }
			if (parseInt(classid)==0) {
			$("#spnMsg").html("请选择所属信息类目");
                return false;
            }
			
			if (addtime=="") {
			$("#spnMsg").html("请选择发布时间");
                return false;
            }
			
			if (sorts == "") {
			$("#spnMsg").html("请输入排序");
                return false;
            }
           return true;
        }
		
		$(document).ready(function(){
		
		$("#enable_hot_link").click(function(){
		if(this.checked){
			$('#hotlinklabel').show();
		}else{
			$('#hotlinklabel').hide();
		}
		});
		
		$("#add_hotdot").click(function(){
		var tmp=$('.label3').eq(0).clone();
		if(tmp)$(tmp).insertBefore(this);
		});
		
		 $(".delf").live("click", function () {
            if (confirm("确定要删除该字段吗？")) {
				if($(".label3").length>1){
					$(this).closest("div").remove(); 
				 }
				else
				{
				  alert("不能删除全部输入项，如果不想使用热点链接，请取消上方的启用选项！");
				  }              
            }
        });
		
	$(".spage-side-nav li").click(function(){
	$('.spage-side-nav li').removeClass('cur');
    $(this).addClass('cur');
	var dq=$(this).index();
	if(dq==0){
	$('#aEditor-Body .spage-main-box').show();
	}
	else
	{
	$('#aEditor-Body .spage-main-box').hide();
	$('#aEditor-Body .spage-main-box').eq(dq).show();
	}
	 $("#main").scrollTop(0);
    })
		        
	   });	   
	  
    </script>
</head>
<body>
<div class="single-page">
<!--left-->
<div id="side" class="side span-auto" style="width: 150px;">
	<div class="side-bx">
    <div class="spage-side-nav">
	<ul>
            <li class="l-handle cur"><span>基本信息</span></li>
            <li class="l-handle "><span>信息内容</span></li>
            <li class="l-handle "><span>SEO设置</span></li>
    </ul>
    </div>
</div>


</div>
<!--right-->
<div id="workground" style="width: 820px; left: 151px;" class="workground">
<form id="myform" name="myform" method="post" action="">
          <div id="main" class="content-main" style="height: 500px; width: 810px;">		 
         <input type="hidden" id="id" value="<{$show.id}>" name="id_not">
		 <input name="qy" type="hidden" value="<{:cookie('qy')}>" />	 
  <div id="aEditor-Body">
     <div class="spage-main-box" style="">
     <h3>基本信息</h3>
     <div class="goods-detail" id="x-g-basic">
     <div class="tableform">
		<div class="division">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
				<tr>
					<th><font color="red">*</font>信息标题：</th>
					<td><input type="text" name="title" id="title" class="cd300" value="<{$show.title}>"></td>
				</tr>				
				<tr>
					<th><font color="red">*</font>所属类目：</th>
					<td><select name="classid" id="classid" class="cd150" >
	<option value="0" selected>请选择分类</option>
	  <volist name="cone" id="vol">
  <option <if condition="($vol[classid] eq $show[classid])">selected="selected"</if> style="background-color:#F6F6F6;color:#000;" value="<{$vol.classid}>"><{$vol.class_name_cn}></option>
  <volist name="vol[0]" id="vol1">
<option <if condition="($vol1[classid] eq $show[classid])">selected="selected"</if> style="" value="<{$vol1.classid}>">──<{$vol1.class_name_cn}></option>
<volist name="vol1[0]" id="vol2">
<option <if condition="($vol2[classid] eq $show[classid])">selected="selected"</if> value="<{$vol2.classid}>">-----<{$vol2.class_name_cn}></option>
</volist>
</volist>
</volist>
</select>
						</td>
				</tr>
				
				
				
				
				
				<tr style="display:none;">
					<th><font color="red">*</font>简介：</th>
					<td><textarea name="text" cols="70" rows="5" class="cdtext" id="text"><{$show.text}></textarea></td>
				</tr>
				<if condition="$ispic eq 1">
				 <tr>
    <th>&nbsp;</th>
    <td>*请上传图为240px × 160px的图片 500K以内</td>
  </tr>
			<tr>
                <th>图片：</th>
                <td><img id="thumbshow_1" width="160" height="125" src="<{$show[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="spic" type="hidden" id="pic_1" size="53" class="cd" value="<{$show.spic}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.spic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Pnews&filed=spic">删除文件</a></if>
                </td>
            </tr>
			</if>
			<if condition="$ispic eq 10">
			 <tr>
    <th>&nbsp;</th>
    <td>多图上传图为600px × 600px的图片 1M以内</td>
  </tr>
			<tr>
                <th>多图上传：</th>
                <td><input type="button" id="J_selectImage" value="批量上传" />
				<div id="J_imageView">
				<volist name="mpic" id="vol">
				<if condition="($vol neq '')">
				<img src="<{$vol}>" width="50" height="50"><a href="<{:C('web_url')}>__APP__/home_delfm.html?id=<{$show.id}>&kk=Pnews&filed=mpic&px=<{$i}>">删除</a>
				</if>
				</volist>
				</div>
				<input name="mpic" type="hidden" id="mpic" size="53" class="cd" value="<{$show[mpic]}>"/>
                </td>
            </tr>
			</if>
				
				
				
							
                <tr>
                     <th>发布：</th>
					 <td>
					 	<input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked</if>>是					 	<input type="radio" <if condition="($show[passed] eq 0)">checked</if> name="passed" value="0">否					 </td>
                </tr>
				<tr>
                     <th>推荐：</th>
					 <td>
					 	<input type="radio" name="tj" value="1" <if condition="($show[tj] eq 1)">checked</if>>是					 	<input type="radio" <if condition="($show[tj] eq 0)">checked</if> name="tj" value="0">否					 </td>
                </tr>
				
				 <tr>
                     <th><font color="red">*</font>点击次数：</th>
                     <td><input type="text" name="hits_int" id="hits"  value="<{$show.hits|default='0'}>" class="cd50"></td>
                </tr>
				 <tr>
                     <th><font color="red">*</font>排序：</th>
                     <td><input type="text" name="sort_int" id="sort"  value="<{$show.sort|default='0'}>" class="cd50"><font color="red">数字越大越靠前</font></td>
                </tr>
				 <tr>
                     <th><font color="red">*</font>发布时间：</th>
                     <td><input type="text" name="addtime_time" id="addtime"  value="<{$show[addtime]|default=$time}>" class="cd150" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-2}-%M-{%d+0} HH:mm:ss',maxDate:'%y-{%M+3}-{%d-1} HH:mm:ss'})" readonly></td>
                </tr>
			</tbody></table>
		</div>
	</div>
    </div>
	</div>
	
     <!--<div class="spage-main-box" style="">
     <h3>扩展属性</h3>
     <div class="goods-detail tableform" id="x-g-basic">

		<div class="division">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody><tr>
					<th>设置：</th>
					<td>					
					<label><input type="checkbox" value="1" name="hot_link" id="enable_hot_link"> 启用热点链接</label>
					<span class="notice-inline">为此文章中部分名词增加链接，使消费者通过名词链接清晰明白该词的意义</span>
					</td>
				</tr>
				
				<tr style="display:none" id="goodsinfolabel">
					<th>相关商品：</th>
					<td><p style="margin:0 0 0.5em;">匹&nbsp;&nbsp;配&nbsp;&nbsp;词：<input type="text" vtype="required" id="goodskeywords" name="article[ext][goods][goodskeywords]" class="x-input x-input" autocomplete="off">					<span class="info">多个匹配词用半角竖线"|"分开</span>     <span id="dom_el_917a552" title=""><img src="http://hzwl.b2c.weixindao.cn/app/desktop/statics/bundle/tips_help.gif"></span>
        </p><div id="tip_Xtip">
      <div><i class="arr"></i><i class="arr2"></i></div>
    </div>
    
    					<p></p>
					显示数量：					<select id="goodsnums" name="article[ext][goods][goodsnums]">
					  <option value="5">5</option>
					  <option value="10">10</option>
					  <option value="20">20</option>
					</select>
					这里要等goods都好才能最后使用 2010/5/28 lvzhihao at shopex.cn
					<button class="btn" onclick="new Dialog('index.php?ctl=content/articles&amp;act=getGoods&amp;p[0]='+$('goodsnums').value+'&amp;p[1]='+$('goodsid').value,{title:'{t}商品选择器{/t}',ajaxoptions:{method:'post',data:Array['H']({'keywords':$('goodskeywords').value})}})" type="button"><span><span>搜索</span></span></button>					</td>
				</tr>
				<tr style="display:none" id="hotlinklabel">
				<th>热点链接：</th>
				<td>
				<div style="padding:5px 0;" class="label3">热&nbsp;&nbsp;点&nbsp;&nbsp;词：<input type="text" vtype="required&&morelength" id="linkwords" style="width:70px;" name="linkwords[]" class="cd50">					&nbsp;&nbsp;&nbsp;&nbsp;链接URL：<input type="text" vtype="required" value="http://" id="linkurl" name="linkurl[]" class="cd200" autocomplete="off"><img width="16" height="16" align="absmiddle" class="delf" app="desktop" src="<{:C('web_url')}>__WJ__/images/delecate.gif"></div>
				
				<button type="button" class="btn btn-success btn-sm" id="add_hotdot" app="desktop"><span><span><i class="btn-icon"><img app="desktop" src="<{:C('web_url')}>__WJ__/images/btn_add.gif"></i>添加热点词</span></span></button>				
				</td>
				</tr>

			</tbody></table>

		</div>
</div>

</div>-->

     <div class="spage-main-box" style="">
  <h3>信息内容</h3>
<div class="division tableform division-skin">
<textarea name="content" rows="10" class="cd" id="content_1" style="width:500px; height:100px;"><{$show.content}></textarea>
</div>
</div>

     <div class="spage-main-box" style="">
  <h3>SEO设置</h3>
<div class="goods-detail" id="x-g-basic">
    <div class="tableform">
		<div class="division">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
				<tr>
					<th>SEO 标题：</th>
					<td><input type="text" vtype="text" id="t" name="t" class="cd300 " autocomplete="off" value="<{$show.t}>"></td>
				</tr>
				
				<tr>
					<th>SEO 关键字：</th>
					<td><input type="text" vtype="text" id="k" name="k" class="cd300" autocomplete="off" value="<{$show.k}>"></td>
				</tr>
				
				<tr>
					<th>SEO 描述：</th>
					<td><textarea name="d" cols="60" rows="5" class="cdtext" id="d" vtype="text" autocomplete="off"><{$show.d}></textarea></td>
				</tr>				
			</tbody></table>
        </div>
	</div>
</div></div>
  </div>


          </div>
          <div style="" class="content-foot">
		  <input type="submit" value="保存数据" onclick="return subArticleForm();" id="btnEnter" class="btn btn-primary" />
<button type="button" onclick="if(confirm('确定退出?'))parent.$.close('MenuEdit');" class="btn btn-default"><span><span>关    闭</span></span></button><span id="spnMsg" class="red"></span>
</div>
</form>
        </div>		
</div>
</body>
</html>