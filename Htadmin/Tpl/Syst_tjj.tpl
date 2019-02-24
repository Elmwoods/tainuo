<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<include file="Pub:key" />
<link href="<{:C('web_url')}>__WJ__/css/nbstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.9.1.min.js"></script>
<!--map-->
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/jquery-1.3.1.js"></script>
<script type="text/javascript" src="<{:C('web_url')}>__WJ__/js/highcharts.js" ></script>
</head>
<body>
<!-- 新窗口的选项卡结束 -->
    <div class="tit">
        <div class="icontithome">数据统计</div>
		<div class="fh"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
    </div>
	
	<div class="mainbox topborder">
	<div class="clear"></div>
	<div class="hyinfo"><b class="text-warning">统计显示</b></div>
	<div class="textinfo">
	 <div id="chart_combo" class="chart_combo" style="width:100%; height:400px; "></div>
<script type="text/javascript">
var chart;
$(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chart_combo',
			zoomType: 'xy'
        },

        title: {  //图表标题
            text: '网站数据实时信息统计'
        },
		xAxis: { //X轴标签
			categories: [<volist name="arr" id="vol">'<{$vol.title}>'<if condition="(count($arr) neq $i)">,</if></volist>],
			labels: {				 
				y:30,//x轴标签位置：距X轴下方18像素
				rotation:-70,
				style: {
                    color: '#ff0000',//设置标签颜色 
					fontSize: '14px',//设置大小
                }
			}

        },
		yAxis: {  //y轴
            title: {text: '网站实时数据统计（条）'}, //y轴标题
			gridLineWidth: 1,  //设置网格宽度为1
			min: 0,  //最小值为0
			//max: 50,  //最大值为0
			tickPixelInterval:50,//y轴坐标值的密度
			//tickInterval:10,//这个属性可以控制步长
			lineWidth: 2 ,//基线宽度
			labels: {
                formatter: function() {//格式化标签名称 
                    return this.value;
                },
                style: {
                    color: '#0D559D'//设置标签颜色 
					
                }
            },            
            //opposite: true//显示在Y轴右侧，通常为false时，左边显示Y轴，下边显示X轴
        },
        tooltip: {//鼠标滑向数据区显示的提示框 
		enabled:true,//是否显示提示框
            formatter: function() { //格式化提示框信息			    
                var s;               
                s = '' + this.x + ': ' + this.y + '';					
				return s;
            }
        },	
		plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0,//柱子边框
            pointWidth: 20,//柱子宽度
			//groupPadding: 0,                //每一组柱子之间的间隔(会影响到柱子的大小)
            //borderWidth: 1,               //柱子边框的大小
            //borderColor: "red",           //柱子边框的颜色
            //borderRadius: 180,            //柱子两端的圆角的半径
            //colorByPoint: true,           //否应该接受每系列的一种颜色或每点一种颜色
            },			
			 series: {
				cursor: 'pointer',
				events: {
				click: function(e) {
				location.href = e.point.url;
				//alert(e.point.category);
				//上面是当前页跳转，如果是要跳出新页面，那就用
				//window.open(e.point.url);
				//这里的url要后面的data里给出
				//category是对应的x轴的值
				}
				}
		    }
		},	
        labels: { //图表标签
            items: [{
                html: '',
                style: {
                    left: '48px',
                    top: '8px'
                }
				
            }]
			
        },
		legend: { //设置低部图例 
            //layout: 'vertical', //水平排列图例             
			backgroundColor: '#FFFFFF',
			borderColor: '#CCC',
			borderWidth: 1,
			align: 'center',
			verticalAlign: 'top',
			enabled:false,
			y: 50,
			shadow: true,  //设置阴影
        }, 
		exporting: {
			enabled: true  //设置导出按钮不可用
		},
		credits: { //版权信息
			text: '',

			href: ''
		},
        series: [{ //数据列
            type: 'column',
            name: '数据查询',
			//color: '#ff0000', //设置颜色
			//yAxis: 1, //数据列关联到Y轴，默认是0，设置为1表示关联上述第二个Y轴即金额 
            data: [
			<volist name="arr" id="vol">
			{
                name: '<{$vol.title}>',
                y: <{$vol.sl}>,
				url:'#',
                color: '#9C3062' ,
            }<if condition="(count($arr) neq $i)">,</if>
			
			</volist>			
			],
			dataLabels: {
                enabled: true,  //显示饼状图数据标签
				y: -20,//位置
				
				color: '#0A4D91',
				style: {//样式设置
				fontSize: '14px'				
				},
			    formatter: function() 
				{
					//return '' + this.point.category + '<br> ' + this.y + '';
					return '' + this.y + '';	
				}
            }
        }]
    });
});

</script>
	</div>
	</div>
	<include file="Pub:foot" />
</body>
</html>