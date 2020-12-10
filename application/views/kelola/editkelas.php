<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning text-light">
                Edit kelas
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_sertifikasi/proseseditkelas') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $kelas['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama kelas</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $kelas['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <?php $datetime = date('Y-m-d\TH:i', $kelas['tanggal']); ?>
                        <label for="Waktu">Waktu</label>
                        <input name="waktu" type="datetime-local" class="form-control" id="Waktu" value="<?= $datetime; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Kuota</label>
                        <input name="kuota" type="number" class="form-control" id="NamaKelas" value="<?= $kelas['kuota']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Proctor</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="proctor">
                            <option value="0">-</option>
                            <?php foreach ($proctor as $p) : ?>
                                <option value="<?= $p['id']; ?>" <?php if ($kelas['id_proctor'] == $p['id']) : ?> selected <?php endif; ?>><?= $p['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Buka" value="1" <?php if ($kelas['status']  == 1) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Buka">Buka</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Tutup" value="0" <?php if ($kelas['status']  == 0) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Tutup">Tutup</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_sertifikasi') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>