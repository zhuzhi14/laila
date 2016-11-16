<?php

/**
 * ECSHOP 支付宝插件
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: douqinghua $
 * $Id: alipay.php 17217 2011-01-19 06:29:08Z douqinghua $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/alipay.php';
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc']    = 'alipay_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = 'ECSHOP TEAM';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.alipay.com';

    /* 版本号 */
    $modules[$i]['version'] = '1.0.2';

    /* 配置信息 */
    $modules[$i]['config']  = array(
        array('name' => 'alipay_account',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_key',               'type' => 'text',   'value' => ''),
        array('name' => 'alipay_partner',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_pay_method',        'type' => 'select', 'value' => '')
    );

    return;
}

/**
 * 类
 */
class alipay
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function __construct()
    {
        $this->alipay();
    }



    function alipay()
    {
    }



    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
        if (!defined('EC_CHARSET'))
        {
            $charset = 'utf-8';
        }
        else
        {
            $charset = EC_CHARSET;
        }

        $real_method = $payment['alipay_pay_method'];

        switch ($real_method){
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }

        $extend_param = 'isv^sh22';

        $parameter = array(
            'extend_param'      => $extend_param,
            'service'           => $service,
            'partner'           => $payment['alipay_partner'],
            //'partner'           => ALIPAY_ID,
            '_input_charset'    => $charset,
            'notify_url'        =>notify_url(),
            'return_url'        => return_url(basename(__FILE__, '.php')),
            /* 业务参数 */
            'subject'           => $order['order_sn'],
            'out_trade_no'      => $order['order_sn'] . $order['log_id'],
            'price'             => $order['order_amount'],
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            /* 买卖双方信息 */
            'seller_email'      => $payment['alipay_account']
        );

        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }

        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        //$sign  = substr($sign, 0, -1). ALIPAY_AUTH;

        $src='https://mapi.alipay.com/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5';
       /*$html='<html><head lang="zh-cn"><meta charset="UTF-8" /><title>支付宝付款</title><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" /><link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" /></script></head>';
        $html.='<div class="container"><div style="text-align: center;font-size:16px;">由于微信限制,<br />请复制以下链接在浏览器中打开</div>';
        $html.='<div style="width:100%;heght:100%;border:3px solid #ccc;word-wrap:break-word;overflow:auto">'.$src.'</div></div></body></html>';
        $user_id=$_SESSION['user_id'];
        $name_url="alipay/".$user_id;
        if(!file_exists($name_url)){
            mkdir($name_url);
        }
        $newurl=$name_url."/alipay.html";
        file_put_contents($newurl,$html);
*/

        $button='<script src="ap.js"></script>';
      // $button .= '<button ><a href="#" class="btn btn-info ect-btn-info ect-colorf ect-bg" onclick="_AP.pay(\'' . $src. '\')" class="c-btn3" >点击付款</a></button></div>';
     $button.= '<div style="text-align:center"><input type="button" onclick="_AP.pay(\'' . $src. '\')" value="点击付款" /></div>';


        return $button;
    }

    /**
     * 响应操作
     */
    function respond()
    {
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
       // require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
       // var_dump($_GET);
        $payment  = get_payment($_GET['code']);
        $seller_email = rawurldecode($_GET['seller_email']);
        $order_sn = str_replace($_GET['subject'], '', $_GET['out_trade_no']);
        //  $order_sn = $_GET['subject'];
         $sid=$_GET['subject'];
        $uid=$_SESSION['user_id'];


       // var_dump($order_sn);
        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);

        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }

        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        //$sign = substr($sign, 0, -1) . ALIPAY_AUTH;
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }

        /* 检查支付的金额是否相符 */
        if (!check_money($order_sn, $_GET['total_fee']))
        {
         return false;
        }

        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            /* 改变订单状态 */
          order_paid($order_sn, 2);

           return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            /* 改变订单状态 */
           order_paid($order_sn);

         return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_SUCCESS')
        {

            return true;
        }
        else
        {
            return false;
        }
    }
/*
    function order_paid_new($user_id,$sid){

        $vars=sprintf("acapi/confirmaccountcheck?user_id=%s&sid=%s&adminnote=PASS&admin_user=admin&systemname=MAILA",$user_id,$sid);


        $newfile="http://192.168.100.13:1092/".$vars;
        $timeout = array(
            'http'=> array(
                'timeout'=>240//设置一个超时时间，单位为秒
            )
        );
        $ctx = stream_context_create($timeout);
      //  var_dump($newfile);
        $result=file_get_contents($newfile,0, $ctx);


        //var_dump($result);
      //  $ch = curl_init();
     //   curl_setopt($ch, CURLOPT_URL, "$newfile");
      //  curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');

      //  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      //  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 160);
      //  curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
      //  curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
      //  curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        //var_dump($newfile);
      //  var_dump(curl_error($ch));
        // curl_close($curl);
        // return $result;
      //  $reqstr = strstr($result,"{") ;
       // return $reqstr;
        //var_dump($result);





    }

*/

}

?>