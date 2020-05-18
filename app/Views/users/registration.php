<div class="container">
	<h2>Create a New Account</h2>
	<?php
	if (isset($_SESSION['msg']))
	{
		echo '<div class="alert alert-danger text-center">' . $_SESSION['msg'] . '</div>';
	}
	elseif (isset($_SESSION['error-msg']))
	{
		echo '<div class="alert alert-danger text-center">' . $_SESSION['error-msg'] . '</div>';
	}
	?>

	<!-- Registration form -->
	<div class="login">
		<form action="<?php echo base_url('users/signup/add_user');?>" method="post" >
			<div class="form-group">
				<label for="uname">Email:</label>
				<input type="text" class="form-control" id="email" placeholder="Enter Email ID" name="email_address" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="uname">First Name:</label>
				<input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" minlength="4" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="uname">Last Name:</label>
				<input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" minlength="4" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password" minlength="4" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group form-check">
				<div class="g-recaptcha" data-sitekey=<?php echo getenv('GOOOGLE_CAPTCHA_SITE_KEY'); ?>></div>
			</div>
			<button type="submit" class="btn btn-primary">Sign up</button>
		</form>
		<div class="mx-auto my-5">
			<p>Already have an account? <a href="<?php echo base_url('/users/login'); ?>">Login here</a></p>
		</div>
	</div>
</div>
