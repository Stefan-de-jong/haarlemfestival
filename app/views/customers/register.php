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
                <div class="row">
                    <div class="col-md-3"><label class="col-form-label">Email: *</label></div>
                    <div class="col"><input type="text" class="form-control" value="<?php echo $data['email'];?>"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label class="col-form-label">Password: *</label></div>
                    <div class="col"><input type="text" class="form-control" value="<?php echo $data['password'];?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label class="col-form-label">Confirm password: *</label></div>
                    <div class="col"><input type="text" class="form-control"
                            value="<?php echo $data['confirm_password'];?>"></div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center mx-auto">
                        <input type="submit" value="Register" class="btn btn-primary btn-block btn-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>