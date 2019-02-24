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
<include file="Pub:js" />
<!--MsgBox-->	
<include file="Pub:msg" />
<script type="text/javascript">
        function Enter() {
			     
            return true;
        }
		function deltjuser(){
		 if(confirm("确定要解除吗？一旦解除将不能恢复！")){
		   location.href=urlS+"user_jc?user_id=<{$show.id}>";
		 }
		 else{
		 
		 }
		}        
    </script>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
	<input name="id_not" type="hidden" value="<{$show.id}>" />	
		<div class="hyinfo"><b class="text-warning">酒店信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>酒店名称：</th>
                <td><input name="title" type="text" id="title" class="cd150"  value="<{$show.title}>" placeholder="名称"/></td>
            </tr>
             <tr>
                     <th><font color="red">*</font>排序：</th>
                     <td><input type="text" name="sort_int" id="sort"  value="<{$show.sort|default='0'}>" class="cd50"><font color="red">数字越大越靠前</font></td>
                </tr>
		  	
							
			<tr>
                <th>审核状态：</th>
                <td><input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked=""</if> >
是
<input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked=""</if>>
否 </td>
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