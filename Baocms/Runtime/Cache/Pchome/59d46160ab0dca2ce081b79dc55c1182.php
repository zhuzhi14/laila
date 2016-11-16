<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo ($CONFIG['site']['headinfo']); ?>
        <title><?php if($config['title'])echo $config['title'];else echo $seo_title; ?></title>
        <meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
        <meta name="description" content="<?php echo ($seo_description); ?>" />
        <link href="__TMPL__statics/shopskin/green/css/style.css?v=20151022" rel="stylesheet" type="text/css">
            <script> var BAO_PUBLIC = '__PUBLIC__';
                var BAO_ROOT = '__ROOT__';</script>
            <script src="__TMPL__statics/js/jquery.js?v=20150718"></script>
            <script src="__PUBLIC__/js/layer/layer.js?v=20150718"></script>
            <script src="__TMPL__statics/js/jquery.flexslider-min.js?v=20150718"></script>
            <script src="__TMPL__statics/js/js.js?v=20150718"></script>
            <script src="__PUBLIC__/js/web.js?v=20150718"></script>
            <script src="__TMPL__statics/js/baocms.js?v=20150718"></script>
    </head>
	<script>
		$(document).ready(function () {
			$(window).scroll(function () {
				if ($(window).scrollTop() > 100) {
					$(".nav_fixed").show();
				} else {
					$(".nav_fixed").hide();
				}//出现与隐藏
				
				var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
				var menu = $(".nav_fixed");                      //定义变量，抓取#menu
				var items = $(".shangjiaC").find(".spxq_xqBt");    //定义变量，查找.item
	
				var curId = "";                             //定义变量，当前所在的楼层item #id 
	
				items.each(function () {
					var m = $(this);                        //定义变量，获取当前类
					var itemsTop = m.offset().top;        //定义变量，获取当前类的top偏移量
					if (top > itemsTop - 260) {
						curId = "#" + m.attr("id");
					} else {
						return false;
					}
				});
	
				//给相应的楼层设置on,取消其他楼层的on
				var curLink = menu.find(".on");
				if (curId && curLink.attr("href") != curId) {
					curLink.removeClass("on");
					menu.find("[href=" + curId + "]").addClass("on");
				}
				// console.log(top);
			});
		});
    </script>
    <body style="background:#fafafa;">
        <iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
        <!--header部分结束-->
        <script type="text/javascript" src="__TMPL__statics/js/jquery.qrcode.min.js"></script>
        <style>
            .sjxq_sjcpDwNr canvas{
                width: 115px;
                height: 115px;
                margin: 0px auto;
                background: #fff;
                padding: 10px;
            }
        </style>
        <!--浮动导航开始-->
        <div class="nav nav_fixed">
            <div class="navList">
                <ul>
                    <li class="navLi"><a href="#" class="navA on">首页</a></li>
                    <li class="navLi"><a href="#spxq_xqBt1" class="navA">商家位置</a></li>
                    <li class="navLi"><a href="#spxq_xqBt2" class="navA">商品抢购</a></li>
                    <li class="navLi"><a href="#spxq_xqBt3" class="navA">商家商品</a></li>
                    <li class="navLi"><a href="#spxq_xqBt4" class="navA">商家活动</a></li>
                    <li class="navLi"><a href="#spxq_xqBt5" class="navA">商家优惠</a></li>
                    <li class="navLi"><a href="#spxq_xqBt6" class="navA">商家详情</a></li>
                    <li class="navLi"><a href="#spxq_xqBt7" class="navA">网友评价</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <!--浮动导航结束-->
    <div class="topOne">
            <div class="nr">
                <div class="left">
                    <ul class="topOne_nav">
                        <li><a href="<?php echo U('pchome/index/index');?>"><i class="back"></i>回到首页</a></li>
                        <li><a href="<?php echo U('pchome/tuan/nearby');?>">身边抢购</a></li>
                        <li><a href="<?php echo U('pchome/huodong/index');?>">活动</a></li>
                        <li><a href="<?php echo U('pchome/lifeservice/index');?>">上门服务</a></li>
                        <li><a href="<?php echo U('pchome/mall/index');?>">同城优购</a></li>
                        <li><a href="<?php echo U('pchome/ele/index');?>">外卖</a></li>
                        <li><a href="<?php echo U('pchome/ding/index');?>">订座</a></li>
                        <li><a href="<?php echo U('pchome/life/main');?>">同城信息</a></li>
                        <li><a href="<?php echo U('pchome/coupon/index');?>">优惠券</a></li>
                    </ul>
                </div>
                <?php if(empty($MEMBER)): ?><div class="right sy_topLogin">您好，欢迎访问<?php echo ($CONFIG["site"]["sitename"]); ?><a href="<?php echo U('pchome/passport/login');?>" class="on">登陆</a>|<a href="<?php echo U('passport/register');?>">注册</a>
                        <?php else: ?>
                        <div class="right sy_topLogin">欢迎 <b style="color: red;font-size:14px;"><?php echo ($MEMBER["nickname"]); ?></b> 来到<?php echo ($CONFIG["site"]["sitename"]); ?>&nbsp;&nbsp; <a href="<?php echo U('member/index/index');?>" >个人中心</a>|<a href="<?php echo U('pchome/passport/logout');?>" >退出登录</a><?php endif; ?>
                            <div class="topSm"> <span class="topSmt"><em>&nbsp;</em></span>
                                <div class="topSmnr"><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["wxcode"]); ?>" width="90" height="90" />
                                    <p>扫描下载客户端</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!--商家详情头部1结束-->
            <div class="pagewd topTitle">
                <div class="left">
                    <h1><?php echo ($detail["shop_name"]); ?><i class="ico_5"></i></h1>
                </div>
                <div class="right">
                    <div class="share bdsharebuttonbox spxq_qgFx" data-tag="share_1"><a mini='act' href="<?php echo U('shop/favorites',array('shop_id'=>$detail['shop_id']));?>"><em>&nbsp;</em>收藏本店</a><a data-cmd="more" href="javascript:void(0);"><em>&nbsp;</em>分享到</a></div>
                    <script>window._bd_share_config = {share: [{"tag": "share_1", 'bdCustomStyle': '__TMPL__statics/empty.css'}]};
                with (document)
                    0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                    </script>
                </div>
                <div class="clear"></div>
            </div>
            <!--商家详情头部2结束-->
            <div class="nav">
                <div class="navList">
                    <ul>
                        <li class="navLi"><a href="<?php echo U('shop/detail',array('shop_id'=>$detail['shop_id']));?>" class="navA on">首页</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/detail',array('shop_id'=>$detail['shop_id']));?>#spxq_xqBt1" class="navA">商家位置</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/tuan',array('shop_id'=>$detail['shop_id']));?>" class="navA">商品抢购</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/goods',array('shop_id'=>$detail['shop_id']));?>" class="navA">商家商品</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/huodong',array('shop_id'=>$detail['shop_id']));?>" class="navA">商家活动</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/coupon',array('shop_id'=>$detail['shop_id']));?>" class="navA">商家优惠</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/detail',array('shop_id'=>$detail['shop_id']));?>#spxq_xqBt6" class="navA">商家详情</a></li>
                        <li class="navLi"><a href="<?php echo U('shop/detail',array('shop_id'=>$detail['shop_id']));?>#spxq_xqBt7" class="navA">网友评价</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <!--商家详情导航结束-->

            <!--商家详情内容部分开始-->
            <div class="mask_bg mask_spxq_pjLi_img_mask">
                <div class="mask_spxq_pjLi_img"><img src="" width="300" height="300" /></div>
            </div>
            <div class="content zy_content">    
                <div class="shangjiaC">
                    <div class="left shangjiaC_l">
                        <!--商家详情信息开始-->
                        <div class="spxq_qg">
                            <div class="left spxq_qg_l">
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.spxq_slider').flexslider({
                                            slideshow: true,
                                            controlNav: "thumbnails",
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
                                    <ul class="slides">
                                        <li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($detail["photo"]); ?>" width="460" height="280" /></li>
                                        <?php  $cache = cache(array('type'=>'File','expire'=> 10800)); $token = md5("Shoppic,shop_id= '{$detail['shop_id']}',0,3,10800,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Shoppic")->where("shop_id= '{$detail['shop_id']}'")->order("orderby asc")->limit("0,3")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_hotgzLi" data-thumb="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="460" height="280" /></li> <?php endforeach; ?>
                                    </ul>

                                </div>
                            </div>
                            <?php $tags = $detail['tags']; $tagsarray = array(); if(!empty($tags)){ $tagsarray = explode(',',$tags); } ?>
                            <style>.spxq_qgjgk{margin-top: 10px;}</style>
                            <div class="right spxq_qg_r">
                                <div class="spxq_qgjgk" style="margin-top:0px;">评价&nbsp;&nbsp;<span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo ($detail['score']); ?>"></span></span>&nbsp;&nbsp;<span class="graycl"><?php echo ($detail["score_num"]); ?>人评价</span></div>
                                <div class="spxq_qgjgk">地址&nbsp;&nbsp;<span class="blackcl6"><?php echo ($detail["addr"]); ?></span></div>
                                <div class="spxq_qgjgk">营业时间&nbsp;&nbsp;<span class="blackcl6"><?php echo ($ex["business_time"]); ?></span></div>
                                <div class="spxq_qgjgk">人均&nbsp;&nbsp;<span class="fontcl1">￥<?php echo ($ex["price"]); ?></span></div>
                                <div class="spxq_qgjgk">标签&nbsp;&nbsp;
                                    <?php if($tagsarray == null): ?><a href="javascript:void(0);">暂无标签</a> 
                                        <?php else: ?>
                                        <?php if(is_array($tagsarray)): $index = 0; $__LIST__ = $tagsarray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$var): $mod = ($index % 2 );++$index;?><a class="bq" href='<?php echo U("shop/index",array("keyword"=>$var));?>'><?php echo ($var); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </div>
                                <!--<div class="spxq_qgjgk">店铺简介&nbsp;&nbsp;
                                    <p class="nr">皮诺装饰是一家连锁经营公司，公司08年落户常州武进区，15年6月公司重装迁址常州新北区新惠大厦13楼。公司从事装饰装修行业多年，有着创新的设...<a href="#" class="more">更多</a></p>
                                </div> -->
                                <div class="hdsy_Licj" style="margin-top:20px;">
                                    <div class="left">
                                        <a class="hdsy_LicjA" href="<?php echo U('member/shop/dianping',array('shop_id'=>$detail['shop_id']));?>">去点评</a>
                                    </div>
                                    <div class="left hdsy_Licj_r">
                                        <?php if($detail["tel"] != null): ?>电话<span class="fontcl1"><?php echo ($detail["tel"]); else: ?><span class="fontcl1">手机<?php echo ($detail["mobile"]); ?></span><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--商家详情信息结束-->
                        <div class="spxq_xqBt" id="spxq_xqBt1">商家位置</div>
                        <div class="spxq_xqNr">
                            <div class="left spxq_xqMap_l">
                                <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7b92b3afff29988b6d4dbf9a00698ed8"></script>
                                <div id="allmap" style="width:384px; height:300px;"></div>
                                <script type="text/javascript">
                                    // 百度地图API功能
                                    var map = new BMap.Map("allmap");
                                    map.centerAndZoom(new BMap.Point("<?php echo ($detail["lng"]); ?>", "<?php echo ($detail["lat"]); ?>"), 15);
                                    var point = new BMap.Point("<?php echo ($detail["lng"]); ?>", "<?php echo ($detail["lat"]); ?>");
                                    map.centerAndZoom(point, 15);
                                    var marker = new BMap.Marker(point); // 创建标注
                                    map.clearOverlays();
                                    map.addOverlay(marker); // 将标注添加到地图中
                                    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                                    map.addControl(new BMap.NavigationControl()); //添加默认缩放平移控件
                                </script>
                            </div>
                            <div class="left spxq_xqMap_r" style="width:556px;">
                                <div class="sjxq_dp">
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
                                                        <td colspan="2"><p class="spxq_xqMapT"><?php echo ($detail["shop_name"]); ?>（<?php echo ($item["name"]); ?>）</p></td>
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
                                                        <td><a><?php echo ($item["telephone"]); ?></a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="spxq_xqMapListNr" style="display:none;" id="detail_<?php echo ($i); ?>">
                                                <table width="100%" class="spxq_table" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2"><p class="spxq_xqMapT"><?php echo ($detail["shop_name"]); ?>（<?php echo ($item["name"]); ?>）</p></td>
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
                                <div class='x' id='setpage'></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var totalpage, pagesize, cpage, count, curcount, outstr, total;
                            total = "<?php echo ($count); ?>";
                            cpage = 1;
                            totalpage = "<?php echo ($totalnum); ?>";
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
                        <div class="spxq_xqBt" id="spxq_xqBt2">商家抢购 <span class="right"><a href="<?php echo U('shop/tuan',array('shop_id'=>$detail['shop_id']));?>">更多>></a></span></div>
                        <div class="spxq_xqNr">
                            <div class="sj_buy_list_box">
                                <ul class="sj_buy_list">
                                    <?php if(is_array($tuan)): foreach($tuan as $key=>$item): ?><li>
                                            <div class="syPub_list">
                                                <a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="312" height="190" /></a>
                                                <h3><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                                                <p class="overflow_clear graycl"><?php echo ($item["intro"]); ?></p>
                                                <hr style="border:none 0px; border-bottom: 1px solid #e0e0e0; margin-top:6px;" />
                                                <div class="btn_box">
                                                    <div class="left"><p><span class="price">￥<?php echo round($item['tuan_price']/100,2);?></span><del>￥<?php echo round($item['price']/100,2);?></del></p></div>
                                                    <div class="right"><p class="">已售：<?php echo ($item["sold_num"]); ?></p><a target="_blank"  href="<?php echo U('tuan/detail',array('tuan_id'=>$item['tuan_id']));?>" class="btn">立即抢购</a></div>
                                                </div>
                                            </div>
                                        </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="spxq_xqBt" id="spxq_xqBt3">商家商品<span class="right"><a href="<?php echo U('shop/goods',array('shop_id'=>$detail['shop_id']));?>">更多>></a></span></div>
                        <div class="spxq_xqNr">
                            <div class="sj_buy_list_box">
                                <ul class="sj_buy_list">
                                    <?php if(is_array($goods)): foreach($goods as $key=>$item): ?><li>
                                        <div class="syPub_list">
                                            <div class="img"><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="312" height="190" /><p class="overflow_clear"><?php echo ($item["title"]); ?><span class="right">已售：<?php echo ($item["sold_num"]); ?></span></p></a></div>
                                            <p class="overflow_clear graycl"><?php echo ($item["intro"]); ?></p>
                                            <hr style="border:none 0px; border-bottom: 1px solid #e0e0e0; margin-top:6px;" />
                                            <div class="btn_box">
                                                <div class="left"><p class="graycl">商城价:<span class="price">￥<?php echo round($item['mall_price']/100,2);?></span>&nbsp;&nbsp;市场价:<del>￥<?php echo round($item['price']/100,2);?></del></p></div>
                                                <div class="right"><a target="_blank" href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id']));?>" class="btn">立即购买</a></div>
                                            </div>
                                        </div>
                                    </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="spxq_xqBt" id="spxq_xqBt4">商家活动<span class="right"><a href="<?php echo U('shop/huodong',array('shop_id'=>$detail['shop_id']));?>">更多>></a></span></div>
                        <div class="spxq_xqNr">
                            <div class="sj_buy_list_box">
                                <ul class="sj_buy_list">
                                    <?php if(is_array($huodong)): foreach($huodong as $key=>$item): ?><li>
                                        <div class="syPub_list">
                                            <a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="312" height="190" /></a>
                                            <h3><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>" class="overflow_clear"><?php echo ($item["title"]); ?></a></h3>
                                            <div class="btn_box">
                                                <div class="left"><p class="graycl">有效期：至<?php echo ($item["end_date"]); ?></p></div>
                                                <div class="right"><a target="_blank" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>" class="btn">立即参加</a></div>
                                            </div>
                                        </div>
                                    </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="spxq_xqBt" id="spxq_xqBt5">商家优惠<span class="right"><a href="<?php echo U('shop/coupon',array('shop_id'=>$detail['shop_id']));?>">更多>></a></span></div>
                        <div class="spxq_xqNr">
                            <ul class="sj_discount_list">
                                <?php if(is_array($coupon)): foreach($coupon as $key=>$item): ?><li>
                                    <div class="left">
                                        <a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>"  width="220" height="144" /></a>
                                        <h3><a target="_blank" title="<?php echo ($item["title"]); ?>" href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>"><?php echo ($item["title"]); ?></a></h3>
                                        <p>有效期<span class="blackcl6">截止到<?php echo ($item["expire_date"]); ?></span> <span class="fontcl1">（周末、法定节假日通用）</span></p>
                                        <div class="list">
                                            <div class="left"><p>浏览</p><?php echo ($item["views"]); ?>人</div>
                                            <div class="left"><p>剩余</p><?php echo ($item["num"]); ?>份</div>
                                            <div class="left"><p>下载</p><?php echo ($item["downloads"]); ?>次</div>
                                        </div>
                                    </div>
                                    <div class="right"><a target="_blank" href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>" class="btn">立即下载</a></div>
                                    <div class="clear"></div>
                                </li><?php endforeach; endif; ?>
                            </ul>
                        </div>
                        <div class="spxq_xqBt" id="spxq_xqBt6">商家详情</div>
                        <div class="spxq_xqNr">
                           <?php echo ($ex["details"]); ?> 
                        </div>
                        <div class="spxq_xqBt" id="spxq_xqBt7">网友评价</div>
                        <div class="spxq_xqNr">
                            <div class="sjxq_tab">
                                <ul>
                                    <li class="sjxq_tabLi on"><a href="javascript:void(0);">全部</a></li>
                                    <li class="sjxq_tabLi"><a href="javascript:void(0);">晒图评价</a></li>
                                </ul>      
                                <span style="float:right;margin-right: 20px;"><a href="<?php echo U('member/shop/dianping',array('shop_id'=>$detail['shop_id']));?>">我也要评价</a></span>
                            </div>
                            <div class="spxq_pjListBox">
                                <ul>
                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$var): $mod = ($i % 2 );++$i;?><li class="spxq_pjList">
                                            <div class="left spxq_pjList_l">
                                                <div class="spxq_pjTx"><img src="__ROOT__/attachs/<?php echo (($users[$var['user_id']]['face'])?($users[$var['user_id']]['face']):'default.jpg'); ?>" width="75" height="75" /></div>
                                                <p class="spxq_pjYh"><?php echo ($users[$var['user_id']]['nickname']); ?></p>
                                            </div>
                                            <div class="left spxq_pjList_r sjxq_pjList_r">
                                                <div><span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo round($var['score']*10,1);?>">&nbsp;</span></span><span class="spxq_pjTime"><?php echo (date('Y-m-d H:i',$var["create_time"])); ?></span>
                                                </div>
                                                <p class="spxq_pjP"><?php echo ($var["contents"]); ?></p>
                                                <?php if(!empty($var['reply'])): ?><p class="spxq_pjP"><?php echo ($var["reply"]); ?></p><?php endif; ?>
                                                <ul class="spxq_pjUl">

                                                    <?php if(is_array($pics)): foreach($pics as $key=>$pic): if(($pic["dianping_id"]) == $var["dianping_id"]): ?><li class="spxq_pjLi"><a href="javascript:void(0);" rel="__ROOT__/attachs/<?php echo ($pic["pic"]); ?>" ><img src="__ROOT__/attachs/<?php echo ($pic["pic"]); ?>" width="100" height="100" /></a></li><?php endif; endforeach; endif; ?>
                                                </ul>
                                            </div>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                                <div class="x"><?php echo ($page); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="right shangjiaC_r">
                        <div class="weixin_sm">
                            <?php if($ex['wei_pic'] == null): ?><img src="__ROOT__/attachs/<?php echo ($CONFIG["site"]["wxcode"]); ?>"  width="132" height="132"/><?php else: ?><img src="<?php echo ($ex['wei_pic']); ?>" width="132" height="132" /><?php endif; ?>
                            <p>扫描商家微信</p>
                            <p>轻松购享优惠</p>
                        </div>
                        <div class="sjsy_newsList">
                            <h3>新入驻商家</h3>
                            <ul class="sjsy_newsUl">
                                <?php  $cache = cache(array('type'=>'File','expire'=> 86400)); $token = md5("Shop, closed=0 AND audit=1,0,10,86400,shop_id desc,,"); if(!$items= $cache->get($token)){ $items = D("Shop")->where(" closed=0 AND audit=1")->order("shop_id desc")->limit("0,10")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li><a title="<?php echo ($item["shop_name"]); ?>" target="_blank" href="<?php echo U('shop/detail',array('shop_id'=>$item['shop_id']));?>"><?php echo bao_msubstr($item['shop_name'],0,10,false);?></a></li> <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sjsy_newsList">
                            <h3>活动&优惠</h3>
                            <div class="sjsy_hdyh">
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.sjsy_flexslider').flexslider({
                                            directionNav: true,
                                            pauseOnAction: false,
                                        });

                                    });//首页轮播js
                                </script>
                                <div class="sjsy_flexslider">
                                    <ul class="slides">
                                        <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Activity, closed=0 AND audit=1 AND bg_date <= '{$today}' AND end_date >= '{$today}',0,2,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Activity")->where(" closed=0 AND audit=1 AND bg_date <= '{$today}' AND end_date >= '{$today}'")->order("orderby asc")->limit("0,2")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_hotgzLi"><a target="_blank" href="<?php echo U('huodong/detail',array('activity_id'=>$item['activity_id']));?>" title="<?php echo ($item["title"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="212" height="158" /></a></li> <?php endforeach; ?>
                                        <?php  $cache = cache(array('type'=>'File','expire'=> 10800)); $token = md5("Coupon,closed=0 AND audit=1 AND expire_date >= '{$today}',0,2,10800,coupon_id desc,,"); if(!$items= $cache->get($token)){ $items = D("Coupon")->where("closed=0 AND audit=1 AND expire_date >= '{$today}'")->order("coupon_id desc")->limit("0,2")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_hotgzLi"><a target="_blank" href="<?php echo U('coupon/detail',array('coupon_id'=>$item['coupon_id']));?>" title="<?php echo ($item["title"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="212" height="158" /></a></li> <?php endforeach; ?> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--商家详情内容部分结束-->
            <div class="pagewd foot_security">
	<ul>
	    <li><i class="ico_1"></i>随时退</li>
        <li><i class="ico_2"></i>不满意免单</li>
        <li><i class="ico_3"></i>过期退款</li>
        <li><i class="ico_4"></i>7×24小时服务</li>
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