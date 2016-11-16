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
  

<body style="overflow-x:hidden;">

<iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
    <?php if(!$is_app){?>
	<header>

  <a href="<?php echo AppLink('mobile/index/index');?>"><i class="icon-goback"></i></a>
		<div class="title">登 录</div>

		<i class="icon-menu"><a href="<?php echo AppLink('passport/register');?>">注册</a></i>

	</header>
    <?php }?>
    <div id="login" class="page-center-box">

    	<form action="<?php echo U('passport/login');?>" method="post" target="baocms_frm">

            <div id="scroll">

                <div id="login-input">

                    <input type="text" name="account" placeholder="用户名" />

                    <input type="password" name="password" placeholder="密码" />

                </div>

                <input type="submit" class="submit" value="登 录" />

                <div class="forget-out"><a href="<?php echo AppLink('passport/forget',array('way'=>2));?>">忘记密码？</a></div>

                <div class="other">

                    <p><span>第三方登录</span></p>

                    <ul>

                        <li><a href="<?php echo AppLink('passport/wblogin');?>"><div class="icon i-1"></div><p>微博</p></a></li>

                        <li><a href="<?php echo AppLink('passport/qqlogin');?>"><div class="icon i-2"></div><p>QQ</p></a></li>

                        <li><a href="<?php echo AppLink('passport/wxlogin');?>"><div class="icon" style="background-image:url(__TMPL__statics/img/other3.png)"></div><p>微信</p></a></li>

                    </ul>

                </div>

            </div>

        </form>

    </div>

</body>

</html>