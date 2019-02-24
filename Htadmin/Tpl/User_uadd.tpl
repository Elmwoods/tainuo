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
		<div class="hyinfo"><b class="text-warning">领班信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>领班账号：</th>
                <td><input name="username" type="text" id="username" class="cd150"  value="<{$show.username}>" placeholder="请谨慎修改，唯一性"/></td>
            </tr>
		<tr>
                <th>手机号码：</th>
                <td><input name="moble" type="text" id="moble" class="cd150"  value="<{$show.moble}>" placeholder="手机号码"/></td>
            </tr>	
						
			 <tr>
                <th>新密码：</th>
                <td><input name="password" type="password" id="password" class="cd150"  value=""/>&nbsp;<span class="red">不修改请为空</span></td>
            </tr>
			 <tr>
                <th>确认新密码：</th>
                <td><input name="password1" type="password" id="password1" class="cd150"  value=""/></td>
            </tr>				 
			
			<tr>
					<th>名称：</th>
					<td><input name="nickname" type="text" id="nickname" class="cd150"  value="<{$show.nickname}>"/></td>
				</tr>	
						
			<tr>
                <th>头像：</th>
                <td><img id="thumbshow_1" width="150" src="<{$show.headimgurl|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"><input name="headimgurl" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<{$show.headimgurl}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.headimgurl  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=user&filed=headimgurl">删除文件</a></if>               </td>
            </tr>
		  	
				<tr>
					<th>上次登录IP：</th>
					<td><{$show.lastLoginIip}></td>
				</tr>	
				<tr>
					<th>上次登录时间：</th>
					<td><{$show.LastLoginTime}></td>
				</tr>	
				<tr>
					<th>登录次数：</th>
					<td><{$show.LoginTimes}></td>
				</tr>
				<tr>
					<th>注册时间：</th>
					<td><{$show.regtime}></td>
				</tr>
								
			<tr>
                <th>审核状态：</th>
                <td><input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked=""</if> >
是
<input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked=""</if>>
否 </td>
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