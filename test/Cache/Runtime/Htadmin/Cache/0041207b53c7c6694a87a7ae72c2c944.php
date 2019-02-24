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
<link href="<?php echo (C("web_url")); ?>__WJ__/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo (C("web_url")); ?>__WJ__/js/jquery-1.9.1.min.js"></script>
</head>
<body style="overflow-x:hidden;">

   <div class="menuBox1" id="menuBox1">
    <!--系统设置-->
	<?php $dy=1;?>
	
<?php if(is_array($mem)): $mlist = 0; $__LIST__ = $mem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($mlist % 2 );++$mlist; if(($mlist == $bk)): if(is_array($vol[1])): $i = 0; $__LIST__ = $vol[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol1): $mod = ($i % 2 );++$i;?><div>
      <h3 class="close"><?php echo ($vol1[0]); ?></h3>
      <ul class="dis">
	  <?php if(is_array($vol1[1])): $i = 0; $__LIST__ = $vol1[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i; if((is_array($usergroup)&&in_array(md5($vol2[1]),$usergroup))||($user['adminjb']==1)){ ?>
	  <?php if($dy==1){ $rur=C('web_url').__APP__.'/'.$vol2[1]; $dy++; }?>
	  <?php if(($vol2[1] == "htadmin/mysql")): ?><li><a href="../<?php echo ($vol2[1]); ?>" target="main"><?php echo ($vol2[0]); ?></a></li>
	   <?php else: ?>
        <li><a href="<?php echo (C("web_url")); ?>__APP__/<?php echo ($vol2[1]); ?>" target="main"><?php echo ($vol2[0]); ?></a></li><?php endif; ?>
	  <?php } endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
	
	
</div>
<?php if($_GET['b']<>'1'){ ?>
<?php if(($rur != "")): ?><script>
$(function(){
<?php if(($bk == 1)): ?>parent.document.getElementById("main").src="<?php echo (C("web_url")); ?>__APP__/home_welcome.html";
<?php else: ?>
parent.document.getElementById("main").src="<?php echo ($rur); ?>";<?php endif; ?>
});
</script><?php endif; ?>
<?php } ?>
<div style="padding-left:20px; margin-top:20px;">
    <a href="http://www.ni8.com" target="_blank"><img src="<?php echo (C("web_url")); ?>__WJ__/images/tech.jpg" width="100%" title="技术支持"/></a>
	</div>
<script type="text/javascript">
$(function(){
    $("#menuBox1 div h3").each(function(dq) {
	$(this).click(function(){
	var sl=$('#menuBox1').children("div").length;	
	for(i=0;i<sl;i++){
	if(i!=dq){
	$('#menuBox1').children("div").eq(i).find("ul").hide();
	$('#menuBox1').children("div").eq(i).find("h3").removeClass("close");
	$('#menuBox1').children("div").eq(i).find("h3").addClass("close");
	}
	}		
	$(this).toggleClass("close");
	$(this).next("ul").toggle();
    });
	});
    $("#menuBox1 h3:eq(0)").click();

    $("#menuBox1 a").click(function() {
        var obj = $(this);
        obj.blur();
        $("#menuBox1 a").removeClass("on");
		obj.addClass("on");
    });
})
</script>
</body>
</html>