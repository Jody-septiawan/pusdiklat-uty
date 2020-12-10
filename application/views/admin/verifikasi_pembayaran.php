<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message');  ?>
            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-4">
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Kuota</th>
                                <th scope="col">Sisa Kuota</th>
                                <th scope="col">Jumlah Peserta yang masuk</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($verifikasi_pembayaran as $vp) : ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $vp['nama']; ?></td>
                                    <td><?= $vp['ruangan']; ?></td>
                                    <td><?= $vp['lokasi']; ?></td>
                                    <td><?= $vp['kuota']; ?></td>
                                    <td><?= $vp['sisa_kuota']; ?></td>
                                    <td><?= $vp['kuota'] - $vp['sisa_kuota']; ?></td>
                                    <td><?= date('d M Y H:i', $vp['tanggal']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/data_peserta/' . $vp['id']) ?>" type="button"><i class="fa fa-list text-light mx-0 rounded-circle p-2 bg-primary icon-kelas"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- End of Main Content -->