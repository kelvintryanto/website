<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Add User</a>
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
            <table class="table">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">User</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user_list as $ul) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img style="height: 2rem; width: 2rem;" class="img-profile rounded-circle" src="<?= base_url() . '/assets/img/profile/' . $ul['profile_picture']; ?>"></td>
                            <td><?= $ul['fullname']; ?></td>
                            <td>
                                <select class="form-select roleselect" id="roleselect" name="roleselect">
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id']; ?>" <?= ($ul['role_id'] == $r['id']) ? 'selected' : ''; ?> data-role="<?= $r['id']; ?>" data-user="<?= $ul['role_id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>