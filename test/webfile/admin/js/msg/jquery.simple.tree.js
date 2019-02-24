/*
* jQuery SimpleTree Drag&Drop plugin
* Update on 22th May 2008
* Version 0.3
* Download by http://www.codefans.net
* Licensed under BSD <http://en.wikipedia.org/wiki/BSD_License>
* Copyright (c) 2008, Peter Panov <panov@elcat.kg>, IKEEN Group http://www.ikeen.com
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions are met:
*     * Redistributions of source code must retain the above copyright
*       notice, this list of conditions and the following disclaimer.
*     * Redistributions in binary form must reproduce the above copyright
*       notice, this list of conditions and the following disclaimer in the
*       documentation and/or other materials provided with the distribution.
*     * Neither the name of the Peter Panov, IKEEN Group nor the
*       names of its contributors may be used to endorse or promote products
*       derived from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY Peter Panov, IKEEN Group ``AS IS'' AND ANY
* EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
* DISCLAIMED. IN NO EVENT SHALL Peter Panov, IKEEN Group BE LIABLE FOR ANY
* DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
* (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
* ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
* (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
* SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/


$.fn.simpleTree = function(opt, dataJson){
	return this.each(function(){
		var TREE = this;
		var ROOT = $('.root',this);
		var mousePressed = false;
		var mouseMoved = false;
		var dragMoveType = false;
		var dragNode_destination = false;
		var dragNode_source = false;
		var dragDropTimer = false;
		var ajaxCache = Array();

		TREE.option = {
			drag:		true,
			animate:	false,
			autoclose:	false,
			speed:		'fast',
			afterAjax:	false,
			afterMove:	false,
			afterClick:	false,
			afterDblClick:	false,
			afterAddNodeClick:	false,	//点击节点后“添加”按钮
			afterDeleteNodeClick: false,	//点击节点后“删除”按钮
			afterEditNodeClick: false,	//点击节点后的“编辑”按钮
			// added by Erik Dohmen (2BinBusiness.nl) to make context menu cliks available
			afterContextMenu:	false,
			docToFolderConvert:false
		};
		TREE.option = $.extend(TREE.option,opt);
		$.extend(this, {getSelected: function(){
			return $('span.active', this).parent();
		}});
		TREE.closeNearby = function(obj)
		{
			$(obj).siblings().filter('.folder-open, .folder-open-last').each(function(){
				var childUl = $('>ul',this);
				var className = this.className;
				this.className = className.replace('open','close');
				if(TREE.option.animate)
				{
					childUl.animate({height:"toggle"},TREE.option.speed);
				}else{
					childUl.hide();
				}
			});
		};
		TREE.nodeToggle = function(obj)
		{
			var childUl = $('>ul',obj);
			if(childUl.is(':visible')){
				obj.className = obj.className.replace('open','close');

				if(TREE.option.animate)
				{
					childUl.animate({height:"toggle"},TREE.option.speed);
				}else{
					childUl.hide();
				}
			}else{
				obj.className = obj.className.replace('close','open');
				if(TREE.option.animate)
				{
					childUl.animate({height:"toggle"},TREE.option.speed, function(){
						if(TREE.option.autoclose)TREE.closeNearby(obj);
						if(childUl.is('.ajax'))TREE.setAjaxNodes(childUl, obj.id);
					});
				}else{
					childUl.show();
					if(TREE.option.autoclose)TREE.closeNearby(obj);
					if(childUl.is('.ajax'))TREE.setAjaxNodes(childUl, obj.id);
				}
			}
		};
		TREE.setAjaxNodes = function(node, parentId, callback)
		{
			if($.inArray(parentId,ajaxCache) == -1){
				ajaxCache[ajaxCache.length]=parentId;
				var url = $.trim($('>li', node).text());
				if(url && url.indexOf('url:'))
				{
					url=$.trim(url.replace(/.*\{url:(.*)\}/i ,'$1'));
					$.ajax({
						type: "GET",
						url: url,
						contentType:'html',
						cache:false,
						success: function(responce){
							node.removeAttr('class');
							node.html(responce);
							$.extend(node,{url:url});
							TREE.setTreeNodes(node, true);
							if(typeof TREE.option.afterAjax == 'function')
							{
								TREE.option.afterAjax(node);
							}
							if(typeof callback == 'function')
							{
								callback(node);
							}
						}
					});
				}
				
			}
		};
		TREE.setTreeNodes = function($node){

			var className = $node.className;
			var open = false;
			var cloneNode = false;
			var childNode = $('>ul', $node);
			if(childNode.size() > 0) {
				var setClassName = 'folder-';
				if(className && className.indexOf('open') >= 0){
					setClassName = setClassName + 'open';
					open = true;
				}else{
					setClassName = setClassName + 'close';
				}
				$node[0].className = setClassName + (($node.is(':last-child') || $node.next(".line-last").size() > 0) ? '-last' : '');

				if(!open || className.indexOf('ajax') >= 0) childNode.hide();

				TREE.setTrigger($node);
			} else {
				var setClassName = 'doc';
				$node[0].className = setClassName + (($node.is(':last-child') || $node.next(".line-last").size() > 0) ? '-last' : '');
			}

			$node.before('<li class="line">&nbsp;</li>');
			var $parent = $node.parent();
			if ($(">.line-last", $parent).size() == 0) {
				$parent.append('<li class="line-last"></li>');
			}
			
			TREE.setEventLine($('.line, .line-last', $node.parent()));

			//初始化操作按钮
			TREE.setButton($node);

			$('>span', $node).addClass('text').unbind()
			.bind('selectstart', function() {
				return false;
			}).click(function(){
				$('.active',TREE).attr('class','text');
				if(this.className=='text')
				{
					this.className='active';
				}
				if(typeof TREE.option.afterClick == 'function')
				{
					TREE.option.afterClick($(this).parent());
				}
				return false;
			}).dblclick(function(){
				mousePressed = false;
				TREE.nodeToggle($(this).parent().get(0));
				if(typeof TREE.option.afterDblClick == 'function')
				{
					TREE.option.afterDblClick($(this).parent());
				}
				return false;
				// added by Erik Dohmen (2BinBusiness.nl) to make context menu actions
				// available
			}).bind("contextmenu",function(){
				$('.active',TREE).attr('class','text');
				if(this.className=='text')
				{
					this.className='active';
				}
				if(typeof TREE.option.afterContextMenu == 'function')
				{
					TREE.option.afterContextMenu($(this).parent());
				}
				return false;
			}).mousedown(function(event){
				mousePressed = true;
				cloneNode = $(this).parent().clone();
				var LI = $(this).parent();
				if(TREE.option.drag)
				{
					$('>ul', cloneNode).hide();
					$('body').append('<div id="drag_container"><ul></ul></div>');
					$('#drag_container').hide().css({opacity:'0.8'});
					$('#drag_container >ul').append(cloneNode);
					//Modify by David 2013.8.9
					//$("<img>").attr({id	: "tree_plus",src	: "images/plus.gif"}).css({width: "7px",display: "block",position: "absolute",left	: "5px",top: "5px", display:'none'}).appendTo("body");
					$(document).bind("mousemove", {LI:LI}, TREE.dragStart).bind("mouseup",TREE.dragEnd);
				}
				return false;
			}).mouseup(function(){
				if(mousePressed && mouseMoved && dragNode_source)
				{
					TREE.moveNodeToFolder($(this).parent());
				}
				TREE.eventDestroy();
			});
		};
		TREE.setTrigger = function($node){
			if ($(">.trigger", $node).size() == 0) {
				$('>span', $node).before('<img class="trigger" src="'+uurlS+'spacer.gif" border=0>');
				var trigger = $('>.trigger', $node);
				trigger.click(function(event) {
					TREE.nodeToggle($node);
				});
				if(!$.browser.msie)
				{
					trigger.css('float','left');
				}
			}
		};
		TREE.dragStart = function(event){
			var LI = $(event.data.LI);
			if(mousePressed)
			{
				mouseMoved = true;
				if(dragDropTimer) clearTimeout(dragDropTimer);
				if($('#drag_container:not(:visible)')){
					$('#drag_container').show();
					LI.prev('.line').hide();
					dragNode_source = LI;
				}
				$('#drag_container').css({position:'absolute', "left" : (event.pageX + 5), "top": (event.pageY + 15) });
				if(LI.is(':visible'))LI.hide();
				var temp_move = false;
				if(event.target.tagName.toLowerCase()=='span' && $.inArray(event.target.className, Array('text','active','trigger'))!= -1)
				{
					var parent = event.target.parentNode;
					var offs = $(parent).offset({scroll:false});
					var screenScroll = {x : (offs.left - 3),y : event.pageY - offs.top};
					var isrc = $("#tree_plus").attr('src');
					var ajaxChildSize = $('>ul.ajax',parent).size();
					var ajaxChild = $('>ul.ajax',parent);
					screenScroll.x += 19;
					screenScroll.y = event.pageY - screenScroll.y + 5;

					if(parent.className.indexOf('folder-close')>=0 && ajaxChildSize==0)
					{
						//Modify by David 2013.8.9
						//if(isrc.indexOf('minus')!=-1)$("#tree_plus").attr('src','images/plus.gif');
						$("#tree_plus").css({"left": screenScroll.x, "top": screenScroll.y}).show();
						dragDropTimer = setTimeout(function(){
							parent.className = parent.className.replace('close','open');
							$('>ul',parent).show();
						}, 700);
					}else if(parent.className.indexOf('folder')>=0 && ajaxChildSize==0){
						////Modify by David 2013.8.9
						//if(isrc.indexOf('minus')!=-1)$("#tree_plus").attr('src','images/plus.gif');
						$("#tree_plus").css({"left": screenScroll.x, "top": screenScroll.y}).show();
					}else if(parent.className.indexOf('folder-close')>=0 && ajaxChildSize>0)
					{
						mouseMoved = false;
						$("#tree_plus").attr('src','images/minus.gif');
						$("#tree_plus").css({"left": screenScroll.x, "top": screenScroll.y}).show();

						$('>ul',parent).show();
						/*
							Thanks for the idea of Erik Dohmen
						*/
						TREE.setAjaxNodes(ajaxChild,parent.id, function(){
							parent.className = parent.className.replace('close','open');
							mouseMoved = true;
							$("#tree_plus").attr('src','images/plus.gif');
							$("#tree_plus").css({"left": screenScroll.x, "top": screenScroll.y}).show();
						});

					}else{
						if(TREE.option.docToFolderConvert)
						{
							$("#tree_plus").css({"left": screenScroll.x, "top": screenScroll.y}).show();
						}else{
							$("#tree_plus").hide();
						}
					}
				}else{
					$("#tree_plus").hide();
				}
				return false;
			}
			return true;
		};
		TREE.dragEnd = function(){
			if(dragDropTimer) clearTimeout(dragDropTimer);
			TREE.eventDestroy();
		};
		TREE.setEventLine = function($node) {
			$node.unbind();
			$node.mouseover(function(){
				if(this.className.indexOf('over')<0 && mousePressed && mouseMoved)
				{
					this.className = this.className.replace('line','line-over');
				}
			}).mouseout(function(){
				if(this.className.indexOf('over')>=0)
				{
					this.className = this.className.replace('-over','');
				}
			}).mouseup(function(){
				if(mousePressed && dragNode_source && mouseMoved)
				{
					dragNode_destination = $(this).parents('li:first');
					TREE.moveNodeToLine(this);
					TREE.eventDestroy();
				}
			});
		};
		TREE.checkNodeIsLast = function(node)
		{
			if(node.className.indexOf('last')>=0)
			{
				var prev_source = dragNode_source.prev().prev();
				if(prev_source.size()>0)
				{
					prev_source[0].className+='-last';
				}
				node.className = node.className.replace('-last','');
			}
		};
		TREE.checkLineIsLast = function(line)
		{
			if(line.className.indexOf('last')>=0)
			{
				var prev = $(line).prev();
				if(prev.size()>0)
				{
					prev[0].className = prev[0].className.replace('-last','');
				}
				dragNode_source[0].className+='-last';
			}
		};
		TREE.eventDestroy = function()
		{
			// added by Erik Dohmen (2BinBusiness.nl), the unbind mousemove TREE.dragStart action
			// like this other mousemove actions binded through other actions ain't removed (use it myself
			// to determine location for context menu)
			$(document).unbind('mousemove',TREE.dragStart).unbind('mouseup').unbind('mousedown');
			$('#drag_container, #tree_plus').remove();
			if(dragNode_source)
			{
				$(dragNode_source).show().prev('.line').show();
			}
			dragNode_destination = dragNode_source = mousePressed = mouseMoved = false;
			//ajaxCache = Array();
		};
		TREE.convertToFolder = function(node){
			node[0].className = node[0].className.replace('doc','folder-open');
			node.append('<ul class="level2"><li class="line-last"></li></ul>');
			TREE.setTrigger(node[0]);
			TREE.setEventLine($('.line, .line-last', node));
		};
		TREE.convertToDoc = function(node){
			$('>ul', node).remove();
			$('img', node).remove();
			node[0].className = node[0].className.replace(/folder-(open|close)/gi , 'doc');
		};
		TREE.moveNodeToFolder = function(node)
		{
			//Modify by David 2013.8.9
			//不能移动到文件夹
			return false;

			if(!TREE.option.docToFolderConvert && node[0].className.indexOf('doc')!=-1)
			{
				return true;
			}else if(TREE.option.docToFolderConvert && node[0].className.indexOf('doc')!=-1){
				TREE.convertToFolder(node);
			}
			TREE.checkNodeIsLast(dragNode_source[0]);
			var lastLine = $('>ul >.line-last', node);
			if(lastLine.size()>0)
			{
				TREE.moveNodeToLine(lastLine[0]);
			}
		};
		TREE.moveNodeToLine = function(node){

			//Modify by David 2013.8.9
			//如果移动的目标和移动的对象都处于同一父节点下，并且都是最后一个节点，则不允许移动
			if (node.className.indexOf("-last") >= 0
				&& dragNode_source[0].className.indexOf("-last") >= 0
				&& $(dragNode_source).parents('li:first').attr('id') == $(node).parents('li:first').attr("id"))
			{
				return false;
			}

			//不能移动文件夹（自定义菜单只有二级）
			//if ($(node).parents('li:first')[0].className.indexOf('folder') >= 0
			//	&& dragNode_source[0].className.indexOf('folder') >= 0) {
			//	return false;
			//}

			//只能同级移动
			if ($(dragNode_source).parents('li:first').attr('id') != $(node).parents('li:first').attr("id")){
				return false;
			}

			TREE.checkNodeIsLast(dragNode_source[0]);
			TREE.checkLineIsLast(node);
			var parent = $(dragNode_source).parents('li:first');
			var line = $(dragNode_source).prev('.line');
			$(node).before(dragNode_source);
			$(dragNode_source).before(line);
			node.className = node.className.replace('-over','');
			var nodeSize = $('>ul >li', parent).not('.line, .line-last').filter(':visible').size();
			if(TREE.option.docToFolderConvert && nodeSize==0)
			{
				TREE.convertToDoc(parent);
			}else if(nodeSize==0)
			{
				parent[0].className=parent[0].className.replace('open','close');
				$('>ul',parent).hide();
			}

			// added by Erik Dohmen (2BinBusiness.nl) select node
			if($('span:first',dragNode_source).attr('class')=='text')
			{
				$('.active',TREE).attr('class','text');
				$('span:first',dragNode_source).attr('class','active');
			}

			if(typeof(TREE.option.afterMove) == 'function')
			{
				var pos = $(dragNode_source).prevAll(':not(.line)').size();
				TREE.option.afterMove($(node).parents('li:first'), $(dragNode_source), pos);
			}


		};

		//Modify by David 2013/8/10
		TREE.addNode = function(id, text, $parentNode)
		{
			var $temp_node = $('<li id="' + id + '"><span>' + text + '</span><div class="right"></div></li>');

			//要添加到的父节点为根节点，即添加的是一级节点
			if ($parentNode.hasClass("root")) {	//父级为根节点
				//先更新同辈节点，去掉“最后一个”样式
				var $last = $(">ul >.folder-open-last,>ul >.folder-close-last, >ul >.doc-last", $parentNode);
				if ($last.size() > 0) $last[0].className = $last[0].className.replace('-last','');
				//如果已经有兄弟节点，则添加到“line-last”之前
				var $last_line = $(">.level1 >.line-last", $parentNode) 
				if ($last_line.size() > 0)
					$last_line.before($temp_node);
				else
					$temp_node.appendTo($(">.level1", $parentNode));
			} else {	//父节点非根节点，即添加的是二级节点
				//父节点不是文件夹，则提示并转换为文件夹
				if ($(">ul", $parentNode).size() == 0) {
					TREE.convertToFolder($parentNode);
				}
				//先更新同辈节点，去掉“最后一个”样式
				var $last = $(">ul >.doc-last", $parentNode);
				if ($last.size() > 0) $last[0].className = $last[0].className.replace('-last', '');
				//如果已经有兄弟节点，则添加到“line-last”之前
				var $last_line = $(">.level2 >.line-last", $parentNode) 
				if ($last_line.size() > 0)
					$last_line.before($temp_node);
				else
					$temp_node.appendTo($(">.level2", $parentNode));
				//设置父级的按钮
				TREE.setButton($parentNode);
			}

			TREE.setTreeNodes($temp_node);
			return $temp_node;
		};
		TREE.editNode = function($node, name)
		{
			$(">span", $node).text(name);
		};
		TREE.delNode = function($node)
		{
			var $parentUL = $node.parent();
			var $parentNode = $parentUL.parent();
			var isLast = $node[0].className.indexOf("-last") > 0 ? true : false;
			$node.prev().remove();	//删除line
			$node.remove();	//删除节点
			//删除的是二级节点
			if ($parentUL.hasClass("level2")) {
				//如果父节点下所有二级节点都删除掉了，则父节点自动变为doc
				if ($(">li:not('.line,.line-last')", $parentUL).size() == 0) {
					TREE.convertToDoc($parentNode);
				}
			}
			//如果删除的是最后一个节点，则处理前一个节点的样式
			if (isLast) {
				var $lastLi = $(">li:not('.line,.line-last'):last", $parentUL);
				if ($lastLi.size() > 0) 
					$lastLi[0].className = $lastLi[0].className + "-last";
			}
			//初始化按钮
			TREE.setButton($parentNode);
		};
		//初始化按钮
		TREE.setButton = function($node) {
			$(">.right", $node).html('');
			if ($node.hasClass("root")) {	//顶级
				if ($(">.level1 >li:not('.line,.line-last')", $node).size() < 3) {	//未够三个一级子菜单
					//添加一级菜单
					$('<i class="add add-level1" title="添加一级菜单"></i>').click(function(){

						if(typeof (TREE.option.afterAddNodeClick) == 'function')
						{
							TREE.option.afterAddNodeClick($(this).parents('li:first'), 1);
						}

						return false;
					}).appendTo($(">.right", $node));
				}
			} else {
				//添加二级子菜单
				if ($node.parents('ul:first').hasClass("level1")) { //一级菜单
					//未够五个二级子菜单时，可添加二级子菜单
					if ($(">.level2 >li:not('.line,.line-last')", $node).size() < 5) {
						$('<i class="add add-level2" title="添加二级子菜单"></i>').click(function(){

							if(typeof (TREE.option.afterAddNodeClick) == 'function')
							{
								TREE.option.afterAddNodeClick($(this).parents('li:first'), 2);
							}

							return false;
						}).appendTo($(">.right", $node));
					}
				}

				//编辑菜单
				$('<i class="editmenu" title="编辑菜单"></i>').click(function(){

					if(typeof (TREE.option.afterEditNodeClick) == 'function')
					{
						TREE.option.afterEditNodeClick($(this).parents('li:first'));
					}

					return false;
				}).appendTo($(">.right", $node));

				//一级菜单无下级或者二级菜单时，可删除菜单
				if (($node.parents('ul:first').hasClass("level1") && $(">ul", $node).size() == 0)
						|| $node.parents('ul:first').hasClass("level2")) {
					//删除菜单
					$('<i class="del" title="删除菜单"></i>').click(function(){
						
						if(typeof (TREE.option.afterDeleteNodeClick) == 'function')
						{
							TREE.option.afterDeleteNodeClick($(this).parents('li:first'));
						}

						return false;
					}).appendTo($(">.right", $node));
				}
			}
		};
		TREE.getListJson = function() {
			
			var json = [];
			$(">li:not('.line,.line-last')", $(".root .level1")).each(function(){
				var id = $(this).attr("id");
				var name = $(">span", $(this)).text();
				var hasChilds = $(">ul >li:not('.line,.line-last')", $(this)).size() > 0 ? "1" : "0";
				if (hasChilds == "1") {
					var childs = [];
					$(">ul >li:not('.line,.line-last')", $(this)).each(function(){
						childs.push({"id": $(this).attr("id"), "name": $(">span", $(this)).text()});
					});
					json.push({"id": id, "name": name, "hasChilds": hasChilds, "childs": childs});
				}
				else {
					json.push({"id": id, "name": name, "hasChilds": hasChilds});
				}
			});
			return json;

		};
		TREE.init = function(obj, dataJson)
		{
			//TREE.setTreeNodes(obj, false);
			//Add by David 2013/8/10
			//初始化节点的操作按钮
			//$("li:not('.line,.line-last')", obj.andSelf()).each(function(){
			//	SetButton($(this));
			//});

			//根据json初始数据初始化到Tree中
			if (dataJson){
				for(var i=0; i<dataJson.length; i++) {
					var $level1_Node = TREE.addNode(dataJson[i].id, dataJson[i].name, ROOT);
					if (dataJson[i].hasChilds == "1") {
						for(var k=0; k<dataJson[i].childs.length; k++) {
							TREE.addNode(dataJson[i].childs[k].id, dataJson[i].childs[k].name, $level1_Node);
						}
					}
				}
			}
			//初始化根节点按钮
			TREE.setButton(ROOT);
		};
		TREE.init(ROOT, dataJson);
	});
}