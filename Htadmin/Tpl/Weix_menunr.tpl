<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/wx.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/menutree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/function.js"></script>
<!--MsgBox-->
<link type="text/css" href="<{:C('web_url')}>__WJ__/js/msg/asyncbox.css" rel="Stylesheet">
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/AsyncBox.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/FunLib_002.js"></script>
<script>var uurlS="<{:C('web_url')}>__WJ__/images/img/";</script>
<script>var past="admin";</script>
<script>var timestamp="<{$timestamp}>";</script>
<script>var token="<{$token}>";</script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/uploadify.css"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/jquery.uploadify-2.1.4.min.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/swfobject.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/uploadify.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/json2.js"></script>
<script src="<{:C('web_url')}>__WJ__/js/wx.js" type="text/javascript"></script>
<style type="text/css">
        body{ background-image:none; }
        .replyList { border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;border: 0px; margin-left:0px;}
        #txtReplyWords {height:359px;}
        #addAppmsg {height:349px;}
        #divRelpyNews { margin: 20px 0 24px 105px}
        .actcover { width:100%;height:100%; opacity: 0.1; z-index: 1987;  background: none repeat scroll 0px 0px rgb(0, 0, 0);margin:0; position:absolute;text-align:center; }
        .actcover span{display:block;width:100%;height:100%;background:url("<{:C('web_url')}>__WJ__/images/img/spinner.gif") no-repeat center;margin:0 auto;}
		.txtc{ text-align:center;}
    </style>
    <script type="text/javascript">
        //显示loading
        function ShowLoading() {
            $(".actcover").show();
        }
        //隐藏loading
        function HideLoading() {
            $(".actcover").hide();
        }

        //提交信息
        function Sumbitmen() {
            
            if ($("#divReply").size() > 0) {

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
                else if (rType == "link") {
                    if (!CheckReplyLink()) {
                        asyncbox.tips('请设定链接目标', 'error');
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
            }

            $("#hidSubmit").val("1");
            ShowLoading();
            return true;
        }
    </script>
</head>
<body>
	<form  method="post" action="<{:C('web_url')}>__APP__/weix_menunr" id="myformly" name="myformly">
	<input name="id" type="hidden" value="<{$show.id}>" />
	<input name="hidReplyType" type="hidden" id="hidReplyType" />
    <input name="hidNews" type="hidden" id="hidNews" />
	<input name="hidSubmit" type="hidden" id="hidSubmit" />
	<div class="float-p replyList">
        <div class="cntBox hide">
            菜单标题：<span id="labName">22张三</span>
        </div>
        <div id="divReply">
            <div class="cntBox">
			<if condition="$show.style eq 0">
                                                <p class="left">回复类型：<span id="returnType" rtype="text">文本</span></p>
												<elseif condition="$show.style eq 1"/>
												<p class="left">回复类型：<span id="returnType" rtype="news">多图文</span></p>
												<else/>
												<p class="left">回复类型：<span id="returnType" rtype="link">网页链接</span></p>
												</if>                            
                <span id="spnAddLink" class="addlink <if condition="$show.style neq 0">hide</if>">
                    <a title="插入指定链接标记" href="#" onclick="SelTarget()">插入链接</a>
                    <!--<a title="插入导航目录标记" href="#" onclick="AddMenu()">导航目录</a>
                    <a title="插入关注公众号标记" href="#" onclick="AddSubscribeMark()">关注公众号</a>-->
                </span>
                <div class="clear"></div>
            </div>
            <div class="replyItems showWords showFile showAppMsg">
                <div id="divReplyWords" style="display:<if condition="$show.style eq 0">block<else/>none</if>;">
                    <textarea name="txtReplyWords" id="txtReplyWords" onblur="CheckReplyWords()" placeholder="请在此输入您的回复内容，1000字以内" autocomplete="off" class="txtarea"><if condition="$show.style eq 0"><{$show.content}></if></textarea>
                </div>
                <div id="divReplyLink" style="display:<if condition="$show.style eq 2">block<else/>none</if>;">
                    网页链接：<input name="txtTargetDesc" type="text" id="txtTargetDesc" class="txt350 readOnly" maxlength="300" value='<if condition="$show.style eq 2"><{$show.content}></if>' />                
                </div>
                <div id="divRelpyNews" class="msg-item-wrapper" style="display:<if condition="$show.style eq 1">block<else/>none</if>;">
                    <div class="msg-item multi-msg">
                        <div class="appmsgItem" flag="0">
                            <p class="msg-meta"><span class="msg-date">&nbsp;</span></p>
                            <div class="cover">
                                <p id="pDefaultTip" class="default-tip" style="display:<if condition='($picarr[0].imgUrl neq "" and $show.style eq 1)'>none</if>;">封面图片</p>
                                <div class="msg-t h4">
                                    <span id="spnTitle" class="i-title"><{$picarr[0].title}></span>
                                </div>
                                <ul class="abs tc sub-msg-opr">
                                    <li class="b-dib sub-msg-opr-item">
                                        <a href="javascript:;" class="th icon18 iconEdit" data-rid="1">编辑</a>
                                    </li>
                                </ul>
                                <img id="imgPic" class="i-img" style="display:<if condition='($picarr[0].imgUrl neq "" and $show.style eq 1)'>block<else/>none</if>;" src="<{$picarr[0].imgUrl}>">
                                <input name="urlTitle" type="hidden" id="urlTitle"  value="<{$picarr[0].urlTitle}>"/>
                            </div>
                        </div>
                        <volist name="picarr" id="vol" offset="1" length="10">
														<div class="rel sub-msg-item appmsgItem " flag="1">
														<span class="thumb">
														<span class="default-tip" style="display:none">缩略图</span>
														<img class="i-img" style="" src="<{$vol.imgUrl}>">
														</span>
														<div class="msg-t h4">
														<span class="i-title"><{$vol.title}></span>
														</div>
														<ul class="abs tc sub-msg-opr">
														<li class="b-dib sub-msg-opr-item">
														<a href="javascript:;" class="th icon18 iconEdit" data-rid="2">编辑</a>
														</li>
														<li class="b-dib sub-msg-opr-item">
														<a href="javascript:;" class="th icon18 iconDel" data-rid="2">删除</a>
														</li>
														</ul>
														<input type="hidden" name="urlTitle"  value="<{$vol.urlTitle}>"/>
														</div>
														</volist>
                        <div class="sub-add">
                            <a href="javascript:;" class="block tc sub-add-btn" onclick="AddNews()"><span class="vm dib sub-add-icon"></span>增加一条</a>
                        </div>
                    </div>
                </div>
                <div id="divSpace" class="space" style="display:none;"></div>
                <div id="addAppmsg" class="addappmsg"  style="display:none;">
                    <div class="tc add-access">
                        <span class="dib vm th add-tip">新建消息入口</span>
                        <a class="dib vm add-btn alink" href="javascript:;" title="指定回复的是网页链接" onclick="SetReplyType('link')">网页链接</a>
                        <a class="dib vm add-btn" href="javascript:;" title="指定回复的是文本消息" onclick="SetReplyType('text')">文本消息</a>
                        <a class="dib vm add-btn multi-access" href="javascript:;" title="指定回复的是多图文消息" onclick="SetReplyType('news')">多图文消息</a>
                    </div>
                </div>
            </div>
            <div class="btnReplyArea">
                <span class="red left" id="snpReplyErr"></span>
                <span id="spnReplyWordsInfo" class="gray left" style="display:<if condition="$show.style eq 0">block<else/>none</if>;">（您还可输入 <span class="red" id="spnCnt">1000</span> 字）</span>
                <span id="spnReplyNewsInfo" class="gray left" style="display:<if condition="$show.style eq 1">block<else/>none</if>;">（鼠标移动到图文上可编辑或删除）</span>
                <span id="spnReplyLinkInfo" class="gray left" style="display:<if condition="$show.style eq 2">block<else/>none</if>;">（请设置链接）</span>
                <a href="javascript:;" class="right block"><button class=" btnAdd c-opr" onclick="return SetReplyType('news')">图文</button></a>
                <a href="javascript:;" class="right block" style="display:none"><button class="addFiles btnAdd c-opr">文件</button></a>
                <a href="javascript:;" class="right block" style="display:none"><button class="addRecording  btnAdd c-opr">录音</button></a>
                <a href="javascript:;" class="right block"><button class="addWords btnAdd c-opr" onclick="return SetReplyType('text')">文字</button></a>
                <a href="javascript:;" class="right block"><button class="addLink btnAdd c-opr" onclick="return SetReplyType('link')">链接</button></a>
            </div>
        </div>
        <div class="btnArea">
            <div id="btnEdit" class="txtc">
                <button type="submit" class="btnGreenS" onclick="return Sumbitmen()"> 保 存 </button>
            </div>
        </div>
    </div>                                
    
<div class="actcover" style="display:none;" unselectable="on"><span></span></div>
<script type="text/javascript">

        $(function () {
            setInterval(SetWinHeight, 100);
            function SetWinHeight() {
                if (typeof (parent.SetWinHeight) == "function")
                    parent.SetWinHeight(document.body.scrollHeight);
            }
            parent.ShowIframe();
        });
        
    </script>
  </form>
</body>
</html>