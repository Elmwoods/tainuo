// JavaScript Document
//插入链接目标
function SelTarget(){
	window.MsgBox.OpenWin({ id: 'AddLink', title: '插入链接目标', width: 650, height: 250, url: urlS+'weix_addlink' });
	window.$.opener("AddLink").targetObj = document.getElementById("txtReplyWords");
}
//插入关注链接标记
function AddSubscribeMark() {
	InsertText("txtReplyWords", '[link({"type":"9","ref":"shop-subscribe"})]点击关注公众号[/link]');
}
//************************** 回复类型处理：Start *************************

var timer;
$("#addAppmsg .add-access").live('mouseover', function () {
	clearTimeout(timer);
	$(this).addClass("add-btn-show");
}).live('mouseout', function () {
	timer = setTimeout("HideBtn()", 3000);
});
function HideBtn() {
	$("#addAppmsg .add-access").removeClass("add-btn-show");
}

//设置回复类型
function SetReplyType(type) {
	$("#snpReplyErr").html("");
	$("#addAppmsg").hide();
	$("#divRelpyNews").hide();
	$("#divReplyWords").hide();
	if (type == "text") {
		$("#returnType").html("文本").attr("rType", "text");
		$(".replyItems .space").hide();
		$("#spnReplyNewsInfo").hide();
		$("#spnReplyWordsInfo").show();
		$("#divReplyWords").show();
		$("#spnAddLink").show();
		$("#divReplyLink").hide();
		$("#spnReplyLinkInfo").hide();
	}
	else if (type == "link") {
		$("#returnType").html("网页链接").attr("rType", "link");
		$(".replyItems .space").hide();
		$("#spnReplyNewsInfo").hide();
		$("#spnReplyWordsInfo").hide();
		$("#divReplyWords").hide();
		$("#spnAddLink").hide();
		$("#divReplyLink").show();
		$("#spnReplyLinkInfo").show();
	}
	else {
		$("#returnType").html("多图文").attr("rType", "news");
		$("#spnReplyWordsInfo").hide();
		$("#spnReplyNewsInfo").show();
		$("#divRelpyNews").show();
		$("#spnAddLink").hide();
		$("#divReplyLink").hide();
		$("#spnReplyLinkInfo").hide();

		if ($("#divRelpyNews .appmsgItem[flag=1]").length == 0) {
			$(".replyItems .space").show();
		}
	}
	 
	return false;
}

//************************** 回复类型处理：End *************************
//************************** 文本回复处理：Start *************************
$(function(){
	function GetLength() {
		$("#spnCnt").html(1000 - $.trim($("#txtReplyWords").val()).length);
	}
	setInterval(GetLength, 500); 
});
//限制输入字
function CheckReplyWords() {
	$("#snpReplyErr").html("");
	var val = $.trim($("#txtReplyWords").val());
	if (val.length == 0) {
		$("#snpReplyErr").html("* 请输入回复内容");
		return false;
	}
	else if (val.length > 1000){
		$("#snpReplyErr").html("* 回复内容超出");
		return false;
	}
	return true;
}
//************************** 文本回复处理：End *************************
//************************** 多图文处理：Start *************************
//显示操作按钮
$("#divRelpyNews .appmsgItem").live('mouseover', function () {
	$(this).addClass("sub-msg-opr-show");
}).live('mouseout', function () {
	$(this).removeClass("sub-msg-opr-show");
});
//增加一个多图
function AddNews() {
	var s = '';
	s += '<div class="rel sub-msg-item appmsgItem " flag="1">';
	s += '    <span class="thumb">';
	s += '        <span class="default-tip" style="">缩略图</span>';
	s += '        <img src="" class="i-img" style="display:none">';
	s += '    </span>';
	s += '    <div class="msg-t h4">';
	s += '        <span class="i-title"></span>';
	s += '    </div>';
	s += '    <ul class="abs tc sub-msg-opr">';
	s += '        <li class="b-dib sub-msg-opr-item">';
	s += '            <a href="javascript:;" class="th icon18 iconEdit" data-rid="2">编辑</a>';
	s += '        </li>';
	s += '        <li class="b-dib sub-msg-opr-item">';
	s += '            <a href="javascript:;" class="th icon18 iconDel" data-rid="2">删除</a>';
	s += '        </li>';
	s += '    </ul>';
	s += '    <input type="hidden" name="urlTitle" />';
	s += '</div>';
	$("#divRelpyNews .sub-add").before(s);
	$(".replyItems .space").hide();
}
//绑定事件：删除一个图文
$("#divRelpyNews .appmsgItem .iconDel").live('click', function () {
	$(this).closest(".appmsgItem").remove();
	if ($("#divRelpyNews .appmsgItem[flag=1]").length == 0) {
		$(".replyItems .space").show();
	}
});
//绑定事件：编辑一个图文
$("#divRelpyNews .appmsgItem .iconEdit").live('click', function () {
	EditNews(this);
});
var $EditAppmsgItemObj; //编辑的多图对象
//显示编辑关键字的弹窗
function EditNews(obj) {
	var s = '';
	var $obj = $(obj).closest(".appmsgItem");
	window.$EditAppmsgItemObj = $obj;
	var flag = $obj.attr("flag");
	var urlTitle = $obj.find("input[name='urlTitle']").val();
	var imgUrl = $obj.find("img").attr("src");
	var title = $obj.find(".i-title").html();

	s += '<div class="win-news ' + (flag == "0" ? "height1" : "height2") + '">';
	s += '  <span class="red">*</span>标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题：<input type="input" name="win-news-title" class="txt350" maxlength="200" value="' + title + '" />';
	s += '  <p>';
	s += '      <span class="red">*</span>链接目标：<input type="text" class="txt350 readOnly" value="' + urlTitle + '" name="txtTargetDesc" maxlength="300" />';	
	s += '  </p>';

	if (flag == "0") {
		s += '  <div class="pic">';
		if (imgUrl && imgUrl != "") {
			s += '      <div class="default" style="display:none;">封面图片</div>';
			s += '      <img src="' + imgUrl + '" />';
		}
		else {
			imgUrl = '';
			s += '      <div class="default">封面图片</div>';
			s += '      <img src="" style="display:none;" />';
		}
		s += '  </div>';
		s += '  <div class="gray tip">（为达到最佳效果，大图片建议尺寸：640像素 * 300像素）</div>';
	}
	else {
		s += '  <div class="pic">';
		if (imgUrl && imgUrl != "") {
			s += '      <div class="default" style="display:none;">缩略图</div>';
			s += '      <img src="' + imgUrl + '" />';
		}
		else {
			imgUrl = '';
			s += '      <div class="default">缩略图</div>';
			s += '      <img src="" style="display:none;" />';
		}
		s += '  </div>';
		s += '  <div class="gray tip">（为达到最佳效果，小图片建议尺寸：80像素 * 80像素）</div>';
	}
	
	s += '  <p>';
	s += '      <span class="red">*</span>封面图片：<input type="file" name="AjaxPic" id="AjaxPic" style="height:30px;width:82px;"/>';
	//s += '      <span class="red">*</span>封面图片：<input type="file" name="AjaxPic" id="AjaxPic" size="40" style="border:darkgray 1px solid;height:22px;line-height:20px;width:358px;" />';
	//s += '      <input type="button" value="上传图片" class="button" name="upImg" />';
	s += '<div id="showPic"></div>'
	s += '      <input type="hidden" value="' + imgUrl + '" name="win-news-imgurl" />';
	s += '  </p>';
	s += '  <div class="win-news-operate">';
	s += '      <input type="button" class="btn btn_submit" value=" 确 定 " onclick="UpdateNews()" />&nbsp;';
	s += '      <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="$.close(\'editNews\')" />';
	s += '      &nbsp;&nbsp;<span class="red" id="win-news-err"></span>';
	s += '  </div>';
	s += '</div>';
	
	//弹出窗口
	window.asyncbox.open({
		id: 'editNews',
		html: s,
		title: '编辑多图',
		modal: true
	});
	
	uploadify('AjaxPic',past, false, '*.jpg;*.png;*.gif;', 'showPic', '512000', 30, 82, uurlS+'upload_select.png', true, UploadSuccess,timestamp,token);


	return false;
}
//编辑封面图
function UploadSuccess(id, responsejson) {
	if (responsejson.success == "1") {
		$(".win-news input[name='win-news-imgurl']").val(responsejson.fullurl);
		$(".win-news img").attr("src", responsejson.fullurl).show();
		$(".win-news .pic .default").hide();
	} else {
		MsgBox.ErrorMsg({ msg: '上传缩略图失败' });
	}
}
//上传图片
$(".win-news input[name='upImg']").live("click", function () {
	AjaxUploadFile('AjaxPic', 'uploadadspic', UploadSucc);
});
//图片上传成功
function UploadSucc(url) {
	$(".win-news input[name='win-news-imgurl']").val(url);
	$(".win-news img").attr("src", url).show();
	$(".win-news .pic .default").hide();
}
//更新多图
function UpdateNews() {
	$("#win-news-err").html("");
	var urlTitle = $(".win-news input[name='txtTargetDesc']").val();
	var imgUrl = $(".win-news input[name='win-news-imgurl']").val();
	var title = $.trim($(".win-news input[name='win-news-title']").val());

	if (title == "") {
		$("#win-news-err").html("请输入标题");
		$(".win-news input[name='win-news-title']").focus();
		return;
	}
	if (urlTitle == "") {
		$("#win-news-err").html("请输入链接地址");
		$(".win-news input[name='txtTargetDesc']").focus();
		return;
	}
	if (imgUrl == "") {
		$("#win-news-err").html("请上传封面图片");
		$(".win-news input[name='AjaxPic']").focus();
		return;
	}
	
	var $obj = window.$EditAppmsgItemObj;
	$obj.find("input[name='urlTitle']").val(urlTitle);
	$obj.find("img").attr("src", imgUrl);
	$obj.find(".i-title").html(title);
	
	$obj.find(".default-tip").hide();
	$obj.find("img").show();
	window.$.close('editNews');
}
//判断图文是否已设置
function CheckNews() {
	$("#snpReplyErr").html("");
	var isValid = true;
	$("#divRelpyNews .appmsgItem").each(function () {
		var urlTitle = $(this).find("input[name='urlTitle']").val();
		var imgUrl = $(this).find("img").attr("src");
		var title = $(this).find(".i-title").html();
		if (title == "") {
			isValid = false;
		}
	});

	if (!isValid) {
		$("#snpReplyErr").html("* 有图文未设置内容");
	}

	return isValid;
}

//获取图文内容
function GetNewsContent(){
	var rType = $("#returnType").attr("rType");
	$("#hidReplyType").val(rType);
	//回复内容（多图文）
	if (rType == "news") {
		
		var jsonNews = [];
		$("#divRelpyNews .appmsgItem").each(function (){
			var flag = $(this).attr("flag");
			var urlTitle = $(this).find("input[name='urlTitle']").val();
			var imgUrl = $(this).find("img").attr("src");
			var title = $(this).find(".i-title").html();			
			jsonNews.push({"flag": flag, "urlTitle": urlTitle.replace(/"/gm,'').replace(/'/gm,''), "imgUrl": imgUrl.replace(/"/gm,'').replace(/'/gm,''), "title": title.replace(/"/gm,'').replace(/'/gm,'') });
		});
		eval("var str = '"+JSON.stringify(jsonNews)+"';");
		return str;
	}
	return "";
}

//************************** 多图文处理：End *************************

//检查内容
        function CheckForm() {
            var rType = $("#returnType").attr("rType");
            if (!rType || rType == "") {
                asyncbox.tips('请设置回复内容', 'error');
                return false;
            }
            else if (rType == "text") {
                if (!CheckReplyWords()) {
                    asyncbox.tips('回复内容有误', 'error');
                    return false;
                }
            }
            else {
                if (!CheckNews()) {
                    asyncbox.tips('回复内容中有图文未设置内容', 'error');
                    return false;
                }
            }

            //整合提交数据
            $("#hidNews").val(GetNewsContent());
            //防止重复提交
            CheckSubmit.Submit(true);
            return true;
        }

//关键字
//************************** 关键字操作：Start *************************

        var EditKeywordObj;

        //显示编辑关键字的弹窗OK
        function ShowAddKeyword(obj) {
            var s = '';
            var keyword = "";
            var isAllMatch = false;
            var tit = "添加关键字";
            var act = 'add';

            if (obj != null && typeof (obj) != 'undifined') {
                tit = "编辑关键字";
                EditKeywordObj = obj;
                act = 'edit';
                keyword = $(obj).siblings(".left").find(".val").html();
                if ($(obj).siblings(".matchMode").hasClass("matchMode1"))
                    isAllMatch = true;
            }
            else {
                if ($("#keywordItems li").length >= 10) {
                    alert("每个规则最多只可添加10个关键字");
                    return false;
                }
            }

            s += '<div class="win-addkeyword">';
            s += '  <span class="red">*</span>关键词：<input type="input" name="win-keyword" onfocus="this.select()" class="txt250" maxlength="30" value="' + keyword + '" />';
            s += '  <p>';
            s += '      <input type="checkbox"' + (isAllMatch ? " checked" : "") + ' />&nbsp;全字匹配&nbsp;&nbsp;';
            s += '      <span class="red" id="spnWinErr"></span>';
            s += '  </p>';
            s += '  <div class="win-operate">';
            s += '      <input type="button" class="btn btn_submit" value=" 确 定 " onclick="ModifyKeyword(\'' + act + '\')" />&nbsp;';
            s += '      <input type="button" class="btn btn_cannel" value=" 取 消 " onclick="$.close(\'addKeyword\'); " />';
            s += '  </div>';
            s += '</div>';
 
            //弹出窗口
            asyncbox.open({
                id : 'addKeyword',
                html: s,
                title: tit,
                modal: true
            });

            return false;
        }

        //添加/编辑关键字OK
        function ModifyKeyword(act) {
            $("#spnWinErr").html("");
            var keyword = $.trim($(".win-addkeyword input[name='win-keyword']").val());
            var isAllMatch = $(".win-addkeyword :checkbox").attr("checked");

            if (keyword == ""){
                $("#spnWinErr").html("请输入关键字");
                return;
            }
            
            if (act == 'edit') {
                var $Keyword = $(EditKeywordObj).siblings(".left").find(".val");
                var $matchMode = $(EditKeywordObj).siblings(".matchMode");
                $Keyword.html(keyword);
                $Keyword.attr("title", keyword);
                if (isAllMatch) {
                    $matchMode.addClass("matchMode1");
                    $matchMode.html("已全匹配");
                }
                else {
                    $matchMode.removeClass("matchMode1");
                    $matchMode.html("全匹配");
                }
            }
            else {
                var s = '';
                s += '<li class="item float-p">';
                s += '    <label class="left">';
                s += '        <input type="checkBox" class="left">';
                s += '        <div class="val left" title="' + keyword + '">' + keyword + '</div>';
                s += '    </label>';

                if (isAllMatch)
                    s += '    <label class="right c-gA matchMode matchMode1">已全匹配</label>';
                else
                    s += '    <label class="right c-gA matchMode">全匹配</label>';

                s += '    <a href="javascript:;" class="keywordEditor oh z c-opr">编辑</a>';
                s += '</li>';

                $("#keywordItems").append(s);
            }

            //关闭弹出窗口
            $.close('addKeyword');
        }

        //绑定关键字“全匹配”按钮点击事件OK
        $("#keywordItems .matchMode").live('click', function () {
            //改变样式
            $(this).toggleClass("matchMode1");
            if ($(this).hasClass("matchMode1"))
                $(this).html("已全匹配");
            else 
                $(this).html("全匹配");
        });

        //绑定关键字“编辑”按钮点击事件OK
        $("#keywordItems .keywordEditor").live('click', function () {
            ShowAddKeyword(this);
        });

        //删除选中的关键字OK
        function DeleteKeyword() {
            $("#keywordItems li").each(function () {
                if ($(this).find("input:checkbox").attr("checked"))
                    $(this).remove();
            });
            return false;
        }

        //检查关键字
        function CheckKeyword(){
            return ($("#keywordItems li").length > 0);
        }

        //************************** 关键字操作：End *************************
		//KEY判断图文类型
        function CheckFormkey() {
            
            var ruleName = $.trim($("#txtRuleName").val());
            if (ruleName == "") {
                asyncbox.tips('请输入规则名称', 'error');
                $("#txtRuleName").focus();
                return false;
            }

            if (!CheckKeyword()){
                asyncbox.tips('请添加关键字', 'error');
                $("button.addKeyword").focus();
                return false;
            }

            var rType = $("#returnType").attr("rType");
            if (!rType || rType == "") {
                asyncbox.tips('请设置回复内容', 'error');
                return false;
            }
            else if (rType == "text") {
                if (!CheckReplyWords()){
                    asyncbox.tips('回复内容有误', 'error');
                    return false;
                }
            }
            else {
                if (!CheckNews()) {
                    asyncbox.tips('回复内容中有图文未设置内容', 'error');
                    return false;
                }
            }
            
            //整合提交数据
            SubData();
            //防止重复提交
            CheckSubmit.Submit(true);
            return true;
        }
		
		//整合提交数据
        function SubData(){
            //关键字
            var jsonKeyword = [];
            $("#keywordItems li").each(function (){
                var matchMode = "0";
                if ($(this).find(".right").hasClass("matchMode1"))
                    matchMode = "1";	
                jsonKeyword.push({ "keyword": $(this).find(".val").html().replace(/"/gm,'').replace(/'/gm,''), "matchMode": matchMode});
            });
			eval("var str = '"+JSON.stringify(jsonKeyword)+"';");
            $("#hidKeyword").val(str);
            $("#hidNews").val(GetNewsContent());
        }
		
function CheckReplyLink() {
	$("#snpReplyErr").html("");
	var val = $.trim($("#txtTargetDesc").val());
	if (val.length == 0) {
		$("#snpReplyErr").html("* 请设定链接目标");
		return false;
	}
	return true;
}