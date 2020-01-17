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
            <div class="icontithome">项目管理列表</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">

            <div class="control-group" style="padding-top:6px;">

               <!-- <a href="javascript:document.getElementById('nodecatEditor').submit();" class="btn btn-primary btn-sm">删除选择</a>-->
                <input type="button" value="将当前条件下数据导出为Excel" class="btn btn-primary btn-sm" onclick="location.href = '<{:C('web_url')}>__APP__/pro_sdc';">
            </div>
            <div class="search"><form id="searchform" action="" method="get"><span>项目名称：</span><span><input name="title" type="text" class="cd" value="<{$title}>"/>&nbsp;</span>
                    <span>领班：</span><span><input name="user" type="text" class="cd" value="<{$username}>"/>&nbsp;</span>
                    <span>
                        <select class="cdselect" name="hotel_id" id="hotel_id">
                            <option value="">选择酒店</option>
                            <foreach name="hotel" item="v">
                                <option value="<{$v.id}>" <if condition="$v['id'] == $hotel_id">selected</if>><{$v.title}></option>
                            </foreach>
                        </select>
                    </span> 
                    <span>
                        <select class="cdselect" name="part_id" id="part_id">
                            <option value="">选择部门</option>
                           
                        </select>
                    </span> 
                    <span>工作日期:<input name="ks" style="height:28px;" type="text" class="cd100" value="<{$ks}>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',})" readonly/>-<input name="js" type="text" class="cd100" value="<{$js}>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly/>&nbsp;

                    </span>
                    <input type="submit" value="搜索" class="btn btn-primary"/></form>
                <span>总返利：<{$rebate|default=0}>元&nbsp;&nbsp;&nbsp;</span><span>总薪酬：<{$reward|default=0}>元&nbsp;&nbsp;&nbsp;</span>
                <span>总工时：<{$hours|default=0}>小时&nbsp;&nbsp;&nbsp;</span><span>总下单人数：<{$xd_sum|default=0}>人&nbsp;&nbsp;&nbsp;</span>
                <span>总考勤人数：<{$kq_sum|default=0}>人&nbsp;&nbsp;&nbsp;</span>
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

                            <th>项目名称</th>
                            <th>领班</th>
                            <th>酒店</th>
                            <th>酒店部门</th>
                            <th>工作日期</th>
                            <th>返利（元）</th>
                            <th>工时（小时）</th>
                            <!--<th>时薪（元）</th>-->
                            <th>薪酬（元）</th>
                            <th>已发放金额（元）</th>
                            <th>下单人数（人）</th>
                            <th>考勤人数（人）</th>
                            <th>发布时间</th>

                            <th>操作</th>
                        </tr>
                        <volist name="arr" id="vo"> 
                            <tr>
                                <td>
                                    <input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<{$vo.id}>'></td>
                                <!--
<td><{$vo.id}></td>						-->
                                <td><{$vo.title}></td>
                                <td><{$vo.username}><br/><{$vo.nickname}></td>
                                <td><{$vo.hotel}></td>
                                <td><{:cate('part',$vo['part_id'])}></td>
                                <td><{$vo.worktime}></td>
                                <td><{$vo.rebate|default=0}></td>
                                <td><{$vo.hours|default=0}></td>
                                <!--<td><{$vo.wage|default=0}></td>-->
                                <td><{$vo.reward|default=0}></td>
                                <td><{:sumprice('item','subject_id',$vo['id'],'send_price')}></td>
                                
                                <td><{$vo.num|default=0}></td>
                                <td><{$vo.kq_num|default=0}></td>

                                <td><{:date('Y-m-d H:i:s',$vo['addtime'])}></td>
                                <td>
                                    <span>[<a href="<{:C('web_url')}>__APP__/pro_sublist.html?id=<{$vo.id}>">详情</a>]</span>&nbsp;
                                    <span>[<a href="<{:C('web_url')}>__APP__/pro_enable?id=<{$vo.id}>&status=<{$vo.status}>" ><if condition="$vo['status'] == 1">冻结<else/>开启</if>项目</a>]</span>&nbsp;
                                    <!--<span>[<a href="<{:C('web_url')}>__APP__/pro_subject.html?id=<{$vo.id}>"  onClick="return ConfirmDel();">删除</a>]</span>&nbsp;-->
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