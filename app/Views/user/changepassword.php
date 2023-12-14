<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h3 class="mb-3">Change Password</h3>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan-danger')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan-danger'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url(); ?>/user/updatepassword" class="needs-validated" method="post" novalidate>
        <?= csrf_field(); ?>
        <div class="mb-3 row col-md-7">
            <label for="currentpassword" class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control <?= (validation_show_error('currentpassword')) ? 'is-invalid' : ''; ?>" id="currentpassword" name="currentpassword">
                <div class="invalid-feedback">
                    <?= validation_show_error('currentpassword'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <label for="password" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" name="password" id="password">
                <div class="invalid-feedback">
                    <?= validation_show_error('password'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <label for="repeatpassword" class="col-sm-3 col-form-label">Repeat Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control <?= (validation_show_error('repeatpassword')) ? 'is-invalid' : ''; ?>" name="repeatpassword" id="repeatpassword">
                <div class="invalid-feedback">
                    <?= validation_show_error('repeatpassword'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <button type="submit" class="btn btn-primary mt-5">Change Password</button>
        </div>
    </form>
</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>