<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/add_ip') ?>">IP Setting</a></li>
                    <li><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
                    <li class="active"><a href="<?= base_url('netManager/vertify') ?>">Vertify User</a></li>
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
        <td><strong><?php echo 'Vertify User'; ?></strong></td>
</tr>
<?php foreach($query as $row): ?>
<tr>
    <td><?php echo $row->username; ?></td>
    <td><?php echo $row->account; ?></td>
    <td><?php echo $row->office; ?></td>
    <td><?php echo $row->email; ?></td>
    <td><button class="btn btn-primary" type="button" <?php if( $row->verified == 1) {echo 'disabled="disabled"';}?> onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/vertify_user').'/'.$row->id;?>'">Vertify</button></td>
</tr>
<?php endforeach; ?>
</table>

