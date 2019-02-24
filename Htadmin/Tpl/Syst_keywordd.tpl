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
			var tit = $.trim($("#keyword").val());
			if (tit == "") {
			$("#spnMsg").html("请输入内容");
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
		<div class="hyinfo"><b class="text-warning">过滤词管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <if condition="($show[id] eq '')">
			 <tr>
                <th width="11%">词语过滤：</th>
                <td width="89%"><textarea name="keyword" cols="50" rows="5" class="cdtext" id="keyword"></textarea><br />
每行一组过滤词语，不良词语和替换词语之间使用“=”进行分割；<br />
如果只是想将某个词语直接替换成 **，则只输入词语即可；<br />
例如：<br />
toobad<br />
nobad<br />
badword=good </td>
            </tr>
			<else/>
			<tr>
                <th width="11%">词组：</th>
                <td width="89%"><input name="keyword" id="keyword" type="text" class="cd300" value="<{$show[keyword]}>" /></td>
            </tr>
			<tr>
                <th width="11%">替换：</th>
                <td width="89%"><input name="replace" id="replace" type="text" class="cd300" value="<{$show[replace]|default='*'}>" /></td>
            </tr>		
			</if>
			 		
			
		 
			
			
			<tr>
                <th>阻止发布：</th>
                <td>
                  <input type="radio" name="statu" value="0" <if condition="($show[statu] eq 0)">checked</if>/>
                  否
                  <input type="radio" name="statu" value="1" <if condition="($show[statu] eq 1)">checked</if>/>
                  是(是否包含以上关键词阻止发布)
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