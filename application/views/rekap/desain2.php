<?php
foreach ($peserta as $p) :
    if ($p['keterangan'] == 'Lulus') :
        $total_lulus += 1;
    endif;
    $total_peserta += 1;
endforeach;
$persen_lulus = round($total_lulus / $total_peserta * 100, 2);

?>
<!doctype html>
<html>

<head>
    <title>Laporan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/uty.png">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid black;
            padding: 10px;
        }

        td {
            text-align: center;
        }

        .line {
            background-color: black;
            padding: 1px 0;
            margin-bottom: 5px;
        }

        h2 {
            text-transform: uppercase;
            margin: 0px;

        }

        h3 {
            text-transform: uppercase;
            margin: 0px;
            text-align: center;
        }

        .p-header {
            margin: 0px;
        }

        .p-content {
            text-align: center;
            font-size: 10px;
            margin: 0px;
            margin-bottom: 20px;
        }

        .logo-uty {
            width: 100px;
            margin-left: 10px;
        }

        .tabel-header td {
            border: 0;
            text-align: left;
        }

        .logo {
            width: 110px;
        }


        .nomor {
            width: 10px;
        }

        .no_identitas {
            width: 100px;
        }

        .nama {
            width: 200px;
        }

        .total-peserta {
            text-align: right;
            /* background-color: aquamarine; */
        }

        .total-nilai {
            text-align: left;
        }

        .baris-total,
        .total-peserta,
        .total-nilai {
            border: none;
        }

        .kiri {
            width: 30%;
        }

        .tengah {
            width: 30%;
        }

        .kanan {
            width: 30%;
        }

        .between-pengesahan {
            margin: 100px 0;
        }

        .jarak-kurung {
            margin: 0 100px
        }

        .pengesahan {
            margin-top: 40px;
        }

        .pengesahan table td {
            border: none;
        }

        .peserta {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table class="tabel-header">
        <tr>
            <td class="logo"><img src="<?= base_url('assets/'); ?>img/uty.png" class="logo-uty"></td>
            <td style="text-align: center;">
                <h2>UNIVERSITAS TEKNOLOGI YOGYAKARTA</h2>
                <h3>PUSDIKLAT & SERTIFIKASI</h3>
                <p class="p-header">
                    Jl. Siliwangi (Ringroad Utara) - Yogyakarta - Yogyakarta. D.I 55285
                </p>
                <p class="p-header">
                    Telp. (0274) 623310, Fax. (0274) 623306, E-Mail: info@uty.ac.id, Website: www.uty.ac.id
                </p>
            </td>
            <td class="logo">
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <div class="content">
        <h3>REKAPITULASI UJIAN SERTIFIKASI MICROSOFT</h3>
        <div style="text-align: center;"><?= $kelas['nama'] ?></div>
        <div style="text-align: center;"><?= date('d M Y, H:i ', $kelas['tanggal']); ?> WIB</div>
    </div>
    <div class="peserta">
        <table>
            <thead>
                <tr>
                    <th class="nomor">No</th>
                    <th class="no_identitas">No identitas</th>
                    <th class="nama">Nama</th>
                    <th>Institusi</th>
                    <th>Sertifikasi</th>
                    <th>Spesifikasi</th>
                    <th>Kehadiran</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

                <?php $norut = 1;
                foreach ($peserta as $p) : ?>
                    <tr>
                        <td><?= $norut++; ?></td>
                        <td><?= $p['no_identitas']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= $p['institusi']; ?></td>
                        <td><?= $p['alias'] ?></td>
                        <td><?= "-" ?></td>
                        <td>
                            <?php if ($p['presensi'] = 1) : ?>
                                Hadir
                            <?php else : ?>
                                Tidak hadir
                            <?php endif; ?>
                        </td>
                        <td><?= $p['nilai']; ?></td>
                        <td><?= $p['keterangan']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="baris-total">
                    <td colspan="9" class="total-peserta">Total lulus : <?= $total_lulus; ?> (<?= $persen_lulus ?>%)</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    $company = $this->db->get('company')->result_array();
    ?>
    <div class="pengesahan">
        <table>
            <tr>
                <td class="kiri">Proctor</td>
                <td class="tengah"> </td>
                <td class="kanan">Kepala <?= $company[2]['value'] ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="between-pengesahan"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="between-pengesahan"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="between-pengesahan"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="between-pengesahan"></div>
                </td>
            </tr>
            <tr>
                <td>( <?php for ($i = 1; $i <= 40; $i++) {
                            echo "&nbsp;";
                        } ?> )</td>
                <td></td>
                <td><b style="color: black;"><?= $company[0]['value'] ?></b></td>
            </tr>
        </table>
    </div>
</body>

</html>