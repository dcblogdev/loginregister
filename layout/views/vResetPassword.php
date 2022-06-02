<form role="form" method="post" action="" autocomplete="off">
    <h2>Change Password</h2>
    <hr>

    <?php require('layout/error.php'); ?>

    <section class="row">
        <section class="col-xs-6 col-sm-6 col-md-6">
            <p class="form-group"><input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="1"></p>
        </section>
        <section class="col-xs-6 col-sm-6 col-md-6">
            <p class="form-group"><input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="1"></p>
        </section>
    </section>
    <hr>
    <section class="row">
        <p class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Change Password" class="btn btn-primary btn-block btn-lg" tabindex="3"></p>
    </section>
</form>