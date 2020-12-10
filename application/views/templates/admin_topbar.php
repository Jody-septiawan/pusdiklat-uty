<?php
$role = $this->session->userdata('role');

?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('ganti_pw'); ?>"></div>
<div class="flash-data1" data-flashdata1="<?= $this->session->flashdata('ganti_pw_salah'); ?>"></div>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <ul class="navbar-nav">
                <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            </ul>

            <!-- <ul class="navbar-nav ml-auto">
                <h6><?= date('d M Y'); ?></h6>
            </ul> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-dark small"><?= $user['username']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <?php if ($role == 6) : ?>
                            <a class="dropdown-item" href="<?= base_url('mbr/profile') ?>">
                            <?php elseif ($role >= 1 || $role <= 5 || $role == 11) : ?>
                                <a class="dropdown-item" href="<?= base_url('user') ?>">
                                <?php endif; ?>
                                <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                                </a>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#GantiPassword">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ganti Password
                                </a>
                                <?php if ($role == 1) : ?>
                                    <a class="dropdown-item" href="<?= base_url('user/history') ?>">
                                        <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity log
                                    </a>
                                <?php endif; ?>
                                <a class="dropdown-item tombol-logout" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <!-- Modal -->
        <div class="modal fade" id="GantiPassword" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ganti Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php if ($role == 6) : ?>
                        <form action="<?= base_url('mbr/ganti_password') ?>" method="post" class="m-0">
                        <?php elseif ($role >= 1 || $role <= 5 || $role == 11) : ?>
                            <form action="<?= base_url('admin/ganti_password') ?>" method="post" class="m-0">
                            <?php elseif ($role >= 7 || $role <= 10) : ?>
                                <form action="<?= base_url('ptr/ganti_password') ?>" method="post" class="m-0">
                                <?php endif; ?>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="form-group">
                                            <label for="">Password Baru</label>
                                            <input type="password" class="form-control" name="pass1" id="pw1" aria-describedby="helpId" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="pass2" onkeyup="ConfirmPW()" id="pw2" aria-describedby="helpId" placeholder="">
                                        </div>
                                        <div class="Confirm-pw text-danger text-center"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                </div>
            </div>
        </div>