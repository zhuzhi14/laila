<?php

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
date_default_timezone_set("Asia/Shanghai");

$action = isset($_GET['act']) ? $_GET['act'] : '';
$data = array();
$template_id = "";
$touser = isset($_GET['open_id']) ? trim($_GET['open_id']) : '';
if ($action == 'change') {
    $phone = isset($_GET['phone']) ? trim($_GET['phone']) : '';
    $name =  isset($_GET['name']) ? trim($_GET['name']) : '';

    $trade_type = isset($_GET['change_type']) ? $_GET['change_type'] : '';
    $trade_desc = isset($_GET['change_desc']) ? $_GET['change_desc']."\r\n" : '';

    $c_balance = isset($_GET['c_balance']) ? "余额：".$_GET['c_balance']."  " : '';
    $c_award_bal = isset($_GET['c_award_bal']) ? "积分：".$_GET['c_award_bal']."  " : '';
    $c_gold_amt = isset($_GET['c_gold_amt']) ? "金币：".$_GET['c_gold_amt'] : '';
    $c_lb_bal = isset($_GET['c_lb_bal']) ? "L币：".$_GET['c_lb_bal']."  " : '';
    $c_tb_bal = isset($_GET['c_tb_bal']) ? "T币：".$_GET['c_tb_bal']."  " : '';
    $trade_amount = $c_balance.$c_award_bal.$c_gold_amt.$c_tb_bal.$c_lb_bal;

    $balance = isset($_GET['balance']) ? "余额：".$_GET['balance']."  " : '';
    $award_bal = isset($_GET['award_bal']) ? "积分：".$_GET['award_bal']."  " : '';
    $gold_amt = isset($_GET['gold_amt']) ? "金币：".$_GET['gold_amt'] : '';
    $lb_bal = isset($_GET['lb_bal']) ? "L币：".$_GET['lb_bal']."  " : '';
    $tb_bal = isset($_GET['tb_bal']) ? "T币：".$_GET['tb_bal']."  " : '';
    $trade_remain = $balance.$award_bal.$gold_amt.$tb_bal.$lb_bal;

    $change_time = isset($_GET['change_time']) ? trim($_GET['change_time']) : time();
    $change_time =date('Y-m-d H:i', $change_time);
    $template_id = "UePXT3XFo5upmajTZ9srmYXBpxdGUvoa5VHkwyVUN3E";

    $first = "尊敬的".$name."：\r\n\r\n您的账户资金最新变动信息";
    if ($trade_type == "432000")
        $url =  "http://m.tongdui.cn/mobile/ll.php";
    else
        $url = "http://m.tongdui.cn/mobile/user.php?act=account_detail&open_id=".$touser;

    $data = array('first'  => array('value' => $first),
        'keyword1' => array('value' => $phone, 'color' => "#173177"),
        'keyword2' => array('value' => $change_time, 'color' => "#173177"),
        'keyword3' => array('value' => $trade_amount, 'color' => "#173177"),
        'keyword4' => array('value' => $trade_remain, 'color' => "#173177"),
        'keyword5' => array('value' => $trade_desc, 'color' => "#173177"),
        'remark' => array('value' =>"点详情，可查看资金变动明细")
    );
}else {

    $code = isset($_GET['code']) ? $_GET['code']."\r\n" : '';
    if ($code == ''){
        exit;
    }else {
        $template_id = "qvKpXIDauve6_Z3wtekD3iqcP6GKZq2KuHm_8WFDHt8";
        $first = "尊敬的".$name."：\r\n\r\n您手机动态验证码";
        $url = "";
        $data = array('first'  => array('value' => $first),
            'number' => array('value' => $code, 'color' => "#173177"),
            'remark' => array('value' =>"验证码有效期为10分钟")
        );
    }

}
$accessToken = getAccessToken();
$res = $templateMsgSDK->send_template_message($touser, $template_id, $url, '',$data ,$accessToken);
if ($res['errcode'] == 40001) {
    $token_detail = json_decode(get_php_file("access_token.php"));
    $appId = getAppId();
    $appSecret = getAppSecret();
    $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
    $result = json_decode(http_request($token_url));
    $access_token = $result->access_token;
    if ($access_token) {
        $token_detail->expire_time = time() + 7000;
        $token_detail->access_token = $access_token;
        set_php_file("access_token.php", json_encode($token_detail));
    }
    $res = $templateMsgSDK->send_template_message($touser, $template_id, $url, '',$data ,$access_token);

}
var_dump($res);
?>