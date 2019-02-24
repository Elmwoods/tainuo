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
			var xzdj="";
			var xzdjname="";
			$("#dxxz  input[type=checkbox]:checked").each(function (){
			var isdj = $(this).attr("checked");
			var sj=$(this).val();
			var sjname=$(this).attr("rel");
			if(isdj=="checked"){
				if(xzdj){
					 xzdj=xzdj+","+sj;
					 xzdjname=xzdjname+","+sjname;
				 }
				 else{
					 xzdj=xzdj+""+sj;
					 xzdjname=xzdjname+""+sjname;
				}
			}
		    });
            $("#spnMsg").text('');
			if (xzdj == "") {
			$("#spnMsg").html("请选择地址");
                return false;
            }		
			window.parent.document.getElementById("aeraname").value=xzdjname;
			window.parent.document.getElementById("aeraid").value=xzdj;
            setTimeout(parent.$.close('MenuEdit22'), 2000);
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
<style>
#dxxz span{
    display: block;
    float: left;
    line-height: 30px;
    width: 70px;
	}</style>
</head>
<body>
<div class="mainbox topborder">
    <form method="post" action="" id="form1">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
			<tr>                
                <td>
				<ul id="dxxz">
				<li class="clearfix">
				<volist name="dq" id="vol">
				<span><input type="checkbox" <php>if(in_array($vol['id'],$nx))echo 'disabled';</php> <php>if(in_array($vol['id'],$yx))echo 'checked';</php> class="checkitem tc cartcheckbox" rel="<{$vol.region_name}>" value="<{$vol.id}>">&nbsp;<{$vol.region_name}></span>
				</volist>
				</li>
				</ul></td>
            </tr>
            <tr><td align="center" style="text-align:center;">
                    <input type="button" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit22')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>