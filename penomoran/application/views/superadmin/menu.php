<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Daftar Menu</h5>

    <div class="row">
        <div class="col-lg-7 ml-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah Menu</a>

    <div class="col-lg-7">

        <table class="table table-hover col-md-6 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">Edit</th>
                <th scope="col">Status</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($user_menu as $mn) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $mn['menu'] ?></td>
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $mn['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $mn['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_menu'; ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label"><b>Nama Menu</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $mn['id'] ?>">
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= $mn['menu'] ?>" required>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <br>
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
                        </td>

                        <td>
                            <?php
                            if ($mn['status'] == 1) { ?>
                                <div class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal2<?= $mn['id']  ?>">
                                    <i>Aktif</i>
                                </div>
                            <?php } else { ?>
                                <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $mn['id']  ?>">
                                    <i>Non-Aktif</i>
                                </div>
                            <?php } ?>

                            <div class="modal fade" id="modal2<?= $mn['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <?php
                                            if ($mn['status'] == 1) { ?>
                                                <h5 class="modal-title" id="exampleModalLabel">Non-Aktifkan Menu</h5>
                                            <?php } else { ?>
                                                <h5 class="modal-title" id="exampleModalLabel">Aktifkan Menu</h5>
                                            <?php } ?>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <?php
                                            if ($mn['status'] == 1) { ?>
                                                <p>Apakah anda yakin untuk mengnon-aktifkan menu <?= $mn['menu']  ?> ?</p>
                                            <?php } else { ?>
                                                <p>Apakah anda yakin untuk mengaktifkan menu <?= $mn['menu']  ?> ?</p>
                                            <?php } ?>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <form action="<?php echo base_url() . 'superadmin/status_menu'; ?>" method="post">
                                            <input type="hidden" name="id" class="form-control" value="<?= $mn['id'] ?>">
                                            <?php
                                            if ($mn['status'] == 1) { ?>
                                                <input type="hidden" name="status" class="form-control" value="0">\
                                            <?php } else { ?>
                                                <input type="hidden" name="status" class="form-control" value="1">\
                                            <?php } ?>
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
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal3<?= $mn['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal3<?= $mn['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus menu <?= $mn['menu']  ?> ?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_menu/' . $mn['id'], '<div class="btn btn-danger">Hapus</div>') ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_menu" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><b>Nama Menu</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="menu" name="menu" required>
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