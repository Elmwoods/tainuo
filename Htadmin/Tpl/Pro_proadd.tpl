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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script language="javascript" type="text/javascript" src="<{:C('web_url')}>__WJ__/js/json2.js"></script>
<script language="javascript" type="text/javascript" src="<{:C('web_url')}>__WJ__/js/pro.js?<php>echo time();</php>"></script>
<script>var passwordhh="<{$user.username}>";</script>
<include file="Pub:js" />
<style>
.listbox { width:630px; min-height:185px;}
.title2 ul li{ background-color:#CCCCCC;color: #FFFFFF;font: 14px/30px "microsoft yahei"; cursor:pointer;}
*{
    padding: 0px;
    margin: 0px;
}
li label{cursor: pointer; float:left; padding-top: 0px;}
li.li_width{width:90px;}
.Father_Title { margin-left:10px; float:left;}
.Father_Title li{float: left;list-style:none; width:60px; color:#FF0000;padding:2px;}
.Father_Item0 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item1 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item2 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item3 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item4 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item5 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item6 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.Father_Item7 li{float: left;list-style:none; padding:2px 2px;width:80px;}
.div_contentlist2 li{float: left;list-style:none; width:98%;padding:0px 1px; text-align:left;}
.li_empty{ width:60px; height:20px; overflow:hidden; display:block; float:left; padding-left:2px;}
.l-text{ line-height:20px; width:100px;}
table#process {
    font-size:12px;
    color:#333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
}
table#process th {
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color:#CCCCCC;
    background-color: #f4f4f4; font-size:12px;
	text-align:left;
}
table#process td {
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color: #f4f4f4;
    background-color: #ffffff;
}
</style>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/liandong.js"></script>
<!--MsgBox-->	
<style>
#J_imageView  img{ margin-right:5px;}</style>
<include file="Pub:msg" />
<script type="text/javascript">     
		
		$(document).ready(function(){		
	$(".spage-side-nav li").click(function(){
	$('.spage-side-nav li').removeClass('cur');
    $(this).addClass('cur');
	var dq=$(this).index();
	if(dq==0){
	$('#aEditor-Body .spage-main-box').show();
	
	$('#aEditor-Body .spage-main-box').eq(2).hide();
	$('#aEditor-Body .spage-main-box').eq(4).hide();
	$('#aEditor-Body .spage-main-box').eq(5).hide();
	}
	else
	{
		$('#aEditor-Body .spage-main-box').hide();
		if(dq==2){
		   $('#aEditor-Body .spage-main-box').eq(dq).show();
		}else{
		   $('#aEditor-Body .spage-main-box').eq(dq).show();
		}
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
            <li class="l-handle cur"><span>产品信息</span></li>
            <li class="l-handle "><span>图片编辑</span></li>
            <li class="l-handle "><span>参数编辑</span></li>
			<li class="l-handle "><span>详细信息</span></li>
		<!--	<li class="l-handle "><span>积分购买设置</span></li>
			<li class="l-handle "><span>团购购买设置</span></li>-->
    </ul>
    </div>
</div>


</div>
<!--right-->
<div id="workground" style="width: 820px; left: 151px;" class="workground">
 <form action="<{:C('web_url')}>__APP__/pro_proaddok.html" method="post" onSubmit="return fbpro();"> 
          <div id="main" class="content-main" style="height: 500px; width: 810px;">		 
          <input name="id_not" id="id_not" type="hidden" value="<{$show.id|default='0'}>" />
		 <input name="ly_not" type="hidden" value="<{$ly}>" />
		 <textarea name="contentprv" id="contentprv"  style="display:none;"></textarea>
		 <textarea name="contentlist" id="contentlist" style="display:none;"></textarea>
		 <textarea name="contentprice" id="contentprice" style="display:none;"></textarea>	 
  <div id="aEditor-Body">
     <div class="spage-main-box" style="">
     <h3>产品信息</h3>
     <div class="goods-detail" id="x-g-basic">
     <div class="tableform">
		<div class="division">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
				<if condition="$show neq ''">
				<tr>
					<th>移动链接地址：</th>
					<td><{:C("pic_url")}>wz.php/pro_show?id=<{$show.id}></td>
				</tr>
				</if>
				<tr>
				<th>商品分类：</th>
				<td><select name="bid" id="bid">
				  <!--<option value="0">选择分类</option>-->
				  <volist name="fllist" id="vol">
				  <option <if condition="$show['bid'] eq $vol['classid']">selected="selected"</if> value="<{$vol.classid}>" ><{$vol.class_name_cn}></option>
				  </volist>
				</select>
				<select name="classid" id="classid" style="display:none;">
				  <option value="0" >选择下级分类</option>
				  <volist name="sbid" id="vol">
				  <option <if condition="$eclasid eq $vol['classid']">selected="selected"</if> value="<{$vol.classid}>" ><{$vol.class_name_cn}></option>
				  </volist>
				  </select>
				  <select name="classid1" id="classid1" style="display:none;">
				  <option value="0" >选择下级分类</option>
				  <volist name="sbid1" id="vol">
				  <option <if condition="$show['classid'] eq $vol['classid']">selected="selected"</if> value="<{$vol.classid}>" ><{$vol.class_name_cn}></option>
				  </volist>
				  </select>
				  </td></tr>
				<tr>
					<th><font color="red">*</font>商品名称：</th>
					<td><input type="text" name="title" id="title" class="cd300" value="<{$show.title}>"></td>
				</tr>
				<tr>
					<th><font color="red">*</font>副标题：</th>
					<td><input type="text" name="text" id="text" class="cd300" value="<{$show.text}>"></td>
				</tr>
				<tr>
					<th><font color="red">*</font>商品编号：</th>
					<td><input type="text" name="model" id="model" class="cd300" value="<{$show.model}>"></td>
				</tr>				
				<tr>
					<th><font color="red">*</font>附加说明：</th>
					<td><textarea name="textsm" id="textsm" class="cdtext"><{$show.textsm}></textarea></td>
				</tr>
				<tr>
					<th><font color="red">*</font>市场价：</th>
					<td><input type="text" name="sprice_f" id="sprice" class="cd100" value="<{$show.sprice|default='0.00'}>"></td>
				</tr>
				<tr>
					<th><font color="red">*</font>销售价格：</th>
					<td><input type="text" name="price_f" id="price" class="cd100" value="<{$show.price|default='0.00'}>"></td>
				</tr>
				<tr>
					<th><font color="red">*</font>虚拟销量：</th>
					<td><input type="text" name="xnsale_int" id="xnsale" class="cd100" value="<{$show.xnsale|default='0'}>"></td>
				</tr>
				<tr>
					<th><font color="red">*</font>佣金价格：</th>
					<td><input type="text" name="yjprice_f" id="yjprice" class="cd100" value="<{$show.yjprice|default='0.00'}>">用于拿出来提成,二级分销百分比乘以此数</td>
				</tr>
				<tr>
					<th><font color="red">*</font>重量：</th>
					<td><input type="text" name="zl_int" id="zl" class="cd100" value="<{$show.zl|default='1.00'}>">KG(计算运费)</td>
				</tr>				
				<tr>
					<th><font color="red">*</font>商品库存：</th>
					<td><input name="kc_int"  id="kc" value="<{$show.kc|default='0'}>" type="text" class="cd100" /></td>
				</tr>
				<tr>
					<th><font color="red">*</font>评星：</th>
					<td><select name="xx">
					<option <if condition="$show[xx] eq 5">selected="selected"</if> value="5">5星</option>
					<option <if condition="$show[xx] eq 4">selected="selected"</if> value="4">4星</option>
					<option <if condition="$show[xx] eq 3">selected="selected"</if> value="3">3星</option>
					<option <if condition="$show[xx] eq 2">selected="selected"</if> value="2">2星</option>
					<option <if condition="$show[xx] eq 1">selected="selected"</if> value="1">1星</option>
					</select></td>
				</tr>
				
				<tr>
					<th><font color="red">*</font>排序：</th>
					<td><input type="text" name="sort_int" id="sort" class="cd100" value="<{$show.sort|default='0'}>">排序从大到小排列显示</td>
				</tr>
				<tr>
                     <th>发布状态：</th>
					 <td>
					 	<input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked</if>>已上架					 	<input type="radio" <if condition="($show[passed] eq 0)">checked</if> name="passed" value="0">已下架					 </td>
                </tr>
				
				<tr>
                     <th>是否推荐：</th>
					 <td><input type="radio" <if condition="($show[tj] eq 1)">checked</if> name="tj" value="1">是
					 	<input type="radio" name="tj" value="0" <if condition="($show[tj] eq 0)">checked</if>>否					 		
						 </td>
                </tr>
				<tr>
                     <th>是否热卖：</th>
					 <td><input type="radio" <if condition="($show[isnew] eq 1)">checked</if> name="isnew" value="1">是
					 	<input type="radio" name="isnew" value="0" <if condition="($show[isnew] eq 0)">checked</if>>否					 		
						 </td>
                </tr>

			</tbody></table>
		</div>
	</div>
    </div>
	</div>
	
    <div class="spage-main-box" style="">
  <h3>图片编辑</h3>
<div class="division tableform division-skin">
<table width="100%" border="0">
  <tr>
    <th>&nbsp;</th>
    <td>*请上传图为280px × 280pxpx的图片</td>
  </tr>
  <if condition='($show[spic] neq "")'>
			<tr>
                <th>图片：</th>
                <td><img id="thumbshow_1" width="100" height="100" src="<{$show[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="spic" type="hidden" rel="no" id="pic_1" size="53" class="cd" value="<{$show.spic}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.spic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=pro&filed=spic">删除文件</a></if>
                </td>
            </tr>
			<else/>
			<tr>
                <th>图片：</th>
                <td><img id="thumbshow_1" width="100" height="100"  src="no" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="spic" type="hidden" id="pic_1" rel="no" size="53" class="cd" value=""/><input type="button" id="image1" value="选择图片" />
                </td>
            </tr>
			</if>
			<tr>
    <th>&nbsp;</th>
    <td>多图上传图为300px × 300px的图片</td>
  </tr>
  <if condition='($show[mpic] neq "")'>
			<tr>
                <th>多图上传：</th>
                <td><input type="button" id="J_selectImage" value="批量上传" />
				<div id="J_imageView">
				<volist name="mpic" id="vol">
				<if condition="($vol neq '')">
				<img src="<{$vol}>" width="50" height="50"><a href="<{:C('web_url')}>__APP__/home_delfm.html?id=<{$show.id}>&kk=pro&filed=mpic&px=<{$i}>">删除</a>
				</if>
				</volist>
				</div>
				<input name="mpic" type="hidden" id="mpic" size="53" class="cd" value="<{$show[mpic]}>"/>
                </td>
            </tr>
	<else/>
				<tr>
                <th>多图上传：</th>
                <td><input type="button" id="J_selectImage" value="批量上传" />
				<div id="J_imageView">				
				</div>
				<input name="mpic" type="hidden" id="mpic" size="53" class="cd" value=""/>
                </td>
            </tr>
	</if>
</table>

</div>
</div>

<div class="spage-main-box" style=" display:;">
  <h3>参数编辑</h3>
<div class="division tableform division-skin">
<table width="100%" border="0">
<!--  <tr>
    <th>品牌类型：</th>
    <td><div id="ppid">
				<if condition="count($pplist) gt 0">
				<volist name="pplist" id="vol">
				<input type="radio" <if condition="$show['ppclassid'] eq $vol['classid']">checked="checked"</if> name="ppclassid" value="<{$vol['classid']}>" /><{$vol['class_name_cn']}>&nbsp;&nbsp;
				</volist>
				<else/>
				先选择分类
				</if>
				</div></td>
  </tr>-->
  <tr>
    <th>扩展类型：</th>
    <td><table width="100%" cellspacing="0" cellpadding="0"  bgcolor="#FFFFFF" style=" border:1px #f4f4f4 solid;">
             <tbody  id="kzid">
			 <if condition="count($kzlists) gt 0">
			 <volist name="kzlists" id="vol">
			 <tr><td width="10%" height="30" bgcolor="#ffffff" align="left">&nbsp;<{$vol['class_name_cn']}></td><td width="90%" bgcolor="#ffffff"><volist name="vol[0]" id="vol1">
			 &nbsp;<input type="checkbox" id="kzlink[]" value="<{$vol1['classid']}>" name="kzlink[]" <{$show['kzlink']|bh=###,$vol1['classid']}>><{$vol1['class_name_cn']}>&nbsp;
			 </volist>
			 </td></tr>
			 </volist>
			 <else/>
			 <tr>

                <td width="10%" height="30" bgcolor="#ffffff" align="left">先选择分类</td>

                <td width="90%" bgcolor="#ffffff"></td>
              </tr>
			  </if></tbody></table></td>
  </tr>
  <tr>
    <th><strong>价格参数信息</strong></th>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <th>是否使用：</th>
    <td><input name="isprice" id="isprice" type="radio" value="0"  <if condition="$show['isprice'] eq 0">checked="checked"</if>/>&nbsp;否&nbsp;&nbsp;&nbsp;<input name="isprice" id="isprice" type="radio" value="1" <if condition="$show['isprice'] eq 1">checked="checked"</if>/>&nbsp;是</td>
  </tr>
  <tr>
    <th>参数选择：</th>
    <td><dl id="xscs" style="display:<if condition="$show['isprice'] eq 0">none</if>;">
				名称可以自己修改
				<dd style=" width:100%;">
				<table width="100%" cellspacing="0" cellpadding="0"  bgcolor="#FFFFFF" style=" border:1px #f4f4f4 solid;">
             <tbody><tr>

                <td width="100%" height="30" bgcolor="#ffffff" align="left"><div class="div_contentlist" id="pricecs">
				<if condition="count($cslists) gt 0">
				<volist name="cslists" id="vol" key="p">
				<ul style="padding:0px;" class="Father_Title"><li contentEditable="true" rel="<{$vol['class_name_cn']}>" name="<{$vol['classid']}>"><{$priceprvname[$vol['classid']]|default=$vol['class_name_cn']}></li></ul><ul class="Father_Item<{$p-1}>">
				<volist name="vol[0]" id="vol1">
				<li class="li_width"><label><input type="checkbox" class="chcBox_Width" <if condition="$pricecsname[$vol1['classid']] neq ''">checked="checked"</if> value="<{$vol1['classid']}>"  alt="<{$vol1['class_name_cn']}>"/></label><span class="li_empty"  contentEditable="true" rel="<{$vol1['class_name_cn']}>"><{$pricecsname[$vol1['classid']]|default=$vol1['class_name_cn']}></span></li>
				</volist>
				</ul><div style="clear:both; height:1px;"></div>
				</volist>
				<else/>
				先选择分类
				</if>
				</div>
				<div class="div_contentlist2">
                        <ul style="padding:0px;">
                            <li style="padding:0px;"><div id="createTable">
							<if condition="count($csname) gt 0">
							<table cellspacing="0" cellpadding="1" border="1" style="width:100%;padding:0px;" id="process">
							<thead><tr><volist name="csname" id="vol"><th><{$vol}></th></volist><th style="width:70px;">价格</th><th style="width:70px;">库存</th></tr>
							</thead>
							<tbody>
							<volist name="csnamelist" id="vol">
							<tr>
							<volist name="csname" id="vol1" key="p">
							<td><{$pricecsname[$vol['csid'][$p-1]]}></td>
							</volist>
							<td><input type="text" value="<{$vol['price']}>" class="l-text" name="Txt_PriceSon"></td><td><input type="text" value="<{$vol['count']}>" class="l-text" name="Txt_CountSon"></td></tr>
							</volist>
							</tbody></table>
							</if>
							</div></li>							
                        </ul>						
                    </div></td>
              </tr>	</tbody></table>
			  
			</dd>
			  </dl></td>
  </tr>
</table>

</div>
</div>

     <div class="spage-main-box" style="">
  <h3>产品详细</h3>
<div class="division tableform division-skin">
<textarea name="content" rows="10" class="cd" id="content_1" style="width:500px; height:100px;"><{$show.content}></textarea>
</div>
<h3>趋势内容</h3>
<div class="division tableform division-skin">
<textarea name="qs" rows="10" class="cd" id="content_2" style="width:500px; height:100px;"><{$show.qs}></textarea>
</div>
</div>

     <div class="spage-main-box" style=" display:none;">
  <h3>积分购买设置</h3>
<div class="goods-detail" id="x-g-basic">
    <div class="tableform">
		<div class="division">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
				<tr>
					<th>是否积分购买：</th>
					<td><input name="isjf" value="1" type="radio" <if condition="$show['isjf'] eq 1">checked="checked"</if>/>是
					 	<input name="isjf" value="0" type="radio" <if condition="$show['isjf'] eq 0">checked="checked"</if>/>否</td>
				</tr>
				<tr>
					<th>购买名称：</th>
					<td><input name="jftitle" id="jftitle" type="text" class="cd300" value="<{$show.jftitle}>" /></td>
				</tr>
				<if condition='($show[jfspic] neq "")'>
			<tr>
                <th>图片：</th>
                <td><img id="thumbshow_2" width="100" height="100" src="<{$show['jfspic']|default=$show['spic']|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="jfspic" type="hidden" rel="no" id="pic_2" size="53" class="cd" value="<{$show['jfspic']|default=$show['spic']}>"/><input type="button" id="image2" value="选择图片" /><if condition="($show.jfspic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=pro&filed=jfspic">删除文件</a></if>
                </td>
            </tr>
			<else/>
			<tr>
                <th>图片：</th>
                <td><img id="thumbshow_2" width="100" height="100"  src="<{$show['jfspic']|default=$show['spic']|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="jfspic" type="hidden" id="pic_2" rel="no" size="53" class="cd" value="<{$show['jfspic']|default=$show['spic']}>"/><input type="button" id="image2" value="选择图片" />
                </td>
            </tr>
			</if>
				<tr>
					<th>简介：</th>
					<td><textarea name="jftext" cols="60" rows="5" class="cdtext" id="jftext" vtype="text" autocomplete="off"><{$show.jftext}></textarea></td>
				</tr>
				<tr>
					<th>积分价：</th>
					<td><input type="text" name="point" id="point" class="cd100" value="<{$show.point|default='0.00'}>">分</td>
				</tr>				
				<tr>
					<th>库存：</th>
					<td><input type="text" name="jfkc" id="jfkc" class="cd100" value="<{$show.jfkc|default='0'}>"></td>
				</tr>				
				<tr>
					<th>已购数量：</th>
					<td><input name="jfsl"  id="jfsl" value="<{$show.jfsl|default='0'}>" type="text" class="cd100"/></td>
				</tr>
			</tbody></table>
        </div>
	</div>
</div></div>

		<div class="spage-main-box" style="display:none;">
		  <h3>团购设置</h3>
		<div class="goods-detail" id="x-g-basic">
			<div class="tableform">
				<div class="division">
					<table cellspacing="0" cellpadding="0" border="0">
						<tbody>
						<tr>
							<th>是否设置团购：</th>
							<td><input name="istg" value="1" type="radio" <if condition="$show['istg'] eq 1">checked="checked"</if>/>是
								<input name="istg" value="0" type="radio" <if condition="$show['istg'] eq 0">checked="checked"</if>/>否</td>
						</tr>
						<tr>
							<th>团购名称：</th>
							<td><input name="tgtitle" id="tgtitle" type="text" class="cd300" value="<{$show.tgtitle}>" /></td>
						</tr>
						<if condition='($show[tgspic] neq "")'>
					<tr>
						<th>团购图片：</th>
						<td><img id="thumbshow_3" width="100" height="100" src="<{$show['tgspic']|default=$show['spic']|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="tgspic" type="hidden" rel="no" id="pic_3" size="53" class="cd" value="<{$show['tgspic']|default=$show['spic']}>"/><input type="button" id="image3" value="选择图片" /><if condition="($show.tgspic  neq '')"><a href="<{$Think.config.web_url}>__APP__/home_delf.html?id=<{$show.id}>&kk=user_pro&filed=tgspic">删除文件</a></if>
						</td>
					</tr>
					<else/>
					<tr>
						<th>团购图片：</th>
						<td><img id="thumbshow_3" width="100" height="100" src="<{$show['tgspic']|default=$show['spic']|default='no'}>"  onerror="javascript:this.src='<{$Think.config.web_url}>__WJ__/images/n.jpg';"><input name="tgspic" type="hidden" id="pic_3" rel="no" size="53" class="cd" value="<{$show['tgspic']|default=$show['spic']}>"/><input type="button" id="image3" value="选择图片" />
						</td>
					</tr>
					</if>
						<tr>
							<th>团购卖点：</th>
							<td><textarea name="tgtext" cols="60" rows="5" class="cdtext" id="tgtext" vtype="text" autocomplete="off"><{$show.tgtext}></textarea></td>
						</tr>
						<tr>
							<th>团购市场价：</th>
							<td><input type="text" name="tgprices" id="tgprices" class="cd100" value="<{$show.tgprices|default='0.00'}>"></td>
						</tr>
						<tr>
							<th>团购销售价格：</th>
							<td><input type="text" name="tgprice" id="tgprice" class="cd100" value="<{$show.tgprice|default='0.00'}>"></td>
						</tr>
						<tr>
							<th>团购库存：</th>
							<td><input type="text" name="tgkc" id="tgkc" class="cd100" value="<{$show.tgkc|default='0'}>"></td>
						</tr>
						<tr>
							<th>开始时间：</th>
							<td><input name="tgstime"  id="tgstime" value="<{$show.tgstime|default=$times|date='Y-m-d H:i:s',###}>" type="text" class="text w200" readonly="" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d HH:mm:ss',maxDate:'%y-{%M+30}-{%d-1} HH:mm:ss'})"/>	</td>
						</tr>
						<tr>
							<th>结束时间：</th>
							<td><input name="tgetime"  id="tgetime" value="<{$show.tgetime|default=$times1|date='Y-m-d H:i:s',###}>" type="text" class="text w200" readonly="" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d HH:mm:ss',maxDate:'%y-{%M+30}-{%d-1} HH:mm:ss'})"/>	</td>
						</tr>
						<tr>
							<th>已团购数量：</th>
							<td><input name="tgsl"  id="tgsl" value="<{$show.tgsl|default='0'}>" type="text" class="cd100"/></td>
						</tr>
					</tbody></table>
				</div>
			</div>
		</div></div>
  </div>


          </div>
          <div style="" class="content-foot">
		  <input type="submit" value="保存数据"  id="btnEnter" class="btn btn-primary" />
<button type="button" onclick="if(confirm('确定退出?'))parent.$.close('MenuEdit');" class="btn btn-default"><span><span>关    闭</span></span></button><span id="spnMsg" class="red"></span>
</div>
</form>
        </div>		
</div>
</body>
</html>