<div class="container">
    <h2>Create a New Account</h2>

    <!-- Status message -->
    <?php
    if(!empty($success_msg)){
        echo '<p class="status-msg success">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="status-msg error">'.$error_msg.'</p>';
    }
    ?>

    <?php
    if(isset($_SESSION['msg'])){
        echo '<div class="alert alert-danger text-center">'.$_SESSION['msg'].'</div>';
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
                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="uname">Last Name:</label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
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
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
        <div class="mx-auto my-5">
            <p>Already have an account? <a href="<?php echo base_url('/users/login'); ?>">Login here</a></p>
        </div>
    </div>
</div>
