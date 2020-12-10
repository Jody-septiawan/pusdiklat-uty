<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style>
		.tepi {
			border-style: solid;
		}

		.label {
			float: left;
			width: 200px;
			padding-right: 20px;
		}

		.input {
			float: left;
			padding-left: 0px;
			padding-right: 20px;
			width: calc(100% - 200px);
		}
	</style>
	<title><?= $kartu_ujian['nama_lengkap']; ?></title>
</head>

<body class="col-lg-7">
	<div class="mt-1" style="border: 2px black dashed; height: 720px; width: 720px;">
		<div class="mt-4 ml-2">
			<table class="tepi" width="700px">
				<tr>
					<td width="1">
						<div class="mx-3">
							<img src="<?= base_url('/assets/img/logo-uty.png') ?>" height="120px" width="120px" alt="">
						</div>
					</td>
					<td>
						<div style="text-align: left;" class="">
							<h5 class="">Pusdiklat dan Sertifikasi Universitas Teknologi Yogyakarta</h5>
							<p>
								Jl. Siliwangi (Ringroad Utara) - Yogyakarta D.i.55285 <br>
								Telp. (0274) 623310, fax. (0274)623306 E-mail: info@uty.ac.id <br>
								Website: www.uty.ac.id <br>
								Ujian Sertifikasi </p>
						</div>
					</td>
				</tr>


			</table>
			<table border="2" width="700px">
				<tr>
					<td>
						<div style="text-align: left;" class="ml-3">
							<div class="ml-2">
								<h5>DATA DIRI</h5>
							</div>
							<div style="line-height: 25px;">
								<table style="margin-left: 25px;">
									<tr>
										<td><b>No peserta</b></td>
										<td>:</td>
										<td><?= $kartu_ujian['id']; ?></td>
									</tr>
									<tr>
										<td><b>Nama peserta</b></td>
										<td>:</td>
										<td><?= $kartu_ujian['nama']; ?></td>
									</tr>
									<tr>
										<td><b>No. Identitas</b></td>
										<td>: </td>
										<td><?= $kartu_ujian['no_identitas']; ?></td>
									</tr>
									<tr>
										<td><b>Tanggal Lahir</b></td>
										<td>:</td>
										<td><?= $kartu_ujian['tgl_lahir']; ?></td>
									</tr>
								</table>

							</div>
						</div>
					</td>
				</tr>
			</table>
			<table border="2" style="border-top: 0px;" width="700px">
				<tr>
					<td>
						<div style="text-align: left;" class="ml-4">
							<div class="">
								<h5>Jadwal Ujian <?= $kartu_ujian['nama_sertifikasi'] ?></h5>
								<div style="line-height: normal;">
									<div style="line-height: 25px;">
										<table style="margin-left: 20px;">
											<tr>
												<td><b>Hari</b></td>
												<td>:</td>
												<td><?= nama_hari(date('l', strtotime($kartu_ujian["tanggal_ujian"])));   ?></td>
											</tr>
											<tr>
												<td><b>Tanggal</b></td>
												<td>:</td>
												<td><?= date('d / M / y', strtotime($kartu_ujian["tanggal_ujian"]));   ?></td>
											</tr>
											<tr>
												<td><b>Jam</b></td>
												<td>: </td>
												<td><?= date('H:i a', strtotime($kartu_ujian["tanggal_ujian"]));   ?></td>
											</tr>
										</table>
									</div>
									<h5>Lokasi Ujian Sertifikasi</h5>
									<div style="line-height: 25px;">
										<table style="margin-left: 20px;">
											<tr>
												<td><b>Lokasi</b></td>
												<td>:</td>
												<td><?= $kartu_ujian['lokasi']; ?></td>
											</tr>
											<tr>
												<td><b>Ruangan</b></td>
												<td>:</td>
												<td><?= $kartu_ujian['nama_ruangan']; ?></td>
											</tr>
										</table>

									</div>
									<h5>Jenis Ujian Sertifikasi</h5>
									<div style="line-height: 25px;">
										<table style="margin-left: 20px;">
											<tr>
												<td><b>Spesifikasi</b></td>
												<td>:</td>
												<td><?= $kartu_ujian['nama_sertifikasi']; ?></td>
											</tr>
											<tr>
												<td><b>Sertifikasi</b></td>
												<td>:</td>
												<td><?= $kartu_ujian['jenis_sertifikasi']; ?></td>
											</tr>
										</table>

									</div>
								</div>

							</div>
						</div>
					</td>
				</tr>
			</table>
			<table border="2" width="700px" style="border-top: 0px;">
				<tr>
					<td>
						<div style="text-align: left;" class="col-md-15 ml-3">
							<div class="ml-2">
								<h5>PERHATIAN</h5>
							</div>
							<div class="ml-0" style="line-height: normal;">
								<ul>
									<li>
										Membawa KTM pada saat ujian dan bukti pembayaran
									</li>
									<li>
										Sudah disediakan alat tulis
									</li>
									<li>
										Tidak boleh terlambat dan Tidak boleh pindah jam tanpa ada pemberitahuan
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>