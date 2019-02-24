function initcity11111(city,ind) {  
switch (document.getElementById("province_"+city).value) {  
case "安徽" : var cityOptions = new Array( "请选择地区", "", "合肥(*)", "合肥", "安庆", "安庆", "蚌埠", "蚌埠", "亳州", "亳州", "巢湖", "巢湖", "滁州", "滁州", "阜阳", "阜阳", "贵池", "贵池", "淮北", "淮北", "淮化", "淮化", "淮南", "淮南", "黄山", "黄山", "九华山", "九华山", "六安", "六安", "马鞍山", "马鞍山", "宿州", "宿州", "铜陵", "铜陵", "屯溪", "屯溪", "芜湖", "芜湖", "宣城", "宣城"); break;
default: var cityOptions = new Array("请选择地区", "");
break;
}
document.getElementById("city_"+city).options.length = 0;
for(var i = 0; i < cityOptions.length/2; i++) {
document.getElementById("city_"+city).options[i]=new Option(cityOptions[i*2],cityOptions[i*2+1]);
if (document.getElementById("city_"+city).options[i].value==ind){ 
document.getElementById("city_"+city).selectedIndex = i; 
}
}
}
function creatprovince(province,index){
	sf=sf.split(",");
	var provinces =sf;
	document.getElementById("province_"+province).options[0]=new Option("请选择省份","0");
	for(var i = 0; i < provinces.length/2; i++) { 
	document.getElementById("province_"+province).options[i+1]=new Option(provinces[i*2],provinces[i*2+1]);
	if (document.getElementById("province_"+province).options[i+1].value==index){ document.getElementById("province_"+province).selectedIndex = i+1; }
	}
	} 
//三级
function changelocation(locationid)
    {
    document.myform.classid1.length = 1; 
	document.myform.classid2.length = 1;
    var locationid=locationid;
    var i;
    for (i=0;i < onecount; i++)
        {
            if (parseInt(subcat[i][1]) == parseInt(locationid))
            { 
                document.myform.classid1.options[document.myform.classid1.length] = new Option(subcat[i][0], subcat[i][2]);
            }
        }
    }
function changelocation1(locationid){
    document.myform.classid2.length = 1; 
    var locationid=locationid;
    var i;
    for (i=0;i < onecount; i++)
        {
            if (subcat[i][1] == locationid)
            { 
                document.myform.classid2.options[document.myform.classid2.length] = new Option(subcat[i][0], subcat[i][2]);
            }
        }
    }

function ShowDialog(url,w,h) {
           var iWidth=w;
		   var iHeight=h;
           var iTop=(window.screen.height-iHeight)/2;
           var iLeft=(window.screen.width-iWidth)/2;
		   window.showModalDialog(url,window,"dialogHeight: "+iHeight+"px; dialogWidth: "+iWidth+"px;dialogTop: "+iTop+"; dialogLeft: "+iLeft+"; resizable:no;status:no;scroll:no");
         }