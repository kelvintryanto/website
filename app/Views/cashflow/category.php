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
        <!-- income category -->
        <div class="col">
            <div>
                <h3>Income Category</h3>
            </div>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newIncomeCategory">Add New Income Category</button>
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

            <table class="table table-bordered border-primary">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Used</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($income_category as $ic) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $i++; ?></th>
                            <td style="<?= ($ic['ti'] == null) ? 'background-color:lightgrey' : ''; ?>"><?= $ic['category']; ?></td>
                            <td style="text-align: center; <?= ($ic['ti'] == null) ? 'background-color:lightgrey' : ''; ?>"><?= ($ic['ti'] != null) ? $ic['ti'] : 0; ?></td>
                            <td style="text-align: center;">
                                <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="#editIncomeModal<?= $ic['id']; ?>">edit</a>
                                <!-- Modal Edit Income Category -->
                                <div class="modal fade" id="editIncomeModal<?= $ic['id']; ?>" tabindex="-1" aria-labelledby="editIncomeModal<?= $ic['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editIncomeModal">Edit Income</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url() . '/cashflow/updateincomecategory/' . $ic['id']; ?>" method="post">
                                                <input type="hidden" name="id" id="id" value="<?= $ic['id']; ?>">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="incomeCategory" class="form-control" name="incomeCategory" placeholder="Type category name here..." value="<?= $ic['category']; ?>">
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

                                <!-- delete Income Category -->
                                <a class="badge rounded-pill bg-danger" data-toggle="modal" data-target="#deleteIncomeCategory<?= $ic['id']; ?>" href="">delete</a>
                                <div class="modal fade" id="deleteIncomeCategory<?= $ic['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteIncomeCategory<?= $ic['id']; ?>" aria-hidden="true">
                                    <form action="<?= base_url() . '/cashflow/deleteincomecategory/' . $ic['id']; ?>" method="post">
                                        <?php csrf_field(); ?>
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteIncomeCategory<?= $ic['id']; ?>">Delete Category <?= $ic['category']; ?>?</h5>
                                                    <button class=" close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Are you sure want to delete this Category?</div>
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

        <!-- outcome category -->
        <div class="col">
            <div>
                <h3>Outcome</h3>
            </div>
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#newOutcomeCategory">Add New Outcome Category</button>
            <?php if (session()->getFlashdata('pesan-outcome')) : ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
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

            <table class="table table-bordered border-primary">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Used</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($outcome_category as $oc) : ?>
                        <tr>
                            <th style="text-align: center;" scope="row"><?= $i++; ?></th>
                            <td style="<?= ($oc['to'] == null) ? 'background-color:lightgrey' : ''; ?>"><?= $oc['category']; ?></td>
                            <td style="text-align: center; <?= ($oc['to'] == null) ? 'background-color:lightgrey' : ''; ?>"><?= ($oc['to'] != null) ? $oc['to'] : 0; ?></td>
                            <td style="text-align: center;">
                                <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="#editOutcomeModal<?= $oc['id']; ?>">edit</a>
                                <!-- Modal Edit Outcome Category -->
                                <div class="modal fade" id="editOutcomeModal<?= $oc['id']; ?>" tabindex="-1" aria-labelledby="editOutcomeModal<?= $oc['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editOutcomeModal">Edit Outcome</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url() . '/cashflow/updateoutcomecategory/' . $oc['id']; ?>" method="post">
                                                <input type="hidden" name="id" id="id" value="<?= $oc['id']; ?>">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="outcomeCategory" class="form-control" name="outcomeCategory" placeholder="Type Outcome name here..." value="<?= $oc['category']; ?>">
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

                                <!-- delete Outcome Category -->
                                <a class="badge rounded-pill bg-danger" data-toggle="modal" data-target="#deleteOutcomeCategory<?= $oc['id']; ?>" href="">delete</a>
                                <div class="modal fade" id="deleteOutcomeCategory<?= $oc['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteOutcomeCategory<?= $oc['id']; ?>" aria-hidden="true">
                                    <form action="<?= base_url() . '/cashflow/deleteoutcomecategory/' . $oc['id']; ?>" method="post">
                                        <?php csrf_field(); ?>
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteOutcomeCategory<?= $oc['id']; ?>">Delete Category <?= $oc['category']; ?>?</h5>
                                                    <button class=" close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Are you sure want to delete this Category?</div>
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

<!-- modal add new income -->
<!-- Modal -->
<div class="modal fade" id="newIncomeCategory" tabindex="-1" aria-labelledby="newIncomeCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newIncomeCategoryLabel">Add New Income Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url() . '/cashflow/addincomecategory'; ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <input type="text" id="category" class="form-control" name="category" placeholder="Type Category here..." autocomplete="off">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal add new outcome -->
<!-- Modal -->
<div class="modal fade" id="newOutcomeCategory" tabindex="-1" aria-labelledby="newOutcomeCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOutcomeCategoryLabel">Add New Outcome Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url() . '/cashflow/addoutcomecategory'; ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <input type="text" id="category" class="form-control" name="category" placeholder="Type Category here..." autocomplete="off">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>