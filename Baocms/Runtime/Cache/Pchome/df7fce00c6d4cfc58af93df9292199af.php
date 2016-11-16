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
<!--top END-->
<script>
$(document).ready(function () {
	$('.sy_flexslider').flexslider({
		directionNav: false,
		pauseOnAction: false
	});//商城banner
	$(function() {
		$(".mall_crowd_flexslider").flexslider({
			animation: "slide",
			animationLoop: false,
			itemWidth: 282,
			itemMargin: 24,
			minItems: 2,
			maxItems: 4,
			controlNav: false,
		   // pausePlay: true
		});
	});	//商城众筹
	
});
</script>
<!--商城频道首页-->
<!--banner内容-->
<div class="pagewd mall_banner mb20">
	<div class="mall_cate">
    	<ul>
        	 <?php $i=0; ?>         
        	 <?php if(is_array($goodscate)): foreach($goodscate as $key=>$item): if(($item["parent_id"]) == "0"): $i++;if($i <= 10){ ?>
                 <li class="list">
                    <h3><a href="<?php echo U('mall/items',array('cat'=>$item['cate_id']));?>"><?php echo ($item["cate_name"]); ?><em class="linkIco"></em></a></h3>
                    <div class="list_child">
                    	 <?php $i2=0; ?>
                        <?php if(is_array($goodscate)): foreach($goodscate as $key=>$item2): if(($item2["parent_id"]) == $item["cate_id"]): $i2++;if($i2 <= 3){ ?>
                            <a target="_blank" href="<?php echo U('mall/items',array('cat'=>$item['cate_id'],'cate_id'=>$item2['cate_id']));?>"><?php echo msubstr($item2['cate_name'],0,4,'utf-8',false);?></a>
                            <?php } endif; endforeach; endif; ?>
                    </div>
                </li>
                <?php } endif; endforeach; endif; ?>
            
    	   
	    </ul>
    </div>
	<div class="sy_flexslider">
        <ul class="slides">
            <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Ad, closed=0 AND site_id=1 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,5,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=1 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="list" style="background:url('__ROOT__/attachs/<?php echo ($item["photo"]); ?>') center center no-repeat;"><a target="_blank" href="<?php echo ($item["link_url"]); ?>"></a></li> <?php endforeach; ?>
        </ul>
    </div>
    <div class="mall_hot">
    	<?php if(is_array($itemss)): $i = 0; $__LIST__ = array_slice($itemss,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="pub_img"><a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>"><span class="tag"><img src="__TMPL__statics/images/mall/hot.png" /></span><img src="__ROOT__/attachs/<?php echo ($item["img"]); ?>" width="240" height="170" /></a></div>
                    <div class="pub_wz">
                        <h3 class="overflow_clear mb10"><a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>"><?php echo ($item["title"]); ?></a></h3>
                        <div class="mall_progressBar mb20">
                            <div class="mall_progressBar_wrap">
                           
                                <span class="mall_progressBar_bar" style="width:<?php echo ($item['have_price']/$item['all_price']*100); ?>%;"></span>
                            </div>
                            <ul class="mall_progressBar_txt">
                                <li class="list"><p><?php echo ($item['have_price']/100); ?></p><p class="graycl">已筹金额</p></li>
                                <li class="list"><p><?php echo ($item['all_price']/100); ?></p><p class="graycl">总需金额</p></li>
                                <li class="list"><p>
                                <?php if($item['all_price']-$item['have_price'] > '0'): echo ($item['all_price']/100-$item['have_price']/100); ?>
                                    <?php else: ?>
                                    0<?php endif; ?>
                                </p><p class="graycl">剩余金额</p></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即夺宝</a>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--banner内容结束-->
<div class="">
    <!--商品众筹-->
    <div class="mall_tit pagewd">
    	<h2 class="left"><b class="bq">众</b>商品众筹</h2>
        <a href="<?php echo U('mall/crowdList');?>" class="more right graycl">更多&gt;</a>
    </div>
    <div class="mall_crowd mb20">
    	<script src="__TMPL__mall/js/jquery.circliful.min.js??v=20160409"></script>
        <script>
			$(document).ready(function() {
                $('.indicatorContainer').circliful();
            });
        </script>
        
        <div class="mall_crowd_flexslider carousel mall_crowd_box">
          <ul class="slides">
          	<?php if(is_array($itemss)): $i = 0; $__LIST__ = array_slice($itemss,1,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="list">
                        <div class="pub_img"><a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["img"]); ?>" width="282" height="200" /> 
                                <div  class="circle-svg indicatorContainer" data-dimension="120" data-text="<?php echo (ceil($item['have_price']/$item['all_price']*100)); ?>%" data-info="" data-width="6" data-fontsize="20" data-percent="<?php echo (ceil($item['have_price']/$item['all_price']*100)); ?>" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#fff"></div>

                        </div>
                        <div class="pub_wz">
                            <h3 class="overflow_clear mb10"><a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>"><?php echo ($item["title"]); ?></a></h3>
                            <div class="mall_progressBar mb10">
                                <div class="mall_progressBar_wrap">
                                    <span class="mall_progressBar_bar" style="width:<?php echo ($item['have_price']/$item['all_price']*100); ?>%;"></span>
                                </div>
                                <ul class="mall_progressBar_txt">
                                    <li class="left"><p><span class="graycl">已筹金额</span> <?php echo ($item['have_price']/100); ?></p></li>
                                    <li class="right"><p><span class="graycl">剩余金额</span> 
                                    <?php if($item['all_price']-$item['have_price'] > '0'): echo ($item['all_price']/100-$item['have_price']/100); ?>
                                    <?php else: ?>
                                    0<?php endif; ?>
                                    </p></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <a href="<?php echo U('mall/crowdDetail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即众筹</a>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            
          </ul>
        </div>
    </div>
    <!--商品众筹结束-->
</div>
<div class="pagewd">
    <!--新品上架-->
    <div class="mall_tit">
    	<h2 class="left"><b class="bq">新</b>新品上架</h2>
        <a href="<?php echo U('mall/items',array('cat'=>0,'order'=>'n'));?>" class="more right graycl">更多&gt;</a>
    </div>
    <div class="mall_new mb20">
    	<?php if(is_array($new)): $i = 0; $__LIST__ = array_slice($new,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="left mall_newOne">
                <img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="560" height="390" />
                <div class="pub_wz">
                    <span class="bq">新</span>
                    <h3><?php echo bao_msubstr($item['title'],0,12,false);?></h3>
                    <h3 class="fontcl1">￥<?php echo round($item['mall_price']/100,2);?></h3>
                    <p>市场价：<del>￥<?php echo round($item['price']/100,2);?></del></p>
                    <p><span class="mr10">已售：<?php echo ($item["sold_num"]); ?></span><span class="ml10">库存：<?php echo ($item["kucun"]); ?></span></p>
                    <a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即购买</a>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    	
        <div class="right mall_new_list_box">
            <ul>
            	<?php if(is_array($new)): $i = 0; $__LIST__ = array_slice($new,1,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="mall_new_list">
                        <div class="pub_img"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><span class="bq">新</span><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="290" height="210" /></a></div>
                        <div class="pub_wz">
                            <h3 class="overflow_clear mb10"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><?php echo bao_msubstr($item['title'],0,12,false);?></a></h3>
                            <p class="fontcl1 price">￥<?php echo round($item['mall_price']/100,2);?></p>
                            <P>市场价：<del>￥<?php echo round($item['price']/100,2);?></del></P>
                            <div class="box">
                                <div class="left" style="line-height:20px; text-align:left; font-size:12px; color:#666;">已售出：<?php echo ($item["sold_num"]); ?><p>库存：<?php echo ($item["kucun"]); ?></p></div>
                                <div class="right"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即购买</a></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
               
               
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--新品上架结束-->
    <!--热门推荐-->
    <div class="mall_tit">
    	<h2 class="left"><b class="bq">荐</b>热门推荐</h2>
        <a href="<?php echo U('mall/items',array('cat'=>0,'order'=>'d'));?>" class="more right graycl">更多&gt;</a>
    </div>
    <div class="mall_recmd mb20">
    	<ul>
        	<?php if(is_array($tuijian)): $i = 0; $__LIST__ = $tuijian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="list">
                    <p class="bq_box bor1"><span class="bq">推荐</span></p>
                    <a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="blackcl3"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="204" height="145" /></a>
                    <h3 class="overflow_clear mt10"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="blackcl3"><?php echo bao_msubstr($item['title'],0,12,false);?></a></h3>
                    <p class="price fontcl1">现价：￥<?php echo round($item['mall_price']/100,2);?></p>
                    <p>市场价：<del>￥<?php echo round($item['price']/100,2);?></del></p>
                    <p class="graycl" style="overflow:hidden; margin-top:10px; font-size:12px;"><span class="left">已售：<?php echo ($item["sold_num"]); ?></span><span class="right">库存：<?php echo ($item["kucun"]); ?></span></p>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
	    </ul>
        <div class="clear"></div>
    </div>
    <!--热门推荐结束-->
    <!--限时抢购-->
    <div class="mall_tit">
    	<h2 class="left"><b class="bq">抢</b>限时抢购</h2>
        <a href="<?php echo U('mall/items',array('cat'=>0,'order'=>'3'));?>" class="more right graycl">更多&gt;</a>
    </div>
    <div class="mall_recmd mall_buy mb20">
    	<div class="left mall_buy_time">
        	<img src="__TMPL__statics/images/mall/time.png" />
        	<p>距离结束还剩</p>
            <script type="text/javascript" language="javascript">
                var t1 = 20*3600*1000;
                
                    setInterval(function () {
                        if(t1>0){
                        t1-=1000;
                       // alert(t1);
                       var str = '';
                        var d1 = Math.floor(t1 / 1000 / 60 / 60 / 24);
                        var h1 = Math.floor(t1 / 1000 / 60 / 60 % 24);
                        var m1 = Math.floor(t1 / 1000 / 60 % 60);
                        var s1 = Math.floor(t1 / 1000 % 60);
                        //alert(d1);
                        //if (d1 > 30 || t1 < 11) {
                           // $('#s1').hide();
                       // }

                        
                        if (h1 < 10) {
                            str+='<span>0'+h1+'</span>时';
                        } else {
                           str+='<span>'+h1+'</span>时';
                        }
                        if (m1 < 10) {
                           str+='<span>0'+m1+'</span>分';
                        } else {
                            str+='<span>'+m1+'</span>分';
                        }
						if (s1 < 10) {
                           str+='<span>0'+s1+'</span>分';
                        } else {
                            str+='<span>'+s1+'</span>分';
                        }
                    }
                        $("#s1").html(str);
                    }, 1000);
            </script>
            <div id="s1" class="time"></div>
        </div>
        <div class="right mall_buy_r">
            <ul>
            
            	<?php if(is_array($xianshi)): $i = 0; $__LIST__ = $xianshi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="list">
                        <p class="bq_box"><span class="bq">抢购</span></p>
                        <a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="204" height="145" /></a>
                        <h3 class="overflow_clear mt10"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="blackcl3"><?php echo bao_msubstr($item['title'],0,12,false);?></a></h3>
                        <p class="price fontcl1">￥<?php echo ($item['rush_price']/100); ?></p>
                        <p>市场价：<del>￥<?php echo ($item['price']/100); ?></del></p>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--限时抢购结束-->
</div>
<div class="mall_bggrey">
    <div class="pagewd">
        <div class="mall_tit">
            <h2 class="left">热门商品</h2>
            <a href="<?php echo U('mall/items',array('cat'=>0,'order'=>'v'));?>" class="more right graycl">更多&gt;</a>
        </div>
        <div class="mall_list_box">
            <ul>
            
            	<?php if(is_array($like)): $i = 0; $__LIST__ = $like;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="mall_list">
                        <div class="box"> 
                            <a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="278" height="190" /></a>
                            <h3 class="overflow_clear"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><?php echo bao_msubstr($item['title'],0,12,false);?></a></h3>
                            <p class="fontcl1">现价：<big><b>￥<?php echo ($item['mall_price']/100); ?></b></big><span style="margin-left:20px;">市场价：<del class="blackcl6">￥<?php echo ($item['price']/100); ?></del></span></p>
                            
                            <div class="btn_box"><a href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即购买</a></div>
                            <p class="graycl" style="overflow:hidden; margin-top:16px;"><span class="left">已售：<?php echo ($item["sold_num"]); ?></span><span class="right">库存：<?php echo ($item["kucun"]); ?></span></p>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
       
    </div>
</div>
<!--商城频道首页结束-->
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