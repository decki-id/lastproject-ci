<div class="position-fixed w-100 h-100 d-flex justify-content-center align-items-center" id="panel">
	<div class="card w-25 w-cp-mod">
		<div class="card-body">
			<div class="text-center">
				<img src="<?= base_url('images/'); ?>logo-ci.png" width="100">
				<h4 class="card-title mt-2 mb-1">Change Password for:</h4>
			</div>
			<form method="post" action="<?= base_url('auth/changepassword/'); ?>">
				<div class="form-group"><h5 class="text-center"><?= $this->session->userdata('reset_email'); ?></h5></div>
				<div class="form-group">
					<input type="password" class="form-control" id="password1" name="password1" placeholder="Enter your new password" required autofocus>
					<?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password" required>
					<?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
				</div>
				<div class="form-group"><button type="submit" class="btn btn-primary btn-block">Change My Password</button></div>
			</form>
			<hr>
			<div class="text-center"><a href="<?= base_url(); ?>"><small>&larr; Back to Login Page</small></a></div>
		</div>
	</div>
</div>