<?php

$nav = [['nama' => 'MOS', 'link' => 'mos'], ['nama' => 'MTA', 'link' => 'mta'], ['nama' => 'MCE', 'link' => 'mce'], ['nama' => 'MTC', 'link' => 'mtc']];
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark shadow border-left-warning sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('') ?>">
            <!-- <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div> -->
            <span class="sidebar-brand-text mr-2">Hai, <?= $user['username']; ?></span><img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-petugas">
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0 ">

        <!-- Nav Item - Dashboard -->
        <?php foreach ($nav as $n) : ?>
            <li class="nav-item ">
                <a class="nav-link py-2" href="<?= base_url('presensi/') . $n['link']; ?>">
                    <i class="fab fa-fw fa-microsoft"></i>
                    <span><?= $n['nama']; ?></span>
                </a>
            </li>
        <?php endforeach; ?>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block mb-0">
        <li class="nav-item ">
            <a class="nav-link py-2" href="<?= base_url('presensi/saran'); ?>">
                <i style="font-size:15px" class="fa">&#xf0eb;</i>
                <!-- <i class="fab fa-fw fa-microsoft"></i> -->
                <span>suggestion</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link py-2" href="<?= base_url('auth/logout') ?>" onclick="return confirm('Apakah anda yakin ingin logout?')">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                <span>Logout</span>
            </a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>