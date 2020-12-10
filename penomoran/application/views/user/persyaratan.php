<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">FILE PERSYARATAN</h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="col-lg-12">
        <p>
            Silahkan anda mendowload file file berikut sebagai acuan dalam pengajuan nomor sertifikat atau piagam penghargaan
        </p>
        <table class="table table-hover col-md-5 ml-3" id="DataTable">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Nama Persyaratan</th>
                <th scope="col">Download File</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($persyaratan as $fl) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $fl['persyaratan'] ?></td>

                        <td>
                            <a href="<?php echo base_url('user/download/' . $fl['id']); ?>">
                                <?php echo $fl['persyaratan'] ?>
                                <div class="btn btn-success btn-sm"><i class="fa fa-download"></i></div>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->