<?php if ($this->session->flashdata('flash-error')) : ?>
	<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>
	<?php $this->session->unset_userdata('flash-error') ?>
<?php elseif ($this->session->flashdata('flash-success')) : ?>
	<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('flash-success'); ?>"></div>
	<?php $this->session->unset_userdata('flash-success') ?>
<?php elseif ($this->session->flashdata('flash')) : ?>
	<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php $this->session->unset_userdata('flash') ?>
<?php endif; ?>

<!-- <div class="position-fixed w-100 h-100" id="panel">
	<div id="login-panel">
		<div class="text-center">
			<img src="<?= base_url('images/'); ?>logo-ci.png" width="100" />
			<h4>Helpdesk Ticketing System</h4>
		</div>
		<form method="post" action="<?= base_url('auth/'); ?>">
			<div class="form-group row">
				<label for="username" class="col-sm-2 col-form-label ml-1">Username</label>
				<div class="col-sm-9 ml-4">
					<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" required autofocus>
				</div>
			</div>
			<div class="form-group row">
				<label for="password" class="col-sm-2 col-form-label ml-1">Password</label>
				<div class="col-sm-9 ml-4">
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Log In</button>
		</form>
		<hr>
		<div class="text-center">
			<a href="<?= base_url('auth/forgotpassword/'); ?>"><small>Forgot Password?</small></a>
		</div>
	</div>
</div> -->

<div class="position-fixed w-100 h-100 d-flex justify-content-center align-items-center" id="panel">
	<div class="card w-50 w-mod">
		<div class="card-body">
			<div class="text-center">
				<img class="text-center" src="<?= base_url('images/'); ?>logo-ci.png" width="100" />
				<h4 class="card-title mt-2">Helpdesk Ticketing System</h4>
			</div>
			<hr>
			<div class="container px-5 pb-2">
				<form method="post" action="<?= base_url('auth/'); ?>">
					<div class="form-group row pb-mod">
						<label for="username" class="col-sm-4 col-form-label l-pt-mod">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" required autofocus>
						</div>
					</div>
					<div class="form-group row pt-mod">
						<label for="password" class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
					</div>
					<div class="row">
						<div class="col col-mb-mod"><button type="submit" class="btn btn-primary btn-block">Log In</button></div>
						<div class="col"><a href="<?= base_url(); ?>" class="col btn btn-success">Sign Up</a></div>
					</div>
				</form>
			</div>
			<hr>
			<div class="text-center">
				<a href="<?= base_url('auth/forgotpassword/'); ?>"><small>Forgot Password?</small></a>
			</div>
		</div>
	</div>
</div>