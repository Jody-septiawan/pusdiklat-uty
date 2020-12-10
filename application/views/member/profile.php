<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-5">
                <div class="card-body">
                    <?php echo form_open_multipart('mbr/editprofile'); ?>
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div class="text-center h5 border-bottom mb-4 pb-2 text-dark">Pribadi</div>
                            <div class="form-group">
                                <?php $identitas = "";
                                if (empty($user['no_identitas'])) :
                                    $identitas = "border border-danger";
                                endif; ?>
                                <label for="no_identitas">No Identitas</label>
                                <input value="<?= $user['no_identitas'] ?>" type="number" name="no_identitas" id="no_identitas" class="form-control <?= $identitas; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <?php $nama = "";
                                if (empty($user['nama_lengkap'])) :
                                    $nama = "border border-danger";
                                endif; ?>
                                <label for="nama_lengkap">Nama lengkap</label>
                                <input value="<?= $user['nama_lengkap'] ?>" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control <?= $nama; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <?php $tmpt_lahir = "";
                                if (empty($user['tempat_lahir'])) :
                                    $tmpt_lahir = "border border-danger";
                                endif; ?>
                                <label for="tempat_lahir">Tempat lahir</label>
                                <input value="<?= $user['tempat_lahir'] ?>" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control <?= $tmpt_lahir; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <?php $tgl_lahir = "";
                                if (empty($user['tgl_lahir'])) :
                                    $tgl_lahir = "border border-danger";
                                endif; ?>
                                <label for="tgl_lahir">Tanggal lahir</label>
                                <input value="<?= $user['tgl_lahir'] ?>" type="date" name="tgl_lahir" id="tgl_lahir" class="form-control <?= $tgl_lahir; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Jenis kelamin</label>
                                <select class="form-control" name="gender" id="">
                                    <option value="1" <?php if ($user['jns_kelamin'] == 1) {
                                                            echo "selected";
                                                        } ?>>Laki-laki</option>
                                    <option value="2" <?php if ($user['jns_kelamin'] == 2) {
                                                            echo "selected";
                                                        } ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php $no_hp = "";
                                if (empty($user['no_hp'])) :
                                    $no_hp = "border border-danger";
                                endif; ?>
                                <label for="no_hp">No HP</label>
                                <input value="<?= $user['no_hp'] ?>" type="number" name="no_hp" id="no_hp" class="form-control <?= $no_hp; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Kategori/Jenis pendaftar</label>
                                <select class="form-control " name="kategori" id="cek" oninput="CekInput()" style="margin-bottom: 10px;">
                                    <option value="0">--Category--</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['id'] ?>" <?php if ($user['id_jenis'] == $k['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $k['nama_jenis'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="99999" <?php if ($user['id_jenis'] == 99999) {
                                                                echo "selected";
                                                            } ?>>lainnya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Institusi</label>
                                <select class="form-control " name="institusi" style="margin-bottom: 10px;">
                                    <option value="0">--Institusi--</option>
                                    <?php foreach ($institusi as $i) : ?>
                                        <option value="<?= $i['id'] ?>" <?php if ($user['institusi'] == $i['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $i['nama'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="99999" <?php if ($user['institusi'] == 99999) {
                                                                echo "selected";
                                                            } ?>>lainnya</option>
                                </select>
                            </div>
                            <?php if ($user['program_studi'] != 0) : ?>
                                <div class="form-group">
                                    <label for="nama_lengkap">Institusi</label>
                                    <select class="form-control" name="prodi">
                                        <option value="0">--Program Studi--</option>
                                        <?php foreach ($prodi as $p) : ?>
                                            <option value="<?= $p['id'] ?>" <?php if ($user['program_studi'] == $p['id']) {
                                                                                echo "selected";
                                                                            } ?>><?= $p['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>


                        </div>
                        <div class="col-sm-6 border-left">
                            <div class="text-center h5 border-bottom mb-4 pb-2 text-dark">Akun</div>

                            <div class="form-group">
                                <?php $username = "";
                                if (empty($user['username'])) :
                                    $username = "border border-danger";
                                endif; ?>
                                <label for="username">Username</label>
                                <input value="<?= $user['username'] ?>" type="text" name="username" id="username" class="form-control <?= $username; ?>" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <?php $email = "";
                                if (empty($user['email'])) :
                                    $email = "border border-danger";
                                endif; ?>
                                <label for="email">Email</label>
                                <input value="<?= $user['email'] ?>" type="text" name="email" id="email" class="form-control <?= $email ?>" aria-describedby="helpId">
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="identitas">Foto Bukti Identitas</label><br>
                                <?php if ($user['img_identitas']) : ?>
                                    <img src="<?= base_url('assets/img/identitas/') . $user['img_identitas'] ?>" class="img-fluid mb-1" width="20%">
                                <?php else : ?>
                                    <span class="text-danger border border-danger rounded px-2">Belum ada</span>
                                <?php endif; ?>
                                <div class="input-group mb-3 mt-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="identitas" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">(jpg/jpeg/png)</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="profile">Foto Profil</label> <br>
                                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-fluid mb-1 border rounded p-1" width="20%">
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
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>