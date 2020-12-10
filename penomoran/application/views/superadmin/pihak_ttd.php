<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h3 mb-4 text-gray-800">Pihak Tanda Tangan</h5>

    <div class="row">
        <div class="col-lg-7 ml-3">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <a href="" class="btn btn-primary mb-3 ml-2" data-toggle="modal" data-target="#exampleModal">Tambah Pihak Tanda Tangan</a>

    <div class="col-lg-7">

        <table class="table table-hover col-md-7 ml-3" id="dataTable">
            <thead>
                <th scope="col">No</th>
                <!-- <th scope="col">Pihak Ke-</th> -->
                <th scope="col">Jabatan</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($pihak_ttd as $ttd) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <!-- <td><?= $ttd['pihak_ke'] ?></td> -->
                        <td><?= $ttd['jabatan'] ?></td>
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $ttd['id']  ?>">
                                <i class="fa fa-edit"></i>
                            </div>

                            <div class="modal fade" id="modal<?= $ttd['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Pihak Tanda Tangan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="<?php echo base_url() . 'superadmin/edit_ttd'; ?>" method="post">
                                            <div class="modal-body">
                                                <!-- <div class="form-group row">
                                                    <label for="pihak_ke" class="col-sm-3 col-form-label"><b>Pihak Ke-</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $ttd['id'] ?>">
                                                        <select class="form-control" id="pihak_ke" name="pihak_ke">
                                                            <option value="1">Satu</option>
                                                            <option value="2">Dua</option>
                                                            <option value="3">Tiga</option>
                                                        </select>
                                                        <?= form_error('pihak_ke', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div> -->

                                                <div class="form-group row">
                                                    <label for="jabatan" class="col-sm-3 col-form-label"><b>Jabatan</b></label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $ttd['id'] ?>">
                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $ttd['jabatan'] ?>" required>
                                                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
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
                            <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal2<?= $ttd['id']  ?>">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="modal fade" id="modal2<?= $ttd['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Pihak Tanda Tangan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus <?= $ttd['jabatan']  ?> dari pihak tanda tangan?</p>
                                        </div>

                                        <div class="modal-footer"></div>
                                        <center>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('superadmin/hapus_ttd/' . $ttd['id'], '<div class="btn btn-danger">Hapus</div>') ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pihak Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="tambah_ttd" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <!-- <div class="form-group row">
                        <label for="pihak_ke" class="col-sm-3 col-form-label"><b>Pihak Ke-</b></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="pihak_ke" name="pihak_ke">
                                <option value="1">Satu</option>
                                <option value="2">Dua</option>
                                <option value="3">Tiga</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 col-form-label"><b>Jabatan</b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
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