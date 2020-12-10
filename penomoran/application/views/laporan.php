<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table.satu {
            border-collapse: collapse;
            width: 100%;
        }
        
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
    <title>Document</title>
    </head><body>
        <img src="assets/img/logo/logo.png" style="position: absolute; width: 70px; height: auto; margin-left: 10px; margin-top: 20px;">
        <table style="width: 100%;">
    <tr>
        <td align="center">
            <span style="font-weight: bold;">
        <h3>PUSAT PENDIDIKAN PELATIHAN DAN SERTIFIKASI
        <br>UNIVERSITAS TEKNOLOGI YOGYAKARTA</h3>
        </span>
        </td>
    </tr>
    </table>
    <hr class="line-title">
    <h3 align="center">Nomor Sertifikat</h3><br>
    <table>
        <?php
        foreach ($pengajuan as $pn) : ?>
            <tr>
                <td>Nama Kegiatan</td>
                <td>:</td>
                <td scope="row"><?php echo $pn->nama_kegiatan ?></td>
            </tr>
            <tr>
                <td>Tanggal Kegiatan</td>
                <td>:</td>
                <td scope="row"><?php echo $pn->tanggal_kegiatan ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td>Jumlah Penerima</td>
            <td>:</td>
            <td scope="row"><?php echo $jumlah ?></td>
        </tr>
    </table><br>
    <table class="satu table table-hover col-md-12 ml-5" border="1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">No Identitas</th>
                <th scope="col">Instansi</th>
                <th scope="col">Keterangan</th>
                <th scope="col">No Sertifikat</th>
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
                    <td scope="row"><?php echo $dtl->no_sertifikat ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body></html>