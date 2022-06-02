<form role="form" method="post" action="" autocomplete="off">
    <h2>Please Login</h2>
    <p><a href='./'>Back to home page</a></p>
    <hr>

    <?php require('layout/error.php'); ?>

    <p class="form-group"><input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1"></p>
    <p class="form-group"><input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3"></p>
    <section class="row">
        <p class="col-xs-9 col-sm-9 col-md-9"><a href='reset.php'>Forgot your Password?</a></p>
    </section>
    <hr>
    <section class="row">
        <p class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></p>
    </section>
</form>