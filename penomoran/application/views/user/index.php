<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">KETENTUAN PENGAJUAN</h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="col-lg-7 mx-auto">
        <?php foreach ($nama_file as $nf) : ?>
            <img src="./assets/file/ketentuan/<?= $nf['nama_file'] ?>" class="img-fluid col-mx-auto" alt="Responsive image">
        <?php endforeach; ?>
    </div>
    <br>
    <br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->