<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo ($CONFIG['site']['headinfo']); ?>
        <title><?php if($config['title'])echo $config['title'];else echo $seo_title; ?></title>
        <meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
        <meta name="description" content="<?php echo ($seo_description); ?>" />
        <link href="__TMPL__statics/css/style.css??v=20160125" rel="stylesheet" type="text/css">
        <script> var BAO_PUBLIC = '__PUBLIC__'; var BAO_ROOT = '__ROOT__';</script>
        <script src="__TMPL__statics/js/jquery.js??v=20160125"></script>
        <script src="__PUBLIC__/js/layer/layer.js??v=20160125"></script>
        <script src="__TMPL__statics/js/jquery.flexslider-min.js??v=20160125"></script>
        <script src="__TMPL__statics/js/js.js??v=20160125"></script>
        <script src="__PUBLIC__/js/web.js??v=20160125"></script>
        <script src="__TMPL__statics/js/baocms.js??v=20160125"></script>
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
                    <div class="menu_fllist2">
    <?php $i=0; ?>             
    <?php if(is_array($tuancates)): foreach($tuancates as $key=>$item): if(($item["parent_id"]) == "0"): $i++;if($i <= 10){ ?>
        <div <?php if($i == 1): ?>class="item2 bo"<?php else: ?>class="item2"<?php endif; ?> >
            <h3>
                <div class="left ico ico_<?php echo ($i); ?>"></div>
                <div class="wz">
                	<a class="bt1" title="<?php echo ($item["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['cate_id']));?>"><?php echo msubstr($item['cate_name'],0,2,'utf-8',false);?></a>
                    <div class="bt2">
                        <?php $i2=0; ?>
                        <?php if(is_array($tuancates)): foreach($tuancates as $key=>$item2): if(($item2["parent_id"]) == $item["cate_id"]): $i2++;if($i2 <= 2){ ?>
                            <a title="<?php echo ($item2["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['cate_id'],'cate_id'=>$item2['cate_id']));?>"><?php echo msubstr($item2['cate_name'],0,4,'utf-8',false);?></a>
                            <?php } endif; endforeach; endif; ?>
                    </div>
                </div>
                <div class="clear"></div>
            </h3>
            <div class="menu_flklist2">
                <div class="menu_fl2t"><a title="<?php echo ($item["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['cate_id']));?>"><?php echo ($item["cate_name"]); ?></a></div>
                <div class="menu_fl2nr">
                    <?php $k=0; ?>
                    <?php if(is_array($tuancates)): foreach($tuancates as $key=>$item2): if(($item2["parent_id"]) == $item["cate_id"]): ?><a title="<?php echo ($item2["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['cate_id'],'cate_id'=>$item2['cate_id']));?>"><?php echo ($item2['cate_name']); ?></a><?php endif; endforeach; endif; ?>
                </div>
            </div>
        </div>
        <?php } endif; endforeach; endif; ?>
</div>

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
<script>
    $(function () {
        $(".minu_zuone li img").each(function (e) {
            $(this).click(function () {
                $(".minu_zuone li img").removeClass("on");
                $(this).addClass("on");
                $(".minu_img").each(function (i) {
                    if (e == i) {
                        $(".minu_img").hide();
                        $(this).show();
                    }
                });
            });
        });
    });
</script>
<div class="content zy_content">
    <div class="spxq_xqT spxq_xqT2">
        <ul>
            <li class="jq_spxq_xqBt1 on"><code rel="spxq_xqBt1">商品详情</code><em></em></li>
            <li class="jq_spxq_xqBt2"><code rel="spxq_xqBt2">商品属性</code><em></em></li>
            <li class="jq_spxq_xqBt3"><code rel="spxq_xqBt2">购买须知</code><em></em></li>
            <li class="jq_spxq_xqBt4"><code rel="spxq_xqBt3">商家详情</code><em></em></li>
            <li class="jq_spxq_xqBt5"><code rel="spxq_xqBt4">用户评价</code><em></em></li>
        </ul>
        <div style="float:right;"><a style="height:31px; line-height:31px;margin-top:5px;width:100px;" mini='buy' rel="jq_num" class="spxq_qgjjKq spxq_qgjjLq" href="<?php echo U('mall/cartadd2',array('goods_id'=>$detail['goods_id']));?>">立即购买</a></div>
    </div>
    <script>
        $(document).ready(function () {
            var href = window.location.href;
            var param = href.split('#');
            if (param[1] != undefined && param[1] !=null && param[1] != "") {
                var _targetTop2 = $('#' + param[1]).offset().top;//获取位置
                jQuery("html,body").animate({scrollTop: _targetTop2}, 300);//跳转
            }
            $(".spxq_xqT2 ul li").click(function () {
                $(".spxq_xqT2 ul li").removeClass("on");
                $(this).addClass("on");
                var _targetTop = $('.' + $(this).find('code').attr('rel')).offset().top;//获取位置
                jQuery("html,body").animate({scrollTop: _targetTop}, 300);//跳转
            });
            $(window).scroll(function () {
                $('.spxq_xqT2 ul li').each(function(i){
                    if($("."+$(this).find('code').attr("rel")).offset().top - $(window).scrollTop() < 50){
                        $(this).addClass('on').siblings().removeClass('on');
                    }
                });
            });            
        });
    </script>

    <div class="spxq_loca"><a href="<?php echo U('index/index');?>">首页</a>&gt;&gt;<a href="<?php echo U('mall/index');?>">购物</a>&gt;&gt;<?php echo ($detail["title"]); ?></div>
    <div class="spxq_xqgm">
        <div class="left spxq_xqgm_l">
            <div class="spxq_qg" style="padding-top: 10px;">
                <div class="left spxq_qg_l">
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.spxq_slider').flexslider({
                                slideshow: false,
                                controlNav: "thumbnails"
                            });
                        });
                        $(function () {
                            $(".sy_hotgzLi").hover(function () {
                                $(".spxq_slider .flex-direction-nav").show();
                            }, function () {
                                $(".spxq_slider .flex-direction-nav").hide();
                            });
                            $(".spxq_slider .flex-direction-nav").hover(function () {
                                $(".spxq_slider .flex-direction-nav").show();
                            }, function () {
                                $(".spxq_slider .flex-direction-nav").hide();
                            });
                        });
                    </script>
                    <div class="spxq_slider">
                        <div class="spxq_bq"><?php if(($detail["freebook"]) == "1"): ?><span class="spxq_bq1">免预约<em></em></span><?php endif; if(($detail["is_new"]) == "1"): ?><span class="spxq_bq2">新单<em></em></span><?php endif; if(($detail["is_hot"]) == "1"): ?><span class="spxq_bq3">热门<em></em></span><?php endif; if(($detail["is_chose"]) == "1"): ?><span class="spxq_bq4">精选<em></em></span><?php endif; ?></div>
                        <ul class="slides">
                            <?php if($goods_value['photo']){ ?>
                            <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($goods_value["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($goods_value["photo"]); ?>" width="470" height="285" /></li>
                            <?php }else{ ?>
                            <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>" width="470" height="285" /></li>
                            <?php } ?>
                            <?php $i=0; ?>
                            <?php if(is_array($thumb)): foreach($thumb as $key=>$item): $i++;if($i<=3){ ?>
                                <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($item); ?>"><img src="__ROOT__/attachs/<?php echo ($item); ?>" width="470" height="285" /></li>
                                <?php } endforeach; endif; ?>
                        </ul>
                        <?php if(empty($thumb)): ?><ol class="flex-control-nav flex-control-thumbs">
                            <?php if(!empty($gf)): ?><li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($gf["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($gf["photo"]); ?>" width="108" height="68" /></li>
                            <?php else: ?>
                            <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>" width="108" height="68" /></li><?php endif; ?>
                            <?php $i=0; ?>
                            <?php if(is_array($thumb)): foreach($thumb as $key=>$item): $i++;if($i<=3){ ?>
                                <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($item); ?>"><img src="__ROOT__/attachs/<?php echo ($item); ?>" width="108" height="68" /></li>
                                <?php } endforeach; endif; ?>
                        </ol><?php endif; ?>
                    </div>
                </div>
                <?php if($detail['rush_ltime'] > $now_time && $detail['rush_kucun'] > 0){ $discount = round(($detail['rush_price']/$detail['price'])*10,1); }else{ $discount = round(($detail['mall_price']/$detail['price'])*10,1); } ?>
                <div class="right spxq_qg_r">
                    <div class="spxq_qgjgk minu_font" style="padding-top: 10px;"><?php echo ($detail["title"]); ?></div>
                    <div class="spxq_qgjgk"><span class="spxq_qgjg">
                    <?php if($detail['rush_ltime'] > $now_time && $detail['rush_kucun'] > 0): ?>￥<?php echo round($detail['rush_price']/100,2);?>
                    <?php else: ?>
                    ￥<?php echo round($detail['mall_price']/100,2); endif; ?>
                    <del>￥<?php echo round($detail['price']/100,2);?></del></span><span class="spxq_qgjgz">
                    <?php echo ($discount); ?>折</span><span class="graycl" style="margin-left:40px;">库存：<?php if(empty($detail['store'])): echo ($detail["kucun"]); else: echo ($detail["store"]); endif; ?></span></div>
                    <div class="spxq_qgjgk">
                        <span class="spxq_qgps">已售<span class="spxq_qgsnum"><?php echo ($detail['sold_num']); ?></span></span>
                        <span class="spxq_qgps"><?php echo ($totalnum); ?>人已评价</span>
                        <span class="spxq_qgps"><span class="spxq_qgpstarBg"><span class="spxq_qgpstar  spxq_qgpstar<?php echo ($shop["score"]); ?>">&nbsp;</span></span><span class="spxq_qgsnum"><?php echo round($shop['score']/10,1);?></span>分</span>
                    </div>
                    <?php if($detail['rush_ltime'] > $now_time && $detail['rush_kucun'] > 0): ?><div class="spxq_qgjgk">
                            <script type="text/javascript">
                                function getRTime(){
                                    var EndTime = new Date(parseInt($('#rush_time').attr('remaintime')) * 1000);
                                    var NowTime = new Date();
                                    var t =EndTime.getTime() - NowTime.getTime();
                                    var d=Math.floor(t/1000/60/60/24);
                                    var h=Math.floor(t/1000/60/60%24);
                                    var m=Math.floor(t/1000/60%60);
                                    var s=Math.floor(t/1000%60);
                                    if(d<10){
                                        document.getElementById("t_d").innerHTML ="0"+ d;
                                    }else{
                                        document.getElementById("t_d").innerHTML = d;
                                    };
                                    if(h<10){
                                        document.getElementById("t_h").innerHTML ="0"+ h;
                                    }else{
                                        document.getElementById("t_h").innerHTML = h;
                                    }
                                    if(m<10){
                                        document.getElementById("t_m").innerHTML ="0"+ m;
                                    }else{
                                        document.getElementById("t_m").innerHTML = m;
                                    };
                                    if(s<10){
                                        document.getElementById("t_s").innerHTML ="0"+ s;
                                    }else{
                                        document.getElementById("t_s").innerHTML = s;
                                    }								
                                }
                                setInterval(getRTime,1000);
                            </script>
                            <span class="radius3 spxq_qgTime mr10">
                                <span class="spxq_qgTimezt spxq_qgTimejx" id = 'rush_time' remaintime="<?php echo ($detail["rush_ltime"]); ?>">&nbsp;</span>
                                <span id="t_d">00</span>天
                                <span id="t_h">00</span>:
                                <span id="t_m">00</span>:
                                <span id="t_s">00</span>
                            </span>
                            <span class="ml10 graycl">库存：<?php echo ($detail['rush_kucun']); ?></span>
                        </div><?php endif; ?>
                    <div class="spxq_qgjgk">
                        <span style="height: 30px; line-height: 30px;">商家：<a style=" font-size: 18px; font-weight: bold;" target="_blank" href="<?php echo U('shop/detail',array('shop_id'=>$detail['shop_id']));?>"><?php echo ($shop["shop_name"]); ?></a></span>
                    </div>
                   
                    <script>
                        $(document).ready(function () {
                            $(".spxq_qgAdd").click(function () {
                                var rush_kucun = "<?php echo ($detail["rush_kucun"]); ?>";
                                var rush_time = "<?php echo ($detail["rush_time"]); ?>";
                                var num = $("#jq_num").val();
                                if(rush_kucun>0){
                                    if("<?php echo ($detail["max_buy"]); ?>" > rush_kucun){
                                            var max_buy = rush_kucun;
                                    }else{
                                            var max_buy = "<?php echo ($detail["max_buy"]); ?>";
                                    }
                                }else if(rush_time>0&&rush_kucun ==0){
                                    layer.msg("库存不足");
                                }else{
                                    var max_buy = 99;
                                }
                                if (parseInt(num) < parseInt(max_buy)) {
                                    num++;
                                }else{
                                      layer.msg("每人限购"+max_buy+"份");
                                }
                                $("#jq_num").val(num);
                            });
                            $(".spxq_qgRedu").click(function () {
                                var num = $("#jq_num").val();
                                if (num > 1) {
                                    num--;
                                }
                                $("#jq_num").val(num);
                            });
							$('#jq_num').focusout(function(){
								if("<?php echo ($detail["max_buy"]); ?>" > rush_kucun){
									var max_buy = rush_kucun;
								}else{
									var max_buy = "<?php echo ($detail["max_buy"]); ?>";
								}
							 	if(parseInt(this.value)>parseInt(max_buy)){
									
									$('#jq_num').val(max_buy);
									alert('该商品最大购买数是：'+max_buy)
								}
							});
                        });</script>                      
                    <?php if(is_array($format_list)): foreach($format_list as $key=>$item): ?><div class="spxq_qgjgk">   
                        <span class="detail_spxq_qg_tit"><?php echo ($item["name"]); ?></span>
                        <div class="mall_goods_guige">
                            <?php if(is_array($item[values])): foreach($item[values] as $key=>$val): if($val['checked']){ ?> 
                            <a href="javascript:;" class="current"><?php echo ($val["name"]); ?><i></i></a>
                            <?php }else if(isset($val['vid'])){?>                            
                            <a href="<?php echo U('mall/detail', array('goods_id'=>$detail['goods_id'],'vid'=>$val['vid']));?>"><?php echo ($val["name"]); ?><i></i></a>
                            <?php }else{ ?>
                            <a href="javascript:;" class="no"><?php echo ($val["name"]); ?><i></i></a>
                            <?php } endforeach; endif; ?>
                        </div>
                    </div><?php endforeach; endif; ?> 
                    
                    <div class="spxq_qgjgk">
                        <div class="left spxq_qgjj"><input type="text" value="1" name="num" id="jq_num" /><span class="spxq_qgAdd">&and;</span><span class="spxq_qgRedu">&or;</span></div>
                        <div class="left spxq_qgjjAn"><a href="javascript:void(0);" class="spxq_qgjjKq spxq_qgjjLq jq_addcart2">立即购买</a><a href="javascript:void(0);" class="spxq_qgjjKk jq_addcart">加入购物车</a></div>
                    </div>
                    <script>
                        var nums = '<?php echo ($cartnum); ?>';
                        nums = parseInt(nums);
                        $(document).ready(function () {
                            $(document).on('click', '.jq_addcart', function () {
                                var num = $("#jq_num").val();
                                var goods_id = "<?php echo ($detail["goods_id"]); ?>";
                                var url = '__ROOT__/index.php?g=pchome&m=mall&a=cartadd&mt=<?php echo time();?>&goods_id=<?php echo ($detail["goods_id"]); ?>&vid=<?php echo ($goods_value["id"]); ?>&num=' + num;
                                $.get(url, function (data) {
                                    if (data.status == 'success') {
                                        nums += parseInt(num);
                                        $("#num").html(nums);
                                        layer.msg(data.msg);
                                    } else {
                                       layer.msg(data.msg);
                                    }
                                }, 'json');

                            });
                            $(document).on('click', '.jq_addcart2', function () {
                                var num = $("#jq_num").val();
                                var goods_id = "<?php echo ($detail["goods_id"]); ?>";
                                var url = '__ROOT__/index.php?g=pchome&m=mall&a=cartadd2&mt=<?php echo time();?>&goods_id=<?php echo ($detail["goods_id"]); ?>&vid=<?php echo ($goods_value["id"]); ?>&num=' + num;
                                $.get(url, function (data) {
                                    if (data.status == 'success') {
                                        nums += parseInt(num);
                                        $("#num").html(nums);
                                        layer.msg(data.msg);
                                        setTimeout(function(){
                                            window.location.href=data.url;
                                        },2000);  
                                    } else {
                                       layer.msg(data.msg);
                                    }
                                }, 'json');

                            });
                        });
                    </script>
                    <div class="spxq_qgtck">服务：<span><a class="spxq_qgFw" href="javascript:void(0);"><em>&nbsp;</em>随时退</a><a class="spxq_qgFw" href="javascript:void(0);"><em>&nbsp;</em>过期退</a><a class="spxq_qgFw" href="javascript:void(0);"><em>&nbsp;</em>真实评价</a></span></div>
                </div>
            </div>
        </div>
        <div class="right spxq_xqgm_r">
            <div class="spxq_qgwx"><img src="<?php echo ($ex['wei_pic']); ?>" width="120" height="120" />
                <p>扫描商家微信</p>
                <p>轻松购享优惠</p>
            </div>
            <div class="share bdsharebuttonbox spxq_qgFx" data-tag="share_1"><?php if(($shop["favo"]) == "0"): ?><a mini='act' class="spxq_qgFxA" href="<?php echo U('shop/favorites',array('shop_id'=>$detail['shop_id']));?>"><em>&nbsp;</em>收藏本店</a><?php else: ?><a class="spxq_qgFxA" href="javascript:void(0);"><em>&nbsp;</em>已收藏</a><?php endif; ?><a class="spxq_qgFxA" data-cmd="more" href="javascript:void(0);"><em>&nbsp;</em>分享到</a></div>
            <script>window._bd_share_config = {share: [{"tag": "share_1", 'bdCustomStyle': '__TMPL__statics/empty.css'}]};
                with (document)
                    0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
        </div>
    </div>
    <div class="spxqBox">
        <div class="left zy_content_l">
            <div class="spxq_xqT">
                <ul>
                    <li class="on"><code rel="spxq_xqBt1">商品详情</code><em></em></li>
                    <li><code rel="spxq_xqBt2">商品属性</code><em></em></li>
                    <li><code rel="spxq_xqBt3">购买须知</code><em></em></li>
                    <li><code rel="spxq_xqBt4">商家详情</code><em></em></li>
                    <li><code rel="spxq_xqBt5">用户评价</code><em></em></li>
                </ul>
            </div>
            <script>
                $(document).ready(function () {
                    $(".spxq_xqT li").click(function () {
                        $(".spxq_xqT2 ul li").removeClass("on");
                        $(".jq_" + $(this).find('code').attr('rel')).addClass("on");
                        var _targetTop = $('.' + $(this).find('code').attr('rel')).offset().top;//获取位置
                        jQuery("html,body").animate({scrollTop: _targetTop}, 300);//跳转
                    });
                });
            </script>
            <div class="spxq_xqBt1">
                <div class="spxq_xqBt">商品详情</div>
                <div class="spxq_xqNr"><?php echo ($detail["details"]); ?></div>
            </div>
            <div class="spxq_xqBt2">
                <div class="spxq_xqBt">商品属性</div>
                <div class="spxq_xqNr"><?php echo ($detail["attr"]); ?></div>
            </div>
            <div class="spxq_xqBt3">
                <div class="spxq_xqBt">购买须知</div>
                <div class="spxq_xqNr"><?php echo ($detail["instructions"]); ?></div>
            </div>

            <div class="spxq_xqBt4">
                <div class="spxq_xqBt">店铺地图</div>
                <div class="spxq_xqNr">
                    <div class="left spxq_xqMap_l">
                        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7b92b3afff29988b6d4dbf9a00698ed8"></script>
                        <div id="allmap" style="width:384px; height:300px;"></div>
                        <script type="text/javascript">
                // 百度地图API功能
                var map = new BMap.Map("allmap");
                map.centerAndZoom(new BMap.Point("<?php echo ($shop["lng"]); ?>", "<?php echo ($shop["lat"]); ?>"), 15);
                var point = new BMap.Point("<?php echo ($shop["lng"]); ?>", "<?php echo ($shop["lat"]); ?>");
                map.centerAndZoom(point, 15);
                var marker = new BMap.Marker(point); // 创建标注
                map.clearOverlays();
                map.addOverlay(marker); // 将标注添加到地图中
                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                map.addControl(new BMap.NavigationControl()); //添加默认缩放平移控件
                        </script>
                    </div>
                    <div class="left spxq_xqMap_r">
                        <script>
                            $(function () {
                                $(".spxq_xqMapList li").each(function (e) {
                                    $(this).click(function () {
                                        $(".spxq_xqMapList li").removeClass("on");
                                        $(this).addClass("on");
                                        $(".spxq_xqMapListNr").each(function (i) {
                                            if (e == i) {
                                                $(".spxq_xqMapListNr").hide();
                                                $(this).show();
                                            }
                                            else {
                                                $(this).hide();
                                            }
                                        });
                                    });
                                });
                            });
                        </script>			
                        <div class="left spxq_xqMapList">
                        <ul>
                            <?php $i=0; ?>
                            <?php if(is_array($lists)): foreach($lists as $key=>$item): $i++;if($i<=5){ ?>
                                <li id="li_<?php echo ($i); ?>" <?php if($i == 1): ?>class="on"<?php endif; ?> ><?php echo ($item["name"]); ?></li>
                                <?php }else{ ?>
                                <li id="li_<?php echo ($i); ?>" style="display:none;"><?php echo ($item["name"]); ?></li>
                                <?php } endforeach; endif; ?>
                        </ul>
                    </div>
                    <div class="left" style="width:356px;">
                        <?php $i=0; ?>
                        <?php if(is_array($lists)): foreach($lists as $key=>$item): $i++;if($i<=5){ ?>
                            <div class="spxq_xqMapListNr" id="detail_<?php echo ($i); ?>" <?php if($i == 1): ?>style="display:block;"<?php endif; ?> >
                                <table width="100%" class="spxq_table" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2"><p class="spxq_xqMapT"><?php echo ($shop["shop_name"]); ?>（<?php echo ($item["name"]); ?>）</p></td>
                                    </tr>
                                    <tr>
                                        <td width="50"><p class="spxq_tabT">评价：</p></td>
                                        <td><a class="" href=""><?php echo ($item["score_num"]); ?>人评价</a></td>
                                    </tr>
                                    <tr>
                                        <td><p class="spxq_tabT">地址：</p></td>
                                        <td><p class="spxq_xqMapWz"><?php echo ($item["addr"]); ?></p></td>
                                    </tr>
                                    <tr>
                                        <td><p class="spxq_tabT">电话：</p></td>
                                        <td><p class="spxq_xqMapWz"><?php echo ($item["telephone"]); ?></P></td>
                                    </tr>
                                </table>
                            </div>
                            <?php }else{ ?>
                            <div class="spxq_xqMapListNr" style="display:none;" id="detail_<?php echo ($i); ?>">
                                <table width="100%" class="spxq_table" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2"><p class="spxq_xqMapT"><?php echo ($shop["shop_name"]); ?>（<?php echo ($item["name"]); ?>）</p></td>
                                    </tr>
                                    <tr>
                                        <td width="50"><p class="spxq_tabT">评价：</p></td>
                                        <td><a class="" href=""><?php echo ($item["score_num"]); ?>人评价</a></td>
                                    </tr>
                                    <tr>
                                        <td><p class="spxq_tabT">地址：</p></td>
                                        <td><p class="spxq_xqMapWz"><?php echo ($item["addr"]); ?></p></td>
                                    </tr>
                                    <tr>
                                        <td><p class="spxq_tabT">电话：</p></td>
                                        <td><p class="spxq_xqMapWz"><?php echo ($item["telephone"]); ?></P></td>
                                    </tr>
                                </table>

                            </div>
                            <?php } endforeach; endif; ?>
                    </div>

                </div>
                <div id='setpage'></div>
            </div>
            </div>
            <script type="text/javascript">
                var totalpage, pagesize, cpage, count, curcount, outstr, total;
                total = "<?php echo ($count); ?>";
                cpage = 1;
                totalpage = "<?php echo ($totalnums); ?>";
                pagesize = 5;
                outstr = "";
                function gotopage(target) {
                    var big_val = target * 5;
                    var small_val = big_val - 4;
                    $('.spxq_xqMapList ul li').hide();
                    $('.spxq_xqMapListNr').hide();
                    $('.spxq_xqMapList ul li').removeClass('on');
                    for (var i = small_val; i <= big_val; i++) {
                        $('#li_' + i).show();
                        $('#li_' + small_val).addClass('on');
                        $('#detail_' + small_val).show();
                    }
                    cpage = target;        //把页面计数定位到第几页 
                    setpage();
                    //reloadpage(target);    //调用显示页面函数显示第几页,这个功能是用在页面内容用ajax载入的情况 
                }
                setpage();    //调用分页 
            </script>
            <div class="spxq_xqBt5">
                <div class="spxq_xqBt">
                    <div class="left">用户评价</div>
                    <div class="right spxq_xqBt_r">我买过此商品，<a class="spxq_pjAn" href="<?php echo U('member/index/index');?>">我要评价</a></div>
                </div>
                <div class="spxq_xqNr">
                    <ul>
                        <?php if(is_array($list)): foreach($list as $key=>$var): ?><li class="spxq_pjList">
                                <div class="left spxq_pjList_l">
                                    <div class="spxq_pjTx"><img src="__ROOT__/attachs/<?php echo (($users[$var['user_id']]['face'])?($users[$var['user_id']]['face']):'default.jpg'); ?>" width="50" height="50" /></div>
                                    <p class="spxq_pjYh"><?php echo ($users[$var['user_id']]['nickname']); ?></p>
                                    <p><img src="__TMPL__statics/images/<?php echo ($userrank[$users[$var['user_id']]['rank_id']]['rank_name']); ?>.jpg" /></p>
                                </div>
                                <div class="left spxq_pjList_r">
                                    <div><span class="spxq_qgpstarBg"><span class="spxq_qgpstar">&nbsp;</span></span><span class="spxq_pjTime"><?php echo (date('Y-m-d',$var["create_time"])); ?></span></div>
                                    <p class="spxq_pjP"><?php echo ($var["contents"]); ?></p>
                                    <ul class="spxq_pjUl">
                                        <?php if(is_array($pics)): foreach($pics as $key=>$pic): if(($pic["order_id"]) == $var["order_id"]): ?><li class="spxq_pjLi"><img src="__ROOT__/attachs/<?php echo ($pic["pic"]); ?>" width="100" height="100" /></li><?php endif; endforeach; endif; ?>
                                    </ul>
                                </div>
                            </li><?php endforeach; endif; ?>
                        <div class="x">
                            <?php echo ($page); ?>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right zy_content_r">
          <div class="nearbuy_wx"><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["wxcode"]); ?>" width="100" height="100" /></div>
            <div class="nearbuy_hotCp">
                <div class="nearbuy_hotCpT">
                    <div class="left">猜你喜欢</div>
                    <div class="right"><a class="nearbuy_zjClear" href="javascript:void(0);">换换<em></em></a></div>
                </div>
                <ul id="glike">
                    <?php if(is_array($like)): $i = 0; $__LIST__ = $like;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><li>
                             <?php if(($i) >= "2"): ?><hr style=" border:none 0px; border-bottom: 1px solid #e0e0e0; margin-bottom:16px;" /><?php endif; ?>
                            <div class="sy_hottjList"><a target="_blank" href="<?php echo U('mall/detail',array('goods_id'=>$l['goods_id']));?>"><img src="__ROOT__/attachs/<?php echo ($l["photo"]); ?>" width="180" height="115" />
                                    <p class="sy_hottjbt"><?php echo ($l["title"]); ?></p> 
                                    <p class="sy_hottjJg"><span class="left">¥<?php echo intval($l['mall_price']/100); ?><del>¥<?php echo intval($l['price']/100); ?></del></span><span class="right">已售<?php echo ($l["sold_num"]); ?></span></p>
                                    </a>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>

            <script type="text/javascript" language="javascript">

                $(document).ready(function () {
                    $('.nearbuy_zjClear').click(function () {
                        $.post("<?php echo U('mall/get_like');?>", {}, function (result) {
                            if (result.status == 'success') {
                                var res = '';
                                arr = result.likes;
                                
                                var url = BAO_ROOT + '/mall/detail/goods_id/';
                                $.each(arr, function (n, value) {
                                    url += value.goods_id+'.html';
                                    res += '<li><div class=sy_hottjList><a target="_blank" href="'+url+'"><img src=__ROOT__/attachs/' + value.photo + ' width=180 height=115 />';
                                    res += '<p class=sy_hottjbt>' + value.title + '</p>';
                                    res += '<p class=sy_hottjJg><span class=left>¥' + parseInt(value.mall_price / 100) + '<del>¥' + parseInt(value.price / 100) + '</del></span><span class="right">已售' + value.sold_num + '</span></p>';
                                    res += '<hr style=border:none 0px; border-bottom: 1px solid #e0e0e0; margin-top:6px; />';
                                    res += '</a></div></li>';

                                });

                                $('#glike').html(res);


                            } else {
                                layer.msg(result.message);
                            }
                        }, 'json');

                    })
                })

            </script>


            <div class="nearbuy_hotCp">
                <div class="nearbuy_hotCpT">
                    <div class="left">浏览足迹</div>
                    <div class="right"><a class="nearbuy_zjClear" id="emptygoods"  href="javascript:void(0);">清空</a></div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#emptygoods").click(function(){
                            $.post("<?php echo U('mall/emptygoods');?>",'',function(data){
                                if(data.status == 'success'){
                                    layer.msg(data.msg,{icon:1});
                                    window.location.reload(true);
                                }else{
                                    layer.msg(data.msg,{icon:2});
                                }
                            },'json')
                        })
                    });
                </script>
                <ul>
                    <?php $i =0; ?>
                    <?php if(is_array($viewgoods)): foreach($viewgoods as $key=>$item): $i++ ?>
                        <li>
                        <?php if($i > 1): ?><hr style=" border:none 0px; border-bottom: 1px solid #e0e0e0; margin-bottom:16px;" /><?php endif; ?>
                            <div class="sy_hottjList"><a target="_blank" target="_blank" href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>">
                                    <div class="left nearbuy_zj_l"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="82" height="50" /></div>
                                    <p style="height: 36px; overflow: hidden;" class="nearbuy_zjP"><?php echo ($item["title"]); ?></p> 
                                    <p style="font-weight: normal;" class="nearbuy_zjJg">¥<?php echo round($item['mall_price']/100,2);?><del>¥<?php echo round($item['price']/100,2);?></del></p>
                            </div>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="pagewd foot_security">
	<ul>
	    <li><i class="ico_1"></i>消费返还</li>
        <li><i class="ico_2"></i>1T积分=1元</li>
        <li><i class="ico_3"></i>随时兑换</li>
        <li><i class="ico_4"></i>7X24小时服务</li>
    </ul>
</div>
<div class="footerOut">
    <?php if($ctl == index): ?><div class="foot_yqlj">
            友情链接：
            <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Links,,0,10,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Links")->where("")->order("orderby asc")->limit("0,10")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><a target="_blank" href="<?php echo ($item["link_url"]); ?>"><?php echo ($item["link_name"]); ?></a> <?php endforeach; ?>
        </div><?php endif; ?>
    <div class="footer">
        <div class="footNav">
            <div class="left">
                <div class="footNavLi">
                    <ul>
                    	<li class="footerLi foot_contact">
                            <h3><i class="ico_1"></i>联系我们</h3>
                			<div class="nr">
                            	<p>客服电话：<b class="fontcl3"><?php echo ($CONFIG["site"]["tel"]); ?></b></p>
                                <p class="graycl">免费长途</p>
                                <p>在线客服：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=800026911&amp;site=www.baocms.cn&amp;menu=yes"><img src="__TMPL__statics/images/foot_btn.png"/></a></p>
                                <p>工作时间：周一至周日9:00-22:00</p>
                                <p class="graycl">法定节假日除外</p>
                            </div>
                        </li>
                        <li class="footerLi">
                            <h3><i class="ico_2"></i>公司信息</h3>
                            <ul class="list">
                                <li><a target="_blank" title="关于我们" href="<?php echo U('article/system',array('content_id'=>1));?>">关于我们</a></li>
                                <li><a target="_blank" title="联系我们" href="<?php echo U('article/system',array('content_id'=>3));?>">联系我们</a></li>
                                <li><a target="_blank" title="人才招聘" href="<?php echo U('article/system',array('content_id'=>2));?>">人才招聘</a></li>
                                <li><a target="_blank" title="免责声明" href="<?php echo U('article/system',array('content_id'=>6));?>">免责声明</a></li>
                            </ul>
                        </li>
                        <li class="footerLi">
                            <h3><i class="ico_3"></i>商户合作</h3>
                            <ul class="list">
                                <li><a href="<?php echo U('shop/apply');?>">商家入驻</a></li>
                                <li><a target="_blank" title="广告合作" href="<?php echo U('article/system',array('content_id'=>5));?>">广告合作</a></li>
                                <li><a href="<?php echo U('shangjia/index/index');?>">商家后台</a></li>
                            </ul>
                        </li>
                        <li class="footerLi">
                            <h3><i class="ico_4"></i>用户帮助</h3>
                            <ul class="list">
                                <li><a target="_blank" title="服务协议" href="<?php echo U('article/system',array('content_id'=>7));?>">服务协议</a></li>
                                <li><a target="_blank" title="退款承诺" href="<?php echo U('article/refund');?>">退款承诺</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
              
            </div>
            <div class="right"><p>扫一扫加关注</p><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["wxcode"]); ?>" width="149" height="149" /></div>
        </div>
    </div>
	<div class="footerCopy">copyright 2013-2113 <?php echo ($_SERVER['HTTP_HOST']); ?> All Rights Reserved <?php echo ($CONFIG["site"]["sitename"]); ?>版权所有 - <?php echo ($CONFIG["site"]["icp"]); ?> <?php echo ($CONFIG["site"]["tongji"]); ?></div>

</div>  
<div class="topUp">
    <ul>
    	<li class="kefu"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=800026911&amp;site=www.baocms.cn&amp;menu=yes"><div class="kefu_open maincl">在线客服</div></a></li>
        <li class="topBack"><div class="topBackOn">回到<br />顶部</div></li>
        <li class="topUpWx"><div class="topUpWxk"><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["wxcode"]); ?>" width="149" height="149" /><p class="maincl">扫描二维码关注微信</p></div></li>
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
                if ($(window).scrollTop() > '<?php echo ($height_num); ?>') {
                    $(".spxq_xqT2").show();
                } else {
                    $(".spxq_xqT2").hide();
                }
            }
        });
        $(".topBack").click(function () {
            $("html,body").animate({scrollTop: 0}, 200);
        });
		
		
		$(window).scroll(function(){
			var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
			var menu = $(".topUp");                      //定义变量，抓取topUp
			var items = $(".footerOut");    //定义变量，查找footerOut 
	
			items.each(function(){
				var m=$(this);
				var itemsTop = m.offset().top;      //定义变量，获取当前类的top偏移量
				if(itemsTop-360 <= top-360){
					menu.css('bottom','360px');
					menu.css('top','auto');
				}else{
					menu.css('bottom','0px');
					menu.css('top','auto');
				}
			});
		});
    });
</script>
</body>
</html>