<?php
    echo form_open('netManager/login_account')
?>
    <fieldset>
        <legend>SDN Local Area Network Managment System</legend>
		<h6>Invalid IP: <?php echo $ip?></h6>
		<p align=right><a href="<?php echo $this->config->base_url('netManager/admin_login');?>">Admin login</a></p>
		<h5>Please login if you want to use the Internet.</h5>
        <label for="account"><b>Account</b></label>
        <input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
        <br />

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" style="width:30.769em" placeholder="" value="<?php echo set_value('password'); ?>"/>
        <br />

        <button type="submit" name="button" class="btn" onclick="this.form.submit();">Login</button>
        <button type="button" name="button" class="btn" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/signup');?>'">Sign up</button>
        <br/>

    </fieldset>
    </form>
</br>
