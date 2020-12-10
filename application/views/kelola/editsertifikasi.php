<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header shadow bg-primary border-bottom-warning">
                <span class="text-light">Edit sertifikasi</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditsertifikasi') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $sertifikasi['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama sertifikasi</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $sertifikasi['nama_sertifikasi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Ket</label>
                        <input name="alias" type="text" class="form-control" id="NamaKelas" value="<?= $sertifikasi['alias']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Standar nilai</label>
                        <input name="nilai" type="number" class="form-control" id="NamaKelas" value="<?= $sertifikasi['std_nilai']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web/sertifikasi') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>