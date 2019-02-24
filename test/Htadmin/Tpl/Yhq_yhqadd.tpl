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
	 <input name="id_not" type="hidden" value="<{$show.id}>" />
		<div class="hyinfo"><b class="text-warning">优惠券</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="20%">标题：</th>
                <td width="80%"><input name="title" id="title" class="cd200" type="text"  value="<{$show.title}>"/></td>
            </tr>
			<tr>
                <th>金额：</th>
                <td><input name="jg" id="jg" class="cd100" type="text"  value="<{$show.jg}>"/>元</td>
            </tr>
			<tr>
                <th>使用条件(满)：</th>
                <td><input name="yqjg" id="yqjg" class="cd100" type="text"  value="<{$show.yqjg}>"/>提示：订单产品总金额(不包含运费，酒币)</td>
            </tr>
			<tr>
                <th>数量：</th>
                <td><input name="sl" id="sl" class="cd100" type="text"  value="<{$show.sl|default='0'}>"/>(初始添加时当类型为兑换码领取时请填写0)</td>
            </tr>
			<tr>
                <th>剩余数量：</th>
                <td><input name="sysl" id="sysl" class="cd100" type="text"  value="<{$show.sysl|default='0'}>"/>(初始添加时当类型为兑换码领取时请填写0)</td>
            </tr>
			<tr style="display:none;">
                <th>领取次数：</th>
                <td><input name="isone" id="isone" class="cd100" type="text"  value="1"/>会员领取次数</td>
            </tr>
			<tr>
                <th>有效期：</th>
                <td><input name="ts" id="ts" class="cd100" type="text"  value="<{$show.ts|default='1'}>"/>天（领取时间开始算）</td>
            </tr>
			<tr style="display:none;">
                <th>开始时间：</th>
                <td><input name="stimes" id="stimes" class="cd200" type="text"  value="<{$show['stimes']|default=$dqtime|date='Y-m-d H:i:s',###}>" readonly="" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d HH:mm:ss',maxDate:'%y-{%M+30}-{%d-1} HH:mm:ss'})"/></td>
            </tr>
			<tr style="display:none;">
                <th>结束时间：</th>
                <td><input name="etimes" id="etimes" class="cd200" type="text"  value="<{$show['etimes']|default=$dqtime|date='Y-m-d H:i:s',###}>" readonly="" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d HH:mm:ss',maxDate:'%y-{%M+30}-{%d-1} HH:mm:ss'})"/></td>
            </tr>
			<tr>
                <th>类型：</th>
                <td><input name="lx" type="radio" value="0"  <if condition="$show.lx eq 0">checked="checked"</if>/>点击领取<input name="lx" type="radio" value="1" <if condition="$show.lx eq 1">checked="checked"</if>/>兑换码领取</td>
            </tr>
			<tr>
                <th>是否启用：</th>
                <td><input name="passed" type="radio" value="0"  <if condition="$show.passed eq 0">checked="checked"</if>/>否<input name="passed" type="radio" value="1" <if condition="$show.passed eq 1">checked="checked"</if>/>是</td>
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