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
            <div class="login_bt">领班登录</div>
            <form method="post" id="lblogin">
                <div class="login_txt">
                    <p>
                        <input type="text" name="username" required="required" id="username" placeholder="请输入账号"/>
                    </p>
                    <p>
                        <input type="password" id="password" name='password' required="required" class="text" placeholder="登录密码">
                    </p>
                    <p>
                        <input type="text" required="" name="captcha" id="captcha" class="inputwide" placeholder="验证码"/>
                        <img id="cp"  src="<?php echo U('auth/verify');?>"></p>
                    <!--onclick="this.src = this.src + '?' + Math.random();"-->
                    </p>
                    <!--<p>
                        <input id="dxcode" required=""  type="text" name="yzm" class="inputwide" placeholder="请输入短信验证码"/>
                        <input type="button" value="获取验证码" class="applyBtn2" id="sendCode"/>
                    </p>-->
                    <div class="login_dl">
                        <input type="submit" value="登录" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="__WJ__/js/jquery-1.8.3.min.js"></script>
    <script>
        $(function () {
            $('#cp').click(function () {
                $("#cp").attr('src', "<?php echo U('auth/verify',array('err'=>1));?>" + '?' + Math.random());
            });
            setTimeout(function () {
                //
            }, 1000);
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
                var user = $('#username').val();
                var password = $('#password').val();
                //var captcha = $('#captcha').val();
                if (user == null || user == '') {
                    err("请您填写账号！");
                    return false;
                }
                if (password == null || password == '') {
                    err("请您填写密码！");
                    return false;
                }
                //var reg1 = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
                /*var reg = /^1\d{10}$/g;
                 if (!reg.test(user)) {
                 err('手机号码错误！');
                 return false;
                 }*/
                obj.unbind("click", mysendCode);

                $.ajax({
                    type: "POST",
                    data: {"username": user, "password": password},
                    url: urllink + "auth_userlogin",
                    dataType: "json",
                    success: function (data) {
                        if (data.success == 1) {
                            err("发送成功,15分钟有效!");
                            intervalid = window.setInterval("fun()", 1000);
                        } else if(data.success == 2){
                            err("账号或密码错误");
                            obj.bind("click", mysendCode);
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


            });
        });
    </script>
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


</body>
</html>