<?php

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
require_once(ROOT_PATH . 'includes/lib_llsys.php');
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');

$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$smarty->assign('action', $action);

$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:0 ;
$disphard='2' ;
$_SESSION['disphard']=$disphard ;
$smarty->assign('disphard', $disphard);

$data=null;
if ($action == 'wx_login')
{
    if (gc_wxResAndLogin()){
        $ucdata = empty($user->ucdata)? "" : $user->ucdata;
        $Loaction = 'll.php';
        ecs_header("Location: $Loaction\n");
    } else {
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
            ecs_header("Location:ll.php\n");
            $login_faild = 1;
        }
        else
        {
            if ($user->check_user($user_name, $pwd) > 0)
            {
                $user->set_session($user_name);
                $user->set_cookie($user_name);
                update_user_info();
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
else if ($action == 'queue')
{
    $qid = $_GET['qid'] ;
    $llsys=gc_llsys_queue($user_id, $qid) ;
    $GLOBALS['smarty']->assign('llsys', $llsys);
    $GLOBALS['smarty']->assign('qid', $qid);
    $orderdata = array() ;
    $begin = 0 ;
    while ($begin < 10 && $llsys['order'][$begin] > 0) {
        $o['order'] = $llsys['order'][$begin] ;
        $o['point'] = $llsys['point'][$begin] ;
        $o['otype'] = $llsys['otype'][$begin] ;
        $orderdata[] = $o ;
        $begin += 1 ;
    }
    $user_name = isset($_SESSION['user_name'])?$_SESSION['user_name']:'' ;
    $data=$orderdata;
    $GLOBALS['smarty']->assign('orderdata', $orderdata);
    $GLOBALS['smarty']->assign('user_name', $user_name);
    $GLOBALS['smarty']->display('ll.dwt');
} 
else if ($action == 'order')
{
    $qid = $_GET['qid'] ;
    $oid = $_GET['oid'] ;
    $pos=$_GET['pos'];
    $llsys=gc_llsys_order($oid);
    $llsys['pos']=$pos;

    echo  json_encode($llsys);
    //$user_name = isset($_SESSION['user_name'])?$_SESSION['user_name']:'' ;
   // $GLOBALS['smarty']->assign('qid', $qid);
  //$GLOBALS['smarty']->assign('llsys', $llsys);
   // $GLOBALS['smarty']->assign('user_name', $user_name);
   // $GLOBALS['smarty']->display('ll.dwt');
} 
else if ($action == 'll_account')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $account_type = 'user_money';

    /* 获取记录条数 */
    $acctype = 'LL';
	$record_count = gc_getaccountcnt($user_id,$acctype);

    //获取余额记录
    $account_log = array();
   // $pager = get_pager('user.php', array('act' => $action), $record_count, $page);
    
    $account_list = array();
    $sur_amount = 0 ;
    $page_start = 0 ;
    $page_num = '20';
    $pagebar = 0    ;
    if($record_count){
        $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $pagebar = get_wap_pager($record_count, $page_num, $page, 'll.php?act=ll_account', 'page');
       $page_start=$page_num*($page-1);

    }
    $res = gc_getaccountlist($user_id, "LL", $page_start,$page_num) ;
    if ($res['resp_code'] == '0') {
        $cnt = $res['cnt'] ;
        $surplus_amount = $res['amount'] ;
        $num = 0 ;
        while ($num < $cnt) {
            $row = $res[$num] ;
            $num++ ;
            $row['change_time'] = local_date("m-d", $row['change_time']);
            $row['type'] = $row[$account_type] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
//            $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
            $row['rank_points'] = 0 ;
            $row['pay_points'] = $row['pay_points'];
            $row['short_change_desc'] = sub_str($row['change_desc'], 60);
            $row['amount'] = $row[$account_type];
            $uid=$row['user_id'];
//            $row['user_realname'] = $row['user_name'] ;
            $account_list[] = $row;
        }
    }
   	
    //模板赋值
//    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
	$smarty->assign('account_log', $account_list);
	$smarty->assign('act', 'll_acount');
	$smarty->assign('pagebar', $pagebar);
	$smarty->display('ll.dwt');
} 
/* 会员T币转账界面 */
elseif ($action == 'll_transfer')
{
	include_once(ROOT_PATH . 'includes/lib_clips.php');

    if ($_SESSION['user_rank'] < 2) {
        $gold_amount = 0 ;
        $tb_amount = 0 ;
        $surplus_amount = 0 ;
    } else {
        $row = gc_getaccountinfo($user_id) ;
        $gold_amount = $row['gold_amt'];
        $tb_amount = $row['tb_bal'];
        $surplus_amount = $row['balance'] + $row['award_bal'];
    }

	$myphone=isset($_SESSION['phone'])?$_SESSION['phone']:"" ;
	
	$smarty->assign('gold_amount', price_format($gold_amount, false));
    $smarty->assign('balance', $surplus_amount);
    $smarty->assign('tb_bal', $tb_amount);
    $smarty->assign('gold_balance', $gold_amount);
	$smarty->assign('myphone', $myphone);
	$smarty->assign('myrealname',   $_SESSION['user_name']);
	$smarty->assign('act', 'll_transfer');
	$smarty->display('ll.dwt');
}
/* 会员T币转余额界面 */
elseif ($action == 'll_tb_balance')
{
	include_once(ROOT_PATH . 'includes/lib_clips.php');

	if ($_SESSION['user_rank'] < 2) {
	    $tb_bal = 0 ;
	} else {
	    $tb_bal = get_user_tb($user_id);
	}
	
    $award_bl=10 ;

	
	$award_je=(100 - $award_bl)*100 ;
	$smarty->assign('award_amount', $tb_bal."T币");
	$smarty->assign('tb_bal', $tb_bal);
	$smarty->assign('award_bl',   $award_bl);
	$smarty->assign('award_je',   $award_je);
	$smarty->assign('myrealname',   $_SESSION['user_name']);
	$smarty->assign('act', 'll_tb_balance');
	$smarty->display('ll.dwt');
}
/* 会员T币提款界面 */
elseif ($action == 'll_credit')
{
	include_once(ROOT_PATH . 'includes/lib_clips.php');
	
	$surplus_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	//$account	= get_surplus_info($surplus_id);
	
	//获取剩余余额
	$surplus_amount = get_user_tb($user_id);
	//var_dump($surplus_amount);
	if (empty($surplus_amount)){
		$surplus_amount = 0;
	}
	
	//读取实名认证数据
	$row=gc_get_realname_auth($user_id) ;
	$realnameflag = 0 ;
	$user = null ;
	if ($row == null) {
	    $realnameflag = '0' ;
	} else {
	    $user = isset($row['user'])?$row['user']:null ;
	    if ($user == null) {
	       $realnameflag = '0' ;
	    } else if ($user['user_id'] === 0) {
	       $realnameflag = '0' ;
	    } else if ($user['status'] != '9') {
    	    $realnameflag = '0' ;
    	} else {
    	    $realnameflag = $row['realnameflag'] ;
    	}
	}
	$smarty->assign('realnameflag', $realnameflag) ;
	$_SESSION['realnameflag'] = $realnameflag ;
	$cardlists = array() ;
    foreach($row as $key=>$val) {
        if(is_array($val)) {
            $cardlists[$key]["bankaccount"] = $row["user"]["bankaccount"];
            $cardlists[$key]["bankname"] = $row["user"]["bankname"];
        }
    }
	//提款卡表
	$smarty->assign('realnamedata', $cardlists) ;
	$smarty->assign('surplus_amount', price_format($surplus_amount, false));
	$smarty->assign('myrealname', $_SESSION['user_name']);
	$smarty->assign('act', 'll_credit');
	$smarty->display('ll.dwt');
}
/* 会员T币提款界面 */
elseif ($action == 'll_act')
{
	include_once(ROOT_PATH . 'includes/lib_clips.php');
	include_once(ROOT_PATH . 'includes/lib_order.php');
	$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
	if ($amount <= 0)
	{
        show_llmsg("请在“金额”栏输入大于0的数字", "返回操作界面", 'll.php?act=ll_credit','info');
        return 0 ;
	}
	//获取剩余余额
	$surplus_amount = get_user_surplus($user_id);
	if (empty($surplus_amount)){
		$surplus_amount = 0;
	}
	$smarty->assign('surplus_amount', price_format($surplus_amount, false));
	
	/* 变量初始化 */
	$surplus = array(
			'user_id' => $user_id,
			'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0,
			'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
			'payment_id' => 2,
			'user_note' => isset($_POST['user_note']) ? trim($_POST['user_note']) : '',
      'bankname'    => '',
      'bankaddress'    => '',
      'myname'    => '',
      'myaccount'    => '',
			'amount' => $amount
	);
	/* 提款的处理 */
	if ($surplus['process_type'] == 1) //提现
	{
		/* 判断是否有足够的余额的进行退款的操作 */
        $sur_amount = get_user_tb($user_id);
        
		if ($amount > $sur_amount)
		{
            show_llmsg("您要申请提现的金额超过了您现有的余额，此操作将不可进行！", "返回操作界面", 'll.php?act=ll_credit','info');
            return 0;
		}

            if ($amount < 100) {
                show_llmsg("提款金额太小，请输入大于100元！", "返回操作界面", 'll.php?act=ll_credit','info');
            }
            $bankaccount = isset($_POST['bankaccount']) ? $_POST['bankaccount'] : "" ;
            ini_set('max_execution_time',120);
            $row = gc_user_drawing($user_id, $bankaccount, $amount, 'TB') ;
            if ($row == false)
            {
               show_llmsg("此次操作失败，请返回重试！", "返回操作界面", 'll.php?act=ll_credit','info');
            } else  if ($row['resp_code'] !== 0) {
               show_llmsg('出错:'.$row['resp_msg'], "返回操作界面", 'll.php?act=ll_credit','info');
            } else {
               show_llmsg("您的提现申请已成功提交!", "返回操作界面", 'll.php?act=ll_credit','info');
            }
	}
	/* 积分转余额的处理 */
    else if ($surplus['process_type'] == 2) // tb转余额
    {
        /* 判断是否有足够的余额的进行退款的操作 */
         $sur_amount = get_user_tb($user_id);
        if ($amount > $sur_amount)
        {
            show_llmsg("您的转现的余额不足！", "返回操作界面", 'll.php?act=ll_tb_balance','info');
            return 0;
        }

        //插入会员账目明细
        $ret = gc_tb_to_balance($user_id,$amount) ;
        
        /* 如果成功提交 */
        if ($ret == null)
        {
            show_llmsg("您的转现交易失败 ！", "返回操作界面", 'll.php?act=ll_tb_balance','info');
        }
        else if ($ret['resp_code'] === 0) 
        {
            show_llmsg("您的转现交易成功 ！", "返回操作界面", 'll.php?act=ll_tb_balance','info');
        } else {
            $content = '金币转账失败：'.$ret['resp_msg'] ;
            show_llmsg($content, "返回操作界面", 'll.php?act=ll_tb_balance','info');
        }
    }
    else if ($surplus['process_type'] == 3) //转账
    {
        /* 判断是否有足够的余额的进行转账的操作 */
        $tocode = isset($_POST['tocode']) ? $_POST['tocode'] : 0 ;
        $tftype = 'tb_bal' ;

        //调用转账交易
        $ret = gc_account_transfer($tftype, $user_id,$tocode, $amount) ;
        
        /* 如果成功提交 */
        if ($ret == null)
        {
            show_llmsg("您的转现交易失败 ！", "返回操作界面", 'll.php?act=ll_transfer','info');
        }
        else if ($ret['resp_code'] === 0) 
        {
            show_llmsg("您的转现交易成功 ！", "返回操作界面", 'll.php?act=ll_transfer','info');
        } else {
            $content = '金币转账失败：'.$ret['resp_msg'] ;
            show_llmsg($content, "返回操作界面", 'll.php?act=ll_transfer','info');
        }
    }
}
else 
{
   //unset($_SESSION);
    $user_id=isset($_GET['llid'])?(int)$_GET['llid']:$_SESSION['user_id'];



    if ($_SESSION['user_id'] > 0)
    {
        show_ll_center();
    }else if($user_id>0){
        $user_info=gc_getuserinfo($user_id);
        $_SESSION=$user_info;
        $_SESSION['user_id']=$user_id;
        @$_SESSION['discount']=0;
        $_SESSION['phone']=$user_info['phone'];

        //var_dump($_SESSION);
        show_ll_center();
    }
    else
    {
        //print_r("user_id = 0") ;
        $reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
        if(!empty($reuser_name)){
            $smarty->assign('reuser_name', $reuser_name);
        }
        $smarty->assign('footer', get_footer());
        $smarty->assign('link','ll') ;
        $smarty->assign('ml_phone',@$_GET['ml_phone']);
        $smarty->display('login.dwt');
        exit;
    }
}

/**
 * 用户来啦中心显示
 */
function show_ll_center()
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_tdwsys.php');
    //print_r("show_user_center") ;
    $best_goods = get_recommend_goods('best');
    if (count($best_goods) > 0) {
        foreach ($best_goods as $key => $best_data) {
            $best_goods[$key]['shop_price'] = encode_output($best_data['shop_price']);
            $best_goods[$key]['name'] = encode_output($best_data['name']);
        }
    }

    $urankname = "";
    $myrank = isset($_SESSION['user_rank']) ? $_SESSION['user_rank'] : "";
    $mybuss = isset($_SESSION['buss_rank']) ? $_SESSION['buss_rank'] : "";
    if ($myrank == '1') $urankname = "一般用户";
    if ($myrank == '2') $urankname = '<font color="#0000FF">麦啦会员</font>';
    if ($myrank == '4') {
        $urankname = "一般";
        if ($mybuss == '1') $bussrankname = '<font color="#088A08">☆';
        if ($mybuss == '2') $bussrankname = '<font color="#FFBF00">☆☆';
        if ($mybuss == '3') $bussrankname = '<font color="#DF013A">☆☆☆';
        $urankname = $bussrankname . "合伙人</font>";
    }
    if ($myrank == '5') $urankname = '<font color="#FF6600">合伙机构</font>';

    $user_id = $_SESSION['user_id'];
    // var_dump($user_id);
    $llcnt = gc_llsys_inq($user_id,'0','0');
    $record_count = $llcnt['cnt'] ;
    $page_start = 0 ;
    $page_num = '20';
    $pagebar = 0    ;
    if($record_count){
        $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $pagebar = get_wap_pager($record_count, $page_num, $page, 'll.php', 'page');
        $page_start=$page_num*($page-1);
        $GLOBALS['smarty']->assign('page_num',$page);
    }
    $llsys = gc_llsys_inq($user_id,$page_start,$page_num);
    if (!empty($llsys['data'])) {
        $qid = isset($_GET['qid']) ? $_GET['qid'] : $llsys['data'][0];
        $orderdata = ll_data($user_id, $qid);
        $weizhi = array_search($qid, $llsys['data']);
        $area = 1;
        $areaname = "100区";

        $num = count($orderdata);

        if ($num < 11) {
            for ($i = $num; $i < 11; $i++) {
                $orderdata[$i]['color'] = 'data_fff';

            }
        }

    //var_dump(get_user_info($user_id));

    $GLOBALS['smarty']->assign('data', $orderdata);
 	$GLOBALS['smarty']->assign('pagebar', $pagebar);
    $GLOBALS['smarty']->assign('qid', $qid);
    $GLOBALS['smarty']->assign('areaname', $areaname);
    $GLOBALS['smarty']->assign('info', get_user_default($user_id));
    $GLOBALS['smarty']->assign('rank_name', $urankname);
    $GLOBALS['smarty']->assign('llsys', $llsys);
}else{
     $GLOBALS['smarty']->assign('data',1);
     $GLOBALS['smarty']->assign('llsys', $llsys);
}

    $GLOBALS['smarty']->assign('action', 'default');
    $GLOBALS['smarty']->assign('user_info', get_user_info());
    $GLOBALS['smarty']->display('ll.dwt');
}


function ll_data($user_id,$qid)
{

    $llsys = gc_llsys_queue($user_id, $qid);

    $orderdata = array();
    $begin = 0;
    while ($begin < 10 && $llsys['order'][$begin] > 0) {
        $o['order'] = $llsys['order'][$begin];
        $o['point'] = $llsys['point'][$begin];
        $o['otype'] = $llsys['otype'][$begin];
        if($o['otype']==1){
            $o['color']="data_red";

        }else if($o['otype']==2){

            $o['color']="data_blue";

        }else{

            $o['color']="data_ccc";
        }

        $orderdata[] = $o;
        $begin += 1;
    }

    return $orderdata;

}

function show_llmsg($content, $links = '', $hrefs = '', $type = 'info', $auto_redirect = true)
{
    assign_template();

    $msg['content'] = $content;
    if (is_array($links) && is_array($hrefs))
    {
        if (!empty($links) && count($links) == count($hrefs))
        {
            foreach($links as $key =>$val)
            {
                $msg['url_info'][$val] = $hrefs[$key];
            }
            $msg['back_url'] = $hrefs['0'];
        }
    }
    else
    {
        $link   = empty($links) ? $GLOBALS['_LANG']['back_up_page'] : $links;
        $href    = empty($hrefs) ? 'javascript:history.back()'       : $hrefs;
        $msg['url_info'][$link] = $href;
        $msg['back_url'] = $href;
    }

    $msg['type']    = $type;
    // update by guo   $position = assign_ur_here(0, $GLOBALS['_LANG']['sys_msg']);
    $position = assign_ur_here(0, '系统提示');
    $GLOBALS['smarty']->assign('page_title', $position['title']);   // 页面标题
    $GLOBALS['smarty']->assign('ur_here',    $position['ur_here']); // 当前位置

    if (is_null($GLOBALS['smarty']->get_template_vars('helps')))
    {
        $GLOBALS['smarty']->assign('helps', get_shop_help()); // 网店帮助
    }
    $GLOBALS['smarty']->assign('action', 'llmsg');
    $GLOBALS['smarty']->assign('auto_redirect', $auto_redirect);
    $GLOBALS['smarty']->assign('message', $msg);
    $GLOBALS['smarty']->display('ll.dwt');

    exit;
}


?>

