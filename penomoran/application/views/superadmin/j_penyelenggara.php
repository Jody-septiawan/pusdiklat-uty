<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Jenis Penyelenggara</h5>

    <div class="row">
        <div class="col-lg-7 ml-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah Jenis Penyelenggara</a>

    <div class="col-lg-7">

        <table class="table table-hover col-md-5 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Jenis Penyelenggara</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($j_penyelenggara as $jp) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $jp['jenis_penyelenggara'] ?></td>
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $jp['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $jp['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Penyelenggara</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_jpenyelenggara'; ?>" method="post">
                                            <div class="modal-body">
                                                <label for="name" class="col-sm-6 col-form-label"><b>Jenis Penyelenggara</b></label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $jp['id'] ?>">
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= $jp['jenis_penyelenggara'] ?>" required>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
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
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $jp['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal2<?= $jp['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Penyelenggara</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus jenis penyelenggara <?= $jp['jenis_penyelenggara'] ?> ?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_jpenyelenggara/' . $jp['id'], '<div class="btn btn-danger">Hapus</div>') ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Penyelenggara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_jpenyelenggara" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <label for="name" class="col-sm-8 col-form-label"><b> Jenis Penyelenggara</b></label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="jp" name="jp" required>
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