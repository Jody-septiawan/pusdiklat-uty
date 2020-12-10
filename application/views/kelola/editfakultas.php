<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit fakultas</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditfakultas') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $fakultas['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Fakultas</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $fakultas['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Alias</label>
                        <input name="alias" type="text" class="form-control" id="NamaKelas" value="<?= $fakultas['alias']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web/fakultas') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>