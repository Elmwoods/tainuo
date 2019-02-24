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
            var tit = $.trim($("#names").val());
			if (tit == "") {
			$("#spnMsg").html("请输入名称");
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
		<div class="hyinfo"><b class="text-warning">收货地址</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">姓名：</th>
                <td width="89%"><input name="names" id="names" type="text" class="cd100" value="<{$show.names}>" /></td>
            </tr>
			<tr>
                <th>电话：</th>
                <td><input name="phone" id="phone" type="text" class="cd100" value="<{$show.phone}>" /></td>
            </tr>
			<tr>
                <th>选择省份：</th>
                <td><select class="cdselect" id="sf" name="sf">
                      <option value="">请选择省份</option>
                     <volist name="sf" id="vol">
				     <option value="<{$vol.id}>" <if condition="$sfs eq $vol[id]">selected="selected"</if>><{$vol.region_name}></option>
				    </volist>
                    </select></td>
            </tr>
			<tr>
                <th>选择城市：</th>
                <td><select class="cdselect" id="cs" name="cs">
                      <option value="">请选择城市</option>
                      <volist name="cslist" id="vol">
				      <option value="<{$vol.id}>" <if condition="$css eq $vol[id]">selected="selected"</if>><{$vol.region_name}></option>
				    </volist>
                    </select></td>
            </tr>
			<tr>
                <th>选择区县：</th>
                <td><select class="cdselect" id="xc" name="xc">
                      <option value="">请选择区县</option>
                      <volist name="xclist" id="vol">
				<option value="<{$vol.id}>" <if condition="$xcs eq $vol[id]">selected="selected"</if>><{$vol.region_name}></option>
				    </volist>
                    </select></td>
            </tr>				
			<tr>
                <th>收货地址：</th>
                <td><input name="address" id="address" type="text" class="cd200" value="<{$show.address}>" /></td>
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