<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pesan Belum Dibalas</h1>
</div>
<!-- /.container-fluid -->

<div class="row">
    <div class="col-lg-10 ml-4">
        <?= $this->session->flashdata('message');  ?>
    </div>
</div>
<div class="mx-4">
    <table class="table table-hover col-md-8" id="dataTable">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Pengirim</th>
            <th scope="col">Isi Pesan</th>
            <th scope="col">Waktu</th>
            <th scope="col">Lihat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($pesan as $psn) :
                if ($psn->pengirim != 2 and $psn->status == 1) { ?>

                    <tr>
                        <td scope="row"><?php echo $no++ ?></td>
                        <td scope="row"><?php echo $psn->name ?></td>
                        <td scope="row"><?php echo $psn->isi_pesan ?></td>
                        <td scope="row"><?php echo $psn->waktu ?></td>
                        <td>
                            <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalScrollable<?= $psn->id  ?>">
                                <i class="fa fa-eye"></i>
                            </div>

                            <div class="modal fade" id="exampleModalScrollable<?= $psn->id  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Balas Pesan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="mx-4">
                                                <?php
                                                $query2 = "SELECT * FROM pesan WHERE pengirim = $psn->pengirim or pengirim = 2 AND penerima=$psn->pengirim";

                                                $balas = $this->db->query($query2)->result();

                                                foreach ($balas as $bls) : ?>
                                                    <?php if ($bls->pengirim == 2) { ?>
                                                        <span>
                                                            <tr align="right">
                                                                <td></td>
                                                                <td scope="row"><?php echo $bls->isi_pesan ?></td>
                                                                <td>
                                                                    <img src="<?php echo base_url('assets/img/profile/'); ?>logo.png" width="20px" alt="">
                                                                </td>
                                                            </tr>
                                                        </span>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td>
                                                                <img src="<?php echo base_url('assets/img/profile/') . $psn->image; ?>" width="20px" alt="">
                                                            </td>
                                                            <td class="col-md-10" scope="row"><?php echo $bls->isi_pesan ?></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </table>

                                            <form action="<?php echo base_url() . 'admin/balas'; ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="hidden" name="pengirim" class="form-control" value="<?php echo $psn->pengirim ?>">
                                                            <input type="text" class="form-control" id="balasan" name="balasan" placeholder="ketikkan balasan.." required>
                                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <center>

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                    <br>
                                                </center>
                                            </form>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

            <?php }
            endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<!-- End of Main Content -->