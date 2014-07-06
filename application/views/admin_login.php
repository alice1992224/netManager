<?php

	echo form_open('netManager/admin_login_account')
?>
	<fieldset>
		<legend>Admin Login Infomation</legend>
<?php
if( $message != ""){
	echo $message;
}
?>

		<label for="account"><b>Account</b></label>
		<input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
		<br />

		<label for="password"><b>Password</b></label>
		<input type="password" name="password" style="width:30.769em" placeholder="" value="<?php echo set_value('password'); ?>"/>
		<br />

		<button type="submit" name="button" class="btn" onclick="this.form.submit();">Login</button>
		<br/>

	</fieldset>
	</form>
