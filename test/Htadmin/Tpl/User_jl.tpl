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
            <script>var urlS = "<{:C('web_url')}>__APP__/";</script>
            <include file="Pub:msg" />

    </head>
    <body>
        <!-- 新窗口的选项卡结束 -->
        <div class="tit">
            <div class="icontithome">领班金额流水记录</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">

            <div class="control-group" style="padding-top:6px;">

                <a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
            </div>
            <div class="search"><form id="searchform" action="" method="get">

                    <span>领班帐号：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
                    <span>
                        <select class="cdselect" name="qy">
                            <option value="">选择类型</option>
                            <option value="0">充值</option>
                            <option value="1">发放工资</option>
                            <option value="2">工资未领取退款</option>
                        </select>
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
                            <th width="99">金额(元)</th>
                            <th width="150">会员帐号</th>
                            <th width="100">类型</th>
                            <th width="270">备注</th>
                            <th width="55">操作</th>
                        </tr>
                        <volist name="arr" id="vo"> 
                            <tr>
                                <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                                <td><{$vo.id}></td>						
                                <td><{$vo['addtime']|mdate}></td>
                                <td><{$vo.price}></td>						
                                <td><{$vo.user_id|ly=###}></td>
                                <td><if condition="$vo['qy'] == 0">充值<elseif condition="$vo['qy'] == 1"/>工资发放<else/>工资未领取退款</if></td>	
                                <td>
                                    <{$vo.text}></td>
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