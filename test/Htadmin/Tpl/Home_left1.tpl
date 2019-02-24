<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{$Think.config.web_url}>__WJ__/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/jquery-1.9.1.min.js"></script>
</head>
<body style="overflow-x:hidden;">

   <div class="menuBox1" id="menuBox1">
    <!--系统设置-->
	<?php $dy=1;?>
	
<volist name="mem" id="vol" key="mlist">
<if condition='($mlist eq $bk)'>
<volist name="vol[1]" id="vol1">
    <div>
      <h3 class="close"><{$vol1[0]}></h3>
      <ul class="dis">
	  <volist name="vol1[1]" id="vol2">
	  <php>if((is_array($usergroup)&&in_array(md5($vol2[1]),$usergroup))||($user['adminjb']==1)){</php>
	  <?php if($dy==1){
	   $rur=C('web_url').__APP__.'/'.$vol2[1];
	   $dy++;
	  }?>
	  <if condition='($vol2[1] eq "htadmin/mysql")'>
	   <li><a href="../<{$vol2[1]}>" target="main"><{$vol2[0]}></a></li>
	   <else/>
        <li><a href="<{$Think.config.web_url}>__APP__/<{$vol2[1]}>" target="main"><{$vol2[0]}></a></li>
		</if>
	  <php>}</php>
	  </volist>
      </ul>
    </div>	
</volist>
</if>
</volist>
	
	
</div>
<php>if($_GET['b']<>'1'){</php>
<if condition='($rur neq "")'>
<script>
$(function(){
<if condition='($bk eq 1)'>
parent.document.getElementById("main").src="<{$Think.config.web_url}>__APP__/home_welcome.html";
<else/>
parent.document.getElementById("main").src="<{$rur}>";
</if>
});
</script>
</if>
<php>}</php>
<include file="Pub:log" />
</body>
</html>