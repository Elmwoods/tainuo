<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理系统</title>
<meta content="管理系统" name="keywords" />
<meta content="管理系统" name="description" />
<script>
var urlS="<?php echo C('web_url');?>__APP__/";
var piclj="<?php echo C('htpiclj');?>";
var piclj1="<?php echo C('htpiclj1');?>";
</script>
<link href="<?php echo C('web_url');?>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<?php echo C('web_url');?>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/jquery-1.9.1.min.js"></script>
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
	
	<div class="hyinfo"><strong><?php echo ($user["username"]); ?></strong>：<b class="text-warning">管理级别-<?php if(($user["adminjb"] == 0)): echo ($dj); else: ?>高级管理员<?php endif; ?></b></div>

	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table class="table noborder">
							    <tr>
                                       
                                        <td>个人姓名：<?php echo ($user["realname"]); ?></td>
                                        <td>部门：<?php echo ($user["depart"]); ?></td>
                                        <td>上次登录IP：<?php echo ($user["lastLoginIip"]); ?></td>
                                        <td>目前IP：<?php echo ($_SERVER['REMOTE_ADDR']); ?></td>
      </tr>
	     <tr>
                                        <td>手机号码: <?php echo ($user["mobile"]); ?> </td>
                                        <td>Q Q号码 : <?php echo ($user["qq"]); ?> </td>
                                        <td>邮箱地址：<?php echo ($user["email"]); ?></td>
                                        <td>登录次数: <?php echo ($user["LoginTimes"]); ?> </td>
                                    </tr>

                                     <tr>
                                        
                                        <td>上次登录时间 : <?php echo ($user["LastLoginTime"]); ?> </td>
                                        <td>上次退出时间：<?php echo ($user["LastLogoutTime"]); ?></td>
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
                                       
                                        <td width="25%">今日订单数：<span class="red">(<?php echo ($web["order"]); ?>)</span></td>
										<td width="25%">今日销售总额：<span class="red">(<?php echo (formatmoney($web["order1"])); ?>)</span></td>
										<td width="25%">今日注册会员: <span class="red">(<?php echo ($web["hycount"]); ?>)</span></td>
										<td width="25%">今日返利酒币结算: <span class="red">(<?php echo (($web["jb"])?($web["jb"]):'0'); ?>)</span></td>                                        
      </tr>
	  <tr>
	                                    <td width="25%">订单总数: <span class="red">(<?php echo ($web["order2"]); ?>)</span></td>
	                                    <td width="25%">待付款订单数: <span class="red">(<?php echo ($web["norder"]); ?>)</span></td>
                                        <td width="25%">已付款待发货订单：<span class="red">(<?php echo ($web["yorder"]); ?>)</span></td>
                                        <td width="25%">待确认订单数：<span class="red">(<?php echo ($web["zorder"]); ?>)</span></td>
										</tr>
										 <tr>
                                       
                                        <td>订单销售总金额：<span class="red">(<?php echo (($web["salep"])?($web["salep"]):'0'); ?>)</span></td>
                                        <td>商品总数量: <span class="red">(<?php echo ($web["pro"]); ?>)</span></td>
										<td>已上架产品: <span class="red">(<?php echo ($web["pro1"]); ?>)</span></td>
										<td>已下架产品：<span class="red">(<?php echo ($web["pro2"]); ?>)</span></td>
										
                                        
                                     </tr>
	     <tr>
                                       
                                        
                                        
										<td>总返利酒币: <span class="red">(<?php echo (($web["zjb"])?($web["zjb"]):'0'); ?>)</span></td>
										<td>总购买获得酒币：<span class="red">(<?php echo (($web["zjb1"])?($web["zjb1"]):'0'); ?>)</span></td>
										<td>总消费酒币：<span class="red">(<?php echo (($web["zjb2"])?($web["zjb2"]):'0'); ?>)</span></td>
                                        <td>待处理提现 : <span class="red">(<?php echo ($web["ntx"]); ?>)</span></td>
                                     </tr>									
									

                                    
      </table>
	</div>-->
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">系统信息</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table  fromtj" style="border:none; width:100%;">
							    <tr>
                                       
                                        <td width="25%">现在时间：<?php echo (date('Y-m-d g:i a',time())); ?></td>
                                        <td width="25%">PHP安装路径: <?php echo (DEFAULT_INCLUDE_PATH); ?></td>
                                        <td width="25%">服务器运行方式：<?php echo ($web["yx"]); ?></td>
                                        <td width="25%">PHP版本：<?php echo (PHP_VERSION); ?></td>
      </tr>
	     <tr>
                                        <td>Zend版本: <?php echo ($web["bb"]); ?>  </td>
                                        <td>服务器系统目录: <?php echo ($web["mu"]); ?> </td>
                                        <td>服务器Web端口: <?php echo ($web["port"]); ?></td>
                                        <td>服务器域名: <?php echo ($web["host"]); ?> </td>
                                    </tr>
									 <tr>
                                        <td>服务器系统类型及版本号：<?php echo ($web["bbh"]); ?> </td>
                                        <td>当前文件绝对路径：<?php echo ($web["file"]); ?></td>
                                        <td>服务器语言：<?php echo ($web["lang"]); ?></td>
                                        <td>服务器解译引擎: <?php echo ($web["yq"]); ?> </td>
                                    </tr>

                                    
      </table>
	</div>
	</div>
	<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/remind.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/bootstrap.min.js"></script>
<style type="text/css">
    .vshop
    {
        overflow: hidden;
    }
    .sname
    {
        float: left;
    }
    .bindwx, .vok
    {
        float: left;
    }
</style>
	<script type="text/javascript">
    var ejecttime = "s_ejecttime";
</script>
<div id="asyncbox_cover" unselectable="on" style="opacity: 0.1; filter: alpha(opacity=10);
    background: #000">
</div>
<div id="asyncbox_clone">
</div>
<div id="asyncbox_focus">
</div>
<div id="asyncbox_load">
    <div>
        <span></span>
    </div>
</div>
<div class="pop_up" id="message">
    <div class="pop_up_top">
        <span>温馨提示</span><a href="javascript://" id="message_close"></a></div>
    <div class="pop_up_middle">
        <ul>
            <li>
                <div class="m" style="float: left;">
				  <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>产品订单:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未付款(<span class="messageTxt"
                        id="span_Message"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已付款(<span class="messageTxt"
                        id="span_BackOrder"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;">已发货(<span class="messageTxt"
                        id="point"><b>0</b></span>)</font>						
						</div>
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				 <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>返利结算:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未结算订单数(<span class="messageTxt"
                        id="zxsj1"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已结算订单数(<span class="messageTxt"
                        id="zxsj2"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj3"><b></b></span></font>						
                    </div>					
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				
                    <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>其他信息:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">提现申请(<span class="messageTxt"
                        id="span_AdvisoryReply"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj4"><b></b></span></font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="nr"><b></b></span></font>						
						</div>
						
                </div>
            </li>
            <li>
                <div class="m">
                    <dl>
                        <dt>设置提示时间：</dt>
                        <dd id="select_dd" style="float:left; margin-top:-5px;">
                            <div class="drop_down" id="drop_down_down1">
                                默认（10分钟）
                            </div>
                            <div class="select_div select_div1" id="select_div1">
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="0">
                                    <a href="#">不再提醒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="3600000">
                                    <a href="#">60分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="2700000">
                                    <a href="#">45分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1800000">
                                    <a href="#">30分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1200000">
                                    <a href="#">20分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="600000">
                                    <a href="#">10分钟（默认）</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="300000">
                                    <a href="#">5分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="120000">
                                    <a href="#">2分钟</a></p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="60000">
                                    <a href="#">1分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="30000">
                                    <a href="#">30秒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="10000">
                                    <a href="#">10秒</a>
                                </p>
                                <div class="clear">
                                </div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
    <div class="pop_up_bottom">
    </div>
</div>
</body>
</html>