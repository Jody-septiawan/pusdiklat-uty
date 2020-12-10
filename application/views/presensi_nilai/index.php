<?php
date_default_timezone_set('Asia/Jakarta');
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary border-bottom-warning py-2">
            <div class="row">
                <div class="col">
                    <span class="text-light">Kelas</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if (empty($kelas)) : ?>
                    <div class="h3 text-center py-5"> Hari ini tidak ada Ujian Sertifikasi</div>
                <?php else : ?>
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-left">
                                <th width="1">No</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                                <th>Lokasi</th>
                                <th>Pukul (WIB)</th>
                                <th>Peserta</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kelas as $k) : ?>
                                <?php if ($k['hari'] == date("d", $timeNow)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $k['nama'] ?></td>
                                        <td><?= $k['ruangan'] ?></td>
                                        <td><?= $k['lokasi'] ?></td>
                                        <td><?= date("H:y", $k['tanggal']) ?></td>
                                        <td><?= $k['peserta'] ?></td>
                                        <td>
                                            <a href="<?= base_url('ptr/detailkelas/') . $k['id']; ?>"><i class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></span></a>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($no == 1) : ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="h3 text-center py-5"> Hari ini tidak ada ujian sertifikasi</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>