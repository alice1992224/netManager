<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/index') ?>">Portal</a></li>
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">Manager</a></li>
                    <li class="active"><a href="<?= base_url('netManager/login') ?>">Login/Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('netManager/login_account') ?>
<fieldset>
        <legend>Login Infomation</legend>


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

