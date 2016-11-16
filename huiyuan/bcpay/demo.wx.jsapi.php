<?php
define('IN_ECS', true);
require('../includes/init.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');
include_once('dependency/WxPayPubHelper/WxPayPubHelper.php');
$jsApi = new JsApi_pub();
//网页授权获取用户openid
//通过code获得openid
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$app_id="918ed1ff-f65c-4eed-bf4f-b9c02c06619a";
//$app_secret = "fd88e381-d6d3-45eb-b2cb-86f0cb2a51fe";
$app_secret="75aa0af5-0961-44ac-9fba-34cd8bb3ee60";
if (strpos($user_agent, 'MicroMessenger') === false) {
    // 非微信浏览器禁止浏览
    $is_wx=1;
} else {
    // 微信浏览器，允许访问
    $is_wx=0;
}
$openid ="";
if($is_wx==0) {
    try {
        if (!isset($_GET['code'])) {
            //触发微信返回code码
            $uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];

            $uri = urlencode($uri);//这里需要urlencode一下
            $wxinfo = get_wxinfo();
            $appid = $wxinfo['appid'];
            $appsecret = $wxinfo['secret'];
            $redurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $uri . '&response_type=code&scope=snsapi_userinfo&state=0101010#wechat_redirect';
            header("location:" . $redurl);

        } else {
            //获取code码，以获取openid
            $openid = gc_get_openid();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}


//echo $openid;

$do = isset($_GET["do"]) ? $_GET["do"] : "chongzhi";
$type=isset($_GET['type'])?$_GET['type']:"";
$user_id=isset($_GET['user_id'])?$_GET['user_id']:"";
$get_time = date("Y-m-d H:i:s", time());
if($do==='saoma'){

    $order_sn = $_GET["order_sn"];
    $money = $_GET["money"];
    $name=$_GET['name'];
    $title="付款";
    $nametype="1";
    $data = array(
        "app_id" => $app_id,
        "title" => $name,
        "amount" => $money * 100,
        "openid" => $openid,
        "out_trade_no" => $order_sn . "Tsm",
        "trace_id" => "testcustomer"
    );




}else if ($do === "shopping") {
    $order_sn = $_GET["order_sn"];
    $money = $_GET["money"];
    $title="付款";
    $nametype="0";
    $data = array(
        "app_id" => $app_id,
        "title" => "麦啦商城" . $order_sn,
        "amount" => $money * 100,
        "openid" => $openid,
        "out_trade_no" => $order_sn . "Ts",
        "trace_id" => "testcustomer"
    );


} else {

    $money = $_GET["money"];
    $title="充值";
    $nametype="0";
    $data = array(
        "app_id" => $app_id,
        "title" => "麦啦充值",
        "amount" => $_GET["money"] * 100,
        "openid" => $openid,
        "trace_id" => "testcustomer"
    );

    $pay_status = $_GET['pay_status'];

    $user_id=$_GET["user_id"];
    if ($pay_status == "chongzhi") {

        $payment_id = "5";

        $surplus = array(
            'user_id' => $user_id,
            'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0,
            'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
            'payment_id' => $payment_id,
            'user_note' => isset($_POST['user_note']) ? trim($_POST['user_note']) : '充值',
            'bankname' => '',
            'bankaddress' => '',
            'myname' => '',
            'myaccount' => '',
            'amount' => $money
        );

        $payment_info = array();
        // $payment_info = payment_info($surplus['payment_id']);

        // var_dump($payment_info);

        //$surplus['payment'] = ;

        if ($surplus['rec_id'] > 0) {
            //更新会员账目明细
            $surplus['rec_id'] = update_user_account($surplus);
        } else {
            //插入会员账目明细
            $surplus['rec_id'] = insert_user_account($surplus, $money);
        }

        //取得支付信息，生成支付代码
        //$payment = unserialize_config($payment_info['pay_config']);

        //生成伪订单号, 不足的时候补0
        $order = array();

        $order['order_sn'] = "麦啦商城充值，订单号:" . $surplus['rec_id'];
        $order['user_name'] = $_SESSION['user_name'];
        $order['surplus_amount'] = $money;

        //计算支付手续费用

        // $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount'] = $order['surplus_amount'];

        //记录支付log
        $log_id = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type = PAY_SURPLUS, 0);

        $data["title"] = "麦啦商城充值" . $surplus['rec_id'];
        $data["out_trade_no"] = time() . "T" . $surplus['rec_id'] . "T" . $user_id;//订单号，需要保证唯一性


    }
}



$sign = md5($data['app_id'] . $data['title'] . $data['amount'] . $data['out_trade_no'] . $app_secret);
$data["sign"] = $sign;
$data["optional"] = json_decode(json_encode(array("hello" => "1")));
//
$newurl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$num = strrpos($newurl, '/');
// $shorturl = substr($newurl, $num + 1);
$yuanurl = substr($newurl, 0, $num - 5);

$return_url = "http://" . $yuanurl . "respond.php";
//手机打开的返回地址

if (($ua == '' || preg_match($uachar, $ua)) && !strpos(strtolower($_SERVER['REQUEST_URI']), 'wap')) {
    //$data['return_url'] = "http://" . $yuanurl . "mobile/respond.php";
}
if($type=="saoma"){

   // $data['return_url'] = "http://" . $yuanurl . "mobile/respond.php?type=ml100&user_id=".$user_id;

}



?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title><?php $title ?></title>
</head>
<body>

<div style="text-align: center">
    <?php if($nametype==1){ ?>
        <h3>商户：<span style="color:red"><?php echo $name?></span></h3>
        <hr />

    <?php } ?>
    <h3>订单总金额:<span style="color: red"><?php echo $money ?></span>元</h3>
    <hr/>
    <h3>订单时间：<span style="color: red"><?php echo $get_time ?></h3>

    <div>

        <div id="qr"></div>
        <script id='spay-script' type='text/javascript'
                src='https://jspay.beecloud.cn/1/pay/jsbutton/returnscripts?appId=918ed1ff-f65c-4eed-bf4f-b9c02c06619a'></script>


        <script>
            window.onload = asyncPay();

            function bcPay() {
                BC.click(<?php echo json_encode($data) ?>, {
                    wxJsapiFinish: function (res) {
                        //jsapi接口调用完成后
                        //alert(JSON.stringify(res));
                        if(res.err_msg == "get_brand_wcpay_request:ok") {
                           // alert("成功支付");
                            <?php  if($type=='ml100'){ ?>
                            window.location.href="../mobile/respond.php?type=ml100&user_id="<?php echo $user_id?>;
                            <?php  }else{?>
                            window.location.href="../mobile/respond.php";
                            <?php } ?>
                        }
                    }
                });
            }

            // 这里不直接调用BC.click的原因是防止用户点击过快，BC的JS还没加载完成就点击了支付按钮。
            // 实际使用过程中，如果用户不可能在页面加载过程中立刻点击支付按钮，就没有必要利用asyncPay的方式，而是可以直接调用BC.click。
            function asyncPay() {
                if (typeof BC == "undefined") {
                    if (document.addEventListener) { // 大部分浏览器
                        document.addEventListener('beecloud:onready', bcPay, false);
                    } else if (document.attachEvent) { // 兼容IE 11之前的版本
                        document.attachEvent('beecloud:onready', bcPay);
                    }
                } else {
                    bcPay();
                }
            }
        </script>
</body>
</html>
