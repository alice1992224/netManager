<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?= base_url('netManager/ip_manager') ?>">IP Manager</a></li>
                    <li><a href="<?= base_url('netManager/add_ip') ?>">Add IP</a></li>
                    <li><a href="<?= base_url('netManager/remove_ip') ?>">Remove IP</a></li>
                    <li class="active"><a href="<?= base_url('netManager/manager') ?>">User List</a></li>
                    <li><a href="<?= base_url('netManager/blacklist') ?>">Black List</a></li>
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
        <td><strong><?php echo 'Online'; ?></strong></td>
        <td><strong><?php echo 'Last Time'; ?></strong></td>
        <td><strong><?php echo 'Enable/Disable'; ?></strong></td>
</tr>
<?php foreach($query as $row): ?>
<tr>
    <td><?php echo $row->account; ?></td>
    <td><?php echo $row->ip; ?></td>
    <td><?php echo $row->status; ?></td>
    <td><?php echo $row->time; ?></td>
<?php if($row->status === '1'){ ?>
    <td><button class="btn btn-primary" type="button" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/change_network_status')."/".$row->ip;?>'">Disable Network</button></td>
<?php } else { ?>
    <td><button class="btn btn-primary" type="button" onclick="javascript:location.href='<?php echo $this->config->base_url('netManager/change_network_status')."/".$row->ip;?>'">Enable Network</button></td>
<?php }?>
</tr>
<?php endforeach; ?>
</table>

