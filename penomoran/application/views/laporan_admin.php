<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><style>
        table {
            border-collapse: collapse;
        }
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style><title>Document</title></head><body>
        <img src="assets/img/logo/logo.png" style="position: absolute; width: 70px; height: auto; margin-left: 40px; margin-top: 20px;">
        <table style="width: 100%;">
    <tr>
        <td align="center">
            <span style="font-weight: bold;">
        <h2>PUSAT PENDIDIKAN PELATIHAN DAN SERTIFIKASI
        <br>UNIVERSITAS TEKNOLOGI YOGYAKARTA</h2>
        </span>
        </td>
    </tr>
    </table>
    <hr class="line-title">
    <h3 align="center">Rekap Penerbitan Nomor Sertifikat</h3><br>
    <br>
    <br>
    <table border="1">
        <tr>
            <td>No.</td>
            <td>Tanggal Terbit</td>
            <td>Tanggal Kegiatan</td>
            <td>Nama Kegiatan</td>
            <td>Penyelenggara</td>
            <td>Jenis Penyelenggara</td>
            <td>Jenis kegiatan</td>
            <td>Sertifikat Pertama</td>
            <td>Sertifikat Terakhir</td>
            <td>Pihak Satu</td>
            <td>Pihak Dua</td>
            <td>Pihak Tiga</td>
            <td>Keterangan</td>
        </tr>
        <?php $no=1; foreach($tampil as $tm) : ?>
        <tr>
            <td scope="row"><?php echo $no++ ?></td>
            <td scope="row"><?php echo $tm['tgl_terbit'] ?></td>
            <td scope="row"><?php echo $tm['tanggal_kegiatan'] ?></td>
            <td scope="row"><?php echo $tm['nama_kegiatan'] ?></td>
            <td scope="row"><?php echo $tm['penyelenggara'] ?></td>
            <td scope="row"><?php echo $tm['jenis_penyelenggara'] ?></td>
            <td scope="row"><?php echo $tm['jenis_kegiatan'] ?></td>
            <td scope="row"><?php echo $tm['no_sertifikat'] ?></td>
            <td scope="row"><?php echo $tm['maks'] ?></td>
            <td scope="row"><?php echo $tm['pihak_satu'] ?></td>
            <td scope="row"><?php echo $tm['pihak_dua'] ?></td>
            <td scope="row"><?php echo $tm['pihak_tiga'] ?></td>
            <td scope="row"><?php echo $tm['ket'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table><br>
</body></html>