<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理系统</title>
<meta content="管理系统" name="keywords" />
<meta content="管理系统" name="description" />
<script>
var urlS="<?php echo C('web_url');?>__APP__/";
var piclj="<?php echo C('htpiclj');?>";
var piclj1="<?php echo C('htpiclj1');?>";
</script>
<link href="<?php echo C('web_url');?>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<?php echo C('web_url');?>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/function.js"></script>
<script>
if("undefined" != typeof passwordhh){ 
}
else
{
var passwordhh="";
}
if("undefined" != typeof jssy){ 
}
else
{
var jssy="";
}

</script>
<script charset="utf-8" src="<?php echo C('web_url');?>__WJ__/ke/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo C('web_url');?>__WJ__/ke/lang/zh_CN.js"></script>
<script>
		var options = {
        allowFileManager : true,
		urlType : 'relative',
		filterMode: false,
		width:'100%',
		height:'450px',
		items : [
		'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image',
		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
		'anchor', 'link', 'unlink', '|', 'about'
	   ]
        };
		var editor;
  			KindEditor.ready(function(K) {
				editor1 = K.create('#content_1',options);
				editor2 = K.create('#content_2',options);	
				editor3 = K.create('#content_3',options);
	
				
				var editor = K.editor({
					allowFileManager : true,
					urlType : 'relative',
					extraFileUploadParams: {
					user_id: '1',
					password: passwordhh,
					jssy: jssy
					}
				});
				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
						    // showLocal : false, //不开启本地图片上传
							//showRemote : false, //网络图片不开启	
							jssy: K('#pic_1').attr("rel"),						
							imageUrl : K('#pic_1').val(),
							clickFn : function(url, title, width, height, border, align) {
							    url=url.replace(piclj,piclj1);
								K('#pic_1').val(url);
								K('#thumbshow_1').attr('src',url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image2').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
						    jssy: K('#pic_2').attr("rel"),	
							imageUrl : K('#pic_2').val(),
							clickFn : function(url, title, width, height, border, align) {
							    url=url.replace(piclj,piclj1);
								K('#pic_2').val(url);
								K('#thumbshow_2').attr('src',url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image3').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
						    jssy: K('#pic_3').attr("rel"),
							imageUrl : K('#pic_3').val(),
							clickFn : function(url, title, width, height, border, align) {
							    url=url.replace(piclj,piclj1);
								K('#pic_3').val(url);
								K('#thumbshow_3').attr('src',url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image4').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
						    jssy: K('#pic_4').attr("rel"),
							imageUrl : K('#pic_4').val(),
							clickFn : function(url, title, width, height, border, align) {
							    url=url.replace(piclj,piclj1);
								K('#pic_4').val(url);
								K('#thumbshow_4').attr('src',url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image5').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
						    jssy: K('#pic_5').attr("rel"),
							imageUrl : K('#pic_5').val(),
							clickFn : function(url, title, width, height, border, align) {
							    url=url.replace(piclj,piclj1);
								K('#pic_5').val(url);
								K('#thumbshow_5').attr('src',url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#J_selectImage').click(function() {
					editor.loadPlugin('multiimage', function() {
						editor.plugin.multiImageDialog({
							clickFn : function(urlList) {
								var div = K('#J_imageView');
								var mpic = K('#mpic');
								var mpicnr=mpic.val();
								//mpicnr=mpic.val();
								K.each(urlList, function(i, data) {
								if(mpicnr){
									mpicnr=mpicnr+"|"+data.url;
									}
									else
									{
									mpicnr=data.url;
									}
									div.append('<img src="' + data.url + '" width="50" height="50">');
								});
								mpic.val(mpicnr);
								editor.hideDialog();
							}
						});
					});
				});
										
			});
		</script>


<!--MsgBox-->
<link type="text/css" href="<?php echo C('web_url');?>__WJ__/js/msg/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/AsyncBox.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/FunLib.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/json2.js"></script>
<script>
<?php if($_GET['err']== 1): ?>$(function(){
parent.MsgBox.SuccessMsg("修改成功");
//MsgBox.ErrorMsg({ msg: '上传缩略图失败' });
//asyncbox.tips('请设定链接目标', 'error');
//parent.MsgBox.ErrorMsg({ msg: '上传Logo失败' });
//parent.asyncbox.alert("请重新设置额度", "温馨提示");
});<?php endif; ?>
</script>
</head>
<body>

<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">微信网站信息</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" onSubmit="return wbadd(this);">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
  <tr>
    <th width="13%">网站名称：</th>
    <td width="87%"><input name="company" type="text" id="company" class="cd500"  value="<?php echo ($show["company"]); ?>"/></td>
  </tr> 
  <tr>
    <th width="13%">网站标题：</th>
    <td width="87%"><input name="t" type="text" id="t" class="cd500"  value="<?php echo ($show["t"]); ?>"/></td>
  </tr>
  <tr>
    <th width="13%">网站关键字：</th>
    <td width="87%"><input name="k" type="text" id="k" class="cd500"  value="<?php echo ($show["k"]); ?>"/></td>
  </tr>
  <tr>
    <th width="13%">网站描述：</th>
    <td width="87%"><textarea name="d" rows="10" class="cd" id="d" style="width:500px; height:100px;"><?php echo ($show["d"]); ?></textarea></td>
  </tr>
  <tr>
    <th width="13%">标准时薪：</th>
    <td width="87%"><input name="wage" type="text"  class="cd50"  value="<?php echo ($show["wage"]); ?>"/>元</td>
  </tr>
  
  <tr>
    <th width="13%">现场支付上限：</th>
    <td width="87%"><input name="limit" type="text"  class="cd50"  value="<?php echo ($show["limit"]); ?>"/>元</td>
  </tr>
  <tr>
    <th width="13%">审核通知号码：</th>
    <td width="87%"><input name="notice_tel" type="text"  class="cd150"  value="<?php echo ($show["notice_tel"]); ?>"/></td>
  </tr>
   <!--  <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为640px × 181px的图片 500K以内</td>
  </tr>
  <tr>
    <th>LOGO图片：</th>
    <td><img id="thumbshow_1" width="166" height="80"  src="<?php echo (($show[log])?($show[log]):'no'); ?>" onerror="javascript:this.src='<?php echo C('web_url');?>__APP__/pub_nopic.html?l=166&w=80';"><input name="log" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<?php echo ($show["log"]); ?>"/><input type="button" id="image1" value="选择图片" /><?php if(($show["log"] != '')): ?><a href="<?php echo C('web_url');?>__APP__/home_delf.html?id=<?php echo ($show["id"]); ?>&kk=Web&filed=log">删除文件</a><?php endif; ?></td>
  </tr>
 <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为160 × 160px的图片 500K以内</td>
  </tr>
   <tr>
    <th>APP二维码：</th>
    <td><img id="thumbshow_2" width="100" height="100"  src="<?php echo (($show[weberw])?($show[weberw]):'no'); ?>" onerror="javascript:this.src='<?php echo C('web_url');?>__APP__/pub_nopic.html?l=100&w=100';"><input name="weberw" type="hidden" id="pic_2"   rel="no" size="53" class="cd" value="<?php echo ($show["weberw"]); ?>"/><input type="button" id="image2" value="选择图片" /><?php if(($show["weberw"] != '')): ?><a href="<?php echo C('web_url');?>__APP__/home_delf.html?id=<?php echo ($show["id"]); ?>&kk=Web&filed=weberw">删除文件</a><?php endif; ?></td>
  </tr>
   <tr>
    <th>&nbsp;</th>
    <td>*请上传大小为160 × 160px的图片 500K以内</td>
  </tr>
   <tr>
    <th>微信二维码：</th>
    <td><img id="thumbshow_3" width="100" height="100"  src="<?php echo (($show[wxewm])?($show[wxewm]):'no'); ?>" onerror="javascript:this.src='<?php echo C('web_url');?>__APP__/pub_nopic.html?l=100&w=100';"><input name="wxewm" type="hidden" id="pic_3"  rel="no" size="53" class="cd" value="<?php echo ($show["wxewm"]); ?>"/><input type="button" id="image3" value="选择图片" /><?php if(($show["wxewm"] != '')): ?><a href="<?php echo C('web_url');?>__APP__/home_delf.html?id=<?php echo ($show["id"]); ?>&kk=Web&filed=wxewm">删除文件</a><?php endif; ?></td>
  </tr>-->
  <!--<tr>
    <th width="13%">快递查询公司编号：</th>
    <td width="87%"><input name="KUAIDI_APP_CODE" type="text" id="KUAIDI_APP_CODE" class="cd200"  value="<?php echo ($show["KUAIDI_APP_CODE"]); ?>"/></td>
  </tr>
  <tr>
    <th width="13%">快递查询APP_KEY：</th>
    <td width="87%"><input name="KUAIDI_APP_KEY" type="text" id="KUAIDI_APP_KEY" class="cd200"  value="<?php echo ($show["KUAIDI_APP_KEY"]); ?>"/>请不要随便更改</td>
  </tr>
  <tr style="display:none;">
    <th width="13%">在线QQ,用|分隔：</th>
    <td width="87%"><input name="qq" type="text" id="qq" class="cd500"  value="<?php echo ($show["qq"]); ?>"/></td>
  </tr>
   <tr>
    <th width="13%">客服电话：</th>
    <td width="87%"><input name="tel" type="text" id="tel" class="cd300"  value="<?php echo ($show["tel"]); ?>"/></td>
  </tr>-->
   <tr>
    <th>网站默认模板：</th>
    <td><select id="temp" name="temp" class="cd">
            <option value="default">default</option></select></td>
  </tr>
    <tr>
    <th>版权信息：</th>
    <td><textarea name="bqxx" rows="10" class="cd" id="bqxx" style="width:500px; height:100px;"><?php echo ($show["bqxx"]); ?></textarea></td>
  </tr>
   <tr>
    <th>网站开关：</th>
    <td><input type="radio" value="1" name="closecon" <?php if(($show["closecon"] == 1)): ?>checked="checked"<?php endif; ?>>开启&nbsp;<input type="radio" value="0" name="closecon" <?php if(($show["closecon"] == 0)): ?>checked="checked"<?php endif; ?>>关闭</td>
  </tr>
     <tr>
    <th>站点统计开关：</th>
    <td><input type="radio" value="1" name="pv" <?php if(($show["pv"] == 1)): ?>checked="checked"<?php endif; ?>>开启&nbsp;<input type="radio" value="0" name="pv" <?php if(($show["pv"] == 0)): ?>checked="checked"<?php endif; ?>>关闭</td>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/><input type="reset" value="重置" class="btn"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/remind.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/bootstrap.min.js"></script>
<style type="text/css">
    .vshop
    {
        overflow: hidden;
    }
    .sname
    {
        float: left;
    }
    .bindwx, .vok
    {
        float: left;
    }
</style>
	<script type="text/javascript">
    var ejecttime = "s_ejecttime";
</script>
<div id="asyncbox_cover" unselectable="on" style="opacity: 0.1; filter: alpha(opacity=10);
    background: #000">
</div>
<div id="asyncbox_clone">
</div>
<div id="asyncbox_focus">
</div>
<div id="asyncbox_load">
    <div>
        <span></span>
    </div>
</div>
<div class="pop_up" id="message">
    <div class="pop_up_top">
        <span>温馨提示</span><a href="javascript://" id="message_close"></a></div>
    <div class="pop_up_middle">
        <ul>
            <li>
                <div class="m" style="float: left;">
				  <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>产品订单:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未付款(<span class="messageTxt"
                        id="span_Message"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已付款(<span class="messageTxt"
                        id="span_BackOrder"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;">已发货(<span class="messageTxt"
                        id="point"><b>0</b></span>)</font>						
						</div>
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				 <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>返利结算:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未结算订单数(<span class="messageTxt"
                        id="zxsj1"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已结算订单数(<span class="messageTxt"
                        id="zxsj2"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj3"><b></b></span></font>						
                    </div>					
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				
                    <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>其他信息:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">提现申请(<span class="messageTxt"
                        id="span_AdvisoryReply"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj4"><b></b></span></font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="nr"><b></b></span></font>						
						</div>
						
                </div>
            </li>
            <li>
                <div class="m">
                    <dl>
                        <dt>设置提示时间：</dt>
                        <dd id="select_dd" style="float:left; margin-top:-5px;">
                            <div class="drop_down" id="drop_down_down1">
                                默认（10分钟）
                            </div>
                            <div class="select_div select_div1" id="select_div1">
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="0">
                                    <a href="#">不再提醒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="3600000">
                                    <a href="#">60分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="2700000">
                                    <a href="#">45分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1800000">
                                    <a href="#">30分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1200000">
                                    <a href="#">20分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="600000">
                                    <a href="#">10分钟（默认）</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="300000">
                                    <a href="#">5分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="120000">
                                    <a href="#">2分钟</a></p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="60000">
                                    <a href="#">1分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="30000">
                                    <a href="#">30秒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="10000">
                                    <a href="#">10秒</a>
                                </p>
                                <div class="clear">
                                </div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
    <div class="pop_up_bottom">
    </div>
</div>
</body>
</html>