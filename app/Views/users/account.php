<div class="container">
    <h2>Welcome <?= esc($first_name); ?>!</h2>
    <a href="<?php echo base_url('users/logout'); ?>" class="logout">Logout</a>
    <div class="regisFrm">
        <p><b>Name: </b><?= esc($first_name) . ' ' . esc($last_name); ?></p>
        <p><b>Email: </b><?= esc($email_address); ?></p>
    </div>
</div>
