<?php
define('IN_ECS', true);
require_once('../includes/init.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');
include_once(ROOT_PATH . 'includes/lib_payment.php');
$app_id = "918ed1ff-f65c-4eed-bf4f-b9c02c06619a";
$app_secret = "75aa0af5-0961-44ac-9fba-34cd8bb3ee60";
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|coolpad|ktouch|tcl|oppo|doov|amoi|bbk|cect|amoi|zte|huawei|iphone|ipad|android|smartphone)/i";
$do = isset($_GET["do"]) ? $_GET["do"] : "chongzhi";

$type=isset($_GET["type"])?$_GET["type"]:"";
//$newurl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
//$num = strrpos($newurl, '/');
// $shorturl = substr($newurl, $num + 1);
//$yuanurl = substr($newurl, 0, $num - 5);

//$return_url = "http://" . $yuanurl . "respond.php";
//手机打开的返回地址

if (($ua == '' || preg_match($uachar, $ua)) && !strpos(strtolower($_SERVER['REQUEST_URI']), 'wap')) {
  //  $return_url = "http://" . $yuanurl . "mobile/respond.php";
}
if($type=="ml100"){

   // $return_url = "http://" . $yuanurl . "mobile/respond.php?type=ml100";


}

$get_time = date("Y-m-d  H:i:s", time());
if($do==='saoma'){

    $order_sn = $_GET["order_sn"];
    $title="付款";
    $nametype="1";


    $money = $_GET["money"];
    $name=$_GET['name'];
    $amount = $money * 100;
    $title = $name;
    $out_trade_no = $order_sn . "Tsm";
    $sign = md5($app_id . $title . $amount . $out_trade_no . $app_secret);




}else if ($do == "shopping") {
    $order_sn = $_GET["order_sn"];
    $money = $_GET["money"];
    $amount = $money * 100;
    $title = "麦啦商城" . $order_sn;
    $nametype="0";
    $out_trade_no = $order_sn . "Ts";

    $sign = md5($app_id . $title . $amount . $out_trade_no . $app_secret);


} else {

    $title = "商城充值";
    $nametype="0";
    $money = $_POST["money"];
    $amount = $_POST["money"] * 100;//支付总价
    $user_id =$_POST["user_id"];
    // $out_trade_no=time()."bc";
    // $title="1212";


    $pay_status = $_POST['pay_status'];
//插入充值ID
    if ($pay_status == "chongzhi") {
        $user_id = $user_id;
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

        $order['order_sn'] = "商城充值，订单号:" . $surplus['rec_id'];
        $order['user_name'] = $_SESSION['user_name'];
        $order['surplus_amount'] = $money;

        //计算支付手续费用

        // $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount'] = $order['surplus_amount'];

        //记录支付log
        $log_id = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type = PAY_SURPLUS, 0);

        $title = "商城充值" . $surplus['rec_id'];
        $out_trade_no = time() . "T" . $surplus['rec_id'] . "T" . $user_id;//订单号，需要保证唯一性


    }


//1.生成sign
    // $str=  $app_id . $title . $amount . $out_trade_no . $app_secret;


    $sign = md5($app_id . $title . $amount . $out_trade_no . $app_secret);

}

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <!--用于移动端H5页面适配，若PC端页面可不引用-->
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title><?php  echo $title?></title>

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

        <!--2.添加控制台->APP->设置->秒支付button项获得的script标签-->
        <script id='spay-script'
                src='https://jspay.beecloud.cn/1/pay/jsbutton/returnscripts?appId=918ed1ff-f65c-4eed-bf4f-b9c02c06619a'></script>
        <script>
            //3. 需要发起支付时(示例中绑定在一个按钮的click事件中),调用BC.click方法

            window.onload = bcPay();

            function bcPay() {
                BC.click({
                    "title": "<?php echo $title; ?>",
                    "amount": <?php echo $amount; ?>,
                    "out_trade_no": "<?php echo $out_trade_no;?>", //唯一订单号
                    "sign": "<?php echo $sign;?>",
                    "return_url": "",
                    /**
                     * optional 为自定义参数对象，目前只支持基本类型的key ＝》 value, 不支持嵌套对象；
                     * 回调时如果有optional则会传递给webhook地址，webhook的使用请查阅文档
                     */
                    "optional": {"test": "willreturn"}
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
