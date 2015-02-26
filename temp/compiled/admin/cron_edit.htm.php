<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js')); ?>
<form action="cron.php" method="post" name="form">
<div class="main-div">
<table cellspacing="1" cellpadding="3" width="100%">
  <tr>
    <th width="30%"></th>
    <th width="70%"></th>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['cron_name']; ?></td>
    <td>
      <input name="cron_name" type="text" value="<?php echo htmlspecialchars($this->_var['cron']['cron_name']); ?>" size="40" readonly="readonly" style="background:#dddddd" />
    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['cron_desc']; ?></td>
    <td><textarea name="cron_desc" cols="80" rows="5" style="" readonly="readonly" style="background:#dddddd" ><?php echo htmlspecialchars($this->_var['cron']['cron_desc']); ?></textarea></td>
  </tr>
  <?php $_from = $this->_var['cron']['cron_config']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'config');if (count($_from)):
    foreach ($_from AS $this->_var['config']):
?>
  <tr>
    <td class="label"><?php echo $this->_var['config']['label']; ?></td>
    <!-- <?php if ($this->_var['config']['type'] == "text"): ?> -->
    <td><input name="cfg_value[]" type="<?php echo $this->_var['config']['type']; ?>" value="<?php echo $this->_var['config']['value']; ?>" size="40" /></td>
    <!-- <?php elseif ($this->_var['config']['type'] == "textarea"): ?> -->
    <td><textarea name="cfg_value[]" cols="80" rows="5"><?php echo $this->_var['config']['value']; ?></textarea></td>
    <!-- <?php elseif ($this->_var['config']['type'] == "select"): ?> -->
    <td><select name="cfg_value[]"><?php echo $this->html_options(array('options'=>$this->_var['config']['range'],'selected'=>$this->_var['config']['value'])); ?></select></td>
    <!-- <?php endif; ?> -->
    <input name="cfg_name[]" type="hidden" value="<?php echo $this->_var['config']['name']; ?>" />
    <input name="cfg_type[]" type="hidden" value="<?php echo $this->_var['config']['type']; ?>" />
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['cron_time']; ?></td>
    <td>
      <input type="radio" name="ttype" id="ttype_day" value="day" onClick="dotype('day');" /><?php echo $this->_var['lang']['cron_month']; ?>
      <select name="cron_day" id="cron_day" disabled="true"><?php echo $this->html_options(array('options'=>$this->_var['days'],'selected'=>$this->_var['cron']['cronday'])); ?></select>&nbsp;<?php echo $this->_var['lang']['cron_day']; ?>&nbsp;
      <input type="radio" name="ttype" id="ttype_week" value="week" onClick="dotype('week');"/><?php echo $this->_var['lang']['cron_week']; ?>
      <select name="cron_week" id="cron_week" disabled="true"><?php echo $this->html_options(array('options'=>$this->_var['week'],'selected'=>$this->_var['cron']['cronweek'])); ?></select>
      <input type="radio" name="ttype" id="ttype_unlimit" value="unlimit" onClick="dotype('unlimit')"><?php echo $this->_var['lang']['cron_unlimit']; ?>
      <br />
      <?php echo $this->_var['lang']['cron_thatday']; ?><select name="cron_hour"><?php echo $this->html_options(array('options'=>$this->_var['hours'],'selected'=>$this->_var['cron']['cronhour'])); ?></select>&nbsp;<?php echo $this->_var['lang']['cron_hour']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td class="label"><a href="javascript:showNotice('notice_minute');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['cron_minute']; ?></td>
    <td><input name="cron_minute" type="text" value="<?php echo $this->_var['cron']['cronminute']; ?>" size="40" />
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
<span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="notice_minute"><?php echo $this->_var['lang']['notice_minute']; ?></span></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['cron_run_once']; ?></td>
    <td><input name="cron_run_once" type="checkbox" value="1" <?php echo $this->_var['cron']['autoclose']; ?> /></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['cron_advance']; ?></td>
    <td><label><input name="show_advance" id="show_advance" type="checkbox" value="1" onClick="show();" /><?php echo $this->_var['lang']['cron_show_advance']; ?></label></td>
  </tr>
  <tr id="advance_1">
    <td class="label"><a href="javascript:showNotice('notice_alow_ip');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['cron_allow_ip']; ?></td>
    <td><input name="allow_ip" type="text" value="<?php echo $this->_var['cron']['allow_ip']; ?>" size="40" />
    </td>
  </tr>
  <tr id="advance_2">
    <td></td>
    <td>
<span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="notice_alow_ip"><?php echo $this->_var['lang']['notice_alow_ip']; ?></span></td>
  </tr>
  <tr id="advance_3">
    <td class="label"><a href="javascript:showNotice('notice_alow_files');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['cron_alow_files']; ?></td>
    <td>
    <?php $_from = $this->_var['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('page_list', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['page_list'] => $this->_var['list']):
?>
    <div style="width:200px;float:left;">
    <label><input type="checkbox" name="alow_files[]" value="<?php echo $this->_var['page_list']; ?>.php" id="<?php echo $this->_var['page_list']; ?>" class="checkbox" <?php if ($this->_var['list'] == 1): ?> checked="true" <?php endif; ?> />
    <?php echo $this->_var['lang']['page'][$this->_var['page_list']]; ?></label>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </td>
  </tr>
  <tr id="advance_4">
    <td></td>
    <td>
<span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="notice_alow_files"><?php echo $this->_var['lang']['notice_alow_files']; ?></span></td>
  </tr>
  <tr align="center">
    <td colspan="2">
      <input type="hidden"  name="cron_id"       value="<?php echo $this->_var['cron']['cron_id']; ?>" />
      <input type="hidden"  name="step"       value="2" />
      <input type="hidden"  name="act"       value="<?php echo $this->_var['cron']['cron_act']; ?>" />
      <input type="hidden"  name="cron_code"     value="<?php echo $this->_var['cron']['cron_code']; ?>" />
      <input type="submit" class="button" name="Submit"       value="<?php echo $this->_var['lang']['button_submit']; ?>" />
      <input type="reset" class="button"  name="Reset"        value="<?php echo $this->_var['lang']['button_reset']; ?>" />
    </td>
  </tr>
</table>
</div>
</form>
<script type="Text/Javascript" language="JavaScript">
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
function dotype(type)
{
    var a,b;
    if(type=='unlimit')
    {
      document.getElementById('cron_day').disabled = true;
      document.getElementById('cron_week').disabled = true;
      document.getElementById('ttype_unlimit').checked = true;
    }
    else if(type == 'day')
    {
      document.getElementById('cron_day').disabled = false;
      document.getElementById('cron_week').disabled = true;
      document.getElementById('ttype_day').checked = true;
    }
    else if(type == 'week')
    {
      document.getElementById('cron_day').disabled = true;
      document.getElementById('cron_week').disabled = false;
      document.getElementById('ttype_week').checked = true;
    }
}
function show()
{
    if(document.form.show_advance.checked)
    {
        document.getElementById('advance_1').style.display="";
        document.getElementById('advance_2').style.display="";
        document.getElementById('advance_3').style.display="";
        document.getElementById('advance_4').style.display="";
    }
    else
    {
        document.getElementById('advance_1').style.display="none";
        document.getElementById('advance_2').style.display="none";
        document.getElementById('advance_3').style.display="none";
        document.getElementById('advance_4').style.display="none";
    }
}

<?php if ($this->_var['cron']['cronday'] > 0): ?>
dotype('day');
<?php elseif ($this->_var['cron']['cronweek'] > 0): ?>
dotype('week');
<?php else: ?>
dotype('unlimit');
<?php endif; ?>
        document.getElementById('advance_1').style.display="none";
        document.getElementById('advance_2').style.display="none";
        document.getElementById('advance_3').style.display="none";
        document.getElementById('advance_4').style.display="none";
//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>