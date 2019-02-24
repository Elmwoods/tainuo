$(function(){

	/*弹出框关闭事件*/
	$("#message_close").click(function(){
		$("#message").hide();
	});
	

 	/*弹出事件*/
 	$(".drop_down").toggle(function(){
		$(this).addClass("seldrop");
		$(this).next().slideDown(200);
 	},function(){
		$(this).removeClass("seldrop");
		$(this).next().slideUp(200);
	});
    
	$("#drop_down_down").click(function(){
           if($("#select_div").css("display") == "none")
               {
		$("#select_div").slideDown(200);
              }
	});

});

    //保存cookie名
    //var ejecttime;
    //保存弹出时间setInterval对象
    var it;
    //保存弹出时间（用来保存Cookie）
    var time;
	
    //信息框在显示的状态下每五秒更新一下数据(只有在弹出层显示在状态下执行函数)
    setInterval(function () {
        if ($("#message").css("display") == "block") {
            $.ajax({
                type: "post",
                url: urlS+"home_remind.html",
                data: { "requestType": "requestdata"},
                dataType: "json",
                success: function (result) {
                         $("#span_Message").text(result.span_Message);
                         $("#span_BackOrder").text(result.span_BackOrder);
						 $("#point").text(result.point);
                         $("#zxsj1").text(result.zxsj1);						 
						 $("#zxsj2").text(result.zxsj2);
                         $("#zxsj3").text(result.zxsj3);
                         $("#span_AdvisoryReply").text(result.span_AdvisoryReply);
						 $("#zxsj4").text(result.zxsj4);
                         $("#nr").text(result.nr);
               }
           });
        }
    }, 5000);
    //加载
     window.onload = function () {
		//$("#message").slideDown(800);
        //第一次加载时判断一下是否保存有ejecttime Cookie存在（适用于刷新操作时）
        if ($.cookie(ejecttime) == null) {
            //刚开始是默认10分钟提醒600000
            time = "60000";
            it = setInterval(tips_pop, time);  //每隔1秒调用这个函数
            //     创建cookie不设置过期时间，浏览器关闭则销毁 | 保存7天的cookie $.cookie("ejecttime", ejecttime, { expires: 7 });
            $.cookie(ejecttime, time, {path: '/', expires: 365 });
        }
        else {
            time = $.cookie(ejecttime);
            //判断是否设置为永远不提醒
            if (time != "0") {
                it = setInterval(tips_pop,time);
            }
            //用保存 Cookie事件通过switch找出所对应的的text文本并赋值到文本框中
            switch (time) {
                case "30000":
                    $("#drop_down_down1").text("30秒");
                    $("#drop_down_down2").text("30秒");
                    break;
                case "60000":
                    $("#drop_down_down1").text("1分钟");
                    $("#drop_down_down2").text("1分钟");
                    break;
                case "120000":
                    $("#drop_down_down1").text("2分钟");
                    $("#drop_down_down2").text("2分钟");
                    break;
                case "300000":
                    $("#drop_down_down1").text("5分钟");
                    $("#drop_down_down2").text("5分钟");
                    break;
                case "600000":
                    $("#drop_down_down1").text("默认（10分钟）");
                    $("#drop_down_down2").text("默认（10分钟）");
                    break;
                case "1200000":
                    $("#drop_down_down1").text("20分钟");
                    $("#drop_down_down2").text("20分钟");
                    break;
                case "1800000":
                    $("#drop_down_down1").text("30分钟");
                    $("#drop_down_down2").text("30分钟");
                    break;
                case "2700000":
                    $("#drop_down_down1").text("45分钟");
                    $("#drop_down_down2").text("45分钟");
                    break;
                case "3600000":
                    $("#drop_down_down1").text("60分钟");
                    $("#drop_down_down2").text("60分钟");
                    break;
                case "0":
                    $("#drop_down_down1").text("永远不提醒");
                    $("#drop_down_down2").text("永远不提醒");
                    break;
                default:
                    $("#drop_down_down1").text("10秒");
                    $("#drop_down_down2").text("10秒");
                    break;
            }
            $(".pop_up_middle,#mainer,#mright").click(function () {
                $("#select_div1").slideUp(200);
                $("#select_div2").slideUp(200);
                $("#drop_down_down1").removeClass("seldrop");
                $("#drop_down_down2").removeClass("seldrop");
            });
        }
}

    //返回值并判断是否需要弹出消息框
    function tips_pop() {
        //如果弹出层是在显示的状态则不再执行slideDown弹出
        if ($("#message").css("display") == "none") {
            $.ajax({
                type: "post",
                url: urlS+"home_remind.html",
                data: { "requestType": "requestdata"},
                dataType: "json",
                success: function (result) {
						//if(result.MessageCount > 0 || result.ReadySend > 0 || result.ProductAdvice > 0)
						//{
                         $("#span_Message").text(result.span_Message);
                         $("#span_BackOrder").text(result.span_BackOrder);
						 $("#point").text(result.point);
                         $("#zxsj1").text(result.zxsj1);						 
						 $("#zxsj2").text(result.zxsj2);
                         $("#zxsj3").text(result.zxsj3);
                         $("#span_AdvisoryReply").text(result.span_AdvisoryReply);
						 $("#zxsj4").text(result.zxsj4);
                         $("#nr").text(result.nr);
						 //如果下拉框是在显示的状态下则隐藏
						 if ($("#select_div1").css("display") == "block")
							 {
								$("#select_div1").hide();
							 }
                         //显示弹出框
                         $("#message").slideDown(800);
						//}
                }
            });
        }
    }
    //  设置提醒时间
    function select_item(e) {
        //先清除setInterval，然后在新建一个setInterval
        window.clearInterval(it);
        //重新赋值一下（修改cookie的值）
        time = $(e).attr("value");
        //判断是否设置为永远不提醒
        if (time != "0") {
            it = setInterval(tips_pop, time);
        }
          //设置过期时间为前10000天
          //var date = new Date();
          //date.setTime(date.getTime() - 10000);
          //document.cookie = name + "=ejecttime,; expires=" + date.toGMTString();

        //保存cookie
        $.cookie(ejecttime, time, {path: '/', expires: 365 });
        //选择项后把下拉框隐藏起来
        $("#select_div1").css("display", "none");
        $("#select_div2").css("display", "none");
        //把选择项的内容放在下拉列表框中
        $("#drop_down_down1").text($(e).text());
        $("#drop_down_down2").text($(e).text());
    }
    //鼠标放上去背景颜色变深
    function onover(e) {
        $(e).css("background", "#eeeeee");
    }
    //鼠标移走背景颜色变会原来的颜色
    function onout(e) {
        $(e).css("background", "");
    }

       