///*** write by Dragoner ***
///*** 2014-04-25 17:08 ***
///*** 引用uploadify.css ***
///*** 引用jquery.uploadify-2.1.4.min.js ***
///*** 引用swfobject.js ***
///*** id:file控件ID ***
///*** act:传递参数到ashx后台,如:uploadproductpic ***
///*** multi:是否允许同时多个文件上传,如:true ***
///*** fileExt:上传文件类型,如:*.jpg;*.png; ***
///*** queueID:进度度条显示容器id ***
///*** sizeLimit:限制上传文件大小,byte单位,如:'102400' ***
///*** height:上传按钮高度,如:30 ***
///*** width:上传按钮宽度,如:82 ***
///*** buttonImg:上传按钮图片,如:'/uploadify/upload_select.png' ***
///*** removeCompleted:上传完文件之后,进度条是否消息 ***
///*** method:上传完成后返回的方法 ***
var uploadify = function (id, act, multi, fileExt, queueID, sizeLimit,height,width, buttonImg, removeCompleted, method,timestamp,token) {
	jQuery("#" + id).uploadify({
		'method': 'get',
		'scriptData': { 'act': act,'timestamp':timestamp,'token':token },					//可提供URL传递参数。用来传递get参数
		'uploader': uurlS+'uploadify.swf',  //上传控件的主体文件，flash控件
		'script': urlS+'weix_upload',				//相对路径的后端脚本，它将处理您上传的文件
		'cancelImg': uurlS+'uploadify-cancel.png',  //删除按钮
		'multi': multi,				//是否允许同时上传多文件
		'auto': true,				//选定文件后是否自动上传
		'fileExt': fileExt,			//限制上传文件的类型
		'fileDesc': fileExt,		//出现在上传对话框中的文件类型描述。与fileExt需同时使用
		'queueID': queueID,			//进度条显示容器
		'sizeLimit': sizeLimit,		//限制上传图片大小为100*1024,单位为byte
		'buttonText': '选择文件',   //按钮文本
		'height': height,			//按钮高度
		'width': width,				//按钮宽度
		'buttonImg': buttonImg,		//上传按钮图片
		'removeCompleted': removeCompleted,    //上传之后，隐藏些进度条
		'onComplete': function (event, queueId, fileObj, response, data) {
			var responsejson = eval("(" + response + ")");			
			method(id,responsejson);
		}
	});
};