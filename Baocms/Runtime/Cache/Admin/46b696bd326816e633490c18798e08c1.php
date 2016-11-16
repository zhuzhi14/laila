<?php if (!defined('THINK_PATH')) exit();?><div class="listBox clfx">
    <div class="menuManage">
        <form  target="baocms_frm" action="<?php echo U('user/create');?>" method="post">
            <div class="mainScAdd">
                <div class="tableBox">
                    <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >
                        <tr>
                            <td class="lfTdBt">账户：</td>
                            <td class="rgTdBt"><input type="text" name="data[account]" value="<?php echo (($detail["account"])?($detail["account"]):''); ?>" class="scAddTextName w200" />
                                <code>账号只允许手机或邮件</code>
                            </td>
                        </tr>
                        <tr>
                            <td class="lfTdBt">密码：</td>
                            <td class="rgTdBt"><input type="password" name="data[password]" value="<?php echo (($detail["password"])?($detail["password"]):''); ?>" class="scAddTextName w200" />
                            </td>
                        </tr>
                        <tr>
                            <td class="lfTdBt">昵称：</td>
                            <td class="rgTdBt"><input type="text" name="data[nickname]" value="<?php echo (($detail["nickname"])?($detail["nickname"]):''); ?>" class="scAddTextName w200" />

                            </td>
                        </tr>
                        <tr>
                            <td class="lfTdBt">用户等级：</td>
                            <td class="rgTdBt">
                                <select name="data[rank_id]" class="seleFl w200">
                                    <?php if(is_array($ranks)): foreach($ranks as $key=>$item): ?><option <?php if(($item["rank_id"]) == $detail["rank_id"]): ?>selected="selected"<?php endif; ?>  value="<?php echo ($item["rank_id"]); ?>"><?php echo ($item["rank_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="lfTdBt">用户名：</td>
                            <td class="rgTdBt"><input type="text" name="data[ext0]" value="<?php echo (($detail["ext0"])?($detail["ext0"]):''); ?>" class="scAddTextName w200" />
                                <code>兼容UCENTER，如果不整合DZ可以不填写，整合就需要填写用户名</code>
                            </td>
                        </tr>
                        <tr>
                            <td class="lfTdBt">
                        <script type="text/javascript" src="__PUBLIC__/js/uploadify/jquery.uploadify.min.js"></script>
                        <link rel="stylesheet" href="__PUBLIC__/js/uploadify/uploadify.css">
                        头像：
                        </td>
                        <td class="rgTdBt">
                            <div style="width: 300px;height: 100px; float: left;">
                                <input type="hidden" name="data[photo]" value="<?php echo ($detail["photo"]); ?>" id="data_photo" />
                                <input id="photo_file" name="photo_file" type="file" multiple="true" value="" />
                            </div>
                            <div style="width: 200px;height: 100px; float: left;">
                                <img id="photo_img" width="80" height="80"  src="__ROOT__/attachs/<?php echo (($detail["photo"])?($detail["photo"]):'default.jpg'); ?>" />
                                <a href="<?php echo U('setting/attachs');?>">头像设置</a>
                                建议尺寸<?php echo ($CONFIG["attachs"]["user"]["thumb"]["thumb"]); ?>
                            </div>
                            <script>
                                $("#photo_file").uploadify({
                                    'swf': '__PUBLIC__/js/uploadify/uploadify.swf?t=<?php echo ($nowtime); ?>',
                                    'uploader': '<?php echo U("app/upload/uploadify",array("model"=>"user"));?>',
                                    'cancelImg': '__PUBLIC__/js/uploadify/uploadify-cancel.png',
                                    'buttonText': '上传头像',
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
                    </table>
                </div>
                <div class="smtQr"><input type="submit" value="确认添加" class="smtQrIpt" /></div>
            </div>
        </form>
    </div>
</div>