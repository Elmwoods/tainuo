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
	<input name="group_id" type="hidden" value="<{$classid}>" />		
		<div class="hyinfo"><b class="text-warning">广告管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">信息标题：</th>
                <td width="89%"><input name="name" id="name" type="text" class="cd300" value="<{$show.name}>" /></td>
            </tr>
			
			<tr>
                <th>广告位：</th>
                <td>
				<volist name="lm" id ="vol">
				<input type="radio" name="lx" value="<{$vol[0]}>" <if condition="($show[lx] eq $vol[0] || $show[lx] eq '')">checked=""</if> >
<{$vol[1]}>(<{$vol[2]}>)
</volist>
</td>
            </tr>
			<tr style="display:none;">
                <th>类型：</th>
                <td>
                  <input type="radio" name="type" value="0" <if condition="($show[type] eq 0)">checked</if>/>
                  图片
                  <input type="radio" name="type" value="1" <if condition="($show[type] eq 1)">checked</if>/>
                  Js代码
                </td>
			</tr>
			<tr id="xspic" <if condition="($show[type] eq 1)">style="display:none;"</if>>
                <th>图片：</th>
                <td><img id="thumbshow_1" width="300"  src="<{$show[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=300&w=160';"><input name="spic" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<{$show.spic}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.spic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=banner&filed=spic">删除文件</a></if>
                </td>
            </tr>			
			<tr  id="xsjs" <if condition="($show[type] eq 0)">style="display:none;"</if>>
                <th>Js代码：</th>
                <td><textarea name="con" rows="10" class="cd" id="content_1" style="width:500px; height:100px;"><{$show.con}></textarea></td>
            </tr>
			
			<tr>
                <th>连接地址：</th>
                <td><input name="url" id="url" type="text" class="cd300" value="<{$show.url}>" /></td>
            </tr>			
			<tr>
                <th>序号：</th>
                <td><input name="sort_int" id="sort" type="text" class="cd50" value="<{$show.sort|default='0'}>" /></td>
            </tr>
			<tr>
                <th>状态：</th>
                <td>
                  <input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked</if>/>
                  停止
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