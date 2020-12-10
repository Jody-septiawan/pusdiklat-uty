<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Rekap Pengajuan</h5>
    <br>

    <div class="row">
        <div class="col-lg-11 mx-4">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="mx-4">
        <table class="table table-hover col-md-10" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kegiatan</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Nomor Sertifikat</th>
                    <th scope="col">Hapus</th>
                    <th scope="col">Tambah Penerima</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($penomoran as $nmr) : ?>

                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $nmr->nama_kegiatan ?></td>

                        <td><?php echo anchor('user/detail/' . $nmr->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i></div>') ?></td>

                        <td>
                            <?php
                            if ($nmr->status == 1) {
                            ?>
                                <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal<?= $nmr->id  ?>">
                                    Proses
                                </div>
                            <?php
                            } else if ($nmr->status  == 2) {
                            ?>
                                <div class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?= $nmr->id  ?>">
                                    Terbit
                                </div>
                            <?php
                            } else if ($nmr->status  == 3) {
                            ?>
                                <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal<?= $nmr->id  ?>">
                                    Revisi
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal<?= $nmr->id  ?>">
                                    Susulan
                                </div>
                            <?php
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            if ($nmr->status == 2 && $user['name'] == 'PUSDIKLAT EPT') {
                                echo anchor('user/excel/' . $nmr->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-download"></i></div>');
                            } else if ($nmr->status == 2) {
                                echo anchor('user/pdf/' . $nmr->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-download"></i></div>');
                            }
                            ?>
                        </td>
                        <!-- 

                    <td>
                        <?php
                        if ($nmr->status == 3) {
                            echo anchor('user/edit/' . $nmr->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-edit"></i></div>');
                        }
                        ?>
                    </td> -->

                        <?php
                        if ($nmr->status != 2 && $nmr->status != 4) {
                        ?>
                            <td>
                                <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $nmr->id  ?>">
                                    <i class="fa fa-trash"></i>
                                </div>

                                <div class="modal fade" id="modal2<?= $nmr->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Pengajuan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Apakah anda yakin untuk menghapus pengajuan <?= $nmr->nama_kegiatan  ?> ?</p>
                                            </div>

                                            <div class="modal-footer"></div>
                                            <center>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <?php echo anchor('user/hapus/' . $nmr->id, '<div class="btn btn-danger">Hapus</div>') ?>
                                            </center>
                                            <br>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td></td>
                        <?php
                        }
                        ?>

                        <?php
                        if ($nmr->status == 2) {
                        ?>
                            <td>
                                <div class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal2<?= $nmr->id  ?>">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td></td>
                        <?php
                        }
                        ?>

                        <div class="modal fade" id="exampleModal<?= $nmr->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Catatan Revisi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <?php echo $nmr->pesan; ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                    <center>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <?php
                                        if ($nmr->status == 3) {
                                            echo anchor('user/edit/' . $nmr->id, '<div class="btn btn-danger">Edit Permohonan</div>');
                                        }
                                        ?>
                                        <br>
                                        <br>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <!-- modal tambah penerima -->
                        <div class="modal fade" id="exampleModal2<?= $nmr->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Penerima</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="pengajuan_susulan" method="post" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="penerima" class="col-sm-4 col-form-label"><b>Daftar Penerima</b></label>
                                                <div class="col-sm-8">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $nmr->id ?>">
                                                        <input type="file" class="custom-file-input" id="penerima" name="penerima" accept=".xlsx" required>
                                                        <label class="custom-file-label" for="penerima ">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </center>

                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>

                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->