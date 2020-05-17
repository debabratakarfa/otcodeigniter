<div class="login container">
    <h1><a href="login" class="text-primary">Admin Access </a></h1>
    <div class="login-bottom">
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
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
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="mx-auto my-5">
            <p>Don't have an account? <a href="<?php echo base_url('/users/signup'); ?>">Sign up here</a></p>
        </div>
    </div>
</div>
