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
<script type="text/javascript" src="__TMPL__statics/js/dateRange.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__statics/css/dateRange.css"/>
<!--主体内容-->
<div class="pagewd">
	<!--搜索-->
    <div class="hotel_banner mt10 mb10">
        <img src="__TMPL__statics/images/hotel/banner.png" />
        <script>
            $(document).ready(function() {
                $(".hotel_soso_pull_int input").click(function(){
                    $(this).parent().find(".hotel_soso_pull").slideToggle(200);
                });
                $(document).on('click','#area li',function(){
                //$(".hotel_soso_pull li").click(function(){
                    $(this).parents(".hotel_soso_pull_int").find(".hotel_soso_pull").hide();
                    $(this).parents(".hotel_soso_pull_int").find("input").val($(this).html());
                    $("#area_id").val($(this).attr('rel'));
                });
                $(document).on('click','#business li',function(){
                //$(".hotel_soso_pull li").click(function(){
                    $(this).parents(".hotel_soso_pull_int").find(".hotel_soso_pull").hide();
                    $(this).parents(".hotel_soso_pull_int").find("input").val($(this).html());
                    $("#business_id").val($(this).attr('rel'));
                });
                $("#business_btn").click(function(){
                    var url = "<?php echo U('hotel/business');?>";
                    var area_id = $("#area_id").val();
                    $.post(url,{area_id:area_id},function(data){
                        if(data.status == 'success'){
                            var html ="";
                            var list = data.list;
                            $.each(list, function (n, value) {
				html += '<li rel='+value.business_id+'>'+value.business_name+'</li>';					
                            });
                            $('#business ul').html(html);
                        }else{
                            return false;
                        }
                    },'json')
                })
                
            });
        </script>
        <div class="hotel_soso">
            <form action="<?php echo U('hotel/index');?>" method="post">
                <div class="int_box hotel_soso_pull_int left">
                    <input value="" type="text" placeholder="地区" />
                    <input type="hidden" id="area_id" value="" name="area_id"/>
                    <em class="ico ico_1"></em>
                	<div class="hotel_soso_pull" id="area">
                    	<ul>
                            <?php if(is_array($areas)): foreach($areas as $key=>$item): ?><li rel="<?php echo ($item["area_id"]); ?>"><?php echo ($item["area_name"]); ?></li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="int_box  hotel_soso_pull_int left">
                    <input type="text" id="business_btn" value="" placeholder="商圈" />
                    <input type="hidden" id="business_id" value="" name="business_id"/>
                    <em class="ico ico_1"></em>
                	<div class="hotel_soso_pull" id="business">
                    	<ul>

                        </ul>
                    </div>
                </div>
                <div id="date_demo" style=" height: 44px; float: left; color: #fff;">
                <div class="int_box time left"><span class="wz">入住</span><input type="text" value="<?php echo ($into_time); ?>" readonly="readonly" id="ft"/><em class="ico ico_2"></em></div>
                <div class="int_box time left"><span class="wz">退房</span><input type="text" value="<?php echo ($out_time); ?>" readonly="readonly" id="tt"/><em class="ico ico_2"></em></div>
                </div>
                <div class="int_box long left"><input type="text" name="keyword" value="<?php echo ($keyword); ?>" placeholder="酒店名"  /></div>
                <input type="submit" id="set_cookie" value="搜索" class="btn left"  />
                <div class="clear"></div>
            </form>
        </div>
    </div>
    <script>
        var today = "<?php echo ($today); ?>";
        var dateRange = new pickerDateRange('date_demo', {
            //aRecent90Days : 'aRecent7DaysDemo3', //最近7天
            isTodayValid : true,
            startDate : "<?php echo ($into_time); ?>",
            endDate : "<?php echo ($out_time); ?>",
            needCompare : true,
            //isSingleDay : true,
            shortOpr : false,
            //dayRangeMax : 30,
            defaultText : ' 至 ',
            inputTrigger : 'input_trigger_demo3',
            theme : 'ta',
            success : function(obj) {
                    $("#ft").val(obj.startDate);
                    $("#tt").val(obj.endDate);
            }
        });
        dateRange.setNextMonth();
        
        $(document).ready(function(){
            $("#set_cookie").click(function(){
                var ft = $("#ft").val();
                var tt = $("#tt").val();
                SetCookie('into_time',ft);
                SetCookie('out_time',tt);
            })
        })
         function SetCookie(name, value)//两个参数，一个是cookie的名子，一个是值
            {
                var Days = 30; //此 cookie 将被保存 30天
                var exp = new Date();    //new Date("December 31, 9998");
                exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
                document.cookie = name + "=" + value + ";expires=" + exp.toGMTString() +";path=/";
            }
    </script>
    <!--搜索结束-->
    <!--酒店分类筛选-->
    <div class="hotel_cate">
        <div class="goods_flBox">
            <ul>
                <li class="goods_flList">
                        <div class="left goods_flList_l">地区位置：</div>
                        <div class="left goods_flList_r">
                            <a  class="<?php if(empty($area_id)): ?>on<?php endif; ?> goods_flListA"  title="全部地区" href="<?php echo LinkTo('hotel/index',$linkArr,array('area_id'=>0,'business_id'=>0));?>">全部</a>  
                            <?php if(is_array($areas)): foreach($areas as $key=>$item): if(($item["city_id"]) == $city_id): ?><a title="<?php echo ($item["area_name"]); ?>"  href="<?php echo LinkTo('hotel/index',$linkArr,array('area_id'=>$item['area_id']));?>"  <?php if(($item["area_id"]) == $area_id): ?>class="goods_flListA on"<?php else: ?>class="goods_flListA"<?php endif; ?> ><?php echo ($item["area_name"]); ?></a><?php endif; endforeach; endif; ?>
                        </div>
                    <?php if(!empty($area_id)): ?><div class="left goods_flList_r stycate">
                            <?php if(is_array($bizs)): foreach($bizs as $key=>$item): if(($item["area_id"]) == $area_id): ?><a title="<?php echo ($item["business_name"]); ?>"  class="<?php if(($item["business_id"]) == $business_id): ?>on<?php endif; ?> goods_flListA"  href="<?php echo LinkTo('hotel/index',$linkArr,array('area_id'=>$area_id,'business_id'=>$item['business_id']));?>"  ><?php echo ($item["business_name"]); ?></a><?php endif; endforeach; endif; ?>
                        </div><?php endif; ?>
                </li>
                <li class="goods_flList">
                    <div class="left goods_flList_l">酒店级别：</div>
                    <div class="left goods_flList_r">
                        <a  class="<?php if(empty($cate_id)): ?>on<?php endif; ?> goods_flListA"  title="不限" href="<?php echo LinkTo('hotel/index',$linkArr,array('cate_id'=>0));?>">不限</a> 
                        <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><a title="<?php echo ($item); ?>" href="<?php echo LinkTo('hotel/index',$linkArr,array('cate_id'=>$i));?>" class="<?php if($cate_id == $i): ?>on<?php endif; ?> goods_flListA"><?php echo ($item); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </li>
                <li class="goods_flList">
                    <div class="left goods_flList_l">价格范围：</div>
                    <div class="left goods_flList_r">
                        <a  class="<?php if(empty($fp)&&empty($tp)): ?>on<?php endif; ?> goods_flListA"  title="不限" href="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>0,'tp'=>0));?>">不限</a> 
                        <a title="￥200以下" href="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>0,'tp'=>200));?>" class="<?php if($fp == 0 && $tp == 200): ?>on<?php endif; ?> goods_flListA">￥200以下</a>
                        <a title="￥200-￥300" href="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>200,'tp'=>300));?>" class="<?php if($fp == 200 && $tp == 300): ?>on<?php endif; ?> goods_flListA">￥200-￥300</a>
                        <a title="￥300-￥500" href="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>300,'tp'=>500));?>" class="<?php if($fp == 300 && $tp == 500): ?>on<?php endif; ?> goods_flListA">￥300-￥500</a>
                        <a title="￥500以上" href="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>500,'tp'=>0));?>" class="<?php if($fp == 500 && $tp == 0): ?>on<?php endif; ?> goods_flListA">￥500以上</a>
                        <span class="hotel_cate_price">自定义<input id="fp" type="text" value="<?php echo (($fp)?($fp):''); ?>" />~<input id='tp' type="text" value="<?php echo (($tp)?($tp):''); ?>" /><a href="javascript:void(0);" id="sure_btn" rel="<?php echo LinkTo('hotel/index',$linkArr,array('fp'=>'oooo','tp'=>yyyy));?>" class="btn">确定</a></span>
                    </div>
                </li>
                <li class="goods_flList">
                    <div class="left goods_flList_l">配套设施：</div>
                    <div class="left goods_flList_r">
                        
                        <a class="<?php if(!$is_wifi&&!$is_kt&&!$is_nq&&!$is_xyj&&!$is_tv&&!$is_ly&&!$is_bx&&!$is_base&&!$is_rsh): ?>on<?php endif; ?> goods_flListA" title="不限" href="<?php echo LinkTo('hotel/index',$linkArr,array('is_wifi'=>0,'is_kt'=>0,'is_nq'=>0,'is_xyj'=>0,'is_tv'=>0,'is_ly'=>0,'is_bx'=>0,'is_base'=>0,'is_rsh'=>0));?>">不限</a>
                        <label title="WIFI" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_wifi) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_wifi'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_wifi'=>'0'));?>"  name="is_wifi"/>WIFI</label>
                        <label title="空调" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_kt) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_kt'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_kt'=>'0'));?>"  name="is_kt"/>空调</label>
                        <label title="暖气" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_nq) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_nq'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_nq'=>'0'));?>"  name="is_nq"/>暖气</label>
                        <label title="洗衣机" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_xyj) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_xyj'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_xyj'=>'0'));?>"  name="is_xyj"/>洗衣机</label>
                        <label title="电视机" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_tv) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_tv'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_tv'=>'0'));?>"  name="is_tv"/>电视机</label>
                        <label title="淋浴" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_ly) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_ly'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_ly'=>'0'));?>"  name="is_ly"/>淋浴</label>
                        <label title="电冰箱" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_bx) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_bx'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_bx'=>'0'));?>"  name="is_bx"/>电冰箱</label>
                        <label title="毛巾牙具" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_base) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_base'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_base'=>'0'));?>"  name="is_base"/>毛巾牙具</label>
                        <label title="热水壶" class="hotel_cate_int wd can_cancel"><input type="checkbox" <?php if(($is_rsh) == "1"): ?>checked="checked"<?php endif; ?>  rel='<?php echo LinkTo('hotel/index',$linkArr,array('is_rsh'=>'1'));?>' data="<?php echo LinkTo('hotel/index',$linkArr,array('is_rsh'=>'0'));?>"  name="is_rsh"/>热水壶</label>
                    </div>
                </li>
                <li class="goods_flList">
                    <div class="left goods_flList_l">酒店品牌：</div>
                    <div class="left goods_flList_r">
                        <a  class="<?php if(empty($type)): ?>on<?php endif; ?> goods_flListA"  title="不限" href="<?php echo LinkTo('hotel/index',$linkArr,array('type'=>0));?>">不限</a> 
                        <?php if(is_array($types)): foreach($types as $key=>$item): ?><a title="<?php echo ($item["title"]); ?>" href="<?php echo LinkTo('hotel/index',$linkArr,array('type'=>$item['type']));?>" class="<?php if($type == $item["type"]): ?>on<?php endif; ?> goods_flListA"><?php echo ($item["title"]); ?></a><?php endforeach; endif; ?>
                    </div>
                </li>
            </ul>
        </div>
        <script>
            $(document).ready(function() {
                $(".hotel_cate .goods_flList_r .more").click(function(){
                    if($(this).hasClass("on")){
                            $(this).removeClass("on");
                            $(this).parent().find(".more_box").hide();
                    }
                    else{
                            $(this).addClass("on");
                            $(this).parent().find(".more_box").show();
                    }
                });
                $(".can_cancel input").click(function () {
                    if ($(this).prop('checked') == true) {
                        location.href = $(this).attr('rel');
                    } else {
                        location.href = $(this).attr('data');
                    }
                });
                $("#sure_btn").click(function(){
                    var link = $(this).attr('rel');
                    var fp = $("#fp").val();
                    var tp = $("#tp").val();
                     window.location.href = link.replace('oooo', fp).replace('yyyy',tp);
                })
                
            });
        </script>
    </div>
    <!--酒店分类筛选结束-->
    <!--排序-->
    <div class="nearbuy_sxk">
        <ul>
            <li class="nearbuy_sxkLi <?php if(($order) == "d"): ?>on<?php endif; ?>"><a class="nearbuy_sxkLiA" href="<?php echo LinkTo('hotel/index',$linkArr,array('order'=>'d'));?>">默认</a></li>
            <li class="nearbuy_sxkLi <?php if(($order) == "s"): ?>on<?php endif; ?>"><a class="nearbuy_sxkLiA" href="<?php echo LinkTo('hotel/index',$linkArr,array('order'=>'s'));?>">星级<em class="em_up"></em></a></li>
            <li class="nearbuy_sxkLi <?php if(($order) == "p"): ?>on<?php endif; ?>"><a class="nearbuy_sxkLiA" href="<?php echo LinkTo('hotel/index',$linkArr,array('order'=>'p'));?>">价格<em class="em_up"></em></a></li>
            <li class="nearbuy_sxkLi <?php if(($order) == "f"): ?>on<?php endif; ?> "><a class="nearbuy_sxkLiA" href="<?php echo LinkTo('hotel/index',$linkArr,array('order'=>'f'));?>">评分<em class="em_up"></em></a></li>
        </ul>
    </div>
    <!--排序结束-->
    <!--酒店列表-->
    <div class="hotel_list_box">
        <ul>
            <?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="hotel_list">
                <div class="pub_img"><a href="<?php echo U('hotel/detail',array('hotel_id'=>$item['hotel_id']));?>"><img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="380" height="300" /><?php if($item['have_tuan'] == 1): ?><span class="tag">团</span><?php endif; ?></a></div>
                <div class="pub_wz">
                	<h3><a href="<?php echo U('hotel/detail',array('hotel_id'=>$item['hotel_id']));?>"><?php echo ($item["hotel_name"]); ?><span class="bq" style="background:#80c269;"><?php echo ($cates[$item['cate_id']]); ?></span></a></h3>
                    <div class="box">
                    	<div class="left">
                            <?php $s = round($item['score']/$item['comments'],1);$sc = $s*20; ?>
                        	<div><span class="spxq_qgpstarBg"><span class="spxq_qgpstar" style="width:<?php echo ($sc); ?>%;"></span></span> <span class="ml10"><?php echo ($s); ?>分</span> <span class="ml10 pl"><?php echo ($item["comments"]); ?>条评论</span></div> 
                            <p class="overflow_clear graycl"><?php echo ($item["addr"]); ?></p>
                        </div>
                        <div class="right">
                        	<p class="price fontcl1">￥<?php echo ($item["price"]); ?><small class="blackcl3">/晚起</small></p>
                                <p class="addr map_icon" rel="<?php echo ($item["lng"]); ?>" data="<?php echo ($item["lat"]); ?>"><em class="ico"></em>地图</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </li><?php endforeach; endif; ?>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="x">
        <?php echo ($page); ?>
    </div>
    <!--酒店列表结束-->
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7b92b3afff29988b6d4dbf9a00698ed8"></script>
    <div class="map_fixed">
        <div class="map_fixed_tit">
                <span>查看地图</span>
         <a href="javascript:;" title="关闭" class="close">×</a> 
        </div>
        <div class="map_fixed_box">
                <div id="allmap" style="width:700px; height:430px;"></div>
        </div>
        <p class="zhu">注：地图位置坐标仅供参考，具体情况以实际道路标识信息为准</p>
    </div>
<script>
    jQuery(document).ready(function($) {
        $('.map_icon').click(function(){
            var lng = $(this).attr('rel');
            var lat = $(this).attr('data');
            $('.map_fixed').show();
               var map = new BMap.Map("allmap");
                map.centerAndZoom(new BMap.Point(lng, lat), 17);
                var point = new BMap.Point(lng,lat);
                map.centerAndZoom(point, 17);
                var marker = new BMap.Marker(point); // 创建标注
                map.clearOverlays();
                map.addOverlay(marker); // 将标注添加到地图中
                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                map.addControl(new BMap.NavigationControl()); //添加默认缩放平移控件
        })
        $('.map_fixed .close').click(function(){
                $('.map_fixed').fadeOut(100);
        })
    })
</script>
<!--主体内容结束-->

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