<div class="container">
    <?php
    if(isset($_SESSION['msg'])){
        echo '<div class="alert alert-success text-center">' . $_SESSION['msg'] . '</div>';
    } elseif (isset($_SESSION['error-msg'])){
        echo '<div class="alert alert-danger text-center">' . $_SESSION['error-msg'] . '</div>';
    }
    ?>

    <h2>Welcome <?= esc($first_name); ?>!</h2>
</div>
