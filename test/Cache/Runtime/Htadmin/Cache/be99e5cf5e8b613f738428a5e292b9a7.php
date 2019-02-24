<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>管理系统</title>
<meta content="管理系统" name="keywords" />
<meta content="管理系统" name="description" />
<script>
var urlS="<?php echo C('web_url');?>__APP__/";
var piclj="<?php echo C('htpiclj');?>";
var piclj1="<?php echo C('htpiclj1');?>";
</script>
            <link href="<?php echo C('web_url');?>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo C('web_url');?>__WJ__/css/bootstrap.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/js.js"></script>
            <script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/My97DatePicker/WdatePicker.js"></script>

            <script>var urlS = "<?php echo C('web_url');?>__APP__/";</script>
            <link type="text/css" href="<?php echo C('web_url');?>__WJ__/js/msg/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/AsyncBox.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/FunLib.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/json2.js"></script>
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
                        var part_id = '<?php echo ($part_id); ?>';
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
                    $('#gooutput').click(function(){
                    window.location.href="<?php echo C('web_url');?>__APP__/pro_fwhzdc.html";
    });
                });
            </script>
    </head>
    <body>
        <!-- 新窗口的选项卡结束 -->
        <div class="tit">
            <div class="icontithome">服务员汇总</div>
            <div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
        </div>

        <div class="mainbox topborder">


            <div class="search"><form id="searchform" action="" method="get"><span>服务员：</span><span><input name="user" type="text" class="cd" value="<?php echo ($username); ?>"/>&nbsp;</span>
                    <span>
                        <select class="cdselect" id="hotel_id" name="hotel_id">
                            <option value="">选择酒店</option>
                            <?php if(is_array($hotel)): foreach($hotel as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $hotel_id): ?>selected<?php endif; ?>><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </span> 
                    <span>
                        <select class="cdselect" id="part_id" name="part_id">
                            <option value="">选择部门</option>

                        </select>
                    </span> 
                    <span>工作日期:<input name="ks" style="height:28px;" type="text" class="cd100" value="<?php echo ($ks); ?>" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd',})" readonly/>-<input name="js" type="text" class="cd100" value="<?php echo ($js); ?>" style="height:28px;" onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})" readonly/>&nbsp;
                    </span>
                    <input type="submit" value="搜索" class="btn btn-primary"/>
                <input type="button" id='gooutput' value="导出当前数据" class="btn btn-primary"/>
                </form>
                <span>总领取金额：<?php echo (($rebate)?($rebate):0); ?>元&nbsp;&nbsp;&nbsp;</span>
                <span>总薪酬：<?php echo (($reward)?($reward):0); ?>元&nbsp;&nbsp;&nbsp;</span>
                <span>总工时：<?php echo (($hours)?($hours):0); ?>小时&nbsp;&nbsp;&nbsp;</span>
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

                            <th>服务员</th>
                            <th>工作时间</th>
                            <th>酒店</th>
                            <th>部门</th>
                            <th>工时</th>
                            <th>时薪</th>
                            <th>酬劳</th>
                            <th>是否确认</th>
                            <th>工资发放状态</th>
                            <th>已发放金额（元）</th>
                            <th>已领取金额（元）</th>
                        </tr>
                        <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td>
                                    <input name='articleid[]' type='checkbox' onClick="unselectall()" id="articleid" value='<?php echo ($vo["id"]); ?>'></td>
                                <td><?php echo ($vo["username"]); ?><br/><?php echo ($vo["moble"]); ?></td>
                                <td><?php echo ($vo["ontime"]); ?> - <br/><?php echo ($vo["offtime"]); ?></td>
                                <td><?php echo cate('hotel',$vo['hotel_id']);?></td>
                                <td><?php echo cate('part',$vo['part_id']);?></td>
                                <td><?php echo (($vo["hours"])?($vo["hours"]):0); ?></td>
                                <td><?php echo (($vo["wage"])?($vo["wage"]):0); ?></td>
                                <td><?php echo (($vo["reward"])?($vo["reward"]):0); ?></td>
                                <td><?php if($vo['is_con'] ==1): ?>是<?php else: ?>否<?php endif; ?></td>
                                <td><?php echo sendstatus($vo['status']);?></td>
                                <td><?php echo ($vo["send_price"]); ?></td>
                                <td><?php echo ($vo["receive_price"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </form>	     
                <div class="clear"></div>
                <div class="pagejump"><div class="number"><span>共<?php echo ($count); ?>条记录&nbsp;</span><?php echo ($fpage); ?></div></div> 

            </div>
        </div>
        <script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/remind.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/msg/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo C('web_url');?>__WJ__/js/bootstrap.min.js"></script>
<style type="text/css">
    .vshop
    {
        overflow: hidden;
    }
    .sname
    {
        float: left;
    }
    .bindwx, .vok
    {
        float: left;
    }
</style>
	<script type="text/javascript">
    var ejecttime = "s_ejecttime";
</script>
<div id="asyncbox_cover" unselectable="on" style="opacity: 0.1; filter: alpha(opacity=10);
    background: #000">
</div>
<div id="asyncbox_clone">
</div>
<div id="asyncbox_focus">
</div>
<div id="asyncbox_load">
    <div>
        <span></span>
    </div>
</div>
<div class="pop_up" id="message">
    <div class="pop_up_top">
        <span>温馨提示</span><a href="javascript://" id="message_close"></a></div>
    <div class="pop_up_middle">
        <ul>
            <li>
                <div class="m" style="float: left;">
				  <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>产品订单:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未付款(<span class="messageTxt"
                        id="span_Message"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已付款(<span class="messageTxt"
                        id="span_BackOrder"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;">已发货(<span class="messageTxt"
                        id="point"><b>0</b></span>)</font>						
						</div>
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				 <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>返利结算:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">未结算订单数(<span class="messageTxt"
                        id="zxsj1"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;">已结算订单数(<span class="messageTxt"
                        id="zxsj2"><b>0</b></span>)</font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj3"><b></b></span></font>						
                    </div>					
                </div>
            </li>
            <li>
                <div class="m"  style="float: left;">
				
                    <div class="green" style=" color:#2559A6;"><font style="float:left;"><strong>其他信息:</strong></font>
					    <font style="display:block; float:left; padding-right:10px;">提现申请(<span class="messageTxt"
                        id="span_AdvisoryReply"><b>0</b></span>)</font>
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="zxsj4"><b></b></span></font>	
						<font style="display:block; float:left; padding-right:10px;"><span class="messageTxt"
                        id="nr"><b></b></span></font>						
						</div>
						
                </div>
            </li>
            <li>
                <div class="m">
                    <dl>
                        <dt>设置提示时间：</dt>
                        <dd id="select_dd" style="float:left; margin-top:-5px;">
                            <div class="drop_down" id="drop_down_down1">
                                默认（10分钟）
                            </div>
                            <div class="select_div select_div1" id="select_div1">
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="0">
                                    <a href="#">不再提醒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="3600000">
                                    <a href="#">60分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="2700000">
                                    <a href="#">45分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1800000">
                                    <a href="#">30分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="1200000">
                                    <a href="#">20分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="600000">
                                    <a href="#">10分钟（默认）</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="300000">
                                    <a href="#">5分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="120000">
                                    <a href="#">2分钟</a></p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="60000">
                                    <a href="#">1分钟</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="30000">
                                    <a href="#">30秒</a>
                                </p>
                                <p onMouseOver="onover(this)" onMouseOut="onout(this)" onClick="select_item(this)"
                                    value="10000">
                                    <a href="#">10秒</a>
                                </p>
                                <div class="clear">
                                </div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
    <div class="pop_up_bottom">
    </div>
</div>
    </body>
</html>