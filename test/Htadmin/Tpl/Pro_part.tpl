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
            <script>
                function addinfo(act, ids) {
                    if (ids == null || ids == '') {
                        parent.MsgBox.OpenWin({id: 'MenuEdit', title: '添加部门', width: 1000, height: 500, url: urlS + 'pro_psave.html?act=' + act});
                    } else
                    {
                        parent.MsgBox.OpenWin({id: 'MenuEdit', title: '部门信息', width: 1000, height: 500, url: urlS + 'pro_psave.html?act=' + act + '&id=' + ids});
                    }
                }
            </script>
    </head>
    <body>
        <!-- 新窗口的选项卡结束 -->
        <div class="tit">
            <div class="icontithome">部门列表</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">

            <div class="control-group" style="padding-top:6px;">
                <button type="button" class="btn btn-primary btn-sm" onclick="addinfo('add', '');">添加部门</button>

                <a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>
            </div>
            <div class="search"><form id="searchform" action="" method="get"><span>标题：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
                    <span>
                        <select name="hotel_id" style="width:auto;" id="hotel_id" class="cdselect">
                            <option value="">选择酒店</option>
                            <foreach name="hotel" item="v">
                                <option <if condition="($hotel_id eq $v['id'])">selected="selected"</if>  value="<{$v.id}>"><{$v.title}></option>
                            </foreach>
                        </select>
                    </span>
                    <span>
                        <select name="passed" style="width:auto;" id="passed" class="cdselect">
                            <option value="">选择状态</option>
                            <option <if condition="($passed eq '0')">selected="selected"</if>  value="0">未审核</option>
                            <option <if condition="($passed eq '1')">selected="selected"</if>  value="1">已审核</option>
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
                            <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
                            <th width="40">ID</th>					
                            <th>标题</th>
                            <th>所属酒店</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        <volist name="arr" id="vo"> 
                            <tr>
                                <td><input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                                <td><{$vo.id}></td>						
                                <td><{$vo.title}></td>
                                <td><{:cate('hotel',$vo['hotel_id'])}></td>
                                <td><if condition="$vo.passed eq 1">已审核<else/><span class="red">未审核</span></if></td>
                                <td>
                                    <span onclick="addinfo('edit', '<{$vo.id}>');">[<a href="javascript://">修改</a>]</span>&nbsp;
                                    <span>[<a href="<{:C('web_url')}>__APP__/pro_part.html?id=<{$vo.id}>" onClick="return ConfirmDel();">删除</a>]</span>
                                </td>
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