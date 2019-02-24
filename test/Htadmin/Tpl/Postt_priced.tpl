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
<script>
function xzaddress() { 
                var postt=$("#postt").val(); 
				if (postt == "") {
				$("#spnMsg").html("请选择运输方式");
                 return false;
				}
				else{
				$("#spnMsg").html();
				}
                var id=$("#id_not").val(); 
				var aeraid=$("#aeraid").val();          
                MsgBox.OpenWin({ id: 'MenuEdit22', title: '选择地区', width: 500, height: 300, url: urlS+'postt_xz.html?id='+id+'&aeraid='+aeraid+'&postt='+postt});
           
        }
		</script>
		
<script type="text/javascript">
        function Enter() {
            $("#spnMsg").text('');
            var tit = $.trim($("#aeraname").val());
			if (tit == "") {
			$("#spnMsg").html("请选择地区");
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
	<input name="id_not" id="id_not" type="hidden" value="<{$show.id|default='0'}>" />	
		<div class="hyinfo"><b class="text-warning">地区运费</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">快递方式：</th>
                <td width="89%"><select name="postt" style="width:auto;" id="postt" class="cdselect">
  <option value="">选择快递方式</option>
 <volist name="farr" id="vol">
	  <option value="<{$vol.id}>" <if condition="($show['postt'] eq $vol[id])">selected="selected"</if>><{$vol.title}></option>
	  </volist>
</select></td>
            </tr>
			<tr>
                <th>地区名称：</th>
              <td><textarea name="aeraname" class="cdtext" id="aeraname" readonly="readonly"><{$show.aeraname}></textarea></td>
            </tr>
			<tr>
                <th>选择地区：</th>
                <td><input type="button" id="Submit" value="选择地区" name="Submit" onclick="javascript:xzaddress();"><textarea id="aeraid" style="display:none;" rows="5" cols="100" name="aeraid"><{$show.aeraid}></textarea></td>
            </tr>
			<tr>
                <th>起重价格：</th>
                <td><input name="sprice" id="sprice" type="text" class="cd50" value="<{$show.sprice|default='0'}>" />
                元</td>
            </tr>
			<tr>
                <th>续重价格：</th>
                <td><input name="xprice" id="xprice" type="text" class="cd50" value="<{$show.xprice|default='0'}>" />元</td>
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