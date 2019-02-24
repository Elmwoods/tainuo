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
            let level_name = $('#username').val(),
                price = $('#moble').val();
            if(level_name == '' || price == ''){
                alert('等级名称和时薪必填!');
                return false;
            }
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
		<div class="hyinfo"><b class="text-warning">服务员等级信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>等级名称：</th>
                <td><input name="level_name" type="text" id="username" class="cd150"  value="<{$show.level_name}>" placeholder="等级名称"/></td>
            </tr>
            <tr>
                <th>时薪: </th>
                <td><input name="price" type="number" id="moble" class="cd150"  value="<{$show.price}>" placeholder="时薪"  step="0.01"/></td>
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