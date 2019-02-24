<div style="padding-left:20px; margin-top:20px;">
    <a href="http://www.ni8.com" target="_blank"><img src="<{$Think.config.web_url}>__WJ__/images/tech.jpg" width="100%" title="技术支持"/></a>
	</div>
<script type="text/javascript">
$(function(){
    $("#menuBox1 div h3").each(function(dq) {
	$(this).click(function(){
	var sl=$('#menuBox1').children("div").length;	
	for(i=0;i<sl;i++){
	if(i!=dq){
	$('#menuBox1').children("div").eq(i).find("ul").hide();
	$('#menuBox1').children("div").eq(i).find("h3").removeClass("close");
	$('#menuBox1').children("div").eq(i).find("h3").addClass("close");
	}
	}		
	$(this).toggleClass("close");
	$(this).next("ul").toggle();
    });
	});
    $("#menuBox1 h3:eq(0)").click();

    $("#menuBox1 a").click(function() {
        var obj = $(this);
        obj.blur();
        $("#menuBox1 a").removeClass("on");
		obj.addClass("on");
    });
})
</script>