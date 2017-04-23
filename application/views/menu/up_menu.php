<div class="container">
    <div class="row">
        <ul class="nav nav-pills">
            <li role="presentation"><a href="#" id="profileLink">Profile</a></li>
            <?php if($data['userType'] == 'admin'):?><li role="presentation"><a href="#" onclick="$('#inviteModal').modal()">Invite</a></li><?php endif;?>
            <?php if($data['userType'] == 'admin'):?><li role="presentation"><a href="#" onclick="openManageUsers()">Manage Users</a></li><?php endif;?>
            <li role="presentation"><a href="<?php echo base_url()?>auth/logout/">Logout</a></li>
        </ul>
    </div>
</div>