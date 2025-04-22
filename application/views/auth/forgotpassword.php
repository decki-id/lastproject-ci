<?php if ($this->session->flashdata('flash-error')) : ?>
	<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>
	<?php $this->session->unset_userdata('flash-error') ?>
<?php elseif ($this->session->flashdata('flash-success')) : ?>
	<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('flash-success'); ?>"></div>
	<?php $this->session->unset_userdata('flash-success') ?>
<?php endif; ?>

<div class="position-fixed w-100 h-100 d-flex justify-content-center align-items-center" id="panel">
	<div class="card w-40 w-mod">
		<div class="card-body text-center">
			<img src="<?= base_url('images/'); ?>logo-ci.png" width="100" />
			<h4 class="card-title mt-2 mb-1">Forgot Password</h4>
			<form method="post" action="<?= base_url('auth/forgotpassword/'); ?>">
				<div class="form-group">
					<label for="email">
						<small>Enter your email address below and we will send you a link to reset your password.</small>
					</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email address" required autofocus />
				</div>
				<div class="row">
					<div class="col col-mod"><button type="submit" class="btn btn-primary btn-block">Reset My Password</button></div>
					<div class="col"><a href="<?= base_url(); ?>" class="col btn btn-secondary">Back to Login Page</a></div>
				</div>
			</form>
		</div>
	</div>
</div>