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
        <legend>SDN 區域網路管理系統</legend>
		<p align=right><a href="<?php echo $this->config->base_url('netManager/admin_login');?>">管理員登入</a></p>
		<h5>欲使用網路，請先登入</h5>
        <label for="account"><b>Account</b></label>
        <input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
        <br />

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" style="width:30.769em" placeholder="" value="<?php echo set_value('password'); ?>"/>
        <br />

        <button type="button" name="button" class="btn" onclick="this.form.submit();">Login</button>
        <br/>

    </fieldset>
    </form>
<?php } else { ?>
    <fieldset>
        <legend>SDN 區域網路管理系統</legend>
		<p align=right><a href="<?php echo $this->config->base_url('netManager/admin_login');?>">管理員登入</a></p>
    </fieldset>
    目前已經是登入狀態<br/>
    登入IP: <?php echo $ip."<br/>"; ?>
    剩餘時間：約 <?php echo $remain_time." 分鐘<br/><br/>"; ?> 
    <button type="button" name="button" class="btn" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/logout');?>'">Logout</button>
<?php } ?>
