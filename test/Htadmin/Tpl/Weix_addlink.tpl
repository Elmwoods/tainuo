<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>

<include file="Pub:msg" />
<script src="<{:C('web_url')}>__WJ__/js/wx.js" type="text/javascript"></script>
	
<include file="Pub:js" />
    <script type="text/javascript">
        //var targetObj;//目标对象

        function Enter() {
            var tit = $.trim($("#txtTitle").val());
            var target = $("input[name='txtTargetDesc']").val();
            var valid = true;

            if (tit == "") {
                TdTips.showTdErr("txtTitle", "请输入链接文字");
                valid = false;
            }
            else {
                TdTips.clearTdErr("txtTitle");
            }

            if (target == "") {
                TdTips.showTdErr("txtTargetDesc", "请输入链接目标");
                valid = false;
            }
            else {
                TdTips.clearTdErr("txtTargetDesc");
            }

            if (valid) {
                parent.InsertText(targetObj, '<a href="'+target+'">' + tit + '</a>');
                parent.$.close('AddLink');
            }
        }
    </script>
</head>
<body>
<form method="post" action="" id="form1">
        <table id="TableList" width="100%" class="fromtj" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="90" height="30"><span class="red">*</span>链接文字：</td>
                <td>
                    <input type="text" id="txtTitle" maxlength="100" class="cd" />
              </td>
            </tr>
            <tr>
                <td class="tdtitle"  height="30"><span class="red">*</span>链接目标：</td>
                <td>
                    <input type="text" class="cd"  name="txtTargetDesc"  id="txtTargetDesc" maxlength="300"/>                   
                </td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td><br />
<br />

                    <input type="button" class="btn btn_submit" value=" 确 定 " onclick="Enter()" />
                    &nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('AddLink')" /><br />
<br />

                </td>
            </tr>
            </tbody>
        </table>
    </form>
</body>
</html>