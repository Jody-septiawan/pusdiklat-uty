<?php
$peserta = $detail['jum_peserta']['jum_peserta'];
$lulus = $detail['lulus']['lulus'];
$tidak_lulus = $peserta - $lulus;
$persen_lulus = round($lulus / $peserta * 100, 2);
$persen_tidak_lulus = round($tidak_lulus / $peserta * 100, 2);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card bg-light card-1">
                <div class="card py-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <table class="table table-hover rounded">
                                    <tr>
                                        <th class="h5 align-middle">Sertifikasi</th>
                                        <td class="align-middle"><?= $detail['sertifikasi']['sertifikasi']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="h5">Peserta</th>
                                        <td class="align-middle"><?= $detail['jum_peserta']['jum_peserta']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="h5">Lulus</th>
                                        <td class="align-middle"><?= $detail['lulus']['lulus']; ?> (<?= $persen_lulus ?>%)</td>
                                    </tr>
                                    <tr>
                                        <th class="h5">Tidak lulus</th>
                                        <td class="align-middle"><?= $tidak_lulus; ?> (<?= $persen_tidak_lulus ?>%)</td>
                                    </tr>
                                    <tr>
                                        <th class="h5">Tanggal</th>
                                        <td class="align-middle"><span class="bg-info text-white p-1 rounded"><?= date('d-M-Y', $awal); ?></span> sampai <span class="bg-info text-white p-1 rounded"><?= date('d-M-Y', $akhir); ?></span></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary btn-block" onclick="self.close()">Kembali</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal">Detail peserta</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <canvas id="doughnut-chart" width="800" height="450"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>No identitas</th>
                                        <th>Nama</th>
                                        <th>Institusi</th>
                                        <th>Email</th>
                                        <th>Presensi</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($detailUser as $u) : ?>
                                        <tr class="<?php if ($u['keterangan'] == 'Tidak lulus') {
                                                        echo 'table-danger';
                                                    } ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $u['no_identitas'] ?></td>
                                            <td><?= $u['nama'] ?></td>
                                            <td><?= $u['institusi'] ?></td>
                                            <td><?= $u['email'] ?></td>
                                            <td><?php if ($u['presensi'] == 1) {
                                                    echo "Hadir";
                                                } else {
                                                    echo "Tidak Hadir";
                                                } ?></td>
                                            <td><?= $u['nilai'] ?></td>
                                            <td><?= $u['keterangan'] ?></td>
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