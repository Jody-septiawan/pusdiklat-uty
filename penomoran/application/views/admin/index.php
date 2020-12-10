<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Nomor</h1>
</div>
<!-- /.container-fluid -->

<div class="row">
    <div class="col-lg-8 ml-4">
        <?= $this->session->flashdata('message');  ?>
    </div>
</div>

<div class="mx-4">
    <table class="table table-hover col-md-12" id="dataTable">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Penyelenggara</th>
            <th scope="col">Nama Kegiatan</th>
            <th scope="col">Tanggal Kegiatan</th>
            <th scope="col">Detail</th>
            <th scope="col">Revisi</th>
            <th scope="col">Terbitkan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($penomoran as $nmr) : ?>

                <tr>
                    <td scope="row"><?php echo $no++ ?></td>
                    <td scope="row"><?php echo $nmr->penyelenggara ?></td>
                    <td scope="row"><?php echo $nmr->nama_kegiatan ?></td>
                    <td scope="row"><?php echo $nmr->tanggal_kegiatan ?></td>

                    <td><?php echo anchor('admin/detail/' . $nmr->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i></div>') ?></td>


                    <!-- revisi -->
                    <td>
                        <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal<?= $nmr->id  ?>">
                            <i class="fa fa-edit"></i>
                        </div>


                        <div class="modal fade" id="exampleModal<?= $nmr->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Catatan Revisi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="<?php echo base_url() . 'admin/revisi'; ?>" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="id" class="form-control" value="<?php echo $nmr->id ?>">
                                                <textarea rows="8" class="form-control" id="pesan" name="pesan" placeholder="ketik disini..."></textarea>
                                            </div>
                                        </div>

                                        <center>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Revisi</button>
                                            <br>
                                        </center>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- terbit -->
                    <td>
                        <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $nmr->id  ?>">
                            <i class="fa fa-file-pdf"></i>
                        </div>


                        <div class="modal fade" id="modal<?= $nmr->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Penerbitan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                    $kueri = "SELECT keterangan,COUNT('id') AS jumlah FROM detail_penerima WHERE id_pengajuan = $nmr->id GROUP BY keterangan";
                                    $coba['data'] = $this->db->query($kueri)->result_array();
                                    ?>

                                    <form action="<?php echo base_url() . 'admin/terbit'; ?>" method="post">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <input type="hidden" name="id" class="form-control" value="<?= $nmr->id ?>">
                                                <input type="hidden" class="form-control" id="penerbit" name="penerbit" value="<?= $user['id'] ?>">
                                                <label for="name" class="col-sm-4 col-form-label">Tanggal Terbit</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value="<?= date("d-M-Y") ?>" readonly>
                                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jenis" class="col-sm-4 col-form-label">Jenis Kegiatan</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="jenis" name="jenis">
                                                        <?php foreach ($jenis as $jn) : ?>
                                                            <option value="<?= $jn['id'] ?>">
                                                                <?= $jn['jenis_kegiatan'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea rows="8" class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"><?php
                                                                                                                                                    foreach ($coba['data'] as $result) {
                                                                                                                                                        echo $result['keterangan'] . "=" . $result['jumlah'] . "&#13;&#10;";
                                                                                                                                                    }
                                                                                                                                                    ?></textarea>
                                                    <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <center>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Terbitkan</button>
                                            <br>
                                        </center>
                                    </form>
                                    <br>
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
<!-- End of Main Content -->


<!-- Modal -->