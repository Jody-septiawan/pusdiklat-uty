<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Form Pengajuan</h5>
    <br>

    <div class="row">
        <div class="col-lg-10">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="col-lg-10">

        <!-- <?= form_open_multipart('user/tambah_pengajuan'); ?> -->
        <form action="tambah_pengajuan" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="penyelenggara" class="col-sm-4 col-form-label">Nama Penyelenggara</label>
                <div class="col-sm-8">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>" class="form-control">
                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="<?= $user['name']; ?>" readonly>
                    <?= form_error('penyelenggara', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="nama_kegiatan" class="col-sm-4 col-form-label">Nama Kegiatan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="<?= set_value('nama_kegiatan'); ?>">
                    <?= form_error('nama_kegiatan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal_kegiatan" class="col-sm-4 col-form-label">Tanggal Kegiatan</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="<?= set_value('tanggal_kegiatan'); ?>">
                    <?= form_error('tanggal_kegiatan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="pihak_satu" class="col-sm-4 col-form-label">Pihak Menandatangani (1)</label>
                <div class="col-sm-8">
                    <!-- <input type="text" class="form-control" id="pihak_satu" name="pihak_satu" value="<?= set_value('pihak_satu'); ?>"> -->

                    <select class="form-control" id="nama" name="pihak_satu">
                        <?php foreach ($nama_pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['nama']; ?>" <?php if ($ttd['id'] == 1) {
                                                                        echo "hidden";
                                                                    } ?>>
                                <?= $ttd['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('pihak_satu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan_pihak_satu" class="col-sm-4 col-form-label">Jabatan Pihak Menandatangani (1)</label>
                <div class="col-sm-8">

                    <select class="form-control" id="jabatan_pihak_satu" name="jabatan_pihak_satu">
                        <?php foreach ($pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['jabatan'] ?>/<?= $ttd['id'] ?>" <?php if ($ttd['jabatan'] == "") {
                                                                                            echo "hidden";
                                                                                        } ?>>
                                <?= $ttd['jabatan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?= form_error('jabatan_pihak_satu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="pihak_dua" class="col-sm-4 col-form-label">Pihak Menandatangani (2)</label>
                <div class="col-sm-8">
                    <!-- <input type="text" class="form-control" id="pihak_dua" name="pihak_dua"> -->
                    <select class="form-control" id="nama2" name="pihak_dua">
                        <?php foreach ($nama_pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['nama']; ?>" <?php if ($ttd['id'] == 1) {
                                                                        echo "hidden";
                                                                    } ?>>
                                <?= $ttd['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('pihak_dua', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan_pihak_dua" class="col-sm-4 col-form-label">Jabatan Pihak Menandatangani (2)</label>
                <div class="col-sm-8">
                    <select class="form-control" id="jabatan_pihak_dua" name="jabatan_pihak_dua">
                        <?php foreach ($pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['jabatan'] ?>/<?= $ttd['id'] ?>" <?php if ($ttd['jabatan'] == "") {
                                                                                            echo "hidden";
                                                                                        } ?>>
                                <?= $ttd['jabatan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('jabatan_pihak_dua', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="pihak_tiga" class="col-sm-4 col-form-label">Pihak Menandatangani (3)*</label>
                <div class="col-sm-8">
                    <!-- <input type="text" class="form-control" id="pihak_tiga" name="pihak_tiga"> -->
                    <select class="form-control" id="nama3" name="pihak_tiga">
                        <?php foreach ($nama_pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['nama']; ?>" <?php if ($ttd['id'] == 1) {
                                                                        echo "hidden";
                                                                    } ?>>
                                <?= $ttd['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('pihak_tiga', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan_pihak_tiga" class="col-sm-4 col-form-label">Jabatan Pihak Menandatangani (3)*</label>
                <div class="col-sm-8">
                    <select class="form-control" id="" name="jabatan_pihak_tiga">
                        <?php foreach ($pihak_ttd as $ttd) : ?>
                            <option value="<?= $ttd['jabatan'] ?>/<?= $ttd['id'] ?>" <?php if ($ttd['jabatan'] == "") {
                                                                                            echo "hidden";
                                                                                        } ?>>
                                <?= $ttd['jabatan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('jabatan_pihak_tiga', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="penerima" class="col-sm-4 col-form-label">Daftar Penerima (excel)</label>
                <div class="col-sm-8">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="data_penerima" name="penerima" accept=".xls, .xlsx">
                        <label class="custom-file-label" for="data_penerima ">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="desain" class="col-sm-4 col-form-label">Desain Sertifikat (jpg/png)</label>
                <div class="col-sm-8">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="desain" name="desain" accept=".jpg, .jpeg, .png">
                        <label class="custom-file-label" for="desain ">Choose file</label>
                    </div>
                </div>
            </div>

            <?php if ($user['kode_penyelenggara']  == 5 || $user['kode_penyelenggara'] == 6) { ?>

                <div class="form-group row">
                    <label for="scan_formulir" class="col-sm-4 col-form-label">Formulir Ditandatangani (pdf)</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="scan_formulir" name="scan_formulir" accept=".pdf">
                            <label class="custom-file-label" for="scan_formulir ">Choose file</label>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <br>
            <div class="tombol">
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </div>

        </form>
    </div>

    <br>
    <p>*kosongkan jika tidak ada</p>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->