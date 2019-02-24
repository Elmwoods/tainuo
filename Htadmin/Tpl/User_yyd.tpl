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
            var tit = $.trim($("#content").val());
			if (tit == "") {
			//$("#spnMsg").html("请输入内容");
               // return false;
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
	 <input name="id" type="hidden" value="<{$show.id}>" />
		<div class="hyinfo"><b class="text-warning">产品预定查看</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="8%">产品标题：</th>
                <td width="92%"><{$show.title}></td>
            </tr>
			<tr>
                <th>会员账户：</th>
                <td><{$show.user_id|ly=###}></td>
            </tr>
			<tr>
                <th>姓名：</th>
                <td><{$show.contact}></td>
            </tr>
			<tr>
                <th>电话：</th>
                <td><{$show.tel}></td>
            </tr>			
			<tr>
                <th>内容：</th>
                <td><{$show.content}></td>
            </tr>			
			<tr>
                <th>审核：</th>
                <td><input name="passed" type="radio" value="0"  <if condition="$show.passed eq 0">checked="checked"</if>/>未审核<input name="passed" type="radio" value="1" <if condition="$show.passed eq 1">checked="checked"</if>/>已审核</td>
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