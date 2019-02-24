<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
    订单打印
</title>
    <style type="text/css">
        * {margin:0;padding:0}
        body {font:12px/1.5  "\5b8b\4f53";color:#333}
        .w{width:990px;margin:0 auto;}
        table{width:100%;border-collapse: collapse;border-spacing: 0;}
        .m{margin-bottom: 20px;}
        .al{text-align: left;}
        .ar{text-align: right;}
        .clr{clear:both;}
        em{font-style: normal;}
        .m1{padding:0 20px 20px;border-style:solid; border-width:2px 1px 1px; border-color:#aaa #eee #eee;}
        .m1 .tb1 td{height:1.1cm; line-height: 1.1cm;border-bottom: 1px solid #f5f5f5;}
        .tb1 .t1{width:50%;}
        .tb1 .t2{width:50%;text-align: right;}
        .tb2 td{height:0.8cm;line-height: 0.8cm;}
        .tb2 .t1{width:2cm;}
        .m2{border:1px solid #eee;}
        .tb4 th{background: #f9f9f9;height:1.1cm; line-height: 1.1cm;font-weight: normal;}
        .tb4 td{height:1.8cm;  border-bottom: 1px solid #f5f5f5;text-align: center}
        .tb4 td.al{text-align: left}
        .tb4 td.ar{text-align: right}
        .tb4 .gap{width:20px;}
        .tb4 td.gap{border-color:#fff;}
		.tb4 .t3{width:50%;}
        .tb4 .t5,.tb .t7{width:10%;}
        .tb4 .p-name{text-align: left}
        .tb4 .num{font-family: verdana}
        /*.tb4{border-collapse:collapse;border:1px solid #000}*/
        /*.tb4 th, .tb4 td,.d1{border:1px solid #000}*/
        .info{position:relative;top:-1px;padding:20px 0;border-top:1px solid #eee;}
        .info .statistic{float:right;margin-right: 20px;}
        .info .list{line-height: 25px;}
        .info .list .label,.info .list .price{display: inline-block;*display: inline;*zoom:1; vertical-align: middle;}
        .info .list .label{width:2.75cm; text-align: left;}
        .info .list .price{width:5cm;text-align: right;font-family: verdana;font-style: normal;}
        .info .list em{font-size:18px;font-weight: bold;}
        .d1{padding:10px}
        .d2{text-align:right;padding:10px 0;font-size:14px}
        .logo{padding:10px}
        .footer{/*position:absolute;bottom:0;left:0;*/width:100%; height:50px;line-height:50px;border-top:1px solid #ededed;text-align:center;}
        .v-h{margin:10px 0; border-top:2px solid #ededed; text-align:right}
        .print-btn{display: inline-block;*display: inline;*zoom:1;width:96px;height:50px;line-height:50px;background: #e54346;color:#fff;font-family: 'Microsoft YaHei';font-size: 18px;font-weight: bold;border:0;}
        .m2{padding-left:1px}
    </style>
    <style type="text/css" media="print">
        .v-h {display:none;}
    </style>

</head>
<body>
<form name="form1">

    <div class="w">
                       <!-- <div class="logo"><img src="images/logo-.png" alt="" width="170" height="60"></div>-->
        <div class="m m1">
            <table class="tb1">
                <tbody>
				<tr>
                    <td class="t1">订单编号：<{$show.ddbh}></td>
                    <td class="t2">订购时间：<{$show.addtime|date="Y-m-d H:i:s",###}></td>
                </tr>
				<tr>
                    <td class="t1">会员账号：<{$show.user_id|ly=###}></td>
                    <td class="t2"></td>
                </tr>
            </tbody>
			</table>
            <table class="tb2">
                <colgroup>
                    <col class="t1">
                    <col class="t2">

                </colgroup>
                <tbody>
                <tr>
                    <td width="100">客户姓名：</td>
                    <td><{$address['names']}> </td>
                </tr>
				<tr>
                    <td>联系方式：</td>
                    <td><{$address['phone']}> </td>
                </tr>
                <tr>
                    <td>客户地址：</td>
                    <td><{$address['sf']|address=###}> <{$address['cs']|address=###}> <{$address['xc']|address=###}> <{$address['address']}> </td>
                </tr>
            </tbody></table>
        </div>
        <div class="m m2">
            <table class="tb4">
                <colgroup>
                    <col class="gap">
                    <col class="t3">
					<col class="t5">
					<col class="t5">
                    <col class="t4">
                    <col class="t5">
                    <col class="t7">
                    <col class="gap">
                </colgroup>
                <tbody><tr>
                    <th class="gap"></th>
                    <th>商品名称</th>
					<th>产品编号</th>
					<th>产品规格型号</th>
                    <th>数量</th>
                    <th>商品单价</th>
                    <th class="ar">商品金额</th>
                    <th class="gap"></th>
                </tr>
                    <volist name="ddlist" id="vol">
	  <php>$allprices=$allprices+$vol["price"];</php>
                                                            <tr>
                            <td class="gap"></td>
                            <td><div class="p-name"><{$vol.title}></div></td>
							<td><div><{$vol.pr_id|hygroup="pro","id",###,"id","model"}></div></td>
							
							<td><div class="p-name">
<{$vol.csname}><if condition="$vol['isth'] gt 0"><span class="red">[<{$vol.isth|isth=###}>-<{$vol.ispassed|isthpass=###}>]</span></if></div></td>
                            <td><span class="num"><{$vol.sl}></span></td>
                            <td class="ar"><span class="num">&#165;<{$vol.dj}></span></td>
                            <td class="ar"><span class="num">&#165;<{$vol.price}></span></td>
                            <td class="gap"></td>
                        </tr>
           </volist> 
                                         
                                                </tbody></table>
            <div class="info">
                <div class="statistic">
                    <div class="list">
                        <span class="label">产品金额：</span>
                        <span class="price">¥<{$show.pprice}></span>
                    </div>
                    <div class="list">
                        <span class="label">优惠券：</span>
                        <span class="price">-¥<{$show.yhq}></span>
                    </div>
                    <div class="list">
                        <span class="label">满减优惠：</span>
                        <span class="price">-¥<{$show.mj}></span>
                    </div><div class="list">
                        <span class="label">运费：</span>
                        <span class="price">+¥<{$show.kdfsprice}></span>
                    </div>
                    
                    <div class="list">
                        <span class="label">酒币：</span>
                        <span class="price">-¥<{$show.pointp}></span>
                    </div>
                    <div class="list">
                        <span class="label">实际付款：</span>
                        <span class="price">¥<{$show.prices}></span>
                    </div>
                    <div class="list">
                        <span class="label">优惠金额：</span>
                        <span class="price">-¥<{$show[zkprice]}></span>
                    </div>
                    
                      
                    <div class="list">
                        <span class="label">订单支付金额：</span>
                        <span class="price"><em>¥<{$show.zhprice}></em></span>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div class="v-h"><div class="w"><input name="" class="print-btn" value="打印" onclick="javascript:dayin();" type="button"></div></div>
    <div class="footer" id='foot'>
        <p class="p1">快乐购物，尽在<{$webset.company}></p>
    </div>
</form>
                    <script>
                        function dayin(){
                            document.getElementById('foot').style.display="none";
                            window.print();
                        }
                    </script>

</body>
</html>