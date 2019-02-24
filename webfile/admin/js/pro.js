// JavaScript Document
$(function(){
	  //ni8shop
/*	 $("#bid").live("change",function(){
	 var bid=$('#bid').val();
	 $.ajax({
			url: urlS+'pub_pro.html',
			type: 'GET',
			data:{bid:bid},
			error: function(){
				   alert("服务器忙,请梢后在试!");
					},
			success: function(msg){
				var t=msg.split('%%');
				$('#classid').html(t[0]);
				$('#classid1').empty();
				$("#classid1").append("<option value=''>请选择分类</option>");
				$('#ppid').html(t[1]);
				$('#kzid').html(t[2]);
				$('#pricecs').html(t[3]);
				}
		   });
	 });*/
	 $("#classid").live("change",function(){
	  var classid=$('#classid').val();
	  $.ajax({
			url: urlS+'pub_pro.html',
			type: 'GET',
			data:{bid:classid},
			error: function(){
				   alert("服务器忙,请梢后在试!");
					},
			success: function(msg){
				var t=msg.split('%%');
				$('#classid1').html(t[0]);				
				}
		   });
	 });
	  //
	 $("#isprice").live("click",function(){
		 var fs=$(this).val();
		 if(fs==1){
			 $("#xscs").show();
			 }
		else{
			 $("#xscs").hide();
			}
	 });

	
});	

function fbpro(){
	var bid=parseInt($('#bid').val().replace(/\s+/g, ""));	
	//var classid=parseInt($('#classid').val().replace(/\s+/g, ""));
	var title=$('#title').val().replace(/\s+/g, "");
	var sprice=$('#sprice').val().replace(/\s+/g, "");
	var price=$('#price').val().replace(/\s+/g, "");
	var kc=$('#kc').val().replace(/\s+/g, "");	
	var pic_1=$('#pic_1').val().replace(/\s+/g, "");	
	var isprice=$('input[name="isprice"]:checked ').val(); 
	var isjf=$('input[name="isjf"]:checked ').val();
	var jfspic=$('#pic_2').val().replace(/\s+/g, "");
	var jftitle=$('#jftitle').val().replace(/\s+/g, "");	
	var point=$('#point').val().replace(/\s+/g, "");
	var jfkc=$('#jfkc').val().replace(/\s+/g, "");	
	
	if(bid==0){
		alert("请选择商品大类!");
		return false;
		}
/*	if(classid==0){
		sssalert("请选择商品小类!");
		return false;
		}*/
	if(title==""){
		alert("请填写商品名称");
		return false;
		}
	if(sprice=="" ){
		alert("请填写市场价!");
		return false;
		}
	if(price=="" ){
		alert("请填写销售价格!");
		return false;
		}
	if(isprice==0){
		if(kc=="" ){
			alert("请填写商品库存!");
			return false;
			}
		}
	if(pic_1=="" ){
		alert("请上传商品图片!");
		return false;
		}
	
	if(isprice==1){
		if (!checkcs()) return false;
		}
	if(isjf==1){
		if(jstitle=="" ){
		alert("请填写积分购买名称!");
		return false;
		}
		if(isspic=="" ){
		alert("请上传积分购买封面图!");
		return false;
		}
		if(point=="" ){
		alert("请填写积分价!");
		return false;
		}		
		if(jfkc=="" ){
		alert("请填写积分库存!");
		return false;
		}		
	}
	return true;
}	
//验证价格参数
        function checkcs() {
            var result = true;
			var i = 0; 
			var contentlists = [];  
			var contentlistprv = [];  
            var pdxz=0;
            $(".div_contentlist .Father_Title").each(function () {
				var itemName = "Father_Item" + i;
					
					var contentlist = [];			
					$("." + itemName + " input[type=checkbox]:checked").each(function (){
					var islock = $(this).attr("checked");
					//if(islock=="checked")contentlist.push($(this).val());
					var Priceid=$(this).val();
					var title=$(this).parent().next("span").html();
					if(islock=="checked")contentlist.push({ "Priceid":Priceid, "title": title});
					});
					if(contentlist.length == 0)	{					
					//alert("请正确选择参数价格");
					//result = false;
					//return false;
					}
					else
					{
					pdxz=1;
					var Priceprvid=$(this).find("li").attr("name");
					var prvtitle=$(this).find("li").html();
					contentlistprv.push({ "Priceprvid":Priceprvid, "prvtitle": prvtitle});
					contentlists.push(contentlist);
					}
				
				
            i++;              
            });
			//if(contentlists.length == 0)pdxz=0;
			if(pdxz==1){
			$("#contentlist").val(JSON.stringify(contentlists));
			$("#contentprv").val(JSON.stringify(contentlistprv));
			}
			else
			{
			$("#contentlist").val('');
			}
			
			 var jsonnews = []; 
			 var pd=1;
			 $("#createTable table tbody tr").each(function () {
				var PriceSon = $(this).find("input[name='Txt_PriceSon']").val();
				var CountSon = $(this).find("input[name='Txt_CountSon']").val();			
                if(PriceSon =="" || CountSon ==""){
				pd=0;
				}
				else
				{
				jsonnews.push({ "PriceSon":PriceSon, "CountSon": CountSon});
				}
           
            });
			 if(jsonnews.length == 0)pd=0;
			 if(pd ==0 || pdxz==0){
				alert("请正确填写参数价格与数量");
				result = false;
				return false;
				}
				else{
				$("#contentprice").val(JSON.stringify(jsonnews));
				}
            return result;
        }