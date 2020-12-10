<div class="container-fluid">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $timeNow = time();
    ?>
    <div class="row">
        <div class="col-md-10 py-0 mb-1">
            <div class="card shadowx">
                <div class="card-body p-1">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr class="text-center bg-secondary text-light">
                                    <th width="1" class="py-1">Tanggal</th>
                                    <th width="1" class="py-1">Peserta</th>
                                    <th width="1" class="py-1">Hadir</th>
                                    <th width="1" class="py-1">Belum hadir</th>
                                    <th width="1" class="py-1">Belum input nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center bg-content-presensi">
                                    <td class="py-2 text-content-presensi"><?= date('d M Y', $timeNow); ?></td>
                                    <td class="py-2 text-content-presensi"><?= $totalpeserta; ?></td>
                                    <?php if ($hadir == 0) : ?>
                                        <td class="py-2  my-bg-danger text-light"><?= $hadir; ?></td>
                                    <?php else : ?>
                                        <td class="py-2 bg-success text-light"><?= $hadir; ?></td>
                                    <?php endif; ?>
                                    <?php if ($belumhadir != 0) : ?>
                                        <td class="py-2 my-bg-danger text-light"><?= $belumhadir; ?></td>
                                    <?php else : ?>
                                        <td class="py-2 bg-success text-light"><?= $belumhadir; ?></td>
                                    <?php endif; ?>
                                    <?php if ($beluminputnilai != 0) : ?>
                                        <td class="py-2 my-bg-danger text-light"><?= $beluminputnilai; ?></td>
                                    <?php else : ?>
                                        <td class="py-2 bg-success text-light"><?= $beluminputnilai; ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-header bg-primary border-bottom-warning text-light py-2">
            Peserta
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-left">
                            <th width="1">No</th>
                            <th width="140">No identitas</th>
                            <th width="140">Nama</th>
                            <th width="140">Spesifikasi</th>
                            <th class="text-center" width="140">Presensi & nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $p) : ?>
                            <tr>
                                <td class="text-left"><?= $no++; ?></td>
                                <td class="text-left"><?= $p['no_identitas']; ?></td>
                                <td>
                                    <div class="text-dark"><?= $p['nama_lengkap']; ?> <a href="#" class="text-info" data-toggle="modal" data-target="#detailPeserta<?= $p['id'] ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a> </div>
                                </td>
                                <td class="text-left" width="10"><?= $p['jenis_sertifikasi']; ?></td>
                                <td class="text-center">
                                    <?php if ($p['presensi'] == 0) : ?>
                                        <!-- Absensi -->
                                        <a href="<?= base_url('ptr/hadir/') . $p['id'] . '/' . $kelas_id; ?>" class="btn btn-success">Hadir</a>
                                    <?php else : ?>
                                        <?php if ($p['keterangan'] == null) : ?>
                                            <!-- Input nilai -->
                                            <form action="<?= base_url('ptr/inputnilai') ?>" method="post">
                                                <div class="input-group">
                                                    <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                                    <input type="hidden" name="sert_id" value="<?= $p['id_sertifikasi'] ?>">
                                                    <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                                                    <?php if ($p['id_sertifikasi'] == 1) : ?>
                                                        <input type="number" name="nilai" class="form-control" id="search-input" min="0" max="1000" placeholder="Nilai" required>
                                                    <?php else : ?>
                                                        <input type="number" name="nilai" class="form-control" id="search-input" min="0" max="100" placeholder="Nilai" required>
                                                    <?php endif; ?>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit" id="search-button">Simpan</button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url('ptr/belumhadir/') . $p['id'] . '/' . $kelas_id; ?>" class="btn btn-danger" type="submit" id="search-button">X</a>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else : ?>
                                            <span class="text-dark"><?= $p['nilai'] ?></span><a href="<?= base_url('ptr/hapusnilai/') . $p['id'] . '/' . $kelas_id; ?>" class=" btn btn-danger ml-2">Hapus</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right py-1">
            <a href="<?= base_url('ptr') ?>" class="btn btn-light text-primary">&#8592; Kembali</a>
        </div>
    </div>
</div>


<!-- Modal -->
<?php foreach ($peserta as $p) : ?>
    <div class="modal fade" id="detailPeserta<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 ">
                <div class="modal-header shadow bg-info">
                    <h5 class="modal-title text-light">Detail Peserta</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-5">
                    <div class="container-fluid">
                        <div class="group">
                            <div>No Identitas</div>
                            <div class="h4 ml-2 text-dark"><?= $p['no_identitas'] ?></div>
                        </div>
                        <div class="group">
                            <div>Nama Lengkap</div>
                            <div class="h4 ml-2 text-dark"><?= $p['nama_lengkap'] ?></div>
                        </div>
                        <div class="group">
                            <div>Institusi</div>
                            <div class="h4 ml-2 text-dark"><?= $p['institusi'] ?></div>
                        </div>
                        <?php
                        $prodi = $this->db->get_where('prodi', ['id' => $p['program_studi']])->row_array();
                        ?>
                        <?php if ($prodi) : ?>
                            <div class="group">
                                <div>Program Studi</div>
                                <div class="h4 ml-2 text-dark"> <?= $prodi['nama']; ?></div>
                            </div>
                        <?php endif; ?>
                        <hr>
                        <div class="group">
                            <div>No HP</div>
                            <div class="h4 ml-2 text-dark"><?= $p['no_hp'] ?></div>
                        </div>
                        <div class="group">
                            <div>Email</div>
                            <div class="h4 ml-2 text-dark"><?= $p['email'] ?></div>
                        </div>
                        <hr>
                        <div class="group">
                            <div>Sertifikasi</div>
                            <div class="h4 ml-2 text-dark"><?= $p['nama_sertifikasi'] ?> (<?= $p['alias'] ?>)</div>
                        </div>
                        <div class="group">
                            <div>Spesifikasi</div>
                            <div class="h4 ml-2 text-dark"><?= $p['jenis_sertifikasi'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-4 shadow bg-info">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>