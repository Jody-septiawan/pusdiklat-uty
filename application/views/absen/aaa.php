<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="">
        <div class="">
            <!-- Begin table -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Peserta Ujian</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url('absen/resetKehadiran/') . $id_sertifikasi; ?>" class="badge badge-success mb-2 p-2">Reset kehadiran</a>
                        <a href="<?= base_url('absen/resetNilai/') . $id_sertifikasi; ?>" class="badge badge-success mb-2 p-2 ml-1">Reset nilai</a>
                    </div>

                    <?php
                    if (empty($AbsenMos)) { ?>

                        <h4>Empty</h4>

                    <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Identitas</th>
                                        <th>Nama</th>
                                        <th>HP</th>
                                        <th>Email</th>
                                        <th>Kehadiran</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $No = 1;
                                    foreach ($AbsenMos as $amos) :
                                    ?>
                                        <tr>
                                            <td><?= $No++; ?></td>
                                            <td><?= $amos['no_identitas']; ?></td>
                                            <td><?= $amos['nama']; ?></td>
                                            <td><?= $amos['hp']; ?></td>
                                            <td><?= $amos['email']; ?></td>
                                            <td><?php if ($amos['presensi'] == 1) {
                                                    echo '<span class="text-success">Hadir</span>';
                                                } else {
                                                    echo '<span class="text-danger">Belum hadir</span>';
                                                } ?></td>
                                            <td><?= $amos['nilai']; ?></td>
                                            <td>
                                                <?php if ($amos['keterangan'] == "Lulus") { ?>
                                                    <span class="text-success"><?= $amos['keterangan']; ?></span>
                                                <?php } else { ?>
                                                    <span class="text-danger"><?= $amos['keterangan']; ?></span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        </div>
                </div>
            </div>

            <!-- End table -->
        </div>
    </div>
</div>

<!-- End of Main content -->
</div>