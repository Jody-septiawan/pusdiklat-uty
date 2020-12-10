<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">File Persyaratan</h5>

    <div class="row">
        <div class="col-lg-9 ml-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah File Persyaratan</a>

    <div class="col-lg-9">

        <table class="table table-hover col-md-9 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Persyaratan</th>
                <th scope="col">File</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($file as $fl) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $fl['persyaratan'] ?></td>
                        <!-- <td><?= $fl['nama_file'] ?></td> -->

                        <td>
                            <a href="<?php echo base_url('superadmin/download1/' . $fl['id']); ?>">
                                <?php echo $fl['nama_file'] ?>
                            </a>
                        </td>

                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $fl['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $fl['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Persyaratan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_persyaratan'; ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <label for="name" class="col-sm-12 col-form-label"><b>Nama Persyaratan</b></label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $fl['id'] ?>">
                                                        <input type="hidden" class="form-control" id="pengupload" name="pengupload" value="<?= $user['id'] ?>">
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= $fl['persyaratan'] ?>" required>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <label for="name" class="col-sm-12 col-form-label"><b>File Persyaratan (pdf/xls/xlsx)</b></label>
                                                <div class="form-group row">
                                                    <div class="col-sm-11 ml-3">
                                                        <input type="file" class="custom-file-input" id="file" name="file" required>
                                                        <label for="file" class="custom-file-label">Choose File</label>
                                                    </div>
                                                </div>
                                            </div>

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


                        <td>
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $fl['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal2<?= $fl['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Persyaratan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus persyaratan <?= $fl['persyaratan']  ?> ?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_persyaratan/' . $fl['id'], '<div class="btn btn-danger">Hapus</div>') ?>
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
        <br><br>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah File Persyaratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_persyaratan" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <label for="name" class="col-sm-8 col-form-label"><b> Nama Persyaratan</b></label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="pengupload" name="pengupload" value="<?= $user['id'] ?>">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <label for="name" class="col-sm-8 mr-5 col-form-label"><b>File Persyaratan (pdf/xls/xlsx) </b></label>
                    <div class="form-group row">
                        <div class="col-sm-11 ml-3">
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