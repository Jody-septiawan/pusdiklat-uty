<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pencarian Data Penerima</h1>
</div>
<!-- /.container-fluid -->
<div class="mx-4">
    <table class="table table-hover col-md-8" id="dataTable">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Nama Penerima</th>
            <th scope="col">Nama Kegiatan</th>
            <th scope="col">Nomor Sertifikat</th>
            <th scope="col">Detail Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($penerima as $pnr) : ?>

                <tr>
                    <td scope="row"><?php echo $no++ ?></td>
                    <td scope="row"><?php echo $pnr->nama ?></td>
                    <td scope="row"><?php echo $pnr->nama_kegiatan ?></td>
                    <td scope="row"><?php echo $pnr->no_sertifikat ?></td>
                    <td><?php echo anchor('admin/detail_cari/' . $pnr->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i></div>') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<!-- End of Main Content -->