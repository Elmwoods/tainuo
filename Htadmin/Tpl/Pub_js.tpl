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
<script charset="utf-8" src="<{:C('web_url')}>__WJ__/ke/kindeditor-min.js"></script>
<script charset="utf-8" src="<{:C('web_url')}>__WJ__/ke/lang/zh_CN.js"></script>
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
