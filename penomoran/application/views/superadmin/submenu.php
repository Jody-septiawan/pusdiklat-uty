<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Daftar Sub Menu</h5>

    <div class="row">
        <div class="col-lg-12 mx-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah Sub Menu</a>

    <div class="col-lg-12">

        <table class="table table-hover col-md-6 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Sub Menu</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">URL</th>
                <th scope="col">Icon</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($submenu as $sm) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $sm['title'] ?></td>
                        <td><?= $sm['id_menu'] ?></td>
                        <td><?= $sm['url'] ?></td>
                        <td><?= $sm['icon'] ?></td>

                        <td>
                            <?php
                            if ($sm['status'] == 1) { ?>
                                <div class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal2<?= $sm['id']  ?>">
                                    <i>Aktif</i>
                                </div>
                            <?php } else { ?>
                                <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $sm['id']  ?>">
                                    <i>Non-Aktif</i>
                                </div>
                            <?php } ?>

                            <div class="modal fade" id="modal2<?= $sm['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <?php
                                            if ($sm['status'] == 1) { ?>
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
                                            if ($sm['status'] == 1) { ?>
                                                <p>Apakah anda yakin untuk mengnon-aktifkan submenu <?= $sm['title']  ?> ?</p>
                                            <?php } else { ?>
                                                <p>Apakah anda yakin untuk mengaktifkan submenu <?= $sm['title']  ?> ?</p>
                                            <?php } ?>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <form action="<?php echo base_url() . 'superadmin/status_submenu'; ?>" method="post">
                                            <input type="hidden" name="id" class="form-control" value="<?= $sm['id'] ?>">
                                            <?php
                                            if ($sm['status'] == 1) { ?>
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
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $sm['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $sm['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Sub Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_submenu'; ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label"><b>Sub Menu</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $sm['id'] ?>">
                                                        <input type="text" class="form-control" id="title" name="title" value="<?= $sm['title'] ?>" required>
                                                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="menu" class="col-sm-3 col-form-label"><b>Nama Menu</b></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="menu_id" name="menu_id">
                                                            <?php foreach ($user_menu as $menu) : ?>
                                                                <option value="<?= $menu['id'] ?>">
                                                                    <?= $menu['menu'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label"><b>URL</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url'] ?>" required>
                                                        <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label"><b>Icon</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon'] ?>" required>
                                                        <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
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
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal3<?= $sm['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal3<?= $sm['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus submenu <?= $sm['title']  ?> ?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_submenu/' . $sm['id'], '<div class="btn btn-danger">Hapus</div>') ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_submenu" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><b>Sub Menu</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title" required>
                            <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menu" class="col-sm-3 col-form-label"><b>Nama Menu</b></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="menu_id" name="menu_id">
                                <?php foreach ($user_menu as $menu) : ?>
                                    <option value="<?= $menu['id'] ?>">
                                        <?= $menu['menu'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><b>URL</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="url" name="url" required>
                            <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><b>Icon</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="icon" name="icon" required>
                            <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <br>
                    <center>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <br>
                    </center>
                </div>
            </form>

        </div>
    </div>
</div>