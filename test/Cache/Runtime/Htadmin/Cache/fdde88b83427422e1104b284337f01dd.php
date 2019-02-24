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
<!--MsgBox-->	
<link type="text/css" href="<?php echo C('web_url');?>__WJ__/js/msg/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/AsyncBox.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/FunLib.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/json2.js"></script>
<script type="text/javascript">
AddSuccess();
function AddSuccess() {
var timestamp1 = Date.parse(new Date());  
var timestamp2 = (new Date()).valueOf();  
var timestamp3 = new Date().getTime();
sj=timestamp1+"" + timestamp2 + "" + timestamp3;
            parent.MsgBox.SuccessMsg("操作成功");
			<?php if(($sx == 1)): ?>window.parent.frames['main'].location.reload();
			<?php else: ?>
			window.parent.frames['main'].document.location=urlS+"<?php echo ($action); ?>.html?classid=<?php echo ($classid); ?>&sj="+sj+"#<?php echo ($classid); ?>";<?php endif; ?>
			//var htmlUrl = window.parent.$("#main").attr("src","http://www.ni8.com"); 
			//window.parent.frames['main'].location.reload()
            setTimeout(parent.$.close('MenuEdit'), 2000);
        }
</script>
</head>
<body>
</body>
</html>