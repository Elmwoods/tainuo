// JavaScript Document
$(document).ready(function(){
//分类关联品牌ok
$("#pipei4").change(function(){							 
                       var classid=$(this).val();
					   var data=$(this).attr("data");	
					   var ppclassid=$(this).attr("rel");	
					   var obj=$("#pipei2");
					   url=urlS+"pub_pro.html";	
					    $.post(url,{"data":data,"classid":classid,"ppclassid":ppclassid},function(res){																				
						obj.html(res);						
						});		
					 
					});
$("#pipei").change(function(){
					   var data=$(this).attr("data");						   
                       var classid=$(this).val();
					   var obj=$("#pipei1");
					   var obj1=$("#pipei2");
					   url=urlS+"pub_ppgl.html";	
					    $.post(url,{"data":data,"classid":classid},function(res){																				
						obj.html(res);	
						obj1.html('<option value="0" selected>选择对象</option>');
						});		
					 
					});
$("#pipei1").change(function(){
					   var classid=$("#pipei").val();
                       var ppclassid=$(this).val();
					   var data=$(this).attr("data");		
					   var obj=$("#pipei2");
					   url=urlS+"pub_pro.html";	
					    $.post(url,{"data":data,"classid":classid,"ppclassid":ppclassid},function(res){																				
						obj.html(res);						
						});		
					 
					});
$("#pipei2").change(function(){
							 
                       var id=$(this).val();
					   var data=$(this).attr("data");
					   var rel=$(this).attr("rel");
					   url=urlS+rel+"&id="+id;						   
					   document.location.href=url;	
					 
					});
//$("#pipei2").change(function(){
//                       var id=$(this).val();
//					   var data=$(this).attr("data");
//					   var obj=$("input[name='cs[]']");
//					   url=urlS+"pub_pro1.html";	
//					   $.post(url,{"data":data,"id":id},function(res){																				
//					   tdnr = res.split("||");
//					   sun=tdnr.length;
//					   for(i=0;i<sun;i++){
//						   obj.eq(i).val(tdnr[i]);
//						   }
//						});		
//					 
//					});
//分类关联品牌ok   
$("#ldclassid").change(function(){
					   var data=$(this).attr("data");						   
                       var classid=$(this).val();
					   var obj=$("#ppclassid");
					   url=urlS+"pub_ppgl.html";	
					    $.post(url,{"data":data,"classid":classid},function(res){	
						obj.html(res);						
						});		
					 
					});
//6-1
$("input[name='tj[]']").click(function(){
					   var aid=$(this).attr("data");
					   var data=$(this).attr("title");
					   var cvalue=$(this).is(":checked");
					   var url=urlS+"pub_tj.html";					  
					   if(cvalue){
					  //if(cvalue=="checked"){
						//添加推荐
						$.post(url,{"aid":aid,"data":data,"ishot":1});   
						}else{
						//取消推荐
						$.post(url,{"aid":aid,"data":data,"ishot":0});  	
						}
					});
//6-1
$("#nodecatEditor ").on("click","#dj1",function(){
var dx=$(this).attr("title");
var src=$(this).attr("src");
if(src.indexOf("hb.png") > 0 )
{
src=src.replace("hb.png","zk.png"); 
$(this).attr("src",src);
$(this).parent().parent().siblings("#xj"+dx).show();
var src1=$(this).parent().parent().siblings("#xj"+dx).find("#dj2").attr("src");
if (typeof(src1) !== "undefined") {
if(src1.indexOf("zk.png") > 0 )src1=src1.replace("zk.png","hb.png"); 
}
$(this).parent().parent().siblings("#xj"+dx).find("#dj2").attr("src",src1);
}
else{
src=src.replace("zk.png","hb.png"); 
$(this).attr("src",src);
$(this).parent().parent().siblings("#xj"+dx).hide();
var src1=$(this).parent().parent().siblings("#xj"+dx).find("#dj2").attr("src");
if (typeof(src1) !== "undefined") {
if(src1.indexOf("zk.png") > 0 )src1=src1.replace("zk.png","hb.png"); 
}
$(this).parent().parent().siblings("#xj"+dx).find("#dj2").attr("src",src1);
}
$(this).parent().parent().siblings(".xj"+dx).hide();
});
//ok
$("#nodecatEditor #dj2").click(function(){
var dx=$(this).attr("title");
var src=$(this).attr("src");
if(src.indexOf("hb.png") > 0 )
{
src=src.replace("hb.png","zk.png"); 
$(this).attr("src",src);
$(this).parent().parent().siblings("#xj"+dx).show();
}
else{
src=src.replace("zk.png","hb.png"); 
$(this).attr("src",src);
$(this).parent().parent().siblings("#xj"+dx).hide();
}
});

//编辑排序ok
$('#edit-nodecatsort').click(function(){
	tm=$(this).children("span").children("span").html();
	if(tm=="编辑排序"){
	$(this).children("span").children("span").html($(this).attr("tmplabel"));
	$(this).children("span").children("span").css('color','#ff0000');
	$("input[vtype='unsigned']").each(function(i){  
	$(this).show();  
	$(this).siblings("b").hide();       
    }); 
	}
	else{
	document.getElementById('nodecatEditor').submit()
	}
	});
	
}); 
//6-1
function passed(sjk,id){
	var htmls=$("#passed_"+id).html();
	if(htmls.indexOf("no.gif") > 0 )
	{
	var passed="1";
	htmls=htmls.replace("no.gif","yes.gif"); 
	htmls=htmls.replace("已禁用","已发布");
	$("#passed_"+id).removeClass("red"); 
	$("#passed_"+id).html(htmls);
	}
	else{
	var passed="0";
	htmls=htmls.replace("yes.gif","no.gif"); 
	htmls=htmls.replace("已发布","已禁用");	
	$("#passed_"+id).addClass("red"); 
	$("#passed_"+id).html(htmls);
		}
	var url=urlS+"pub_passed.html";
	if(sjk!="" && id!="" && passed!=""){
	$.post(url,{"sjk":sjk,"id":id,"passed":passed}); 
	}
}
//处理状态ok
function passed1(sjk,id){
	var htmls=$("#passed_"+id).html();
	if(htmls.indexOf("no.gif") > 0 )
	{
	var passed="1";
	htmls=htmls.replace("no.gif","yes.gif"); 
	htmls=htmls.replace("未处理","已处理");
	$("#passed_"+id).removeClass("red"); 
	$("#passed_"+id).html(htmls);
	}
	else{
	var passed="0";
	htmls=htmls.replace("yes.gif","no.gif"); 
	htmls=htmls.replace("已处理","未处理");	
	$("#passed_"+id).addClass("red"); 
	$("#passed_"+id).html(htmls);
		}
	var url=urlS+"pub_passed1.html";
	if(sjk!="" && id!="" && passed!=""){
	$.post(url,{"sjk":sjk,"id":id,"passed":passed}); 
	}
}
//6-1
function deleteRow(sjk,id,fild,sjk1,prvid,ur){
	parent.asyncbox.confirm('确定要删除吗？', '温馨提示', function (action) {
	if (action == 'ok') {
	
	if(sjk!="" && id!="" && fild!=""){
	var url=urlS+"pub_dell.html?sjk="+sjk+"&id="+id+"&fild="+fild+"&sjk1="+sjk1;
	$.get(url,function (res) {
                                if (res=="ok"){                                    
                                    MsgBox.SuccessMsg('操作成功');
var timestamp1 = Date.parse(new Date());  
var timestamp2 = (new Date()).valueOf();  
var timestamp3 = new Date().getTime();
sj=timestamp1+"" + timestamp2 + "" + timestamp3;
									window.parent.frames['main'].document.location=urlS+ur+".html?classid="+prvid+"&sj="+sj+"#"+prvid+"";									//window.parent.frames['main'].location.reload()
                                } else {
                                    MsgBox.ErrorMsg(res);
                                }
                            });
	}
	
	}
	});	
	}
//ok	
function CA(){ 
var cd=document.nodecatEditor.articleid.length;
if (typeof(cd) == "undefined") { 
    $("input[type='checkbox']").attr("checked",document.nodecatEditor.allbox.checked);
}else{
	for(var i=0;i<document.nodecatEditor.articleid.length;i++){ 
	
	var e=document.nodecatEditor.articleid[i]; 
	
	if(e.name!='allbox') e.checked=document.nodecatEditor.allbox.checked; 
	
	} 
}

} 
//ok
function ConfirmDel()

{

   if(confirm("确定要删除选中的记录吗？一旦删除将不能恢复！"))

     return true;

   else

     return false;

	 

}