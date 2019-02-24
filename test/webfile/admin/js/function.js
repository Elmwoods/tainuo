//6-1
function submitfrom(path){
	var username=$("#username").val();
	password=$("#password").val();
	code=$("#code").val();
	var n=0;
	if(!strNoEmpty(username,"请输入用户名!")) n=1;
	if(n==0){
		if(!strNoEmpty(password,"请输入密码!")) n=1;
	}
	if(n==0){
		if(!strNoEmpty(code,"请输入验证码!")) n=1;
	}
	if(n==0){
		$("#login").attr("action", path);
		$('#login').submit();
	}
}
//6-1
function formReset(){
  document.getElementById("login").reset()
}
//6-1
function reloa(){
	//window.location.reload();
	var m=document.getElementById('main').contentWindow.location.href;
	var m1 = $('#menu').attr('src'); 
    if(m1.indexOf("b=1")>0){
	    $('#menu').attr('src', m1);
	}else{		
		$('#menu').attr('src', m1+"&b=1");
	}
	$('#main').attr('src', m);
	//document.getElementById('menu').contentWindow.location.reload(true);
	//document.getElementById('main').contentWindow.location.reload(true);
}
//6-1
function changeheight(){
	var seeheight=document.documentElement.clientHeight;
	var seewidth=document.documentElement.clientWidth;
	var menubox=document.getElementById("menuBox");
	var centerBar=document.getElementById("centerBar");
	var rightBox=document.getElementById("rightbox");
	menubox.style.height=seeheight-119+"px";
	centerBar.style.height=seeheight-80+"px";
	rightBox.style.width=seewidth-234+"px";
	rightBox.style.height=seeheight-80+"px";
}
//6-1
var isHide = true;
function hideMenu() {
        if (isHide) {
            $(".leftbox").hide();
            $(".centerBar").css("left", "0px");
            $(".rightbox").css("left", "18px");
			$(".rightbox").css("width", "100%");
            //changeheight();
            isHide = false;
        }
        else {

            isHide = true;
            $(".leftbox").show();
            $(".centerBar").css("left", "220px");
            $(".rightbox").css("left", "234px");
            var seeheight = document.documentElement.clientHeight;
            var seewidth = document.documentElement.clientWidth;
            var rightBox = document.getElementById("rightbox");
            rightBox.style.width = seewidth - 234 + "px";
        }
}

function wbadd(obj)
    {
		if(!strNoEmpty(obj.webname.value,"请输入网站名称！"))
	    return false;		
        return true;
    }
	
$(function(){
//6-1		   
$('#glxz .xz').click(function(){
	var cvalue=$(this).is(":checked");
	if(cvalue){
		$(this).parent().parent().parent().parent().parent().find("input[name='perm[]']").attr("checked",true);
	}else{
		$(this).parent().parent().parent().parent().parent().find("input[name='perm[]']").attr("checked",false);
	}
});	
$('#glxz .xz1').click(function(){
	var cvalue=$(this).is(":checked");
	if(cvalue){
		$(this).parent().parent().find("input[name='perm[]']").attr("checked",true);
	}else{
		$(this).parent().parent().find("input[name='perm[]']").attr("checked",false);
	}
});	
		   

		//省份选择
$('#sf').change(function(){
			 var id=$('#sf').val();
			 $("#cs").attr("disabled","disabled");
			 $.ajax({
					url: urlS+'pub_city',
					type: 'GET',
					data:{id:id},
					error: function(){
					   alert("服务器忙!");
					},
					success: function(msg){
					var t=msg.split('%');
					$("#cs").removeAttr("disabled"); 
					$('#cs').html(t[0])
					$('#xc').html(t[1]);
					
					}
				   });
			});	
//城市选择
$('#cs').change(function(){
         var id=$('#cs').val();
		 $("#xc").attr("disabled","disabled");
		 $.ajax({
				url: urlS+'pub_xian',
				type: 'GET',
				data:{id:id},
				error: function(){
					   alert("服务器忙!");
						},
				success: function(msg){					
					$("#xc").removeAttr("disabled"); 
					$('#xc').html(msg);
					}
			   });
});	
	//6-1	
    $(".main-nav li").click(function(){
		$('.main-nav li').removeClass('active');
		$(this).addClass('active');
		srl=($(this).attr('name'));
		if(srl!=""){
		document.getElementById("menu").src=srl;
		}
    });
	
	$('input[name="type"]').click(function(){
												 var sz=$(this).val();
												 if(sz==1){												 
												     $('#xsjs').show();	
													 $('#xspic').hide();
												 }											
												 else{
												     $('#xsjs').hide();	
													 $('#xspic').show();
												 }
												
												 });
	//end
    $("input[name='style']").click(function(){
			var val=$(this).val();
		    if(val==1){
			$('#myTR_0').show();			
			}
		    else{
			$('#myTR_0').hide();
			$('#myTR_1').hide();
			$('#myTR_2').hide();
			$('#myTR_3').hide();
			$('#myTR_4').hide();
			$('#myTR_5').hide();
			}
       });
	
    })
//6-1
function strNoEmpty(theField,massage){
	var ss=theField;
	var sss=ss.replace(/[ ]/g,"");
    if (sss==""){
		alert(massage);
        return false;
    }
	return true
}

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
function ConfirmDel()

{

   if(confirm("确定要删除选中的记录吗？一旦删除将不能恢复！"))

     return true;

   else

     return false;

	 

}












function changehideheight() {
    var seeheight = document.documentElement.clientHeight;
    var seewidth = document.documentElement.clientWidth;
    var menubox = document.getElementById("menuBox");
	var centerBar=document.getElementById("centerBar");
    var rightBox = document.getElementById("rightbox");
    menubox.style.height = seeheight - 119 + "px";
	centerBar.style.height=seeheight-80+"px";
    rightBox.style.width = seewidth - 234 + "px";
    rightBox.style.height = seeheight - 80 + "px";

}


function xf()

{

   if(confirm("确定要续费吗？一旦续费将不能恢复！")){
   $("input[name='xf_not']").val(1);
   $("#myformly").submit();
     return true;
   }
   else
  {  
     return false;
  }

	 

}

//6-1
function pswfrom(obj)
    {
		var mm=obj.mypwd.value;
		var mobile=obj.mobile.value;
		var realname=obj.realname.value;
		if(mm!=""){
			if(!chkPwd(obj.mypwd,"请输入原始密码!")) return false;
			if(!chkPwd(obj.newpwd,"请输入新密码!")) return false;
			if(!chkPwd(obj.renewpwd,"请输入确认密码!")) return false;
			if(!strNoEqual(obj.newpwd,obj.renewpwd,"密码输入前后不一致!")) return false;
		}
		if(realname=="") {
				 alert('请填写个人姓名');
				 return false;
        } 
		if(isNaN(mobile) || mobile.length != 11) {
				 alert('手机号码为11位，请正确填写');
				 return false;
        } 
		
        if(!checkMobile(mobile)){
			alert('请输入正确的手机号码');
			 return false;
			}
		if(!chkEmail(obj.email,"请输入合法的邮箱帐户!")) return false;
       
         return true;
    }
//
function user(obj)
    {
		if(!strNoEmpty(obj.class_name_cn.value,"请输入栏目名称！"))
	    return false;       
        return true;
    }
//信息添加
function infoadd(obj)
    {
		if(!strNoEmpty(obj.classid.value,"请选择二级目录！"))
	    return false; 
		if(!strNoEmpty(obj.title.value,"请输入信息标题！"))
	    return false;		
        return true;
    }
//信息广告
function ggadd(obj)
    {
		if(!strNoEmpty(obj.title.value,"请输入标题！"))
	    return false;		
        return true;
    }


 
function AddFile() 
{ 
	for (var Key=1;Key<=5;Key++) 
	{ 
		if(document.getElementById("myTR_"+Key).style.display=='none') 
		{ 
			document.getElementById("myTR_"+Key).style.display=''; 
			break; 
		} 
	} 
} 
function DelFile(Key)
{ 
	document.all("myTR_"+Key).style.display='none'; 
} 


//end

//功能:判断单(多)选按钮组是否选值
//参数:theRadio:要判断的单(多)选按钮组对象
//     massage:提示消息
//返回:若至少选了一个项,返回true;否则,弹出消息提示,返回false
function checkOne(theRadio,massage)
{
	if(typeof(theRadio)=="object")
	{
		if(theRadio.length==null)
		{
			if(theRadio.checked) return true;
		}
		else
		{
			for(var i=0;i<theRadio.length;i++)
			{
				if(theRadio[i].checked)
				{
					return true;
				}
			}
		}
	}
    alert(massage);
    return false;
}

//时间运做
function showLocale(objD)
{
var str,colorhead,colorfoot;
var yy = objD.getYear();
if(yy<1900) yy = yy+1900;
var MM = objD.getMonth()+1;
if(MM<10) MM = '0' + MM;
var dd = objD.getDate();
if(dd<10) dd = '0' + dd;
var hh = objD.getHours();
if(hh<10) hh = '0' + hh;
var mm = objD.getMinutes();
if(mm<10) mm = '0' + mm;
var ss = objD.getSeconds();
if(ss<10) ss = '0' + ss;
var ww = objD.getDay();
if  ( ww==0 )  colorhead="<font color=\"#FF0000\">";
if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#373737\">";
if  ( ww==6 )  colorhead="<font color=\"#008000\">";
if  (ww==0)  ww="星期日";
if  (ww==1)  ww="星期一";
if  (ww==2)  ww="星期二";
if  (ww==3)  ww="星期三";
if  (ww==4)  ww="星期四";
if  (ww==5)  ww="星期五";
if  (ww==6)  ww="星期六";
colorfoot="</font>"
str = colorhead + yy + "-" + MM + "-" + dd + " " + ww + " " + hh + ":" + mm + ":" + ss + "  "  + colorfoot;
//str = colorhead + yy + "-" + MM + "-" + dd + " " + hh + ":" + mm + ":" + ss + "  "  + colorfoot;
return(str);
}
function tick()
{
var today;
today = new Date();
document.getElementById("zzjs").innerHTML = showLocale(today);
window.setTimeout("tick()", 1000);
}
//检查EMAIL
function chkEmail(theField,message)
{
	var i=theField.value.length;
	var temp = theField.value.indexOf("@");
	var tempd = theField.value.indexOf(".");
	if (temp > 1) {
		if ((i-temp) > 3){	
			if ((i-tempd)>0){
			 return true;
			}
		}
	}
	alert(message);
	theField.focus();
	theField.select();
	return false;
}
//检查密码
function chkPwd(theField,message)
{
	if(!strNoEmpty(theField.value,message)) return false;
	if(!IsLetterNum(theField.value)){
		alert(message);
		theField.select();
		return false;
	}
	if(strlen(theField.value)<6||strlen(theField.value)>16){
		alert("密码范围6-16个字符!");
		theField.select();
		return false;
	}
	return true;
}
//判断字符串是否由数字、字母和下划线组成(用于帐号和密码)
function IsLetterNum(str)
{
	if(str=="") return false;
	for (var i=0; i<str.length;i++)
	{
		var c=str.charAt(i)
		if(!((c>='0'&&c<='9')||(c>='A'&&c<='Z')||(c>='a'&&c<='z')||c=='_'))
			return false;
	}
	return true;
}
//返回:若相等,返回true;否则,弹出消息提示,返回false
function strNoEqual(theField,theField2,massage)
{
    if (theField.value!=theField2.value){
		alert(massage);
        theField2.focus();
		theField2.select();
        return false;
    }
	return true
}
//功能介绍：检查是否为日期时间  
function CheckDateTime(str){  
var reg = /^(\d+)-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;  
var r = str.match(reg);  
if(r==null)return false;  
r[2]=r[2]-1;  
var d= new Date(r[1], r[2],r[3], r[4],r[5], r[6]);  
if(d.getFullYear()!=r[1])return false;  
if(d.getMonth()!=r[2])return false;  
if(d.getDate()!=r[3])return false;  
if(d.getHours()!=r[4])return false;  
if(d.getMinutes()!=r[5])return false;  
if(d.getSeconds()!=r[6])return false;  
return true;  
}
//功能介绍：检查是否为日期时间  
function CheckDateTime1(str){  
var reg = /^(\d+)-(\d{1,2})-(\d{1,2})$/;  
var r = str.match(reg);  
if(r==null)return false;  
r[2]=r[2]-1;  
var d= new Date(r[1], r[2],r[3]);  
if(d.getFullYear()!=r[1])return false;  
if(d.getMonth()!=r[2])return false;  
if(d.getDate()!=r[3])return false;  
return true;  
}

//调用





  
//新闻信息
function news(obj)
{
	if(!strNoEmpty(obj.title.value,"请输入信息标题！"))
	return false;
	if(!strNoEmpty(obj.addtime.value,"请输入发布时间！"))
	return false;
	if(!CheckDateTime(obj.addtime.value)){
	alert('请输入正确的时间格式！例:0000-00-00 00:00:00');
	return false;
	}
	return true;
}
//用户添加
function user(obj)
{
	if(!strNoEmpty(obj.user_name.value,"请输入用户账户名！"))return false;	
	if(!chkPwd(obj.password,"请输入密码!")) return false;
	if(!checkOne(obj.user_rank,"请选择账号权限"))return false;
	if(!checkOne(obj.flag,"请选择账号状态"))return false;
	if(!chkEmail(obj.email,"请输入合法的邮箱帐户!")) return false;
	if(!strNoEmpty(obj.realname.value,"请输入姓名!")) return false;
	if(!strNoEmpty(obj.phone.value,"请输入电话!")) return false;
	return true;
}
//用户修改
function usere(obj)
{
	if(!strNoEmpty(obj.user_name.value,"请输入用户账户名！"))return false;
	//if(!chkPwd(obj.password,"请输入密码!")) return false;
	if(!checkOne(obj.user_rank,"请选择账号权限"))return false;
	if(!checkOne(obj.flag,"请选择账号状态"))return false;
	if(!chkEmail(obj.email,"请输入合法的邮箱帐户!")) return false;
	if(!strNoEmpty(obj.realname.value,"请输入姓名!")) return false;
	if(!strNoEmpty(obj.phone.value,"请输入电话!")) return false;
	return true;
}
//提交留言
function feerback(obj)
{//
	if(!strNoEmpty(obj.title.value,"请输入留言主题!"))return false;	
	if(!strNoEmpty(obj.contents.value,"请输入留言内容!"))return false;	
	return true;
}
//回复留言
function feerback_back(obj)
{//
	if(!strNoEmpty(obj.contents.value,"请输入回复内容!"))return false;	
	return true;
}
//留言搜索
function feerserch(obj)
{//
var ss=obj.stime.value;
var ee=obj.etime.value;
var sss=ss.replace(/[ ]/g,"");
var eee=ee.replace(/[ ]/g,"");
if(sss!=""){	
	if(eee==""){
	alert('请输入查询结束时间');
	return false;
	}
	if(sss>=eee){
	alert("结束日期必须大于开始日期!");
	return false;
	}	
}
return true;
}
//维修记录搜索
function feerserch1(obj)
{//
var ss=obj.stime.value;
var ee=obj.etime.value;
var ss1=obj.stime1.value;
var ee1=obj.etime1.value;
var sss=ss.replace(/[ ]/g,"");
var eee=ee.replace(/[ ]/g,"");
var sss1=ss1.replace(/[ ]/g,"");
var eee1=ee1.replace(/[ ]/g,"");
if(sss!=""){	
	if(eee==""){
	alert('请输入维修登记结束时间');
	return false;
	}
	if(sss>=eee){
	alert("维修登记结束日期必须大于开始日期!");
	return false;
	}	
}
if(sss1!=""){	
	if(eee1==""){
	alert('请输入报修日期结束时间');
	return false;
	}
	if(sss1>=eee1){
	alert("报修结束日期必须大于开始日期!");
	return false;
	}	
}
return true;
}
//提交投诉
function complain(obj)
{//
	if(!strNoEmpty(obj.factory_name2.value,"请选择投诉商家!"))return false;	
	if(!strNoEmpty(obj.factory_style2.value,"请选择投诉商家!"))return false;	
	if(!strNoEmpty(obj.factory_id.value,"请选择投诉商家!"))return false;	
	if(!strNoEmpty(obj.title.value,"请输入投诉主题!"))return false;	
	if(!strNoEmpty(obj.content.value,"请输入投诉内容!"))return false;	
	return true;
}
//投诉搜索
function comserch(obj)
{//
var ss=obj.stime.value;
var ee=obj.etime.value;
var sss=ss.replace(/[ ]/g,"");
var eee=ee.replace(/[ ]/g,"");
if(sss!=""){	
	if(eee==""){
	alert('请输入查询结束时间');
	return false;
	}
	if(sss>=eee){
	alert("结束日期必须大于开始日期!");
	return false;
	}	
}
return true;
}
//教学楼添加
function buil(obj)
{
	if(!strNoEmpty(obj.buil_name.value,"请输入教学楼名称！"))
	return false;
	if(!strNoEmpty(obj.buil_time.value,"请输入建筑时间！"))
	return false;
	if(!CheckDateTime1(obj.buil_time.value)){
	alert('请输入正确的时间格式！例:0000-00-00');
	return false;
	}
	return true;
}
//教室添加
function room(obj)
{
	if(!strNoEmpty(obj.room_name.value,"请输入教室名称！"))
	return false;
	if(!strNoEmpty(obj.classroom.value,"请选择教室类型！"))
	return false;
	if(obj.classroom.value=="0"){
	if(!strNoEmpty(obj.classroom_name.value,"请输入其他类型名称！"))
	return false;
	}
	if(!CheckDateTime1(obj.buil_time.value)){
	alert('请输入正确的建设时间格式！例:0000-00-00');
	return false;
	}
	if(!strNoEmpty(obj.project_source.value,"请选择项目来源！"))
	return false;
	if(obj.project_source.value=="0"){
	if(!strNoEmpty(obj.project_name.value,"请输入其他来源名称！"))
	return false;
	}
	if(!strNoEmpty(obj.buil_name.value,"请选择教室位置！"))
	return false;
	if(!strNoEmpty(obj.teach_buil.value,"请选择教室位置！"))
	return false;
	if(!strNoEmpty(obj.floors.value,"请选择教室位置！"))
	return false;	
	if(!strNoEmpty(obj.floor.value,"请选择楼层！"))
	return false;
	if(!strNoEmpty(obj.area.value,"请输入教室面积！"))
	return false;
	if(!strNoEmpty(obj.fault.value,"请选择教室状态！"))
	return false;
	return true;
}
//说明书添加
function book(obj)
{
if(!strNoEmpty(obj.book_name.value,"说明书名称不能为空!"))
		return false;
//if(!strNoEmpty(obj.content.value,"说明书内容不能为空!"))
//		return false;
	return true;
}
//设备信息添加
function equipment(obj)
{
	if(!strNoEmpty(obj.title.value,"请输入设备名称！"))
	return false;
	if(!strNoEmpty(obj.device.value,"请选择设备类型！"))
	return false;
	if(obj.device.value=="0"){
	if(!strNoEmpty(obj.device_name.value,"请输入其它类型名称！"))
	return false;
	}
	
	if(!strNoEmpty(obj.project_source.value,"请选择项目来源！"))
	return false;
	if(obj.project_source.value=="0"){
	if(!strNoEmpty(obj.project_source_name.value,"请输入其它项目来源名称！"))
	return false;
	}
	
	if(!strNoEmpty(obj.factory1.value,"请选择供应商！"))
	return false;
	if(obj.factory1.value=="0"){
	if(!strNoEmpty(obj.factory1_name.value,"请输入其它供应商名称！"))
	return false;
	}
	
	if(!strNoEmpty(obj.factory2.value,"请选择生产商！"))
	return false;
	if(obj.factory2.value=="0"){
	if(!strNoEmpty(obj.factory2_name.value,"请输入其它生产商名称！"))
	return false;
	}
	
	if(!strNoEmpty(obj.factory3.value,"请选择服务商！"))
	return false;
	if(obj.factory3.value=="0"){
	if(!strNoEmpty(obj.factory3_name.value,"请输入其它服务商名称！"))
	return false;
	}
	
	if(!strNoEmpty(obj.room_name.value,"请选择配置场所！"))
	return false;
	
	if(!strNoEmpty(obj.brand.value,"请选择品牌！"))
	return false;
	if(obj.brand.value=="0"){
	if(!strNoEmpty(obj.brand_name.value,"请输入其它品牌名称！"))
	return false;
	}
	
	if(!CheckDateTime1(obj.buy_time.value)){
	alert('请输入正确的采购日期格式！例:0000-00-00');
	return false;
	}
	return true;
}
//巡检添加
function inspection_add(obj)
{
if(!strNoEmpty(obj.equipment_id.value,"请选择设备!"))
		return false;
if(!strNoEmpty(obj.content.value,"设备巡检备注不能为空!"))
		return false;
	return true;
}
//使用时候发生故障报修添加
function maintenance(obj)
{
    if(!strNoEmpty(obj.room_name.value,"请选择报修教室!"))
		return false;	
	 if(!strNoEmpty(obj.room_id.value,"请选择报修教室!"))
		return false;	
	 if(!strNoEmpty(obj.equipment_name.value,"请选择故障设备!"))
		return false;	
	if(!strNoEmpty(obj.equipment_id.value,"请选择故障设备!"))
		return false;	
	if(!strNoEmpty(obj.bxgz.value,"请输入报修故障!"))
		return false;
	return true;
}
//巡检故障转报修添加
function maintenance_add(obj)
{
    if(!strNoEmpty(obj.room_name.value,"请选择登记设备!"))
		return false;	
	 if(!strNoEmpty(obj.room_id.value,"请选择登记设备!"))
		return false;	
	 if(!strNoEmpty(obj.equipment_name.value,"请选择登记设备!"))
		return false;	
	if(!strNoEmpty(obj.equipment_id.value,"请选择登记设备!"))
		return false;	
	if(!strNoEmpty(obj.not_id.value,"请选择登记设备!"))
		return false;	
	if(!strNoEmpty(obj.bxgz.value,"请输入报修故障!"))
		return false;
	return true;
}
//报修转维修
function repair_add(obj)
{//
if(obj.bxgzhs.value=='1')
{
	if(!strNoEmpty(obj.equipment_id.value,"请选择确认故障设备!"))
		return false;
	if(!strNoEmpty(obj.bxgz.value,"确认故障现象不能为空!"))
		return false;
	if(!strNoEmpty(obj.wxclfs.value,"请选择维修处理方式!"))
		return false;
		
	if(obj.wxclfs.value=='1')
   {
	   if(!strNoEmpty(obj.wxfwsxz.value,"请选择维修服务商选择!"))
		return false;
	   if(obj.wxfwsxz.value=='1')
       {
	   if(!strNoEmpty(obj.wxfws_name.value,"请选择选择指定维修商!"))
		return false;
	   if(!strNoEmpty(obj.wxfws.value,"请选择选择指定维修商!"))
		return false;
	   
       }
	   else
	   {
	   if(!strNoEmpty(obj.wxlxr.value,"联系人不能为空!"))
	    return false;
	   if(!strNoEmpty(obj.wxlxdh.value,"联系人电话不能为空!"))
	    return false;
	   if(!strNoEmpty(obj.wxmc.value,"联系人公司名称不能为空!"))
	    return false;
	   if(!strNoEmpty(obj.wxdz.value,"联系人地址不能为空!"))
	    return false;
		}
	  if(!strNoEmpty(obj.fwfs.value,"请选择服务方式!"))
		return false;
	   
   }
	if(!strNoEmpty(obj.wxbz.value,"备注不能空的!"))
		return false;		
}
	return true;
}

//维修验收
function repairs_add(obj)
{
    if(!strNoEmpty(obj.gzyy.value,"请输入故障原因!"))
		return false;	
	 if(!strNoEmpty(obj.wxju.value,"请输入维修记录!"))
		return false;	
	 if(!strNoEmpty(obj.bxzt.value,"请选择保修状态!"))
		return false;		
	return true;
}
//发收货物
function post_add(obj)
{
	if(typeof(obj.fhcontent)!='undefined'){
	if(!strNoEmpty(obj.fhcontent.value,"请输入发货地点!"))
		return false;	
	}
    if(typeof(obj.fshcontent)!='undefined'){
	 if(!strNoEmpty(obj.fshcontent.value,"请输入收货地点!"))
		return false;	
	}
	return true;
}
//维修查询
function wxserch(obj)
{//
var ss=obj.stime.value;
var ee=obj.etime.value;
var sss=ss.replace(/[ ]/g,"");
var eee=ee.replace(/[ ]/g,"");
if(obj.dq[4].checked==false){
alert('请选择按时间段!');
return false;
}
    if(sss==""){
	alert('请输入查询开始时间');
	return false;
	}
	if(eee==""){
	alert('请输入查询结束时间');
	return false;
	}
	if(sss>=eee){
	alert("结束日期必须大于开始日期!");
	return false;
	}	
return true;
}
//维修查询1
function wxserch1(obj)
{//
var ss=obj.school_type.value;
    if(ss=="0"){
	alert('请选择学校类型!');
	return false;
	}
return true;
}
//没有使用

function checkInput1(obj)
{//在线咨询
	if(!strNoEmpty(obj.name,"Name cannot be empty!"))
		return false;
	if(!chkEmail(obj.email,"Email address wrong!"))
		return false;
	if(!strNoEmpty(obj.tel,"Tel cannot be empty!"))
		return false;
	if(!strNoEmpty(obj.country,"Please select a country!"))
		return false;
	var j=0;   
    for(i=0;i<obj.product.length;i++){
             if(obj.product[i].type=="checkbox" && obj.product[i].checked == true){
      j=j+1;
     
    }
    }
   
    if(j==0){
    alert('Please select products are interested in');
    return false;
    }
	if(!strNoEmpty(obj.content,"Please input your ideas and ask questions!"))
		return false;
	if(!strNoEmpty(obj.CheckCode,"Verification code cannot be empty!"))
		return false;
	return true;
}




//功能:判断单(多)选按钮组是否选值
//参数:theRadio:要判断的单(多)选按钮组对象
//     massage:提示消息
//返回:若至少选了一个项,返回true;否则,弹出消息提示,返回false
function selectOne(theSelect,massage)
{
	if(typeof(theSelect)=="object")
	{
		for(var i=0;i<theSelect.length;i++)
		{
			if(theSelect.options[i].selected)
			{
				return true;
			}
		}
	}
	
    alert(massage);
    return false;
}
//================================
//功能:判断非法字符
//参数:theField:要判断的文本框对象
//     massage:提示消息
//返回:若str合法,返回true;否则,弹出消息提示,返回false
function strFilter(theField,massage)
{
var filterChar="><' ;";  //需要过滤的字符
var filterTip=["大于号","小于号","单撇号","空格","分号"];  //字符说明

	for (i = 0; i < filterChar.length;i++)
    {   
        var c = filterChar.charAt(i);
        if (theField.value.indexOf(c) != -1){
			alert(massage + filterTip[i]);
			theField.focus();
			return false;
			}
    }
	return true
}
//================================
//判断数值型数据
function IsNum(theField,massage)
{
    var Number = "0123456789";
    var s=theField.value;

    if(s=="")
	{
		alert(massage);
	    theField.focus();
	    return false;
	}
    for (i = 0; i < s.length;i++)
        {   
            var c = s.charAt(i);
            if (Number.indexOf(c) == -1)
                {
					alert(massage);
                    theField.focus();
                    return false;
                }
        }
    return true;
}

//功能:四舍五入函数
//参数:fNum  传入的数值；fBit 保留几位小数
function JSRound(fNum,fBit)
{ 
	var i = 1; 
	var m = 1; 
	var tempNum= fNum; 
	for(i=1;i <= fBit;i++)  m = m * 10; 
	tempNum = tempNum * m; 
	tempNum = Math.round(tempNum); 
	tempNum = tempNum / m; 
	return tempNum;
}
//================================
//功能:判断是否是中文字符
//参数:str要判断的字符
function isChinese(str)
{
   var lst = /[u00-uFF]/;       
   return !lst.test(str);      
}
//功能:判断中英文字符长度
//参数:str要判断的字符串
function strlen(str) 
{
   var strlength=0;
   for (i=0;i<str.length;i++)
  {
     if (isChinese(str.charAt(i))==true)
        strlength=strlength + 2;
     else
        strlength=strlength + 1;
  }
return strlength;
}
//=================================

//功能：检查是否为Email Address
//参数：要检查的字符串
//返回值：false：不是  true：是

//功能：检查是否为合法帐号
//参数：要检查的字符串
//返回值：false：不是  true：是
function chkAcc(theField)
{
	if(!strNoEmpty(theField,"请输入用户名!")) return false;
	if(!IsLetterNum(theField.value)){
		alert("用户名只能是数字字母!");
		theField.select();
		return false;
	}
	if(strlen(theField.value)<4||strlen(theField.value)>20){
		alert("用户名在4-20字符之间!");
		theField.select();
		return false;
	}
	return true;
}
//功能：检查是否为合法密码
//参数：要检查的字符串
//返回值：false：不是  true：是
	

function checkMobile( s ){ 
var regu = /^1\d{10}$/g;
var re = new RegExp(regu);
if (re.test(s)) {
return true;
}else{
return false;
}
}