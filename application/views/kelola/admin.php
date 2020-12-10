<div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light"></span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#new">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="example" width="100%" cellspacing="0">
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
                            <?php
                            $No = 1;
                            foreach ($admin as $um) :
                                if ($um['id_role'] != 1 && $um['id_role'] != 6) {
                            ?>
                                    <tr class="text-center">
                                        <td class="py-0 align-middle"><?= $No++; ?></td>
                                        <td class="py-1 align-middle"><img src="<?= base_url('assets/img/profile/') . $um['image']; ?>" class="card-img m-2" alt="..." style="max-width: 30px"></td>
                                        <td class="py-1 align-middle text-left"><?= $um['username']; ?></td>
                                        <td class="py-1 align-middle text-left"><?= $um['email']; ?></td>
                                        <td class="py-1 align-middle text-left"><?= $um['role']; ?></td>
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
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input btn-switch item-switch" id="customSwitch<?= $um['id'] ?>" <?php if ($um['is_active'] == 1) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?> data="<?= $um['id'] ?>">
                                                <label class="custom-control-label" for="customSwitch<?= $um['id'] ?>"></label>
                                            </div>
                                        </td>
                                        <td class="py-1 align-middle text-center" width="10%">

                                            <a href="<?= base_url('user/gantipassword/') . $um['id']; ?>"><span class="bg-dark rounded p-1"><i class="fa fa-lock text-light mx-1"></i></span></a>
                                            <a href="<?= base_url('user/editUser/') . $um['id']; ?>"><span class="bg-success rounded py-1 pl-1 pr-0"><i class="fa fa-edit text-light mx-1"></i></span></a>
                                            <?php
                                            // if ($um['id_role'] == 7) :
                                            ?>
                                            <a href="<?= base_url('user/hapus/') . $um['id']; ?>" class="tombol-delete-user"><span class="bg-danger rounded p-1"><i class="fa fa-trash text-light mx-1"></i></span></a>
                                            <?php
                                            // endif;
                                            ?>
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

<!-- Modal -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin/Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kelola_user/addadmin'); ?>" method="post">
                    <div class="form-group">
                        <label for="peran">Peran</label>
                        <select class="form-control" name="role" id="peran">
                            <?php foreach ($role as $r) : ?>
                                <?php if ($r['id_role'] != "1" && $r['id_role'] != "6") : ?>
                                    <option value="<?= $r['id_role'] ?>"><?= $r['role'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>