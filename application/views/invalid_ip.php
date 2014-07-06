<?php 
    echo form_open('netManager/login_account')
?>
    <fieldset>
        <legend>SDN 區域網路管理系統</legend>
		<h6>Invalid IP: <?php echo $ip?></h6>
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
</br>
