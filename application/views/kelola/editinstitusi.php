<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Institusi</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kelola_web/proseseditinstitusi') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $institusi['id']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Program Studi</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas" value="<?= $institusi['nama']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('kelola_web/institusi') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>