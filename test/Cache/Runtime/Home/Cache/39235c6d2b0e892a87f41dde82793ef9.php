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
    <div class="wx clearfix">
        <div class="wx-tab"><a href="<?php echo U('foremen/bd');?>"><img src="__WJ__/images/mu1.png"></a></div>
        <div class="wx-text"> <i><img src="<?php echo ($user["headimgurl"]); ?>"></i>
            <p><?php echo ($user["nickname"]); ?>,当前余额<?php echo ($user["discount"]); ?>元</p>
            <h2>领班</h2><h2><a href="<?php echo U('auth/logout');?>">退出</a></h2>
        </div>
    </div>
    <div class="foreman-list" id="">

        <h1>我的项目组</h1>
        <ul class="clearfix" id="list">
            <form>
                <li>

                    <p class="clearfix" style="margin-bottom: 10px;margin-top: 5px;">
                        <span class="clearfix">
                            <input type="text" class="form-control" readonly name="start" value="<?php echo ($start); ?>" data-field="date" id="time1" style="width: 47%;float: left;"  placeholder="开始时间"/>
                            <em style="width: 6%;float: left;text-align: center;">-</em>
                            <input type="text" class="form-control" readonly name="end" value="<?php echo ($end); ?>" data-field="date" id="time2" style="width: 47%;float: left;" placeholder="结束时间"/>
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
                    <p class="clearfix"  style="margin-bottom: 10px;" >
                        <button class="btn btn-primary" type="button" style="background-color: #0cb9f3; border-color: #0cb9f3;margin-right: 5px;">
                            项目数量<span class="badge"><?php echo ($info["times"]); ?></span>
                        </button>
                        <button class="btn btn-primary" type="button" style="background-color: #0cb9f3; border-color: #0cb9f3;margin-right: 5px;">
                            总工时<span class="badge"><?php echo (hour_clear($info["hourss"])); ?></span>
                        </button>
                        <button class="btn btn-primary" type="button" style="background-color: #0cb9f3; border-color: #0cb9f3;margin-right: 5px;">
                            总工资<span class="badge"><?php echo (hour_clear($info["rewards"])); ?></span>
                        </button>
                    </p>
                </li>
            </form>
            <div id="list-item">
                <?php if(is_array($subject)): foreach($subject as $key=>$v): ?><li>
                        <h2  ><?php echo ($v["title"]); ?></h2>
                        <p>工作日期：<span><?php echo ($v["worktime"]); ?></span></p>
                        <p>地&emsp;&emsp;点：<span><?php echo ($v["hotel"]["title"]); ?></span></p>
                        <?php if($v['part']): ?><p>部&emsp;&emsp;门：<span><?php echo ($v["part"]["title"]); ?></span></p><?php endif; ?>
                        <p>领班提成：<span><?php echo (hour_clear(($v["rebate"])?($v["rebate"]):0)); ?>元</span></p>
                        <p>总工时：<span><?php echo (hour_clear(($v["hours"])?($v["hours"]):0)); ?>小时</span></p>
                        <p>总薪资：<span><?php echo (hour_clear(($v["reward"])?($v["reward"]):0)); ?>元</span></p>
                        <p>下单人数：<span><?php echo (($v["num"])?($v["num"]):0); ?>人</span></p>
                        <p>现场人数：<span><?php echo (($v["total"])?($v["total"]):0); ?>人</span></p>
                        <p>项目人数：<span><?php echo (($v["sl"])?($v["sl"]):0); ?>人</span></p>
                        <p>考勤人数：<span><?php echo (($v["kq_sl"])?($v["kq_sl"]):0); ?>人</span></p>
                        <?php if($v['passed'] == 1): ?><div><a href="javascript:void(0);" class="qrcode-back" data-title="<?php echo ($v["title"]); ?>" data-id="<?php echo ($v["id"]); ?>">分享</a>
                                <a href="<?php echo U('foremen/dc',array('id'=>$v['id']));?>" ><img src="__WJ__/images/dc.png"/>导出</a><a href="<?php echo U('foremen/changeitem',array('id'=>$v['id']));?>" ><img src="__WJ__/images/edi.png"/>编辑</a><!--<a href="javascript:;" class="remove" rid="<?php echo ($v["id"]); ?>"><img src="__WJ__/images/del.png"/>解除组</a>--><a href="<?php echo U('foremen/flist',array('id'=>$v['id']));?>"><img src="__WJ__/images/ment.png"/>管理</a></div>
                            <?php else: ?>
                            <div><a >项目未审核</a></div><?php endif; ?>
                    </li><?php endforeach; endif; ?>
            </div>
            <i <?php if(!empty($subject)): ?>style="display:none;"<?php endif; ?>>暂无项目组</i>
        </ul>
    </div>
    <div id="html_canvas" style="left:100%;position:fixed;top: 0; background:#fff;width:250px;height:300px;display:flex;flex-flow:column;align-items:center;padding-top:10px;margin-bottom: 10px;">

        <div style="display:flex;align-items:center;margin-bottom: 5px;"><img src="__WJ__/images/logo.jpg" style="width:25px; height:25px;"/>《泰诺日结》</div>
        <p style="text-align:center;font-size:12px;margin-bottom: 5px;">欢迎您加入</p >
        <p  style="text-align:center;margin:0px;margin-bottom:10px;margin-bottom: 5px;" id="alert_title">${title}</p >
        <div style="background:#fff;padding:10px;position:relative;box-shadow:1px 1px 5px #ddd;">
            <div id="qrcode"style="width:150px;height:150px;">

            </div>
            <img src="__WJ__/images/logo.jpg" style="width:30px;height:30px;position:absolute;top:0;left:0;bottom:0;right:0;margin:auto;"/>
        </div>
        <p style="font-size:12px;margin-top:5px;">扫描二维码，加入项目</p >
        <p style="font-size:12px;margin-top:5px;">咨询热线:0755-23614773 咨询微信:T-NO666</p >
        <div id="html_canvas1"></div>
    </div>
    <div class="service-btn"><a href="<?php echo U('foremen/additem');?>">创建项目组</a></div>

    <script type="text/javascript" src="__WJ__/js/qrcode.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

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


<script src="__WJ__/js/html2canvas.min.js"></script>
<script src="__WJ__/js/laydate/laydate.js"></script>
<script>
    $('.qrcode-back').click(function () {
        var title = $(this).data('title');
        //页面层
//        let name_time = title
        /*
            <div id="html_canvas" style="background: #f1f0f0;width: 200px;height: 200px;display: flex;flex-flow: column;align-items: center;">
            <p id="" style="text-align: center;margin: 15px;">${title}</p>
            <div id="qrcode" style="width: 100px;height: 100px;"></div>
            </div>
*/

        let str = `<div id="html_canvas" style="background:#fff;width:250px;height:300px;display:flex;flex-flow:column;align-items:center;padding-top:10px;margin-bottom: 10px;">

        <div style="display:flex;align-items:center;margin-bottom: 5px;"><img src="__WJ__/images/logo.jpg" style="width:25px; height:25px;"/>《泰诺日结》</div>
        <p style="text-align:center;font-size:12px;margin-bottom: 5px;">欢迎您加入</p >
        <p  style="text-align:center;margin:0px;margin-bottom:10px;margin-bottom: 5px;">${title}</p >
        <div style="background:#fff;padding:10px;position:relative;box-shadow:1px 1px 5px #ddd;">
        <div id="qrcode"style="width:150px;height:150px;">

</div>
        <img src="__WJ__/images/logo.jpg" style="width:30px;height:30px;position:absolute;top:0;left:0;bottom:0;right:0;margin:auto;"/>
        </div>
        <p style="font-size:12px;margin-top:5px;">扫描二维码，加入项目</p >
        <p style="font-size:12px;margin-top:5px;">咨询热线:0755-23614773 <咨询></咨询>微信:T-NO666</p >
    </div>`;

        var id = $(this).data('id');
        var domain = document.domain;
        var url = "http://" + domain + "/test/wz.php/index_join_id_" + id;
        $('#alert_title').text(title);
        $('#qrcode').html("")
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 150,
            height : 150,
            text: url,
//                  text: "http://baidu.com"
        });
        html2canvas(document.getElementById("html_canvas")).then(function(canvas) {
            $(canvas).css({'width':'250px','height':'250px'});
            var img = canvas.toDataURL()
//            $("#html_canvas").html(`<img src="${img}" id="image" style="width: 150px;height:150px" />`);
            layer.open({
                title:"二维码",
                type: 1,
                isOutAnim:true,
                skin: 'layui-layer-rim', //加上边框
//            area: ['250px', '250px'], //宽高
                content: `<img src="${img}" id="image" style="width: 250px;height:300px" />` || str,

            });
            //            $("#html_canvas1").html(canvas);
            //            $("#html_canvas").append(canvas);  //这里是直接
            //			            document.body.appendChild(canvas);
        })

        laydate.render({
            elem: '#time1'
        });
        laydate.render({
            elem: '#time2'
        });
//        console.log(id);
//        console.log(url);
    });


</script>
<script>
    let obj = {
        loadMore:function(params,func){
            $(params.parent).scroll(throttle(function() {
                var htmlHeight = $(params.child).height();
                var clientHeight = $(params.parent).height();
                var scrollTop = $(params.parent).scrollTop();
                var he = scrollTop + clientHeight;
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
        parent:"#list",
        child:"#list-item"
    },function(){
        if(statu) {
            return false;
        }
        statu = true;
        let load = `<div id="" class="spinner-snake" style="border-top-color: rgb(38, 162, 255); border-left-color: rgb(38, 162, 255); border-bottom-color: rgb(38, 162, 255); height: 28px; width: 28px;"></div>`;
        $('body').append(load);
        $.ajax({
            url: "<?php echo U('foremen/index');?>",
            type: 'get',
            data: {
                page: i,
                isflag: true,
                hotel_id: $('#hotel_id').val(),
                start: $("input[name='start']").val(),
                end: $("input[name='end']").val(),
                part_id: $("#part_id option:selected").val()
            },
            success: function (data) {
                statu = false;
                i++;
                let str = '';
                let list = data.data;
                if(list == null || list == '')
                {
                    $('.spinner-snake').remove();
                    layer.msg('暂无更多数据!', {
                        time: 1000 //1秒关闭
                    });
                    return false;
                }
                list.forEach((v,index) => {
                    str += `<li>
                        <h2>${v.title}</h2>
                        <p>工作日期：<span>${v.worktime}</span></p>
                        <p>地&emsp;&emsp;点：<span>${v.hotel.title}</span></p>
                            ${getPart(v.part)}
                        <p>领班提成：<span>${v.rebate|| 0}元</span></p>
                        <p>总工时：<span>${v.hours|| 0}小时</span></p>
                        <p>总薪资：<span>${v.reward|| 0}元</span></p>
                        <p>下单人数：<span>${v.num|| 0}人</span></p>
                        <p>现场人数：<span>${v.total|| 0}人</span></p>
                        <p>项目人数：<span>${v.sl|| 0}人</span></p>
                        <p>考勤人数：<span>${v.kq_sl|| 0}人</span></p>
                           ${getPassed(v.passed)}
                    </li>
`;
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


    function getPart(part){
        return part ? `<p>部&emsp;&emsp;门：<span>${part.title}</span></p>` : '';
    }

    function getPassed(passed){
        return passed == 1 ? `<div><a href="<?php echo U('foremen/dc',array('id'=>$v['id']));?>" ><img src="__WJ__/images/dc.png"/>导出</a><a href="<?php echo U('foremen/changeitem',array('id'=>$v['id']));?>" ><img src="__WJ__/images/edi.png"/>编辑</a><a href="<?php echo U('foremen/flist',array('id'=>$v['id']));?>"><img src="__WJ__/images/ment.png"/>管理</a></div>` : '<div><a >项目未审核</a></div>';
    }

    function throttle(func, wait, mustRun) {
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

//    $('.remove').on('click', function () {
//        var id = $(this).attr('rid');
//        var a = $(this);
//        layer.msg('确定解除项目组？', {
//            time: 0 //不自动关闭
//            , btn: ['确定', '取消']
//            , yes: function (index) {
//                $.ajax({
//                    url: "<?php echo U('foremen/index');?>",
//                    type: 'POST',
//                    data: {id: id},
//                    success: function (data) {
//                        if (data.code == 1) {
//                            a.parents('li').remove();
//                            layer.close(index);
//                            layer.msg('已成功解除', {
//                                time: 1000 //1秒关闭
//                            });
//                            if ($('.foreman-list ul li').length == 0) {
//                                $('.foreman-list ul i').show();
//                            }
//                        } else {
//                            layer.close(index);
//                            layer.msg('NETWORK ERROR!', {
//                                time: 1000 //1秒关闭
//                            });
//                        }
//                    },
//                    error: function (error) {
//                        //alert("NETWORK ERROR!");
//                        layer.close(index);
//                        layer.msg('NETWORK ERROR!', {
//                            time: 1000 //1秒关闭
//                        });
//                    },
//                });
//
//            }
//        });
//
//    });
    $('#hotel_id').change(function () {
        var hotel_id = $('#hotel_id').val();
        var part_id = '<?php echo ($part_id); ?>';
        $.ajax({
            url: "<?php echo U('pub/part');?>",
//            url: "<?php echo U('foremen/index');?>",
            data: {
                hotel_id: hotel_id,
//                isflag: true,
            },
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
</script>
<script>
    $(document).ready(function () {
        var pmH = $(window).height() - 125;
        $(".foreman-list ul").height(pmH);
    });
</script>
</body>
</html>