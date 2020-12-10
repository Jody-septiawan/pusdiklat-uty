<div class="container-fluid">

    <div class="row">

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <form action="<?= base_url('user/prosesganti') ?>" method="post">

                <input type="hidden" name="id" value="<?= $ganti['id']; ?>">

                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                    <?= form_error('currentPassword', '<small class="text-danger pl-3">', '</small>') ?>

                </div>
                <div class="form-group">
                    <label for="newPassword1">New Password</label>
                    <input type="password" class="form-control" id="newPassword1" name="newPassword1">
                    <?= form_error('newPassword1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="newPassword2">Repeat Password</label>
                    <input type="password" class="form-control" id="newPassword2" name="newPassword2">
                    <?= form_error('newPassword2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>

    </div>


</div>

</div>