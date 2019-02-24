<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '添加领班', width: 1000, height: 500, url: urlS+'pro_sssave.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '领班信息', width: 1000, height: 500, url: urlS+'pro_sssave.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">项目详情-<{$subject.title}></div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group" style="padding-top:6px;">
	<!--<button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add','');">添加项目</button>
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>-->
                <input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary btn-sm" onclick="location.href='<{:C('web_url')}>__APP__/pro_xqdc';">

    </div>
<!--<div class="search"><form id="searchform" action="" method="get"><span>标题：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
  <span>发布人：</span><span><input name="user" type="text" class="cd" value="<{$username}>"/>&nbsp;</span>
	 
  <input type="submit" value="搜索" class="btn btn-primary"/></form>
</div>-->
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>					
					<th>服务员</th>
                                        <th>工作时间</th>
                                        <th>就餐休息时间</th>
                                        <th>工时</th>
                                        <th>时薪</th>
                                        <th>酬劳</th>
                                        <th>领班返利</th>
                                        <th>归还工服</th>
                                        <th>现金支付</th>
                                        <th>现金支付金额</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td>
                                            <input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
                                                <td><{$vo.username}><br/><{$vo.moble}></td>
						<td><{$vo.ontime}> - <br/><{$vo.offtime}></td>
                                                <td><{$vo.break}>分钟</td>
                                                <td><{$vo.hours}>小时</td>
                                                <td><{$vo.wage}>元</td>
                                                <td><{$vo.reward}>元</td>
                                                <td><{$vo.rebate}>元</td>
                                                <td><if condition="$vo['clothes'] ==1">是<else/>否</if></td>
						<td><if condition="$vo['pay'] ==1">是<else/>否</if></td>
                                                <td><{$vo.paymoney}>元</td>
                                                
				  </tr>				  
				  </volist>
		</table>
	  </form>	     
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
		
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>