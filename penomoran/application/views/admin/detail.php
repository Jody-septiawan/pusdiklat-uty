<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Daftar Pengajuan Nomor</h1>
</div>
<!-- /.container-fluid -->

<table class="table table-hover col-lg-8 ml-5">
    <tr>
        <th>Penyelenggara</th>
        <td><?php echo $detail->penyelenggara ?></td>
    </tr>
    <tr>
        <th>Nama Kegiatan</th>
        <td><?php echo $detail->nama_kegiatan ?></td>
    </tr>
    <tr>
        <th>Tanggal Kegiatan</th>
        <td><?php echo $detail->tanggal_kegiatan ?></td>
    </tr>
    <tr>
        <th>Pihak Manandatangani (1)</th>
        <td><?php echo $detail->pihak_satu ?></td>
    </tr>
    <tr>
        <th>Jabatan Pihak Manandatangani (1)</th>
        <td><?php echo $detail->jabatan_pihak_satu ?></td>
    </tr>
    <tr>
        <th>Pihak Manandatangani (2)</th>
        <td><?php echo $detail->pihak_dua ?></td>
    </tr>
    <tr>
        <th>Jabatan Pihak Manandatangani (2)</th>
        <td><?php echo $detail->jabatan_pihak_dua ?></td>
    </tr>
    <?php if ($detail->pihak_tiga == NULL) {
    } else {
    ?>
        <tr>
            <th>Pihak Manandatangani (3)</th>
            <td><?php echo $detail->pihak_tiga ?></td>
        </tr>
        <tr>
            <th>Jabatan Pihak Manandatangani (3)</th>
            <td><?php echo $detail->jabatan_pihak_tiga ?></td>
        </tr>
    <?php } ?>
    <tr>
        <th>Daftar Penerima</th>
        <td>
            <a href="<?php echo base_url('admin/detail_penerima/') . $detail->id; ?>">
                <?php echo $detail->data_penerima ?>
                <div class="btn btn-success btn-sm"><i class="fa fa-search"></i></div>
            </a>
        </td>
    </tr>
    <tr>
        <th>Desain Sertifikat</th>
        <!-- <td><?php echo $detail->desain ?></td> -->
        <td>
            <a href="<?php echo base_url('admin/download2/' . $detail->id); ?>">
                <?php echo $detail->desain ?>
                <div class="btn btn-success btn-sm"><i class="fa fa-download"></i></div>
            </a>
        </td>
    </tr>
    <?php if ($id_user['kode_penyelenggara']  == 5 || $id_user['kode_penyelenggara'] == 6) { ?>
        <tr>
            <th>Scan Formulir</th>
            <td>
                <a href="<?php echo base_url('admin/download3/' . $detail->id); ?>">
                    <?php echo $detail->scan_formulir ?>
                    <div class="btn btn-success btn-sm"><i class="fa fa-download"></i></div>
                </a>
            </td>
        </tr>
    <?php } ?>
</table>
<br>
<div class="tombol">
    <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary">Kembali</a>
</div>
<br>
<br>
<br>

</div>
<!-- End of Main Content -->