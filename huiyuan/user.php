<?php

/**
 * ECSHOP 会员中心
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: user.php 17217 2011-01-19 06:29:08Z liubo $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');

$user_id = $_SESSION['user_id'];

$smarty->assign('user_id', $user_id);

$_SESSION['systemid'] == 'MAILA' ;
$systemid = 'MAILA' ;

$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';
$myrealname = $_SESSION['user_name'];
if (empty($myrealname)) {
    $myrealname = '';
}
$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);
$smarty->assign('stockstype', get_stockstype());
$back_act = '';

$_SESSION["ipaddress"]=real_ip();

//define(TIME_LONG,'60');

$allbalance = '电子币:' . $_SESSION['balance'] . '元 积分:' . $_SESSION['award_bal'] . 'TB  金币:' . $_SESSION['gold_amt'] . '币';
$smarty->assign('allbalance', $allbalance);        // 显示当前余额

// 不需要登录的操作或自己验证是否登录（如ajax处理）的act
$not_login_arr =
    array('login', 'act_login', 'register', 'act_register', 'act_edit_password', 'get_password', 'send_pwd_email', 'password', 'signin', 'add_tag', 'collect', 'return_to_cart', 'logout', 'email_list', 'validate_email', 'send_hash_mail', 'order_query', 'is_registered', 'check_email', 'check_recode', 'clear_history', 'qpassword_name', 'get_passwd_question', 'check_answer', 'getsms', 'change_pwd');

/* 显示页面的action列表 */
$ui_arr = array('register', 'login', 'profile', 'order_list', 'order_detail', 'address_list', 'collection_list','send_inq_gpos',
    'message_list', 'tag_list', 'get_password', 'reset_password', 'booking_list', 'add_booking', 'account_raply', 'account_award','account_goldtransfer',
    'account_deposit', 'account_log', 'account_list', 'accountjf_list', 'account_detail', 'account_detailjf', 'act_account', 'act_goldtransfer','pay', 'default', 'bonus', 'group_buy', 'group_buy_detail', 'affiliate', 'afftree','stock_trade', 'comment_list', 'upvip', 'fhlist', 'myreg', 'myrecom', 'buy_list', 'account_list', 'upbaodan', 'in_register', 'validate_email', 'track_packages', 'transform_points', 'qpassword_name', 'get_passwd_question', 'check_answer', 'getsms', 'change_pwd', 'safe_center','true_info');

/* 未登录处理 */

gc_writelog("B=" . $_SESSION['user_id'] . "-" . $myrealname . "-".$action."E");
if (empty($_SESSION['user_id'])) {
    if (!in_array($action, $not_login_arr)) {
        if (in_array($action, $ui_arr)) {
            /* 如果需要登录,并是显示页面的操作，记录当前操作，用于登录后跳转到相应操作
            if ($action == 'login')
            {
                if (isset($_REQUEST['back_act']))
                {
                    $back_act = trim($_REQUEST['back_act']);
                }
            }
            else
            {}*/
            if (!empty($_SERVER['QUERY_STRING'])) {
                $back_act = 'user.php?' . strip_tags($_SERVER['QUERY_STRING']);
            }
            $action = 'login';
        } else {
            //未登录提交数据。非正常途径提交数据！
            die($_LANG['require_login']);
        }
    }
}

/* 取出大家共用的数字 */
$myrank = $_SESSION['user_rank'];
$mybuss=isset($_SESSION['buss_rank'])?$_SESSION['buss_rank']:"" ;
$mybranch=isset($_SESSION['branch_rank'])?$_SESSION['branch_rank']:"" ;
$mylevel = $_SESSION['relevel'];
$myphone = $_SESSION['phone'];
$user_name = $_SESSION['user_name'];

if ($myrank == '1') $urankname = "一般用户" ;
if ($myrank == '2') $urankname = '<font color="#0000FF">麦啦会员</font>' ;
if ($myrank == '4') {
    $urankname = "一般" ;
    if ($mybuss == '1') $bussrankname = '<font color="#088A08">☆' ;
    if ($mybuss == '2') $bussrankname = '<font color="#FFBF00">☆☆' ;
    if ($mybuss == '3') $bussrankname = '<font color="#DF013A">☆☆☆' ;
    $urankname = $bussrankname."合伙人</font>" ;
}
if ($mybranch=='1') $urankname = $urankname.'<font color="#FF6600">---机构</font>'  ;
$maxdai = 1000;

$smarty->assign('user_rank', $myrank);        //用户等级
$smarty->assign('buss_rank', $mybuss);        //用户等级
$smarty->assign('urankname', $urankname);        //用户等级

/* 如果是显示页面，对页面进行相应赋值 */
if (in_array($action, $ui_arr)) {
    assign_template();
    $position = assign_ur_here(0, $_LANG['user_center']);
    $smarty->assign('page_title', $position['title']); // 页面标题
    $smarty->assign('ur_here', $position['ur_here']);
    $sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE id = 419";
    $row = $db->getRow($sql);
    $car_off = $row['value'];
    $smarty->assign('car_off', $car_off);
    /* 是否显示积分兑换 */
    if (!empty($_CFG['points_rule']) && unserialize($_CFG['points_rule'])) {
        $smarty->assign('show_transform_points', 1);
    }
    $smarty->assign('helps', get_shop_help());        // 网店帮助
    $smarty->assign('data_dir', DATA_DIR);   // 数据目录
    $smarty->assign('action', $action);
    $smarty->assign('lang', $_LANG);
}

//用户中心欢迎页
if ($action == 'default') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $smarty->assign('rank_name', sprintf($_LANG['your_level'], $urankname));
    
    $user_info = get_user_default($user_id);
    //$user_info=gc_getuserinfo($user_id);
    // var_dump($user_info);

    $u_name = $user_info['username'];
    //var_dump($u_name);
    $tel = explode("(", $u_name);
    $tel = substr($tel[1], 0, 11);


    if ($user_info['reg_phone'] == 0) {
        $telvali = "未验证";
    } else {
        $telvali = "已验证";
    }
    if ($user_info['is_validate'] == 0) {
        $mailvali = "未验证";
    } else {
        $mailvali = "已验证";
    }
    if ($user_info['reg_name'] == 0) {
        $namevali = "未验证";
    } else {
        $namevali = "已验证";
    }
    $gpos=gc_gpos_inq($user_id) ;
    if ($gpos==null || $gpos['user_id'] === 0) {
        $smarty->assign('gposstatus', '8');
    } else {
        $smarty->assign('gposstatus', $gpos['status']);
//        print_r($gpos['status']) ;
        if ($gpos['status'] === '9') {
            $smarty->assign('posno', $gpos['posno']);
        }
    }

    $gp = gc_usershares($user_id)  ;
    $smarty->assign('sharesnum', $gp['sharesnum']);
    $smarty->assign('unitprice', $gp['unitprice']);
    $smarty->assign('curprice', $gp['curprice']);
    $smarty->assign('sharesamt', $gp['curprice']*$gp['sharesnum']);
    
    $smarty->assign('info', $user_info);
    $smarty->assign('telvali', $telvali);
    $smarty->assign('mailvali', $mailvali);
    $smarty->assign('namevali', $namevali);
    $smarty->assign('tel', $tel);
    $smarty->assign('user_notice', $_CFG['user_notice']);
    $smarty->assign('prompt', get_user_prompt($user_id));
    $smarty->display('user_clips.dwt');
}

/* 显示会员注册界面 */
if ($action == 'register') {
    if ((!isset($back_act) || empty($back_act)) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
        $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
    }

    $recode = '';

    /* 验证码相关设置 */
    if ((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0) {
        $smarty->assign('enabled_captcha', 1);
        $smarty->assign('rand', mt_rand());
    }

    /* 密码提示问题 */
    $smarty->assign('recode', $recode);
    /* 增加是否关闭注册 */
    $smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);
    $smarty->assign('back_act', $back_act);
    $smarty->display('user_passport.dwt');
} /* 注册会员的处理 */
elseif ($action == 'act_register') {
    /* 增加是否关闭注册 */


    if ($_CFG['shop_reg_closed']) {
        $smarty->assign('action', 'register');
        $smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);
        $smarty->display('user_passport.dwt');
    } else {
        include_once(ROOT_PATH . 'includes/lib_passport.php');

        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $smscode = isset($_POST['smscode']) ? trim($_POST['smscode']) : '';
        $username = isset($_POST['userrname']) ? trim($_POST['userrname']) : $phone;
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $pidno = isset($_POST['pidno']) ? trim($_POST['pidno']) : '';
        $recode = isset($_POST['recode']) ? trim($_POST['recode']) : '';

        $back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';

        //var_dump($phone);
        // var_dump($smscode);
        if (strlen($smscode) != 6) {
            show_message($_LANG['passport_js']['sms_error']);
        }

        if (empty($_POST['agreement'])) {
            show_message($_LANG['passport_js']['agreement']);
        }

        if (empty($_POST['smscode'])) {
            show_message($_LANG['passport_js']['sms_empty']);
        }
/*
        if (strlen($username) < 3) {
            show_message($_LANG['passport_js']['username_shorter']);
        }
*/
        if (strlen($password) < 6) {
            show_message($_LANG['passport_js']['password_shorter']);
        }

        if (strpos($password, ' ') > 0) {
            show_message($_LANG['passwd_balnk']);
        }

        /* 验证码检查 */
        if ((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0) {
            if (empty($_POST['captcha'])) {
                show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'user.php?act=register', 'error');
            }

            /* 检查验证码 */
            include_once('includes/cls_captcha.php');

            $validator = new captcha();
            if (!$validator->check_word($_POST['captcha'])) {
                show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'user.php?act=register', 'error');
            }
        }
//print_r("register") ;

        if (register($phone, $pidno, $smscode, $password, $username, $email, $recode) !== false) {
//print_r("ok") ;

            /* 判断是否需要自动发送注册邮、件*/
            if ($GLOBALS['_CFG']['member_email_validate'] && $GLOBALS['_CFG']['send_verify_email']) {
                send_regiter_hash($_SESSION['user_id']);
            }
            $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
            show_message(sprintf($_LANG['register_success'], $username . $ucdata), array($_LANG['back_up_page'], $_LANG['profile_lnk']), array($back_act, 'user.php'), 'info');
        } else {
            print_r("error");
            $err->show($_LANG['sign_up'], 'user.php?act=register');
        }
    }
} /* 内部注册会员的处理 */
elseif ($action == 'act_register_in') {

    /* 增加是否关闭注册 */
    if ($_CFG['shop_reg_closed']) {
        $smarty->assign('action', 'in_register');
        $smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);
        $smarty->display('user_clips.dwt');
    } else {
        include_once(ROOT_PATH . 'includes/lib_passport.php');

        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

        $username = isset($_POST['userrname']) ? trim($_POST['userrname']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $pidno = isset($_POST['pidno']) ? trim($_POST['pidno']) : '';
        $recode = $_SESSION['phone'];

        $back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';

        if (strlen($phone) != 11) {
            show_message($_LANG['passport_js']['username_tellen']);
        }

        if (strlen($password) < 6) {
            show_message($_LANG['passport_js']['password_shorter']);
        }

        if (strpos($password, ' ') > 0) {
            show_message($_LANG['passwd_balnk']);
        }

        /* 验证码检查 */
        if ((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0) {
            if (empty($_POST['captcha'])) {
                show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'user.php?act=register', 'error');
            }

            /* 检查验证码 */
            include_once('includes/cls_captcha.php');

            $validator = new captcha();
            if (!$validator->check_word($_POST['captcha'])) {
                show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'user.php?act=register', 'error');
            }
        }

        if (registerin($phone, $pidno, $password, $username, $email, $recode) !== false) {
            /* 判断是否需要自动发送注册邮件 *
            if ($GLOBALS['_CFG']['member_email_validate'] && $GLOBALS['_CFG']['send_verify_email'])
            {
                send_regiter_hash($reguid);
            }
            */
            $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
            $msg = '';
            show_message($_LANG['add_newmem_success'], $_LANG['add_newmem_lnk'], 'user.php?act=in_register', 'info');

        } else {
            $err->show($_LANG['sign_up'], 'user.php?act=in_register');
        }
    }
} /* 验证用户注册邮件 */
elseif ($action == 'validate_email') {
    $hash = empty($_GET['hash']) ? '' : trim($_GET['hash']);
    if ($hash) {
        include_once(ROOT_PATH . 'includes/lib_passport.php');
        $id = register_hash('decode', $hash);
        if ($id > 0) {
            $sql = "UPDATE " . $ecs->table('users') . " SET is_validated = 1 WHERE user_id='$id'";
            $db->query($sql);
            $sql = 'SELECT user_name, email FROM ' . $ecs->table('users') . " WHERE user_id = '$id'";
            $row = $db->getRow($sql);
            show_message(sprintf($_LANG['validate_ok'], $row['user_name'], $row['email']), $_LANG['profile_lnk'], 'user.php');
        }
    }
    show_message($_LANG['validate_fail']);
} /* 验证用户注册用户名是否可以注册 */
elseif ($action == 'is_registered') {
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    $phone = trim($_GET['phone']);
    //	gc_writelog("\r\n phone=".$phone."  user_id=".$row["user_id"]);
    gc_writelog("\r\tphone=" . $phone . "|" . "  user_id=" . $row["user_id"]);

    if ($phone == null) {
        return 'false';
    }

    $row = gc_checkuser($phone);

    if ($row["user_id"] === 0 || $row["reid"] === 0 || $row["recode"] == null) {
        echo 'true';
    } else {

        echo 'false';
    }

} 
elseif ($action == 'get_user_name') {
    $user_phone = trim($_GET['phone']);
    if ($user_phone === $myphone) {
        echo 'false';
    } else {
        $reuser = gc_checkuser($user_phone) ;
        if ($reuser['user_id'] == 0) {
            echo 'false';
        } else {
            echo $reuser['user_name'] ;
        }
    }
}/* 验证用户邮箱地址是否被注册 */
elseif ($action == 'check_email') {
    $email = trim($_GET['email']);
    if ($user->check_email($email)) {
        echo 'false';
    } else {
        echo 'ok';
    }
} /* 验证推荐人是否存在 */
elseif ($action == 'check_recode') {
    $email = trim($_GET['email']);

    gc_writelog("recode=" . $email);

    if ($user->check_recode($email)) {
        echo 'false';
    } else {
        echo 'ok';
    }
} /* 用户登录界面 */
elseif ($action == 'login') {
    if (empty($back_act)) {
        if (empty($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
            $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
        } else {
            $back_act = 'user.php';
        }
    }


    $captcha = intval($_CFG['captcha']);
    if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && $_SESSION['login_fail'] > 2)) && gd_version() > 0) {
        $GLOBALS['smarty']->assign('enabled_captcha', 1);
        $GLOBALS['smarty']->assign('rand', mt_rand());
    }

    $smarty->assign('back_act', $back_act);
    $smarty->display('user_passport.dwt');
} /* 处理会员的登录 */
elseif ($action == 'act_login') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';




    $captcha = intval($_CFG['captcha']);
    if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && $_SESSION['login_fail'] > 2)) && gd_version() > 0) {
        if (empty($_POST['captcha'])) {
            show_message($_LANG['invalid_captcha'], $_LANG['relogin_lnk'], 'user.php', 'error');
        }

        /* 检查验证码 */
        include_once('includes/cls_captcha.php');

        $validator = new captcha();
        $validator->session_word = 'captcha_login';
        if (!$validator->check_word($_POST['captcha'])) {
            show_message($_LANG['invalid_captcha'], $_LANG['relogin_lnk'], 'user.php', 'error');
        }
    }


    // cvbnm,,/vgbbbvar_dump($user->login($username,$password));
    if ($user->login($username, $password, isset($_POST['remember']))) {
        update_user_info();
        recalculate_price();

        $ucdata = isset($user->ucdata) ? $user->ucdata : '';
        show_message($_LANG['login_success'] . $ucdata, array($_LANG['back_up_page'], $_LANG['profile_lnk']), array($back_act, 'user.php'), 'info');
    } else {
       // $_SESSION['login_fail']++;
        show_message($_LANG['login_failure'], $_LANG['relogin_lnk'], 'user.php', 'error');
    }
} /* 处理 ajax 的登录请求 */
elseif ($action == 'signin') {
    include_once('includes/cls_json.php');
    $json = new JSON;

    $username = !empty($_POST['username']) ? json_str_iconv(trim($_POST['username'])) : '';
    $password = !empty($_POST['password']) ? trim($_POST['password']) : '';
    $captcha = !empty($_POST['captcha']) ? json_str_iconv(trim($_POST['captcha'])) : '';
    $result = array('error' => 0, 'content' => '');

    $captcha = intval($_CFG['captcha']);
    if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && $_SESSION['login_fail'] > 2)) && gd_version() > 0) {
        if (empty($captcha)) {
            $result['error'] = 1;
            $result['content'] = $_LANG['invalid_captcha'];
            die($json->encode($result));
        }

        /* 检查验证码 */
        include_once('includes/cls_captcha.php');

        $validator = new captcha();
        $validator->session_word = 'captcha_login';
        if (!$validator->check_word($_POST['captcha'])) {

            $result['error'] = 1;
            $result['content'] = $_LANG['invalid_captcha'];
            die($json->encode($result));
        }
    }

    if ($user->login($username, $password)) {
        //       update_user_info();  //更新用户信息
        recalculate_price(); // 重新计算购物车中的商品价格
        $smarty->assign('user_info', get_user_info());
        $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
        $result['ucdata'] = $ucdata;
        $result['content'] = $smarty->fetch('library/member_info.lbi');
    } else {
        $_SESSION['login_fail']++;
        if ($_SESSION['login_fail'] > 2) {
            $smarty->assign('enabled_captcha', 1);
            $result['html'] = $smarty->fetch('library/member_info.lbi');
        }
        $result['error'] = 1;
        $result['content'] = $_LANG['login_failure'];
    }
    die($json->encode($result));
} /* 退出会员中心 */
elseif ($action == 'logout') {
    if ((!isset($back_act) || empty($back_act)) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
        $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
    }

    $user->logout();
    $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
    show_message($_LANG['logout'] . $ucdata, array($_LANG['back_up_page'], $_LANG['back_home_lnk']), array($back_act, 'index.php'), 'info');
} /* 个人资料页面 */
elseif ($action == 'profile') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');



   /*

    $sql="SELECT bankid,bankname FROM  `d_paybankinfo` GROUP BY bankname";

    $sql1="SELECT provinceid, provincename FROM  `d_paybankinfo` GROUP BY provincename";




    $bank = $db->getAll($sql);
   $province=$db->getAll($sql1);




      $bankinfo=$bank;
  */
  //  var_dump($province);


    $user_info = get_profile($user_id);
//获取用户信息
    $res_info = gc_getuserinfo($user_id);
    //var_dump($res_info);
    $idcard = $res_info['pidno'];
    $birthday = $res_info['birthday'];
    $phone = $res_info['phone'];

    $alias = $res_info['alias'];

    $qq_number = $res_info['qq'];

    $bir_year = substr($birthday, 0, 4);
    $bir_mon = substr($birthday, 4, 2);
    $bir_day = substr($birthday, 6, 2);
    $birthday = $bir_year . '-' . $bir_mon . '-' . $bir_day;


    //var_dump($res_info);
    // var_dump($user_info);
    //var_dump($_SESSION);
    // $user_id=$_SESSION['user_id'];
    $user_info_get = get_user_default($user_id);
    //var_dump($user_info_get);

    // var_dump($_SESSION);

    $reg_phone = $user_info_get['reg_phone'];
    $reg_mail = $user_info_get['reg_mail'];
    $reg_name = $user_info_get['reg_name'];


    /*
        if($user_info_get['reg_phone']==0){
            $telvali="未验证";
        }else{
            $telvali="已验证";
        }
        if($user_info_get['is_validate']==0){
            $mailvali="未验证";
        }else{
            $mailvali="已验证";
        }
        if($user_info_get['reg_name']==0){
            $namevali="未验证";
        }else{
            $namevali="已验证";
        }
    */
    //var_dump($namevali);

    // $phone=$_SESSION['phone'];
    $user_name = $res_info['user_name'];

    //  var_dump($user_name);
    //$phone=$_SESSION['phone'];

    $smarty->assign('telvali', $telvali);
    $smarty->assign('mailvali', $mailvali);
    $smarty->assign('namevali', $namevali);

    $smarty->assign('reg_phone', $reg_phone);
    $smarty->assign('reg_mail', $reg_mail);
    $smarty->assign('reg_name', $reg_name);


    $smarty->assign('idcard', $idcard);
    // $birthday='1989-07-24';
    $smarty->assign('birthday', $birthday);
    $smarty->assign('qq_number', $qq_number);
    $smarty->assign('alias', $alias);


    $smarty->assign('profile', $user_info);
    $smarty->assign('username', $user_name);
    $smarty->assign("phone", $phone);
    $smarty->assign("bankinfo",$bankinfo);
    $smarty->assign("province",$province);
    $smarty->display('user_transaction.dwt');
} /* 修改个人资料的处理 */
elseif ($action == 'act_edit_profile') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');


    if ($_POST['birthdayMonth'] < 10) {

        $_POST['birthdayMonth'] = '0' . $_POST['birthdayMonth'];
    }


    $birthday = trim($_POST['birthdayYear']) . $_POST['birthdayMonth'] . trim($_POST['birthdayDay']);
    $email = trim($_POST['email']);
    $idcard = trim($_POST['idcard']);
    $user_name = trim($_POST['user_name']);
    // var_dump($user_name);
    $phone = trim($_POST['phone']);
    $sex = trim($_POST['sex']);

    $qq_number = trim($_POST['qq_number']);

    $alias = trim($_POST['alias']);


    // $other['msn'] = $msn = isset($_POST['extend_field1']) ? trim($_POST['extend_field1']) : '';
    // $other['qq'] = $qq = isset($_POST['extend_field2']) ? trim($_POST['extend_field2']) : '';
    //  $other['office_phone'] = $office_phone = isset($_POST['extend_field3']) ? trim($_POST['extend_field3']) : '';
    // $other['home_phone'] = $home_phone = isset($_POST['extend_field4']) ? trim($_POST['extend_field4']) : '';
    //  $other['mobile_phone'] = $mobile_phone = isset($_POST['extend_field5']) ? trim($_POST['extend_field5']) : '';
    // $sel_question = empty($_POST['sel_question']) ? '' : compile_str($_POST['sel_question']);
    // $passwd_answer = isset($_POST['passwd_answer']) ? compile_str(trim($_POST['passwd_answer'])) : '';

    /* 更新用户扩展字段的数据 */
    //   $sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id';   //读出所有扩展字段的id
    //$fields_arr = $db->getAll($sql);
    if (empty($user_name)) {

        show_message($_LANG['passport_js']['user_name_error']);

    }
    if (!empty($phone) && !preg_match('/1[3458]{1}\d{9}$/', $phone)) {

        show_message($_LANG['passport_js']['mobile_phone_invalid']);

    }

    if (!empty($idcard) && !preg_match("/^(\d{18,18}|\d{15,15}|\d{17,17}x)$/", $idcard)) {

        show_message($_LANG['passport_js']['idcard_invalid']);


    }

    if (!empty($alias)) {
        if (!preg_match("/^\w{1,20}$/", $alias)) {


            show_message($_LANG['passport_js']['alias_invalid']);
        }


    }


    if (!empty($qq_number)) {
        if (!preg_match("/^\d{5,10}$/", $qq_number)) {
            show_message($_LANG['passport_js']['qq_invalid']);
        }
    }


    $res = gc_updateuserinfo($user_id, $user_name, $idcard, $sex, $phone, $birthday, $qq_number, $alias);
    //var_dump($res);

    if ($res['resp_code'] === 0) {
        show_message($_LANG['edit_profile_success'], $_LANG['profile_lnk'], 'user.php?act=profile', 'info');

        $_SESSION['user_name'] = $res['user']['user_name'];


    } else {

        $msg = $_LANG['edit_profile_failed'];
        show_message($msg, '', '', 'info');

    }


    /*
        if (!empty($office_phone) && !preg_match( '/^[\d|\_|\-|\s]+$/', $office_phone ) )
        {
           // show_message($_LANG['passport_js']['office_phone_invalid']);
        }
        if (!empty($home_phone) && !preg_match( '/^[\d|\_|\-|\s]+$/', $home_phone) )
        {
           //  show_message($_LANG['passport_js']['home_phone_invalid']);
        }
        if (!is_email($email))
        {
            show_message($_LANG['msg_email_format']);
        }
        if (!empty($msn) && !is_email($msn))
        {
            // show_message($_LANG['passport_js']['msn_invalid']);
        }
        if (!empty($qq) && !preg_match('/^\d+$/', $qq))
        {
             //show_message($_LANG['passport_js']['qq_invalid']);
        }
        if (!empty($mobile_phone) && !preg_match('/^[\d-\s]+$/', $mobile_phone))
        {
           // show_message($_LANG['passport_js']['mobile_phone_invalid']);
        }




        $profile  = array(
            'user_id'  => $user_id,
            'email'    => isset($_POST['email']) ? trim($_POST['email']) : '',
            'sex'      => isset($_POST['sex'])   ? intval($_POST['sex']) : 0,
            'birthday' => $birthday,
            'other'    => isset($other) ? $other : array()
            );


        if (edit_profile($profile))
        {
            show_message($_LANG['edit_profile_success'], $_LANG['profile_lnk'], 'user.php?act=profile', 'info');
        }
        else
        {
            if ($user->error == ERR_EMAIL_EXISTS)
            {
                $msg = sprintf($_LANG['email_exist'], $profile['email']);
            }
            else
            {
                $msg = $_LANG['edit_profile_failed'];
            }
            show_message($msg, '', '', 'info');
        }
    */
} /* 密码找回-->修改密码界面 */
elseif ($action == 'get_password') {
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    if (isset($_GET['code']) && isset($_GET['uid'])) //从邮件处获得的act
    {
        $code = trim($_GET['code']);
        $uid = intval($_GET['uid']);

        /* 判断链接的合法性 */
        $user_info = $user->get_profile_by_id($uid);
        if (empty($user_info) || ($user_info && md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']) != $code)) {
            show_message($_LANG['parm_error'], $_LANG['back_home_lnk'], './', 'info');
        }

        $smarty->assign('uid', $uid);
        $smarty->assign('code', $code);
        $smarty->assign('action', 'reset_password');
        $smarty->display('user_passport.dwt');
    } else {
        //显示用户名和email表单
        $smarty->display('user_passport.dwt');
    }
} /* 密码找回-->输入用户名界面 */
elseif ($action == 'qpassword_name') {
    //显示输入要找回密码的账号表单
    $smarty->display('user_passport.dwt');
} /* 密码找回-->根据注册用户名取得密码提示问题界面 */
elseif ($action == 'get_passwd_question') {
    if (empty($_POST['user_name'])) {
        show_message($_LANG['no_passwd_question'], $_LANG['back_home_lnk'], './', 'info');
    } else {
        $user_name = trim($_POST['user_name']);
    }

    //取出会员密码问题和答案
    $sql = 'SELECT user_id, user_name, passwd_question, passwd_answer FROM ' . $ecs->table('users') . " WHERE user_name = '" . $user_name . "'";
    $user_question_arr = $db->getRow($sql);

    //如果没有设置密码问题，给出错误提示
    if (empty($user_question_arr['passwd_answer'])) {
        show_message($_LANG['no_passwd_question'], $_LANG['back_home_lnk'], './', 'info');
    }

    $_SESSION['temp_user'] = $user_question_arr['user_id'];  //设置临时用户，不具有有效身份
    $_SESSION['temp_user_name'] = $user_question_arr['user_name'];  //设置临时用户，不具有有效身份
    $_SESSION['passwd_answer'] = $user_question_arr['passwd_answer'];   //存储密码问题答案，减少一次数据库访问

    $captcha = intval($_CFG['captcha']);
    if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && $_SESSION['login_fail'] > 2)) && gd_version() > 0) {
        $GLOBALS['smarty']->assign('enabled_captcha', 1);
        $GLOBALS['smarty']->assign('rand', mt_rand());
    }

    $smarty->assign('passwd_question', $_LANG['passwd_questions'][$user_question_arr['passwd_question']]);
    $smarty->display('user_passport.dwt');
} /* 密码找回-->根据提交的密码答案进行相应处理 */
elseif ($action == 'check_answer') {
    $captcha = intval($_CFG['captcha']);
    if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && $_SESSION['login_fail'] > 2)) && gd_version() > 0) {
        if (empty($_POST['captcha'])) {
            show_message($_LANG['invalid_captcha'], $_LANG['back_retry_answer'], 'user.php?act=qpassword_name', 'error');
        }

        /* 检查验证码 */
        include_once('includes/cls_captcha.php');

        $validator = new captcha();
        $validator->session_word = 'captcha_login';
        if (!$validator->check_word($_POST['captcha'])) {
            show_message($_LANG['invalid_captcha'], $_LANG['back_retry_answer'], 'user.php?act=qpassword_name', 'error');
        }
    }

    if (empty($_POST['passwd_answer']) || $_POST['passwd_answer'] != $_SESSION['passwd_answer']) {
        show_message($_LANG['wrong_passwd_answer'], $_LANG['back_retry_answer'], 'user.php?act=qpassword_name', 'info');
    } else {
        $_SESSION['user_id'] = $_SESSION['temp_user'];
        $_SESSION['user_name'] = $_SESSION['temp_user_name'];
        unset($_SESSION['temp_user']);
        unset($_SESSION['temp_user_name']);
        $smarty->assign('uid', $_SESSION['user_id']);
        $smarty->assign('action', 'reset_password');
        $smarty->display('user_passport.dwt');
    }
} /* 发送密码修改确认邮件 */
elseif ($action == 'send_pwd_email') {
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    /* 初始化会员用户名和邮件地址 */
    $user_name = !empty($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $email = !empty($_POST['email']) ? trim($_POST['email']) : '';

    //用户名和邮件地址是否匹配
    $user_info = $user->get_user_info($user_name);

    if ($user_info && $user_info['email'] == $email) {
        //生成code
        //$code = md5($user_info[0] . $user_info[1]);

        $code = md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']);
        //发送邮件的函数
        if (send_pwd_email($user_info['user_id'], $user_name, $email, $code)) {
            show_message($_LANG['send_success'] . $email, $_LANG['back_home_lnk'], './', 'info');
        } else {
            //发送邮件出错
            show_message($_LANG['fail_send_password'], $_LANG['back_page_up'], './', 'info');
        }
    } else {
        //用户名与邮件地址不匹配
        show_message($_LANG['username_no_email'], $_LANG['back_page_up'], '', 'info');
    }
} /* 重置新密码 */
elseif ($action == 'reset_password') {
    //显示重置密码的表单
    $smarty->display('user_passport.dwt');
} /* 修改会员密码 */
elseif ($action == 'act_edit_password') {
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    $old_password = isset($_POST['old_password']) ? trim($_POST['old_password']) : null;
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    $user_id = isset($_POST['uid']) ? intval($_POST['uid']) : $user_id;
    $code = isset($_POST['code']) ? trim($_POST['code']) : '';

    if (strlen($new_password) < 6) {
        show_message($_LANG['passport_js']['password_shorter']);
    }

    if (strlen($confirm_password) < 6) {
        show_message($_LANG['passport_js']['password_shorter']);

    }


    //  $user_info = $user->get_profile_by_id($user_id); //论坛记录
    /*
       if (($user_info && (!empty($code) && md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']) == $code)) || ($_SESSION['user_id']>0 && $_SESSION['user_id'] == $user_id && $user->check_user($_SESSION['user_name'], $old_password)))
       {

           if ($user->edit_user(array('username'=> (empty($code) ? $_SESSION['user_name'] : $user_info['user_name']), 'old_password'=>$old_password, 'password'=>$new_password), empty($code) ? 0 : 1)) {
               */


    $phone = $_SESSION['phone'];

    //var_dump($user_id);
    $new_password = md5($new_password);
    $old_password = md5($old_password);
    $res = gc_changepwd($phone, $old_password, $new_password);


    if ($res[resp_code] === 0) {
        $user->logout();
        show_message($_LANG['edit_password_success'], $_LANG['relogin_lnk'], 'user.php?act=login', 'info');
    } else {
        show_message($_LANG['process_false'], $_LANG['back_page_up'], '', 'info');


    }

} /* 添加一个红包 */
elseif ($action == 'act_add_bonus') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $bouns_sn = isset($_POST['bonus_sn']) ? intval($_POST['bonus_sn']) : '';

    if (add_bonus($user_id, $bouns_sn)) {
        show_message($_LANG['add_bonus_sucess'], $_LANG['back_up_page'], 'user.php?act=bonus', 'info');
    } else {
        $err->show($_LANG['back_up_page'], 'user.php?act=bonus');
    }
} /* 查看订单列表 */
elseif ($action == 'order_list') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $record_count = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('order_info') . " WHERE user_id = '$user_id'");

    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    $orders = get_user_orders($user_id, $pager['size'], $pager['start']);
    $merge = get_user_merge($user_id);

    $smarty->assign('merge', $merge);
    $smarty->assign('pager', $pager);
    $smarty->assign('orders', $orders);
    $smarty->display('user_transaction.dwt');
} /* 查看订单详情 */
elseif ($action == 'order_detail') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

    /* 订单详情 */
    $order = get_order_detail($order_id, $user_id);

    if ($order === false) {
        $err->show($_LANG['back_home_lnk'], './');

        exit;
    }

    /* 是否显示添加到购物车 */
    if ($order['extension_code'] != 'group_buy' && $order['extension_code'] != 'exchange_goods') {
        $smarty->assign('allow_to_cart', 1);
    }

    /* 订单商品 */
    $goods_list = order_goods($order_id);
    foreach ($goods_list AS $key => $value) {
        $goods_list[$key]['market_price'] = price_format($value['market_price'], false);
        $goods_list[$key]['goods_price'] = price_format($value['goods_price'], false);
        $goods_list[$key]['subtotal'] = price_format($value['subtotal'], false);
    }

    /* 设置能否修改使用余额数 */
     //$user = user_info($order['user_id']);
     //var_dump($user);
     //var_dump($order['order_status']);
    if ($order['order_amount'] > 0) {
        if ($order['order_status'] == OS_UNCONFIRMED || $order['order_status'] == OS_CONFIRMED) {
            $user = user_info($order['user_id']);
           /* if ($user['user_money'] + $user['credit_line'] >= 0) {*/
              
            if ($user['pay_points'] + $user['credit_line'] >= 0) {
                $smarty->assign('allow_edit_surplus', 1);
              //  $smarty->assign('max_surplus', sprintf($_LANG['max_surplus'], $user['user_money']));
              $smarty->assign('max_surplus', sprintf($_LANG['max_surplus'], $user['pay_points']));
              
            }
        }
    }

    /* 未发货，未付款时允许更换支付方式 */
    if ($order['order_amount'] > 0 && $order['pay_status'] == PS_UNPAYED && $order['shipping_status'] == SS_UNSHIPPED) {
        $payment_list = available_payment_list(false, 0, true);

        /* 过滤掉当前支付方式和余额支付方式 */
        if (is_array($payment_list)) {
            foreach ($payment_list as $key => $payment) {
                if ($payment['pay_id'] == $order['pay_id'] || $payment['pay_code'] == 'balance') {
                    unset($payment_list[$key]);
                }
            }
        }
        $smarty->assign('payment_list', $payment_list);
    }

    /* 订单 支付 配送 状态语言项 */
    $order['order_status'] = $_LANG['os'][$order['order_status']];
    $order['pay_status'] = $_LANG['ps'][$order['pay_status']];
    $order['shipping_status'] = $_LANG['ss'][$order['shipping_status']];

    $smarty->assign('order', $order);
    $smarty->assign('goods_list', $goods_list);
    $smarty->display('user_transaction.dwt');
} /* 取消订单 */
elseif ($action == 'cancel_order') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

    if (cancel_order($order_id, $user_id)) {
        ecs_header("Location: user.php?act=order_list\n");
        exit;
    } else {
        $err->show($_LANG['order_list_lnk'], 'user.php?act=order_list');
    }
} /* 收货地址列表界面*/
elseif ($action == 'address_list') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/shopping_flow.php');
    $smarty->assign('lang', $_LANG);

    /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
    $smarty->assign('country_list', get_regions());
    $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));

    /* 获得用户所有的收货人信息 */
    $consignee_list = get_consignee_list($_SESSION['user_id']);

    if (count($consignee_list) < 5 && $_SESSION['user_id'] > 0) {
        /* 如果用户收货人信息的总数小于5 则增加一个新的收货人信息 */
        $consignee_list[] = array('country' => $_CFG['shop_country'], 'email' => isset($_SESSION['email']) ? $_SESSION['email'] : '');
    }

    $smarty->assign('consignee_list', $consignee_list);

    //取得国家列表，如果有收货人列表，取得省市区列表
    foreach ($consignee_list AS $region_id => $consignee) {
        $consignee['country'] = isset($consignee['country']) ? intval($consignee['country']) : 0;
        $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
        $consignee['city'] = isset($consignee['city']) ? intval($consignee['city']) : 0;

        $province_list[$region_id] = get_regions(1, $consignee['country']);
        $city_list[$region_id] = get_regions(2, $consignee['province']);
        $district_list[$region_id] = get_regions(3, $consignee['city']);
    }

    /* 获取默认收货ID */
    $address_id = get_address_id($user_id);

    //赋值于模板
    $smarty->assign('real_goods_count', 1);
    $smarty->assign('shop_country', $_CFG['shop_country']);
    $smarty->assign('shop_province', get_regions(1, $_CFG['shop_country']));
    $smarty->assign('province_list', $province_list);
    $smarty->assign('address', $address_id);
    $smarty->assign('city_list', $city_list);
    $smarty->assign('district_list', $district_list);
    $smarty->assign('currency_format', $_CFG['currency_format']);
    $smarty->assign('integral_scale', $_CFG['integral_scale']);
    $smarty->assign('name_of_region', array($_CFG['name_of_region_1'], $_CFG['name_of_region_2'], $_CFG['name_of_region_3'], $_CFG['name_of_region_4']));

    $smarty->display('user_transaction.dwt');
} /* 添加/编辑收货地址的处理 */
elseif ($action == 'act_edit_address') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/shopping_flow.php');
    $smarty->assign('lang', $_LANG);

    $address = array(
        'user_id' => $user_id,
        'address_id' => intval($_POST['address_id']),
        'country' => isset($_POST['country']) ? intval($_POST['country']) : 0,
        'province' => isset($_POST['province']) ? intval($_POST['province']) : 0,
        'city' => isset($_POST['city']) ? intval($_POST['city']) : 0,
        'district' => isset($_POST['district']) ? intval($_POST['district']) : 0,
        'address' => isset($_POST['address']) ? compile_str(trim($_POST['address'])) : '',
        'consignee' => isset($_POST['consignee']) ? compile_str(trim($_POST['consignee'])) : '',
        'email' => isset($_POST['email']) ? compile_str(trim($_POST['email'])) : '',
        'tel' => isset($_POST['tel']) ? compile_str(make_semiangle(trim($_POST['tel']))) : '',
        'mobile' => isset($_POST['mobile']) ? compile_str(make_semiangle(trim($_POST['mobile']))) : '',
        'best_time' => isset($_POST['best_time']) ? compile_str(trim($_POST['best_time'])) : '',
        'sign_building' => isset($_POST['sign_building']) ? compile_str(trim($_POST['sign_building'])) : '',
        'activity' => '0',
        'zipcode' => isset($_POST['zipcode']) ? compile_str(make_semiangle(trim($_POST['zipcode']))) : '',
    );

    if (update_address($address)) {
        show_message($_LANG['edit_address_success'], $_LANG['address_list_lnk'], 'user.php?act=address_list');
    }
} /* 删除收货地址 */
elseif ($action == 'drop_consignee') {
    include_once('includes/lib_transaction.php');

    $consignee_id = intval($_GET['id']);

    if (drop_consignee($consignee_id)) {
        ecs_header("Location: user.php?act=address_list\n");
        exit;
    } else {
        show_message($_LANG['del_address_false']);
    }
} /* 显示收藏商品列表 */
elseif ($action == 'collection_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $record_count = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('collect_goods') .
        " WHERE user_id='$user_id' ORDER BY add_time DESC");

    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    $smarty->assign('pager', $pager);
    $smarty->assign('goods_list', get_collection_goods($user_id, $pager['size'], $pager['start']));
    $smarty->assign('url', $ecs->url());
    $lang_list = array(
        'UTF8' => $_LANG['charset']['utf8'],
        'GB2312' => $_LANG['charset']['zh_cn'],
        'BIG5' => $_LANG['charset']['zh_tw'],
    );
    $smarty->assign('lang_list', $lang_list);
    $smarty->assign('user_id', $user_id);
    $smarty->display('user_clips.dwt');
} /* 删除收藏的商品 */
elseif ($action == 'delete_collection') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $collection_id = isset($_GET['collection_id']) ? intval($_GET['collection_id']) : 0;

    if ($collection_id > 0) {
        $db->query('DELETE FROM ' . $ecs->table('collect_goods') . " WHERE rec_id='$collection_id' AND user_id ='$user_id'");
    }

    ecs_header("Location: user.php?act=collection_list\n");
    exit;
} /* 添加关注商品 */
elseif ($action == 'add_to_attention') {
    $rec_id = (int)$_GET['rec_id'];
    if ($rec_id) {
        $db->query('UPDATE ' . $ecs->table('collect_goods') . "SET is_attention = 1 WHERE rec_id='$rec_id' AND user_id ='$user_id'");
    }
    ecs_header("Location: user.php?act=collection_list\n");
    exit;
} /* 取消关注商品 */
elseif ($action == 'del_attention') {
    $rec_id = (int)$_GET['rec_id'];
    if ($rec_id) {
        $db->query('UPDATE ' . $ecs->table('collect_goods') . "SET is_attention = 0 WHERE rec_id='$rec_id' AND user_id ='$user_id'");
    }
    ecs_header("Location: user.php?act=collection_list\n");
    exit;
} /* 显示留言列表 */
elseif ($action == 'message_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $order_id = empty($_GET['order_id']) ? 0 : intval($_GET['order_id']);
    $order_info = array();

    /* 获取用户留言的数量 */
    if ($order_id) {
        $sql = "SELECT COUNT(*) FROM " . $ecs->table('feedback') .
            " WHERE parent_id = 0 AND order_id = '$order_id' AND user_id = '$user_id'";
        $order_info = $db->getRow("SELECT * FROM " . $ecs->table('order_info') . " WHERE order_id = '$order_id' AND user_id = '$user_id'");
        $order_info['url'] = 'user.php?act=order_detail&order_id=' . $order_id;
    } else {
        $sql = "SELECT COUNT(*) FROM " . $ecs->table('feedback') .
            " WHERE parent_id = 0 AND user_id = '$user_id' AND user_name = '" . $_SESSION['user_name'] . "' AND order_id=0";
    }

    $record_count = $db->getOne($sql);
    $act = array('act' => $action);

    if ($order_id != '') {
        $act['order_id'] = $order_id;
    }

    $pager = get_pager('user.php', $act, $record_count, $page, 5);

    $smarty->assign('message_list', get_message_list($user_id, $_SESSION['user_name'], $pager['size'], $pager['start'], $order_id));
    $smarty->assign('pager', $pager);
    $smarty->assign('order_info', $order_info);
    $smarty->display('user_clips.dwt');
} /* 显示评论列表 */
elseif ($action == 'comment_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户留言的数量 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('comment') .
        " WHERE parent_id = 0 AND user_id = '$user_id'";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 5);

    $smarty->assign('comment_list', get_comment_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示升级vip列表 */
elseif ($action == 'upvip') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $mpage = isset($_REQUEST['mpage']) ? intval($_REQUEST['mpage']) : 1;
    /* 获取用户留言的数量 */
    $recode_count = gc_mlgetbuycount($user_id);
    $res = gc_getmltypelistpro($user_id);
    $pager = get_pager('user.php', array('act' => $action), $recode_count, $page, 5);

    $mrecode_count = gc_matchingcount($user_id);
    $mres = gc_getmltypelistpro($user_id);
    $mpager = get_pager('user.php', array('act' => $action), $mrecode_count, $mpage, 5,$do="2");
    
    $smarty->assign('user_name', $myphone);
    $smarty->assign('urealname', $urealname);
    $smarty->assign('balance', $_SESSION['balance']);
    $smarty->assign('award_bal', $_SESSION['award_bal']);
    $smarty->assign('amount', $_SESSION['balance']+$_SESSION['award_bal']);
    $smarty->assign('mltypelist', $res);
    $smarty->assign('mltype', "N15000");
/*    
    if ($_SESSION['systemid']=="ZHMLA") {
        $smarty->assign('mltype', "ZH7500");
    } else if ($_SESSION['systemid']=="USMLA")  {
        $smarty->assign('mltype', "US7500");
    } else {
        $smarty->assign('mltype', "M7500");
    }
*/
    $smarty->assign('buyorder_list', get_buyorder_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->assign('matching_list', get_matching_list($user_id, $mpager['size'], $mpager['start']));
    $smarty->assign('mpager', $mpager);
    $smarty->display('user_clips.dwt');
} /* 显示分红明细列表 */
elseif ($action == 'upbaodan') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    /* 获取用户留言的数量 */
    $recode_count = gc_baoappcount($user_id);

    $pager = get_pager('user.php', array('act' => $action), $recode_count, $page, 5);
    
    /* 获取用户报单中心的状态 */
    $ifbao = $_SESSION['user_rank'];
    /* 获取用户成为报单中心的时间 */
    $baotime = $_SESSION['baotime'];
    $gp = gc_usershares($user_id)  ;
    $shares = '股数:'.$gp['sharesnum'].'股   平均单价:'.$gp['unitprice'].'   当前单价:'.$gp['curprice'] ;
//    if ($_SESSION['systemid'] == "ZHMLA") {
        $baomess = "购买10万元市场价货，获得合伙人资格，并赠送10万元等值股权。" ;
//    } else {
//        $baomess = "升级商户中心，缴纳5万元，享受商务中心权益。" ;
//    }
    $balance = isset($_SESSION['balance'])?$_SESSION['balance']:0;
    $award_bal = isset($_SESSION['award_bal'])?$_SESSION['award_bal']:0;
        /* 获取用户可用资金余额 */
    $user_money = $balance + $award_bal;
    $baotimes = local_date($_CFG['date_format'], $baotime);
    $smarty->assign('bd_fee', 100000);
    $smarty->assign('baomess', $baomess);
    $smarty->assign('baotime', $baotimes);
    $smarty->assign('ifbao', $ifbao);
    $smarty->assign('shares', $shares);
//    $smarty->assign('user_money', $user_money);
    $smarty->assign('balance', $balance);
    $smarty->assign('award_bal', $award_bal);
    $smarty->assign('user_money', $balance+$award_bal);
    $smarty->assign('baoapp_list', get_baoapp_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示注册新会员 */
elseif ($action == 'fhlist') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $recode_count = gc_mlfenhongcount($user_id);

    $pager = get_pager('user.php', array('act' => $action), $recode_count, $page, 5);

    $smarty->assign('fenhong_list', get_fenhong_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示我注册的列表 */
elseif ($action == 'myreg') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('users') .
        " WHERE baouid ='$user_id'   ";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 20);

    $smarty->assign('myreg_list', get_myreg_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示我推荐的会员列表 */
elseif ($action == 'myrecom') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('users') .
        " WHERE reid ='$user_id'   ";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 20);

    $smarty->assign('myrecom_list', get_myrecom_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示会员的购单列表 */
elseif ($action == 'buy_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $user_id;

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户购单的数量 */
    $record_count = gc_mlgetcount($user_id);

    $actionall = $action . '&uid=' . $theuid;
    $pager = get_pager('user.php', array('act' => $actionall), $record_count, $page, 10);

    $smarty->assign('buy_list', get_buy_list($theuid, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 显示升级保单中心 */
elseif ($action == 'in_register') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    /* 取出注册扩展字段 */
    $recode = $_SESSION['phone'];

    /* 验证码相关设置 */
    if ((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0) {
        $smarty->assign('enabled_captcha', 1);
        $smarty->assign('rand', mt_rand());
    }

    $user_rank = $_SESSION['user_rank'];
    $smarty->assign('user_rank', $user_rank);
    $smarty->assign('recode', $recode);
    /* 增加是否关闭注册 */
    $smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);

    $smarty->display('user_clips.dwt');
} /*添加身份证*/
elseif ($action == "act_add_cart") {
    //  include_once(root_path.'includes/cls_image.php');



    // var_dump($_REQUEST);
    $message = array(
        'user_id' => $_SESSION['user_id'],
        'user_name' => $_SESSION['user_name'],
        'user_email' => $_SESSION['email'],
        'banks'=>$_REQUEST["banks"],
        'bankaccount'=>$_REQUEST["bankaccount"],
        'bankname'=>$_REQUEST["bankname"],
        'upload1' => (isset($_FILES['card_img_1']['error']) && $_FILES['card_img_1']['error'] == 0) || (!isset($_FILES['card_img_1']['error']) && isset($_FILES['card_img_1']['tmp_name']) && $_FILES['card_img_1']['tmp_name'] != 'none')
            ? $_FILES['card_img_1'] : array(),
        'upload2' => (isset($_FILES['card_img_2']['error']) && $_FILES['card_img_2']['error'] == 0) || (!isset($_FILES['card_img_2']['error']) && isset($_FILES['card_img_2']['tmp_name']) && $_FILES['card_img_2']['tmp_name'] != 'none')
            ? $_FILES['card_img_2'] : array(),

        'upload3' => (isset($_FILES['yhcard_img_1']['error']) && $_FILES['yhcard_img_1']['error'] == 0) || (!isset($_FILES['yhcard_img_1']['error']) && isset($_FILES['yhcard_img_1']['tmp_name']) && $_FILES['yhcard_img_1']['tmp_name'] != 'none')
            ? $_FILES['yhcard_img_1'] : array(),
        'upload4' => (isset($_FILES['yhcard_img_2']['error']) && $_FILES['yhcard_img_2']['error'] == 0) || (!isset($_FILES['yhcard_img_2']['error']) && isset($_FILES['yhcard_img_2']['tmp_name']) && $_FILES['yhcard_img_2']['tmp_name'] != 'none')
            ? $_FILES['yhcard_img_2'] : array(),
        'upload5' => (isset($_FILES['ercard_img_1']['error']) && $_FILES['ercard_img_1']['error'] == 0) || (!isset($_FILES['ercard_img_1']['error']) && isset($_FILES['ercard_img_1']['tmp_name']) && $_FILES['ercard_img_1']['tmp_name'] != 'none')
            ? $_FILES['ercard_img_1'] : array(),

    );

    foreach ($message as $key=> $msg){
        if(empty($msg)){
            switch  ($key) {

                case  "bankaccount":
                    show_message("银行帐号为空");
                    break;
                case  "bankname";
                    show_message("支行名为空");
                    break;
                case  "upload1" :
                    show_message("身份证正面为空");
                    break;
                case  "upload2" :
                    show_message("身份证反面为空");
                    break;
                case "upload3" :
                    show_message("银行卡正面为空");
                    break;
                case "upload4" :
                    show_message("银行卡反面为空");
                    break;
                case "upload5" :
                    show_message("二合一为空");
                    break;
            }

        }


    }

    $bankno=trim($_REQUEST["bankno"]);

    $banksql="select bankname,bankbranchname from d_paybankinfo where bankbranchid=".$bankno;

    $bankinfo=$db->getAll($banksql);

    //var_dump($bankinfo);

    $realname['user_id']=$user_id;
    $realname['pidno']=trim($_REQUEST['pidno']);
    $realname['banks']=trim($bankinfo[0]['bankname']);
    $realname['bankno']=trim($_REQUEST['bankno']);
    $realname['bankaccount']=trim($_REQUEST['bankaccount']);
    $realname['bankname']=trim($bankinfo[0]['bankbranchname']);

    include_once('includes/cls_image.php');
    $filename=$user_id;
    $img = new  cls_image();
    $imgname["img1"]= $img->upload_image($message['upload1'], $dir = $filename, $img_name ='',$type="renzheng");
    $imgname["img2"]= $img->upload_image($message['upload2'], $dir = $filename, $img_name = '',$type="renzheng");
    $imgname["img3"]= $img->upload_image($message['upload3'], $dir =$filename, $img_name = '',$type="renzheng");
    $imgname["img4"]= $img->upload_image($message['upload4'], $dir = $filename, $img_name = '',$type="renzheng");
    $imgname["img5"]= $img->upload_image($message['upload5'], $dir =$filename, $img_name = '',$type="renzheng");

  // var_dump($imgname);
    foreach($imgname as $key=>$val){

        $newval=explode("/",$val);

        $realname[$key]=$newval[4]."/".$newval[5]."/".$newval[6];


    }

  // var_dump($realname);

    $result=gc_user_realname_auth($realname);


    if($result===0){

        show_message($result['resp_msg'], "用户中心", 'user.php?act=true_info');
    }else{
        show_message($result['resp_msg'], "用户中心", 'user.php?act=true_info');

    }



} /* 添加我的留言 */
elseif ($action == 'act_add_message') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $message = array(
        'user_id' => $user_id,
        'user_name' => $_SESSION['user_name'],
        'user_email' => $_SESSION['email'],
        'msg_type' => isset($_POST['msg_type']) ? intval($_POST['msg_type']) : 0,
        'msg_title' => isset($_POST['msg_title']) ? trim($_POST['msg_title']) : '',
        'msg_content' => isset($_POST['msg_content']) ? trim($_POST['msg_content']) : '',
        'order_id' => empty($_POST['order_id']) ? 0 : intval($_POST['order_id']),
        'upload' => (isset($_FILES['message_img']['error']) && $_FILES['message_img']['error'] == 0) || (!isset($_FILES['message_img']['error']) && isset($_FILES['message_img']['tmp_name']) && $_FILES['message_img']['tmp_name'] != 'none')
            ? $_FILES['message_img'] : array()
    );

    if (add_message($message)) {
        show_message($_LANG['add_message_success'], $_LANG['message_list_lnk'], 'user.php?act=message_list&order_id=' . $message['order_id'], 'info');
    } else {
        $err->show($_LANG['message_list_lnk'], 'user.php?act=message_list');
    }
} /* 添加我的购单 */
elseif ($action == 'act_add_order') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
//print_r("mltype=[".$_POST['mltype']."]") ;
    $message = array(
        'whopay' => $user_id,
        'mltype' => isset($_POST['mltype']) ? $_POST['mltype'] : "",
        'paycode' => $_SESSION['user_name'],
        'buy_num' => isset($_POST['buy_num']) ? intval($_POST['buy_num']) : 1,
        'buy_uname' => isset($_POST['buy_uname']) ? trim($_POST['buy_uname']) : '',
        'bordernum' => date('YmdHis', time())
    );
// print_r($message) ;    		
    if (add_order($message)) {
        show_message($_LANG['add_buy_success'], $_LANG['buy_list_lnk'], 'user.php?act=upvip&order_id=' . $message['bordernum'], 'info');
    } else {
        $err->show($_LANG['buy_list_lnk'], 'user.php?act=upvip');
    }
} /* 升级报单中心 */
elseif ($action == 'act_add_baodan') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $cc = array();

    $cc = gc_ml_baodan($user_id);

    if ($cc['resp_code'] == '0') {
        print_r("ok");
        show_message($_LANG['add_app_success'], $_LANG['app_list_lnk'], 'user.php?act=upbaodan&order_id=' . $message['bordernum'], 'info');
    } else {
        $GLOBALS['err']->add($cc["resp_msg"]);
        $err->show($_LANG['app_list_lnk'], 'user.php?act=upbaodan');
    }
} /* 标签云列表 */
elseif ($action == 'tag_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $good_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $smarty->assign('tags', get_user_tags($user_id));
    $smarty->assign('tags_from', 'user');
    $smarty->display('user_clips.dwt');
} /* 删除标签云的处理 */
elseif ($action == 'act_del_tag') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $tag_words = isset($_GET['tag_words']) ? trim($_GET['tag_words']) : '';
    delete_tag($tag_words, $user_id);

    ecs_header("Location: user.php?act=tag_list\n");
    exit;

} /* 显示缺货登记列表 */
elseif ($action == 'booking_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取缺货登记的数量 */
    $sql = "SELECT COUNT(*) " .
        "FROM " . $ecs->table('booking_goods') . " AS bg, " .
        $ecs->table('goods') . " AS g " .
        "WHERE bg.goods_id = g.goods_id AND user_id = '$user_id'";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    $smarty->assign('booking_list', get_booking_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager', $pager);
    $smarty->display('user_clips.dwt');
} /* 添加缺货登记页面 */
elseif ($action == 'add_booking') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $goods_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($goods_id == 0) {
        show_message($_LANG['no_goods_id'], $_LANG['back_page_up'], '', 'error');
    }
    $info = array();
    $sql  = "SELECT goods_name FROM " .$GLOBALS['ecs']->table('goods'). " WHERE goods_id = '$goods_id'";

    $info['goods_name']   = $GLOBALS['db']->getOne($sql);
    $info['goods_number'] = 1;
    $info['id']           = $goods_id;
    if($user_id>0) {
        $userinfo = gc_getuserinfo($user_id);
        $info['consignee']=$userinfo["user_name"];
     $info["email"]=$userinfo["email"];
     $info["tel"]=$userinfo["phone"];

    }
    //var_dump($info);
    /* 根据规格属性获取货品规格信息 */
    $goods_attr = '';
    if ($_GET['spec'] != '') {
        $goods_attr_id = $_GET['spec'];

        $attr_list = array();
        $sql = "SELECT a.attr_name, g.attr_value " .
            "FROM " . $ecs->table('goods_attr') . " AS g, " .
            $ecs->table('attribute') . " AS a " .
            "WHERE g.attr_id = a.attr_id " .
            "AND g.goods_attr_id " . db_create_in($goods_attr_id);
        $res = $db->query($sql);

        while ($row = $db->fetchRow($res)) {
            $attr_list[] = $row['attr_name'] . ': ' . $row['attr_value'];
        }
        $goods_attr = join(chr(13) . chr(10), $attr_list);
    }

    $smarty->assign('goods_attr', $goods_attr);

    $smarty->assign('info', $info);
    $smarty->display('user_clips.dwt');

} /* 添加缺货登记的处理 */
elseif ($action == 'act_add_booking') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $booking = array(
        'goods_id' => isset($_POST['id']) ? intval($_POST['id']) : 0,
        'goods_amount' => isset($_POST['number']) ? intval($_POST['number']) : 0,
        'desc' => isset($_POST['desc']) ? trim($_POST['desc']) : '',
        'linkman' => isset($_POST['linkman']) ? trim($_POST['linkman']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'tel' => isset($_POST['tel']) ? trim($_POST['tel']) : '',
        'booking_id' => isset($_POST['rec_id']) ? intval($_POST['rec_id']) : 0
    );

    // 查看此商品是否已经登记过
    $rec_id = get_booking_rec($user_id, $booking['goods_id']);
    if ($rec_id > 0) {
        show_message($_LANG['booking_rec_exist'], $_LANG['back_page_up'], '', 'error');
    }

    if (add_booking($booking)) {
        show_message($_LANG['booking_success'], $_LANG['back_booking_list'], 'user.php?act=booking_list',
            'info');
    } else {
        $err->show($_LANG['booking_list_lnk'], 'user.php?act=booking_list');
    }
} /* 删除缺货登记 */
elseif ($action == 'act_del_booking') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id == 0 || $user_id == 0) {
        ecs_header("Location: user.php?act=booking_list\n");
        exit;
    }

    $result = delete_booking($id, $user_id);
    if ($result) {
        ecs_header("Location: user.php?act=booking_list\n");
        exit;
    }
} /* 确认收货 */
elseif ($action == 'affirm_received') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

    if (affirm_received($order_id, $user_id)) {
        ecs_header("Location: user.php?act=order_list\n");
        exit;
    } else {
        $err->show($_LANG['order_list_lnk'], 'user.php?act=order_list');
    }
} /* 会员退款申请界面 */
elseif ($action == 'account_raply') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

	if ($_SESSION['user_rank'] < 2) {
	    $surplus_amount = 0 ;
	} else {
	    $surplus_amount = get_user_surplus($user_id);
	}
	if (empty($surplus_amount)){
		$surplus_amount = 0;
	}
	$row=gc_get_realname_auth($user_id) ;
    //var_dump($row);
    $user = $row['user'] ;
    $realnameflag = 0 ;
	if ($row == null || $user['user_id'] === 0) {
	    $realnameflag = '0' ;
	} else if ($user['status'] != '9') {
	    $realnameflag = '0' ;
	} else {
	    $realnameflag = $row['realnameflag'] ;
	}
	$smarty->assign('realnameflag', $realnameflag) ;
	$_SESSION['realnameflag'] = $realnameflag ;
	$cardlists = array() ;
    foreach($row as $key=>$val) {

      if(is_array($val)) {
          $cardlists[$key]["bankaccount"] = $row["user"]["bankaccount"];
          $cardlists[$key]["bankname"] = $row["user"]["bankname"];
      }
    }
//var_dump($cardlists);
	$smarty->assign('realnamedata', $cardlists) ;
	$smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('myrealname', $myrealname);
    $smarty->display('user_transaction.dwt');
} /* 积分转电子币申请界面 */
elseif ($action == 'account_award') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    if ($_SESSION['user_rank'] < 2) {
        $award_amount = 0 ;
    } else {
        $award_amount = get_user_award($user_id);
    }
    
    if ($_SESSION['award_flag'] == 'A') {
        $award_bl = 5;
    } else {
        $award_bl = 10;
    }

    $award_je = (100 - $award_bl) * 100;
    $smarty->assign('award_amount', price_format($award_amount, false));
    $smarty->assign('award_balance', $award_amount);
    $smarty->assign('award_bl', $award_bl);
    $smarty->assign('award_je', $award_je);
    $smarty->assign('myrealname', $myrealname);
    $smarty->display('user_transaction.dwt');
} #金币转账界面
elseif ($action == 'account_goldtransfer') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    if ($_SESSION['user_rank'] < 2) {
        $gold_amount = 0 ;
        $award_amount = 0 ;
        $surplus_amount = 0 ;
    } else {
        $gold_amount = get_user_goldamt($user_id);
        $award_amount = get_user_award($user_id);
        $surplus_amount = get_user_surplus($user_id);
    }
    $transferlist = array() ;
    $transfer['tftype'] = "balance" ;
    $transfer['tfname'] = "电子币" ;
    $transferlist[] = $transfer   ;
    $transfer['tftype'] = "award_bal" ;
    $transfer['tfname'] = "积分" ;
    $transferlist[] = $transfer   ;
    $transfer['tftype'] = "gold_amt" ;
    $transfer['tfname'] = "金币" ;
    $transferlist[] = $transfer   ;
    
    $smarty->assign('gold_amount', price_format($gold_amount, false));
    $smarty->assign('myphone', $myphone);
    $smarty->assign('transferlist', $transferlist);
    $smarty->assign('balance', $surplus_amount);
    $smarty->assign('award_bal', $award_amount);
    $smarty->assign('gold_balance', $gold_amount);
    $smarty->assign('myrealname', $myrealname);
    $smarty->display('user_transaction.dwt');
}/* 会员预付款界面充值 */
elseif ($action == 'account_deposit') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $surplus_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
//    $account    = get_surplus_info($surplus_id);

    $smarty->assign('payment', get_online_payment_list(false));
//   $smarty->assign('order',   $account);
    $smarty->display('user_transaction.dwt');
} /* 会员电子币明细界面 */
elseif ($action == 'account_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $user_id;
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $record_count = gc_getaccountcnt($theuid, "BAL");

    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    //获取余额记录
    $account_list = array();

    $res = getaccountlist($theuid, "BAL", $pager['start'], $pager['size']);
    if ($res['resp_code'] == '0') {
        $cnt = $res['cnt'];
        $surplus_amount = $res['amount'];
        $num = 0;
        while ($num < $cnt) {
            $row = $res[$num];
            $num++;
            $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
            $row['type'] = $row['user_money'] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
            $row['user_money'] = price_format(abs($row['user_money']), false);
            $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
            $row['rank_points'] = 0;
            $row['pay_points'] = abs($row['pay_points']);
            $row['short_change_desc'] = sub_str($row['change_desc'], 60);
            $row['amount'] = $row['user_money'];
            $uid = $row['user_id'];
            $row['user_realname'] = $row['user_name'];
            $account_list[] = $row;
        }
    }

    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('account_list', $account_list);
    $smarty->assign('pager', $pager);
    $smarty->assign('theuname', $myrealname);
    $smarty->display('user_transaction.dwt');
} /* 会员金币明细界面 */
elseif ($action == 'accountjf_list') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $user_id;
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $record_count = gc_getaccountcnt($theuid, "GOLD");

    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    //获取余额记录
    $account_list = array();

    $res = getaccountlist($theuid, "GOLD", $pager['start'], $pager['size']);
    if ($res['resp_code'] == '0') {
        $cnt = $res['cnt'];
        $surplus_amount = $res['amount'];
        $num = 0;
        while ($num < $cnt) {
            $row = $res[$num];
            $num++;
            $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
            $row['type'] = $row['pay_points'] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
            $row['user_money'] = price_format(abs($row['user_money']), false);
            $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
            $row['rank_points'] = 0;
            $row['pay_points'] = abs($row['pay_points']);
            $row['short_change_desc'] = sub_str($row['change_desc'], 60);
            $row['amount'] = $row['pay_points'];
            $uid = $row['user_id'];
            $row['user_realname'] = $row['user_name'];
            $account_list[] = $row;
        }
    }

    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('account_list', $account_list);
    $smarty->assign('pager', $pager);
    $smarty->assign('theuname', $theuname);
    $smarty->display('user_transaction.dwt');
} /* 会员账目明细界面 */
elseif ($action == 'account_detail') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $theuid = $user_id;

    $record_count = gc_getaccountcnt($theuid, "BAL");

    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    //获取余额记录
    $account_list = array();

    $res = gc_getaccountlist($theuid, "BAL", $pager['start'], $pager['size']);
    if ($res['resp_code'] == '0') {
        $cnt = $res['cnt'];
        $surplus_amount = $res['amount'];
        $num = 0;
        while ($num < $cnt) {
            $row = $res[$num];
            $num++;
            $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
            $row['type'] = $row['user_money'] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
            $row['user_money'] = price_format(abs($row['user_money']), false);
            $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
            $row['rank_points'] = 0;
            $row['pay_points'] = abs($row['pay_points']);
            $row['short_change_desc'] = sub_str($row['change_desc'], 60);
            $row['amount'] = $row['user_money'];
            $uid = $row['user_id'];
            $row['user_realname'] = $row['user_name'];
            $account_list[] = $row;
        }
    }


    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('account_log', $account_list);
    $smarty->assign('pager', $pager);
    $smarty->display('user_transaction.dwt');
} /* 会员积分账目明细界面 */
elseif ($action == 'account_detailjf') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $user_id;
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $account_type = 'user_money';

    $record_count = gc_getaccountcnt($theuid, "ALL");

    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);

    $account_list = array();

    $res = gc_getaccountlist($theuid, "ALL", $pager['start'], $pager['size']);
    if ($res['resp_code'] == '0') {
        $cnt = $res['cnt'];
        $surplus_amount = $res['amount'];
        $num = 0;
        while ($num < $cnt) {
            $row = $res[$num];
            $num++;
            $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
            $row['type'] = $row[$account_type] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
            $row['user_money'] = $row['user_money'];
            $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
            $row['rank_points'] = 0;
            $row['pay_points'] = $row['pay_points'];
            $row['short_change_desc'] = sub_str($row['change_desc'], 60);
            $row['amount'] = $row[$account_type];
            $uid = $row['user_id'];
            $row['user_realname'] = $row['user_name'];
            $account_list[] = $row;
        }
    }

    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('account_log', $account_list);
    $smarty->assign('pager', $pager);
    $smarty->display('user_transaction.dwt');
} /* 会员充值和提现申请记录 */
elseif ($action == 'account_log') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $_SESSION['user_id'];
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $record_count = gc_getaccountcnt($theuid, "CHK");

    //  $record_count=get_user_surplus($theuid);

    //分页函数
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    $surplus_amount = get_user_surplus($theuid);
    if (empty($surplus_amount)) {
        $surplus_amount = 20;
    }

    $account_log_1 = get_account_log($theuid, $pager['size'], $pager['start']);

    //模板赋值
    $smarty->assign('$surplus_amount', $surplus_amount);
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('account_log', $account_log_1);
    $smarty->assign('pager', $pager);
    $smarty->display('user_transaction.dwt');
} /* 对会员余额申请的处理 */
elseif ($action == 'act_account') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0) {
        show_message($_LANG['amount_gt_zero']);
    }

    /* 变量初始化 */
    $surplus = array(
        'user_id' => $user_id,
        'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0,
        'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
        'payment_id' => isset($_POST['payment_id']) ? intval($_POST['payment_id']) : 0,
        'user_note' => isset($_POST['user_note']) ? trim($_POST['user_note']) : '',
        'bankname' => isset($_POST['mybankname']) ? trim($_POST['mybankname']) : '',
        'bankaddress' => isset($_POST['mybankaddress']) ? trim($_POST['mybankaddress']) : '',
        'myname' => isset($_POST['myname']) ? trim($_POST['myname']) : '',
        'myaccount' => isset($_POST['myaccount']) ? trim($_POST['myaccount']) : '',
        'amount' => $amount
    );

    /* 退款申请的处理 */
    if ($surplus['process_type'] == 1) {
        /* 判断是否有足够的余额的进行退款的操作 */
    	if ($_SESSION['user_rank'] < 2) {
	       $sur_amount = 0 ;
	    } else {
           $sur_amount = get_user_surplus($user_id);
	    }
        if ($amount > $sur_amount) {
            $content = $_LANG['surplus_amount_error'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        }
        if ($amount < 100) {
            $content = '提现金额太小，需要大于100元!';
            show_message($content, $_LANG['back_page_up'], '', 'info');
        }
        
        if ($_SESSION['realnameflag'] == 1) {
            $bankaccount = isset($_POST['bankaccount']) ? $_POST['bankaccount'] : "" ;
//print_r($bankaccount) ;            
            $row = gc_user_drawing($user_id, $bankaccount, $amount) ;
            if ($row == null || $row['resp_code'] !== 0)
            {
                $content = '出错:'.$row['resp_msg'];
                show_message($content, $_LANG['back_page_up'], '', 'info');
            } else {
                show_message("您的提现申请已成功提交！", $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
            }
        } else {
            //插入会员账目明细
            $amount = '-' . $amount;
            $surplus['payment'] = '';
            $surplus['rec_id'] = insert_user_account($surplus, $amount);
    
            /* 如果成功提交 */
            if ($surplus['rec_id'] > 0) {
                $content = $_LANG['surplus_appl_submit'];
                show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
            } else {
                $content = $_LANG['process_false'];
                show_message($content, $_LANG['back_page_up'], '', 'info');
            }
        }
    } else if ($surplus['process_type'] == 2) {
        /* 判断是否有足够的余额的进行退款的操作 */
        
        $sur_amount = get_user_award($user_id);
        if ($amount > $sur_amount) {
            $content = $_LANG['award_amount_error'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        }

        //插入会员账目明细
        $ret = gc_award_to_balance($user_id,$amount) ;
       // var_dump($user_id);
        
        /* 如果成功提交 */
            /* 如果成功提交 */
        if ($ret == NULL) {
            $content = $_LANG['process_false'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        } else if ($ret['resp_code'] === 0) {
            $_SESSION['award_bal'] = $ret['award_bal'] ;
            $_SESSION['balance'] = $ret['balance'] ;
            $content = $_LANG['award_appl_submit'];
            show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
        } else {
            $content = '积分转提失败：'.$ret['resp_msg'] ;
            show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
        }
    }  else if ($surplus['process_type'] == 3) {
        /* 判断是否有足够的余额的进行退款的操作 */

        $tocode = isset($_POST['tocode']) ? $_POST['tocode'] : 0 ;
        $tftype = isset($_POST['tftype']) ? $_POST['tftype'] : 0 ;
        
        //插入会员账目明细
        $ret = gc_gold_to_balance($tftype, $user_id,$tocode, $amount) ;
//print_r($ret) ;
        /* 如果成功提交 */
        if ($ret == NULL) {
            $content = $_LANG['process_false'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        } else if ($ret['resp_code'] === 0) {
            $_SESSION['gold_amt'] = $ret['gold_amt'] ;
            $content = $_LANG['gold_transfer_submit'];
            show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
        } else {
            $content = '金币转账失败：'.$ret['resp_msg'] ;
            show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
        }
    } /* 如果是会员预付款，跳转到下一步，进行线上支付的操作 */
    else {
        if ($surplus['payment_id'] <= 0) {
            show_message($_LANG['select_payment_pls']);
        }

        include_once(ROOT_PATH . 'includes/lib_payment.php');

        //获取支付方式名称
        $payment_info = array();
        $payment_info = payment_info($surplus['payment_id']);
        $surplus['payment'] = $payment_info['pay_name'];
        //  var_dump($surplus['rec_id']);
        if ($surplus['rec_id'] > 0) {
            exit;
        } else {
            //插入会员账目明细
            //  $surplus['rec_id'] =gc_addaccountcheck($surplus, $amount);
        }

        //取得支付信息，生成支付代码
        $payment = unserialize_config($payment_info['pay_config']);

        //生成伪订单号, 不足的时候补0
        $order = array();
        $time = time();

        $order['user_name'] = $_SESSION['user_name'];
        $order['surplus_amount'] = $amount;

        //计算支付手续费用
        $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount'] = $amount + $payment_info['pay_fee'];

        //记录支付log
        //没有充值记录id 写入充值id$surplus['rec_id']=$surplus['user_id'];

        $order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type = PAY_SURPLUS, 0);
        //   var_dump($order['log_id']);
        //   var_dump($surplus);
        $surplus['bankname'] = '';
        $surplus['bankaddress'] = '';
        $surplus['myname'] = $_SESSION['user_name'];
        $surplus['myaccount'] = '';
        $surplus['payment'] = $surplus['payment'];
        if(strlen($surplus['payment'])===38){

            $surplus['payment']="支付宝支付";
        }


        $result = gc_addaccountcheck($surplus,$amount);
        // var_dump($result);
        $order['order_sn'] = "麦啦商城充值，订单号:" . $result['sid'];
        // $order['subject']="麦啦商城充值，订单号:".$order['log_id'];
        //var_dump($surplus);
        //var_dump($order);

        /* 调用相应的支付方式文件 */
        include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

        /* 取得在线支付方式的支付按钮 */
        $pay_obj = new $payment_info['pay_code'];
        //var_dump($order);
        $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

        /* 模板赋值 */
        $smarty->assign('payment', $payment_info);
        $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
        $smarty->assign('amount', price_format($amount, false));
        $smarty->assign('order', $order);
        $smarty->display('user_transaction.dwt');
    }
} 
elseif ($action == 'act_goldtransfer') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0) {
        show_message($_LANG['amount_gt_zero']);
    }

    /* 变量初始化 */
    $surplus = array(
        'user_id' => $user_id,
        'amount' => $amount
    );

 
        /* 判断是否有足够的余额的进行退款的操作 */
        $sur_amount = get_user_goldamt($user_id);
        if ($amount > $sur_amount) {
            $content = $_LANG['award_amount_error'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        }

        //插入会员账目明细
        $ret = user_gold_to_balance($user_id,$tocode, $amount);

        /* 如果成功提交 */
        if ($ret == true) {
            $content = $_LANG['award_appl_submit'];
            show_message($content, $_LANG['back_account_log'], 'user.php?act=account_log', 'info');
        } else {
            $content = $_LANG['process_false'];
            show_message($content, $_LANG['back_page_up'], '', 'info');
        }
} /* 删除会员余额 */
elseif ($action == 'cancel') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id == 0 || $user_id == 0) {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }

    $result = del_user_account($id, $user_id);
    if ($result == '0') {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }
} /* 会员通过帐目明细列表进行再付款的操作 */
elseif ($action == 'pay') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');

    //变量初始化
    $surplus_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $payment_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

    if ($surplus_id == 0) {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }

    //如果原来的支付方式已禁用或者已删除, 重新选择支付方式
    if ($payment_id == 0) {
        ecs_header("Location: user.php?act=account_deposit&id=" . $surplus_id . "\n");
        exit;
    }

    //获取单条会员帐目信息
    $order = array();
    // $order = $surplus_id;


    //支付方式的信息
    $payment_info = array();
    $payment_info = payment_info($payment_id);

    /* 如果当前支付方式没有被禁用，进行支付的操作 */
    if (!empty($payment_info)) {
        //取得支付信息，生成支付代码
        $payment = unserialize_config($payment_info['pay_config']);

        //生成伪订单号
        $order['order_sn'] = $surplus_id;

        //获取需要支付的log_id
        $order['log_id'] = get_paylog_id($surplus_id, $pay_type = PAY_SURPLUS);

        $order['user_name'] = $_SESSION['user_name'];
        $order['surplus_amount'] = $order['amount'];

        //计算支付手续费用
        $payment_info['pay_fee'] = pay_fee($payment_id, $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount'] = $order['surplus_amount'] + $payment_info['pay_fee'];

        //如果支付费用改变了，也要相应的更改pay_log表的order_amount
        $order_amount = $db->getOne("SELECT order_amount FROM " . $ecs->table('pay_log') . " WHERE log_id = '$order[log_id]'");
        if ($order_amount <> $order['order_amount']) {
            $db->query("UPDATE " . $ecs->table('pay_log') .
                " SET order_amount = '$order[order_amount]' WHERE log_id = '$order[log_id]'");
        }

        /* 调用相应的支付方式文件 */
        include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

        /* 取得在线支付方式的支付按钮 */
        $pay_obj = new $payment_info['pay_code'];
        $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

        /* 模板赋值 */
        $smarty->assign('payment', $payment_info);
        $smarty->assign('order', $order);
        $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
        $smarty->assign('amount', price_format($order['surplus_amount'], false));
        $smarty->assign('action', 'act_account');
        $smarty->display('user_transaction.dwt');
    } /* 重新选择支付方式 */
    else {
        include_once(ROOT_PATH . 'includes/lib_clips.php');

        $smarty->assign('payment', get_online_payment_list());
        $smarty->assign('order', $order);
        $smarty->assign('action', 'account_deposit');
        $smarty->display('user_transaction.dwt');
    }
} /* 添加标签(ajax) */
elseif ($action == 'add_tag') {
    include_once('includes/cls_json.php');
    include_once('includes/lib_clips.php');

    $result = array('error' => 0, 'message' => '', 'content' => '');
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $tag = isset($_POST['tag']) ? json_str_iconv(trim($_POST['tag'])) : '';

    if ($user_id == 0) {
        /* 用户没有登录 */
        $result['error'] = 1;
        $result['message'] = $_LANG['tag_anonymous'];
    } else {
        add_tag($id, $tag); // 添加tag
        clear_cache_files('goods'); // 删除缓存

        /* 重新获得该商品的所有缓存 */
        $arr = get_tags($id);

        foreach ($arr AS $row) {
            $result['content'][] = array('word' => htmlspecialchars($row['tag_words']), 'count' => $row['tag_count']);
        }
    }

    $json = new JSON;

    echo $json->encode($result);
    exit;
} /* 添加收藏商品(ajax) */
elseif ($action == 'collect') {
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON();
    $result = array('error' => 0, 'message' => '');
    $goods_id = $_GET['id'];

    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0) {
        $result['error'] = 1;
        $result['message'] = $_LANG['login_please'];
        die($json->encode($result));
    } else {
        /* 检查是否已经存在于用户的收藏夹 */
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('collect_goods') .
            " WHERE user_id='$_SESSION[user_id]' AND goods_id = '$goods_id'";
        if ($GLOBALS['db']->GetOne($sql) > 0) {
            $result['error'] = 1;
            $result['message'] = $GLOBALS['_LANG']['collect_existed'];
            die($json->encode($result));
        } else {
            $time = gmtime();
            $sql = "INSERT INTO " . $GLOBALS['ecs']->table('collect_goods') . " (user_id, goods_id, add_time)" .
                "VALUES ('$_SESSION[user_id]', '$goods_id', '$time')";

            if ($GLOBALS['db']->query($sql) === false) {
                $result['error'] = 1;
                $result['message'] = $GLOBALS['db']->errorMsg();
                die($json->encode($result));
            } else {
                $result['error'] = 0;
                $result['message'] = $GLOBALS['_LANG']['collect_success'];
                die($json->encode($result));
            }
        }
    }
} /* 删除留言 */
elseif ($action == 'del_msg') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $order_id = empty($_GET['order_id']) ? 0 : intval($_GET['order_id']);

    if ($id > 0) {
        $sql = 'SELECT user_id, message_img FROM ' . $ecs->table('feedback') . " WHERE msg_id = '$id' LIMIT 1";
        $row = $db->getRow($sql);
        if ($row && $row['user_id'] == $user_id) {
            /* 验证通过，删除留言，回复，及相应文件 */
            if ($row['message_img']) {
                @unlink(ROOT_PATH . DATA_DIR . '/feedbackimg/' . $row['message_img']);
            }
            $sql = "DELETE FROM " . $ecs->table('feedback') . " WHERE msg_id = '$id' OR parent_id = '$id'";
            $db->query($sql);
        }
    }
    ecs_header("Location: user.php?act=message_list&order_id=$order_id\n");
    exit;
} /* 删除评论 */
elseif ($action == 'del_cmt') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $sql = "DELETE FROM " . $ecs->table('comment') . " WHERE comment_id = '$id' AND user_id = '$user_id'";
        $db->query($sql);
    }
    ecs_header("Location: user.php?act=comment_list\n");
    exit;
} /* 合并订单 */
elseif ($action == 'merge_order') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $from_order = isset($_POST['from_order']) ? trim($_POST['from_order']) : '';
    $to_order = isset($_POST['to_order']) ? trim($_POST['to_order']) : '';
    if (merge_user_order($from_order, $to_order, $user_id)) {
        show_message($_LANG['merge_order_success'], $_LANG['order_list_lnk'], 'user.php?act=order_list', 'info');
    } else {
        $err->show($_LANG['order_list_lnk']);
    }
} /* 将指定订单中商品添加到购物车 */
elseif ($action == 'return_to_cart') {
    include_once(ROOT_PATH . 'includes/cls_json.php');
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    $json = new JSON();

    $result = array('error' => 0, 'message' => '', 'content' => '');
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    if ($order_id == 0) {
        $result['error'] = 1;
        $result['message'] = $_LANG['order_id_empty'];
        die($json->encode($result));
    }

    if ($user_id == 0) {
        /* 用户没有登录 */
        $result['error'] = 1;
        $result['message'] = $_LANG['login_please'];
        die($json->encode($result));
    }

    /* 检查订单是否属于该用户 */
    $order_user = $db->getOne("SELECT user_id FROM " . $ecs->table('order_info') . " WHERE order_id = '$order_id'");
    if (empty($order_user)) {
        $result['error'] = 1;
        $result['message'] = $_LANG['order_exist'];
        die($json->encode($result));
    } else {
        if ($order_user != $user_id) {
            $result['error'] = 1;
            $result['message'] = $_LANG['no_priv'];
            die($json->encode($result));
        }
    }

    $message = return_to_cart($order_id);

    if ($message === true) {
        $result['error'] = 0;
        $result['message'] = $_LANG['return_to_cart_success'];
        die($json->encode($result));
    } else {
        $result['error'] = 1;
        $result['message'] = $_LANG['order_exist'];
        die($json->encode($result));
    }

} /* 编辑使用余额支付的处理 */
elseif ($action == 'act_edit_surplus') {
    /* 检查是否登录 */
    if ($_SESSION['user_id'] <= 0) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单号 */
    $order_id = intval($_POST['order_id']);
    if ($order_id <= 0) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查余额 */
    $surplus = floatval($_POST['surplus']);
    if ($surplus <= 0) {
        $err->add($_LANG['error_surplus_invalid']);
        $err->show($_LANG['order_detail'], 'user.php?act=order_detail&order_id=' . $order_id);
    }

    include_once(ROOT_PATH . 'includes/lib_order.php');

    /* 取得订单 */
    $order = order_info($order_id);
    if (empty($order)) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单用户跟当前用户是否一致 */
    if ($_SESSION['user_id'] != $order['user_id']) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单是否未付款，检查应付款金额是否大于0 */
    if ($order['pay_status'] != PS_UNPAYED || $order['order_amount'] <= 0) {
        $err->add($_LANG['error_order_is_paid']);
        $err->show($_LANG['order_detail'], 'user.php?act=order_detail&order_id=' . $order_id);
    }

    /* 计算应付款金额（减去支付费用） */
    $order['order_amount'] -= $order['pay_fee'];

    /* 余额是否超过了应付款金额，改为应付款金额 */
    if ($surplus > $order['order_amount']) {
        $surplus = $order['order_amount'];
    }

    /* 取得用户信息 */
    $user = user_info($_SESSION['user_id']);

    /* 用户帐户余额是否足够 */
    /*if ($surplus > $user['user_money'] + $user['credit_line']) {*/
    if ($surplus > $user['pay_points'] + $user['credit_line']) {
        $err->add($_LANG['error_surplus_not_enough']);
        $err->show($_LANG['order_detail'], 'user.php?act=order_detail&order_id=' . $order_id);
    }

    /* 修改订单，重新计算支付费用 */
    $order['surplus'] += $surplus;
    $order['order_amount'] -= $surplus;
    if ($order['order_amount'] > 0) {
        $cod_fee = 0;
        if ($order['shipping_id'] > 0) {
            $regions = array($order['country'], $order['province'], $order['city'], $order['district']);
            $shipping = shipping_area_info($order['shipping_id'], $regions);
            if ($shipping['support_cod'] == '1') {
                $cod_fee = $shipping['pay_fee'];
            }
        }

        $pay_fee = 0;
        if ($order['pay_id'] > 0) {
            $pay_fee = pay_fee($order['pay_id'], $order['order_amount'], $cod_fee);
        }

        $order['pay_fee'] = $pay_fee;
        $order['order_amount'] += $pay_fee;
    }

    /* 如果全部支付，设为已确认、已付款 */
    if ($order['order_amount'] == 0) {
        if ($order['order_status'] == OS_UNCONFIRMED) {
            $order['order_status'] = OS_CONFIRMED;
            $order['confirm_time'] = gmtime();
        }
        $order['pay_status'] = PS_PAYED;
        $order['pay_time'] = gmtime();
    }
    $order = addslashes_deep($order);
    update_order($order_id, $order);

    /* 更新用户余额 */
    $change_desc = sprintf($_LANG['pay_order_by_surplus'], $order['order_sn']);
   // log_account_change($user['user_id'], (-1) * $surplus, 0, 0, 0, $change_desc);
   log_account_change($user['user_id'],0, 0, 0, (-1) * $surplus,  $change_desc);

    /* 跳转 */
    ecs_header('Location: user.php?act=order_detail&order_id=' . $order_id . "\n");
    exit;
} /* 编辑使用余额支付的处理 */
elseif ($action == 'act_edit_payment') {
    /* 检查是否登录 */
    if ($_SESSION['user_id'] <= 0) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查支付方式 */
    $pay_id = intval($_POST['pay_id']);
    if ($pay_id <= 0) {
        ecs_header("Location: ./\n");
        exit;
    }

    include_once(ROOT_PATH . 'includes/lib_order.php');
    $payment_info = payment_info($pay_id);
    if (empty($payment_info)) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单号 */
    $order_id = intval($_POST['order_id']);
    if ($order_id <= 0) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 取得订单 */
    $order = order_info($order_id);
    if (empty($order)) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单用户跟当前用户是否一致 */
    if ($_SESSION['user_id'] != $order['user_id']) {
        ecs_header("Location: ./\n");
        exit;
    }

    /* 检查订单是否未付款和未发货 以及订单金额是否为0 和支付id是否为改变*/
    if ($order['pay_status'] != PS_UNPAYED || $order['shipping_status'] != SS_UNSHIPPED || $order['goods_amount'] <= 0 || $order['pay_id'] == $pay_id) {
        ecs_header("Location: user.php?act=order_detail&order_id=$order_id\n");
        exit;
    }

    $order_amount = $order['order_amount'] - $order['pay_fee'];
    $pay_fee = pay_fee($pay_id, $order_amount);
    $order_amount += $pay_fee;

    $sql = "UPDATE " . $ecs->table('order_info') .
        " SET pay_id='$pay_id', pay_name='$payment_info[pay_name]', pay_fee='$pay_fee', order_amount='$order_amount'" .
        " WHERE order_id = '$order_id'";
    $db->query($sql);

    /* 跳转 */
    ecs_header("Location: user.php?act=order_detail&order_id=$order_id\n");
    exit;
} /* 保存订单详情收货地址 */
elseif ($action == 'save_order_address') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $address = array(
        'consignee' => isset($_POST['consignee']) ? compile_str(trim($_POST['consignee'])) : '',
        'email' => isset($_POST['email']) ? compile_str(trim($_POST['email'])) : '',
        'address' => isset($_POST['address']) ? compile_str(trim($_POST['address'])) : '',
        'zipcode' => isset($_POST['zipcode']) ? compile_str(make_semiangle(trim($_POST['zipcode']))) : '',
        'tel' => isset($_POST['tel']) ? compile_str(trim($_POST['tel'])) : '',
        'mobile' => isset($_POST['mobile']) ? compile_str(trim($_POST['mobile'])) : '',
        'sign_building' => isset($_POST['sign_building']) ? compile_str(trim($_POST['sign_building'])) : '',
        'best_time' => isset($_POST['best_time']) ? compile_str(trim($_POST['best_time'])) : '',
        'order_id' => isset($_POST['order_id']) ? intval($_POST['order_id']) : 0
    );
    if (save_order_address($address, $user_id)) {
        ecs_header('Location: user.php?act=order_detail&order_id=' . $address['order_id'] . "\n");
        exit;
    } else {
        $err->show($_LANG['order_list_lnk'], 'user.php?act=order_list');
    }
} /* 我的红包列表 */
elseif ($action == 'bonus') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $record_count = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('user_bonus') . " WHERE user_id = '$user_id'");

    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    $bonus = get_user_bouns_list($user_id, $pager['size'], $pager['start']);

    $smarty->assign('pager', $pager);
    $smarty->assign('bonus', $bonus);
    $smarty->display('user_transaction.dwt');
} /* 我的团购列表 */
elseif ($action == 'group_buy') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    //待议
    $smarty->display('user_transaction.dwt');
} /* 团购订单详情 */
elseif ($action == 'group_buy_detail') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    //待议
    $smarty->display('user_transaction.dwt');
} // 用户推荐页面
elseif ($action == 'affiliate') {
    $goodsid = intval(isset($_REQUEST['goodsid']) ? $_REQUEST['goodsid'] : 0);
    if (empty($goodsid)) {
        //我的推荐页面

        $page = !empty($_REQUEST['page']) && intval($_REQUEST['page']) > 0 ? intval($_REQUEST['page']) : 1;
        $size = !empty($_CFG['page_size']) && intval($_CFG['page_size']) > 0 ? intval($_CFG['page_size']) : 10;

        empty($affiliate) && $affiliate = array();

        if (empty($affiliate['config']['separate_by'])) {
            //推荐注册分成
            $affdb = array();
            $num = count($affiliate['item']);
            $up_uid = "'$user_id'";
            $all_uid = "'$user_id'";
            for ($i = 1; $i <= $num; $i++) {
                $count = 0;
                if ($up_uid) {
                    $sql = "SELECT user_id FROM " . $ecs->table('users') . " WHERE parent_id IN($up_uid)";
                    $query = $db->query($sql);
                    $up_uid = '';
                    while ($rt = $db->fetch_array($query)) {
                        $up_uid .= $up_uid ? ",'$rt[user_id]'" : "'$rt[user_id]'";
                        if ($i < $num) {
                            $all_uid .= ", '$rt[user_id]'";
                        }
                        $count++;
                    }
                }
                $affdb[$i]['num'] = $count;
                $affdb[$i]['point'] = $affiliate['item'][$i - 1]['level_point'];
                $affdb[$i]['money'] = $affiliate['item'][$i - 1]['level_money'];
            }
            $smarty->assign('affdb', $affdb);

            $sqlcount = "SELECT count(*) FROM " . $ecs->table('order_info') . " o" .
                " LEFT JOIN" . $ecs->table('users') . " u ON o.user_id = u.user_id" .
                " LEFT JOIN " . $ecs->table('affiliate_log') . " a ON o.order_id = a.order_id" .
                " WHERE o.user_id > 0 AND (u.parent_id IN ($all_uid) AND o.is_separate = 0 OR a.user_id = '$user_id' AND o.is_separate > 0)";

            $sql = "SELECT o.*, a.log_id, a.user_id as suid,  a.user_name as auser, a.money, a.point, a.separate_type FROM " . $ecs->table('order_info') . " o" .
                " LEFT JOIN" . $ecs->table('users') . " u ON o.user_id = u.user_id" .
                " LEFT JOIN " . $ecs->table('affiliate_log') . " a ON o.order_id = a.order_id" .
                " WHERE o.user_id > 0 AND (u.parent_id IN ($all_uid) AND o.is_separate = 0 OR a.user_id = '$user_id' AND o.is_separate > 0)" .
                " ORDER BY order_id DESC";

            /*
                SQL解释：

                订单、用户、分成记录关联
                一个订单可能有多个分成记录

                1、订单有效 o.user_id > 0
                2、满足以下之一：
                    a.直接下线的未分成订单 u.parent_id IN ($all_uid) AND o.is_separate = 0
                        其中$all_uid为该ID及其下线(不包含最后一层下线)
                    b.全部已分成订单 a.user_id = '$user_id' AND o.is_separate > 0

            */

            $affiliate_intro = nl2br(sprintf($_LANG['affiliate_intro'][$affiliate['config']['separate_by']], $affiliate['config']['expire'], $_LANG['expire_unit'][$affiliate['config']['expire_unit']], $affiliate['config']['level_register_all'], $affiliate['config']['level_register_up'], $affiliate['config']['level_money_all'], $affiliate['config']['level_point_all']));
        } else {
            //推荐订单分成
            $sqlcount = "SELECT count(*) FROM " . $ecs->table('order_info') . " o" .
                " LEFT JOIN" . $ecs->table('users') . " u ON o.user_id = u.user_id" .
                " LEFT JOIN " . $ecs->table('affiliate_log') . " a ON o.order_id = a.order_id" .
                " WHERE o.user_id > 0 AND (o.parent_id = '$user_id' AND o.is_separate = 0 OR a.user_id = '$user_id' AND o.is_separate > 0)";


            $sql = "SELECT o.*, a.log_id,a.user_id as suid, a.user_name as auser, a.money, a.point, a.separate_type,u.parent_id as up FROM " . $ecs->table('order_info') . " o" .
                " LEFT JOIN" . $ecs->table('users') . " u ON o.user_id = u.user_id" .
                " LEFT JOIN " . $ecs->table('affiliate_log') . " a ON o.order_id = a.order_id" .
                " WHERE o.user_id > 0 AND (o.parent_id = '$user_id' AND o.is_separate = 0 OR a.user_id = '$user_id' AND o.is_separate > 0)" .
                " ORDER BY order_id DESC";

            /*
                SQL解释：

                订单、用户、分成记录关联
                一个订单可能有多个分成记录

                1、订单有效 o.user_id > 0
                2、满足以下之一：
                    a.订单下线的未分成订单 o.parent_id = '$user_id' AND o.is_separate = 0
                    b.全部已分成订单 a.user_id = '$user_id' AND o.is_separate > 0

            */

            $affiliate_intro = nl2br(sprintf($_LANG['affiliate_intro'][$affiliate['config']['separate_by']], $affiliate['config']['expire'], $_LANG['expire_unit'][$affiliate['config']['expire_unit']], $affiliate['config']['level_money_all'], $affiliate['config']['level_point_all']));

        }

        $count = $db->getOne($sqlcount);

        $max_page = ($count > 0) ? ceil($count / $size) : 1;
        if ($page > $max_page) {
            $page = $max_page;
        }

        $res = $db->SelectLimit($sql, $size, ($page - 1) * $size);
        $logdb = array();
        while ($rt = $GLOBALS['db']->fetchRow($res)) {
            if (!empty($rt['suid'])) {
                //在affiliate_log有记录
                if ($rt['separate_type'] == -1 || $rt['separate_type'] == -2) {
                    //已被撤销
                    $rt['is_separate'] = 3;
                }
            }
            $rt['order_sn'] = substr($rt['order_sn'], 0, strlen($rt['order_sn']) - 5) . "***" . substr($rt['order_sn'], -2, 2);
            $logdb[] = $rt;
        }

        $url_format = "user.php?act=affiliate&page=";

        $pager = array(
            'page' => $page,
            'size' => $size,
            'sort' => '',
            'order' => '',
            'record_count' => $count,
            'page_count' => $max_page,
            'page_first' => $url_format . '1',
            'page_prev' => $page > 1 ? $url_format . ($page - 1) : "javascript:;",
            'page_next' => $page < $max_page ? $url_format . ($page + 1) : "javascript:;",
            'page_last' => $url_format . $max_page,
            'array' => array()
        );
        for ($i = 1; $i <= $max_page; $i++) {
            $pager['array'][$i] = $i;
        }

        $smarty->assign('url_format', $url_format);
        $smarty->assign('pager', $pager);


        $smarty->assign('affiliate_intro', $affiliate_intro);
        $smarty->assign('affiliate_type', $affiliate['config']['separate_by']);

        $smarty->assign('logdb', $logdb);
    } else {
        //单个商品推荐
        $smarty->assign('userid', $user_id);
        $smarty->assign('goodsid', $goodsid);

        $types = array(1, 2, 3, 4, 5);
        $smarty->assign('types', $types);

        $goods = get_goods_info($goodsid);
        $shopurl = $ecs->url();
        $goods['goods_img'] = (strpos($goods['goods_img'], 'http://') === false && strpos($goods['goods_img'], 'https://') === false) ? $shopurl . $goods['goods_img'] : $goods['goods_img'];
        $goods['goods_thumb'] = (strpos($goods['goods_thumb'], 'http://') === false && strpos($goods['goods_thumb'], 'https://') === false) ? $shopurl . $goods['goods_thumb'] : $goods['goods_thumb'];
        $goods['shop_price'] = price_format($goods['shop_price']);

        $smarty->assign('goods', $goods);
    }

    $smarty->assign('shopname', $_CFG['shop_name']);
    $smarty->assign('userid', $user_id);
    $smarty->assign('shopurl', $ecs->url());
    $smarty->assign('logosrc', 'themes/' . $_CFG['template'] . '/images/logo.gif');

    $smarty->display('user_clips.dwt');
} /* 显示用户关系推荐树 */
elseif ($action == 'afftree') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    //该会员能查看的最多的代数；
    //$disdai=$myrelevel+$maxdai;

    /* 获取该会员伞下面的会员信息 */
    $begin = 0;
    $count = 20;
    $li = array();
    $cnt = 20;

    while ($cnt >= 20) {
        $res = gc_getafftree($user_id, $begin, $count);
        $cnt = $res['cnt'];
        $rbegin = $res['begin'];
        if ($begin != $rbegin) break;
        $begin = $begin + $cnt;
        $num = 0;
        while ($num < $cnt) {
            $row = $res[$num];
            $num += 1;
            $li[] = $row;
        }
    }

    foreach ($li as $key => $val) {
        $uid = $li[$key]['user_id'];
        $rankid = $li[$key]['user_rank'];
        $bussid = $li[$key]['buss_rank'];
        if ($rankid == '1') $userrankname = "一般用户" ;
        if ($rankid == '2') $userrankname = '<font color="#0000FF">麦啦会员</font>' ;
        if ($rankid == '4') {
            $bussrankname = "一般" ;
            if ($bussid == '1') $bussrankname = '<font color="#088A08">☆' ;
            if ($bussid == '2') $bussrankname = '<font color="#FFBF00">☆☆' ;
            if ($bussid == '3') $bussrankname = '<font color="#DF013A">☆☆☆' ;
            $userrankname = $bussrankname."合伙人</font>" ;
        }
        if ($rankid == '5') $userrankname = '<font color="#0000FF">麦啦会员</font>' ;
        
        $li[$key]['user_rankname'] = $userrankname;
        $li[$key]['user_realname'] = $auser_name;
    }

    $my['user_id'] = $user_id;
    $my['user_name'] = $myphone;
    $my['user_rankname'] = $urankname;
    $my['user_realname'] = $user_name;
    $smarty->assign('my', $my);
    $smarty->assign('li', $li);
    $smarty->display('user_clips.dwt');
} //首页邮件订阅ajax操做和验证操作
elseif ($action == 'stock_trade') {
    //$dir=dir(__FILE__);
   // echo $dir;
    //$dir_array=explode("\\",$dir);
    //var_dump($dir_array);

    $gp = gc_usershares($user_id)  ;
    
    //$smarty->assign("filename",dirname(__FILE__));
    $smarty->assign('sharesfree', $gp['sharesfree']);
    $smarty->assign('sharesnum', $gp['sharesnum']);
    $smarty->assign('unitprice', $gp['unitprice']);
    $smarty->assign('curprice', $gp['curprice']);
    $smarty->assign('sharesamt', $gp['curprice']*$gp['sharesnum']);   
    $smarty->display('user_clips.dwt');
}
elseif ($action == 'email_list') {
    $job = $_GET['job'];

    if ($job == 'add' || $job == 'del') {
        if (isset($_SESSION['last_email_query'])) {
            if (time() - $_SESSION['last_email_query'] <= 30) {
                die($_LANG['order_query_toofast']);
            }
        }
        $_SESSION['last_email_query'] = time();
    }

    $email = trim($_GET['email']);
    $email = htmlspecialchars($email);

    if (!is_email($email)) {
        $info = sprintf($_LANG['email_invalid'], $email);
        die($info);
    }
    $ck = $db->getRow("SELECT * FROM " . $ecs->table('email_list') . " WHERE email = '$email'");
    if ($job == 'add') {
        if (empty($ck)) {
            $hash = substr(md5(time()), 1, 10);
            $sql = "INSERT INTO " . $ecs->table('email_list') . " (email, stat, hash) VALUES ('$email', 0, '$hash')";
            $db->query($sql);
            $info = $_LANG['email_check'];
            $url = $ecs->url() . "user.php?act=email_list&job=add_check&hash=$hash&email=$email";
            send_mail('', $email, $_LANG['check_mail'], sprintf($_LANG['check_mail_content'], $email, $_CFG['shop_name'], $url, $url, $_CFG['shop_name'], local_date('Y-m-d')), 1);
        } elseif ($ck['stat'] == 1) {
            $info = sprintf($_LANG['email_alreadyin_list'], $email);
        } else {
            $hash = substr(md5(time()), 1, 10);
            $sql = "UPDATE " . $ecs->table('email_list') . "SET hash = '$hash' WHERE email = '$email'";
            $db->query($sql);
            $info = $_LANG['email_re_check'];
            $url = $ecs->url() . "user.php?act=email_list&job=add_check&hash=$hash&email=$email";
            send_mail('', $email, $_LANG['check_mail'], sprintf($_LANG['check_mail_content'], $email, $_CFG['shop_name'], $url, $url, $_CFG['shop_name'], local_date('Y-m-d')), 1);
        }
        die($info);
    } elseif ($job == 'del') {
        if (empty($ck)) {
            $info = sprintf($_LANG['email_notin_list'], $email);
        } elseif ($ck['stat'] == 1) {
            $hash = substr(md5(time()), 1, 10);
            $sql = "UPDATE " . $ecs->table('email_list') . "SET hash = '$hash' WHERE email = '$email'";
            $db->query($sql);
            $info = $_LANG['email_check'];
            $url = $ecs->url() . "user.php?act=email_list&job=del_check&hash=$hash&email=$email";
            send_mail('', $email, $_LANG['check_mail'], sprintf($_LANG['check_mail_content'], $email, $_CFG['shop_name'], $url, $url, $_CFG['shop_name'], local_date('Y-m-d')), 1);
        } else {
            $info = $_LANG['email_not_alive'];
        }
        die($info);
    } elseif ($job == 'add_check') {
        if (empty($ck)) {
            $info = sprintf($_LANG['email_notin_list'], $email);
        } elseif ($ck['stat'] == 1) {
            $info = $_LANG['email_checked'];
        } else {
            if ($_GET['hash'] == $ck['hash']) {
                $sql = "UPDATE " . $ecs->table('email_list') . "SET stat = 1 WHERE email = '$email'";
                $db->query($sql);
                $info = $_LANG['email_checked'];
            } else {
                $info = $_LANG['hash_wrong'];
            }
        }
        show_message($info, $_LANG['back_home_lnk'], 'index.php');
    } elseif ($job == 'del_check') {
        if (empty($ck)) {
            $info = sprintf($_LANG['email_invalid'], $email);
        } elseif ($ck['stat'] == 1) {
            if ($_GET['hash'] == $ck['hash']) {
                $sql = "DELETE FROM " . $ecs->table('email_list') . "WHERE email = '$email'";
                $db->query($sql);
                $info = $_LANG['email_canceled'];
            } else {
                $info = $_LANG['hash_wrong'];
            }
        } else {
            $info = $_LANG['email_not_alive'];
        }
        show_message($info, $_LANG['back_home_lnk'], 'index.php');
    }
} /* ajax 发送验证邮件 */
elseif ($action == 'send_hash_mail') {
    include_once(ROOT_PATH . 'includes/cls_json.php');
    include_once(ROOT_PATH . 'includes/lib_passport.php');
    $json = new JSON();

    $result = array('error' => 0, 'message' => '', 'content' => '');

    if ($user_id == 0) {
        /* 用户没有登录 */
        $result['error'] = 1;
        $result['message'] = $_LANG['login_please'];
        die($json->encode($result));
    }

    if (send_regiter_hash($user_id)) {
        $result['message'] = $_LANG['validate_mail_ok'];
        die($json->encode($result));
    } else {
        $result['error'] = 1;
        $result['message'] = $GLOBALS['err']->last_message();
    }

    die($json->encode($result));
} else if ($action == 'track_packages') {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $orders = array();

    $sql = "SELECT order_id,order_sn,invoice_no,shipping_id FROM " . $ecs->table('order_info') .
        " WHERE user_id = '$user_id' AND shipping_status = '" . SS_SHIPPED . "'";
    $res = $db->query($sql);
    $record_count = 0;
    while ($item = $db->fetch_array($res)) {
        $shipping = get_shipping_object($item['shipping_id']);

        if (method_exists($shipping, 'query')) {
            $query_link = $shipping->query($item['invoice_no']);
        } else {
            $query_link = $item['invoice_no'];
        }

        if ($query_link != $item['invoice_no']) {
            $item['query_link'] = $query_link;
            $orders[] = $item;
            $record_count += 1;
        }
    }
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    $smarty->assign('pager', $pager);
    $smarty->assign('orders', $orders);
    $smarty->display('user_transaction.dwt');
} else if ($action == 'order_query') {
    $_GET['order_sn'] = trim(substr($_GET['order_sn'], 1));
    $order_sn = empty($_GET['order_sn']) ? '' : addslashes($_GET['order_sn']);
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON();

    $result = array('error' => 0, 'message' => '', 'content' => '');

    if (isset($_SESSION['last_order_query'])) {
        if (time() - $_SESSION['last_order_query'] <= 10) {
            $result['error'] = 1;
            $result['message'] = $_LANG['order_query_toofast'];
            die($json->encode($result));
        }
    }
    $_SESSION['last_order_query'] = time();

    if (empty($order_sn)) {
        $result['error'] = 1;
        $result['message'] = $_LANG['invalid_order_sn'];
        die($json->encode($result));
    }

    $sql = "SELECT order_id, order_status, shipping_status, pay_status, " .
        " shipping_time, shipping_id, invoice_no, user_id " .
        " FROM " . $ecs->table('order_info') .
        " WHERE order_sn = '$order_sn' LIMIT 1";

    $row = $db->getRow($sql);
    if (empty($row)) {
        $result['error'] = 1;
        $result['message'] = $_LANG['invalid_order_sn'];
        die($json->encode($result));
    }

    $order_query = array();
    $order_query['order_sn'] = $order_sn;
    $order_query['order_id'] = $row['order_id'];
    $order_query['order_status'] = $_LANG['os'][$row['order_status']] . ',' . $_LANG['ps'][$row['pay_status']] . ',' . $_LANG['ss'][$row['shipping_status']];

    if ($row['invoice_no'] && $row['shipping_id'] > 0) {
        $sql = "SELECT shipping_code FROM " . $ecs->table('shipping') . " WHERE shipping_id = '$row[shipping_id]'";
        $shipping_code = $db->getOne($sql);
        $plugin = ROOT_PATH . 'includes/modules/shipping/' . $shipping_code . '.php';
        if (file_exists($plugin)) {
            include_once($plugin);
            $shipping = new $shipping_code;
            $order_query['invoice_no'] = $shipping->query((string)$row['invoice_no']);
        } else {
            $order_query['invoice_no'] = (string)$row['invoice_no'];
        }
    }

    $order_query['user_id'] = $row['user_id'];
    /* 如果是匿名用户显示发货时间 */
    if ($row['user_id'] == 0 && $row['shipping_time'] > 0) {
        $order_query['shipping_date'] = local_date($GLOBALS['_CFG']['date_format'], $row['shipping_time']);
    }
    $smarty->assign('order_query', $order_query);
    $result['content'] = $smarty->fetch('library/order_query.lbi');
    die($json->encode($result));
} elseif ($action == 'transform_points') {
    $rule = array();
    if (!empty($_CFG['points_rule'])) {
        $rule = unserialize($_CFG['points_rule']);
    }
    $cfg = array();
    if (!empty($_CFG['integrate_config'])) {
        $cfg = unserialize($_CFG['integrate_config']);
        $_LANG['exchange_points'][0] = empty($cfg['uc_lang']['credits'][0][0]) ? $_LANG['exchange_points'][0] : $cfg['uc_lang']['credits'][0][0];
        $_LANG['exchange_points'][1] = empty($cfg['uc_lang']['credits'][1][0]) ? $_LANG['exchange_points'][1] : $cfg['uc_lang']['credits'][1][0];
    }
    $sql = "SELECT user_id, user_name, pay_points, rank_points FROM " . $ecs->table('users') . " WHERE user_id='$user_id'";
    $row = $db->getRow($sql);
    if ($_CFG['integrate_code'] == 'ucenter') {
        $exchange_type = 'ucenter';
        $to_credits_options = array();
        $out_exchange_allow = array();
        foreach ($rule as $credit) {
            $out_exchange_allow[$credit['appiddesc'] . '|' . $credit['creditdesc'] . '|' . $credit['creditsrc']] = $credit['ratio'];
            if (!array_key_exists($credit['appiddesc'] . '|' . $credit['creditdesc'], $to_credits_options)) {
                $to_credits_options[$credit['appiddesc'] . '|' . $credit['creditdesc']] = $credit['title'];
            }
        }
        $smarty->assign('selected_org', $rule[0]['creditsrc']);
        $smarty->assign('selected_dst', $rule[0]['appiddesc'] . '|' . $rule[0]['creditdesc']);
        $smarty->assign('descreditunit', $rule[0]['unit']);
        $smarty->assign('orgcredittitle', $_LANG['exchange_points'][$rule[0]['creditsrc']]);
        $smarty->assign('descredittitle', $rule[0]['title']);
        $smarty->assign('descreditamount', round((1 / $rule[0]['ratio']), 2));
        $smarty->assign('to_credits_options', $to_credits_options);
        $smarty->assign('out_exchange_allow', $out_exchange_allow);
    } else {
        $exchange_type = 'other';

        $bbs_points_name = $user->get_points_name();
        $total_bbs_points = $user->get_points($row['user_name']);

        /* 论坛积分 */
        $bbs_points = array();
        foreach ($bbs_points_name as $key => $val) {
            $bbs_points[$key] = array('title' => $_LANG['bbs'] . $val['title'], 'value' => $total_bbs_points[$key]);
        }

        /* 兑换规则 */
        $rule_list = array();
        foreach ($rule as $key => $val) {
            $rule_key = substr($key, 0, 1);
            $bbs_key = substr($key, 1);
            $rule_list[$key]['rate'] = $val;
            switch ($rule_key) {
                case TO_P :
                    $rule_list[$key]['from'] = $_LANG['bbs'] . $bbs_points_name[$bbs_key]['title'];
                    $rule_list[$key]['to'] = $_LANG['pay_points'];
                    break;
                case TO_R :
                    $rule_list[$key]['from'] = $_LANG['bbs'] . $bbs_points_name[$bbs_key]['title'];
                    $rule_list[$key]['to'] = $_LANG['rank_points'];
                    break;
                case FROM_P :
                    $rule_list[$key]['from'] = $_LANG['pay_points'];
                    $_LANG['bbs'] . $bbs_points_name[$bbs_key]['title'];
                    $rule_list[$key]['to'] = $_LANG['bbs'] . $bbs_points_name[$bbs_key]['title'];
                    break;
                case FROM_R :
                    $rule_list[$key]['from'] = $_LANG['rank_points'];
                    $rule_list[$key]['to'] = $_LANG['bbs'] . $bbs_points_name[$bbs_key]['title'];
                    break;
            }
        }
        $smarty->assign('bbs_points', $bbs_points);
        $smarty->assign('rule_list', $rule_list);
    }
    $smarty->assign('shop_points', $row);
    $smarty->assign('exchange_type', $exchange_type);
    $smarty->assign('action', $action);
    $smarty->assign('lang', $_LANG);
    $smarty->display('user_transaction.dwt');
} elseif ($action == 'act_transform_points') {
    $rule_index = empty($_POST['rule_index']) ? '' : trim($_POST['rule_index']);
    $num = empty($_POST['num']) ? 0 : intval($_POST['num']);


    if ($num <= 0 || $num != floor($num)) {
        show_message($_LANG['invalid_points'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }

    $num = floor($num); //格式化为整数

    $bbs_key = substr($rule_index, 1);
    $rule_key = substr($rule_index, 0, 1);

    $max_num = 0;

    /* 取出用户数据 */
    $sql = "SELECT user_name, user_id, pay_points, rank_points FROM " . $ecs->table('users') . " WHERE user_id='$user_id'";
    $row = $db->getRow($sql);
    $bbs_points = $user->get_points($row['user_name']);
    $points_name = $user->get_points_name();

    $rule = array();
    if ($_CFG['points_rule']) {
        $rule = unserialize($_CFG['points_rule']);
    }
    list($from, $to) = explode(':', $rule[$rule_index]);

    $max_points = 0;
    switch ($rule_key) {
        case TO_P :
            $max_points = $bbs_points[$bbs_key];
            break;
        case TO_R :
            $max_points = $bbs_points[$bbs_key];
            break;
        case FROM_P :
            $max_points = $row['pay_points'];
            break;
        case FROM_R :
            $max_points = $row['rank_points'];
    }

    /* 检查积分是否超过最大值 */
    if ($max_points <= 0 || $num > $max_points) {
        show_message($_LANG['overflow_points'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }

    switch ($rule_key) {
        case TO_P :
            $result_points = floor($num * $to / $from);
            $user->set_points($row['user_name'], array($bbs_key => 0 - $num)); //调整论坛积分
            log_account_change($row['user_id'], 0, 0, 0, $result_points, $_LANG['transform_points'], ACT_OTHER);
            show_message(sprintf($_LANG['to_pay_points'], $num, $points_name[$bbs_key]['title'], $result_points), $_LANG['transform_points'], 'user.php?act=transform_points');

        case TO_R :
            $result_points = floor($num * $to / $from);
            $user->set_points($row['user_name'], array($bbs_key => 0 - $num)); //调整论坛积分
            log_account_change($row['user_id'], 0, 0, $result_points, 0, $_LANG['transform_points'], ACT_OTHER);
            show_message(sprintf($_LANG['to_rank_points'], $num, $points_name[$bbs_key]['title'], $result_points), $_LANG['transform_points'], 'user.php?act=transform_points');

        case FROM_P :
            $result_points = floor($num * $to / $from);
            log_account_change($row['user_id'], 0, 0, 0, 0 - $num, $_LANG['transform_points'], ACT_OTHER); //调整商城积分
            $user->set_points($row['user_name'], array($bbs_key => $result_points)); //调整论坛积分
            show_message(sprintf($_LANG['from_pay_points'], $num, $result_points, $points_name[$bbs_key]['title']), $_LANG['transform_points'], 'user.php?act=transform_points');

        case FROM_R :
            $result_points = floor($num * $to / $from);
            log_account_change($row['user_id'], 0, 0, 0 - $num, 0, $_LANG['transform_points'], ACT_OTHER); //调整商城积分
            $user->set_points($row['user_name'], array($bbs_key => $result_points)); //调整论坛积分
            show_message(sprintf($_LANG['from_rank_points'], $num, $result_points, $points_name[$bbs_key]['title']), $_LANG['transform_points'], 'user.php?act=transform_points');
    }
} elseif ($action == 'act_transform_ucenter_points') {
    $rule = array();
    if ($_CFG['points_rule']) {
        $rule = unserialize($_CFG['points_rule']);
    }
    $shop_points = array(0 => 'rank_points', 1 => 'pay_points');
    $sql = "SELECT user_id, user_name, pay_points, rank_points FROM " . $ecs->table('users') . " WHERE user_id='$user_id'";
    $row = $db->getRow($sql);
    $exchange_amount = intval($_POST['amount']);
    $fromcredits = intval($_POST['fromcredits']);
    $tocredits = trim($_POST['tocredits']);
    $cfg = unserialize($_CFG['integrate_config']);
    if (!empty($cfg)) {
        $_LANG['exchange_points'][0] = empty($cfg['uc_lang']['credits'][0][0]) ? $_LANG['exchange_points'][0] : $cfg['uc_lang']['credits'][0][0];
        $_LANG['exchange_points'][1] = empty($cfg['uc_lang']['credits'][1][0]) ? $_LANG['exchange_points'][1] : $cfg['uc_lang']['credits'][1][0];
    }
    list($appiddesc, $creditdesc) = explode('|', $tocredits);
    $ratio = 0;

    if ($exchange_amount <= 0) {
        show_message($_LANG['invalid_points'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }
    if ($exchange_amount > $row[$shop_points[$fromcredits]]) {
        show_message($_LANG['overflow_points'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }
    foreach ($rule as $credit) {
        if ($credit['appiddesc'] == $appiddesc && $credit['creditdesc'] == $creditdesc && $credit['creditsrc'] == $fromcredits) {
            $ratio = $credit['ratio'];
            break;
        }
    }
    if ($ratio == 0) {
        show_message($_LANG['exchange_deny'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }
    $netamount = floor($exchange_amount / $ratio);
    include_once(ROOT_PATH . './includes/lib_uc.php');
    $result = exchange_points($row['user_id'], $fromcredits, $creditdesc, $appiddesc, $netamount);
    if ($result === true) {
        $sql = "UPDATE " . $ecs->table('users') . " SET {$shop_points[$fromcredits]}={$shop_points[$fromcredits]}-'$exchange_amount' WHERE user_id='{$row['user_id']}'";
        $db->query($sql);
        $sql = "INSERT INTO " . $ecs->table('account_log') . "(user_id, {$shop_points[$fromcredits]}, change_time, change_desc, change_type)" . " VALUES ('{$row['user_id']}', '-$exchange_amount', '" . gmtime() . "', '" . $cfg['uc_lang']['exchange'] . "', '98')";
        $db->query($sql);
        show_message(sprintf($_LANG['exchange_success'], $exchange_amount, $_LANG['exchange_points'][$fromcredits], $netamount, $credit['title']), $_LANG['transform_points'], 'user.php?act=transform_points');
    } else {
        show_message($_LANG['exchange_error_1'], $_LANG['transform_points'], 'user.php?act=transform_points');
    }
} /* 清除商品浏览历史 */
elseif ($action == 'clear_history') {
    setcookie('ECS[history]', '', 1);
} elseif ($action == "getsms") {

    $tel = $_GET['tel'];

    $type = isset($_GET["type"]) ? $_GET["type"] : 'REG';

//    var_dump($type);
    gc_writelog("type=".$type."End") ;
    $res = gc_getusersmssend($tel, $type);

    if (!empty($tel)) {

        if ($res['resp_code'] === 0) {


            echo "ok";

        } else {
            echo $res['resp_msg'];
        }
    }
} elseif ($action == "send_inq_gpos") {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/shopping_flow.php');
    $smarty->assign('lang', $_LANG);
    
    /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
    $smarty->assign('country_list', get_regions());
    $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
    
    /* 获得用户所有的收货人信息 */
    $consignee_list = get_consignee_list($_SESSION['user_id']);
    
    if (count($consignee_list) < 5 && $_SESSION['user_id'] > 0) {
        /* 如果用户收货人信息的总数小于5 则增加一个新的收货人信息 */
        $consignee_list[] = array('country' => $_CFG['shop_country'], 'email' => isset($_SESSION['email']) ? $_SESSION['email'] : '');
    }
//print_r($consignee_list) ;    
    $smarty->assign('consignee_list', $consignee_list);
    
    //取得国家列表，如果有收货人列表，取得省市区列表
    foreach ($consignee_list AS $region_id => $consignee) {
        $consignee['country'] = isset($consignee['country']) ? intval($consignee['country']) : 0;
        $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
        $consignee['city'] = isset($consignee['city']) ? intval($consignee['city']) : 0;
    
        $province_list[$region_id] = get_regions(1, $consignee['country']);
        $city_list[$region_id] = get_regions(2, $consignee['province']);
        $district_list[$region_id] = get_regions(3, $consignee['city']);
    }
    
    /* 获取默认收货ID */
    $address_id = get_address_id($user_id);
    
    //赋值于模板
    $smarty->assign('real_goods_count', 1);
    $smarty->assign('shop_country', $_CFG['shop_country']);
    $smarty->assign('shop_province', get_regions(1, $_CFG['shop_country']));
    $smarty->assign('province_list', $province_list);
    $smarty->assign('address', $address_id);
    $smarty->assign('city_list', $city_list);
    $smarty->assign('district_list', $district_list);
    $smarty->assign('currency_format', $_CFG['currency_format']);
    $smarty->assign('integral_scale', $_CFG['integral_scale']);
    $smarty->assign('name_of_region', array($_CFG['name_of_region_1'], $_CFG['name_of_region_2'], $_CFG['name_of_region_3'], $_CFG['name_of_region_4']));
    
    $smarty->display('user_transaction.dwt');
} elseif ($action == "act_gpos") {
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/shopping_flow.php');
    $smarty->assign('lang', $_LANG);
    
    $address = array(
        'user_id' => $user_id,
        'address_id' => intval($_POST['address_id']),
        'country' => isset($_POST['country']) ? $_POST['country'] : 0,
        'province' => isset($_POST['province']) ? $_POST['province'] : 0,
        'city' => isset($_POST['city']) ? $_POST['city'] : 0,
        'district' => isset($_POST['district']) ? $_POST['district'] : 0,
        'address' => isset($_POST['address']) ? compile_str(trim($_POST['address'])) : '',
        'consignee' => isset($_POST['consignee']) ? compile_str(trim($_POST['consignee'])) : '',
        'email' => isset($_POST['email']) ? compile_str(trim($_POST['email'])) : '',
        'tel' => isset($_POST['tel']) ? compile_str(make_semiangle(trim($_POST['tel']))) : '',
        'mobile' => isset($_POST['mobile']) ? compile_str(make_semiangle(trim($_POST['mobile']))) : '',
        'best_time' => isset($_POST['best_time']) ? compile_str(trim($_POST['best_time'])) : '',
        'sign_building' => isset($_POST['sign_building']) ? compile_str(trim($_POST['sign_building'])) : '',
        'activity' => '0',
        'zipcode' => isset($_POST['zipcode']) ? compile_str(make_semiangle(trim($_POST['zipcode']))) : '',
    );
    
 //   update_address($address) ;
    $addrstr = get_regions_name($address['province']).'|'.get_regions_name($address['city']).'|'.get_regions_name($address['district']).'|'.$address['address'].'|'.$address['consignee'].'|'.$address['email'].'|'.$address['tel'].'|'.$address['mobile'].'|'.$address['zipcode'];
    
    $suid = $address['user_id'];
    
    $res = gc_gpos_req($suid,$addrstr);
    //print_r($res) ;
    if (!empty($res)) {
        if ($res['resp_code'] === 0) {
            show_message('您的Gpos领取申请发送成功!', '返回会员中心', 'user.php?act=default');
        } else {
            show_message($res['resp_msg'], '返回会员中心', 'user.php?act=default');
        }
    }
} elseif ($action == "checksms") {

    $tel = trim($_GET['tel']);
    $smscode = trim($_GET['code']);
    $type = trim($_GET['type']);

    $userid = $_SESSION['user_id'];
    // var_dump($userid);
    $reg_phone = '1';

    $res = gc_checkusersmssend($tel, $smscode, $type);
    //  var_dump($res);


    if ($res['resp_code'] === 0) {
        $phone_res = gc_checkphoneauth($userid, $reg_phone);

        if ($phone_res['resp_code'] === 0) {

            echo "ok";

        } else {

            echo 'error2';

        }


    } else {

        echo "error1";

    }

} elseif ($action == "change_pwd") {

    $tel = $_GET['tel'];
    $smscode = $_GET['code'];
    $newpwd = $_GET["newpass"];
    $newpassword = md5($newpwd);

    gc_writelog("\r\nPWD:".$newpwd."|".$newpassword."End") ;
    $res = gc_changeuserpasswd($tel, $smscode, $newpassword);

    // var_dump($res);


    if ($res['resp_code'] === 0) {

        echo "ok";

    } else {

        echo "error";

    }
//账户安全 2015年11月2日 16:42:09
} elseif ($action == 'safe_center') {

    $phone = $_SESSION['phone'];

    $smarty->assign('phone', $phone);


    $smarty->display('user_clips.dwt');

} elseif ($action == 'reset_pay_pwd') {
    $phone = $_SESSION['phone'];
    $smscode = isset($_POST['smscode']) ? trim($_POST['smscode']) : '';
    $row = gc_resetpaypwd($phone,"11",$smscode) ;
    if ($row == null)  {
        show_message("重置密码出错", "安全中心", 'user.php?act=safe_center');
    }
    if ($row['resp_code'] === 0) {
        show_message($row['resp_msg'], "安全中心", 'user.php?act=safe_center');
    } else {
        show_message($row['resp_msg'], "安全中心", 'user.php?act=safe_center');
    }
} elseif ($action == 'change_pay_pwd') {
    $phone = $_SESSION['phone'];
    $old_pwd = isset($_POST['old_paypassword']) ? trim($_POST['old_paypassword']) : '';
    $new_pwd1 = isset($_POST['new_paypassword']) ? trim($_POST['new_paypassword']) : '';
    $new_pwd2 = isset($_POST['confirm_paypassword']) ? trim($_POST['confirm_paypassword']) : '';
    gc_writelog("paswd=".$old_pwd."|".$new_pwd1."|".$new_pwd2."E") ;
    if ($new_pwd1 != $new_pwd2) {
        show_message("二次输入新密码不一致！", "安全中心", 'user.php?act=safe_center');
    }
    if (strlen($old_pwd) != 6 || strlen($new_pwd1) != 6 || strlen($new_pwd2) != 6) {
        show_message("密码长度必须6位数字！", "安全中心", 'user.php?act=safe_center');
    }
    if (is_numeric($old_pwd) == false || is_numeric($new_pwd1) == false || is_numeric($new_pwd2) == false) {
        show_message("密码必须输入全部数字！", "安全中心", 'user.php?act=safe_center');
    }
    $oldpass=gc_rsa_encrypt($old_pwd) ;
    echo $oldpass;
    $newpass=gc_rsa_encrypt($new_pwd1) ;
    echo $newpass;
    gc_writelog("|".$oldpass."|") ;
    gc_writelog("|".$newpass."|") ;
    $row = gc_changepaypwd($phone,$oldpass, $newpass) ;
    if ($row == null)  {
        show_message("修改密码出错", "安全中心", 'user.php?act=safe_center');
    }
    if ($row['resp_code'] === 0) {
        show_message($row['resp_msg'], "安全中心", 'user.php?act=safe_center');
    } else {
        show_message($row['resp_msg'], "安全中心", 'user.php?act=safe_center');
    }
}else if($action=="checkzhifupassword") {



    //$_SESSION["last_time"]=$_GET["time"];
/*
    if(time()-$_SESSION["last_time"]>60*10){

        unset($_SESSION["last_time"]);
    }
*/

    $pass = $_GET["password"];
     $phone=$_SESSION['phone'];
    $pass=gc_rsa_encrypt($pass);
    $res=gc_checkpaypwd($phone,$pass);


    if($res['resp_code']===0){
        $_SESSION['last_time']=time();

        echo "ok";

    }else{

        echo  "error";
    }



   // echo  $_SESSION["last_time"].$pass;
}else if($action=="checkalreadypassword"){


    $address_ip=real_ip();
    //传送过来的时间
   $time=$_GET["time"];
    //var_dump($time);
   //session里面存放的时间

    $time_save=$_SESSION['last_time'];
    if(!empty($time_save)){

        $max=$time-$time_save;


    }

   // var_dump($max);
    $address_ip = real_ip();
  //  var_dump($address_ip);
    $address_save=$_SESSION["ipaddress"];
 //  var_dump($max);
   // die();
   if(isset($max)) {
       if ($max > 60) {

           unset($_SESSION['last_time']);
           echo "error";
       } else {
           //  die();
           echo "ok";
       }
   }else if($address_save!==$address_ip){

         echo "error";
   }else{

       echo  "error";

   }

}else if($action=='getcity'){
    include_once('includes/cls_json.php');
    $json = new JSON;

    if(!empty($_GET["bankinfo"])&&!empty($_GET["provinceinfo"])) {
        $bankinfo = $_GET["bankinfo"];
        $provinceinfo = $_GET[provinceinfo];

        $sql = "SELECT cityid,cityname FROM  `d_paybankinfo` WHERE provinceid =" . $provinceinfo . " AND bankid =" . $bankinfo . " GROUP BY cityname";

        $info = $db->getAll($sql);

        //  echo $sql;
        echo  $json->encode($info);

    }




    }else if($action=="getzhihang") {

    include_once('includes/cls_json.php');
    $json = new JSON;

        if (!empty($_GET["bankinfo"]) && !empty($_GET["cityinfo"])) {
            $bankinfo = $_GET["bankinfo"];
            $cityinfo = $_GET[cityinfo];

            $sql = "SELECT bankbranchid,bankbranchname FROM  `d_paybankinfo` WHERE cityid =" . $cityinfo . " AND bankid =" . $bankinfo . " GROUP BY bankbranchname";

            $info = $db->getAll($sql);

            //  echo $sql;
            echo  $json->encode($info);


        }


    }else if($action=="true_info"){

    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    if(file_exists("bank.php")&&file_exists("province.php")) {


        $bank=file_get_contents("bank.php");
        $bankinfo=json_decode($bank,true);
        $province=file_get_contents("province.php");
        $province=json_decode($province,true);
        array_shift($province);


    }else{

        $sql = "SELECT bankid,bankname FROM  `d_paybankinfo` where bankid>100 and  bankid<501 GROUP BY bankname order by bankid asc";
        $sql1 = "SELECT provinceid, provincename FROM  `d_paybankinfo` GROUP BY provincename";
        $bank = $db->getAll($sql);
        $province = $db->getAll($sql1);

        array_shift($province);
        $bankinfo = $bank;
        file_put_contents("bank.php", json_encode($bankinfo));
        file_put_contents("province.php", json_encode($province));

    }



    $result=gc_get_realname_auth($user_id);



    if($result["resp_code"]===0){
        $result=$result['user'];
       //$result["status"]=2;

        if($result["userid"]!==0) {

            if($result[status]==1 || $result[status]==9){
                $sql = " SELECT  provincename,cityname  FROM `d_paybankinfo` WHERE bankbranchid=" . $result["bankno"];
                $res = $db->getAll($sql);
                $smarty->assign("status", $result["status"]);
                $smarty->assign("banks", $result["banks"]);//银行
                $smarty->assign("pidno", $result["pidno"]);//身份证
                $smarty->assign("bankno", $result["bankno"]);//支行代码号
                $smarty->assign("bankaccount", $result["bankaccount"]);//银行卡号
                $smarty->assign("bankname", $result["bankname"]);//支行名字
                $smarty->assign("provincename", $res[0]["provincename"]);//省份
                $smarty->assign("cityname", $res[0]["cityname"]);//市区

            }else{


                $sql = " SELECT bankbranchid,bankid, provinceid, provincename,cityid,cityname  FROM `d_paybankinfo` WHERE bankbranchid=" . $result["bankno"];
                $res[0] = $db->getRow($sql);

                $smarty->assign("status", $result["status"]);
                $smarty->assign("banks", $result["banks"]);//银行
                $smarty->assign("pidno", $result["pidno"]);//身份证
                $smarty->assign("bankno", $result["bankno"]);//支行代码号
                $smarty->assign("bankaccount", $result["bankaccount"]);//银行卡号
                $smarty->assign("bankname", $result["bankname"]);//支行名字
                $smarty->assign("provincename", $res[0]["provincename"]);//省份
                $smarty->assign("bankid",$res[0]["bankid"]);//

                $smarty->assign("provinceid",$res[0]["provinceid"]);//省份代码
                $smarty->assign("bankbranchid",$res[0]["bankbranchid"]);

                $smarty->assign("cityid",$res[0]["cityid"]);//市区代码
                $smarty->assign("cityname", $res[0]["cityname"]);//市区


                $smarty->assign("bankinfo", $bankinfo);
                $smarty->assign("province", $province);



            }
        }

    }else{


        $smarty->assign("bankinfo", $bankinfo);
        $smarty->assign("province", $province);

    }

    $smarty->display('user_transaction.dwt');


}


?>