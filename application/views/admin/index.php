<!-- Begin Page Content -->
<div class="container-fluid mb-3">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h5 class="h5 mb-0 text-gray-800">Exam Microsoft <i class="fab fa-microsoft"></i></h5>
    </div> -->

    <div class="row">
        <?php
        $Nmos = 0;
        // foreach ($mos as $mos) :
        //     $Nmos++;
        // endforeach;

        $Nmta = 0;
        // foreach ($mta as $mta) :
        //     $Nmta++;
        // endforeach;

        $Nmce = 0;
        // foreach ($mce as $mce) :
        //     $Nmce++;
        // endforeach;

        $Nmtc = 0;
        // foreach ($mtc as $mtc) :
        //     $Nmtc++;
        // endforeach;
        ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/mos') ?>">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Microsoft Office Specialist (MOS)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Nmos; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/mta') ?>">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Microsoft Technology Associate (MTA)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Nmta; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/mce') ?>">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Microsoft Certified Educator (MCE)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Nmce; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('absen/mtc') ?>">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Microsoft Technical Certifications (MTC)</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Nmtc; ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-microsoft fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-5">
                <div class="card-header bg-primary border-bottom-warning">
                    <div class="text-light">Peserta Ujian sertifikasi <?= date('Y') ?></div>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->