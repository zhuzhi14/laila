<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head lang="zh-CN">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title><?php if($mobile_title)echo $mobile_title;else echo $CONFIG['site']['sitename'] ?></title>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/css_1.css?v=20151118"/>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/css_2.css?v=20151118"/>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/css_wxj.css?v=20151118"/>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/wap.css?v=20151118"/>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/reset.css?v=20151118"/>
        <link rel="stylesheet" href="./themes/default/Mobile/statics/css/style.css?v=20151118"/>
        <script> var BAO_PUBLIC = '__PUBLIC__';
            var BAO_ROOT = '__ROOT__';</script>
        
        <script src = "./themes/default/Mobile/statics/js/jquery-1.7.1.min.js?v=20151118" ></script>
        <script src="./themes/default/Mobile/statics/js/baocms.js?v=20151118"></script>
      
        <script src="./themes/default/Mobile/statics/js/jquery.event.drag-1.5.min.js?v=20151118"></script>
        <script src="./themes/default/Mobile/statics/js/jquery.touchSlider.js?v=20151118"></script>
        <script src="./themes/default/Mobile/statics/js/zepto.js?v=20151118"></script>
        <script src="./themes/default/Mobile/statics/js/layer/layer.js?v=20151118"></script>
        <script src="__PUBLIC__/js/web.js?v=20150718"></script>
        <script>
            function bd_encrypt(gg_lat, gg_lon)   // 百度地图测距偏差 问题修复
            {
                var x_pi = 3.14159265358979324 * 3000.0 / 180.0;
                var x = gg_lon;
                var y = gg_lat;
                var z = Math.sqrt(x * x + y * y) + 0.00002 * Math.sin(y * x_pi);
                var theta = Math.atan2(y, x) + 0.000003 * Math.cos(x * x_pi);
                var bd_lon = z * Math.cos(theta) + 0.0065;
                var bd_lat = z * Math.sin(theta) + 0.006;
                dingwei('<?php echo U("mobile/index/dingwei",array("t"=>$nowtime,"lat"=>"llaatt","lng"=>"llnngg"));?>', bd_lat, bd_lon);
            }
            navigator.geolocation.getCurrentPosition(function (position) {
                bd_encrypt(position.coords.latitude, position.coords.longitude);
            });
        </script>
         <?php if($is_app){?>
            <style>
                .page-center-box{top: 0rem !important;}
                .content_right{margin-top: 0rem !important;}
                #search-bar{top:0rem !important;}
                .serch-bar-mask{top:0.4rem !important; height: 100%; padding-bottom: 0;}
                #app_nav{top:0rem !important;}
                #loading{bottom: 0.1rem !important; height: 0.4rem !important;}
                #shangjia_tab{top: 0rem !important;}
                .app_page{top:0.3rem !important;}
                .app_shangjia{top:0.4rem !important;}
                footer{ bottom: 0.15rem;}
            </style>
        <?php }?>
        
        <?php if($is_app&&!$is_android){?>
            <style>
                footer{ bottom: 0.15rem;}
                .lbs-tag .info-box{bottom: 0.12rem !important;}
                .yiyuan_buynum_mask .cont{bottom: 0.12rem !important;}
            </style>
        <?php }?>
        
        <?php if ($is_android){?>
        <script type="text/javascript" language="javascript"> 
            function  getNewWebView(url1,url2){
               
               window.jsObj.HtmlcallJava(url1,url2);
            }
            
            function getContents(content){
                window.jsObj.getContent(content);
            }
        </script>
        <script>
            $(document).ready(function(){
                getContents("<?php echo ($mobile_description); ?>");
            })
        </script>
        <?php }?>
        
        
</head>

<body>
    <div id="personal" class="page-center-box" style="top:0;">
        <div id="scroll">
            <div class="personal_info_bg">
            	<div class="title">我的</div>
                <div class="info">
                    <a style="display:block" href="<?php echo AppLink('/mcenter/information');?>">
                    <div class="info-img"><img src="__ROOT__/attachs/<?php echo (($MEMBER["face"])?($MEMBER["face"]):'default.jpg'); ?>" /></div>
                    <div class="info-content">
                        <p class="name"><?php echo ($MEMBER["nickname"]); ?></p>
                        <p><em></em><?php echo ($MEMBER["mobile"]); ?></p>
                        <i></i>   
                    </div>
                    </a>
                    <div class="clear"></div>
                </div>
                <div class="mine-list">
                    <ul>

                        <li>
                            <div class="mine-list-content"><a href="<?php echo AppLink('mcenter/money/index');?>"><p class="c2"><big><?php echo round($MEMBER['money']/100,2);?></big>元</p>我的余额</a></div>
                        </li>
                        <li>
                            <div class="mine-list-content"><a href="<?php echo AppLink('mobile/jifen/index');?>"><p><big><?php echo ($MEMBER["integral"]); ?></big> T币</p>我的T积分</a></div>
                        </li>

                        <div class="mine-list-content"><a href="<?php echo AppLink('mcenter/money/index');?>"><p class="c2"><big><?php echo ($MEMBER["lb_bal"]); ?></big> L币</p>我的L积分</a></div>
                        </li>

                       <!--
                        <?php if($CONFIG['quanming']['is_money']){ ?>  
                        
                        <li>
                            <div class="mine-list-content">
                                <?php if(($MEMBER_EX["frozen_money"]) == "0"): ?><a href="<?php echo AppLink('mcenter/money/fzmoney');?>">
                                        
                                    <p class="c3"><big>  0 </big>元</p>
                                        
                                    冻结金=>充值
                                    </a>
                                    <?php else: ?>
                                    <?php if(($MEMBER_EX["is_no_frozen"]) == "0"): ?><a href="javascript:void(0);">
                                        <p class="c3"><big>    <?php echo round($MEMBER_EX['frozen_money']/100,2);?> </big>元</p>
                                        冻结金
                                        </a>
                                        <?php else: ?>
                                        <a href="javascript:void(0);">
                                            
                                        <p class="c3"><big>  0 </big>元</p>
                                            
                                        冻结金
                                        </a><?php endif; endif; ?>
                                
                            </div>
                            
                        </li>
                        
                        <?php }else{ ?>
                        <li>
                            <div class="mine-list-content"><a href="<?php echo AppLink('mcenter/tuan/index');?>"><p class="c3"><big><?php echo ($order); ?></big>个</p>我的订单</a></div>
                            
                        </li>
                        <?php } ?>-->
                    </ul>
                </div>
            </div>
            <div class="personalLink_box">
            	<div class="personalLinkOne mb10">
                    <ul>
                        <li class="list"><a href="<?php echo AppLink('/mcenter/tuan/index');?>"><em class="ico ico_1"></em><p>我的抢购</p></a></li>
                        <li class="list"><a href="<?php echo AppLink('/mcenter/goods/index');?>"><em class="ico ico_2"></em><p>我的购物</p></a></li>
                        <li class="list"><a href="<?php echo AppLink('/mcenter/eleorder/index');?>"><em class="ico ico_3"></em><p>我的订餐</p></a></li>
                        <li class="list"><a href="<?php echo AppLink('mcenter/ding/index');?>"><em class="ico ico_4"></em><p>我的订座</p></a></li>
                        <li class="list"><a href="<?php echo AppLink('mcenter/cloud/index');?>"><em class="ico ico_5"></em><p>我的云购</p></a></li>
                        <li class="list"><a href="<?php echo AppLink('mcenter/hotel/index',array('st'=>1));?>"><em class="ico ico_6"></em><p>酒店预约</p></a></li>
                    </ul>
                </div>
                <div class="list-box">
                    <ul>
                        <li>
                            <a href="<?php echo AppLink('mcenter/tuancode/index');?>"><em class="ico ico_1"></em>我的抢购券
                            <div class="num"><?php echo ($code); ?></div></a>
                        </li>
                        <li>
                            <a href="<?php echo AppLink('mcenter/coupon/index');?>"><em class="ico ico_2"></em>我的优惠券
                            <div class="num"><?php echo ($coupon); ?></div></a>
                        </li>
                         <li>
                            <a href="<?php echo AppLink('mcenter/crowd/index');?>"><em class="ico ico_13"></em>我的众筹
                            <div class="num"><?php echo ($coupon); ?></div></a>
                        </li>
                        <li>
                            <a href="<?php echo AppLink('mcenter/hdmobile/index');?>"><em class="ico ico_3"></em>我的活动
                            <div class="num"><?php echo ($hd); ?></div></a>
                        </li>
                        <li>
                            <a href="<?php echo AppLink('mobile/favorites/index');?>"><em class="ico ico_4"></em>我的收藏
                            <div class="num"><?php echo ($rsf); ?></div></a>
                        </li> 
                        <li>
                            <a href="<?php echo AppLink('mcenter/breaks/index');?>"><em class="ico ico_11"></em>优惠买单
                            <div class="num"><?php echo ($breaks); ?></div></a>
                        </li>   
                        <li>
                            <a href="<?php echo AppLink('mcenter/yuyue/index',array('status'=>2));?>"><em class="ico ico_14"></em>我的预约
                            <div class="num"><?php echo ($code); ?></div></a>
                        </li>
                           <li>
                            <a href="<?php echo AppLink('mcenter/life/index');?>"><em class="ico ico_12"></em>我的生活信息
                            <i></i></a>
                        </li>
                    </ul>
                </div>
                <div class="list-box">
                    <ul>
                        <li>
                            <a href="<?php echo AppLink('mobile/extend/index');?>"><em class="ico ico_5"></em>全民经纪人</a>
                        </li>
                        <li>
                            <a href="<?php echo AppLink('mcenter/exchange/index');?>"><em class="ico ico_6"></em>积分兑换</a>
                        </li>
                        <li>
                            <a href="<?php echo AppLink('mcenter/express/index');?>"><em class="ico ico_7"></em>我的快递</a>
                        </li>
                 	</ul>
                 </div>
                 <div class="list-box">
                    <ul>
                        <li>
                            <a href="<?php echo AppLink('mcenter/cash/index');?>"><em class="ico ico_8"></em>提现申请</a>
                        </li>
                        <li>
                        
                            <a href="<?php echo AppLink('mcenter/message/index');?>"><em class="ico ico_9 "></em>消息中心
                           
                            <i></i></a>
                            
                        </li>
   
                        <li>
                            <?php if($new_xiaoxi){ ?>
                                <a href="<?php echo AppLink('mcenter/msg/index');?>"><em class="ico ico_10 on"></em>我的消息
                            <?php }else{ ?>
                                <a href="<?php echo AppLink('mcenter/msg/index');?>"><em class="ico ico_10"></em>我的消息
                            <?php } ?>
                            <i></i></a>
                        
                        </li>
                      
                    </ul>
                </div>
            </div>
            <input type="button" class="submit" value="退出当前账号" onClick="javascript:window.location.href='<?php echo U('mobile/passport/logout');?>';">
        </div>
    </div>
<div id="loading">
    <div class="bao_loading">正在加载中....</div>
</div>
<div class="blank">&nbsp;</div>
<?php if(!$is_app){?>
<footer>
    <div>
        <a href="<?php echo AppLink('mobile/index/index');?>">  
            <div class="icon i-1"></div>
            <p>首页</p>
        </a>
    </div>
    <div>
        <a href="<?php echo AppLink('mobile/tuan/index');?>">  
            <div class="icon i-2"></div>
            <p>抢购</p>
        </a>
    </div>
    <div>
        <a href="<?php echo AppLink('mobile/favorites/index');?>">   
            <div class="icon i-3"></div>
            <p>关注</p>
        </a>
    </div>
    <div class="my_login">
        <a href="<?php echo AppLink('mcenter/member/index');?>">
            <div class="icon i-4"></div>
            <p>我的</p></a>
    </div>
    <div class="foot_more">
        <!--<a href="<?php echo AppLink('mcenter/member/index');?>"> </a>-->
        <div class="icon i-5"></div>
        <p>更多</p>
        <div class="foot_more_pull">
            <i></i>
            <ul>
                  <li><a href="<?php echo AppLink('store/index/index');?>" class="on">商户管理</a></li>
                    <li><a href="<?php echo AppLink('wuye/index/index');?>">物业后台</a></li>
                    <li><a href="<?php echo AppLink('delivery/index/index');?>">物流后台</a></li>
                     <li><a href="<?php echo AppLink('mobile/community/index');?>">小区O2O</a></li>
                     <li><a href="<?php echo AppLink('mobile/market/index');?>">商圈O2O</a></li>
                    <li><a href="<?php echo AppLink('mobile/index/more');?>">更多服务</a></li>
            </ul>
        </div>
    </div>
</footer>
<?php }?>
<div style="display: none;" class="topUp"></div>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100) {
                $(".topUp").show();
            } else {
                $(".topUp").hide();
            }
        });
        $(".topUp").click(function () {
            $("html,body").animate({scrollTop: 0}, 200);
        });
        $('.foot_more').click(function(){
            $(".foot_more_pull").toggle();
        })
    });
</script>
<iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
<style>
    .li_table table{ width:100%; text-align:center;}
    footer #jq_total{width:auto;}
    .foot_more{ position:relative; cursor:pointer;}
    .foot_more_pull{display:none; position:absolute; bottom:0.48rem; right:0; width:100%; min-width:0.9rem; background:#fff none; box-shadow:0 0 0.03rem #999;}
    .foot_more_pull ul{position:relative; z-index:1000; background:#fff none;}
    .foot_more_pull i{ position:absolute; z-index:999; bottom:-0.04rem; left:50%; display:inline-block; width:0; height:0; content:''; background:#fff none; width:0.08rem; height:0.08rem; transform:rotate(-45deg);-webkit-transform:rotate(-45deg);-moz-transform:rotate(-45deg);-webkit-transform:rotate(-45deg);-o-transform:rotate(-45deg); box-shadow:0 0 0.03rem #999;}
    .foot_more_pull li{ display:block;}
    .foot_more_pull li a{ display:block; border-bottom:1px solid #dedede; font-size:0.14rem; line-height:0.4rem; color:#333; text-align:center;}
    .foot_more_pull li a.on{ background:#eee none;}
    .foot_more_pull li:last-child a{border-bottom:none 0px;}
</style>
</body>
</html>