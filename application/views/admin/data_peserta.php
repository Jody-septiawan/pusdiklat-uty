<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<?= $this->session->flashdata('message');  ?>
	<div class="col-sm-12">
		<!-- DataTales Example -->
		<div class="card shadow">
			<div class="card-header bg-primary border-bottom-warning py-4">
			</div>
			<div class="card-body">
				<table class="table table-hover" id="example">
					<thead>
						<tr>
							<th scope="col">
								#
							</th>
							<th scope="col">Nama Lengkap</th>
							<th scope="col">No Identitas</th>
							<th scope="col">Kelas</th>
							<th scope="col">No Slip</th>
							<th scope="col">Tanggal Bayar</th>
							<th scope="col">Bukti Bayar</th>
							<th scope="col">Status Pembayaran</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php foreach ($data_peserta as $dp) : ?>
							<tr>
								<th scope="row"><?= $i++ ?></th>
								<td><?= $dp['nama_lengkap']; ?></td>
								<td><?= $dp['no_identitas']; ?></td>
								<td><?= $dp['nama']; ?></td>
								<td><?= $dp['no_slip']; ?></td>
								<td><?= $dp['tanggal_bayar']; ?></td>
								<td><a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $dp['id'];  ?>"><i class="fas fa-eye"></i></a></td>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal<?= $dp['id'];  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<img src="<?= base_url('assets/img/slip/') . $dp['bukti_bayar'];  ?>" class="img-thumbnail">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<?php if ($dp['status'] == "Terverifikasi") : ?>
									<td><span class="badge badge-success"><?= $dp['status']; ?></span></td>
								<?php else : ?>
									<td><span class="badge badge-danger">Pending</span></td>
								<?php endif; ?>
								<td>
									<?php if ($dp['status'] == "Pending") : ?>
										<a class=" badge badge-success" href="<?= base_url('admin/verifikasi/' . $dp['id'] . '/' . $id_kelas) ?>">
											<svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-hourglass-split" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13s-.866-1.299-3-1.48V8.35z" />
											</svg>
										</a>
									<?php else : ?>
										<a class=" badge badge-danger" href="<?= base_url('admin/batalkan/' . $dp['id'] . '/' . $id_kelas) ?>">
											<svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
												<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
											</svg>
										</a>
								</td>
							<?php endif; ?>
						<?php endforeach; ?>
							</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- </div> -->