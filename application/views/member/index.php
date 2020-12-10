<div class="flash-data" data-flashdata="<?= $this->session->flashdata('ganti_pw'); ?>"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="h3 text-dark mb-3">Sertifikasi</div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pelatihan </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Coming Soon</div>
                        </div>
                        <div class="col-auto">
                            <!-- <a href="" class="btn btn-info">Cek</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Ujian </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 17px"> <span class="text-muted">Tersedia : </span><?= $kelasSertifikasi ?> kelas</div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('sertifikasi/daftar_kelas'); ?>" class="btn btn-info">Cek</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-12">
            <div class="h3 text-dark mb-3">Bahasa</div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pelatihan </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Coming Soon</div>
                        </div>
                        <div class="col-auto">
                            <!-- <a href="" class="btn btn-success">Cek</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ujian </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Coming Soon</div>
                        </div>
                        <div class="col-auto">
                            <!-- <a href="" class="btn btn-warning">Cek</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class=" row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <img src="<?= base_url('assets/img/ilustrasi/hello.svg') ?>" alt="" class="img-fluid">
        </div>
    </div> -->
</div>