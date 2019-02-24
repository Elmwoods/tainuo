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
        .topsearchs p {
            font-family: "微软雅黑";
        }
        .foreman-service ul li{height:auto;}
        .foreman-service ul li .list { width:calc(100% - 30px); float:left;/*background: url(__WJ__/images/jt.png) no-repeat right 15px;*/background-size: 20px; position: relative;}
        .foreman-service ul li p{width: 100%;padding-right: 25px;border-bottom: solid 1px #ccc;float: none;padding-bottom: 5px;height: 45px;}
        .foreman-service ul li label { float:left; display:block; width:30px; height:50px;}
        .foreman-service ul li label .input-del { width:15px; height:15px; border:1px solid #ccc; margin-top:16px;}
        .service-btn a {background: #0cb9f3 none repeat scroll 0 0;border-radius: 8px;color: #fff;display: block;font-family: "微软雅黑";font-size: 12px;height: 40px;line-height: 40px;margin: 10px auto;text-align: center;width: 90%;}
        .xz-wan{text-align: right;padding: 5px 25px 10px 0px;}
        .xz-wan span{display: inline-block;padding: 0 6px;background: #0cb9f3;color:#fff;font-size: 12px;height: 26px;line-height: 26px;border-radius: 5px;margin-left: 10px; }
    </style>
</head>
<body>
    <div class="foreman-service" style=" margin-bottom:20px;">
        <h1><?php echo ($subject["title"]); ?></h1>
        <form method="" >
            <div class="topsearchs" class="clearfix" style="height:auto;">
                <p class="clearfix" style="margin-bottom: 10px;margin-top: 5px;">
                    <input type="text" class="form-control"  name="keyboard" value="<?php echo ($keyboard); ?>"  style="width: 100%;"  placeholder="姓名/手机号查找"/>
                </p>   
                <p class="clearfix"  style="margin-bottom: 10px;">
                    <select name="status" id='status' style="width:65%;float: left;margin-right: 5%"  class="form-control" >
                        <option value="0">选择状态</option>
                        <option value="1" <?php if($status == 1): ?>selected<?php endif; ?>>未确认</option>
                        <option value="2" <?php if($status == 2): ?>selected<?php endif; ?>>已确认</option>
                        <option value="3" <?php if($status == 3): ?>selected<?php endif; ?>>已发放工资</option>
                    </select>
                    <button type="submit" style="width:30%;float: left;margin-bottom: 10px;" class="btn btn-default">搜索</button>
                    <button type="button" style="width:100%;" class="btn btn-default allselected">全选</button>
                </p> 
            </div>
        </form>
        <form method="" id="deletef" action="<?php echo U('foremen/deleteitem');?>">
            <input name="subject_id" value="<?php echo ($subject["id"]); ?>" type="hidden"/>
            <ul class="clearfix">
                <?php if(is_array($list)): foreach($list as $key=>$v): ?><li class="clearfix">
                        <label><input class="input-del" name="id[]" value="<?php echo ($v["id"]); ?>" type="checkbox" style="-webkit-appearance: checkbox;"/></label>
                        <!---->
                            <div  class="list" >
                            <p class="clearfix">
                                <em><span><?php echo ($key+1); ?>、<?php echo ($v["wait"]["username"]); ?></span><a href="tel:<?php echo (hour_clear($v["wage"])); ?>"><?php echo ($v["wait"]["moble"]); ?></a></em>
                                <em><span>时薪</span><span><?php echo (hour_clear($v["wage"])); ?></span></em>
                                <em><span>工时</span><span><?php echo (hour_clear($v["hours"])); ?></span></em>
                                <em><span>工资</span><span><?php echo (hour_clear($v["reward"])); ?></span></em>
                                <a href="<?php echo U('foremen/fshow',array('id'=>$v['id']));?>"><img style="position: absolute;right: 0;top: -1px;" src="http://tainuo.cn/test/webfile/wap/images/jt.png" /></a>
                                <!--<?php if($v['is_con'] == 1): ?><i>已确认</i><?php endif; ?>-->
                            </p>
                            <div class="xz-wan clearfix" style="    width: 100%;    display: flex;    justify-content: space-around;">
                                <?php if($v['status'] == 1): ?><span>工资已发放</span><?php endif; ?>
                                <?php if($v['status'] == 2): ?><span>工资部分发放失败</span><?php endif; ?>
                                <?php if($v['is_con'] == 1): ?><span>考勤已确认</span><?php endif; ?>
                                <?php if($v['receive_price'] != 0): ?><span>已领取<?php echo ($v['receive_price']); ?>元</span><?php endif; ?>
                            </div>
                            <!--<img src="__WJ__/images/jt.png"/>-->
                            </div>
                    </li><?php endforeach; endif; ?>
            </ul>
        </form>
    </div>
    <!--<?php echo U('foremen/changeitem',array('id'=>$subject['id']));?>-->
    <div class="service-btn">
        <a id="deleteBtn" style="width:20%;margin-left:3%;margin-right: 0;display: inline-block;" href="#">删除选择</a>
        <a style='width:20%;margin-left:3%;margin-right: 0;display: inline-block;' id="changeall" href="<?php echo U('foremen/changeall',array('id'=>$subject['id']));?>">批量编辑</a>
        <a style='width:20%;margin-left:3%;margin-right: 0;display: inline-block;' id="send"  href="<?php echo U('foremen/wage',array('id'=>$subject['id']));?>">发放工资</a>
        <a style='display: inline-block;width:20%; margin-left:3%;' href="<?php echo U('/foremen');?>">返回</a></div>
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


<script>
    $(document).ready(function () {
        $('.allselected').click(function(){
            var a = $(this);
            if(a.text() == "全选"){
                a.text("全不选");
                $('.input-del').attr('checked',true);
            }else{
                a.text("全选");
                $('.input-del').removeAttr('checked');
            }
        });
        $('#deleteBtn').click(function () {
            var length = $('.input-del:checked').length;
            if (length == 0) {
                return false;
            }
            if (window.confirm("确定删除选择项么？")) {
                $('#deletef').attr("action", "<?php echo U('foremen/deleteitem');?>");
                $('#deletef').submit();
            }
            return false;
        });
        $('#send').click(function () {
            var length = $('.input-del:checked').length;
            if (length == 0) {
                return false;
            }
            if (window.confirm("确认将选中项发放工资？")) {
                $('#deletef').attr("action", "<?php echo U('foremen/wage');?>");
                $('#deletef').submit();
            }
            return false;
        });
        $('#conBtn').click(function () {
            var length = $('.input-del:checked').length;
            if (length == 0) {
                return false;
            }
            if (window.confirm("是否确认？")) {
                $('#deletef').attr("action", "<?php echo U('foremen/confirm');?>");
                $('#deletef').submit();
            }
            return false;
        });
        $('#changeall').click(function () {
            var length = $('.input-del:checked').length;
            if (length == 0) {
                return false;
            }
            $('#deletef').attr("action", "<?php echo U('foremen/changeall');?>");
            $('#deletef').submit();
            return false;
        });
        var pmH = $(window).height() - 85;
        $(".foreman-service ul").height(pmH);
    });
</script>
</body>
</html>