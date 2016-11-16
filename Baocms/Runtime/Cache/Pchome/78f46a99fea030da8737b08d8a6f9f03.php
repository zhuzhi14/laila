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
<script>
    $(function () {
        $(".order-add").click(function () {
            $(".order-cover").show();
        });
        $(".order-xg").click(function () {
            $(".order-cover").show();
        });
        $(".add-off").click(function () {
            $(".order-cover").hide();
        })
        $(".add-close").click(function () {
            $(".order-cover").hide();
        })
    })

</script>
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
<div class="between">
    <div class="bet_bj">
        <div class="all" style="padding-bottom: 40px;">
            <div class="all_2">
                <ul>
                    <li class="on">1.提交订单<em>&nbsp;</em></li>
                    <li>2.去支付<em>&nbsp;</em></li>
                    <li>3.完成<em>&nbsp;</em></li>
                </ul>
            </div>
            <div class="all_3">
                <ul class="ul_3">
                    <li><a href="javascript:void(0);"><img src="__PUBLIC__/img/tp_5.png"><p>随时退</p></a></li>
                    <li><a href="javascript:void(0);"><img src="__PUBLIC__/img/tp_6.png"><p>不满意免单</p></a></li>
                    <li><a href="javascript:void(0);"><img src="__PUBLIC__/img/tp_7.png"><p>过期退</p></a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <div class="mode_dingdan">
            <form method="post" target="baocms_frm" action="<?php echo U('mall/order',array('t'=>$nowtime));?>">
                <div class="order-box">
                    <table class="order" width="100%">
                        <tr>
                            <th>项目</th>
                            <th>单价</th>
                            <th>数量</th>
                            <th width="120">总价</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($cart_goods)): foreach($cart_goods as $key=>$item): ?><tr>
                                <td>
                                    <div class="tab_nr">
                                        <div class="left tab_img"><a target="_blank" href="<?php echo U('mall/detail',array('goods_id'=>$item['goods_id'], 'vid'=>$item['vid']));?>">
                                        <?php if($item['value']['photo']){ ?>
                                        <img src="__ROOT__/attachs/<?php echo ($item["value"]["photo"]); ?>" width="134" height="85" class="img_3">
                                        <?php }else{ ?>
                                        <img src="__ROOT__/attachs/<?php echo ($item["photo"]); ?>" width="134" height="85" class="img_3">
                                        <?php } ?>
                                        </a>
                                        </div>
                                        <div class="left tab_wz">
                                            <p class="tab_nr1"><?php echo ($item["format_title"]); ?></p>
                                        </div>
                                    </div>
                                </td>

	                                <td width="115"><div class="tab_price">￥<span class="price"><?php echo round($item['mall_price']/100,2);?></span></div></td>               
	                                <td width="116">
	                                    <div class="ko">
	                                        <span data="<?php echo ($item["goods_id"]); ?>_<?php echo ($item['vid']); ?>"  class="jian">—</span>
	                                        <input type="text" value="<?php echo ($item["num"]); ?>" data="<?php echo ($item["goods_id"]); ?>_<?php echo ($item['vid']); ?>" rel="<?php echo round($item['mall_price']/100,2);?>" name="num[<?php echo ($item['goods_id']); ?>_<?php echo ($item['vid']); ?>]"   class="spinner">
	                                        <span data="<?php echo ($item["goods_id"]); ?>_<?php echo ($item['vid']); ?>" class="jia" store='<?php echo ($item["store"]); ?>' >+</span>
                                           <!--<input type="hidden" name="max_num" class="max_num" value="<?php echo ($item["max_buy"]); ?>"> -->
	                                       <input type="hidden" value="<?php echo ($item["max_buy"]); ?>" id='<?php echo ($item["goods_id"]); ?>_<?php echo ($item["vid"]); ?>max_buy'>
                                        </div>
	                                </td>
                                	<td><span id="jq_total_<?php echo ($item["goods_id"]); ?>_<?php echo ($item["vid"]); ?>" class="money2">￥<?php echo round($item['mall_price'] * $item['num']/100,2);?></span></td>
                                	<td><a class="jq_delete" rel="<?php echo ($item["goods_id"]); ?>_<?php echo ($item["vid"]); ?>" href="javascript:void(0);">删除</a></td>

                            </tr><?php endforeach; endif; ?>
                    </table>
                    <script>


                        function changetotal(obj) {
                            var money = obj.parent().find('.spinner').attr('rel');
                            var num = obj.parent().find('.spinner').val();
                            var total = Math.round(money * num * 100) / 100;
                            $("#jq_total_" + obj.attr('data')).html('￥' + total);
                            changealltotal();
                        }
                        function changealltotal() {

                            var total_price = 0;
                            $(".spinner").each(function () {
                                total_price += Math.round($(this).val() * $(this).attr('rel') * 100) / 100;
                            });
                            $("#jq_total").html(total_price);
                        }
                        $(document).ready(function (e) {
                            $(".jian").click(function () {
                                var v = $(this).parent().find(".spinner").val();
                                if (v > 1) {
                                    v--;
                                    $(this).parent().find(".spinner").val(v);
                                }
                                changetotal($(this));
                            });
                            
                            $(".jia").click(function () {
                                var v = $(this).parent().find(".spinner").val();
                                var store = parseInt($(this).attr('store'),10);
                                var goods_id = $(this).attr('data');                     
                                var max_buy = parseInt($('#'+goods_id+'max_buy').val());
                                if(isNaN(max_buy)){
                                    max_buy = 0;
                                }
                                if ((v < store && v < max_buy && max_buy!=0) || (v < store && v < 99 && max_buy==0)) {
                                    v++;
                                    $(this).parent().find(".spinner").val(v);
                                }else{
                                    alert(max_buy);
                                    layer.msg("已经达到购买上限");
                                }
                                changetotal($(this));
                            });

                            $(".spinner").change(function () {
                                if ($(this).val() < 1) {
                                    $(this).val('1');
                                }
                                if ($(this).val() > 99) {
                                    $(this).val('99');
                                }
                                changetotal($(this));
                            });
                            $(".jq_delete").click(function () {
                                goods_id = $(this).attr('rel');
                                layer.confirm('您确定要删除该商品？', {
                                    title:'删除商品',
                                    area: ['150px', '150px'], //宽高
                                    btn: ['是的', '不'], //按钮
                                    shade: false //不显示遮罩
                                }, function () {
                                    $.post("<?php echo U('mall/cartdel');?>", {goods_id: goods_id}, function (result) {
                                        if (result.status == "success") {
                                            layer.msg(result.msg);
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        } else {
                                            layer.msg(result.msg);
                                        }
                                    }, 'json');
                                });
                                $('.layui-layer-btn0').css('background', '#2fbdaa');
                            });

                        });
                    </script>
                    <div class="order_p1">
                        <div class="order_s3">
                            应付总额：<span class="rmb">￥</span><label id="jq_total" class="money"><?php echo round($total_price/100,2);?></label>
                        </div>   
                        <div class="cha"><a href="javascript:history.go(-1)" class="back">返回上一步</a><input type="submit" value="确认" class="sub"></div>
                    </div>
                    <div class="clear"></div>
                </div>   
            </form>
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