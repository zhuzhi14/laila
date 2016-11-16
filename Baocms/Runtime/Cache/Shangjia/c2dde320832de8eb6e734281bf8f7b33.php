<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($CONFIG["site"]["title"]); ?>商户中心</title>
<meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>商户中心" />
<meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>商户中心" />
<link href="__TMPL__statics/css/newstyle.css" rel="stylesheet" type="text/css" />
 <link href="__PUBLIC__/js/jquery-ui.css" rel="stylesheet" type="text/css" />
<script>
var BAO_PUBLIC = '__PUBLIC__'; var BAO_ROOT = '__ROOT__';
</script>
<script src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/jquery-ui.min.js"></script>
<script src="__PUBLIC__/js/web.js"></script>
<script src="__PUBLIC__/js/layer/layer.js"></script>
<script src="__PUBLIC__/js/jquery.jqprint.js"></script>

</head>

<body>
<iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
<script src="__PUBLIC__/js/highcharts/highcharts.js"></script>
<script src="__PUBLIC__/js/highcharts/modules/exporting.js"></script>
<div class="sjgl_lead">
    <ul>
        <li><em class="sjgl_leadico"></em><a href="#">首页</a></li>
    </ul>
</div>
<div class="sy_content">
    <div class="sy_c1">
        <ul>
            <li class="left sy_c1Li">
                <div class="sy_c1Linr">
                    <div class="sy_c1Linr_t">统计中心</div>
                    <div class="sy_c1List">
                        <ul>
                            <li class="sy_c1nrLi">
                                <div class="left sy_c1nrLit">今日订单</div>
                                <div class="left sy_c1nrLit sy_c1nrLis"><?php echo ($counts["totay_order"]); ?>个</div>
                                <div class="right"><a class="radius3 sy_lookan" href="<?php echo U('shangjia/order/index');?>">查看</a></div>
                            </li>
                            <li class="sy_c1nrLi">
                                <div class="left sy_c1nrLit">总订单</div>
                                <div class="left sy_c1nrLit sy_c1nrLis"><?php echo ($counts["order"]); ?>个</div>
                                <div class="right"><a class="radius3 sy_lookan" href="<?php echo U('shangjia/order/index');?>">查看</a></div>
                            </li>
                            <li class="sy_c1nrLi">
                                <div class="left sy_c1nrLit">今日优惠券</div>
                                <div class="left sy_c1nrLit sy_c1nrLis"><?php echo ($counts["today_yuyue"]); ?>个</div>
                                <div class="right"><a class="radius3 sy_lookan" href="<?php echo U('shangjia/coupon/index');?>">查看</a></div>
                            </li>
                            <li class="sy_c1nrLi">
                                <div class="left sy_c1nrLit">总优惠券</div>
                                <div class="left sy_c1nrLit sy_c1nrLis"><?php echo ($counts["yuyue"]); ?>个</div>
                                <div class="right"><a class="radius3 sy_lookan" href="<?php echo U('shangjia/coupon/index');?>">查看</a></div>
                            </li>
                            <li class="sy_c1nrLi">
                                <div class="left sy_c1nrLit">点评消息</div>
                                <div class="left sy_c1nrLit sy_c1nrLis"><?php echo ($counts["dianping"]); ?>个</div>
                                <div class="right"><a class="radius3 sy_lookan" href="<?php echo U('shangjia/dianping/index');?>">查看</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="left sy_c1Li">
                <div class="sy_c1Linr">
                    <div class="sy_c1Linr_t">商家资金时间段（<?php echo ($bg_date); ?> - <?php echo ($end_date); ?>）内走势 ---- <?php echo ($SHOP['shop_name']); ?></div>
                    <div class="sy_c1List">
                        <script>
                            $(function () {
                            $('#container3').highcharts({
                                chart: {
                            type: 'line',
                            margin: [50, 0, 60, 80] //距离上下左右的距离值
                            },
                            title: {
                            text: '',
                                    x: - 20 //center
                            },
                                    subtitle: {
                                    text: "",
                                            x: - 20
                                    },
                                    xAxis: {
                                    categories: [<?php echo ($money["d"]); ?>]
                                    },
                                    yAxis: {
                                    min: 0,  
                                    title: {
                                    text: '单位元'
                                    },
                                            plotLines: [{
                                            value: 0,
                                                    width: 1,
                                                    color: '#808080'
                                            }]
                                    },
                                    series: [{
                                    name: '收入金额',
                                            data: [<?php echo ($money["price"]); ?>]
                                    }]
                            });
                            });</script>
                                                <div id="container3" style="height: 215px;">

                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="sy_c1">
        <ul>
            <li class="left sy_c1Li">
                <div class="sy_c1Linr">
                    <div class="sy_c1Linr_t">统计分析</div>
                    <div class="sy_c2tjnr">
                        <script>
                            $(function () {
                            $('#container').highcharts({
                            title: {
                            text: '抢购金额时间段（<?php echo ($bg_date); ?> - <?php echo ($end_date); ?>）内趋势',
                                    x: - 20 //center
                            },
                                    subtitle: {
                                    text: "<?php echo ($SHOP['shop_name']); ?>",
                                            x: - 20
                                    },
                                    xAxis: {
                                    categories: [<?php echo ($money["d"]); ?>]
                                    },
                                    yAxis: {
                                    title: {
                                    text: '单位元'
                                    },
                                            plotLines: [{
                                            value: 0,
                                                    width: 1,
                                                    color: '#808080'
                                            }]
                                    },
                                    series: [{
                                    name: '购买金额',
                                            data: [<?php echo ($money["price"]); ?>]
                                    }]
                            });
                            });</script>
                        <div id="container">

                        </div>
                    </div>
                </div>
            </li>
            <li class="left sy_c1Li">
                <div class="sy_c1Linr">
                    <div class="sy_c1Linr_t">销售额分析</div>
                    <div class="sy_c2tjnr">
                        <script>
                            $(function () {
                            $('#container2').highcharts({
                            title: {
                            text: '销售金额时间段（<?php echo ($bg_date); ?> - <?php echo ($end_date); ?>）内趋势',
                                    x: - 20 //center
                            },
                                    subtitle: {
                                    text: "<?php echo ($SHOP['shop_name']); ?>",
                                            x: - 20
                                    },
                                    xAxis: {
                                    categories: [<?php echo ($ordermoney["d"]); ?>]
                                    },
                                    yAxis: {
                                    title: {
                                    text: '单位元'
                                    },
                                            plotLines: [{
                                            value: 0,
                                                    width: 1,
                                                    color: '#808080'
                                            }]
                                    },
                                    series: [{
                                    name: '购买金额',
                                            data: [<?php echo ($ordermoney["price"]); ?>]
                                    }]
                            });
                            });</script>
                        <div id="container2">

                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
</body>
</html>