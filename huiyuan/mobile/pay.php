<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/23
 * Time: 10:37
 */

// 充值接口  包括 两种方式  一种支付宝 一种微信

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/includes/lib_main.php');
require_once(ROOT_PATH . '/includes/lib_tdwsys.php');
include_once(ROOT_PATH .'includes/lib_payment.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');
include_once(ROOT_PATH . 'includes/lib_order.php');
if ($_SESSION['user_id'] > 0)
{
   // $smarty->assign('user_name', $_SESSION['user_name']);
}else{
    //ecs_header("Location:user.php\n");

}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($user_agent, 'MicroMessenger') === false) {
    // 非微信浏览器禁止浏览
    $is_wx=1;
} else {
    // 微信浏览器，允许访问
    $is_wx=0;
}




$paymethod=isset($_POST['paymethod'])?$_POST['paymethod']:"default";

$money=isset($_POST['money'])?$_POST['money']:"";

$pay_status=isset($_COOKIE['openid'])?1:0;

$user_id=$_GET["user_id"];

$openid=isset($_COOKIE['openid'])?$_COOKIE['openid']:0;


//支付宝支付
/*

if($paymethod=="alipay"){
    $user_id=$_SESSION['user_id'];
    $payment_id="5";
    $amount=$money;
    $surplus = array(
        'user_id' => $_SESSION['user_id'],
        'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0,
        'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
        'payment_id' => $payment_id,
        'user_note' => '支付宝充值',
        'bankname'    => '',
        'bankaddress'    => '',
        'myname'    => '',
        'myaccount'    => '',
        'amount' => $money
    );




    //获取支付方式名称
    $payment_info = array();
    $payment_info = payment_info($surplus['payment_id']);

   // var_dump($payment_info);

    $surplus['payment'] = $payment_info['pay_name'];

    if ($surplus['rec_id'] > 0)
    {
        //更新会员账目明细
        $surplus['rec_id'] = update_user_account($surplus);
    }
    else
    {
        //插入会员账目明细
        $surplus['rec_id'] = insert_user_account($surplus, $money);
    }
    //取得支付信息，生成支付代码
    $payment = unserialize_config($payment_info['pay_config']);

    //生成伪订单号, 不足的时候补0
    $order = array();

    $order['order_sn']	   = "麦啦商城充值，订单号:".$surplus['rec_id'];
    $order['user_name']	  = $_SESSION['user_name'];
    $order['surplus_amount'] = $money;

    //计算支付手续费用

   // $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

    //计算此次预付款需要支付的总金额
    $order['order_amount']   = $amount + $payment_info['pay_fee'];

    //记录支付log
    $order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type=PAY_SURPLUS, 0)."_".$user_id;

    /* 调用相应的支付方式文件
    //如果存在是支付宝不是就用原来的
    if($pay_status==1&&$payment_info['pay_code']=='alipay') {
        include_once(ROOT_PATH . 'includes/modules/payment/alipay_mobile.php');
    }else{
        include_once(ROOT_PATH . 'includes/modules/payment/alipay_mobile.php');

    }


    /* 取得在线支付方式的支付按钮
    $pay_obj = new alipay();
    $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

   // var_dump($payment_info);

    $_SESSION["order_id"]=$order['log_id'];


   // var_dump($_SESSION);

    /* 模板赋值
    $smarty->assign("paymethod",$paymethod);
    $smarty->assign('payment', $payment_info);
    $smarty->assign('button',$payment_info['pay_button']);
     $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
    $smarty->assign('money', price_format($amount, false));
    $smarty->assign('order', $order);



 //微信支付
}else if($paymethod=="wxpay"){
    $user_id=$_SESSION['user_id'];
    $surplus = array(
        'user_id' => $_SESSION['user_id'],
        'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0,
        'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
        'payment_id' => 0,
        'user_note' =>'微信充值',
        'bankname'    => '',
        'bankaddress'    => '',
        'myname'    => '',
        'myaccount'    => '',
        'amount' => $money
    );
    if ($surplus['rec_id'] > 0)
    {
        //更新会员账目明细
        $surplus['rec_id'] = @update_user_account($surplus);
    }
    else
    {
        //插入会员账目明细
        $surplus['rec_id'] = @insert_user_account($surplus, $money);
    }

    $rec_id=$surplus['rec_id'];

    $smarty->assign("paymethod",$paymethod);
    $order_id=$user_id."_".$rec_id;
 //   $_SESSION['money']=$money;

   // $smarty->assign("rec_id",$rec_id);
      $smarty->assign("amount",$money);
   // var_dump($_SESSION);
    $smarty->assign('money', price_format($money, false));
    $smarty->assign('order_id',$order_id);
    $smarty->assign('openid',$openid);

*/

if($paymethod=="default"){

   $smarty->assign("user_id",$_GET["user_id"]);
   $smarty->assign("pay_status",$pay_status);
    $smarty->assign("openid",$openid);

    $smarty->assign('paymethod',$paymethod);

}


$smarty->display("pay.dwt");








