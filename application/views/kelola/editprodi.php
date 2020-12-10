<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Program Studi</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditprodi') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $prodi['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Program Studi</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $prodi['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Alias</label>
                        <input name="akreditas" type="text" class="form-control" id="NamaKelas" value="<?= $prodi['akreditas']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Formenu">Fakultas</label>
                        <select class="form-control" id="Formenu" name="id_fakultas">
                            <?php foreach ($fakultas as $s) : ?>
                                <option value="<?= $s['id'] ?>" <?php if ($prodi['id_fakultas'] == $s['id']) : ?> selected <?php endif; ?>><?= $s['nama'] ?> (<?= $s['alias'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web/prodi') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>