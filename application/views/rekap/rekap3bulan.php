<div class="container-fluid">
    <div class="row ">
        <div class="col">
            <div class="alert alert-light text-primary shadow mb-3">
                <div class="row">
                    <div class="col my-auto">
                        <span class="text-dark"> Laporan 3 bulanan : </span> <?= $tigabulan; ?> s/d <?= $sekarang; ?>
                    </div>
                    <div class="col text-right">
                        <button class="btn px-1 btn-light text-primary" onclick="self.close()">&#8592; Kembali</button>
                        <span class="btn bg-dark py-2 text-light">Cetak semua
                            <a href="#" class="btn btn-danger px-0 py-0 ml-2"><i class="fa fa-fw fa-file-pdf text-light" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-success px-0 py-0"><i class="fa fa-fw fa-file-excel text-light" aria-hidden="true"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-2">
                    <span class="text-light">Kelas</span>
                </div>
                <div class="card-body pt-2">
                    <div class="table-respossive">
                        <table class="table mb-0" id="example">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-2" width="1">No</th>
                                    <th class="py-2">Kelas</th>
                                    <th class="py-2">Waktu</th>
                                    <th class="py-2">Peserta</th>
                                    <th class="py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kelas as $k) : ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $k['nama']; ?></td>
                                        <td><?= date('d M Y', $k['tanggal']); ?></td>
                                        <td><?= $k['peserta']; ?></td>
                                        <td>
                                            <a href=""><span class="btn btn-danger p-0"><i class="fa fa-fw fa-file-pdf text-light" aria-hidden="true"></i></span></a>
                                            <a href=""><span class="btn btn-success p-0"><i class="fa fa-fw fa-file-excel text-light" aria-hidden="true"></i></span></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right py-2">
                    <span class="btn bg-dark py-2 text-light">Cetak semua kelas
                        <a href="#" class="btn btn-danger px-0 py-0 ml-2"><i class="fa fa-fw fa-file-pdf text-light" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-success px-0 py-0"><i class="fa fa-fw fa-file-excel text-light" aria-hidden="true"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-5 shadow">
                <div class="card-header bg-primary border-bottom-warning py-2">
                    <span class="text-light">Jenis Sertifikasi</span>
                </div>
                <div class="card-body">
                    <div class="table-respossive">
                        <table class="table" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-2" width="1">No</th>
                                    <th class="py-2">Jenis sertifikasi</th>
                                    <th class="py-2">Peserta</th>
                                    <th class="py-2">Lulus</th>
                                    <th class="py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($jenis_sertifikasi as $js) : ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $js['alias'] ?></td>
                                        <td><?= $js['peserta'] ?></td>
                                        <td><?= $js['lulus'] ?></td>
                                        <td>
                                            <a href=""><span class="btn btn-danger p-0"><i class="fa fa-fw fa-file-pdf text-light" aria-hidden="true"></i></span></a>
                                            <a href=""><span class="btn btn-success p-0"><i class="fa fa-fw fa-file-excel text-light" aria-hidden="true"></i></span></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right py-2">
                    <span class="btn bg-secondary py-2 text-light">Cetak semua jenis sertifikasi
                        <a href="#" class="btn btn-danger px-0 py-0 ml-2"><i class="fa fa-fw fa-file-pdf text-light" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-success px-0 py-0"><i class="fa fa-fw fa-file-excel text-light" aria-hidden="true"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>