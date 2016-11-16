<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,index.js')); ?>
</head>
<body class="index_page" style="min-width:1200px;">
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/index_ad.lbi'); ?>

<div class="blank" style="height:30px;"></div>
<div class="block clearfix Main">
<?php echo $this->fetch('library/category_tree_index.lbi'); ?>
<div class="AreaL">
 
<?php echo $this->fetch('library/new_articles.lbi'); ?>
  



</div>
<div class="Arear">

 
</div> 
  <div class="goodsBox_1">
  

  
  
<?php echo $this->fetch('library/recommend_best.lbi'); ?>
<?php echo $this->fetch('library/recommend_new.lbi'); ?>
<?php echo $this->fetch('library/recommend_hot.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_1']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_1']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_17']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_17']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_34']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_34']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_21']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_21']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_38']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_38']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_28']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_28']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_37']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_37']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

  </div> 
  
    </div>
  
  
  
 


    <?php echo $this->fetch('library/help.lbi'); ?>
 

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>

<script type='text/javascript' src='http://tb.53kf.com/kf.php?arg=10060261&style=5'></script>
</html>