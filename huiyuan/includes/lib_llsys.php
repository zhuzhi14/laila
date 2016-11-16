<?php

/**
 * TDWSYS 通兑会员数据函数
 * ============================================================================
 * * 版权所有 2005-2012 江苏通兑有限公司，并保留所有权利。
 * 网站地址: http://www.tongduika.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: tdwsys.php 17217 2011-01-19 06:29:08Z liubo $
 */

require_once(ROOT_PATH . '/includes/lib_tdwsys.php');

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

function gc_llsys_inq($user_id,$start='',$size='')
{
    $vars = sprintf("llapi/llsys_inq?user_id=%s&start=%s&size=%s&systemname=MAILA", $user_id,$start,$size);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;
}

function gc_llsys_queue($user_id, $qid)
{
    $vars = sprintf("llapi/llsys_queue?user_id=%d&qid=%s&systemname=MAILA",$user_id, $qid);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;
}

function gc_llsys_order($order)
{
    $vars = sprintf("llapi/llsys_order?ordernum=%s&systemname=MAILA", $order);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;
}

function gc_merchant_inq($user_id)
{
    $vars = sprintf("llapi/merchant_inq?user_id=%s&systemname=MAILA", $user_id);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;
}

function gc_merchant_drawing($user_id,$account,$amount)
{
    $vars = sprintf("llapi/merchant_drawing?user_id=%s&account=%s&amount=%s&systemname=MAILA",
        $user_id,$account,$amount);

    $reqstr = gc_httpcall($vars);

    $output_array = json_decode($reqstr, true);

    return $output_array ;
}


function gc_merchant_translist($user_id,$start,$size)
{
    $vars = sprintf("llapi/merchant_translist?user_id=%s&start=%s&size=%s&systemname=MAILA",
        $user_id,$start,$size);
    //var_dump($vars);
    $reqstr = gc_httpcall($vars);
    //var_dump($reqstr);
    $output_array = json_decode($reqstr,true);
   // var_dump($output_array);
    return $output_array ;
}

function gc_merchant_sale($user_id,$merchant_id,$saletype, $amount)
{
    $vars = sprintf("llapi/merchant_sale?user_id=%s&merchant_id=%s&saletype=%s&amount=%s&systemname=MAILA",
        $user_id,$merchant_id,$saletype, $amount);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;
}
///llapi/merchant_drawinglists?user_id=xx?systemname=xx

function  gc_merchant_drawinglists($user_id){

    $vars = sprintf("llapi/merchant_drawinglists?user_id=%s&systemname=MAILA", $user_id);
    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    // var_dump($reqstr);
    $output_array = json_decode($reqstr, true);

    return $output_array ;

}






?>
