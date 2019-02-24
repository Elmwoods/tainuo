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
			var price = $.trim($("#price").val());
			if (price==0) {
			$("#spnMsg").html("请输入充值金额");
                return false;
            }						     
            return true;
        }      
    </script>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
	<input name="userid" type="hidden" value="<{$show.id}>" />	
		<div class="hyinfo"><b class="text-warning">会员账户充值</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>当前会员账户：</th>
                <td><{$show.username}></td>
            </tr>
			 <tr>
                <th>会员名称：</th>
                <td><{$show.nickname}></td>
            </tr>			
			 <tr>
                <th>当前钱包余额：</th>
                <td><{$show.discount}></td>
            </tr>
			<tr>
                <th>充值金额：</th>
                <td><input name="price" type="text" class="cd150" id="price"  value="0" maxlength="8" /></td>
            </tr>
			 <tr>
					<th>摘要说明：</th>
					<td><textarea name="text" class="cdtext" id="text"></textarea></td>
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