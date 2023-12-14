<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->section('content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-6">

                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
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
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $r) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $r['role']; ?></td>
                                <td>
                                    <a class="badge rounded-pill bg-success" href="<?= base_url() . '/admin/roleAccess/' . $r['id']; ?>">access</a>
                                    <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="#editMenuModal">edit</a>
                                    <!-- Modal Edit Submenu -->
                                    <!-- <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMenuModal">Edit Menu</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" id="id" value="">
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="menu" class="form-control" name="menu" placeholder="Type menu name here..." value="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- delete Menu -->
                                    <a class="badge rounded-pill bg-danger" data-toggle="modal" data-target="#deleteMenuModal" href="">delete</a>

                                    <!-- <div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModal" aria-hidden="true">
                                        <form action="" method="post">
                                            <?php csrf_field(); ?>
                                            <input type="hidden" name="_method" value="delete">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteMenuModal">Delete?</h5>
                                                        <button class=" close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Are you sure want to delete this Menu?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                                        <button class="btn btn-primary" type="submit">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- modal add new menu -->
    <!-- Modal -->
    <div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url() . '/admin/addrole'; ?>" method="post">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" id="role" class="form-control" name="role" placeholder="Type role name here...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>