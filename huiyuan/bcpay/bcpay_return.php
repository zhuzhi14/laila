<?php
/**
 * http类型为 Application/json, 非XMLHttpRequest的application/x-www-form-urlencoded, $_POST方式是不能获取到的
 */
define('IN_ECS', true);
require('../includes/init.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');
include_once(ROOT_PATH . 'includes/lib_tdwsys.php');
include_once(ROOT_PATH . 'includes/lib_payment.php');
include_once(ROOT_PATH . 'includes/lib_order.php');
include_once(ROOT_PATH . 'includes/lib_common.php');
include_once(ROOT_PATH . 'includes/lib_llsys.php');
function gc_returnlog($str)
{
    $open = fopen(ROOT_PATH . "bcpay/log.txt", "a");
    fwrite($open, $str);
    fclose($open);
}


$appId = "918ed1ff-f65c-4eed-bf4f-b9c02c06619a";
$appSecret = "75aa0af5-0961-44ac-9fba-34cd8bb3ee60";
$jsonStr = file_get_contents("php://input");
$msg = json_decode($jsonStr);
// webhook字段文档: https://beecloud.cn/doc/?index=webhook
//第一步:验证签名
$sign = md5($appId . $appSecret . sprintf("%.0f", $msg->timestamp));
$str_log = date("Ymd-H:i:s",time()) . $sign . "_" . $msg->sign . "_" . sprintf("%.0f", $msg->timestamp) . "\n";
gc_returnlog($str_log);

if ($sign != $msg->sign) {
    // 签名不正确
    exit();
}
//第二步:过滤重复的Webhook
//客户需要根据订单号进行判重，忽略已经处理过的订单号对应的Webhook
//if(transaction_id对应的订单号已经处理完毕){
//  exit();
//}
//
//第三步:验证订单金额与购买的产品实际金额是否一致
//也就是验证调用Webhook返回的transaction_fee订单金额是否与客户服务端内部的数据库查询得到对应的产品的金额是否相同
//if($msg->transaction_fee != 客户服务端查询得到的实际产品金额){
//  exit();
//}
//第四步:处理业务逻辑和返回


if ($msg->transaction_type == "PAY") { //支付的结果
    //付款信息
    //支付状态是否变为支付成功,true代表成功
    $result = $msg->trade_success;
    //message_detail 参考文档
    //channel_type 微信/支付宝/银联/快钱/京东/百度/易宝/PAYPAL
    $str = "订单处理开始";
    $str .= $msgresult->out_trade_no;
    switch ($msg->channel_type) {
        //微信

        case "WX":
            $msgresult = $msg->message_detail;
            $order_sn = $msgresult->out_trade_no;
            $log = explode("T", $msgresult->out_trade_no);
            $log_id = $log[1];
            if ($log_id == "s") {

                $order_sn = $log[0];
                $sql = "select * from " . $ecs->table('order_info') . "where `order_sn`=" . $order_sn;
                //  echo $sql;

                $result = $db->getAll($sql);
                //  var_dump($result);


                $order = $result[0];


                // var_dump($order);

                $gold_total = (float)$order["goods_amount"];
                // $order["user_id"] = $_SESSION["user_id"];
                $order["order_sn"] = $order_sn;
                $_LANG['pay_order'] = "金币支付" . "订单号：" . $order['order_sn'];
                $str .= $_LANG["pay_order"] . "_";

                $acc = log_account_change($order['user_id'], 0, 0, 0, $gold_total * (-1), sprintf($_LANG['pay_order'], $order['order_sn']), "", $order['order_sn']);

                $str .= $acc;
                //var_dump($acc);

               if(!$acc) {
                   $order['order_status'] = OS_CONFIRMED;
                   $order['confirm_time'] = gmtime();
                   $order['pay_status'] = PS_PAYED;
                   $order['pay_time'] = gmtime();
                   $order['order_amount'] = 0;

                   $error_no = 0;
                   do {


                       $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('order_info'), $order, 'update', 'order_sn=' . $order['order_sn']);

                       $error_no = $GLOBALS['db']->errno();

                       if ($error_no > 0 && $error_no != 1062) {
                           die($GLOBALS['db']->errorMsg());
                       }
                   } while ($error_no == 1062);


                   $str .= date("Ymd-H:i:s",time()) . '|' . $msgresult->out_trade_no . $log[0] . $log[1] . "\n";

                   gc_returnlog($str);
               }else{

                   $str .="购物:".$order['order_sn']."支付失败".date("Ymd-H:i:s", time())."\n";
                   gc_returnlog($str);
                   echo  "error_wx_shop";
                   exit;


               }

            } else if ($log_id == 'sm') {
                //ml100 订单处理

                $order_sn = $log[0];
                $sql = "select * from " . $ecs->table('maila') . "where `is_pay`=0 and `bordernum`=" . $order_sn;
                //  echo $sql;

                $result = $db->getAll($sql);
                if(!empty($result)) {
                    $jieguo = $result[0];
                    if ($jieguo['whopay'] == 0) {

                        $log="error:用户不存在:".$order_sn."\n";
                        gc_returnlog($log);

                        echo "error_user_empty";
                        exit();


                    }


                    $user_id = $jieguo['whopay'];


                    $mert_user_id = $jieguo['mert_user_id'];
                    $money = $jieguo['buy_amt'];
                    $order_sn = $jieguo['bordernum'];

                    $_LANG['pay_order'] = "扫码支付";
                    $saletype = 'PAY';
                    $row = gc_merchant_sale($user_id, $mert_user_id, $saletype, $money);
                    if ($row == null) {

                        $pay_res = "支付失败";
                        $log=$user_id.'-'.$order_sn.$pay_res.'\n';
                        gc_returnlog($log);

                        exit();

                    }
                    if ($row['resp_code'] == 0) {
                        update_maila_pay('1', $order_sn);
                        $pay_res = "支付成功";

                    } else {

                        $pay_res = "支付失败";
                        $log=$user_id.'-'.$order_sn.$pay_res.'\n';
                        gc_returnlog($log);
                        exit();
                    }


                    $str .= "wx扫码支付:" . date("YmdH:i:s",time()) . "订单号：" . $order_sn . $row['resp_code'] . $pay_res . serialize($row) . $user_id . $mert_user_id . $saletype . $money;

                    gc_returnlog($str);
                }else{

                    $str .="error_wx:订单号：" . $order_sn."已经成功支付了\n";
                      gc_returnlog($str);
                    echo  "error_wx";
                    exit();



                }


            } else {


                $uid = $log[2];
                $payresult = gc_zfb_sh($uid, $log_id);

                $str .= "充值：订单号" . $order_sn . "时间：" . date("Ymd-H:i:s", time()) . "用户" . $log[1] . "结果：" . $payresult["resp_code"] . "\n";
                gc_returnlog($str);
            }




            break;
        case "ALI":
            $msgresult = $msg->message_detail;
            $order_sn = $msgresult->out_trade_no;
            $log = explode("T", $msgresult->out_trade_no);

            $log_id = $log[1];
            if ($log_id == "s") {

                $order_sn = $log[0];
                $sql = "select * from " . $ecs->table('order_info') . "where `order_sn`=" . $order_sn;
                //  echo $sql;

                $result = $db->getAll($sql);
                //  var_dump($result);


                $order = $result[0];


                // var_dump($order);

                $gold_total = (float)$order["goods_amount"];
                // $order["user_id"] = $_SESSION["user_id"];
                $order["order_sn"] = $order_sn;
                $_LANG['pay_order'] = "金币支付" . "订单号：" . $order['order_sn'];
                $acc = log_account_change($order['user_id'], 0, 0, 0, $gold_total * (-1), sprintf($_LANG['pay_order'], $order['order_sn']), "", $order['order_sn']);


                //var_dump($acc);
               if(!$acc) {

                   $order['order_status'] = OS_CONFIRMED;
                   $order['confirm_time'] = gmtime();
                   $order['pay_status'] = PS_PAYED;
                   $order['pay_time'] = gmtime();
                   $order['order_amount'] = 0;

                   $error_no = 0;
                   do {


                       $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('order_info'), $order, 'update', 'order_sn=' . $order['order_sn']);

                       $error_no = $GLOBALS['db']->errno();

                       if ($error_no > 0 && $error_no != 1062) {
                           die($GLOBALS['db']->errorMsg());
                       }
                   } while ($error_no == 1062);


                   $str = date("Ymd-H:i:s", time()) . "购物:" . $_LANG['pay_order'] . $log[1] . "\n";

               }else{
                   $str .="购物:".$order['order_sn']."支付失败".date("Ymd-H:i:s", time())."\n";
                   gc_returnlog($str);
                   echo  "error_ali";
                   exit;

               }

            } else if ($log_id== 'sm') {
                //ml100订单处理

                //ml100 订单处理

                $order_sn = $log[0];
                $sql = "select * from " . $ecs->table('maila') . "where  `is_pay`=0 and  `bordernum`=" . $order_sn;
                //  echo $sql;
                $result = $db->getAll($sql);
               if(!empty($result)) {

                   $jieguo = $result[0];
                   if ($jieguo['whopay'] == 0) {


                       $log="error:用户不存在:".$order_sn."\n";
                       gc_returnlog($log);

                       echo "error_user_empty";
                       exit();

                   }

                   $user_id = $jieguo['whopay'];
                   $mert_user_id = $jieguo['mert_user_id'];
                   $money = $jieguo['buy_amt'];
                   $order_sn = $jieguo['bordernum'];
                   $_LANG['pay_order'] = "扫码支付";
                   $saletype = 'PAY';
                   if (strlen($user_id) > 0) {
                       $row = gc_merchant_sale($user_id, $mert_user_id, $saletype, $money);

                   } else {
                       $sql = "select * from " . $ecs->table('maila') . "where `bordernum`=" . $order_sn;
                       //  echo $sql;
                       $result = $db->getAll($sql);
                       $jieguo = $result[0];

                       $user_id = $jieguo['whopay'];
                       $mert_user_id = $jieguo['mert_user_id'];
                       $money = $jieguo['buy_amt'];
                       $order_sn = $jieguo['bordernum'];
                       $_LANG['pay_order'] = "扫码支付";
                       $saletype = 'PAY';
                       $row = gc_merchant_sale($user_id, $mert_user_id, $saletype, $money);


                   }
                   if ($row == null) {

                       $pay_res = "支付失败";
                       $log=$user_id.'-'.$order_sn.$pay_res.'\n';
                       gc_returnlog($log);
                       exit();

                   }

                   if ($row['resp_code'] == 0) {
                       update_maila_pay('1', $order_sn);
                       $pay_res = "支付成功";

                   } else {

                       $pay_res = "支付失败";
                       $log=$user_id.'-'.$order_sn.$pay_res.'\n';
                       gc_returnlog($log);
                       exit();
                   }

                   $str .= "ali扫码支付:" . date("YmdH:i:s",time()) . "订单号：" . $order_sn . $row['resp_code'] . $pay_res . serialize($row) . $user_id . $mert_user_id . $saletype . $money;
               }else{
                   $str .="error_ali:订单号：" . $order_sn."已经成功支付\n";
                      gc_returnlog($str);
                    echo  "error_ali";
                    exit();




               }


                } else {
                $uid = $log[2];
                $payresult = gc_zfb_sh($uid, $log_id);
                $str .= "充值：订单号" . $order_sn . "时间：" . date("Ymd-H:i:s", time()) . "用户" . $log[1] . "结果：" . $payresult["resp_code"] . "\n";

            }

            //print_r($str);
            gc_returnlog($str);


            break;
        case "UN":
            break;
        case "KUAIQIAN":
            break;
        case "JD":
            break;
        case "BD":
            break;
        case "YEE":
            break;
        case "PAYPAL":
            break;
    }
} else if ($msg->transaction_type == "REFUND") { //退款的结果
}

//打印所有字段

//处理消息成功,不需要持续通知此消息返回success
echo 'success';