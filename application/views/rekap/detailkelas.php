<?php
$no = 0;
foreach ($dataSertifikasi as $ds) :
    $dataSertifikasi[$no]['persen_lulus'] = round($ds['lulus'] / $ds['peserta'] * 100, 2);
    $tidak = $ds['peserta'] - $ds['lulus'];
    $dataSertifikasi[$no]['persen_tidak_lulus'] = round($tidak / $ds['peserta'] * 100, 2);
    $no++;
endforeach;
?>
<?php $dataKelas = $dataKelas[0]; ?>
<div class="container-fluid pb-5">
    <div class="card card-1 mb-3">
        <div class="card-body py-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="text-dark"> Kelas :</span> <?= $dataKelas['nama'] ?>
                    </div>
                    <div class="text-center">
                        <span class="text-dark"> Jadwal :</span> <?= date('d M Y, H:i', $dataKelas['tanggal']) ?> WIB
                    </div>
                </div>
            </div>
            <button class="btn btn-lg btn-block btn-success py-1 mt-2" data-toggle="modal" data-target="#modalSemuaPeserta">Detail semua peserta</button>
        </div>
    </div>


    <?php $no = 0;
    foreach ($dataSertifikasi as $ds) : ?>
        <div class="card card-1 mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <table class="table table-hover">
                            <tr>
                                <th class="h5 text-dark" width="200">Sertifikasi</th>
                                <td class="text-dark"><?= $ds['nama_sertifikasi']; ?></td>
                            </tr>
                            <tr>
                                <th class="h5 text-dark">Peserta</th>
                                <td class="text-dark"><?= $ds['peserta'] ?></td>
                            </tr>
                            <tr>
                                <th class="h5 text-dark">Lulus</th>
                                <td class="text-dark"><?= $ds['lulus'] ?> (<?= $ds['persen_lulus'] ?>%)</td>
                            </tr>
                            <tr>
                                <th class="h5 text-dark">Tidak lulus</th>
                                <td class="text-dark"><?= $ds['peserta'] - $ds['lulus']; ?> (<?= $ds['persen_tidak_lulus'] ?>%)</td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal<?= $no + 1; ?>">Detail peserta</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <canvas id="doughnut-chart<?= $no + 1; ?>"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php $no++;
    endforeach; ?>
</div>

<?php $no = 0;
foreach ($DetailPeserta as $dp) : ?>
    <?php
    $id_sertifikasi = $dp['id_sertifikasi'];
    $kelas_id = $dataKelas['id'];
    $query = "SELECT * FROM peserta WHERE id_sertifikasi = $id_sertifikasi AND kelas_id = $kelas_id ORDER BY no_identitas ASC";
    $peserta = $this->db->query($query)->result_array();
    ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?= $no + 1; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-hover" id="example<?= $no + 1; ?>">
                            <thead>
                                <tr class="text-center">
                                    <th width="1">No</th>
                                    <th>No identitas</th>
                                    <th>Nama lengkap</th>
                                    <th>Email</th>
                                    <th>Kehadiran</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $noo = 1;
                                foreach ($peserta as $p) : ?>
                                    <?php if ($p['presensi'] == 0 || $p['keterangan'] == "Tidak lulus") : ?>
                                        <tr class="text-center table-danger">
                                        <?php else : ?>
                                        <tr class="text-center">
                                        <?php endif; ?>
                                        <td><?= $noo++; ?></td>
                                        <td><?= $p['no_identitas']; ?></td>
                                        <td><?= $p['nama']; ?></td>
                                        <td><?= $p['email']; ?></td>
                                        <td>
                                            <?php if ($p['presensi'] == 1) : ?>
                                                <span>Hadir</span>
                                            <?php else : ?>
                                                <span>Tidak hadir</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $p['nilai']; ?></td>
                                        <td><?= $p['keterangan']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php $no++;
endforeach; ?>

<!-- Modal semua peserta -->
<div class="modal fade" id="modalSemuaPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="example0">
                                <thead>
                                    <tr class="text-center">
                                        <th width="1">NO</th>
                                        <th>No identitas, nama & kontak</th>
                                        <th>Institusi</th>
                                        <th>Sertifikasi</th>
                                        <th>Spesifikasi</th>
                                        <th>Presensi</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($SemuaPeserta as $sp) : ?>
                                        <?php if ($sp['presensi'] == 0 || $sp['keterangan'] == "Tidak lulus") : ?>
                                            <tr class="text-center table-danger">
                                            <?php else : ?>
                                            <tr class="text-center">
                                            <?php endif; ?>
                                            <td class="align-middle"><?= $no++; ?></td>
                                            <td>
                                                <div><?= $sp['no_identitas'] ?></div>
                                                <div><?= $sp['nama'] ?></div>
                                                <div><?= $sp['hp'] ?></div>
                                                <div><?= $sp['email'] ?></div>
                                            </td>
                                            <td class="align-middle"><?= $sp['institusi'] ?></td>
                                            <td class="align-middle"><?= $sp['alias'] ?></td>
                                            <td class="align-middle">-</td>
                                            <td class="align-middle">
                                                <?php if ($sp['presensi'] == 1) : ?>
                                                    <span>Hadir</span>
                                                <?php else : ?>
                                                    <span>Tidak hadir</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle"><?= $sp['nilai']; ?></td>
                                            <td class="align-middle"><?= $sp['keterangan']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>