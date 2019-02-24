<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/ss.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<script>var urlS="<{:C('web_url')}>__APP__/";</script>
<include file="Pub:msg" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">产品收藏统计详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选数据 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get">
        <dl class="lineD">
           <dt>产品名称：</dt>
           <dd><input type="text" value="<{$title}>" id="title" style="width:190px" name="title"><span>不填则不限制</span></dd>
        </dl>
    <div class="page_btm">
      <input type="submit" value="确定" class="btn btn-warning">
    </div>	
	</form>
  </div>
  </div>
  <div class="clear"></div>
<div class="search" style="background-color:#ececec; height:50px; padding-top:10px;">&nbsp;
  <input type="button" value="搜索/筛选数据" onclick="dosearch();" class="btn btn-primary  search_action"/>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="40">产品id</th>					
					<th>产品名称</th>
					<th width="50">收藏次数</th>
					<th width="180">最新会员</th>
					<th width="150">最新IP地址</th>
					<th >最新添加时间</th>									
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.classid}>'></td>
						<td><{$vo.classid}></td>	
						<td><{$vo.id}></td>					
						<td><{$vo[title]}>
</td>
						<td><{$vo.sl}></td>
						<td><{$vo.user_name}></td>						
						<td><{$vo[ip]}></td>
						<td><{$vo.time}></td>
				  </tr>				  
				  </volist>
		</table>
	  </form>	     
		<div class="clear"></div>
		<div class="pagejump"><div class="number"><span>共<{$count}>条记录&nbsp;</span><{$fpage}></div></div> 
		
	</div>
	</div>
<include file="Pub:foot" />
<script>
var isSearchHidden = 1;
var searchName = "搜索/筛选数据";
function dosearch() {
	if(isSearchHidden == 1) {
		$("#search_div").slideDown("fast");
		$(".search_action").val("搜索完毕");
		isSearchHidden = 0;
	}else {
		$("#search_div").slideUp("fast");
		$(".search_action").val(searchName);
		isSearchHidden = 1;
	}
} 
</script>
</body>
</html>