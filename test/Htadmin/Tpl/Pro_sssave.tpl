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
			var password = $.trim($("#password").val());
			var password1 = $.trim($("#password1").val()); 
			if (password!="") {
			if (password1=="") {
			$("#spnMsg").html("请输入确认新密码");
                return false;
            }
			if (password1!=password) {
			$("#spnMsg").html("确认新密码错误");
                return false;
            }
            }			     
            return true;
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
		<div class="hyinfo"><b class="text-warning">酒店信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>服务员：</th>
                <td><{$show.waiter.username}>-<{$show.waiter.moble}></td>
            </tr>
            <tr>
                <th>时薪：</th>
                <td><input name="wage" type="text" id="username" class="cd150"  value="<{$show.wage}>" placeholder="时薪"/></td>
            </tr>
            
            <tr>
                <th>午休时长：</th>
                <td>
                  <select class="cdselect" name="break">
                            <option value="0" <if condition="$show['break'] == 0">selected</if> >0小时</option>
                            <option value="30" <if condition="$show['break'] == 30">selected</if> >0.5小时</option>
                            <option value="60" <if condition="$show['break'] == 60">selected</if> >1小时</option>
                            <option value="90" <if condition="$show['break'] == 90">selected</if> >1.5小时</option>
                        </select>
                </td>
            </tr>
            <tr>
                <th>工作日期：</th>
                <td><input type="text" name="worktime" id="worktime"  value="<{$show.worktime}>" class="cd150" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly></td>
            </tr>
            <tr>
                <th>上班时间：</th>
                <td><input type="text" name="ontime" id="offtime"  value="<{:date('H:i:s',strtotime($show['ontime']))}>" class="cd150" onClick="WdatePicker({doubleCalendar:true,dateFmt:'HH:mm:ss'})" readonly></td>
            </tr>
            <tr>
                <th>下班时间：</th>
                <td><input type="text" name="offtime" id="offtime"  value="<{:date('H:i:s',strtotime($show['offtime']))}>" class="cd150" onClick="WdatePicker({doubleCalendar:true,dateFmt:'HH:mm:ss'})" readonly></td>
            </tr>
            <tr>
                <th>工服归还：</th>
                <td>
                    <select class="cdselect" name="clothes">
                        <option <if condition="$show['clothes'] == 1">selected</if> value="1" >是</option>
                        <option <if condition="$show['clothes'] == 0">selected</if> value="0" >否</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>现场支付：</th>
                <td><select class="cdselect" name="pay">
                        <option value="1" <if condition="$show['pay'] == 1">selected</if>>是</option>
                            <option value="0" <if condition="$show['pay'] == 0">selected</if>>否</option>
                        </select></td>
            </tr>
            <tr>
                <th>现场支付金额：</th>
                <td><input name="paymoney" type="text" id="paymoney" class="cd150"  value="<{$show.paymoney}>" placeholder="现场支付金额"/></td>
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