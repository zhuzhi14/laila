<!-- $Id -->
<?php echo $this->fetch('pageheader.htm'); ?>
<form name="theForm" method="get" action="order.php" onsubmit="return check()">
<div class="list-div">
<table>
  <tr>
    <th><?php echo $this->_var['lang']['label_refund_amount']; ?></th>
    <td><?php echo $this->_var['formated_refund_amount']; ?></td>
  </tr>
  <tr>
    <th width="120"><?php echo $this->_var['lang']['label_handle_refund']; ?></th>
    <td><p><?php if (! $this->_var['anonymous']): ?><label><input type="radio" name="refund" value="1" /><?php echo $this->_var['lang']['return_user_money']; ?></label><br><?php endif; ?>
      <label><input type="radio" name="refund" value="2" /><?php echo $this->_var['lang']['create_user_account']; ?></label><br>
      <label><input name="refund" type="radio" value="3" />
      <?php echo $this->_var['lang']['not_handle']; ?></label><br>
    </p></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_refund_note']; ?></th>
    <td><textarea name="refund_note" cols="60" rows="3" id="refund_note"><?php echo $this->_var['refund_note']; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2">
      <div align="center">
        <input type="submit" name="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
        <input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>" />
        <input type="hidden" name="func" value="refund" />
        <input type="hidden" name="act" value="process" />
        <input type="hidden" name="refund_amount" value="<?php echo $this->_var['refund_amount']; ?>" />
        </div></td>
  </tr>
</table>
</div>
</form>
<script language="JavaScript">

  function check()
  {
    var selected = false;
    for (var i = 0; i < document.forms['theForm'].elements.length; i++)
    {
      ele = document.forms['theForm'].elements[i];
      if (ele.tagName == 'INPUT' && ele.name == 'refund' && ele.checked)
      {
        selected = true;
        break;
      }
    }
    if (!selected)
    {
      alert(pls_select_refund);
      return false;
    }
    return true;
  }

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>