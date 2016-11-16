<?php

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
require_once(ROOT_PATH . 'includes/lib_llsys.php');
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');

$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$smarty->assign('action', $action);

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0';

$disphard = '2';
$_SESSION['disphard'] = $disphard;
$smarty->assign('disphard', $disphard);

$data = null;
if ($action == 'wx_login') {
    if (gc_wxResAndLogin()) {
        $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
        $Loaction = 'merchant.php';
        ecs_header("Location: $Loaction\n");
    } else {
        $user_name = !empty($_REQUEST['username']) ? $_GET['username'] : '';
        $pwd = !empty($_GET['pwd']) ? $_GET['pwd'] : '';
        $gourl = !empty($_GET['gourl']) ? $_GET['gourl'] : '';

        $remember = isset($_GET['remember']) ? $_GET['remember'] : 0;
        //记住用户名字
        if (!empty($remember)) {
            setcookie("ECS[reuser_name]", $user_name, time() + 31536000, '/');
        }
        $reuser_name = isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
        if (!empty($reuser_name)) {
            $smarty->assign('reuser_name', $reuser_name);
        }

        if (empty($user_name) || empty($pwd)) {
            ecs_header("Location:merchant.php\n");
            $login_faild = 1;
        } else {
            if ($user->check_user($user_name, $pwd) > 0) {
                $user->set_session($user_name);
                $user->set_cookie($user_name);
                update_user_info();
            } else {
                $login_faild = 1;
            }
        }
        $smarty->assign('login_faild', $login_faild);
        $smarty->display('login.dwt');
        exit;
    }
} else if ($action == 'mert_credit') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $mert = gc_merchant_inq($user_id);
    if ($mert == null) {
        show_message("读取商户数据错误! ！", "返回操作界面", 'merchant.php', 'info');
    }
    if ($mert['resp_code'] != 0) {
        show_message($mert['resp_msg'], "返回操作界面", 'merchant.php', 'info');
    }
    //获取剩余余额
    $surplus_amount = $mert['balance'];

    if (empty($surplus_amount)) {
        $surplus_amount = 0;
    }
    if ($surplus_amount < 10) {
        show_message("余额不足，暂时不能提款!", "返回操作界面", 'merchant.php', 'info');
    }

    //读取实名认证数据
    $row = gc_get_realname_auth($user_id);
    $realnameflag = 0;
    $user = null;
    if ($row == null) {
        $realnameflag = '0';
    } else {
        $user = isset($row['user']) ? $row['user'] : null;
        if ($user == null) {
            $realnameflag = '0';
        } else if ($user['user_id'] === 0) {
            $realnameflag = '0';
        } else if ($user['status'] != '9') {
            $realnameflag = '0';
        } else {
            $realnameflag = $row['realnameflag'];
        }
    }
    $smarty->assign('realnameflag', $realnameflag);
    $_SESSION['realnameflag'] = $realnameflag;
    $cardlists = array();
    foreach ($row as $key => $val) {
        if (is_array($val)) {
            $cardlists[$key]["bankaccount"] = $row["user"]["bankaccount"];
            $cardlists[$key]["bankname"] = $row["user"]["bankname"];
        }
    }
    //提款卡表
    $smarty->assign('realnamedata', $cardlists);
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
    $smarty->assign('myrealname', $_SESSION['user_name']);
    $smarty->assign('act', 'mert_credit');
    $smarty->display('merchant.dwt');

} else if ($action == 'mert_act') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0) {
        show_message("请在“金额”栏输入大于0的数字", "返回操作界面", 'merchant.php?act=mert_credit', 'info');
        return 0;
    }

    /* 提款的处理 */
    if (isset($_POST['bankaccount'])) {
        $bankaccount = $_POST['bankaccount'];
        ini_set('max_execution_time', 120);
        $row = gc_merchant_drawing($user_id, $bankaccount, $amount);

        if ($row == false) {
            show_message("此次操作失败，请返回重试！", "返回操作界面", 'merchant.php?act=mert_credit', 'info');
        } else if ($row['resp_code'] !== 0) {
            show_message('出错:' . $row['resp_msg'], "返回操作界面", 'merchant.php?act=mert_credit', 'info');
        } else {
            show_message("您的提现申请已成功提交!", "返回操作界面", 'merchant.php?act=mert_credit', 'info');
        }
    } else {
        show_message("提现账号没有选择！", "返回操作界面", 'merchant.php?act=mert_credit', 'info');
    }
} else if ($action == 'mert_account') {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'mobile/includes/lib_main.php');
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $account_type = 'user_money';
    //获取余额记录
    $account_log = array();
    $account_list = array();
    $sur_amount = 0;

    $mert = gc_merchant_inq($user_id);
    $shang_name=$mert['merchant_name'];
    $record = gc_merchant_translist($user_id, 0, 0);
    // var_dump($record);
    if ($record['resp_code'] == '0') {

        $record_cnt = $record['cnt'];
        $page_start = 0;
        $page_num = 15;
        $pagebar = 0;
        if ($record_cnt > 0) {
            $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
            // var_dump($page);
            $pagebar = get_wap_pager($record_cnt, $page_num, $page, 'merchant.php?act=mert_account', 'page');
            //var_dump($pagebar);
            $page_start = $page_num * ($page - 1);
            $res = gc_merchant_translist($user_id, $page_start, $page_num);

            if ($res['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $res['sno'];
                $num = 0;
                while ($num < $cnt) {
                    $row = $res[$num];
                    $num++;
                    $account_list[] = $row;
                }
            }

            $smarty->assign('account_log', $account_list);
            $smarty->assign('pagebar', $pagebar);
        }

    }


    //  @ $pager = pager('user.php', array('act' => $action), $record_count, $page);
    //模板赋值
    //    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
     $smarty->assign('shang_name',$shang_name);
    $smarty->assign('act', 'mert_account');
    $smarty->display('merchant.dwt');
} else if ($action == 'mert_bankaccount') {

    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'mobile/includes/lib_main.php');


    $record = gc_merchant_drawinglists($user_id);
    // var_dump($record);
    if ($record['resp_code'] == '0') {

        $record_cnt = $record['sno'];

        if ($record_cnt > 0) {


            if ($record['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $record['sno'];
                $num = 0;
                while ($num < $cnt) {
                    $row = $record[$num];
                    $num++;
                    $account_list[] = $row;
                }
            }


        }


    }


    //  @ $pager = pager('user.php', array('act' => $action), $record_count, $page);
    //模板赋值
    //    $smarty->assign('surplus_amount', price_format($surplus_amount, false));

    $smarty->assign('account_log', $account_list);
    $smarty->assign('act', 'mert_bankaccount');

    $smarty->display('merchant.dwt');
}else if($action=='ll_order') {
    //$merchant_id=$_SESSION["user_id"]


    if($user_id>0) {
        $mert = gc_merchant_inq($user_id);
        $shang_name = $mert['merchant_name'];

        //var_dump($shang_name);

        $smarty->assign('shang_name', $shang_name);
        $smarty->assign('act', 'll_order');
        $smarty->display("merchant.dwt");
    }else{

        exit;
    }
}else if($action=='merchant_order_sale'){
   // var_dump($_POST);
   if($user_id>0) {
       $mert_id = $user_id;
       $user_phone = trim($_POST["phone"]);
       $amount = intval(trim($_POST["amount"]));
       $ordername = trim($_POST["ordername"]);

       $row = gc_merchant_order_sale($user_phone, $mert_id, $amount, $ordername);

       //var_dump($row);
       if ($row['resp_code'] == 0) {

           show_message("订单成功提交", "返回操作界面", 'merchant.php', 'info');

       } else {
           show_llmsg($row['resp_msg'], "返回操作界面", 'merchant.php', 'info');

       }


   }else{

       show_ll_center();

   }







} else {
    if ($_SESSION['user_id'] > 0) {
        show_merchant_center();
    } else {
        //print_r("user_id = 0") ;
        $reuser_name = isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
        if (!empty($reuser_name)) {
            $smarty->assign('reuser_name', $reuser_name);
        }
        $smarty->assign('footer', get_footer());
        $smarty->assign('link', 'merchant');
        $smarty->assign('ml_phone', @$_GET['ml_phone']);
        $smarty->display('login.dwt');
        exit;
    }
}

function show_merchant_center()
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_llsys.php');

    $user_id = $_SESSION['user_id'];
    // var_dump($user_id);


    $mert = gc_merchant_inq($user_id);

    if ($mert == null) {
        show_llmsg("读取商户数据错误! ！", "返回操作界面", 'merchant.php', 'info');
    }

    if ($mert['resp_code'] === 0 && $mert['ismerchant'] == 1) {
        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $mert['surl'];
        //    echo $url;
        //二维码
        //二维码存放地址
        $name_url = "images/erweima/" . $user_id;
        if (!file_exists($name_url)) {
            mkdir($name_url);
        }
        $name_erweima = $name_url . "/merchant.png";
        if (!file_exists($name_erweima)) {
            $qr = erweima($url, $name_erweima);
        }

        $GLOBALS['smarty']->assign('linkurl', $name_erweima);
        $GLOBALS['smarty']->assign('shorturl', $url);
        $GLOBALS['smarty']->assign('action', 'default');
        $GLOBALS['smarty']->assign('mert', $mert);
        $GLOBALS['smarty']->display('merchant.dwt');
    } else if ($mert['resp_code'] === 0) {
        show_llmsg("您还不是商户，请申请商户后操作!", "返回操作界面", 'merchant.php', 'info');
    } else {
        show_llmsg($mert['resp_msg'], "返回操作界面", 'merchant.php', 'info');
    }
}

function show_llmsg($content, $links = '', $hrefs = '', $type = 'info', $auto_redirect = true)
{
    assign_template();

    $msg['content'] = $content;
    if (is_array($links) && is_array($hrefs)) {
        if (!empty($links) && count($links) == count($hrefs)) {
            foreach ($links as $key => $val) {
                $msg['url_info'][$val] = $hrefs[$key];
            }
            $msg['back_url'] = $hrefs['0'];
        }
    } else {
        $link = empty($links) ? $GLOBALS['_LANG']['back_up_page'] : $links;
        $href = empty($hrefs) ? 'javascript:history.back()' : $hrefs;
        $msg['url_info'][$link] = $href;
        $msg['back_url'] = $href;
    }

    $msg['type'] = $type;
    // update by guo   $position = assign_ur_here(0, $GLOBALS['_LANG']['sys_msg']);
    $position = assign_ur_here(0, '系统提示');
    $GLOBALS['smarty']->assign('page_title', $position['title']);   // 页面标题
    $GLOBALS['smarty']->assign('ur_here', $position['ur_here']); // 当前位置

    if (is_null($GLOBALS['smarty']->get_template_vars('helps'))) {
        $GLOBALS['smarty']->assign('helps', get_shop_help()); // 网店帮助
    }
    $GLOBALS['smarty']->assign('action', 'llmsg');
    $GLOBALS['smarty']->assign('auto_redirect', $auto_redirect);
    $GLOBALS['smarty']->assign('message', $msg);
    $GLOBALS['smarty']->display('ll.dwt');

    exit;
}

function erweima($url, $name)
{
    require_once(ROOT_PATH . "/phpqrcode/phpqrcode.php");
    $value = $url; //二维码内容
    $errorCorrectionLevel = 'L';//容错级别
    $matrixPointSize = 6;//生成图片大小
    //生成二维码图片
    QRcode::png($value, $name, $errorCorrectionLevel, $matrixPointSize, 2);
}

?>
