<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <include file="Pub:key" />
            <link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
            <link href="<{:C('web_url')}>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/js.js"></script>
            <script type="text/javascript" src="<{$Think.config.web_url}>__WJ__/My97DatePicker/WdatePicker.js"></script>
            <script>var urlS = "<{:C('web_url')}>__APP__/";</script>
            <include file="Pub:msg" />

    </head>
    <body>
        <!-- 新窗口的选项卡结束 -->
        <div class="tit">
            <div class="icontithome">红包发送记录</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">

            <div class="control-group" style="padding-top:6px;">

                <a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
            </div>
            <div class="search"><form id="searchform" action="" method="get">
                    <span>红包总金额: <{$sum}>&nbsp;</span>
                    <span>领班帐号：</span><span><input name="users" type="text" class="cd" value="<{$users}>"/>&nbsp;</span>
                    <span>服务员账号/手机号码：</span><span><input name="waiter" type="text" class="cd" value="<{$waiter}>"/>&nbsp;</span>
                    <span>项目名称：</span><span><input name="subject" type="text" class="cd" value="<{$subject}>"/>&nbsp;</span>
                    <span>操作时间:<input name="ks" style="height:28px;" type="text" class="cd100" value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly/>-<input name="js" type="text" class="cd100" value="<{$js}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'{%y-50}-%M-{%d+0} %H:%m:%s',maxDate:'%y-{%M}-{%d-1}%H:%m:%s'})" readonly/>&nbsp;
                        <span>工作日期:<input name="wks" style="height:28px;" type="text" class="cd100" value="<{$wks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly/>-<input name="wjs" type="text" class="cd100" value="<{$wjs}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly/>&nbsp;

                            <span><select name="passed" style="width:80px" class='cdselect' >
                                    <option value="">发送状态</option>
                                    <option <if condition="($passed eq '0')">selected="selected"</if>  value="0">发送失败</option>
                                    <option <if condition="($passed eq '1')">selected="selected"</if>  value="1">发送成功</option>
                                    <option <if condition="($passed eq '2')">selected="selected"</if>  value="2">已领取</option>
                                    <option <if condition="($passed eq '3')">selected="selected"</if>  value="3">退款中</option>
                                    <option <if condition="($passed eq '4')">selected="selected"</if>  value="4">已退款</option>
                                    <!--<option <if condition="($is_pay eq '2')">selected="selected"</if>  value="2">已退款</option>-->
                                </select>&nbsp;</span>
                        </span>
                        <input type="submit" value="搜索" class="btn btn-primary"/></form>
            </div>
            <div class="clear"></div>
            <!--内容-->
            <div class="contentbox">
                <form id="nodecatEditor" name="nodecatEditor" method="post" action="">
                    <table width="100%" class="table table-bordered">
                        <tr>
                            <th width="21"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
                            <th width="51">ID</th>					
                            <th width="150">操作时间</th>
                            <th width="150">工作日期</th>
                            <th width="99">金额(元)</th>					
                            <th width="150">领班帐号</th>
                            <th width="150">领取服务员</th>
                            <th width="150">项目名称</th>
                            <th width="150">状态</th>
                            <th width="270">备注</th>
                            <th width="55">操作</th>
                        </tr>
                        <volist name="arr" id="vo"> 
                            <tr>
                                <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                                <td><{$vo.id}></td>						
                                <td><{:date('Y-m-d H:i:s',$vo['addtime'])}></td>
                                <td><{$vo.worktime}></td>	
                                <td><{$vo.amount}></td>						
                                <td><{$vo.username}></td>
                                <td><{$vo.waiter}> <{$vo.waitermoble}></td>
                                <td><{$vo.title}></td>
                                <td><{$vo.passed|receivestatus}></td>
                                <td><{$vo.msg}></td>
                                <td><span>[<a href="<{:C('web_url')}>__APP__/user_jl.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>						</td>
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