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

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

		function gc_writelog($str,$filename='',$line='')
		{
		    $f1 = strrchr($filename,"/") ;
		    if ($f1 != null) $f2=str_replace("/","",$f1) ;
		    else $f2=$filename ;
		    //$sstr = "\r\n".$f2.'['.$line.']'.$str ;
		    //$open=fopen("log.txt","a" );
			//fwrite($open,$sstr);
			//fclose($open);
		} 

		function trimall($str)//删除空格
		{
		    $qian=array(" ","　","\t","\n","\r");$hou=array(".",".",".","","");
		    return str_replace($qian,$hou,$str);    
		}

		function gc_httpcall($urlvars)
		{
		    $url=tdwsys_url().trimall($urlvars);
		    
		    $ch = curl_init();

		    curl_setopt($ch, CURLOPT_URL, "$url");
		    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		    curl_setopt($ch, CURLOPT_HEADER, 1); //如果设为0，则不使用header
		    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		    $result = curl_exec($ch);
		    curl_close($ch);
		    
		    $reqstr = strstr($result,"{") ;
		    
		    return $reqstr ;
		}
		
		function gc_userlogin($account,$passwd)
		{
			
				$vars =sprintf("ucapi/userlogin?account=%s&logpass=%s&systemname=SYSTEM&user_ip=%s",$account,$passwd,real_ip());
				
				$reqstr = gc_httpcall($vars) ;
				
				//print_r($reqstr) ;
				
				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);
//				print_r($output_array) ;
				
				if ($output_array["resp_code"] === 0) {
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
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    //if ($systmid == "") $systmid="MAILA" ;
		    
				$vars =sprintf("ucapi/getuserinfo?user_id=%s&systemname=%s",$user_id,$systmid);
             // var_dump($vars);
				$reqstr = gc_httpcall($vars) ;
           //   var_dump($reqstr);

				$output_array = json_decode($reqstr,true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);

				
				if ($output_array["resp_code"] === 0) {
					@$okuser = $output_array["user"] ;
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
					if ($okuser['user_id'] == $_SESSION['user_id'])
					{
						$_SESSION['user_rank'] = $okuser['user_rank'] ;
						$_SESSION['buss_rank'] = $okuser['buss_rank'] ;
						$_SESSION['branch_rank'] = $okuser['branch_rank'] ;
						$_SESSION['md_jb'] = @$okuser['md_jb'] ;
						$_SESSION['gold_amt'] = $okuser['gold_amt'] ;
						$_SESSION['balance'] = $okuser['balance'] ;
						$_SESSION['award_bal'] = $okuser['award_bal'] ;
						$_SESSION['tb_bal'] = $okuser['tb_bal'] ;
						$_SESSION['lb_bal'] = $okuser['lb_bal'] ;
						$_SESSION['gold_amt'] = $okuser['gold_amt'] ;
						$_SESSION['frozen_amt'] = $okuser['frozen_amt'] ;
                        $_SESSION['pwdok']=$okuser['pwdok'];

				}

					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $erruser ;
				

		}

		function gc_checkuser($account)
        {
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
            $vars = sprintf("ucapi/checkuser?account=%s&systemname=%s", $account,$systmid);
           // var_dump($vars);
            $reqstr = gc_httpcall($vars);
          // var_dump($reqstr);
            $output_array = json_decode($reqstr, true);
//				$output_array["resp_msg"] = iconv('utf-8', 'gbk', $output_array["resp_msg"]);			
           // var_dump($output_array);
            if ($output_array == null) {
                return null ;
            }
            if ($output_array["resp_code"] === 0) {
                $okuser = $output_array["user"];
//					$okuser["user_name"] = iconv('utf-8', 'gbk', $okuser["user_name"]);			
                return $okuser;
            }else {
                $erruser = array();
                $erruser["user_id"] = 0;
                return $erruser;
            }
        }
        
		//获取用户账户信息
        function gc_getaccountinfo($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("ucapi/getaccountinfo?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				
				if ($output_array["resp_code"] === 0) {
					$okuser = $output_array["account"] ;
					$_SESSION['award_bal'] = $okuser['award_bal'] ;
					$_SESSION['tb_bal'] = $okuser['tb_bal'] ;
					$_SESSION['lb_bal'] = $okuser['lb_bal'] ;
					$_SESSION['gold_amt'] = $okuser['gold_amt'] ;
					$_SESSION['balance'] = $okuser['balance'] ;
					$_SESSION['frozen_amt'] = $okuser['frozen_amt'] ;
					return $okuser ;
				}
				$erruser = array() ;
				$erruser["user_id"] = 0 ;
				return $erruser ;
		}


		//修改用户密码
		function gc_changepwd($phone,$oldpwd,$newpwd)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
				$vars = sprintf("ucapi/changepwd?phone=%s&oldpwd=%s&newpwd=%s&systemname=%s",$phone,$oldpwd,$newpwd,$systmid);
				$reqstr = gc_httpcall($vars);
				$output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				if($output_array['resp_code']===0) {
                    return $output_array;
                }else{
                    return  false;

                }
		}

		//读取买的麦啦订单表
		function gc_mlgetlist($id, $size, $start)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlgetlist?user_id=%s&start=%d&size=%d&systemname=%s",$id,$start,$size,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//读取买的麦啦订单数量
		function gc_mlgetcount($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlgetcount?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//读取所有麦啦订单表
		function gc_mlgetbuylist($id, $size, $start)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlgetbuylist?user_id=%s&start=%d&size=%d&systemname=%s",$id,$start,$size,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//读取所有麦啦排位表
		function gc_mlgetmlorder($id, $size, $start)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlgetmlorder?user_id=%s&start=%d&size=%d&systemname=%s",$id,$start,$size,$systmid);
			$reqstr = gc_httpcall($vars) ;

			$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }

			return $output_array ;
		}
		
		//读取所有麦啦订单数量
		function gc_mlgetbuycount($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlgetbuycount?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//读取所有麦啦订单匹配表
		function gc_matchinglist($id, $size, $start)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/matchinglist?user_id=%s&start=%d&size=%d&systemname=%s",$id,$start,$size,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//读取所有麦啦订单匹配数量
		function gc_matchingcount($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/matchingcount?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}
		
		//读取所有投资合伙人表
		function gc_baoapplist($id, $size, $start, $sharesid='01')
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/baoapplist?user_id=%s&start=%d&size=%d$sharesid=%s&systemname=%s",
		        $id,$start,$size,$sharesid,$systmid);
			$reqstr = gc_httpcall($vars) ;

			$output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//读取所有投资合伙人数量
		function gc_baoappcount($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/baoappcount?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//读取所有麦啦订单表
		function gc_mlfenhonglist($id, $size, $start)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlfenhonglist?user_id=%s&start=%d&size=%d&systemname=%s",$id,$start,$size,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//读取所有麦啦订单数量
		function gc_mlfenhongcount($id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlfenhongcount?user_id=%s&systemname=%s",$id,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);

				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}

		//读取用户股票数据数量
		function gc_usershares($id,$sharesid='01')
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		
		    $vars =sprintf("mlapi/getusershares?user_id=%s&sharesid=%s&systemname=%s",$id,$sharesid,$systmid);
		    $reqstr = gc_httpcall($vars) ;
		
		    $output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
		
            return $output_array ;
		}

		//用户挂单销售股票
		function gc_sharessale($user_id,$stocknum,$stockprice,$sharesid='01')
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		
		    $vars =sprintf("mlapi/shares_sale?user_id=%s&sharesnum=%s&saleprice=%s&sharesid=%s&systemname=%s",
		        $user_id,$stocknum,$stockprice,$sharesid,$systmid);
		    $reqstr = gc_httpcall($vars) ;
		
		    $output_array = json_decode($reqstr,true);
		    if ($output_array == null) {
		        $output_array['resp_code'] = -1 ;
		        $output_array['resp_msg'] = '通讯失败,稍后再做！' ;
		        return $output_array ;
		    }
		
		    return $output_array ;
		}
		
		//用户撤销挂单销售股票
		function gc_sharescancel($user_id,$sid)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		
		    $vars =sprintf("mlapi/shares_cancel?user_id=%s&sid=%s&systemname=%s",$user_id,$sid,$systmid);
		    $reqstr = gc_httpcall($vars) ;
		
		    $output_array = json_decode($reqstr,true);
		    if ($output_array == null) {
		        $output_array['resp_code'] = -1 ;
		        $output_array['resp_msg'] = '通讯失败,稍后再做！' ;
		        return $output_array ;
		    }
		
		    return $output_array ;
		}
		
		//读取用户股票数据数量
		function gc_sharesdata($sharesid='01')
		{
		    print_r("gc_sharesdata") ;
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		
		    $vars =sprintf("mlapi/getsharesdata?sharesid=%s&systemname=%s",$sharesid,$systmid);
		    $reqstr = gc_httpcall($vars) ;
		
		    $output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
		
		    return $output_array ;
		}
		
		//读取所有商户中心报单树
		function gc_getafftree($id, $begin, $count)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/getafftree?user_id=%s&begin=%s&count=%s&systemname=%s",$id, $begin, $count,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				
				return $output_array ;
		}
		
		//购买麦啦单
		function gc_mlbuyorder($buycode, $buynum, $user_id, $mltype="ml7500", $shopuser='')
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("mlapi/mlbuyorder?buycode=%s&buynum=%s&user_id=%d&mltype=%s&systemname=%s&shopuser=%s",$buycode, $buynum, $user_id, $mltype,$systmid,$shopuser);

            //var_dump($vars);
			$reqstr = gc_httpcall($vars) ;

			$output_array = json_decode($reqstr,true);

           // var_dump($output_array);

            if ($output_array == null) {
                $output_array['resp_code'] = -1 ;
                $output_array['resp_msg']="未知错误";
                return $output_array ;
            }
				
			return $output_array ;			
		}
		
		//读取麦啦报单
		function gc_getmltypelistpro($id=null,$mltype = null) 
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    if ($id==null) {
		        $id = isset($_SESSION['user_id'])?$_SESSION['user_id']:0 ;
		    }
		    
		       if ($mltype == null) 
					$vars =sprintf("mlapi/getmltypelist?user_id=%s&systemname=%s",$id,$systmid);
				else
					$vars =sprintf("mlapi/getmltypelist?user_id=%s&mltype=%s&systemname=%s",$id,$mltype,$systmid);
				
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
           // var_dump($output_array);
				@$cnt = $output_array['cnt'] ;
    		    $num = 0;
    		    
				$mltypelist = array() ;
		    if ($output_array['resp_code'] === 0) {
				    while ($num < $cnt)
				    {
							$row = $output_array[$num] 		;
				    	$num += 1 ; 
				    	$mltypelist[] = $row 	;
				  	}
		  	}

				return $mltypelist ;			
		}

      function gc_mlmobilebuy($userid,$groupid){


          $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;


          if ($userid==null) {
              $userid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0 ;
          }


          $vars =sprintf("mlapi/getmltypelist?user_id=%s&systemname=%s&mlgroup=%s",$userid,$systmid,$groupid);
          $reqstr = gc_httpcall($vars) ;

          $output_array = json_decode($reqstr,true);
          $cnt = $output_array['cnt'] ;
          $num = 0;

          $mltypelist = array() ;
          if ($output_array['resp_code'] === 0) {
              while ($num < $cnt)
              {
                  $row = $output_array[$num] 		;
                  $num += 1 ;
                  $mltypelist[] = $row 	;
              }
          }

          return $mltypelist ;

      }
		
		
		//读取账单表数量 acctype =ALL,CHK,BAL,GOLD 三种表示充值取款账单，电子币账单，金币账单
		function gc_getaccountcnt($user_id,$acctype)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("acapi/getaccountcnt?user_id=%d&acctype=%s&systemname=%s",$user_id,$acctype,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				$count = 0 ;
				if ($output_array["resp_code"] === 0) {
					$count = $output_array['count'] ;
				}
				
				return $count ;
		}
		
		//读取账单表 acctype = ALL,CHK,BAL,GOLD 三种表示充值取款账单，电子币账单，金币账单
		function gc_getaccountlist($user_id,$acctype,$start,$size)
		{
    		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    		    if ($systmid == "") $systmid="MAILA" ;
		    
		    $vars =sprintf("acapi/getaccountlist?user_id=%d&acctype=%s&start=%s&size=%s&systemname=%s",$user_id,$acctype,$start,$size,$systmid);
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);

            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				return $output_array ;
		}
		
		function gc_addaccountcheck($surplus,$amount)
		{
    		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    		    if ($systmid == "") $systmid="MAILA" ;
		        
		        $vars =sprintf("acapi/addaccountcheck?user_id=%d&amount=%s&user_note=%s&process_type=%s&payment=%s&bankname=%s&bankaddress=%s&myname=%s&myaccount=%s&systemname=%s",
						$surplus['user_id'],$amount,$surplus['user_note'], $surplus['process_type'], $surplus['payment'], $surplus['bankname'],$surplus['bankaddress'],$surplus['myname'],$surplus['myaccount'],$systmid);
				$reqstr = gc_httpcall($vars) ;

				if ($reqstr == null || strlen($reqstr) == 0) 
				{ 
					return null ;
				}
				$output_array = json_decode($reqstr,true);
				return $output_array ;
		}
		
		function gc_scancode_addamount($user_id,$amount,$process_type)
		{
		    $vars =sprintf("acapi/scancode_addamount?user_id=%d&amount=%s&process_type=%s&systemname=MAILA",
		        $user_id,$amount, $process_type);
		    $reqstr = gc_httpcall($vars) ;
		
		    if ($reqstr == null || strlen($reqstr) == 0)
		    {
		        return null ;
		    }
		    $output_array = json_decode($reqstr,true);
		    return $output_array ;
		}
		
		function gc_award_to_balance($user_id, $amount)
		{
		    if ($amount == 0)
		        return null ;
		    if ($user_id == 0)
		        return null ;

		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
			$vars =sprintf("acapi/award_to_balance?user_id=%d&amount=%s&merchant_id=%s&systemname=%s",
						$user_id,$amount,real_ip(),$systmid);
			$reqstr = gc_httpcall($vars) ;
            if($reqstr==null){

                return false;
            }

			$output_array = json_decode($reqstr,true);
			if ($output_array == null) {
                return false;
            }

            if($output_array['resp_code']!==0){

                return false;
            }

            if($output_array['resp_code']===0){

                return  $output_array;
            }
		} 

		function gc_tb_to_balance($user_id, $amount)
		{
		    if ($amount == 0)
		        return null ;
		    if ($user_id == 0)
		        return null ;
		
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		
		    $vars =sprintf("acapi/tb_to_balance?user_id=%d&amount=%s&merchant_id=%s&systemname=%s",
		        $user_id,$amount,real_ip(),$systmid);
		    $reqstr = gc_httpcall($vars) ;
		    if($reqstr==null){
		        return false;
		    }
		
		    $output_array = json_decode($reqstr,true);
		    if ($output_array == null) {
		        return false;
		    }
		
		    if($output_array['resp_code']!==0){
		
		        return false;
		    }
		
		    if($output_array['resp_code']===0){
		
		        return  $output_array;
		    }
		}
		
		//转账交易
		function gc_account_transfer($tftype, $user_id,$tocode, $amount)
		{
		    if ($amount == 0)
		        return NULL ;

		    if ($user_id == 0)
		        return NULL ;
		
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
 //  print_r($user_id."|".$tocode."|".$amount) ;
		    
		    $vars =sprintf("acapi/account_transfer?user_id=%d&tftype=%s&tocode=%s&amount=%s&merchant_id=%s&systemname=%s",
		        $user_id,$tftype,$tocode,$amount,real_ip(),$systmid);
		    $reqstr = gc_httpcall($vars) ;
		
		    $output_array = json_decode($reqstr,true);
		    if ($output_array == null) {
                return NULL;
            }
		    return $output_array ;
		}
		
		function gc_goldcard_recharge($user_id,$cardno, $newpass)
		{
		    $vars =sprintf("acapi/goldcard_recharge?user_id=%d&cardno=%s&password=%s&systemname=MAILA",
		        $user_id,$cardno,$newpass);
		    $reqstr = gc_httpcall($vars) ;
		    
		    $output_array = json_decode($reqstr,true);
		    if ($output_array == null) {
		        return NULL;
		    }
		    return $output_array ;
		}
		
		
		function gc_delaccountcheck($id,$user_id)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
				$vars =sprintf("acapi/delaccountcheck?sid=%s&user_id=%s&systemname=%s",$id,$user_id,$systmid) ;
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
            if ($output_array == null) {
                $output_array=array();
                $output_array['resp_code'] = -1 ;
                return $output_array ;
            }
				return $output_array ;
		}

		function gc_account_change($user_id, $user_money, $frozen_money, $pay_points, $change_desc, $change_type,$bordernum='')
		{									
//			print_r("tdwsys") ;
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
			$vars =sprintf("acapi/maila_account_change?user_id=%s&balance=%s&gold_amt=%s&change_desc=%s&change_type=%s&merchant_id=%s&bordernum=%s&systemname=%s",
						$user_id, $user_money, $pay_points, $change_desc, $change_type, real_ip(),$bordernum,$systmid) ;

			//print_r($vars) ;
			$reqstr = gc_httpcall($vars) ;

           //var_dump($reqstr);
            if($reqstr==null){
                return false;

            }

           //print_r($reqstr);
				if (strlen($reqstr) == 0) {
                    return false;
                }
				$output_array = json_decode($reqstr,true);
                if($output_array==null){
                  return  false;
                }
				if ($output_array=="") {
                    return false;
                }
				if ($output_array['resp_code'] === 0) {
                    return true;
                }
				return false  ;
		}

		function gc_ml_baodan($user_id,$buy_num)
		{
		    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
		    if ($systmid == "") $systmid="MAILA" ;
		    
				$vars =sprintf("mlapi/buybaodai?user_id=%s&buy_num=%s&systemname=%s",$user_id,$buy_num,$systmid) ;
				$reqstr = gc_httpcall($vars) ;

				$output_array = json_decode($reqstr,true);
				if ($output_array['resp_code'] === 0) {
				    $_SESSION['user_rank'] = 4 ;
				}
				return $output_array ;			
		}

    //get_请求
        function http_get($url) {

        $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSLVERSION, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            //curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        $file_contents = curl_exec($curl);
        curl_close($curl);
            return $file_contents;
}
//获取微信open_id
function gc_get_openid() 
{
    if (!isset($_GET["code"])) return false ;
    $disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;
    $wx=get_wxinfo();
    if ($disphard === '2') {
        $appid=$wx['llappid'];
        $secret=$wx['llsecret'];
    } else {
        $appid=$wx['appid'];
        $secret=$wx['secret'];
    }
    $code = $_GET["code"];
    gc_writelog("appid=".$appid."$secret=".$secret."code=".$code, __FILE__, __LINE__);

    $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
    gc_writelog($get_token_url, __FILE__, __LINE__);
    $file_contents = http_get($get_token_url);

    if ($file_contents != null) {
        $json_obj = json_decode($file_contents,true);
        if (!isset($json_obj['openid'])) return false ;
        
        @$openid =$json_obj['openid'];
        @setcookie("openid", $openid);
        $_COOKIE["openid"] = $openid;
        $_SESSION['nick_name'] = "maila";
        $_SESSION['user_img']=isset($json_obj['headimgurl'])?$json_obj['headimgurl']:'default';
    } else return false ;
    return $openid;
}
//获取微信用户全部信息

function gc_wechat_list($open_id,$disphard='1')
{
    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    $vars =sprintf("ucapi/wechat_list?wechat_openid=%s&disphard=%s&systemname=%s",
           $open_id,$disphard,$systmid);
    $reqstr =  gc_httpcall($vars) ;

    $output_array = json_decode($reqstr, true);
    $num = 0;
    $userlist = array();
    if ($output_array['resp_code'] === 0) {
        $cnt = $output_array['cnt'];
        $list = array();
        while ($num < $cnt)
        {
            $row = $output_array[$num] 		;
            $num += 1 ;
            $list[] = $row 	;
        }
        $userlist["cnt"] = $cnt;
        $userlist["list"] = $list;
    }else {
        $userlist["cnt"] = 0 ;
    }
    return $userlist ;
}


//根据openid获取用户信息
function  gc_weixin_getuserinfo($open_id)
{
	$disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;  
    $userlist = gc_wechat_list($open_id,$disphard);
    $cnt = $userlist["cnt"];
    $user_id = "";
    if ($cnt > 0) {
        $list = $userlist["list"];
        for ($i = 0; $i < $cnt; $i++) {
            $row = $list[$i];
            if ($row["wechat_flag"] == 1) {
                $user_id = $row["user_id"];
                $phone = $row["phone"];
            }
        }
        if ($user_id != ""){
            $_SESSION["user_id"] = $user_id;
            $userlist["user_id"] = $user_id;
        }else {
            $_SESSION["user_id"] = $list[0]["user_id"];
           $userlist["user_id"] =   $list[0]["user_id"];
        }
        update_user_info();
    }else {
        $userlist["user_id"] = 0 ;
    }
    return $userlist ;
}

//微自动陆
	function gc_wxResAndLogin()
	{
	   $disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;  
	   if (!gc_get_openid()) return false ;
	   
	   if (!isset($_COOKIE['openid'])) return false ;

	   @$openid = $_COOKIE['openid'];
	   
	   $row = gc_weixin_getuserinfo($openid);
		
	   if($row['user_id'] > 0){
		 	//update_user_info();      // 更新用户信息
            return true;
	   }
	   return false;
	}
	
//绑定微信账号
function gc_bindweixin($open_id,$nickname,$userid)
{
	$disphard=isset($_SESSION['disphard'])?$_SESSION['disphard']:'0' ;  
    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    
        $vars =sprintf("ucapi/bindwechat?wechat_openid=%s&disphard=%s&wechat_nickname=%s&systemname=%s&user_id=%s",
                $open_id,$disphard,$nickname,$systmid,$userid);
		$reqstr =  gc_httpcall($vars) ;
        gc_writelog($vars, __FILE__, __LINE__);
		return $reqstr;
}


//2015年10月28日 11:24:57  充值验证接口
function gc_zfb_sh($user_id,$sid){
    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    
    $vars=sprintf("acapi/confirmaccountcheck?user_id=%s&sid=%s&adminnote=PASS&admin_user=admin&systemname=%s",$user_id,$sid,$systmid);

    // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    $output_array = json_decode($reqstr,true);

    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }
  //  var_dump($output_array);
    return $output_array ;

}

//2015年10月29日 15:32:54 获取短信验证码

function  gc_getusersmssend($tel,$type){

    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    $vars=sprintf("ucapi/userSmssend?tel=%s&type=%s&systemname=%s",$tel,$type,$systmid) ;

  //  var_dump($vars);
    $reqstr = gc_httpcall($vars);
    $output_array = json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -2 ;
        $output_array['resp_msg']="短信发送失败";
        return $output_array ;
    }
    return $output_array ;


}

//校验验证码
function  gc_checkusersmssend($tel,$smscode,$type){
    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    $vars=sprintf("ucapi/userSmsverify?tel=%s&type=%s&systemname=%s&smscode=%s",$tel,$type,$systmid,$smscode);
   // var_dump($vars);
    $reqstr = gc_httpcall($vars);
    $output_array = json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }
    return $output_array ;

}

//修改帐号密码
function gc_changeuserpasswd($tel,$smscode,$newpass){
    $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
    if ($systmid == "") $systmid="MAILA" ;
    
    $vars=sprintf("ucapi/changepwd?phone=%s&systemname=%s&smscode=%s&newpwd=%s",$tel,$systmid,$smscode,$newpass);
    //var_dump($vars);

     $reqstr=gc_httpcall($vars);
    $output_array = json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }
    return $output_array ;


}

//修改用户信息

function gc_updateuserinfo($user_id,$user_name,$pidno,$sex,$phone,$birthday,$qq,$alias){
    $vars=sprintf("ucapi/updateuserinfo?user_id=%s&systemname=%s&user_name=%s&pidno=%s&sex=%s&phone=%s&birthday=%s&qq=%s&alias=%s",$user_id,$_SESSION['systemid'],$user_name,$pidno,$sex,$phone,$birthday,$qq,$alias);

    $reqstr=gc_httpcall($vars);
  //  var_dump($reqstr);

    $output_array = json_decode($reqstr,true);

    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }
    return $output_array ;


}

//手机号验证功能 2015年11月12日 13:54:01
//function  gc_
function  gc_checkphoneauth($userid,$reg_phone){

    $vars=sprintf("ucapi/userverify?user_id=%s&systemname=MAILA&reg_phone=%s",$userid,$reg_phone);

   //var_dump($vars);

    $reqstr=gc_httpcall($vars);
    $output_array = json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }
    return $output_array ;

}

//修改支付密码


function gc_changepaypwd($phone,$oldpwd,$newpwd){

    $vars=sprintf("acapi/changepaypwd?phone=%s&systemname=MAILA&oldpwd=%s&newpwd=%s",$phone,$oldpwd,$newpwd);

    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }

    return $output_array;
}

function gc_checkpaypwd($phone,$pwd){

    $vars=sprintf("acapi/checkpaypwd?phone=%s&systemname=MAILA&pwd=%s",$phone,$pwd);

    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }

    return $output_array;
}

function gc_resetpaypwd($phone,$pid,$smscode){
    $vars=sprintf("acapi/resetpaypwd?phone=%s&systemname=MAILA&pid=%s&smscode=%s",$phone,$pid,$smscode);

    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
    if ($output_array == null) {
        $output_array=array();
        $output_array['resp_code'] = -1 ;
        return $output_array ;
    }

    return $output_array;
}

function gc_rsa_encrypt($password) //加密
{

    $publicKeyFilePath = ROOT_PATH.'/data/public_key.pem';
    extension_loaded('openssl') or die('php需要openssl扩展支持');
    
    $filestr = file_get_contents($publicKeyFilePath) ;
    gc_writelog("RSA=".$filestr."PU\n", __FILE__, __LINE__) ;
//    print_r($filestr) ;
    
    $pu_key = openssl_pkey_get_public($filestr);

    $old_encrypted="" ;
    openssl_public_encrypt($password, $old_encrypted, $pu_key);//公钥加密
    $rsa_pass = base64_encode($old_encrypted);

    return $rsa_pass ;
}

function gc_rsa_decrypt($password) //私密解密
{
    $publicKeyFilePath = ROOT_PATH.'/data/private_key.pem';
    extension_loaded('openssl') or die('php需要openssl扩展支持');

    $filestr = file_get_contents($publicKeyFilePath) ;
    gc_writelog("RSA=".$filestr."PI\n".$password."end", __FILE__, __LINE__) ;
        
    $pu_key = openssl_pkey_get_private($filestr);
    $decrypted="" ;
    openssl_private_decrypt(base64_decode($password), $decrypted, $pu_key);//私密解密
    gc_writelog("E".$decrypted."E", __FILE__, __LINE__) ;
    return $decrypted ;
}

//1.推送实名认证数据
function gc_user_realname_auth($realname)
{
    $vars=sprintf("ucapi/user_realname_auth?user_id=%s&user_name=%s&pidno=%s&banks=%s&bankno=%s&bankaccount=%s&bankname=%s&img1=%s&img2=%s&img3=%s&img4=%s&img5=%s&systemname=MAILA",
            $realname['user_id'],$realname['user_name'],$realname['pidno'],$realname['banks'],$realname['bankno'],$realname['bankaccount'],$realname['bankname'],$realname['img1'],
            $realname['img2'],$realname['img3'],$realname['img4'],$realname['img5']) ;

    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
    if($output_array==null){
        $output_array=array();
        $output_array['resp_code']=-1;
        $output_array['resp_msg']="上传失败";

    }


    return $output_array;    
}

//2.读取实名认证数据 
function gc_get_realname_auth($user_id)
{
    $vars=sprintf("ucapi/get_realname_auth?user_id=%s&systemname=MAILA", $user_id) ;

    $reqstr=gc_httpcall($vars);

    $output_array=json_decode($reqstr,true);

    
    $user = array() ;
    if ($output_array == null) {
        $user['resp_code'] = -1 ;
        return $user ;
    }
    return $output_array ;
}
//提现
function gc_user_drawing($user_id, $bankaccount, $amount,$drawingtype='BAL')
{
    $rsp = array() ;
/*
    if ($drawingtype != 'TB') {
        $rsp['resp_code'] = -1 ;
        $rsp['resp_msg'] = "系统故障!" ;
        return $rsp;
    }
*/
    $vars=sprintf("ucapi/user_drawing?user_id=%s&bankaccount=%s&amount=%s&drawingtype=%s&systemname=MAILA", 
        $user_id, $bankaccount, $amount,$drawingtype) ;
    //var_dump($vars);
    $reqstr=gc_httpcall($vars);
   // var_dump($reqstr);
    if($reqstr==null){
        $rsp['resp_code'] = -1 ;
        $rsp['resp_msg'] = "系统故障!" ;
        return $rsp;
    }
    $output_array=json_decode($reqstr,true);
    if($output_array==null){
        $rsp['resp_code'] = -1 ;
        $rsp['resp_msg'] = "系统故障!" ;
        return $rsp;
    }

    if($output_array["resp_code"]===0){
        return  $output_array;
    }else{
        return $output_array;
    }
}

//1.Gpos用户申请
function gc_gpos_req($user_id,$addrstr)
{
    $vars=sprintf("ucapi/gpos_req?user_id=%s&addr=%s&systemname=MAILA", $user_id,$addrstr) ;

    $reqstr=gc_httpcall($vars);
    if($reqstr==null){

        return  false;
    }

    $output_array=json_decode($reqstr,true);

    if($output_array==null){
        return false;

    }

    if($output_array["resp_code"]===0){

        return $output_array;

    }else{

        return  false;
    }



}

//2.Gpos用户信息查询
function gc_gpos_inq($user_id)
{
    $vars=sprintf("ucapi/gpos_inq?user_id=%s&systemname=MAILA", $user_id) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);

    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['user_id'] = 0 ;
        return $user;
    }
    return $output_array['gpos'] ;
}


//短连接
 function  gc_urlshort($user_id,$utype='U'){

     $vars=sprintf("ucapi/surl_set?user_id=%s&utype=%s&systemname=MAILA", $user_id,$utype) ;

     $reqstr=gc_httpcall($vars);

     $output_array=json_decode($reqstr,true);

     if ($output_array == null) {
         $output_array=array();
         $output_array['resp_code']=-1;
         $output_array['resp_msg']="获取失败";

         return $output_array;
     }
     return $output_array;
 }

//获取长连接
function   gc_getlongurl($url){

    $vars=sprintf("ucapi/surl_inq?surl=%s&systemname=MAILA", $url) ;

    $reqstr=gc_httpcall($vars);



    $output_array=json_decode($reqstr,true);

    $user=array();

    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $output_array=array();
        $output_array['resp_code']=-1;
        $output_array['resp_msg']="获取失败";

        return $output_array;
    }


    return  $output_array;


}


//数字打码
function  number_stars($str,$from,$limit,$star="*"){


        $len=strlen($str);
      if($len>8) {
          if($from>$len){
              return $str;

          }
          if($limit+$from>$len){

              return $str;
          }


          $newstr = substr($str, $from, $limit);
          $restr = str_repeat($star, $limit);
          $res = str_replace($newstr, $restr, $str);
          return $res;
      }else{

          return $str;

      }
}

//2.门店融资信息查询
function gc_mdrz_inq($user_id)
{
    $vars=sprintf("/mdapi/mdrz_inq?user_id=%s&systemname=MAILA", $user_id) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);

    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = 0 ;
        return $user;
    }
    return $output_array ;
}
function gc_mdrz_order($user_id,$level, $number, $amount,$rephone)
{
    $vars=sprintf("/mdapi/mdrz_order?user_id=%s&level=%s&number=%s&amount=%s&rephone=%s&systemname=MAILA", 
        $user_id,$level,$number,$amount,$rephone) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);

    if ($output_array == null) {
        $user = array() ;
        $user['resp_code'] = -1 ;
        $user['resp_msg'] = "通讯失败，请稍后再试！" ;
        return $user;
    }
    return $output_array ;
}

//查询用户机构信息
function gc_branch_inq($user_id)
{
    $vars=sprintf("/mdapi/branch_inq?user_id=%s&systemname=MAILA", $user_id) ;

    $reqstr=gc_httpcall($vars);


    $output_array=json_decode($reqstr,true);


    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1;
        return $user;
    }
    return $output_array ;
}

//用户机构申请
function gc_branch_apply($user_id, $region_id,$rephone,$branch_name
)
{
    $vars=sprintf("/mdapi/branch_apply?user_id=%s&region_id=%s&rephone=%s&branch_name=%s&systemname=MAILA", $user_id,$region_id,$rephone,$branch_name) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);

    $output_array=json_decode($reqstr,true);


    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=@$output_array['resp_msg'];
        return $user;
    }
    return $output_array ;
}

//用户机构开通
function gc_branch_sale($user_id,$region_id,$amount)
{
    $vars=sprintf("/mdapi/branch_sale?user_id=%s&region_id=%s&amount=%s&systemname=MAILA", $user_id,$region_id,$amount) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);

    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=$output_array['resp_msg'];

        return $user;
    }
    return $output_array ;
}
//代理商查询
function  gc_merchant_lists($user_id,$type,$start,$size){


    $vars=sprintf("/llapi/merchant_lists?user_id=%s&type=%s&start=%s&size=%s&systemname=MAILA", $user_id,$type,$start,$size) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
   //var_dump($output_array);
    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=$output_array['resp_msg'];

        return $user;
    }
    return $output_array ;
}
//服务商卡密升级
///mdapi/md_fws_card?user_id=,cardno=,passwd=,rephone=,systemname=

function gc_fwscard($user_id,$cardno,$pwd,$rephone){

    $vars=sprintf("/mdapi/md_fws_card?user_id=%s&cardno=%s&passwd=%s&rephone=%s&systemname=MAILA", $user_id,$cardno,$pwd,$rephone) ;
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
   // var_dump($reqstr);

    $output_array=json_decode($reqstr,true);
   // var_dump($output_array);

    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=$output_array['resp_msg'];

        return $user;
    }
    return $output_array ;

}
///mdapi/md_fws_lists?user_id,start,size,systemname
//您的服务商查询
function  gc_fws_lists($userid,$start,$size){


    $vars=sprintf("/mdapi/md_fws_lists?user_id=%s&start=%s&size=%s&systemname=MAILA", $userid,$start,$size);
    // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    // var_dump($reqstr);

    $output_array=json_decode($reqstr,true);
    // var_dump($output_array);

    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=$output_array['resp_msg'];

        return $user;
    }
    return $output_array ;


}
//2016年9月28日 13:28:05  来啦订单

function   gc_merchant_order_sale($user_phone,$merchant_id,$amount,$ordername){


    $vars=sprintf("/llapi/merchant_order_sale?user_phone=%s&merchant_id=%s&amount=%s&ordername=%s&systemname=MAILA", $user_phone,$merchant_id,$amount,$ordername);

    $reqstr=gc_httpcall($vars);


    $output_array=json_decode($reqstr,true);


    $user = array() ;
    if ($output_array == null || $output_array['resp_code'] !== 0) {
        $user['resp_code'] = -1 ;
        $user['resp_msg']=$output_array['resp_msg'];

        return $user;
    }
    return $output_array ;









}




//微信快速注册

function wx_register($openid,$phone){
    $vars =sprintf("ucapi/userregister?tel=%s&openid=%s&recommend=%s&systemname=MAILA",
        '',$openid,$phone);
   // var_dump($vars);
    $reqstr=gc_httpcall($vars);
    $output_array=json_decode($reqstr,true);
    if ($output_array == null) {
        $user = array() ;
        $user['resp_code'] = -1 ;
        $user['resp_msg'] = "通讯失败，请稍后再试！" ;
        return $user;
    }
    return $output_array ;
    }



