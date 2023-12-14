<?= $this->extend('layout/auth_template'); ?>

<?= $this->section('content'); ?>

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        <!-- form masuk ke method save -->
                        <form action="save" class="user needs-validated" method="post" novalidate>
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?>" id=" fullname" name="fullname" placeholder="Full Name" value="<?= old('fullname'); ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('fullname'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email Address" value="<?= old('email'); ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('password'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user <?= (validation_show_error('confirmpassword')) ? 'is-invalid' : ''; ?>" id="confirmpassword" name="confirmpassword" placeholder="Repeat Password">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('confirmpassword'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Register with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                        </a>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="/">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>