<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($CONFIG["site"]["title"]); ?>管理后台</title>
        <meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台" />
        <link href="__TMPL__statics/css/pub.css" rel="stylesheet" type="text/css" />
        <script> var BAO_PUBLIC = '__PUBLIC__';
            var BAO_ROOT = '__ROOT__';</script>
        <script src="__PUBLIC__/js/jquery.js"></script>
        <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
        <script src="__PUBLIC__/js/admin.js"></script>

    </head>
    <body>
        <iframe id="baocms_frm" name="baocms_frm" style="display:none;"></iframe>
        <div class="main_logon">

            <div class="login">
                <div class="title">Baocms后台管理系统</div>

                <form method="post" action="<?php echo U('login/loging');?>" target="baocms_frm" >


                    <table cellpssssadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width=""><input type="text" name="username" class="loginInput1" placeholder="请输入用户名"/></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" class="loginPass" placeholder="请输入密码" /></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="yzm" class="yzm" placeholder="请输入验证码" />
                                <span class="yzm_code" style="margin:2px 0 0px; display:block; cursor:pointer;"><img style="width:124px; height:44px;"  src="__ROOT__/index.php?g=app&m=verify&a=index&mt=<?php echo time();?>" /></span></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="loginBtn" value="确认登录" /></td>
                        </tr>
                    </table>
                </form> 
            </div>
            <p class="copy">技术支持：合肥生活宝网络科技有限公司 www.baocms.com</p>
        </div>		  	   	
        
</div>
</body>
</html>