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
        <li class="li1">商家</li>
        <li class="li2">商家管理</li>
        <li class="li2 li3">编辑商家</li>
    </ul>
</div>
<form  target="baocms_frm" action="<?php echo U('shop/edit',array('shop_id'=>$detail['shop_id']));?>" method="post">
    <div class="mainScAdd">
        <div class="tableBox">
            <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >


                <tr>
                    <td class="lfTdBt">管理者：</td>
                    <td class="rgTdBt">
                        <div class="lt">
                            <input type="hidden" id="user_id" name="data[user_id]" value="<?php echo (($detail["user_id"])?($detail["user_id"]):''); ?>" />
                            <input class="scAddTextName w210 sj" type="text" name="nickname" id="nickname"  value="<?php echo ($user["nickname"]); ?>" />
                        </div>
                        <a mini="select"  w="800" h="600" href="<?php echo U('user/select');?>" class="seleSj">选择用户</a>
                    </td>
                </tr>    <tr>
                    <td class="lfTdBt">分类：</td>
                    <td class="rgTdBt">
                        <select id="cate_id" name="data[cate_id]" class="seleFl w210">
                            <?php if(is_array($cates)): foreach($cates as $key=>$var): if(($var["parent_id"]) == "0"): ?><option value="<?php echo ($var["cate_id"]); ?>"  <?php if(($var["cate_id"]) == $detail["cate_id"]): ?>selected="selected"<?php endif; ?> ><?php echo ($var["cate_name"]); ?></option>                
                                <?php if(is_array($cates)): foreach($cates as $key=>$var2): if(($var2["parent_id"]) == $var["cate_id"]): ?><option value="<?php echo ($var2["cate_id"]); ?>"  <?php if(($var2["cate_id"]) == $detail["cate_id"]): ?>selected="selected"<?php endif; ?> > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($var2["cate_name"]); ?></option><?php endif; endforeach; endif; endif; endforeach; endif; ?>
                        </select>
                        </script>
                    </td>
                </tr>    
                <tr>
                    <td class="lfTdBt">所在区域：</td>
                    <td class="rgTdBt">
                        
                        <select name="data[city_id]" id="city_id" style="float: left;" class="seleFl w210"></select>
                       <select name="data[area_id]" id="area_id" style="float: left;"  class="seleFl w210"></select>

                    </td>
                </tr>
                 <script src="<?php echo U('app/datas/cityarea');?>"></script>
                <script>
                    var city_id = <?php echo (int)$detail['city_id'];?>;
                    var area_id = <?php echo (int)$detail['area_id'];?>;
                    function changeCity(cid){
                        var area_str = '<option value="0">请选择.....</option>';
                        for(a in cityareas.area){
                           if(cityareas.area[a].city_id ==cid){
                                if(area_id == cityareas.area[a].area_id){
                                    area_str += '<option selected="selected" value="'+cityareas.area[a].area_id+'">'+cityareas.area[a].area_name+'</option>';
                                }else{
                                     area_str += '<option value="'+cityareas.area[a].area_id+'">'+cityareas.area[a].area_name+'</option>';
                                }  
                            }
                        }
                        $("#area_id").html(area_str);
                    }
                    $(document).ready(function(){
                        var city_str = '<option value="0">请选择.....</option>';
                        for(a in cityareas.city){
                           if(city_id == cityareas.city[a].city_id){
                               city_str += '<option selected="selected" value="'+cityareas.city[a].city_id+'">'+cityareas.city[a].name+'</option>';
                           }else{
                                city_str += '<option value="'+cityareas.city[a].city_id+'">'+cityareas.city[a].name+'</option>';
                           }  
                        }
                        $("#city_id").html(city_str);
                        if(city_id){
                            changeCity(city_id);
                        }
                        $("#city_id").change(function(){
                            city_id = $(this).val();
                            changeCity($(this).val());
                        });
                        
                        $("#area_id").change(function () {
                            var url = '<?php echo U("business/child",array("area_id"=>"0000"));?>';
                            if ($(this).val() > 0) {
                                var url2 = url.replace('0000', $(this).val());
                                $.get(url2, function (data) {
                                    $("#business_id").html(data);
                                }, 'html');
                            }

                        });
                    });
                </script>
                <tr>
                    <td class="lfTdBt">所在商圈：</td>
                    <td class="rgTdBt">
                        <select name="data[business_id]" id="business_id" class="seleFl w210">
                            <option value="0">请选择...</option>
                            <?php if(is_array($business)): foreach($business as $key=>$var): ?><option value="<?php echo ($var["business_id"]); ?>"  <?php if(($var["business_id"]) == $detail["business_id"]): ?>selected="selected"<?php endif; ?> ><?php echo ($var["business_name"]); ?></option><?php endforeach; endif; ?>   
                        </select>

                    </td>
                </tr><tr>
                    <td class="lfTdBt">商铺名称：</td>
                    <td class="rgTdBt"><input type="text" name="data[shop_name]" value="<?php echo (($detail["shop_name"])?($detail["shop_name"]):''); ?>" class="scAddTextName w210" />

                    </td>
                </tr><tr>
                    <td class="lfTdBt">
                <script type="text/javascript" src="__PUBLIC__/js/uploadify/jquery.uploadify.min.js"></script>
                <link rel="stylesheet" href="__PUBLIC__/js/uploadify/uploadify.css">
                商铺LOGO：
                </td>
                <td class="rgTdBt">
                    <div style="width: 300px;height: 100px; float: left;">
                        <input type="hidden" name="data[logo]" value="<?php echo ($detail["logo"]); ?>" id="data_logo" />
                        <input id="logo_file" name="logo_file" type="file" multiple="true" value="" />
                    </div>
                    <div style="width: 300px;height: 100px; float: left;">
                        <img id="logo_img" width="80" height="80"  src="__ROOT__/attachs/<?php echo (($detail["logo"])?($detail["logo"]):'default.jpg'); ?>" />
                        <a href="<?php echo U('setting/attachs');?>">缩略图设置</a>
                        建议尺寸:<?php echo ($CONFIG["attachs"]["shoplogo"]["thumb"]); ?>
                    </div>
                    <script>
                        $("#logo_file").uploadify({
                            'swf': '__PUBLIC__/js/uploadify/uploadify.swf?t=<?php echo ($nowtime); ?>',
                            'uploader': '<?php echo U("app/upload/uploadify",array("model"=>"shoplogo"));?>',
                            'cancelImg': '__PUBLIC__/js/uploadify/uploadify-cancel.png',
                            'buttonText': '上传商铺LOGO',
                            'fileTypeExts': '*.gif;*.jpg;*.png',
                            'queueSizeLimit': 1,
                            'onUploadSuccess': function (file, data, response) {
                                $("#data_logo").val(data);
                                $("#logo_img").attr('src', '__ROOT__/attachs/' + data).show();
                            }
                        });

                    </script>
                </td>
            </tr><tr>
            <td class="lfTdBt">
                店铺缩略图：
            </td>
            <td class="rgTdBt">
                <div style="width: 300px; height: 100px; float: left;">
                    <input type="hidden" name="data[photo]" value="<?php echo ($detail["photo"]); ?>" id="data_photo" />
                    <input id="photo_file" name="photo_file" type="file" multiple="true" value="" />
                </div>
                <div style="width: 300px; height: 100px; float: left;">
                    <img id="photo_img" width="80" height="80"  src="__ROOT__/attachs/<?php echo (($detail["photo"])?($detail["photo"]):'default.jpg'); ?>" />
                    <a href="<?php echo U('setting/attachs');?>">缩略图设置</a>建议尺寸:<?php echo ($CONFIG["attachs"]["shopphoto"]["thumb"]); ?>
                </div>
                <script>
                    $("#photo_file").uploadify({
                        'swf': '__PUBLIC__/js/uploadify/uploadify.swf?t=<?php echo ($nowtime); ?>',
                        'uploader': '<?php echo U("app/upload/uploadify",array("model"=>"shopphoto"));?>',
                        'cancelImg': '__PUBLIC__/js/uploadify/uploadify-cancel.png',
                        'buttonText': '上传店铺缩略图',
                        'fileTypeExts': '*.gif;*.jpg;*.png',
                        'queueSizeLimit': 1,
                        'onUploadSuccess': function (file, data, response) {
                            $("#data_photo").val(data);
                            $("#photo_img").attr('src', '__ROOT__/attachs/' + data).show();
                        }
                    });

                </script>
            </td>
        </tr><tr>
            <td class="lfTdBt">店铺地址：</td>
            <td class="rgTdBt">
                <input type="text" name="data[addr]" value="<?php echo (($detail["addr"])?($detail["addr"]):''); ?>" class="scAddTextName w210" />
            </td>
        </tr><tr>
            <td class="lfTdBt">店铺电话：</td>
            <td class="rgTdBt"><input type="text" name="data[tel]" value="<?php echo (($detail["tel"])?($detail["tel"]):''); ?>" class="scAddTextName w210" />

            </td>
        </tr>
        <tr>
            <td class="lfTdBt">联系人：</td>
            <td class="rgTdBt">
                <input type="text" name="data[contact]" value="<?php echo (($detail["contact"])?($detail["contact"]):''); ?>" class="scAddTextName w210" />
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">手机号码：</td>
            <td class="rgTdBt">
                <input type="text" name="data[mobile]" value="<?php echo (($detail["mobile"])?($detail["mobile"]):''); ?>" class="scAddTextName w210" />
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">标签：</td>
            <td class="rgTdBt"><input type="text" name="data[tags]" value="<?php echo (($detail["tags"])?($detail["tags"]):''); ?>" class="scAddTextName w210" />
                <code>每个标签用“，”分隔</code>
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">属性：</td>
            <td class="rgTdBt">
                <label><span style="margin-left: 20px;">自主配送：</span><input type="checkbox" name="data[is_pei]" <?php if($detail['is_pei'] == 1): ?>checked="checked"<?php endif; ?> value="1" /></label>
                <code>不勾选则是配送员配送</code>
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">等待配送时间：</td>
            <td class="rgTdBt">
                <label><input type="text" class="scAddTextName w210"  name="data[delivery_time]" value="<?php echo (($ex["delivery_time"])?($ex["delivery_time"]):'30'); ?>" />分钟</label>
                <code>自主配送则不用填</code>
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">店铺附近坐标：</td>
            <td class="rgTdBt"><input type="text" name="data[near]" value="<?php echo (($ex["near"])?($ex["near"]):''); ?>" class="scAddTextName w210" />

            </td>
        </tr><tr>
            <td class="lfTdBt">营业时间：</td>
            <td class="rgTdBt"><input type="text" name="data[business_time]" value="<?php echo (($ex["business_time"])?($ex["business_time"]):''); ?>" class="scAddTextName w210" />
                <code>例如8:00-19：00</code>
            </td>
        </tr><tr>
            <td class="lfTdBt">固定排名：</td>
            <td class="rgTdBt"><input type="text" name="data[orderby]" value="<?php echo (($detail["orderby"])?($detail["orderby"]):'100'); ?>" class="scAddTextName w210" />
                <code>1就是固定排名在第一位，一般建议不需要设置这个值！</code>
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">人均消费：</td>
            <td class="rgTdBt"><input type="text" name="data[price]" value="<?php echo (($ex["price"])?($ex["price"]):'0'); ?>" class="scAddTextName w210" />
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">订座：</td>
            <td class="rgTdBt">&nbsp;&nbsp;&nbsp;<input type="radio" name="data[is_ding]" value="1" <?php if($detail["is_ding"] == 1): ?>checked="checked"<?php endif; ?>  />是 &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[is_ding]" value="0"  <?php if($detail["is_ding"] == 0): ?>checked="checked"<?php endif; ?>/>否&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <td class="lfTdBt">商家坐标：</td>
            <td class="rgTdBt">
                <div class="lt">
                    经度<input type="text" name="data[lng]" id="data_lng" value="<?php echo (($detail["lng"])?($detail["lng"]):''); ?>" class="scAddTextName w210 w100" />
                    纬度 <input type="text" name="data[lat]" id="data_lat" value="<?php echo (($detail["lat"])?($detail["lat"]):''); ?>" class="scAddTextName w210 w100" />
                </div>
                <a style="margin-left: 10px;" mini="select"  w="600" h="600" href="<?php echo U('public/maps',array('lat'=>$detail['lat'],'lng'=>$detail['lng']));?>" class="seleSj">百度地图</a>
        </tr>

        <tr>
            <td class="lfTdBt">详情：</td>
            <td class="rgTdBt">
                <script type="text/plain" id="data_details" name="details" style="width:800px;height:360px;"><?php echo ($ex["details"]); ?></script>
            </td>
        </tr>
        <link rel="stylesheet" href="__PUBLIC__/umeditor/themes/default/css/umeditor.min.css" type="text/css">
        <script type="text/javascript" charset="utf-8" src="__PUBLIC__/umeditor/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="__PUBLIC__/umeditor/umeditor.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/umeditor/lang/zh-cn/zh-cn.js"></script>
        <script>
                    um = UM.getEditor('data_details', {
                        imageUrl: "<?php echo U('app/upload/editor');?>",
                        imagePath: '__ROOT__/attachs/editor/',
                        lang: 'zh-cn',
                        langPath: UMEDITOR_CONFIG.UMEDITOR_HOME_URL + "lang/",
                        focus: false
                    });
        </script>
     
    </table>
</div>
<div class="smtQr"><input type="submit" value="确认编辑" class="smtQrIpt" /></div>
</div>
</form>

</div>
</body>
</html>