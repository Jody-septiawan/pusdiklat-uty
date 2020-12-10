<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Perhatian !</strong> Silahkan pesan kelas terlebih dahulu.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<br>
	<div class="col-sm-12">
		<!-- DataTales Example -->
		<div class="card-header bg-primary border-bottom-warning text-right">
			<a href="<?= base_url('sertifikasi/ujian_sertifikasi')  ?>" class="btn btn-success py-1 my-0 " id="boking">Lihat Booking</a>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">
						#
					</th>
					<th scope="col">Kelas</th>
					<th scope="col">Ruangan</th>
					<th scope="col">Lokasi</th>
					<th scope="col">Tanggal Ujian</th>
					<th scope="col">Kuota</th>
					<th scope="col">Sisa Kuota</th>

					<th scope="col">Status</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1 ?>
				<?php foreach ($kelas as $k) : ?>

					<tr>
						<th scope="row"><?= $i++ ?></th>
						<td><?= $k['nama']; ?></td>
						<td><?= $k['ruangan']; ?></td>
						<td><?= $k['lokasi']; ?></td>
						<td><?= $k['tanggal']; ?></td>
						<td><?= $k['kuota']; ?></td>
						<td><?= $k['sisa_kuota']; ?></td>

						<?php if ($k['sisa_kuota'] > 0) : ?>
							<td>
								<span class="badge badge-primary"> <?= $k['status']; ?></span>
							</td>

							<!-- <td><?= date('d-m-Y', strtotime($boking->tanggal_ujian)) . "#" . date('d-m-Y', strtotime($k['tanggal'])) ?></td> -->

							<td>
								<a href="" class="fas fa-fw fa-user-plus" data-toggle="modal" data-target="#pilih<?= $k['id']; ?>"> Pilih</a>
								<!-- Modal -->

								<div class="modal fade" id="pilih<?= $k['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newKelasModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="newKelasModalLabel">Pilih Sertifikasi .<b><?= $k['nama']; ?></b></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												<!-- form -->


												<form class="user" action="<?= base_url('sertifikasi/bo_kelas/' . $k['id']); ?>" method="POST">
													<div class="form-group">
														<select class="form-control" id="id_ujian" name="id_ujian" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
															<option value=selected>
																Pilih Jenis Ujian
															</option>
															<?php foreach ($jenis_ujian as $ju) : ?>
																<option value="<?= $ju['id_ujian']; ?>"><?= $ju['jenis_sertifikasi'] ?></option>
															<?php endforeach ?>

														</select>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary ">Tambahkan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

								<!-- end Modal -->

							<?php else :	?>
							<td>
								<span class="badge badge-danger"><?= $k['status']; ?></span>
							<td>
								<a href="#penuh" class="fas fa-fw fa-times" data-toggle="modal" data-target=""></a>

								<div class="modal fade" id="penuh" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="fas fa-fw fa-exclamation-triangle danger" id="staticBackdropLabel"></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<b><?= $k['nama']; ?></b> Penuh Silahkan Pilih Kelas Lain </div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</td>

							</td>
						<?php endif; ?>

						</form>
						<!-- endform -->

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- </div> -->