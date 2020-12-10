<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Daftar Member</h5>

    <div class="row">
        <div class="col-lg-10 ml-2">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah Member</a>

    <div class="col-lg-10">

        <table class="table table-hover col-md-10 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Member</th>
                <th scope="col">Email</th>
                <th scope="col">Peran</th>
                <th scope="col">Ubah Password</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1;
                foreach ($member as $mb) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $mb['name'] ?></td>
                        <td><?= $mb['email'] ?></td>
                        <td>
                            <?php
                            if ($mb['role_id'] == 1) {
                                echo ('Admin');
                            } else {
                                echo ('User');
                            } ?>
                        </td>

                        <!-- ubah password -->
                        <td>
                            <div class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal<?= $mb['id']  ?>">
                                <i class="fa fa-lock"></i>
                            </div>


                            <div class="modal fade" id="exampleModal<?= $mb['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/update_password'; ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $mb['id'] ?>">
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="password baru" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" onclick="myFunction()">Tampilkan Password
                                                </div>
                                            </div>

                                            <center>

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <br>
                                            </center>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- edit data -->
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $mb['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $mb['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_member'; ?>" method="post">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4 col-form-label">Nama Member</label>
                                                    <div class="col-sm-8">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $mb['id'] ?>">
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= $mb['name'] ?>" required>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="jenis" class="col-sm-4 col-form-label">Jenis Member</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="jenis" name="jenis">
                                                            <?php foreach ($j_member as $jm) : ?>
                                                                <option value="<?= $jm['id'] ?>" <?php if ($jm['id'] == $mb['kode_penyelenggara']) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                                    <?= $jm['jenis_penyelenggara'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="jenis" class="col-sm-4 col-form-label">Dibawah Naungan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="naungan" name="naungan">
                                                            <?php foreach ($naungan as $nn) : ?>
                                                                <option value="<?= $nn['kode'] ?>" <?php if ($nn['kode'] == $mb['kode_naungan']) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                                    <?= $nn['nama_naungan'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="email" name="email" value="<?= $mb['email'] ?>" required>
                                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="peran" class="col-sm-4 col-form-label">Peran</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="peran" name="peran">
                                                            <option value="1" <?php if ($mb['role_id'] == 1) {
                                                                                    echo "selected";
                                                                                }; ?>>Admin</option>
                                                            <option value="2" <?php if ($mb['role_id'] == 2) {
                                                                                    echo "selected";
                                                                                }; ?>>User</option>
                                                        </select>
                                                        <?= form_error('peran', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <br>
                                            </center>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $mb['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal2<?= $mb['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Member</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus <?= $mb['name']; ?> sebagai member?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus/' . $mb['id'], '<div class="btn btn-danger">Hapus</div>') ?>
                                        </center>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
    </div>
</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="superadmin/tambah_member" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Nama Member</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" class="form-control">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis" class="col-sm-4 col-form-label">Jenis Member</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="jenis" name="jenis">
                                <?php foreach ($j_member as $jm) : ?>
                                    <option value="<?= $jm['id'] ?>">
                                        <?= $jm['jenis_penyelenggara'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis" class="col-sm-4 col-form-label">Dibawah Naungan</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="naungan" name="naungan">
                                <?php foreach ($naungan as $nn) : ?>
                                    <option value="<?= $nn['kode'] ?>">
                                        <?= $nn['nama_naungan'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" required>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="password" name="password" required>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="peran" class="col-sm-4 col-form-label">Peran</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="peran" name="peran">
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                            <?= form_error('peran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <table align="center">
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>