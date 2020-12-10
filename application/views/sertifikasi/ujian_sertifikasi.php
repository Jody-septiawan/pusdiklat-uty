<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Perhatian !</strong> Silahkan Booking kelas terlebih dahulu.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?= $this->session->flashdata('message');  ?>
    <br>
    <div class="col-lg">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-sm-10 ">

        </div>
        <!-- DataTales Example -->
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning text-right">
                <a href="<?= base_url('sertifikasi/daftar_kelas')  ?>" class="btn btn-success py-1 my-0 " id="boking">Boking Kelas</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">No Identitas</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Ujian</th>

                                <th scope="col">Tanggal Pesan</th>
                                <th scope="col">Tarif</th>
                                <th scope="col">Status Boking</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($boking_kelas as $bk) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $bk['nama']; ?></td>
                                    <td><?= $bk['no_identitas']; ?></td>
                                    <td><?= $bk['nama']; ?></td>
                                    <td><?= $bk['jenis_sertifikasi']; ?></td>
                                    <td><?= $bk['tanggal_pesan']; ?></td>
                                    <td><?= $bk['tarif']; ?></td>
                                    <td><?= $bk['status_boking']; ?></td>
                                    <td>
                                        <?php if ($bk['is_active'] == 0) : ?>

                                            <a class=" badge badge-secondary py-1" href="<?= base_url('sertifikasi/konfirmasi/' . $bk['id']) ?>" onclick="return false;">
                                                <svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-hourglass-split" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13s-.866-1.299-3-1.48V8.35z" />
                                                </svg>
                                            </a>
                                        <?php else : ?>
                                            <a class=" badge badge-primary" href="<?= base_url('sertifikasi/konfirmasi/' . $bk['id']) ?>" data-toggle="modal" data-target="#konfirmasiModal<?= $bk['id'] ?>">
                                                <svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="konfirmasiModal<?= $bk['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembayaran</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('sertifikasi/konfirmasi/') . $bk['id'] . '/' . $bk['id_kelas'] . '/' . $bk['id_ujian']; ?>" method="POST" enctype="multipart/form-data">

                                                            <div class="form-group">
                                                                <label for="nama">Nama Lengkap</label>
                                                                <input type="text" hidden id="id" name="id" value="<?= $bk['id']; ?>">
                                                                <input type="text" class="form-control" id="nama" value="<?= $akun_user['nama_lengkap'];  ?>" name="nama" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kelas">Kelas</label>
                                                                <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $bk['nama'];  ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_slip">Nomor Slip</label>
                                                                <input type="text" class="form-control" id="no_slip" name="no_slip" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bukti_bayar">Bukti Pembayaran</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="bukti_bayar" name="bukti_bayar">
                                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

<!-- </div> -->
<!-- Button trigger modal -->