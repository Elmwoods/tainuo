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
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/My97DatePicker/WdatePicker.js"></script>
<include file="Pub:js" />
<!--MsgBox-->	
<include file="Pub:msg" />
<script type="text/javascript">
        function Enter() {
            $("#spnMsg").text('');
            var tit = $.trim($("#content").val());
			if (tit == "") {
			//$("#spnMsg").html("请输入内容");
               // return false;
            }
			
            return true;
        }

        //添加成功
        function AddSuccess(id, tit) {
            MsgBox.SuccessMsg("操作成功");
            parent.AddSuccess(id, tit);
            setTimeout(parent.$.close('MenuEdit'), 2000);
        }

        //编辑成功
        function EditSuccess(tit) {
            MsgBox.SuccessMsg("操作成功");
            parent.EditSuccess(tit);
            setTimeout(parent.$.close('MenuEdit'), 2000);
        }		
    </script>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
	 <input name="id" type="hidden" value="<{$show.classid}>" />
		<div class="hyinfo"><b class="text-warning">退款售后服务</b></div>
			<div>
	<table class="table noborder" style="width:100%;">
							    <tr>
                                       
                                        <th width="100">产品名称</th>
										<th width="30">产品编号</th>
										<th width="30">属性</th>
                                        <th width="20">产品单价</th>
										
										<th width="20">数量</th>
                                        <th width="20">产品总金额</th>
										
      </tr>
	  <volist name="ddlist" id="vol">
	     <tr>
                                        <td><{$vol.title}></td>
										<td><{$vol.pr_id|hygroup="pro","id",###,"id","model"}></td>
										<td><{$vol.csname}></td>
                                        <td><{$vol.dj}></td>
										
										<td><{$vol.sl}></td>
                                        <td><{$vol.price}></td>
										
                                    </tr>

     </volist> 	                              
      </table>
	</div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="8%">订单号：</th>
                <td width="92%"><{$show.ddbh}></td>
            </tr>			
			<tr>
                <th width="8%">收货地址：</th>
                <td width="92%">收货人：<{$address['names']}>   电话：<{$address['phone']}>   收货地址：<{$address['sf']|address=###}> <{$address['cs']|address=###}> <{$address['xc']|address=###}> <{$address['address']}></td>
            </tr>
			<tr>
                <th width="8%">产品金额：</th>
                <td width="92%">￥<{$show.pprice}></td>
            </tr>
			<tr>
                <th width="8%">优惠券：</th>
                <td width="92%">-￥<{$show.yhq}></td>
            </tr>
			<tr>
                <th width="8%">满减优惠：</th>
                <td width="92%">-￥<{$show.mj}></td>
            </tr>
			<tr>
                <th width="8%">运费：</th>
                <td width="92%">+￥<{$show.kdfsprice}></td>
            </tr>
			<tr>
                <th width="8%">酒币：</th>
                <td width="92%">-￥<{$show.pointp}></td>
            </tr>
			<tr>
                <th width="8%">应付金额：</th>
                <td width="92%">￥<{$show.prices}></td>
            </tr>
			<tr>
                <th width="8%">优惠金额：</th>
                <td width="92%">-￥<{$show.zkprice}></td>
            </tr>
			<tr>
                <th width="8%">实际付款：</th>
                <td width="92%">￥<{$show.zhprice}></td>
            </tr>
			<tr>
                <th width="8%">退款金额：</th>
                <td width="92%">￥<{$show.zhprice}></td>
            </tr>			
			<tr>
                <th>申请类型：</th>
                <td><strong>退款</strong></td>
            </tr>
			<tr>
                <th>交易流程：</th>
                <td><div style="width:600px; height:150px; padding:2px; overflow:auto; border:1px solid #f4f4f4;">
<volist name="tklist" id="vol">
<strong style="color:#FF0000;"><{$vol.addtime}>--<{$vol.tktitle}></strong><br /><{$vol.content}><br /><br />
</volist>
</div></td>
            </tr>
			
			<tr>
                <th>审核状态：</th>
                <td>
		  <select class="cdselect" id="tkpassed" style="width:auto;" name="tkpassed">
		  <option value="0" <if condition="($show[tkpassed] eq '0')">selected="selected"</if>>审核中</option>		  
		  <option value="11" <if condition="($show[tkpassed] eq '11')">selected="selected"</if>>已拒绝</option>
		  <option value="12" <if condition="($show[tkpassed] eq '12')">selected="selected"</if>>已完成</option>
		  <option value="13" <if condition="($show[tkpassed] eq '13')">selected="selected"</if>>已取消</option>		
	      </select>
			</td>
            </tr>
			<tr>
                <th>备注说明：</th>
                <td><textarea name="content" class="cdtext"></textarea>
			</td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                   <if condition="$show[tkpassed] eq 0"> <input type="submit" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;</if>
                    <input type="button" class="btn btn_cannel" value=" 关 闭 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>