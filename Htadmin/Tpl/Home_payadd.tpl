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
<!--MsgBox-->	
<include file="Pub:msg" />
<script type="text/javascript">
        function Enter() {
            $("#spnMsg").text('');
            //var tit = $.trim($("#title").val());
//            if (tit == "") {
//			$("#spnMsg").html("请输入名称");
//                return false;
//            }
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
    <form method="post" action="<{:C('web_url')}>__APP__/home_payadd.html" id="form1">
	<input name="id_not" type="hidden" value="<{$show.id}>" />
		<div class="hyinfo"><b class="text-warning">数据信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            <tr>
                <th>名称：</th>
                <td>
                    <{$show.title}>
              </td>
            </tr>
			<if condition="$show[id] eq 1">
			<tr>
                <th>支付宝收款账号：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[0]}>"/>
                </td>
            </tr>
			<tr>
                <th>合作者身份ID（partner）：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[1]}>"/>
                </td>
            </tr>
			<tr>
                <th>交易安全校验码（key）：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[2]}>"/>
                </td>
            </tr>
			</if>
			
			<if condition="$show[id] eq 2">
			<tr>
                <th>微信公众号AppId：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[0]}>"/>
                </td>
            </tr>
			<tr>
                <th>微信公众号AppSecret：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[1]}>"/>
                </td>
            </tr>
			<tr>
                <th>商户ID：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[2]}>"/>
                </td>
            </tr>
			<tr>
                <th>商户支付密钥：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[3]}>"/>
                </td>
            </tr>
			
			</if>
			<if condition="$show[id] eq 3">
			<tr>
                <th>商户号(merId)：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[0]}>"/>
                </td>
            </tr>
			<tr>
                <th>签名证书密码：</th>
                <td>
                    <input name="pz[]" type="text" id="pz" class="cd"  value="<{$pz[1]}>"/>
                </td>
            </tr>			
			</if>
			 <tr>
                    <th>支付开关：</th>
					<td><input type="radio" value="1" name="passed" <if condition='($show.passed  eq 1)'>checked="checked"</if>>开启&nbsp;<input type="radio" value="0" name="passed" <if condition='($show.passed  eq 0)'>checked="checked"</if>>关闭</td>
  </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />

                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>