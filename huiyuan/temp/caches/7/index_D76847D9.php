<?php exit;?>a:3:{s:8:"template";a:11:{i:0;s:49:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/index.dwt";i:1;s:63:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/page_header.lbi";i:2;s:60:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/index_ad.lbi";i:3;s:71:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/category_tree_index.lbi";i:4;s:64:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/new_articles.lbi";i:5;s:66:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/recommend_best.lbi";i:6;s:65:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/recommend_new.lbi";i:7;s:65:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/recommend_hot.lbi";i:8;s:61:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/cat_goods.lbi";i:9;s:56:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/help.lbi";i:10;s:63:"D:/WWW/huiyuan/themes/ecmoban_yihaodian/library/page_footer.lbi";}s:7:"expires";i:1476953694;s:8:"maketime";i:1476950094;}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="麦啦-CBC联盟商务" />
<meta name="Description" content="麦啦-CBC联盟商务" />
<title>麦啦-CBC联盟商务</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/ecmoban_yihaodian/style.css" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS|麦啦-CBC联盟商务" href="feed.php" />
<script type="text/javascript" src="js/common.js"></script><script type="text/javascript" src="js/index.js"></script></head>
<body class="index_page" style="min-width:1200px;">
<link href="themes/ecmoban_suning/qq/images/qq.css" rel="stylesheet" type="text/css" />
  
  
<script type="text/javascript">
var process_request = "正在处理您的请求...";
</script>
<script type="text/javascript">
//设为首页 www.ecmoban.com
function SetHome(obj,url){
    try{
        obj.style.behavior='url(#default#homepage)';
       obj.setHomePage(url);
   }catch(e){
       if(window.netscape){
          try{
              netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){
              alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
          }
       }else{
        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
       }
  }
}
 
//收藏本站 bbs.ecmoban.com
function AddFavorite(title, url) {
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
     }
  }
}
function show_div(obj){
	if(obj.className == "more-menu")
	{
		obj.className = "more-menu hover";
	}
	else
	{
		obj.className = "more-menu";
	}
}	
</script>
<script type="text/javascript" src="js/transport.js"></script><script type="text/javascript" src="js/utils.js"></script>
<div class="hd_global_top_bar" id="global_top_bar">
  <div class="wrap clearfix">
    <div class="hd_topbar_left clearfix">
      <div class="hd_unlogin_wrap" id="global_unlogin">
      
        <div class="hd_login clearfix" id="ECS_MEMBERZONE"><font color=red>麦啦</font>网手机版 | 收藏<font color=red>麦啦</font>网 </div>
        
      </div>
    </div>
    <div class="hd_top_manu clearfix">
      <ul class="clearfix">
        <li class="hd_my_order">554fcae493e564ee0dc75bdf2ebf94camember_info|a:1:{s:4:"name";s:11:"member_info";}554fcae493e564ee0dc75bdf2ebf94ca</li>
	
	<li class="hd_menu_tit hd_my_order" id="glHdMyYhd"  > <a class="hd_menu" target="_blank" href="user.php"><s></s>我的麦啦</a>
         </li>
        <li class="hd_menu_tit" id="glKeHuDuan" > <a href="flow.php" class="hd_menu"><i class="carts"></i>购物车</a>
         
        </li>
              </ul>
        </div>
  </div>
</div>
<div id="site_header" class="wrap hd_header clearfix">
  <div class="hd_logo_area fl clearfix" id="logo_areaID"> 
  
  <a class="fl" href="./index.php"> <img alt="麦啦网" src="themes/ecmoban_yihaodian/images/logo.gif"> </a>
  
  </div>
  
  
  <div class="hd_head_search">
    <div class="hd_search_form clearfix">
    
      <div class="hd_search_wrap clearfix">
      <script type="text/javascript">
    
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
           // alert("请输入搜索关键词！");
            return false;
        }
    }
    
    </script>
      <form name="searchForm" id="newKeywords" method="get" action="search.php" onsubmit="return checkSearchForm()">
        <input type="text" value="" onblur="if(this.value == ''){this.value=''}" onfocus="if(this.value == ''){this.value = ''}" maxlength="100" style="color:#333333;" id="keyword" name="keywords" class="hd_input_test">
        <input  class="hd_search_btn" type="submit" value="搜 索">
        </form>
      </div>
      
    </div>
    <p class="hd_hot_search" id="hotKeywordsShow">  
        </p>
  </div>
  <div id="hdPrismWrap" class="hd_prism_wrap">
     
    
  </div>
  
</div>
<div class="menu_box clearfix"> 
<div class="block"> 
<div class="menu">
  <a href="index.php" class="cur">首页</a>
    <a href="category.php?id=21"  >美容护肤</a>
 
   <a href="category.php?id=17"  >日常护理</a>
 
   <a href="category.php?id=38"  >品位生活</a>
 
   <a href="category.php?id=1"  >秀丽家居</a>
 
 </div> 
</div>
</div>
 
<style type="text/css"> 
.container, .container *{margin:0; padding:0;}
.container{width:100%; height:413px; overflow:hidden;position:relative;}
.slider{position:absolute; width:100%; height:413px;}
.slider li , .slider li a{list-style:none; float:left;width:100%; height:413px;}
.slider img{width:100%; height:413px; display:block;}
.slider2{width:2000px;}
.slider2 li{float:left;}
.num{position:absolute; left:50%; bottom:5px; width:auto; margin:0 auto;}
.num li{
	float: left;
	color: #E50065;
	text-align: center;
	line-height: 16px;
	width: 16px;
	height: 16px;
	font-family: Arial;
	font-size: 12px;
	cursor: pointer;
	overflow: hidden;
	margin: 3px 1px;
	border: 1px solid #ff3c3c;
	background-color: #ccc;
}
.num li.on{
	color: #fff;
	line-height: 21px;
	width: 21px;
	height: 21px;
	font-size: 16px;
	margin: 0 1px;
	border: 0;
	background-color: #ff3c3c;
	border: 1px solid #ff3c3c;
	font-weight: bold;
}
</style>
<div class="container" id="idTransformView">
  <ul class="slider" id="idSlider">
        <li style="background:url(data/afficheimg/20150806xrplhi.jpg) center 0 no-repeat; position:relative;"><a href="http://m.tongdui.cn/" target="_blank"></a></li>
            <li style="background:url(data/afficheimg/20150805diowos.jpg) center 0 no-repeat; position:relative;"><a href="http://m.tongdui.cn/" target="_blank"></a></li>
            <li style="background:url(data/afficheimg/20150805oveqth.jpg) center 0 no-repeat; position:relative;"><a href="http://m.tongdui.cn" target="_blank"></a></li>
      
  </ul>
  <ul class="num" id="idNum">
 
    
          <li>
    1    </li> 
         <li>
    2    </li> 
         <li>
    3    </li> 
        
  </ul>
</div>
<script type="text/javascript">
var $ = function (id) {
	return "string" == typeof id ? document.getElementById(id) : id;
};
var Class = {
  create: function() {
	return function() {
	  this.initialize.apply(this, arguments);
	}
  }
}
Object.extend = function(destination, source) {
	for (var property in source) {
		destination[property] = source[property];
	}
	return destination;
}
var TransformView = Class.create();
TransformView.prototype = {
  //容器对象,滑动对象,切换参数,切换数量
  initialize: function(container, slider, parameter, count, options) {
	if(parameter <= 0 || count <= 0) return;
	var oContainer = $(container), oSlider = $(slider), oThis = this;
	this.Index = 0;//当前索引
	
	this._timer = null;//定时器
	this._slider = oSlider;//滑动对象
	this._parameter = parameter;//切换参数
	this._count = count || 0;//切换数量
	this._target = 0;//目标参数
	
	this.SetOptions(options);
	
	this.Up = !!this.options.Up;
	this.Step = Math.abs(this.options.Step);
	this.Time = Math.abs(this.options.Time);
	this.Auto = !!this.options.Auto;
	this.Pause = Math.abs(this.options.Pause);
	this.onStart = this.options.onStart;
	this.onFinish = this.options.onFinish;
	
	oContainer.style.overflow = "hidden";
	oContainer.style.position = "relative";
	
	oSlider.style.position = "absolute";
	oSlider.style.top = oSlider.style.left = 0;
  },
  //设置默认属性
  SetOptions: function(options) {
	this.options = {//默认值
		Up:			true,//是否向上(否则向左)
		Step:		5,//滑动变化率
		Time:		10,//滑动延时
		Auto:		true,//是否自动转换
		Pause:		2000,//停顿时间(Auto为true时有效)
		onStart:	function(){},//开始转换时执行
		onFinish:	function(){}//完成转换时执行
	};
	Object.extend(this.options, options || {});
  },
  //开始切换设置
  Start: function() {
	if(this.Index < 0){
		this.Index = this._count - 1;
	} else if (this.Index >= this._count){this.Index = 0;}
	
	this._target = -1 * this._parameter * this.Index;
	this.onStart();
	this.Move();
  },
  //移动
  Move: function() {
	clearTimeout(this._timer);
	var oThis = this, style = this.Up ? "top" : "left", iNow = parseInt(this._slider.style[style]) || 0, iStep = this.GetStep(this._target, iNow);
	
	if (iStep != 0) {
		this._slider.style[style] = (iNow + iStep) + "px";
		this._timer = setTimeout(function(){oThis.Move();}, this.Time);
	} else {
		this._slider.style[style] = this._target + "px";
		this.onFinish();
		if (this.Auto) { this._timer = setTimeout(function(){oThis.Index++; oThis.Start();}, this.Pause); }
	}
  },
  //获取步长
  GetStep: function(iTarget, iNow) {
	var iStep = (iTarget - iNow) / this.Step;
	if (iStep == 0) return 0;
	if (Math.abs(iStep) < 1) return (iStep > 0 ? 1 : -1);
	return iStep;
  },
  //停止
  Stop: function(iTarget, iNow) {
	clearTimeout(this._timer);
	this._slider.style[this.Up ? "top" : "left"] = this._target + "px";
  }
};
window.onload=function(){
	function Each(list, fun){
		for (var i = 0, len = list.length; i < len; i++) {fun(list[i], i);}
	};
	
	var objs = $("idNum").getElementsByTagName("li");
	
	var tv = new TransformView("idTransformView", "idSlider", 413, 5, {
		onStart : function(){ Each(objs, function(o, i){o.className = tv.Index == i ? "on" : "";}) }//按钮样式
	});
	
	tv.Start();
	
	Each(objs, function(o, i){
		o.onmouseover = function(){
			o.className = "on";
			tv.Auto = false;
			tv.Index = i;
			tv.Start();
		}
		o.onmouseout = function(){
			o.className = "";
			tv.Auto = true;
			tv.Start();
		}
	})
	
	////////////////////////test2
	
	var objs2 = $("idNum2").getElementsByTagName("li");
	
	var tv2 = new TransformView("idTransformView2", "idSlider2",1200, 3, {
		onStart: function(){ Each(objs2, function(o, i){o.className = tv2.Index == i ? "on" : "";}) },//按钮样式
		Up: false
	});
	
	tv2.Start();
	
	Each(objs2, function(o, i){
		o.onmouseover = function(){
			o.className = "on";
			tv2.Auto = false;
			tv2.Index = i;
			tv2.Start();
		}
		o.onmouseout = function(){
			o.className = "";
			tv2.Auto = true;
			tv2.Start();
		}
	})
	
	$("idStop").onclick = function(){tv2.Auto = false; tv2.Stop();}
	$("idStart").onclick = function(){tv2.Auto = true; tv2.Start();}
	$("idNext").onclick = function(){tv2.Index++; tv2.Start();}
	$("idPre").onclick = function(){tv2.Index--;tv2.Start();}
	$("idFast").onclick = function(){ if(--tv2.Step <= 0){tv2.Step = 1;} }
	$("idSlow").onclick = function(){ if(++tv2.Step >= 10){tv2.Step = 10;} }
	$("idReduce").onclick = function(){ tv2.Pause-=1000; if(tv2.Pause <= 0){tv2.Pause = 0;} }
	$("idAdd").onclick = function(){ tv2.Pause+=1000; if(tv2.Pause >= 5000){tv2.Pause = 5000;} }
	
	$("idReset").onclick = function(){
		tv2.Step = Math.abs(tv2.options.Step);
		tv2.Time = Math.abs(tv2.options.Time);
		tv2.Auto = !!tv2.options.Auto;
		tv2.Pause = Math.abs(tv2.options.Pause);
	}
	
}
</script>
<div class="blank" style="height:30px;"></div>
<div class="block clearfix Main">
<script type="text/javascript">
          //初始化主菜单
            function sw_nav2(obj,tag)
            {
            var DisSub2 = document.getElementById("DisSub2_"+obj);
            var HandleLI2= document.getElementById("HandleLI2_"+obj);
			
                if(tag==1)
                {
                    DisSub2.style.display = "block";
					HandleLI2.className="current";
                }
                else
                {
                    DisSub2.style.display = "none";
					HandleLI2.className="";	
                }
            }
</script>
<div id="category_tree">
  <dl class="clearfix">
    <div class="mainCategory">
      <h2><a href="search.php" target="_blank">所有商品分类</a></h2>
    </div>
     
        <div  class="dt"  onMouseOver="sw_nav2(1,1);" onMouseOut="sw_nav2(1,0);" >
      <div id="HandleLI2_1"><a class="a " href="category.php?id=17">日常护理<i></i></a></div>
      <dd id=DisSub2_1 style="display:none"> 
         
        <a class="over_2" href="category.php?id=22">沐浴润肤</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=23">秀发养护</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=24">口腔洁净</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=25">婴儿用品</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=26">家居清洁</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=27">手足特别护理</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=47">女性护理</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(2,1);" onMouseOut="sw_nav2(2,0);" >
      <div id="HandleLI2_2"><a class="a t" href="category.php?id=28">养生美体<i></i></a></div>
      <dd id=DisSub2_2 style="display:none"> 
         
        <a class="over_2" href="category.php?id=29">养生普洱</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=30">养身美酒</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=48">养身护体</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(3,1);" onMouseOut="sw_nav2(3,0);" >
      <div id="HandleLI2_3"><a class="a " href="category.php?id=21">美容护肤<i></i></a></div>
      <dd id=DisSub2_3 style="display:none"> 
         
        <a class="over_2" href="category.php?id=31">美肽高肌能</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=32">美体内衣</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=33">益肌肤</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(4,1);" onMouseOut="sw_nav2(4,0);" >
      <div id="HandleLI2_4"><a class="a t" href="category.php?id=34">健康食品<i></i></a></div>
      <dd id=DisSub2_4 style="display:none"> 
         
        <a class="over_2" href="category.php?id=35">利咽含片</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=36">营养补充食品</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=49">健身利体</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(5,1);" onMouseOut="sw_nav2(5,0);" >
      <div id="HandleLI2_5"><a class="a " href="category.php?id=37">护肤精油<i></i></a></div>
      <dd id=DisSub2_5 style="display:none"> 
         
        <a class="over_2" href="category.php?id=39">单方精油</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=40">基础油</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=41">复方精油</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(6,1);" onMouseOut="sw_nav2(6,0);" >
      <div id="HandleLI2_6"><a class="a t" href="category.php?id=38">品位生活<i></i></a></div>
      <dd id=DisSub2_6 style="display:none"> 
         
        <a class="over_2" href="category.php?id=6">生态睡眠</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=12">美车用品</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=42">装饰品</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(7,1);" onMouseOut="sw_nav2(7,0);" >
      <div id="HandleLI2_7"><a class="a " href="category.php?id=1">秀丽家居<i></i></a></div>
      <dd id=DisSub2_7 style="display:none"> 
         
        <a class="over_2" href="category.php?id=43">衣洁系列</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=44">家居系列</a>
        <div class="clearfix"> 
           
        </div>
         
        <a class="over_2" href="category.php?id=45">厨房系列</a>
        <div class="clearfix"> 
           
        </div>
         
      </dd>
    </div>
     
     
        <div  class="dt"  onMouseOver="sw_nav2(8,1);" onMouseOut="sw_nav2(8,0);" >
      <div id="HandleLI2_8"><a class="a t" href="category.php?id=50">高品质产品组合<i></i></a></div>
      <dd id=DisSub2_8 style="display:none"> 
         
      </dd>
    </div>
     
     
        <div  class="dt" style="border-bottom:none;" onMouseOver="sw_nav2(9,1);" onMouseOut="sw_nav2(9,0);" >
      <div id="HandleLI2_9"><a class="a " href="category.php?id=51">购物储值卡<i></i></a></div>
      <dd id=DisSub2_9 style="display:none"> 
         
      </dd>
    </div>
     
      </dl>
</div>
<div class="AreaL">
 
<div id="mallNews"    class="  box_1">
    <h3><span>站内快讯</span></h3>
    <div class="NewsList tc  " style="border-top:none">
        <ul>
                <li>
      <a href="article.php?id=36" title="油污清洁精">油污清洁精</a>
        </li>
                <li>
      <a href="article.php?id=35" title="浓缩型有机酵素洗涤剂">浓缩型有机酵素洗涤剂</a>
        </li>
                <li>
      <a href="article.php?id=34" title="洗手液">洗手液</a>
        </li>
                <li>
      <a href="article.php?id=33" title="多功能薄垫（双人1.8米）">多功能薄垫（双人1.8米）</a>
        </li>
                <li>
      <a href="article.php?id=32" title="记忆枕">记忆枕</a>
        </li>
                <li>
      <a href="article.php?id=31" title="磁性被芯">磁性被芯</a>
        </li>
                <li>
      <a href="article.php?id=30" title="维生素C衍生物">维生素C衍生物</a>
        </li>
                <li>
      <a href="article.php?id=29" title="男士沐浴露">男士沐浴露</a>
        </li>
                </ul>
    </div>
</div>
<div  class="blank"></div>  
</div>
<div class="Arear">
 
</div> 
  <div class="goodsBox_1">
  
  
  
<div class="xm-box">
<h4 class="title"><span>精品推荐</span> <a class="more" href="search.php?intro=best">更多</a></h4>
<div id="show_best_area" class="clearfix">
      <div class="goodsItem">
       
           <a href="goods.php?id=119"><img src="images/201509/thumb_img/119_thumb_G_1441147581174.jpg" alt="秀丽家居套装 I" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=119" title="秀丽家居套装 I">秀丽家居套装 I</a></p>
           
           
 市场价：<font class="market">￥5138元</font> <br/>
      
           本店价：<font class="f1">
                     5000金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=120"><img src="images/201509/thumb_img/120_thumb_G_1441147700830.jpg" alt="秀丽家居套装 II" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=120" title="秀丽家居套装 II">秀丽家居套装 II</a></p>
           
           
 市场价：<font class="market">￥1552元</font> <br/>
      
           本店价：<font class="f1">
                     1500金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=121"><img src="images/201509/thumb_img/121_thumb_G_1441495245250.jpg" alt="日常护理套装" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=121" title="日常护理套装">日常护理套装</a></p>
           
           
 市场价：<font class="market">￥2542元</font> <br/>
      
           本店价：<font class="f1">
                     2500金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=40"><img src="images/201508/thumb_img/40_thumb_G_1440107514532.jpg" alt="浓缩型有机酵素洗衣液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=40" title="浓缩型有机酵素洗衣液">浓缩型有机酵素洗衣液</a></p>
           
           
 市场价：<font class="market">￥103元</font> <br/>
      
           本店价：<font class="f1">
                     86金币                     </font>      
		    
        </div>
   
    </div>
</div>
<div class="blank"></div>
  <div class="xm-box">
<h4 class="title"><span>新品上架</span> <a class="more" href="search.php?intro=new">更多</a></h4>
<div id="show_new_area" class="clearfix">
      <div class="goodsItem">
       
           <a href="goods.php?id=33"><img src="images/201508/thumb_img/33_thumb_G_1438722255015.jpg" alt="抑菌洗手液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=33" title="抑菌洗手液">抑菌洗手液</a></p>
           
           
 市场价：<font class="market">￥38元</font> <br/>
      
           本店价：<font class="f1">
                     32金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=117"><img src="images/201508/thumb_img/117_thumb_G_1440713887883.jpg" alt="磁益生女士磁疗内裤" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=117" title="磁益生女士磁疗内裤">磁益生女士磁疗内裤</a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=36"><img src="images/201508/thumb_img/36_thumb_G_1438728766914.jpg" alt="远红外纳米银-日用卫生巾" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=36" title="远红外纳米银-日用卫生巾">远红外纳米银-日用卫生巾</a></p>
           
           
 市场价：<font class="market">￥36元</font> <br/>
      
           本店价：<font class="f1">
                     30金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=39"><img src="images/201508/thumb_img/39_thumb_G_1440108022802.jpg" alt="浓缩型强效洗衣精华" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=39" title="浓缩型强效洗衣精华">浓缩型强效洗衣精华</a></p>
           
           
 市场价：<font class="market">￥72元</font> <br/>
      
           本店价：<font class="f1">
                     60金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=118"><img src="images/201508/thumb_img/118_thumb_G_1440716074008.jpg" alt="莫代尔多极磁石卫裤" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=118" title="莫代尔多极磁石卫裤">莫代尔多极磁石卫裤</a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
   
    </div>
</div>
<div class="blank"></div>
  <div class="xm-box">
<h4 class="title"><span>热卖商品</span> <a class="more" href="search.php?intro=hot">更多</a></h4>
<div id="show_hot_area" class="clearfix">
      <div class="goodsItem">
       
           <a href="goods.php?id=119"><img src="images/201509/thumb_img/119_thumb_G_1441147581174.jpg" alt="秀丽家居套装 I" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=119" title="秀丽家居套装 I">秀丽家居套装 I</a></p>
           
           
 市场价：<font class="market">￥5138元</font> <br/>
      
           本店价：<font class="f1">
                     5000金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=120"><img src="images/201509/thumb_img/120_thumb_G_1441147700830.jpg" alt="秀丽家居套装 II" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=120" title="秀丽家居套装 II">秀丽家居套装 II</a></p>
           
           
 市场价：<font class="market">￥1552元</font> <br/>
      
           本店价：<font class="f1">
                     1500金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=121"><img src="images/201509/thumb_img/121_thumb_G_1441495245250.jpg" alt="日常护理套装" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=121" title="日常护理套装">日常护理套装</a></p>
           
           
 市场价：<font class="market">￥2542元</font> <br/>
      
           本店价：<font class="f1">
                     2500金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=36"><img src="images/201508/thumb_img/36_thumb_G_1438728766914.jpg" alt="远红外纳米银-日用卫生巾" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=36" title="远红外纳米银-日用卫生巾">远红外纳米银-日用卫生巾</a></p>
           
           
 市场价：<font class="market">￥36元</font> <br/>
      
           本店价：<font class="f1">
                     30金币                     </font>      
		    
        </div>
    <div class="goodsItem">
       
           <a href="goods.php?id=42"><img src="images/201508/thumb_img/42_thumb_G_1438728598884.jpg" alt="生态能量多功能薄垫（1.8米）" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=42" title="生态能量多功能薄垫（1.8米）">生态能量多功能薄垫（1.8米）</a></p>
           
           
 市场价：<font class="market">￥9000元</font> <br/>
      
           本店价：<font class="f1">
                     7500金币                     </font>      
		    
        </div>
   
    </div>
</div>
<div class="blank"></div>
  
<div class="xm-box">
<h4 class="title"><span>秀丽家居</span> <a class="more" href="category.php?id=1">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=62"><img src="images/201508/thumb_img/62_thumb_G_1438721328073.jpg" alt="玻璃清洁剂" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=62" title="玻璃清洁剂"></a></p>
           
           
 市场价：<font class="market">￥34元</font> <br/>
      
           本店价：<font class="f1">
                     29金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=61"><img src="images/201508/thumb_img/61_thumb_G_1438721381229.jpg" alt="油污清洁精" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=61" title="油污清洁精"></a></p>
           
           
 市场价：<font class="market">￥31元</font> <br/>
      
           本店价：<font class="f1">
                     26金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=60"><img src="images/201508/thumb_img/60_thumb_G_1438721425710.jpg" alt="微矿泉水机" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=60" title="微矿泉水机"></a></p>
           
           
 市场价：<font class="market">￥4500元</font> <br/>
      
           本店价：<font class="f1">
                     3750金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=46"><img src="images/201508/thumb_img/46_thumb_G_1440531555719.jpg" alt="洗洁精稀释瓶" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=46" title="洗洁精稀释瓶"></a></p>
           
           
 市场价：<font class="market">￥17元</font> <br/>
      
           本店价：<font class="f1">
                     14金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=40"><img src="images/201508/thumb_img/40_thumb_G_1440107514532.jpg" alt="浓缩型有机酵素洗衣液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=40" title="浓缩型有机酵素洗衣液"></a></p>
           
           
 市场价：<font class="market">￥103元</font> <br/>
      
           本店价：<font class="f1">
                     86金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>日常护理</span> <a class="more" href="category.php?id=17">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=128"><img src="images/201609/thumb_img/128_thumb_G_1473829234968.jpg" alt="dddasd" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=128" title="dddasd"></a></p>
           
           
 市场价：<font class="market">￥0元</font> <br/>
      
           本店价：<font class="f1">
                     0金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=127"><img src="images/201609/thumb_img/127_thumb_G_1473829017759.jpg" alt="1111" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=127" title="1111"></a></p>
           
           
 市场价：<font class="market">￥0元</font> <br/>
      
           本店价：<font class="f1">
                     0金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=126"><img src="images/201609/thumb_img/126_thumb_G_1473828974956.jpg" alt="11" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=126" title="11"></a></p>
           
           
 市场价：<font class="market">￥0元</font> <br/>
      
           本店价：<font class="f1">
                     0金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=107"><img src="images/201508/thumb_img/107_thumb_G_1438821227984.jpg" alt="保湿焗油洗发水" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=107" title="保湿焗油洗发水"></a></p>
           
           
 市场价：<font class="market">￥223元</font> <br/>
      
           本店价：<font class="f1">
                     186金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=106"><img src="images/201508/thumb_img/106_thumb_G_1438821211380.jpg" alt="保湿焗油头皮改良液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=106" title="保湿焗油头皮改良液"></a></p>
           
           
 市场价：<font class="market">￥223元</font> <br/>
      
           本店价：<font class="f1">
                     186金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>健康食品</span> <a class="more" href="category.php?id=34">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=104"><img src="images/201508/thumb_img/104_thumb_G_1438821163069.jpg" alt="草本多醣干细胞萃取素25gX20包" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=104" title="草本多醣干细胞萃取素25gX20包"></a></p>
           
           
 市场价：<font class="market">￥1135元</font> <br/>
      
           本店价：<font class="f1">
                     946金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=103"><img src="images/201508/thumb_img/103_thumb_G_1438821140539.jpg" alt="绿康纤" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=103" title="绿康纤"></a></p>
           
           
 市场价：<font class="market">￥672元</font> <br/>
      
           本店价：<font class="f1">
                     560金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=102"><img src="images/201508/thumb_img/102_thumb_G_1438821123571.jpg" alt="芒果鲜橙" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=102" title="芒果鲜橙"></a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=85"><img src="images/201508/thumb_img/85_thumb_G_1438820503854.jpg" alt="鲜橙原味液体水果" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=85" title="鲜橙原味液体水果"></a></p>
           
           
 市场价：<font class="market">￥288元</font> <br/>
      
           本店价：<font class="f1">
                     240金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=84"><img src="images/201508/thumb_img/84_thumb_G_1438820488840.jpg" alt="菠萝鲜橙液体水果" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=84" title="菠萝鲜橙液体水果"></a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>美容护肤</span> <a class="more" href="category.php?id=21">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=118"><img src="images/201508/thumb_img/118_thumb_G_1440716074008.jpg" alt="莫代尔多极磁石卫裤" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=118" title="莫代尔多极磁石卫裤"></a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=117"><img src="images/201508/thumb_img/117_thumb_G_1440713887883.jpg" alt="磁益生女士磁疗内裤" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=117" title="磁益生女士磁疗内裤"></a></p>
           
           
 市场价：<font class="market">￥238元</font> <br/>
      
           本店价：<font class="f1">
                     198金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=100"><img src="images/201508/thumb_img/100_thumb_G_1438812494369.jpg" alt="原植素野玫瑰原液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=100" title="原植素野玫瑰原液"></a></p>
           
           
 市场价：<font class="market">￥276元</font> <br/>
      
           本店价：<font class="f1">
                     230金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=99"><img src="images/201508/thumb_img/99_thumb_G_1438812451863.jpg" alt="原植素多肽原液" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=99" title="原植素多肽原液"></a></p>
           
           
 市场价：<font class="market">￥336元</font> <br/>
      
           本店价：<font class="f1">
                     280金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=98"><img src="images/201508/thumb_img/98_thumb_G_1438812390625.jpg" alt="阳光防护乳" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=98" title="阳光防护乳"></a></p>
           
           
 市场价：<font class="market">￥252元</font> <br/>
      
           本店价：<font class="f1">
                     210金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>品位生活</span> <a class="more" href="category.php?id=38">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=59"><img src="images/201508/thumb_img/59_thumb_G_1438721569315.jpg" alt="生态能量记忆枕" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=59" title="生态能量记忆枕"></a></p>
           
           
 市场价：<font class="market">￥1320元</font> <br/>
      
           本店价：<font class="f1">
                     1100金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=55"><img src="images/201508/thumb_img/55_thumb_G_1440108228284.jpg" alt="表板蜡" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=55" title="表板蜡"></a></p>
           
           
 市场价：<font class="market">￥69元</font> <br/>
      
           本店价：<font class="f1">
                     58金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=54"><img src="images/201508/thumb_img/54_thumb_G_1438721838489.jpg" alt="柏油清洁剂" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=54" title="柏油清洁剂"></a></p>
           
           
 市场价：<font class="market">￥69元</font> <br/>
      
           本店价：<font class="f1">
                     58金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=53"><img src="images/201508/thumb_img/53_thumb_G_1440108297288.jpg" alt="化油器清洁剂" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=53" title="化油器清洁剂"></a></p>
           
           
 市场价：<font class="market">￥70元</font> <br/>
      
           本店价：<font class="f1">
                     58金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=52"><img src="images/201508/thumb_img/52_thumb_G_1438721892633.jpg" alt="多功能泡沫清洁剂" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=52" title="多功能泡沫清洁剂"></a></p>
           
           
 市场价：<font class="market">￥69元</font> <br/>
      
           本店价：<font class="f1">
                     58金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>养生美体</span> <a class="more" href="category.php?id=28">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=91"><img src="images/201508/thumb_img/91_thumb_G_1438804143563.jpg" alt="水牛角刮痧板" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=91" title="水牛角刮痧板"></a></p>
           
           
 市场价：<font class="market">￥60元</font> <br/>
      
           本店价：<font class="f1">
                     50金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=77"><img src="images/201508/thumb_img/77_thumb_G_1438823228419.jpg" alt="贴针灸" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=77" title="贴针灸"></a></p>
           
           
 市场价：<font class="market">￥226元</font> <br/>
      
           本店价：<font class="f1">
                     188金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=76"><img src="images/201508/thumb_img/76_thumb_G_1438823238031.jpg" alt="瘦针灸" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=76" title="瘦针灸"></a></p>
           
           
 市场价：<font class="market">￥226元</font> <br/>
      
           本店价：<font class="f1">
                     188金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
<div class="xm-box">
<h4 class="title"><span>护肤精油</span> <a class="more" href="category.php?id=37">更多</a></h4>
<div id="show_hot_area" class="clearfix">
 
            <div class="goodsItem">
       
           <a href="goods.php?id=96"><img src="images/201508/thumb_img/96_thumb_G_1438812295773.jpg" alt="美白嫩肤复方精油" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=96" title="美白嫩肤复方精油"></a></p>
           
           
 市场价：<font class="market">￥264元</font> <br/>
      
           本店价：<font class="f1">
                     220金币                     </font>      
		    
        </div>
            <div class="goodsItem">
       
           <a href="goods.php?id=92"><img src="images/201508/thumb_img/92_thumb_G_1438803993106.jpg" alt="眼部祛皱复方精油" class="goodsimg" /></a><br />
           <p class="f1"><a href="goods.php?id=92" title="眼部祛皱复方精油"></a></p>
           
           
 市场价：<font class="market">￥222元</font> <br/>
      
           本店价：<font class="f1">
                     185金币                     </font>      
		    
        </div>
          </div>
 
 
</div>
<div class="blank"></div>
  </div> 
  
    </div>
  
  
  
 
    <div class="ft_service_link clearfix" data-tpa="YHD_GLOBAl_FOOTER_HELP">
  <div id="bottomHelpLinkId" class="ft_help_list clearfix"> 
        <dl>
      <dt>新手上路 </dt>
            <dd><a href="article.php?id=9" target="_blank">会员注册</a></dd>
            <dd><a href="article.php?id=10" target="_blank">会员登录</a></dd>
            <dd><a href="article.php?id=11" target="_blank">订购方式</a></dd>
            <dd><a href="article.php?id=37" target="_blank">麦啦协议签订流程</a></dd>
          </dl>
        <dl>
      <dt>购物常识 </dt>
            <dd><a href="article.php?id=12" target="_blank">选购商品</a></dd>
            <dd><a href="article.php?id=13" target="_blank">购物流程</a></dd>
            <dd><a href="article.php?id=14" target="_blank">售后流程</a></dd>
          </dl>
        <dl>
      <dt>充值、汇款流程</dt>
            <dd><a href="article.php?id=15" target="_blank">货到付款区域</a></dd>
            <dd><a href="article.php?id=16" target="_blank">配送支付智能查询</a></dd>
            <dd><a href="article.php?id=17" target="_blank">支付方式说明</a></dd>
            <dd><a href="data/article/1458522203083148286.pdf" target="_blank">GPOS 使用说明</a></dd>
          </dl>
        <dl>
      <dt>会员中心</dt>
            <dd><a href="article.php?id=18" target="_blank">升级商户中心</a></dd>
            <dd><a href="article.php?id=19" target="_blank">购买麦啦订单</a></dd>
            <dd><a href="article.php?id=20" target="_blank">资金管理</a></dd>
          </dl>
        <dl>
      <dt>服务保证 </dt>
            <dd><a href="article.php?id=21" target="_blank">退换货原则</a></dd>
            <dd><a href="article.php?id=22" target="_blank">售后服务保证</a></dd>
            <dd><a href="article.php?id=23" target="_blank">产品品质保障</a></dd>
          </dl>
        <dl>
      <dt>联系我们 </dt>
            <dd><a href="article.php?id=24" target="_blank">网站故障报告</a></dd>
            <dd><a href="article.php?id=25" target="_blank">选机咨询</a></dd>
            <dd><a href="article.php?id=26" target="_blank">投诉与建议</a></dd>
          </dl>
     
  </div>
</div>
 
<div class="ft_code_wrap clearfix" id="footerQRcode">
  <div class="ft_mobile_code clearfix"> 
  <img width="90"   src="themes/ecmoban_yihaodian/images/tdweixin.jpg" alt="通兑集团官方微信">
    <dl>
      <dt>通兑集团官方微信</dt>
      <dd>只为创造高品质生活！</dd>
      
    </dl>
  </div>
  <div class="ft_mobile_code clearfix"> 
  <img width="90"   src="themes/ecmoban_yihaodian/images/td_code.png" alt="通兑积分官方微信">
    <dl>
      <dt>通兑积分官方微信</dt>
      <dd>刷卡享受优惠，积分通天下！</dd>
    </dl>
  </div>
</div>
<div id="footer">
<!--
  <div class="ft_footer_service"> 
  <a href="#" target="_blank"><span class="s1"></span>全国包邮</a> 
  <a href="#" target="_blank"><span class="s2"></span>正品保障</a> 
  <a href="#" target="_blank"><span class="s3"></span>售后无忧</a> 
  <a href="#" target="_blank"><span class="s4"></span>准时送达</a> 
  </div>
 --> 
    
  
<p class="ft_footer_link">
                <a href="http://www.tongdui.cn" target="_blank" title="通兑官网">通兑官网</a>        </p>
  <div class="text" style="line-height:20px;">
  <center>
 <br />
 上海市浦东新区宝安大厦3F        Tel: 400-021-5522  
               <a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=2850589771&amp;Site=麦啦-CBC联盟商务&amp;Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:2850589771:4" height="16" border="0" alt="QQ" /> 2850589771</a>
                                                                                           
  <br />
    </center>
 </div>
      
 
<small class="ft_pic_link" id="footerbanner2LazyLoad">
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img1.jpg"></a>|
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img2.jpg"></a>|
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img3.jpg"></a>|
<a><img src="themes/ecmoban_yihaodian/images/foot_img4.jpg"></a>|
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img5.jpg"></a>|
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img6.jpg"></a>|
<a href="#"><img src="themes/ecmoban_yihaodian/images/foot_img7.jpg"></a>|
<a href="h#"><img src="themes/ecmoban_yihaodian/images/foot_img8.jpg"></a>|
</small> 
</div>
  
<link href="ecmoban_qq/images/qq.css" rel="stylesheet" type="text/css" />
<div class="QQbox" id="divQQbox" style="width: 170px; ">
<div class="Qlist" id="divOnline" onmouseout="hideMsgBox(event);" style="display: none; " onmouseover="OnlineOver();">
    <div class="t"></div>
    <div class="infobox">我们营业的时间<br>9:00-18:00</div>
    <div class="con">
        <ul>
 
  
  
  
  
  
                <li><a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=2850589771&amp;Site=麦啦-CBC联盟商务&amp;Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:2850589771:4" height="16" border="0" alt="QQ" /> 2850589771</a> </li>
                                                                               
    
  
  
  
  
  
  
  
  
  
  
	      <li> 服务热线: 400-021-5522</li>
         </ul>
    </div>
    <div class="b"></div>
</div>
<div id="divMenu" onmouseover="OnlineOver();" style="display: block; "><img src="ecmoban_qq/images/qq_1.gif" class="press" alt="在线咨询"></div>
</div>
<script type="text/javascript">
//<![CDATA[
var tips; var theTop = 120/*这是默认高度,越大越往下*/; var old = theTop;
function initFloatTips() {
tips = document.getElementById('divQQbox');
moveTips();
};
function moveTips() {
var tt=50;
if (window.innerHeight) {
pos = window.pageYOffset
}
else if (document.documentElement && document.documentElement.scrollTop) {
pos = document.documentElement.scrollTop
}
else if (document.body) {
pos = document.body.scrollTop;
}
pos=pos-tips.offsetTop+theTop;
pos=tips.offsetTop+pos/10;
if (pos < theTop) pos = theTop;
if (pos != old) {
tips.style.top = pos+"px";
tt=10;
//alert(tips.style.top);
}
old = pos;
setTimeout(moveTips,tt);
}
//!]]>
initFloatTips();
function OnlineOver(){
document.getElementById("divMenu").style.display = "none";
document.getElementById("divOnline").style.display = "block";
document.getElementById("divQQbox").style.width = "170px";
}
function OnlineOut(){
document.getElementById("divMenu").style.display = "block";
document.getElementById("divOnline").style.display = "none";
}
if(typeof(HTMLElement)!="undefined")    //给firefox定义contains()方法，ie下不起作用
{   
      HTMLElement.prototype.contains=function(obj)   
      {   
          while(obj!=null&&typeof(obj.tagName)!="undefind"){ //通过循环对比来判断是不是obj的父元素
   　　　　if(obj==this) return true;   
   　　　　obj=obj.parentNode;
   　　}   
          return false;   
      };   
}  
function hideMsgBox(theEvent){ //theEvent用来传入事件，Firefox的方式
　 if (theEvent){
　 var browser=navigator.userAgent; //取得浏览器属性
　 if (browser.indexOf("Firefox")>0){ //如果是Firefox
　　 if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素
　　 return; //结束函式
} 
} 
if (browser.indexOf("MSIE")>0){ //如果是IE
if (document.getElementById('divOnline').contains(event.toElement)) { //如果是子元素
return; //结束函式
}
}
}
/*要执行的操作*/
document.getElementById("divMenu").style.display = "block";
document.getElementById("divOnline").style.display = "none";
}
</script>
 
</body>
<script type='text/javascript' src='http://tb.53kf.com/kf.php?arg=10060261&style=5'></script>
</html>