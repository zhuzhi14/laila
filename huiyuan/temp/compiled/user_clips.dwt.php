<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<style type="text/css">

</style>

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,common.js,user.js,dtree.js,password.js,zhifubox.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

  <?php echo $this->fetch('library/ur_here.lbi'); ?>
<div class="block clearfix">
  
  <div class="AreaL">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox">
        <?php echo $this->fetch('library/user_menu.lbi'); ?>
      </div>
     </div>
    </div>
  </div>
  
  
  <div class="AreaR">
    <div class="box">

     <div class="box_1">
      <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
         
         <?php if ($this->_var['action'] == 'default'): ?>
          <font class="f5"><b class="f4"><?php echo $this->_var['info']['username']; ?></b> <?php echo $this->_var['lang']['welcome_to']; ?> <?php echo $this->_var['info']['shop_name']; ?>！</font><br />
          <div class="blank"></div>
          <?php echo $this->_var['lang']['last_time']; ?>: <?php echo $this->_var['info']['last_time']; ?><br />
          <div class="blank5"></div>
          <?php echo $this->_var['rank_name']; ?> <?php echo $this->_var['next_rank_name']; ?><br />
          <div class="blank5"></div>
          <!--
             <div>手机验证:<a onclick="showMask()"><span style="color:red" id="tel_check"><?php echo $this->_var['telvali']; ?></span></a></div><br />
                             <div>邮箱验证:<span style="color:red"><?php echo $this->_var['mailvali']; ?></span></div><br />
                             <div>实名验证:<a onclick="showcard()">     <span style="color:red"><?php echo $this->_var['namevali']; ?></span></a></div><br />
          -->

           <?php if ($this->_var['info']['is_validate'] == 0): ?>
          <?php echo $this->_var['lang']['not_validated']; ?> <a href="javascript:sendHashMail()" style="color:#006bd0;"><?php echo $this->_var['lang']['resend_hash_mail']; ?></a><br />
           <?php endif; ?>
           <div style="margin:5px 0; border:1px solid #f7dd98;padding:10px 20px; background-color:#fffad5;">
           <img src="themes/ecmoban_yihaodian/images/note.gif" alt="note" />&nbsp;<?php echo $this->_var['user_notice']; ?>
           </div>
	          <div style="margin-left:-40px">
	          </div>

           <br /><br />
          <div class="f_l" style="width:350px;">
          <h5><span><?php echo $this->_var['lang']['your_account']; ?></span></h5>
          <div class="blank"></div>
          <?php echo $this->_var['lang']['your_surplus']; ?>:<a href="user.php?act=account_log" style="color:#006bd0;"><?php echo $this->_var['info']['surplus']; ?></a><br />
          <?php if ($this->_var['info']['credit_line'] > 0): ?>
          <?php echo $this->_var['lang']['credit_line']; ?>:<?php echo $this->_var['info']['formated_credit_line']; ?><br />
          <?php endif; ?>
          <?php echo $this->_var['lang']['your_award']; ?>:<a href="user.php?act=account_log" style="color:#006bd0;"><?php echo $this->_var['info']['award_bal']; ?></a><br />
          <?php echo $this->_var['lang']['your_integral']; ?>:<?php echo $this->_var['info']['integral']; ?><br />
          </div>
          <div class="f_r" style="width:350px;">
          <h5><span><?php echo $this->_var['lang']['your_notice']; ?></span></h5>
          <div class="blank"></div>
           <?php $_from = $this->_var['prompt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <?php echo $this->_var['item']['text']; ?><br />
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <?php echo $this->_var['lang']['last_month_order']; ?><?php echo $this->_var['info']['order_count']; ?><?php echo $this->_var['lang']['order_unit']; ?><br />
          <?php if ($this->_var['info']['shipped_order']): ?>
          <?php echo $this->_var['lang']['please_received']; ?><br />
          <?php $_from = $this->_var['info']['shipped_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" style="color:#006bd0;"><?php echo $this->_var['item']['order_sn']; ?></a>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <?php endif; ?>
          <br /><br />
          </div>
         
          <div class="f_l" style="width:350px;">
	          <h5><span>股票账户</span></h5>
	          <div class="blank"></div>
	          股票数量:<?php echo $this->_var['sharesnum']; ?> <br />
	          平均单价:<?php echo $this->_var['unitprice']; ?> <br />
	          当前单价:<?php echo $this->_var['curprice']; ?> <br />
	          当前市值:<?php echo $this->_var['sharesamt']; ?> <br />
          </div>
          <div class="f_r" style="width:350px;">
	          <h5><span>支付设备</span></h5>
	          <div class="blank"></div>
	          <?php if ($this->_var['gposstatus'] == '0'): ?>
		          <?php if ($this->_var['user_rank'] > '1'): ?>
		            <form action="user.php" method="post" enctype="multipart/form-data" name="formUpv" onSubmit="return submitUpv()">
	                  <table width="100%" border="0" cellpadding="3">
				          免费领取GPOS机 <br />
		                    <tr>          	                    
		                      <td>&nbsp;</td>
		                      <td><input type="hidden" name="act" value="send_inq_gpos" />
		                        <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus" onclick="return confirm('确定要领取Gpos机吗?')"/>
		                      </td>
		                    </tr>
	                 </table>
	                </form>
	       <!--             
		              <span style="background-color:#ACD6FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="send_inq_gpos(<?php echo $this->_var['user_id']; ?>)"    id="get_code1" >点击免费领取</span>
		   -->           
				  <?php endif; ?>
		          <?php if ($this->_var['user_rank'] <= '1'): ?>
				  	 升级麦啦会员、合伙人后领取GPOS机 <br />
	              <?php endif; ?> 
              <?php endif; ?>
	          <?php if ($this->_var['gposstatus'] == 'X'): ?>
	          请在完成实名认证后的麦啦用户、合伙人免费领取GPOS机 <br />
              <?php endif; ?>
	          <?php if ($this->_var['gposstatus'] == '1'): ?>
	          已经发送免费领取gpos机请求，请等待收取 <br />
              <?php endif; ?>
	          <?php if ($this->_var['gposstatus'] == '9'): ?>
	          已经领取Gpos机，机器编号：<?php echo $this->_var['posno']; ?> <br />
              <?php endif; ?>
          </div>
          
          
          
          <script type="text/javascript">
              //兼容火狐、IE8
              //显示遮罩层


          </script>


          <div id="mask" class="mask" style="display:none;position: absolute; top:400px;margin-left:490px;  background-color: #fff;z-index: 1002; left: 0px;width:300px;height:300px;border: 1px solid #2cb7fe;" >
            <div>
              <span id="mask_close" onclick="hideMask()" style="margin-left:250px">关闭</span>
            </div>
            <div style="margin-top:40px">
              <h2>手机号：<span id="tel_num"><?php echo $this->_var['tel']; ?></span></a></h2>
            </div>
            <div style="margin-top:40px">
              <h2>验证码：<input type="text" id="code" size="30"><button id="get_code" onclick="getsms()">获取验证码</button></h2>
            </div>
            <div  style="margin-top:40px">

                     <button  id="check_code" onclick="check_code()">验证</button>

           </div>

    </div>

    <div id="card" class="mask" style="display:none;position: absolute; top:400px;margin-left:490px;  background-color: #fff;z-index: 1002; left: 0px;width:300px;height:300px;border: 1px solid #2cb7fe;" >
               <form action="user.php" method="post" enctype="multipart/form-data" name="formMsg" onSubmit="return submitMsg()">
<div>
              <span id="mask_close" onclick="hidecard()" style="margin-left:250px">关闭</span>
  </div>
 <div style="margin-top:30px;">正面：<input type="file" name="card_img_1"  size="45"  class="inputBg" /></div>
<div style="margin-top:30px;">反面：<input type="file" name="card_img_2"  size="45"  class="inputBg" /></div>

                 <div><input type="hidden" name="act" value="act_add_cart" />
                    <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus" />
                   </div>

              </form>
        </div>
         <?php endif; ?>

          <?php if ($this->_var['action'] == 'safe_center'): ?>
           <div  class="black"></div>
<div  class="f_l">修改密码</div>
  <form name="formPassword" id="formPassword" action="user.php" method="post" onSubmit="return check_pass_form()" >
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
   <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['old_password']; ?>：</td>
            <td width="76%" align="left" bgcolor="#FFFFFF"><input name="old_password" id="old_password" type="password" size="25"  class="inputBg" /></td>
          </tr>
          <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['new_password']; ?>：</td>
            <td align="left" bgcolor="#FFFFFF"><input name="new_password" id="new_password" type="password" size="25"  class="inputBg" /></td>
          </tr>
          <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['confirm_password']; ?>：</td>
            <td align="left" bgcolor="#FFFFFF"><input name="confirm_password"  id="confrim_password" type="password" size="25"  class="inputBg" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_password" />
              <input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
            </td>
          </tr>
  </table>
    </form>

<div  class="f_l">重置支付密码</div>
<form name="formResetpayPassword" id="formResetPassword" action="user.php?act=reset_pay_pwd" method="post"  >
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
   <tr>
      <td width="28%" align="right" bgcolor="#FFFFFF">说明</td>
      <td width="76%" align="left" bgcolor="#FFFFFF">重置支付密码，会随机生成支付密码，通过短信发送到您手机上！</td>
   </tr>
   <tr>
      <td width="28%" align="right" bgcolor="#FFFFFF">手机号</td>
            <td width="76%" align="left" bgcolor="#FFFFFF"><input name="phone" id="phone" type="text" size="25" disabled='disabled'  class="inputBg" value="<?php echo $this->_var['phone']; ?>" /></td>
   </tr>
   <tr>
      <td width="28%" align="right" bgcolor="#FFFFFF">验证码</td>
      <td width="76%" align="left" bgcolor="#FFFFFF">
            <input name="smscode" type="text" id="smscode" size="30"><span style="background-color:#ACD6FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="getresetsms()"    id="get_code" >获取验证码</span></td>
      </td>
   </tr>
   
   <tr>
       <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="reset_pay_pwd" />
              <input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="重置支付密码" />
       </td>
    </tr>
  </table>
</form>

<div  class="f_l">修改支付密码</div>
	<form name="formResetpayPassword" id="formResetPassword" action="user.php?act=change_pay_pwd" method="post"  >
	<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF">原支付密码：</td>
            <td align="left" bgcolor="#FFFFFF"><input name="old_paypassword" maxlength=6 id="old_paypassword" onblur="check_password(this.value);" type="password" size="25"  class="inputBg" /></td>
          </tr>
          <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF">新支付密码：</td>
            <td align="left" bgcolor="#FFFFFF"><input name="new_paypassword" maxlength=6 id="new_paypassword" onblur="check_password(this.value);" type="password" size="25"  class="inputBg" /></td>
          </tr>
          <tr>
            <td width="28%" align="right" bgcolor="#FFFFFF">重复新支付密码：</td>
            <td align="left" bgcolor="#FFFFFF"><input name="confirm_paypassword" maxlength=6 id="confrim_paypassword" onblur="check_password(this.value);" type="password" size="25"  class="inputBg" /></td>
          </tr>

          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="change_pay_pwd" />
              <input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="修改支付密码" />
            </td>
          </tr>
  	</table>
    </form>

          <?php endif; ?>

         
         
         <?php if ($this->_var['action'] == 'message_list'): ?>
          <h5><span><?php echo $this->_var['lang']['label_message']; ?></span></h5>
          <div class="blank"></div>
           <?php $_from = $this->_var['message_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'message');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['message']):
?>
          <div class="f_l">
          <b><?php echo $this->_var['message']['msg_type']; ?>:</b>&nbsp;&nbsp;<font class="f4"><?php echo $this->_var['message']['msg_title']; ?></font> (<?php echo $this->_var['message']['msg_time']; ?>)
          </div>
          <div class="f_r">
          <a href="user.php?act=del_msg&amp;id=<?php echo $this->_var['key']; ?>&amp;order_id=<?php echo $this->_var['message']['order_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_msg']; ?>')) return false;" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
          </div>
          <div class="msgBottomBorder">
          <?php echo $this->_var['message']['msg_content']; ?>
           <?php if ($this->_var['message']['message_img']): ?>
           <div align="right">
           <a href="data/feedbackimg/<?php echo $this->_var['message']['message_img']; ?>" target="_bank" class="f6"><?php echo $this->_var['lang']['view_upload_file']; ?></a>
           </div>
           <?php endif; ?>
           <br />
           <?php if ($this->_var['message']['re_msg_content']): ?>
           <a href="mailto:<?php echo $this->_var['message']['re_user_email']; ?>" class="f6"><?php echo $this->_var['lang']['shopman_reply']; ?></a> (<?php echo $this->_var['message']['re_msg_time']; ?>)<br />
           <?php echo $this->_var['message']['re_msg_content']; ?>
           <?php endif; ?>
          </div>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <?php if ($this->_var['message_list']): ?>
          <div class="f_r">
          <?php echo $this->fetch('library/pages.lbi'); ?>
          </div>
          <?php endif; ?>
          <div class="blank"></div>
          <form action="user.php" method="post" enctype="multipart/form-data" name="formMsg" onSubmit="return submitMsg()">
                  <table width="100%" border="0" cellpadding="3">
                    <?php if ($this->_var['order_info']): ?>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['order_number']; ?></td>
                      <td>
                      <a href ="<?php echo $this->_var['order_info']['url']; ?>"><img src="themes/ecmoban_yihaodian/images/note.gif" /><?php echo $this->_var['order_info']['order_sn']; ?></a>
                      <input name="msg_type" type="hidden" value="5" />
                      <input name="order_id" type="hidden" value="<?php echo $this->_var['order_info']['order_id']; ?>" class="inputBg" />
                      </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['message_type']; ?>：</td>
                      <td><input name="msg_type" type="radio" value="0" checked="checked" />
                        <?php echo $this->_var['lang']['type']['0']; ?>
                        <input type="radio" name="msg_type" value="1" />
                        <?php echo $this->_var['lang']['type']['1']; ?>
                        <input type="radio" name="msg_type" value="2" />
                        <?php echo $this->_var['lang']['type']['2']; ?>
                        <input type="radio" name="msg_type" value="3" />
                        <?php echo $this->_var['lang']['type']['3']; ?>
                        <input type="radio" name="msg_type" value="4" />
                        <?php echo $this->_var['lang']['type']['4']; ?> </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['message_title']; ?>：</td>
                      <td><input name="msg_title" type="text" size="30" class="inputBg" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><?php echo $this->_var['lang']['message_content']; ?>：</td>
                      <td><textarea name="msg_content" cols="50" rows="4" wrap="virtual" class="B_blue"></textarea></td>
                    </tr>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['upload_img']; ?>：</td>
                      <td><input type="file" name="message_img"  size="45"  class="inputBg" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="hidden" name="act" value="act_add_message" />
                        <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus" />
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                      <?php echo $this->_var['lang']['img_type_tips']; ?><br />
                      <?php echo $this->_var['lang']['img_type_list']; ?>
                      </td>
                    </tr>
                  </table>
                </form>
         <?php endif; ?>
         



         <?php if ($this->_var['action'] == 'upvip'): ?>
          <h5><span><?php echo $this->_var['lang']['label_upvip']; ?></span></h5>
          <div class="blank"></div>
          
          <form action="user.php" method="post" enctype="multipart/form-data" name="formUpv" onSubmit="return submitUpv()" id="myform_zhifubox">
                  <table width="100%" border="0" cellpadding="3">

                    <tr>
                      <td align="right">购买订单可使用金额： </td>
                      <td align="left"><?php echo $this->_var['amount']; ?> [其中余额:<?php echo $this->_var['balance']; ?>,积分:<?php echo $this->_var['award_bal']; ?>]</td>
                    </tr>
                    
		                <tr>
		                  <td align="right" bgcolor="#ffffff">麦啦产品类型：</td>
		                  <td colspan="3" align="left" bgcolor="#ffffff"><select name="mltype" id="selml_<?php echo $this->_var['sn']; ?>">
		                      <option value="0">请选择产品</option>
		                      <?php $_from = $this->_var['mltypelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ml');if (count($_from)):
    foreach ($_from AS $this->_var['ml']):
?>
		                      <option value="<?php echo $this->_var['ml']['mltype']; ?>" <?php if ($this->_var['mltype'] == $this->_var['ml']['mltype']): ?>selected<?php endif; ?>><?php echo $this->_var['ml']['mlname']; ?></option>
		                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                    </select>
		                  </td>
		                </tr>

                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['buy_uname']; ?>：</td>
                      <td><input name="buy_uname" type="text" size="30" value="<?php echo $this->_var['user_name']; ?>" class="inputBg" /> </td>
                    </tr>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['buy_num']; ?>：</td>
                      <td><input name="buy_num" type="text" size="30" value="1" class="inputBg" /><td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="hidden" name="act" value="act_add_order" />
                        <button  class="bnt_bonus" onclick="zhifucheck();return  false"/><?php echo $this->_var['lang']['submit']; ?></button>
                      </td>
          </form>
                    </tr>
                    <tr>
                      <td align="right"><font color="red">小提示：</font></td>
                      <td align="left">
                      <?php echo $this->_var['lang']['buy_type_tips']; ?><br />
                      <?php echo $this->_var['lang']['buy_type_list']; ?><br />
                      您在购单完成后，需要托售的订单在购买3日后挂网销售。货物需要在一月内下订单，过期未下定单的部分，收取每月5%的管理费。
                      </td>
                    </tr>
                  </table>


          <div  id="zhifubox"></div>

     <tr align="left">
        <td  bgcolor="#ffffff">购单数据</td>
	 </tr>
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_bordernum']; ?></td>
		<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ucode']; ?></td>
       	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_num']; ?></td>      
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_totalmoney']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_fanzong']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_fanok']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ifout']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_time']; ?></td>
        <td  bgcolor="#ffffff">总量</td>
        <td  bgcolor="#ffffff">已完成</td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_paycode']; ?></td>
      </tr>
      <?php $_from = $this->_var['buyorder_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['bordernum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ucode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['buynum']; ?></td>     
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['totalmoney']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['fanzong']; ?></td>
	 	<td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['fanok']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ifoutstr']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_add_time']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ordernum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['compnum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['paycode']; ?></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     </table>
    
 	 <?php if ($this->_var['buyorder_list']): ?>
         <?php echo $this->fetch('library/pages.lbi'); ?>
     <?php endif; ?> 
     
     <tr align="left">
        <td  bgcolor="#ffffff">分配数据</td>
	 </tr>
    
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_bordernum']; ?></td>
		<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ucode']; ?></td>
       	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
        <td  bgcolor="#ffffff">订单总额</td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_time']; ?></td>
         <td  bgcolor="#ffffff">完成日期</td>
         <td  bgcolor="#ffffff">完成子单数</td>
         <td  bgcolor="#ffffff">子单金额</td>
         <td  bgcolor="#ffffff">本次总金额</td>
      </tr>
      <?php $_from = $this->_var['matching_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       	<td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['bordernum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ucode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['totalmoney']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_add_time']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['matchdate']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['compnum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['orderfan']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['compamt']; ?></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     </table>
    
	 <?php if ($this->_var['matching_list']): ?>
	          <?php echo $this->fetch('library/mpages.lbi'); ?>          
	 <?php endif; ?>


         <?php endif; ?>
         



         <?php if ($this->_var['action'] == 'fhlist'): ?>
          <h5><span><?php echo $this->_var['lang']['label_fhlist']; ?></span></h5>
          <div class="blank"></div>
       
         
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['ucode']; ?></td>
         <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['backfee']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['ordernum']; ?></td>
       
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['stardate']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['enddate']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['adddate']; ?></td>
       
       
      </tr>
      <?php $_from = $this->_var['fenhong_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ucode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['backfee']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['from_onum']; ?></td>
      
	 <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['stardatestr']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['enddatestr']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_add_time']; ?></td>
    
        
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
 <?php if ($this->_var['fenhong_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>
           <?php else: ?>
          <?php echo $this->_var['lang']['no_fhlist']; ?>
          <?php endif; ?>


         <?php endif; ?>
         



         <?php if ($this->_var['action'] == 'upbaodan'): ?>
          <h5><span><?php echo $this->_var['lang']['label_upbaodan']; ?></span></h5>
          <div class="blank"></div>

           <?php if ($this->_var['user_id'] > 50): ?>
              <form action="user.php" method="post" enctype="multipart/form-data" name="formUpbd" >
                  <table width="100%" border="0" cellpadding="3">
                    <tr>
                      <td align="right">您当前等级为：</td>
                      <td><?php echo $this->_var['urankname']; ?>   升级时间：<?php echo $this->_var['baotime']; ?> </td>
                    </tr>
                    <tr>
                      <td align="right">您的股票：</td>
                      <td><?php echo $this->_var['shares']; ?></td>
                    </tr>
                    <tr>
                      <td align="right">升级说明：</td>
                      <td><?php echo $this->_var['baomess']; ?></td>
                    </tr>
                    <tr>
                      <td align="right">可用资金：</td>
                      <td> <?php echo $this->_var['user_money']; ?> [余额:<?php echo $this->_var['balance']; ?>+积分:<?php echo $this->_var['award_bal']; ?>]</td>
                    </tr>
                    <tr>
                      <td align="right"><?php echo $this->_var['lang']['bd_fee']; ?>：</td>
                      <td><input name="bd_fee" type="text" size="30" class="inputBg" value="<?php echo $this->_var['bd_fee']; ?>" readonly/></td>
                    </tr>
                     <tr>
                      <td>&nbsp;</td>
                      <td><input type="hidden" name="act" value="act_add_baodan" />
                        <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus" onclick="return confirm('确定购买10万元货吗，该操作无法撤销！')"/>
                      </td>
                    </tr>
                    
                  </table>
                </form>
                                
             <?php endif; ?>
             <?php if ($this->_var['user_id'] < 51): ?>            
                  <table width="100%" border="0" cellpadding="3">
                    <tr>
                      <td  > 此号不能升级商务中心:<?php echo $this->_var['user_id']; ?></td>
                    </tr>
                  </table>
             <?php endif; ?>

                    <td>&nbsp;</td> <br \>
                     <td>&nbsp;</td> <br \>
                     <td>&nbsp;</td> <br \>
     <tr align="left">
        <td  bgcolor="#ffffff">购买合伙人订单数据</td>
	 </tr>
  <table width="50%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_bordernum']; ?></td>
		<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ucode']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_totalmoney']; ?></td>
        <td  bgcolor="#ffffff">赠送股数</td>
        <td  bgcolor="#ffffff">单价(元)</td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_time']; ?></td>
      </tr>
      <?php $_from = $this->_var['baoapp_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['bordernum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ucode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['totalmoney']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['sharesnum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['unitprice']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_add_time']; ?></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    
 	<?php if ($this->_var['baoapp_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>      
     <?php endif; ?>
    
         <?php endif; ?>
         


         <?php if ($this->_var['action'] == 'in_register'): ?>
 <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
          <h5><span><?php echo $this->_var['lang']['label_in_register']; ?></span></h5>
          <div class="blank"></div>
         <?php if ($this->_var['user_rank'] == 4 || $this->_var['user_id'] < 51): ?> 
          <form action="user.php" method="post" name="formUser" onsubmit="return register();">
      <table width="100%"  border="0" align="left" cellpadding="5" cellspacing="3">
        <tr>
          <td width="25%" align="right">手机号:</td>
          <td width="65%">
          <input name="phone" id="telphone" type="text" size="25" onblur="is_registered(this.value);" class="inputBg"/>
            <span id="phone_notice" style="color:#FF0000"> *请填写手机号码。</span>
          </td>
        </tr>
        <tr>
          <td width="25%" align="right">真实姓名:</td>
          <td width="65%">
          <input name="userrname" type="text" size="25" id="userrname" class="inputBg"/>
            <span id="userrname_notice" style="color:#FF0000"> *请填写名字。</span>
          </td>
        </tr> 
<!--        
         <tr>
          <td width="25%" align="right">身份证号:</td>
          <td width="65%">
          <input name="pidno" type="text" size="25" id="pidno" class="inputBg"/>
            <span id="pidno_notice" style="color:#FF0000"> *请填写身份证号。</span>
          </td>
        </tr> 
        <tr>
          <td align="right"><?php echo $this->_var['lang']['label_email']; ?></td>
          <td>
          <input name="email" type="text" size="25" id="email" onblur="checkEmail(this.value);"  class="inputBg"/>
            <span id="email_notice" style="color:#FF0000"> *</span>
          </td>
        </tr>
-->        
        <tr>
          <td align="right"><?php echo $this->_var['lang']['label_password']; ?></td>
          <td>
          <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" class="inputBg" style="width:179px;" />
            <span style="color:#FF0000" id="password_notice"> *</span>
          </td>
        </tr>
       <tr>
          <td align="right"><?php echo $this->_var['lang']['label_confirm_password']; ?></td>
          <td>
          <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);"  class="inputBg" style="width:179px;"/>
            <span style="color:#FF0000" id="conform_password_notice"> *</span>
          </td>
        </tr>

         <tr>
          <td align="right"><?php echo $this->_var['lang']['label_recode']; ?></td>
          <td>
          <input name="recode" value="<?php echo $this->_var['recode']; ?>" type="text" size="25" id="recode" readonly  class="inputBg"/>
            <span id="recode_notice" style="color:#FF0000"> *</span>
          </td>
        </tr>
      <?php if ($this->_var['enabled_captcha']): ?>
      <tr>
      <td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
      <td><input type="text" size="8" name="captcha" class="inputBg" />
      <img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /> </td>
      </tr>
      <?php endif; ?>
        <tr style="display:none;">
          <td>&nbsp;</td>
          <td><label>
            <input name="agreement" type="checkbox" value="1" checked="checked" />
            <?php echo $this->_var['lang']['agreement']; ?></label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="left">
          <input name="act" type="hidden" value="act_register_in" >
          <input type="hidden" name="back_act" value="in_register" />
          <input name="Submit" type="submit" value="" class="us_Submit_reg">
          </td>
        </tr>
       </table>
    </form>
          <?php endif; ?>
	   <?php if ($this->_var['user_rank'] != 4 && $this->_var['user_id'] > 50): ?> 
            <table width="100%" border="0" cellpadding="3">
                    <tr>
                      <td  >只有商务中心才有资格注册新会员。 </td>
                      
                    </tr>
                    
                    
                  </table>
           <?php endif; ?> 
         <?php endif; ?>



         <?php if ($this->_var['action'] == 'myreg'): ?>
          <h5><span><?php echo $this->_var['lang']['label_myreg']; ?></span></h5>
          <div class="blank"></div>
       
         
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_name']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myrecode']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['mybaocode']; ?></td>
       
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myemail']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myurank']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myreg_time']; ?></td>
       
       
      </tr>
      <?php $_from = $this->_var['myreg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_name']; ?></td>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['recode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['baocode']; ?></td>
      
	 <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['email']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_rankname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_reg_time']; ?></td>
         
        
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
 <?php if ($this->_var['myreg_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>
           <?php else: ?>
          <?php echo $this->_var['lang']['no_record']; ?>
          <?php endif; ?>


         <?php endif; ?>
         


         <?php if ($this->_var['action'] == 'myrecom'): ?>
          <h5><span><?php echo $this->_var['lang']['label_myrecom']; ?></span></h5>
          <div class="blank"></div>
       
         
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_name']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myrecode']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['mybaocode']; ?></td>
       
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myemail']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myurank']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myreg_time']; ?></td>
       <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['operates']; ?></td>
       
      </tr>
      <?php $_from = $this->_var['myrecom_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_name']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['recode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['baocode']; ?></td>
      
	 <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['email']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_rankname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_reg_time']; ?></td>
        <td align="center" bgcolor="#ffffff"><a href="user.php?act=buy_list&uid=<?php echo $this->_var['item']['user_id']; ?>"><?php echo $this->_var['lang']['buylist']; ?></a> | <a href="user.php?act=account_list&uid=<?php echo $this->_var['item']['user_id']; ?>"><?php echo $this->_var['lang']['rewardlist']; ?></a>| <a href="user.php?act=accountjf_list&uid=<?php echo $this->_var['item']['user_id']; ?>"><?php echo $this->_var['lang']['jinbilist']; ?></a>  </td>
        
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
 <?php if ($this->_var['myrecom_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>
           <?php else: ?>
          <?php echo $this->_var['lang']['no_record']; ?>
          <?php endif; ?>


         <?php endif; ?>
         


         <?php if ($this->_var['action'] == 'buy_list'): ?>
          <h5><span><?php echo $this->_var['lang']['label_buy_list']; ?></span></h5>
          <div class="blank"></div>
          
          

  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_bordernum']; ?></td>
	<td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ucode']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
         <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_num']; ?></td>
       
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_totalmoney']; ?></td>
       
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_weekfan']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_fanzong']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_fanok']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_ifout']; ?></td>
        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_time']; ?></td>
         <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['buy_paycode']; ?></td>
      </tr>
      <?php $_from = $this->_var['buy_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['bordernum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ucode']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['buynum']; ?></td>
      
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['totalmoney']; ?></td>
       
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['weekfan']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['fanzong']; ?></td>
	 <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['fanok']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['ifoutstr']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['formated_add_time']; ?></td>
    
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['paycode']; ?></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
 <?php if ($this->_var['buy_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>
          
          <?php endif; ?>


         <?php endif; ?>
         




         
          <?php if ($this->_var['action'] == 'comment_list'): ?>
          <h5><span><?php echo $this->_var['lang']['label_comment']; ?></span></h5>
          <div class="blank"></div>
          <?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
          <div class="f_l">
          <b><?php if ($this->_var['comment']['comment_type'] == '0'): ?><?php echo $this->_var['lang']['goods_comment']; ?><?php else: ?><?php echo $this->_var['lang']['article_comment']; ?><?php endif; ?>: </b><font class="f4"><?php echo $this->_var['comment']['cmt_name']; ?></font>&nbsp;&nbsp;(<?php echo $this->_var['comment']['formated_add_time']; ?>)
          </div>
          <div class="f_r">
          <a href="user.php?act=del_cmt&amp;id=<?php echo $this->_var['comment']['comment_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_msg']; ?>')) return false;" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
          </div>
          <div class="msgBottomBorder">
          <?php echo htmlspecialchars($this->_var['comment']['content']); ?><br />
          <?php if ($this->_var['comment']['reply_content']): ?>
          <b><?php echo $this->_var['lang']['reply_comment']; ?>：</b><br />
          <?php echo $this->_var['comment']['reply_content']; ?>
           <?php endif; ?>
          </div>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <?php if ($this->_var['comment_list']): ?>
          <?php echo $this->fetch('library/pages.lbi'); ?>
          <?php else: ?>
          <?php echo $this->_var['lang']['no_comments']; ?>
          <?php endif; ?>
          <?php endif; ?>
    
    
    <?php if ($this->_var['action'] == 'tag_list'): ?>
    <h5><span><?php echo $this->_var['lang']['label_tag']; ?></span></h5>
    <div class="blank"></div>
     <?php if ($this->_var['tags']): ?>
    <?php $_from = $this->_var['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
    <a href="search.php?keywords=<?php echo urlencode($this->_var['tag']['tag_words']); ?>" class="f6"><?php echo htmlspecialchars($this->_var['tag']['tag_words']); ?></a> <a href="user.php?act=act_del_tag&amp;tag_words=<?php echo urlencode($this->_var['tag']['tag_words']); ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_drop_tag']; ?>')) return false;" title="<?php echo $this->_var['lang']['drop']; ?>"><img src="themes/ecmoban_yihaodian/images/drop.gif" alt="<?php echo $this->_var['lang']['drop']; ?>" /></a>&nbsp;&nbsp;
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php else: ?>
    <span style="margin:2px 10px; font-size:14px; line-height:36px;"><?php echo $this->_var['lang']['no_tag']; ?></span>
    <?php endif; ?>
    <?php endif; ?>
    
    
    <?php if ($this->_var['action'] == 'collection_list'): ?>
  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
    <h5><span><?php echo $this->_var['lang']['label_collection']; ?></span></h5>
    <div class="blank"></div>
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <th width="35%" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_name']; ?></th>
        <th width="30%" bgcolor="#ffffff"><?php echo $this->_var['lang']['price']; ?></th>
        <th width="35%" bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></th>
      </tr>
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
      <tr>
        <td bgcolor="#ffffff"><a href="<?php echo $this->_var['goods']['url']; ?>" class="f6"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></a></td>
        <td bgcolor="#ffffff"><?php if ($this->_var['goods']['promote_price'] != ""): ?>
          <?php echo $this->_var['lang']['promote_price']; ?><span class="goods-price"><?php echo $this->_var['goods']['promote_price']; ?></span>
          <?php else: ?>
          <?php echo $this->_var['lang']['shop_price']; ?><span class="goods-price"><?php echo $this->_var['goods']['shop_price']; ?></span>
          <?php endif; ?>        </td>
        <td align="center" bgcolor="#ffffff">
          <?php if ($this->_var['goods']['is_attention']): ?>
          <a href="javascript:if (confirm('<?php echo $this->_var['lang']['del_attention']; ?>')) location.href='user.php?act=del_attention&rec_id=<?php echo $this->_var['goods']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['no_attention']; ?></a>
          <?php else: ?>
          <a href="javascript:if (confirm('<?php echo $this->_var['lang']['add_to_attention']; ?>')) location.href='user.php?act=add_to_attention&rec_id=<?php echo $this->_var['goods']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['attention']; ?></a>
          <?php endif; ?>
           <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['lang']['add_to_cart']; ?></a> <a href="javascript:if (confirm('<?php echo $this->_var['lang']['remove_collection_confirm']; ?>')) location.href='user.php?act=delete_collection&collection_id=<?php echo $this->_var['goods']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
        </td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    <?php echo $this->fetch('library/pages.lbi'); ?>
     <div class="blank5"></div>

    <h5><span><?php echo $this->_var['lang']['label_affiliate']; ?></span></h5>
    <div class="blank"></div>
     <form name="theForm" method="post" action="">
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
    <tr>
      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['label_need_image']; ?></td>
      <td bgcolor="#ffffff">
        <select name="need_image" id="need_image" class="inputBg">
          <option value="true" selected><?php echo $this->_var['lang']['need']; ?></option>
          <option value="false"><?php echo $this->_var['lang']['need_not']; ?></option>
        </select>
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['label_goods_num']; ?></td>
      <td bgcolor="#ffffff"><input name="goods_num" type="text" id="goods_num" value="6" class="inputBg" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['label_arrange']; ?></td>
      <td bgcolor="#ffffff"><select name="arrange" id="arrange" class="inputBg">
        <option value="h" selected><?php echo $this->_var['lang']['horizontal']; ?></option>
        <option value="v"><?php echo $this->_var['lang']['verticle']; ?></option>
      </select></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['label_rows_num']; ?></td>
      <td bgcolor="#ffffff"><input name="rows_num" type="text" id="rows_num" value="1" class="inputBg" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['label_charset']; ?></td>
      <td bgcolor="#ffffff"><select name="charset" id="charset">
        <?php echo $this->html_options(array('options'=>$this->_var['lang_list'])); ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#ffffff"><input type="button" name="gen_code" value="<?php echo $this->_var['lang']['generate']; ?>" onclick="genCode()" class="bnt_blue_1" />
			</td>
  </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#ffffff"><textarea name="code" cols="80" rows="5" id="code" class="B_blue"></textarea></td>
  </tr>
  </table>
     </form>
      <script language="JavaScript">
      var elements = document.forms['theForm'].elements;
      var url = '<?php echo $this->_var['url']; ?>';
      var u   = '<?php echo $this->_var['user_id']; ?>';
      /**
       * 生成代码
       */
      function genCode()
      {
          // 检查输入
          if (isNaN(parseInt(elements['goods_num'].value)))
          {
              alert('<?php echo $this->_var['lang']['goods_num_must_be_int']; ?>');
              return;
          }
          if (elements['goods_num'].value < 1)
          {
              alert('<?php echo $this->_var['lang']['goods_num_must_over_0']; ?>');
              return;
          }
          if (isNaN(parseInt(elements['rows_num'].value)))
          {
              alert('<?php echo $this->_var['lang']['rows_num_must_be_int']; ?>');
              return;
          }
          if (elements['rows_num'].value < 1)
          {
              alert('<?php echo $this->_var['lang']['rows_num_must_over_0']; ?>');
              return;
          }

          // 生成代码
          var code = '\<script src=\"' + url + 'goods_script.php?';
          code += 'need_image=' + elements['need_image'].value + '&';
          code += 'goods_num=' + elements['goods_num'].value + '&';
          code += 'arrange=' + elements['arrange'].value + '&';
          code += 'rows_num=' + elements['rows_num'].value + '&';
          code += 'charset=' + elements['charset'].value + '&u=' + u;
          code += '\"\>\</script\>';
          elements['code'].value = code;
          elements['code'].select();
          if (Browser.isIE)
          {
              window.clipboardData.setData("Text",code);
          }
      }
	var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
  var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
  var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
  var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
  </script>
  <?php endif; ?>
    
    
    <?php if ($this->_var['action'] == 'booking_list'): ?>
    <h5><span><?php echo $this->_var['lang']['label_booking']; ?></span></h5>
    <div class="blank"></div>
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td width="20%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_goods_name']; ?></td>
        <td width="10%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_amount']; ?></td>
        <td width="20%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_time']; ?></td>
        <td width="35%" bgcolor="#ffffff"><?php echo $this->_var['lang']['process_desc']; ?></td>
        <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
      </tr>
      <?php $_from = $this->_var['booking_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
        <td align="left" bgcolor="#ffffff"><a href="<?php echo $this->_var['item']['url']; ?>" target="_blank" class="f6"><?php echo $this->_var['item']['goods_name']; ?></a></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['goods_number']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['booking_time']; ?></td>
        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['dispose_note']; ?></td>
        <td align="center" bgcolor="#ffffff"><a href="javascript:if (confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) location.href='user.php?act=act_del_booking&id=<?php echo $this->_var['item']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['drop']; ?></a> </td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    <?php endif; ?>
    <div class="blank5"></div>
   
  <?php if ($this->_var['action'] == 'add_booking'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['booking_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
    <h5><span><?php echo $this->_var['lang']['add']; ?><?php echo $this->_var['lang']['label_booking']; ?></span></h5>
    <div class="blank"></div>
     <form action="user.php" method="post" name="formBooking" onsubmit="return addBooking();">
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_goods_name']; ?></td>
        <td bgcolor="#ffffff"><?php echo $this->_var['info']['goods_name']; ?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_amount']; ?>:</td>
        <td bgcolor="#ffffff"><input name="number" type="text" value="<?php echo $this->_var['info']['goods_number']; ?>" class="inputBg" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['describe']; ?>:</td>
        <td bgcolor="#ffffff"><textarea name="desc" cols="50" rows="5" wrap="virtual" class="B_blue"><?php echo htmlspecialchars($this->_var['info']['goods_desc']); ?></textarea>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['contact_username']; ?>:</td>
        <td bgcolor="#ffffff"><input name="linkman" type="text" value="<?php echo htmlspecialchars($this->_var['info']['consignee']); ?>" size="25"  class="inputBg"/>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>:</td>
        <td bgcolor="#ffffff"><input name="email" type="text" value="<?php echo htmlspecialchars($this->_var['info']['email']); ?>" size="25" class="inputBg" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['contact_phone']; ?>:</td>
        <td bgcolor="#ffffff"><input name="tel" type="text" value="<?php echo htmlspecialchars($this->_var['info']['tel']); ?>" size="25" class="inputBg" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#ffffff">&nbsp;</td>
        <td bgcolor="#ffffff"><input name="act" type="hidden" value="act_add_booking" />
          <input name="id" type="hidden" value="<?php echo $this->_var['info']['id']; ?>" />
          <input name="rec_id" type="hidden" value="<?php echo $this->_var['info']['rec_id']; ?>" />
          <input type="submit" name="submit" class="submit" value="<?php echo $this->_var['lang']['submit_booking_goods']; ?>" />
          <input type="reset" name="reset" class="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
        </td>
      </tr>
    </table>
     </form>
    <?php endif; ?>
    
    <?php if ($this->_var['affiliate']['on'] == 1): ?>
     <?php if ($this->_var['action'] == 'affiliate'): ?>
      <?php if (! $this->_var['goodsid'] || $this->_var['goodsid'] == 0): ?>
      <h5><span><?php echo $this->_var['lang']['affiliate_detail']; ?></span></h5>
      <div class="blank"></div>
     <?php echo $this->_var['affiliate_intro']; ?>
    <?php if ($this->_var['affiliate']['config']['separate_by'] == 0): ?>
    
    <div class="blank"></div>
    <h5><span><a name="myrecommend"><?php echo $this->_var['lang']['affiliate_member']; ?></a></span></h5>
    <div class="blank"></div>
   <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_num']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['level_point']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['level_money']; ?></td>
    </tr>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val');$this->_foreach['affdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['affdb']['total'] > 0):
    foreach ($_from AS $this->_var['level'] => $this->_var['val']):
        $this->_foreach['affdb']['iteration']++;
?>
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['level']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['num']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['point']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['money']; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

<?php else: ?>


<?php endif; ?>

<div class="blank"></div>
<h5><span>分成规则</span></h5>
<div class="blank"></div>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_money']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_point']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_mode']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_status']; ?></td>
    </tr>
    <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['logdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['logdb']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['logdb']['iteration']++;
?>
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['order_sn']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['money']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['point']; ?></td>
      <td bgcolor="#ffffff"><?php if ($this->_var['val']['separate_type'] == 1 || $this->_var['val']['separate_type'] === 0): ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['val']['separate_type']]; ?><?php else: ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['affiliate_type']]; ?><?php endif; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_stats'][$this->_var['val']['is_separate']]; ?></td>
    </tr>
    <?php endforeach; else: ?>
<tr><td colspan="5" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['no_records']; ?></td>
</tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['logdb']): ?>
    <tr>
    <td colspan="5" bgcolor="#ffffff">
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  <div id="pager"> <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
    <select name="page" id="page" onchange="selectPage(this)">
    <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
    </select>
    <input type="hidden" name="act" value="affiliate" />
  </div>
</form>
    </td>
    </tr>
    <?php endif; ?>
  </table>
 <script type="text/javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script>

<div class="blank"></div>
<h5><span><?php echo $this->_var['lang']['affiliate_code']; ?></span></h5>
<div class="blank"></div>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
<tr>
<td width="30%" bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" class="f6"><?php echo $this->_var['shopname']; ?></a></td>
<td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="&lt;a href=&quot;<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>&quot; target=&quot;_blank&quot;&gt;<?php echo $this->_var['shopname']; ?>&lt;/a&gt;" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_webcode']; ?></td>
</tr>
<tr>
<td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" title="<?php echo $this->_var['shopname']; ?>"  class="f6"><img src="<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>" /></a></td>
<td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="&lt;a href=&quot;<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>&quot; target=&quot;_blank&quot; title=&quot;<?php echo $this->_var['shopname']; ?>&quot;&gt;&lt;img src=&quot;<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>&quot; /&gt;&lt;/a&gt;" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_webcode']; ?></td>
</tr>
<tr>
<td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" class="f6"><?php echo $this->_var['shopname']; ?></a></td>
<td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="[url=<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>]<?php echo $this->_var['shopname']; ?>[/url]" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_bbscode']; ?></td>
</tr>
<tr>
<td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" title="<?php echo $this->_var['shopname']; ?>" class="f6"><img src="<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>" /></a></td>
<td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="[url=<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>][img]<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>[/img][/url]" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_bbscode']; ?></td>
</tr>
</table>

        <?php else: ?>
        
        <style type="text/css">
        .types a{text-decoration:none; color:#006bd0;}
        </style>
    <h5><span><?php echo $this->_var['lang']['affiliate_code']; ?></span></h5>
    <div class="blank"></div>
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_view']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_code']; ?></td>
    </tr>
    <?php $_from = $this->_var['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['types']['iteration']++;
?>
    <tr align="center">
      <td bgcolor="#ffffff" class="types"><script src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>"></script></td>      <td bgcolor="#ffffff">javascript <?php echo $this->_var['lang']['affiliate_codetype']; ?><br>
        <textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>" style="border:1px solid #ccc;"><script src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>"></script></textarea>[<a href="#" titleTo Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
<br>iframe <?php echo $this->_var['lang']['affiliate_codetype']; ?><br><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_iframe"  style="border:1px solid #ccc;"><iframe width="250" height="270" src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>&display_mode=iframe" frameborder="0" scrolling="no"></iframe></textarea>[<a href="#" titleTo Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_iframe').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');" class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
<br /><?php echo $this->_var['lang']['bbs']; ?>UBB <?php echo $this->_var['lang']['affiliate_codetype']; ?><br /><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_ubb"  style="border:1px solid #ccc;"><?php if ($this->_var['val'] != 5): ?>[url=<?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>][img]<?php if ($this->_var['val'] < 3): ?><?php echo $this->_var['goods']['goods_thumb']; ?><?php else: ?><?php echo $this->_var['goods']['goods_img']; ?><?php endif; ?>[/img][/url]<?php endif; ?>

[url=<?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>][b]<?php echo $this->_var['goods']['goods_name']; ?>[/b][/url]
<?php if ($this->_var['val'] != 1 && $this->_var['val'] != 3): ?>[s]<?php echo $this->_var['goods']['market_price']; ?>[/s]<?php endif; ?> [color=red]<?php echo $this->_var['goods']['shop_price']; ?>[/color]</textarea>[<a href="#" titleTo Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_ubb').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
<?php if ($this->_var['val'] == 5): ?><br /><?php echo $this->_var['lang']['im_code']; ?> <?php echo $this->_var['lang']['affiliate_codetype']; ?><br /><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_txt"  style="border:1px solid #ccc;"><?php echo $this->_var['lang']['show_good_to_you']; ?> <?php echo $this->_var['goods']['goods_name']; ?>

<?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?></textarea>[<a href="#" titleTo Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_txt').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]<?php endif; ?></td>
</tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
<script language="Javascript">
copyToClipboard = function(txt)
{
 if(window.clipboardData)
 {
    window.clipboardData.clearData();
    window.clipboardData.setData("Text", txt);
 }
 else if(navigator.userAgent.indexOf("Opera") != -1)
 {
   //暂时无方法:-(
 }
 else if (window.netscape)
 {
  try
  {
    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  }
  catch (e)
  {
    alert("<?php echo $this->_var['lang']['firefox_copy_alert']; ?>");
    return false;
  }
  var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
  if (!clip)
    return;
  var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
  if (!trans)
    return;
  trans.addDataFlavor('text/unicode');
  var str = new Object();
  var len = new Object();
  var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
  var copytext = txt;
  str.data = copytext;
  trans.setTransferData("text/unicode",str,copytext.length*2);
  var clipid = Components.interfaces.nsIClipboard;
  if (!clip)
  return false;
  clip.setData(trans,null,clipid.kGlobalClipboard);
 }
}
                </script>
            
            <?php endif; ?>
        <?php endif; ?>

    <?php endif; ?>

  

 
    <?php if ($this->_var['affiliate']['on'] == 1): ?>
   <?php if ($this->_var['action'] == 'afftree'): ?>
  
<table><tr><td>我的树形图</td></tr> </table>
<div class="dtree" style="padding-left:50px;">
 	<p><a href="javascript: d.openAll();">展开所有</a> | <a href="javascript: d.closeAll();">折叠所有</a></p>
   

  <script type="text/javascript">
		<!--
 		d = new dTree('d');
 		d.add(<?php echo $this->_var['my']['user_id']; ?>,-1,'<?php echo $this->_var['my']['user_name']; ?>(<?php echo $this->_var['my']['user_realname']; ?>)--<?php echo $this->_var['my']['user_rankname']; ?>');
 		<?php $_from = $this->_var['li']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['li'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['li']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['li']['iteration']++;
?>
               d.add(<?php echo $this->_var['val']['user_id']; ?>,<?php echo $this->_var['val']['reid']; ?>,'<?php echo $this->_var['val']['phone']; ?>(<?php echo $this->_var['val']['user_name']; ?>)--<?php echo $this->_var['val']['user_rankname']; ?>');
		 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		document.write(d);

		//-->
	</script>
  
  
  
   <?php endif; ?>
   <?php endif; ?>

   <?php if ($this->_var['action'] == 'stock_trade'): ?>
		<table><tr><td>股票期权回购系统</td></tr> </table>
<form name="formResetpayPassword" id="formResetPassword" action="user.php?act=reset_pay_pwd" method="post"  >
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
   <tr>
      <td width="76%" align="left" bgcolor="#FFFFFF">
      		切换股票走势图
            <span style="background-color:#ACD6FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="changeStockDate(1)"    id="get_code1" >一周</span>
            <span style="background-color:#ACD6FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="changeStockDate(2)"    id="get_code2" >一月</span>
            <span style="background-color:#ACD6FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="changeStockDate(3)"    id="get_code3" >三月</span>
      </td>
   </tr>
  </table>

  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">  
   <tr>
      <td width="50%" align="center"  style="background-color:#B9B9FF;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" size=12 id="imgtitle" name="imgtitle">一周股票走势图</td>
   </tr>
  </table>

  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
   <tr>
      <td>
  		<img src="" id="imgname" name="imgname" />
	  </td>
   </tr>
  </table>
  
   <table width="50%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
   <tr>
      <td width="76%" align="left" bgcolor="#FFFFFF">
 	        股票数量:<?php echo $this->_var['sharesnum']; ?>  平均单价:<?php echo $this->_var['unitprice']; ?> 当前单价:<?php echo $this->_var['curprice']; ?>  当前市值:<?php echo $this->_var['sharesamt']; ?>  <br />     					 
 	        可以流通股票数量:<?php echo $this->_var['sharesfree']; ?> <br />
            挂单股数<input name="stocknum" id="stocknum" value="" /> 单价 <input name="stockprice" id="stockprice" value="" /> <span style="background-color:#DDDDDD;display:-moz-inline-box;display:inline-block; border:1px solid #ccc;font-size:16px;margin-left:10px;border-radius:5px;" onclick="salestocksfunc()"    id="salestocks" >挂单</span>
      </td>
   </tr>
  </table>
  
<script type="text/javascript">
	 var pathName=window.document.location.pathname;
     var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);
    // console.log(document.getElementById("imgname").src);
     document.getElementById("imgname").src=projectName+"/images/stocks/week.png";
</script> 
 
</form>

     <tr align="left">
        <td  bgcolor="#ffffff">购单数据</td>
	 </tr>
  <table width="50%" border="0" cellpadding="4" cellspacing="1" bgcolor="#dddddd">
      <tr align="center">
        <td  bgcolor="#ffffff">挂单时间</td>
		<td  bgcolor="#ffffff">股数</td>
       	<td  bgcolor="#ffffff">挂单价</td>
        <td  bgcolor="#ffffff">总价</td>
      </tr>
      <?php $_from = $this->_var['stocks_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <tr>
       <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['stocksdate']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['buynum']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['price']; ?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     </table>


   <?php endif; ?>

  


      </div>
     </div>
    </div>
  </div>
  
</div>
<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>

<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";


</script>




</html>