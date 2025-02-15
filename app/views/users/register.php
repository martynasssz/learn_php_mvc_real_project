<?php require APPROOT . '/views/inc/header.php'; ?>
	<div class="row">
		<div class="col-md-6 mx-auto">  <!-- mx-auto put everything in a center -->
			<div class="card card-body bg-light mt-5">
				<h2>Create An Account</h2>
				<p>Please fill this form for register</p>
				<form action="<?php echo URLROOT; ?>/users/register" method="post">
					<div class="form-group">
						<label for="name">Name: <sup>*</sup></label>
						<input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>"><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['name_err']; ?></span><!-- we want display error and don't keep box red-->
					</div>

					<div class="form-group">
						<label for="email">Email: <sup>*</sup></label>
						<input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>"><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['email_err']; ?></span><!-- we want display error and don't keep box red-->
					</div>

					<div class="form-group">
						<label for="name">Password: <sup>*</sup></label>
						<input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>"><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['password_err']; ?></span><!-- we want display error and don't keep box red-->
					
					</div>
					<div class="form-group">
						<label for="confirm_password">Confirm Password: <sup>*</sup></label>
						<input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>"><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span><!-- we want display error and don't keep box red-->
					</div>

					<div class="row">
						<div class="col">
							<input type="submit" value="Register" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account Login</a>
						</div>
						
					</div>
					
				</form>
			</div>
		</div>
	</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>