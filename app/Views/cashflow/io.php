<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (validation_list_errors()) : ?>
        <?php foreach (validation_errors() as $err) : ?>
            <div class="alert alert-danger alert-dismissible fade show col-md-4" role="alert">
                <?= $err; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="row row-cols-xl-2">
        <!-- income -->
        <div class="col">
            <div>
                <h3>Income: <?= uang($totalincome); ?></h3>
            </div>
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#newIncomeModal">Add Income</button>
            <?php if (session()->getFlashdata('pesan-income')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan-income'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan-danger-income')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan-danger-income'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <table class="table table-bordered border-primary table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody style="overflow-y: auto;">
                    <?php $x = 1; ?>
                    <?php foreach ($income as $i) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $x++; ?></th>
                            <td><?= $i['keterangan']; ?></td>
                            <td style="text-align: right"><?= uang($i['nominal']); ?></td>
                            <td><?= $i['category']; ?></td>
                            <td style="text-align: center;">
                                <button class="badge rounded-pill bg-warning text-dark">detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- outcome -->
        <div class="col">
            <div>
                <h3>Outcome: <?= uang($totaloutcome); ?></h3>
            </div>
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#newOutcomeModal">Add Outcome</button>
            <?php if (session()->getFlashdata('pesan-outcome')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan-outcome'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan-danger-outcome')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan-danger-outcome'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <table class="table table-bordered border-primary table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x = 1; ?>
                    <?php foreach ($outcome as $o) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $x++; ?></th>
                            <td><?= $o['keterangan']; ?></td>
                            <td style="text-align: right"><?= uang($o['nominal']); ?></td>
                            <td><?= $o['category']; ?></td>
                            <td style="text-align: center;">

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- modal add new income -->
<!-- Modal -->
<div class="modal fade" id="newIncomeModal" tabindex="-1" aria-labelledby="newIncomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newIncomeModalLabel">Add New Income</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url() . '/cashflow/addincome'; ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Type Item name here..." autocomplete="off">
                    </div>
                    <div class="input-group mb-2">
                        <input type="number" id="nominal" class="form-control" name="nominal" placeholder="Type Num" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="category" id="category">
                            <option value="">Open this select Category</option>
                            <!-- logikanya adalah jika  -->
                            <?php foreach ($income_category as $ic) : ?>
                                <option value="<?= $ic['id']; ?>"><?= $ic['category']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Income</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal add new income -->
<!-- Modal -->
<div class="modal fade" id="newOutcomeModal" tabindex="-1" aria-labelledby="newOutcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOutcomeModalLabel">Add New Outcome</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url() . '/cashflow/addoutcome'; ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Type Item name here..." autocomplete="off">
                    </div>
                    <div class="input-group mb-2">
                        <input type="number" id="nominal" class="form-control" name="nominal" placeholder="Type Num" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="category" id="category">
                            <option value="">Open this select Category</option>
                            <!-- logikanya adalah jika  -->
                            <?php foreach ($outcome_category as $oc) : ?>
                                <option value="<?= $oc['id']; ?>"><?= $oc['category']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Add Outcome</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>