<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Add Customer</h1>

    <form action="<?= base_url(); ?>/user/update" method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field(); ?>
        <input type="hidden" name="userID" value="<?= $userID; ?>">

        <!-- nama -->
        <div class="mb-3 row col-md-7">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="nama">
            </div>
        </div>

        <!-- nomor hp -->
        <div class="mb-3 row col-md-7">
            <label for="noHP" class="col-sm-3 col-form-label">Nomor HP</label>
            <div class="col-sm-6">
                <input type="number" class="form-control " id="noHP" placeholder="ex: +62812345678">
            </div>
            <div class="col-sm-3">
                <a href="" class="btn btn-primary">Cek Nomor</a>
            </div>
            <div>cek nomor nanti buat database customer aja, pakai web scraping untuk ekstrak nomor di getcontact.com</div>
        </div>

        <!-- email -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- profile picture -->
        <div class="mb-3 row col-md-7">
            <label for="profilepicture" class="col-sm-3 col-form-label">Profile Picture</label>
            <div class="col-sm-2">
                <img src="<?= base_url() . '/assets/img/profile/' . 'default.jpg'; ?>" class="img-thumbnail img-preview">
            </div>
            <div class="mb-3 row col-sm-6">
                <div class="mb-3">
                    <input class="form-control" type="file" id="profilepicture" multiple name="profilepicture" onchange="previewImg()">
                </div>
            </div>
        </div>

        <!-- jenis kelamin -->
        <div class="mb-3 row col-md-7">
            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Pria
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Wanita
                    </label>
                </div>
            </div>
        </div>

        <!-- tempat lahir -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Tanah Kelahiran</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- tanggal lahir -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- tinggi badan -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Tinggi Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- berat badan -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Berat Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- status Perokok -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Status Perokok</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- pekerjaan -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Pekerjaan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- alamat kerja -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Alamat Kantor</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- alamat rumah -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Alamat Rumah</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- agama -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <!-- golongan darah -->
        <div class="mb-3 row col-md-7">
            <label for="email" class="col-sm-3 col-form-label">Golongan Darah</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="email">
            </div>
        </div>

        <div class="mb-3 row col-md-7">
            <button type="submit" class="btn btn-primary mt-5">Add Customer</button>
        </div>
    </form>

</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>