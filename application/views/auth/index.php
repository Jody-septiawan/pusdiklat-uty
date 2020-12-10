<div class="my-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="pr-lg-5"><img src="<?= base_url('assets/img/ilustrasi/login-hp-dark.svg'); ?>" alt="" class="img-fluid"></div>
            </div>
            <div class="col-md-5 mt-5">
                <table class="mt-5 mb-5">
                    <tr>
                        <td>
                            <a href="<?= base_url(''); ?>">
                                <img src="<?= base_url('assets/img/uty.png'); ?>" alt="" height="50" class="mr-2">
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url(''); ?>" class="btn text-left p-0">
                                <h1 class="text-base text-light text-uppercase mb-0">UNIVERSITAS TEKNOLOGI YOGYAKARTA </h1>
                                <p class="text-base text-light text-uppercase mb-0"> Pusdiklat & Sertifikasi</p>
                            </a>
                        </td>
                    </tr>
                </table>

                <!-- <h2 class="text-light mb-0">Silahkan login</h2> -->
                <?= $this->session->flashdata('message'); ?>
                <form id="loginForm" action="<?= base_url('auth'); ?>" class="mt-4" method="post">
                    <div class="form-group mb-4">
                        <input type="text" name="username" placeholder="Email or username" class="form-control border-0 shadow form-control-lg text-primary" value="<?= set_value('username'); ?>">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" placeholder="Password" id="password" class="form-control border-0 shadow form-control-lg text-primary">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?> <br>
                        <input type="checkbox" onclick="ShowPassword()" class="mx-2"><span class="text-light">Show Password</span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-grad px-5 py-1">Login</button>
                        <div class="text-light mt-2"> Belum Punya Akun? <a href="<?= base_url('registration') ?>" class="text-warning">Daftar</a></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5 pt-5 text-center text-light">
                <span class="px-2 py-0 rounded"><a href="<?= base_url(''); ?>" class="text-light"> Pusdiklat & Sertifikasi UTY</a> &copy; <?= date('Y'); ?></span>
            </div>
        </div>
    </div>
</div>