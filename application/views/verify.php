<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/add_ip') ?>">IP Setting</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
                    <li class="active"><a href="<?= base_url('netManager/verify') ?>">Verify User</a></li>
                    <li><a href="<?= base_url('netManager/admin_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-hover" id="header" cellpadding="5">
<tr>
        <td><strong><?php echo 'Username'; ?></strong></td>
        <td><strong><?php echo 'Account'; ?></strong></td>
        <td><strong><?php echo 'Office'; ?></strong></td>
        <td><strong><?php echo 'Email'; ?></strong></td>
        <td><strong><?php echo 'Verify User'; ?></strong></td>
</tr>
<?php foreach($query as $row): ?>
<tr>
    <td><?php echo $row->username; ?></td>
    <td><?php echo $row->account; ?></td>
    <td><?php echo $row->office; ?></td>
    <td><?php echo $row->email; ?></td>
    <?php if($row->verified == 0) { ?>

    <td><button class="btn btn-primary" type="button"
        onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/verify_user').'/'.$row->id;?>'">
        Verify</button></td>
    <?php }else{ ?>
    <td><button class="btn btn-success" type="button" disabled="disabled"
        onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/verify_user').'/'.$row->id;?>'">
        Verified</button></td>
    <?php } ?>

</tr>
<?php endforeach; ?>
</table>

