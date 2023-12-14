<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
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
            <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $i++; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td style="text-align: center;">
                                <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="#editMenuModal<?= $m['id']; ?>">edit</a>
                                <!-- Modal Edit Submenu -->
                                <div class="modal fade" id="editMenuModal<?= $m['id']; ?>" tabindex="-1" aria-labelledby="editMenuModal<?= $m['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMenuModal">Edit Menu</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url() . '/menu/update/' . $m['id']; ?>" method="post">
                                                <input type="hidden" name="id" id="id" value="<?= $m['id']; ?>">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="menu" class="form-control" name="menu" placeholder="Type menu name here..." value="<?= $m['menu']; ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete Menu -->
                                <a class="badge rounded-pill bg-danger" <?= ($m['id'] == 1) ? 'hidden' : ''; ?> data-toggle="modal" data-target="#deleteMenuModal<?= $m['id']; ?>" href="">delete</a>
                                <div class="modal fade" id="deleteMenuModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModal<?= $m['id']; ?>" aria-hidden="true">
                                    <form action="<?= base_url() . '/menu/deleteMenu/' . $m['id']; ?>" method="post">
                                        <?php csrf_field(); ?>
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteMenuModal<?= $m['id']; ?>">Delete?</h5>
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
                                </div>
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
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url() . '/menu/addmenu'; ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="menu" class="form-control" name="menu" placeholder="Type menu name here..." autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>