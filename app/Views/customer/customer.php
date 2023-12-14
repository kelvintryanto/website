<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Customer</h1>
    <a href="<?= base_url() . '/customer/addCustomer'; ?>" class="btn btn-primary mb-3">Add Customer</a>

    <div>
        <!-- <h2>to-do-list</h2> -->
        <p>- buat form <i class="fa-regular fa-circle-check" style="color: #0f7520;"></i>
        <p>- masukkan data customer ke dalam database <i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
        <p>- tampilkan data customer berupa card dan ada profile picturenya <i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
        <p>- ada tombol edit dan delete customer <i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
        <p>- delete customer menggunakan confirmation delete<i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
        <p>- kategorikan data customer berupa data ABCD <i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
        <p>- buat calon nasabah menjadi nasabah yang dicari dengan getcontact <i class="fa-regular fa-circle-xmark" style="color: #c33232;"></i>
    </div>
</div>
<!-- /.container-fluid -->



<?= $this->endSection(); ?>