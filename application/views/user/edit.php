<div class="container-fluid">

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">


                    <?= form_open_multipart('user/edit'); ?>

                    <div class="form-group row">

                        <input type="hidden" name="id" value="<?= $user['id']; ?>">

                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Picture</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="useDefault" name="useDefault" value="1">
                                            <label class="form-check-label" for="useDefault">
                                                Use default picture
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end mb-0">
                        <div class="col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>

                        </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

</div>