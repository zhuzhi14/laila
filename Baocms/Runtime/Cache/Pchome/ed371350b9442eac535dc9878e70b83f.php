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
<script src="__TMPL__statics/js/baocms.js"></script>
<style>
    input[type="radio"],input[type="checkbox"]{border:0;position:absolute;left:-9999px;}
    .radio{float: left; margin:8px 10px 0 0; border: 1px #BDBDBD solid; width: 100px; height: 30px; line-height: 30px; text-align: center; cursor: pointer; background: #FFF;}
    .radio-disabled{border-color:#DDD; color:#CCC;}
    .radio-active{border-color: #2FBCAC; border-width: 2px; width: 98px; height: 28px; background: url(__TMPL__statics/images/seat/icon.png) no-repeat 80px -427px #FFF;}
    .checkbox{float: left; width: 20px; height: 20px; background-image:url(__TMPL__statics/images/seat/icon.png); background-repeat: no-repeat; background-position: -36px -43px; margin-right: 10px;}
    .checkbox-active{background-position: -36px -75px;}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.dcsy_flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false,
            /*slideshow: false,*/
            /*manualControlEvent:"hover",*/
        });
         $.reset_input();
    });//首页轮播js
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
            <li class="navLi"><a class="navA <?php if($ctl == ele and $act == index): ?>on<?php endif; ?> " href="<?php echo U('ele/index');?>">首页</a></li>
            <li class="navLi"><a class="navA <?php if($ctl == ele and $act == takeout): ?>on<?php endif; ?>" href="<?php echo U('ele/takeout');?>">身边外卖</a></li>
            <li class="navLi"><a class="navA " href="<?php echo U('ele/index',array('new'=>1));?>">今日新单</a></li>
            <li class="navLi"><a class="navA" href="<?php echo U('ele/index',array('hot'=>1));?>">热门疯抢</a></li>
        </ul>
    </div>
</div>
<div class="content zy_content">
    <div class="dcsy_top">
        <div class="dcsy_banner">
            <div class="dcsy_flexslider">
                <ul class="slides">
                    <?php  $cache = cache(array('type'=>'File','expire'=> 21600)); $token = md5("Ad, closed=0 AND site_id=14 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ,0,3,21600,orderby asc,,"); if(!$items= $cache->get($token)){ $items = D("Ad")->where(" closed=0 AND site_id=14 AND  city_id IN ({$city_ids}) and bg_date <= '{$today}' AND end_date >= '{$today}' ")->order("orderby asc")->limit("0,3")->select(); $cache->set($token,$items); } ; $index=0; foreach($items as $item): $index++; ?><li class="sy_hotgzLi"><a target="_blank" href="<?php echo ($item["link_url"]); ?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="1182" height="105" /></a></li> <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="dcsy_topList">
            <ul>
                <li class="dcsy_topLi <?php if($cate == 0): ?>on<?php endif; ?>"><a href="<?php echo LinkTo('ele/index',$linkArr,array('cate'=>0));?>"><span class="radius10 dcsy_topLiTu"></span>全部</a></li>
                <?php if(is_array($elecate)): $index = 0; $__LIST__ = $elecate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($index % 2 );++$index; $i = $index + 1; ?>
                    <li class="dcsy_topLi <?php if($cate == $index): ?>on<?php endif; ?>"><a href="<?php echo LinkTo('ele/index',$linkArr,array('cate'=>$index));?>"><span class="radius10 dcsy_topLiTu dcsy_topLiTu<?php echo ($i); ?>"></span><?php echo ($item); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="dcsy_sx">
        <div class="dcsy_sxC1">
            <span><label><input type="checkbox" <?php if(($fan) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('ele/index',$linkArr,array('fan'=>'1'));?>' data="<?php echo LinkTo('ele/index',$linkArr,array('fan'=>'0'));?>"  name="is_fan" /></label>下单立减</span>
            <span><label><input type="checkbox" <?php if(($new) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('ele/index',$linkArr,array('new'=>'1'));?>' data="<?php echo LinkTo('ele/index',$linkArr,array('new'=>'0'));?>"  name="is_new" /></label>新用户优惠</span>
            <span><label><input type="checkbox" <?php if(($pay) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('ele/index',$linkArr,array('pay'=>'1'));?>' data="<?php echo LinkTo('ele/index',$linkArr,array('pay'=>'0'));?>"  name="is_pay" /></label>在线支付</span>
        </div>
        <script>
            $(document).ready(function () {
                $(".dcsy_sxC1 input").click(function () {
                    if ($(this).prop('checked') == true) {
                        location.href = $(this).attr('rel');
                    } else {
                        location.href = $(this).attr('data');
                    }
                });
            });
        </script>
        <div class="dcsy_sxC2">
            <ul>
                <li class="dcsy_sxLi <?php if(($order) == "d"): ?>on<?php endif; ?>"><a class="dcsy_sxLiA" href="<?php echo LinkTo('ele/index',$linkArr,array('order'=>'d'));?>">默认排序</a></li>
                <li class="dcsy_sxLi <?php if(($order) == "s"): ?>on<?php endif; ?>"><a class="dcsy_sxLiA" href="<?php echo LinkTo('ele/index',$linkArr,array('order'=>'s'));?>">销量<em></em></a></li>
                <li class="dcsy_sxLi <?php if(($order) == "t"): ?>on<?php endif; ?>"><a class="dcsy_sxLiA" href="<?php echo LinkTo('ele/index',$linkArr,array('order'=>'t'));?>">送餐速度<em></em></a></li>
                <li class="dcsy_sxLi dcsy_sxLixl"><a class="dcsy_sxLiA" href="javascript:void(0);">起送价筛选<em></em></a>
                    <div class="nearbuy_sxkLi2Xl">
                        <ul>
                            <li><a href="<?php echo LinkTo('ele/index',$linkArr,array('price'=>1));?>">50元以下</a></li>
                            <li><a href="<?php echo LinkTo('ele/index',$linkArr,array('price'=>2));?>">50-100元</a></li>
                            <li><a href="<?php echo LinkTo('ele/index',$linkArr,array('price'=>3));?>">100-200元</a></li>
                            <li><a href="<?php echo LinkTo('ele/index',$linkArr,array('price'=>4));?>">200元以上</a></li>
                        </ul>
                    </div>
                </li>
                <li class="dcsy_sxLi dcsy_sxLixl"><a class="dcsy_sxLiA" href="<?php echo LinkTo('ele/index');?>">全部商家<em></em></a></li>
            </ul>
        </div>
    </div>
    <div class="dcsy_spList">
        <ul>
            <?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="dcsy_spLi">
                    <a title="<?php echo ($item["shop_name"]); ?>" href="<?php echo U('ele/shop',array('shop_id'=>$item['shop_id']));?>" target="_blank"><div class="dcsy_spImg"><img src="__ROOT__/attachs/<?php echo ($shops[$item['shop_id']]['photo']); ?>" width="208" height="156" /></div>
                        <p class="dcsy_spT"><?php echo ($item["shop_name"]); ?></p>
                        <p class="dcsy_spPf"><span class="left"><span class="spxq_qgpstarBg"><span class="spxq_qgpstar spxq_qgpstar<?php echo ($shops[$item['shop_id']]['score']); ?>"></span></span><?php echo round($shops[$item['shop_id']]['score']/10,1);?>分</span><span class="right dcsy_spDd">月售<?php echo ($item["month_num"]); ?>单</span></p>
                        <p class="dcsy_spPf"><span class="left">起送:￥<?php echo round($item['since_money']/100,2);?> <span class="dcsy_spPs">配送费:￥<?php echo round($item['logistics']/100,2);?></span></span><span class="right"><em class="em_time"></em><?php echo ($item["distribution"]); ?>分钟</span></p>
                        <hr style=" border:none 0px; border-bottom: 1px solid #e0e0e0; margin-top:6px;" />
                        <p class="dcsy_spBq"><?php if(($item["is_pay"]) == "1"): ?><span class="dcsy_spBq2">&nbsp;</span><?php endif; if(($item["is_new"]) == "1"): ?><span class="dcsy_spBq3">&nbsp;</span><?php endif; if(($item["is_fan"]) == "1"): ?><span class="dcsy_spBq4">&nbsp;</span><?php endif; ?></p>
                    </a>
                </li><?php endforeach; endif; ?>
        </ul>
    </div>
    <div class="x">
        <?php echo ($page); ?>
    </div>
</div>
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