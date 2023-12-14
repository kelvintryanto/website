<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url(); ?>/user/update" method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field(); ?>
        <input type="hidden" name="profilLama" value="<?= $profile_picture; ?>">
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control " id="email" value="<?= $email; ?>" disabled>
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $fullname; ?>">
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <label for="profilepicture" class="col-sm-2 col-form-label">Profile Picture</label>
            <div class="col-sm-3">
                <img src="<?= base_url() . '/assets/img/profile/' . $profile_picture; ?>" class="img-thumbnail img-preview">
            </div>
            <div class="mb-3 row col-sm-7">
                <div class="mb-3">
                    <input class="form-control" type="file" id="profilepicture" multiple name="profilepicture" onchange="previewImg()">
                </div>
            </div>
        </div>
        <div class="mb-3 row col-md-7">
            <button type="submit" class="btn btn-primary mt-5">Update Profile</button>
        </div>
    </form>
</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>