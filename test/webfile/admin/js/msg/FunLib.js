
/*****************************************************
*					 弹出窗口和提示					 *
*													 *
* -- 须引用 jQuery及AsyncBox.v1.4.5.js、FunLib.js    *
******************************************************/
var MsgBox = {
    _openWinId: "", 	//弹出窗口的ID,用于关闭弹出窗口
    _oriRequestWin: null, //发起弹出层请求的原始窗口对象

    //操作成功提示，并提交（submit）页面：起到刷新页面作用
    //args			参数json对象
    //args.msg			消息内容，必须
    //args.target		刷新窗体目标：0—本窗体、1—父窗体，默认为本窗体，可选
    //args.openWinId	弹出窗口ID,如果刷新窗体目标为父窗口时必须传该参数，用于关闭弹出层
    //args.formId		要submit页面的窗体id，一般为form1，可选
    //args.width		提示框宽度（整数，单位px，每个汉字25px计算），可选
    SuccessRefresh: function (args) {
        $(".asyncbox_wait").show(); //出现等待层
        asyncbox.tips(args.msg, 'success');

        var width = 0;
        if (typeof (args.width) != "undefined")		//指定长度
            width = args.width;
        else	//根据字符计算
            width = StrLength(args.msg) * 13;

        if (width > 0)		//指定长度
            $(".asynctips").width(width);

        if (typeof (args.target) != "undefined" && args.target == 1)
            setTimeout(function () {
                parent.MsgBox._oriRequestWin.$('#__RefTag').val("1");
                parent.MsgBox._oriRequestWin.$("#" + (typeof (args.formId) == "undefined" ? "form1" : args.formId)).submit();
                parent.$.close(parent.MsgBox._openWinId); //关闭弹出的窗口
            }, 1800, args.winId);
        else
            setTimeout(function () {
                $('#__RefTag').val("1");
                $("#" + (typeof (args.formId) == "undefined" ? "form1" : args.formId)).submit();
            }, 1800);
    },


    //操作出错提示，并提交（submit）页面：起到刷新页面作用
    //args			参数json对象
    //args.msg			消息内容，必须
    //args.target		刷新窗体目标：0—本窗体、1—父窗体，默认为本窗体，可选
    //args.openWinId	弹出窗口ID,如果刷新窗体目标为父窗口时必须传该参数，用于关闭弹出层
    //args.formId		要submit页面的窗体id，一般为form1，可选
    //args.width		提示框宽度（整数，单位px，每个汉字25px计算），可选
    ErrorRefresh: function (args) {
        $(".asyncbox_wait").show(); //出现等待层
        asyncbox.tips(args.msg, 'error');

        var width = 0;
        if (typeof (args.width) != "undefined")		//指定长度
            width = args.width;
        else	//根据字符计算
            width = StrLength(args.msg) * 13;

        if (width > 0)		//指定长度
            $(".asynctips").width(width);

        if (typeof (args.target) != "undefined" && args.target == 1)
            setTimeout(function () {
                parent.MsgBox._oriRequestWin.$('#__RefTag').val("1");
                parent.MsgBox._oriRequestWin.$("#" + (typeof (args.formId) == "undefined" ? "form1" : args.formId)).submit();
                parent.$.close(parent.MsgBox._openWinId); //关闭弹出的窗口
            }, 1800);
        else
            setTimeout(function () {
                $('#__RefTag').val("1");
                $("#" + (typeof (args.formId) == "undefined" ? "form1" : args.formId)).submit();
            }, 1800);
    },


    //操作成功提示，并跳转页面
    //args			参数json对象
    //args.msg			消息内容，必须
    //args.url			要跳转的链接，必须
    //args.target		要跳转的窗体目标：0—本窗体、1—父窗体，默认为本窗体，可选
    //args.openWinId	弹出窗口ID,如果刷新窗体目标为父窗口时必须传该参数，用于关闭弹出层
    //args.width		提示框宽度（整数，单位px，每个汉字25px计算），可选
    SuccessRedirect: function (args) {

        $(".asyncbox_wait").show(); //出现等待层
        asyncbox.tips(args.msg, 'success');

        var width = 0;
        if (typeof (args.width) != "undefined")		//指定长度
            width = args.width;
        else	//根据字符计算
            width = StrLength(args.msg) * 13;

        if (width > 0)		//指定长度
            $(".asynctips").width(width);

        if (typeof (args.target) != "undefined" && args.target == 1)
            setTimeout(function () {
                parent.MsgBox._oriRequestWin.location.href = args.url;
                parent.$.close(parent.MsgBox._openWinId); //关闭弹出的窗口
            }, 1800);
        else
            setTimeout(function () { window.location.href = args.url; }, 1800);
    },

    //操作出错提示，并跳转页面
    //args			参数json对象
    //args.msg			消息内容，必须
    //args.url			要跳转的链接，必须
    //args.target		要跳转的窗体目标：0—本窗体、1—父窗体，默认为本窗体，可选
    //args.openWinId	弹出窗口ID,如果刷新窗体目标为父窗口时必须传该参数，用于关闭弹出层
    //args.width		提示框宽度（整数，单位px，每个汉字25px计算），可选
    ErrorRedirect: function (args) {
        $(".asyncbox_wait").show(); //出现等待层
        asyncbox.tips(args.msg, 'error');

        var width = 0;
        if (typeof (args.width) != "undefined")		//指定长度
            width = args.width;
        else	//根据字符计算
            width = StrLength(args.msg) * 13;

        if (width > 0)		//指定长度
            $(".asynctips").width(width);

        if (typeof (args.target) != "undefined" && args.target == 1)
            setTimeout(function () {
                parent.MsgBox._oriRequestWin.location.href = args.url;
                parent.$.close(parent.MsgBox._openWinId); //关闭弹出的窗口
            }, 1800);
        else
            setTimeout(function () { window.location.href = args.url; }, 1800);
    },

	//msg:   消息文本
	//title: 文本框标题
	WarningTips: function (args) {
        asyncbox.error(args.msg, args.title);
	},

    //操作成功提示
    //args			参数json对象或直接传字符串
    //args.msg		消息内容，必须
    //args.width	提示框宽度（整数，单位px，每个汉字25px计算），可选
    SuccessMsg: function (args) {
        if (args) {
            var width = 0;
            if (IsJson(args)) {
                asyncbox.tips(args.msg, 'success');
                if (typeof (args.width) != "undefined")		//指定长度
                    width = args.width;
                else	//根据字符计算
                    width = StrLength(args.msg) * 13;
            }
            else {
                asyncbox.tips(args, 'success');
                width = StrLength(args) * 13;
            }

            if (width > 0)		//指定长度
                $(".asynctips").width(width);
        }
    },

    //操作出错提示
    //args			参数json对象或直接传字符串
    //args.msg		消息内容，必须
    //args.width	提示框宽度（整数，单位px，每个汉字25px计算），可选
    ErrorMsg: function (args) {
        if (args) {
            var width = 0;
            if (IsJson(args)) {
                asyncbox.tips(args.msg, 'error');
                if (typeof (args.width) != "undefined")		//指定长度
                    width = args.width;
                else	//根据字符计算
                    width = StrLength(args.msg) * 13;
            }
            else {
                asyncbox.tips(args, 'error');
                width = StrLength(args) * 13;
            }

            if (width > 0)		//指定长度
                $(".asynctips").width(width);
        }
    },

    //在顶层页面打开窗口
    //此处用的是 AsyncBox v1.4.5
    //args			参数json对象
    //args.id		窗口ID，必须（用于关闭窗口，方法 parent.$.close("id");）
    //args.title	窗口标题，必须
    //args.width	宽，必须
    //args.height	高，必须
    //args.url		页面url，必须，请填入绝对路径如：/Product/BrandEdit.aspx
    //args.data		页面参数，可选（也可以把参数直接写到url中）
    //					支持以下两种写法：
    //						1、data : 'id=100&name=asyncbox'。
    //						2、data : { id : 100, name : 'asyncbox' } 
    //					以上两种最终转换为 url + data 即：'asyncbox.html?id=100&name=asyncbox'。
    //args.drag		是否可拖动窗口，可选；可用值： true / false，默认值：false
    //args.modal	是否显示遮罩层，可选；可用值： true / false，默认值：true
    //args.scroll	滚动条，可选；可用值：no / yes / auto，默认值：'auto'
    TopOpenWin: function (args) {
        if (typeof (args.modal) == "undefined")	//修改“是否显示遮罩层”参数默认值为true
            args["modal"] = true;
        window.top.MsgBox._openWinId = args.id;
        window.top.MsgBox._oriRequestWin = window;
        window.top.asyncbox.open(args);
    },

    //打开窗口
    //此处用的是 AsyncBox v1.4.5
    //args			参数json对象
    //args.id		窗口ID，必须（用于关闭窗口，方法 parent.$.close("id");）
    //args.title	窗口标题，必须
    //args.width	宽，必须
    //args.height	高，必须
    //args.url		页面url，必须，请填入绝对路径如：/Product/BrandEdit.aspx
    //args.data		页面参数，可选（也可以把参数直接写到url中）
    //					支持以下两种写法：
    //						1、data : 'id=100&name=asyncbox'。
    //						2、data : { id : 100, name : 'asyncbox' } 
    //					以上两种最终转换为 url + data 即：'asyncbox.html?id=100&name=asyncbox'。
    //args.drag		是否可拖动窗口，可选；可用值： true / false，默认值：false
    //args.modal	是否显示遮罩层，可选；可用值： true / false，默认值：true
    //args.scroll	滚动条，可选；可用值：no / yes / auto，默认值：'auto'	
    OpenWin: function (args) {
        if (typeof (args.modal) == "undefined")	//修改“是否显示遮罩层”参数默认值为true
            args["modal"] = true;
        MsgBox._openWinId = args.id;
        MsgBox._oriRequestWin = window;
        asyncbox.open(args);
    },

    //关闭弹出窗口
    CloseWin: function () {
        parent.$.close(parent.MsgBox._openWinId);
    }
}



/***************************
*         字符串处理       *
***************************/

//信息字符串长度
function StrLength(str) {
    var byteLen = 0, len = str.length;
    if (str) {
        for (var i = 0; i < len; i++) {
            if (str.charCodeAt(i) > 255)
                byteLen += 2;
            else
                byteLen++;
        }
        return byteLen;
    }
    else {
        return 0;
    }
}



/***********************************
*         文本框textarea操作       *
************************************/

//textarea光标处插入内容
//textarea：textarea的ID或对象
//str：文本内容
function InsertText(textarea, str) {
    if (textarea) {
        var obj = typeof (textarea) == "object" ? textarea : document.getElementById(textarea);
        if (document.selection) {
            obj.focus();
            var start = GetSelectRangeStart(obj);
            var rng = document.selection.createRange();
            rng.text = str;
            //如果能取出当前位置，则设置刚插入的内容选中
            if (start != null)
                SetSelectRange(obj, start, (start + str.length));
        }
        else if (typeof (obj.selectionStart) === 'number' && typeof (obj.selectionEnd) === 'number') {
            var startPos = obj.selectionStart;
            var endPos = obj.selectionEnd;
            var tmpStr = obj.value;
            obj.value = tmpStr.substring(0, startPos) + str + tmpStr.substring(endPos, tmpStr.length);
            //设置刚插入的内容选中
            SetSelectRange(obj, startPos, (startPos + str.length));
        } else {
            obj.value += str;
            //设置刚插入的内容选中
            SetSelectRange(obj, 0, str.length);
        }
    }
}

//设置选中区域
//textarea：textarea的ID或对象
//start：开始位置
//end：结束位置
function SetSelectRange(textarea, start, end) {
    if (textarea) {
        var obj = typeof (textarea) == "object" ? textarea : document.getElementById(textarea);
        // IE
        if (typeof (obj.createTextRange) != 'undefined') {
            var range = obj.createTextRange();
            // 先把相对起点移动到0处 
            range.moveStart("character", 0)
            range.moveEnd("character", 0);
            range.collapse(true); // 移动插入光标到start处 
            range.moveEnd("character", end);
            range.moveStart("character", start);
            range.select();
        }
        else if (typeof (textarea.setSelectionRange) != 'undefined') {	//非IE
            obj.setSelectionRange(start, end);
            obj.focus();
        }
    }
}

//获得textarea对象选中区域的开始位置
//textarea：textarea的ID或对象
function GetSelectRangeStart(textarea) {
    if (textarea) {
        var obj = typeof (textarea) == "object" ? textarea : document.getElementById(textarea);
        var start = 0;
        //如果是Firefox(1.5)的话，方法很简单
        if (typeof (obj.selectionStart) == "number") {
            start = obj.selectionStart;
            //var end = obj.selectionEnd;
        }
        //下面是IE(6.0)的方法，麻烦得很，还要计算上'\n'
        else if (document.selection) {
            var range = document.selection.createRange();
            var range_textarea = document.body.createTextRange();
            range_textarea.moveToElementText(textarea);
            //比较start point 
            for (var sel_start = 0; range_textarea.compareEndPoints('StartToStart', range) < 0; sel_start++)
                range_textarea.moveStart('character', 1);
            start = sel_start;
        }
        return start;
    }
    return null;
}



/***************************
*          页面操作        *
***************************/

//防止重复提交表单,注意此方法只对重复提交验证,不对表单验证(请独立验证)
//使用示例：return CheckSubmit.Submit(true);
var CheckSubmit = {
    //提交次数统计
    SubmitCount: 0,
    //初始化统计量避免操作成功后无法继续操作
    InitCount: function () {
        SubmitCount = 0;
    },
    //验证
    Check: function () {
        if (CheckSubmit.SubmitCount > 0) {//已提交
            return false;
        }
        else {
            CheckSubmit.SubmitCount += 1;
            return true;
        }
    },
    //确认提交,表单验证在外部,此处只做重复验证
    Submit: function (isSubmit) {//isSubmit为bool参数,表示表单是否已通过验证
        if (isSubmit) {//信息验证通过再验证是否重复提交
            if (!CheckSubmit.Check())//防止重复提交表单
                return false;
            else
                return true;
        }
        else {
            CheckSubmit.SubmitCount = 0; //没通过必须将提交次数初始化，避免通过后无法提交
            return false;
        }
    }
}

//编辑操作的单元格提示
var TdTips = {
    //显示单元格的错误信息 id-单元格的验证元素(必须为单元格一级子元素) tips-提示信息
    showTdErr: function (id, tips) {
        var $p = $('#' + id).parent();
        if ($p.find('span.errtip').length > 0)
            $p.find('span.errtip').text(tips);
        else
            $('#' + id).after('<span class="errtip">' + tips + '</span>');
    },
    //清除单元格的错误信息 id-单元格的验证元素(必须为单元格一级子元素)
    clearTdErr: function (id) {
        $('#' + id).parent().find('span.errtip').remove();
    }
}


/***************************
*          列表操作        *
***************************/

//获得列表中复选框选中值列表
function GetCheckBoxIdList() {
    var list = "";
    $("input[name='chkKey']:checked").each(function () {
        list += (list == "" ? "" : ",") + this.value;
    });
    return list;
}

//列表显示初始化——鼠标效果
$(".tblist tbody tr").live('mouseover mouseout', function () {
    $(this).toggleClass("select");
});

//列表显示初始化——全选：必须保证“全选”复选框name="CheckAll"、列表中复选框name="chkKey"
$("input[name='CheckAll']").live('click', function () {
    $("input[name='chkKey']").attr("checked", this.checked);
});



/***************************
*          Cookie          *
***************************/

//创建Cookie
//name：Cookie名
//value：Cookie值
//second：有效时间，秒
function AddCookie(name, value, second) {//添加cookie
    var str = name + "=" + escape(value);
    if (second > 0) {//为0时不设定过期时间，浏览器关闭时cookie自动消失
        var date = new Date();
        date.setTime(date.getTime() + second);
        str += "; expires=" + date.toGMTString();
    }
    document.cookie = str;
}

//获取Cookie
//name：Cookie名
function GetCookie(name) {//获取指定名称的cookie的值
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == name) return unescape(temp[1]);
    }
}

//删除Cookie
//name：Cookie名
function DelCookie(name) {//为了删除指定名称的cookie，可以将其过期时间设定为一个过去的时间
    var date = new Date();
    date.setTime(date.getTime() - 10000);
    document.cookie = name + "=a; expires=" + date.toGMTString();
}


/***************************
*       Ajax上传文件       *
***************************/

//上传文件
//1. file控件必须带nmae和id，且保持一致，如：name="AjaxProductPic" id="AjaxProductPic"
//2. 站点必须有页面：/Ajax/FileUpload.ashx 接收上传后台调用
//3. 页面必须引入 AjaxFileUpload.js、jQuery.js
//4. 页面必须引入 AsyncBox.js 插件作提示用
//5. fileId：file控件id
//6. act：操作类型，与FileUpload.ashx方法调用act参数结合，表明要上传的类型：如，UploadProductPic。
//6. fun：方法名，图片上传成功即调用此方法，需一个参数接受图片url
//		如：UploadSucc，页面上需定义方法：function UploadSucc(url) { /*上传成功处理语句*/ }
//			页面如此调用：AjaxUploadFile('AjaxProductPic', 'UploadProductPic', UploadSucc);
function AjaxUploadFile(fileId, act, fun) {
    if ($("#" + fileId).val().length == 0) {
        asyncbox.tips("请选择图片", 'error'); return;
    }
    $.ajaxFileUpload({
        url: '/Ajax/FileUpload.ashx?act=' + act,
        secureuri: false,
        async: false,
        fileElementId: fileId,
        dataType: 'json',
        success: function (data, status) {
            if (data.success == 1) {
                fun(data.fullurl);
            }
            else {
                asyncbox.error(data.error, '上传失败');
            }
        },
        error: function (data, status, e) {
            asyncbox.error(e, '上传失败');
        }
    });
}



/***************************
*         数值转换         *
***************************/
//格式化数值为货币类型
function FormatCurrency(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    var sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    var cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
    return '¥' + (((sign) ? '' : '-') + num + '.' + cents);
}

//将货币类型转货为数值
function CurrencyToNumber(str) {
    str = str.replace("¥", "").replace(",", "").replace(/\s/g, '');
    return parseFloat(str);
}


//判断对象是否为json
function IsJson(obj) {
    return typeof (obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length;
}

$(function () {
    //顶部导航下拉
    var $dropDown = $('#userHeadMenu').find('li:gt(0)'); //将第二个开始的下拉选项隐藏
    $dropDown.hide();
    $('#dropDown,.userName').click(function () {
        $('#dropDown').toggleClass('upDown');
        $('#userHeadMenu').toggleClass('uHover');
        $dropDown.slideToggle('fast');
    })
    //搜索框下拉
    $('#searchSlide').click(function () {
        $('.search').slideToggle();
        $(this).toggleClass('searchUp');
    })
    $('#btnSearch,#Pager_btn').removeClass('button');
    $(".menubox").after("<div id='lines'></div>");
    var h1 = $('.menubox').find('ul').height();
    var h2 = $('.mainbox').height() + 200;
    var h = h1 > h2 ? h1 : h2;
    $('#lines').height(h);
    $(window).resize(function () {
        $('#lines').height(h);
    });
    //信息提示居中显示
    var wid = $('.asynctips tr').width();
    $('.asynctips tr').width(wid);

//    $('.messageTxt').click(function () {
//        if ($("#messageList").is(":hidden")) {
//            $('#messageList').show();
//        }
//        else {
//            $('#messageList').hide();
//        }
//    })
    $('#closeBtn').click(function () {
        $('#messageList').hide();
    })
    if ($("#messageList ul li").length>0) {
        $('#messageList').show();
    }
    else {
        $('#messageList').hide();
    }
})  