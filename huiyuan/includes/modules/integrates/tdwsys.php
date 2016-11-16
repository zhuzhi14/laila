<?php

/**
 * ECSHOP 会员数据处理类
 * ============================================================================
 * * 版权所有 2005-2012 江苏通兑有限公司，并保留所有权利。
 * 网站地址: http://www.tongduika.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: ecshop.php 17217 2011-01-19 06:29:08Z liubo $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = (isset($modules)) ? count($modules) : 0;

    /* 会员数据整合插件的代码必须和文件名保持一致 */
    $modules[$i]['code']    = 'ecshop';

    /* 被整合的第三方程序的名称 */
    $modules[$i]['name']    = 'ecshop';

    /* 被整合的第三方程序的版本 */
    $modules[$i]['version'] = '2.0';

    /* 插件的作者 */
    $modules[$i]['author']  = 'ECSHOP';

    /* 插件作者的官方网站 */
    $modules[$i]['website'] = 'http://www.tongduika.com';

    return;
}

require_once(ROOT_PATH . 'includes/modules/integrates/integrate.php');
require_once(ROOT_PATH . 'includes/lib_tdwsys.php');
class ecshop extends integrate
{
    var $is_ecshop = 1;

    function __construct($cfg)
    {
        $this->ecshop($cfg);
    }

    /**
     *
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function ecshop($cfg)
    {
        parent::integrate(array());
        $this->user_table = 'users';
        $this->field_id = 'user_id';
        $this->ec_salt = 'ec_salt';
        $this->field_phone = 'phone';
        $this->field_name = 'user_name';
        $this->field_pass = 'password';
        $this->field_email = 'email';
        $this->field_gender = 'sex';
        $this->field_bday = 'birthday';
        $this->field_reg_date = 'reg_time';
        $this->need_sync = false;
        $this->is_ecshop = 1;
 //       echo "ecshop";
    }

    /**
     *  检查指定用户是否存在及密码是否正确(重载基类check_user函数，支持zc加密方法)
     *
     * @access  public
     * @param   string  $username   用户名
     *
     * @return  int
     */
    function check_user($username, $password = null)
    {
        if ($this->charset != 'UTF8')
        {
            $post_username = ecs_iconv('UTF8', $this->charset, $username);
        }
        else
        {
            $post_username = $username;
        }

        if ($password === null)
        {
						$row = gc_checkuser($username) ;
            return $row ;
        }
        else
        {
       		$row = gc_userlogin($username,md5($password)) ;
        	$_SESSION['user_id']   = $row['user_id'];
          return $row ;
        }
    }

    /**
     *  用户登录函数
     *
     * @access  public
     * @param   string  $username
     * @param   string  $password
     *
     * @return void
     */
    function login($username, $password, $remember = null)
    {
    	//先清除登入信息
//				$this->set_session();
//				$this->set_cookie();
gc_writelog("login") ;
       	$row = gc_userlogin($username,md5($password)) ;
gc_writelog($row) ;

        if ($row['user_id'] > 0)
        {
        		$_SESSION['user_id']   = $row['user_id'];
		        $_SESSION['last_time']   = $row['last_login'];
		        $_SESSION['last_ip']     = $row['last_ip'];
		        $_SESSION['login_fail']  = 0;
		        $_SESSION['email']       = $row['email'] ;
				$_SESSION['user_rank'] = $row['user_rank'] ;
				$_SESSION['buss_rank'] = $row['buss_rank'] ;
				$_SESSION['md_jb'] = $row['md_jb'] ;
				$_SESSION['branch_rank'] = $row['branch_rank'] ;
				$_SESSION['baotime'] = $row['baotime'] ;			
				$_SESSION['discount']  = $row['discount'] ;
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
				
            if ($this->need_sync)
            {
                $this->sync($row['phone'],$password);
            }
            $this->set_session($row['phone']);
            $this->set_cookie($row['phone'], $remember);

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     *  添加一个新用户
     *
     * @access  public
     * @param
     *
     * @return int
     */
    function add_user($phone,$pidno,$smscode,$password, $username, $email, $recode)
    {
        $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
        if ($systmid == "") $systmid="MAILA" ;
        
        $vars =sprintf("ucapi/userregister?tel=%s&pidno=%s&smscode=%s&logpass=%s&recommend=%s&name=%s&email=%s&systemname=%s",
				       $phone, $pidno, $smscode,md5($password),$recode, $username,$email,$systmid);
               // var_dump($vars);
				$erruser = array() ;
                $erruser["user_id"] = 0 ;
				
				if ($vars === null) {
				    $erruser['resp_msg'] = "通讯失败，请稍后再做！" ;
				    return $erruser ;    
                }
				$reqstr = gc_httpcall($vars) ;
				//var_dump($reqstr);
				$output_array = json_decode($reqstr,true);
			
                if ($output_array == null)
                    return $erruser;
				//$row['user_id'] > 0
        if ($output_array["resp_code"] === 0)
        {
        		$row = $output_array["user"] ;
        		$_SESSION['user_id']   = $row['user_id'];
		        $_SESSION['last_time']   = $row['last_time'];
		        $_SESSION['last_ip']     = $row['last_ip'];
		        $_SESSION['login_fail']  = 0;
		        $_SESSION['email']       = $row['email'] ;
						$_SESSION['user_rank'] = $row['user_rank'] ;
						$_SESSION['baotime'] = $row['baotime'] ;			
						//$_SESSION['discount']  = $row['discount'] ;
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
						
            if ($this->need_sync)
            {
                $this->sync($row['phone'],$password);
            }
            $this->set_session($row['phone']);
          //  $this->set_cookie($row['phone'], $remember);
          	return $row;
        }
				
				//return $output_array ;
		$erruser['resp_msg'] = $output_array['resp_msg'] ;
        return $erruser ;
    }

    function add_in_user($phone,$pidno, $password, $username, $email, $recode)
    {
        $systmid = isset($_SESSION['systemid'])?$_SESSION['systemid']:"MAILA" ;
        if ($systmid == "") $systmid="MAILA" ;
        
        $vars =sprintf("ucapi/userregister?tel=%s&pidno=%s&logpass=%s&recommend=%s&name=%s&email=%s&systemname=%s",
            $phone,$pidno, md5($password),$recode, $username,$email,$systmid);
        // var_dump($vars);
        $erruser = array() ;
        $erruser["user_id"] = 0 ;
    
        if ($vars === null) {
            $erruser['resp_msg'] = "通讯失败，请稍后再做！" ;
            return $erruser ;
        }
        $reqstr = gc_httpcall($vars) ;
        //var_dump($reqstr);
        $output_array = json_decode($reqstr,true);
        	
        if ($output_array == null)
            return $erruser;
        //$row['user_id'] > 0
        if ($output_array["resp_code"] === 0)
        {
            $row = $output_array["user"] ;
    
            return $row;
        }
    
        $erruser['resp_msg'] = $output_array['resp_msg'] ;
        return $erruser ;
    }
    
    
    /**
     *  编辑用户信息($password, $email, $gender, $bday)
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function edit_user($cfg)
    {
        if (empty($cfg['username']))
        {
            return false;
        }
        else
        {
            $cfg['post_username'] = $cfg['username'];
        }

        $values = array();
        if (!empty($cfg['password']) && empty($cfg['md5password']))
        {
            $cfg['md5password'] = md5($cfg['password']);
        }
        if ((!empty($cfg['md5password'])) && $this->field_pass != 'NULL')
        {
            $values[] = $this->field_pass . "='" . $this->compile_password(array('md5password'=>$cfg['md5password'])) . "'";
        }

        if ((!empty($cfg['email'])) && $this->field_email != 'NULL')
        {
            /* 检查email是否重复 */
            $sql = "SELECT " . $this->field_id .
                   " FROM " . $this->table($this->user_table).
                   " WHERE " . $this->field_email . " = '$cfg[email]' ".
                   " AND " . $this->field_name . " != '$cfg[post_username]'";
            if ($this->db->getOne($sql, true) > 0)
            {
                $this->error = ERR_EMAIL_EXISTS;

                return false;
            }
            // 检查是否为新E-mail
            $sql = "SELECT count(*)" .
                   " FROM " . $this->table($this->user_table).
                   " WHERE " . $this->field_email . " = '$cfg[email]' ";
            if($this->db->getOne($sql, true) == 0)
            {
                // 新的E-mail
                $sql = "UPDATE " . $GLOBALS['ecs']->table('users') . " SET is_validated = 0 WHERE user_name = '$cfg[post_username]'";
                $this->db->query($sql);
            }
            $values[] = $this->field_email . "='". $cfg['email'] . "'";
        }

        if (isset($cfg['gender']) && $this->field_gender != 'NULL')
        {
            $values[] = $this->field_gender . "='" . $cfg['gender'] . "'";
        }

        if ((!empty($cfg['bday'])) && $this->field_bday != 'NULL')
        {
            $values[] = $this->field_bday . "='" . $cfg['bday'] . "'";
        }

        if ($values)
        {
            $sql = "UPDATE " . $this->table($this->user_table).
                   " SET " . implode(', ', $values).
                   " WHERE " . $this->field_name . "='" . $cfg['post_username'] . "' LIMIT 1";

            $this->db->query($sql);

            if ($this->need_sync)
            {
                if (empty($cfg['md5password']))
                {
                    $this->sync($cfg['username']);
                }
                else
                {
                    $this->sync($cfg['username'], '', $cfg['md5password']);
                }
            }
        }

        return true;
    }

    /**
     * 删除用户
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function remove_user($id)
    {
        $post_id = $id;

        if ($this->need_sync || (isset($this->is_ecshop) && $this->is_ecshop))
        {
            /* 如果需要同步或是ecshop插件执行这部分代码 */
            $sql = "SELECT user_id FROM "  . $GLOBALS['ecs']->table('users') . " WHERE ";
            $sql .= (is_array($post_id)) ? db_create_in($post_id, 'user_name') : "user_name='". $post_id . "' LIMIT 1";
            $col = $GLOBALS['db']->getCol($sql);

            if ($col)
            {
                $sql = "UPDATE " . $GLOBALS['ecs']->table('users') . " SET parent_id = 0 WHERE " . db_create_in($col, 'parent_id'); //将删除用户的下级的parent_id 改为0
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('users') . " WHERE " . db_create_in($col, 'user_id'); //删除用户
                $GLOBALS['db']->query($sql);
                /* 删除用户订单 */
                $sql = "SELECT order_id FROM " . $GLOBALS['ecs']->table('order_info') . " WHERE " . db_create_in($col, 'user_id');
                $GLOBALS['db']->query($sql);
                $col_order_id = $GLOBALS['db']->getCol($sql);
                if ($col_order_id)
                {
                    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('order_info') . " WHERE " . db_create_in($col_order_id, 'order_id');
                    $GLOBALS['db']->query($sql);
                    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('order_goods') . " WHERE " . db_create_in($col_order_id, 'order_id');
                    $GLOBALS['db']->query($sql);
                }

                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('booking_goods') . " WHERE " . db_create_in($col, 'user_id'); //删除用户
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('collect_goods') . " WHERE " . db_create_in($col, 'user_id'); //删除会员收藏商品
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('feedback') . " WHERE " . db_create_in($col, 'user_id'); //删除用户留言
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('user_address') . " WHERE " . db_create_in($col, 'user_id'); //删除用户地址
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('user_bonus') . " WHERE " . db_create_in($col, 'user_id'); //删除用户红包
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('user_account') . " WHERE " . db_create_in($col, 'user_id'); //删除用户帐号金额
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('tag') . " WHERE " . db_create_in($col, 'user_id'); //删除用户标记
                $GLOBALS['db']->query($sql);
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('account_log') . " WHERE " . db_create_in($col, 'user_id'); //删除用户日志
                $GLOBALS['db']->query($sql);
            }
        }

        if (isset($this->ecshop) && $this->ecshop)
        {
            /* 如果是ecshop插件直接退出 */
            return;
        }

        $sql = "DELETE FROM " . $this->table($this->user_table) . " WHERE ";
        if (is_array($post_id))
        {
            $sql .= db_create_in($post_id, $this->field_name);
        }
        else
        {
            $sql .= $this->field_name . "='" . $post_id . "' LIMIT 1";
        }

        $this->db->query($sql);
    }

    /**
     *  获取指定用户的信息
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function get_profile_by_name($username)
    {
        $post_username = $username;
				$row = gc_checkuser($post_username) ;
        return $row;
    }

    /**
     *  获取指定用户的信息
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function get_profile_by_id($id)
    {
				$row = gc_getuserinfo($id) ;

        return $row;
    }

    /**
     *  根据登录状态设置cookie
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function get_cookie()
    {
        $id = $this->check_cookie();
        if ($id)
        {
            if ($this->need_sync)
            {
                $this->sync($id);
            }
            $this->set_session($id);

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     *  检查指定邮箱是否存在
     *
     * @access  public
     * @param   string  $email   用户邮箱
     *
     * @return  boolean
     */
    function check_email($email)
    {
				$row = gc_checkuser($email) ;
				gc_writelog("\r\nemail=".$email."  user_id=".$row["user_id"]);

				if ($row["user_id"] == 0)
					return false ;
				else {
					$this->error = ERR_EMAIL_EXISTS;
					return true ;
				}
    }
/**
     *  检查指定推荐人是否存在
     *
     * @access  public
     * @param   string  $email   用户邮箱
     *
     * @return  boolean
     */
    function check_recode($email)
    {
    	if (!empty($email)) {
				gc_writelog("recode=".$email."|||");
				$row = gc_checkuser($email) ;
				
				gc_writelog("recode=".$email."  user_id=".$row["user_id"]);
				
				if ($row["user_id"] == 0) {
                $this->error = ERR_INVALID_USERNAME;
                return true;
				} else return false ;
			}
    }

    /**
     *  设置cookie
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function set_cookie($username='', $remember= null )
    {
    		gc_writelog("set_cookie=".$username."|".$remember."\r\n") ;
        if (empty($username))
        {
            /* 摧毁cookie */
            $time = time() - 3600;
            setcookie("ECS[user_id]",  '', $time, $this->cookie_path);            
            setcookie("ECS[password]", '', $time, $this->cookie_path);

        }
        elseif ($remember)
        {
            /* 设置cookie */
            $time = time() + 3600 * 24 * 15;
    		
    				gc_writelog("time=".$time."|\r\n") ;

            setcookie("ECS[username]", $username, $time, $this->cookie_path, $this->cookie_domain);
//            setcookie("ECS[user_id]", $row['user_id'], $time, $this->cookie_path, $this->cookie_domain);
//            setcookie("ECS[password]", $row['password'], $time, $this->cookie_path, $this->cookie_domain);
        }
    }

   /**
     *  设置指定用户SESSION
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function set_session ($username='')
    {
        if (empty($username))
        {
            $GLOBALS['sess']->destroy_session();
        }
        else
        {
//        		echo "set_session".$username."|" ;
            $row = gc_getuserinfo($username) ;

            if ($row['user_id'] > 0)
            {
                $_SESSION['user_id']   = $row['user_id'];
                $_SESSION['user_name'] = $username;
                $_SESSION['email']     = $row['email'];
            }
        }
    }


    /**
     *  编译密码函数
     *
     * @access  public
     * @param   array   $cfg 包含参数为 $password, $md5password, $salt, $type
     *
     * @return void
     */
    function compile_password ($cfg)
    {
       if (isset($cfg['password']))
       {
            $cfg['md5password'] = md5($cfg['password']);
       }
       if (empty($cfg['type']))
       {
            $cfg['type'] = PWD_MD5;
       }

       switch ($cfg['type'])
       {
           case PWD_MD5 :
              	if(!empty($cfg['ec_salt']))
		       {
			       return md5($cfg['md5password'].$cfg['ec_salt']);
		       }
			   else
		       {
                    return $cfg['md5password'];
			   }

           case PWD_PRE_SALT :
               if (empty($cfg['salt']))
               {
                    $cfg['salt'] = '';
               }

               return md5($cfg['salt'] . $cfg['md5password']);

           case PWD_SUF_SALT :
               if (empty($cfg['salt']))
               {
                    $cfg['salt'] = '';
               }

               return md5($cfg['md5password'] . $cfg['salt']);

           default:
               return '';
       }
    }

    /**
     *  会员同步
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function sync ($username, $password='', $md5password='')
    {
    	return true ;
    }

    /**
     *  获取用户积分
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function get_points($username)
    {
        $credits = $this->get_points_name();
        $fileds = array_keys($credits);
        if ($fileds)
        {
            $sql = "SELECT " . $this->field_id . ', ' . implode(', ',$fileds).
                   " FROM " . $this->table($this->user_table).
                   " WHERE " . $this->field_name . "='$username'";
            $row = $this->db->getRow($sql);
            return $row;
        }
        else
        {
            return false;
        }
    }

    /**
     *设置用户积分
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function set_points ($username, $credits)
    {
        $user_set = array_keys($credits);
        $points_set = array_keys($this->get_points_name());

        $set = array_intersect($user_set, $points_set);

        if ($set)
        {
            $tmp = array();
            foreach ($set as $credit)
            {
               $tmp[] = $credit . '=' . $credit . '+' . $credits[$credit];
            }
            $sql = "UPDATE " . $this->table($this->user_table).
                   " SET " . implode(', ', $tmp).
                   " WHERE " . $this->field_name . " = '$username'";
            $this->db->query($sql);
        }

        return true;
    }

    function get_user_info($username)
    {
        return $this->get_profile_by_name($username);
    }


    /**
     * 检查有无重名用户，有则返回重名用户
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function test_conflict ($user_list)
    {
        if (empty($user_list))
        {
            return array();
        }

        return $user_list;
    }


}

?>