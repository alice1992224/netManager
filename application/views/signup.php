<?php
echo form_open('netManager/set_signup')
?>
<fieldset>
	<legend>Sign up</legend>

	<br />
	
	<label for="username"><b>Name</b></label> 
	<input type="text" name="username" style="width:30.769em" placeholder="" value="<?php echo set_value('username'); ?>"/>
	<font color="ff0000"><?php echo form_error('username'); ?></font>
	<br />

	<label for="account"><b>Account</b></label> 
	<input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
	<font color="ff0000"><?php echo form_error('account'); ?></font>
	<br />

	<label for="password"><b>Password</b></label> 
	<input type="text" name="password" style="width:30.769em" placeholder="" value="<?php echo set_value('password'); ?>"/>
	<font color="ff0000"><?php echo form_error('password'); ?></font>
	<br />

	<label for="office"><b>Office</b></label> 
	<select name="office" style="width:20.769em">
		<option value="employee" <?php echo set_select('office', 'employee', TRUE); ?> >Employee</option>
		<option value="manager" <?php echo set_select('office', 'manager'); ?> >Manager</option>
	</select>
	<br/>

	<label for="email"><b>Email Address</b></label> 
	<input type="text" name="email" style="width:30.769em" placeholder="" value="<?php echo set_value('email'); ?>"/>
	<font color="ff0000"><?php echo form_error('email'); ?></font>
	<br />


	<button type="button" name="button" class="btn" onclick="this.form.submit();">Apply</button>
	<button type="button" name="cancel" class="btn" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/index');?>'">Cancel</button>
	<br/>

</fieldset>
</form>
