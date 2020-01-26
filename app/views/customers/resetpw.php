<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="vertical-center">
    <div class="container">
        <div class="card" id="login">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>Reset your password</h2>
                    </div>
                </div>
                <form action="<?php echo URLROOT;?>/customers/forgotpassword" method="post">
                    <div class="row">
                        <div class="col-md-3"><label for="email" class="col-form-label">Email: *</label></div>
                        <div class="col"><input type="text" name="email"
                                class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['email'];?>">
                            <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-center mx-auto">
                            <input type="submit" name="reset-request-submit" value="Request password reset"
                                class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>