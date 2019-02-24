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
    <form method="POST"  >
        <div class="login">
            <div class="login_text">
                <div class="login_bt">信息绑定</div>
                <div class="login_txt">
                    <p>
                        <input type="text" required=""  name="username" id="username" placeholder="请输入姓名"/>
                    </p>
                    <p>
                        <input type="text" required=""  name="moble" id="user" placeholder="请输入手机号"/>
                    </p>
                    <p>
                        <input type="text" required=""  id="captcha" class="inputwide" placeholder="验证码"/>
                        <img id="cp"  src="<?php echo U('index/verify');?>"></p>
                    <!--onclick="this.src = this.src + '?' + Math.random();"-->
                    </p>
                    <p>
                        <input id="dxcode" required=""  type="text" name="yzm" class="inputwide" placeholder="请输入短信验证码"/>
                        <input type="button" value="获取验证码" class="applyBtn2" id="sendCode"/>
                    </p>
                    <div class="login_dl">
                        <input type="submit" click='0' id='submit' class="submit" value="确认"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="__WJ__/js/jquery-1.8.3.min.js"></script>
<script src="__WJ__/js/layer/layer.js"></script>
<script>
    function err(mes) {
        layer.msg(mes, {
            time: 1500,
        });
    }
</script>
<?php if(!empty($err)): ?><script>
        $(function () {
            layer.msg('<?php echo ($err); ?>', {
                time: 1500,
            });
        });
    </script><?php endif; ?>


<script>
                            $('#cp').click(function () {
                                $("#cp").attr('src', "<?php echo U('index/verify',array('err'=>1));?>" + '?' + Math.random());
                            });
                            var intervalid = "";
                            var ipo = 120;
                            function fun() {
                                if (ipo == 0) {
                                    $('#sendCode').bind("click", mysendCode);
                                    document.getElementById("sendCode").value = '再次获取';
                                    ipo = 120;
                                    window.clearInterval(intervalid);
                                } else {
                                    document.getElementById("sendCode").value = '剩余' + ipo + '秒';
                                    ipo--;
                                }
                            }
                            $(function () {
                                $("#sendCode").bind("click", mysendCode = function () {
                                    var bd = 0;
                                    var obj = $(this);
                                    var fs = 1;
                                    var user = $('#user').val();
                                    var captcha = $('#captcha').val();
                                    if (user == null || user == '') {
                                        err("请您填写手机号码！");
                                        return false;
                                    }
                                    //var reg1 = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
                                    var reg = /^1\d{10}$/g;
                                    if (!reg.test(user)) {
                                        err('手机号码错误！');
                                        return false;
                                    }
                                    obj.unbind("click", mysendCode);
                                    $.ajax({
                                        type: "POST",
                                        data: {"user": user, "fs": fs, "captcha": captcha, "bd": bd},
                                        url: urllink + "pub_user",
                                        dataType: "json",
                                        success: function (data) {
                                            if (data.captcha == false) {
                                                err("图片验证码错误！");
                                                obj.bind("click", mysendCode);
                                                return false;
                                            }
                                            if (data.is_regist) {
                                                $.ajax({
                                                    type: "POST",
                                                    data: {"user": user, "fs": fs},
                                                    url: urllink + "pub_sendcode",
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data.success) {
                                                            err("发送成功,15分钟有效!");
                                                            intervalid = window.setInterval("fun()", 1000);
                                                        } else {
                                                            err("发送失败.");
                                                            obj.bind("click", mysendCode);
                                                        }
                                                    },
                                                    error: function () {
                                                        err("network error.");
                                                        obj.bind("click", mysendCode);
                                                    }
                                                });
                                            } else {
                                                if (fs == 1) {
                                                    err("该信息已经使用，无需重复使用.");
                                                } else {
                                                    err("该信息不存在.");
                                                }
                                                obj.bind("click", mysendCode);
                                            }
                                        },
                                        error: function () {
                                            err("network error.");
                                            obj.bind("click", mysendCode);
                                        }
                                    });
                                });
                            });

</script>
</body>
</html>