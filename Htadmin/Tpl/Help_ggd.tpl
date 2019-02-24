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
            var tit = $.trim($("#title").val());
			if (tit == "") {
			$("#spnMsg").html("请输入标题");
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
	<input name="id_not" type="hidden" value="<{$show.id}>" />	
	<input name="qy" type="hidden" value="<{$Think.cookie.qy}>" />	
		<div class="hyinfo"><b class="text-warning">信息管理</b></div>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="fromtj">
            
			 <tr>
                <th width="11%">信息标题：</th>
                <td width="89%"><input name="title" id="title" type="text" class="cd300" value="<{$show.title}>" /><if condition="$show['id'] eq 3">我要推广数据内容</if></td>
            </tr>
			<if condition="$show['id'] eq 3">
			<tr>
                <th>二维码上标题：</th>
                <td><input name="src" id="src" type="text" class="cd300" value="<{$show.src}>" /></td>
            </tr>
			<tr>
                <th>二维码下标题：</th>
                <td><input name="wxsrc" id="wxsrc" type="text" class="cd300" value="<{$show.wxsrc}>" /></td>
            </tr>
			<tr >
                <th>背景图片(上)：</th>
                <td><img id="thumbshow_1" width="160"  src="<{$show[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=160&w=80';"><input name="spic" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<{$show.spic}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.spic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Infor&filed=spic">删除文件</a></if>尺寸(640px X 450px)
                </td>
            </tr>
			<tr >
                <th>背景图片(下)：</th>
                <td><img id="thumbshow_2" width="160"  src="<{$show[bpic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=160&w=80';"><input name="bpic" type="hidden" id="pic_2" rel="no" size="53" class="cd" value="<{$show.bpic}>"/><input type="button" id="image2" value="选择图片" /><if condition="($show.bpic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Infor&filed=bpic">删除文件</a></if>尺寸(640px X 245px)
                </td>
            </tr>
			<tr >
                <th>广告图片：</th>
                <td><img id="thumbshow_3" width="160"  src="<{$show[text]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=160&w=80';"><input name="text" type="hidden" id="pic_3" rel="no" size="53" class="cd" value="<{$show.text}>"/><input type="button" id="image3" value="选择图片" /><if condition="($show.text  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Infor&filed=text">删除文件</a></if>尺寸(640px X 450px)
                </td>
            </tr>
			</if>
			
			<if condition="($Think.cookie.qy neq 1 && $Think.cookie.qy neq 2 && $Think.cookie.qy neq 5)">
			<tr>
                <th>简介：</th>
                <td><textarea name="text" rows="10" class="cd" id="text" style="width:500px; height:100px;"><{$show.text}></textarea>
                </td>
			</tr>
			</if>
			<if condition="$show['id'] eq 4">
			<tr >
                <th>背景图片：(尺寸：640PX*1740PX)</th>
                <td><img id="thumbshow_1" width="160"  src="<{$show[spic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=160&w=160';"><input name="spic" type="hidden" id="pic_1" rel="no" size="53" class="cd" value="<{$show.spic}>"/><input type="button" id="image1" value="选择图片" /><if condition="($show.spic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Infor&filed=spic">删除文件</a></if>
                </td>
            </tr>			
			</if>
			<if condition="($Think.cookie.qy eq 10)">
			<tr >
                <th>变化图片：</th>
                <td><img id="thumbshow_2" width="160"  src="<{$show[bpic]|default='no'}>" onerror="javascript:this.src='<{:C('web_url')}>__APP__/pub_nopic.html?l=160&w=160';"><input name="bpic" type="hidden" id="pic_2" rel="no" size="53" class="cd" value="<{$show.bpic}>"/><input type="button" id="image2" value="选择图片" /><if condition="($show.bpic  neq '')"><a href="<{:C('web_url')}>__APP__/home_delf.html?id=<{$show.id}>&kk=Infor&filed=bpic">删除文件</a></if>
                </td>
            </tr>			
			</if>
			<if condition="($Think.cookie.qy eq 10)">
			<tr>
                <th>连接地址：</th>
                <td><input name="src" id="src" type="text" class="cd300" value="<{$show.src}>" /></td>
            </tr>
			<tr>
                <th>微信连接地址：</th>
                <td><input name="wxsrc" id="wxsrc" type="text" class="cd300" value="<{$show.wxsrc}>" /></td>
            </tr>
			</if>	
			<if condition="($Think.cookie.qy eq 1 || $Think.cookie.qy eq 2)">
			<if condition="$show['id'] neq 3">
			<tr>
                <th>内容：</th>
                <td><textarea name="content" rows="10" class="cd" id="content_1" style="width:500px; height:100px;"><{$show.content}></textarea></td>
            </tr>
			</if>	
			</if>	
			<tr>
                <th>序号：</th>
                <td><input name="sort" id="sort" type="text" class="cd50" value="<{$show.sort|default='0'}>" /></td>
            </tr>
			<tr>
                <th>状态：</th>
                <td>
                  <input type="radio" name="passed" value="0" <if condition="($show[passed] eq 0)">checked</if>/>
                  停止
                  <input type="radio" name="passed" value="1" <if condition="($show[passed] eq 1)">checked</if>/>
                  开启
                </td>
			</tr>
            <tr>
                <td class="tdtitle">&nbsp;</td>
                <td>
                    <input type="submit" value=" 确 定 " onclick="return Enter();" id="btnEnter" class="btn btn_submit" />&nbsp;
                    <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="parent.$.close('MenuEdit')" />&nbsp;
                    <span id="spnMsg" class="red"></span><br />
<br />                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>