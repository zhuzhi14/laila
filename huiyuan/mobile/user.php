<?php

/**
 * ECSHOP 用户中心
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: user.php 16643 2009-09-08 07:02:13Z liubo $
 */

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
//require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
require_once(ROOT_PATH . '/includes/lib_tdwsys.php');
require(ROOT_PATH . 'includes/lib_order.php');
require(ROOT_PATH . 'includes/lib_payment.php');
require(ROOT_PATH.'includes/lib_clips.php');

//print_r("users begin\r\n") ;
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$cp = isset($_REQUEST['cp']) ? $_REQUEST['cp'] : '';

$total_goods=isset($_SESSION['total_goods'])?$_SESSION["total_goods"]:'0';
$smarty->assign("total_goods",$total_goods);
if ($_SESSION['user_id'] > 0)
{
    $smarty->assign('user_name', $_SESSION['user_name']);
}else{
   // show_user_center();
}
$action = isset($_GET['act']) ? $_GET['act'] : '';
//var_dump($action);
$user_id = $_SESSION['user_id'];
$smarty->assign('action', $action);
$smarty->assign('user_id', $user_id) ;

$disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;
$smarty->assign('disphard', $disphard);

$systemid='MAILA' ;

gc_writelog("<begin!!".$action.">", __FILE__, __LINE__) ;

/* 显示页面的action列表 */
$ui_arr = array('register','in_register','login', 'profile', 'order_list', 'order_detail', 'address_list', 'collection_list','gpos',
    'message_list', 'tag_list', 'get_password', 'reset_password', 'booking_list', 'add_booking', 'account_raply','account_award','account_goldtransfer',
    'account_deposit', 'account_log','account_list','accountjf_list', 'account_detail','account_detailjf', 'act_account', 'pay', 'default', 'bonus', 'group_buy', 'group_buy_detail', 'affiliate', 'afftree','stock_trade','comment_list','upvip','fhlist','myreg','myrecom','buy_list','account_list','upbaodan','in_register','validate_email','track_packages', 'transform_points','qpassword_name', 'get_passwd_question', 'check_answer','safe_center','true_info','act_add_card','ml100');


/* 取出大家共用的数字 */
$myrank=isset($_SESSION['user_rank'])?$_SESSION['user_rank']:"" ;
$mybuss=isset($_SESSION['buss_rank'])?$_SESSION['buss_rank']:"" ;
$mybranch=isset($_SESSION['branch_rank'])?$_SESSION['branch_rank']:"" ;
$mylevel=isset($_SESSION['relevel'])?$_SESSION['relevel']:"" ;
$myphone=isset($_SESSION['phone'])?$_SESSION['phone']:"" ;
$user_name=isset($_SESSION['user_name'])?$_SESSION['user_name']:"" ;
$urankname = "" ;

if ($myrank == '1') $urankname = "一般用户" ;
if ($myrank == '2') $urankname = '<font color="#0000FF">麦啦会员</font>' ;
if ($myrank == '3') $urankname = '<font color="#0000FF">服务商</font>' ;
if ($myrank == '4') {
    $urankname = "一般" ;
    if ($mybuss == '1') $bussrankname = '<font color="#088A08">☆' ;
    else if ($mybuss == '2') $bussrankname = '<font color="#FFBF00">☆☆' ;
    else if ($mybuss == '3') $bussrankname = '<font color="#DF013A">☆☆☆' ;
    else if ($mybuss == '4') $bussrankname = '<font color="#DF013A">☆☆☆☆' ;
    else if ($mybuss == '5') $bussrankname = '<font color="#DF013A">区域' ;
    $urankname = $bussrankname."合伙人</font>" ;
}
if ($mybranch=='1') $urankname = $urankname.'<font color="#FF6600">-商户</font>'  ;
else if ($mybranch=='5') $urankname = $urankname.'<font color="#FF6600">---机构</font>'  ;
else if ($mybranch=='2') $urankname = $urankname.'<font color="#FF6600">---门店管理</font>'  ;
$maxdai = 1000;

/*
if ($md_jb < '1' || $md_jb > '7') $md_jb = '0' ;
$mdzwarray=array('0'=>'普通','1'=>"主任",'2'=>"主管",'3'=>"经理", '4'=>"总监", '5'=>"首席", '6'=>"总裁",'7'=>"董事");
$urankname = '一般用户' ;
if ($md_jb === '0') {
    if ($myrank == '1') $urankname = "一般用户" ;
    if ($myrank == '2') $urankname = '<font color="#0000FF">麦啦会员</font>' ;
    if ($myrank == '3') $urankname = '<font color="#088A08">服务商</font>' ;
} else {
    $urankname='<font color="#088A08">服务商('.$mdzwarray[$md_jb].')</font>' ;
}
*/

$smarty->assign('user_rank', $myrank);        //用户等级
$smarty->assign('buss_rank', $mybuss);        //用户等级
$smarty->assign('rank_name', $urankname);        //用户等级
$smarty->assign('urankname', @$urankname);        //用户等级

//print_r($action) ;
//gc_writelog("B=".$_SESSION['user_id']."B".$user_name."B", __FILE__, __LINE__) ;

/* 用户登陆 */
if ($action == 'do_login'){
    // var_dump($_POST);
    //break;
    $user_name = !empty($_POST['username']) ? $_POST['username'] : '';
    $pwd = !empty($_POST['pwd']) ? $_POST['pwd'] : '';
    $gourl = !empty($_POST['gourl']) ? $_POST['gourl'] : '';
    $ml_phone = !empty($_POST['canshu']) ? $_POST['canshu'] : '';
    $remember = isset($_POST['remember']) ? $_POST['remember'] : 0;


    //记住用户名字
    if(!empty($remember)){
        setcookie("ECS[reuser_name]", $user_name, time() + 31536000, '/');
    }
    $reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
    if(!empty($reuser_name)){
        $smarty->assign('reuser_name', $reuser_name);
    }

    if (empty($user_name) || empty($pwd))
    {
        ecs_header("Location:user.php\n");
        $login_faild = 1;
    }else{
        $row = gc_userlogin($user_name,md5($pwd)) ;

        echo json_encode($row);
      } 
        /*

        if ($row['user_id'] > 0)
        {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['last_time']   = isset($row['last_login'])?$row['last_login']:0;
            $_SESSION['last_ip']     = $row['last_ip'];
            $_SESSION['login_fail']  = 0;
            $_SESSION['email']       = $row['email'] ;
            $_SESSION['user_rank'] = $row['user_rank'] ;
            $_SESSION['buss_rank'] = $row['buss_rank'] ;
            $_SESSION['md_jb'] = @$row['md_jb'] ;
            $_SESSION['branch_rank'] = $row['branch_rank'] ;
            $_SESSION['baotime'] = $row['baotime'] ;
            $_SESSION['discount']  = isset($row['discount'])?$row['discount']:0 ;
            $_SESSION['phone']  = $row['phone'] ;
            $_SESSION['user_name']  = $row['user_name'] ;
            $_SESSION['relevel'] = $row['relevel'] ;
            $_SESSION['gold_amt'] = $row['gold_amt'] ;
            $_SESSION['balance'] = $row['balance'] ;
            $_SESSION['award_bal'] = $row['award_bal'] ;
            $_SESSION['tb_bal'] = $row['tb_bal'] ;
            $_SESSION['lb_bal'] = $row['lb_bal'] ;
            $_SESSION['frozen_amt'] = $row['frozen_amt'] ;
            $_SESSION['credit_amount'] = $row['credit_amount'] ;
            $_SESSION['address_id'] = $row['address_id'] ;
            $_SESSION['award_flag'] = $row['award_flag'] ;
            $_SESSION['systemid'] = $row['systemid'] ;
            $_SESSION['branch_id'] = $row['branch_id'] ;
            if(isset($_COOKIE['openid']))
            {
               $openid = $_COOKIE['openid'];
                $nickname = "maila";
                $userid = $_SESSION['user_id'];
                $str = gc_bindweixin($openid,$nickname,$userid);
            }
            $user->set_session($user_name);
            $user->set_cookie($user_name);
            update_user_info();
            //优化登陆跳转
            if ($disphard === '1') {
                $Loaction = 'usercenter.php?act=default&disphard=1';
                ecs_header("Location: $Loaction\n");
            } else if($gourl){
               //  echo "1111";
               // break;
                ecs_header("Location:$gourl.php?ml_phone=$ml_phone\n");
                exit;
            }else{
                $sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') . " WHERE session_id = '" . SESS_ID . "' " . "AND parent_id = 0 AND is_gift = 0 AND rec_type = 0";
                if ($db->getOne($sql) > 0){
                    ecs_header("Location:cart.php\n");
                    exit;
                }else{
                    ecs_header("Location:user.php\n");
                    exit;
                }
            }*/
            
        //}
       // else
        //{
          //  $login_faild = 1;
       // }
    //}
   // $smarty->assign('login_faild', $login_faild);
    //$smarty->display('login.dwt');
   // exit;

}elseif($action=='send_hash_mail'){
 include_once(ROOT_PATH . 'includes/cls_json.php');
include_once(ROOT_PATH . 'includes/lib_passport.php');
$json = new JSON();

$result = array('error' => 0, 'message' => '', 'content' => '');

if ($user_id == 0) {
    /* 用户没有登录 */
    $result['error'] = 1;
    $result['message'] = "请登录";
    die($json->encode($result));
}

if (send_regiter_hash($user_id)) {
    $result['message'] = "邮件发送成功";
    die($json->encode($result));
} else {
    $result['error'] = 1;
    $result['message'] = "邮件发送失败";
}

die($json->encode($result));
/* 微信用户自动登陆 */
}elseif ($action == 'weixin_login')
{
    if (gc_wxResAndLogin()){
        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $Loaction = 'index.php';
        ecs_header("Location: $Loaction\n");
    }else{
        $user_name = !empty($_REQUEST['username']) ? $_GET['username'] : '';
        $pwd = !empty($_GET['pwd']) ? $_GET['pwd'] : '';
        $gourl = !empty($_GET['gourl']) ? $_GET['gourl'] : '';

        $remember = isset($_GET['remember']) ? $_GET['remember'] : 0;
        //记住用户名字
        if(!empty($remember)){
            setcookie("ECS[reuser_name]", $user_name, time() + 31536000, '/');
        }
        $reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
        if(!empty($reuser_name)){
            $smarty->assign('reuser_name', $reuser_name);
        }

        if (empty($user_name) || empty($pwd))
        {
            ecs_header("Location:user.php\n");
            $login_faild = 1;
        }
        else
        {
            if ($user->check_user($user_name, $pwd) > 0)
            {
                $user->set_session($user_name);
                $user->set_cookie($user_name);
                update_user_info();
                //优化登陆跳转
                if($gourl){
                    ecs_header("Location:$gourl\n");
                    exit;
                }else{
                    $sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') . " WHERE session_id = '" . SESS_ID . "' " . "AND parent_id = 0 AND is_gift = 0 AND rec_type = 0";
                    if ($db->getOne($sql) > 0){
                        ecs_header("Location:cart.php\n");
                        exit;
                    }else{
                        ecs_header("Location:user.php\n");
                        exit;
                    }
                }
            }
            else
            {
                $login_faild = 1;
            }
        }
        $smarty->assign('login_faild', $login_faild);
        $smarty->display('login.dwt');
        exit;
    }
}

/* 微信绑定账号列表*/
elseif ($action == 'wechat_user_list')
{
   $_SESSION['disphard']='2' ;
   if (!isset($_COOKIE['openid']))
        gc_get_openid();
   $openid = $_COOKIE['openid'];
   wechat_bind_list($openid);
}
/* 微信绑定账号列表*/
elseif ($action == 'wechat_user_list1')
{
    if (!isset($_COOKIE['openid']))
        gc_get_openid();
    $openid = $_COOKIE['openid'];
    wechat_bind_list($openid);

}
/* 设为默认账户*/
elseif ($action == 'default_user')
{
    $openid = $_COOKIE['openid'];
    $nickname = "maila";
    $userid = isset($_GET['id']) ? $_GET['id'] : 0;
    $_SESSION["user_id"] = $userid;
    $str = gc_bindweixin($openid,$nickname,$userid);
    wechat_bind_list($openid);
}
/* 解除绑定*/
elseif ($action == 'remove_bind')
{
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $openid = $_COOKIE['openid'];
    $str = gc_bindweixin(null,null,$id);
    wechat_bind_list($openid);
}
/* 新增绑定*/
elseif ($action == 'bind_wechat')
{

    if (!isset($_COOKIE['openid'])) {
        gc_get_openid();
    }
    $user_name = !empty($_POST['username']) ? $_POST['username'] : '';
    $pwd = !empty($_POST['pwd']) ? $_POST['pwd'] : '';

    if (empty($user_name) || empty($pwd))
    {
        ecs_header("Location:user.php?act=bind\n");
        $login_faild = 1;
    }
    else
    {
        $row = gc_userlogin($user_name,md5($pwd)) ;

        if ($row['user_id'] > 0)
        {

            $_SESSION['user_id'] = $row['user_id'];
            $nickname = "maila";
            $userid = $_SESSION['user_id'];

            $str = gc_bindweixin($openid,$nickname,$userid);

            $user->set_session($user_name);
            $user->set_cookie($user_name);
            update_user_info();
            wechat_bind_list($openid);
        }
        else
        {
            $login_faild = 1;
        }
    }
    $smarty->assign('login_faild', $login_faild);
    $smarty->display('bind_wechat.dwt');
    exit;
}
elseif ($action == 'bind')
{
    $smarty->display('bind_wechat.dwt');
    exit;
}

elseif ($action == 'order_list')
{
    if(!$_SESSION['user_id']){
        $smarty->assign('footer', get_footer());
        $smarty->display('login.dwt');
        exit;
    }
    $record_count = gc_mlfenhongcount($_SESSION['user_id']);
    $record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = {$_SESSION['user_id']}");
    if ($record_count > 0){
        include_once(ROOT_PATH . 'includes/lib_transaction.php');
        $page_num = '10';
        $page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
        $pages = ceil($record_count / $page_num);
        if ($page <= 0)
        {
            $page = 1;
        }
        if ($pages == 0)
        {
            $pages = 1;
        }
        if ($page > $pages)
        {
            $page = $pages;
        }
        $pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=order_list', 'page');
        $smarty->assign('pagebar' , $pagebar);
        /* 订单状态 */
        $_LANG['os'][OS_UNCONFIRMED] = '未确认';
        $_LANG['os'][OS_CONFIRMED] = '已确认';
        $_LANG['os'][OS_SPLITED] = '已确认';
        $_LANG['os'][OS_SPLITING_PART] = '已确认';
        $_LANG['os'][OS_CANCELED] = '已取消';
        $_LANG['os'][OS_INVALID] = '无效';
        $_LANG['os'][OS_RETURNED] = '退货';

        $_LANG['ss'][SS_UNSHIPPED] = '未发货';
        $_LANG['ss'][SS_PREPARING] = '配货中';
        $_LANG['ss'][SS_SHIPPED] = '已发货';
        $_LANG['ss'][SS_RECEIVED] = '收货确认';
        $_LANG['ss'][SS_SHIPPED_PART] = '已发货(部分商品)';
        $_LANG['ss'][SS_SHIPPED_ING] = '配货中'; // 已分单

        $_LANG['ps'][PS_UNPAYED] = '未付款';
        $_LANG['ps'][PS_PAYING] = '付款中';
        $_LANG['ps'][PS_PAYED] = '已付款';
        $_LANG['cancel'] = '取消订单';
        $_LANG['pay_money'] = '付款';
        $_LANG['view_order'] = '查看订单';
        $_LANG['received'] = '确认收货';
        $_LANG['ss_received'] = '已完成';
        $_LANG['confirm_received'] = '你确认已经收到货物了吗？';
        $_LANG['confirm_cancel'] = '您确认要取消该订单吗？取消后此订单将视为无效订单';

        $orders = get_user_orders($_SESSION['user_id'], $page_num, $page_num * ($page - 1));
        //$orders = gc_mlfenhonglist($_SESSION['user_id'], $page_num, $page_num * ($page - 1));
        if (!empty($orders))
        {
            foreach ($orders as $key => $val)
            {
                $orders[$key]['total_fee'] = encode_output($val['total_fee']);
            }
        }
        $merge  = get_user_merge($_SESSION['user_id']);

        $smarty->assign('orders', $orders);
    }
    $smarty->display('order_list.dwt');
    exit;
}
/* 订单详情 */
elseif($action=='order_info'){
    if(!$_SESSION['user_id']){
        $smarty->display('login.dwt');
        exit;
    }
    $id= isset($_GET['id']) ? intval($_GET['id']) : 0;
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    /* 订单详情 */
    $order = get_order_detail($id, $_SESSION['user_id']);

    if ($order === false)
    {
        exit("对不起，该订单不存在");
    }
    require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
    /* 订单商品 */
    $goods_list = order_goods2($id);
    if (empty($goods_list))
    {
        $tips = '<br><br>无效错误订单<br><br><a href=user.php?act=order_list class=red>返回我的订单</a>';
        $smarty->assign('tips', $tips);
        $smarty->display('order_done.dwt');
        exit();
    }
    foreach ($goods_list AS $key => $value)
    {
        $goods_list[$key]['market_price'] = price_format($value['market_price'], false);
        $goods_list[$key]['goods_price']  = price_format($value['goods_price'], false);
        $goods_list[$key]['subtotal']	 = price_format($value['subtotal'], false);
    }

    /* 订单 支付 配送 状态语言项 */
    $order['order_status'] = $_LANG['os'][$order['order_status']];
    $order['pay_status'] = $_LANG['ps'][$order['pay_status']];
    $order['shipping_status'] = $_LANG['ss'][$order['shipping_status']];
    $smarty->assign('order',	  $order);
    $smarty->assign('goods_list', $goods_list);
    $smarty->assign('lang',	   $_LANG);
    $smarty->assign('footer', get_footer());
    $smarty->display('order_info.dwt');
    exit();
}
/* 取消订单 */
elseif ($action == 'cancel_order')
{
    if(!$_SESSION['user_id']){
        $smarty->assign('footer', get_footer());
        $smarty->display('login.dwt');
        exit;
    }
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    if (cancel_order($order_id, $_SESSION['user_id']))
    {
        ecs_header("Location: user.php?act=order_list\n");
        exit;
    }
}

/* 确认收货 */
elseif ($action == 'affirm_received')
{
    if(!$_SESSION['user_id']){
        $smarty->assign('footer', get_footer());
        $smarty->display('login.dwt');
        exit;
    }
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    $_LANG['buyer'] = '买家';
    if (affirm_received($order_id, $_SESSION['user_id']))
    {
        ecs_header("Location: user.php?act=order_list\n");
        exit;
    }

}

/* 个人资料页面 */
elseif ($action == 'profile')
{
    if(!$_SESSION['user_id']){
        $smarty->assign('footer', get_footer());
        $smarty->display('login.dwt');
        exit;
    }
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    $user_id=$_SESSION['user_id'];
    $user_info = get_profile($user_id);
    $res_info=gc_getuserinfo($user_id);

    $idcard=$res_info['pidno'];
    $birthday=$res_info['birthday'];
    $phone=$res_info['phone'];

    $alias=$res_info['alias'];

    $user_name=$res_info['user_name'];

    $qq_number=$res_info['qq'];
    $bir_year=substr($birthday,0,4);
    $bir_mon=substr($birthday,4,2);
    $bir_day=substr($birthday,6,2);
    $birthday=$bir_year.'-'.$bir_mon.'-'.$bir_day;


    //$user_info = gc_getuserinfo($user_id);
    /* 取出注册扩展字段 */
    /*
    $sql = 'SELECT * FROM ' . $ecs->table('reg_fields') . ' WHERE type < 2 AND display = 1 ORDER BY dis_order, id';
    $extend_info_list = $db->getAll($sql);

    $sql = 'SELECT reg_field_id, content ' .
           'FROM ' . $ecs->table('reg_extend_info') .
           " WHERE user_id = $user_id";
    $extend_info_arr = $db->getAll($sql);

    $temp_arr = array();
    foreach ($extend_info_arr AS $val)
    {
        $temp_arr[$val['reg_field_id']] = $val['content'];
    }

    foreach ($extend_info_list AS $key => $val)
    {
        switch ($val['id'])
        {
            case 1:     $extend_info_list[$key]['content'] = $user_info['msn']; break;
            case 2:     $extend_info_list[$key]['content'] = $user_info['qq']; break;
            case 3:     $extend_info_list[$key]['content'] = $user_info['office_phone']; break;
            case 4:     $extend_info_list[$key]['content'] = $user_info['home_phone']; break;
            case 5:     $extend_info_list[$key]['content'] = $user_info['mobile_phone']; break;
            default:    $extend_info_list[$key]['content'] = empty($temp_arr[$val['id']]) ? '' : $temp_arr[$val['id']] ;
        }
    }

    $smarty->assign('extend_info_list', $extend_info_list);
*/
    /* 密码提示问题 */
    // $smarty->assign('passwd_questions', $_LANG['passwd_questions']);



    $smarty->assign('profile', $user_info);
    $smarty->assign('idcard',$idcard);
    // $birthday='1989-07-24';
    $smarty->assign('birthday',$birthday);
    $smarty->assign('qq_number',$qq_number);
    $smarty->assign('alias',$alias);

    $smarty->assign('phone',$phone);

    $smarty->assign('username',$user_name);


    $smarty->display('profile.dwt');
}
elseif($action=='checksms'){
    $tel = trim($_GET['tel']);
    $smscode = trim($_GET['code']);
    $type = trim($_GET['type']);

    $userid = $_SESSION['user_id'];
    // var_dump($userid);
    $reg_phone = $tel;

    $res = gc_checkusersmssend($tel, $smscode, $type);
   //  var_dump($res);


    if ($res['resp_code'] === 0) {
        $phone_res = gc_checkphoneauth($userid, $reg_phone);

        if ($phone_res['resp_code'] === 0) {

            echo "ok";

        } else {

            echo 'error2';

        }


    } else {

        echo "error1";

    }

}elseif($action=='do_pay'){
    $user_id=$_POST["user_id"];
    $user_money=$_POST["money"]/100;
    $_LANG['pay_order']="新网站扣款";
    $order['order_sn']=$_POST["create_time"];

   //$acc = log_account_change($user_id, $money*(-1), 0, 0, 0, sprintf($_LANG['pay_order'], $order['order_sn']), "", $order['order_sn']);
    $acc = gc_account_change($user_id, $user_money*(-1), 0, 0, $_LANG['pay_order'].$order['order_sn'], '030000', $order['order_sn']) ;


    if (!$acc) {
        echo  "error";
    } else {
        echo "success";

    }


}



/* 修改个人资料的处理 */
elseif ($action == 'act_edit_profile')
{
    if(!$_SESSION['user_id']){
        $smarty->assign('footer', get_footer());
        $smarty->display('login.dwt');
        exit;
    }
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    if($_POST['birthdayMonth']<10){

        $_POST['birthdayMonth']='0'.$_POST['birthdayMonth'];
    }



    $birthday = trim($_POST['birthdayYear']).$_POST['birthdayMonth'].trim($_POST['birthdayDay']);
    $email = isset($email)?trim($_POST['email']):'';
    $idcard=isset($idcard)?trim($_POST['idcard']):'';
    $user_name=isset($user_name)?trim($_POST['username']):'';
    // var_dump($user_name);
    $phone=isset($phone)?trim($_POST['phone']):'';
    $sex=trim($_POST['sex']);

    $qq_number=isset($qq_number)?trim($_POST['qq_number']):'';

    $alias=isset($alias)?trim($_POST['alias']):'';

    $res=gc_updateuserinfo($user_id,$user_name,$idcard,$sex,$phone,$birthday,$qq_number,$alias);

    // var_dump($res);

    if ($res['resp_code']=== 0)
    {
        echo"<SCRIPT LANGUAGE='javascript'>alert('".$_LANG['edit_profile_success']."');location.href='user.php';</SCRIPT>";
    }
    else
    {

        echo"<SCRIPT LANGUAGE='javascript'>alert('".$msg."');history.go(-1);</SCRIPT>";
    }
}

/* 修改会员密码 */
elseif ($action == 'act_edit_password')
{

    // include_once(ROOT_PATH . 'includes/lib_passport.php');

    $old_password = isset($_POST['old_password']) ? trim($_POST['old_password']) : null;
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $confirm_password=isset($_POST['confirm_password'])?trim($_POST['confirm_password']):'';
    $comfirm_password = isset($_POST['comfirm_password']) ? trim($_POST['comfirm_password']) : '';
    $user_id      = isset($_POST['uid'])  ? intval($_POST['uid']) : $user_id;
    $code         = isset($_POST['code']) ? trim($_POST['code'])  : '';
    //var_dump($_POST);


    // $user_info = $user->get_profile_by_id($user_id); //论坛记录
    $phone = $_SESSION['phone'];
    $res=gc_changepwd($phone, md5($old_password),md5($new_password));
    //var_dump($res);

    if($res['resp_code']===0)
    {
        echo '<script language=javascript>alert("密码修改成功");</script>';
        $user->logout();
    }
    else
    {

        echo "<script>alert('修改失败');window.location.href='user.php?act=safe_center';</script>";
        // $f = 4;


    }

    /*
if (($user_info && (!empty($code) && md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']) == $code)) || ($_SESSION['user_id']>0 && $_SESSION['user_id'] == $user_id && $user->check_user($_SESSION['user_name'], $old_password)))
{

    if ($user->edit_user(array('username'=> (empty($code) ? $_SESSION['user_name'] : $user_info['user_name']), 'old_password'=>$old_password, 'password'=>$new_password), empty($code) ? 0 : 1))
    {
        $sql="UPDATE ".$ecs->table('users'). "SET `ec_salt`='0' WHERE user_id= '".$user_id."'";
        $db->query($sql);
        $user->logout();
        $user->logout();
        $Loaction = 'user.php';
        ecs_header("Location: $Loaction\n");
    }
    else
    {
        $f = 4;
    }
}
else
{
    $f = 4;
}
*/
    //$smarty->assign('f', $f);
    // $smarty->display('safecenter.dwt');
}

/* 退出会员中心 */
elseif ($action == 'logout')
{
    if (!isset($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
    {
        $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
    }
    //$userid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
   // $str = gc_bindweixin(null, null, $userid);
    $disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;
    $user->logout();
    if ($disphard === '1' || $disphard === '2') {
        $Loaction = 'usercenter.php?act=default&disphard='.$disphard;
        ecs_header("Location: $Loaction\n");
    } else {
        $Loaction = 'index.php';
        ecs_header("Location: $Loaction\n");
    }
}elseif($action=='forgetpwd'){
    $smarty->display('forgetpwd.dwt');
}elseif($action=='act_forget_password'){

    $tel = isset($_POST['phone'])?$_POST['phone']:'';
    $smscode = isset($_POST['smscode'])?$_POST['smscode']:'';
    $newpassword =isset($_POST['new_password'])?$_POST["new_password"]:'';

    //var_dump($tel);
    gc_writelog("\r\nCPWD:".$smscode."|".$newpassword."End", __FILE__, __LINE__) ;

    $res = gc_changeuserpasswd($tel, $smscode, md5($newpassword));

    if ($res['resp_code'] === 0) {

        echo '<script language=javascript>alert("密码修改成功");window.location.href="user.php?act=forgetpwd";</script>';

    } else {
        $rspmsg = isset($res["resp_msg"])?$res["resp_msg"]:"密码修改失败!" ;

        echo '<script language=javascript>alert("'.$rspmsg.'");window.location.href="user.php?act=forgetpwd";</script>';
    }
}
/* 显示会员注册界面 */
elseif ($action == 'register')
{
    if (!isset($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
    {
        $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
    }
    //
    /* 取出注册扩展字段 */
    $disphard = isset($_GET['disphard'])?$_GET['disphard']:'0' ;
    if ($disphard === '0')
        $disphard = isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;

    if($_SESSION['user_id'] > 0){
            $Loaction = 'user.php?act=default&disphard='.$disphard ;
            ecs_header("Location: $Loaction\n");
    }
    $recode='';
    $_SESSION['disphard'] = $disphard ;
   // var_dump($_SESSION);
    if(isset($_SESSION['tuijian'])){

        $tuijian=$_SESSION['tuijian'];
        $smarty->assign('tuijian',$tuijian);

    }
    if(isset($_SESSION['back_act'])){

        $back_act=$_SESSION['back_act'];
        $smarty->assign('back_act',$back_act);


    }



    $smarty->assign('disphard', $disphard);
    $smarty->assign('footer', get_footer());
    $smarty->assign('recode', $recode);

    $smarty->display('user_passport.dwt');
}
/* 注册会员的处理 */
elseif ($action == 'act_register')
{
    include_once(ROOT_PATH . 'includes/lib_passport.php');


    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : $phone;
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $rpassword = isset($_POST['rpassword']) ? trim($_POST['rpassword']) : '';
    $email	= isset($_POST['email']) ? trim($_POST['email']) : '';
    $pidno    = isset($_POST['pidno']) ? trim($_POST['pidno']) : '';
    $recode    = isset($_POST['recode']) ? trim($_POST['recode']) : '';
    $smscode    = isset($_POST['smscode']) ? trim($_POST['smscode']) : '';

    $back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';

    if ($password != $rpassword) {
        echo '<script language=javascript>alert("密码输入不一致！");history.go(-1);</script>';
        exit;
    }

    if (m_register($phone,$pidno, $smscode,$password, $username, $email,$recode) !== false)
    {
        /*把新注册用户的扩展信息插入数据库*/

        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $disphard = isset($_SESSION['disphard'])?$_SESSION['disphard']:'0';
        if ($disphard === '1' || $disphard === '2' ) {
            $Loaction = 'usercenter.php?act=default&disphard=' . $disphard;
            ecs_header("Location: $Loaction\n");
        }else if(strlen($back_act)>0){

            $Loaction=$back_act;

            ecs_header("Location: $Loaction\n");




        } else {
            $Loaction = 'user.php';
            ecs_header("Location: $Loaction\n");
        }
    } else {
        //            echo '<script language=javascript>history.go(-1);</script>';
        exit;
    }
}
/* 显示会员注册界面 */
elseif ($action == 'in_register')
{
    if (!isset($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
    {
        $back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
    }

    if($_SESSION['user_id'] === 0){
        echo '<meta http-equiv="refresh" content="0;URL='.$back_act.'" />';
        exit;
    }

    $recode=isset($_SESSION['phone'])?$_SESSION['phone']:'' ;

    gc_writelog("\r\n<(in_register)action=".$action."|".$recode.">", __FILE__, __LINE__) ;

    $smarty->assign('footer', get_footer());
    $smarty->assign('recode', $recode);

    $smarty->display('mala.dwt');
}
/* 注册会员的处理 */
elseif ($action == 'act_in_register')
{
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $rpassword = isset($_POST['rpassword']) ? trim($_POST['rpassword']) : '';
    $email	= isset($_POST['email']) ? trim($_POST['email']) : '';
    $pidno    = isset($_POST['pidno']) ? trim($_POST['pidno']) : '';
    $recode    = $_SESSION['phone'] ;

    $back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';

    if ($password != $rpassword) {
        echo '<script language=javascript>alert("密码输入不一致！");history.go(-1);</script>';
        exit;
    }

    if (m_in_register($phone,$pidno, $password, $username, $email,$recode) !== false)
    {
        /*把新注册用户的扩展信息插入数据库*/

        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $Loaction = 'user.php';
        ecs_header("Location: $Loaction\n");

    } else {
        exit ;
    }
}
/* 增加收货地址 */
elseif ($action == 'add_address')
{
    include_once('includes/lib_transaction.php');
    /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
    $smarty->assign('country_list',       get_regions());
    $smarty->assign('shop_country',       $_CFG['shop_country']);
    $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
    $consignee_list = get_consignee_list($_SESSION['user_id']);
    /* 取得每个收货地址的省市区列表 */
    $province_list = array();
    $city_list = array();
    $district_list = array();
    foreach ($consignee_list as $region_id => $consignee)
    {
        $consignee['country']  = isset($consignee['country'])  ? intval($consignee['country'])  : 0;
        $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
        $consignee['city']     = isset($consignee['city'])     ? intval($consignee['city'])     : 0;

        $province_list = get_regions(1, $consignee['country']);
        $city_list     = get_regions(2, $consignee['province']);
        $district_list = get_regions(3, $consignee['city']);
    }
    $smarty->assign('province_list', $province_list);
    $smarty->assign('city_list',     $city_list);
    $smarty->assign('district_list', $district_list);
    $smarty->assign('action', "user.php?act=add_edit_address");
    $smarty->assign('fun', 'add');
    $smarty->display('address_list.dwt');
}
/* 收货地址列表 */
elseif ($action == 'address_list')
{
    include_once('includes/lib_transaction.php');
    /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
    $smarty->assign('country_list',       get_regions());
    $smarty->assign('shop_country',       $_CFG['shop_country']);
    $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
    $consignee_list = get_consignee_list($_SESSION['user_id']);
    /* 取得每个收货地址的省市区列表 */
    $province_list = array();
    $city_list = array();
    $district_list = array();
    foreach ($consignee_list as $region_id => $consignee)
    {
        $consignee['country']  = isset($consignee['country'])  ? intval($consignee['country'])  : 0;
        $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
        $consignee['city']     = isset($consignee['city'])     ? intval($consignee['city'])     : 0;

        $province_list = get_regions(1, $consignee['country']);
        $city_list     = get_regions(2, $consignee['province']);
        $district_list = get_regions(3, $consignee['city']);
    }
    $smarty->assign('province_list', $province_list);
    $smarty->assign('city_list',     $city_list);
    $smarty->assign('district_list', $district_list);
    $smarty->assign('consignee', $consignee_list);
    $smarty->assign('action', "user.php?act=act_edit_address");
    $smarty->assign('subval', '修改送货地址');
    $smarty->assign('fun', 'list');
    $smarty->display('address_list.dwt');
}
/*更新收获地址*/
elseif ($action == 'act_edit_address'){

    global $db;
    include_once('includes/lib_transaction.php');

    if(empty($_POST['country']) || empty($_POST['province']) || empty($_POST['city']) || empty($_POST['district']))
    {
        echo '<script language=javascript>alert("配送区域不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['address']))
    {
        echo '<script language=javascript>alert("收货地址不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['consignee']))
    {
        echo '<script language=javascript>alert("收货人姓名不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['tel']))
    {
        echo '<script language=javascript>alert("联系电话不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['mobile']))
    {
        echo '<script language=javascript>alert("联系手机不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['email']))
    {
        echo '<script language=javascript>alert("电子邮箱不可为空！");history.go(-1);</script>';
        exit;
    }
    /*
     * 保存收货人信息
     */
    $consignee = array(
        'user_id'		=> $_SESSION['user_id'],
        'address_id'    => empty($_POST['address_id']) ? 0  : intval($_POST['address_id']),
        'consignee'     => empty($_POST['consignee'])  ? '' : trim($_POST['consignee']),
        'country'       => empty($_POST['country'])    ? '' : $_POST['country'],
        'province'      => empty($_POST['province'])   ? '' : $_POST['province'],
        'city'          => empty($_POST['city'])       ? '' : $_POST['city'],
        'district'      => empty($_POST['district'])   ? '' : $_POST['district'],
        'email'         => empty($_POST['email'])      ? '' : $_POST['email'],
        'address'       => empty($_POST['address'])    ? '' : $_POST['address'],
        'zipcode'       => empty($_POST['zipcode'])    ? '' : make_semiangle(trim($_POST['zipcode'])),
        'tel'           => empty($_POST['tel'])        ? '' : make_semiangle(trim($_POST['tel'])),
        'mobile'        => empty($_POST['mobile'])     ? '' : make_semiangle(trim($_POST['mobile'])),
        'sign_building' => empty($_POST['sign_building']) ? '' : $_POST['sign_building'],
        'best_time'     => empty($_POST['best_time'])  ? '' : $_POST['best_time'],
        'default_id'    => empty($_POST['default_id'])  ? '0' : $_POST['default_id'],
    );

    $result = update_address($consignee);

    $GLOBALS['db']->query("UPDATE " . $GLOBALS['ecs']->table('user_address') . " SET default_id = 0 WHERE default_id != 1 ");

    if($result){
        echo '<script language=javascript>alert("修改收货地址成功");location.href="user.php?act=address_list";</script>';
    }
    else{
        echo '<script language=javascript>alert("修改失败");history.go(-1);</script>';
    }
    if ($_SESSION['user_id'] > 0)
    {
        $smarty->assign('user_name', $_SESSION['user_name']);
    }
}
/*增加收获地址*/
elseif ($action == 'add_edit_address'){

    global $db;
    include_once('includes/lib_transaction.php');

    if(empty($_POST['country']) || empty($_POST['province']) || empty($_POST['city']) || empty($_POST['district']))
    {
        echo '<script language=javascript>alert("配送区域不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['address']))
    {
        echo '<script language=javascript>alert("收货地址不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['consignee']))
    {
        echo '<script language=javascript>alert("收货人姓名不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['tel']))
    {
        echo '<script language=javascript>alert("联系电话不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['mobile']))
    {
        echo '<script language=javascript>alert("联系手机不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['email']))
    {
        echo '<script language=javascript>alert("电子邮箱不可为空！");history.go(-1);</script>';
        exit;
    }
    /*
     * 保存收货人信息
     */
    $consignee = array(
        'user_id'		=> $_SESSION['user_id'],
        'address_id'    => empty($_POST['address_id']) ? 0  : intval($_POST['address_id']),
        'consignee'     => empty($_POST['consignee'])  ? '' : trim($_POST['consignee']),
        'country'       => empty($_POST['country'])    ? '' : $_POST['country'],
        'province'      => empty($_POST['province'])   ? '' : $_POST['province'],
        'city'          => empty($_POST['city'])       ? '' : $_POST['city'],
        'district'      => empty($_POST['district'])   ? '' : $_POST['district'],
        'email'         => empty($_POST['email'])      ? '' : $_POST['email'],
        'address'       => empty($_POST['address'])    ? '' : $_POST['address'],
        'zipcode'       => empty($_POST['zipcode'])    ? '' : make_semiangle(trim($_POST['zipcode'])),
        'tel'           => empty($_POST['tel'])        ? '' : make_semiangle(trim($_POST['tel'])),
        'mobile'        => empty($_POST['mobile'])     ? '' : make_semiangle(trim($_POST['mobile'])),
        'sign_building' => empty($_POST['sign_building']) ? '' : $_POST['sign_building'],
        'best_time'     => empty($_POST['best_time'])  ? '' : $_POST['best_time'],
    );

    $result = update_address($consignee);
    if($result){
        echo '<script language=javascript>alert("增加收货地址成功");location.href="user.php?act=address_list";</script>';
    }
    else{
        echo '<script language=javascript>alert("增加收货地址失败");history.go(-1);</script>';
    }
    if ($_SESSION['user_id'] > 0)
    {
        $smarty->assign('user_name', $_SESSION['user_name']);
    }
}
/* 删除收货人信息*/
elseif ($action == 'drop_address')
{
    include_once('includes/lib_transaction.php');

    $consignee_id = intval($_GET['id']);

    if (drop_consignee($consignee_id))
    {
        ecs_header("Location: user.php?act=address_list\n");
        exit;
    }
}
/* 添加收藏商品(ajax) */
elseif ($action == 'collect')
{
    include_once(ROOT_PATH .'includes/cls_json.php');
    $json = new JSON();
    $result = array('error' => 0, 'message' => '');
    $goods_id = $_GET['id'];

    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
        $result['error'] = 1;
        $result['message'] = "由于您还没有登录，因此您还不能使用该功能。";
        die($json->encode($result));
    }
    else
    {
        /* 检查是否已经存在于用户的收藏夹 */
        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('collect_goods') .
            " WHERE user_id='$_SESSION[user_id]' AND goods_id = '$goods_id'";
        if ($GLOBALS['db']->GetOne($sql) > 0)
        {
            $result['error'] = 1;
            $result['message'] = "该商品已经存在于您的收藏夹中。";
            die($json->encode($result));
        }
        else
        {
            $time = gmtime();
            $sql = "INSERT INTO " .$GLOBALS['ecs']->table('collect_goods'). " (user_id, goods_id, add_time)" .
                "VALUES ('$_SESSION[user_id]', '$goods_id', '$time')";

            if ($GLOBALS['db']->query($sql) === false)
            {
                $result['error'] = 1;
                $result['message'] = $GLOBALS['db']->errorMsg();
                die($json->encode($result));
            }
            else
            {
                $result['error'] = 0;
                $result['message'] = "该商品已经成功地加入了您的收藏夹。";
                die($json->encode($result));
            }
        }
    }
}
/* 显示升级vip列表 */
elseif ($action == 'upvip')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_tdwsys.php');

    global $db;

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $balance=isset($_SESSION['balance']) ? $_SESSION['balance'] : 0 ;
    $award_bal=isset($_SESSION['award_bal']) ? $_SESSION['award_bal'] : 0 ;

    /* 获取用户留言的数量 */
    $recode_count = gc_mlgetbuycount($user_id) ;
    if ($recode_count == null) $recode_count = 0 ;

    $res = gc_getmltypelistpro($user_id) ;

    $pager = get_pager('user.php', array('act' => $action), $recode_count, $page, 10);

    $smarty->assign('user_name', $user_name) ;
    $smarty->assign('urealname', $user_name) ;
    $smarty->assign('mltypelist', $res) ;
    $smarty->assign('balance', $balance);
    $smarty->assign('award_bal', $award_bal);
    $smarty->assign('amount', $balance+$award_bal);
    $smarty->assign('defmltype', "N15000");
    /*
        if ($systemid=="ZHMLA") {
            $smarty->assign('mltype', "ZH7500");
        } else if ($systemid=="USMLA")  {
            $smarty->assign('mltype', "US7500");
        } else {
            $smarty->assign('mltype', "M7500");
        }
    */
    $smarty->assign('buyorder_list', get_buyorder_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager',        $pager);
    $smarty->display('mala.dwt');
}
/* 添加我的购单 */
elseif ($action == 'act_add_order')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $message = array(
        'whopay'     => $user_id,
        'paycode'   => $_SESSION['user_name'],
        'mltype'		=> isset($_POST['mltype']) ? $_POST['mltype']  : "",
        'buy_num'    => isset($_POST['buy_num']) ? intval($_POST['buy_num'])     : 1,
        'buy_uname'   => isset($_POST['buy_uname']) ? trim($_POST['buy_uname'])     : '',
        'ml_phone' =>isset($_POST['ml_phone'])?trim($_POST['ml_phone']):'',
        'bordernum'=>date('YmdHis',time())
    );


    if (add_order($message))
    {
        show_message($_LANG['add_buy_success'], $_LANG['buy_list_lnk'], 'user.php?act=upvip&order_id=' . $message['bordernum'],'info');
//        $err->show($_LANG['add_buy_success'], 'user.php?act=upvip');
    }
    else
    {
        $err->show($_LANG['buy_list_lnk'], 'user.php?act=upvip');
    }
}

/* 显示分红明细列表 */
elseif ($action == 'fhlist')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $sql = "SELECT COUNT(*) FROM " .$ecs->table('fenhong').
        " WHERE uid ='$user_id'  ";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 5);

    $smarty->assign('fenhong_list', get_fenhong_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager',        $pager);
    $smarty->display('user_clips.dwt');
}
/* 显示我注册的列表 */
elseif ($action == 'myreg')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $sql = "SELECT COUNT(*) FROM " .$ecs->table('users').
        " WHERE baouid ='$user_id'   ";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 20);

    $smarty->assign('myreg_list', get_myreg_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager',        $pager);
    $smarty->display('user_clips.dwt');
}
/* 显示我推荐的会员列表 */
elseif ($action == 'myrecom')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户分红的数量 */
    $sql = "SELECT COUNT(*) FROM " .$ecs->table('users').
        " WHERE reid ='$user_id'   ";
    $record_count = $db->getOne($sql);
    $pager = get_pager('user.php', array('act' => $action), $record_count, $page, 20);

    $smarty->assign('myrecom_list', get_myrecom_list($user_id, $pager['size'], $pager['start']));
    $smarty->assign('pager',        $pager);
    $smarty->display('user_clips.dwt');
}
/* 显示会员的购单列表 */
elseif ($action == 'buy_list')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    $theuid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : $user_id;

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取用户购单的数量 */
    $record_count = gc_mlgetcount($user_id) ;

    $actionall=$action.'&uid='.$theuid;
    $pager = get_pager('user.php', array('act' => $actionall), $record_count, $page, 10);

    $smarty->assign('buy_list', get_buy_list($theuid, $pager['size'], $pager['start']));
    $smarty->assign('pager',        $pager);
    $smarty->display('user_clips.dwt');
}

/* 显示升级保单中心 */
elseif ($action == 'upbaodan')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');


    /* 获取用户报单中心的状态 */
    $ifbao = $_SESSION['user_rank'];

    /* 获取用户成为报单中心的时间 */
    $baotime = isset($_SESSION['baotime'])?$_SESSION['baotime']:'';
    $gp = gc_usershares($user_id,"02")  ;
//    $shares = '股数:'.$gp['sharesnum'].'股   平均单价:'.$gp['unitprice'].'   当前单价:'.$gp['curprice'] ;
    $shares = '当前单价:'.$gp['curprice'].'元/股' ;
    
    /*    if ($systemid == "ZHMLA") {
            $baomess = "购买5万元市场价货升级商务中心，需要购买或推荐会员购买麦啦订单10单。" ;
        } else {
            $baomess = "升级商户中心，缴纳5万元，享受商务中心权益。" ;
        }
    */
    $baomess = "投资麦啦门店，每家门店200万，享受店铺40%分红权，每人最少投资1份（10万元/份，享受2%分红权），预期日分红为0.02-0.05%，本金全额参与来啦方块返回。" ;
    $balance = isset($_SESSION['balance'])?$_SESSION['balance']:0;
    $award_bal = isset($_SESSION['award_bal'])?$_SESSION['award_bal']:0;
    /* 获取用户可用资金余额 */
    $user_money = isset($_SESSION['balance'])?$_SESSION['balance']:0;
    $baotimes=local_date($_CFG['date_format'], $baotime);
    $smarty->assign('bd_fee', 1);
    $smarty->assign('baotime', $baotimes);
    $smarty->assign('baomess', $baomess);
    $smarty->assign('ifbao', $ifbao);
    $smarty->assign('shares', $shares);
    $smarty->assign('user_money', $balance+$award_bal);
    $smarty->assign('balance', $balance);
    $smarty->assign('award_bal', $award_bal);
    $smarty->assign('baoapp_list', get_baoapp_list($user_id, 10, 0));
    $smarty->display('mala.dwt');
}

/* 升级报单中心 */
elseif ($action == 'act_add_baodan')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_tdwsys.php');

    $cc = array() ;
    $buy_num = isset($_POST['buy_num']) ? $_POST['buy_num']  : 0 ;
//    print_r($buy_num) ;
    $cc = gc_ml_baodan($user_id,$buy_num) ;

    if ($cc == null) {
        show_message("购买失败，稍后再操作！", $_LANG['app_list_lnk'], 'user.php?act=upbaodan','info');
    }

    if ($cc['resp_code'] === 0)
    {
        show_message($_LANG['add_app_success'], $_LANG['app_list_lnk'], 'user.php?act=upbaodan','info');
        $_SESSION['user_rank'] = 4 ;
        $_SESSION['baotime'] = time() ;
        if (isset($cc['balance'])) {
            $_SESSION['balance'] = $cc['balance'] ;
        } else {
            $_SESSION['balance'] = $_SESSION['balance']  - 50000;
        }
    }
    else
    {
        show_message($cc['resp_msg'], $_LANG['app_list_lnk'], 'user.php?act=upbaodan','info');
    }
}


/* 显示用户关系推荐树 */
elseif ($action == 'afftree')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    //include_once(ROOT_PATH . 'includes/mobile/lib_main.php');
    //该会员能查看的最多的代数；
    //$disdai=$myrelevel+$maxdai;

    /* 获取该会员伞下面的会员信息 */
    /* 获取该会员伞下面的会员信息 */
    $begin = 0  ;
    $count = 0 ;
    $cnt=20;
    $li = array();
    $page_num=10;


   // var_dump($res);
    while ($cnt>=20) {

        $res = gc_getafftree($user_id,$begin, $count) ;

        $cnt = isset($res['cnt'])?$res['cnt']:0 ;
        $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $pagebar = get_wap_pager($cnt, $page_num, $page, 'user.php?act=afftree', 'page');
        $page_start=$page_num*($page-1);
        $res=gc_getafftree($user_id,$page_start,$page_num);


        //@$rbegin=$res['begin'] ;
        //if ($begin != $rbegin) break ;
        $cnt=$res['cnt'];
        // var_dump($cnt);
        $num_b=$page_start+1;
        $begin = $begin + $cnt ;
        $num= 0;
        while ($num < $cnt)
        {
            $row = $res[$num] ;
            $row["num"]=$num_b++;
            $num += 1;
            $li[] = $row;
        }
    }
   // var_dump($li);
/*
    foreach ($li  as $key=>$val)
    {
        $uid =$li[$key]['user_id'];
        $rankid =$li[$key]['user_rank'];
        $bussid = $li[$key]['buss_rank'];
        $branchid = $li[$key]['bh_rank'];
        if ($rankid == '1') $userrankname = "一般用户" ;
        else if ($rankid == '2') $userrankname = '<font color="#0000FF">麦啦会员</font>' ;
        else if ($rankid == '3') $userrankname = '<font color="#0000FF">服务商</font>' ;
        else if ($rankid == '4') {
            $bussrankname = "一般" ;
            if ($bussid == '1') $bussrankname = '<font color="#088A08">☆' ;
            else if ($bussid == '2') $bussrankname = '<font color="#FFBF00">☆☆' ;
            else if ($bussid == '3') $bussrankname = '<font color="#DF013A">☆☆☆' ;
            else if ($bussid == '4') $bussrankname = '<font color="#DF013A">☆☆☆☆' ;
            else if ($bussid == '5') $bussrankname = '<font color="#DF013A">区域' ;
            $userrankname = $bussrankname."合伙人</font>" ;
        }
        if ($branchid == '5') $userrankname = $userrankname.'-机构' ;
        else if ($branchid == '2') $userrankname = $userrankname.'-门店' ;
        else if ($branchid == '1') $userrankname = $userrankname.'-商户' ;

        $li[$key]['user_rankname']=$userrankname;
        $li[$key]['user_realname']=isset($li[$key]['phone'])?$li[$key]['phone']:'';
    }
*/
   // var_dump($li);

    $my['user_id']=$user_id;
    $my['user_name']=$myphone;
    $my['user_rankname']=$urankname;
    $my['user_realname']=$user_name;

    $mobile_url=gc_urlshort($user_id);

    $shorturl='';
    if($mobile_url["resp_code"]===0){

        $shorturl=$mobile_url["surl"];

    }
    
/*
    $_SERVER['HTTP_REFERER_l']="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

    $num=strrpos($_SERVER['HTTP_REFERER_l'],'/');

    $mobile_num=strrpos($_SERVER['HTTP_REFERER_l'],'mobile');
    //二维码链接
    $m_url=substr($_SERVER['HTTP_REFERER_l'],0,$num);
    // echo  $m_url;
    //短连接潜质
    $s_url=substr($_SERVER['HTTP_REFERER_l'],0,$mobile_num);

    //  echo  $s_url;

    $url=$s_url.$shorturl;
*/
    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $shorturl;
    //    echo $url;
    //二维码
    //二维码存放地址
    $name_url="images/erweima/".$user_id;
    if(!file_exists($name_url)){
        mkdir($name_url);
    }

    $name_erweima=$name_url."/erweima.png";
    if(!file_exists($name_erweima)){

        $qr = erweima($url, $name_erweima);

    }
    // $url=htmlspecialchars($url);
    //生成段地址

    // var_dump($short[1]);

    // $newurl=$s_url.$short[1];
    // echo $newurl;
    //  echo  $url;
    $smarty->assign('linkurl',$name_erweima);
    $smarty->assign('shorturl',$url);
    $smarty->assign('my',$my);
    $smarty->assign('li',$li);
    $smarty->assign("pagebar", $pagebar);
    $smarty->display('mala.dwt');
}
elseif($action=="stock_trade") {

    @$type=$_GET['type'];
    $gp = gc_usershares($user_id,'01')  ;
    $cnt = $gp['cnt'] ;
    $num = 0;
    
    $stocks_list = array() ;
    if ($gp['resp_code'] === 0) {
        while ($num < $cnt)
        {
            $row = $gp[$num] 		;
            $row['amount'] = $row['sharesnum']*$row['unitprice'] ;
            $num += 1 ;
            $stocks_list[] = $row 	;
        }
    }
   
    //$smarty->assign("filename",dirname(__FILE__));
    if($type!=='json') {

        $smarty->assign('sharesfree', $gp['sharesfree']);
        $smarty->assign('stocks_list', $stocks_list);
        $smarty->assign('sharesnum', $gp['sharesnum']);
        $smarty->assign('unitprice', $gp['unitprice']);
        $smarty->assign('curprice', $gp['curprice']);
        $smarty->assign('sharessale', $gp['sharessale']);
        $smarty->assign('sharesamt', $gp['curprice'] * $gp['sharesnum']);
        $smarty->display('mala.dwt');
    }else{

        echo json_encode($stocks_list);

    }

}
elseif ($action == 'send_salestocks') {
    $stocknum = $_GET['stocknum'];
    $stockprice = $_GET['stockprice'] ;
    $ret = gc_sharessale($user_id,$stocknum,$stockprice);
//    print_r($ret['resp_msg']) ;
    if ($ret['resp_code'] === 0) {
        print_r('ok') ;
    } else print_r($ret['resp_msg']) ;
}
elseif ($action == 'stocks_cancel') {
    $sid = $_GET['id'];
    $ret = gc_sharescancel($user_id,$sid);
    if ($ret['resp_code'] === 0) {
        show_message($ret['resp_msg'], $_LANG['app_list_lnk'], 'user.php?act=stock_trade','info');
    } else {
        show_message($ret['resp_msg'], $_LANG['app_list_lnk'], 'user.php?act=stock_trade','info');
    }
}
elseif($action=="gpos") {
    $user_id = $_SESSION['user_id'] ;
    $status='0';
    $gpos=gc_gpos_inq($user_id) ;
    if ($gpos==null || $gpos['user_id'] === 0) {
        $status='8' ;
    } else {
        $status=$gpos['status'] ;
        //        print_r($gpos['status']) ;
        if ($gpos['status'] === '0') {
            include_once('includes/lib_transaction.php');
            /*
             * 收货人信息填写界面
            */
            if (isset($_REQUEST['direct_shopping']))
            {
                $_SESSION['direct_shopping'] = 1;
            }

            /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
            $smarty->assign('country_list',	   get_regions());
            $smarty->assign('shop_country',	   $_CFG['shop_country']);
            $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
            $consignee_list = get_consignee_list($_SESSION['user_id']);
            /* 取得每个收货地址的省市区列表 */
            $province_list = array();
            $city_list = array();
            $district_list = array();
            foreach ($consignee_list as $region_id => $consignee)
            {
                $consignee['country']  = isset($consignee['country'])  ? intval($consignee['country'])  : 0;
                $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
                $consignee['city']	 = isset($consignee['city'])	 ? intval($consignee['city'])	 : 0;

                $province_list = get_regions(1, $consignee['country']);
                $city_list	 = get_regions(2, $consignee['province']);
                $district_list = get_regions(3, $consignee['city']);
            }

            //取得收货地址列表 22:36 2013-7-28
            $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('user_address') . " WHERE city <> '' AND user_id = '$_SESSION[user_id]' limit 8";
            $defaddress = $db->getALL($sql);
            if($_SESSION['user_id'] > 0){
                $isinput = isset($_REQUEST['isinput']) ? $_REQUEST['isinput'] : 0;
            }else{
                $isinput = 1;
            }
            $smarty->assign('isinput', $isinput);
            $smarty->assign('defaddress', $defaddress);

            $smarty->assign('buy_type', 1);
            $smarty->assign('province_list', get_regions(1, $_CFG['shop_country']));
            $smarty->assign('city_list',	 $city_list);
            $smarty->assign('district_list', $district_list);
        }
        if ($gpos['status'] === '9') {
            $GLOBALS['smarty']->assign('posno', $gpos['posno']);
        }
    }
    gc_writelog('status='.$status.'|', __FILE__, __LINE__) ;
    $GLOBALS['smarty']->assign('gposstatus', $status) ;
    if ($status === '0') {
        $smarty->display('gpos.dwt');
    } else {
        $smarty->display('mala.dwt');
    }
} elseif ($action == "send_inq_gpos") {
    $suid = isset($_GET["user_id"]) ? $_GET["user_id"] : $user_id;
    if($_POST['isinput']==1 || empty($_POST['address_id'])){
        //19:21 2013-7-16
        $_POST['country'] = 1;//默认国家
        if(empty($_POST['province']) || empty($_POST['city'])){
            echo '配送区域不可为空！';
            exit;
        }
        if(empty($_POST['consignee']))
        {
            echo '收货人姓名不可为空！';
            exit;
        }
        if(empty($_POST['address']))
        {
            echo '详细地址不可为空！';
            exit;
        }
        if(empty($_POST['tel']))
        {
            echo '电话不可为空！';
            exit;
        }
        if(empty($_POST['email']))
        {
            echo '电子邮箱不可为空！';
            exit;
        }
        /*
         * 保存收货人信息
         */
        $consignee = array(
            'address_id'	=> empty($_POST['address_id']) ? 0  : intval($_POST['address_id']),
            'consignee'	 => empty($_POST['consignee'])  ? '' : compile_str(trim($_POST['consignee'])),
            'country'	   => empty($_POST['country'])	? '' : intval($_POST['country']),
            'province'	  => empty($_POST['province'])   ? '' : intval($_POST['province']),
            'city'		  => empty($_POST['city'])	   ? '' : intval($_POST['city']),
            'district'	  => empty($_POST['district'])   ? '' : intval($_POST['district']),
            'email'		 => empty($_POST['email'])	  ? '' : compile_str($_POST['email']),
            'address'	   => empty($_POST['address'])	? '' : compile_str($_POST['address']),
            'zipcode'	   => empty($_POST['zipcode'])	? '' : compile_str(make_semiangle(trim($_POST['zipcode']))),
            'tel'		   => empty($_POST['tel'])		? '' : compile_str(make_semiangle(trim($_POST['tel']))),
            'mobile'		=> empty($_POST['mobile'])	 ? '' : compile_str(make_semiangle(trim($_POST['mobile']))),
            'sign_building' => empty($_POST['sign_building']) ? '' : compile_str($_POST['sign_building']),
            'best_time'	 => empty($_POST['best_time'])  ? '' : compile_str($_POST['best_time']),
        );

        if ($_SESSION['user_id'] > 0)
        {
            include_once(ROOT_PATH . 'includes/lib_transaction.php');

            /* 如果用户已经登录，则保存收货人信息 */
            $consignee['user_id'] = $_SESSION['user_id'];
            save_consignee($consignee, true);
        }
    }else{
        $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('user_address') . " WHERE user_id = '$_SESSION[user_id]' AND address_id = '$_POST[address_id]'";
        $consignee = $db->getRow($sql);
    }

    $addrstr = get_regions_name($consignee['province']).'|'.get_regions_name($consignee['city']).'|'.get_regions_name($consignee['district']).'|'.$consignee['address'].'|'.$consignee['consignee'].'|'.$consignee['email'].'|'.$consignee['tel'].'|'.$consignee['mobile'].'|'.$consignee['zipcode'];

    $res = gc_gpos_req($suid, $addrstr);
//print_r($res) ;
    if (!empty($res)) {
        if ($res['resp_code'] === 0) {
            show_message("成功提交领取申请!", $_LANG['app_list_lnk'], 'user.php?act=gpos','info');
        } else {
            show_message("提交申请失败", $_LANG['app_list_lnk'], 'user.php?act=gpos','info');
        }
    } else {
        show_message('提交申请失败！', $_LANG['app_list_lnk'], 'user.php?act=gpos','info');
    }
} elseif ($action=="getsms"){

    $tel=isset($_GET['tel'])?$_GET['tel']:'';
    $type=isset($_GET["type"])?$_GET["type"]:'REGISTER';


//  var_dump($type);

     if(!empty($tel)) {
        $row = gc_checkuser($tel);

         if($row['user_id']>0 && $type == 'REGISTER') {
             echo "手机号已经注册";

        } else {
            $res = gc_getusersmssend($tel, $type);


            if ($res['resp_code'] == '0') {
                echo "ok";
            } else {
                echo $res['resp_msg'];
            }

        }
    }else{

         echo  "发送失败";
     }

}elseif($action=='safe_center'){
    require(ROOT_PATH.'includes/lib_clips.php');
    $user_id=$_SESSION['user_id'];
    $do=isset($_GET["do"])?$_GET['do']:'login';
    $phone=isset($_SESSION['phone']) ? $_SESSION['phone'] : "" ;
    $user_info= get_user_default($user_id);
   // var_dump($do);
   // var_dump($user_info);
    if ($user_info['reg_phone'] == 0) {
        $status = "1";
    } else {
        $status = "0";
    }

    $smarty->assign('status',$status);
    $smarty->assign('phone', $phone)  ;
    $smarty->assign('do',$do);
    $smarty->display('safecenter.dwt');
} elseif ($action == 'reset_pay_pwd') {
  //  var_dump($_SESSION);
   if(isset($_SESSION['reset'])){

       $_SESSION['reset']=$_SESSION['reset'];
   }else{
      $_SESSION['reset']=1;

   }

     @$phone = $_SESSION['phone'];
    $smscode = isset($_POST['smscode']) ? trim($_POST['smscode']) : '';
    gc_writelog("reset_pay_pwd=".$phone."|".$smscode."End", __FILE__, __LINE__) ;
   if($_SESSION['reset']==1) {
       $row = gc_resetpaypwd($phone, "11", $smscode);

       if ($row == null) {
           show_message("重置密码出错", "安全中心", 'setting.php');
       }
       if ($row['resp_code'] === 0) {
           $_SESSION['reset'] = 2;
           show_message($row['resp_msg'], "安全中心", 'setting.php');


       } else {
           show_message("重置密码失败", "安全中心", 'setting.php');
       }
   }else{

       show_message("已经重置过支付密码", "安全中心", 'setting.php');

   }

} elseif ($action == 'change_pay_pwd') {
    $phone = $_SESSION['phone'];
    $old_pwd = isset($_POST['old_password']) ? trim($_POST['old_password']) : '';
    $new_pwd1 = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $new_pwd2 = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    gc_writelog("paswd=".$old_pwd."|".$new_pwd1."|".$new_pwd2."E", __FILE__, __LINE__) ;
    if($old_pwd==$new_pwd1){

        show_message("旧密码与新密码一致！", "安全中心", 'setting.php');

    }
    if ($new_pwd1 != $new_pwd2) {
        show_message("二次输入新密码不一致！", "安全中心", 'setting.php');
    }
    if (strlen($old_pwd) != 6 || strlen($new_pwd1) != 6 || strlen($new_pwd2) != 6) {
        show_message("密码长度必须6位数字！", "安全中心", 'user.php?act=safe_center');
    }
    if (is_numeric($old_pwd) == false || is_numeric($new_pwd1) == false || is_numeric($new_pwd2) == false) {
        show_message("密码必须输入全部数字！", "安全中心", 'setting.php');
    }
    $oldpass=gc_rsa_encrypt($old_pwd) ;
    $newpass=gc_rsa_encrypt($new_pwd1) ;
    gc_writelog("|".$oldpass."|".$newpass."|", __FILE__, __LINE__) ;
    $row = gc_changepaypwd($phone,$oldpass, $newpass) ;
    if ($row == null)  {
        show_message("修改密码出错", "安全中心", 'setting.php');
    }
    if ($row['resp_code'] === 0) {
        show_message($row['resp_msg'], "安全中心", 'setting.php');
    } else {
        show_message("修改密码出错", "安全中心", 'setting.php');
    }
}/* 用户中心 */
elseif ($action == 'get_user_name') {
    $user_phone = trim($_GET['phone']);
    if ($user_phone === $myphone) {
        echo 'false';
    } else {
        $reuser = gc_checkuser($user_phone) ;
        if ($reuser == null) {
            echo 'false' ;
        } else if ($reuser['user_id'] == 0) {
            echo 'false';
        } else {
            echo $reuser['user_name'] ;
        }
    }



}else if($action=='get_mala_user'){

    $user_phone = trim($_GET['phone']);

        $reuser = gc_checkuser($user_phone) ;
        if ($reuser == null) echo 'false' ;
        else if ($reuser['user_id'] == 0) {
            echo 'false';
        } else {
            echo $reuser['user_name'] ;
        }

}else if($action=='getcity'){
    include_once('includes/cls_json.php');
    $json = new JSON;

    if(!empty($_GET["bankinfo"])&&!empty($_GET["provinceinfo"])) {
        $bankinfo = $_GET["bankinfo"];
        $provinceinfo = $_GET["provinceinfo"];

        $sql = "SELECT cityid,cityname FROM  `d_paybankinfo` WHERE provinceid =" . $provinceinfo . " AND bankid =" . $bankinfo . " GROUP BY cityname";

        $info = $db->getAll($sql);

        //  echo $sql;
        echo  $json->encode($info);

    }




}else if($action=="getzhihang") {

    include_once('includes/cls_json.php');
    $json = new JSON;

    if (!empty($_GET["bankinfo"]) && !empty($_GET["cityinfo"])) {
        $bankinfo = $_GET["bankinfo"];
        $cityinfo = $_GET["cityinfo"];

        $sql = "SELECT bankbranchid,bankbranchname FROM  `d_paybankinfo` WHERE cityid =" . $cityinfo . " AND bankid =" . $bankinfo . " GROUP BY bankbranchname";

        $info = $db->getAll($sql);

        //  echo $sql;
        echo  $json->encode($info);
    }

}elseif($action == "act_add_card") {


    // include_once(root_path.'includes/cls_image.php');
    error_reporting(E_ALL ^ E_NOTICE);

    $message = array(
        'user_id' => $_SESSION['user_id'],
        'user_name' => @$_REQUEST["user_name"],
        'user_email' => $_SESSION['email'],
        'banks'=>@$_REQUEST["banks"],
        'bankaccount'=>@$_REQUEST["bankaccount"],
        'bankname'=>@$_REQUEST["bankname"],
/*        
        'upload1' => (isset($_FILES['card_img_1']['error']) && $_FILES['card_img_1']['error'] == 0) || (!isset($_FILES['card_img_1']['error']) && isset($_FILES['card_img_1']['tmp_name']) && $_FILES['card_img_1']['tmp_name'] != 'none')
            ? $_FILES['card_img_1'] : array(),
        'upload2' => (isset($_FILES['card_img_2']['error']) && $_FILES['card_img_2']['error'] == 0) || (!isset($_FILES['card_img_2']['error']) && isset($_FILES['card_img_2']['tmp_name']) && $_FILES['card_img_2']['tmp_name'] != 'none')
            ? $_FILES['card_img_2'] : array(),

        'upload3' => (isset($_FILES['yhcard_img_1']['error']) && $_FILES['yhcard_img_1']['error'] == 0) || (!isset($_FILES['yhcard_img_1']['error']) && isset($_FILES['yhcard_img_1']['tmp_name']) && $_FILES['yhcard_img_1']['tmp_name'] != 'none')
            ? $_FILES['yhcard_img_1'] : array(),
        'upload4' => (isset($_FILES['yhcard_img_2']['error']) && $_FILES['yhcard_img_2']['error'] == 0) || (!isset($_FILES['yhcard_img_2']['error']) && isset($_FILES['yhcard_img_2']['tmp_name']) && $_FILES['yhcard_img_2']['tmp_name'] != 'none')
            ? $_FILES['yhcard_img_2'] : array(),
        'upload5' => (isset($_FILES['ercard_img_1']['error']) && $_FILES['ercard_img_1']['error'] == 0) || (!isset($_FILES['ercard_img_1']['error']) && isset($_FILES['ercard_img_1']['tmp_name']) && $_FILES['ercard_img_1']['tmp_name'] != 'none')
            ? $_FILES['ercard_img_1'] : array(),
*/
    );

    foreach ($message as $key=> $msg){
        if(empty($msg)){
            switch  ($key) {

                case  "bankaccount":
                    show_message("银行帐号为空");
                    break;
                case  "bankname";
                    show_message("支行名为空");
                    break;
/*                case  "upload1" :
                    show_message("身份证正面为空");
                    break;
                case  "upload2" :
                    show_message("身份证反面为空");
                    break;
                case "upload3" :
                    show_message("银行卡正面为空");
                    break;
                case "upload4" :
                    show_message("银行卡反面为空");
                    break;
                case "upload5" :
                    show_message("二合一为空");
                    break; */
            }

        }


    }

    $bankno=trim($_REQUEST["bankno"]);

    $banksql="select bankname,bankbranchname from d_paybankinfo where bankbranchid=".$bankno;

    $bankinfo=$db->getAll($banksql);
   // var_dump($user_id);
   // var_dump($_SESSION['user_id']);
    include_once('includes/lib_check.php');
    
    $realname['user_id']=isset($_SESSION["user_id"])?$user_id:$_SESSION['user_id'];
    $realname['user_name']=trim($_REQUEST['user_name']);
    $realname['pidno']=trim($_REQUEST['pidno']);
    $realname['banks']=trim($bankinfo[0]['bankname']);
    $realname['bankno']=trim($_REQUEST['bankno']);
    $realname['bankaccount']=trim($_REQUEST['bankaccount']);
    $realname['bankname']=trim($bankinfo[0]['bankbranchname']);

    if (luhmCheck($realname['bankaccount']) == false) {
        show_message("银行账号错误!", "用户中心", 'user.php?act=true_info');
    }
    if (isPidNo($realname['pidno']) == false) {
        show_message("身份证号输入错误!", "用户中心", 'user.php?act=true_info');
    }
/*    
    include_once('includes/cls_image.php');
    $filename=$user_id;
    $img = new  cls_image();

    $imgname["img1"]= $img->upload_image($message['upload1'], $dir = $filename, $img_name ='',$type="phone");
    $imgname["img2"]= $img->upload_image($message['upload2'], $dir = $filename, $img_name = '',$type="phone");
    $imgname["img3"]= $img->upload_image($message['upload3'], $dir =$filename, $img_name = '',$type="phone");
    $imgname["img4"]= $img->upload_image($message['upload4'], $dir = $filename, $img_name = '',$type="phone");
    $imgname["img5"]= $img->upload_image($message['upload5'], $dir =$filename, $img_name = '',$type="phone");

    foreach($imgname as $key=>$val){

        $newval=explode("/",$val);

        @$realname[$key]=$newval[5]."/".$newval[6]."/".$newval[7];


    }

*/

    $result=gc_user_realname_auth($realname);


    if($result===0){

        show_message($result['resp_msg'], "用户中心", 'user.php?act=true_info');
    }else{
        show_message($result['resp_msg'], "用户中心", 'user.php?act=true_info');

    }

   // $smarty->display('act_add_card.dwt');




}elseif($action=='mobile_buy'){
    $user_id=$_SESSION["user_id"];
    $groupid="02";
    $res=gc_mlmobilebuy($user_id,$groupid);


     $smarty->assign('mltypelist',$res);
    $smarty->display('mobile_buy.dwt');

}elseif($action=="true_info"){

    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    include_once(ROOT_PATH . 'includes/lib_clips.php');


    $sql = "SELECT bankid,bankname FROM  `d_paybankinfo` where bankid>100 and  bankid<106  GROUP BY bankname order by bankid asc";
    $sql2 = "SELECT bankid,bankname FROM  `d_paybankinfo` where bankid>300 and  bankid<310 and bankid!=306 GROUP BY bankname order by bankid asc";

    $sql1="SELECT provinceid, provincename FROM  `d_paybankinfo` GROUP BY provincename";
    $bank1 = $db->getAll($sql);
    $bank2=$db->getAll($sql2);
    $province=$db->getAll($sql1);
    array_shift($province);
    $bankinfo=array_merge($bank1,$bank2);
    //var_dump($bankinfo);

    $result=gc_get_realname_auth($user_id);

    if($result["resp_code"]===0){
        $result=$result['user'];

        if(@$result["userid"]!==0) {

            if($result["status"]==1 || $result["status"]==9){
                $sql = " SELECT  provincename,cityname  FROM `d_paybankinfo` WHERE bankbranchid=" . $result["bankno"];
                $res = $db->getAll($sql);

                // var_dump($res);
                $smarty->assign("status", $result["status"]);
                $smarty->assign("user_name", $result["user_name"]);//姓名
                $smarty->assign("banks", $result["banks"]);//银行
                $smarty->assign("pidno", $result["pidno"]);//身份证
                $smarty->assign("bankno", $result["bankno"]);//支行代码号
                $smarty->assign("bankaccount", $result["bankaccount"]);//银行卡号
                $smarty->assign("bankname", $result["bankname"]);//支行名字
                $smarty->assign("provincename", $res[0]["provincename"]);//省份
                $smarty->assign("cityname", $res[0]["cityname"]);//市区

            }else{

                $sql = " SELECT bankbranchid,bankid, provinceid, provincename,cityid,cityname  FROM `d_paybankinfo` WHERE bankbranchid=" . $result["bankno"];
                $res = $db->getAll($sql);

                $smarty->assign("status", $result["status"]);

                $smarty->assign("note",$result["note"]);
                $smarty->assign("user_name", $result["user_name"]);//姓名
                $smarty->assign("banks", $result["banks"]);//银行
                $smarty->assign("pidno", $result["pidno"]);//身份证
                $smarty->assign("bankno", $result["bankno"]);//支行代码号
                $smarty->assign("bankaccount", $result["bankaccount"]);//银行卡号
                $smarty->assign("bankname", $result["bankname"]);//支行名字
                $smarty->assign("provincename", $res[0]["provincename"]);//省份
                $smarty->assign("bankid",$res[0]["bankid"]);//

                $smarty->assign("provinceid",$res[0]["provinceid"]);//省份代码
                $smarty->assign("bankbranchid",$res[0]["bankbranchid"]);

                $smarty->assign("cityid",$res[0]["cityid"]);//市区代码
                $smarty->assign("cityname", $res[0]["cityname"]);//市区


                $smarty->assign("bankinfo", $bankinfo);
                $smarty->assign("province", $province);




            }
        }

    }else{


        $smarty->assign("bankinfo", $bankinfo);
        $smarty->assign("province", $province);

    }

    $smarty->display('true_info.dwt');



}elseif($action == "account_detail"){
    if ($_SESSION['user_id'] > 0 || gc_wxResAndLogin())
    {
        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $Loaction = 'account.php?act=account_detail';
        ecs_header("Location: $Loaction\n");
        exit;
    }

    $smarty->assign('footer', get_footer());
    $smarty->display('login.dwt');
    exit;

}elseif($action=="ll_detail"){
    if ($_SESSION['user_id'] > 0 || gc_wxResAndLogin())
    {
        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $Loaction = 'll.php';
        ecs_header("Location: $Loaction\n");
        exit;
    }
    $smarty->assign('footer', get_footer());
    $smarty->display('login.dwt');
    exit;

} elseif($action=='ml100'){
   // var_dump($_SESSION);
     $userid=$_SESSION['user_id'];
     $user_name=$_SESSION['user_name'];
    $amount=$_SESSION['balance']+$_SESSION['award_bal'];


      $groupid="02";
     $res=gc_mlmobilebuy($userid,$groupid);


    $smarty->assign("mltypelist",$res);
    $smarty->assign("amount",$amount);

    $smarty->display('ml100.dwt');


} elseif($action=='goldcard'){
    $smarty->display('mala.dwt');
} elseif($action=='act_goldcard'){
    $user_id = $_SESSION['user_id'];
    $cardno = isset($_POST['cardno']) ? trim($_POST['cardno']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $newpass = md5($password) ;

    $row = gc_goldcard_recharge($user_id,$cardno, $newpass) ;
//    print_r($row) ;
    if ($row == null)  {
        show_message("充值出错", "金币充值", 'user.php?act=goldcard');
    }
    if ($row['resp_code'] === 0) {
        show_message($row['resp_msg'], "金币充值", 'user.php?act=goldcard');
    } else {
        show_message("出错:".$row['resp_msg'], "金币充值", 'user.php?act=goldcard');
    }
}else if($action=="checkzhifupassword") {



    //$_SESSION["last_time"]=$_GET["time"];
    /*
        if(time()-$_SESSION["last_time"]>60*10){

            unset($_SESSION["last_time"]);
        }
    */

    $pass = $_GET["password"];
    $phone=$_SESSION['phone'];
    $pass=gc_rsa_encrypt($pass);
    $res=gc_checkpaypwd($phone,$pass);

    // var_dump($res);
    if($res['resp_code']===0){
        $_SESSION['last_time']=time();
        $_SESSION['ipaddress']=real_ip();

        echo "ok";

    }else{

        echo  "error";
    }



    // echo  $_SESSION["last_time"].$pass;
}else if($action=="checkalreadypassword"){


    $address_ip=real_ip();
    //传送过来的时间
    $time=$_GET["time"];
    //var_dump($time);
    //session里面存放的时间

    $time_save=@$_SESSION['last_time'];
    if(!empty($time_save)){

        $max=$time-$time_save;


    }

    // var_dump($max);
    $address_ip = real_ip();
   // var_dump($address_ip);
    $address_save=@$_SESSION["ipaddress"];
    //  var_dump($max);
    // die();
    if(isset($max)) {
        if ($max > 60) {

            unset($_SESSION['last_time']);
            echo "error";
        } else {
            //  die();
            echo "ok";
        }
    }else if($address_save!==$address_ip){

        echo "error";
    }else{

        echo  "error";

    }

}
else
{
    if ($_SESSION['user_id'] > 0)
    {
        $disphard = isset($_GET['disphard'])?$_GET['disphard']:'0';
        $_SESSION['disphard'] = $disphard ;
        $smarty->assign('disphard', $disphard);
        show_user_center();
    }
    else
    {
//print_r("user_id = 0") ;
        $reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
        if(!empty($reuser_name)){
            $smarty->assign('reuser_name', $reuser_name);
        }
        $disphard = isset($_GET['disphard'])?$_GET['disphard']:'0';
        $_SESSION['disphard'] = $disphard ;
        $smarty->assign('disphard', $disphard);
        $smarty->assign('footer', get_footer());
        $smarty->assign('link',@$_GET['link']);
        $smarty->assign('ml_phone',@$_GET['ml_phone']);
        $smarty->display('login.dwt');
        exit;
    }
}

/* 微信绑定账号列表*/
function wechat_bind_list($openid)
{
    $userList = gc_weixin_getuserinfo($openid);
    /*
    if ($userList["cnt"] == 0) {
        $GLOBALS['smarty']->display('login.dwt');
        exit;
    }else {
        gc_wxResAndLogin();
        $GLOBALS['smarty']->assign('userList', $userList["list"]);

    }
    */
    $GLOBALS['smarty']->assign('userList', $userList);
    $GLOBALS['smarty']->display('wechat_user_list.dwt');
    exit;
}

/**
 * 用户中心显示
 */
function show_user_center()
{
    include_once(ROOT_PATH .'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_tdwsys.php');
//print_r("show_user_center") ;
    $best_goods = get_recommend_goods('best');
    $user_id=$_SESSION['user_id'];
   // var_dump($user_id);
    $res_info=gc_getuserinfo($user_id);
   // var_dump($res_info);



    if (count($best_goods) > 0)
    {
        foreach  ($best_goods as $key => $best_data)
        {
            $best_goods[$key]['shop_price'] = encode_output($best_data['shop_price']);
            $best_goods[$key]['name'] = encode_output($best_data['name']);
        }
    }
    
    $user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:0 ;
    
    if ($user_id > 0) {
        $gp = gc_usershares($user_id)  ;
        if ($gp != null) {
            $GLOBALS['smarty']->assign('sharesnum', @$gp['sharesnum']);
            $GLOBALS['smarty']->assign('unitprice', @$gp['unitprice']);
            $GLOBALS['smarty']->assign('curprice', @$gp['curprice']);
            $GLOBALS['smarty']->assign('sharesamt', @$gp['curprice']*@$gp['sharesnum']);
        }
    }

    $GLOBALS['smarty']->assign('info', get_user_default($_SESSION['user_id']));
 //   $GLOBALS['smarty']->assign('rank_name', $urankname);
    $GLOBALS['smarty']->assign('user_id',$user_id);
    $GLOBALS['smarty']->assign('user_info', get_user_info());
    $GLOBALS['smarty']->assign('best_goods' , $best_goods);
    $GLOBALS['smarty']->assign('footer', get_footer());
    $GLOBALS['smarty']->display('user.dwt');
}

/**
 * 手机注册
 */
function m_register($phone,$pidno, $smscode, $password,$username, $email,$recode)
{
    /* 检查username */
    /*	if (empty($username))
        {
            echo '<script>alert("用户名必须填写！");history.go(-1); </script>';
            return false;
        }
        if (preg_match('/\'\/^\\s*$|^c:\\\\con\\\\con$|[%,\\*\\"\\s\\t\\<\\>\\&\'\\\\]/', $username))
        {
            echo '<script>alert("用户名错误！");history.go(-1); </script>';
            return false;
        }
    */
    if (empty($smscode))
    {
        echo '<script>alert("短信验证码必须填写！");history.go(-1); </script>';
        return false;
    }
    if (empty($recode))
    {
        echo '<script>alert("推荐人必须填写！");history.go(-1); </script>';
        return false;
    }

    /* 检查是否和管理员重名 *
    if (admin_registered($username))
    {
        echo '<script>alert("此用户已存在！");history.go(-1); </script>';
        return false;
    }
    */

    if(strlen($recode)<=0 )
    {
        echo '<script>alert("推荐人不能为空！");history.go(-1); </script>';
        return false;
    }
    else
    {
        $row = gc_checkuser($recode) ;
        if ($row == null) {
            echo '<script>alert("通讯失败，请稍后再做!");history.go(-1); </script>';
            return false;
        } else if ($row['user_id'] <= 0)
        {
            echo '<script>alert("推荐人不存在");history.go(-1); </script>';
            return false;
        }
    }

    $row = $GLOBALS['user']->add_user($phone, $pidno, $smscode, $password, $username, $email, $recode);
    if ($row['user_id'] === 0)
    {
        $ret = $row['resp_msg'];
        echo "<script>alert('".$ret."');history.go(-1); </script>";
//		window.location.href=\"user.php?act=register\";
        //注册失败
        return false;
    }
    else
    {
        //注册成功

        /* 设置成登录状态 */
        $GLOBALS['user']->set_session($username);
        $GLOBALS['user']->set_cookie($username);

        update_user_info();      // 更新用户信息
        recalculate_price();     // 重新计算购物车中的商品价格

        echo "<script>window.location.href=\"user.php?act=default\"; </script>";
        return true;
    }


    //安全中心









}
/**
 * 手机注册
 */
function m_in_register($phone, $pidno, $password,$username, $email,$recode)
{
    /* 检查username */
    if (empty($username))
    {
        echo '<script>alert("用户名必须填写！");history.go(-1); </script>';
        return false;
    }
    if (empty($recode))
    {
        echo '<script>alert("推荐人必须填写！");history.go(-1); </script>';
        return false;
    }
    if (preg_match('/\'\/^\\s*$|^c:\\\\con\\\\con$|[%,\\*\\"\\s\\t\\<\\>\\&\'\\\\]/', $username))
    {
        echo '<script>alert("用户名错误！");history.go(-1); </script>';
        return false;
    }

    /* 检查是否和管理员重名 *
     if (admin_registered($username))
     {
     echo '<script>alert("此用户已存在！");history.go(-1); </script>';
     return false;
     }
     */

    if(strlen($recode)<=0 )
    {
        echo '<script>alert("推荐人不能为空！");history.go(-1); </script>';
        return false;
    }
    else
    {
        $row = gc_checkuser($recode) ;
        if ($row == null) {
            echo '<script>alert("通讯失败，请稍后再做!");history.go(-1); </script>';
            return false;
        } else if($row['user_id'] <= 0)
        {
            echo '<script>alert("推荐人不存在");history.go(-1); </script>';
            return false;
        }
    }

    $row = $GLOBALS['user']->add_in_user($phone,$pidno, $password, $username, $email, $recode);
    if ($row['user_id'] === 0)
    {
        $ret = $row['resp_msg'];
        echo "<script>alert('".$ret."');history.go(-1); </script>";
        //		window.location.href=\"user.php?act=in_register\";
        //注册失败
        return false;
    }
    else
    {
        //注册成功
        echo "<script>alert('注册成功!');window.location.href=\"user.php?act=in_register\"; </script>";
        return true;
    }
}

  function erweima($url,$name){
      require_once(ROOT_PATH."/phpqrcode/phpqrcode.php");
      $value = $url; //二维码内容
      $errorCorrectionLevel = 'L';//容错级别
      $matrixPointSize = 6;//生成图片大小
//生成二维码图片
      QRcode::png($value, $name, $errorCorrectionLevel, $matrixPointSize, 2);




  }


class Short_Url {
    #字符表
    public static $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    public static function short($url) {
        $key = "alexis";
        $urlhash = md5($key . $url);
        $len = strlen($urlhash);

        #将加密后的串分成4段，每段4字节，对每段进行计算，一共可以生成四组短连接
        for ($i = 0; $i < 4; $i++) {
            $urlhash_piece = substr($urlhash, $i * $len / 4, $len / 4);
            #将分段的位与0x3fffffff做位与，0x3fffffff表示二进制数的30个1，即30位以后的加密串都归零
            $hex = hexdec($urlhash_piece) & 0x3fffffff; #此处需要用到hexdec()将16进制字符串转为10进制数值型，否则运算会不正常

            $short_url = "";
            #生成6位短连接
            for ($j = 0; $j < 6; $j++) {
                #将得到的值与0x0000003d,3d为61，即charset的坐标最大值
                $short_url .= self::$charset[$hex & 0x0000003d];
                #循环完以后将hex右移5位
                $hex = $hex >> 5;
            }

            $short_url_list[] = $short_url;
        }
        return $short_url_list;
    }
}

?>