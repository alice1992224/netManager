<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li class="active"><a href="<?= base_url('netManager/add_ip') ?>">Add IP</a></li>
                    <li><a href="<?= base_url('netManager/remove_ip') ?>">Remove IP</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
                    <li><a href="<?= base_url('netManager/admin_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
echo form_open('netManager/set_ip')
?>
	<fieldset>
		<label for="account"><b>Account</b></label>
		<input type="text" name="account" style="width:30.769em" placeholder="" value="<?php echo set_value('account'); ?>"/>
		<br />

		<label for="ip"><b>IP</b></label>
		<input type="text" name="ip" style="width:30.769em" placeholder="" value="<?php echo set_value('ip'); ?>"/>
		<br />

		<button type="button" name="button" class="btn" onclick="this.form.submit();">Add</button>
		<br/>

	</fieldset>
</form>

