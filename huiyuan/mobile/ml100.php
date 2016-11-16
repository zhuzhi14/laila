<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/26
 * Time: 9:03
 */

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/includes/lib_main.php');
require_once(ROOT_PATH . '/includes/lib_tdwsys.php');
require_once(ROOT_PATH . '/includes/lib_base.php');
require_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');

$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($user_agent, 'MicroMessenger') === false) {
    // 非微信浏览器禁止浏览
    $is_wx = 1;
} else {
    // 微信浏览器，允许访问
    $is_wx = 0;
}

$action = isset($_GET["act"]) ? $_GET["act"] : "default";
$ml_phone = isset($_GET["phone"]) ? $_GET['phone'] : "default";

//获取新的参数
if ($ml_phone == "default" && $action == "buy") {
    @$do = isset($_SESSION['esc']["do"]) ? $_SESSION['esc']['do'] : "";
    $get_phone = isset($_SESSION['esc']["phone"]) ? $_SESSION['esc']["phone"] : "";


    if ($do == "doregister" && $get_phone != "") {

        // echo "<script>window.location.href='user.php?act=user_center&link=ml100&ml_phone=" . $get_phone . "'</script>";

        $url1 = "user.php?act=user_center&link=ml100&ml_phone=" . $get_phone;
        $url2 = "ml100.php?act=register&ml_phone=" . $get_phone;
        $smarty->assign('url1', $url1);
        $smarty->assign('url2', $url2);
        $smarty->display('ml100reg.dwt');
        exit;
        // ;
    }


}
//注册快捷注册
if ($action == "register") {
    $openid = $_SESSION['esc']['openid'];
    $phone = $_GET['ml_phone'];
    $res = wx_register($openid, $phone);

    //var_dump($res);
    if ($res['resp_code'] === 0) {
        $user = $res['user'];
        $userid=$user['user_id'];
        $nickname=$_SESSION['esc']['nickname'];


        $bind_res=gc_bindweixin($openid,$nickname,$userid);

        if($bind_res['resp_code']===0) {
            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION['user_name'] = $_SESSION['esc']['nickname'];
            $_SESSION['balance'] = $user['balance'];
            $_SESSION['award_bal'] = $user['award_bal'];
            $_SESSION['wx_flag'] = 1;
        }else{

            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION['user_name'] = $_SESSION['esc']['nickname'];
            $_SESSION['balance'] = $user['balance'];
            $_SESSION['award_bal'] = $user['award_bal'];
            $_SESSION['wx_flag'] = 1;


        }

    }

}

//var_dump($_SESSION);
//购买操作
if ($action == "act_add_order") {
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $message = array(
        'whopay' => $_SESSION['user_id'],
        'paycode' => $_SESSION['user_name'],
        'mltype' => isset($_POST['mltype']) ? $_POST['mltype'] : "",
        'buy_num' => isset($_POST['buy_num']) ? intval($_POST['buy_num']) : 1,
        'buy_uname' => isset($_POST['buy_uname']) ? trim($_POST['buy_uname']) : '',
        'ml_phone' => isset($_POST['ml_phone']) ? trim($_POST['ml_phone']) : '',
        'bordernum' => date('YmdHis', time() + 8 * 3600).$_SESSION['user_id'],
        'buy_method' => isset($_POST['buy_method']) ? trim($_POST['buy_method']) : "",
    );
    //var_dump($message);
    $row_id=insert_maila($message);

    //var_dump($row_id);


    if ($message['buy_method'] == 'yepay') {

        if (add_order($message)) {
            $is_pay=1;
            $bordernum=$message['bordernum'];

            $result=update_maila_pay($is_pay,$bordernum);

            show_ml100msg($_LANG['add_buy_success'], $_LANG['buy_list_lnk'], 'ml100.php?act=default&order_id=' . $message['bordernum'], 'info');
//        $err->show($_LANG['add_buy_success'], 'user.php?act=upvip');
        } else {
            $err->show($_LANG['buy_list_lnk'], 'ml100.php?act=default');
        }
    } else {
        $order_sn = $message['bordernum']. 'Tm';
        if ($message['mltype'] == 'MD100L') {
            $money = 0.01* $message['buy_num'];
        } else {
            $money = 0.01*$message['buy_num'];

        }
        if ($is_wx == 0) {
            $openid = $_COOKIE['openid'];

            $url = "../bcpay/demo.wx.jsapi.php?user_id=".$_SESSION['user_id']."&type=ml100&do=shopping&openid=" . $openid . "&order_sn=" . $order_sn . "&money=" . $money;

            unset($_SESSION['user_id']);
            unset($_SESSION['nick_name']);

            echo "<script>window.location.href='" . $url . "'</script>";


        } else {

            $url = "../bcpay/demo.php?type=ml100&do=shopping&order_sn=" . $order_sn . "&money=" . $money;
            // $url="../bcpay/test.php";
            // var_dump($url);
            //unset($_SESSION['user_id']);
            //unset($_SESSION['nick_name']);

            echo "<script>window.location.href='" . $url . "'</script>";


        }

    }


} else {
    if (!empty($_SESSION['user_id'])) {
        $userid = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        @$myphone = $_SESSION['phone'];
        $groupid = "02";
        $action = "ml100";
        $balance = $_SESSION['balance'];
        $award_bal = $_SESSION['award_bal'];
        $ml_phone = isset($_GET['ml_phone']) ? $_GET['ml_phone'] : @$_GET['phone'];
        $user_img = isset($_SESSION['user_img']) ? isset($_SESSION['user_img']) : 'default';
        if ($user_img == 'default') {

            $src = "images/tx.jpg";

        } else {

            $src = $user_img;
        }
//print_r('phone='.$ml_phone) ;
        if ($ml_phone === null || strlen($ml_phone) == 0) {
            $flag = 0;
        } else {
            $flag = 0;
        }
        $amount=$balance+$award_bal;
        if($amount>0){

            $buyflag=0;

        }else{

            $buyflag=1;
        }


        $res = gc_mlmobilebuy($userid, $groupid);
        $smarty->assign('ml_phone', $ml_phone);
        $smarty->assign('myphone', $myphone);
        $smarty->assign('balance', $balance);
        $smarty->assign('award_bal', $award_bal);
        $smarty->assign('amount', $balance + $award_bal);
        $smarty->assign('user_name', $user_name);
        $smarty->assign('src', $src);
        $smarty->assign("mltypelist", $res);
        $smarty->assign("flag", $flag);
        $smarty->assign('buyflag',$buyflag);
        $smarty->assign('action', $action);
        $smarty->display('ml100.dwt');
    } else {
        $ml_phone = isset($_GET['ml_phone']) ? $_GET['ml_phone'] : @$_GET['phone'];
        //var_dump($_GET);
        if (isset($_GET["code"])) {

            // $wx = gc_get_wxinfo();
            // $openid=gc_get_openid();
            //setcookie("openid",$openid);
            // $_COOKIE["openid"] = $openid;
            $res = gc_wxResAndLogin();

            $openid = $_COOKIE["openid"];
            // var_dump($res);

            if ($res) {
                $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
                $Loaction = 'ml100.php?phone=' . $ml_phone;
                //var_dump($Loaction);
                ecs_header("Location: $Loaction\n");
                exit();
            } else {
                // echo  "12123";
                if ($is_wx == 0) {
                    if (isset($_GET["code"])) {
                        $phone = $ml_phone;
                        // $res=wx_register($openid,$phone);

                        $_SESSION['esc']["do"] = "doregister";
                        $_SESSION['esc']["phone"] = $phone;
                        $_SESSION['esc']['openid'] = $openid;

                        //  if($res['resp_code']===0){
                        //跳转关注
                        //查询关注
                        //获取关注信息
                        $gz = gc_gz($openid);

                        $subscribe = $gz->subscribe;
                        @$nickname = $gz->nickname;
                        //用户名
                        $_SESSION['esc']['nickname'] = $nickname;
                        if ($subscribe == 1) {
                            //
                            //已经关注的情况下


                            $url1 = "user.php?act=user_center&link=ml100&ml_phone=" . $phone;
                            $url2 = "ml100.php?act=register&ml_phone=" . $phone;
                            $smarty->assign('url1', $url1);
                            $smarty->assign('url2', $url2);
                            $smarty->display('ml100reg.dwt');
                            exit;
                            //exit;


                        } else {
                            //未关注
                            //盈中科技

                            $url = "https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIwMDIxNDQ5Mg==&scene=110#wechat_redirect";
                            //laila
                            //$url="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzI0MTQzNzUzMw==&scene=110#wechat_redirect";


                            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
                            exit;

                        }

                    }
                } else {
                    echo "<script>window.location.href='user.php?act=user_center&link=ml100&ml_phone=" . $ml_phone . "'</script>";
                }

            }
        } else {
            //  $uri="http://maila.vastpay.cn/mobile/ml100.php?phone=13951414596";
            if ($is_wx == "0") {

                $uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
                // echo $uri;
                //  exit;
                $uri = urlencode($uri);//这里需要urlencode一下
                $wxinfo = get_wxinfo();
                $appid = $wxinfo['appid'];
                $appsecret = $wxinfo['secret'];
                $redurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $uri . '&response_type=code&scope=snsapi_userinfo&state=111111#wechat_redirect';
                header("location:" . $redurl);


            } else {

                echo "<script>window.location.href='user.php?act=user_center&link=ml100&ml_phone=" . $ml_phone . "'</script>";


            }
        }
    }
}

function show_ml100msg($content, $links = '', $hrefs = '', $type = 'info', $auto_redirect = true)
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

    $smarty->assign('action', "ml100msg");
    $GLOBALS['smarty']->assign('auto_redirect', $auto_redirect);
    $GLOBALS['smarty']->assign('message', $msg);
    $GLOBALS['smarty']->display('ml100.dwt');

    exit;
}


function gc_get_wxinfo()
{
    //
    // $appid =  "wx1a655b2a22bb0b9c";
    // $secret = "2b81a348797ee94d3d7e641a9a91a75b";
    $wx = get_wxinfo();
    $appid = $wx['appid'];
    $secret = $wx['secret'];
    $code = $_GET["code"];
    gc_writelog($code, __FILE__, __LINE__);

    $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
    gc_writelog($get_token_url, __FILE__, __LINE__);
    $file_contents = http_get($get_token_url);

    //  if ($file_contents == null) return ;
    $json_obj = json_decode($file_contents, true);
    //var_dump($json_obj);
    //return $json_obj;
    $openid = $json_obj['openid'];

    $access_token = $json_obj['access_token'];

    $get_wxinfo = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
    $file_wx = http_get($get_wxinfo);

    // if ($file_wx == null) return ;
    $json_wx = json_decode($file_wx, true);

    return $json_wx;

}

//获取单个用户信息
function gc_gz($openid)
{

    $wx = get_wxinfo();
    $appid = $wx['appid'];
    $secret = $wx['secret'];
    $get_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret;
    $res2 = json_decode(http_get($get_token_url));
    $token = $res2->access_token;
    if ($token) {
        // session("token", $token);
        //session("openid", $openid);
        // session("expire_time", time());
    } else {
        exit("未请求到access_token");
    }

    $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $token . "&openid=" . $openid;
    $subscribe_info = http_get($subscribe_msg);
    $subscribe_info = json_decode($subscribe_info);
    /*
  if($subscribe_info->subscribe){
       return "1";
  }else{
      return "0";
  }
  */

    return $subscribe_info;


}




