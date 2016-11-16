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
<div class="main-jsgl main-sc">
    <div class="jsglNr">
        <div class="selectNr" style="margin-top: 0px; border-top:none;">
            <div class="right">    
                <form class="search_form" method="post" action="<?php echo U('user/select',array('id'=>$id,'show'=>$show));?>">
                    <div class="seleHidden" id="seleHidden">
                        <span>昵称</span>
                        <input type="text" name="nickname" value="<?php echo ($nickname); ?>" class="inptText" /><input type="submit" value="   搜索"  class="inptButton" />
                    </div> 
                </form>
                <a href="javascript:void(0);" class="searchG">高级搜索</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <form method="post" action="<?php echo U('user/select',array('id'=>$id,'show'=>$show));?>">
            <div class="selectNr selectNr2">
                <div class="left">
                    <div class="seleK">
                        <label>
                            <span>账户</span>
                            <input type="text" name="account" value="<?php echo ($account); ?>" class="inptText w100" />
                        </label>
                        <label>
                            <span>昵称</span>
                            <input type="text" name="nickname" value="<?php echo ($nickname); ?>" class="inptText w100" />
                        </label>
                        <label>
                            <span>扩展字段</span>
                            <input type="text" name="ext0" value="<?php echo ($ext0); ?>" class="inptText w100" />
                        </label>

                    </div>
                </div>
                <div class="right">
                    <input type="submit" value="   搜索"  class="inptButton" />
                </div>
        </form>
        <div class="clear"></div>
    </div>
    <form  target="baocms_frm" method="post">
        <div class="tableBox">
            <table bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;"  >
                <tr>
                    <td class="w50">ID</td>
                    <td>账户</td>
                    <td>昵称</td>
                    <td>扩展字段</td>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$var): ?><tr>
                        <td><input type="radio" name="user_id"   rel="<?php echo ($var["nickname"]); ?>" value="<?php echo ($var["user_id"]); ?>" /><?php echo ($var["user_id"]); ?></td>
                        <td><?php echo ($var["account"]); ?></td>
                        <td><?php echo ($var["nickname"]); ?></td>
                        <td><?php echo ($var["ext0"]); ?></td>
                    </tr><?php endforeach; endif; ?>
            </table>
            <?php echo ($page); ?>
        </div>
        <div class="selectNr" style="margin-bottom: 0px; border-bottom: none;">
            <div class="left">
                <input style="border:1px solid #dbdbdb; width: 100px; height: 38px; line-height: 38px; text-align: center;" type="button" id="select_btn" class="remberBtn" value="确定选择" />
            </div>
        </div>
    </form>
</div>
</div>

<script>
    $(document).ready(function (e) {
        $("#select_btn").click(function () {
            $("input[name='user_id']").each(function (a) {
                if ($(this).prop("checked") == true) {
                    parent.selectCallBack('user_id', 'nickname', $(this).val(), $(this).attr('rel'));
                }
            });
        });

    });
</script>

</div>
</body>
</html>