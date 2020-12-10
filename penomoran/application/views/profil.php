<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile Member</h1>
</div>
<!-- /.container-fluid -->

<div class="row">
    <div class="col-lg-6 ml-4">
        <?= $this->session->flashdata('message');  ?>
    </div>
</div>

<a href="" class="btn btn-primary mb-3 ml-4" data-toggle="modal" data-target="#exampleModal">Edit Profile</a>

<div class="card mb-3 ml-4" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h4 class="card-text"><small class="text-muted"><?= $user['name']; ?></small></h4>
                <h4 class="card-text"><small class="text-muted"><?= $user['email']; ?></small></h4>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="edit_profile" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <label for="name" class="col-sm-8 col-form-label"><b> Foto Profil (jpg/jpeg/png)</b></label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="custom-file">
                                <input type="hidden" id="email" name="email" value="<?= $user['email']; ?>">
                                <input type="file" class="custom-file-input" id="image" name="image" required>
                                <label for="image" class="custom-file-label">Choose File</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <table align="center">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>