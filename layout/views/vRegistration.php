<form role="form" method="post" action="" autocomplete="off">
    <h2>Please Sign Up</h2>
    <p>Already a member? <a href='login.php'>Login</a></p>
    <hr>

    <?php require(__DIR__.'/../error.php'); ?>

    <p class="form-group"><input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1"></p>
    <p class="form-group"><input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2"></p>
    <section class="row">
        <section class="col-xs-6 col-sm-6 col-md-6">
            <p class="form-group"><input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3"></p>
        </section>
        <section class="col-xs-6 col-sm-6 col-md-6">
            <p class="form-group"><input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4"></p>
        </section>
    </section>
    <section class="row">
        <p class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></p>
    </section>
</form>