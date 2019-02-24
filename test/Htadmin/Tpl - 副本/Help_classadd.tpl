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
<include file="Pub:js" />
<!--MsgBox-->	
<include file="Pub:msg" />
<script type="text/javascript">
        function Enter() {
            $("#spnMsg").text('');
            var tit = $.trim($("#class_name_cn").val());
			var sorts = $.trim($("#sort").val());
            if (tit == "") {
			$("#spnMsg").html("请输入类目标题");
                return false;
            }
			if (sorts == "") {
			$("#spnMsg").html("请输入排序");
                return false;
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
	<input name="id_not" type="hidden" value="<{$show.classid}>" />
	<input name="dj" type="hidden" value="<{$dj}>" />
	<input name="prv_id" type="hidden" value="<{$prv}>" />
	<input name="qy" type="hidden" value="<{:cookie('qy')}>" />
		<div class="hyinfo"><b class="text-warning">类目信息</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
		    <tr>
                <th>上级类目：</th>
                <td><{$prvname}></td>
            </tr>
            <tr>
                <th>类目标题：</th>
                <td>
                    <input name="class_name_cn" type="text" id="class_name_cn" class="cd"  value="<{$show.class_name_cn}>"/><span class="red">&nbsp;*</span>
              </td>
            </tr>
			 
			 
			 
			<if condition="$prv gt 0">
			<tr>
                <th>栏目类型：</th>
                <td><input type="radio" name="tj" value="0" <if condition="($show[tj] eq 0)">checked=""</if> >
单页面
<input type="radio" name="tj" value="1" <if condition="($show[tj] eq 1)">checked=""</if>>
图片列表
<input type="radio" name="tj" value="2" <if condition="($show[tj] eq 2)">checked=""</if>>
文章列表<br />
<span class="red">单页面(只介绍此信息),图片页面(需要在左侧信息列表添加图片),文章列表(需要在左侧信息列表添加文章)</span>
</td>
            </tr>
			<else/>
			<tr style="display:none;">
                <th>栏目类型：</th>
                <td><input type="radio" name="tj" value="2" checked="">单页面</td>
            </tr>
			</if>
			<if condition="$prv gt 0">
			<tr>
                <th>优化标题：</th>
                <td>
                    <input name="t" type="text" id="t" class="cd300"  value="<{$show.t}>"/>
                </td>
            </tr>
			
			<tr>
                <th>优化关键字：</th>
                <td>
                    <input name="k" type="text" id="k" class="cd300"  value="<{$show.k}>"/>
                </td>
            </tr>
			
			<tr>
                <th>优化描述：</th>
                <td>
                    <textarea name="d" cols="60" rows="5" class="cdtext" id="d"><{$show.d}></textarea>
                </td>
            </tr>
			
			<tr>
                <th>详细内容：</th>
                <td>
                    <textarea name="class_txt_cn" cols="60" rows="5" class="cdtext" id="content_1"><{$show.class_txt_cn}></textarea>
                </td>
            </tr>
			</if>
			<tr>
                <th>是否发布：</th>
                <td><input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked=""</if> >
是
<input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked=""</if>>
否 </td>
            </tr>
			 <tr>
                <th>排序：</th>
                <td>
                    <input name="sort" type="text" id="sort" maxlength="8" class="cd50" value="<{$show.sort|default='0'}>"/>
                    <span class="red">（必须是数字）数字越大越靠前</span>
                </td>
            </tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" name="btnEnter" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
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