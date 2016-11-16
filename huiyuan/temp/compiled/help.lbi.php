<?php if ($this->_var['helps']): ?>
<div class="ft_service_link clearfix" data-tpa="YHD_GLOBAl_FOOTER_HELP">
  <div id="bottomHelpLinkId" class="ft_help_list clearfix"> 
    <?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'help_cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['help_cat']):
        $this->_foreach['foo']['iteration']++;
?>
    <dl>
      <dt><?php echo $this->_var['help_cat']['cat_name']; ?></dt>
      <?php $_from = $this->_var['help_cat']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      <dd><a href="<?php echo $this->_var['item']['url']; ?>" target="_blank"><?php echo $this->_var['item']['short_title']; ?></a></dd>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </dl>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
  </div>
</div>
<?php endif; ?>