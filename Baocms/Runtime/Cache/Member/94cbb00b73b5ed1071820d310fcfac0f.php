<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>用户中心</title>
        <link href="__TMPL__statics/css/newstyle.css?v=20150729" rel="stylesheet" type="text/css" />

        <link href="themes/default/statics/css/style.css?v=20150729" rel="stylesheet" type="text/css" />
        <script src="__TMPL__statics/js/jquery.js"></script>
        <script> var BAO_PUBLIC = '__PUBLIC__';
            var BAO_ROOT = '__ROOT__';</script>
        <script src="__PUBLIC__/js/layer/layer.js"></script>
        <script src="__PUBLIC__/js/web.js"></script>
        <script>
        </script>
    </head>
    <body>
        <iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
        <div class="topOne">
    <div class="nr">
        <?php if(empty($MEMBER)): ?><div class="left">您好，欢迎访问<?php echo ($CONFIG["site"]["sitename"]); ?><a href="<?php echo U('pchome/passport/login');?>" class="on">登陆</a>|<a href="<?php echo U('passport/register');?>">注册</a>
        <?php else: ?>
        <div class="left">欢迎 <b style="color: red;font-size:14px;"><?php echo ($MEMBER["nickname"]); ?></b> 来到<?php echo ($CONFIG["site"]["sitename"]); ?>&nbsp;&nbsp; <a href="<?php echo U('member/index/index');?>" class="maincl" >个人中心</a><a href="<?php echo U('pchome/passport/logout');?>" class="maincl" >退出登录</a><?php endif; ?>
        <a href="<?php echo U('download/index');?>" class="topSm blackcl6"><em class="ico"></em>下载手机客户端</a>
    </div>
    <div class="right">
        <ul>
            <li class="liOne"><a class="liOneB" href="<?php echo U('member/order/index');?>" >我的订单</a></li>
            <li class="liOne"><a class="liOneA" href="javascript:void(0);">我的服务<em>&nbsp;</em></a>
                <div class="list">
                    <ul>
                        <li><a href="<?php echo U('member/order/index');?>">我的订单</a></li>
                        <li><a href="<?php echo U('member/ele/index');?>">我的外卖</a></li>
                        <li><a href="<?php echo U('member/yuyue/index');?>">我的预约</a></li>
                        <li><a href="<?php echo U('member/dianping/index');?>">我的评价</a></li>
                        <li><a href="<?php echo U('member/favorites/index');?>">我的收藏</a></li>                                    
                        <li><a href="<?php echo U('member/myactivity/index');?>">我的活动</a></li>
                        <li><a href="<?php echo U('member/life/index');?>">会员服务</a></li>
                        <li><a href="<?php echo U('member/set/nickname');?>">帐号设置</a></li>
                    </ul>
                </div>
            </li>
            <span>|</span>
            <li class="liOne liOne_visit"><a class="liOneA" href="javascript:void(0);">最近浏览<em>&nbsp;</em></a>
                <div class="list liOne_visit_pull">
                    <ul>
                        <?php
 $views = unserialize(cookie('views')); $views = array_reverse($views, TRUE); if($views){ foreach($views as $v){ ?>
                        <li class="liOne_visit_pull_li">
                            <a href="<?php echo U('tuan/detail',array('tuan_id'=>$v['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($v["photo"]); ?>" width="80" height="50" /></a>
                            <h5><a href="<?php echo U('tuan/detail',array('tuan_id'=>$v['tuan_id']));?>"><?php echo ($v["title"]); ?></a></h5>
                            <div class="price_box"><a href="<?php echo U('tuan/detail',array('tuan_id'=>$v['tuan_id']));?>"><em class="price">￥<?php echo ($v["tuan_price"]); ?></em><span class="old_price">￥<?php echo ($v["price"]); ?></span></a></div>
                        </li>
                        <?php }?>
                    </ul>
                    <p class="empty"><a href="javascript:;" id="emptyhistory">清空最近浏览记录</a></p>
                    <?php }else{?>
                    <p class="empty">您还没有浏览记录</p>
                    <?php } ?>
                </div>
            </li>
            <span>|</span>
            <li class="liOne"> <a class="liOneA" href="javascript:void(0);">我是商家<em>&nbsp;</em></a>
                <div class="list">
                    <ul>
                        <li><a href="<?php echo U('shangjia/login/index');?>">商家登陆</a></li>
                    </ul>
                </div>
            </li>
            <span>|</span>
            <li class="liOne"> <a class="liOneA" href="javascript:void(0);">快捷导航<em>&nbsp;</em></a>
                <div class="list">
                    <ul>
                        <?php if(is_array($func)): foreach($func as $key=>$item): if($item['is_show'] == 1): if($item['is_nav'] == 0): ?><li><a <?php if($item['is_system'] == 1): ?>href="<?php echo U($item['url']);?>" <?php else: ?>href="http://<?php echo ($item["url"]); ?>"<?php endif; ?> ><?php echo ($item["title"]); ?></a></li><?php endif; endif; endforeach; endif; ?>              
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

</div>
<script>
    $(document).ready(function(){
        $("#emptyhistory").click(function(){
            $.get("<?php echo U('tuan/emptyviews');?>",function(data){
                if(data.status == 'success'){
                    $(".liOne_visit_pull ul li").remove();
                    $(".liOne_visit_pull p.empty").html("您还没有浏览记录");
                }else{
                    layer.msg(data.msg,{icon:2});
                }
            },'json')

            //$.cookie('views', '', { expires: -1 }); 
            //$(".liOne_visit_pull ul li").remove();
            //$(".liOne_visit_pull p.empty").html("您还没有浏览记录");
        })
    });
</script>  
         
<div class="topTwo">
    <div class="left">
        <?php if(!empty($CONFIG['site']['logo'])): ?><h1><a href="<?php echo U('pchome/index/index');?>"><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["logo"]); ?>" /></a></h1>
            <?php else: ?>
            <h1><a href="<?php echo U('pchome/index/index');?>"><img src="__TMPL__statics/iamges/images/logo.png" /></a></h1><?php endif; ?> 
        <div class="changeCity">
            <p class="changeCity_name"><?php echo ($city_name); ?></p>
            <a href="<?php echo U('pchome/city/index');?>" class="graycl changeCity_link">更换城市</a>
        </div>
    </div>
    <div class="left searchBox_r">
    <script>
		$(document).ready(function () {
			$(".selectList li a").click(function () {
				$("#search_form").attr('action', $(this).attr('rel'));
				$("#selectBoxInput").html($(this).html());
				$('.selectList').hide();
			});
			$(".selectList a").each(function(){
				if($(this).attr("cur")){
					$("#search_form").attr('action', $(this).attr('rel'));
					$("#selectBoxInput").html($(this).html());                                
				}
			})
		});
	</script>
        <div class="searchBox">
        	<form id="search_form"  method="post" action="<?php echo U('pchome/shop/index');?>">
            <div class="selectBox"> <span class="select"  id="selectBoxInput">商家</span>
                <div  class="selectList">
                    <ul>
                        <li><a href="javascript:void(0);" <?php if($ctl == 'shop'){?> cur='true'<?php }?> rel="<?php echo U('pchome/shop/index');?>">商家</a></li>
                        <li><a href="javascript:void(0);" <?php if($ctl == 'tuan'){?> cur='true'<?php }?>rel="<?php echo U('pchome/tuan/index');?>">抢购</a></li>
                        <li><a href="javascript:void(0);" <?php if($ctl == 'life'){?> cur='true'<?php }?>rel="<?php echo U('pchome/life/index');?>">生活</a></li>
                        <li><a href="javascript:void(0);" <?php if($ctl == 'mall'){?> cur='true'<?php }?>rel="<?php echo U('pchome/mall/items');?>">商品</a></li>
                        <li><a href="javascript:void(0);" <?php if($ctl == 'ding'){?> cur='true'<?php }?>rel="<?php echo U('pchome/ding/index');?>">订座</a></li>
                    </ul>
                </div>
            </div>
            <input type="text" class="text" name="keyword" value="<?php echo (($keyword)?($keyword):'输入您要搜索的内容'); ?>" onclick="if (value == defaultValue) {
                        value = '';
                        this.style.color = '#000'
                    }"  onBlur="if (!value) {
                                value = defaultValue;
                                this.style.color = '#999'
                            }" />
            <input type="submit" class="submit" value="搜索" />
            </form>
        </div>
        <div class="hotSearch">
            <?php $a =1; ?>
            <?php  $cache = cache(array('type'=>'File','expire'=> 43200)); $token = md5("Keyword,,0,8,43200,key_id desc,,"); if(!$items= $cache->get($token)){ $items = D("Keyword")->where("")->order("key_id desc")->limit("0,8")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; if($item['type'] == 0 or $item['type'] == 1): ?><a href="<?php echo U('pchome/shop/index',array('keyword'=>$item['keyword']));?>"><?php echo ($item["keyword"]); ?></a>
                <?php elseif($item['type'] == 2): ?>
                    <a href="<?php echo U('pchome/tuan/index',array('keyword'=>$item['keyword']));?>"><?php echo ($item["keyword"]); ?></a>
                <?php elseif($item['type'] == 3): ?>
                    <a href="<?php echo U('pchome/life/index',array('keyword'=>$item['keyword']));?>"><?php echo ($item["keyword"]); ?></a>
                <?php elseif($item['type'] == 4): ?>
                    <a href="<?php echo U('pchome/mall/index',array('keyword'=>$item['keyword']));?>"><?php echo ($item["keyword"]); ?></a><?php endif; ?> <?php endforeach; ?>
        </div>
    </div>
    <div class="topTwo_cart_box right" id='cart'><em class="ico"></em>购物车<span id="num" class="num"><?php echo (($cartnum)?($cartnum):'0'); ?></span>
        <div class="topTwo_cart_list_box">
            <div class="box"  id='cart_show'>
               
                	
                   
               
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script>
$('#cart').hover(function(){
	var link = "<?php echo U('pchome/mall/goods');?>";
	$("#cart_show").load(link);
});
	
</script>        
         <div class="nav">
    <div class="navList">
        <ul>
        	<li class="navListAll"><span class="navListAllt">全部抢购分类</span>
                <div class="shadowy navAll">
                    
                </div>
            </li>
            <?php if(is_array($func)): foreach($func as $key=>$item): if($item['is_show'] == 1): if($item['is_nav'] == 1): ?><li class="navLi"><a <?php if($item['url'] == $current_url): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="首页" <?php if($item['is_system'] == 1): ?>href="<?php echo U($item['url']);?>" <?php else: ?>href="http://<?php echo ($item["url"]); ?>" ><?php endif; ?> ><?php echo ($item["title"]); if($item['is_new'] == 1): ?><em class="hot"></em><?php endif; ?></a></li><?php endif; endif; endforeach; endif; ?>
            
            <!--<li class="navLi"><a <?php if($ctl == 'index'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="首页" href="<?php echo U('pchome/index/index');?>" >首页</a></li>
            <li class="navLi"><a <?php if($ctl == 'tuan'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="抢购" href="<?php echo U('pchome/tuan/nearby');?>" >抢购</a></li>
            <li class="navLi"><a <?php if($ctl == 'huodong'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="活动" href="<?php echo U('pchome/huodong/index');?>" >活动</a></li>
            <li class="navLi"><a <?php if($ctl == 'lifeservice'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="上门服务" href="<?php echo U('pchome/lifeservice/index');?>" >上门服务</a></li>
            <li class="navLi"><a <?php if($ctl == 'mall'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="本地商城" href="<?php echo U('pchome/mall/index');?>" >本地商城</a></li>
            <li class="navLi"><a <?php if($ctl == 'ele'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="外卖" href="<?php echo U('pchome/ele/index');?>" >外卖</a></li>
            <li class="navLi"><a <?php if($ctl == 'ding'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="订座" href="<?php echo U('pchome/ding/index');?>" >订座</a></li>
            <li class="navLi"><a <?php if($ctl == 'life'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="同城信息" href="<?php echo U('pchome/life/main');?>" >同城信息</a></li>
            <li class="navLi"><a <?php if($ctl == 'coupon'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="优惠券" href="<?php echo U('pchome/coupon/index');?>" >优惠券</a></li>
                        <li class="navLi"><a <?php if($ctl == 'jifen'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="积分商城" href="<?php echo U('pchome/jifen/index');?>" >积分</a></li>-->

        </ul>
    </div>
</div>
<div class="clear"></div>
            <script type="text/javascript">
                $(document).ready(function () {
                $('#selectBoxInput').on("mouseleave", function () {
                    $('.selectList').stop().hide();
                }).on("mouseenter", function(){
                    $('.selectList').stop().slideDown();
                });
                $('.selectList').on("mouseleave", function(){
                    $(this).stop().hide();
                }).on("mouseenter", function(){
                    $(this).stop().show();
                });
                $(".selectList li a").click(function () {
                    $("#selectBoxInput").html($(this).html());
                    $('.selectList').hide();
                });
                    $('.menu_fllist2 > .item2').hover(function () {
                        /*var eq = $('.menu_fllist2 > .item2').index(this), //获取当前滑过是第几个元素
                                h = $('.menu_fllist2').offset().top, //获取当前下拉菜单距离窗口多少像素
                                s = $(window).scrollTop(), //获取游览器滚动了多少高度
                                i = $(this).offset().top, //当前元素滑过距离窗口多少像素
                                item = $(this).children('.menu_flklist2').height(), //下拉菜单子类内容容器的高度
                                sort = $('.menu_fllist2').height();                     //父类分类列表容器的高度

                        if (item > sort) {                                              //如果子类的高度小于父类的高度
                            if (eq == 0) {
                                $(this).children('.menu_flklist2').css('top', (i - h));
                            } else {
                                $(this).children('.menu_flklist2').css('top', (i - h) + 1);
                            }
                        } else {
                            if (s > h) {                                                //判断子类的显示位置，如果滚动的高度大于所有分类列表容器的高度
                                if (i - s > 0) {                                            //则 继续判断当前滑过容器的位置 是否有一半超出窗口一半在窗口内显示的Bug,
                                    $(this).children('.menu_flklist2').css('top', (s - h) + 2);
                                } else {
                                    $(this).children('.menu_flklist2').css('top', (s - h) - (-(i - s)) + 2);
                                }
                            } else {
                                $(this).children('.menu_flklist2').css('top', 0);
                            }
                        }*/

                        $(this).addClass('on');
                        $(this).children('.menu_flklist2').css('display', 'block');
                    }, function () {
                        $(this).removeClass('on');
                        $(this).children('.menu_flklist2').css('display', 'none');
                    });//导航菜单js
                });

            </script>
            <div class="main_c">
                <div class="content_left">
                    <ul>
                        <li class="index_nav clef_user">
                            <div class="clef_usertx"><a href="<?php echo U('set/face');?>"><img src="__ROOT__/attachs/<?php echo (($MEMBER['face'])?($MEMBER['face']):'default.jpg'); ?>"/></a>

                                <p class="user_name"><?php echo ($MEMBER['nickname']); ?></p>
                                <!-- <p class="user_dj">等级：VIP2</p> -->
                            </div>
                            <div class="clef_userxx">
                                <ul>
                                    <li>余额：<span style="color:#fb3203;font-weight:bold;">￥<?php echo round($MEMBER['money']/100,2);?></span><a class="user_cz" href="<?php echo U('money/money');?>">去充值</a>

                                    <!--    <a  class="user_cz" href="http://127.0.0.1/huiyuan/mobile/pay.php?user_id=<?php echo ($MEMBER["user_id"]); ?>">去充值</a>-->
                                    </li>
                                   <!-- <li>金块：<span class="user_ye"><?php echo ($MEMBER['gold']); ?></span><a class="user_cz" href="<?php echo U('money/gold');?>">去充值</a></li>-->
                                    <li>T积分：<span class="user_jf"  style="color:#fb3203;font-weight:bold;"><?php echo ($MEMBER['integral']); ?> T币</span></li>
                                    <li>L积分：<span class="user_jf"  style="color:#fb3203;font-weight:bold;"><?php echo ($MEMBER['lb_bal']); ?> L币</span></li>

                                    <!--
                                    <?php if($CONFIG['quanming']['is_money']){ ?>
                        
                                        <li>冻结金：
                                         <span class="user_jf">
                                             <?php if(empty($MEMBER_EX)): echo round($MEMBER_EX['frozen_money']/100,2);?>
                                                <a class="user_cz" href="<?php echo U('member/set/base');?>">请先完善资料</a>
                                             <?php elseif($MEMBER_EX['frozen_money'] == 0): ?> 
                                             <?php echo round($MEMBER_EX['frozen_money']/100,2);?>
                                                <a class="user_cz" href="<?php echo U('money/fzmoney');?>">去充值</a>
                                             <?php elseif($MEMBER_EX['is_no_frozen'] == 0): ?>
                                               <?php echo round($MEMBER_EX['frozen_money']/100,2); endif; ?>
                                         
                                         </span>
                                     
                                     </li>
                                     
                                 
                                     <?php } ?>-->
                                </ul>
                            </div>
                        </li>
                        <li class="index_nav">
                            <h3>订单中心</h3>
                            <div class="indexnav_li">
                                <ul>
                                    <li><a <?php if($ctl == 'order' or $ctl == 'ele' ): ?>class="on"<?php endif; ?> href="<?php echo U('order/index');?>">我的订单</a></li>
                                    <li><a <?php if($ctl == 'index' ): ?>class="on"<?php endif; ?> href="<?php echo U('index/index');?>">我的抢购券</a></li>
                                    <li><a <?php if($ctl == 'coupon' ): ?>class="on"<?php endif; ?> href="<?php echo U('coupon/index');?>">优惠券下载</a></li>
                                    <li><a <?php if($ctl == 'yuyue' ): ?>class="on"<?php endif; ?> href="<?php echo U('yuyue/index');?>">我的预约</a></li>
                                    <li><a <?php if($ctl == 'crowd' ): ?>class="on"<?php endif; ?> href="<?php echo U('crowd/index');?>">我的众筹</a></li>
                                    <li><a <?php if($ctl == 'exchange' ): ?>class="on"<?php endif; ?> href="<?php echo U('exchange/index');?>">我的兑换</a></li>
                                    <li><a <?php if($ctl == 'ding' ): ?>class="on"<?php endif; ?> href="<?php echo U('ding/index');?>">我的订座</a></li>
                                    <li><a <?php if($ctl == 'hotel' ): ?>class="on"<?php endif; ?> href="<?php echo U('hotel/index');?>">我的预订酒店</a></li>
                                    <li><a <?php if($ctl == 'farm' ): ?>class="on"<?php endif; ?> href="<?php echo U('farm/index');?>">我预订的农家乐</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="index_nav">
                            <h3>会员服务</h3>
                            <div class="indexnav_li">
                                <ul>
                                    <li><a <?php if($ctl == 'money' ): ?>class="on"<?php endif; ?> href="<?php echo U('money/money');?>">充值管理</a></li>
                                    <li><a <?php if($ctl == 'myactivity' ): ?>class="on"<?php endif; ?> href="<?php echo U('myactivity/index');?>">我的活动</a></li>
                                    <li><a <?php if($ctl == 'life' ): ?>class="on"<?php endif; ?> href="<?php echo U('life/index');?>">我的信息</a></li>
                                    <li><a <?php if($ctl == 'message' ): ?>class="on"<?php endif; ?> href="<?php echo U('message/index');?>">我的消息</a></li>
                                    <li><a <?php if($ctl == 'tribe' ): ?>class="on"<?php endif; ?> href="<?php echo U('tribe/index');?>">我的部落</a></li>
                                    <li><a <?php if($ctl == 'express' ): ?>class="on"<?php endif; ?> href="<?php echo U('express/index');?>">我的快递</a></li>
                                    <li><a <?php if($ctl == 'dianping' ): ?>class="on"<?php endif; ?> href="<?php echo U('dianping/index');?>">我的点评</a></li>
                                    <li><a <?php if($ctl == 'favorites' ): ?>class="on"<?php endif; ?> href="<?php echo U('favorites/index');?>">我的关注</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="index_nav">
                            <h3>账户中心</h3>
                            <div class="indexnav_li">
                                <ul>
                                    <li><a <?php if($ctl == 'cash' ): ?>class="on"<?php endif; ?> href="<?php echo U('cash/index');?>">申请提现</a></li>
                                    <li><a <?php if($ctl == 'set' ): ?>class="on"<?php endif; ?> href="<?php echo U('set/base');?>">账户设置</a></li>
                                    <li><a <?php if($ctl == 'address' ): ?>class="on"<?php endif; ?> href="<?php echo U('address/index');?>">收货地址</a></li>
                                    <li><a <?php if($ctl == 'logs' ): ?>class="on"<?php endif; ?> href="<?php echo U('logs/integral');?>">日志管理</a></li>
                                    <li><a <?php if($ctl == 'quanming' ): ?>class="on"<?php endif; ?> href="<?php echo U('quanming/index');?>">全民推广</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
 
<!--  -->
<div class="content_right">
    <div class="tgdd">
        <div class="tgdd_t">
            <ul>
                <li <?php if($ctl == 'order' and ($act == 'index' or $act == 'noindex')): ?>class="on"<?php endif; ?> ><a href="<?php echo U('order/index');?>">抢购订单</a></li>
                <li <?php if($ctl == 'ele'): ?>class="on"<?php endif; ?> ><a href="<?php echo U('ele/index');?>">订餐订单</a></li>
                <li <?php if($ctl == 'order' and $act == 'goods'): ?>class="on"<?php endif; ?> ><a href="<?php echo U('order/goods');?>">商城订单</a></li>
            </ul>
        </div>
        <div class="tgdd_t">
            <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
            <form action="<?php echo U('order/index');?>" method="post">
                <div class="search_form"> 
                    <span class="search_form_wz">开始时间</span><input class="search_form_time" type="text" name="bg_date" value="<?php echo (($bg_date)?($bg_date):''); ?>" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'});"  />
                    <span class="search_form_wz">结束时间</span><input class="search_form_time" type="text" name="end_date" value="<?php echo (($end_date)?($end_date):''); ?>" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'});" />
                    <span class="search_form_wz">状态</span>
                    <select name="st" class="search_form_zt">
                        <option value="999">请选择</option>
                        <option <?php if(($st) == "1"): ?>selected="selected"<?php endif; ?>  value="1">已完成</option>
                        <option <?php if(($st) == "0"): ?>selected="selected"<?php endif; ?>  value="0">等待付款</option>
                        <option <?php if(($st) == "-1"): ?>selected="selected"<?php endif; ?>  value="-1">到店付</option>
                    </select>
                    <span class="search_form_wz">订单编号</span>
                    <input type="text" name="keyword" value="<?php echo ($keyword); ?>" class="search_form_ssk" /><input type="submit" class="search_form_ssan" value="搜索" />
                </div>
            </form>
        </div>
        <div class="tgdd_nr">
            <table border="0" cellspacing="0" width="100%"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; text-align:center;">
                <tr class="tgdd_nrt">
                    <th>抢购订单</th>
                    <th>数量</th>
                    <th>总价</th>
                    <th>使用积分</th>
                    <th>RMB</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$var): $mod = ($i % 2 );++$i;?><tr class="tgdd_nrBh">
                        <td colspan="7" style="text-align:left;">订单编号：<span class="tgdd_bh"><?php echo ($var["order_id"]); ?></span></td>
                    </tr>
                    <tr class="tgdd_nrC">
                        <td style="text-align:left;" width="335px"><div class="tgdd_tw">
                                <div class="left"><a class="myInfor_sx" target="_blank" href="<?php echo U('pchome/tuan/detail',array('tuan_id'=>$var['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($tuan[$var['tuan_id']]['photo']); ?>" width="81" height="60" /></a></div>
                                <div class="lef"><a class="myInfor_sx" target="_blank" href="<?php echo U('pchome/tuan/detail',array('tuan_id'=>$var['tuan_id']));?>"><?php echo ($tuan[$var['tuan_id']]['title']); ?></a><p>有效期至：<?php if($tuan[$var['tuan_id']]['fail_date']){echo $tuan[$var['tuan_id']]['fail_date'];}else{echo '---';} ?></p><p>商家：<a class="myInfor_sx" target="_blank" href="<?php echo U('pchome/shop/detail',array('shop_id'=>$var['shop_id']));?>"><?php echo (($shops[$var['shop_id']]['shop_name'])?($shops[$var['shop_id']]['shop_name']):'本站'); ?></a></p></div>
                            </div></td>
                        <td class="tgdd_nrCtd"><?php echo ($var["num"]); ?></td>
                        <td class="tgdd_nrCtd" id="price-color">&yen;<?php echo round($var['total_price']/100,2);?></td>
                        <td class="tgdd_nrCtd"><?php echo ($var["use_integral"]); ?></td>
                        <td class="tgdd_nrCtd" id="price-color">&yen;<?php echo round($var['need_pay']/100,2);?></td>
                        <td class="tgdd_nrCtd">
                            <?php if(($var["status"]) == "0"): ?><a class="myInfor_sx myInfor_sx_fk" target="_blank" href="<?php echo U('pchome/tuan/pay',array('order_id'=>$var['order_id']));?>">去付款</a>
                            <?php else: ?>
                                <?php if(($var["status"]) == "-1"): ?>到店付
                                <?php else: ?>
                                	<?php $tc = D('TuanCode'); $rtc = $tc -> where('order_id ='.$var['order_id']) -> find(); ?>
                                    <?php if(($rtc["is_used"]) == "1"): ?><a class="myInfor_sx myInfor_sx_fk" href="javascript:void(0)">已完成</a>
                                            <?php if($dianping[$var['order_id']]['order_id'] == null): ?><a class="myInfor_sx" href="<?php echo U('dianping/tuandianping',array('order_id'=>$var['order_id']));?>">点评</a>     
                                            <?php else: ?>
                                                <a class="myInfor_sx myInfor_sx_fk" href="javascript:void(0)">已评价</a><?php endif; ?>
                                        <?php else: ?>
                                           已付款  未消费<?php endif; endif; endif; ?>
                        </td>
                        <td align="center"><a mini='confirm' class="tgdd_del red" href="<?php echo U('order/delete',array('order_id'=>$var['order_id']));?>">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table> 
            <div class="x"><?php echo ($page); ?></div>
        </div>
    </div>
</div>
</div>
</div>
<div style="clear:both;"></div>

<div class="footerOut">
    <div class="footer">
        <div class="footNav">
            <div class="left topTwo_b">
                <div class="tel"><?php echo ($CONFIG["site"]["tel"]); ?><p>周一至周日 9:00-22:00</p><p>客服电话 免长途费</p></div>
                <div class="protect">
                    <ul>
                        <li><em>&nbsp;</em><a href="javascript:void(0);">随时退</a></li>
                        <li class="protectLi2"><em>&nbsp;</em><a href="javascript:void(0);">不满意免单</a></li>
                        <li class="protectLi3"><em>&nbsp;</em><a href="javascript:void(0);">过期退款</a></li>
                    </ul>
                </div>
            </div>
            <div class="center">
                <div class="footNavLi">
                    <ul>
                        <li class="footerLi">
                            <h3>公司信息</h3>
                            <ul>
                                <li><a target="_blank" title="关于我们" href="<?php echo U('pchome/article/system',array('content_id'=>1));?>">关于我们</a></li>
                                <li><a target="_blank" title="联系我们" href="<?php echo U('pchome/article/system',array('content_id'=>3));?>">联系我们</a></li>
                                <li><a target="_blank" title="人才招聘" href="<?php echo U('pchome/article/system',array('content_id'=>2));?>">人才招聘</a></li>
                                <li><a target="_blank" title="免责声明" href="<?php echo U('pchome/article/system',array('content_id'=>6));?>">免责声明</a></li>
                            </ul>
                        </li>
                        <li class="footerLi">
                            <h3>商户合作</h3>
                            <ul>
                                <li><a href="<?php echo U('pchome/shop/apply');?>">商家入驻</a></li>
                                <li><a target="_blank" title="广告合作" href="<?php echo U('pchome/article/system',array('content_id'=>5));?>">广告合作</a></li>
                                <li><a href="<?php echo U('pchome/shop/news');?>">商家新闻</a></li>
                            </ul>
                        </li>
                        <li class="footerLi">
                            <h3>用户帮助</h3>
                            <ul>
                                <li><a target="_blank" title="服务协议" href="<?php echo U('pchome/article/system',array('content_id'=>7));?>">服务协议</a></li>
                                <li><a target="_blank" title="退款承诺" href="<?php echo U('pchome/article/refund');?>">退款承诺</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="copy">copyright 2013-2113 <?php echo ($_SERVER['HTTP_HOST']); ?> All Rights Reserved <?php echo ($CONFIG["site"]["sitename"]); ?>版权所有 - <?php echo ($CONFIG["site"]["icp"]); ?> <?php echo ($CONFIG["site"]["tongji"]); ?></div>
            </div>
            <div class="right"><img src="__PUBLIC__/img/wx.png" width="149" height="149" /><p>扫一扫关注BAOCMS</p></div>
        </div>
    </div>
</div>
<div class="topUp">
    <ul>
        <li class="topBack"><div class="topBackOn">回到<br />顶部</div></li>
        <li class="topUpWx"><div class="topUpWxk"><img src="__PUBLIC__/img/wx.png" width="149" height="149" /><p>扫描二维码关注微信</p></div></li>
    </ul>
</div>

<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100) {
                $(".topUp").show();
                $(".indexpop").show();
            } else {
                $(".topUp").hide();
                $(".indexpop").hide();
            }
            var ctl = "<?php echo ($ctl); ?>";
            if(ctl == 'coupon'){
                if ($(window).scrollTop() > 665) {
                    $(".spxq_xqT2").show();
                } else {
                    $(".spxq_xqT2").hide();
                }
            }else{
                if ($(window).scrollTop() > 750) {
                    $(".spxq_xqT2").show();
                } else {
                    $(".spxq_xqT2").hide();
                }
            }
        });
        $(".topBack").click(function () {
            $("html,body").animate({scrollTop: 0}, 200);
        });
    });
</script>
</body>
</html>