<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <form action="<?= base_url('user/tambah'); ?>" method="post">

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="2">Admin</option>
                        <option value="3">Petugas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" class="form-control" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password2">Repeat password</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->