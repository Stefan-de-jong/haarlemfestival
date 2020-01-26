<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="vertical-center">
    <div class="container">
        <div class="card" id="login">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <?php flash('register_succes'); ?>
                        <?php flash('reset_sent_succes'); ?>
                        <?php flash('pwreset_succes'); ?>
                        <h2>Login</h2>
                    </div>
                </div>
                <form action="<?php echo URLROOT;?>/customers/login" method="post">
                    <div class="row">
                        <div class="col-md-3"><label for="email" class="col-form-label">Email: *</label></div>
                        <div class="col"><input type="text" name="email"
                                class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['email'];?>">
                            <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="password" class="col-form-label">Password: *</label></div>
                        <div class="col"><input type="password" name="password"
                                class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['password'];?>">
                            <span class="invalid-feedback"><?php echo $data['password_error']; ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col text-left"><a href="#">Forgot
                                password?</a></div>
                        <div class="col text-right"><span>No account? Create one&nbsp;</span><a
                                href="<?php echo URLROOT;?>/customers/register">here.</a></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-center mx-auto">
                            <input type="submit" value="Login" class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>