<!--<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?= base_url('netManager/index') ?>">Portal</a></li>
				    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">Manager</a></li>
                    <li><a href="<?= base_url('netManager/login') ?>">Login/Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>-->

<?php

if( $online === FALSE ){
    echo form_open('netManager/login_account')
?>
    <fieldset>
        <legend>SDN Local Area Network Managment System</legend>
		<p align=right><a href="<?php echo $this->config->base_url('netManager/admin_login');?>">Admin login</a></p>
		<h5>Please login if you want to use the Internet.</h5>
        <label for="account"><b>Account</b></label>
        <input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
        <br />

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" style="width:30.769em" placeholder="" value="<?php echo set_value('password'); ?>"/>
        <br />

        <button type="submit" name="button" class="btn" onclick="this.form.submit();" style="margin-right:10px">Login</button>
        <button type="button" name="button" class="btn" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/signup');?>'">Sign up</button>
        <br/>

    </fieldset>
    </form>
<?php } else { ?>
    <fieldset>
        <legend>SDN Local Area Network Managment System</legend>
		<p align=right><a href="<?php echo $this->config->base_url('netManager/admin_login');?>">Admin login</a></p>
    </fieldset>
    Please login if you want to use the Internet.<br/>
    Login IP: <?php echo $ip."<br/>"; ?>
    Time remains:  <?php echo $remain_time." min.<br/><br/>"; ?>
    <button type="button" name="button" class="btn" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/logout');?>'">Logout</button>
<?php } ?>
