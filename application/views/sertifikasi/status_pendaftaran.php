<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<?= $this->session->flashdata('message');  ?>
	<div class="col-sm">
		<!-- DataTales Example -->
		<div class="card shadow">
			<div class="card-header bg-primary border-bottom-warning py-4">
			</div>
			<div class="card-body">
				<table class="table table-hover">
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
							<th scope="col">Kartu Ujian</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php foreach ($status_pendaftaran as $sp) : ?>

							<tr>
								<th scope="row"><?= $i++ ?></th>
								<td><?= $sp['nama']; ?></td>
								<td><?= $sp['no_identitas']; ?></td>
								<td><?= $sp['nama']; ?></td>
								<td><?= $sp['no_slip']; ?></td>
								<td><?= $sp['tanggal_bayar']; ?></td>
								<td><?= $sp['bukti_bayar']; ?></td>
								<?php if ($sp['status'] == "Terverifikasi") : ?>
									<td><span class="badge badge-success"><?= $sp['status']; ?></span></td>
									<td><a href="<?= base_url('sertifikasi/kartu_ujian/') . $sp['id']; ?>" onclick="return true" class="badge badge-primary">
											<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z" />
												<path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z" />
												<path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z" />
											</svg>
										</a></td>
								<?php else : ?>
									<td>

										<span class="badge badge-warning">Pending</span>
									</td>

									<td>
										<center><a href="" class="fas fa-phone " data-toggle="modal" data-target="#hubadmin"><br>Hubungi Admin</a></center>
									</td>

									<!-- modal hubungi admin -->
									<div class="modal fade" id="hubadmin" tabindex="-1" role="dialog" aria-labelledby="newKelasModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="newKelasModalLabel">Hubungi Admin</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<!-- form -->

													<h6> <b> Jika Pembayaran anda belum terverifikasi selama 3 Hari jam kerja</b></h6>
													<h6> Hubungi Admin Pusdiklat :</h6>
													<h6> </h6>

													<h6>WA : <b>085743200650</b> Umar Zaky S.kom M.Cs</h6>
													<h6>Email : pusdiklat@uty.ac.id </h6>
												</div>

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