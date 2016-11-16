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
include_once(ROOT_PATH . 'includes/lib_llsys.php');
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
$phone = isset($_GET["phone"]) ? $_GET['phone'] : "default";

//获取新的参数
if ($phone == "default" && $action == "buy") {
    @$do = isset($_SESSION['m']["do"]) ? $_SESSION['m']['do'] : "";
    $get_phone = isset($_SESSION['m']["phone"]) ? $_SESSION['m']["phone"] : "";


    if ($do == "doregister" && $get_phone != "") {

        // echo "<script>window.location.href='user.php?act=user_center&link=ml100&ml_phone=" . $get_phone . "'</script>";

        $url1 = "user.php?act=user_center&link=merchantpay&ml_phone=" . $get_phone;
        $url2 = "merchantpay.php?act=register&ml_phone=" . $get_phone;
        $smarty->assign('url1', $url1);
        $smarty->assign('url2', $url2);
        $smarty->display('ml100reg.dwt');
        exit;
        // ;
    }else{

        echo "<script>window.location.href='user.php?act=user_center'</script>";

         exit;
    }


}
//注册快捷注册
if ($action == "register") {
    $openid = $_SESSION['m']['openid'];
    $phone = $_SESSION['m']['phone'];
    $res = wx_register($openid, $phone);

    //var_dump($res);
    if ($res['resp_code'] === 0) {
        $user = $res['user'];
        $userid = $user['user_id'];
        $nickname = $_SESSION['m']['nickname'];


        $bind_res = gc_bindweixin($openid, $nickname, $userid);

        if ($bind_res['resp_code'] === 0) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['mert_user_id'] = $_SESSION['m']['mert_user_id'];
            $_SESSION['user_name'] = $_SESSION['m']['nickname'];
            $_SESSION['balance'] = $user['balance'];
            $_SESSION['award_bal'] = $user['award_bal'];
            $_SESSION['wx_flag'] = 1;
        } else {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['mert_user_id'] = $_SESSION['m']['mert_user_id'];
            $_SESSION['user_name'] = $_SESSION['m']['nickname'];
            $_SESSION['balance'] = $user['balance'];
            $_SESSION['award_bal'] = $user['award_bal'];
            $_SESSION['wx_flag'] = 1;


        }

    }

}

//var_dump($_SESSION);

if ($action == "act_pay") {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    //$money=isset($_POST['buy_amt'])?trim($_POST['buy_amt']):'0';


    $_SESSION['user_id']=isset($_SESSION['user_id'])?$_SESSION['user_id']:-1;
    $_SESSION['mert_user_id']=isset($_SESSION['mert_user_id'])?$_SESSION['mert_user_id']:-1;

   // var_dump($_SESSION);



    if($_SESSION["user_id"]<=0){

        show_message("请返回再试_1");
        exit();
    }
    if($_SESSION['mert_user_id']<=0){

        show_message("请返回再试_2");
        exit();
    }


    if(strlen($_POST["buy_uname"])==0){

        show_message("商户不存在(-1);请返回");
        exit();

    }







    $res = select_maila($_POST['order_sn']);

    if (!empty($res)) {

        show_message("请勿重复提交", '', '', '');
    } else {
        $message = array(
            'whopay' => $_SESSION['user_id'],
            'paycode' => $_SESSION['user_name'],
            'mltype' => isset($_POST['mltype']) ? $_POST['mltype'] : "扫码付款",
            'buy_num' => isset($_POST['buy_num']) ? intval($_POST['buy_num']) : 1,
            'buy_uname' => isset($_POST['buy_uname']) ? trim($_POST['buy_uname']) : '',
            'mert_user_id' => $_SESSION['mert_user_id'],
            'bordernum' => isset($_POST['order_sn']) ? trim($_POST['order_sn']) : '',
            'buy_method' => isset($_POST['buy_method']) ? trim($_POST['buy_method']) : '',
            'buy_amt' => isset($_POST['buy_amt']) ? trim($_POST['buy_amt']) : '0'
        );
    }


    $money = floatval($message['buy_amt']) ; 
    $order_sn = $message['bordernum'];
    $row_id = insert_maila($message);

    //var_dump($row_id);
    if($money < 0.01){
        show_message('金额不正确',"返回操作界面", 'merchantpay.php', 'info', true);
    }

    if ($message['buy_method'] == 'yepay') {

        $user_id = $_SESSION['user_id'];
        $merchant_id = $_SESSION['mert_user_id'];
        $amount = $_POST['buy_amt'];
        $saletype = 'BAL';
        $row = gc_merchant_sale($user_id, $merchant_id, $saletype, $amount);
        //var_dump($row);
        $str=date('YmdHis',time()+8*3600).serialize($row).$user_id.$merchant_id.$saletype.$amount;
        gc_writelog($str);

        if ($row == null) {

            show_message('交易失败-1，请稍后再做', "返回操作界面", 'merchantpay.php', 'info', true);
        }
        if ($row['resp_code'] == 0) {

            //var_dump($_SESSION);
            $info = gc_getuserinfo($user_id);

            update_maila_pay('1', $order_sn);
            // var_dump($info);
            $_SESSION['balance'] = $info['balance'];
            $_SESSION['award_bal'] = $info['award_bal'];
            $_SESSION['tb_bal']=$info['tb_bal'];

            show_message('金额' . $amount . '元,支付成功!', "返回操作界面", 'merchantpay.php', 'info', true);


        } else {

            show_message('交易失败-2，请稍后再做', "返回操作界面", 'merchantpay.php', 'info', true);
        }
    } else {

        $order_sn = $message['bordernum'];
        $name=$message['buy_uname'];


        if ($money > 0) {
            if ($is_wx == 0) {
                @$openid = $_COOKIE['openid'];
                $url = "../bcpay/demo.wx.jsapi.php?name=".$name."&user_id=" . $_SESSION['user_id'] . "&type=saoma&do=saoma&openid=" . $openid . "&order_sn=" . $order_sn . "&money=" . $money;
               // unset($_SESSION['user_id']);
               // unset($_SESSION['nick_name']);
                echo "<script>window.location.href='" . $url . "'</script>";

            } else {
                $url = "../bcpay/demo.php?name=".$name."&type=saoma&do=saoma&order_sn=" . $order_sn . "&money=" . $money;


                echo "<script>window.location.href='" . $url . "'</script>";


            }
        } else {

            show_message('金额不正确',"返回操作界面", 'merchantpay.php', 'info', true);
        }


    }


} else {
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    if (isset($_GET['user_id'])) {
        $mert_user_id = $_GET['user_id'];
        $_SESSION['mert_user_id'] = $mert_user_id;
    } else {
        $mert_user_id = isset($_SESSION['mert_user_id']) ? $_SESSION['mert_user_id'] : 0;
    }
    if (isset($_GET['amount'])) {
        $mert_amount = $_GET['amount'];
        $_SESSION['mert_amount'] = $mert_amount;
    } else {
        $mert_amount = isset($_SESSION['mert_amount']) ? $_SESSION['mert_amount'] : 0;
    }


    if (!empty($_SESSION['user_id'])) {
        $userid = $_SESSION['user_id'];
        $user_name = isset($_SESSION['user_name'])?$_SESSION['user_name']:'U000'.$user_id;
        @$myphone = $_SESSION['phone'];

        $rc = gc_merchant_inq($mert_user_id);


        if ($rc == null) {
            show_message("读取商户数据错误! ！", "返回操作界面", 'merchantpay.php', 'info');
        }
        if ($rc['resp_code'] != 0) {
            show_message($rc['resp_msg'], "返回操作界面", 'merchantpay.php', 'info');
        }




        $action = "merchantpay";
        $balance = isset($_SESSION['balance'])?$_SESSION['balance']:0;
        $award_bal =isset($_SESSION['award_bal'])?$_SESSION['award_bal']:0;
        $tb_bal=isset($_SESSION['tb_bal'])?$_SESSION['tb_bal']:0;

        $order_sn = date('YmdHis', time() + 3600 * 8) . $userid;
        $smarty->assign('order_sn', $order_sn);
        $smarty->assign('mert_amount', $mert_amount);

        $smarty->assign('mert_user_id', $mert_user_id);
        $smarty->assign('balance', $balance);
        $smarty->assign('award_bal', $award_bal);
        $smarty->assign('amount', $balance + $award_bal+$tb_bal);
        $smarty->assign('user_name', $user_name);
        $smarty->assign('merchant', $rc);
        $smarty->assign('action', $action);
        $smarty->display('merchant.dwt');
    } else {
        //$ml_phone = isset($_GET['ml_phone']) ? $_GET['ml_phone'] : @$_GET['phone'];
        //获取相应的商家手机号
        @$ml_user = gc_getuserinfo($mert_user_id);
        @$phone = $ml_user['phone'];
        $_SESSION['tuijian']=$phone;
        $_SESSION['back_act']="merchantpay.php?user_id=".$mert_user_id;
        if (isset($_GET["code"])) {
            $res = gc_wxResAndLogin();
            $openid = $_COOKIE["openid"];
            if ($res) {
                $ucdata = empty($user->ucdata) ? "" : $user->ucdata;
                $mert_user_id = $_SESSION['mert_user_id'];
                $Loaction = 'merchantpay.php?user_id=' . $mert_user_id;
                ecs_header("Location: $Loaction\n");
            } else {



                /*
                if ($is_wx == 0) {
                    if (isset($_GET["code"])) {

                        // $res=wx_register($openid,$phone);

                        $_SESSION['m']["do"] = "doregister";
                        $_SESSION['m']['openid'] = $openid;
                        $_SESSION['m']['phone'] = $phone;
                        $_SESSION['m']['mert_user_id'] = $mert_user_id;
                        //  if($res['resp_code']===0){
                        //跳转关注
                        //查询关注
                        //获取关注信息
                        $gz = gc_gz($openid);

                        $subscribe = $gz->subscribe;
                        @$nickname = $gz->nickname;
                        //用户名
                        $_SESSION['m']['nickname'] = $nickname;
                        if ($subscribe == 1) {
                            //
                            //已经关注的情况下

                            $url1 = "user.php?act=user_center&link=merchantpay&ml_phone=" . $phone;
                            $url2 = "merchantpay.php?act=register&ml_phone=" . $phone;
                            $smarty->assign('url1', $url1);
                            $smarty->assign('url2', $url2);
                            $smarty->display('ml100reg.dwt');
                            exit;
                            //exit;


                        } else {
                            //未关注
                           // $url = "https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIwMDIxNDQ5Mg==&scene=110#wechat_redirect";

                            //laila
                            //$url="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzI0MTQzNzUzMw==&scene=110#wechat_redirect";
                            //通兑 MzA4NDY2MTcyOQ

                            $url="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzA4NDY2MTcyOQ==&scene=110#wechat_redirect";


                            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
                            exit;

                        }

                    }
                } else {

                }*/
                echo "<script>window.location.href='user.php?act=user_center&link=merchantpay&ml_phone=" . $phone . "'</script>";
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
                $redurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $uri . '&response_type=code&scope=snsapi_userinfo&state=0101010#wechat_redirect';
                header("location:" . $redurl);
            } else {
                echo "<script>window.location.href='user.php?act=user_center&link=merchantpay&ml_phone=" . $phone . "'</script>";
            }
        }
    }
}

function show_mertmsg($content, $links = '', $hrefs = '', $type = 'info', $auto_redirect = true)
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
    $smarty->assign('page_title', $position['title']);   // 页面标题
    $smarty->assign('ur_here', $position['ur_here']); // 当前位置

    if (is_null($smarty->get_template_vars('helps'))) {
        $smarty->assign('helps', get_shop_help()); // 网店帮助
    }

    $smarty->assign('action', "ml100msg");
    $smarty->assign('auto_redirect', $auto_redirect);
    $smarty->assign('message', $msg);
    $smarty->display('ml100.dwt');

    exit;
}

//获取微信信息
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


    return $subscribe_info;


}
