<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Picture</th>
                                <th>Username</th>
                                <th>profile</th>
                                <th>Terakhir Aktif</th>
                                <th>Actived</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($member as $m) : ?>
                                <tr class="text-center">
                                    <td class=" align-middle"><?= $no++; ?></td>
                                    <td class="align-middle"><img src="<?= base_url('assets/img/profile/') . $m['image'] ?>" class="img-fluid" width="20%"></td>
                                    <td class="align-middle"><?= $m['username'] ?></td>
                                    <td class="align-middle"><?= $m['email'] ?></td>
                                    <td class="align-middle">
                                        <?php
                                        if ($m['last_active'] == 'Online') {
                                            echo '<div class="text-success">' . $m['last_active'] . '</div>';
                                        } else {
                                            if ($m['last_active'] == '0000000000') {
                                                echo 'Belum pernah aktif';
                                            } else {

                                                echo date('d-M-Y H:i:s', $m['last_active']) . " WIB";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input btn-switch item-switch" id="customSwitch<?= $m['id'] ?>" <?php if ($m['is_active'] == 1) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?> data="<?= $m['id'] ?>">
                                            <label class="custom-control-label" for="customSwitch<?= $m['id'] ?>"></label>
                                        </div>
                                    </td>
                                    <td class="py-1 align-middle">
                                        <a href="#" data-toggle="modal" data-target="#GantiPw<?= $m['id'] ?>"><span class="bg-dark rounded p-1"><i class="fa fa-lock text-light mx-1"></i></span></a>
                                        <a href="#" data-toggle="modal" data-target="#EditMember<?= $m['id'] ?>"><span class="bg-success rounded py-1 pl-1 pr-0"><i class="fa fa-edit text-light mx-1"></i></span></a>
                                        <a href="<?= base_url('user/hapus/') . $m['id']; ?>" class="tombol-delete-user"><span class="bg-danger rounded p-1"><i class="fa fa-trash text-light mx-1"></i></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($member as $m) : ?>
    <!-- Modal ganti pw -->
    <div class="modal fade" id="GantiPw<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Password Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kelola_user/member_gantipw') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $m['id'] ?>">
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" aria-describedby="helpId">
                        </div>
                </div>
                <div class="modal-footer border-0">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditMember<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Member |
                        Status Akun :
                        <?php if ($m['is_active']) : ?>
                            <span class="text-success">
                                Aktif
                            </span>
                        <?php else : ?>
                            <span class="text-danger">
                                Tidak aktif
                            </span>
                        <?php endif; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-sm-6 border-right">

                                <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                <div class="text-center h5 border-bottom mb-4 pb-2">Data pribadi</div>
                                <div class="form-group">
                                    <label for="no_identitas">No Identitas</label>
                                    <input value="<?= $m['no_identitas'] ?>" type="number" name="no_identitas" id="no_identitas" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input value="<?= $m['nama_lengkap'] ?>" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat lahir</label>
                                    <input value="<?= $m['tempat_lahir'] ?>" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal lahir</label>
                                    <input value="<?= $m['tgl_lahir'] ?>" type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="nama_lengkap">Jenis kelamin</label>
                                    <select class="form-control" name="" id="">
                                        <option value="1" <?php if ($m['jns_kelamin'] == 1) {
                                                                echo "selected";
                                                            } ?>>Laki-laki</option>
                                        <option value="2" <?php if ($m['jns_kelamin'] == 2) {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input value="<?= $m['no_hp'] ?>" type="text" name="no_hp" id="no_hp" class="form-control" aria-describedby="helpId">
                                </div>


                                <div class="form-group">
                                    <label for="nama_lengkap">Kategori/Jenis pendaftar</label>
                                    <select class="form-control " name="kategori" id="cek" oninput="CekInput()" style="margin-bottom: 10px;">
                                        <option value="0">--Category--</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['id'] ?>" <?php if ($m['kategori'] == $k['id']) {
                                                                                echo "selected";
                                                                            } ?>><?= $k['nama_jenis'] ?></option>
                                        <?php endforeach; ?>
                                        <option value="99999" <?php if ($m['kategori'] == 99999) {
                                                                    echo "selected";
                                                                } ?>>lainnya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nama_lengkap">Institusi</label>
                                    <select class="form-control " name="institusi" style="margin-bottom: 10px;">
                                        <option value="0">--Institusi--</option>
                                        <?php foreach ($institusi as $i) : ?>
                                            <option value="<?= $i['id'] ?>" <?php if ($m['institusi'] == $i['id']) {
                                                                                echo "selected";
                                                                            } ?>><?= $i['nama'] ?></option>
                                        <?php endforeach; ?>
                                        <option value="99999" <?php if ($m['institusi'] == 99999) {
                                                                    echo "selected";
                                                                } ?>>lainnya</option>
                                    </select>
                                </div>
                                <?php if ($m['program_studi'] != 0) : ?>
                                    <div class="form-group">
                                        <label for="nama_lengkap">Institusi</label>
                                        <select class="form-control " name="prodi">
                                            <option value="0">--Program Studi--</option>
                                            <?php foreach ($prodi as $p) : ?>
                                                <option value="<?= $p['id'] ?>" <?php if ($m['program_studi'] == $p['id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $p['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>


                            </div>
                            <div class="col-sm-6 border-left">
                                <div class="text-center h5 border-bottom mb-4 pb-2">Data akun</div>



                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input value="<?= $m['username'] ?>" type="text" name="username" id="username" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input value="<?= $m['email'] ?>" type="text" name="email" id="email" class="form-control" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <label for="identitas">Foto Identitas</label><br>
                                    <?php if ($m['img_identitas']) : ?>
                                        <img src="<?= base_url('assets/img/identitas/') . $m['img_identitas'] ?>" class="img-fluid mb-1" width="20%">
                                    <?php else : ?>
                                        <span class="text-danger">Belum ada</span>
                                    <?php endif; ?>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="identitas" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">(jpg/jpeg/png)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="profile">Foto Profil</label> <br>
                                    <img src="<?= base_url('assets/img/profile/') . $m['image'] ?>" class="img-fluid mb-1 border rounded p-1" width="20%">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">(jpg/jpeg/png)</label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>