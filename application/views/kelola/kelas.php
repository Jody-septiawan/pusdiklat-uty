<div class="container-fluid">
    <?php
    // date_default_timezone_set('Asia/Jakarta');
    ?>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning">
            <div class="row">
                <div class="col">
                    <span class="text-light">Jadwal sertifikasi</span>
                </div>
                <div class="col text-right">
                    <button class="btn btn-success py-0" data-toggle="modal" data-target="#newKelas">Tambah kelas</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-center">
                            <th width="1">No</th>
                            <th width="150">Kelas</th>
                            <th width="200">Waktu</th>
                            <th width="1">Kuota</th>
                            <th width="1">Peserta</th>
                            <th width="1">Proctor</th>
                            <th width="1">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kelas as $k) : ?>
                            <tr class="text-center">
                                <td class="pb-0 pt-2"><?= $no++; ?></td>
                                <td class="pb-0 pt-2"><?= $k['nama']; ?></td>
                                <td class="pb-0 pt-2"><?= date('d M Y H:i', $k['tanggal']); ?> WIB</td>
                                <td class="pb-0 pt-2"><?= $k['kuota']; ?></td>
                                <td class="pb-0 pt-2"><?= $k['peserta']; ?></td>
                                <td>
                                    <?php if (empty($k['proctor'])) : ?>
                                        -
                                    <?php endif; ?>
                                    <?= $k['proctor'] ?>
                                </td>
                                <td class="pb-0 pt-2"><?php
                                                        if ($k['status'] == 1) {
                                                            echo '<p class="text-success">Buka<p>';
                                                        } else {
                                                            echo '<p class="text-danger">Tutup<p>';
                                                        }
                                                        ?></td>
                                <td>
                                    <a href="<?= base_url('kelola_sertifikasi/detailkelas/') . $k['id']; ?>"><i class="fa fa-list text-light mx-0 rounded-circle p-2 bg-primary icon-kelas"></i></a>
                                    <a href="<?= base_url('kelola_sertifikasi/editkelas/') . $k['id']; ?>"><i class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></a>
                                    <a href="<?= base_url('kelola_sertifikasi/deletekelas/') . $k['id']; ?>" class="tombol-delete-kelas"><i class="fa fa-trash text-light mx-0 rounded-circle p-2 bg-danger icon-kelas"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kelola_sertifikasi/addkelas'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama kelas</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTanggal">Tanggal</label>
                        <input type="datetime-local" name="waktu" class="form-control" id="exampleInputTanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKuota">Kuota</label>
                        <input type="number" name="kuota" class="form-control" id="exampleInputEmail1" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1" value="1" checked>
                        <label class="form-check-label" for="exampleCheck1">Buka kelas</label>
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