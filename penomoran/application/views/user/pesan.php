<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Percakapan Dengan Admin PUSDIKLAT</h1>
</div>
<!-- /.container-fluid -->

<div class="row">
    <div class="col-lg-10 ml-4">
        <?= $this->session->flashdata('message');  ?>
    </div>
</div>
<div class="chat">
    <div class="mx-4">
        <table class="mx-4">
            <?php
            $pengirim = $user['id'];
            $query2 = "SELECT * FROM pesan WHERE pengirim = $pengirim or pengirim = 2 AND penerima=$pengirim LIMIT 10";

            $balas = $this->db->query($query2)->result();

            foreach ($balas as $bls) : ?>
                <?php if ($bls->pengirim != 2) { ?>
                    <span>
                        <tr align="right">
                            <td></td>
                            <td scope="row"><?php echo $bls->isi_pesan ?></td>
                            <td>
                                <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>" width="20px" alt="">
                            </td>
                        </tr>
                    </span>
                <?php } else { ?>
                    <tr>
                        <td>
                            <img src="<?php echo base_url('assets/img/profile/'); ?>logo.png" width="20px" alt="">
                        </td>
                        <td class="col-md-10" scope="row"><?php echo $bls->isi_pesan ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
        </table>

        <form action="<?php echo base_url() . 'user/balas'; ?>" method="post">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input type="hidden" name="pengirim" class="form-control" value="<?php echo $pengirim ?>">
                        <input type="text" class="form-control" id="balasan" name="balasan" placeholder="ketikkan balasan.." required>
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>

            </div>
        </form>
        </table>
    </div>
</div>
</div>
<!-- End of Main Content -->

<style>
    .chat {
        background-color: darkgray;
        margin: 20px 20px 0px 20px;
        padding-top: 20px;
        color: black;
        border-radius: 15px;
    }

    .form-group {
        margin-top: 20px;
    }
</style>