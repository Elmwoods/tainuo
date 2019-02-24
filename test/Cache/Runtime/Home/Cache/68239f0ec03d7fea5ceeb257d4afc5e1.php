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
    <div class="wx clearfix">
        <div class="wx-tab"></a></div>
        <div class="wx-text"> <i><img src="<?php echo ($waiter["headimgurl"]); ?>"></i>
            <p><?php echo ($waiter["username"]); ?></p>
            <h2><?php echo ($waiter["moble"]); ?></h2>
        </div>
    </div>
    <form method="" >
        <div class="foreman-list">
            <h1>兼职项目</h1>
            <ul class="clearfix">
                <form>
                    <li>
                        <p class="clearfix"  style="margin-bottom: 10px;margin-top: 5px;">
                            <span  class="clearfix">
                                <input type="text" class="form-control" readonly name="start" value="<?php echo ($start); ?>" data-field="date" id="time1" style="width: 45%;float: left;"  placeholder="开始时间"/>
                                <em style="width: 10%;float: left;text-align: center;">-</em>
                                <input type="text" class="form-control" readonly name="end" value="<?php echo ($end); ?>" data-field="date" id="time2" style="width: 45%;float: left;" placeholder="结束时间"/>
                            </span>
                        </p>   
                        <p class="clearfix"  style="margin-bottom: 10px;">
                            <span class="clearfix">
                                <select name="hotel_id" id='hotel_id' style="width:47%;float: left;margin-right: 6%"  class="form-control" >
                                    <option value="0">选择酒店</option>
                                    <?php if(is_array($hotel)): foreach($hotel as $key=>$v): ?><option <?php if($v['id'] == $hotel_id): ?>selected<?php endif; ?> value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                                </select>
                                <select name="part_id" id='part_id' style="width:47%;float: left;"  class="form-control" >
                                    <option value="0">选择部门</option>
                                </select>
                            </span>
                        </p> 
                        <p class="clearfix"  style="margin-bottom: 10px;">
                            <button type="submit" style="width:100%;" class="btn btn-default">搜索</button>
                        </p>
                    </li>
                </form>
                <?php if(is_array($subject)): foreach($subject as $key=>$v): ?><li>
                        <h2><?php echo ($v["title"]); ?></h2>
                        <p>工作日期：<span><?php echo ($v["worktime"]); ?></span></p>                   
                        <p>地&emsp;&emsp;点：<span><?php echo ($v["hotel"]["title"]); ?></span></p>
                    <?php if($v['part']): ?><p>部&emsp;&emsp;门：<span><?php echo ($v["part"]["title"]); ?></span></p><?php endif; ?>
                    <div><a href="<?php echo U('index/join',array('id'=>$v['id']));?>"><img src="__WJ__/images/jr.png"/>加入</a></div>
                    </li><?php endforeach; endif; ?>

                <i <?php if(!empty($subject)): ?>style="display:none;"<?php endif; ?>>暂无兼职项目</i>
            </ul>
        </div>

        <div class="service-btn"><a href="<?php echo U('index/record');?>">查看我的兼职</a></div>
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
            laydate.render({
                elem: '#time1'
            });
            laydate.render({
                elem: '#time2'
            });
        </script>
        <script>
            $(document).ready(function () {
                var pmH = $(window).height() - 125;
                $(".foreman-list ul").height(pmH);

                $('#hotel_id').change(function () {
                    var hotel_id = $('#hotel_id').val();
                    var part_id = '<?php echo ($part_id); ?>';
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
                                var li = '<option ' + classs + ' value="' + n.id + '">' + n.title + '</option>';
                                $('#part_id').append($(li));
                            });
                        },
                        error: function (error) {
                            alert("NETWORK ERROR!");
                        },
                    });
                });
                $('#hotel_id').trigger('change');
            });
        </script>
</body>
</html>