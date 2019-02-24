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
        <div class="icontithome">今日访问统计</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<br />


	
	<div class="hyinfo"><b class="text-warning">今日流量统计数据</b></div>

	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<table class="table noborder">
							    <tr>
                                       
                                        <td>IP总数：<{$ips}></td>
                                        <td>PV总数：<{$pvs}></td>
                                        <td>URL总数：<{$urls}></td>
                                        <td>新注册会员数：<{$newsusers}></td>
      </tr>
	     <tr>
                                        <td>当前上线会员数: <{$onusers}> </td>
                                        <td>目前在线游客数 : <{$users}> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">今日IP前十名</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table table-bordered" style="border:none;">
							    <tr>
                                       
                                        <th width="25%">IP</th>
                                        <th width="25%">用户</th>
                                        <th width="25%">访问次数</th>
                                        <th width="25%">操作</th>
      </tr>
	  <volist name="list1" id="vol">
	     <tr>
                                        <td><{$vol.ip}>[<{$vol[ip]|convertip=###,'Cache/Databases/tinyipdata.dat'}>] </td>
                                        <td><{$vol.username}></td>
                                        <td><{$vol.count}></td>
                                        <td><a href="<{:C('web_url')}>__APP__/syst_iplockd.html?ip=<{$vol.ip}>">禁止</a></td>
                                    </tr>

      </volist>                              
      </table>
	</div>
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">今日URL前十名</b></div>
	<div class="clear"></div>
	<div class="contentbox">
	<table class="table table-bordered"style="border:none; width:100%;">
							    <tr>
                                       
                                        <th width="50%">URL地址</th>
                                        <th width="50%">访问次数</th>
      </tr>
	  <volist name="list2" id="vol">
	     <tr>
                                        <td><{$vol[url]|urldecode=###}></td>
                                        <td><{$vol.count}></td>
                                    </tr>
	  </volist> 
      </table>
	</div>
	</div>
	<include file="Pub:foot" />
</body>
</html>