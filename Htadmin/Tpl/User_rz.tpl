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
<script>
function addinfo(act,ids) {
               if (ids == null || ids ==''){
               parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '查看认证信息', width: 1000, height: 600, url: urlS+'user_rzshow.html?act='+act});
			   }
			   else
			   {
			    parent.MsgBox.OpenWin({ id: 'MenuEdit', title: '查看认证信息', width: 1000, height: 600, url: urlS+'user_rzshow.html?act='+act+'&id='+ids});
			   }
        }
		</script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">会员实名认证管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	
	<div style="display:none;" id="search_div">
  	<div class="page_tit">搜索/筛选数据 [ <a onclick="dosearch();" href="javascript:void(0);">隐藏</a> ]</div>
	
	<div class="form2">
	<form action="" method="get">
        <dl class="lineD">
           <dt>会员名：</dt>
           <dd><input type="text" value="<{$uname}>" id="uname" style="width:190px" name="uname"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
           <dt>真实姓名：</dt>
           <dd><input type="text" value="<{$users}>" id="users" style="width:190px" name="users"><span>不填则不限制</span></dd>
        </dl>
		<dl class="lineD">
           <dt>身份证号：</dt>
           <dd><input type="text" value="<{$zjh}>" id="zjh" style="width:190px" name="zjh"><span>不填则不限制</span></dd>
        </dl>
		
		
	<dl class="lineD">
      <dt>申请时间(开始)：</dt>
      <dd><input type="text" value="<{$ks}>" id="ks" style="width:190px" name="ks" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选开始时间则查询从开始时间往后所有</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>申请时间(结束)：</dt>
      <dd><input type="text" value="<{$js}>" id="js" style="width:190px" name="js" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly><span>只选结束时间则查询从结束时间往前所有</span></dd>
    </dl>
	<dl class="lineD">
      <dt>申请状态：</dt>
      <dd><select name="passed" style="width:80px" id="passed" >
  <option value="">申请状态</option>
<option <if condition="($passed eq '0')">selected="selected"</if>  value="0">待审核</option>
<option <if condition="($passed eq '1')">selected="selected"</if>  value="1">已审核</option>
<option <if condition="($passed eq '2')">selected="selected"</if>  value="2">未通过</option>
</select> <span>不填则不限制</span></dd>
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
  <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<{:C('web_url')}>__APP__/user_rz.html';">显示全部</button>
</div>
	<div class="clear"></div>
	<!--内容-->
	<div class="contentbox">
	<form id="nodecatEditor" name="nodecatEditor" method="post" action="">
	<table width="100%" class="table table-bordered">
				<tr>
			      <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
					<th width="40">ID</th>
					<th width="210">会员名</th>					
					<th width="40">真实姓名</th>
					<th width="50">身份证号</th>
					<!--<th width="60">正面图片</th>
					<th width="60">反面图片</th>-->
					<th width="130">上传时间</th>
					<th width="60">审核状态</th>								
					<th width="102">操作</th>					
				</tr>
					<volist name="arr" id="vo"> 
			      <tr>
				        <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
						<td><{$vo.id}></td>	
						<td><{$vo[user_id]|ly=###}></td>					
						<td><{$vo['users']}>
</td>
						<td><{$vo['zjh']}></td>
						<!--<td><a target="_blank" href="<{$vo['spic']}>">查看正面</a></td>
						<td><a target="_blank" href="<{$vo['spic1']}>">查看反面</a></td>-->
						
						<td><{$vo.addtime|date="Y-m-d H:i:s",###}></td>
						<td>
						<if condition="$vo['passed'] eq 2">未通过
						<elseif condition="$vo['passed'] eq 1"/>已通过
						<elseif condition="$vo['passed'] eq 0"/>审核中				
						</if></td>
						<td><span>[<a href="<{:C('web_url')}>__APP__/user_rz.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>&nbsp;&nbsp;&nbsp;<span onclick="addinfo('edit','<{$vo.id}>');">[<a href="javascript://">编辑</a>]</span></td>
						
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