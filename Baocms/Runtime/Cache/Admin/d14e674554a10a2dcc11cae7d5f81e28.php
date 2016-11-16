<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($CONFIG["site"]["title"]); ?>管理后台</title>
        <meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <!-- <link href="__TMPL__statics/css/index.css" rel="stylesheet" type="text/css" /> -->
        <link href="__TMPL__statics/css/style.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/land.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/pub.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/main.css" rel="stylesheet" type="text/css" />
        <link href="__PUBLIC__/js/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script> var BAO_PUBLIC = '__PUBLIC__'; var BAO_ROOT = '__ROOT__'; </script>
        <script src="__PUBLIC__/js/jquery.js"></script>
        <script src="__PUBLIC__/js/jquery-ui.min.js"></script>
        <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
        <script src="__PUBLIC__/js/admin.js?v=20150409"></script>
    </head>
    <body style="background-color: #f1f1f1;">
         <iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
   <div class="main">
<div class="main">
    <div class="mainBt">
        <ul>
            <li class="li1">后台首页</li>
        </ul>
    </div>
    <div class="mainNr">
        <div class="left">
            <div class="mainLeftBox">
                <div class="title">后台统计</div>
                <div class="titleNr">
                    <div class="title_bt">
                        <ul>
                            <li id="s1" class="titleLiHover">名称</li>
                            <li id="s2">数量</li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="nr">
                        <div class="lef">
                            <ul>
                                <li>今日订单</li>
                                <li class="bg">总订单</li>
                                <li>今日充值</li>
                                <li class="bg">总充值</li>
                                <li>今日预约</li>
                                <li class="bg">总预约</li>
                                <li>今日优惠券下载 </li>
                                <li class="bg">总优惠券下载</li>
                                <li>点评</li>
                                <li class="bg">会员数</li>
                                <li>商家数</li>
                                <li class="bg">消费分享</li>
                            </ul>
                        </div>
                        <div class="lef">
                            <ul>
                                <li>共<span><?php echo ($counts["totay_order"]); ?></span>条订单</li>
                                <li class="bg">共<span><?php echo ($counts["order"]); ?></span>条订单</li>
                                <li>共<span><?php echo ($counts["totay_gold"]); ?></span>条充值</li>
                                <li class="bg">共<span><?php echo ($counts["totay_gold"]); ?></span>条充值</li>
                                <li>共<span><?php echo ($counts["today_yuyue"]); ?></span>条预约</li>
                                <li class="bg">共<span><?php echo ($counts["yuyue"]); ?></span>条预约</li>
                                <li>共<span><?php echo ($counts["today_coupon"]); ?></span>条下载</li>
                                <li class="bg">共<span><?php echo ($counts["coupon"]); ?></span>条下载</li>
                                <li>共<span><?php echo ($counts["dianping"]); ?></span>条点评</li>
                                <li class="bg">共<span><?php echo ($counts["users"]); ?></span>个会员</li>
                                <li>共<span><?php echo ($counts["shops"]); ?></span>商家</li>
                                <li class="bg">共<span><?php echo ($counts["post"]); ?></span>条分享</li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center">
            <div class="mainC1">
                <div class="title">版权信息</div>
                <div class="nr">
                    <div class="lef">
                        <ul>
                            <li>研发单位</li>
                            <li>当前版本</li>
                            <li>开发语言</li>
                            <li>作者</li>
                            <li>官方网站</li>
                            <li>论坛交流</li>
                            <li>声明</li>
                        </ul>
                    </div>     
                    <div class="cen">
                        <ul>
                            <li>合肥生活宝网络科技有限公司</li>
                            <li><?php echo ($v); ?></li>
                            <li>PHP+MYSQL</li>
                            <li>baocms团队</li>
                            <li>http://www.baocms.com</li>
                            <li>http://bbs.baocms.com/</li>
                            <li>未经过合肥生活宝网络科技授权，不允许进行商业运营！</li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="mainC1">
                <div class="title">服务器环境</div>
                <div class="nr">
                    <div class="lef">
                        <ul>
                            <li>环境需求</li>
                            <li>当前PHP版本</li>
                            <li>当前mysql版本</li>
                            <li>上传限制</li>
                            <li>系统限制函数</li>
                            <li>建议</li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="cen">
                        <ul>
                            <li>PHP5.3/PHP5.4+MYSQL5.1及以上版本</li>
                            <li><?php echo phpversion();?></li>
                            <li><?php echo mysql_get_server_info();?></li>
                            <li><?php echo ini_get("upload_max_filesize");?></li>
                            <li><?php echo ini_get("disable_functions");?>&nbsp;</li>
                            <li>使用独立服务器或者阿里云/腾讯云的云主机，不推荐使用虚拟主机，可能会影响网站的访问速度！</li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

</div>
</body>
</html>