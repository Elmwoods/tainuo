<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/wx.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/menutree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<!--MsgBox-->	
<link type="text/css" href="<{:C('web_url')}>__WJ__/css/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/AsyncBox.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/FunLib.js"></script>
<script type="text/javascript">
        function Enter() {
            $("#spnMsg").text('');
            var tit = $.trim($("#txtTitle").val());
			var sorts = $.trim($("#sort").val());
            if (tit == "") {
			$("#spnMsg").html("请输入菜单标题");
                return false;
            }
			if (sorts == "") {
			$("#spnMsg").html("请输入排序号");
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
    <form method="post" action="<{:C('web_url')}>__APP__/weix_menuadd?parent=<{$parent}>" id="form1">
	<input name="id" type="hidden" value="<{$show.id}>" />
        <div id="divTitle" class="title">添加菜单</div>
        <table id="TableList" width="100%" class="tbmodify" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="tdtitle" width="70"><span class="red">*</span>菜单标题：</td>
                <td>
                    <input name="txtTitle" type="text" id="txtTitle" maxlength="8" class="txt350"  value="<{$show.mtitle}>"/>
                    <div class="gray">（菜单标题在8个字以内）</div>
                </td>
            </tr>
			 <tr>
                <td class="tdtitle" width="70"><span class="red">*</span>排序：</td>
                <td>
                    <input name="sort" type="text" id="sort" maxlength="8" class="txt350" value="<{$show.sort}>"/>
                    <div class="gray">（必须是数字）</div>
                </td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" name="btnEnter" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</body>
</html>