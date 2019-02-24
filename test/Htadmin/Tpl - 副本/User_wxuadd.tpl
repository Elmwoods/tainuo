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
		<div class="hyinfo"><b class="text-warning">微信会员信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>Openid帐号：</th>
                <td><{$show.username}></td>
            </tr>
			<tr>
                <th>剩余服务项目：</th>
                <td><volist name="fwxm" id="vol">
				<{$vol.fwxmt}>:<{$vol.sl}>次<br>
				</volist></td>
            </tr>
			<tr>
                <th>卡号：</th>
                <td><input name="hykh" type="text" id="hykh" class="cd150"  value="<{$show.hykh|default='无'}>"/></td>
            </tr>
			 <tr style="display:none;">
                <th>绑定帐户：</th>
                <td><if condition="$show.glid gt 0">
				<{$show.glid|ly=###}><a onclick="return ConfirmDel();" href="<{:C('web_url')}>__APP__/user_qxbd?user_id=<{$show.id}>">&nbsp;&nbsp;取消绑定</a>
				<else/>
				<input name="glname" type="text" id="glname" class="cd200"  value=""/>输入需要绑定的PC账户名 
				</if>
				</td>
            </tr>			 			 
			<tr  style="display:none;">
					<th>会员上级：</th>
					<td><if condition="$show.prv_id gt 0">
					会员名称:<{$shows.nickname}>    账户：<{$shows.username}><input type="button" onclick="deltjuser()" value="解除全部关系" >
					<else/>
					<input id="prvid" type="text" size="40" name="prvid" class="cd200">输入上级会员的帐户名或者OPENID
</if>
</td>
				</tr>	
				
				 <tr  style="display:none;">
                <th>会员等级：</th>
                <td><if condition="$show.glid gt 0">
					<{$show['vip']|vip=###}>
				<else/>
				<select id="vip" name="vip" class="cdselect">
                    <option <if condition="$show['vip'] eq 0">selected="selected"</if> value="0">铁牌会员</option>
					<option <if condition="$show['vip'] eq 6">selected="selected"</if> value="6">黄金代理商</option>
					<option <if condition="$show['vip'] eq 7">selected="selected"</if> value="7">白金代理商</option>
					<option <if condition="$show['vip'] eq 8">selected="selected"</if> value="8">钻石代理商</option>
					</select>
				</if></td>
            </tr>	
			<tr>
					<th>头像：</th>
					<td><img height="100" src="<{$show.headimgurl}>" onerror="javascript:this.src='<{:C('web_url')}>__WJ__/images/n.jpg';"></td>
				</tr>	
				<tr>
					<th>呢称：</th>
					<td><input name="nickname" type="text" id="nickname" class="cd150"  value="<{$show.nickname}>"/></td>
				</tr>	
				<tr>
					<th>姓名：</th>
					<td><input name="contact" type="text" id="contact" class="cd150"  value="<{$show.contact}>"/></td>
				</tr>	
				<tr>
					<th>性别：</th>
					<td><input name="sex" type="radio" value="0" <if condition="($show.sex  eq '0')">checked="checked"</if> />男<input name="sex" type="radio" value="1" <if condition="($show.sex  eq '1')">checked="checked"</if>/>女</td>
				</tr>				
			     
				 <tr>
					<th>手机：</th>
					<td><input name="moble" type="text" id="moble" class="cd150"  value="<{$show.moble}>"/></td>
				</tr>
				<tr>
					<th>邮箱：</th>
					<td><input name="email" type="text" id="email" class="cd150"  value="<{$show.email}>"/></td>
				</tr>
				<tr>
					<th>地址：</th>
					<td><input name="wxaddress" type="text" id="wxaddress" class="cd150"  value="<{$show.wxaddress}>"/></td>
				</tr>
					
		  <tr style="display:none;">
				  <th>积分：</th>
				  <td><if condition="$show.glid gt 0">
				  <{$showp.pointend}>
				  <else/>
				  <input name="pointend" type="text" id="pointend" class="cd150"  value="<{$show.pointend}>"/>
				  </if></td>
		  </tr>
		   <tr>
				  <th>帐户金额：</th>
				  <td><if condition="$show.glid gt 0">
				  <{$showp.discount}>
				  <else/><{$show.discount}>&nbsp;&nbsp;<a href="<{:C('web_url')}>__APP__/user_recharge?userid=<{$show.id}>">人工充值通道</a></if></td>
		  </tr>			
				<tr>
					<th>个人说明：</th>
					<td><textarea name="text" class="cdtext" id="text"><{$show.text}></textarea></td>
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
					<th>关注时间：</th>
					<td><{$show.gztime}></td>
				</tr>			
			<tr>
                <th>审核状态：</th>
                <td><input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked=""</if> >
是
<input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked=""</if>>
否 </td>
            </tr>	
			<tr>
                <th>关注：</th>
                <td><if condition="($show[subscribe] eq 1)">是<else/>否</if></td>
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