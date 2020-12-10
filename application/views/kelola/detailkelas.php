<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning text-light">
            <div class="row">
                <div class="col">
                    Kelas : <?= $kelas['nama']; ?>
                    <span class="badge badge-info"><?= date('H:i', $kelas['tanggal']); ?> WIB</span>
                    <span class="badge badge-info"><?= date('d M Y', $kelas['tanggal']); ?></span>
                </div>
                <div class="col text-right">
                    Proctor :
                    <?php if ($kelas['proctor']) : ?>
                        <?= $kelas['proctor']; ?>
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Identitas</th>
                            <th>Nama & kontak</th>
                            <th>Institusi</th>
                            <th>Sertifikasi</th>
                            <th>Spesifikasi</th>
                            <th>Kehadiran</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $p) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $p['no_identitas']; ?></td>
                                <td>
                                    <div class="text-dark"><?= $p['nama']; ?></div>
                                    <div class="font-weight-light"><?= $p['email']; ?></div>
                                    <div class="font-weight-light"><?= $p['hp']; ?></div>
                                </td>
                                <td><?= $p['institusi']; ?></td>
                                <td><?= $p['sertifikasi']; ?></td>
                                <td><?= $p['spesifikasi']; ?></td>
                                <td>
                                    <?php if ($p['presensi'] == 1) : ?>
                                        <div class="text-success">Hadir</div>
                                    <?php else : ?>
                                        <div class="text-danger">Tidak hadir</div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $p['nilai']; ?></td>
                                <td>
                                    <?php if ($p['keterangan'] == "Lulus") : ?>
                                        <div class="text-success">Lulus</div>
                                    <?php else : ?>
                                        <div class="text-danger">Tidak lulus</div>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?= base_url('kelola_sertifikasi') ?>" class="btn btn-light text-primary">&#8592; Kembali</a>
        </div>
    </div>
</div>