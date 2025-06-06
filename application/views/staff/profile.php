<?php if ($this->session->flashdata('flash')) : ?>
    <div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php $this->session->unset_userdata('flash') ?>
<?php endif; ?>

<div class="dashboard-wrapper">
    <div class="bg-info text-center">
        <div class="text-white pt-3"><h5>Your Profile</h5></div>
        <hr class="mb-0">
        <img src="<?= base_url('images/'); ?><?= $this->session->userdata('image'); ?>" class="shadow">
        <table class="table bg-white">
            <tr>
                <th class="text-right th-profile-custom"><b>Name</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('name'); ?></td>
            </tr>
            <tr>
                <th class="text-right th-profile-custom"><b>Address</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('address'); ?></td>
            </tr>
            <tr>
                <th class="text-right th-profile-custom"><b>City</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('city'); ?></td>
            </tr>
            <tr>
                <th class="text-right th-profile-custom"><b>Mobile Phone</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('phone'); ?></td>
            </tr>
            <tr>
                <th class="text-right th-profile-custom"><b>Email Address</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('email'); ?></td>
            </tr>
            <tr>
                <th class="text-right th-profile-custom"><b>Username</b></th>
                <td class="text-left td-profile-custom"><?= $this->session->userdata('username'); ?></td>
            </tr>
        </table>
    </div>
</div>