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
         <li class="li1">设置</li>
        <li class="li2">区域设置</li>
        <li class="li2 li3">城市站点</li>
    </ul>
</div>
<form  target="baocms_frm" action="<?php echo U('city/create');?>" method="post">
    <div class="mainScAdd">
        <div class="tableBox">
            <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >
                
                <tr>
                    <td class="lfTdBt">城市名称：</td>
                    <td class="rgTdBt"><input type="text" name="data[name]" value="<?php echo (($detail["name"])?($detail["name"]):''); ?>" class="manageInput" />

                    </td>
                </tr><tr>
                    <td class="lfTdBt">城市拼音：</td>
                    <td class="rgTdBt"><input type="text" name="data[pinyin]" value="<?php echo (($detail["pinyin"])?($detail["pinyin"]):''); ?>" class="manageInput" />

                    </td>
                </tr>
                
                <tr>
                    <td class="lfTdBt">城市模板风格：</td>
                    <td class="rgTdBt">
                        <select name="data[theme]" class="select">
                            <option value="">请选择</option>
                            <?php if(is_array($themes)): foreach($themes as $key=>$item): ?><option <?php if(($detail["theme"]) == $item["theme"]): ?>selected="selected"<?php endif; ?> value="<?php echo ($item["theme"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td class="lfTdBt">首字母：</td>
                    <td class="rgTdBt"><input type="text" name="data[first_letter]" value="<?php echo (($detail["first_letter"])?($detail["first_letter"]):''); ?>" class="manageInput" />
                        <code>大写字母</code>
                    </td>
                </tr>
                  <tr>
                    <td class="lfTdBt">城市中心坐标：</td>
                    <td class="rgTdBt">
                        <div class="lt">
                            经度<input type="text" name="data[lng]" id="data_lng" value="<?php echo (($detail["lng"])?($detail["lng"]):''); ?>" class="scAddTextName w200" />
                            纬度 <input type="text" name="data[lat]" id="data_lat" value="<?php echo (($detail["lat"])?($detail["lat"]):''); ?>" class="scAddTextName w200" />
                        </div>
                        <a style="margin-left: 10px;" mini="select"  w="600" h="600" href="<?php echo U('public/maps');?>" class="seleSj">百度地图</a>
                </tr>
                <tr>
                    <td class="lfTdBt">排序：</td>
                    <td class="rgTdBt"><input type="text" name="data[orderby]" value="<?php echo (($detail["orderby"])?($detail["orderby"]):''); ?>" class="manageInput" />

                    </td>
                </tr>
                 <tr>
                    <td class="lfTdBt">是否启用：</td>
                    <td class="rgTdBt">
                        <label>
                            <input type="radio" <?php if($detail['is_open'] == 0) echo "checked='checked'";?> name="data[is_open]" value="0"  />
                                   不启用
                        </label>
                        <label>
                            <input type="radio" <?php if($detail['is_open'] == 1) echo "checked='checked'";?> name="data[is_open]" value="1"  />
                                   启用
                        </label>
                    </td>
                </tr>
            </table>
        </div>
        <div class="smtQr"><input type="submit" value="确认添加" class="smtQrIpt" /></div>
    </div>
</form>

</div>
</body>
</html>