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
            var tit = $.trim($("#name").val());
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
		<div class="hyinfo"><b class="text-warning">计划任务管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">名称：</th>
                <td width="89%"><input name="name" id="name" type="text" class="cd300" value="<{$show.name}>" /></td>
            </tr>
			 <tr>
                <th width="11%">脚本：</th>
                <td width="89%"><input name="script" id="script" type="text" class="cd300" value="<{$show.script}>" />请将脚本放置于对应位置</td>
            </tr>			
			<tr>
                <th>每周：</th>
                <td><select class="cdselect" name="week" style="width:auto; width:100px;">
				<option value="-1" <if condition="($show[week] eq '-1')">"selected"</if>>不作限制</option>
			                  <option value="Sunday" <if condition="($show[week] eq 'Sunday')">"selected"</if>>每周日</option>
                                  <option value="Monday" <if condition="($show[week] eq 'Monday')">"selected"</if>>每周一</option>
                                  <option value="Tuesday" <if condition="($show[week] eq 'Tuesday')">"selected"</if>>每周二</option>
                                  <option value="Wednesday" <if condition="($show[week] eq 'Wednesday')">"selected"</if>>每周三</option>
                                  <option value="Thursday" <if condition="($show[week] eq 'Thursday')">"selected"</if>>每周四</option>
                                  <option value="Friday" <if condition="($show[week] eq 'Friday')">"selected"</if>>每周五</option>
                                  <option value="Saturday" <if condition="($show[week] eq 'Saturday')">"selected"</if>>每周六</option>
                                </select>设置周几执行，此设置将覆盖下面的“日”选项。</td>
            </tr>
			<tr>
                <th>每月：</th>
                <td><select name="day" class="cdselect" style="width:auto; width:100px;">

				<option value="-1">每天</option>

			<php>

				for($i=1;$i<=31;$i++)

				{

					$day = str_pad($i, 2, "0", STR_PAD_LEFT);

				</php>

                  <option value="<{$day}>" <if condition="($show[day] eq $day)">"selected"</if>><{$day}></day>

                <php>}</php>

                </select>设置任务哪天执行，默认为每天。</td>
            </tr>
			 
			<tr>
                <th>小时：</th>
                <td><select name="hours"  class="cdselect" style="width:auto; width:100px;">

			<php>

				for($i=0;$i<=23;$i++)

				{

					$hours = str_pad($i, 2, "0", STR_PAD_LEFT);

				</php>

                  <option value="<{$hours}>" <if condition="($show[hours] eq $hours)">"selected"</if>><{$hours}></day>

               <php>}</php>


                </select></td>
            </tr>
			<tr>
                <th>分钟：</th>
                <td><select name="minutes"  class="cdselect" style="width:auto; width:100px;">

			<php>for($i=0;$i<=59;$i++)
				{
				 $minutes = str_pad($i, 2, "0", STR_PAD_LEFT);

				</php>

                  <option value="<{$minutes}>" <if condition="($show[minutes] eq $minutes)">"selected"</if>><{$minutes}></day>

               <php>}</php>

                </select></td>
            </tr>
			<tr>
                <th>是否启用：</th>
                <td>
                  <input type="radio" name="active" value="0" <if condition="($show[active] eq 0)">checked</if>/>
                  关闭
                  <input type="radio" name="active" value="1" <if condition="($show[active] eq 1)">checked</if>/>
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