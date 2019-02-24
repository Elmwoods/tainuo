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
<include file="Pub:msg" />
<script>
<if condition="$Think.get.err eq 1">
$(function(){
parent.MsgBox.SuccessMsg("操作成功");
});
</if>
</script>
</head>
<body>
<include file="Pub:loadd" />
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">分销方式设置</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="" id="myformly" name="myformly" >
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
	 <tr>
    <th width="10%"><span class="red">网站分销设置</span></th>
    <td width="90%">&nbsp;</td>
    </tr>
  <tr>
    <th><strong class="red">分销方式</strong></th>
    <td><input name="fs" type="radio" value="1" <if condition="$show['fs'] eq 1">checked="checked"</if> />开启&nbsp;&nbsp;<input name="fs" type="radio" value="0" <if condition="$show['fs'] eq 0">checked="checked"</if> />关闭<br />
二级分销-每级可以拿佣金(可设置)</td>
    </tr>
	 <tr>
    <th></th>
    <td>等级设置:<select name="dj" id="dj">
      <option value="1" <if condition="$show['dj'] eq 1">selected="selected"</if>>A级</option>
	  <option value="2" <if condition="$show['dj'] eq 2">selected="selected"</if>>B级</option>
	 <!-- <option value="3" <if condition="$show['dj'] eq 3">selected="selected"</if>>三级</option>
	  <option value="4" <if condition="$show['dj'] eq 4">selected="selected"</if>>四级</option>
	  <option value="5" <if condition="$show['dj'] eq 5">selected="selected"</if>>五级</option>-->
    </select></td>
    </tr>
	 <tr>
    <th></th>
    <td>
	<table width="100%" class="table table-bordered">
				<tr>
			        <th  style="text-align:left;width:14%;">等级</th>
					<th  style="text-align:left;width:14%;">A级</th>					
					<th  style="text-align:left;width:14%;">B级</th>
					<!--<th  style="text-align:left;width:14%;">三级</th>
					<th  style="text-align:left;width:14%;">四级</th>
					<th  style="text-align:left;width:14%;">五级</th>
					<th  style="text-align:left;width:14%;">自己</th>-->
					<th  style="text-align:left;width:16%;">操作</th>
				</tr>
					
			      <tr>
				        <td>拥金返利百分比%</td>
						<td><input name="commission[]" type="text" id="commission" class="cd50"  value="<{$commission[0]}>"/>%</td>						
						<td><input name="commission[]" type="text" id="commission" class="cd50"  value="<{$commission[1]}>"/>%</td>
						<!--<td><input name="commission[]" type="text" id="commission" class="cd50"  value="<{$commission[2]}>"/>%</td>
						<td><input name="commission[]" type="text" id="commission" class="cd50"  value="<{$commission[3]}>"/>%</td>
						<td><input name="commission[]" type="text" id="commission" class="cd50"  value="<{$commission[4]}>"/>%</td>
						<td><input name="flme" type="text" id="flme" class="cd50"  value="<{$show.flme}>"/>%</td>-->
					<td><input name="flfs" type="radio" value="1" <if condition="$show['flfs'] eq 1">checked="checked"</if> />按产品设置金额<br />
					    <input name="flfs" type="radio" value="2" <if condition="$show['flfs'] eq 2">checked="checked"</if>/>按实付金额</td>
				  </tr>
				  <tr>
				        <td>备注说明</td>
						<td>购买人上级为一级</td>						
						<td>购买人上上级为二级</td>
						<!--<td>购买人上上上级为三级</td>
						<td>购买人上上上上级为四级</td>
						<td>购买人上上上上上级为五级</td>
					    <td>自己购买自己拿</td>-->
						<td></td>
				  </tr>
		</table></td>
    </tr>
	 <tr>
    <th><strong  class="red">会员等级设置</strong></th>
    <td></td>
    </tr> 
	<tr>
    <th></th>
    <td>
	<table width="100%" class="table table-bordered">
				<tr>
			        <th  style="text-align:left;width:20%;">等级</th>
					<th  style="text-align:left;width:20%;">普通会员</th>	
					<th  style="text-align:left;width:20%;">银卡会员</th>					
					<th  style="text-align:left;width:20%;">金卡会员</th>
					<th  style="text-align:left;width:20%;">钻石会员</th>
					<th  style="text-align:left;width:20%;">操作</th>
				</tr>
					<tr>
				        <td>消费总金额</td>
						<td><input name="ucz[]" type="text" id="ucz" class="cd50"  value="<{$ucz[0]}>"/>元</td>
						<td><input name="ucz[]" type="text" id="ucz" class="cd50"  value="<{$ucz[1]}>"/>元</td>							
						<td><input name="ucz[]" type="text" id="ucz" class="cd50"  value="<{$ucz[2]}>"/>元</td>
						<td><input name="ucz[]" type="text" id="ucz" class="cd50"  value="<{$ucz[3]}>"/>元</td>
					    <td><input type="checkbox" <if condition="$show['ucz_enabled'] eq 1">checked=""</if> value="1" name="ucz_enabled">开启升级功能</td>
				  </tr>
				   <tr>
				        <td>酒币比例</td>
						<td><input name="uz[]" type="text" id="uz" class="cd50"  value="<{$uz[0]}>"/>系数</td>	
						<td><input name="uz[]" type="text" id="uz" class="cd50"  value="<{$uz[1]}>"/>系数</td>						
						<td><input name="uz[]" type="text" id="uz" class="cd50"  value="<{$uz[2]}>"/>系数</td>
						<td><input name="uz[]" type="text" id="uz" class="cd50"  value="<{$uz[3]}>"/>系数</td>
					<td><input type="checkbox" <if condition="$show['uz_enabled'] eq 1">checked=""</if> value="1" name="uz_enabled">开启酒币比例</td>
				  </tr>	
				 <!-- <tr>
				        <td>满包邮费</td>
						<td><input name="umf[]" type="text" id="umf" class="cd50"  value="<{$umf[0]}>"/>元</td>
						<td><input name="umf[]" type="text" id="umf" class="cd50"  value="<{$umf[1]}>"/>元</td>								
						<td><input name="umf[]" type="text" id="umf" class="cd50"  value="<{$umf[2]}>"/>元</td>
						<td><input name="umf[]" type="text" id="umf" class="cd50"  value="<{$umf[3]}>"/>元</td>
					<td><input type="checkbox" <if condition="$show['umf_enabled'] eq 1">checked=""</if> value="1" name="umf_enabled">开启满包邮费功能</td>
				  </tr>	-->		  
				  <tr>
				        <td>备注说明</td>
						<td colspan="5">1. 消费总金额达到设置数量自动升级到当前等级<br />
						2. 设置享受自己购买获取酒币的比例(实际酒币*当前系数)<br />
</td>					
						
				  </tr>
		</table></td>
    </tr>
	<tr><td style="text-align:right;">分销返利说明</td><td><textarea name="fxtext"  style="width:100%;" class="cdtext" id="fxtext"><{$show['fxtext']}></textarea></td></tr>
  <tr>
    <th>&nbsp;</th>
    <td><input type="submit" value="修改" class="btn btn-primary"/></td>
  </tr>
</table>                                
      </form>
	</div>
	</div>
<include file="Pub:foot" />
</body>
</html>