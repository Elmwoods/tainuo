<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
<include file="Pub:msg" />
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '处理拥金提现记录', width: 1000, height: 600, url: urlS+'user_yjtxd.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '拥金提现记录', width: 1000, height: 600, url: urlS+'user_yjtxd.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">拥金提现管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
    <div class="control-group">
	
	<a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm" onClick="return ConfirmDel();">删除选择</a>
    </div>
<div class="search"><form id="searchform" action="" method="get"><span>会员：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
<input name="user_id" type="hidden" value="<{$user_id}>" />
<span>
	<select name="passed" style="width:auto;" id="passed" class="cdselect">
	  <option value="">处理状态</option>
		  <option value="0" <if condition="($passed eq '0')">selected="selected"</if>>待审核</option>
		  <option value="1" <if condition="($passed eq '1')">selected="selected"</if>>已审核</option>
	</select>
	</span>
	<span>时间段<input name="ks" type="text" id="ks" class="cd100"  value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-50}-%M-{%d+0}',maxDate:'%y-{%M}-{%d-1}'})" readonly/>--<input name="js" type="text" id="js" class="cd100"  value="<{$js}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'{%y-50}-%M-{%d+0}',maxDate:'%y-{%M}-{%d}'})" readonly/>&nbsp;

	</span>
  <input type="submit" value="搜索" class="btn btn-primary"/>待审核总额：<{$nprice|default='0.00'}>， 已通过总额：<{$yprice|default='0.00'}>。</form>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered table-hover">
				<tr>
			      <th width="20"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="71">ID</th>					
					<th width="100">会员</th>
					<th width="158">提现金额到帐户</th>
					<th width="80">审核状态</th>
					<th width="127">提交时间</th>
					<th width="80">处理人</th>
					<th width="120">处理时间</th>
					<th width="119">操作</th>
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>						
						<td><{$vo.user_id|ly=###}></td>
						<td><{$vo.price}></td>						
						<td><if condition="$vo[passed] eq 0">未审核<else/>已通过</if></td>
						<td><{$vo.addtime}></td>
						<td><{$vo.clr}></td>
						<td><{$vo.cltime}></td>
						<td>
						<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">编辑</a>]</span>&nbsp;&nbsp;&nbsp;
						<span>[<a href="<{:C('web_url')}>__APP__/user_yjtx.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span></td>
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