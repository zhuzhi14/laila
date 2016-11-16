<?php
session_start();
define('IN_ECS', true);
define('ECS_ADMIN', true);
require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
require_once(ROOT_PATH . 'includes/lib_llsys.php');
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');

$user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : '0';
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'mdrz_inq';

$pay_status=isset($_COOKIE['openid'])?1:0;

$disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'1' ;
$smarty->assign('disphard', $disphard);

/*
$md_jb=isset($_SESSION['md_jb'])?$_SESSION['md_jb']:"Z" ;
if ($md_jb === 'Z') {
    $mdzq = '会员' ;
} else {
    $mdzwarray=array('0'=>'无','1'=>"主任",'2'=>"主管",'3'=>"经理", '4'=>"总监", '5'=>"首席", '6'=>"总裁",'7'=>"董事");
    $mdzq='<font color="#088A08">服务商（'.$mdzwarray[$md_jb].'）</font>' ;
}
$smarty->assign('mdzq', $mdzq);        //用户等级
*/
/* 取出大家共用的数字 */
$myrank=isset($_SESSION['user_rank'])?$_SESSION['user_rank']:"" ;
$mybuss=isset($_SESSION['buss_rank'])?$_SESSION['buss_rank']:"" ;
$mybranch=isset($_SESSION['branch_rank'])?$_SESSION['branch_rank']:"" ;
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
else if ($mybranch=='5') $urankname = $urankname.'<font color="#FF6600">-机构</font>'  ;
else if ($mybranch=='2') $urankname = $urankname.'<font color="#FF6600">-门店</font>'  ;
$smarty->assign('urankname', @$urankname);        //用户等级

/* 用户中心 */
if ($user_id <= 0){
	$smarty->assign('footer', get_footer());
	$smarty->assign('gourl', "account.php");
	$smarty->display('login.dwt');
	exit;
}

$smarty->assign('action',$act) ;
    
if ($act == 'mdrz_inq'){
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    /* 获取用户报单中心的状态 */
    $user_id = $_SESSION['user_id'];
    // $user_id='2110';
    $row = gc_mdrz_inq($user_id) ;

// print_r($row) ;

    $num = 0;
    $cnt = $row['cnt'] ;
    $mdrz_list = array() ;
    while ($num < $cnt)
    {
        $pp = $row[$num] ;
        $num += 1 ;
        $pp['formated_add_time'] = local_date($GLOBALS['_CFG']['date_format'], $pp['addtime']);
        $statusname='OK' ;
        if ($pp['status'] == '2') 
            $statusname='OK' ;
        $pp['statusname'] = $statusname ;
        $mdrz_list[] = $pp;
    }


    $balance = isset($_SESSION['balance'])?$_SESSION['balance']:0;
    $award_bal = isset($_SESSION['award_bal'])?$_SESSION['award_bal']:0;
    $tb_bal=$_SESSION['tb_bal'];
    /* 获取用户可用资金余额 */
    $smarty->assign('user_id', $user_id);
    $smarty->assign('recode', @$row['recode']);
    $smarty->assign('rename', @$row['rename']);
    $smarty->assign('cnt', $row['cnt']);
    $smarty->assign('user_money', $balance+$award_bal+$tb_bal);
    $smarty->assign('balance', $balance);
    $smarty->assign('award_bal', $award_bal);
    $smarty->assign('level',$row['level']) ;
    $smarty->assign('unitprice',$row['unitprice']) ;
    $smarty->assign('totalcnt',$row['totalcnt']) ;
    $_SESSION['unitprice'] = $row['unitprice'] ;
    $_SESSION['level'] = $row['level'] ;
    $_SESSION['limited'] = $row['limited'] ;
    $smarty->assign('salecnt',$row['salecnt']) ;
    $smarty->assign('limited',$row['limited']) ;
    $smarty->assign('mdrz_list', $mdrz_list);
    $smarty->display('mdrz.dwt');    
} else if ($act == 'act_mdrz'){
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    
    $cc = array() ;
    $user_id = $_SESSION['user_id'];
    $level = isset($_SESSION['level']) ? $_SESSION['level']  : 0 ;
    $limited = isset($_SESSION['limited']) ? $_SESSION['limited']  : 0 ;
    $unitprice = isset($_SESSION['unitprice']) ? $_SESSION['unitprice']  : 0 ;
    if ($unitprice == 0) {
        show_message("单价出错，重新输入！", $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }

    $buy_num = isset($_POST['buy_num']) ? $_POST['buy_num']  : 0 ;
    $recode = isset($_POST['rephone']) ? $_POST['rephone']  : '' ;
/*
    if ($buy_num > $limited && $limited > 0) {
        show_message("购买份数太多，重新输入！", $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
*/    
    $amount = $buy_num * 10000 ;
    $number = $amount/$unitprice ;
    if ($amount < 10000 || $buy_num < 1) {
        show_message("购买份数太少，重新输入！", $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
    if (strlen($recode) != 11) {
        show_message("输入11位服务商号码，重新输入！", $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
//    print_r("buy_num=".$buy_num."  amount=".$amount."  unitprice=".$unitprice."  limitecnt=".$limitecnt) ;

    $cc = gc_mdrz_order($user_id,$level, $number, $amount,$recode) ;
    
    if ($cc == null) {
        show_message("购买失败，稍后再操作！", $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
//    print_r($cc) ;
    if ($cc['resp_code'] === 0)
    {
        show_message('服务商购买产品成功！', $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
    else
    {
        show_message($cc['resp_msg'], $_LANG['app_list_lnk'], 'mdrz.php?act=mdrz_inq','info');
    }
} else if ($act == 'mdarea_inq'){


    include_once(ROOT_PATH . 'includes/lib_clips.php');
    /* 获取用户报单中心的状态 */
    $user_id = $_SESSION['user_id'];
   // $user_id='2110';

    
    $row = gc_branch_inq($user_id) ;

 // var_dump($row);



    if($row['resp_code']==0) {
        //用户不存在
        if(isset($_SESSION['row_status'])){

          $status=@$_SESSION['row_status'];

        }else {
            $status = $row['status'];

        }
        
        $_SESSION['branch_inq'] = $row ;
        
        if (strlen($row['status'])>0) {
            $status = $row['status'];
            if ($row['status'] ==='0'||$row['status']==='1'||$row['status']==='9') {
                include_once('includes/lib_transaction.php');
                /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
                $smarty->assign('country_list', get_regions());
                $smarty->assign('shop_country', $_CFG['shop_country']);
                $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
                $consignee_list = get_consignee_list($_SESSION['user_id']);
                /* 取得每个收货地址的省市区列表 */
                $province_list = array();
                $city_list = array();
                $district_list = array();
                foreach ($consignee_list as $region_id => $consignee) {
                    $consignee['country'] = isset($consignee['country']) ? intval($consignee['country']) : 0;
                    $consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
                    $consignee['city'] = isset($consignee['city']) ? intval($consignee['city']) : 0;

                    $province_list = get_regions(1, $consignee['country']);
                    $city_list = get_regions(2, $consignee['province']);
                    $district_list = get_regions(3, $consignee['city']);
                }
                if($row['status']==='1' || $row['status']==='9') {
                    //$message = "您的申请已经提交审核中";
                    $cnt=$row['cnt'];
                    $area_list=array();

                    if($cnt>0){
                        $num=0;
                        while($num<$cnt){
                            $num_list['region_id']=$row[$num]['region_id'];
                            $num_list['region_name']=get_address($row[$num]['region_id']);
                            $num_list['amount']=$row[$num]['amount'];
                            $num_list['apply_time']=date("md",$row[$num]['addtime']);
                            $num_list['status']=$row[$num]['status'];

                            $area_list[]=$num_list;

                            $num++;
                        }






                    }




                   //var_dump($area_list);





                    //$region_id=$row['region_id'];
                    //$area_name=get_address($region_id);
                   $smarty->assign('area_list',$area_list);
                }else{
                    $message="请选择您需要代理的区域";

                }
                // var_dump($row);
                $reid = $row['reid'];
                //var_dump($reid);
                $res = gc_getuserinfo($reid);
                // var_dump($res);
                $_SESSION['branch_inq']['rephone'] = $res['phone'] ;

                $smarty->assign('rephone', $res['phone']);
                $smarty->assign('branchname', $row['branch_name']);
                $smarty->assign('province_list', $province_list);
                $smarty->assign('city_list', $city_list);
                $smarty->assign('district_list', $district_list);

            }
        }else{

            $status = -1;
            $message = "未知错误";
         }
        }else{

            $status=-1;
            $message="未知错误";
        }

    $smarty->assign('message', @$message);
    $smarty->assign('status', $status);
    $smarty->display('mdrz.dwt');
}else if($act=='mdarea_apply'){

    if($_POST){
       // var_dump($_POST);
        $region_id=trim($_POST['district']);
        $user_id=$_SESSION['user_id'];
        $branch_inq = array() ;
        if (isset($_SESSION['branch_inq']))
            $branch_inq = $_SESSION['branch_inq'] ;
        else {
            $branch_inq['status'] = '0' ;
        }
        if ($branch_inq['status'] == '9') {
            $rephone=$branch_inq['rephone'] ;
            $branch_name=$branch_inq['branch_name'] ;
        } else {
            $rephone=trim($_POST['rephone']);
            $branch_name=$_POST['branchname'];
        }
       // $branch_name=$_POST['branch_name'];

        $res=gc_branch_apply($user_id,$region_id,$rephone,$branch_name);
//        var_dump($res);
        if($res['resp_code']===0){
           $_SESSION['row_status']=2;
           $status='2';
           update_region($region_id,$status);
           show_message("申请成功","返回申请界面","mdrz.php?act=mdarea_inq");
        }else{
           $message=$res['resp_msg'];
           show_message($message,"返回申请界面","mdrz.php?act=mdarea_inq");
        }
    }



}else if($act=='mdarea_pay'){

     $user_id=$_SESSION['user_id'];
    if($_GET) {
        $amount = $_GET['amount'];
        $region_id = $_GET['region_id'];
        $do=isset($_GET['do'])?$_GET["do"]:"";
        $region_name=get_address($region_id);
        $smarty->assign("region_id",$region_id);
        $smarty->assign("amount",$amount);
        $smarty->assign("region_name",$region_name);

    }


    if(@$do=='pay') {


        $row = gc_branch_sale($user_id, $region_id, $amount);


        if ($row['resp_code'] == 0) {
            $_SESSION['row_status'] = 9;
            $status = 9;
            update_region($region_id, $status);
            show_message("你已经成功支付，成为代理商", "返回申请页面", "mdrz.php?act=mdarea_inq");


        } else {

            show_message($row['resp_msg'], "返回申请页面", "mdrz.php?act=mdarea_inq");

        }

    }


     $smarty->display('mdrz.dwt');


}else if($act=='mdrz_list'){
    if(!isset($_GET['user_id'])){

      show_message('参数有误');
    }

     $md_userid=$_GET['user_id'];
    $mert = gc_merchant_inq($md_userid);
    $shang_name=$mert['merchant_name'];

    $record = gc_merchant_translist($md_userid, 0, 0);
    if ($record['resp_code'] == '0') {

        $record_cnt = $record['cnt'];
        $page_start = 0;
        $page_num = 15;
        $pagebar = 0;
        if ($record_cnt > 0) {
            $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
            // var_dump($page);
            $pagebar = get_wap_pager($record_cnt, $page_num, $page, 'mdrz.php?act=mdrz_list&user_id='.$md_userid, 'page');
            //var_dump($pagebar);
            $page_start = $page_num * ($page - 1);
            $res = gc_merchant_translist($md_userid, $page_start, $page_num);

            if ($res['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $res['sno'];
                $num = 0;
                while ($num < $cnt) {
                    $row = $res[$num];
                    $num++;
                    $account_list[] = $row;
                }
            }

            $smarty->assign('account_log', $account_list);
            $smarty->assign('pagebar', $pagebar);
        }

    }


    //  @ $pager = pager('user.php', array('act' => $action), $record_count, $page);
    //模板赋值
    //    $smarty->assign('surplus_amount', price_format($surplus_amount, false));
   // var_dump($account_list);

    $smarty->assign('action', 'mert_account');
    $smarty->assign('shang_name',$shang_name);
    $smarty->display('merchant.dwt');





}else if($act=='mdrz_sel'){

    $type=$_POST['type'];
    $start='0';
    $size='0';
    if($type==2){
        $shang_name="服务商";
    }else if($type==1){
        $shang_name="代理商";

    }

    $row=gc_merchant_lists($user_id,$type,$start,$size);


    if($row['resp_code']==0){
        $record_cnt = $row['cnt'];
        $page_start = 0;
        $page_num = 15;
        $pagebar = 0;
        if ($record_cnt > 0) {
            $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
            // var_dump($page);
            $pagebar = get_wap_pager($record_cnt, $page_num, $page, 'mdrz.php?act=mdarea_inq', 'page');
            //var_dump($pagebar);
            $page_start = $page_num * ($page - 1);
            $res = gc_merchant_lists($user_id,$type,$page_start, $page_num);

            if ($res['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $res['sno'];
                $num = 0;
                while ($num < $cnt) {
                    $row = $res[$num];
                    $num++;
                    $account_list[] = $row;
                }
                $smarty->assign('account_list',$account_list);
            }

        }
        $smarty->assign('cnt', $record_cnt);
    }


    $smarty->assign('shang_name', $shang_name);
  $smarty->display('mdrz.dwt');

}else if($act=='card_pay'){

    $user_id = $_SESSION['user_id'];
    // $user_id='2110';
    $row = gc_mdrz_inq($user_id) ;
    $rephone=$row['recode'];
    $smarty->assign('rephone',$rephone);
    $smarty->display('mdrz.dwt');
}else if($act=='card_sj'){
    if(!empty($_POST)){
        $card_num=trim($_POST['card_num']);
        $card_pwd=strtolower(trim($_POST['card_pwd']));
        $rephone=trim($_POST['rephone']);
        $new_cardpwd=md5($card_pwd);
        $user_id=$_SESSION['user_id'];
       // var_dump($card_pwd);
        $row=gc_fwscard($user_id,$card_num,$new_cardpwd,$rephone);
        //var_dump($row);

        if($row['resp_code']==='0'){

            show_message($row['resp_msg'],'服务商升级','mdrz.php?act=mdrz_fws_inq');

        }else{

            show_message($row['resp_msg'],'服务商升级','mdrz.php?act=mdrz_fws_inq');
        }


    //卡号密码 验证



    }



}else if($act=='mdrz_fws_inq'){

    include_once(ROOT_PATH . 'includes/lib_clips.php');
    /* 获取用户报单中心的状态 */
    $user_id = $_SESSION['user_id'];
    // $user_id='2110';
    $row = gc_mdrz_inq($user_id) ;
   //$myrank=isset($_SESSION['user_rank'])?$_SESSION['user_rank']:"" ;

    //var_dump($myrank);

// print_r($row) ;

    $num = 0;
    $cnt = $row['cnt'] ;
    $mdrz_list = array() ;
    while ($num < $cnt)
    {
        $pp = $row[$num] ;
        $num += 1 ;
        $pp['formated_add_time'] = local_date($GLOBALS['_CFG']['date_format'], $pp['addtime']);
        $statusname='OK' ;
        if ($pp['status'] == '2')
            $statusname='OK' ;
        $pp['statusname'] = $statusname ;
        $mdrz_list[] = $pp;
    }
    if($cnt>0 || $myrank==4){

        $status=1;
    }else{

        $status=0;
    }

    $balance = isset($_SESSION['balance'])?$_SESSION['balance']:0;
    $award_bal = isset($_SESSION['award_bal'])?$_SESSION['award_bal']:0;
    $tb_bal=$_SESSION['tb_bal'];
    /* 获取用户可用资金余额 */
    $smarty->assign('user_id', $user_id);
    $smarty->assign('recode', @$row['recode']);
    $smarty->assign('rename', @$row['rename']);
    $smarty->assign('cnt', $row['cnt']);
    $smarty->assign('user_money', $balance+$award_bal+$tb_bal);
    $smarty->assign('balance', $balance);
    $smarty->assign('award_bal', $award_bal);
    $smarty->assign('level',$row['level']) ;
    $smarty->assign('unitprice',$row['unitprice']) ;
    $smarty->assign('totalcnt',$row['totalcnt']) ;
    $_SESSION['unitprice'] = $row['unitprice'] ;
    $_SESSION['level'] = $row['level'] ;
    $_SESSION['limited'] = $row['limited'] ;
    $smarty->assign('status',$status);
    $smarty->assign('salecnt',$row['salecnt']) ;
    $smarty->assign('limited',$row['limited']) ;
    $smarty->assign('mdrz_list', $mdrz_list);
    $smarty->display('mdrz.dwt');


}else if($act=='mdrz_shoplist'){

    $type=3;
    $start='0';
    $size='0';
    if($type==2){
        $shang_name="服务商";
    }else if($type==1){
        $shang_name="代理商";

    }else{
        $shang_name='旗下商户';
    }

    $row=gc_merchant_lists($user_id,$type,$start,$size);


       if($row['resp_code']==0){
        $record_cnt = $row['cnt'];
        $page_start = 0;
        $page_num = 15;
        $pagebar = 0;
        if ($record_cnt > 0) {
            $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
            // var_dump($page);
            $pagebar = get_wap_pager($record_cnt, $page_num, $page, 'mdrz.php?act=mdrz_shoplist', 'page');
            //var_dump($pagebar);
            $page_start = $page_num * ($page - 1);
            $res = gc_merchant_lists($user_id,$type,$page_start, $page_num);

            if ($res['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $res['sno'];
                $num = 0;
                while ($num < $cnt) {
                    $row = $res[$num];
                    $num++;
                    $account_list[] = $row;
                }
                $smarty->assign('account_list',$account_list);
            }
            $smarty->assign("pagebar",$pagebar);

        }
        $smarty->assign('cnt', $record_cnt);
    }


   $smarty->assign('shang_name',$shang_name);
    $smarty->assign('action','mdrz_sel');
    $smarty->display('mdrz.dwt');



}else if($act=='mdrz_fws_list'){

    $user_id=$_SESSION["user_id"];

    $start=0;
    $size=0;
    $row=gc_fws_lists($user_id,$start,$size);

    if($row['resp_code']==0){
        $record_cnt = $row['cnt'];
        $page_start = 0;
        $page_num = 15;
        $pagebar = 0;
        if ($record_cnt > 0) {
            $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
            // var_dump($page);
            $pagebar = get_wap_pager($record_cnt, $page_num, $page, 'mdrz.php?act=mdrz_fws_list', 'page');
            //var_dump($pagebar);
            $page_start = $page_num * ($page - 1);
            $res = gc_fws_lists($user_id,$page_start, $page_num);

            if ($res['resp_code'] == '0') {
                //var_dump($res);

                $cnt = $res['sno'];
                $num = 0;
                $start_num=$page_start+1;
                while ($num < $cnt) {
                    $row = $res[$num];
                    $row['num']=$start_num++;
                    $num++;
                    $account_list[] = $row;
                }

                $smarty->assign('account_list',$account_list);
            }

        }
        $smarty->assign('pagebar',$pagebar);
        $smarty->assign('cnt', $record_cnt);
    }


   //var_dump($account_list);
    $smarty->display('mdrz.dwt');











}


  function  get_address($region_id){
      if($region_id>=100) {
          for ($i = 0; $i < 3; $i++) {
              $sql = 'SELECT region_name,parent_id FROM ' . $GLOBALS['ecs']->table('region') .
                  " WHERE region_id = '$region_id'";

              $row = $GLOBALS['db']->GetAll($sql);
              $region_id = $row[0]['parent_id'];
              $region_name[$i] = $row['0']['region_name'];
          }

          $name = $region_name[2] . '-' . $region_name[1] . '-' . $region_name[0];

          return $name;

      }else{

          return "无区域";
      }
  }


function  update_region($region_id,$status){

    $sql = 'update' . $GLOBALS['ecs']->table('region') .
        " set status=".$status." where region_id=".$region_id;

    return $GLOBALS['db']->query($sql);


}







?>
