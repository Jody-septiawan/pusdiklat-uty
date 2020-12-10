<div class="container-fluid">
    <div class="col-md-10">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow mb-5">
            <div class="card-header bg-primary border-bottom-warning">
                <div class="row">
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#newSertifikasi">Tambah sertifikasi</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="example9">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Sertifikasi</th>
                                <th>Ket</th>
                                <th>Standar nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($sertifikasi as $s) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td width="390"><?= $s['nama_sertifikasi']; ?></td>
                                    <td class="text-center"><?= $s['alias']; ?></td>
                                    <td class="text-center"><?= $s['std_nilai']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kelola_web/editsertifikasi/') . $s['id']; ?>">
                                            <i class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i>
                                        </a>
                                        <a href="<?= base_url('kelola_web/deletesertifikasi/') . $s['id']; ?>" class="tombol-delete-sertifikasi">
                                            <i class="fa fa-trash text-light mx-0 rounded-circle py-2 px-2 bg-danger icon-kelas"></i>
                                        </a>
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

<!-- Modal -->
<div class="modal fade" id="newSertifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sertifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kelola_web/addsertifikasi'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama sertifikasi</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Ket</label>
                        <input type="text" name="ket" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Standar nilai</label>
                        <input type="number" name="nilai" class="form-control" id="exampleInputNama" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>