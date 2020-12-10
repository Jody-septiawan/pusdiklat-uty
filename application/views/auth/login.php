<div class="page-holder d-flex align-items-center">
    <div class="container ">
        <div class="row align-items-center py-5">
            <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
                <div class="pr-lg-5"><img src="<?= base_url('assets/img/ilustrasi/login-hp-dark.svg'); ?>" alt="" class="img-fluid"></div>
            </div>
            <div class="col-lg-5 px-lg-4">
                <h1 class="text-base text-primary text-uppercase text-light mb-4">Pusdiklat & Sertifikasi UTY <img src="<?= base_url('assets/img/uty.png'); ?>" alt="" height="50"></h1>
                <h2 class="mb-4 text-light">Silahkan login</h2>
                <?= $this->session->flashdata('message'); ?>
                <form id="loginForm" action="<?= base_url('auth'); ?>" class="mt-4" method="post">
                    <div class="form-group mb-4">
                        <input type="text" name="username" placeholder="Username" class="form-control border-0 shadow form-control-lg text-primary" value="<?= set_value('username'); ?>">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" placeholder="Password" class="form-control border-0 shadow form-control-lg text-primary">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary shadow px-5">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>