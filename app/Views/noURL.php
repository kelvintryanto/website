<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="ERROR">ERROR</div>
                <p class="lead text-gray-800 mb-5">NO URI Segment</p>
                <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                <a href="<?= base_url() . '/user'; ?>">&larr; Back to Dashboard</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>