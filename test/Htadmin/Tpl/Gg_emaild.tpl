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
            $("#spnMsg").text('');
			 var subject = $.trim($("#subject").val());
			if (subject == "") {
			$("#spnMsg").html("请输入模板名称");
                return false;
            }
            var tit = $.trim($("#title").val());
			if (tit == "") {
			//$("#spnMsg").html("请输入邮件标题");
             //   return false;
            }
			
            return true;
        }

        //添加成功
        function AddSuccess(id, tit) {
            MsgBox.SuccessMsg("操作成功");
            parent.AddSuccess(id, tit);
            setTimeout(parent.$.close('MenuEdit'), 2000);
        }
        //编辑成功
        function EditSuccess(tit) {
            MsgBox.SuccessMsg("操作成功");
            parent.EditSuccess(tit);
            setTimeout(parent.$.close('MenuEdit'), 2000);
        }		
    </script>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
	<input name="id_not" type="hidden" value="<{$show.id}>" />	
	<input name="qy" type="hidden" value="<{$Think.cookie.qy}>" />	
		<div class="hyinfo"><b class="text-warning">模板管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
             <tr>
                <th width="11%">模板名称：</th>
                <td width="89%"><input name="subject" id="subject" type="text" class="cd300" value="<{$show.subject}>" /></td>
            </tr>
			<tr>
                <th>短信模板内容：</th>
               <td><span class="red">(参数:{%d}-数字,{%s}-字符)(内容中只能有一个{%d}或者{%s}，其他文字可以调整)</span><br />
<textarea name="message" class="cdtext" id="message"><{$show.message}></textarea></td>
            </tr>		
			<tr>
                <th>邮件模板内容：</th>
               <td><span class="red">(参数:{%d}-数字,{%s}-字符)(预留接口，不需要动)</span><br />
<textarea name="yjmessage" class="cdtext" id="yjmessage"><{$show.yjmessage}></textarea></td>
            </tr>
			 <tr>
                <th width="11%">微信模板编号：</th>
                <td width="89%"><input name="tm" id="tm" type="text" class="cd300" value="<{$show.tm}>" /><span class="red">（预留接口，以下不需要动)</span></td>
            </tr>
			 <tr>
                <th width="11%">微信模板ID：</th>
                <td width="89%"><input name="template_id" id="template_id" type="text" class="cd300" value="<{$show.template_id}>" /></td>
            </tr>
			<tr>
                <th>微信模板内容：</th>
               <td><span class="red">请不要随便修改</span><br />
<textarea name="wxmessage" class="cdtext" id="wxmessage"><{$show.wxmessage}></textarea></td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>