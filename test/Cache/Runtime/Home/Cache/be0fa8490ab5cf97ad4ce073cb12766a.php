<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <title><?php echo ($webt); ?></title>
<script>var urllink="<?php echo (C("web_url")); ?>__APP__/";</script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="white" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="__WJ__/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="__WJ__/css/style.css" rel="stylesheet">
    <style>
        .spinner-snake{
            border: 4px solid transparent;
            border-radius: 50%;
            animation: pinner-rotate .8s infinite linear;
            top: 50%;
            left: 0;
            position: fixed;
            left: 50%;
            right: 0;
            transform: translate(-50%);
            z-index: 1000;
        }
        @keyframes pinner-rotate{
            0%{    transform: rotate(0deg);}
            100%{transform: rotate(1turn);}
        }
    </style>
</head>
<body>
    <form method="post">
        <div class="login">
            <div class="login_text">
                <div class="login_bt">创建项目组</div>
                <div class="login_txt">
                    <p>
                        <em>项目名称：</em>
                        <input type="text" name="title"  id="title" placeholder="项目名称"/>
                    </p>
                    <p>
                        <em>选择酒店：</em>
                        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel[0]['id']); ?>"/>

                        <select disabled="disabled" name="hotel_id" id="hotel_id" style="width:47%;margin-right: 4%;display: inline-block;" class="select">

                            <option value="0">选择酒店</option>
                            <?php if(is_array($hotel)): foreach($hotel as $key=>$v): ?><option selected  value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                        </select>
                        <!-- <select   name="hotel_id" id="hotel_id" style="width:47%;margin-right: 4%;display: inline-block;" class="select">

                                <option value="0">选择酒店</option>
                                <?php if(is_array($hotel)): foreach($hotel as $key=>$v): ?><option   value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                            </select> -->
                        <select name="part_id" id="part_id" style="width:47%;display: inline-block;" class="select">
                            <option value="0">选择部门</option>
                        </select>
                    </p>
                    <p>
                        <em>工作日期：</em>
                        <input type="text" readonly name="worktime"  data-field="date" id="day"  placeholder="工作日期"/>
                    </p>
                    <p>
                        <em>上班时间：</em>
                        <input type="text" readonly name="ontime"  data-field="date"  id="time"   placeholder="上班时间"/>
                    </p>
                    <!--<p>
                                            <em>时薪：</em>
                        <input type="text" name="wage" id="wage" placeholder="时薪"/>
                    </p>-->
                    <p>
                        <em>下单人数：</em>
                        <input type="text" name="num" id="num" placeholder="下单人数"/>
                    </p>
                    <p>
                        <em>现场人数：</em>
                        <input type="text" name="total" id="total" placeholder="现场人数"/>
                    </p>
                    <p>
                        <em>选择服务员：</em>
                        <i class="inputwide2" id="waitershow">
                            <!--<label>张鑫、</label>--></i>
                        <input type="button" value="选择服务员" style="width:auto;" class="applyBtn3"/>
                    </p>
                    <!-- <p>
                                             <em>就餐休息时长：</em>
                         <select name="break" id="break" class="select">
                             <option value="">就餐休息时长</option>
                             <option value="0">0小时</option>
                             <option value="30">0.5小时</option>
                             <option value="60">1小时</option>
                             <option value="90">1.5小时</option>
                         </select>
                     </p>
                     <p>
                                             <em>上下班时间：</em>
                         <input type="text" readonly name="ontime"  data-field="date" class="inputime" id="time" placeholder="上班时间"/>
                         <span>-</span>
                         <input type="text" readonly name="offtime" data-field="date" class="inputime" id="time2" placeholder="下班时间"/>
                     </p>-->
                    <div class="login_dl">
                        <input type="hidden" name="waiter" id="waiter" />
                        <input type="submit" click="0" id="wsubmit" class="success" value="立即创建"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="find_nav_list1" style="right: -2000px; top: -2000px;">
            <a class="search_logo cloose" href="javascript:void(0);"></a>
            <h2>选择服务员</h2>
            <div class="topsearchs">
                <input class="inp_srh" name="keyboard" id="wkeyword" placeholder="姓名/手机号查找" />
                <input  class="btn_srh bx_buys" id="wsearch" type="button" value="" >
            </div>
                <ul class="clearfix"   id="waiters">
                    <div id="list-item" style="display: inline-block;">
                        <?php if(is_array($waiter)): foreach($waiter as $key=>$v): ?><li rel="<?php echo ($v["id"]); ?>" username="<?php echo ($v["username"]); ?>"><a href="#" ><p><?php echo ($v["username"]); ?></p><p><span>手机：<?php echo ($v["moble"]); ?></span></p></a></li><?php endforeach; endif; ?>
                    </div>
                </ul>
                <div class="service-btn2">
                    <a href="javascript:;" class="cloose">确认</a>
                </div>

        </div>
    </form>
    <script src="__WJ__/js/jquery-1.8.3.min.js"></script>
<script src="__WJ__/js/layer/layer.js"></script>
<script>
    var width = $()
    function err(mes) {
        layer.msg(mes, {
            area: '80%',
            offset: ['45%', '10%'],
            time: 1500,
        });
        return false;
    }
</script>
<?php if(!empty($err)): ?><script>
        $(function () {
            err('<?php echo ($err); ?>');
        });
    </script><?php endif; ?>


<script src="__WJ__/js/laydate/laydate.js"></script>
<script>
    let obj = {
        loadMore:function(params,func){
            $(params.parent).scroll(obj.throttle(function() {
                var htmlHeight = $(params.child).height();
                var clientHeight = $(params.parent).height();
                var scrollTop = $(params.parent).scrollTop();
                var he = scrollTop + clientHeight;
                console.log(he,htmlHeight)
                if (he >= htmlHeight * 0.8) {
                    func();
                }
            },500));
        },
        throttle:function(func, wait, mustRun) {
            var timeout,
                startTime = new Date();

            return function() {
                var context = this,
                    args = arguments,
                    curTime = new Date();

                clearTimeout(timeout);
                // 如果达到了规定的触发时间间隔，触发 handler
                if (curTime - startTime >= mustRun) {
                    func.apply(context, args);
                    startTime = curTime;
                    // 没达到触发间隔，重新设定定时器
                } else {
                    timeout = setTimeout(func, wait);
                }
            };
        }
    }
    var i = 2;
    var statu = false;
    obj.loadMore({
        parent:"#waiters",
        child:"#list-item"
    },function(){
        if(statu) {
            return false;
        }
        statu = true;
        let load = `<div id="" class="spinner-snake" style="z-index:10000;border-top-color: rgb(38, 162, 255); border-left-color: rgb(38, 162, 255); border-bottom-color: rgb(38, 162, 255); height: 28px; width: 28px;"></div>`;
        $('body').append(load);
        $.ajax({
            url: "<?php echo U('foremen/additem');?>",
            type: 'get',
            data: {
                page: i,
                isflag: true
            },
            success: function (data) {
                statu = false;
                i++;
                let str = '';
                let list = data.data;
                list.forEach((v,index) => {
                    str += `
                        <li rel="${v.id}" username="${v.username}">
                            <a href="#" ><p>${v.username}</p><p><span>手机：${v.moble}</span></p></a>
                        </li>`;
            });
                $('#list-item').append(str);
                $('.spinner-snake').remove();
            },
            error: function (error) {
                //alert("NETWORK ERROR!");
                layer.close(index);
                layer.msg('NETWORK ERROR!', {
                    time: 1000 //1秒关闭
                });
            },
        })
    })

    function err(mes) {
        $('#wsubmit').attr('click', 0);
        layer.msg(mes, {
            time: 1500,
        });
        return false;
    }
    $(function () {
        // $('#hotel_id').change(function () {
            var hotel_id = $('#hotel_id').val();
            console.log(hotel_id)
            var part_id = '';
            $.ajax({
                url: "<?php echo U('pub/part');?>",
                data: {hotel_id: hotel_id},
                success: function (data) {
                    $('#part_id').empty();
                    $('#part_id').append($('<option value="0">选择部门</option>'));
                    $.each(data, function (i, n) {
                        var classs = '';
                        if (n.id == part_id) {
                            classs = 'selected';
                        }
                        var li = '<option '+classs+' value="' +n.id+ '">' +n.title+ '</option>';
                        $('#part_id').append($(li));
                    });
                },
                error: function (error) {
                    alert("NETWORK ERROR!");
                },
            });
        // });
        $('#wsubmit').click(function () {
            if ($(this).attr('click') == 1) {
                return false;
            }
            $(this).attr('click', 1);
            var title = $('#title').val();
            var hotel_id = $('#hotel_id').val();
        //     console.log(hotel_id);
        // return false;
            var worktime = $('#day').val();
            var wage = $('#wage').val();
            var bbreak = $('#break').val();
            var ontime = $('#time').val();
            var offtime = $('#time2').val();
            if (title == '') {
                $(this).attr('click', 0);
                return err("项目名称不能为空！");
            }
            if (hotel_id == 0) {
                $(this).attr('click', 0);
                return err("请选择酒店！");
            }
            if (worktime == '') {
                $(this).attr('click', 0);
                return err("请选择工作日期！");
            }
            if (ontime == '') {
                $(this).attr('click', 0);
                return err("请选择上班时间！");
            }
            var num = parseInt($('#num').val());
            if (!$('#num').val() || isNaN(num)) {
                err("请填写下单人数！");
                $(this).attr('click', 0);
                return false;
            }
            var total = parseInt($('#total').val());
            if (!$('#total').val() || isNaN(total)) {
                err("请填写项目人数！");
                $(this).attr('click', 0);
                return false;
            }
            if (total > num) {
                err("下单人数需大于项目人数！");
                $(this).attr('click', 0);
                return false;
            }
            var length = $('#waitershow label').length;
            if (length > total) {
                err("选择人数超出项目人数上限！");
                $(this).attr('click', 0);
                return false;
            }
            /*var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
             if (!reg.test(wage)) {
             $(this).attr('click', 0);
             return err("请输入正确时薪！");
             }*/
            /*if (bbreak == '') {
             $(this).attr('click', 0);
             return err("请选择就餐休息时间！");
             }
             
             
             if (offtime == '') {
             $(this).attr('click', 0);
             return err("请选择下班时间！");
             }*/
            var label = $('#waitershow label');
            if (label.length == 0) {
                //$(this).attr('click', 0);
                //return err("请选择服务员！");
            }
            var waiter = '';
            $.each(label, function (ii, nn) {
                waiter = waiter + label.eq(ii).attr('wid') + ',';
            });
            // console.log(waiter);
            // console.log(1)
            // return false;
            $('#waiter').val(waiter);
        });

        $(".applyBtn3").click(
            function () {
                var total = parseInt($('#total').val());
                if (!$('#total').val() || isNaN(total)) {
                    err("请填写项目人数！");
                    return false;
                }
                $('body').css('overflow', 'hidden')
                $(".find_nav_list1").animate({'right': '0', 'top': '0px'}, 300);
            }
        );
        $(".cloose").click(
            function () {
                $('body').css('overflow', '')
                $(".find_nav_list1").animate({'right': '-2000px', 'top': '-2000px'}, 300);
            }
        );
        $('#wsearch').click(function () {
            var keyword = $('#wkeyword').val();
            $.ajax({
                url: "<?php echo U('pub/waiter');?>",
                data: {keyword: keyword},
                success: function (data) {
                    var label = $('#waitershow label');
                    $('.find_nav_list1 ul').empty();
                    $.each(data, function (i, n) {
                        var classs = '';
                        $.each(label, function (ii, nn) {
                            if (n.id == label.eq(ii).attr('wid')) {
                                classs = 'find_nav_cur';
                            }
                        });
                        var li = '<li class="' + classs + '" rel="' + n.id + '" username="' + n.username + '"><a href="#" ><p>' + n.username + '</p><p><span>手机：' + n.moble + '</span></p></a></li>';
                        $('.find_nav_list1 ul').append($(li));
                    });
                },
                error: function (error) {
                    alert("NETWORK ERROR!");
                },
            });
        });
        //服务员选择
        $('.find_nav_list1 ul').on('click', 'li', function () {
            var length = $('#waitershow label').length;
            var total = parseInt($('#total').val());
            if (!$('#total').val() || isNaN(total)) {
                err("请填写项目人数！");
                return false;
            }
			//var h = $(window).height() - 170;
            //$('.find_nav_list1 ul').css({height: h + 'px'});

            var id = $(this).attr('rel');
            var username = $(this).attr('username');
            if ($(this).hasClass('find_nav_cur')) {
                $(this).removeClass("find_nav_cur");
                $('#waitershow').find("label[wid=" + id + "]").remove();
            } else {
                if (length == total) {
                    err("选择人数已达项目人数上限！");
                    return false;
                }
                $(this).addClass("find_nav_cur");
                //waitershow
                var label = '<label wid="' + id + '">' + username + '、</label>';
                $('#waitershow').append($(label));
            }
            var length = $('#waitershow label').length;
            if (length == 0) {
                $('.applyBtn3').val("选择服务员");
            } else {
                $('.applyBtn3').val("已选择" + length + "个服务员");

            }
            return false;
        });
    });
</script>
<script>;
    laydate.render({
        elem: '#day'
    });
    laydate.render({
        elem: '#time'
        , type: 'datetime'
    });
    laydate.render({
        elem: '#time2'
        , type: 'datetime'
    });
   /* $(function () {
        var h = $(window).height() - 170;
        $('.find_nav_list1 ul').css({height: h + 'px'});
    });
    $(window).resize(function () {
        var h = $(window).height() - 170;
        $('.find_nav_list1 ul').css({height: h + 'px'});
    });
*/
</script>

</body>
</html>