<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<link href="<{:C('web_url')}>__WJ__/css/wx.css" rel="stylesheet" type="text/css" />
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
	
<include file="Pub:js" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">添加回复规则</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="contentbox">
	<form  method="post" action="<{:C('web_url')}>__APP__/weix_keysadd" id="myformly" name="myformly">
	<input name="hidKeyword" type="hidden" id="hidKeyword" />
    <input name="hidReplyType" type="hidden" id="hidReplyType" />
    <input name="hidNews" type="hidden" id="hidNews" />
	<input name="ly" type="hidden" value="<{$ly}>" />
	<table id="TableList" width="100%" class="tbmodify" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="80" class="tdtitle"><span class="red">*</span>规则名：</td>
                            <td>
                                <input name="txtRuleName" type="text" maxlength="60" id="txtRuleName" class="txt350" />
                                <span class="gray">（规则名最多60个字）</span>                            </td>                    
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="float-p">
                                    <div class="left keywordsList">
                                        <div class="cLine header">
                                            <span class="left b">关键字</span>                                        </div>
                                        <ul id="keywordItems" class="keywordItems">
                                        </ul>
                                        <div class="btnArea float-p">
                                            <button class="delKeyword btnGreenS left" onclick="return DeleteKeyword()">删除选中</button>
                                            <button class="addKeyword btnGrayS right" onclick="return ShowAddKeyword()">添加关键字</button>
                                        </div>
                                    </div>
                                    <div class="replyList">
                                        <div class="cLine header">
                                            <p class="left b">回复内容</p>
                                            <p class="right red">（注意：禁止发布色情、反动、暴力等违规内容。）</p>
                                        </div>
                                        <div class="cntBox">
                                            <p class="left">回复类型：<span id="returnType" rType=""></span></p>
                                            <span id="spnAddLink" class="addlink hide">
                                                <a title="插入指定链接标记" href="#" onclick="SelTarget()">插入链接</a>
                                               <!-- <a title="插入导航目录标记" href="#" onclick="AddMenu()">导航目录</a>
                                                <a title="插入关注公众号标记" href="#" onclick="AddSubscribeMark()">关注公众号</a>-->                                            </span>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="replyItems showWords showFile showAppMsg">
                                            <div id="divReplyWords" style="display:none;">
                                                <textarea name="txtReplyWords" id="txtReplyWords" onblur="CheckReplyWords()" placeholder="请在此输入您的回复内容，1000字以内" autocomplete="off" class="txtarea"></textarea>
                                            </div>
                                            <div id="divRelpyNews" class="msg-item-wrapper" style="display:none;">
                                                <div class="msg-item multi-msg">
                                                    <div class="appmsgItem" flag="0">
                                                        <p class="msg-meta"><span class="msg-date">&nbsp;</span></p>
                                                        <div class="cover">
                                                            <p id="pDefaultTip" class="default-tip" style="">封面图片</p>
                                                            <div class="msg-t h4">
                                                                <span id="spnTitle" class="i-title"></span>                                                            </div>
                                                            <ul class="abs tc sub-msg-opr">
                                                                <li class="b-dib sub-msg-opr-item">
                                                                    <a href="javascript:;" class="th icon18 iconEdit" data-rid="1">编辑</a>                                                                </li>
                                                            </ul>
                                                            <img id="imgPic" class="i-img" style="display:none;" />
                                                            <input name="urlTitle" type="hidden" id="urlTitle" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="sub-add">
                                                        <a href="javascript:;" class="block tc sub-add-btn" onclick="AddNews()"><span class="vm dib sub-add-icon"></span>增加一条</a>                                                    </div>
                                                </div>
                                            </div>
                                            <div id="divSpace" class="space" style="display:none;">&nbsp;</div>
                                            <div id="addAppmsg" class="addappmsg">
                                                <div class="tc add-access">
                                                    <span class="dib vm th add-tip">新建消息入口</span>
                                                    <a class="dib vm add-btn" href="javascript:;" title="指定回复的是文本消息" onclick="SetReplyType('text')">文本消息</a>
                                                    <a class="dib vm add-btn multi-access" href="javascript:;" title="指定回复的是多图文消息" onclick="SetReplyType('news')">多图文消息</a>                                                </div>
                                            </div>
                                        </div>
                                        <div class="btnArea float-p">
                                            <span class="red left" id="snpReplyErr"></span>
                                            <span id="spnReplyWordsInfo" class="gray left" style="display:none;">（您还可输入 <span class="red" id="spnCnt">1000</span> 字）</span>
                                            <span id="spnReplyNewsInfo" class="gray left" style="display:none;">（鼠标移动到图文上可编辑或删除）</span>
                                            <a href="javascript:;" class="right block"><button class="btnAdd c-opr" onclick="return SetReplyType('news')">图文</button></a>
                                            <a href="javascript:;" class="right block" style="display:none"><button class="addFiles btnAdd c-opr">文件</button></a>
                                            <a href="javascript:;" class="right block" style="display:none"><button class="addRecording  btnAdd c-opr">录音</button></a>
                                            <a href="javascript:;" class="right block"><button class="addWords btnAdd c-opr" onclick="return SetReplyType('text')">文字</button></a>                                        </div>
                                    </div>
                                </div>                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value=" 保存修改 " onclick="return CheckFormkey();" id="btnEnter" class="btn btn_submit" />&nbsp;
                                <input type="reset" value="重置" class="btn"/>                           </td>
                        </tr>
                    </tbody>
                </table>                                
      </form>
	</div>
	</div>
</body>
</html>