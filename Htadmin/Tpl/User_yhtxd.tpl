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
	 <input name="id" type="hidden" value="<{$show.id}>" />
		<div class="hyinfo"><b class="text-warning">查看提现</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>提现单号：</th>
                <td><{$show.ddbh}></td>
            </tr>
			 <tr>
                <th width="8%">卡号：</th>
                <td width="92%"><{$show.yhname}>-<{$show.kh}></td>
            </tr>
			<tr>
                <th>姓名：</th>
                <td><{$show.name}></td>
            </tr>
			<tr>
                <th>提现金额：</th>
                <td><{$show.price}></td>
            </tr>
			<tr>
                <th>会员：</th>
                <td><{$show.user_id|ly=###}></td>
            </tr>
			<tr>
                <th>提交时间：</th>
                <td><{$show.time|date="Y-m-d H:i:s",###}></td>
            </tr>
			<tr>
                <th>审核：</th>
                <td><select name="passed" class="cdselect">
	 
	  <if condition="$Think.cookie.ac eq 'a'">
	  <option value="">处理状态</option>
		  <option value="0" <if condition="($show['passed'] eq '0')">selected="selected"</if>>待审核</option>
		  <option value="1" <if condition="($show['passed'] eq '1')">selected="selected"</if>>审核未通过</option>
		  <option value="2" <if condition="($show['passed'] eq '2')">selected="selected"</if>>审核通过</option>
	 </if>
	 <if condition="$Think.cookie.ac eq 'b'">
	      <option value="2" <if condition="($show['passed'] eq '2')">selected="selected"</if>>审核通过</option>
		  <option value="3" <if condition="($show['passed'] eq '3')">selected="selected"</if>>已到账</option>
	 </if>
	</select></td>
            </tr>
			<if condition="$Think.cookie.ac eq 'b'">
			<tr>
                <th>付款单号：</th>
                <td><input name="fkdh" type="text" id="fkdh" class="cd150"  value="<{$show.fkdh}>"/></td>
            </tr>
			</if>
			<tr>
                <th>备注：</th>
                <td><textarea name="text"  class="cdtext"><{$show['text']}></textarea></td>
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