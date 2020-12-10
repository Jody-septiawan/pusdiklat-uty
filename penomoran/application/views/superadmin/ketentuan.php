<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800"><?= $aktif ?></h5>

    <div class="row">
        <div class="col-lg-9 ml-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah <?= $aktif ?></a>

    <div class="col-lg-9">

        <table class="table table-hover col-md-9 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Ketentuan</th>
                <th scope="col">File</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($ketentuan as $fl) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $fl['ketentuan'] ?></td>
                        <!-- <td><?= $fl['nama_file'] ?></td> -->

                        <td>
                            <a href="<?php echo base_url('superadmin/download2/' . $fl['id']); ?>">
                                <?php echo $fl['nama_file'] ?>
                            </a>
                        </td>


                        <!-- edit ketentuan -->
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $fl['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $fl['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Ketentuan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_ketentuan'; ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <label for="name" class="col-sm-4 col-form-label"><b>Nama Ketentuan</b></label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 mr-2">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $fl['id'] ?>">
                                                        <input type="hidden" class="form-control" id="pengupload" name="pengupload" value="<?= $user['id'] ?>">
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= $fl['ketentuan'] ?>" required>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <label for="name" class="col-sm-8 col-form-label"><b>File Ketentuan (jpg/jpeg/png)</b></label>
                                                <div class="form-group row">
                                                    <div class="col-sm-11 mx-3">
                                                        <input type="file" class="custom-file-input" id="file" name="file" required>
                                                        <label for="file" class="custom-file-label">Choose File</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer"></div>

                                            <center>

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <br>
                                            </center>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </td>


                        <!-- hapus ketentuan -->
                        <td>
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $fl['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal2<?= $fl['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Ketentuan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus ketentuan <?= $fl['ketentuan'] ?> ?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_ketentuan/' . $fl['id'], '<div class="btn btn-danger">Hapus</div>') ?>
                                        </center>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
    </div>
</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah File Ketentuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_ketentuan" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <label for="name" class="col-sm-4 col-form-label"><b>Nama Ketentuan</b></label>
                    <div class="form-group row">
                        <div class="col-sm-12 mr-2">
                            <input type="hidden" class="form-control" id="pengupload" name="pengupload" value="<?= $user['id'] ?>">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <label for="name" class="col-sm-8 col-form-label"><b>File Ketentuan (jpg/jpeg/png)</b></label>
                    <div class="form-group row">
                        <div class="col-sm-11 mx-3">
                            <input type="file" class="custom-file-input" id="file" name="file" required>
                            <label for="file" class="custom-file-label">Choose File</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <table align="center">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>