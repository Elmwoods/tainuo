<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{$Think.config.web_url}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{$Think.config.web_url}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/js/js.js"></script>
<include file="Pub:js" />
</HEAD>
<body>
<script type="text/javascript">
function checkm()
{
	 if (document.mailsend.subject.value==""   || document.mailsend.mtype.value=="")
		{ 
         alert("内容，主题和内容不能为空！") 
         return false;  
        }  
     else 
		 {
		 List = document.forms[0].hyid1;
		 if (List.length && List.options[0].value == 'temp'){
		 alert("请选择一个会员!");
		 return false;
		 }
		 allSelect();
		 return true;} 

}
</script>
<script type="text/javascript">
$(function(){
$("#btn").click(function(){
var t = $("#t").val();
var isshop = $("#isshop").val();
if(t=="" && isshop==""){
//alert('请输入查找内容');
//$("#t").focus();
//return false;
}
$.ajax({
            url: urlS+'gg_ss.html',
            type: 'GET', 
			data:{"t":t,"isshop":isshop},
            error: function(){alert('服务器连接忙，请稍后再试。');},
            success: function(msg){
			$('#hyid').html(msg);}
           });

})
});

function copyToList(from,to,fx) {
fromList = eval('document.forms[0].' + from);
toList = eval('document.forms[0].' + to);
if (toList.options.length > 0 && toList.options[0].value == 'temp')
{
toList.options.length = 0;
}

if (toList.options.length > 0 && toList.options[0].value != 'temp' && fx=='y')
{
//alert ('一次只能选择一个!');
//return;
}

var sel = false;
for (i=0;i<fromList.options.length;i++)
{
var current = fromList.options[i];
if (current.selected)
{
sel = true;
if (current.value == 'temp')
{
alert ('你不能选择这个项目!');
return;
}
txt = current.text;
val = current.value;
toList.options[toList.length] = new Option(txt,val);
fromList.options[i] = null;
i--;
}
}
if (!sel) alert ('你还没有选择任何对象!');
}

function allSelect() {
List = document.forms[0].hyid1;
if (List.length && List.options[0].value == 'temp') return;
for (i=0;i<List.length;i++)
{
List.options[i].selected = true;
}
}

</script>
<style>
.bigbox{background-color:#FFFFFF;width:99%;  float:left; padding-left:1%;}
.bigboxhead{ height:38px; line-height:38px;vertical-align: middle; font-size:14px;color:#0099CC;font-weight:bold;float:left;width:90%;}
.bigboxbody{
	height:auto;
	float:left;
	width:100%;
	width:99.8%!important;
	border-bottom:1px solid #DEEFFB;
	line-height:25px;
	margin-top:3px;
}
.bigboxbody td{line-height:25px; padding:3px; padding-left:5px; border-top: 1px solid #d4e7ff;}
.bigboxbody a{ font-size:12px; list-style:none;}
.bigboxbody a:hover{ font-size:12px; text-decoration: none; color: #006699;}
</style>
<div class="bigbox">
	<div class="bigboxhead">邮件群发</div>
<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>

      <td width="100%" valign="top">
		<form method="post" action="<{$Think.config.web_url}>__APP__/gg_mailsend" name="mailsend">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="5%" >收信人邮箱</td>
              <td>
			  
			  <TABLE width="100%" border="0" cellpadding=0 cellspacing=0>				 
				<TR class="theader">
							<TD colspan="3">按手机号/邮箱查找：
            <input type="text" name="t" id="t" style="width:250px;"><select style="width:130px;" name="isshop" id="isshop">
	<option value="">会员级别</option>
	<php>
foreach($vip as $k=>$v){
	echo "<option value='".$k."'>".$v."</option>";
}
</php>
</select><input type="button" value="搜索" id="btn" name="btn"></TD>
				</TR>
					<TR>
					  <TD width="187" style="border-bottom:none"><select name="hyid" id="hyid" size="4" MULTIPLE style="width: 200px; height:200px;">
</select>                     </TD>
			          <TD width="146" style="border-bottom:none; text-align:center;">
						<input type="button" value=">>" onClick="javascript:copyToList('hyid','hyid1','y');"><br>
                        <input type="button" value="<<" onClick="javascript:copyToList('hyid1','hyid','z');"><br></TD>
					  <TD width="413" style="border-bottom:none">
					  <select name="hyid1[]" id="hyid1" size="4" MULTIPLE style="width: 200px; height:200px;">
					  <option value="temp">选择对象</option>
					  </select></TD>
					</TR>
				</TABLE>
                </td>
            </tr>
            <tr>
              <td >类别</td>
              <td >
                <input type="radio" name="mtype" id="radio" value="1" checked="checked" >
              电子邮件<input type="radio" name="mtype" id="radio2" value="2">
              手机短信(直接编辑内容发布)</td>
            </tr>            
            <tr>
              <td valign="top" > 发送主题 </td>
              <td valign="top" ><input name="subject" type="text"  value="<{$show.title}>" style="width:500px;"></td>
            </tr>
            <tr> 
              <td width="16%" valign="top" > 发送内容<br />
<span style="color:#FF0000;">[username]直接替换为用户呢称<br />
[sitename]直接替换为脚本数据(只用于邮件发送)</span></td>

              <td width="84%" valign="top" > 
                <textarea name="mes"  id="content_1" style="width:500px; height:400px; padding:3px;"><{$show.message}></textarea>              </td>
            </tr>
            <tr> 
              <td width="16%" style="border-bottom:none;">&nbsp; </td>
              <td width="84%" style="border-bottom:none;"> 
                <input class="btn" type="submit" name="submit" value="发送信息" onClick="return checkm();">
                <input name="action" type="hidden" id="action" value="send"></td>
            </tr>
        </table>
        </form>
      </td>
    </tr>
  </table>
  </div>
  </div>
</body>
</html>