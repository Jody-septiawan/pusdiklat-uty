<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion border-left-warning shadow" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="<?= base_url('assets/'); ?>img/uty.png" class="img-profile" height="35" alt="">
            </div>
            <div class="sidebar-brand-text mx-1">Pusdiklat UTY</div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Presensi
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link py-2" href="<?= base_url('absen/mos'); ?>">
                <i class="fab fa-fw fa-microsoft"></i>
                <span>MOS</span>
            </a>
            <a class="nav-link py-2" href="<?= base_url('absen/mta'); ?>">
                <i class="fab fa-fw fa-microsoft"></i>
                <span>MTA</span>
            </a>
            <a class="nav-link py-2" href="<?= base_url('absen/mce'); ?>">
                <i class="fab fa-fw fa-microsoft"></i>
                <span>MCE</span>
            </a>
            <a class="nav-link py-2" href="<?= base_url('absen/mtc'); ?>">
                <i class="fab fa-fw fa-microsoft"></i>
                <span>MTC</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider mb-1">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link pb-2 pt-1" href="<?= base_url('rekap'); ?>">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Rekap ujian sertifikasi</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">



        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item ">
            <a class="nav-link py-2" href="<?= base_url('user'); ?>">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Profil & User management</span></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link py-2" href="<?= base_url('user/history'); ?>">
                <i class="fas fa-history"></i>
                <span>History User</span></a>
        </li>

        <?php if ($user['role'] == 1) { ?>

            <li class="nav-item">
                <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#Konfigurasi" aria-expanded="true" aria-controls="Konfigurasi">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Konfigurasi</span>
                </a>
                <div id="Konfigurasi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('config/admin'); ?>">Admin</a>
                        <a class="collapse-item" href="<?= base_url('config/petugas'); ?>">Petugas</a>
                    </div>
                </div>
            </li>
        <?php
        }

        ?>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link pt-2 tombol-logout" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>



        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->