<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-store,no-cache"> 
        <meta name="Handheldfriendly" content="true">

        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        
        <title><?php if($mobile_title)echo $mobile_title;else echo $CONFIG['site']['sitename'] ?></title>
        <meta name="description" content="<?php echo ($mobile_description); ?>" />
        <link rel="stylesheet" href="__TMPL__statics/css/css_1.css?v=20160125"/>
        <link rel="stylesheet" href="__TMPL__statics/css/reset.css?v=20160125"/>
        <link rel="stylesheet" href="__TMPL__statics/css/style.css?v=20160125"/>
        <link rel="stylesheet" href="__TMPL__statics/css/wl_style.css?v=20160125"/>
        
        <script> var BAO_PUBLIC = '__PUBLIC__';
            var BAO_ROOT = '__ROOT__';</script>
        
        <script src = "__TMPL__statics/js/jquery-1.7.1.min.js?v=20160422" ></script>
        <script src="__TMPL__statics/js/baocms.js?v=20160422"></script> 
        <script src="__TMPL__statics/js/jscookie.js?v=20150822"></script>
        <script src="__TMPL__statics/js/jquery.event.drag-1.5.min.js?v=20160422"></script>
        <script src="__TMPL__statics/js/jquery.touchSlider.js?v=20160422"></script>

        <script src="__TMPL__statics/js/layer/layer.js?v=20160422"></script>
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
                #search-bar{top:0rem !important;}
                .serch-bar-mask{top:0.4rem !important; height: 100%; padding-bottom: 0;}
                #app_nav{top:0.4rem !important;}
                #loading{bottom: 0.1rem !important; height: 0.4rem !important;}
                #shangjia_tab{top: 0rem !important;}
                .app_page{top:0.3rem !important;}
                .shop_page{top:0.8rem !important;}
                #shangjia_detail{top:0.4rem !important;}
                .app_shangjia{top:0.4rem !important;}
                //.dw{top:369px !important;}
                .slides img{height: auto; width: 100%;}
            </style>
        <?php }?>
        
        <?php if($is_app&&!$is_android){?>
            <style>
                footer{ bottom: 0.15rem;}
                .lbs-tag .info-box{bottom: 0.12rem !important;}
                .yiyuan_buynum_mask .cont{bottom: 0.12rem !important;}
            </style>
        <?php }?>
        
        <?php if($is_app &&$ctl =='index'){ ?>
            <style>
                footer{ bottom: 0;}
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

<script>
    $(function () {
        var scrtime;
        $(".sy_hotNews #quotation").hover(function () {
            clearInterval(scrtime);

        }, function () {

            scrtime = setInterval(function () {
                var $ul = $(".sy_hotNews #quotation ul");
                var liHeight = $ul.find("li:last").height();
                $ul.animate({marginTop: liHeight + 29 + "px"}, 1000, function () {

                    $ul.find("li:last").prependTo($ul)
                    $ul.find("li:first").hide();
                    $ul.css({marginTop: 0});
                    $ul.find("li:first").fadeIn(1000);
                });
            }, 3000);

        }).trigger("mouseleave");
    });//首页最新消息部分结束
</script> 
<body style="background:#fafafa none; font-size:0.12rem;">  
    <?php if(!$is_app){?>
    <header>
        <i class="city"><a class="index qiehuan" href="<?php echo AppLink('city/index');?>"><?php echo bao_msubstr($city_name,0,2,false);?></a></i>
        <div class="title">
            <div class="box_search">
                <a href="<?php echo AppLink('index/search');?>"><i></i>输入商户名/搜索词</a>
            </div>
        </div>

        <i class="icon-menu" style="margin-right:0.30rem;"><a href="<?php echo AppLink('sign/signed');?>">签到</a></i>
        <a href="<?php echo AppLink('sign/signed');?>"> <i class="icon-menu" id="ico_7"></i></a>

    </header>
    <?php }?>
    <div id="index" class="page-center-box">
        <div>
            <!-- 广告开始-->
            <div class="ads">
                <script type="text/javascript">
                    $(document).ready(function () {


                        $(".main_image").touchSlider({
                            flexible: true,
                            speed: 200,
                            btn_prev: $("#btn_prev"),
                            btn_next: $("#btn_next"),
                            paging: $(".flicking_con a"),
                            counter: function (e) {
                                $(".flicking_con a").removeClass("on").eq(e.current - 1).addClass("on");
                            }
                        });

                        $(".main_image").bind("mousedown", function () {
                            $dragBln = false;
                        });

                        $(".main_image").bind("dragstart", function () {
                            $dragBln = true;
                        });

                        $(".main_image a").click(function () {
                            if ($dragBln) {
                                return false;
                            }
                        });

                        timer = setInterval(function () {
                            $("#btn_next").click();
                        }, 5000);

                        $(".ele_banner").hover(function () {
                            clearInterval(timer);
                        }, function () {
                            timer = setInterval(function () {
                                $("#btn_next").click();
                            }, 5000);
                        });

                        $(".main_image").bind("touchstart", function () {
                            clearInterval(timer);
                        }).bind("touchend", function () {
                            timer = setInterval(function () {
                                $("#btn_next").click();
                            }, 5000);
                        });

                    });
                </script>
                <div class="ele_banner">
                    <div class="flicking_con">
                        <?php  $cache = cache(array('type'=>'File','expire'=> 7200)); $token = md5("Ad, closed=0 AND site_id=39 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,5,7200,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=39 AND city_id IN ({$city_ids})  and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><a href="#"></a> <?php endforeach; ?> 
                    </div>
                    <div class="main_image">
                        <ul>
                            <?php  $cache = cache(array('type'=>'File','expire'=> 7200)); $token = md5("Ad, closed=0 AND site_id=39 AND city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,5,7200,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=39 AND city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li>
                                    <a href="<?php echo ($item["link_url"]); ?>" title="<?php echo ($item["title"]); ?>" class="favou-ig-1">
                                        <img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" alt="<?php echo ($item["title"]); ?>" />
                                    </a>
                                </li> <?php endforeach; ?> 
                        </ul>
                    </div>
                    <a href="javascript:;" id="btn_prev"></a>
                    <a href="javascript:;" id="btn_next"></a>
                </div>
            </div>
            <!--<div class="banner"><a href="#"><img src="__TMPL__statics/img/index_banner.png"></a></div>-->
            <!-- 广告结束-->
            <!-- 首页分类开始-->
            <div class="cate_shequ"><a href="<?php echo AppLink('community/index');?>"><em></em>我的社区服务</a></div>
            <script src="__TMPL__statics/js/jquery.flexslider-min.js" type="text/javascript" charset="utf-8"></script>
            <script>
                    $(document).ready(function () {
                        $('.flexslider_cate').flexslider({
                            directionNav: true,
                            pauseOnAction: false,
                            /*slideshow: false,*/
                            /*touch:true,*/
                        });
                        /*首页菜单分类结束*/
						$('.flexslider').flexslider({
                            directionNav: true,
                            pauseOnAction: false,
                            /*slideshow: false,*/
                            /*touch:true,*/
                        });
                        /*广告轮播end*/
                    });
            </script>
            <div class="banner">
                <div class="flexslider_cate"> 
                    <ul class="slides">

                        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i; if($i%10 == 1): ?><li class="list">
                                    <ul class="cate">
                                        <li>
                                            <a href="<?php echo ($n['url']); ?>"><img src="__ROOT__/attachs/<?php echo ($n["photo"]); ?>">
                                                <p><?php echo ($n["title"]); ?></p></a>
                                        </li>
                                        <?php elseif($i%10 == 0): ?>        

                                        <li>
                                            <a href="<?php echo ($n['url']); ?>"><img src="__ROOT__/attachs/<?php echo ($n["photo"]); ?>">
                                                <p><?php echo ($n["title"]); ?></p></a>
                                        </li>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a href="<?php echo ($n['url']); ?>"><img src="__ROOT__/attachs/<?php echo ($n["photo"]); ?>">
                                        <p><?php echo ($n["title"]); ?></p></a>
                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>


                    </ul>  
                </div>
            </div>            
            <!--首页分类结束-->
            <!--快报消息-->
            <!--<div class="fastNews mb10">
            	<div class="fl"><span class="border_r pad_r10 mr10"><em class="ico ico_1"></em></span><em class="ico ico_2"></em></div>
            	<div class="list_box">
                  <ul>
                        <li>
                            <a href="#" class="stress">赖先生 订购：6张B1套餐 规格：398元/张</a>
                        </li>
                        <li>
                            <a href="#" class="stress">刘小姐 订购：5张A1套餐 规格：388元/张</a>
                        </li>
                        <li>
                            <a href="#" class="stress">王先生 订购：6张B1套餐 规格：398元/张</a>
                        </li>
                        <li>
                            <a href="#" class="stress">贾先生 订购：6张B1套餐 规格：398元/张</a>
                        </li>
                  </ul>
                </div>
            </div>-->
            <script>
			$(function(){
				var scrtime;
				$(".fastNews .list_box").hover(function(){
					clearInterval(scrtime);
				
				},function(){
				
				scrtime = setInterval(function(){
					var $ul = $(".fastNews .list_box ul");
					var liHeight = $ul.find("li:last").height();
					$ul.animate({marginTop : liHeight + 29 + "px"},1000,function(){
					
					$ul.find("li:last").prependTo($ul)
					$ul.find("li:first").hide();
					$ul.css({marginTop:0});
					$ul.find("li:first").fadeIn(1000);
					});
				},4000);
				
				}).trigger("mouseleave");
			});
			</script>
            <!--快报消息end-->
            <!--首页限时抢购开始-->
            <div class="sy_title"><span class="left">限时抢购</span><div class="sy_limit_buy_time left"><em class="ico"></em>还剩<span class="time" remaintime="1442800030"></span></div><a href="<?php echo AppLink('tuan/index');?>" class="fr fontcl2 more">限时限量&gt;&gt;</a></div>
            <script>
                            $(function(){
                                    var dateTime = new Date();
                                    var difference = dateTime.getTime() - 1442200030*1000;	
                                    setInterval(function(){
                                      $("[remaintime]").each(function(){
                                            var obj = $(this);
                                            var endTime = new Date(parseInt(obj.attr('remaintime')) * 1000);
                                            var nowTime = new Date();
                                            var nMS=endTime.getTime() - nowTime.getTime() + difference;
                                            var myD=Math.floor(nMS/(1000 * 60 * 60 * 24));
                                            var myH=Math.floor(nMS/(1000*60*60)) % 24;
                                            var myM=Math.floor(nMS/(1000*60)) % 60;
                                            var myS=Math.floor(nMS/1000) % 60;
                                            var myMS=Math.floor(nMS/100) % 10;
                                            if(myD>= 0){
                                                    var str = "<span>" + myH + "</span>" + ":" + "<span>" + myM + "</span>" + ":" + "<span>" + myS + "</span>";
                                            }else{
                                                    var str = "真遗憾您来晚了，抢购已经结束。";	
                                            }
                                            obj.html(str);
                                      });
                                    }, 100);
                            });
                    </script>
            <div class="sy_limit_buy mb10">
            	<div class="locatLabel_switch swiper-container5">
                    <div class="swiper-wrapper">
                        <?php  $cache = cache(array('type'=>'File','expire'=> 7200)); $token = md5("Tuan,closed=0 AND bg_date <= '{$now}' AND end_date >= '{$now}' ,0,10,7200,tuan_id desc,,"); if(!$items= $cache->get($token)){ $items = D("Tuan")->where("closed=0 AND bg_date <= '{$now}' AND end_date >= '{$now}' ")->order("tuan_id desc")->limit("0,10")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><div class="box swiper-slide">
                            <a href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="" height="">
                            <p class="txt_center overflow_clear"><?php echo ($item["title"]); ?></p>
                            <p class="txt_center fontcl1">¥<?php echo ($item['tuan_price']/100); ?><small class="ml10"><del class="black9">￥<?php echo ($item['price']/100); ?></del></small></p></a> 
                        </div> <?php endforeach; ?>
                    </div>
                </div>
                <script src="__TMPL__index/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script>
                    var swiper = new Swiper('.swiper-container5', {
                        pagination: '.swiper-pagination5',
                        slidesPerView: 3.5,
                        paginationClickable: true,
                        spaceBetween: 10,
                        freeMode: true
                    });
                </script>
            </div>
            <!--首页限时抢购结束-->
            <!--特色频道start-->
            <div class="sy_title"><span class="left">特色频道</span></div>
            <div class="sy_tese mb10">
            	<ul>
                    <li class="list listOne">
                        <a href="<?php echo U('mobile/farm/index');?>">
                        <div class="box">
                            <h3 class="colr_1"><em class="ico"></em>农家乐</h3>
                            <p>吃喝玩乐要啥有啥</p>
                            <img src="__TMPL__statics/img/index/teseImg1.png">
                        </div>
                        </a>
                    </li>
                    <li class="list listThree">
                        <a href="<?php echo U('mobile/ding/index');?>">
                        <div class="box">
                        	<img src="__TMPL__statics/img/index/teseImg3.png">
                            <div class="pub_wz">
                                <h3 class="colr_3"><em class="ico"></em>订饭店</h3>
                                <p>不排队，提前订座</p>
                            </div>
                        </div>
                        </a>
                    </li>
                    <li class="list listThree">
                        <a href="<?php echo U('mobile/hotel/index');?>">
                        <div class="box">
                        	<img src="__TMPL__statics/img/index/teseImg4.png">
                            <div class="pub_wz">
                                <h3 class="colr_4"><em class="ico"></em>订酒店</h3>
                                <p>精选同城优质房源</p>
                            </div>
                        </div>
                        </a>
                    </li>
                    <li class="list listTwo">
                        <a href="<?php echo U('mobile/mall/crowdList');?>">
                        <div class="box">
                        	<h3 class="colr_2"><em class="ico"></em>商品众筹</h3>
                            <p>众筹的方式实现心愿</p>
                            <img src="__TMPL__statics/img/index/teseImg2.png">
                        </div>
                        </a>
                    </li>
                    <li class="list listThree">
                        <a href="<?php echo U('mobile/cloud/index');?>">
                        <div class="box">
                        	<img src="__TMPL__statics/img/index/teseImg5.png">
                            <div class="pub_wz">
                                <h3 class="colr_5"><em class="ico"></em>一元云购</h3>
                                <p>爆款大牌随心购</p>
                            </div>
                        </div>
                        </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <!--特色频道end-->
            <!--广告轮播-->
            <div class="banner mb10">
                <div class="flexslider" style="max-height:1.06rem;">
                    <ul class="slides">
                        <?php  $cache = cache(array('type'=>'File','expire'=> 7200)); $token = md5("Ad,closed=0 AND site_id=37 AND city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,5,7200,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where("closed=0 AND site_id=37 AND city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,5")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li><a href="<?php echo ($item["link_url"]); ?>" title="<?php echo ($item["title"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" alt="<?php echo ($item["title"]); ?>" width="100%" draggable="false"></a></li> <?php endforeach; ?>
                    </ul>  
                </div>
            </div>
            <!--广告轮播end-->
            <!--热门商家-->
            <div class="sy_title"><span class="left">热门商家</span><a href="<?php echo AppLink('shop/index');?>" class="fr black9 more">更多商家&gt;&gt;</a></div>
            <div class="sy_hot_seller">
            	<div class="sy_limit_buy mb10">
                    <div class="locatLabel_switch swiper-container6">
                        <div class="swiper-wrapper">
                            <?php  $items = D("Shop")->where("closed=0 AND city_id=$city_id AND audit=1")->order("orderby asc,score_num desc")->limit("0,10")->select(); $index=0; foreach($items as $item): $index++; ?><div class="box swiper-slide">
                                <a href="<?php echo U('shop/detail',array('shop_id'=>$item['shop_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item['photo']); ?>" width="114" height="114">
                                <p class="txt_center overflow_clear"><?php echo ($item["shop_name"]); ?></p>
                                <p class="fontcl2"><?php echo ($item["fans_num"]); ?>人关注<small class="ml10 fr black9">已售<?php echo ($item["score"]); ?></small></p></a> 
                            </div> <?php endforeach; ?>
                        </div>
                    </div>
                    <script>
                        var swiper = new Swiper('.swiper-container6', {
                            pagination: '.swiper-pagination6',
                            slidesPerView: 2.5,
                            paginationClickable: true,
                            spaceBetween: 10,
                            freeMode: true
                        });
                    </script>
                </div>
            </div>
            <!--热门商家end-->
 
            <!--专享推荐-->
            <div class="sy_recmd mb10">
            	<div class="title"><span>专享推荐</span></div>
                <div class="sy_recmd_list_box">
                    <ul>
                        <?php  $items = D("Shop")->where("closed=0 AND city_id=$city_id AND audit=1")->order("score desc")->limit("0,10")->select(); $index=0; foreach($items as $item): $index++; ?><li class="sy_recmd_list">
                                <div class="box">
                                    <div class="pub_img"><a href="<?php echo U('shop/detail',array('shop_id'=>$item['shop_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="145" height="145"></a></div>
                                    <div class="pub_wz">
                                        <h3 class="overflow_clear"><a href="<?php echo U('shop/detail',array('shop_id'=>$item['shop_id']));?>"><?php echo ($item["shop_name"]); ?></a></h3>
                                        <P class="black9 overflow_clear"><?php echo ($item["tags"]); ?>&nbsp;</P>
                                        <div class="nr_box">
                                            <p class="fl fontcl2"><?php echo ($item["fans_num"]); ?>人关注</p>
                                            <p class="fr price fontcl2"><del class="black9">已售<?php echo ($item["score"]); ?></del></p>
                                        </div>
                                    </div>
                                </div>
                            </li> <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
            <!--专享推荐end-->

        </div>
    </div>
<div id="loading">
    <div class="bao_loading">正在加载中....</div>
</div>
<div class="blank">&nbsp;</div>
<?php if(!$is_app||($ctl =='index'&&$is_app)){?>
<footer>
    <div>
        <a href="<?php echo AppLink('mobile/index/index');?>"> 
            <div <?php if($ctl == 'index'): ?>class="icon i-1 on"<?php else: ?>class="icon i-1"<?php endif; ?> ></div>
            <p>首页</p>
        </a>
    </div>
    <div>
        <a href="<?php echo AppLink('mobile/tuan/index');?>"> 
        <div <?php if($ctl == 'tuan'): ?>class="icon i-2 on"<?php else: ?>class="icon i-2"<?php endif; ?> ></div>
        <p>抢购</p>
        </a>
    </div>
    <div>
        <a href="<?php echo AppLink('mobile/favorites/index');?>"> 
        <div <?php if($ctl == 'favorites'): ?>class="icon i-3 on"<?php else: ?>class="icon i-3"<?php endif; ?> ></div>
        <p>关注</p>
        </a>
    </div>
    <div>
        <a href="<?php echo AppLink('mcenter/index/index');?>">
        <div <?php if($ctl == 'mcenter/index'): ?>class="icon i-4 on"<?php else: ?>class="icon i-4"<?php endif; ?> ></div>
        <p>我的</p>
        </a>
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
		$(".foot_more").click(function () {
            $(this).find(".foot_more_pull").toggle();
        });
    });
</script>
<iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
<!--定义编辑器里的table属性开始-请勿删除！！！！-->
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
<!--定义编辑器里的table属性结束-请勿删除！！！！-->
</body>
</html>