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
<div class="nav mb10">
    <div class="navList">
        <ul>
        	<li class="navListAll">全部分类</li>
            
                <?php if(is_array($func)): foreach($func as $key=>$item): if($item['is_show'] == 1): if($item['is_nav'] == 1): ?><li class="navLi"><a <?php if($item['url'] == $current_url): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="首页" <?php if($item['is_system'] == 1): ?>href="<?php echo U($item['url']);?>" <?php else: ?>href="http://<?php echo ($item["url"]); ?>"<?php endif; ?> ><?php echo ($item["title"]); if($item['is_new'] == 1): ?><em class="hot"></em><?php endif; ?></a></li><?php endif; endif; endforeach; endif; ?>
                
                
            <!--<li class="navLi"><a <?php if($ctl == 'index'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="首页" href="<?php echo U('pchome/index/index');?>" >首页</a></li>
           
            <li class="navLi"><a <?php if($ctl == 'shop'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="商家" href="<?php echo U('pchome/shop/index');?>" >商家</a></li>

            <li class="navLi"><a <?php if($ctl == 'tuan'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="抢购" href="<?php echo U('pchome/tuan/nearby');?>" >抢购</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'huodong'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="活动" href="<?php echo U('pchome/huodong/index');?>" >活动</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'lifeservice'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="上门服务" href="<?php echo U('pchome/lifeservice/index');?>" >上门服务</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'mall'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="本地商城" href="<?php echo U('pchome/mall/index');?>" >本地商城</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'ele'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="外卖" href="<?php echo U('pchome/ele/index');?>" >外卖</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'ding'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="订座" href="<?php echo U('pchome/ding/index');?>" >订座</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'life'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="同城信息" href="<?php echo U('pchome/life/main');?>" >同城信息</a></li> -->
            
            <!--<li class="navLi"><a <?php if($ctl == 'coupon'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="优惠券" href="<?php echo U('pchome/coupon/index');?>" >优惠券</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'jifen'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="积分商城" href="<?php echo U('pchome/jifen/index');?>" >积分商城</a></li>
            
            <li class="navLi"><a <?php if($ctl == 'post'): ?>class="navA  on"<?php else: ?>class="navA"<?php endif; ?> title="贴吧" href="<?php echo U('pchome/post/index');?>" >贴吧</a></li>-->
 
        </ul>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.sy_flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
		
		$('.sy_buy_flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false,
			controlNav:false,
        });
		
        $('.sy_waimai_flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
    });//首页轮播js

    $(function () {
        
        $(".syShop_tab>.left a").each(function (e) {
            $(this).mouseover(function (event) {
                $(this).parent().find("a").removeClass("on");
                $(this).addClass("on");
                $(".syShop_list_box .syShop_list").each(function (i) {
                    if (e == i)
                    {
                        $(this).parent().find(".syShop_list").hide();
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });
            });
        });//首页本地商城部分结束
        $(".cityInfor_tab i").each(function (e) {
            $(this).mouseover(function (event) {
                $(this).parent().find("i").removeClass("on");
                $(this).addClass("on");
                $(".cityInfor_nr .cityInfor_list").each(function (i) {
                    if (e == i)
                    {
                        $(this).parent().find(".cityInfor_list").hide();
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });
            });
        });//首页同城信息部分结
        $(".sy_seatSwitch_tab li").each(function (e) {
            $(this).mouseover(function (event) {
                $(this).parent().find("li").removeClass("on");
                $(this).addClass("on");
                $(".sy_seatSwitch_box .sy_seatSwitch1").each(function (i) {
                    if (e == i)
                    {
                        $(this).parent().find(".sy_seatSwitch1").hide();
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });
            });
        });//首页订座部分结
        
    });
</script>
<!--首页第一部分开始-->
<div class="sy_partOne">
	<div class="left sy_partOne_cate"><div class="menu_fllist2">
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
    <div class="right sy_partOne_r">
    	<div class="sy_flexslider">
            <ul class="slides">
                <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Ad, closed=0 AND site_id=1 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,5,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=1 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="list" style="background:url('__ROOT__/attachs/<?php echo ($item["photo"]); ?>') center center no-repeat;"><a target="_blank" href="<?php echo ($item["link_url"]); ?>"></a></li> <?php endforeach; ?>
            </ul>
        </div>
        <ul class="sy_flsx">
            <li class="bg_1">
                <h3><em class="ico ico_1"></em>热门抢购</h3>
            <?php $i=0; ?>
            <?php if(is_array($tuancates)): foreach($tuancates as $key=>$item): if(($item["is_hot"]) == "1"): $i++;if($i<10){ ?>
                <?php if($item['parent_id'] == 0): ?><a title="<?php echo ($item["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['cate_id']));?>"><?php echo ($item['cate_name']); ?></a>
                    <?php else: ?>
                    <a title="<?php echo ($item["cate_name"]); ?>" target="_blank" href="<?php echo U('tuan/index',array('cat'=>$item['parent_id'],'cate_id'=>$item['cate_id']));?>"><?php echo ($item['cate_name']); ?></a><?php endif; ?>
                <?php } endif; endforeach; endif; ?>
            </li>
            <li class="bg_2">
                <h3><em class="ico ico_2"></em>全部区域</h3>
            <?php $i=0; ?>
            <?php if(is_array($areas)): foreach($areas as $key=>$item): $i++;if($i<=10&&$item['city_id'] == $city_id){ ?>
                <a href="<?php echo U('tuan/index',array('area'=>$item['area_id']));?>"><?php echo ($item['area_name']); ?></a>
                <?php } endforeach; endif; ?>
            </li>
            <li class="bg_3" style="margin-right:0;">
                <h3><em class="ico ico_3"></em>热门商圈</h3>
            <?php $i=0; ?>
            <?php if(is_array($bizs)): foreach($bizs as $key=>$item): if(in_array($item['area_id'],$limit_area)&&$i<=8&&$item['is_hot']=='1'){ ?>
                <a href="<?php echo U('tuan/index',array('area'=>$item['area_id'],'business'=>$item['business_id']));?>"><?php echo ($bizs[$item['business_id']]['business_name']); ?></a>
                <?php $i++;} endforeach; endif; ?>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<!--首页第一部分结束-->
<div class="pagewd" id="index-gun">
    <!--首页抢购部分开始-->
    <div class="sy_FloorBt" data="top_1" id="floor1" style="border-bottom:none;">
        <div class="left sy_FloorBtz"><i class="ico_1"></i><span class="bt cl_1">限时抢购</span>
            <script type="text/javascript" language="javascript">
                var t1 = 5*3600*1000;
                
                    setInterval(function () {
                        if(t1>0){
                        t1-=1000;
                       // alert(t1);
                       var str = '<span class="spxq_qgTimezt spxq_qgTimejx">&nbsp;</span>';
                        var d1 = Math.floor(t1 / 1000 / 60 / 60 / 24);
                        var h1 = Math.floor(t1 / 1000 / 60 / 60 % 24);
                        var m1 = Math.floor(t1 / 1000 / 60 % 60);
                        var s1 = Math.floor(t1 / 1000 % 60);
                        //alert(d1);
                        //if (d1 > 30 || t1 < 11) {
                           // $('#s1').hide();
                       // }

                        if (d1 < 10) {
                            str+='<span>0'+d1+'</span>天';

                        } else {
                           str+='<span>'+d1+'</span>天';
                        }
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
                            str+='<span>0'+s1+'</span>秒';

                        } else {
                           str+='<span>'+s1+'</span>秒';
                        }
                    }
                        $("#s1").html(str);
                    }, 1000);
            </script>
            <span class="radius3 spxq_qgTime" style="margin-left:0;" id="s1"></span>
        </div>
        <!--<div class="right"><a  title="更多抢购" target="_blank" href="<?php echo U('tuan/index');?>">更多&gt;&gt;</a></div>-->
    </div>
    <div class="sy_buy_nr">
    	<div class="sy_buy_flexslider">
        	<ul class="slides">
                    <?php  $cache = cache(array('type'=>'File','expire'=> 600)); $token = md5("Tuan,audit = 1 AND closed=0 AND city_id=$city_id and bg_date <= '{$now}' AND end_date >= '{$now}',600,orderby asc,sold_num desc,0,25,,"); if(!$items= $cache->get($token)){ $items = D("Tuan")->where("audit = 1 AND closed=0 AND city_id=$city_id and bg_date <= '{$now}' AND end_date >= '{$now}'")->order("orderby asc,sold_num desc")->limit("0,25")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; if($index%5 == 1): ?><li class="list">
                                <ul class="sy_buy_list_box">  
                                    <li class="sy_buy_list">
                                        <div class="syPub_list">
                                            <div class="img"><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="224" height="160" /></a></div>
                                            <h3><a target="_blank" title="" href="#" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                                            <div class="btn_box">
                                                <div class="left price"><small>¥</small><?php echo round($item['tuan_price']/100,2);?><del>¥<?php echo round($item['price']/100,2);?></del></div>
                                                <div class="right"><p class="graycl">已售<?php echo ($item["sold_num"]); ?></p></div>
                                            </div>
                                            <a href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>" class="long_btn">进店抢购</a>
                                        </div>
                                    </li>
                        <?php elseif($index%5 == 0): ?>
                                    <li class="sy_buy_list">
                                        <div class="syPub_list">
                                            <div class="img"><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="224" height="160" /></a></div>
                                            <h3><a target="_blank" title="" href="#" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                                            <div class="btn_box">
                                                <div class="left price"><small>¥</small><?php echo round($item['tuan_price']/100,2);?><del>¥<?php echo round($item['price']/100,2);?></del></div>
                                                <div class="right"><p class="graycl">已售<?php echo ($item["sold_num"]); ?></p></div>
                                            </div>
                                            <a href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>" class="long_btn">进店抢购</a>
                                        </div>
                                    </li>
                            </ul>
                            <div class="clear"></div>
                        </li>
                        <?php else: ?>
                            <li class="sy_buy_list">
                                <div class="syPub_list">
                                    <div class="img"><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="224" height="160" /></a></div>
                                    <h3><a target="_blank" title="" href="#" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                                    <div class="btn_box">
                                        <div class="left price"><small>¥</small><?php echo round($item['tuan_price']/100,2);?><del>¥<?php echo round($item['price']/100,2);?></del></div>
                                        <div class="right"><p class="graycl">已售<?php echo ($item["sold_num"]); ?></p></div>
                                    </div>
                                    <a href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>" class="long_btn">进店抢购</a>
                                </div>
                            </li><?php endif; ?> <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!--首页抢购部分结束-->


    <!--首页本地商城部分开始-->
    <div class="sy_FloorBt" data="top_2" id="floor2">
        <div class="left sy_FloorBtz"><i class="ico_2"></i><span class="bt cl_3">本地商城</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('mall/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_cityBuy_nr ">
		<div class="left sy_cityBuy_ad">
			<?php  $cache = cache(array('type'=>'File','expire'=> 7200)); $token = md5("Ad, closed=0 AND site_id=46 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,1,7200,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=46 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,1")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><a target="_blank" href="<?php echo ($item["link_url"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="260" height="499" /></a> <?php endforeach; ?>
		</div>
        <div class="left sy_cityBuy_list_box">
            <ul>
            	<?php  $cache = cache(array('type'=>'File','expire'=> 600)); $token = md5("Goods,audit =1 AND type='goods' AND closed=0 AND city_id = $city_id AND end_date >= '{$today}',orderby asc,sold_num desc,0,8,600,,"); if(!$items= $cache->get($token)){ $items = D("Goods")->where("audit =1 AND type='goods' AND closed=0 AND city_id = $city_id AND end_date >= '{$today}'")->order("orderby asc,sold_num desc")->limit("0,8")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_cityBuy_list">
                        <a target="_blank" title="<?php echo ($item['title']); ?>" href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>">
                        <img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="214" height="175" />
                        <p class="price fontcl1">¥<?php echo round($item['mall_price']/100,2);?> <small class="graycl">¥<?php echo round($item['price']/100,2);?></small></p>
                        <P class="bt overflow_clear"><?php echo msubstr($item['title'],0,15);?></P>
                        </a>
                    </li> <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <!--首页本地商城部分结束-->
    
    <!--首页外卖部分开始-->
    <div class="sy_FloorBt" data="top_3" id="floor3">
        <div class="left sy_FloorBtz"><i class="ico_3"></i><span class="bt cl_2">外卖</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('ele/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_waimai_nr">
    	<div class="sy_waimai_one">
        	<div class="left sy_waimai_cate">
            	<div class="sy_waimai_cate_list">
                    <a target="_blank" href="<?php echo LinkTo('ele/index',$linkArr,array('cate'=>0));?>" class="list">全部</a>
                    <?php if(is_array($elecate)): $index = 0; $__LIST__ = $elecate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($index % 2 );++$index; $i = $index + 1; ?>
                            <a href="<?php echo U('ele/index',array('cate'=>$index));?>" class="list"><?php echo ($item); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                    <?php  $cache = cache(array('type'=>'File','expire'=> 14400)); $token = md5("Ad, closed=0 AND site_id=47 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,1,14400,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=47 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,1")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><div class="sy_waimai_ad"><a target="_blank" href="<?php echo ($item["link_url"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="180" height="180" /></a></div> <?php endforeach; ?>
            </div>
            <div class="left sy_waimai_lunbo">
            	<div class="sy_waimai_flexslider">
                    <ul class="slides">
                        <?php  $cache = cache(array('type'=>'File','expire'=> 43200)); $token = md5("Ad, closed=0 AND site_id=48 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,3,43200,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=48 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,3")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="list"><a target="_blank" href="<?php echo ($item["link_url"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="459" height="338" /></a></li> <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="right sy_waimai_listOne">
                <ul>
                	<?php  $cache = cache(array('type'=>'File','expire'=> 600)); $token = md5("Ele,audit = 1 AND city_id=$city_id ,1,orderby asc,sold_num desc,0,2,600,"); if(!$items= $cache->get($token)){ $items = D("Ele")->where("audit = 1 AND city_id=$city_id ")->order("orderby asc,sold_num desc")->limit("0,2")->select(); $items = D("Ele")->CallDataForMat($items); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="list">
                    	<div class="nr">
                        	<p class="bt overflow_clear"><a href="#"><?php echo ($item["shop_name"]); ?></a></p>
                            <p>评价：<span class="fontcl1"><?php echo round($item['shop']['score']/10,1);?>分</span>
                                <span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo ($item["shop"]["score"]); ?>"></span></span>
                            </p>
                            <p><span class="mr10">起送：￥<?php echo round($item['since_money']/100,2);?></span>  配送费：￥<?php echo round($item['logistics']/100,2);?></p>
                            <p class="blackcl6"><span class="mr10"><?php echo ($item["distribution"]); ?>分钟</span> <span class="right">月售：<?php echo ($item["month_num"]); ?>单</span></p>
                        </div>
                        <div class="tag_box"><?php if(($item["is_pay"]) == "1"): ?><i class="ico_2"></i><?php endif; ?>
                                    <?php if(($item["is_new"]) == "1"): ?><i class="ico_3"></i><?php endif; ?>
                                    <?php if(($item["is_fan"]) == "1"): ?><i class="ico_4"></i><?php endif; ?></div>
                        <div class="img"><a title="<?php echo ($item["shop_name"]); ?>家外卖" target="_blank" href="<?php echo U('ele/shop',array('shop_id'=>$item['shop_id']));?>"><img alt="<?php echo ($item["shop_name"]); ?>家外卖" src="__ROOT__/attachs/<?php echo ($item["shop"]["photo"]); ?>" width="238" height="180" /></a></div>
                    </li> <?php endforeach; ?> 
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sy_waimai_list_box">
        	<ul>
            	<?php  $cache = cache(array('type'=>'File','expire'=> 3600)); $token = md5("Ele,audit = 1 AND city_id=$city_id ,1,orderby asc,sold_num desc,2,7,3600,"); if(!$items= $cache->get($token)){ $items = D("Ele")->where("audit = 1 AND city_id=$city_id ")->order("orderby asc,sold_num desc")->limit("2,7")->select(); $items = D("Ele")->CallDataForMat($items); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_waimai_list">
                        <div class="img"><a title="<?php echo ($item["shop_name"]); ?>" target="_blank" href="<?php echo U('ele/shop',array('shop_id'=>$item['shop_id']));?>"><div class="tag_box"><?php if(($item["is_pay"]) == "1"): ?><i class="bg_2">付</i><?php endif; ?>
                                    <?php if(($item["is_new"]) == "1"): ?><i class="bg_3">首</i><?php endif; ?>
                                    <?php if(($item["is_fan"]) == "1"): ?><i class="bg_4">减</i><?php endif; ?></div><img alt="<?php echo ($item["shop_name"]); ?>家外卖" src="__ROOT__/attachs/<?php echo ($item["shop"]["photo"]); ?>" width="238" height="180" /><p class="overflow_clear"><?php echo ($item["shop_name"]); ?></p></a></div>
                        <div class="nr">
                            <p>评价：<span class="fontcl1"><?php echo round($item['shop']['score']/10,1);?>分</span>
                                <span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo ($item["shop"]["score"]); ?>"></span></span>
                            </p>
                            <p><span class="mr10">起送：￥<?php echo round($item['since_money']/100,2);?></span>  配送费：￥<?php echo round($item['logistics']/100,2);?></p>
                            <p class="blackcl6"><span class="mr10"><?php echo ($item["distribution"]); ?>分钟</span> <span class="right">月售：<?php echo ($item["month_num"]); ?>单</span></p>
                        </div>
                    </li> <?php endforeach; ?> 
    	    </ul>
            <div class="clear"></div>
        </div>
    </div>
    <!--首页外卖部分结束-->

    <!--首页优惠券部分开始-->
    <div class="sy_FloorBt" data="top_4" id="floor4">
        <div class="left sy_FloorBtz"><i class="ico_4"></i><span class="bt cl_8">优惠券</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('coupon/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_coupon_nr">
    	<ul class="sy_buy_list_box">
        	<?php  $cache = cache(array('type'=>'File','expire'=> 600)); $token = md5("Coupon,600,audit=1 AND closed=0 AND city_id=$city_id AND expire_date >= '{$today}',downloads desc,views desc,0,5,,"); if(!$items= $cache->get($token)){ $items = D("Coupon")->where("audit=1 AND closed=0 AND city_id=$city_id AND expire_date >= '{$today}'")->order("downloads desc,views desc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_buy_list">
                    <div class="syPub_list">
                        <div class="img"><a target="_blank" title='<?php echo ($item["title"]); ?>' href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="224" height="160" /></a></div>
                        <h3><a target="_blank" title='<?php echo ($item["title"]); ?>' href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                        <p class="graycl">下载：<?php echo ($item["downloads"]); ?>次&nbsp;&nbsp;剩余：<?php echo ($item["num"]); ?>次</p>
                        <a target="_blank" title='<?php echo ($item["title"]); ?>' href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>" class="long_btn mt10">立即下载</a>
                    </div>
                </li> <?php endforeach; ?>
        </ul>
        <div class="clear"></div>
    </div>
    <!--首页优惠券部分结束-->
    <!--首页订座部分开始-->
    <div class="sy_FloorBt" data="top_5" id="floor5">
        <div class="left sy_FloorBtz"><i class="ico_5"></i><span class="bt cl_5">订座</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('ding/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_seat_nr">
        <div class="left sy_seat_list">
            <ul class="sy_buy_list_box">
            	<?php  $cache = cache(array('type'=>'File','expire'=> 3600)); $token = md5("Shopding,3600,is_open=1 AND audit=1 AND closed=0 AND  city_id=$city_id,0,4,orders desc,score desc,,"); if(!$items= $cache->get($token)){ $items = D("Shopding")->where("is_open=1 AND audit=1 AND closed=0 AND  city_id=$city_id")->order("orders desc,score desc")->limit("0,4")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_buy_list">
                        <div class="syPub_list">
                            <div class="img"><a target="_blank" href="<?php echo U('ding/detail',array('shop_id'=>$item['shop_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="224" height="160" /></a></div>
                            <h3><a target="_blank" href="<?php echo U('ding/detail',array('shop_id'=>$item['shop_id']));?>" class="overflow_clear"><?php echo ($item["shop_name"]); ?></a></h3>
                            <p class="graycl">口味：<?php echo ($item['kw_score']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;环境<?php echo ($item['hj_score']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务<?php echo ($item['fw_score']); ?></p>
                            <a target="_blank" href="<?php echo U('ding/detail',array('shop_id'=>$item['shop_id']));?>" class="long_btn mt10">立即预订</a>
                        </div>
                    </li> <?php endforeach; ?>
            </ul>
        </div>
        <div class="right sy_seatSwitch">
            <ul class="sy_seatSwitch_tab">
                <li class="on">帮您找座位</li>
                <li>人气排行榜</li>
            </ul>
            <div class="sy_seatSwitch_box">
                <div class="sy_seatSwitch1" style="display:block;">
                    <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
                    <form action="<?php echo U('ding/lists');?>" method="post">
                        <div class="num_box">
                            <input class="name" type="text"   name="date" value="<?php echo TODAY; ?>" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'});"  placeholder="日期" />
                            <select name="time" class="num">
                                <?php $cfg = D('Shopdingsetting')->getCfg(); ?>
                                <?php if(is_array($cfg)): $i = 0; $__LIST__ = $cfg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>

                            <div class="clear"></div>
                        </div>
                        <select name="area_id" class="addr">
                            <?php if(is_array($areas)): $i = 0; $__LIST__ = $areas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($item["city_id"]) == $city_id): ?><option value="<?php echo ($item["area_id"]); ?>"><?php echo ($item["area_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <div class="num_box">
                            <?php $room=D('Shopdingroom')->getType(); ?>
                            <select name="number" class="num">
                                <?php if(is_array($room)): $i = 0; $__LIST__ = $room;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <input class="name" name="name" type="text" placeholder="商户名" />
                            <div class="clear"></div>
                        </div>
                        <input class="btn" type="submit" value="免费帮您订座" />
                    </form>
                </div>
                <div class="sy_seatSwitch1">
                    <ul class="hotBill">
                        <?php  $cache = cache(array('type'=>'File','expire'=> 1600)); $token = md5("Shopding,1600,is_open=1 AND audit=1 AND closed=0 AND  city_id=$city_id,0,3,score desc,orders desc,,"); if(!$items= $cache->get($token)){ $items = D("Shopding")->where("is_open=1 AND audit=1 AND closed=0 AND  city_id=$city_id")->order("score desc,orders desc")->limit("0,3")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li>
                                <a href="<?php echo U('ding/detail',array('shop_id'=>$item['shop_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="60" height="40" /></a>
                                <h3 class="overflow_clear"><a href="<?php echo U('ding/detail',array('shop_id'=>$item['shop_id']));?>"><?php echo ($item["shop_name"]); ?></a></h3>
                                <p><span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo ($item['score']*10); ?>"></span></span></p>
                            </li> <?php endforeach; ?>   
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!--首页订座部分结束-->
    <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Ad, closed=0 AND site_id=2 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,1,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=2 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,1")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><div class="sy_adPosit"><a href="<?php echo ($item["link_url"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="1200" height="100"/></a></div> <?php endforeach; ?>
    <!--首页同城信息部分开始-->
    <div class="sy_FloorBt" data="top_6" id="floor6">
        <div class="left sy_FloorBtz"><i class="ico_6"></i><span class="bt cl_4">同城信息</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('life/main');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="cityInfor_nr">
        <ul class="cityInfor_list" style="display:block;">
            <li class="nr">
                <h3>二手</h3>
                <div class="link">
                    <div class="left img ico_1"></div>
                    <ul>
                        <li><a  href="<?php echo U('life/index',array('cat'=>1));?>">手机及配件</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>2));?>">数码产品</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>4));?>">家用电器</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>5));?>">日常用品</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>车辆</h3>
                <div class="link">
                    <div class="left img ico_2"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>21));?>">二手轿车</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>24));?>">电动车</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>25));?>">自行车</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>27));?>">摩托车/燃气车</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>房屋</h3>
                <div class="link">
                    <div class="left img ico_3"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>47));?>">租房/出租</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>48));?>">个人租房</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>49));?>">二手房出售</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>52));?>">求租/求购</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>招聘</h3>
                <div class="link">
                    <div class="left img ico_4"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>67));?>">工人/技工</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>68));?>">销售/金融</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>71));?>">人事/行政/文员</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>72));?>">营业员/促销/零售</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>服务</h3>
                <div class="link">
                    <div class="left img ico_5"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>90));?>">招商加盟</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>95));?>">房屋装修</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>94));?>">公司注册</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>108));?>">搬家服务</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>培训</h3>
                <div class="link">
                    <div class="left img ico_6"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>58));?>">中小学教育</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>59));?>">职业技能</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>60));?>">学历教育</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>61));?>">电脑培训</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>求职</h3>
                <div class="link">
                    <div class="left img ico_7"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>38));?>">全职求职意向</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>39));?>">兼职求职意向</a></li>

                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
            <li class="nr">
                <h3>兼职</h3>
                <div class="link">
                    <div class="left img ico_8"></div>
                    <ul>
                        <li><a href="<?php echo U('life/index',array('cat'=>131));?>">家教/老师</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>132));?>">派发/促销</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>134));?>">学生兼职</a></li>
                        <li><a href="<?php echo U('life/index',array('cat'=>135));?>">餐厅/服务员</a></li>
                    </ul>
                </div>
                <a href="<?php echo U('life/main');?>" class="more">more</a>
            </li>
        </ul>

    </div>
    <!--首页同城信息部分结束-->
    
    <!--首页活动部分开始-->
    <div class="sy_FloorBt" data="top_7" id="floor7">
        <div class="left sy_FloorBtz"><i class="ico_7"></i><span class="bt cl_7">活动</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('huodong/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_active_nr">
    	<ul class="sy_active_list_box">
            <?php  $cache = cache(array('type'=>'File','expire'=> 600)); $token = md5("Activity,audit=1 AND closed=0 AND city_id=$city_id and bg_date <= '{$today}' AND end_date >= '{$today}',activity_id desc,0,4,600,,"); if(!$items= $cache->get($token)){ $items = D("Activity")->where("audit=1 AND closed=0 AND city_id=$city_id and bg_date <= '{$today}' AND end_date >= '{$today}'")->order("activity_id desc")->limit("0,4")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_active_list">
                    <div class="syPub_list">
                        <a target="_blank" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="300" height="180" /></a>
                        <h3 class="mt10"><a target="_blank" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                        <div class="btn_box">
                            <div class="left"><p class="graycl">有效期：至<?php echo ($item["end_date"]); ?> </p></div>
                            <div class="right"><a target="_blank" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>" class="btn">立即参加</a></div>
                        </div>
                    </div>
                </li> <?php endforeach; ?>
        </ul>
        <div class="clear"></div>
    </div>
    <!--首页活动部分结束-->

    <!--首页上门服务部分开始-->
    <div class="sy_FloorBt" data="top_8" id="floor8">
        <div class="left sy_FloorBtz"><i class="ico_8"></i><span class="bt cl_6">上门服务</span></div>
        <div class="right"><a target="_blank" href="<?php echo U('lifeservice/index');?>">更多&gt;&gt;</a></div>
    </div>
    <div class="sy_doorSer_list">
        <ul>
            <?php $a =1; ?>
            <?php if(is_array($list)): foreach($list as $key=>$item): if($a <= 8): ?><li>
                        <a href="<?php echo U('lifeservice/detail',array('id'=>$a));?>">
                            <i class="ico_<?php echo ($a); ?>"></i>
                            <h3><?php echo ($item["t"]); ?></h3>
                            <p><?php if(empty($item['title'])): ?>暂无简介<?php else: echo bao_msubstr($item['title'],0,16,true); endif; ?></p>
                        </a>
                    </li><?php endif; ?>
                <?php $a++; endforeach; endif; ?>
        </ul>
    </div>
    <!--首页上门服务部分结束-->
</div>

<div style="margin-bottom:-20px; margin-top:40px;"><a href="<?php echo U('download/index');?>"><img src="__TMPL__statics/images/images/ad.png" width="100%" /></a></div>

<div class="indexpop" id="fox-food">
    <ul>
        <li class="ico_1"><a href="#floor1"><div class="wz">抢购</div></a></li>
        <li class="ico_2"><a href="#floor2"><div class="wz">商城</div></a></li>
        <li class="ico_3"><a href="#floor3"><div class="wz">外卖</div></a></li>
        <li class="ico_4"><a href="#floor4"><div class="wz">优惠</div></a></li>
        <li class="ico_5"><a href="#floor5"><div class="wz">订座</div></a></li>
        <li class="ico_6"><a href="#floor6"><div class="wz">信息</div></a></li>
        <li class="ico_7"><a href="#floor7"><div class="wz">活动</div></a></li>
        <li class="ico_8"><a href="#floor8"><div class="wz">上门</div></a></li>
    </ul>
</div>
<script>
    $(function () {
        $("#fox-food li").each(function (e) {
            $(this).click(function (event) {
                $(".radius3").each(function (i) {
                    if (e == i)
                    {
                        $("html,body").animate({scrollTop: $(this).offset().top}, 500);
                        event.preventDefault();
                    }
                });
            });
        });
    });

    $(document).ready(function () {
        $(window).scroll(function () {
            var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
            var menu = $("#fox-food");                      //定义变量，抓取#menu
            var items = $("#index-gun").find(".sy_FloorBt");    //定义变量，查找.item

            var curId = "";                             //定义变量，当前所在的楼层item #id 

            items.each(function () {
                var m = $(this);                        //定义变量，获取当前类
                var itemsTop = m.offset().top;        //定义变量，获取当前类的top偏移量
                if (top > itemsTop - 300) {
                    curId = "#" + m.attr("id");
                } else {
                    return false;
                }
            });

            //给相应的楼层设置cur,取消其他楼层的cur
            var curLink = menu.find(".cur");
            if (curId && curLink.attr("href") != curId) {
                curLink.removeClass("cur");
                menu.find("[href=" + curId + "]").addClass("cur");
            }
            // console.log(top);
        });
        /*控制*/
        $(window).scroll(function () {
            if ($(window).scrollTop() < 220) {
                $(".indexpop").css("top", "220px");
                $(".indexpop").css("bottom", "auto");
            }
            else {
                $(".indexpop").css("top", "40px");
                $(".indexpop").css("bottom", "auto");
            }
        });


    });
</script>
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