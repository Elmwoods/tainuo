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
            var tit = $.trim($("#title").val());
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
		<div class="hyinfo"><b class="text-warning">运输方式</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">运输方式名称：</th>
                <td width="89%"><input name="title" id="title" type="text" class="cd300" value="<{$show.title}>" /></td>
            </tr>
			<tr>
                <th>起重：</th>
                <td><input name="ssl" id="ssl" type="text" class="cd50" value="<{$show.ssl|default='0'}>" />
                kg</td>
            </tr>
			<tr>
                <th>起重价格：</th>
                <td><input name="sprice" id="sprice" type="text" class="cd50" value="<{$show.sprice|default='0'}>" />
                元</td>
            </tr>
			<tr>
                <th>续重：</th>
                <td><input name="xsl" id="xsl" type="text" class="cd50" value="<{$show.xsl|default='0'}>" />kg(不能为0)</td>
            </tr>
			<tr>
                <th>续重价格：</th>
                <td><input name="xprice" id="xprice" type="text" class="cd50" value="<{$show.xprice|default='0'}>" />元</td>
            </tr>				
			<tr>
                <th>序号：</th>
                <td><input name="sort" id="sort" type="text" class="cd50" value="<{$show.sort|default='0'}>" /></td>
            </tr>
			<tr style="display:none;">
                <th>是否生成取货码：</th>
                <td>
                  <input type="radio" name="fs" value="0" <if condition="($show[fs] eq 0)">checked</if>/>
                  否
                  <input type="radio" name="fs" value="1" <if condition="($show[fs] eq 1)">checked</if>/>
                 是
                </td>
			</tr>
			<tr>
                <th>状态：</th>
                <td>
                  <input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked</if>/>
                  关闭
                  <input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked</if>/>
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