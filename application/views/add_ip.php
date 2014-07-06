<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li class="active"><a href="<?= base_url('netManager/add_ip') ?>">IP Setting</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
                    <li><a href="<?= base_url('netManager/vertify') ?>">Vertify User</a></li>
                    <li><a href="<?= base_url('netManager/admin_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
echo form_open('netManager/set_ip')
?>

<br>
<legend><strong>Add IP</strong></legend>

<table>
	<fieldset>
		<font size="4"><b>Account&nbsp</b></font>
        <select name="account">
        <?php foreach($account as $row): ?>
            <option value="<?php echo $row->account; ?>"><?php echo $row->account; ?></option>
        <?php endforeach; ?>
        </select>
		<br />

        <font size="4"><b>IP&nbsp</b></font>
        <select name="ip">
        <?php foreach($add_ip as $row): ?>
            <option value="<?php echo $row->ip; ?>"><?php echo $row->ip; ?></option>
        <?php endforeach; ?>
        </select>
		<br />

		<button type="button" name="button" class="btn" onclick="this.form.submit();">Add</button>
		<br/>

	</fieldset>
</form>

<br>
<legend><strong>Remove IP</strong></legend>

<?php
echo form_open('netManager/delete_ip')
?>
	<fieldset>
		<font size="4"><b>Account&nbsp</b></font>
        <select name="account">
        <?php foreach($account as $row): ?>
            <option value="<?php echo $row->account ?>"><?php echo $row->account; ?></option>
        <?php endforeach; ?>
        </select>

		<br />

        <font size="4"><b>IP&nbsp</b></font>
        <select name="ip">
        <?php foreach($del_ip as $row): ?>
            <option value="<?php echo $row->ip ?>"><?php echo $row->ip; ?></option>
        <?php endforeach; ?>
        </select>
		<br />
    
		<button type="button" name="button" class="btn" onclick="this.form.submit();">Delete</button>
		<br/>

	</fieldset>
</form>
