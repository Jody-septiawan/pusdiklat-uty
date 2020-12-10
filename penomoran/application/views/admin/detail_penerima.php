<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Data Penerima</h1>
</div>
<!-- /.container-fluid -->

<div class="mx-4">
    <table class="table table-hover col-md-8" id="dataTable">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">No Identitas</th>
            <th scope="col">Instansi</th>
            <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($detail as $dtl) : ?>

                <tr>
                    <td scope="row"><?php echo $no++ ?></td>
                    <td scope="row"><?php echo $dtl->nama ?></td>
                    <td scope="row"><?php echo $dtl->no_identitas ?></td>
                    <td scope="row"><?php echo $dtl->instansi ?></td>
                    <td scope="row"><?php echo $dtl->keterangan ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br>
<div class="tombol">
    <a href="<?php echo base_url('admin/detail/' . $coba->id); ?>" class="btn btn-primary">Kembali</a>
</div>
<br>
</div>
<!-- End of Main Content -->