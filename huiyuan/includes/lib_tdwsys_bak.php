<?php

/**
 * TDWSYS ͨ�һ�Ա���ݺ���
 * ============================================================================
 * * ��Ȩ���� 2005-2012 ����ͨ�����޹�˾������������Ȩ����
 * ��վ��ַ: http://www.tongduika.com
 * ----------------------------------------------------------------------------
 * ����һ����ѿ�Դ�����������ζ���������ڲ�������ҵĿ�ĵ�ǰ���¶Գ������
 * �����޸ġ�ʹ�ú��ٷ�����
 * ============================================================================
 * $Author: liubo $
 * $Id: tdwsys.php 17217 2011-01-19 06:29:08Z liubo $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

		function gc_writelog($str)
		{
		//	$open=fopen("log.txt","a" );
			//fwrite($open,$str);
			//fclose($open);
		} 

		function gc_httpcall($urlvars)
		{
			
				$url="http://58.221.92.138:1092/".$urlvars;
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "$url");
				curl_setopt($ch, CURLOPT_TIMEOUT, 2);
				curl_setopt($ch, CURLOPT_HEADER, 1); //�����Ϊ0����ʹ��header
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				$result = curl_exec($ch);
				curl_close($ch);
				
				$reqstr = strstr($result,"{") ;
				
				return $reqstr ;
				
				
				
		}
		
		function gc_userlogin($account,$passwd)
		{
			
				$vars =sprintf("ucapi/userlogin?account=%s&logpass=%s&systemname=MAILA&user_ip=%s",$account,$passwd,real_ip());
				
				$reqstr = gc_httpcall($vars) ;
				
				//print_r($reqstr) ;
				
				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);
//				print_r($output_array) ;
				
				if ($output_array["resp_code"] == "0") {
					$okuser = $output_array["user"] ;
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $erruser ;
				
				
		}
		
		function gc_getuserinfo($user_id)
		{	
				
				$vars =sprintf("ucapi/getuserinfo?user_id=%s&systemname=MAILA",$user_id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);			
				
				if ($output_array["resp_code"] == "0") {
					$okuser = $output_array["user"] ;
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
					if ($okuser['user_id'] == $_SESSION['user_id']) 
					{
						$_SESSION['user_rank'] = $okuser['user_rank'] ;
						$_SESSION['gold_amt'] = $okuser['gold_amt'] ;
						$_SESSION['balance'] = $okuser['balance'] ;
						$_SESSION['frozen_amt'] = $okuser['frozen_amt'] ;
					}
					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $erruser ;
				
				
		}

		function gc_checkuser($account)
		{
				$vars =sprintf("ucapi/checkuser?account=%s&systemname=MAILA",$account);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);			
				
				if ($output_array["resp_code"] == "0") {
					$okuser = $output_array["user"] ;
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $errusers ;
		}

		//��ȡ�û��˻���Ϣ
		function gc_getaccountinfo($id)
		{
				$vars =sprintf("ucapi/getaccountinfo?user_id=%s&systemname=MAILA",$id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);			
				
				if ($output_array["resp_code"] == "0") {
					$okuser = $output_array["account"] ;
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $errusers ;
		}


		//�޸��û�����
		function gc_changepwd($phone,$oldpwd,$newpwd)
		{
			
				$vars = sprintf("ucapi/changepwd?user_id=%s&oldpwd=%s&newpwd=%s&systemname=MAILA",$id,$oldpwd,$newpwd);
				$reqstr = gc_httpcall($vars);
				$output_array = json_decode($reqstr,true);
				
				return $output_array ;
				
			}

		//��ȡ�������������
		function gc_mlgetlist($id, $size, $start)
		{
				$vars =sprintf("mlapi/mlgetlist?user_id=%s&start=%d&size=%d&systemname=MAILA",$id,$start,$size);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				return $output_array ;
		}
		
		//��ȡ���������������
		function gc_mlgetcount($id)
		{
				$vars =sprintf("mlapi/mlgetcount?user_id=%s&systemname=MAILA",$id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] == "0") {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//��ȡ��������������
		function gc_mlgetbuylist($id, $size, $start)
		{
				$vars =sprintf("mlapi/mlgetbuylist?user_id=%s&start=%d&size=%d&systemname=MAILA",$id,$start,$size);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				return $output_array ;
		}
		
		//��ȡ����������������
		function gc_mlgetbuycount($id)
		{
				$vars =sprintf("mlapi/mlgetbuycount?user_id=%s&systemname=MAILA",$id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] == "0") {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//��ȡ��������������
		function gc_mlfenhonglist($id, $size, $start)
		{
				$vars =sprintf("mlapi/mlfenhonglist?user_id=%s&start=%d&size=%d&systemname=MAILA",$id,$start,$size);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				return $output_array ;
		}
		
		//��ȡ����������������
		function gc_mlfenhongcount($id)
		{
				$vars =sprintf("mlapi/mlfenhongcount?user_id=%s&systemname=MAILA",$id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);

				$count = 0 ;
				if ($output_array["resp_code"] == "0") {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//��ȡ�����̻����ı�����
		function gc_getafftree($id)
		{
				$vars =sprintf("mlapi/getafftree?user_id=%s&systemname=MAILA",$id);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				return $output_array ;
		}
		
		//����������
		function gc_mlbuyorder($buycode, $buynum, $user_id, $mltype="ml7500")
		{
				$vars =sprintf("mlapi/mlbuyorder?buycode=%s&buynum=%s&user_id=%d&mltype=%s&systemname=MAILA",$buycode, $buynum, $user_id, $mltype);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				return $output_array ;			
		}
		
		//��ȡ��������
		function gc_getmltypelistpro($mltype = null) 
		{
				if ($mltype == null) 
					$vars =sprintf("mlapi/getmltypelist?systemname=MAILA");
				else
					$vars =sprintf("mlapi/getmltypelist?mltype=%s&systemname=MAILA",$mltype);
				
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$cnt = $output_array['cnt'] ;
    		$num = 0;
    		    
				$mltypelist = array() ;
		    if ($output_array['resp_code'] == "0") {
				    while ($num < $cnt)
				    {
							$row = $output_array[$num] 		;
				    	$num += 1 ; 
				    	$mltypelist[] = $row 	;
				  	}
		  	}

				return $mltypelist ;			
		}
		
		
		//��ȡ�˵������� acctype = CHK,BAL,GOLD ���ֱ�ʾ��ֵȡ���˵������ӱ��˵�������˵�
		function gc_getaccountcnt($user_id,$acctype)
		{
				$vars =sprintf("acapi/getaccountcnt?user_id=%d&acctype=%s&systemname=MAILA",$user_id,$acctype);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] == "0") {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}
		
		//��ȡ�˵��� acctype = CHK,BAL,GOLD ���ֱ�ʾ��ֵȡ���˵������ӱ��˵�������˵�
		function gc_getaccountlist($user_id,$acctype,$start,$size)
		{
				$vars =sprintf("acapi/getaccountlist?user_id=%d&acctype=%s&start=%s&size=%s&systemname=MAILA",$user_id,$acctype,$start,$size);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				return $output_array ;
		}
		
		function gc_addaccountcheck($surplus,$amount)
		{
				$vars =sprintf("acapi/addaccountcheck?user_id=%d&amount=%s&user_note=%s&process_type=%s&payment=%s&bankname=%s&bankaddress=%s&myname=%s&myaccount=%s&systemname=MAILA",
						$surplus['user_id'],$amount,$surplus['user_note'], $surplus['process_type'], $surplus['payment'], $surplus['bankname'],$surplus['bankaddress'],$surplus['myname'],$surplus['myaccount']);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				return $output_array ;
		}
 
 
		function gc_delaccountcheck($id,$user_id)
		{
				$vars =sprintf("acapi/delaccountcheck?sid=%s&user_id=%s&systemname=MAILA",$id,$user_id) ;
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				return $output_array ;
		}

		function gc_account_change($user_id, $user_money, $frozen_money, $pay_points, $change_desc, $change_type)
		{									
//			print_r("tdwsys") ;
				$vars =sprintf("acapi/ac_account_change?user_id=%s&balance=%s&frozen_money=%s&gold_amt=%s&change_desc=%s&change_type=%s&merchant_id=%s&systemname=MAILA",
						$user_id, $user_money, $frozen_money, $pay_points, $change_desc, $change_type, real_ip()) ;
//			print_r($vars) ;
			$reqstr = gc_httpcall($vars) ;

				if (strlen($reqstr) == 0) 
					return false ;
					
				$output_array = json_decode($reqstr,true);
				if ($output_array=="") 
					return false ;
					
				if ($output_array['resp_code'] == '0')
					return TRUE ;
				return false  ;
		}

		function gc_ml_baodan($user_id)
		{
				$vars =sprintf("mlapi/buybaodai?user_id=%s&systemname=MAILA",$user_id) ;
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				return $output_array ;			
		}


//��ȡ΢��open_id
function gc_get_openid(){
	
	$appid =  "wx30b7704828bcc552";
	$secret = "033a1c911b58b08d388538be871cafb9";
	$code = $_GET["code"];
	$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt ($ch, CURLOPT_URL, $get_token_url);
	curl_setopt ($ch,CURLOPT_HEADER,0);  
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
	$file_contents = curl_exec($ch);  
	curl_close($ch);
	$json_obj = json_decode($file_contents,true); 
	
	//����openid��access_token��ѯ�û���Ϣ  
	$access_token = $json_obj['access_token'];  
	$openid = $json_obj['openid'];  
	$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';  
  


	$ch = curl_init();  
	curl_setopt($ch,CURLOPT_URL,$get_user_info_url);  
	curl_setopt($ch,CURLOPT_HEADER,0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);  
	$res = curl_exec($ch); 
	curl_close($ch);  
  
	//����json  
	$user_obj = json_decode($res,true);  
	//$_SESSION['user'] = $user_obj;  
	$nick_name = $user_obj['nickname'];
	$openid = $user_obj['openid'];
	//session_start();
	$_SESSION['openid'] = $openid;
	$_SESSION['nick_name'] = $nick_name;
	
}

//����openid��ȡ�û���Ϣ
function gc_weixin_getuserinfo($openid)
{
	
		$vars =sprintf("ucapi/checkuser?wechat_openid=%s&systemname=MAILA",$openid);
		$reqstr = gc_httpcall($vars) ;
		
		$output_array = json_decode($reqstr,true);
		
		
			
		if ($output_array["resp_code"] == "0") {
					$okuser = $output_array["user"];
					if ($okuser['wechat_openid'] == $_SESSION['openid']) 
					{
						$_SESSION['user_name'] = $okuser['user_name'] ;
						$_SESSION['user_id'] = $okuser['user_id'] ;
						
					}
					return $okuser ;
				}
				
		
			$erruser = array() ;
			$erruser["user_id"] = 0 ;
			return $erruser ;
		
   
}

//΢�Զ�½
	function gc_wxResAndLogin($openid)
		{
		$row = gc_weixin_getuserinfo($openid);
		
			if($row['user_id'] > 0){
		
                                
		 		$GLOBALS['user']->set_session($_SESSION['user_name']);
        $GLOBALS['user']->set_cookie($_SESSION['user_name']);
		 		update_user_info();      // �����û���Ϣ
       // recalculate_price();     // ���¼��㹺�ﳵ�е���Ʒ�۸�
        
        return true;   
        
	}
		
			return false;
		
	
	}
	
//��΢���˺�
function gc_bindweixin($openid,$nickname,$userid)
{
	
		$vars =sprintf("ucapi/bindwechat?wechat_openid=%s&wechat_nickname=%s&systemname=MAILA&user_id=%s",$openid,$nickname,$userid);
		$reqstr =  gc_httpcall($vars) ;
		
		return $reqstr;
	}
	