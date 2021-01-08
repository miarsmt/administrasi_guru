<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png'); ?>">

    <!-- Jquery -->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

    <!-- Notify -->
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script>
        base_url = "<?= base_url(); ?>";

        function noti(tipe, value) {
            $.notify({
                icon: 'fas fa-fw fa-info-circle',
                message: '<strong>Informasi</strong><p>' + value + '</p>'
            }, {
                type: tipe,
                timer: 1000
            });
            return true;
        }
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">