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
            <script type="text/javascript" src="<{:C('web_url')}>__WJ__/My97DatePicker/WdatePicker.js"></script>

            <script>var urlS = "<{:C('web_url')}>__APP__/";</script>
            <include file="Pub:msg" />
            <script>
                function addinfo(act, ids) {
                    if (ids == null || ids == '') {
                        parent.MsgBox.OpenWin({id: 'MenuEdit', title: '添加领班', width: 1000, height: 500, url: urlS + 'pro_ssave.html?act=' + act});
                    } else
                    {
                        parent.MsgBox.OpenWin({id: 'MenuEdit', title: '领班信息', width: 1000, height: 500, url: urlS + 'pro_ssave.html?act=' + act + '&id=' + ids});
                    }
                }
                $(function () {
                    $('#hotel_id').change(function () {
                        var hotel_id = $('#hotel_id').val();
                        var part_id = '<{$part_id}>';
                        $.ajax({
                            url: urlS+"pub_part",
                            data: {hotel_id: hotel_id},
                            success: function (data) {
                                $('#part_id').empty();
                                $('#part_id').append($('<option value="0">选择部门</option>'));
                                $.each(data, function (i, n) {
                                    var classs = '';
                                    if (n.id == part_id) {
                                        classs = 'selected';
                                    }
                                    var li = '<option ' + classs + ' value="' + n.id + '">' + n.title + '</option>';
                                    $('#part_id').append($(li));
                                });
                            },
                            error: function (error) {
                                alert("NETWORK ERROR!");
                            },
                        });
                    }).trigger('change');
                });
            </script>
    </head>
    <body>
        <!-- 新窗口的选项卡结束 -->
        <div class="tit">
            <div class="icontithome">项目汇总</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">


            <div class="search"><form id="searchform" action="" method="get">
                    <span>领班：</span><span><input name="user" type="text" class="cd" value="<{$username}>"/>&nbsp;</span>
                    <span>
                        <select class="cdselect" id="hotel_id" name="hotel_id">
                            <option value="">选择酒店</option>
                            <foreach name="hotel" item="v">
                                <option value="<{$v.id}>" <if condition="$v['id'] == $hotel_id">selected</if>><{$v.title}></option>
                            </foreach>
                        </select>
                    </span> 
                    <span>
                        <select class="cdselect" id="part_id" name="part_id">
                            <option value="">选择部门</option>

                        </select>
                    </span> 
                    <span>工作日期:<input name="ks" style="height:28px;" type="text" class="cd100" value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',})" readonly/>-<input name="js" type="text" class="cd100" value="<{$js}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly/>&nbsp;

                    </span>
                    <input type="submit" value="搜索" class="btn btn-primary"/></form>
                    
                    <span>总薪酬：<{$tj.rewards}>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span>总工时：<{$tj.hourss}>小时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span>总返利：<{$tj.rebates}>元</span>
            </div>
            <div class="clear"></div>
            <!--内容-->
            <div class="contentbox">
                <form id="nodecatEditor" name="nodecatEditor" method="post" action="">
                    <table width="100%" class="table table-bordered">
                        <tr>
                            <th width="22"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
                            <!--
<th width="40">ID</th>-->					
                            <th>领班</th>
                            <th>工时</th>
                            <th>返利</th>
                            <th>薪酬</th>
                            <th>操作</th>
                        </tr>
                        <volist name="arr" id="vo"> 
                            <tr>
                                <td>
                                    <input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                                <!--
<td><{$vo.id}></td>						-->
                                <td><{$vo.username}><br/><{$vo.nickname}></td>
                                <td><{$vo.hourss}>小时</td>
                                <td><{$vo.rebates}>元</td>
                                <td><{$vo.rewards}>元</td>
                                <td>
                                    <span>[<a href="<{:C('web_url')}>__APP__/pro_fitem.html?id=<{$vo.user_id}>" >详情</a>]</span>
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