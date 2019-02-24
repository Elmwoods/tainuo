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
    <div class="login">
        <div class="login_text">
            <div class="login_bt"><?php echo ($waiter["username"]); ?></div>
            <form method="post">
                <div class="login_txt">
                    <p>
                        <em>工作日期：</em>
                        <input type="text" readonly name="worktime" value="<?php echo ($show["worktime"]); ?>" data-field="date" id="day"  placeholder="工作日期"/>
                    </p>
                    <p>
                        <em>时薪：</em>
                        <!-- <input type="text" readonly='readonly' name="wage" value="<?php echo ($show["wage"]); ?>" id='wage'  placeholder="时薪"/> -->
                        <input type="text" readonly='readonly' name="" value="<?php echo ($show["wage"]); ?>" id='wage'  placeholder="时薪"/>
                    </p>
                    <p>
                        <em>工服归还：</em>
                        <select class="select" name="clothes">
                            <option>工服归还</option>
                            <option value="1" <?php if($show['clothes'] == 1): ?>selected<?php endif; ?> value="1" >是</option>
                            <option value="0" <?php if($show['clothes'] == 0): ?>selected<?php endif; ?> value="0" >否</option>
                        </select>
                    </p>
                    <p>
                        <em>就餐休息时长：</em>
                        <select class="select" id="break" name="break">
                            <option>就餐休息时长</option>
                            <option value="0" <?php if($show['break'] == 0): ?>selected<?php endif; ?> >0小时</option>
                            <option value="30" <?php if($show['break'] == 30): ?>selected<?php endif; ?> >0.5小时</option>
                            <option value="60" <?php if($show['break'] == 60): ?>selected<?php endif; ?> >1小时</option>
                            <option value="90" <?php if($show['break'] == 90): ?>selected<?php endif; ?> >1.5小时</option>
                        </select>
                    </p>
                    <p>
                        <em>上下班时间：</em>
                        <input type="text" readonly name="ontime" value="<?php echo strtotime($show['ontime'])?date('Y-m-d H:i:s',strtotime($show['ontime'])):date('Y-m-d 00:00:00');?>" data-field="date" class="inputime" id="time" placeholder="上班时间"/>
                        <span>-</span>
                        <input type="text" readonly name="offtime" value="<?php echo strtotime($show['offtime'])?date('Y-m-d H:i:s',strtotime($show['offtime'])):date('Y-m-d 00:00:00');?>" data-field="date" class="inputime" id="time2" placeholder="下班时间"/>
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
                        <em>工时：</em>
                        <input type="text" name="" value="<?php echo (($show["hours"])?($show["hours"]):0); ?>" readonly="readonly" id='hours'  placeholder="时薪"/>
                    </p>
                    <p>
                        <em>工资：</em>
                        <input type="text" name="" value="<?php echo (($show["reward"])?($show["reward"]):0); ?>" readonly="readonly" id='rewards'  placeholder="时薪"/>
                    </p>
                    <p>
                        <em>是否确认：</em>
                        <select class="select select2" name="is_con">
                            <option value="1" <?php if($show['is_con'] == 1): ?>selected<?php endif; ?>>是</option>
                            <option value="0" <?php if($show['is_con'] == 0): ?>selected<?php endif; ?>>否</option>
                        </select>
                    </p>
                    <?php if($show['status'] == 0): ?><div class="login_dl">
                            <input type="submit" class="success" value="确认修改"/>
                        </div><?php endif; ?>
                </div>
            </form>

        </div>
    </div>
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

    function newDate(strdate) {
        var arr = strdate.split(/[- : \/]/);
        date = new Date(arr[0], arr[1] - 1, arr[2], arr[3], arr[4], arr[5]);
        return date;
    }
    function cala() {
        var ontime = $('#time').val();
        var offtime = $('#time2').val();
        var breaktime = $('#break').val();
        var wage = parseFloat($('#wage').val());

        if (!offtime || !ontime) {
            $('#hours').val(0);
            $('#rewards').val(0);
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
            $('#rewards').val(0);
            return false;
        }

        var h = (e - s) / (60 * 60) - breaktime / 60;
        h = h.toFixed(2);
        $('#hours').val(h);
        if (!wage) {
            $('#rewards').val(0);
            return false;
        }
        var reward = h * wage;

        $('#rewards').val(reward);
    }
    laydate.render({
        elem: '#day'
    });
    laydate.render({
        elem: '#time'
        , type: 'datetime'
        , done: function (value, date, endDate) {
            //cala();
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
$(function(){
    let init_time = "<?php echo strtotime($show['ontime'])?date('Y-m-d H:i:s',strtotime($show['ontime'])):date('Y-m-d 00:00:00');?>";
    if(init_time){
        let time = new Date(init_time).getHours();
        if(time == 0){
            $('#break').val(0)
        }else{
            $('#break').val(time < 11 ? '60' : 30)
        }
    }
});
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


    $('.success').on('click', function () {
        var worktime = $('#day').val();
        // var wage = $('#wage').val();
        var paymoney = $('#paymoney').val();
        var ontime = $('#time').val();
        var offtime = $('#time2').val();

        if (worktime == '') {
            return err("请选择工作日期！");
        }
        var reg1 = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;

        var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
        // if (!reg.test(wage)) {
        //     return err("请输入正确时薪！");
        // }
        if (!reg1.test(paymoney)) {
            return err("请输入正确支付金额！");
        }
        if (ontime == '') {
            return err("请选择上班时间！");
        }
        if (offtime == '') {
            return err("请选择下班时间！");
        }
    });
</script>
</body>
</html>