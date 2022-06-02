<form role="form" method="post" action="" autocomplete="off">
    <h2>Reset Password</h2>
    <p><a href='login.php'>Back to login page</a></p>
    <hr>

    <?php require(__DIR__.'/../error.php'); ?>

    <p class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
    </p>

    <hr>
    <section class="row">
        <p class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Sent Reset Link" class="btn btn-primary btn-block btn-lg" tabindex="2"></p>
    </section>
</form>