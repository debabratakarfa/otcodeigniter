<div class="login container">
	<div class="login-bottom">
		<?php
		if (isset($_SESSION['msg']))
		{
			echo '<div class="alert alert-success text-center">' . $_SESSION['msg'] . '</div>';
		}
		elseif (isset($_SESSION['error-msg']))
		{
			echo '<div class="alert alert-danger text-center">' . $_SESSION['error-msg'] . '</div>';
		}
		?>
		<form action="<?php echo base_url('users/authenticate'); ?>" method="post">
			<div class="form-group">
				<label for="uname">Username:</label>
				<input type="text" class="form-control" id="email_address" placeholder="Enter username" name="email_address" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
            <div class="form-group form-check">
                <div class="g-recaptcha" data-sitekey=<?php echo getenv('GOOOGLE_CAPTCHA_SITE_KEY'); ?>></div>
            </div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<div class="mx-auto my-5">
			<p>Don't have an account? <a href="<?php echo base_url('/users/signup'); ?>">Sign up here</a></p>
		</div>
	</div>
</div>
