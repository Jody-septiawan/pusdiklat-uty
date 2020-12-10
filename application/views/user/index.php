<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    $UserId = $user['id'];
    $QueryUser = "SELECT * FROM
                user u JOIN user_role ur
                ON u.role = ur.id_role
                WHERE u.id = '$UserId'";
    $DataUser = $this->db->query($QueryUser)->row_array();

    ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img m-2" alt="...">
                        </div>
                        <div class="col-md-8">
                            <h5 class="card-title mb-0"><b><?= $user['username']; ?></b></h5>
                            <p class="card-text mb-0"><?= $user['email']; ?></p>
                            <p class="card-text mb-0"><?= $DataUser['role']; ?></p>
                            <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-circle text-success mr-1"></i><?= $user['last_active']; ?></small></p>
                            <p class="card-text mb-1"><a href="<?= base_url('user/changepassword') ?>" class="badge badge-dark"><i class="fa fa-lock text-light mx-1"></i>Ganti Password</a></p>
                            <a href="<?= base_url('user/edit'); ?>" class="btn btn-primary mb-3 shadow">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php if ($user['role'] == 1) { ?>

    <!-- Tabel User -->
    <div class="container-fluid">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $No = 1;
        $QueryUserMan = "SELECT * FROM
                user, user_role
                WHERE user.role = user_role.id_role
                ORDER BY user.role";
        $DataUserMan = $this->db->query($QueryUserMan)->result_array();
        ?>

        <div class="row">
            <div class="col-lg-12">
                <?= $this->session->flashdata('message2'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary border-bottom-warning">
                        <h6 class="m-0 font-weight-bold text-light"></h6>
                        <div class="row">
                            <div class="col">
                                <span class="text-light">User Management</span>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-success py-0" data-toggle="modal" data-target="#TambahUser">Tambah user</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Picture</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Terakhir Aktif</th>
                                        <th>Actived</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($DataUserMan as $um) :
                                        if ($um['role'] != 'admin-system') {
                                    ?>
                                            <tr class="text-center">
                                                <td class="py-0 align-middle"><?= $No++; ?></td>
                                                <td class="py-1 align-middle"><img src="<?= base_url('assets/img/profile/') . $um['image']; ?>" class="card-img m-2" alt="..." style="max-width: 30px"></td>
                                                <td class="py-1 align-middle"><?= $um['username']; ?></td>
                                                <td class="py-1 align-middle"><?= $um['email']; ?></td>
                                                <td class="py-1 align-middle"><?= $um['role']; ?></td>
                                                <td class="py-1 align-middle"><?php
                                                                                if ($um['last_active'] == 'Online') {
                                                                                    echo '<div class="text-success">' . $um['last_active'] . '</div>';
                                                                                } else {
                                                                                    if ($um['last_active'] == '0000000000') {
                                                                                        echo 'never logged in';
                                                                                    } else {

                                                                                        echo date('d-M-Y H:i:s', $um['last_active']) . " WIB";
                                                                                    }
                                                                                }
                                                                                ?></td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input btn-switch item-switch" id="customSwitch<?= $um['id'] ?>" <?php if ($um['is_active'] == 1) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?> data="<?= $um['id'] ?>">
                                                        <label class="custom-control-label" for="customSwitch<?= $um['id'] ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="py-1 align-middle">
                                                    <a href="<?= base_url('user/gantipassword/') . $um['id']; ?>"><span class="bg-dark rounded p-1"><i class="fa fa-lock text-light mx-1"></i></span></a>
                                                    <a href="<?= base_url('user/editUser/') . $um['id']; ?>"><span class="bg-success rounded py-1 pl-1 pr-0"><i class="fa fa-edit text-light mx-1"></i></span></a>
                                                    <a href="<?= base_url('user/hapus/') . $um['id']; ?>" class="tombol-delete-user"><span class="bg-danger rounded p-1"><i class="fa fa-trash text-light mx-1"></i></span></a>
                                                </td>
                                            </tr>
                                    <?php }
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- Modal -->
<div class="modal fade" id="TambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('user/tambah'); ?>" method="post">

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <?php foreach ($user_role as $ur) : ?>
                                <option value="<?= $ur['id_role'] ?>"><?= $ur['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>