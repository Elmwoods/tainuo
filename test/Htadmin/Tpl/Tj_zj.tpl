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
        <div class="icontithome">资金记录详细</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选数据 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get">
        <dl class="lineD">
           <dt>会员账号：</dt>
           <dd><input type="text" value="<{$uname}>" id="uname" style="width:190px" name="uname"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
           <dt>订单号：</dt>
           <dd><input type="text" value="<{$order}>" id="order" style="width:190px" name="order"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
      <dt>影响金额：</dt>
      <dd><select class="c_select" style="width:80px" id="bj" name="bj">
	  <option value="">--请选择--</option>
	  <option value="gt" <if condition="($bj eq 'gt')">selected="selected"</if>>大于</option>
	  <option value="eq" <if condition="($bj eq 'eq')">selected="selected"</if>>等于</option>
	  <option value="lt" <if condition="($bj eq 'lt')">selected="selected"</if>>小于</option>
	  </select>
      <input type="text" value="<{$money}>" class="input" style="width:100px" id="money" name="money">
        <span>不填则不限制</span>
      </dd>
    </dl>
	<dl class="lineD">
      <dt>交易时间(开始)：</dt>
      <dd><input type="text" value="<{$ks}>" id="ks" style="width:190px" name="ks" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选开始时间则查询从开始时间往后所有</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>交易时间(结束)：</dt>
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
  <input type="button" value="搜索/筛选数据" onclick="dosearch();" class="btn btn-primary  search_action"/><input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary" onclick="location.href='<{:C('web_url')}>__APP__/tj_zjexport';"/>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="40">会员id</th>					
					<th width="210">会员账号</th>
					<th width="50">姓名</th>
					<th width="150">影响金额</th>
					<th width="60">订单号</th>
					<th width="240">交易时间</th>
					<th width="60">状态</th>
                    <th width="50">说明</th>									
					<th width="182">处理备注</th>					
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><{$vo.user_id}></td>					
						<td><{$vo['user_id']|hygroup="user","id",###,"id","username"}>
</td>
						<td><{$vo['user_id']|hygroup="user","id",###,"id","contact"}></td>
						<td><{$vo.price}></td>
						<td><{$vo.ordern}></td>						
						<td><{$vo.addtime}><br />
<{$vo.zftime}></td>
						<td>完成</td>						
						<td><{$vo.sz}></td>
						<td><{$vo.text}></td>

						
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