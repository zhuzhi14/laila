<?php if ($this->_var['user_info']): ?>
<span class="hd_hi">欢迎您回来,<?php echo $this->_var['user_info']['userrealname']; ?></span>&nbsp;<a class="blue_link" href="user.php">我的账户</a>  | <a class="blue_link" href="user.php?act=logout"><?php echo $this->_var['lang']['user_logout']; ?></a>
<?php else: ?>
<span class="hd_hi">欢迎您,</span> 请<a class="blue_link" href="user.php?act=login" id="global_top_bar_loginLink">&nbsp;登录&nbsp;</a>/<a class="blue_link" href="user.php?act=register">&nbsp;注册</a> 
<?php endif; ?>