<div class="userMenu">
<a href="user.php" <?php if ($this->_var['action'] == 'default'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u1.gif"> <?php echo $this->_var['lang']['label_welcome']; ?></a>
<a href="user.php?act=profile"<?php if ($this->_var['action'] == 'profile'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u2.gif"> <?php echo $this->_var['lang']['label_profile']; ?></a>
<a href="flow.php?step=cart"><img src="themes/ecmoban_yihaodian/images/u103.gif">  购物车 </a>
<a href="user.php?act=address_list"<?php if ($this->_var['action'] == 'address_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u4.gif"> <?php echo $this->_var['lang']['label_address']; ?></a>
<a href="user.php?act=order_list"<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_detail'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u3.gif"> <?php echo $this->_var['lang']['label_order']; ?></a>
<a href="user.php?act=collection_list"<?php if ($this->_var['action'] == 'collection_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u5.gif"> <?php echo $this->_var['lang']['label_collection']; ?></a>
<a href="user.php?act=message_list"<?php if ($this->_var['action'] == 'message_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u6.gif"> <?php echo $this->_var['lang']['label_message']; ?></a>
<a href="user.php?act=tag_list"<?php if ($this->_var['action'] == 'tag_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u7.gif"> <?php echo $this->_var['lang']['label_tag']; ?></a>
<a href="user.php?act=booking_list"<?php if ($this->_var['action'] == 'booking_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u8.gif"> <?php echo $this->_var['lang']['label_booking']; ?></a>

<!--
<a href="user.php?act=bonus"<?php if ($this->_var['action'] == 'bonus'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u9.gif"> <?php echo $this->_var['lang']['label_bonus']; ?></a>
-->

<?php if ($this->_var['affiliate']['on'] == 99): ?>
<a href="user.php?act=affiliate"<?php if ($this->_var['action'] == 'affiliate'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u108.gif"> <?php echo $this->_var['lang']['label_affiliate']; ?></a>
<?php endif; ?>
<a href="user.php?act=afftree"<?php if ($this->_var['action'] == 'afftree'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u104.gif"> <?php echo $this->_var['lang']['label_afftree']; ?></a>
<a href="user.php?act=comment_list"<?php if ($this->_var['action'] == 'comment_list'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u11.gif"> <?php echo $this->_var['lang']['label_comment']; ?></a>
<a href="user.php?act=upvip"<?php if ($this->_var['action'] == 'upvip'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u103.gif"> <?php echo $this->_var['lang']['label_upvip']; ?></a>
<a href="user.php?act=fhlist"<?php if ($this->_var['action'] == 'fhlist'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u107.gif"> <?php echo $this->_var['lang']['label_fhlist']; ?></a>
<a href="user.php?act=upbaodan"<?php if ($this->_var['action'] == 'upbaodan'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u102.gif"> <?php echo $this->_var['lang']['label_upbaodan']; ?></a>
<?php if ($this->_var['user_rank'] == 4): ?>
<a href="user.php?act=stock_trade"<?php if ($this->_var['action'] == 'stocks'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/stocks.jpg"> <?php echo $this->_var['lang']['label_shares']; ?></a>
<a href="user.php?act=in_register"<?php if ($this->_var['action'] == 'in_register'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u101.gif"> <?php echo $this->_var['lang']['label_in_register']; ?></a>
<?php endif; ?>
<!--
<a href="user.php?act=myreg"<?php if ($this->_var['action'] == 'myreg'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u108.gif"> <?php echo $this->_var['lang']['label_myreg']; ?></a>
<a href="user.php?act=myrecom"<?php if ($this->_var['action'] == 'myrecom'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u108.gif"> <?php echo $this->_var['lang']['label_myrecom']; ?></a>
-->
<!--<a href="user.php?act=group_buy"><?php echo $this->_var['lang']['label_group_buy']; ?></a>-->
<a href="user.php?act=track_packages"<?php if ($this->_var['action'] == 'track_packages'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u12.gif"> <?php echo $this->_var['lang']['label_track_packages']; ?></a>
<a href="user.php?act=account_log"<?php if ($this->_var['action'] == 'account_log'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u106.gif"> <?php echo $this->_var['lang']['label_user_surplus']; ?></a>
<?php if ($this->_var['show_transform_points']): ?>
<a href="user.php?act=transform_points"<?php if ($this->_var['action'] == 'transform_points'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u14.gif"> <?php echo $this->_var['lang']['label_transform_points']; ?></a>
<?php endif; ?>
<a href="user.php?act=safe_center"<?php if ($this->_var['action'] == 'safe_center'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u6.gif"> <?php echo $this->_var['lang']['safe_center']; ?></a>
<a href="user.php?act=true_info"<?php if ($this->_var['action'] == 'true_info'): ?>class="curs"<?php endif; ?>><img src="themes/ecmoban_yihaodian/images/u9.gif">实名认证</a>
<a href="user.php?act=logout" style="background:none; text-align:right; margin-right:10px;"><img src="themes/ecmoban_yihaodian/images/bnt_sign.gif"></a>



</div>