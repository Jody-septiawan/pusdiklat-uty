<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit spesifikasi</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditspesifikasi') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $spesifikasi['id']; ?>">
                    <div class="form-group">
                        <label for="Formenu">Sertifikasi</label>
                        <select class="form-control" id="Formenu" name="id_sertifikasi">
                            <?php foreach ($sertifikasi as $s) : ?>
                                <option value="<?= $s['id'] ?>" <?php
                                                                if ($s['id'] == $spesifikasi['id_sertifikasi']) :
                                                                    echo "selected";
                                                                endif;
                                                                ?>><?= $s['alias'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Spesifikasi</label>
                        <input name="spesifikasi" type="text" class="form-control" id="NamaKelas" value="<?= $spesifikasi['spesifikasi']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web/spesifikasi') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>