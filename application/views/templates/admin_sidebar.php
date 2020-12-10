<!-- Page Wrapper -->
<div id="wrapper">
    <?php
    $this->db->select('value');
    $sidebar = $this->db->get_where('company', ['nama' => 'sidebar'])->row_array();
    $sidebar = $sidebar['value'];

    if ($sidebar == 1) :
        $sidebar = "toggled";
    else :
        $sidebar = "";
    endif;
    ?>

    <!-- Sidebar -->
    <!-- border-left-danger -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow border-kiri <?= $sidebar ?>" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <a class="nav-link" href="<?= base_url('admin'); ?>">

                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?= base_url('assets/'); ?>img/uty.png" class="img-profile" height="35" alt="">
                </div>
                <div class="sidebar-brand-text mx-1 text-light">Pusdiklat UTY</div>
            </a>
        </div>

        <?php
        $role_id =  $this->session->userdata('role');
        $queryMenu = "select m.* FROM user_menu m, user_access_menu am
                        WHERE am.menu_id = m.id
                        AND am.role_id = $role_id
                        AND m.is_active = 1
                        GROUP BY m.id ORDER BY m.title ASC";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <?php foreach ($menu as $m) : ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-1 mb-3">
            <!-- Heading -->
            <div class="sidebar-heading ">
                <?= $m['title']; ?>
            </div>
            <?php
            $menu_id = $m['id'];
            $querySubmenu = "select sm.* from user_menu m, user_sub_menu sm
                            where m.id = sm.menu_id
                            AND sm.menu_id = $menu_id
                            AND sm.is_Active = 1
                            ORDER BY sm.title ASC";
            $submenu = $this->db->query($querySubmenu)->result_array();
            ?>
            <?php foreach ($submenu as $sm) : ?>
                <?php if ($sm['title'] == $title) : ?>
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                    <?php else : ?>
                        <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class=" nav-link py-2 " href=" <?= base_url() . $sm['url']; ?>">
                        <?php if ($sm['title'] == $title) : ?>
                            <?php if ($sm['title'] == "Menu management" || $sm['title'] == "Menu akses" || $sm['title'] == "Sertifikasi" || $sm['title'] == "Spesifikasi" || $sm['title'] == "Fakultas" || $sm['title'] == "Program Studi" || $sm['title'] == "Institusi" || $sm['title'] == "Admin & Staff" || $sm['title'] == "Member") : ?>
                                <i class="<?= $sm['icon']; ?> fa-spin"></i>
                            <?php else : ?>
                                <i class="<?= $sm['icon']; ?>"></i>
                            <?php endif; ?>
                        <?php else : ?>
                            <i class="<?= $sm['icon']; ?>"></i>
                        <?php endif; ?>
                        <span><?= $sm['title']; ?></span>
                    </a>
                    </li>
                <?php endforeach; ?>
            <?php endforeach;
            ?>

            <!-- Divider -->
            <div class="">
                <hr class="sidebar-divider my-1 ">
            </div>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-3">
                <button class="rounded-circle border-0 sidebar-switch" id="sidebarToggle"></button>
            </div>

    </ul>
    <!-- End of Sidebar -->