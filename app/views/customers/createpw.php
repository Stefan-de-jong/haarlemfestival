<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="vertical-center">
    <div class="container">
        <div class="card" id="login">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>New password</h2>
                    </div>
                </div>
                <form action="<?php echo URLROOT;?>/customers/createnewpw" method="post">
                    <input type="hidden" name="selector" value="<?php echo $data['selector']; ?>">
                    <input type="hidden" name="validator" value="<?php echo $data['validator']; ?>">

                    <div class="row">
                        <div class="col-md-3"><label for="password" class="col-form-label">Password: *</label></div>
                        <div class="col"><input type="password" name="password"
                                class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['password'];?>">
                            <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><label for="confirm_password" class="col-form-label">Confirm password:
                                *</label></div>
                        <div class="col"><input type="password" name="confirm_password"
                                class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['confirm_password'];?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 text-center mx-auto">
                            <input type="submit" name="reset-password-submit" value="Reset password"
                                class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>