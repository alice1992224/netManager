<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/add_ip') ?>">Add IP</a></li>
                    <li><a href="<?= base_url('netManager/remove_ip') ?>">Remove IP</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/admin_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-hover" id="header" cellpadding="5">
<tr>
        <td><strong><?php echo 'Account'; ?></strong></td>
        <td><strong><?php echo 'IP'; ?></strong></td>
</tr>
<?php foreach ($query as $k => $v) {//print_r($query);//foreach($query as $key => $value): ?>
<tr>
    <td><?php echo $k; ?></td>
    <td><?php echo $v; ?></td>
</tr>
<?php } ?>
</table>

