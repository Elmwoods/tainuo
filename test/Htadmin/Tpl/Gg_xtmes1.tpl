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
function checkm(){	
         var dx=$("input[name='dx']:checked").val();
		 if(dx==1){
			 var List = document.forms[0].hyid1;
			 if (List.length && List.options[0].value == 'temp'){
			 alert("请选择一个会员!");
			 return false;
			 }
			 allSelect();
		 }
		 return true; 

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
	<div class="bigboxhead">站内信</div>
<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>

      <td width="100%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
		    <tr> 
			<td width="5%" >信息类型</td>
			<td width="5%" >
			<if condition="$show['lx'] eq 1">系统</if>
			<if condition="$show['lx'] eq 2">通知</if>
			<if condition="$show['lx'] eq 3">公告</if>

         </td>
			</tr>
		    <tr> 
			<td width="5%" >发送对象</td>
			<td width="5%" ><{$show['id']|xxname=###}></td>
			</tr>
              
			 <tr> 
              <td width="16%" valign="top" > 标题</td>

              <td width="84%" valign="top" ><{$show['title']}></td>
            </tr>          
            <tr> 
              <td width="16%" valign="top" > 发送内容</td>

              <td width="84%" valign="top" > 
               <{$show['content']}>              </td>
            </tr>
            <tr> 
              <td width="16%" style="border-bottom:none;">&nbsp; </td>
              <td width="84%" style="border-bottom:none;"> 
			    <input class="btn btn-primary" type="submit" name="submit" value="关闭" onclick="parent.$.close('MenuEdit')">               </td>
            </tr>
        </table>
       
      </td>
    </tr>
  </table>
  </div>
  </div>
</body>
</html>