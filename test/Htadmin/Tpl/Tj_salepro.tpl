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
        <div class="icontithome">商品销售统计</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选数据 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get"> 
	<dl class="lineD">
      <dt>产品分类：</dt>
      <dd><select name="classid" style="width:auto;"  class="cdselect">
  <option value=" ">全部分类</option>
  <volist name="cone" id="vol">
  <option <if condition="($vol[classid] eq $classid)">selected="selected"</if> style="background-color:#F6F6F6;color:#000;" value="<{$vol.classid}>"><{$vol.class_name_cn}></option>
  <volist name="vol[0]" id="vol1">
<option <if condition="($vol1[classid] eq $classid)">selected="selected"</if> style="background-color:#F6F6F6;color:#000;" value="<{$vol1.classid}>">─<{$vol1.class_name_cn}></option>
<volist name="vol1[0]" id="vol2">
<option <if condition="($vol2[classid] eq $classid)">selected="selected"</if> value="<{$vol2.classid}>">-----<{$vol2.class_name_cn}></option>
</volist>
</volist>
</volist>
</select> <span>不填则不限制</span></dd>
    </dl>
	      
	<dl class="lineD">
      <dt>付款起止日期：</dt>
      <dd><input type="text" value="<{$ks}>" id="ks" style="width:190px" name="ks" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选开始时间则查询从开始时间往后所有</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>付款结束日期：</dt>
      <dd><input type="text" value="<{$js}>" id="js" style="width:190px" name="js" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选结束时间则查询从结束时间往前所有</span></dd>
    </dl>
    <div class="page_btm">
      <input type="submit" value="确定" class="btn btn-warning">
    </div>	
	</form>
  </div>
  </div>
  <div class="clear"></div>
<div class="search" style="background-color:#ececec; height:50px; padding-top:10px;">&nbsp;
  <input type="button" value="搜索/筛选数据" onclick="dosearch();" class="btn btn-primary  search_action"/><!--<input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary" onclick="location.href='<{:C('web_url')}>__APP__/tj_saleproexport';"/>-->
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="210">产品名称</th>	
					<th width="40">商品单价</th>					
					<th width="40">累计销量</th>
					<th width="50"><a href="<{:C('web_url')}>__APP__/tj_salepro?classid=<{$classid}>&ks=<{$ks}>&js=<{$js}>&sort=<{$ext}>">累计销售额<{$sort_str}></a></th>
					<th width="120">所占比例</th>	
					<th width="100">操作</th>									
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><{$vo.title}></td>	
						<td><{$vo.price}></td>				
						<td><{$vo['num']|default='0'}>
</td>
						<td><{$vo['pro_max_money']|default='0'}></td>
						<td><php>echo sprintf("%.2f",($vo['pro_max_money']/$max_money*100));</php>%</td>
						<td><a href="<{:C('web_url')}>__APP__/tj_salepros?id=<{$vo.id}>">查看详细</a></td>
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