<div class="container-fluid rekap ">
    <div class="row mb-4">
        <div class="col-md-12">
            <?php
            if ($hasilCek) :
            ?>
                <div class="card ">
                    <div class="card-header text-light bg-primary border-bottom-warning">
                        Periode laporan
                    </div>
                    <div class="card-body text-dark shadow body-rekap">
                        <form action="<?= base_url('rekap') ?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sejak tanggal</label>
                                <input type="date" class="form-control" id="exampleInputPassword1" name="sejak" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hingga tanggal</label>
                                <input type="date" class="form-control" id="exampleInputPassword1" name="hingga" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cek</button>
                            <a href="<?= base_url('rekap/index/1') ?>" class="btn btn-primary">3 Bulan terakhir</a>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <div class="text-center">
                    <h1 class="text-center text-warning"><i class="fa fa-spinner fa-spin"></i> UNDER MAINTENANCE <i class="fa fa-spinner fa-spin"></i></h1>
                    <img src="<?= base_url('assets/img/ilustrasi/maintenance.svg') ?>" alt="" width="40%" class="img-fluid">
                </div>

            <?php endif; ?>
        </div>
        <?php
        if ($hasilCek) {
        ?>

    </div>

    <div class="row my-4">
        <div class="col-md-12">
            <div class="card mt-1 mb-5 shadow">
                <div class="card-header text-light bg-primary border-bottom-warning">
                    <div class="row">
                        <div class="col align-self-center">
                            <b class="btn btn-light"><?= date('d M Y', $awal); ?></b> s/d <b class="btn btn-light"><?= date('d M Y', $akhir); ?></b>
                        </div>
                        <div class="col text-right">
                            <span class="btn btn-light align-self-center">
                                Cetak semua
                                <a href="<?= base_url('rekap/cetakallpdf/') . $awal . '/' . $akhir ?>" target="blank"><span class="btn btn-danger btn-sm p-1 ml-1"><i class="fa fa-fw fa-file-pdf text-light " aria-hidden="true"></i></span></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Jadwal</th>
                                    <th>Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($hasilCek as $dk) : ?>
                                    <tr class="text-center text-dark">
                                        <td><?= $no++; ?></td>
                                        <td><?= $dk['nama'] ?></td>
                                        <td><?= date('d M Y H:i', $dk['tanggal']) ?> WIB</td>
                                        <td><?= $dk['peserta'] ?></td>
                                        <td>
                                            <form action="<?= base_url('rekap/detailkelas') ?>" method="post">
                                                <input type="hidden" name="awal" value="<?= $awal; ?>">
                                                <input type="hidden" name="akhir" value="<?= $akhir; ?>">
                                                <input type="hidden" name="id" value="<?= $dk['id']; ?>">
                                                <button formtarget="_blank" type="submit" class="btn btn-primary btn-sm p-1"><i class="fa fa-fw fa-search text-light " aria-hidden="true"></i></button>
                                                <a href="<?= base_url('rekap/cetakpdf/') . $dk['id']; ?>" target="blank"><span class="btn btn-danger btn-sm p-1"><i class="fa fa-fw fa-file-pdf text-light " aria-hidden="true"></i></span></a>
                                                <!-- <a href=""><span class="btn btn-success btn-sm p-1"><i class="fa fa-fw fa-file-excel text-light " aria-hidden="true"></i></span></a> -->
                                            </form>
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
<?php }
        if ($DataResult == 0) { ?>
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-danger text-light">
                result not found
            </div>
            <div class="card-body body-rekap">
                <img src="<?= base_url('assets/img/ilustrasi/not_found_red.svg') ?>" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
</div>