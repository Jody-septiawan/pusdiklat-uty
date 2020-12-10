<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> - Administrator Pusdiklat UTY</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/sbadmin/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/sbadmin/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/uty.png">
    <!-- custom -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/style.css'); ?>">
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <style>
        a:hover {
            text-decoration: none;
        }

        * {
            transition: 1s;
        }
    </style>
</head>

<?php
$this->db->select('value');
$sidebar = $this->db->get_where('company', ['nama' => 'sidebar'])->row_array();
$sidebar = $sidebar['value'];

if ($sidebar == 1) :
    $sidebar = "sidebar-toggled";
else :
    $sidebar = "";
endif;
?>

<body id="page-top" class="<?= $sidebar ?>">