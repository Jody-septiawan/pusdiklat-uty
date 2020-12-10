<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit submenu</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditsubmenu') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
                    <div class="form-group">
                        <label for="Formenu">For menu</label>
                        <select class="form-control" id="Formenu" name="menu_id">
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['id'] == $submenu['menu_id']) : ?>
                                    <option value="<?= $m['id'] ?>" selected>
                                    <?php else : ?>
                                    <option value="<?= $m['id'] ?>">
                                    <?php endif; ?>
                                    <?= $m['title'] ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama submenu</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $submenu['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">URL</label>
                        <input name="url" type="text" class="form-control" id="NamaKelas" value="<?= $submenu['url']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Icon (fontawesome.com)</label>
                        <input name="icon" type="text" class="form-control" id="NamaKelas" value="<?= $submenu['icon']; ?>">
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Buka" value="1" <?php if ($submenu['is_active']  == 1) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Buka">ON</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" name="inlineRadioOptions" id="Tutup" value="0" <?php if ($submenu['is_active']  == 0) : echo "checked";
                                                                                                                                    endif; ?>>
                        <label class="form-check-label" for="Tutup">OFF</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>