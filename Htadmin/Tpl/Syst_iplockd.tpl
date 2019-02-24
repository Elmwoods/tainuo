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
            $("#spnMsg").text('');stoptime
            var tit = $.trim($("#ip").val());
			var stoptime = $.trim($("#stoptime").val());
			if (tit == "") {
			$("#spnMsg").html("请输入IP");
                return false;
            }
			if (stoptime == "") {
			$("#spnMsg").html("请输入锁定时间");
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
		<div class="hyinfo"><b class="text-warning">IP锁定管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">锁定IP：</th>
                <td width="89%"><input name="ip" id="ip" type="text" class="cd300" value="<{$show.ip}>" /></td>
            </tr>
			 <tr>
                <th width="11%">解锁时间：</th>
                <td width="89%"><input name="stoptime" id="stoptime" type="text" class="cd300" value="<if condition='($show[stoptime] neq "")'><{$show[stoptime]|date='Y-m-d H:i:s',###}></if>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-{%d+0} HH:mm:ss',maxDate:'%y-{%M+3}-{%d-1} HH:mm:ss'})" readonly/></td>
            </tr>			
			<tr>
                <th>锁定类型：</th>
                <td><select class="cdselect" name="type" style="width:auto; width:100px;">
				         <option value="1" <if condition="($show[type] eq '1')">selected</if>>禁止访问</option>
			             <option value="2" <if condition="($show[type] eq '2')">selected</if>>禁止注册</option>
                    </select></td>
            </tr>
		 
			
			
			<tr>
                <th>状态：</th>
                <td>
                  <input type="radio" name="statu" value="0" <if condition="($show[statu] eq 0)">checked</if>/>
                  关闭
                  <input type="radio" name="statu" value="1" <if condition="($show[statu] eq 1)">checked</if>/>
                  开启
                </td>
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