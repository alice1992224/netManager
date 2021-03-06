<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/add_ip') ?>">IP Setting</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li class="active"><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
                    <li><a href="<?= base_url('netManager/verify') ?>">Verify User</a></li>
                    <li><a href="<?= base_url('netManager/admin_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-hover" id="header" cellpadding="3">
<tr>
        <td><strong><?php echo 'Website'; ?></strong></td>
        <td><strong><?php echo 'IP'; ?></strong></td>
        <td><strong><?php echo 'Enable/Disable'; ?></strong></td>
</tr>
<?php foreach($query as $row): ?>
<tr>
    <td><?php echo $row->app_name; ?></td>
    <td><?php echo $row->ip; ?></td>
    <td><button class="btn btn-danger" type="button" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/remove_blacklist')."/".$row->ip;?>'">Remove</button></td>
</tr>
<?php endforeach; ?>
<?php
echo form_open('netManager/add_blacklist')
?>
<tr>
    <td><input type="text" name="app_name" style="width:100%" placeholder="" value="<?php echo set_value('app_name'); ?>"/></td>
    <td><input type="text" name="ip" style="width:100%" placeholder="" value="<?php echo set_value('ip'); ?>"/><?php echo form_error('ip');?></td>
    <td><button type="submit" name="submit" class="btn btn-primary" style="width:35%"onclick="this.form.submit();">Add</button></td>
</tr>
</form>
</table>
