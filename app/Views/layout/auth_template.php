<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() . '/assets/'; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="<?= base_url() . '/assets/'; ?>css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

    <?= $this->renderSection('content'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() . '/assets/'; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() . '/assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() . '/assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() . '/assets/'; ?>js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="<?php base_url(); ?>/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(200, 0).slideUp(500, function() {
                    $(this).remove();
                });
                $(".alert").addClass('alert alert-danger').fadeTo(200, 0)
            }, 4000);
        });

        // tampilkan preview gambar
        function previewImg() {
            const sampul = document.querySelector('#sampul');
            const imgPreview = document.querySelector('.img-preview');

            // sampulLabel.textContent = sampul.files[0].name;
            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);
            console.log(fileSampul.readAsDataURL(sampul.files[0]));

            // menampilkan preview gambar pada img
            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>