<!-- CONTENT -->
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<div class="container m-0 pb-5 my-bg">
    <div class="row ">
        <div class="col-md-12">
            <h3 class="text-center text-light my-3"><?= $judul; ?></h3>
            <hr class="bg-light">
            <h4>
                <span class="badge badge-info py-1 px-2">
                    <?= $tglSekarang; ?> WIB
                </span>
                <span class="badge badge-success py-1 px-2">
                    Jumlah peserta
                    <span class="badge badge-light"><?= $JumlahPeserta; ?></span>
                </span>
                <span class="badge <?php if ($BelumHadir == 0) {
                                        echo 'badge-success';
                                    } else {
                                        echo 'badge-danger';
                                    } ?> py-1 px-2">
                    Belum hadir
                    <span class="badge badge-light"><?= $BelumHadir; ?></span>
                </span>
                <span class="badge <?php if ($hadir != 0) {
                                        echo 'badge-success';
                                    } else {
                                        echo 'badge-danger';
                                    } ?> py-1 px-2">
                    Hadir
                    <span class="badge badge-light"><?= $hadir; ?></span>
                </span>

            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- <div class="input-group">
                <input type="text" class="form-control" id="search-input" placeholder="id / no peserta">
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button" id="search-button">Search</button>
                </div>
            </div> -->
            <div class="card shadow mt-2">
                <div class="card-header">
                    <?php foreach ($kloter as $k) : ?>
                        <a href="<?= base_url('presensi/') . $nama_sert . '/' . $k['id'] ?>" class="btn  p-0 px-2 m-0 float-left mr-1 <?php if ($k['id'] == $id_kloter) {
                                                                                                                                            echo 'btn-kloter-active';
                                                                                                                                        } else {
                                                                                                                                            echo 'btn-kloter';
                                                                                                                                        } ?> "><?= $k['nama'] ?></a>
                    <?php endforeach; ?>
                </div>
                <?php if ($JumlahPeserta != 0) { ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-0" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id/no identitas</th>
                                        <th>Nama Peserta</th>
                                        <th>Institusi</th>
                                        <th>HP</th>
                                        <th>Email</th>
                                        <th>Kloter</th>
                                        <th>Presensi | Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($peserta as $p) : ?>
                                        <tr>
                                            <td><?= $p['id'] . ' / ' . $p['no_identitas'] ?></td>
                                            <td><?= $p['nama'] ?></td>
                                            <td><?= $p['institusi'] ?></td>
                                            <td><?= $p['hp'] ?></td>
                                            <td><?= $p['email'] ?></td>
                                            <td><?= $p['kloter'] ?></td>
                                            <td>
                                                <?php if ($p['presensi'] == 0) { ?>
                                                    <a href="<?= base_url('presensi/InputPresensi/') . $p['id'] . '/' . $p['id_sertifikasi'] . '/' . $id_kloter; ?>" class="btn btn-success tombol-hadir">Hadir</a>
                                                <?php } elseif ($p['presensi'] == 1 && $p['nilai'] == 0) { ?>
                                                    <form action="<?= base_url('presensi/InputNilai') ?>" method="post">
                                                        <div class="input-group">
                                                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                                            <input type="hidden" name="id_sert" value="<?= $p['id_sertifikasi']; ?>">
                                                            <input type="number" name="nilai" class="form-control" id="search-input" min="1" max="1000" placeholder="Nilai">
                                                            <input type="hidden" name="kloter" value="<?= $id_kloter; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-success" type="submit" id="search-button">Simpan</button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <a href="<?= base_url('presensi/HapusPresensi/') . $p['id'] . '/' . $p['id_sertifikasi'] . '/' . $id_kloter; ?>" class="btn btn-danger" type="submit" id="search-button">X</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php } else { ?>
                                                    <b><?= $p['nilai']; ?></b>
                                                    <a href="<?= base_url('presensi/hapusnilai/') . $p['id'] . '/' . $p['id_sertifikasi'] . '/' . $id_kloter; ?>" class="badge badge-danger tombol-hapus-nilai">Hapus</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <h3 class="p-0 mx-3 my-3">Empty</h3>
                <?php } ?>
            </div>
        </div>
    </div>
</div>