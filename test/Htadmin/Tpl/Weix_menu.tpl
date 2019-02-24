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
	
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/FunLib.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/msg/jquery.simple.tree.js"></script>


<script type="text/javascript">        
        function Edit(id, parent) {
            if (id == null || id =='')
                MsgBox.OpenWin({ id: 'MenuEdit', title: '添加', width: 600, height: 280, url: '<{:C('web_url')}>__APP__/weix_menuadd?parent=' + parent });
            else
                MsgBox.OpenWin({ id: 'MenuEdit', title: '编辑', width: 600, height: 220, url: '<{:C('web_url')}>__APP__/weix_menuadd?act=edit&id=' + id });
        }

        var $actNode = null;
        var simpleTreeCollection;
        $(function () {
            ShowLoading();
            simpleTreeCollection = $('.simpleTree').simpleTree({
                afterClick: function ($node) {
                    ShowLoading();
                    //如果选中的是文件夹（有二级菜单的节点），则显示无法设置响应操作
                    if ($node.parent().hasClass("level1") && ($node[0].className && $node[0].className.indexOf("folder") >= 0)) {
                        ShowRemind('所选菜单下有二级菜单，无法为其设置响应动作');
                    }
                    else {
                        $("#ifmEdit").attr("src", "<{:C('web_url')}>__APP__/weix_menunr?id=" + $node.attr("id"));
                    }
                },
                afterDblClick: function ($node) {
                    //alert("text-"+$('span:first',node).text());
                },
                afterMove: function (destination, source, pos) {
                    //alert("destination-"+destination.attr('id')+" source-"+source.attr('id')+" pos-"+pos);

                },
                afterAjax: function () {
                    //alert('Loaded');
                },
                afterAddNodeClick: function($node, level) {
                    $actNode = $node;
                    //添加的是二级菜单：如果一级菜单下没有二级菜单，则提示清理一级菜单的回复内容
                    if (level == "2" && $(">.level2", $node).size() == 0) {
                        asyncbox.confirm('添加二级菜单后，原来一级菜单的回复内容将会被清除，确定要添加吗？', '温馨提示', function (action) {
                            if (action == 'ok') {
                                Edit("", $node.attr("id"));
                            }
                        });
                    } else {
                        Edit("", $node.attr("id"));
                    }
                },
                afterEditNodeClick: function($node) {
                    $actNode = $node;
                    Edit($node.attr("id"), "");
                },
                afterDeleteNodeClick: function ($node) {
                    var role = 'True';
                    if (role == "False") {
                        MsgBox.ErrorMsg("你没有此操作权限！");
                        return;
                    }
                    asyncbox.confirm('确定要删除此菜单项吗？', '温馨提示', function (action) {
                        if (action == 'ok') {
                            $.get("<{:C('web_url')}>__APP__/weix_menudel?id=" + $node.attr("id"), function (res) {
                                if (res=="ok"){
                                    simpleTreeCollection[0].delNode($node);
                                    MsgBox.SuccessMsg('操作成功');
                                } else {
                                    MsgBox.ErrorMsg(res);
                                }
                            });
                        }
                    });
                },
                animate: true
                //,docToFolderConvert:true
            }, $.parseJSON($("#hidTreeJson").val()));
            //11
            if ($(">ul >li", $(".root")).size() == 0) {
                ShowRemind('您可以先点击左侧菜单列表中“+”号添加菜单，然后开始为其设置响应动作');
            }
            else {
                ShowRemind('请点选左侧菜单节点，然后为其设置响应动作');
            }
            $(".required", $("#divWait")).show();
        });

        //显示loading 11
        function ShowLoading() {
            $("#ifmEdit").hide();
            $("#ifmEdit").attr("src", "#");
            $(".required", $("#divWait")).hide();
            $(".wait,.loading,.cover,.bottom", $("#divWait")).show();
			<if condition="($Think.get.cu eq '1')">
			MsgBox.SuccessMsg('<{$Think.get.mesg}>');
			<else/>
		    MsgBox.ErrorMsg('<{$Think.get.mesg}>');
			</if>			
        }
        //显示提示信息
        function ShowRemind(msg) {
            $("#ifmEdit").hide();
            $("#ifmEdit").attr("src", "#");
            $(".loading,.cover", $("#divWait")).hide();
            $("#divWait .required").text(msg);
            $(".required", $("#divWait")).andSelf().show();
        }
        //显示Iframe中内容
        function ShowIframe() {
            $("#divWait").hide();
            $("#ifmEdit").show();
        }
        //添加成功
        function AddSuccess(id, tit) {
            simpleTreeCollection[0].addNode(id, tit, $actNode);
        }
        //编辑成功
        function EditSuccess(tit) {
            simpleTreeCollection[0].editNode($actNode, tit);
        }
        //保存排序
        function SaveSort() {
            $("#hidTreeJson").val(JSON.stringify(simpleTreeCollection[0].getListJson()));
            $("#hidAct").val("4");
            return true;
        }
        //发布
        function Publish() {
            if (confirm('确定要向公众账号发布自定义菜单吗？')) {
                $("#hidAct").val("1");
                return true;
            }
            return false;
        }
        //停用
        function Disabled() {
            if (confirm('确定要停用公众账号的自定义菜单设置吗？')) {
                $("#hidAct").val("3");
                return true;
            }
            return false;
        }
        //演示
        function Demo() {

            var json = simpleTreeCollection[0].getListJson();

            var html = '';
            for (var i = 0; i < json.length; i++) {
                if (i > 0) html += '<div class="split">&nbsp;</div>';
                html += '<div class="bg_nav">';
                html += '    <a ' + (json[i].hasChilds == "0" ? 'class="nochilds" ' : '') + 'href="javascript:void(0);">' + json[i].name  + '</a>';
                if (json[i].hasChilds == "1") {
                    html += '<div class="tcc">';
                    html += '    <ul>';
                    for(var k = 0; k < json[i].childs.length; k++){
                        html += '        <li' + (k == (json[i].childs.length - 1) ? ' class="li-last"' : '') + '>' + json[i].childs[k].name + '</li>';
                    }
                    html += '    </ul>';
                    html += '    <p class="botimg"></p>';
                    html += '</div>';
                }
                html += '</div>';
            }
            $(".democover .mgbot").html(html);
            $(".democover").show().height($(document.body).height());
            $(".democover .nei").offset({ left: ($(document.body).width() - $(".democover .nei").width()) / 2});

            $(".bg_nav").each(function () {
                $(this).click(function () {
                    var a = 0;
                    $(".tcc").hide();
                    $(this).find(".tcc").show();
                })
            })
            $("#clos").click(function () {
                $(".democover").hide();
            })

            $("#a1").mouseover(function () {
                $(this).addClass("ahover");
            }).mouseleave(function () {
                $(this).removeClass("ahover");
            })

            $(".tcc").find("li").each(function () {
                $(this).hover(function () {
                    $(this).addClass("ihover");
                }).mouseleave(function () {
                    $(this).removeClass("ihover");
                })
            })

            return false;
        }
    </script>
<include file="Pub:js" />
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">自定义菜单管理</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="hyinfo"><b class="text-ts">
1、使用本模块，必须在微信公众平台申请自定义菜单使用的AppId和AppSecret，然后在【微信绑定设置】中设置。<br />
2、最多创建3 个一级菜单，每个一级菜单下最多可以创建 5 个二级菜单，菜单最多支持两层。<br />
3、拖动树形菜单再点击“保存排序”可以对菜单重排序，但最终只有“发布”后才会生效。公众平台限制了每天的发布次数。<br />
4、公众平台规定，菜单发布24小时后生效。如果为新增粉丝，则可马上看到菜单。<br />
</b></div>

	<div class="clear"></div>
	<div class="contentbox">
	<form  method="post" action="<{:C('web_url')}>__APP__/weix_menu" id="myformly" name="myformly">
	<table width="100%" border="0" cellpadding="0" cellspacing="1">
	<tr>
    <th width="13%"></th>
    <td width="87%"><div class="messg"></div></td>
  </tr>
    <tr>
      <th colspan="2">
	  <div class="float-p">
                    <div class="left">
                        <div class="menu">
	                        <ul class="simpleTree">
		                        <li class="root" id='0'>
			                        <span>自定义菜单列表</span>
			                        <div class="right">
				                        <i class="add add-level1" title="添加一级菜单"></i>
			                        </div>
			                        <ul class="level1">
			                        </ul>
		                        </li>
	                        </ul>
                        </div>
                        <div class="btnArea">
                            <button type="submit" class="btnGreenS" onclick="return Publish()"> 发 布 </button>
                            <button type="submit" class="btnGreenS" onclick="return Demo()"> 预 览 </button>
                            <button type="submit" class="btnGreenS" onclick="return Disabled()"> 停 用 </button>
                            <!--<button type="submit" class="btnGreenS" onclick="return SaveSort()">保存排序</button>-->
                            <input name="hidAct" type="hidden" id="hidAct" />
                        </div>
                        <input name="hidTreeJson" type="hidden" id="hidTreeJson" value='<{$hidTreeJson}>'/>
                    </div>

                    <div class="replyList">
                        <div class="cLine header">
                            <p class="left b">菜单动作</p>
                            <p class="right red">（注意：禁止发布色情、反动、暴力等违规内容。）</p>
                        </div>
                        <div id="divWait" class="wait">
                            <div class="loading"></div>
                            <div class="cover" unselectable="on"></div>
                            <div class="required hide">未选中任何记录</div>
                            <div class="bottom">&nbsp;</div>
                        </div>
                        <iframe id="ifmEdit" src="#" style="width:100%;display:none;" frameborder="0" scrolling="no" border="0"></iframe>
                    </div>
                </div>
                                        </th>
      </tr>    
</table>  
<div class="democover hide">
        <div class="nei">
            <div id="clos" class="clos"></div>
            <div id="shopName" class="mgtop">阅览效果</div>
            <div class="mgcen"></div>
            <div class="mgbot">
            </div>
        </div>
    </div>                              
      </form>
	  <script type="text/javascript">
        //设定窗口高度
        function SetWinHeight(height) {
            $("#ifmEdit").height(height);
        }
    </script>
	</div>
	</div>
</body>
</html>