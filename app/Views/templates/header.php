<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title ." | " : "" ?>CI4 Test</title>
    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

    <!--end of Styles -->


    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    
    <!-- end of Scritps -->

</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">CI4 Test</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('main/create') ?>"><i class="fa fa-plus-square"></i> Add New</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('main/list') ?>"><i class="fa fa-th-list"></i> List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--End Top Navigation Bar -->

    <!-- Wrapper -->
    <div class="wrapper my-4">
        <!-- Main Container -->
        <div class="main container">
            <?php if(!empty($session->getFlashdata('success_message'))): ?>
                <div class="alert alert-success rouded-0">
                    <div class="d-flex">
                        <div class="col-11"><?= $session->getFlashdata('success_message') ?></div>
                        <div class="col-1 text-end"><a href="javascript:void(0)" onclick="$(this).closest('.alert').remove()" class="text-muted text-decoration-none"><i class="fa fa-times"></i></a></div>
                    </div>
                </div>
            <?php endif ?>
            <?php if(!empty($session->getFlashdata('error_message'))): ?>
                <div class="alert alert-danger rouded-0">
                    <div class="d-flex">
                        <div class="col-11"><?= $session->getFlashdata('error_message') ?></div>
                        <div class="col-1 text-end"><a href="javascript:void(0)" onclick="$(this).closest('.alert').remove()" class="text-muted text-decoration-none"><i class="fa fa-times"></i></a></div>
                    </div>
                </div>
            <?php endif ?>

       