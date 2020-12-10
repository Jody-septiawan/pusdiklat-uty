<div class="container-fluid">
    <div class="col-md-8">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning text-light ">
                <div class="row">
                    <div class="col">
                        <span class="text-light">User akses menu</span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#newAkses">Tambah akses</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php// print_r($menuakses); ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1">No</th>
                                <th class="text-center" width="200">Username</th>
                                <th width="1"></th>
                                <th width="200" class="text-center">Menu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($menuakses as $ma) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="text-center"><?= $ma['username']; ?></td>
                                    <td class="text-center">&#8594;</td>
                                    <td class="text-center"><?= $ma['title']; ?></td>
                                    <td>
                                        <div class="text-center">
                                            <!-- <a href="<?= base_url('kelola_web/editaksesmenu/') . $ma['id']; ?>"><i class="fa fa-edit text-light mx-0 rounded-circle py-2 pl-2 pr-2 bg-success icon-kelas"></i></a> -->
                                            <a href="<?= base_url('kelola_web/deleteaksesmenu/') . $ma['id']; ?>" class="hapus-menuakses"><i class="fa fa-trash text-light mx-0 rounded-circle p-2 bg-danger icon-kelas"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newAkses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah akses menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kelola_web/addaksesmenu'); ?>" method="post">
                    <div class="form-group">
                        <label for="Formenu">From username</label>
                        <select class="form-control" id="Formenu" name="role_id">
                            <?php foreach ($datarole as $du) : ?>
                                <option value="<?= $du['id_role'] ?>"><?= $du['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Formenu">To menu</label>
                        <select class="form-control" id="Formenu" name="menu_id">
                            <?php foreach ($datamenu as $dm) : ?>
                                <option value="<?= $dm['id'] ?>"><?= $dm['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>