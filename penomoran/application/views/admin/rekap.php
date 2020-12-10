<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Rekap Pengajuan Nomor Telah Terbit</h1>
</div>
<!-- /.container-fluid -->

<a href="" class="btn btn-primary mb-3 ml-4" data-toggle="modal" data-target="#exampleModal">Cetak Rekap</a>

<div class="mx-4">
    <table class="table table-hover col-md-8" id="dataTable">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Penyelenggara</th>
            <th scope="col">Nama Kegiatan</th>
            <th scope="col">Tanggal Terbit</th>
            <th scope="col">Detail</th>
            <th scope="col">Cetak</th>
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
                    <td scope="row"><?php echo date_format(new DateTime($nmr->tgl_terbit), 'd-m-Y')  ?></td>

                    <td><?php echo anchor('admin/detail_rekap/' . $nmr->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i></div>') ?></td>

                    <!-- <td><?php echo anchor('admin/pdf/' . $nmr->id, '<div class="btn btn-success btn-sm"><i class="fa fa-print"></i></div>') ?></td> -->

                    <td><?php echo anchor('admin/rekap_admin2/' . $nmr->id, '<div class="btn btn-success btn-sm"><i class="fa fa-print"></i></div>') ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<!-- End of Main Content -->


<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Periode Rekap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="rekap_admin" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="awal" class="col-sm-4 col-form-label">Sejak Tanggal</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" class="form-control">
                            <input type="date" class="form-control" id="awal" name="awal" required>
                            <?= form_error('awal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="akhir" class="col-sm-4 col-form-label">Hingga Tanggal</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="akhir" name="akhir" required>
                            <?= form_error('akhir', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <table align="center">
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-primary">Cetak</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>