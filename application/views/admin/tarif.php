<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->


	<!-- /.container-fluid -->
	<div class="row">
		<div class="col-lg-12">
			<?php if (validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>
			<?= $this->session->flashdata('message');  ?>

			<div class="card shadow">
				<div class="card-header bg-primary border-bottom-warning text-right ">
					<a href="" class="btn btn-success my-0 py-1 border-dark" data-toggle="modal" data-target="#newTarifModal">Tambah Tarif</a>
				</div>
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Jenis Sertifikasi</th>
								<th scope="col">Jenis Pendaftar</th>
								<th scope="col">Tarif</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							<?php foreach ($tarif as $t) : ?>
								<tr>
									<th scope="row"><?= $i ?></th>
									<td><?= $t['jenis_sertifikasi'] ?></td>
									<td><?= $t['nama_jenis'] ?></td>
									<td>Rp. <?= rupiah($t['tarif']); ?>,-</td>

									<td>


										<!-- Edit -->
										<a data-toggle="modal" data-target="#editTarif<?= $t['id']; ?>" class="fa fa-list text-light mx-0 rounded-circle p-2 bg-primary icon-kelas" href="">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
											</svg>
										</a>


										<!-- Modal -->
										<div class="modal fade" id="editTarif<?= $t['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editTarifLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="editTarifLabel">Edit Tarif</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="<?= base_url('admin/edit_tarif'); ?>" method="POST">
														<div class="modal-body">
															<div class="form-group">

																<input type="text" class="form-control" id="tarif" name="tarif" value="<?= rupiah($t['tarif']) ?>">
																<input type="hidden" id="id" name="id" value="<?= $t['id'] ?>">
															</div>
															<div class="form-group">
																<select name="id_jenis" class="form-control" id="id_jenis" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">

																	<?php foreach ($jenis_pendaftar as $jp) : ?>
																		<option value="<?= $jp['id']; ?>"><?= $jp['nama_jenis'] ?></option>
																	<?php endforeach ?>

																</select>
															</div>
															<div class="form-group">
																<select name="id_ujian" class="form-control" id="id_ujian" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
																	<?php foreach ($jenis_ujian as $ju) : ?>
																		<option value="<?= $ju['id_ujian']; ?>"><?= $ju['jenis_sertifikasi'] ?></option>
																	<?php endforeach ?>

																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Update</button>
														</div>
													</form>
												</div>
											</div>
										</div>

										<!-- Hapus -->
										<a class="fa fa-trash text-light mx-0 rounded-circle p-2 bg-danger icon-kelas" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('admin/hapus_tarif/' . $t['id']) ?>">
											<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
											<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
											</svg>
										</a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newTarifModal" tabindex="-1" role="dialog" aria-labelledby="newTarifModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newTarifModalLabel">Tambah Tarif</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form -->
				<form class="user" action="<?php base_url('admin/tarif'); ?>" method="POST">
					<div class="form-group">
						<input type="number" class="form-control" id="tarif" name="tarif" placeholder="Tarif" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
					</div>
					<div class="form-group">
						<select name="id_jenis" class="form-control" id="id_jenis" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
							<option selected disabled value="">Jenis Pendaftar</option>
							<?php foreach ($jenis_pendaftar as $jp) : ?>
								<option value="<?= $jp['id'] ?>"><?= $jp['nama_jenis'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<select name="id_ujian" class="form-control" id="id_ujian" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
							<option selected disabled value="">Jenis Ujian</option>
							<?php foreach ($jenis_ujian as $ju) : ?>
								<option value="<?= $ju['id_ujian'] ?>"><?= $ju['jenis_sertifikasi'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary ">Tambahkan</button>
			</div>
			</form>
			<!-- endform -->
		</div>
	</div>
	<!-- </div> -->