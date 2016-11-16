<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/5
 * Time: 13:49
 */


session_start();

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');

require(ROOT_PATH.'includes/lib_clips.php');

/* 载入语言文件 */

require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
if ($_SESSION['user_id'] > 0)
{
    $smarty->assign('user_name', $_SESSION['user_name']);
}else{
    ecs_header("Location:user.php\n");

}

$user_id=$_SESSION['user_id'];

$res=gc_getuserinfo($user_id);
$user_info= get_user_default($user_id);

$disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'1' ;
$smarty->assign('disphard', $disphard);


if(!empty($res)){
    $user_name=$res['user_name'];
    $user_phone=$res['phone'];
    $user_mail=$res['email'];
    $user_phone=number_stars($user_phone,3,4);
   // $user_mail=number_stars($user_mail,4,4);
    if ($user_info['reg_phone'] == 0) {
        $telvali = "未验证";
    } else {
        $telvali = "已验证";
    }
    if ($user_info['is_validate'] == 0) {
        $mailvali = "未验证";
    } else {
        $mailvali = "已验证";
    }

    $smarty->assign('telvali',$telvali);
    $smarty->assign('mailvali',$mailvali);
    $smarty->assign('user_name',$user_name);
    $smarty->assign('user_phone',$user_phone);
    $smarty->assign('user_mail',$user_mail);
    $result=gc_get_realname_auth($user_id);

   if($result['resp_code']===0) {
       $status=$result["user"]["status"];
      // var_dump($status);
       if($status==1||$status==9){
         $user_pidno=$result["user"]["pidno"];
          $user_pidno=number_stars($user_pidno,7,5);
         $smarty->assign('user_pidno',$user_pidno);
         if($status==1){

            $user_pidinfo="审核中";
         }else if($status==9){
            $user_pidinfo="已认证";
         }

       }else if($status==2) {


           $user_pidinfo="认证未通过";
       }

   }else{

        $status="-1";
        $user_pidinfo="未提交";


   }


}
$smarty->assign('status',$status);
$smarty->assign("user_pidinfo",$user_pidinfo);
$smarty->display("setting.dwt");







?>