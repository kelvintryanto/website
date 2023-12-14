<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-12">

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New SubMenu</a>
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
            <?php if (validation_list_errors()) : ?>
                <?php foreach (validation_errors() as $err) : ?>
                    <div class="alert alert-danger alert-dismissible fade show col-md-4" role="alert">
                        <?= $err; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Menu Title</th>
                        <th scope="col">Submenu Title</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">is_active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($submenu as $sm) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $i++; ?></th>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td style="text-align: center;"><?= $sm['is_active']; ?></td>
                            <td style="text-align: center;">
                                <!-- edit submenu -->
                                <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="#editSubmenuModal<?= $sm['id']; ?>">edit</a>
                                <!-- Modal Edit Submenu -->
                                <div class="modal fade" id="editSubmenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="editSubmenuModal<?= $sm['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSubmenuModal<?= $sm['id']; ?>">Add New SubMenu</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <form action="<?= base_url() . '/menu/updateSubmenu/' . $sm['id']; ?>" method="post">
                                                <?php csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" aria-label="Default select example" name="menu" id="menu">
                                                            <option value="">Open this select menu</option>
                                                            <!-- logikanya adalah jika  -->
                                                            <?php foreach ($menu as $m) : ?>
                                                                <option value="<?= $m['id']; ?>" <?= ($sm['menu_id'] == $m['id']) ? 'selected' : '' ?>><?= $m['menu']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="title" class="form-control" name="title" placeholder="Type Submenu name here..." value="<?= $sm['title']; ?>">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="url" class="form-control" name="url" placeholder="Type url here..." value="<?= $sm['url']; ?>">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="icon" class="form-control" name="icon" placeholder="Type icon here..." value="<?= $sm['icon']; ?>">
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="checkbox" id="isactive" name="isactive" value="1" <?= $sm['is_active'] == 1 ? 'checked' : '' ?>>
                                                        <label for="isactive" class="mt-2 ml-2"> is active?</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Menu</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- delete submenu -->
                                <a class="badge rounded-pill bg-danger" data-toggle="modal" data-target="#deleteSubmenuModal<?= $sm['id']; ?>" href="">delete</a>
                                <!-- Modal Delete Submenu-->
                                <div class="modal fade" id="deleteSubmenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubmenuModal<?= $sm['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteSubmenuModal<?= $sm['id']; ?>">Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url() . '/menu/deleteSubmenu/' . $sm['id']; ?>" method="post">
                                                <?php csrf_field(); ?>
                                                <div class="modal-body">Are you sure want to delete this Submenu?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-primary" type="submit">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

<!-- modal add new submenu -->
<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?= base_url() . '/menu/addsubmenu'; ?>" method="post">
                <?= csrf_field(); ?>

                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="menu" id="menu">
                            <option value="">Open this select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>" <?= old('menu') == $m['id'] ? 'selected' : '' ?>><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="submenu" class="form-control" name="submenu" placeholder="Type Submenu name here..." value="<?= old('submenu'); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="url" class="form-control" name="url" placeholder="Type url here..." value="<?= old('url'); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="icon" class="form-control" name="icon" placeholder="Type icon here..." value="<?= old('icon'); ?>">
                    </div>
                    <div class="input-group">
                        <input type="checkbox" id="isactive" name="isactive" value="1" checked>
                        <label for="isactive" class="mt-2 ml-2"> is active?</label>
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