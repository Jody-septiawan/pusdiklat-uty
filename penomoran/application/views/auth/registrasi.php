<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">BUAT AKUN</h1>
                        </div>

                        <form class="user" method="post" accept="<?= base_url('auth/registrasi'); ?>">
                            <div class="form-group">
                                <!-- value untuk biar ga kosong pas reload setelah error -->
                                <input name="name" type="text" class="form-control form-control-user" id="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                                <!-- untuk pesan error-->
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input name="email" type="text" class="form-control form-control-user" id="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="password1" type="password" class="form-control form-control-user" id="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="col-sm-6">
                                    <input name="password2" type="password" class="form-control form-control-user" id="password2" placeholder="Repeat Password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftar Akun
                            </button>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Lupa Password?</a>
                        </div>

                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah Punya Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>