<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($CONFIG["site"]["title"]); ?>商户中心</title>
<meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>商户中心" />
<meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>商户中心" />
<link href="__TMPL__statics/css/newstyle.css" rel="stylesheet" type="text/css" />
 <link href="__PUBLIC__/js/jquery-ui.css" rel="stylesheet" type="text/css" />
<script>
var BAO_PUBLIC = '__PUBLIC__'; var BAO_ROOT = '__ROOT__';
</script>
<script src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/jquery-ui.min.js"></script>
<script src="__PUBLIC__/js/web.js"></script>
<script src="__PUBLIC__/js/layer/layer.js"></script>
<script src="__PUBLIC__/js/jquery.jqprint.js"></script>

</head>

<body>
<iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
<div class="content_right">  
    <div class="tgdd">
        <div class="tgdd_nr">
            <ul class="myMessage_list">
                <?php if(is_array($list)): foreach($list as $key=>$item): ?><li>
                        <img src="__ROOT__/attachs/<?php echo ($item["face"]); ?>" width="48" height="48" />
                        <div class="nr">
                            <div class="left">
                                <p><?php echo msubstr($item['nickname'],0,6);?></p>
                                <p class="date"><?php echo (date('Y-m-d H:i',$item["time"])); ?></p>
                            </div>
                            <div class="right"><a class="btn" href="<?php echo U('message/mlist',array('uid'=>$item['user_id']));?>">查看对话</a></div>
                        </div>
                    </li><?php endforeach; endif; ?>
            </ul>
            <div class="x"><?php echo ($page); ?></div>
        </div>
    </div> 
</div>
</div>
</body>
</html>