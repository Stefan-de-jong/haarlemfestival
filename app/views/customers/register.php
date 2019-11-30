<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="vertical-center">
    <div class="container">
        <div class="card" id="login">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>Register account</h2>
                    </div>
                    <div class="col text-right"><a href="<?php echo URLROOT;?>/customers/login">Back to login</a></div>
                </div>
                <form action="<?php echo URLROOT;?>/customers/register" method="post">
                    <div class="row">
                        <div class="col-md-3"><label for="firstname" class="col-form-label">First name:
                                <sup>*</sup></label>
                        </div>
                        <div class="col"><input type="text" name="firstname"
                                class="form-control <?php echo (!empty($data['firstname_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['firstname'];?>"><span
                                class="invalid-feedback"><?php echo $data['firstname_error']; ?></span></div>

                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="lastname" class="col-form-label">Last name:
                                <sup>*</sup></label>
                        </div>
                        <div class="col"><input type="text" name="lastname"
                                class="form-control <?php echo (!empty($data['lastname_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['lastname'];?>"><span
                                class="invalid-feedback"><?php echo $data['lastname_error']; ?></span></div>

                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="email" class="col-form-label">Email: <sup>*</sup></label>
                        </div>
                        <div class="col"><input type="text" name="email"
                                class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['email'];?>"><span
                                class="invalid-feedback"><?php echo $data['email_error']; ?></span></div>

                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="password" class="col-form-label">Password:
                                <sup>*</sup></label>
                        </div>
                        <div class="col"><input type="password" name="password"
                                class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['password'];?>">
                            <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="confirm_password" class="col-form-label">Confirm password:
                                <sup>*</sup></label></div>
                        <div class="col"><input type="password" name="confirm_password"
                                class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '' ;?>"
                                value="<?php echo $data['confirm_password'];?>"><span
                                class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span></div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 text-center mx-auto">
                            <input type="submit" value="Register" class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>