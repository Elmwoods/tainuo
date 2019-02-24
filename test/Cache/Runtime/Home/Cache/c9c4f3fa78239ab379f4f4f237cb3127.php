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
</head>
<body>
    <form method="post">
        <div class="login">
            <div class="login_text">
                <div class="login_bt">批量编辑</div>
                <div class="login_txt">
                     <!-- 20190203 注释 -->
                    <!-- <p>
                        <em>时薪：</em>
                        <input type="text" name="wage" id="wage" placeholder="时薪"/>
                    </p> -->

                    <p>
                        <em>就餐休息时长：</em>
                        <select name="break" id="break" class="select" >
                            <option value="">就餐休息时长</option>
                            <option value="0">0小时</option>
                            <option value="30">0.5小时</option>
                            <option value="60">1小时</option>
                            <option value="90">1.5小时</option>
                        </select>
                    </p>
                    <p>
                        <em>工服归还：</em>
                        <select class="select" name="clothes">
                            <option>工服归还</option>
                            <option value="1" selected value="1" >是</option>
                            <option value="0" <?php if($show['clothes'] == 0): ?>selected<?php endif; ?> value="0" >否</option>
                        </select>
                    </p>
                    <p>
                        <em>现场支付：</em>
                        <select class="select select2" name="pay">
                            <option>现场支付</option>
                            <option value="1" <?php if($show['pay'] == 1): ?>selected<?php endif; ?>>是</option>
                            <option value="0" <?php if($show['pay'] == 0): ?>selected<?php endif; ?>>否</option>
                        </select>
                        <input type="text" name="paymoney" id="paymoney" value="<?php echo ($show["paymoney"]); ?>" class="inputime"  placeholder="支付金额" />
                    </p>
                    <p>
                        <em>上下班时间：</em>
                        <input type="text" readonly name="ontime"  data-field="date" value="<?php echo ($subject["ontime"]); ?>" class="inputime" id="time" placeholder="上班时间"/>
                        <span>-</span>
                        <input type="text" readonly name="offtime" data-field="date" class="inputime" id="time2" placeholder="下班时间"/>
                    </p>
                    <p>
                        <em>工时：</em>
                        <input type="text" name="hours" value="<?php echo (($show["hours"])?($show["hours"]):0); ?>" readonly="readonly" id='hours'  placeholder="时薪"/>
                    </p>
                    <!-- <p>
                        <em>工资：</em>
                        <input type="text" name="" value="<?php echo (($show["reward"])?($show["reward"]):0); ?>" readonly="readonly" id='rewards'  placeholder="时薪"/>
                    </p> -->
                    <p>
                        <em>选择服务员：</em>
                        <i class="inputwide2" id="waitershow">
                            <!--<label>张鑫、</label>--></i>
                        <input type="button" value="选择服务员" style="width:auto;" class="applyBtn3"/>
                    </p>
                    <p>
                        <em>是否确认：</em>
                        <select class="select select2" name="is_con">
                            <option value="1" <?php if($show['is_con'] == 1): ?>selected<?php endif; ?>>是</option>
                            <option value="0" <?php if($show['is_con'] == 0): ?>selected<?php endif; ?>>否</option>
                        </select>
                    </p>
                    <div class="login_dl">
                        <input type="hidden" name="id" id="waiter" />
                        <input type="hidden" name="subject_id" value="<?php echo ($subject["id"]); ?>" id="subject_id" />
                        <input type="submit" click="0" id="wsubmit" class="success" value="确认修改"/>
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
            <ul class="clearfix" id="waiters">	  
                <?php if(is_array($item)): foreach($item as $key=>$v): ?><li rel="<?php echo ($v["id"]); ?>" username="<?php echo ($v["wait"]["username"]); ?>"><a href="#" ><p><?php echo ($v["wait"]["username"]); ?></p><p><span>手机：<?php echo ($v["wait"]["moble"]); ?></span></p></a></li><?php endforeach; endif; ?>
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
<script>;
    function newDate(strdate) {
        var arr = strdate.split(/[- : \/]/);
        date = new Date(arr[0], arr[1] - 1, arr[2], arr[3], arr[4], arr[5]);
        return date;
    }
    function cala() {
        var ontime = $('#time').val();
        var offtime = $('#time2').val();
        var breaktime = $('#break').val();
        // var wage = parseFloat($('#wage').val());   // 20190203 注释
        if (!offtime || !ontime) {
            $('#hours').val(0);
            // $('#rewards').val(0);  // 20190203 注释
            return false;
        }
        //var s = parseInt(Date.parse(new Date(ontime)) / 1000);
        //var e = parseInt(Date.parse(new Date(offtime)) / 1000);
        var s = newDate(ontime);
        var e = newDate(offtime);
        s = s.getTime() / 1000;
        e = e.getTime() / 1000;
        if (e <= s) {
            $('#hours').val(0);
            // $('#rewards').val(0);  // 20190203 注释
            return false;
        }

        var h = (e - s) / (60 * 60) - breaktime / 60;
        h = h.toFixed(2);
        // var reward = h * wage;   // 20190203 注释
        $('#hours').val(h);
        // if (!wage) {
        //     $('#rewards').val(0);
        //     return false;
        // }
        // $('#rewards').val(reward);
    }
    laydate.render({
        elem: '#day'
    });
    laydate.render({
        elem: '#time'
        , type: 'datetime'
        , done: function (value, date, endDate) {
            let time = new Date(value).getHours();
            if(time == 0){
                $('#break').val(0)
            }else{
                $('#break').val(time < 11 ? '60' : 30)
            }
            
            $('#time').trigger('change');
        }
    });
    laydate.render({
        elem: '#time2'
        , type: 'datetime'
        , done: function (value, date, endDate) {
            //cala();
            $('#time2').trigger('change');
        }
    });
</script>
<script>
    $(function () {
        // 20190223
        let init_time = '<?php echo ($subject["ontime"]); ?>';
        if(init_time){
            let time = new Date(init_time).getHours();
            if(time == 0){
                $('#break').val(0)
            }else{
                $('#break').val(time < 11 ? '60' : 30)
            }
        }


        var checklist = '<?php echo json_encode($check);?>';
        if (checklist) {
            checklist = JSON.parse(checklist);
            var li = $('.find_nav_list1 ul li');
            $.each(li, function (i, n) {
                var rel = li.eq(i).attr('rel');
                console.log(checklist,checklist.indexOf(rel),rel)

                if (checklist.indexOf(rel) != -1) {
                    li.eq(i).trigger('click');
                }
            });
        }
        var h = $(window).height() - 170;
        $('.find_nav_list1 ul').css({height: h + 'px'});
    });
    $(window).resize(function () {
        var h = $(window).height() - 170;
        $('.find_nav_list1 ul').css({height: h + 'px'});
    });
    $('#wsearch').click(function () {
        var keyword = $('#wkeyword').val();
        var subject_id = '<?php echo ($subject["id"]); ?>';
        $.ajax({
            url: "<?php echo U('pub/iwaiter');?>",
            data: {keyword: keyword, id: subject_id},
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
        var id = $(this).attr('rel');
        var username = $(this).attr('username');
        if ($(this).hasClass('find_nav_cur')) {
            $(this).removeClass("find_nav_cur");
            $('#waitershow').find("label[wid=" + id + "]").remove();
        } else {
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
    $(".applyBtn3").click(
            function () {
                $(".find_nav_list1").animate({'right': '0', 'top': '0px'}, 300);
            }
    );
    $(".cloose").click(
            function () {
                $(".find_nav_list1").animate({'right': '-2000px', 'top': '-2000px'}, 300);
            }
    );
    // $('#wage').keyup(function () {
    //     cala();
    // });
    $('#time').change(function () {
        setTimeout("cala()", 1000);
        //cala();
    });
    $('#time2').change(function () {
        setTimeout("cala()", 1000);

        //cala();
    });
    $('#break').change(function () {
        cala();
    });

    function accMul(arg1, arg2) {
        var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
        try {
            m += s1.split(".")[1].length
        } catch (e) {
        }
        try {
            m += s2.split(".")[1].length
        } catch (e) {
        }
        return  Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
    }
    $('.success').on('click', function () {
        var worktime = $('#day').val();
        // var wage = $('#wage').val();  // 20190203 注释
        var ontime = $('#time').val();
        var offtime = $('#time2').val();

        if (worktime == '') {
            return err("请选择工作日期！");
        }
        var reg1 = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;

        var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
        // if (!reg.test(wage)) {   // 20190203 注释
        //     return err("请输入正确时薪！");
        // }

        if (ontime == '') {
            return err("请选择上班时间！");
        }
        if (offtime == '') {
            return err("请选择下班时间！");
        }
        var label = $('#waitershow label');
        if (label.length == 0) {
            $(this).attr('click', 0);
            return err("请选择服务员！");
        }
        var waiter = '';
        $.each(label, function (ii, nn) {
            waiter = waiter + label.eq(ii).attr('wid') + ',';
        });

        $('#waiter').val(waiter);
    });
</script>

</body>
</html>