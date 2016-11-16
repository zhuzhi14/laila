<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($CONFIG["site"]["title"]); ?>管理后台</title>
        <meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <!-- <link href="__TMPL__statics/css/index.css" rel="stylesheet" type="text/css" /> -->
        <link href="__TMPL__statics/css/style.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/land.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/pub.css" rel="stylesheet" type="text/css" />
        <link href="__TMPL__statics/css/main.css" rel="stylesheet" type="text/css" />
        <link href="__PUBLIC__/js/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script> var BAO_PUBLIC = '__PUBLIC__'; var BAO_ROOT = '__ROOT__'; </script>
        <script src="__PUBLIC__/js/jquery.js"></script>
        <script src="__PUBLIC__/js/jquery-ui.min.js"></script>
        <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
        <script src="__PUBLIC__/js/admin.js?v=20150409"></script>
    </head>
    <body style="background-color: #f1f1f1;">
         <iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
   <div class="main">

<div class="mainBt">
    <ul>
        <li class="li1">商城</li>
        <li class="li2">产品管理</li>
        <li class="li2 li3">编辑</li>
    </ul>
</div>
<div class="mainScAdd ">

    <div class="tableBox">
        <form target="baocms_frm" action="<?php echo U('goods/edit',array('goods_id'=>$detail['goods_id']));?>" method="post">
            <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >
                <tr>
                    <td class="lfTdBt">产品名称：</td>
                    <td class="rgTdBt"><input type="text" name="data[title]" value="<?php echo (($detail["title"])?($detail["title"]):''); ?>" class="manageInput" />

                    </td>
                </tr> 

                <tr>
                    <td class="lfTdBt">商家：</td>
                    <td class="rgTdBt"> <div class="lt">
                            <input type="hidden" id="shop_id" name="data[shop_id]" value="<?php echo (($detail["shop_id"])?($detail["shop_id"]):''); ?>"/>
                            <input type="text" id="shop_name" name="shop_name" value="<?php echo ($shop["shop_name"]); ?>" class="manageInput" />
                        </div>
                        <a mini="select"  w="1000" h="600" href="<?php echo U('shop/select');?>" class="remberBtn">选择商家</a>
                    </td>
                </tr>
                <tr>
                    <td class="lfTdBt">分类：</td>
                    <td class="rgTdBt">


                        <select id="cate_id" name="data[cate_id]" class="manageSelect w100">
                            <?php if(is_array($cates)): foreach($cates as $key=>$var): if(($var["parent_id"]) == "0"): ?><option value="<?php echo ($var["cate_id"]); ?>"  <?php if(($var["cate_id"]) == $detail["cate_id"]): ?>selected="selected"<?php endif; ?> ><?php echo ($var["cate_name"]); ?>(<?php echo ($var["rate"]); ?>‰)</option>                
                                <?php if(is_array($cates)): foreach($cates as $key=>$var2): if(($var2["parent_id"]) == $var["cate_id"]): ?><option value="<?php echo ($var2["cate_id"]); ?>"  <?php if(($var2["cate_id"]) == $detail["cate_id"]): ?>selected="selected"<?php endif; ?> > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($var2["cate_name"]); ?>(<?php echo ($var2["rate"]); ?>‰)</option><?php endif; endforeach; endif; endif; endforeach; endif; ?>
                        </select>

                    </td>
                </tr>   
                <tr>
                    <td class="lfTdBt">
                <script type="text/javascript" src="__PUBLIC__/js/uploadify/jquery.uploadify.min.js"></script>
                <link rel="stylesheet" href="__PUBLIC__/js/uploadify/uploadify.css">
                缩略图：
                </td>
                <td class="rgTdBt">
                    <div style="width: 300px;height: 100px; float: left;">
                        <input type="hidden" name="data[photo]" value="<?php echo ($detail["photo"]); ?>" id="data_photo" />
                        <input id="photo_file" name="photo_file" type="file" multiple="true" value="" />
                    </div>
                    <div style="width: 300px;height: 100px; float: left;">
                        <img id="photo_img" width="80" height="80"  src="__ROOT__/attachs/<?php echo (($detail["photo"])?($detail["photo"]):'default.jpg'); ?>" />
                        <a href="<?php echo U('setting/attachs');?>">缩略图设置</a>
                        建议尺寸<?php echo ($CONFIG["attachs"]["goods"]["thumb"]); ?>
                    </div>
                    <script>
                        $("#photo_file").uploadify({
                            'swf': '__PUBLIC__/js/uploadify/uploadify.swf?t=<?php echo ($nowtime); ?>',
                            'uploader': '<?php echo U("app/upload/uploadify",array("model"=>"goods"));?>',
                            'cancelImg': '__PUBLIC__/js/uploadify/uploadify-cancel.png',
                            'buttonText': '上传缩略图',
                            'fileTypeExts': '*.gif;*.jpg;*.png',
                            'queueSizeLimit': 1,
                            'onUploadSuccess': function (file, data, response) {
                                $("#data_photo").val(data);
                                $("#photo_img").attr('src', '__ROOT__/attachs/' + data).show();
                            }
                        });

                    </script>
                </td>
            </tr>
            <tr>
                <td class="lfTdBt">商品属性：</td>
                 <td class="rgTdBt"><input type="text" name="data[attr]" value="<?php echo (($detail["attr"])?($detail["attr"]):''); ?>" class="manageInput" />
                     <code>填写商品的大小、颜色、等属性信息。</code>
                </td>
            </tr>
            <tr>
            <td class="lfTdBt">市场价格：</td>
            <td class="rgTdBt"><input type="text" name="data[price]" value="<?php echo round($detail['price']/1,2);?>" class="manageInput" />

            </td>
        </tr><tr>
            <td class="lfTdBt">商城价格：</td>
            <td class="rgTdBt"><input type="text" name="data[mall_price]" value="<?php echo round($detail['mall_price']/1,2);?>" class="manageInput" />

            </td>
        </tr><tr>
            <td class="lfTdBt">手机下单优惠价格：</td>
             <td class="rgTdBt"><input type="text" name="data[mobile_fan]" value="<?php echo round($detail['mobile_fan']/1,2);?>" class="manageInput" />

            </td>
        </tr><tr>
            <td class="lfTdBt">结算价格：</td>
            <td class="rgTdBt"><input type="text" name="data[settlement_price]" value="<?php echo round($detail['settlement_price']/1,2);?>" class="manageInput" />
			<code>结算价格必须填写，否则该产品不能设置通过审核。</code>
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">可使用积分数：</td>
             <td class="rgTdBt"><input type="text" name="data[use_integral]" value="<?php echo (($detail["use_integral"])?($detail["use_integral"]):''); ?>" class="manageInput" />
                 <code>最大可使用的积分数，100积分抵扣1元，不填表示不可使用积分</code>  
            </td>
                <tr>
                    <td class="lfTdBt">库存数量：</td>
                    <td class="rgTdBt"><input type="text" name="data[kucun]" value="<?php echo (($detail["kucun"])?($detail["kucun"]):''); ?>"
                                              class="manageInput"/>

                    </td>
                </tr>
        </tr>
                <tr>
            <td class="lfTdBt">卖出数量：</td>
            <td class="rgTdBt"><input type="text" name="data[sold_num]" value="<?php echo (($detail["sold_num"])?($detail["sold_num"]):''); ?>" class="manageInput" />

            </td>
        </tr>
        <tr>
            <td class="lfTdBt">商品单次最大购买数：</td>
             <td class="rgTdBt">  <input type="text" name="data[max_buy]" value="<?php echo (($detail["max_buy"])?($detail["max_buy"]):''); ?>"  class="manageInput" />

            </td>
        </tr>
        
        <tr>
            <td class="lfTdBt">限时商品库存：</td>
             <td class="rgTdBt">  <input type="text" name="data[rush_kucun]" value="<?php echo (($detail["rush_kucun"])?($detail["rush_kucun"]):''); ?>" class="manageInput" />

            </td>
        </tr>
        
         <tr>
            <td class="lfTdBt">限时价格：</td>
             <td class="rgTdBt"><input type="text" name="data[rush_price]" value="<?php echo (($detail["rush_price"])?($detail["rush_price"]):''); ?>" class="manageInput" />

            </td>
        </tr>
        
         <tr>
            <td class="lfTdBt">限时时间：</td>
             <td class="rgTdBt"> <input type="text" name="data[rush_ltime]" value="<?php echo (date('Y-m-d',$detail['rush_ltime'])); ?>" onfocus="WdatePicker();"  class="manageInput" />

            </td>
        </tr>
        <tr>
            <td class="lfTdBt">浏览量：</td>
            <td class="rgTdBt"><input type="text" name="data[views]" value="<?php echo (($detail["views"])?($detail["views"]):''); ?>" class="manageInput" />

            </td>
        </tr><tr>
            <td class="lfTdBt">购买须知：</td>
            <td class="rgTdBt">
                <script type="text/plain" id="data_instructions" name="data[instructions]" style="width:800px;height:360px;"><?php echo ($detail["instructions"]); ?></script>
            </td>
        </tr>
        <link rel="stylesheet" href="__PUBLIC__/umeditor/themes/default/css/umeditor.min.css" type="text/css">
        <script type="text/javascript" charset="utf-8" src="__PUBLIC__/umeditor/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="__PUBLIC__/umeditor/umeditor.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/umeditor/lang/zh-cn/zh-cn.js"></script>
        <script>
                        um = UM.getEditor('data_instructions', {
                            imageUrl: "<?php echo U('app/upload/editor');?>",
                            imagePath: '__ROOT__/attachs/editor/',
                            lang: 'zh-cn',
                            langPath: UMEDITOR_CONFIG.UMEDITOR_HOME_URL + "lang/",
                            focus: false
                        });
        </script>
        <tr>
            <td class="lfTdBt">商品详情：</td>
            <td class="rgTdBt">
                <script type="text/plain" id="data_details" name="data[details]" style="width:800px;height:360px;"><?php echo ($detail["details"]); ?></script>
            </td>
        </tr>
        <script>
            um = UM.getEditor('data_details', {
                imageUrl: "<?php echo U('app/upload/editor');?>",
                imagePath: '__ROOT__/attachs/editor/',
                lang: 'zh-cn',
                langPath: UMEDITOR_CONFIG.UMEDITOR_HOME_URL + "lang/",
                focus: false
            });
        </script>
        <tr>
            <td class="lfTdBt">过期时间：</td>
            <td class="rgTdBt"><input type="text" name="data[end_date]" value="<?php echo (($detail["end_date"])?($detail["end_date"]):''); ?>" onfocus="WdatePicker();"  class="inputData" />

            </td>
        </tr>
        <tr>
            <td class="lfTdBt">排序：</td>
            <td class="rgTdBt"><input type="text" name="data[orderby]" value="<?php echo (($detail["orderby"])?($detail["orderby"]):''); ?>" class="manageInput" />

            </td>
        </tr>

    </table>
    <div style="margin-left:140px;margin-top:20px">
        <input type="submit" value="确认编辑" class="smtQrIpt" />
        <div>
            </form>
        </div>
    </div>
    
</div>
</body>
</html>