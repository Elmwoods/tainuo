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
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/My97DatePicker/WdatePicker.js"></script>
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
<script type="text/javascript">
        function Enter() {
            let level_name = $('#username').val(),
                price = $('#moble').val();
            if(level_name == '' || price == ''){
                alert('等级名称和时薪必填!');
                return false;
            }
        }
		function deltjuser(){
            if(confirm("确定要解除吗？一旦解除将不能恢复！")){
            location.href=urlS+"user_jc?user_id=<?php echo ($show["id"]); ?>";
            }
            else{
            
            }
		}        
    </script>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
        <input name="id_not" type="hidden" value="<?php echo ($show["id"]); ?>" />	
		<div class="hyinfo"><b class="text-warning">服务员等级信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>等级名称：</th>
                <td><input name="level_name" type="text" id="username" class="cd150"  value="<?php echo ($show["level_name"]); ?>" placeholder="等级名称"/></td>
            </tr>
            <tr>
                <th>时薪: </th>
                <td><input name="price" type="number" id="moble" class="cd150"  value="<?php echo ($show["price"]); ?>" placeholder="时薪"  step="0.01"/></td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />               
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>