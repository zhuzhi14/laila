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
        <li class="li1">会员</li>
        <li class="li2">会员管理</li>
        <li class="li2 li3">会员等级</li>
    </ul>
</div>
<div class="main-jsgl main-sc">
    <p class="attention"><span>注意：</span>会员的等级图标建议写成样式！有序的从0到你要的等级；分享返利会在分享后带来的用户在商城或者抢购消费获得积分！</p>
    <div class="jsglNr">
        <div class="selectNr" style="margin-top: 0px; border-top:none;">
            <div class="left">
                <?php echo BA('userrank/create','','添加内容','load','',800,550);?>
            </div>
        </div>
        <form  target="baocms_frm" method="post">
            <div class="tableBox">
                <table bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;"  >
                    <tr>
                        <td class="w50"><input type="checkbox" class="checkAll" rel="rank_id" /></td>
                        <td class="w50">ID</td>
                        <td>等级名称</td>
                        <td>等级图标</td>
                        <td>等级图标2</td>
                        <td>分享返利（返积分）</td>
                        <td>需要声望</td> 
                        <td>操作</td>
                    </tr>
                    <?php if(is_array($list)): foreach($list as $key=>$var): ?><tr>
                            <td><input class="child_rank_id" type="checkbox" name="rank_id[]" value="<?php echo ($var["rank_id"]); ?>" /></td>
                            <td><?php echo ($var["rank_id"]); ?></td>
                            <td><?php echo ($var["rank_name"]); ?></td>
                            <td><?php echo ($var["icon"]); ?></td>
                            <td><?php echo ($var["icon1"]); ?></td>
                            <td><?php echo ($var["rebate"]); ?>%</td>
                            <td><?php echo ($var["prestige"]); ?></td>
                            <td>
                                <?php echo BA('userrank/edit',array("rank_id"=>$var["rank_id"]),'编辑','load','remberBtn',800,550);?>
                                <?php echo BA('userrank/delete',array("rank_id"=>$var["rank_id"]),'删除','act','remberBtn');?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </table>
                <?php echo ($page); ?>
            </div>
            <div class="selectNr" style="margin-bottom: 0px; border-bottom: none;">
                <div class="left">
                    <?php echo BA('userrank/delete','','批量删除','list',' a2');?>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</body>
</html>