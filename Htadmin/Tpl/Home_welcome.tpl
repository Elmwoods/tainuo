<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
</head>
<body>

<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">账户信息</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<br />

    <div class="control-group">
<a href="__APP__/home_mpsw.html" class="btn">修改资料</a>
    </div>
	
	<div class="hyinfo"><strong><{$user.username}></strong>：<b class="text-warning">管理级别-<if condition="($user.adminjb eq 0)"><{$dj}><else />高级管理员
</if></b></div>

	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table class="table noborder">
							    <tr>
                                       
                                        <td>个人姓名：<{$user.realname}></td>
                                        <td>部门：<{$user.depart}></td>
                                        <td>上次登录IP：<{$user.lastLoginIip}></td>
                                        <td>目前IP：<{$Think.server.REMOTE_ADDR}></td>
      </tr>
	     <tr>
                                        <td>手机号码: <{$user.mobile}> </td>
                                        <td>Q Q号码 : <{$user.qq}> </td>
                                        <td>邮箱地址：<{$user.email}></td>
                                        <td>登录次数: <{$user.LoginTimes}> </td>
                                    </tr>

                                     <tr>
                                        
                                        <td>上次登录时间 : <{$user.LastLoginTime}> </td>
                                        <td>上次退出时间：<{$user.LastLogoutTime}></td>
                                        <td>&nbsp;</td>
										<td>&nbsp;</td>
                                    </tr>
      </table>
	</div>
    <div class="clear"></div>
	<!--<div class="hyinfo"><b class="text-warning">数据统计信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table noborder" width="100%">
							    <tr>
                                       
                                        <td width="25%">今日订单数：<span class="red">(<{$web.order}>)</span></td>
										<td width="25%">今日销售总额：<span class="red">(<{$web.order1|formatmoney=###}>)</span></td>
										<td width="25%">今日注册会员: <span class="red">(<{$web.hycount}>)</span></td>
										<td width="25%">今日返利酒币结算: <span class="red">(<{$web.jb|default='0'}>)</span></td>                                        
      </tr>
	  <tr>
	                                    <td width="25%">订单总数: <span class="red">(<{$web.order2}>)</span></td>
	                                    <td width="25%">待付款订单数: <span class="red">(<{$web.norder}>)</span></td>
                                        <td width="25%">已付款待发货订单：<span class="red">(<{$web.yorder}>)</span></td>
                                        <td width="25%">待确认订单数：<span class="red">(<{$web.zorder}>)</span></td>
										</tr>
										 <tr>
                                       
                                        <td>订单销售总金额：<span class="red">(<{$web.salep|default='0'}>)</span></td>
                                        <td>商品总数量: <span class="red">(<{$web.pro}>)</span></td>
										<td>已上架产品: <span class="red">(<{$web.pro1}>)</span></td>
										<td>已下架产品：<span class="red">(<{$web.pro2}>)</span></td>
										
                                        
                                     </tr>
	     <tr>
                                       
                                        
                                        
										<td>总返利酒币: <span class="red">(<{$web.zjb|default='0'}>)</span></td>
										<td>总购买获得酒币：<span class="red">(<{$web.zjb1|default='0'}>)</span></td>
										<td>总消费酒币：<span class="red">(<{$web.zjb2|default='0'}>)</span></td>
                                        <td>待处理提现 : <span class="red">(<{$web.ntx}>)</span></td>
                                     </tr>									
									

                                    
      </table>
	</div>-->
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">系统信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none; width:100%;">
							    <tr>
                                       
                                        <td width="25%">现在时间：<{$Think.now}></td>
                                        <td width="25%">PHP安装路径: <{$Think.const.DEFAULT_INCLUDE_PATH}></td>
                                        <td width="25%">服务器运行方式：<{$web.yx}></td>
                                        <td width="25%">PHP版本：<{$Think.const.PHP_VERSION}></td>
      </tr>
	     <tr>
                                        <td>Zend版本: <{$web.bb}>  </td>
                                        <td>服务器系统目录: <{$web.mu}> </td>
                                        <td>服务器Web端口: <{$web.port}></td>
                                        <td>服务器域名: <{$web.host}> </td>
                                    </tr>
									 <tr>
                                        <td>服务器系统类型及版本号：<{$web.bbh}> </td>
                                        <td>当前文件绝对路径：<{$web.file}></td>
                                        <td>服务器语言：<{$web.lang}></td>
                                        <td>服务器解译引擎: <{$web.yq}> </td>
                                    </tr>

                                    
      </table>
	</div>
	</div>
	<include file="Pub:foot" />
</body>
</html>