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
            var tit = $.trim($("#name").val());
			if (tit == "") {
			$("#spnMsg").html("请输入标题");
                return false;
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
		<div class="hyinfo"><b class="text-warning">广告位管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="8%">名称：</th>
                <td width="92%"><input name="name" id="name" type="text" class="cd300" value="<{$show.name}>" /></td>
            </tr>
			<tr>
                <th>分组：</th>
                <td><input name="fz" id="fz" type="text" class="cd300" value="<{$show.fz}>" /></td>
            </tr>
			<tr>
                <th>规格：</th>
                <td>宽&nbsp;<input name="width" id="width" type="text" class="cd50" value="<{$show.width}>" />&nbsp;&nbsp;高&nbsp;<input name="height" id="height" type="text" class="cd50" value="<{$show.height}>" />必须填写单位px</td>
            </tr>
			<tr>
                <th>数量：</th>
                <td><input name="total" id="total" type="text" class="cd50" value="<{$show.total}>" /></td>
            </tr>			 
			<tr>
                <th>备注：</th>
                <td><textarea name="con"  id="con"class="cdtext"><{$show.con}></textarea></td>
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