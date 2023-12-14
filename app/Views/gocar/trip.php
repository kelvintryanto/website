<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h3>Gocar Trip</h3>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#startTripModal">
        Start New Trip
    </button>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <p>- setelah distart maka setelah itu yang terecord adalah tanggal/waktu, km start</p>
    <p>- setelah distop, maka setelah itu yang terecord adalah tanggal/waktu, km end, masukkan selisih km dikalikan 1000 masukkan ke dalam pengeluaran yang harus dikeluarkan di dalam income/outcome</p>

    <div class="row">
        <div class="col-lg-6">
            <table class="table">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">KM Start</th>
                        <th scope="col">KM End</th>
                        <th scope="col">Difference KM</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <th scope="row">1</th>
                        <td>15/03/2023</td>
                        <td>15.00</td>
                        <td>19.38</td>
                        <td>4.38 hours</td>
                        <td>16.7 km</td>
                        <td>57.5 km</td>
                        <td>40.8km</td>
                        <td>
                            <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="">edit</a>
                            <!-- <a class="badge rounded-pill bg-danger text-light" href="" data-toggle="modal" data-target="">stop</a> -->
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <th scope="row">2</th>
                        <td>15/03/2023</td>
                        <td>15.00</td>
                        <td>19.38</td>
                        <td>4.38 hours</td>
                        <td>16.7 km</td>
                        <td>57.5 km</td>
                        <td>40.8km</td>
                        <td>
                            <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="">edit</a>
                            <a class="badge rounded-pill bg-danger text-light" href="" data-toggle="modal" data-target="">stop</a>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <th scope="row">3</th>
                        <td>15/03/2023</td>
                        <td>15.00</td>
                        <td>19.38</td>
                        <td>4.38 hours</td>
                        <td>16.7 km</td>
                        <td>57.5 km</td>
                        <td>40.8km</td>
                        <td>
                            <a class="badge rounded-pill bg-warning text-dark" href="" data-toggle="modal" data-target="">edit</a>
                            <a class="badge rounded-pill bg-danger text-light" href="" data-toggle="modal" data-target="">stop</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="startTripModal" tabindex="-1" aria-labelledby="startTripModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="startTripModalLabel">Start Trip</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url(); ?>/gocar/starttrip" method="post" enctype="multipart/form-data" novalidate>
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <div class="mb-3 row col-md-12">
                            <label for="odometer" class="col-sm-2 col-form-label">Start</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="odometer" id="odometer">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>